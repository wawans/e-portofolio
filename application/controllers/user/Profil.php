<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profil extends CI_Controller {

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
        $this->load->view('Profil',$data);
	}

    public function get_current()
    {

    }

    public function get_uuid()
    {

    }

    public function set_profil()
    {

    }

    public function set_password()
    {

    }
}

/* End of file Profil.php */