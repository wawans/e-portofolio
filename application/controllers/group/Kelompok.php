<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kelompok extends CI_Controller {
    public $data = array();

    public function __construct() 
    {
        parent::__construct();
        $this->load->library('session');
    }

	/**
	 * Index Page for this controller.
	 *
	 */
	public function index()
	{
        $this->get_all(true);
        $this->load->view('header',$this->data);
        $this->load->view('nav-top',$this->data);
        $this->load->view('Kelompok',$this->data);
	}
    // kelompok
    public function get_all($local = false)
    {
        $this->load->model('kelompok_model');
        $data = $this->kelompok_model->get_all();
        if ($this->input->is_ajax_request())
        {
            echo json_encode($data);
            exit;
        }
        elseif($local==true)
        {
            $this->data['all'] = $data;
        }
        else
        {
            $this->index();
        }
    }
    // kelas -> hanya untuk development !important.
    public function get_all_kelas($local = false)
    {
        $this->load->model('kelas_model');
        $data = $this->kelas_model->get_all();
        if ($this->input->is_ajax_request())
        {
            echo json_encode($data);
            exit;
        }
        elseif($local==true)
        {
            $this->data['all'] = $data;
        }
        else
        {
            $this->index();
        }
    }

    // kelas berdasarkan user yg login / yang di ikuti
    public function get_current()
    {
        $this->load->model('kelompok_model');
        $data = $this->kelompok_model->get_current();
        if ($this->input->is_ajax_request())
        {
            echo json_encode($data);
            exit;
        }
        else
        {
            $this->data['all'] = $data;
            $this->index();
        }
    }

    // data kelas tertentu berdasrkn uuid , return 1;
    public function get_uuid($uuid)
    {

    }

    public function get_uuid_member()
    {

    }

    public function check_uuid_exist($uuid = NULL)
    {
        $this->load->library('form_validation');
        if (!$this->input->is_ajax_request())
        {
            $this->form_validation->set_data(array('kode'=>$uuid));
        }
        $this->form_validation->set_rules('kode', 'Kode Kelompok', 'required|trim|exact_length[9]');
        if ($this->form_validation->run() === FALSE)
        {
            if ($this->input->is_ajax_request())
            {
                $eror = $this->form_validation->error_array();
                $code['return'] = "01";
                echo json_encode(array_merge($code,$eror));
                exit;
            }
            else
            {
                return false;
            }
        }
        elseif (!isset($uuid))
        {
            $this->check_uuid_exist($this->input->post('kode'));
        }
        elseif (isset($uuid))
        {
            $this->load->model('kelompok_model');
            $data = $this->kelompok_model->check_uuid_exist($uuid);
            if ($data===true && $this->input->is_ajax_request())
            {
                echo json_encode(array('return' => '00'));
                exit;
            }
            else
            {
                if ($data===true)
                {
                    return true;
                }
                else
                {
                    $this->form_validation->set_message('check_uuid_exist', 'The {field} value is not exist');
                    return false;
                }
            }
        }
        else
        {
            return false;
        }
    }
public function check_kelas_uuid_exist($uuid = NULL)
    {
        $this->load->library('form_validation');
        if (!$this->input->is_ajax_request())
        {
            $this->form_validation->set_data(array('kelas'=>$uuid));
        }
        $this->form_validation->set_rules('kelas', 'Kode Kelas', 'required|trim|exact_length[9]');
        if ($this->form_validation->run() === FALSE)
        {
            if ($this->input->is_ajax_request())
            {
                $eror = $this->form_validation->error_array();
                $code['return'] = "01";
                echo json_encode(array_merge($code,$eror));
                exit;
            }
            else
            {
                return false;
            }
        }
        elseif (!isset($uuid))
        {
            $this->check_kelas_uuid_exist($this->input->post('kelas'));
        }
        elseif (isset($uuid))
        {
            $this->load->model('kelas_model');
            $data = $this->kelas_model->check_uuid_exist($uuid);
            if ($data===true && $this->input->is_ajax_request())
            {
                echo json_encode(array('return' => '00'));
                exit;
            }
            else
            {
                if ($data===true)
                {
                    return true;
                }
                else
                {
                    $this->form_validation->set_message('check_kelas_uuid_exist', 'The {field} value is not exist');
                    return false;
                }
            }
        }
        else
        {
            return false;
        }
    }

    public function create()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('kelas', 'Kode Kelas', 'required|trim|exact_length[9]|callback_check_kelas_uuid_exist');
        $this->form_validation->set_rules('nama', 'Nama Kelompok', 'required|trim|min_length[1]|max_length[125]');
        $this->form_validation->set_rules('maks', 'Maks', 'required|trim|numeric|max_length[11]');
        if ($this->form_validation->run() === FALSE)
        {
            $eror = $this->form_validation->error_array();
            $code['return'] = "01";
            echo json_encode(array_merge($code,$eror));
        }
        else
        {
            $this->load->model('kelompok_model');
            $data = $this->kelompok_model->create();
            if (is_array($data) && (strtolower($data['msg']) == 'ok'))
            {
                $code['return'] = "00"; // Accepted
                $code['uuid'] = $data['uuid'];
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

    public function join($uuid = null)
    {
        $this->load->library('form_validation');
        if (!$this->input->is_ajax_request())
        {
            $this->form_validation->set_data(array('kode'=>$uuid));
        }
        $this->form_validation->set_rules('kode', 'Kode Kelas', 'required|trim|exact_length[9]|callback_check_uuid_exist');
        if ($this->form_validation->run() === FALSE)
        {
            $eror = $this->form_validation->error_array();
            $code['return'] = "01";
            echo json_encode(array_merge($code,$eror));
        }
        else
        {
            $this->load->model('kelompok_model');
            $data = $this->kelompok_model->join($uuid);
            if ($data===true)
            {
                $code['return'] = "00"; // Accepted
                echo json_encode($code);
            }
            else
            {
                $code['return'] = "01"; // Not Acceptable
                $code['mesage'] = $data;
                echo json_encode($code);
            }
        }
        exit;
    }

    public function join_out($kelas_uuid)
    {
        $this->load->library('form_validation');
        if (!$this->input->is_ajax_request()) $this->form_validation->set_data(array('kode'=>$kelas_uuid));
        $this->form_validation->set_rules('kode', 'Kode Kelas', 'required|trim|exact_length[9]|callback_check_uuid_exist');
        if ($this->form_validation->run() === FALSE)
        {
            $eror = $this->form_validation->error_array();
            $code['return'] = "01";
            echo json_encode(array_merge($code,$eror));
        }
        else
        {
            $this->load->model('kelompok_model');
            $data = $this->kelompok_model->join_out($kelas_uuid);
            if ($data===true)
            {
                $code['return'] = "00"; // Accepted
                echo json_encode($code);
            }
            else
            {
                $code['return'] = "01"; // Not Acceptable
                $code['mesage'] = $data;
                echo json_encode($code);
            }
        }
        exit;
    }

    public function update($kelas_uuid = null)
    {
        $this->load->library('form_validation');
        if (isset($kelas_uuid)) $this->form_validation->set_data(array('kode'=>$kelas_uuid));
        $this->form_validation->set_rules('kode', 'Kode Kelas', 'required|trim|exact_length[9]|callback_check_uuid_exist');
        $this->form_validation->set_rules('nama', 'Nama Kelas', 'required|trim|min_length[3]|max_length[125]');
        $this->form_validation->set_rules('maks', 'Maks', 'required|trim|numeric|max_length[11]');
        if ($this->form_validation->run() === FALSE)
        {
            $eror = $this->form_validation->error_array();
            $code['return'] = "01";
            echo json_encode(array_merge($code,$eror));
        }
        else
        {
            $this->load->model('kelompok_model');
            $data = $this->kelompok_model->update($kelas_uuid);
            if ($data===true)
            {
                $code['return'] = "00"; // Accepted
                echo json_encode($code);
            }
            else
            {
                $code['return'] = "01"; // Not Acceptable
                $code['mesage'] = $data;
                echo json_encode($code);
            }
        }
        exit;
    }

    /**
     * Drop , Only owner & empty kelas member (min 1 , owner) allowed;
     */
    public function drop($kelas_uuid=null)
    {
        $this->load->library('form_validation');
        if (isset($kelas_uuid)) $this->form_validation->set_data(array('kode'=>$kelas_uuid));
        $this->form_validation->set_rules('kode', 'Kode Kelas', 'required|trim|exact_length[9]|callback_check_uuid_exist');
        if ($this->form_validation->run() === FALSE)
        {
            $eror = $this->form_validation->error_array();
            $code['return'] = "01";
            echo json_encode(array_merge($code,$eror));
        }
        else
        {
            $this->load->model('kelompok_model');
            $data = $this->kelompok_model->drop($kelas_uuid);
            if ($data===true)
            {
                $code['return'] = "00"; // Accepted
                echo json_encode($code);
            }
            else
            {
                $code['return'] = "01"; // Not Acceptable
                $code['mesage'] = $data;
                echo json_encode($code);
            }
        }
        exit;
    }

    public function drop_member($kelas_uuid,$member_uuid)
    {

    }
}

/* End of file Kelompok.php */