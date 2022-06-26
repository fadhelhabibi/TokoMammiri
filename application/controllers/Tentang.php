<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Tentang extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
    }
    public function tentang()
    {
        $data = array(
            'title' => 'Tentang Kami',
            'isi' => 'v_tentang',
        );
        $this->load->view('layout/v_wrapper_frontend', $data, FALSE);
    }
}