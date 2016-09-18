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
    public function getKdUuid()
    {
        return $this->kd_uuid;
    }

    /**
     * @param mixed $kd_uuid
     */
    public function setKdUuid($kd_uuid)
    {
        $this->kd_uuid = $kd_uuid;
    }

    /**
     * @return mixed
     */
    public function getKdKelas()
    {
        return $this->kd_kelas;
    }

    /**
     * @param mixed $kd_kelas
     */
    public function setKdKelas($kd_kelas)
    {
        $this->kd_kelas = $kd_kelas;
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
    public function getJudul()
    {
        return $this->judul;
    }

    /**
     * @param mixed $judul
     */
    public function setJudul($judul)
    {
        $this->judul = $judul;
    }

    /**
     * @return mixed
     */
    public function getKonten()
    {
        return $this->konten;
    }

    /**
     * @param mixed $konten
     */
    public function setKonten($konten)
    {
        $this->konten = $konten;
    }

    /**
     * @return mixed
     */
    public function getJnsGrup()
    {
        return $this->jns_grup;
    }

    /**
     * @param mixed $jns_grup
     */
    public function setJnsGrup($jns_grup)
    {
        $this->jns_grup = $jns_grup;
    }

    /**
     * @return mixed
     */
    public function getJnsNilai()
    {
        return $this->jns_nilai;
    }

    /**
     * @param mixed $jns_nilai
     */
    public function setJnsNilai($jns_nilai)
    {
        $this->jns_nilai = $jns_nilai;
    }

    /**
     * @return int
     */
    public function getLampiran()
    {
        return $this->lampiran;
    }

    /**
     * @param int $lampiran
     */
    public function setLampiran($lampiran)
    {
        $this->lampiran = $lampiran;
    }

    /**
     * @return mixed
     */
    public function getTglAwal()
    {
        return $this->tgl_awal;
    }

    /**
     * @param mixed $tgl_awal
     */
    public function setTglAwal($tgl_awal)
    {
        $this->tgl_awal = $tgl_awal;
    }

    /**
     * @return mixed
     */
    public function getTglAkhir()
    {
        return $this->tgl_akhir;
    }

    /**
     * @param mixed $tgl_akhir
     */
    public function setTglAkhir($tgl_akhir)
    {
        $this->tgl_akhir = $tgl_akhir;
    }

    /**
     * @return mixed
     */
    public function getTglBuat()
    {
        return $this->tgl_buat;
    }

    /**
     * @param mixed $tgl_buat
     */
    public function setTglBuat($tgl_buat)
    {
        $this->tgl_buat = $tgl_buat;
    }

    /**
     * @return mixed
     */
    public function getTglMod()
    {
        return $this->tgl_mod;
    }

    /**
     * @param mixed $tgl_mod
     */
    public function setTglMod($tgl_mod)
    {
        $this->tgl_mod = $tgl_mod;
    }

    /**
     * @return int
     */
    public function getAct()
    {
        return $this->act;
    }

    /**
     * @param int $act
     */
    public function setAct($act)
    {
        $this->act = $act;
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
    public function is_kelas_exist($kelas_uuid)
    {
        $query = $this->db->select('kd_uuid')->get_where('kelas_ref',array('kd_uuid'=>$kelas_uuid),1);
        return ($query->num_rows() > 0) ? true : false;
    }

    /**
     * @param $tugas_uuid
     * @return bool
     */
    public function is_tugas_exist($tugas_uuid)
    {
        $query = $this->db->select('kd_uuid')->get_where('tugas_ref',array('kd_uuid'=>$tugas_uuid),1);
        return ($query->num_rows() > 0) ? true : false;
    }

    public function is_user_submited($kd_tugas,$kd_user)
    {
        $query = $this->db->select('kd_tugas')->get_where('tugas',array('kd_tugas'=>$kd_tugas,'kd_user'=>$kd_user),1);
        return ($query->num_rows() > 0) ? true : false;
    }

    public function get_kd_tugas($tugas_uuid)
    {
        return $this->db->select('kd_tugas')
            ->where('kd_uuid',$tugas_uuid)
            ->limit(1)
            ->get('tugas_ref')->row()->kd_tugas;
    }
    public function baru($kelas_uuid)
    {
        if (!$this->is_kelas_exist($kelas_uuid)) return 'Error!';
        $file = 0;
        $this->gen_kd_tugas();
        $this->gen_kd_uuid();
        $this->load->model('kelas_model');
        $this->load->model('media_model');
        $this->kd_kelas = $this->kelas_model->get_kd_kelas($kelas_uuid);
        $this->kd_user = $this->profile->kd_user;
        $this->judul = $this->input->post('judul');
        $this->konten = $this->input->post('konten');
        $this->jns_grup = $this->input->post('jns_grup');
        $this->jns_nilai = $this->input->post('jns_nilai');
        $this->tgl_awal = $this->input->post('tgl_awal');
        $this->tgl_akhir = $this->input->post('tgl_ahir',false).' 23:59:59';
        $this->act = $this->input->post('publik');
        $this->tgl_buat = $this->today;
        $this->tgl_mod = $this->today;
        $lmap = $this->input->post('filelist');
        $this->db->trans_start();
        if (isset($lmap))
        {
            $impl = explode(',',$lmap);
            foreach ($impl as $filename)
            {
                if ($filename != '')
                {
                    $this->media_model->simpan($filename,$this->getKdTugas());
                    $file++;
                }
            }
        }
        $this->setLampiran($file);
        $this->db->insert('tugas_ref',$this);
        $this->db->trans_complete();
        return array('msg'=>'ok', 'kode'=>$this->getKdTugas());
    }

    public function daftar_tugas($kelas_uuid)
    {
        if (!$this->is_kelas_exist($kelas_uuid)) return 'Error!';
        $this->load->model('kelas_model');
        $this->kd_kelas = $this->kelas_model->get_kd_kelas($kelas_uuid);
        return $this->db->select('tugas_ref.kd_tugas,
tugas_ref.kd_uuid,
tugas_ref.kd_kelas,
tugas_ref.kd_user,
tugas_ref.judul,
tugas_ref.konten,
tugas_ref.jns_grup,
tugas_ref.jns_nilai,
tugas_ref.lampiran,
tugas_ref.tgl_awal,
tugas_ref.tgl_akhir,
tugas_ref.tgl_buat,
tugas_ref.tgl_mod,
tugas_ref.act,
GROUP_CONCAT(
media.filename) filename')
            ->where('kd_kelas',$this->kd_kelas)
            ->where('act','1')
            ->join('media','media.kd_tugas = tugas_ref.kd_tugas','left')
            ->order_by('tgl_mod', 'DESC')
            ->group_by(array("tugas_ref.kd_tugas","tugas_ref.kd_uuid","tugas_ref.kd_kelas","tugas_ref.kd_user","tugas_ref.judul","tugas_ref.konten","tugas_ref.jns_grup","tugas_ref.jns_nilai","tugas_ref.lampiran","tugas_ref.tgl_awal","tugas_ref.tgl_akhir","tugas_ref.tgl_buat","tugas_ref.tgl_mod","tugas_ref.act"
            ))
            ->get('tugas_ref')
            ->result();
    }

    public function detail_tugas($tugas_uuid)
    {
        if (!$this->is_tugas_exist($tugas_uuid)) return 'Error!';
        $this->setKdUuid($tugas_uuid);
        return $this->db->where('kd_uuid',$this->getKdUuid())
            ->get('tugas_ref')
            ->row();
    }

    public function join($tugas_uuid)
    {
        if (!$this->is_tugas_exist($tugas_uuid)) return 'Error!';
        $this->kd_tugas = $this->get_kd_tugas($tugas_uuid);
        if ($this->is_user_submited($this->kd_tugas,$this->profile->kd_user)) return 'Sudah Dikerjakan';
        $insert = array(
            'kd_tugas' => $this->kd_tugas,
            'kd_user' => $this->profile->kd_user,
            'tanggal' => $this->today
        );
        $this->db->trans_start();
        $this->db->insert('tugas',$insert);
        $this->db->trans_complete();
        return true;
    }

    public function join_out($kd_tugas)
    {
        if ($this->is_user_submited($kd_tugas,$this->profile->kd_user))
        {
        $this->db->trans_start();
        $this->db->where('kd_tugas',$kd_tugas)
            ->where('kd_user',$this->profile->kd_user)
            ->delete('tugas');
        $this->db->trans_complete();
        }
        return true;
    }


}

/* End of file Tugas_model.php */