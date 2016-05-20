<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kelas extends CI_Controller {
    public $data = array();

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
        $this->load->view('Kelas',$this->data);
	}

    public function get_all_kelas()
    {
        $this->load->model('kelas_model');
        $data = $this->kelas_model->get_all();
        if ($this->input->is_ajax_request())
        {
            echo json_encode($data);
            exit;
        }
        else
        {
            $this->data['all'] = $data;
            $this->index();
        }
    }

    // kelas berdasarkan user yg login / yang di ikuti
    public function get_current()
    {
        $this->load->model('kelas_model');
        $data = $this->kelas_model->get_current();
        if ($this->input->is_ajax_request())
        {
            echo json_encode($data);
            exit;
        }
        else
        {
            $this->data['all'] = $data;
            $this->index();
        }
    }

    // data kelas tertentu berdasrkn uuid , return 1;
    public function get_uuid($uuid)
    {

    }

    public function get_uuid_member()
    {

    }

    public function create()
    {

    }

    public function join()
    {

    }

    public function update()
    {

    }

    public function drop()
    {

    }

    public function drop_member()
    {

    }
}

/* End of file Kelas.php */