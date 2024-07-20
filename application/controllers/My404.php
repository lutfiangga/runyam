<?php
class My404 extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data = array(
            'judul' => "404 NOT FOUND",
            'sub' => "404 NOT FOUND",
        );
        $this->output->set_status_header('404');
        $this->load->view('backend/error/My404'); //loading in custom error view
    }
}
