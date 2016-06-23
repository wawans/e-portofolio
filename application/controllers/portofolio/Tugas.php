<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tugas extends CI_Controller {
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
	public function index($kelas_uuid)
	{
        $this->data['kelas_uuid'] = $kelas_uuid;
        $this->load->view('header',$this->data);
        $this->load->view('menu',$this->data);
        $this->load->view('nav-top',$this->data);
        $this->load->view('tugas',$this->data);
        $this->load->view('footer',$this->data);
	}

    public function detail($kelas_uuid,$tugas_uuid)
    {
        $this->load->model('media_model');
        $this->data['data_tugas'] = $this->detail_tugas($tugas_uuid);
        $this->data['data_lampiran'] = $this->media_model->get_by_kd_tugas($this->data['data_tugas']->kd_tugas);
        $this->data['kelas_uuid'] = $kelas_uuid;
        $this->data['tugas_uuid'] = $tugas_uuid;
        $this->load->view('header',$this->data);
        $this->load->view('menu',$this->data);
        $this->load->view('nav-top',$this->data);
        $this->load->view('tugas-detail',$this->data);
        $this->load->view('footer',$this->data);
    }

    public function buat($kelas_uuid)
    {

    }

    public function baru($kelas_uuid)
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('judul', 'Judul', 'required|trim|max_length[125]');
        $this->form_validation->set_rules('konten', 'Isi Konten', 'required|trim');
        $this->form_validation->set_rules('tgl_awal', 'Jangka Waktu Awal', 'required|trim|exact_length[10]');
        $this->form_validation->set_rules('tgl_ahir', 'Jangka Waktu Ahir', 'required|trim|exact_length[10]');
        $this->form_validation->set_rules('jns_grup', 'Grup', 'trim|numeric|exact_length[1]');
        $this->form_validation->set_rules('jns_nilai', 'PeNilai', 'trim|numeric|exact_length[1]');
        $this->form_validation->set_rules('publik', 'Publik', 'trim|numeric|exact_length[1]');
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
            if (is_array($data) && ($data['msg'] == 'ok'))
            {
                $code['return'] = "00"; // Accepted
                $code['kode'] = $data['kode'];
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

    public function detail_tugas($tugas_uuid)
    {
        $this->load->model('tugas_model');
        $data = $this->tugas_model->detail_tugas($tugas_uuid);
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

    public function join($kelas_uuid,$tugas_uuid)
    {
        // prepare validation before upload
        $this->load->model('kelas_model');
        // cek kode kelas benar ada;
        if (!$this->kelas_model->check_uuid_exist($kelas_uuid))
        {
            $code['return'] = "20"; // Not Acceptable
            $code['mesage'] = 'Kelas tidak ditemukan';
            echo json_encode($code);
            exit;
        }

        // send file
        $config['upload_path']          = FCPATH.'public'.DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR;
        $config['allowed_types']        = 'gif|jpg|png|jpeg|doc|docx|pdf|xls|xlsx|ppt|txt|zip|rar|7zip';
        $config['max_size']             = ini_get('upload_max_filesize')*1024;
        $config['file_ext_tolower']     = true;
        $config['encrypt_name']         = true;

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('filename'))
        {
            $code['return'] = "20"; // Not Acceptable
            $code['mesage'] = $this->upload->display_errors();
            echo json_encode($code);
            exit;
        }
        // no error, save Tugas & Media
        else
        {
            $data = $this->upload->data();
            $this->load->model('tugas_model');
            $this->load->model('media_model');
            $tugas = $this->tugas_model->join($tugas_uuid);
            if ($tugas === true)
            {
                // simpan file;
                $code['file_id'] = $this->media_model->simpan($data['file_name'],$this->tugas_model->get_kd_tugas($tugas_uuid),false);
                $code['return'] = "00"; // Accepted
                echo json_encode($code);
                exit;
            }
            else
            {
                // jika eror hapus file , tidak simpan media
                $filepath = FCPATH.'public'.DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.$data['file_name'];
                if (is_really_writable($filepath))
                {
                    unlink($filepath);
                }
                $code['return'] = "20"; // Not Acceptable
                $code['mesage'] = $tugas;
                echo json_encode($code);
                exit;
            }
        }
    }
}

/* End of file Tugas.php */