<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kelompok_model extends CI_Model {
    protected $profile;
    protected $today;
    public $kd_kelompok;
    public $kd_uuid;
    public $kd_kelas;
    public $kd_user;
    public $nm_kelompok;
    public $maks;
    public $tgl_buat;
    public $tgl_mod;

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
        $this->today = date('Y-m-d');
        $this->load->model('user_model');
        $this->profile = $this->user_model->get_profil($this->session->uuid);
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
    public function getKdKelas()
    {
        return $this->kd_kelas;
    }

    /**
     * @param mixed $kd_kelompok
     */
    public function setKdKelompok($kd_kelompok)
    {
        $this->kd_kelompok = $kd_kelompok;
    }

    /**
     * @return mixed
     */
    public function getKdKelompok()
    {
        return $this->kd_kelompok;
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
     * @param mixed $kd_uuid
     */
    public function setKdUuid($kd_uuid)
    {
        $this->kd_uuid = $kd_uuid;
    }

    /**
     * @return mixed
     */
    public function getKdUuid()
    {
        return $this->kd_uuid;
    }

    /**
     * @param mixed $maks
     */
    public function setMaks($maks)
    {
        $this->maks = $maks;
    }

    /**
     * @return mixed
     */
    public function getMaks()
    {
        return $this->maks;
    }

    /**
     * @param mixed $nm_kelompok
     */
    public function setNmKelompok($nm_kelompok)
    {
        $this->nm_kelompok = $nm_kelompok;
    }

    /**
     * @return mixed
     */
    public function getNmKelompok()
    {
        return $this->nm_kelompok;
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
    public function getTglBuat()
    {
        return $this->tgl_buat;
    }

    /**
     * @param mixed $tgl_mod
     */
    public function setTglMod($tgl_mod)
    {
        $this->tgl_mod = $tgl_mod;
    }

    /**
     * @return mixed
     */
    public function getTglMod()
    {
        return $this->tgl_mod;
    }

    private function gen_kd_uuid()
    {
        $this->load->library('app');
        $this->setKdUuid($this->app->gen_uuid());
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
        $gen = ($last->num_rows() < 1) ? $date.'000' : sprintf("%09d",($last->row()->kd_kelompok+1));
        $this->setKdKelompok($gen);
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

    public function get_detail($uuid)
    {
        return $this->db->select('kelompok_ref.kd_kelompok,
kelompok_ref.kd_uuid,
kelompok_ref.kd_kelas,
kelas_ref.nm_kelas,
kelas_ref.kd_uuid kelas_uuid,
kelompok_ref.kd_user,
kelompok_ref.nm_kelompok,
kelompok_ref.maks,
`profile`.nm_awal,
`profile`.nm_akhir,
            klm.cnt')
            ->distinct()
            ->from('kelompok_ref')
            ->join('kelas_ref','kelas_ref.kd_kelas = kelompok_ref.kd_kelas')
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
            ) klm','klm.kd_pok = kelompok_ref.kd_kelompok','left')
            ->where('kelompok_ref.kd_uuid',$uuid)
            ->get()->row();
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

    public function get_kelompok_kelas($kelas_uuid)
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
            ->where('kelas_ref.kd_uuid',$kelas_uuid)
            ->get()->result();
    }

    public function get_kelompok_member($kelompok_uuid)
    {
        return $this->db->select('kelompok_ref.kd_kelompok,
kelompok_ref.nm_kelompok,
kelompok.kd_kelas,
kelompok.kd_user,
`profile`.nm_awal,
`profile`.nm_akhir,
kelompok.act,
kelompok.tgl_join')
            ->distinct()
            ->from('kelompok_ref')
            ->join('kelompok','kelompok_ref.kd_kelompok = kelompok.kd_kelompok')
            ->join('profile','kelompok.kd_user = profile.kd_user')
            ->where('kelompok_ref.kd_uuid',$kelompok_uuid)
        ->order_by('`profile`.nm_awal ASC, `profile`.nm_akhir ASC')
            ->get()->result();
    }

    public function create()
    {
        if (!$this->session->has_userdata('uuid')) exit('Error : Unexpected System Error!');
        $this->load->model('kelas_model');
        $kelas_uuid = $this->input->post('kelas');
        if ($this->kelas_model->check_uuid_exist($kelas_uuid) !=  true)
            return 'Kelas Tidak Ada';

        $this->setKdKelas($this->kelas_model->get_kd_kelas($kelas_uuid));
        $this->setKdUser($this->profile->kd_user);
        if ($this->kelas_model->is_joined($this->getKdKelas(),$this->getKdUser()) != true)
            return 'Anda Tidak Terdaftar Anggota Kelas!';

        if ($this->has_group($this->getKdKelas(),$this->getKdUser()) == true)
            return 'Anda Sudah Memiliki Kelompok';

        $this->setNmKelompok($this->input->post('nama'));
        $this->setMaks($this->input->post('maks'));
        $this->setTglBuat($this->today);
        $this->setTglMod($this->today);
        // generate
        $this->gen_kd_uuid();
        $this->gen_kd_kelompok();

        $data = array(
            'kd_kelompok' => $this->getKdKelompok(),
            'kd_kelas' => $this->getKdKelas(),
            'kd_user' => $this->getKdUser(),
            'act' => 1,
            'tgl_join' => $this->today
        );
        $this->db->trans_start();
        $this->db->insert('kelompok_ref',$this);
        $this->db->insert('kelompok',$data);
        $this->db->trans_complete();
        return array(
            'msg' => 'ok',
            'uuid' => $this->getKdUuid()
        );
    }

    public function join()
    {
        /*
         * - cek login
         * - cek kode uuid kelompok
         * - cek kuota
         * - cek sudah punya kelompok
         * - cek terdaftar dalam kelas dari kelompok tsb.
         * - cek sudah bergabung dengan kelompok tsb.*
         * insert.
         */
        if (!$this->session->has_userdata('uuid')) exit('Error : Unexpected System Error!');
        $kd_uuid = $this->input->post('kode');
        if ($this->check_uuid_exist($kd_uuid) != true)
            return 'Kelompok Tidak Ada';
        $select = $this->db->get_where('kelompok_ref',array('kd_uuid'=>$kd_uuid),1)->row();
        $this->setKdKelompok($select->kd_kelompok);
        $this->setKdKelas($select->kd_kelas);
        $this->setKdUser($this->profile->kd_user);
        $this->load->model('kelas_model');
        if ($this->kelas_model->is_joined($this->getKdKelas(),$this->getKdUser()) != true)
            return 'Anda Tidak Terdaftar Anggota Kelas!';

        if ($this->has_group($this->getKdKelas(),$this->getKdUser()) == true)
            return 'Anda Sudah Memiliki Kelompok';

        if ($this->has_quota($this->getKdKelompok()) != true)
            return 'Anggota Kelompok Maksimal';

        $data = array(
            'kd_kelompok' => $this->getKdKelompok(),
            'kd_kelas' => $this->getKdKelas(),
            'kd_user' => $this->getKdUser(),
            'act' => 1, // atau 0 biar di approve dulu
            'tgl_join' => $this->today
        );
        $this->db->trans_start();
        $this->db->insert('kelompok',$data);
        $this->db->trans_complete();
        return true;
    }

    public function join_out($kelompok_uuid)
    {
        if (!$this->session->has_userdata('uuid')) exit('Error : Unexpected System Error!');
        if ($this->check_uuid_exist($kelompok_uuid) != true)
            return 'Kelompok Tidak Ada';
        $this->setKdUuid($kelompok_uuid);
        $this->setKdUser($this->profile->kd_user);
        $quee = $this->db->select('kd_kelompok')
            ->distinct()
            ->where('kd_uuid',$this->getKdUuid())
            ->where('kd_user',$this->getKdUser())
            ->limit(1)
            ->get('kelompok_ref');

        if ($quee->num_rows() < 1)
        {
            $detail = $this->get_detail($kelompok_uuid);
            $this->setKdKelompok($detail->kd_kelompok);
            $query = $this->db->select('kd_kelompok')
                ->distinct()
                ->from('kelompok')
                ->where('kd_kelompok',$this->getKdKelompok())
                ->where('kd_user',$this->getKdUser())
                ->limit(1)
                ->get();
            if ($query->num_rows() > 0)
            {
                $this->db
                    ->where('kd_kelompok',$this->getKdKelompok())
                    ->where('kd_user',$this->getKdUser())
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

    public function drop($kelompok_uuid)
    {
        if (!$this->session->has_userdata('uuid')) exit('Error : Unexpected System Error!');
        if ($this->check_uuid_exist($kelompok_uuid) != true)
            return 'Kelompok Tidak Ada';
        $this->setKdUuid($kelompok_uuid);
        $this->setKdUser($this->profile->kd_user);

        $detail = $this->get_detail($kelompok_uuid);

        $query = $this->db->select('count(kd_user) ada')
            ->from('kelompok')
            ->where('kd_kelompok',$detail->kd_kelompok)
            ->get();
        if ($query->row()->ada < 2) {
            $query = $this->db->select('kd_kelompok')
                ->distinct()
                ->from('kelompok_ref')
                ->where('kd_uuid',$this->getKdUuid())
                ->where('kd_user',$this->getKdUser())
                ->limit(1)
                ->get();
            if ($query->num_rows() > 0)
            {
                $this->db
                    ->where('kd_kelompok',$detail->kd_kelompok)
                    ->delete(array('kelompok','kelompok_ref'));
                return true;
            }
            else
            {
                return 'Anda Bukan Pemilik kelompok!';
            }
        }
        else
        {
            return 'Fatal Hapus kelompok Yg Memiliki Anggota';
        }
    }

    public function drop_member($kelompok_uuid,$member_kd)
    {
        /*
         * - cek author 3
         * - cek user is member 4
         * - user login 1
         * - uuid ada 2
         */
        if (!$this->session->has_userdata('uuid')) exit('Error : Unexpected System Error!');
        if ($this->check_uuid_exist($kelompok_uuid) != true)
            return 'Kelompok Tidak Ada';
        $this->setKdUuid($kelompok_uuid);
        $this->setKdUser($this->profile->kd_user);

        $query0 = $this->db->select('kd_kelompok')
            ->distinct()
            ->from('kelompok_ref')
            ->where('kd_uuid',$this->getKdUuid())
            ->where('kd_user',$this->getKdUser())
            ->limit(1)
            ->get();

        if ($query0->num_rows() > 0)
        {
            if ($this->getKdUser() == $member_kd)
                return 'User Selain Anda!.';

            $query = $this->db->select('kd_kelompok')
                ->distinct()
                ->from('kelompok')
                ->where('kd_kelompok',$query0->row()->kd_kelompok)
                ->where('kd_user',$member_kd)
                ->limit(1)
                ->get();
            if ($query->num_rows() > 0)
            {
                $this->db
                    ->where('kd_kelompok',$query0->row()->kd_kelompok)
                    ->where('kd_user',$member_kd)
                    ->delete('kelompok');
                return true;
            }
            else
            {
                return 'User Tidak Terdaftar di Kelompok Ini!';
            }
        }
        else
        {
            return 'Gagal! Anda Bukan Admin Kelompok Ini!';
        }
    }

    public function has_group($kd_kelas,$kd_user)
    {
        $query = $this->db->select('kd_kelompok')
            ->from('kelompok')
            ->where('kd_kelas',$kd_kelas)
            ->where('kd_user',$kd_user)
            ->get();
        return ($query->num_rows() > 0) ? true : false;
    }

    public function has_quota($kd_kelompok)
    {
        $query = $this->db->select('kelompok_ref.maks, Count(kelompok.kd_user) cnt')
            ->from('kelompok_ref ,kelompok')
            ->where('kelompok_ref.kd_kelompok',$kd_kelompok)
            ->group_by('kelompok_ref.maks')
            ->get()->row();
        return ($query->cnt < $query->maks) ? true : false;
    }

}

/* End of file Kelompok_model.php */