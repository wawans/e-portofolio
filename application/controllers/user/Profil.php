<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profil extends CI_Controller {
    public $data = array();
    public function __construct() 
    {
        parent::__construct();
        $this->load->library('session');
        if (!$this->session->has_userdata('uuid')) redirect(base_url());
        $this->load->model('user_model');
        $this->data['profile'] = $this->user_model->get_profil($this->session->uuid);
    }

	/**
	 * Index Page for this controller.
	 *
	 */
	public function index()
	{
        $this->load->view('header',$this->data);
        $this->load->view('menu',$this->data);
        $this->load->view('nav-top',$this->data);
        $this->load->view('profil',$this->data);
        $this->load->view('footer',$this->data);
	}

    public function pengaturan()
    {
        $this->load->view('header',$this->data);
        $this->load->view('menu',$this->data);
        $this->load->view('nav-top',$this->data);
        $this->load->view('akun',$this->data);
        $this->load->view('footer',$this->data);
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