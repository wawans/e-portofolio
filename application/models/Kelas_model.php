<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kelas_model extends CI_Model {
    private $kd_kelas;
    private $kd_uuid;
    private $kd_user;
    public $nm_kelas;
    public $maks;
    public $tgl_buat;
    public $tgl_mod;
    public $tgl_join;
    public $act;
    public $ket;

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('app');
        $this->today = date('Y-m-d');
    }
    
    private function gen_kd_kelas()
    {
        $date = date('dym');
        $last = $this->db->select('kd_kelas')
            ->distinct()
            ->like('kd_kelas',$date,'after')
            ->order_by('kd_kelas', 'DESC')
            ->limit(1)
            ->get('kelas_ref');
        $this->kd_user = ($last->num_rows() < 1) ? $date.'000' : sprintf("%09d",($last->row()->kd_kelas+1));
    }
    
    private function gen_kd_uuid()
    {
        $this->kd_uuid = $this->app->gen_uuid();
    }

    public function get_kd_kelas($uuid)
    {
        return $this->db->select('kd_kelas')
            ->where('kd_uuid',$uuid)
            ->limit(1)
            ->get('kelas_ref')->row()->kd_kelas;
    }
    
    public function check_uuid()
    {
        $query = $this->db->select('kd_uuid')->get_where('kelas_ref',array('kd_uuid'=>$this->kd_uuid),1);
        return ($query->num_rows() > 0) ? true : false;        
    }
    
    public function create()
    {
        $this->load->library('session');        
        if (!$this->session->userdata('uuid')) exit;
        
        $this->load->model('user_model');        
        $this->kd_user = $this->user_model->get_kd_user($this->session->userdata('uuid'));
        
        $this->maks = $this->input->post('maks');
        $this->nm_kelas = $this->input->post('nama');
        $this->gen_kd_kelas();
        $this->gen_kd_uuid();
        $ref = array(
            'kd_kelas' => $this->kd_kelas,
            'kd_uuid' => $this->kd_uuid,
            'kd_user' => $this->kd_user,
            'nm_kelas' => $this->nm_kelas,
            'maks' => $this->maks,
            'tgl_buat' => $this->today,
            'tgl_mod' => $this->today
        );
        $kelas = array(
            'kd_kelas' => $this->kd_kelas,            
            'kd_user' => $this->kd_user,
            'tgl_join' => $this->today            
        );
        $this->db->trans_start();
        $this->db->insert('kelas_ref',$ref);
        $this->db->insert('kelas',$kelas);
        $this->db->trans_complete();
        return true;
    }

    public function join()
    {
        $this->load->library('session');
        if (!$this->session->userdata('uuid')) exit;

        $this->load->model('user_model');
        $this->kd_user = $this->user_model->get_kd_user($this->session->userdata('uuid'));
        
        $this->kd_uuid = $this->input->post('kode');
        if ($this->check_uuid() !== true)
        {
            return 'Invalid Code!';
        }
        $this->kd_kelas = $this->get_kd_kelas($this->kd_uuid);

        $query = $this->db->select('r.kd_kelas')
            ->distinct()
            ->from('kelas k')
            ->join('kelas_ref r','r.kd_kelas = k.kd_kelas')
            ->where('r.kd_uuid',$this->kd_uuid)
            ->where('k.kd_user',$this->kd_user)
            ->limit(1)
        ;
        if ($query->num_rows() < 1)
        {
            $kelas = array(
                'kd_kelas' => $this->kd_kelas,
                'kd_user' => $this->kd_user,
                'tgl_join' => $this->today
            );
            $this->db->insert('kelas',$kelas);
            return true;
        }
        else
        {
            return 'Anda Sudah Terdaftar!';
        }
    }

    public function update()
    {

    }

    public function drop()
    {

    }

    public function drop_member()
    {

    }
}

/* End of file Kelas_model.php */