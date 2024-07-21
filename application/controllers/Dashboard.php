<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Dashboard extends CI_Controller
{
    private $view = "dashboard/";
    private $redirect = "Dashboard";
    public function __construct()
    {
        parent::__construct();
        //mengaktifkan session dengan demikian halaman ini jika dipanggil kini membutuhkan session
        IsAdmin();
        $this->load->model('M_rute');
        $this->load->model('M_user');
        $this->load->model('M_sampah');
        $this->load->model('M_aduan');
    }
    public function index()
    {
        $data = array(
            'judul' => "BERANDA",
            'sub' => "Beranda",
            'active_menu' => 'dashboard',
            'id_user' => $this->session->userdata('id_user'),
            'nama' => $this->session->userdata('nama'),
            'username' => $this->session->userdata('username'),
            'password' => $this->session->userdata('password'),
            'foto' => 'assets/img/photos/' . $this->session->userdata('img_user'),
            'rute' => $this->M_rute->GetAll(),
            'user' => $this->M_user->countUser(),
            'jumlah_rute' => $this->M_rute->countRute(),
            'total_sampah' =>  $this->M_sampah->getTotal(),
            'kategori_sampah' =>  $this->M_sampah->getTotalbyKategori(),
            'total_aduan' =>  $this->M_aduan->countAduan(),
            'sampah' => $this->M_sampah->GetSampah(),

        );
        $this->template->load('layout/template', $this->view . 'read', $data);

        // echo $this->session->userdata('img_user');
    }
}
