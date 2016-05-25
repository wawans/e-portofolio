<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tugas extends CI_Controller {
    public $data = array();

    public function __construct() 
    {
        parent::__construct();
        $this->load->library('session');
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
        $this->load->view('tugas',$this->data);
        $this->load->view('footer',$this->data);
	}

    public function create($kelas_uuid = null)
    {
        $this->load->library('form_validation');
        if ($kelas_uuid) $this->form_validation->set_data(array('kelas'=>$kelas_uuid));
        $this->form_validation->set_rules('judul', 'Judul', 'required|trim|max_length[125]');
        $this->form_validation->set_rules('konten', 'Isi Konten', 'required|trim');
        $this->form_validation->set_rules('tgl_awal', 'Jangka Waktu Awal', 'required|trim|exact_length[10]');
        $this->form_validation->set_rules('tgl_ahir', 'Jangka Waktu Ahir', 'required|trim|exact_length[10]');
        $this->form_validation->set_rules('jns_grup', 'Fill', 'required|trim|numeric|exact_length[1]');
        $this->form_validation->set_rules('jns_nilai', 'Fill', 'required|trim|numeric|exact_length[1]');
        $this->form_validation->set_rules('public', 'Fill', 'required|trim|numeric|exact_length[1]');
        $this->form_validation->set_rules('kelas', 'Fill', 'required|trim|exact_length[9]');
        if ($this->form_validation->run() === FALSE)
        {
            $eror = $this->form_validation->error_array();
            $code['return'] = "10";
            echo json_encode(array_merge($code,$eror));
        }
        else
        {
            $this->load->model('tugas_model');
            $data = $this->tugas_model->create();
            if (is_array($data) && (strtolower($data['msg']) == 'ok'))
            {
                $code['return'] = "00"; // Accepted
                $code['uuid'] = $data['uuid'];
                echo json_encode($code);
                exit;
            }
            $code['return'] = "20"; // Not Acceptable
            $code['mesage'] = $data;
            echo json_encode($code);
            exit;
        }
    }

    // ambil semua data milik saya
    public function get_my_list($user_uuid = null)
    {
        if ($user_uuid)
        {
            $user_uuid = $this->data['profile']->kd_uuid;
        }
        $this->load->model('tugas_model');
        $data = $this->tugas_model->get_my_list($user_uuid);
        if ($this->input->is_ajax_request())
        {
            echo json_encode($data);
            exit;
        }
        else
        {
            return $data;
        }
    }
    // data tugas berdasarkan kelas yg dipilih
    public function get_my_kelas_list($kelas_uuid, $user_uuid = null)
    {
        if ($user_uuid)
        {
            $user_uuid = $this->data['profile']->kd_uuid;
        }
        $this->load->model('tugas_model');
        $data = $this->tugas_model->get_my_kelas_list($kelas_uuid,$user_uuid);
        if ($this->input->is_ajax_request())
        {
            echo json_encode($data);
            exit;
        }
        else
        {
            return $data;
        }
    }
}

/* End of file Tugas.php */