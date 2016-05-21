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
        $this->kd_kelas = ($last->num_rows() < 1) ? $date.'000' : sprintf("%09d",($last->row()->kd_kelas+1));
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

    public function check_uuid_exist($uuid)
    {
        $this->kd_uuid = $uuid;
        return $this->check_uuid();
    }

    public function get_all()
    {
        return $this->db->select('kelas_ref.kd_kelas,
        kelas_ref.kd_uuid,
        kelas_ref.nm_kelas,
        kelas_ref.maks,
        `profile`.nm_awal,
        `profile`.nm_akhir,
        `user`.kd_uuid user_id,
        xz.usr anggota')
            ->distinct()
            ->from('kelas_ref')
            ->join('kelas','kelas_ref.kd_kelas = kelas.kd_kelas')
            ->join('profile','kelas_ref.kd_user = profile.kd_user')
            ->join('user','profile.kd_user = user.kd_user')
            ->join('(SELECT kk.kd_kelas kdk,
            Count(kk.kd_user) usr
            FROM
            kelas kk
            GROUP BY
            kk.kd_kelas) xz','xz.kdk = kelas.kd_kelas')
            ->get()->result();
    }
    
    public function create()
    {
        $this->load->library('session');        
        if (!$this->session->has_userdata('uuid')) exit('Error : Unexpected System Error!');
        
        $this->load->model('user_model');        
        $this->kd_user = $this->user_model->get_kd_user($this->session->uuid);
        
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
        return array(
            'msg' => 'ok',
            'uuid' => $this->kd_uuid
        );
    }

    private function common_init($kelas_uuid=null)
    {
        $this->load->library('session');
        if (!$this->session->has_userdata('uuid')) exit;

        $this->load->model('user_model');
        $this->kd_user = $this->user_model->get_kd_user($this->session->uuid);

        $this->kd_uuid = (isset($kelas_uuid)) ? $kelas_uuid : $this->input->post('kode');
        if ($this->check_uuid() !== true)
        {
            return 'Invalid Code!';
        }
        $this->kd_kelas = $this->get_kd_kelas($this->kd_uuid);
    }

    public function join($kelas_uuid=null)
    {
        $this->common_init($kelas_uuid);

        $query = $this->db->select('r.kd_kelas')
            ->distinct()
            ->from('kelas k')
            ->join('kelas_ref r','r.kd_kelas = k.kd_kelas')
            ->where('r.kd_uuid',$this->kd_uuid)
            ->where('k.kd_user',$this->kd_user)
            ->limit(1)
        ->get();

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

    public function is_joined($kd_kelas,$kd_user)
    {
        $query = $this->db->select('kd_user')
            ->get_where('kelas',array('kd_kelas'=>$kd_kelas,'kd_user'=>$kd_user),1);
        return ($query->num_rows() > 0) ? true : false;
    }
    public function join_out($kelas_uuid=null)
    {
        $this->common_init($kelas_uuid);

        $query = $this->db->select('kd_kelas')
            ->distinct()
            ->from('kelas_ref')
            ->where('kd_uuid',$this->kd_uuid)
            ->where('kd_user',$this->kd_user)
            ->limit(1)
            ->get();

        if ($query->num_rows() < 1)
        {
            $query = $this->db->select('kd_kelas')
                ->distinct()
                ->from('kelas')
                ->where('kd_kelas',$this->kd_kelas)
                ->where('kd_user',$this->kd_user)
                ->limit(1)
                ->get();
            if ($query->num_rows() > 0)
            {
                $this->db
                    ->where('kd_kelas',$this->kd_kelas)
                    ->where('kd_user',$this->kd_user)
                    ->delete('kelas');
                return true;
            }
            else
            {
                return 'Anda Tidak Terdaftar di Kelas Ini!';
            }
        }
        else
        {
            return 'Gagal! Kelas Ini Butuh Anda (Owner)!';
        }
    }

    public function update($kelas_uuid=null)
    {
        $this->common_init($kelas_uuid);

        $this->nm_kelas = $this->input->post('nama');
        $this->maks = $this->input->post('maks');
        $query = $this->db->select('kd_kelas')
            ->distinct()
            ->from('kelas_ref')
            ->where('kd_uuid',$this->kd_uuid)
            ->where('kd_user',$this->kd_user)
            ->limit(1)
            ->get();

        if ($query->num_rows() > 0)
        {
            $data = array(
                'nm_kelas' => $this->nm_kelas,
                'maks' => $this->maks,
                'tgl_mod' => $this->today
            );
            $this->db->where('kd_kelas', $this->kd_kelas)
                ->where('kd_user', $this->kd_user)
                ->update('kelas_ref', $data);
            return true;
        }
        else
        {
            return 'Koreksi Tidak Di Ijinkan. Anda Bukan Pemilik Kelas!';
        }
    }

    public function drop($kelas_uuid=null)
    {
        $this->common_init($kelas_uuid);

        $query = $this->db->select('count(kd_user) ada')
            ->from('kelas')
            ->where('kd_kelas',$this->kd_kelas)
            ->get();
        if ($query->row()->ada < 2) {
            $query = $this->db->select('kd_kelas')
                ->distinct()
                ->from('kelas_ref')
                ->where('kd_uuid',$this->kd_uuid)
                ->where('kd_user',$this->kd_user)
                ->limit(1)
                ->get();
            if ($query->num_rows() > 0)
            {
                $this->db
                    ->where('kd_kelas',$this->kd_kelas)
                    ->delete(array('kelas','kelas_ref'));
                return true;
            }
            else
            {
                return 'Anda Bukan Pemilik Kelas!';
            }
        }
        else
        {
            return 'Fatal Hapus Kelas Yg Memiliki Anggota';
        }
    }

    public function drop_member()
    {

    }
}

/* End of file Kelas_model.php */