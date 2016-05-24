<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kelompok_model extends CI_Model {
    private $kd_kelompok;
    private $kd_uuid;
    private $kd_kelas;
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
        $this->kd_kelompok = ($last->num_rows() < 1) ? $date.'000' : sprintf("%09d",($last->row()->kd_kelompok+1));
    }

    private function gen_kd_uuid()
    {
        $this->kd_uuid = $this->app->gen_uuid();
    }

    public function get_all()
    {
        return $this->db->select('kelas_ref.kd_uuid,
kelas_ref.nm_kelas,
kelompok_ref.kd_uuid kl_uuid,
kelompok_ref.nm_kelompok,
klm.cnt,
IFNULL(kelompok_ref.maks,0) maks,
`profile`.nm_awal,
`profile`.nm_akhir')
            ->distinct()
            ->from('kelas_ref')
            ->join('kelompok_ref','kelas_ref.kd_kelas = kelompok_ref.kd_kelas','left')
            ->join('profile','kelompok_ref.kd_user = profile.kd_user','left')
            ->join('(SELECT
klk.kd_kelompok AS kd_pok,
klk.kd_kelas AS kd_las,
Count(klk.kd_user) AS cnt
FROM
kelompok AS klk
GROUP BY
klk.kd_kelompok,
klk.kd_kelas
) klm','klm.kd_pok = kelompok_ref.kd_kelompok','left')
            ->get()->result();
    }

    public function get_all_kelompok()
    {
        return $this->db->select('kelas_ref.kd_uuid,
kelas_ref.nm_kelas,
kelompok_ref.kd_uuid kl_uuid,
kelompok_ref.nm_kelompok,
klm.cnt,
IFNULL(kelompok_ref.maks,0) maks,
`profile`.nm_awal,
`profile`.nm_akhir')
            ->distinct()
            ->from('kelas_ref')
            ->join('kelompok_ref','kelas_ref.kd_kelas = kelompok_ref.kd_kelas')
            ->join('profile','kelompok_ref.kd_user = profile.kd_user')
            ->join('(SELECT
klk.kd_kelompok AS kd_pok,
klk.kd_kelas AS kd_las,
Count(klk.kd_user) AS cnt
FROM
kelompok AS klk
GROUP BY
klk.kd_kelompok,
klk.kd_kelas
) klm','klm.kd_pok = kelompok_ref.kd_kelompok')
            ->get()->result();
    }

    public function get_kd_kelompok($uuid)
    {
        return $this->db->select('kd_kelompok')
            ->where('kd_uuid',$uuid)
            ->limit(1)
            ->get('kelompok_ref')->row()->kd_kelompok;
    }

    public function get_kd_kelas($uuid)
    {
        return $this->db->select('kd_kelas')
            ->where('kd_uuid',$uuid)
            ->limit(1)
            ->get('kelompok_ref')->row()->kd_kelas;
    }

    public function check_uuid()
    {
        $query = $this->db->select('kd_uuid')->get_where('kelompok_ref',array('kd_uuid'=>$this->kd_uuid),1);
        return ($query->num_rows() > 0) ? true : false;
    }

    public function check_uuid_exist($uuid)
    {
        $this->kd_uuid = $uuid;
        return $this->check_uuid();
    }

    public function get_kelompok_kelas($kelas_uuid)
    {

    }

    public function create($kelas_uuid=null)
    {
        $kelas_uuid = (!isset($kelas_uuid)) ? $this->input->post('kelas') : $kelas_uuid;

        $this->load->library('session');
        if (!$this->session->has_userdata('uuid')) exit;

        $this->load->model('user_model');
        $this->kd_user = $this->user_model->get_kd_user($this->session->uuid);

        $this->load->model('kelas_model');
        $this->kd_kelas = $this->kelas_model->get_kd_kelas($kelas_uuid);
        if ($this->kelas_model->is_joined($this->kd_kelas,$this->kd_user) !== true)
        {
            return 'Anda Tidak Terdaftar Anggota Kelas!';
        }
        if ($this->is_joined($this->kd_kelas,$this->kd_user) == true)
        {
            return 'Anda Sudah Memiliki Kelompok!';
        }
        $this->maks = $this->input->post('maks');
        $this->nm_kelompok = $this->input->post('nama');
        $this->gen_kd_kelompok();
        $this->gen_kd_uuid();
        $ref = array(
            'kd_kelompok' => $this->kd_kelompok,
            'kd_uuid' => $this->kd_uuid,
            'kd_kelas' => $this->kd_kelas,
            'kd_user' => $this->kd_user,
            'nm_kelompok' => $this->nm_kelompok,
            'maks' => $this->maks,
            'tgl_buat' => $this->today,
            'tgl_mod' => $this->today
        );
        $kelompok = array(
            'kd_kelompok' => $this->kd_kelompok,
            'kd_kelas' => $this->kd_kelas,
            'kd_user' => $this->kd_user,
            'tgl_join' => $this->today
        );
        $this->db->trans_start();
        $this->db->insert('kelompok_ref',$ref);
        $this->db->insert('kelompok',$kelompok);
        $this->db->trans_complete();
        return array(
            'msg' => 'ok',
            'uuid' => $this->kd_uuid
        );
    }

    private function common_init($kelompok_uuid=null)
    {
        $this->load->library('session');
        if (!$this->session->has_userdata('uuid')) exit('Please, Login To Continue.');

        $this->load->model('user_model');
        $this->kd_user = $this->user_model->get_kd_user($this->session->uuid);

        $this->kd_uuid = (isset($kelompok_uuid)) ? $kelompok_uuid : $this->input->post('kode');
        if ($this->check_uuid() !== true)
        {
            return 'Invalid Code!';
        }
        $this->kd_kelompok = $this->get_kd_kelompok($this->kd_uuid);
        $this->kd_kelas = $this->get_kd_kelas($this->kd_uuid);
    }

    // joinable jika ada kuota sisa;
    public function is_joinable($kelompok_uuid)
    {

    }

    public function is_joined($kd_kelas,$kd_user)
    {
        $query = $this->db->select('kd_kelompok')
            ->from('kelompok')
            ->where('kd_kelas',$kd_kelas)
            ->where('kd_user',$kd_user)
            ->get();
        return ($query->num_rows() > 0) ? true : false;
    }

    public function join($kelompok_uuid=null)
    {
        $this->common_init($kelompok_uuid);
        $this->load->model('kelas_model');
        if ($this->kelas_model->is_joined($this->kd_kelas,$this->kd_user) !== true)
        {
            return 'Anda Tidak Terdaftar Anggota Kelas!';
        }
        if ($this->is_joined($this->kd_kelas,$this->kd_user))
        {
            return 'Anda Sudah Memiliki Kelompok!';
        }
        $query = $this->db->select('r.kd_kelompok')
            ->distinct()
            ->from('kelompok k')
            ->join('kelompok_ref r','r.kd_kelompok = k.kd_kelompok')
            ->where('r.kd_uuid',$this->kd_uuid)
            ->where('k.kd_user',$this->kd_user)
            ->limit(1)
            ->get();
        if ($query->num_rows() < 1)
        {
            $kelompok = array(
                'kd_kelompok' => $this->kd_kelompok,
                'kd_kelas' => $this->kd_kelas,
                'kd_user' => $this->kd_user,
                'tgl_join' => $this->today
            );
            $this->db->insert('kelompok',$kelompok);
            return true;
        }
        else
        {
            return 'Anda Sudah Menjadi Anggota!';
        }
    }

    public function join_out($kelompok_uuid=null)
    {
        $this->common_init($kelompok_uuid);

        $query = $this->db->select('kd_kelompok')
            ->distinct()
            ->from('kelompok_ref')
            ->where('kd_kelompok',$this->kd_kelompok)
            ->where('kd_user',$this->kd_user)
            ->limit(1)
            ->get();

        if ($query->num_rows() < 1)
        {
            $query = $this->db->select('kd_kelompok')
                ->distinct()
                ->from('kelompok')
                ->where('kd_kelompok',$this->kd_kelompok)
                ->where('kd_user',$this->kd_user)
                ->limit(1)
                ->get();
            if ($query->num_rows() > 0)
            {
                $this->db
                    ->where('kd_kelompok',$this->kd_kelompok)
                    ->where('kd_user',$this->kd_user)
                    ->delete('kelompok');
                return true;
            }
            else
            {
                return 'Anda Tidak Terdaftar di Kelompok Ini!';
            }
        }
        else
        {
            return 'Gagal! Kelompok Ini Butuh Anda (Owner)!';
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