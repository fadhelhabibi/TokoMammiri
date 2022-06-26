<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_admin');
        $this->load->model('m_pesanan_masuk');
    }
    

    public function index()
    {
        $data = array(
            'title' => 'Dashboard',
            'total_kategori' => $this->m_admin->total_kategori(),
            'total_barang' => $this->m_admin->total_barang(),
            'total_transaksi' => $this->m_admin->total_transaksi(),
            'id_rinci' => $this->m_admin->id_rinci(),
            'isi' => 'v_admin',
        );
        $this->load->view('layout/v_wrapper_backend', $data, FALSE);
        
    }

    public function pesanan_masuk()
    {
        $data = array(
            'title' => 'Pesanan Masuk',
            'pesanan' => $this->m_pesanan_masuk->pesanan(),
            'pesanan_diproses' => $this->m_pesanan_masuk->pesanan_diproses(),
            'pesanan_dikirim' => $this->m_pesanan_masuk->pesanan_dikirim(),
            'pesanan_selesai' => $this->m_pesanan_masuk->pesanan_selesai(),
            'isi' => 'v_pesanan_masuk',
        );
        $this->load->view('layout/v_wrapper_backend', $data, FALSE);
    }

    public function proses($id_transaksi)
    {
        $data = array(
            'id_transaksi' => $id_transaksi,
            'status_order' => '1',
            
        );
        $this->m_pesanan_masuk->update_order($data);
        $this->session->set_flashdata('pesan', 'Pesanan berhasil diproses atau dikemas');
        
        redirect('admin/pesanan_masuk');
        
    }

    public function kirim($id_transaksi)
    {
        $data = array(
            'id_transaksi' => $id_transaksi,
            'status_order' => '2',
            
        );
        $this->m_pesanan_masuk->update_order($data);
        $this->session->set_flashdata('pesan', 'Pesanan berhasil Dikirim');
        
        redirect('admin/pesanan_masuk');
        
    }
}

/* End of file Home.php */
