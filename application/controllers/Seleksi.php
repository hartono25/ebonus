<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Seleksi extends CI_Controller
{
    public function index()
    {
        if ($this->session->userdata('username') == null) {
            echo '<script>alert("Please login first!"); location.href = "' . site_url('login') . '"</script>';
        } else {

            $all = $this->Model->getall();
            $tsi = 0;
            foreach ($all as $a) {
                $absensi = $this->Model->bobot_by_id($a['id_bobot_absensi']);
                $perilaku = $this->Model->bobot_by_id($a['id_bobot_perilaku']);
                $disiplin = $this->Model->bobot_by_id($a['id_bobot_kedisiplinan']);
                $wawasan = $this->Model->bobot_by_id($a['id_bobot_wawasan']);
                $kerjasama = $this->Model->bobot_by_id($a['id_bobot_kerjasama']);
                $kinerja = $this->Model->bobot_by_id($a['id_bobot_kinerja']);

                $powabsensi = pow($a['bobot_poin_absensi'], $absensi['perbaikan_bobot']);
                $powperilaku = pow($a['bobot_poin_perilaku'], $perilaku['perbaikan_bobot']);
                $powdisiplin = pow($a['bobot_poin_kedisiplinan'], $disiplin['perbaikan_bobot']);
                $powwawasan = pow($a['bobot_poin_wawasan'], $wawasan['perbaikan_bobot']);
                $powkerjasama = pow($a['bobot_poin_kerjasama'], $kerjasama['perbaikan_bobot']);
                $powkinerja = pow($a['bobot_poin_kinerja'], $kinerja['perbaikan_bobot']);

                $si = ($powabsensi * $powperilaku * $powdisiplin * $powwawasan * $powkerjasama * $powkinerja);
                $tsi = $tsi + $si;
                $vi = $si / $tsi;

                $akumulasi = $a['total_poin'] + $a['total_poin_perilaku'] + $a['total_poin_kedisiplinan'] + $a['total_poin_wawasan'] + $a['total_poin_kerjasama'] + $a['total_poin_kinerja'];
                $penilaian = [
                    'nik'               => $a['nik'],
                    'nilai_si'          => $si,
                    'nilai_vi'          => 0,
                    'akumulasi_poin'    => $akumulasi,
                    'tgl_penilaian'     => date('Y-m-d'),
                ];


                $cari = $this->Model->cari_penilaian($a['nik']);
                // $cari = $this->Model->cari_penilaian();
                if ($cari == 0) {
                    $this->Model->menyimpan_data('penilaian', $penilaian);
                }
            }

            $asal = $this->Model->getpenilaian();
            // $tsi = 0;
            foreach ($asal as $as) {
                // $tsi = $tsi + $as['nilai_si'];
                $vi  = $as['nilai_si'] / $tsi;

                $vvi = [
                    'nilai_vi' => $vi
                ];

                $this->Model->updateData($as['nik'], 'nik', 'penilaian', $vvi);
            }

            $data = [
                'title'     => 'Data Bobot Kriteria',
                'data'      => $this->Model->getpenilaian(),
                'urut'      => $this->Model->urut(),

            ];

            $this->load->view('auth/auth_header', $data);
            $this->load->view('seleksi/index');
            $this->load->view('auth/auth_footer');
        }
    }

    public function bobot_input()
    {
        if ($this->session->userdata('username') == null) {
            echo '<script>alert("Please login first!"); location.href = "' . site_url('login') . '"</script>';
        } else {
            if ($this->session->userdata('role') != '0') {
                echo '<script>alert("This account is not allowed!"); location.href = "' . site_url() . '"</script>';
            } else {
                $this->form_validation->set_rules('fullname', 'Nama Lengkap', 'required|trim');
                $this->form_validation->set_rules('phone', 'Nomor Telpon', 'required|trim');
                $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
                $this->form_validation->set_rules('username', 'Username', 'required|trim|max_length[15]|min_length[3]|is_unique[user.username]');
                $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[3]');

                if ($this->form_validation->run() == false) {
                    # code...
                    $data = [
                        'title'     => 'Tambah Kriteria',
                    ];
                    $this->load->view('auth/auth_header', $data);
                    $this->load->view('bobot/tambah', $data);
                    $this->load->view('auth/auth_footer');
                } else {
                    # code...
                    // $user = [
                    //     'full_name'     => $this->input->post('fullname'),
                    //     'username'      => $this->input->post('username'),
                    //     'password'      => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                    //     'akses'         => $this->input->post('akses'),
                    //     'is_active'     => '1',
                    //     'date_created'  => date('Y-m-d')
                    // ];

                    // $this->Model->menyimpan_data('user', $user);
                    // $iduser = $this->db->insert_id();
                    // $petugas = [
                    //     'kode_petugas'  => $this->input->post('kodepts'),
                    //     'full_name'     => $this->input->post('fullname'),
                    //     'phone'         => $this->input->post('phone'),
                    //     'email'         => $this->input->post('email'),
                    //     'id_user'       => $iduser,
                    //     'date_created'  => date('Y-m-d'),
                    //     'deleted'       => '0'
                    // ];

                    // $this->Model->menyimpan_data('petugas', $petugas);
                    redirect(site_url('supplier'));
                }
            }
        }
    }

    public function karyawan_edit($petugas)
    {
        if ($this->session->userdata('username') == null) {
            echo '<script>alert("Please login first!"); location.href = "' . site_url('login') . '"</script>';
        } else {
            if ($this->session->userdata('role') != '1') {
                echo '<script>alert("This account is not allowed!"); location.href = "' . site_url() . '"</script>';
            } else {
                $data['petugas']    = $this->Model->petugas_by_kode($petugas);
                $username   = $this->input->post('username');

                if ($username != $data['petugas']['username']) {
                    $this->form_validation->set_rules('username', 'Username', 'required|trim|max_length[15]|min_length[3]|is_unique[user.username]');
                }

                $this->form_validation->set_rules('fullname', 'Nama Lengkap', 'required|trim');
                $this->form_validation->set_rules('phone', 'Nomor Telpon', 'required|trim');
                $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
                $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[3]');

                if ($this->form_validation->run() == false) {
                    # code...

                    $this->load->view('auth/auth_header');
                    $this->load->view('user/user_edit', $data);
                    $this->load->view('auth/auth_footer');
                } else {
                    # code...
                    $now_password   = $this->input->post('password');
                    $old_password   = $data['petugas']['password'];
                    $user = [
                        'full_name'     => $this->input->post('fullname'),
                        'username'      => $this->input->post('username'),
                        'password'      => ($now_password == $old_password ? $old_password : password_hash($now_password, PASSWORD_DEFAULT)),
                        'akses'         => $this->input->post('akses'),
                        'is_active'     => $this->input->post('aktif'),
                        'date_created'  => date('Y-m-d')
                    ];

                    $this->Model->updateData($data['petugas']['id_user'], 'id_user', 'user', $user);
                    // $iduser = $this->db->insert_id();
                    $datapetugas = [
                        'full_name'     => $this->input->post('fullname'),
                        'phone'         => $this->input->post('phone'),
                        'email'         => $this->input->post('email'),
                        'date_created'  => date('Y-m-d'),
                    ];

                    $this->Model->updateData($petugas, 'kode_petugas', 'petugas', $datapetugas);
                    redirect(site_url('petugas'));
                }
            }
        }
    }

    public function karyawan_hapus($kode)
    {
        if ($this->session->userdata('username') == null) {
            echo '<script>alert("Please login first!"); location.href = "' . site_url('login') . '"</script>';
        } else {
            if ($this->session->userdata('role') != '1') {
                echo '<script>alert("This account is not allowed!"); location.href = "' . site_url() . '"</script>';
            } else {
                $petugas = [
                    'deleted' => '1'
                ];

                $this->Model->updateData($kode, 'kode_petugas', 'petugas', $petugas);
                redirect(site_url('petugas'));
            }
        }
    }
}
