<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
    public $data = array();

    public function __construct() 
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->model(array('user_model','kelas_model'));
        $this->data['profile'] = $this->user_model->get_profil($this->session->uuid);
        $this->data['my_kelas'] = $this->kelas_model->get_current();
    }

	/**
	 * Index Page for this controller.
	 *
	 */
	public function index()
	{
        $this->load->view('header',$this->data);
        $this->load->view('menu',$this->data);
     //   $this->load->view('nav-top',$this->data);
        $this->load->view('home',$this->data);
        $this->load->view('footer',$this->data);
	}
}

/* End of file Home.php */