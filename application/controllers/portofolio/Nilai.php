<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Nilai extends CI_Controller {
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
        $this->load->view('nilai',$this->data);
        $this->load->view('footer',$this->data);
	}

    public function menilai($tugas_uuid,$a,$z)
    {
        $this->load->model('tugas_model');
        $this->data['user'] = $this->tugas_model->get_list_participants(true,$tugas_uuid,$a);
        $this->data['a'] = $a;
        $this->data['z'] = $z;
        $this->data['tugas'] = $tugas_uuid;
        $this->load->view('popup.menilai.php',$this->data);
        //echo var_dump($this->data['user']);
        //exit;
    }

    public function simpan($tugas_kd,$ternilai_kd)
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('n1', 'Sikap', 'required|trim|numeric|max_length[3]');
        $this->form_validation->set_rules('n2', 'Pengetahuan', 'required|trim|numeric|max_length[3]');
        $this->form_validation->set_rules('n3', 'Ketrampilan', 'required|trim|numeric|max_length[3]');
        $this->form_validation->set_rules('n5', 'Presentasi', 'required|trim|numeric|max_length[3]');
        if ($this->form_validation->run() === FALSE)
        {
            $eror = $this->form_validation->error_array();
            $code['return'] = "10";
            echo json_encode(array_merge($code,$eror));
        }
        else
        {
            $this->load->model('nilai_model');
            $data = $this->nilai_model->simpan($tugas_kd,$ternilai_kd);
            if (is_array($data) && (strtolower($data['msg']) == 'ok'))
            {
                $code['return'] = "00"; // Accepted
                echo json_encode($code);
                exit;
            }
            $code['return'] = "20"; // Not Acceptable
            $code['mesage'] = $data;
            echo json_encode($code);
            exit;
        }
        exit;
    }


}

/* End of file Nilai.php */