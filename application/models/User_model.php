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
        $this->load->library('database');
    }

    protected function do_hash($input, $hex = true)
    {
        $nr = 1345345333;
        $add = 7;
        $nr2 = 0x12345671;
        $tmp = null;
        $inlen = strlen($input);
        for ($i = 0; $i < $inlen; $i++) {
            $byte = substr($input, $i, 1);
            if ($byte == ' ' || $byte == "\t")
                continue;
            $tmp = ord($byte);
            $nr ^= ((($nr & 63) + $add) * $tmp) + (($nr << 8) & 0xFFFFFFFF);
            $nr2 += (($nr2 << 8) & 0xFFFFFFFF) ^ $nr;
            $add += $tmp;
        }
        $out_a = $nr & ((1 << 31) - 1);
        $out_b = $nr2 & ((1 << 31) - 1);
        $output = sprintf("%08x%08x", $out_a, $out_b);
        if ($hex)
            return $output;
        return $this->to_bin($output);
    }

    protected function to_bin($hex)
    {
        $bin = "";
        $len = strlen($hex);
        for ($i = 0; $i < $len; $i += 2) {
            $byte_hex = substr($hex, $i, 2);
            $byte_dec = hexdec($byte_hex);
            $byte_char = chr($byte_dec);
            $bin .= $byte_char;
        }
        return $bin;
    }

    protected function unique_salt()
    {
        return $this->do_hash(mt_rand());
    }

    private function unique_pass($key,$salt)
    {
        return sha1(md5($salt).$key.$salt);
    }

    private function gen_kd_user()
    {

    }

    private function gen_kd_uuid()
    {

    }

    private function check_uname_mail()
    {

    }

    public function create_user()
    {
        $this->uname = $this->input->post('username');
        $this->upass = $this->input->post('password');
        $this->usalt = $this->unique_salt();
        $this->email = $this->input->post('email');
    }


}

/* End of file User_model.php */