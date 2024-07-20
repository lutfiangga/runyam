<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Aduan extends CI_Controller
{
    private $view = "aduan/";
    //memanggil control rt/index dalam keadaan refresh
    private $redirect = "Aduan";
    public function __construct()
    {
        parent::__construct();
        //control rt menghubungkan model M_rt
        IsAdmin();
        $this->load->model('M_aduan');
    }
    function index()
    {
        $data = array(
            //'read' variabel yang akan dipanggil pada view read.php
            'judul' => "DATA ADUAN",
            'sub' => "Data Aduan",
            'active_menu' => 'aduan',
            'id_user' => $this->session->userdata('id_user'),
            'nama' => $this->session->userdata('nama'),
            'username' => $this->session->userdata('username'),
            'password' => $this->session->userdata('password'),
            'foto' => 'assets/img/photos/' . $this->session->userdata('img_user'),
            'read' => $this->M_aduan->GetAll(),
        );
        $this->template->load('layout/template', $this->view . 'read', $data);
    }
    public function create()
    {
        $data = array(
            'judul' => "DATA ADUAN",
            'sub' => "Data Aduan",
            'active_menu' => 'aduan',
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
            'status' => 'pending',
            'waktu' => 'Y/m/d H:i:s',
        );
        $this->M_aduan->save($data);
        //dengan $this->redirect artinya memanggil private $redirect = "rt"
        redirect($this->redirect, 'refresh');
    }
    public function edit()
    {
        $id = $this->uri->segment(3);
        $data = array(
            //'edit' variabel yang akan dipanggil pada view edit.php
            'judul' => "DATA ADUAN",
            'sub' => "Data Aduan",
            'active_menu' => 'aduan',
            'id_user' => $this->session->userdata('id_user'),
            'nama' => $this->session->userdata('nama'),
            'username' => $this->session->userdata('username'),
            'password' => $this->session->userdata('password'),
            'foto' => 'assets/img/photos/' . $this->session->userdata('img_user'),
            'edit' => $this->M_aduan->edit($id),
        );
        $this->template->load('layout/template', $this->view . 'edit', $data);
    }
    public function detail()
    {
        $id = $this->uri->segment(3);
        $data = array(
            //'edit' variabel yang akan dipanggil pada view edit.php
            'judul' => "DATA ADUAN",
            'sub' => "Data Aduan",
            'active_menu' => 'aduan',
            'id_user' => $this->session->userdata('id_user'),
            'nama' => $this->session->userdata('nama'),
            'username' => $this->session->userdata('username'),
            'password' => $this->session->userdata('password'),
            'foto' => 'assets/img/photos/' . $this->session->userdata('img_user'),
            'detail' => $this->M_aduan->edit($id),
        );
        $this->template->load('layout/template', $this->view . 'detail', $data);
    }
    public function update()
    {
        $id = $this->uri->segment(3);
        $data = array(
            'pengirim' => $this->input->post('pengirim'),
            'subjek' => $this->input->post('subjek'),
            'pesan' => $this->input->post('pesan'),
            'status' => 'pending',
            'waktu' => 'Y/m/d H:i:s',
        );
        $this->M_aduan->update($id, $data);
        redirect($this->redirect, 'refresh');
    }

    public function accept($kd)
    {
        $data = array(
            'status' => 'diproses',
        );

        $this->M_aduan->update($kd, $data);

        redirect($this->redirect);
    }
    public function decline($kd)
    {
        $data = array(
            'status' => 'ditolak',
        );

        $this->M_aduan->update($kd, $data);

        redirect($this->redirect);
    }
    public function finish($kd)
    {
        $data = array(
            'status' => 'selesai',
        );

        $this->M_aduan->update($kd, $data);

        redirect($this->redirect);
    }

    public function delete()
    {
        $id = $this->uri->segment(3);
        $data = array(
            //data akan dihapus sesuai uri->segment(3) yang dipilih
            'id_aduan' => $id
        );
        $this->M_aduan->delete($data);
        redirect($this->redirect, 'refresh');
    }
}
