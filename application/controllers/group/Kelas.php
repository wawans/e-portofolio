<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kelas extends CI_Controller {

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
        $this->load->view('Kelas',$data);
	}

    public function get_all_kelas()
    {

    }

    // kelas berdasarkan user yg login / yang di ikuti
    public function get_current()
    {

    }

    // data kelas tertentu berdasrkn uuid , return 1;
    public function get_uuid()
    {

    }

    public function get_uuid_member()
    {

    }

    public function set_uuid()
    {

    }

    public function set_uuid_member()
    {

    }

    public function drop_uuid() {

    }
}

/* End of file Kelas.php */