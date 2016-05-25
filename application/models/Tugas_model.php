<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tugas_model extends CI_Model {
    protected $profile;

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('app');
        $this->load->library('session');
        $this->today = date('Y-m-d H:i:s');
        $this->load->model('user_model');
        $this->profile = $this->user_model->get_profil($this->session->uuid);
    }

    public function get_my_kelas_list()
    {
        return $this->db->get_where('kelas_ref',array('kd_user'=>$this->profile->kd_user))->result();
    }
}

/* End of file Tugas_model.php */