<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kelompok extends CI_Controller {
    public $data = array();

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        if (!$this->session->has_userdata('uuid')) redirect(base_url());
        $this->load->model(array('user_model','kelas_model'));
        $this->data['profile'] = $this->user_model->get_profil($this->session->uuid);
        $this->data['my_kelas'] = $this->kelas_model->get_current();
    }

    /**
     * Index Page for this controller.
     *
     */
    public function index($kelas_uuid)
    {
        $this->get_all(true);
        $this->data['kelas_uuid'] = $kelas_uuid;
        $this->load->view('header',$this->data);
        $this->load->view('menu',$this->data);
        $this->load->view('Kelompok',$this->data);
        $this->load->view('footer',$this->data);
    }

    public function detail($kelompok_uuid)
    {
        if ($this->is_group_exist($kelompok_uuid)!=true) show_404();
        $this->get_detail($kelompok_uuid);
        $this->get_uuid_member($kelompok_uuid);
        $this->load->view('header',$this->data);
        $this->load->view('menu',$this->data);
        $this->load->view('Kelompok-detail',$this->data);
        $this->load->view('footer',$this->data);
    }

    public function create()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('kelas', 'Kode Kelas', 'required|trim|exact_length[9]|callback_is_kelas_exist');
        $this->form_validation->set_rules('nama', 'Nama Kelas', 'required|trim|min_length[1]|max_length[125]');
        $this->form_validation->set_rules('maks', 'Maks', 'required|trim|numeric|max_length[11]');
        if ($this->form_validation->run() === FALSE)
        {
            $error = $this->form_validation->error_array();
            $code['return'] = "10";
            echo json_encode(array_merge($code,$error));
            exit;
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
            $code['return'] = "20"; // Not Acceptable
            $code['mesage'] = $data;
            echo json_encode($code);
            exit;
        }
    }

    public function join()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('kode', 'Kode Kelompok', 'required|trim|exact_length[9]|callback_is_group_exist');
        if ($this->form_validation->run() === FALSE)
        {
            $error = $this->form_validation->error_array();
            $code['return'] = "10";
            echo json_encode(array_merge($code,$error));
            exit;
        }
        else
        {
            $this->load->model('kelompok_model');
            $data = $this->kelompok_model->join();
            if ($data===true)
            {
                $code['return'] = "00"; // Accepted
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

    }

    public function join_out($kelompok_uuid)
    {
        $this->load->library('form_validation');
        $this->form_validation->set_data(array('kode'=>$kelompok_uuid));
        $this->form_validation->set_rules('kode', 'Kode Kelompok', 'required|trim|exact_length[9]|callback_is_group_exist');
        if ($this->form_validation->run() === FALSE)
        {
            $eror = $this->form_validation->error_array();
            $code['return'] = "10";
            echo json_encode(array_merge($code,$eror));
        }
        else
        {
            $this->load->model('kelompok_model');
            $data = $this->kelompok_model->join_out($kelompok_uuid);
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

    public function drop($kelompok_uuid)
    {
        $this->load->library('form_validation');
        $this->form_validation->set_data(array('kode'=>$kelompok_uuid));
        $this->form_validation->set_rules('kode', 'Kode Kelompok', 'required|trim|exact_length[9]|callback_is_group_exist');
        if ($this->form_validation->run() === FALSE)
        {
            $eror = $this->form_validation->error_array();
            $code['return'] = "10";
            echo json_encode(array_merge($code,$eror));
        }
        else
        {
            $this->load->model('kelompok_model');
            $data = $this->kelompok_model->drop($kelompok_uuid);
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

    public function drop_member($kelompok_uuid,$member_kd)
    {
        $this->load->library('form_validation');
        $this->form_validation->set_data(array('kode'=>$kelompok_uuid));
        $this->form_validation->set_rules('kode', 'Kode Kelompok', 'required|trim|exact_length[9]|callback_is_group_exist');
        if ($this->form_validation->run() === FALSE)
        {
            $eror = $this->form_validation->error_array();
            $code['return'] = "10";
            echo json_encode(array_merge($code,$eror));
            exit;
        }
        else
        {
            $this->load->model('kelompok_model');
            $data = $this->kelompok_model->drop_member($kelompok_uuid,$member_kd);
            if ($data===true)
            {
                $code['return'] = "00"; // Accepted
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
    }

    public function get_all()
    {
        $this->load->model('kelompok_model');
        $data = $this->kelompok_model->get_all_kelompok();
        $this->data['all'] = $data;
    }

    public function get_detail($uuid)
    {
        $this->load->model('kelompok_model');
        $data = $this->kelompok_model->get_detail($uuid);
        $this->data[__FUNCTION__] = $data;
    }

    public function get_uuid_member($kelompok_id)
    {
        $this->load->model('kelompok_model');
        $data = $this->kelompok_model->get_kelompok_member($kelompok_id);
        $this->data[__FUNCTION__] = $data;
    }

    public function is_group_exist($uuid)
    {
        $this->load->model('kelompok_model');
        $data = $this->kelompok_model->check_uuid_exist($uuid);
        if ($data==true)
        {
            return true;
        }
        else
        {
            if ($this->load->is_loaded('Form_validation') != false)
            $this->form_validation->set_message(__FUNCTION__, 'The {field} value is not exist');
            return false;
        }
    }

    public function is_kelas_exist($uuid)
    {
        $this->load->model('kelas_model');
        $data = $this->kelas_model->check_uuid_exist($uuid);
        if ($data===true)
        {
            return true;
        }
        else
        {
            $this->form_validation->set_message(__FUNCTION__, 'The {field} value is not exist');
            return false;
        }
    }
}

/* End of file Kelompok.php */