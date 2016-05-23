<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Masuk extends CI_Controller {

    public function __construct() 
    {
        parent::__construct();
		$this->load->library('form_validation');
    }

	/**
	 * Index Page for this controller.
	 *
	 */
	public function index()
	{
        $data=array();
        $this->load->view('nav-top',$data);
        $this->load->view('Masuk',$data);
	}

    public function post() {
        $this->form_validation->set_rules('username', 'Username', 'required|trim|min_length[4]');
        $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[4]');
        if ($this->form_validation->run() === FALSE)
        {
            $eror = $this->form_validation->error_array();
            $code['return'] = "10"; // Error Form Validation
            echo json_encode(array_merge($code,$eror));
        }
        else
        {
            $this->load->model('user_model');
            $data = $this->user_model->login_user();
            if (is_array($data) && (strtolower($data['msg']) == 'ok'))
            {
                $this->load->library('session');
                $this->session->set_userdata(array(
                    'uuid' => $data['uuid'],
                    'token' => md5(microtime()),
                    'name' => $this->input->post('username')
                ));
                if (!$this->input->is_ajax_request()) redirect(site_url('home/index/?uuid='.$data['uuid']));
                $code['return'] = "00"; // True
                echo json_encode($code);
                exit;
            }
            $code['return'] = "20"; // Error Message
            $code['mesage'] = $data;
            echo json_encode($code);
            exit;
        }
        exit;
    }
}

/* End of file Masuk.php */