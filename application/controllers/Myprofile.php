<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MyProfile extends CI_Controller
{
	private $view = "myprofile/";
	private $redirect = "MyProfile/";

	public function __construct()
	{
		parent::__construct();
		IsAdmin();
		$this->load->model('M_profile');
		$this->load->library('form_validation');
		$this->load->model('M_user');
	}

	public function index()
	{
		$id = $this->session->userdata('id_user');
		$data = array(
			//'read' variabel yang akan dipanggil pada view read.php
			'judul' => "MY PROFILE",
			'sub' => "My Profile",
			'active_menu' => 'myprofile',
			'id_user' => $id,
			'username' => $this->session->userdata('username'),
			'password' => $this->session->userdata('password'),
			'nama' => $this->session->userdata('nama'),
			 'foto' => 'assets/img/photos/' . $this->session->userdata('img_user'),
			'user' => $this->M_profile->getById($id),
		);

		$this->template->load('layout/template', $this->view . 'read', $data);
	}

	public function edit()
	{
		$id = $this->session->userdata('id_user');
		$data = array(
			//'read' variabel yang akan dipanggil pada view read.php
			'judul' => "MY PROFILE",
			'sub' => "My Profile",
			'active_menu' => 'myprofile',
			'id_user' => $id,
			'username' => $this->session->userdata('username'),
			'password' => $this->session->userdata('password'),
			'nama' => $this->session->userdata('nama'),
			 'foto' => 'assets/img/photos/' . $this->session->userdata('img_user'),
			'user' => $this->M_profile->getById($id),
			'edit' => $this->M_profile->edit($id),
		);

		$this->template->load('layout/template', $this->view . 'edit', $data);
	}

	public function update($id)
	{
		$config['upload_path'] = './assets/img/photos/';
		$config['allowed_types'] = 'jpg|jpeg|png';
		$config['max_size'] = 20000; // KB
		$config['file_name'] = 'user_' . time(); // Unique filename

		$this->load->library('upload', $config);

		$img_user = '';
		if ($this->upload->do_upload('img_user')) {
			$img_user_data = $this->upload->data();
			$img_user = $img_user_data['file_name'];
		} else {
			// Ambil dari input hidden atau dari data saat ini jika file tidak diunggah
			$img_user = $this->input->post('img_user_current');
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
			// Validasi gagal, simpan pesan error ke flashdata
			$this->session->set_flashdata('username_error', validation_errors());
			redirect($this->redirect . '/edit/' . $id); // Redirect kembali ke halaman edit
		} else {
			// Validasi berhasil, simpan data pengguna baru
			$data = array(
				'username' => $this->input->post('username'),
				'password' => $this->input->post('password'),
				'nama' => $this->input->post('nama'),
				'img_user' => $img_user,
			);

			$this->M_user->update($id, $data);

			// Set session data for user update
			$this->session->set_userdata('username', $this->input->post('username'));
			$this->session->set_userdata('password', $this->input->post('password'));
			$this->session->set_userdata('nama', $this->input->post('nama'));
			$this->session->set_userdata('img_user', $img_user);

			redirect($this->redirect, 'refresh');
		}
	}

}
