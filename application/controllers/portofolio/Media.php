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
        $this->load->view('media',$this->data);
        $this->load->view('footer',$this->data);
	}

    public function uploader($tugas_uuid) {
        // gunakan method ini untuk upload lampiran tugas detail , bukan hasil tugas (form individu).
        // cek apakah tugas uuid sudah ada;
        $this->load->model(array('media_model','tugas_model'));
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
                    $code['url_del'] = site_url('portofolio/media/delete/'.$kd_media);
                    $code['idx'] = $kd_media;
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
            $code['mesage'] = "Tugas Tidak Valid!";
            echo json_encode($code);
            exit;
        }
    }

    public function delete($kd_media)
    {
        $this->load->model(array('media_model','tugas_model'));
        $file = $this->media_model->get_file($kd_media);
        if (is_object($file))
        {
            $filepath = FCPATH.'public'.DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.$file->file;
            if (is_really_writable($filepath) && unlink($filepath))
            {
                $this->media_model->delete($kd_media);
                exit('Berkas dihapus!');
            }
            else
            {
                exit('Berkas tidak ditemukan!');
            }
        }
        else
        {
            exit('error');
        }
    }

    public function drop($type = 'id',$file_id)
    {
        $data = $file_id;
        if (($type=='id') || ($type=='tugas'))
        {
            $this->load->model('media_model');
            $data = $this->media_model->get_filename($file_id);
        }
        if ($data!== false)
        {
            $filepath = FCPATH.'public'.DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.$data;
            if (is_really_writable($filepath) && unlink($filepath))
            {
                //if ($type == 'id') $this->media_model->delete_file($file_id);
                if (($type=='id') || ($type=='tugas'))
                {
                    $this->media_model->delete_file($file_id,false);
                    $this->load->model('tugas_model');
                    $this->tugas_model->join_out($this->media_model->get_kdTugas_byID($file_id));
                }
                exit('Berkas dihapus!');
            }
            else
            {
                exit('Berkas tidak ditemukan!');
            }
        }
        else
        {
            exit('Berkas tidak dapat dihapus!');
        }
    }

    public function put_file($act = 'tmp',$kd_tugas = null)
    {
        if (($act == 'save') && !isset($kd_tugas))
        {
            $code['return'] = "20"; // Not Acceptable
            $code['mesage'] = "Simpan tugas dahulu!";
            echo json_encode($code);
            exit;
        }
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
        else
        {
            $data = $this->upload->data();
            if ($act == 'save') {
                $this->load->model('media_model');
                $code['file_id'] = $this->media_model->simpan($data['file_name'],$kd_tugas);
            }
            else
            {
                $code['file_id'] = $data['file_name'];
            }
            $code['file_name'] = $data['orig_name'];
            $code['raw_name'] = $data['raw_name'];
            $code['file_url'] = base_url().'public/uploads/'.$data['file_name'];
            //$code['file_del'] = site_url('portofolio/media/drop/file/'.$code['file_id']);
            $code['file_del'] = site_url('portofolio/media/drop/id/'.$code['file_id']);
            $code['return'] = "00"; // Accepted
            echo json_encode($code);
            //echo json_encode(array_merge($code,$data));
            exit;
        }
    }
}

/* End of file Media.php */