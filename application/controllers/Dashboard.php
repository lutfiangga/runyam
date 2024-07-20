<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Dashboard extends CI_Controller
{
    private $view = "dashboard/";
    private $redirect = "Dashboard";
    public function __construct()
    {
        parent::__construct();
        //mengaktifkan session dengan demikian halaman ini jika dipanggil kini membutuhkan session
        $this->load->model('M_rute');

    }
    public function index()
    {
        $data = array(
            'judul' => "BERANDA",
            'sub' => "Beranda",
            'active_menu' => 'dashboard',
            'rute' => $this->M_rute->GetAll(),		
           
        );
        $this->template->load('layout/template', $this->view . 'read', $data);

        // echo $this->session->userdata('img_user');
    }
}
