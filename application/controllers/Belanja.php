<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Belanja extends CI_Controller {

    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_transaksi');
    
        
    }
    

    public function index()
    {
        if (empty($this->cart->contents())) {
            redirect('home');
        }
        $data = array(
            'title' => 'Keranjang Belanja',
            'isi' => 'v_belanja',
        );
        $this->load->view('layout/v_wrapper_frontend', $data, FALSE);
    }

    public function add()
    {
        $redirect_page = $this->input->post('redirect_page');
        $data = array(
            'id'      => $this->input->post('id'),
            'qty'     => $this->input->post('qty'),
            'price'   => $this->input->post('price'),
            'name'    => $this->input->post('name'),
    );
    $this->cart->insert($data);
    redirect($redirect_page, 'refresh');
    }

    public function delete($rowid)
    {
        $this->cart->remove($rowid);
        redirect('belanja');
    }

    public function update()
    {
        $i = 1;
        foreach ($this->cart->contents() as $items) {
            $data = array(
                'rowid' => $items['rowid'],
                'qty'   => $this->input->post($i . '[qty]'),
        );
        $this->cart->update($data);
        $i++;
        }
        redirect('belanja');
        }

        public function cekout()
        {
            $this->pelanggan_login->proteksi_halaman();
            $this->form_validation->set_rules('nama_penerima', 'Nama Penerima', 'required', 
            array('required' => '%s Harus Diisi!!'));
            $this->form_validation->set_rules('nohp_penerima', 'No HP Penerima', 'required', 
            array('required' => '%s Harus Diisi!!'));
            $this->form_validation->set_rules('alamat', 'Alamat', 'required', 
            array('required' => '%s Harus Diisi!!'));
            if ($this->form_validation->run() == FALSE){
                $data = array(
                    'title' => 'Cek Out Belanja',
                    'isi' => 'v_cekout',
                );
                $this->load->view('layout/v_wrapper_frontend', $data, FALSE);
            } else {
                $data = array(
                    'id_pelanggan' => $this->session->userdata('id_pelanggan'),
                    'no_order' => $this->input->post('no_order'),
                    'tgl_order' => date('Y-m-d'),
                    'nama_penerima' => $this->input->post('nama_penerima'),
                    'nohp_penerima' => $this->input->post('nohp_penerima'),
                    'alamat' => $this->input->post('alamat'),
                    'grand_total' => $this->input->post('grand_total'),
                    'total_bayar' => $this->input->post('total_bayar'),
                    'status_bayar' => '0',
                    'status_order' => '0',
                );
                $this->m_transaksi->simpan_transaksi($data);
                $i = 1;
                foreach ($this->cart->contents() as $item){
                    $data_rinci = array(
                        'no_order' => $this->input->post('no_order'),
                        'id_barang' => $item['id'],
                        'qty' => $this->input->post('qty' . $i++),
                    );
                    $this->m_transaksi->simpan_rinci_transaksi($data_rinci);
                }
                
                $this->session->set_flashdata('pesan', 'Pesanan Berhasil DiProses');
                redirect('pesanan_saya');
            }
            
        }
}