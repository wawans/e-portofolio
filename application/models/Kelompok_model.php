<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kelompok_model extends CI_Model {
    private $kd_kelompok;
    private $kd_uuid;
    private $kd_user;
    public $nm_kelompok;
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

    private function gen_kd_kelompok()
    {
        $date = date('dym');
        $last = $this->db->select('kd_kelompok')
            ->distinct()
            ->like('kd_kelompok',$date,'after')
            ->order_by('kd_kelompok', 'DESC')
            ->limit(1)
            ->get('kelompok_ref');
        $this->kd_user = ($last->num_rows() < 1) ? $date.'000' : sprintf("%09d",($last->row()->kd_kelompok+1));
    }

    private function gen_kd_uuid()
    {
        $this->kd_uuid = $this->app->gen_uuid();
    }

    public function get_kd_kelompok($uuid)
    {
        return $this->db->select('kd_kelompok')
            ->where('kd_uuid',$uuid)
            ->limit(1)
            ->get('kelompok_ref')->row()->kd_kelompok;
    }

    public function check_uuid()
    {
        $query = $this->db->select('kd_uuid')->get_where('kelompok_ref',array('kd_uuid'=>$this->kd_uuid),1);
        return ($query->num_rows() > 0) ? true : false;
    }

    public function create()
    {
        $this->load->library('session');
        if (!$this->session->userdata('uuid')) exit;

        $this->load->model('user_model');
        $this->kd_user = $this->user_model->get_kd_user($this->session->userdata('uuid'));

        $this->maks = $this->input->post('maks');
        $this->nm_kelompok = $this->input->post('nama');
        $this->gen_kd_kelompok();
        $this->gen_kd_uuid();
        $ref = array(
            'kd_kelompok' => $this->kd_kelompok,
            'kd_uuid' => $this->kd_uuid,
            'kd_user' => $this->kd_user,
            'nm_kelompok' => $this->nm_kelompok,
            'maks' => $this->maks,
            'tgl_buat' => $this->today,
            'tgl_mod' => $this->today
        );
        $kelompok = array(
            'kd_kelompok' => $this->kd_kelompok,
            'kd_user' => $this->kd_user,
            'tgl_join' => $this->today
        );
        $this->db->trans_start();
        $this->db->insert('kelompok_ref',$ref);
        $this->db->insert('kelompok',$kelompok);
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
        $this->kd_kelompok = $this->get_kd_kelompok($this->kd_uuid);

        $query = $this->db->select('r.kd_kelompok')
            ->distinct()
            ->from('kelompok k')
            ->join('kelompok_ref r','r.kd_kelompok = k.kd_kelompok')
            ->where('r.kd_uuid',$this->kd_uuid)
            ->where('k.kd_user',$this->kd_user)
            ->limit(1)
        ;
        if ($query->num_rows() < 1)
        {
            $kelompok = array(
                'kd_kelompok' => $this->kd_kelompok,
                'kd_user' => $this->kd_user,
                'tgl_join' => $this->today
            );
            $this->db->insert('kelompok',$kelompok);
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

/* End of file Kelompok_model.php */