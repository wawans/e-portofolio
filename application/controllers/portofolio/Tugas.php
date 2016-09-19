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
        $this->data['data_lampiran'] = $this->media_model->lampiran_detail_tugas($this->data['data_tugas']->kd_tugas);
        $this->data['my_lampiran'] = $this->media_model->lampiran_tugas($this->data['data_tugas']->kd_tugas);
        $this->data['kelas_uuid'] = $kelas_uuid;
        $this->list_participants($kelas_uuid,$tugas_uuid,true);
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
            exit;
        }
        else
        {
            $this->load->model('tugas_model');
            $data = $this->tugas_model->baru($kelas_uuid);
            if (is_array($data) && ($data['msg'] == 'ok'))
            {
                $code['return'] = "00"; // Accepted
                $code['kode'] = $data['kode'];
                $code['uuid'] = $data['uuid'];
                echo json_encode($code);
                exit;
            }
            else
            {
                $code['return'] = "20"; // Not Acceptable
                $code['mesage'] = $data;
                echo json_encode($code);
                exit;
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
        $error = null;
        // prepare validation before upload
        $this->load->model('tugas_model');
        // cek kode tugas benar ada;
        if (!$this->tugas_model->is_tugas_exist($tugas_uuid)) $error = 'Tugas tidak ditemukan';
        $kd_tugas = $this->tugas_model->get_kd_tugas($tugas_uuid);
        // cek kode kelas benar ada;
        if (!$this->tugas_model->is_kelas_exist($kelas_uuid)) $error = 'Kelas tidak ditemukan';
        // CEK USER SUDAH MENGERJAKAN / BELUM
        if ($this->tugas_model->is_user_submited($kd_tugas,$this->data['profile']->kd_user))
            $error = 'Anda Sudah Mengerjakan Tugas Ini';

        if (!is_null($error))
        {
            $code['return'] = "20"; // Not Acceptable
            $code['mesage'] = $error;
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
            // simpan tugas // jika eror hapus file , tidak simpan media
            $save = $this->tugas_model->join($tugas_uuid);
            if($save === true)
            {
                // no eror , simpan media
                $this->load->model('media_model');
                $code['file_id'] = $this->media_model->simpan($data['file_name'],$kd_tugas,false);
                $code['file_name'] = $data['orig_name'];
                $code['raw_name'] = $data['raw_name'];
                $code['file_url'] = base_url().'public/uploads/'.$data['file_name'];
                $code['file_del'] = site_url('portofolio/media/drop/id/'.$code['file_id']);

                $code['return'] = "00"; // Accepted
                echo json_encode($code);
                exit;
            }
            else
            {
                $filepath = FCPATH.'public'.DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.$data;
                if (is_really_writable($filepath) && unlink($filepath))
                {
                    $save .= '. Berkas dihapus!';
                }
                $code['return'] = "20"; // Not Acceptable
                $code['mesage'] = $save;
                echo json_encode($code);
                exit;
            }
            exit;
        }

    }

    public function uploader($kelas_uuid,$tugas_uuid) {
        // gunakan method ini untuk upload lampiran hasil tugas (form individu). bukan tugas detail.
        // cek apakah tugas uuid sudah ada;
        $this->load->model(array('media_model','tugas_model'));
        $error = null;
        // prepare validation before upload
        // cek kode kelas benar ada;
        if (!$this->tugas_model->is_kelas_exist($kelas_uuid)) $error = 'Kelas tidak ditemukan';
        // CEK USER SUDAH MENGERJAKAN / BELUM
        if ($this->tugas_model->is_user_submited($this->tugas_model->get_kd_tugas($tugas_uuid),$this->data['profile']->kd_user))
            $error = 'Anda Sudah Mengerjakan Tugas Ini';

        if (!is_null($error))
        {
            $code['return'] = "20"; // Not Acceptable
            $code['mesage'] = $error;
            echo json_encode($code);
            exit;
        }
        if ($this->tugas_model->is_tugas_exist($tugas_uuid))
        {
            $config['upload_path']          = FCPATH.'public'.DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR;
            $config['allowed_types']        = 'gif|jpg|png|jpeg|doc|docx|pdf|xls|xlsx|ppt|txt|zip|rar|7zip';
            $config['max_size']             = ini_get('upload_max_filesize')*1024;
            $config['file_ext_tolower']     = true;
            $config['max_filename']         = 248;

            $this->load->library('upload', $config);
            if ( ! $this->upload->do_upload('filename'))
            {
                $code['return'] = "20"; // Not Acceptable
                $code['mesage'] = $this->upload->display_errors();
                echo json_encode($code);
                exit;
            }
            else
            {
                $data = $this->upload->data();
                $kd_tugas = $this->tugas_model->get_kd_tugas($tugas_uuid);
                $kd_media = $this->media_model->save_file($kd_tugas,$data);

                if (strlen($kd_media) == 9)
                {
                    $code['name'] = $data['orig_name'];
                    $code['file'] = $data['file_name'];
                    $code['url_file'] = base_url().'public/uploads/'.$data['file_name'];
                    $code['url_del'] = site_url('portofolio/media/delete/'.$code['kd_media']);
                    $code['return'] = "00"; // Accepted
                    echo json_encode($code);
                    exit;
                }
                else
                {
                    if (is_really_writable($data['full_path']) && unlink($data['full_path']))
                    {
                        $kd_media .= '. Berkas dihapus!';
                    }
                    $code['return'] = "20"; // Not Acceptable
                    $code['mesage'] = $kd_media;
                    echo json_encode($code);
                    exit;
                }
            }
        }
        else
        {
            $code['return'] = "20"; // Not Acceptable
            $code['mesage'] = "Tugas tidak ditemukan!";
            echo json_encode($code);
            exit;
        }
    }

    public function list_participants($kelas_uuid,$tugas_uuid,$local = false)
    {
        $this->load->model('tugas_model');
        $data = $this->tugas_model->get_list_participants($kelas_uuid,$tugas_uuid);
        if ($this->input->is_ajax_request())
        {
            echo json_encode($data);
            exit;
        }
        elseif($local==true)
        {
            $this->data[__FUNCTION__] = $data;
        }
        else
        {
            return $data;
        }
    }
}

/* End of file Tugas.php */