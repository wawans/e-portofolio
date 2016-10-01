<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->session->sess_destroy();
        session_write_close();
    }

	public function index()
	{
        $data=array();
        $this->load->view('header',$data);
        $this->load->view('login',$data);
        $this->load->view('footer',$data);
	}

    public function error404()
    {
        $data=array();
        $this->load->view('header',$data);
        $this->load->view('error-404',$data);
        $this->load->view('footer',$data);
    }
}
