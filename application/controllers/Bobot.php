<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Bobot extends CI_Controller
{
    public function index()
    {
        if ($this->session->userdata('username') == null) {
            echo '<script>alert("Please login first!"); location.href = "' . site_url('login') . '"</script>';
        } else {
            $data = [
                'title'     => 'Data Bobot Kriteria',
                'data'      => $this->Model->getbobot(),
            ];
            $this->load->view('auth/auth_header', $data);
            $this->load->view('bobot/index', $data);
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
                $this->form_validation->set_rules('nama', 'Nama Kriteria', 'required|trim');
                $this->form_validation->set_rules('bobot', 'Bobot Nilai', 'required');

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
                    $user = [
                        'kriteria'          => $this->input->post('nama'),
                        'nilai_bobot'       => number_format($this->input->post('bobot'), 2, ".", ","),

                    ];

                    $this->Model->menyimpan_data('bobot', $user);

                    $id = $this->db->insert_id();
                    $data = $this->Model->getbobot();
                    $sum = $this->Model->get_bobotsum()->result();
                    $sumbobot = 0;
                    foreach ($sum as $s) {
                        $sumbobot = $s->bobot;
                    }

                    foreach ($data as $d) {
                        $perbaikan_bobot = $d['nilai_bobot'] / $sumbobot;
                        $user = [
                            'perbaikan_bobot'   => $perbaikan_bobot,
                        ];
                        $this->Model->updateData($d['id_bobot'], 'id_bobot', 'bobot', $user);
                    }

                    $nilai  = $this->input->post('nilai');
                    $bobot  = $this->input->post('bobot_nilai');
                    $min    = $this->input->post('min');
                    $max    = $this->input->post('max');
                    $count = count($nilai);

                    for ($i = 0; $i < $count; $i++) {
                        $nilai_kriteria = [
                            'min_value'         => $min[$i],
                            'max_value'         => $max[$i],
                            'nilai_kriteria'    => $nilai[$i],
                            'bobot'             => $bobot[$i],
                            'id_bobot'          => $id
                        ];
                        $this->Model->menyimpan_data('nilai_kriteria', $nilai_kriteria);
                    }

                    redirect(site_url('bobot'));
                }
            }
        }
    }

    public function bobot_edit($petugas)
    {
        if ($this->session->userdata('username') == null) {
            echo '<script>alert("Please login first!"); location.href = "' . site_url('login') . '"</script>';
        } else {
            if ($this->session->userdata('role') != '0') {
                echo '<script>alert("This account is not allowed!"); location.href = "' . site_url() . '"</script>';
            } else {

                $this->form_validation->set_rules('nama', 'Nama Kriteria', 'required|trim');
                $this->form_validation->set_rules('bobot', 'Bobot Nilai', 'required');

                if ($this->form_validation->run() == false) {
                    # code...
                    $data = [
                        'title'     => 'Data Bobot Kriteria',
                        'data'      => $this->Model->bobot_by_id($petugas),
                        'nilaikriteria' => $this->Model->nilai_kriteria_by_id($petugas),
                        'kode'      => $petugas
                    ];

                    $this->load->view('auth/auth_header', $data);
                    $this->load->view('bobot/edit', $data);
                    $this->load->view('auth/auth_footer');
                } else {
                    # code...

                    $user = [
                        'kriteria'          => $this->input->post('nama'),
                        'nilai_bobot'       => number_format($this->input->post('bobot'), 2, ".", ","),

                    ];
                    $this->Model->updateData($petugas, 'id_bobot', 'bobot', $user);

                    $data = $this->Model->getbobot();
                    $sum = $this->Model->get_bobotsum()->result();
                    $sumbobot = 0;
                    foreach ($sum as $s) {
                        $sumbobot = $s->bobot;
                    }

                    foreach ($data as $d) {
                        $perbaikan_bobot = $d['nilai_bobot'] / $sumbobot;
                        $user = [
                            'perbaikan_bobot'   => $perbaikan_bobot,
                        ];
                        $this->Model->updateData($d['id_bobot'], 'id_bobot', 'bobot', $user);
                    }

                    $nilai = $this->input->post('nilai');
                    $bobot = $this->input->post('bobot_nilai');
                    $idnilai = $this->input->post('id_nilai');
                    $min = $this->input->post('min');
                    $max = $this->input->post('max');
                    $count = count($nilai);

                    for ($i = 0; $i < $count; $i++) {
                        $nilai_kriteria = [
                            'min_value'         => $min[$i],
                            'max_value'         => $max[$i],
                            'nilai_kriteria'    => $nilai[$i],
                            'bobot'             => $bobot[$i],
                            'id_bobot'          => $petugas
                        ];

                        $carnilai = $this->Model->nilai_by_id($idnilai[$i]);
                        if ($carnilai == 0) {
                            if ($nilai[$i] != 0 && $bobot[$i] != 0 && $min[$i] != 0 && $max[$i] != 0) {
                                # code...
                                $this->Model->menyimpan_data('nilai_kriteria', $nilai_kriteria);
                            }
                        } else {
                            $this->Model->updateData($idnilai[$i], 'id_nilai', 'nilai_kriteria', $nilai_kriteria);
                        }
                    }
                    redirect(site_url('bobot'));
                }
            }
        }
    }

    public function bobot_hapus($kode)
    {
        if ($this->session->userdata('username') == null) {
            echo '<script>alert("Please login first!"); location.href = "' . site_url('login') . '"</script>';
        } else {
            if ($this->session->userdata('role') != '0') {
                echo '<script>alert("This account is not allowed!"); location.href = "' . site_url() . '"</script>';
            } else {
                $petugas = [
                    'deleted' => '1'
                ];

                $this->Model->updateData($kode, 'id_bobot', 'bobot', $petugas);

                $data = $this->Model->getbobot();
                $sum = $this->Model->get_bobotsum()->result();
                $sumbobot = 0;
                foreach ($sum as $s) {
                    $sumbobot = $s->bobot;
                }

                foreach ($data as $d) {
                    $perbaikan_bobot = $d['nilai_bobot'] / $sumbobot;
                    $user = [
                        'perbaikan_bobot'   => $perbaikan_bobot,
                    ];
                    $this->Model->updateData($d['id_bobot'], 'id_bobot', 'bobot', $user);
                }

                redirect(site_url('bobot'));
            }
        }
    }

    public function hapus_item($id)
    {
        $idbobot = $this->uri->segment(4);
        $this->Model->deleteData($id, 'id_nilai', 'nilai_kriteria');
        redirect(site_url('bobot/' . $idbobot));
    }
}
