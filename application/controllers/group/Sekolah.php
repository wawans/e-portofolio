<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sekolah extends CI_Controller {

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
        $this->load->view('Sekolah',$data);
	}

    public function baru()
    {

    }

    public function get_uuid() {

    }
}

/* End of file Sekolah.php */