<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Sampah extends CI_Controller
{
    private $view = "sampah/";
    //memanggil control rt/index dalam keadaan refresh
    private $redirect = "Sampah";
    public function __construct()
    {
        parent::__construct();
        //control rt menghubungkan model M_rt
        IsAdmin();
        $this->load->model('M_sampah');
    }
    function index()
    {
        $period = $this->input->post('period');
        $start_date = null;
        $end_date = date('Y-m-d'); // Default to today

        if ($period == 'last_week') {
            $start_date = date('Y-m-d', strtotime('-1 week'));
        } elseif ($period == 'second_week') {
            $start_date = date('Y-m-d', strtotime('-2 week'));
        } elseif ($period == 'last_month') {
            $start_date = date('Y-m-d', strtotime('-1 month'));
        } elseif ($period == 'second_month') {
            $start_date = date('Y-m-d', strtotime('-2 month'));
        } elseif ($period == 'third_month') {
            $start_date = date('Y-m-d', strtotime('-3 month'));
        } elseif ($period == 'past_month') {
            $start_date = date('Y-m-d', strtotime('-6 month'));
        } elseif ($period == 'last_year') {
            $start_date = date('Y-m-d', strtotime('-1 year'));
        } elseif ($period == 'custom') {
            $start_date = $this->input->post('start_date');
            $end_date = $this->input->post('end_date');
        }

        if ($start_date && $end_date) {
            $total_sampah = $this->M_sampah->getTotalByPeriode($start_date, $end_date);
            $sampah_by_kategori = $this->M_sampah->getTotalByKategoriPeriode($start_date, $end_date);
        } else {
            $total_sampah = $this->M_sampah->getTotal();
            $sampah_by_kategori = $this->M_sampah->getTotalbyKategori();
        }


        $data = array(
            //'read' variabel yang akan dipanggil pada view read.php
            'judul' => "DATA SAMPAH",
            'sub' => "Data Sampah",
            'active_menu' => 'sampah',
            'id_user' => $this->session->userdata('id_user'),
            'nama' => $this->session->userdata('nama'),
            'username' => $this->session->userdata('username'),
            'password' => $this->session->userdata('password'),
            'foto' => 'assets/img/photos/' . $this->session->userdata('img_user'),
            'read' => $this->M_sampah->GetAll(),
            'total_sampah' => $total_sampah,
            'sampah_by_kategori' => $sampah_by_kategori,
            // 'start_date' => $start_date,
            // 'end_date' => $end_date,
        );
        $this->template->load('layout/template', $this->view . 'read', $data);
    }
    public function create()
    {
        $data = array(
            'judul' => "DATA SAMPAH",
            'sub' => "Data Sampah",
            'active_menu' => 'sampah',
            'id_user' => $this->session->userdata('id_user'),
            'nama' => $this->session->userdata('nama'),
            'username' => $this->session->userdata('username'),
            'password' => $this->session->userdata('password'),
            'foto' => 'assets/img/photos/' . $this->session->userdata('img_user'),
            'create' => '',
        );
        $this->template->load('layout/template', $this->view . 'create', $data);
    }
    public function save()
    {
        $last_id = $this->M_sampah->getLastId();

        // jika tidak ditemukan, id_sampah diisi 1
        if ($last_id == null) {
            $id_sampah = 1;
        } else {
            // jika ditemukan, tambahkan 1 pada id_sampah terakhir
            $id_sampah = $last_id + 1;
        }
        $data = array(
            'id_sampah' => $id_sampah,
            'tanggal' => $this->input->post('tanggal'),
            'kategori' => $this->input->post('kategori'),
            'jumlah' => $this->input->post('jumlah'),
        );
        $this->M_sampah->save($data);
        //dengan $this->redirect artinya memanggil private $redirect = "rt"
        redirect($this->redirect, 'refresh');
    }
    public function edit()
    {
        $id = $this->uri->segment(3);
        $data = array(
            //'edit' variabel yang akan dipanggil pada view edit.php
            'judul' => "DATA SAMPAH",
            'sub' => "Data Sampah",
            'active_menu' => 'sampah',
            'id_user' => $this->session->userdata('id_user'),
            'nama' => $this->session->userdata('nama'),
            'username' => $this->session->userdata('username'),
            'password' => $this->session->userdata('password'),
            'foto' => 'assets/img/photos/' . $this->session->userdata('img_user'),
            'edit' => $this->M_sampah->edit($id),
        );
        $this->template->load('layout/template', $this->view . 'edit', $data);
    }
    public function detail()
    {
        $id = $this->uri->segment(3);
        $data = array(
            //'edit' variabel yang akan dipanggil pada view edit.php
            'judul' => "DATA SAMPAH",
            'sub' => "Data Sampah",
            'active_menu' => 'sampah',
            'id_user' => $this->session->userdata('id_user'),
            'nama' => $this->session->userdata('nama'),
            'username' => $this->session->userdata('username'),
            'password' => $this->session->userdata('password'),
            'foto' => 'assets/img/photos/' . $this->session->userdata('img_user'),
            'detail' => $this->M_sampah->edit($id),
        );
        $this->template->load('layout/template', $this->view . 'detail', $data);
    }
    public function update()
    {
        $id = $this->uri->segment(3);
        $data = array(
            'tanggal' => $this->input->post('tanggal'),
            'kategori' => $this->input->post('kategori'),
            'jumlah' => $this->input->post('jumlah'),
        );
        $this->M_sampah->update($id, $data);
        redirect($this->redirect, 'refresh');
    }
    public function delete()
    {
        $id = $this->uri->segment(3);
        $data = array(
            //data akan dihapus sesuai uri->segment(3) yang dipilih
            'id_sampah' => $id
        );
        $this->M_sampah->delete($data);
        redirect($this->redirect, 'refresh');
    }
}
