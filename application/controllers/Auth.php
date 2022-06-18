<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function index()
    {

        if ($this->session->userdata('username') == null) {
            $this->load->view('auth/login');
        } else {
            if ($this->session->userdata('role') == '0') {
                # code...
                redirect(site_url('main'));
                // } elseif ($this->session->userdata('role') == '2') {
                //     # code...
                //     // redirect(site_url('loket'));
                // } elseif ($this->session->userdata('role') == '3') {
                //     # code...
                //     // redirect(site_url('loket'));
                // } elseif ($this->session->userdata('role') == '4') {
                # code...
                // redirect(site_url('loket'));
            }
        }
    }

    public function login()
    {
        $this->form_validation->set_rules('username', 'Username', 'required|trim|max_length[15]|min_length[3]');
        $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[3]');

        if ($this->form_validation->run() == false) {
            $this->load->view('auth/login');
        } else {
            $this->is_login();
        }
    }

    public function is_login()
    {
        $username   = $this->input->post('username');
        $password   = $this->input->post('password');
        $this->Model->islogin($username, $password);
    }

    public function registrasi()
    {
        $this->form_validation->set_rules('first_name', 'First Name', 'required|trim');
        // $this->form_validation->set_rules('last_name', 'Last Name', 'required|trim');
        $this->form_validation->set_rules('username', 'Username', 'required|trim|max_length[15]|min_length[3]|is_unique[user.username]');
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]');
        $this->form_validation->set_rules('password2', 'Re-Password', 'required|trim|matches[password1]');

        if ($this->form_validation->run() == false) {
            $this->load->view('auth/auth_register');
        } else {
            $data = [
                'full_name'     => $this->input->post('first_name') . ' ' . $this->input->post('last_name'),
                'username'      => $this->input->post('username'),
                'password'      => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'akses'         => '1',
                'is_active'     => '1',
                'date_created'  => date('Y-m-d')
            ];

            $this->Model->menyimpan_data('user', $data);
            redirect(site_url('login'));
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('role');
        redirect(site_url('login'));
    }
}
