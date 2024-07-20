<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Index extends CI_Controller
{
    private $view = "landing/";
    private $redirect = "Index";
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_rute');
        $this->load->model('M_aduan');
    }
    public function index()
    {
        $data = array(
            'judul' => "BERANDA",
            'sub' => "Beranda",
            'active_menu' => 'index',
            'rute' => $this->M_rute->GetAll(),

        );
        $this->template->load('landing/layout/template', $this->view . 'read', $data);

    }
    public function about()
    {
        $data = array(
            'judul' => "BERANDA",
            'sub' => "Beranda",
            'active_menu' => 'about',
            'rute' => $this->M_rute->GetAll(),

        );
        $this->template->load('landing/layout/template', $this->view . 'about', $data);

    }
    public function terms()
    {
        $data = array(
            'judul' => "BERANDA",
            'sub' => "Beranda",
            'active_menu' => 'terms',
            'rute' => $this->M_rute->GetAll(),

        );
        $this->template->load('landing/layout/template', $this->view . 'terms', $data);

    }
    public function privacy()
    {
        $data = array(
            'judul' => "BERANDA",
            'sub' => "Beranda",
            'active_menu' => 'privacy',
            'rute' => $this->M_rute->GetAll(),

        );
        $this->template->load('landing/layout/template', $this->view . 'privacy', $data);

    }
    public function aduan()
    {
        $last_id = $this->M_aduan->getLastId();

        // jika tidak ditemukan, id_aduan diisi 1
        if ($last_id == null) {
            $id_aduan = 1;
        } else {
            // jika ditemukan, tambahkan 1 pada id_aduan terakhir
            $id_aduan = $last_id + 1;
        }
        $data = array(
            'id_aduan' => $id_aduan,
            'pengirim' => $this->input->post('pengirim'),
            'subjek' => $this->input->post('subjek'),
            'pesan' => $this->input->post('pesan'),
            'status' => $this->input->post('status'),
            'waktu_aduan' => $this->input->post('waktu_aduan'),
        );
        $this->M_aduan->save($data);
        //dengan $this->redirect artinya memanggil private $redirect = "rt"
        redirect($this->redirect, 'refresh');
    }
}
