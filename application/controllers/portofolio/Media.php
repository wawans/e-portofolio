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

    public function drop($file_id)
    {
        $this->load->model('media_model');
        $data = $this->media_model->get_filename($file_id);
        if ($data!== false)
        {
            $filepath = FCPATH.'public'.DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.$data;
            if (is_really_writable($filepath) && unlink($filepath))
            {
                $this->media_model->delete_file($file_id);
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

    public function put_file()
    {
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
            $this->load->model('media_model');
            $code['file_id'] = $this->media_model->simpan($data['file_name']);
            $code['file_name'] = $data['orig_name'];
            $code['file_url'] = base_url().'public/uploads/'.$data['file_name'];
            $code['file_del'] = site_url('portofolio/media/drop/'.$code['file_id']);
            $code['return'] = "00"; // Accepted
            echo json_encode($code);
            //echo json_encode(array_merge($code,$data));
            exit;
        }
    }
}

/* End of file Media.php */