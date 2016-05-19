<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    public function __construct() 
    {
        parent::__construct();
    }

	/**
	 * Index Page for this controller.
	 *
	 */
	public function index()
	{
        $data=array();
        $this->load->view('User',$data);
	}

    public function get_all()
    {

    }

    public function set_uuid()
    {

    }

    public function drop_uuid() {

    }
}

/* End of file User.php */