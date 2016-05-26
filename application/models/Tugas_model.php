<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tugas_model extends CI_Model {
    protected $profile;
    protected $today;
    public $kd_tugas;
    public $kd_uuid;
    public $kd_kelas;
    public $kd_user;
    public $judul;
    public $konten;
    public $jns_grup;
    public $jns_nilai;
    public $lampiran = 0;
    public $tgl_awal;
    public $tgl_akhir;
    public $tgl_buat;
    public $tgl_mod;
    public $act = 1;

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library(array('app','session'));
        $this->today = date('Y-m-d H:i:s');

        if (!$this->session->has_userdata('uuid')) exit('Error : Unexpected System Error!');

        $this->load->model('user_model');
        $this->profile = $this->user_model->get_profil($this->session->uuid);
    }

    private function gen_kd_tugas()
    {
        $date = date('dym');
        $last = $this->db->select('kd_tugas')
            ->distinct()
            ->like('kd_tugas',$date,'after')
            ->order_by('kd_tugas', 'DESC')
            ->limit(1)
            ->get('tugas_ref');
        $this->kd_tugas = ($last->num_rows() < 1) ? $date.'000' : sprintf("%09d",($last->row()->kd_tugas+1));
    }

    private function gen_kd_uuid()
    {
        $this->kd_uuid = $this->app->gen_uuid();
    }

    /**
     * @param $kelas_uuid
     * @return bool
     */
    private function is_kelas_exist($kelas_uuid)
    {
        $query = $this->db->select('kd_uuid')->get_where('kelas_ref',array('kd_uuid'=>$kelas_uuid),1);
        return ($query->num_rows() > 0) ? true : false;
    }

    public function baru($kelas_uuid)
    {
        if (!$this->is_kelas_exist($kelas_uuid)) return 'Error!';
        $this->gen_kd_tugas();
        $this->gen_kd_uuid();
        $this->load->model('kelas_model');
        $this->kd_kelas = $this->kelas_model->get_kd_kelas($kelas_uuid);
        $this->kd_user = $this->profile->kd_user;
        $this->judul = $this->input->post('judul');
        $this->konten = $this->input->post('konten');
        $this->jns_grup = $this->input->post('jns_grup');
        $this->jns_nilai = $this->input->post('jns_nilai');
        $this->tgl_awal = $this->input->post('tgl_awal');
        $this->tgl_akhir = $this->input->post('tgl_ahir').' 23:59:59';
        $this->act = $this->input->post('publik');
        $this->tgl_buat = $this->today;
        $this->tgl_mod = $this->today;
        $this->db->trans_start();
        $this->db->insert('tugas_ref',$this);
        $this->db->trans_complete();
        return true;
    }
}

/* End of file Tugas_model.php */