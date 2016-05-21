<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->session->sess_destroy();
    }

	public function index()
	{
        $data=array();
        $this->load->view('header',$data);
        $this->load->view('nav-top',$data);
        $this->load->view('index',$data);
        $this->load->view('footer',$data);
	}
}
