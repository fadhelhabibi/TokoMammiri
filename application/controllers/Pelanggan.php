<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Pelanggan extends CI_Controller {

    
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('m_pelanggan');
        $this->load->model('m_auth');
    }
    

    public function register()
    {
        $this->form_validation->set_rules('nama_pelanggan', 'nama_pelanggan', 'required', array(
            'required' => '%s Harus Diisi !!!'
        ));
        $this->form_validation->set_rules('email', 'E-mail', 'required|is_unique[tbl_pelanggan.email]', array(
            'required' => '%s Harus Diisi !!!',
            'is_unique' => '%s Email ini sudah terdaftar!',
        ));
        $this->form_validation->set_rules('password', 'password', 'required', array(
            'required' => '%s Harus Diisi !!!'
        ));
        $this->form_validation->set_rules('ulangi_password', 'Ulangi Password', 'required|matches[password]', array(
            'required' => '%s Harus Diisi !!!',
            'matches' => '%s Password tidak sama!',
        ));

        if ($this->form_validation->run() == FALSE) {
            $data = array(
                'title' => 'Register Pelanggan',
                'isi' => 'v_register',
            );
            $this->load->view('layout/v_wrapper_frontend', $data, FALSE);
        } else {
            $data = array(
                'nama_pelanggan' => $this->input->post('nama_pelanggan'),
                'email' => $this->input->post('email'),
                'password' => $this->input->post('password'),
                
            );
            $this->m_pelanggan->register($data);
            $this->session->set_flashdata('pesan', 'Register Berhasil, Silahkan Login Kembali !!!');
            redirect('pelanggan/register');
        }
    }

    public function login()
    {
        $this->form_validation->set_rules('email', 'email', 'required', array(
            'required' => '%s harus diisi!!!'
        ));
        $this->form_validation->set_rules('password', 'password', 'required', array(
            'required' => '%s harus diisi!!!'
        ));
        
        
        if ($this->form_validation->run() == TRUE) {
            $email = $this->input->post('email');
            $password = $this->input->post('password');
            $this->pelanggan_login->login($email, $password);

        } 

        $data = array(
            'title' => 'Login Pelanggan',
            'isi' => 'v_login_pelanggan',
        );
        $this->load->view('layout/v_wrapper_frontend', $data, FALSE);
    }

    public function logout()
    {
        $this->pelanggan_login->logout();
        $this->cart->destroy();

    }
 
    public function akun()
    {
        $this->pelanggan_login->proteksi_halaman();

        $this->form_validation->set_rules('nama_pelanggan', 'Nama Pelanggan', 'required', 
        array('required' => '%s Harus Diisi!!')
    );
    $this->form_validation->set_rules('email', 'Email', 'required', 
        array('required' => '%s Harus Diisi!!')
    );
    $this->form_validation->set_rules('alamat', 'Alamat', 'required', 
        array('required' => '%s Harus Diisi!!')
    );
    
    if ($this->form_validation->run() == TRUE) { 
    $config['upload_path'] = './assets/gambar/';
    $config['allowed_types'] = 'gif|jpg|png|jpeg|ico';
    $config['max_size']     = '2000';
    $this->upload->initialize($config);
    $field_name = "foto";
        if (!$this->upload->do_upload($field_name)) {
            $data = array(
                'title' => 'Akun Saya',
                'pelanggan' => $this->m_pelanggan->get_data($this->session->id_pelanggan),
                'error_upload' => $this->upload->display_errors(),
                'isi' => 'v_akun_saya',
            );
            $this->load->view('layout/v_wrapper_frontend', $data, FALSE);
        }else{
            $pelanggan=$this->m_pelanggan->get_data($this->session->id_pelanggan);
        if ($pelanggan->foto != "") {
            unlink('./assets/gambar/' . $pelanggan->foto);
        }
            $upload_data = array('uploads' => $this->upload->data());
            $config['image_library'] = 'gd2';
            $config['source_image'] = './assets/gambar/' . $upload_data['uploads']['file_name'];
            $namafoto=$upload_data['uploads']['file_name'];
            $this->load->library('image_lib', $config);
            $data = array(
                'id_pelanggan' => $this->session->id_pelanggan,
                'nama_pelanggan' => $this->input->post('nama_pelanggan'),
                'email' => $this->input->post('email'),
                'alamat' => $this->input->post('alamat'),
                'foto' => $namafoto,
         );
         $this->m_pelanggan->edit($data);
         $this->session->set_flashdata('pesan', 'Data berhasil diganti!!');
         $this->session->userdata = $data;
         redirect('pelanggan/akun');
        }
        
       if($this->input->post('email')){
        $data = array(
            'id_pelanggan' => $this->session->id_pelanggan,
            'nama_pelanggan' => $this->input->post('nama_pelanggan'),
            'email' => $this->input->post('email'),
            'alamat' => $this->input->post('alamat'),
            'foto' => $this->m_pelanggan->get_data($this->session->id_pelanggan)->foto,
            );
            $this->m_pelanggan->edit($data);
     $this->session->set_flashdata('pesan', 'Data berhasil diganti!!');
     $this->session->userdata=$data;
     redirect('pelanggan/akun');
       }
    }
        $data = array(
            'title' => 'Akun Saya',
            'pelanggan' => $this->m_pelanggan->get_data($this->session->id_pelanggan),
            'isi' => 'v_akun_saya',
        );
        $this->load->view('layout/v_wrapper_frontend', $data, FALSE);
    }
    
} 