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
	public function index($kelas_uuid)
	{
        $this->data['kelas_uuid'] = $kelas_uuid;
        $this->load->view('header',$this->data);
        $this->load->view('menu',$this->data);
        $this->load->view('nav-top',$this->data);
        $this->load->view('tugas',$this->data);
        $this->load->view('footer',$this->data);
	}

    public function baru($kelas_uuid)
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('judul', 'Judul', 'required|trim|max_length[125]');
        $this->form_validation->set_rules('konten', 'Isi Konten', 'required|trim');
        $this->form_validation->set_rules('tgl_awal', 'Jangka Waktu Awal', 'required|trim|exact_length[10]');
        $this->form_validation->set_rules('tgl_ahir', 'Jangka Waktu Ahir', 'required|trim|exact_length[10]');
        $this->form_validation->set_rules('jns_grup', 'Grup', 'required|trim|numeric|exact_length[1]');
        $this->form_validation->set_rules('jns_nilai', 'PeNilai', 'required|trim|numeric|exact_length[1]');
        $this->form_validation->set_rules('publik', 'Publik', 'required|trim|numeric|exact_length[1]');
        if ($this->form_validation->run() === FALSE)
        {
            $eror = $this->form_validation->error_array();
            $code['return'] = "10";
            echo json_encode(array_merge($code,$eror));
        }
        else
        {
            $this->load->model('tugas_model');
            $data = $this->tugas_model->baru($kelas_uuid);
            if ($data===true)
            {
                $code['return'] = "00"; // Accepted
                echo json_encode($code);
            }
            else
            {
                $code['return'] = "20"; // Not Acceptable
                $code['mesage'] = $data;
                echo json_encode($code);
            }
        }
        exit;
    }

    public function daftar_tugas($kelas_uuid)
    {
        $this->load->model('tugas_model');
        $data = $this->tugas_model->daftar_tugas($kelas_uuid);
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