<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Bonus extends CI_Controller
{
    public function index()
    {
        if ($this->session->userdata('username') == null) {
            echo '<script>alert("Please login first!"); location.href = "' . site_url('login') . '"</script>';
        } else {
            $data = [
                'title'   => 'Penilaian Karyawan',
                'data'      => $this->Model->getbonus()
            ];
            $this->load->view('auth/auth_header', $data);
            $this->load->view('bonus/index');
            $this->load->view('auth/auth_footer');
        }
    }

    public function bonus_input()
    {
        if ($this->session->userdata('username') == null) {
            echo '<script>alert("Please login first!"); location.href = "' . site_url('login') . '"</script>';
        } else {
            if ($this->session->userdata('role') != '0') {
                echo '<script>alert("This account is not allowed!"); location.href = "' . site_url() . '"</script>';
            } else {
                $this->form_validation->set_rules('nik', 'NIK', 'required|trim');

                if ($this->form_validation->run() == false) {
                    # code...
                    $data = [
                        'title'     => 'Tambah Penerimaan Bonus',
                        'data'      => $this->Model->urut(),
                        'kode'      => $this->Model->kodeBonus()
                    ];
                    $this->load->view('auth/auth_header', $data);
                    $this->load->view('bonus/tambah', $data);
                    $this->load->view('auth/auth_footer');
                } else {
                    # code...
                    $bonus = [
                        'kode_bonus'        => $this->input->post('kode'),
                        'nik'               => $this->input->post('nik'),
                        'nama_karyawan'     => $this->input->post('nama'),
                        'jml_bonus'         => $this->input->post('bonus'),
                        'tgl_penerimaan'    => date('Y-m-d', strtotime($this->input->post('tanggal')))
                    ];

                    $this->Model->menyimpan_data('bonus', $bonus);
                    redirect(site_url('bonus'));
                }
            }
        }
    }

    public function bonus_edit($petugas)
    {
        if ($this->session->userdata('username') == null) {
            echo '<script>alert("Please login first!"); location.href = "' . site_url('login') . '"</script>';
        } else {
            if ($this->session->userdata('role') != '0') {
                echo '<script>alert("This account is not allowed!"); location.href = "' . site_url() . '"</script>';
            } else {

                $this->form_validation->set_rules('nik', 'NIK', 'required|trim');

                if ($this->form_validation->run() == false) {
                    # code...
                    $data = [
                        'title'     => 'Tambah Penerimaan Bonus',
                        'data'      => $this->Model->getbonusid($petugas),
                    ];
                    $this->load->view('auth/auth_header', $data);
                    $this->load->view('bonus/edit', $data);
                    $this->load->view('auth/auth_footer');
                } else {
                    # code...

                    $bonus = [
                        'nik'               => $this->input->post('nik'),
                        'nama_karyawan'     => $this->input->post('nama'),
                        'jml_bonus'         => $this->input->post('bonus'),
                        'tgl_penerimaan'    => date('Y-m-d', strtotime($this->input->post('tanggal')))
                    ];

                    $this->Model->updateData($petugas, 'kode_bonus', 'bonus', $bonus);
                    redirect(site_url('bonus'));
                }
            }
        }
    }

    public function bonus_hapus($kode)
    {
        if ($this->session->userdata('username') == null) {
            echo '<script>alert("Please login first!"); location.href = "' . site_url('login') . '"</script>';
        } else {
            if ($this->session->userdata('role') != '0') {
                echo '<script>alert("This account is not allowed!"); location.href = "' . site_url() . '"</script>';
            } else {
                $this->Model->deleteData($kode, 'kode_bonus', 'bonus');
                redirect(site_url('bonus'));
            }
        }
    }
}
