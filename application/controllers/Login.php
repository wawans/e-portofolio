<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct() 
    {
        parent::__construct();
        $this->load->helper('form');
    }

	/**
	 * Index Page for this controller.
	 *
	 */
	public function index()
	{
        $data=array();
        $this->load->view('header',$data);
        $this->load->view('Login',$data);
        $this->load->view('footer',$data);
	}
}

/* End of file Login.php */