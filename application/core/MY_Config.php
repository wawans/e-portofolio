<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Config extends CI_Config {
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Theme URL
     *
     * Returns base_url [. uri_string]
     *
     * @uses	CI_Config::_uri_string()
     *
     * @param	string|string[]	$uri	URI string or an array of segments
     * @param	string	$protocol
     * @return	string
     */
    public function theme_url($uri = '', $protocol = NULL)
    {
        $base_url = $this->slash_item('base_url');
        $base_url .= 'public/themes/';
        $base_url .= rtrim($this->item('theme'),'/');

        if (isset($protocol))
        {
            // For protocol-relative links
            if ($protocol === '')
            {
                $base_url = substr($base_url, strpos($base_url, '//'));
            }
            else
            {
                $base_url = $protocol.substr($base_url, strpos($base_url, '://'));
            }
        }

        return $base_url.ltrim($this->_uri_string($uri), '/');
    }
}