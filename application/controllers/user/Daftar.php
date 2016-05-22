<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Daftar extends CI_Controller {

    public function __construct() 
    {
        parent::__construct();
        $this->load->library('form_validation');
    }

	/**
	 * Index Page for this controller.
	 *
	 */
	public function index($user = 'siswa')
	{
        $data['user']=$user;
        $this->load->view('header',$data);
        //$this->load->view('nav-top',$data);
        $this->load->view('signup',$data);
	}

    public function set_user()
    {
        //if (!$this->input->is_ajax_request()) exit;
        $this->form_validation->set_rules('nama_awal', 'Nama Awal', 'required|trim|min_length[3]|max_length[125]');
        $this->form_validation->set_rules('nama_akhir', 'Nama Akhir', 'trim|max_length[125]');
        $this->form_validation->set_rules('username', 'Username', 'required|trim|min_length[4]|max_length[75]|callback_check_username');
        $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[4]');
        $this->form_validation->set_rules('passconf', 'Password Confirmation', 'required|trim|matches[password]');
        $this->form_validation->set_rules('email', 'Email', 'trim|valid_email|callback_check_email');
        if ($this->form_validation->run() === FALSE)
        {
            $eror = $this->form_validation->error_array();
            $code['return'] = "01";
            echo json_encode(array_merge($code,$eror));
        }
        else
        {
            $this->load->model('user_model');
            $data = $this->user_model->create_user();
            if ($data===true)
            {
                $code['return'] = "00"; // Accepted
                echo json_encode($code);
                exit;
            }
            $code['return'] = "01"; // Not Acceptable
            $code['mesage'] = $data;
            echo json_encode($code);
            exit;
        }
        exit;
    }

    public function set_kelas()
    {

    }

    public function check_username($var = NULL)
    {
        if (!isset($var) && $this->input->is_ajax_request())
        {
            // Cek username via ajax, no callback;
            $this->form_validation->set_rules('username', 'Username', 'required|trim|min_length[4]|max_length[75]');
            if ($this->form_validation->run() === FALSE)
            {
                $eror = $this->form_validation->error_array();
                $code['return'] = "01";
                echo json_encode(array_merge($code,$eror));
            }
            else
            {

            }
            exit;
        }
        else
        {

        }
    }

    public function check_email($var = NULL)
    {
        if (!isset($var) && $this->input->is_ajax_request())
        {
            // Cek username via ajax, no callback;
            $this->form_validation->set_rules('username', 'Username', 'required|trim|min_length[4]|max_length[75]');
            if ($this->form_validation->run() === FALSE)
            {
                $eror = $this->form_validation->error_array();
                $code['return'] = "01";
                echo json_encode(array_merge($code,$eror));
            }
            else
            {

            }
            exit;
        }
        else
        {

        }
    }

}

/* End of file Daftar.php */