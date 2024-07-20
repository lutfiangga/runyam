<?php
defined('BASEPATH') or exit('No direct script access allowed');
class User extends CI_Controller
{
  private $view = "user/";
  private $redirect = "User";
  public function __construct()
  {
    parent::__construct();
    // IsAdmin();
    $this->load->model('M_user');
    $this->load->helper('text');
    $this->load->library('form_validation');
  }
  function index()
  {
    $data = array(
      'judul' => "DATA USER",
      'sub' => "Data User",
      'active_menu' => 'user',
      'id_user' => $this->session->userdata('id_user'),
      'nama' => $this->session->userdata('nama'),
      'img_user_path' => 'assets/img_user/' . $this->session->userdata('img_user'),
      'read' => $this->M_user->GetAll(),
    );
    $this->template->load('layout/template', $this->view . 'read', $data);
  }
  public function create()
  {
    $data = array(
      'judul' => "DATA USER",
      'sub' => "Data User",
      'active_menu' => 'user',
      'id_user' => $this->session->userdata('id_user'),
      'nama' => $this->session->userdata('nama'),
      'img_user_path' => 'assets/img_user/' . $this->session->userdata('img_user'),
      'create' => '',
    );
    $this->template->load('layout/template', $this->view . 'create', $data);
  }

  public function save()
  {
    $this->form_validation->set_rules('id_user', 'Kode User', 'required|is_unique[user.id_user]');
    $this->form_validation->set_rules('username', 'Username', 'required|is_unique[user.username]');

    if ($this->form_validation->run() == FALSE) {
      // Validasi gagal, kembali ke halaman registrasi dengan error
      $data = array(
        'judul' => "DATA USER",
        'sub' => "Data User",
        'active_menu' => 'user',
        'id' => $this->session->userdata('id'),
        'nama' => $this->session->userdata('nama'),
        'img_user_path' => 'assets/img_user/' . $this->session->userdata('img_user'),
        'create' => '',
        'kode_error' => form_error('id_user'),
        // Menggunakan form_error() untuk mendapatkan pesan kesalahan Kode User
        'username_error' => form_error('username') // Menggunakan form_error() untuk mendapatkan pesan kesalahan Username
      );
      $this->template->load('layout/template', $this->view . 'create', $data);
    } else {
      // Validasi berhasil, simpan data pengguna baru
      $data = array(
        'id_user' => $this->input->post('id_user'),
        'nama' => $this->input->post('nama'),
        'email' => $this->input->post('email'),
        'username' => $this->input->post('username'),
        'password' => $this->input->post('password'),
        'jabatan' => $this->input->post('jabatan'),
        'img_user' => 'user.png'
      );
      $this->M_user->save($data);

      redirect($this->redirect, 'refresh');
    }
  }

  public function edit()
  {
    $id = $this->uri->segment(3);
    $data = array(
      //'edit' variabel yang akan dipanggil pada view edit.php
      'judul' => "DATA USER",
      'sub' => "Data User",
      'active_menu' => 'user',
      'id' => $this->session->userdata('id'),
      'nama' => $this->session->userdata('nama'),
      'img_user_path' => 'assets/img_user/' . $this->session->userdata('img_user'),
      'edit' => $this->M_user->edit($id),
    );
    $this->template->load('layout/template', $this->view . 'edit', $data);
  }
  public function update($id)
  {
    $config['upload_path'] = './assets/img_user/';
    $config['allowed_types'] = 'jpg|jpeg|png';
    $config['max_size'] = 20000; // KB
    $config['file_name'] = 'user_' . time(); // Unique filename

    $this->load->library('upload', $config);

    if (!$this->upload->do_upload('img_user')) {
      $error = $this->upload->display_errors();

      // Check if the error is due to not selecting a new image
      if (strpos($error, 'You did not select a file to upload.') === false) {
        echo "<script>alert('$error');</script>";
        redirect($this->redirect, 'refresh');
      }
    } else {
      $img_user_data = $this->upload->data();
      $img_user = $img_user_data['file_name'];
    }

    $this->form_validation->set_rules('username', 'Username', 'required');

    // Ambil username dari database untuk memeriksa apakah ada perubahan
    $user = $this->M_user->getId($id);
    $username_db = $user->username;

    // Jika username tidak berubah, atur aturan validasi untuk mengabaikan is_unique
    if ($this->input->post('username') == $username_db) {
      $this->form_validation->set_rules('username', 'Username', 'required');
    } else {
      $this->form_validation->set_rules('username', 'Username', 'required|is_unique[user.username]');
    }

    if ($this->form_validation->run() == FALSE) {
      // Validasi gagal, kembali ke halaman edit dengan error
      $data = array(
        'judul' => "DATA USER",
        'sub' => "Data User",
        'active_menu' => 'user',
        'id' => $this->session->userdata('id'),
        'nama' => $this->session->userdata('nama'),
        'img_user_path' => 'assets/img_user/' . $this->session->userdata('img_user'),
        'edit' => $this->M_user->edit($id),
        'username_error' => form_error('username')
      );
      $this->template->load('layout/template', $this->view . 'edit', $data);
    } else {
      // Validasi berhasil, simpan data pengguna baru
      $data = array(
        // 'id_user' => $this->input->post('id_user'),
        'nama' => $this->input->post('nama'),
        'email' => $this->input->post('email'),
        'username' => $this->input->post('username'),
        'password' => $this->input->post('password'),
        'jabatan' => $this->input->post('jabatan'),
        // Jika tidak ada gambar baru, gunakan gambar yang sudah ada
        'img_user' => isset($img_user) ? $img_user : $user->img_user
      );

      $this->M_user->update($id, $data);
      redirect($this->redirect, 'refresh');
    }
  }

  public function delete()
  {
    $id = $this->uri->segment(3);
    $data = array(
      //data akan dihapus sesuai uri->segment(3) yang dipilih
      'id_user' => $id
    );
    $this->M_user->delete($data);
    redirect($this->redirect, 'refresh');
  }
}
