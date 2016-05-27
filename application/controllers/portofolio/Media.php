<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Media extends CI_Controller {
	public $data = array();

	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
        if (!$this->session->has_userdata('uuid')) redirect(base_url());
		$this->load->model('user_model');
		$this->data['profile'] = $this->user_model->get_profil($this->session->uuid);
	}

	public function index()
	{
        $this->load->view('header',$this->data);
        $this->load->view('menu',$this->data);
        $this->load->view('nav-top',$this->data);
        $this->load->view('upload',$this->data);
        $this->load->view('footer',$this->data);
	}
}

/* End of file Media.php */