<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Rute extends CI_Controller
{
    private $view = "rute/";
    //memanggil control rt/index dalam keadaan refresh
    private $redirect = "Rute";
    public function __construct()
    {
        parent::__construct();
        //control rt menghubungkan model M_rt
        $this->load->model('M_rute');
    }
    function index()
    {
        $data = array(
            //'read' variabel yang akan dipanggil pada view read.php
            'judul' => "DATA RUTE",
            'sub' => "Data Rute",
            'active_menu' => 'rute',	
            'id_user' => $this->session->userdata('id_user'),
            'nama' => $this->session->userdata('nama'),
            'img_user_path' => 'assets/img_user/' . $this->session->userdata('img_user'),
            'read' => $this->M_rute->GetAll(),
        );
        $this->template->load('layout/template', $this->view . 'read', $data);
    }
    public function create()
    {
        $data = array(
            'judul' => "DATA RUTE",
            'sub' => "Data Rute",
            'active_menu' => 'rute',
            'id_user' => $this->session->userdata('id_user'),
            'nama' => $this->session->userdata('nama'),
            'img_user_path' => 'assets/img_user/' . $this->session->userdata('img_user'),
            'create' => '',
        );
        $this->template->load('layout/template', $this->view . 'create', $data);
    }
    public function save()
    {
        $last_id = $this->M_rute->getLastId();

        // jika tidak ditemukan, id_rute diisi 1
        if ($last_id == null) {
            $id_rute = 1;
        } else {
            // jika ditemukan, tambahkan 1 pada id_rute terakhir
            $id_rute = $last_id + 1;
        }
        $data = array(
            'id_rute' => $id_rute,
            'lokasi' => $this->input->post('lokasi'),
            'latitude' => $this->input->post('latitude'),
            'longitude' => $this->input->post('longitude'),
            'posisi' => $this->input->post('posisi'),
            'hari' => $this->input->post('hari'),
            'waktu' => $this->input->post('waktu'),
        );
        $this->M_rute->save($data);
        //dengan $this->redirect artinya memanggil private $redirect = "rt"
        redirect($this->redirect, 'refresh');
    }
    public function edit()
    {
        $id = $this->uri->segment(3);
        $data = array(
            //'edit' variabel yang akan dipanggil pada view edit.php
            'judul' => "DATA RUTE",
            'sub' => "Data Rute",
            'active_menu' => 'rute',
            'id_user' => $this->session->userdata('id_user'),
            'nama' => $this->session->userdata('nama'),
            'img_user_path' => 'assets/img_user/' . $this->session->userdata('img_user'),
            'edit' => $this->M_rute->edit($id),
        );
        $this->template->load('layout/template', $this->view . 'edit', $data);
    }
    public function detail()
    {
        $id = $this->uri->segment(3);
        $data = array(
            //'edit' variabel yang akan dipanggil pada view edit.php
            'judul' => "DATA RUTE",
            'sub' => "Data Rute",
            'active_menu' => 'rute',
            'id_user' => $this->session->userdata('id_user'),
            'nama' => $this->session->userdata('nama'),
            'img_user_path' => 'assets/img_user/' . $this->session->userdata('img_user'),
            'detail' => $this->M_rute->edit($id),
        );
        $this->template->load('layout/template', $this->view . 'detail', $data);
    }
    public function update()
    {
        $id = $this->uri->segment(3);
        $data = array(
            'lokasi' => $this->input->post('lokasi'),
            'latitude' => $this->input->post('latitude'),
            'longitude' => $this->input->post('longitude'),
            'posisi' => $this->input->post('posisi'),
            'hari' => $this->input->post('hari'),
            'waktu' => $this->input->post('waktu'),
        );
        $this->M_rute->update($id, $data);
        redirect($this->redirect, 'refresh');
    }
    public function delete()
    {
        $id = $this->uri->segment(3);
        $data = array(
            //data akan dihapus sesuai uri->segment(3) yang dipilih
            'id_rute' => $id
        );
        $this->M_rute->delete($data);
        redirect($this->redirect, 'refresh');
    }

    public function lihat()
    {
        $id = $this->uri->segment(3);
        $data_rt = $this->M_rt->lihat($id);
        $data_penduduk = $this->M_rt->dataPendudukByNoRT($data_rt['rt']);

        $data = array(
            'username' => $this->session->userdata('username'),
            'judul' => "DATA KELUARGA",
            'sub' => "Data Keluarga",
            'id_user' => $this->session->userdata('id_user'),
            'nama' => $this->session->userdata('nama'),
            'jabatan' => $this->session->userdata('jabatan'),
            'img_user_path' => 'assets/img_user/' . $this->session->userdata('img_user'),
            'lihat' => $data_rt,
            'data_penduduk' => $data_penduduk,
            'dusun' => $this->M_dusun->getAll()->row(),
        );

        $this->template->load('backend/template/rt', $this->view . 'lihat', $data);
    }
}
