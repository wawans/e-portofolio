<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct() 
    {
        parent::__construct();
        $this->load->library('session');
    }

	/**
	 * Index Page for this controller.
	 *
	 */
	public function index()
	{
        $data=array();
        $this->load->view('header',$data);
        $this->load->view('nav-top',$data);
        $this->load->view('Home',$data);
        $this->load->view('footer',$data);
	}
}

/* End of file Home.php */