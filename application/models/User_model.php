<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {
    private $kd_user;
    private $kd_uuid;
    private $usalt;
    public $uname;
    public $upass;
    public $nm_awal;
    public $nm_akhir;
    public $email;
    public $tgl_buat;
    public $tgl_mod;
    public $act = 1;

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('app');
        $this->tgl_buat = date('Y-m-d');
        $this->tgl_mod = date('Y-m-d');
    }

    protected function unique_salt()
    {
        return $this->app->do_hash(mt_rand());
    }

    private function unique_pass($key,$salt)
    {
        return sha1(md5($salt).$key.$salt);
    }

    private function gen_kd_user()
    {
        $date = date('myd');
        $last = $this->db->select('kd_user')
                         ->distinct()
                         ->like('kd_user',$date,'after')
                         ->order_by('kd_user', 'DESC')
                         ->limit(1)
                         ->get('user');
        $this->kd_user = ($last->num_rows() < 1) ? $date.'000' : sprintf("%09d",($last->row()->kd_user+1));
    }

    private function gen_kd_uuid()
    {
        $this->kd_uuid = $this->app->gen_uuid();
    }

    private function check_uname_mail($set = false)
    {
        $uname = $this->db->select('kd_uuid,upass,usalt')
            ->distinct()
            ->where("BINARY uname=".$this->db->escape($this->uname),NULL,FALSE)
            ->limit(1)
            ->get('user');
        if ($uname->num_rows() > 0)
        {
            if ($set == true)
            {
                $this->upass = $uname->row()->upass;
                $this->usalt = $uname->row()->usalt;
                $this->kd_uuid = $uname->row()->kd_uuid;
                return true;
            }
            else
            {
                return 'Username Sudah Ada!';
            }
        }
        elseif (isset($this->email) && ($this->email != ''))
        {
            $mail = $this->db->get_where('profile',array('email'=>$this->email),1);
            return ($mail->num_rows() > 0) ? 'Email Sudah Terdaftar' : true;
        }
        return true;
    }

    public function create_user()
    {
        $this->uname = $this->input->post('username');
        $this->act = $this->input->post('akun');
        $this->upass = $this->input->post('password');
        $this->email = $this->input->post('email');
        $this->nm_awal = $this->input->post('nama_awal');
        $this->nm_akhir = $this->input->post('nama_akhir');
        if ($this->check_uname_mail() !== true)
        {
            return $this->check_uname_mail();
        }
        $this->gen_kd_user();
        $this->gen_kd_uuid();
        $this->usalt = $this->unique_salt();
        $this->upass = $this->unique_pass($this->upass,$this->usalt);
        $user = array(
            'kd_user' => $this->kd_user,
            'kd_uuid' => $this->kd_uuid,
            'uname' => $this->uname,
            'upass' => $this->upass,
            'usalt' => $this->usalt,
            'tgl_buat' => $this->tgl_buat,
            'tgl_mod' => $this->tgl_mod
        );
        $prof = array(
            'kd_user' => $this->kd_user,
            'nm_awal' => $this->nm_awal,
            'nm_akhir' => $this->nm_akhir,
            'email' => $this->email,
            'tgl_mod' => $this->tgl_mod,
            'act'=> $this->act
        );
        $this->db->trans_start();
        $this->db->insert('user',$user);
        $this->db->insert('profile',$prof);
        $this->db->trans_complete();
        return true;
    }

    public function login_user()
    {
        $this->uname = $this->input->post('username');
        $this->upass = $this->input->post('password');
        $plain = $this->input->post('password');
        if ($this->check_uname_mail(true) == true)
        {
            if ($this->upass == $this->unique_pass($plain,$this->usalt))
            {

                return array('msg'=>'ok','uuid'=>$this->kd_uuid);
            }
            else
            {
                return 'Username & Password Tidak Sesuai!';
            }
        }
        else
        {
            return 'Username & Password Tidak Sesuai!';
        }
    }

    public function get_kd_user($uuid)
    {
        return $this->db->select('kd_user')
            ->where('kd_uuid',$uuid)
            ->limit(1)
            ->get('user')->row()->kd_user;
    }
public function get_kd_uuid($kd_user)
    {
        return $this->db->select('kd_uuid')
            ->where('kd_user',$kd_user)
            ->limit(1)
            ->get('user')->row()->kd_uuid;
    }

    public function get_profil($uuid)
    {
        $query = $this->db->select('u.kd_user,u.kd_uuid,p.nm_awal,p.nm_akhir,p.email,p.act')
                    ->distinct()
                    ->from('user u')
                    ->join('profile p','p.kd_user = u.kd_user')
                    ->where('u.kd_uuid',$uuid)
                    ->limit(1)->get()
                ;
        return ($query->num_rows() > 0) ? $query->row() : false;
    }
}

/* End of file User_model.php */