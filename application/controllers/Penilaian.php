<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Penilaian extends CI_Controller
{
    // public function __construct()
    // {
    //     date_default_timezone_set('Asia/Jakarta');
    // }

    public function index()
    {
        if ($this->session->userdata('username') == null) {
            echo '<script>alert("Please login first!"); location.href = "' . site_url('login') . '"</script>';
        } else {
            $data = [
                'title'   => 'Penilaian Karyawan',
                'data'      => $this->Model->getbobot(),
                'join'      => $this->Model->join_karyawan(),
                'karyawan'  => $this->Model->getkaryawan(),
                'group'     => $this->Model->get_penilaian_group(),
            ];

            $this->load->view('auth/auth_header', $data);
            $this->load->view('penilaian/index');
            $this->load->view('auth/auth_footer');
        }
    }

    public function penilaian_input()
    {
        if ($this->session->userdata('username') == null) {
            echo '<script>alert("Please login first!"); location.href = "' . site_url('login') . '"</script>';
        } else {
            if ($this->session->userdata('role') != '0') {
                echo '<script>alert("This account is not allowed!"); location.href = "' . site_url() . '"</script>';
            } else {
                $this->form_validation->set_rules('nama', 'Nama Lengkap', 'required|trim');
                $this->form_validation->set_rules('nik', 'NIK', 'required|trim');

                if ($this->form_validation->run() == false) {
                    # code...
                    $data = [
                        'title'   => 'Penilaian Karyawan',
                        'data'      => $this->Model->getbobot(),
                        'join'      => $this->Model->join_karyawan(),
                        'karyawan'  => $this->Model->getkaryawan(),
                    ];
                    $this->load->view('auth/auth_header', $data);
                    $this->load->view('penilaian/index');
                    $this->load->view('auth/auth_footer');
                } else {
                    # code...

                    $nik                = $this->input->post('nik');
                    $tgl                = date('Y-m-d');
                    $nilai              = $this->input->post('nilai');
                    $bobot_nilai        = $this->input->post('bobot_nilai');
                    $idnilai            = $this->input->post('idnilai');
                    $perbaikan_bobot    = $this->input->post('bobot_perbaikan');
                    $count = count($nilai);
                    $si = 1;
                    $tvi = 0;

                    for ($i = 0; $i < $count; $i++) {
                        $caris = $this->Model->penilaian_karyawan($bobot_nilai[$i], $idnilai[$i]);
                        $pangkat    = pow($caris['bobot'], $perbaikan_bobot[$i]);
                        $si         = $si * $pangkat;
                        $tvi        = $tvi + $si;
                        // $vi         = $si / $tvi;

                        $penilaian = [
                            'nik'               => $nik,
                            'kriteria'          => $nilai[$i],
                            'bobot_penilaian'   => $caris['bobot'],
                            'ket_penilaian'     => $caris['nilai_kriteria'],
                            'bobot_perbaikan'   => $perbaikan_bobot[$i],

                            'tgl_penilaian'     => $tgl
                        ];
                        $this->Model->menyimpan_data('penilaian_karyawan', $penilaian);
                        // var_dump($penilaian);
                    }

                    $cari = $this->Model->cari_penilaian();
                    $update = [
                        'nik'               => $nik,
                        'nilai_si'          => $si,
                        'tgl_penilaian'     => date('Y-m-d')
                    ];
                    if ($cari == 0) {
                        $this->Model->menyimpan_data('penilaian', $update);
                    } else {
                        $this->Model->menyimpan_data('penilaian', $update);
                        $asal = $this->Model->getpenilaian();
                        $tsi = 0;
                        foreach ($asal as $a) {
                            $tsi = $tsi + $a['nilai_si'];
                            $vi  = $a['nilai_si'] / $tsi;

                            $vvi = [
                                'nilai_vi' => $vi
                            ];

                            $this->Model->updateData($a['nik'], 'nik', 'penilaian', $vvi);
                        }
                    }

                    redirect(site_url('penilaian'));
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

    public function penilaian_hapus($kode)
    {
        if ($this->session->userdata('username') == null) {
            echo '<script>alert("Please login first!"); location.href = "' . site_url('login') . '"</script>';
        } else {
            if ($this->session->userdata('role') != '0') {
                echo '<script>alert("This account is not allowed!"); location.href = "' . site_url() . '"</script>';
            } else {

                $this->Model->deleteDataPenilaian($kode, 'nik', 'penilaian_karyawan');
                redirect(site_url('penilaian'));
            }
        }
    }

    public function absensi()
    {
        if ($this->session->userdata('username') == null) {
            echo '<script>alert("Please login first!"); location.href = "' . site_url('login') . '"</script>';
        } else {
            $this->form_validation->set_rules('nama', 'Nama Lengkap', 'required|trim');
            $this->form_validation->set_rules('nik', 'NIK', 'required|trim');

            if ($this->form_validation->run() == false) {

                $data = [
                    'title'   => 'Penilaian Karyawan Absensi',
                    'karyawan'  => $this->Model->getkaryawan(),
                    'data'      => $this->Model->getabsensi(),

                ];

                $this->load->view('auth/auth_header', $data);
                $this->load->view('penilaian/absensi');
                $this->load->view('auth/auth_footer');
            } else {

                $nik = $this->input->post('nik');
                $harikerja = $this->input->post('total_hari');
                $totalmasuk = $this->input->post('total_masuk');

                $poin = ($totalmasuk / $harikerja) * 100;
                $nilai = $this->Model->penilaian_karyawan($poin, "ABSENSI");

                // var_dump($nilai['nilai_kriteria']);
                $penilaian = [
                    'nik'                   => $nik,
                    'hari_kerja'            => $this->input->post('total_hari'),
                    'total_masuk'           => $this->input->post('total_masuk'),
                    'total_poin'            => $poin,
                    'keterangan'            => $nilai['nilai_kriteria'],
                    'bobot_poin_absensi'    => $nilai['bobot'],
                    'tgl_penilaian'         => date('Y-m-d'),
                    'id_bobot_absensi'      => $nilai['id_bobot']
                ];

                $this->Model->menyimpan_data('absensi', $penilaian);
                redirect(site_url('penilaian/absensi'));
            }
        }
    }

    public function ubah_absensi($nik)
    {
        if ($this->session->userdata('username') == null) {
            echo '<script>alert("Please login first!"); location.href = "' . site_url('login') . '"</script>';
        } else {
            $this->form_validation->set_rules('nama', 'Nama Lengkap', 'required|trim');
            $this->form_validation->set_rules('nik', 'NIK', 'required|trim');

            if ($this->form_validation->run() == false) {

                $data = [
                    'title'   => 'Penilaian Karyawan Absensi',
                    'absen' => $this->Model->getabsensi_nik($nik),

                ];

                $this->load->view('auth/auth_header', $data);
                $this->load->view('penilaian/absensi_edit');
                $this->load->view('auth/auth_footer');
            } else {

                $harikerja = $this->input->post('total_hari');
                $totalmasuk = $this->input->post('total_masuk');
                $idabsen = $this->input->post('idabsen');
                $poin = ($totalmasuk / $harikerja) * 100;
                $nilai = $this->Model->penilaian_karyawan($poin, "ABSENSI");

                // var_dump($poin);
                // die();

                $penilaian = [
                    'hari_kerja'            => $this->input->post('total_hari'),
                    'total_masuk'           => $this->input->post('total_masuk'),
                    'total_poin'            => $poin,
                    'keterangan'            => $nilai['nilai_kriteria'],
                    'bobot_poin_absensi'    => $nilai['bobot'],
                    'tgl_penilaian'         => date('Y-m-d'),
                    'id_bobot_absensi'      => $nilai['id_bobot']
                ];


                $this->Model->updateData($idabsen, 'id_absensi', 'absensi', $penilaian);
                // $this->Model->menyimpan_data('absensi', $penilaian);
                redirect(site_url('penilaian/absensi'));
            }
        }
    }

    public function perilaku()
    {
        if ($this->session->userdata('username') == null) {
            echo '<script>alert("Please login first!"); location.href = "' . site_url('login') . '"</script>';
        } else {
            $this->form_validation->set_rules('nama', 'Nama Lengkap', 'required|trim');
            $this->form_validation->set_rules('nik', 'NIK', 'required|trim');

            if ($this->form_validation->run() == false) {

                $data = [
                    'title'   => 'Penilaian Karyawan Perilaku',
                    'karyawan'  => $this->Model->getkaryawan(),
                    'data'      => $this->Model->getperilaku(),

                ];

                $this->load->view('auth/auth_header', $data);
                $this->load->view('penilaian/perilaku');
                $this->load->view('auth/auth_footer');
            } else {

                $nik = $this->input->post('nik');
                $kebersihan = $this->input->post('kebersihan');
                $peraturan = $this->input->post('peraturan');
                $kejujuran = $this->input->post('kejujuran');
                $komunikasi = $this->input->post('komunikasi');

                $poin = ($kebersihan + $peraturan + $kejujuran + $komunikasi);
                $nilai = $this->Model->penilaian_karyawan($poin, "PERILAKU");

                // var_dump($nilai['nilai_kriteria']);
                // die();
                $penilaian = [
                    'nik'                       => $nik,
                    'kebersihan'                => $kebersihan,
                    'peraturan'                 => $peraturan,
                    'kejujuran'                 => $kejujuran,
                    'komunikasi'                => $komunikasi,
                    'total_poin_perilaku'       => $poin,
                    'keterangan_perilaku'       => $nilai['nilai_kriteria'],
                    'bobot_poin_perilaku'       => $nilai['bobot'],
                    'tgl_penilaian_perilaku'    => date('Y-m-d'),
                    'id_bobot_perilaku'         => $nilai['id_bobot']
                ];

                $this->Model->menyimpan_data('perilaku', $penilaian);
                redirect(site_url('penilaian/perilaku'));
            }
        }
    }

    public function ubah_perilaku($nik)
    {
        if ($this->session->userdata('username') == null) {
            echo '<script>alert("Please login first!"); location.href = "' . site_url('login') . '"</script>';
        } else {
            $this->form_validation->set_rules('nama', 'Nama Lengkap', 'required|trim');
            $this->form_validation->set_rules('nik', 'NIK', 'required|trim');

            if ($this->form_validation->run() == false) {

                $data = [
                    'title'   => 'Penilaian Karyawan Perilaku',
                    'karyawan'  => $this->Model->getkaryawan(),
                    'data'      => $this->Model->getperilaku_nik($nik),

                ];

                $this->load->view('auth/auth_header', $data);
                $this->load->view('penilaian/perilaku_edit');
                $this->load->view('auth/auth_footer');
            } else {

                $kebersihan = $this->input->post('kebersihan');
                $peraturan = $this->input->post('peraturan');
                $kejujuran = $this->input->post('kejujuran');
                $komunikasi = $this->input->post('komunikasi');
                $idperilaku = $this->input->post('idperilaku');

                $poin = ($kebersihan + $peraturan + $kejujuran + $komunikasi);
                $nilai = $this->Model->penilaian_karyawan($poin, "PERILAKU");

                // var_dump($nilai['nilai_kriteria']);
                // die();
                $penilaian = [
                    'kebersihan'                => $kebersihan,
                    'peraturan'                 => $peraturan,
                    'kejujuran'                 => $kejujuran,
                    'komunikasi'                => $komunikasi,
                    'total_poin_perilaku'       => $poin,
                    'keterangan_perilaku'       => $nilai['nilai_kriteria'],
                    'bobot_poin_perilaku'       => $nilai['bobot'],
                    'tgl_penilaian_perilaku'    => date('Y-m-d'),
                    'id_bobot_perilaku'         => $nilai['id_bobot']
                ];

                $this->Model->updateData($idperilaku, 'id_perilaku', 'perilaku', $penilaian);
                redirect(site_url('penilaian/perilaku'));
            }
        }
    }

    public function kedisiplinan()
    {
        if ($this->session->userdata('username') == null) {
            echo '<script>alert("Please login first!"); location.href = "' . site_url('login') . '"</script>';
        } else {
            $this->form_validation->set_rules('nama', 'Nama Lengkap', 'required|trim');
            $this->form_validation->set_rules('nik', 'NIK', 'required|trim');

            if ($this->form_validation->run() == false) {

                $data = [
                    'title'   => 'Penilaian Karyawan Kedisiplinan',
                    'karyawan'  => $this->Model->getkaryawan(),
                    'data'      => $this->Model->getdisiplin(),

                ];

                $this->load->view('auth/auth_header', $data);
                $this->load->view('penilaian/kedisiplinan');
                $this->load->view('auth/auth_footer');
            } else {

                $nik = $this->input->post('nik');
                $harikerja = $this->input->post('total_hari');
                $totalmasuk = $this->input->post('total_masuk');
                $potongan = $this->input->post('total_potongan');

                $poin = (($totalmasuk / $harikerja) * 100) - $potongan;
                $nilai = $this->Model->penilaian_karyawan($poin, "KEDISIPLINAN");

                // var_dump($nilai['nilai_kriteria']);
                // die();
                $penilaian = [
                    'nik'                           => $nik,
                    'hari_kerja'                    => $harikerja,
                    'total_masuk'                   => $totalmasuk,
                    'total_potongan'                => $potongan,
                    'total_poin_kedisiplinan'       => $poin,
                    'keterangan_disiplin'           => $nilai['nilai_kriteria'],
                    'bobot_poin_kedisiplinan'       => $nilai['bobot'],
                    'tgl_penilaian_kedisiplinan'    => date('Y-m-d'),
                    'id_bobot_kedisiplinan'         => $nilai['id_bobot']
                ];

                $this->Model->menyimpan_data('kedisiplinan', $penilaian);
                redirect(site_url('penilaian/kedisiplinan'));
            }
        }
    }

    public function ubah_kedisiplinan($nik)
    {
        if ($this->session->userdata('username') == null) {
            echo '<script>alert("Please login first!"); location.href = "' . site_url('login') . '"</script>';
        } else {
            $this->form_validation->set_rules('nama', 'Nama Lengkap', 'required|trim');
            $this->form_validation->set_rules('nik', 'NIK', 'required|trim');

            if ($this->form_validation->run() == false) {

                $data = [
                    'title'   => 'Penilaian Karyawan Kedisiplinan',
                    'karyawan'  => $this->Model->getkaryawan(),
                    'data'      => $this->Model->getdisiplin_nik($nik),

                ];

                $this->load->view('auth/auth_header', $data);
                $this->load->view('penilaian/kedisiplinan_edit');
                $this->load->view('auth/auth_footer');
            } else {

                $harikerja = $this->input->post('total_hari');
                $totalmasuk = $this->input->post('total_masuk');
                $potongan = $this->input->post('total_potongan');

                $poin = (($totalmasuk / $harikerja) * 100) - $potongan;
                $nilai = $this->Model->penilaian_karyawan($poin, "KEDISIPLINAN");

                $iddisiplin = $this->input->post('iddisiplin');

                // var_dump($nilai['nilai_kriteria']);
                // die();
                $penilaian = [
                    'hari_kerja'                    => $harikerja,
                    'total_masuk'                   => $totalmasuk,
                    'total_potongan'                => $potongan,
                    'total_poin_kedisiplinan'       => $poin,
                    'keterangan_disiplin'           => $nilai['nilai_kriteria'],
                    'bobot_poin_kedisiplinan'       => $nilai['bobot'],
                    'tgl_penilaian_kedisiplinan'    => date('Y-m-d'),
                    'id_bobot_kedisiplinan'         => $nilai['id_bobot']
                ];

                $this->Model->updateData($iddisiplin, 'id_disiplin', 'kedisiplinan', $penilaian);
                redirect(site_url('penilaian/kedisiplinan'));
            }
        }
    }

    public function wawasan()
    {
        if ($this->session->userdata('username') == null) {
            echo '<script>alert("Please login first!"); location.href = "' . site_url('login') . '"</script>';
        } else {
            $this->form_validation->set_rules('nama', 'Nama Lengkap', 'required|trim');
            $this->form_validation->set_rules('nik', 'NIK', 'required|trim');

            if ($this->form_validation->run() == false) {

                $data = [
                    'title'   => 'Penilaian Karyawan Wawasan',
                    'karyawan'  => $this->Model->getkaryawan(),
                    'data'      => $this->Model->getwawasan(),

                ];

                $this->load->view('auth/auth_header', $data);
                $this->load->view('penilaian/wawasan');
                $this->load->view('auth/auth_footer');
            } else {

                $nik = $this->input->post('nik');
                $evaluasi = $this->input->post('hasil_evaluasi');

                $poin = $evaluasi;
                $nilai = $this->Model->penilaian_karyawan($poin, "WAWASAN");

                // var_dump($nilai['nilai_kriteria']);
                // die();
                $penilaian = [
                    'nik'                   => $nik,
                    'hasil_evaluasi'        => $evaluasi,
                    'total_poin_wawasan'    => $poin,
                    'keterangan_wawasan'    => $nilai['nilai_kriteria'],
                    'bobot_poin_wawasan'    => $nilai['bobot'],
                    'tgl_penilaian_wawasan' => date('Y-m-d'),
                    'id_bobot_wawasan'      => $nilai['id_bobot']
                ];

                $this->Model->menyimpan_data('wawasan', $penilaian);
                redirect(site_url('penilaian/wawasan'));
            }
        }
    }

    public function ubah_wawasan($nik)
    {
        if ($this->session->userdata('username') == null) {
            echo '<script>alert("Please login first!"); location.href = "' . site_url('login') . '"</script>';
        } else {
            $this->form_validation->set_rules('nama', 'Nama Lengkap', 'required|trim');
            $this->form_validation->set_rules('nik', 'NIK', 'required|trim');

            if ($this->form_validation->run() == false) {

                $data = [
                    'title'   => 'Penilaian Karyawan Wawasan',
                    'karyawan'  => $this->Model->getkaryawan(),
                    'data'      => $this->Model->getwawasan_nik($nik),

                ];

                $this->load->view('auth/auth_header', $data);
                $this->load->view('penilaian/wawasan_edit', $data);
                $this->load->view('auth/auth_footer');
            } else {

                $nik = $this->input->post('nik');
                $evaluasi = $this->input->post('hasil_evaluasi');
                $idwawasan = $this->input->post('idwawasan');

                $poin = $evaluasi;
                $nilai = $this->Model->penilaian_karyawan($poin, "WAWASAN");

                // var_dump($nilai['nilai_kriteria']);
                // die();
                $penilaian = [
                    'nik'                   => $nik,
                    'hasil_evaluasi'        => $evaluasi,
                    'total_poin_wawasan'    => $poin,
                    'keterangan_wawasan'    => $nilai['nilai_kriteria'],
                    'bobot_poin_wawasan'    => $nilai['bobot'],
                    'tgl_penilaian_wawasan' => date('Y-m-d'),
                    'id_bobot_wawasan'      => $nilai['id_bobot']
                ];

                $this->Model->updateData($idwawasan, 'id_wawasan', 'wawasan', $penilaian);
                redirect(site_url('penilaian/wawasan'));
            }
        }
    }

    public function kerjasama()
    {
        if ($this->session->userdata('username') == null) {
            echo '<script>alert("Please login first!"); location.href = "' . site_url('login') . '"</script>';
        } else {
            $this->form_validation->set_rules('nama', 'Nama Lengkap', 'required|trim');
            $this->form_validation->set_rules('nik', 'NIK', 'required|trim');

            if ($this->form_validation->run() == false) {

                $data = [
                    'title'   => 'Penilaian Karyawan Kerjasama Tim',
                    'karyawan'  => $this->Model->getkaryawan(),
                    'data'      => $this->Model->getkerjasama(),

                ];

                $this->load->view('auth/auth_header', $data);
                $this->load->view('penilaian/kerjasama');
                $this->load->view('auth/auth_footer');
            } else {

                $nik = $this->input->post('nik');
                $evaluasi = $this->input->post('potongan');

                $poin = (100 - $evaluasi);
                $nilai = $this->Model->penilaian_karyawan($poin, "KERJASAMA TIM");

                // var_dump($nilai['nilai_kriteria']);
                // die();
                $penilaian = [
                    'nik'                       => $nik,
                    'potongan'                  => $evaluasi,
                    'total_poin_kerjasama'      => $poin,
                    'keterangan_kerjasama'      => $nilai['nilai_kriteria'],
                    'bobot_poin_kerjasama'      => $nilai['bobot'],
                    'tgl_penilaian_kerjasama'   => date('Y-m-d'),
                    'id_bobot_kerjasama'        => $nilai['id_bobot']
                ];

                $this->Model->menyimpan_data('kerjasama_tim', $penilaian);
                redirect(site_url('penilaian/kerjasama'));
            }
        }
    }

    public function ubah_kerjasama($nik)
    {
        if ($this->session->userdata('username') == null) {
            echo '<script>alert("Please login first!"); location.href = "' . site_url('login') . '"</script>';
        } else {
            $this->form_validation->set_rules('nama', 'Nama Lengkap', 'required|trim');
            $this->form_validation->set_rules('nik', 'NIK', 'required|trim');

            if ($this->form_validation->run() == false) {

                $data = [
                    'title'   => 'Penilaian Karyawan Kerjasama Tim',
                    'data'      => $this->Model->getkerjasama_nik($nik),

                ];

                $this->load->view('auth/auth_header', $data);
                $this->load->view('penilaian/kerjasama_edit');
                $this->load->view('auth/auth_footer');
            } else {

                $nik = $this->input->post('nik');
                $evaluasi = $this->input->post('potongan');
                $idkerjasama = $this->input->post('idkerjasama');

                $poin = (100 - $evaluasi);
                $nilai = $this->Model->penilaian_karyawan($poin, "KERJASAMA TIM");

                // var_dump($nilai['nilai_kriteria']);
                // die();
                $penilaian = [
                    'potongan'                  => $evaluasi,
                    'total_poin_kerjasama'      => $poin,
                    'keterangan_kerjasama'      => $nilai['nilai_kriteria'],
                    'bobot_poin_kerjasama'      => $nilai['bobot'],
                    'tgl_penilaian_kerjasama'   => date('Y-m-d'),
                    'id_bobot_kerjasama'        => $nilai['id_bobot']
                ];

                $this->Model->updateData($idkerjasama, 'id_kerjasama', 'kerjasama_tim', $penilaian);
                redirect(site_url('penilaian/kerjasama'));
            }
        }
    }

    public function kinerja()
    {
        if ($this->session->userdata('username') == null) {
            echo '<script>alert("Please login first!"); location.href = "' . site_url('login') . '"</script>';
        } else {
            $this->form_validation->set_rules('nama', 'Nama Lengkap', 'required|trim');
            $this->form_validation->set_rules('nik', 'NIK', 'required|trim');

            if ($this->form_validation->run() == false) {

                $data = [
                    'title'   => 'Penilaian Karyawan Kinerja',
                    'karyawan'  => $this->Model->getkaryawan(),
                    'data'      => $this->Model->getkinerja(),

                ];

                $this->load->view('auth/auth_header', $data);
                $this->load->view('penilaian/kinerja');
                $this->load->view('auth/auth_footer');
            } else {

                $nik = $this->input->post('nik');
                $komunikasi = $this->input->post('komunikasi');
                $target = $this->input->post('target');
                $teknis = $this->input->post('teknis');
                $disiplin = $this->input->post('disiplin');
                $kecepatan = $this->input->post('kecepatan');
                $adaptasi = $this->input->post('adaptasi');
                $waktu = $this->input->post('waktu');

                $poin = ($komunikasi + $target + $teknis + $disiplin + $kecepatan + $adaptasi + $waktu);
                $nilai = $this->Model->penilaian_karyawan($poin, "KINERJA");

                // var_dump($nilai['nilai_kriteria']);
                // die();
                $penilaian = [
                    'nik'                       => $nik,
                    'komunikasi'                => $komunikasi,
                    'target'                    => $target,
                    'teknis'                    => $teknis,
                    'disiplin'                  => $disiplin,
                    'kecepatan'                 => $kecepatan,
                    'adaptasi'                  => $adaptasi,
                    'waktu'                     => $waktu,
                    'total_poin_kinerja'        => $poin,
                    'keterangan_kinerja'        => $nilai['nilai_kriteria'],
                    'bobot_poin_kinerja'        => $nilai['bobot'],
                    'tgl_penilaian_kinerja'     => date('Y-m-d'),
                    'id_bobot_kinerja'          => $nilai['id_bobot']
                ];

                $this->Model->menyimpan_data('kinerja', $penilaian);
                redirect(site_url('penilaian/kinerja'));
            }
        }
    }

    public function ubah_kinerja($nik)
    {
        if ($this->session->userdata('username') == null) {
            echo '<script>alert("Please login first!"); location.href = "' . site_url('login') . '"</script>';
        } else {
            $this->form_validation->set_rules('nama', 'Nama Lengkap', 'required|trim');
            $this->form_validation->set_rules('nik', 'NIK', 'required|trim');

            if ($this->form_validation->run() == false) {

                $data = [
                    'title'   => 'Penilaian Karyawan Kinerja',
                    'karyawan'  => $this->Model->getkaryawan(),
                    'data'      => $this->Model->getkinerja_nik($nik),

                ];

                $this->load->view('auth/auth_header', $data);
                $this->load->view('penilaian/kinerja_edit');
                $this->load->view('auth/auth_footer');
            } else {

                $nik = $this->input->post('nik');
                $komunikasi = $this->input->post('komunikasi');
                $target = $this->input->post('target');
                $teknis = $this->input->post('teknis');
                $disiplin = $this->input->post('disiplin');
                $kecepatan = $this->input->post('kecepatan');
                $adaptasi = $this->input->post('adaptasi');
                $waktu = $this->input->post('waktu');

                $idkinerja = $this->input->post('idkinerja');
                $poin = ($komunikasi + $target + $teknis + $disiplin + $kecepatan + $adaptasi + $waktu);
                $nilai = $this->Model->penilaian_karyawan($poin, "KINERJA");

                // var_dump($nilai['nilai_kriteria']);
                // die();
                $penilaian = [
                    'nik'                       => $nik,
                    'komunikasi'                => $komunikasi,
                    'target'                    => $target,
                    'teknis'                    => $teknis,
                    'disiplin'                  => $disiplin,
                    'kecepatan'                 => $kecepatan,
                    'adaptasi'                  => $adaptasi,
                    'waktu'                     => $waktu,
                    'total_poin_kinerja'        => $poin,
                    'keterangan_kinerja'        => $nilai['nilai_kriteria'],
                    'bobot_poin_kinerja'        => $nilai['bobot'],
                    'tgl_penilaian_kinerja'     => date('Y-m-d'),
                    'id_bobot_kinerja'          => $nilai['id_bobot']
                ];

                $this->Model->updateData($idkinerja, 'id_kinerja', 'kinerja', $penilaian);
                redirect(site_url('penilaian/kinerja'));
            }
        }
    }
}
