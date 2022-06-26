<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Invoice extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
    }
    public function invoice()
    {
        $data = array(
            'title' => 'Invoice',
            'isi' => 'v_invoice',
        );
        $this->load->view('layout/v_wrapper_frontend', $data, FALSE);
    }
}