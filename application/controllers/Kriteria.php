<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kriteria extends CI_Controller
{
    public function index()
    {
        if ($this->session->userdata('username') == null) {
            echo '<script>alert("Please login first!"); location.href = "' . site_url('login') . '"</script>';
        } else {
            $data = [
                'title'   => 'Data Kriteria'
            ];
            $this->load->view('auth/auth_header', $data);
            $this->load->view('kriteria/kriteria_index');
            $this->load->view('auth/auth_footer');
        }
    }

    public function kriteria_input()
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
                    $this->load->view('kriteria/kriteria_form', $data);
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

    public function apar_edit($petugas)
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

    public function apar_hapus($kode)
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
