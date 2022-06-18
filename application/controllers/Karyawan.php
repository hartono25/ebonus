<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Karyawan extends CI_Controller
{
    public function index()
    {
        if ($this->session->userdata('username') == null) {
            echo '<script>alert("Please login first!"); location.href = "' . site_url('login') . '"</script>';
        } else {
            $data = [
                'title'     => 'Data Karyawan',
                'data'      => $this->Model->getkaryawan(),
            ];
            $this->load->view('auth/auth_header', $data);
            $this->load->view('karyawan/index', $data);
            $this->load->view('auth/auth_footer');
        }
    }

    public function karyawan_input()
    {
        if ($this->session->userdata('username') == null) {
            echo '<script>alert("Please login first!"); location.href = "' . site_url('login') . '"</script>';
        } else {
            if ($this->session->userdata('role') != '0') {
                echo '<script>alert("This account is not allowed!"); location.href = "' . site_url() . '"</script>';
            } else {
                $this->form_validation->set_rules('nama', 'Nama Lengkap', 'required|trim');
                $this->form_validation->set_rules('phone', 'Nomor Telpon', 'required|trim');
                $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
                $this->form_validation->set_rules('gender', 'Gender', 'required|trim');
                $this->form_validation->set_rules('t_lahir', 'Tempat Kelahiran', 'required|trim');
                $this->form_validation->set_rules('tgl_lahir', 'Tanggal Kelahiran', 'required|trim');
                $this->form_validation->set_rules('tgl_lahir', 'Tanggal Kelahiran', 'required|trim');

                if ($this->form_validation->run() == false) {
                    # code...
                    $data = [
                        'title'     => 'Tambah Karyawan',
                        'nik'       => $this->Model->nik(),
                    ];
                    $this->load->view('auth/auth_header', $data);
                    $this->load->view('karyawan/tambah', $data);
                    $this->load->view('auth/auth_footer');
                } else {
                    # code...
                    $user = [
                        'nik'           => $this->input->post('kodepts'),
                        'nama_lengkap'  => $this->input->post('nama'),
                        'gender'        => $this->input->post('gender'),
                        'tempat_lahir'  => $this->input->post('t_lahir'),
                        'tgl_lahir'     => $this->input->post('tgl_lahir'),
                        'email'         => $this->input->post('email'),
                        'phone'         => $this->input->post('phone'),
                        'date_created'  => date('Y-m-d'),
                        'deleted'       => '0'
                    ];

                    $this->Model->menyimpan_data('karyawan', $user);
                    redirect(site_url('karyawan'));
                }
            }
        }
    }

    public function karyawan_edit($petugas)
    {
        if ($this->session->userdata('username') == null) {
            echo '<script>alert("Please login first!"); location.href = "' . site_url('login') . '"</script>';
        } else {
            if ($this->session->userdata('role') != '0') {
                echo '<script>alert("This account is not allowed!"); location.href = "' . site_url() . '"</script>';
            } else {

                $this->form_validation->set_rules('nama', 'Nama Lengkap', 'required|trim');
                $this->form_validation->set_rules('phone', 'Nomor Telpon', 'required|trim');
                $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
                $this->form_validation->set_rules('gender', 'Gender', 'required|trim');
                $this->form_validation->set_rules('t_lahir', 'Tempat Kelahiran', 'required|trim');
                $this->form_validation->set_rules('tgl_lahir', 'Tanggal Kelahiran', 'required|trim');
                $this->form_validation->set_rules('tgl_lahir', 'Tanggal Kelahiran', 'required|trim');

                if ($this->form_validation->run() == false) {
                    # code...
                    $data = [
                        'title'     => 'Ubah Karyawan',
                        'nik'       => $petugas,
                        'data'      => $this->Model->karyawan_by_nik($petugas),
                    ];

                    $this->load->view('auth/auth_header', $data);
                    $this->load->view('karyawan/edit', $data);
                    $this->load->view('auth/auth_footer');
                } else {
                    # code...
                    $user = [
                        'nama_lengkap'  => $this->input->post('nama'),
                        'gender'        => $this->input->post('gender'),
                        'tempat_lahir'  => $this->input->post('t_lahir'),
                        'tgl_lahir'     => $this->input->post('tgl_lahir'),
                        'email'         => $this->input->post('email'),
                        'phone'         => $this->input->post('phone'),
                        'date_created'  => date('Y-m-d'),
                        'deleted'       => '0'
                    ];

                    $this->Model->updateData($petugas, 'nik', 'karyawan', $user);
                    redirect(site_url('karyawan'));
                }
            }
        }
    }

    public function karyawan_hapus($kode)
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

                $this->Model->updateData($kode, 'nik', 'karyawan', $petugas);
                redirect(site_url('karyawan'));
            }
        }
    }
}
