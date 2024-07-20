<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Auth extends CI_Controller
{
    private $redirect = "user";
    public function __construct()
    {
        parent::__construct();
        //Load model
        $this->load->model('M_auth');
        $this->load->model('M_dusun');
    }

    public function index()
    {
        $this->session->sess_destroy();
        $data = array(
            'dusun' => $this->M_dusun->getAll()->row(),
            'login' => ''
        );
        $this->load->view('backend/Login', $data);
    }

    public function login()
{
    $user = $this->input->post('username');
    $pwd = $this->input->post('password');
    $data = $this->M_auth->CekLogin('user', 'username', $user);
    
    if (!empty($data) && $data['password'] == $pwd && $data['username'] == $user) {
        $array = array(
            'id_user' => $data['id_user'],
            'nama' => $data['nama'],
            'username' => $data['username'],
            'email' => $data['email'],
            'img_user' => $data['img_user'],
            'jabatan' => $data['jabatan'],
            'IsAdmin' => 1,
        );
        $this->session->set_userdata($array);
        redirect('Home', 'refresh');
    } else {
        $this->session->set_flashdata('error', 'Username atau Password salah!');
        redirect('Auth', 'refresh');
    }
}

    public function logout()
{
    // Hancurkan sesi
    $this->session->sess_destroy();

    // Set pesan alert menggunakan flashdata
    $this->session->set_flashdata('logout_message', 'Anda telah keluar!');

    // Redirect ke halaman Index
    redirect('Index', 'refresh');
}

}
