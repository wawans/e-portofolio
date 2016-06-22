<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Nilai_model extends CI_Model {
    protected $profile;
    protected $today;
    public $kd_nilai;
    public $kd_tugas;
    public $kd_user;
    public $kd_penilai;
    public $sikap;
    public $pengetahuan;
    public $ketrampilan;
    public $waktu;
    public $presentasi;
    public $tgl_nilai;

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
     * @return mixed
     */
    public function getKdNilai()
    {
        return $this->kd_nilai;
    }

    /**
     * @param mixed $kd_nilai
     */
    public function setKdNilai($kd_nilai)
    {
        $this->kd_nilai = $kd_nilai;
    }

    /**
     * @return mixed
     */
    public function getKdPenilai()
    {
        return $this->kd_penilai;
    }

    /**
     * @param mixed $kd_penilai
     */
    public function setKdPenilai($kd_penilai)
    {
        $this->kd_penilai = $kd_penilai;
    }

    /**
     * @return mixed
     */
    public function getKdTugas()
    {
        return $this->kd_tugas;
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
    public function getKdUser()
    {
        return $this->kd_user;
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
    public function getKetrampilan()
    {
        return $this->ketrampilan;
    }

    /**
     * @param mixed $ketrampilan
     */
    public function setKetrampilan($ketrampilan)
    {
        $this->ketrampilan = $ketrampilan;
    }

    /**
     * @return mixed
     */
    public function getPengetahuan()
    {
        return $this->pengetahuan;
    }

    /**
     * @param mixed $pengetahuan
     */
    public function setPengetahuan($pengetahuan)
    {
        $this->pengetahuan = $pengetahuan;
    }

    /**
     * @return mixed
     */
    public function getPresentasi()
    {
        return $this->presentasi;
    }

    /**
     * @param mixed $presentasi
     */
    public function setPresentasi($presentasi)
    {
        $this->presentasi = $presentasi;
    }

    /**
     * @return mixed
     */
    public function getProfile()
    {
        return $this->profile;
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
    public function getSikap()
    {
        return $this->sikap;
    }

    /**
     * @param mixed $sikap
     */
    public function setSikap($sikap)
    {
        $this->sikap = $sikap;
    }

    /**
     * @return mixed
     */
    public function getTglNilai()
    {
        return $this->tgl_nilai;
    }

    /**
     * @param mixed $tgl_nilai
     */
    public function setTglNilai($tgl_nilai)
    {
        $this->tgl_nilai = $tgl_nilai;
    }

    /**
     * @return bool|string
     */
    public function getToday()
    {
        return $this->today;
    }

    /**
     * @param bool|string $today
     */
    public function setToday($today)
    {
        $this->today = $today;
    }

    /**
     * @return mixed
     */
    public function getWaktu()
    {
        return $this->waktu;
    }

    /**
     * @param mixed $waktu
     */
    public function setWaktu($waktu)
    {
        $this->waktu = $waktu;
    }


    private function gen_kd_nilai()
    {
        $date = date('ymd');
        $last = $this->db->select('kd_nilai')
            ->distinct()
            ->like('kd_nilai',$date,'after')
            ->order_by('kd_nilai', 'DESC')
            ->limit(1)
            ->get('nilai');
        $kode = ($last->num_rows() < 1) ? $date.'000' : sprintf("%09d",($last->row()->kd_nilai+1));
        $this->setKdNilai($kode);
    }

    private function is_user_exist($user_uuid)
    {
        $query = $this->db->select('kd_uuid')->get_where('user',array('kd_uuid'=>$user_uuid),1);
        return ($query->num_rows() > 0) ? true : false;
    }

    /**
     * @param $tugas_uuid
     * @return bool
     */
    private function is_tugas_exist($tugas_uuid)
    {
        $query = $this->db->select('kd_uuid')->get_where('tugas_ref',array('kd_uuid'=>$tugas_uuid),1);
        return ($query->num_rows() > 0) ? true : false;
    }

    private function is_user_ternilai($kd_tugas,$kd_user,$kd_penilai)
    {
        $query = $this->db->select('kd_nilai')->get_where('nilai',array('kd_tugas'=>$kd_tugas,'kd_user'=>$kd_user,'kd_penilai'=>$kd_penilai),1);
        return ($query->num_rows() > 0) ? true : false;
    }

    public function menilai($tugas_uuid,$user_uuid)
    {
        // cek kode tugas benar ada;
        if (!$this->is_tugas_exist($tugas_uuid)) return 'Tugas tidak ditemukan';
        // cek kode user benar ada;
        if (!$this->is_user_exist($user_uuid)) return 'User tidak ditemukan';

        $this->load->model('tugas_model');

        $this->setKdTugas($this->tugas_model->get_kd_tugas($tugas_uuid));
        $this->setKdUser($this->user_model->get_kd_user($user_uuid));
        // CEK USER SUDAH MENGERJAKAN / BELUM
        if ($this->db->select('kd_tugas')->get_where('tugas',array('kd_user'=>$this->getKdUser()),1)->num_rows() < 1)
            return 'Belum Dikerjakan oleh user yang dinilai';
        // cek kode tugas sudah pernah di nilai
        $this->setKdPenilai($this->profile->kd_user);
        if ($this->is_user_ternilai($this->getKdTugas(),$this->getKdUser(),$this->getKdPenilai()))
            return 'Anda Sudah Menilai User Ini!';

        $this->setTglNilai($this->getToday());
        $this->setSikap($this->input->post('jns_nilai'));
        $this->setPengetahuan($this->input->post('jns_nilai'));
        $this->setKetrampilan($this->input->post('jns_nilai'));
        $this->setPresentasi($this->input->post('jns_nilai'));
        // menilai waktu
        $this->setWaktu($this->db->select('(
(DATEDIFF(tugas_ref.tgl_akhir,tugas.tanggal)+1)/
(DATEDIFF(tugas_ref.tgl_akhir,
tugas_ref.tgl_awal)+1))*100 AS SKOR')->join('tugas','tugas_ref.kd_tugas = tugas.kd_tugas')
        ->where('tugas_ref.kd_tugas',$this->getKdTugas())
        ->where('tugas.kd_user',$this->getKdUser())
        ->get('tugas_ref')
        ->row()->SKOR
        );
        // NO ERROR, Simpan.
        $this->gen_kd_nilai();
        $this->db->trans_start();
        $this->db->insert('nilai',$this);
        $this->db->trans_complete();
        return array('msg'=>'ok');
    }

}

/* End of file Nilai_model.php */