<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class App {

    public function __construct() 
    {

    }

    public function do_hash($input, $hex = true)
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

    public function gen_uuid($len = 9)
    {
        $tmp = null;
        $len = ($len+1 > 16) ? 16 : $len;
        $tmp = $this->do_hash(mt_rand().microtime());
        return substr($tmp,0,$len);
    }
}
/* End of file App.php */