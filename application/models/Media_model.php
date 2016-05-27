<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Media_model extends CI_Model {
    protected $profile;
    protected $today;
    public $kd_media;
    public $kd_tugas;
    public $kd_user;
    public $tgl_unggah;
    public $filename;

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

    /**
     * @param mixed $filename
     */
    public function setFilename($filename)
    {
        $this->filename = $filename;
    }

    /**
     * @return mixed
     */
    public function getFilename()
    {
        return $this->filename;
    }

    /**
     * @param mixed $kd_media
     */
    public function setKdMedia($kd_media)
    {
        $this->kd_media = $kd_media;
    }

    /**
     * @return mixed
     */
    public function getKdMedia()
    {
        return $this->kd_media;
    }

    /**
     * @param mixed $kd_tugas
     */
    public function setKdTugas($kd_tugas)
    {
        $this->kd_tugas = $kd_tugas;
    }

    /**
     * @return mixed
     */
    public function getKdTugas()
    {
        return $this->kd_tugas;
    }

    /**
     * @param mixed $kd_user
     */
    public function setKdUser($kd_user)
    {
        $this->kd_user = $kd_user;
    }

    /**
     * @return mixed
     */
    public function getKdUser()
    {
        return $this->kd_user;
    }

    /**
     * @param mixed $profile
     */
    public function setProfile($profile)
    {
        $this->profile = $profile;
    }

    /**
     * @return mixed
     */
    public function getProfile()
    {
        return $this->profile;
    }

    /**
     * @param mixed $tgl_unggah
     */
    public function setTglUnggah($tgl_unggah)
    {
        $this->tgl_unggah = $tgl_unggah;
    }

    /**
     * @return mixed
     */
    public function getTglUnggah()
    {
        return $this->tgl_unggah;
    }

    /**
     * @param mixed $today
     */
    public function setToday($today)
    {
        $this->today = $today;
    }

    /**
     * @return mixed
     */
    public function getToday()
    {
        return $this->today;
    }

    private function gen_kd_media()
    {
        $date = date('myd');
        $last = $this->db->select('kd_media')
            ->distinct()
            ->like('kd_media',$date,'after')
            ->order_by('kd_media', 'DESC')
            ->limit(1)
            ->get('media');
        $kode = ($last->num_rows() < 1) ? $date.'000' : sprintf("%09d",($last->row()->kd_media+1));
        $this->setKdMedia($kode);
    }

    public function simpan($filename)
    {
        $this->gen_kd_media();
        $this->setKdTugas($this->getKdMedia());
        $this->setKdUser($this->getProfile()->kd_user);
        $this->setTglUnggah($this->getToday());
        $this->setFilename($filename);
        $this->db->trans_start();
        $this->db->insert('media',$this);
        $this->db->trans_complete();
        return $this->getKdMedia();
    }

    public function get_filename($file_id)
    {
        $last = $this->db->select('filename')
            ->where('kd_media',$file_id)
            ->limit(1)
            ->get('media');
        return ($last->num_rows() < 1) ? false : $last->row()->filename;
    }

    public function delete_file($file_id)
    {
        $this->db
            ->where('kd_media',$file_id)
            ->where('kd_user',$this->getProfile()->kd_user)
            ->delete('media');
        return true;
    }

}

/* End of file Media_model.php */