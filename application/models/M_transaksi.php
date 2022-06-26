<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class M_transaksi extends CI_Model {

    public function simpan_transaksi($data){
        $this->db->insert('tbl_transaksi', $data);
    }

    public function simpan_rinci_transaksi($data_rinci){
        $this->db->insert('tbl_rinci_transaksi', $data_rinci);
    }

    public function belum_bayar()
    {
        $this->db->select('*');
        $this->db->from('tbl_transaksi');
        $this->db->where('id_pelanggan', $this->session->userdata('id_pelanggan'));
        $this->db->where('status_order=0');
        $this->db->order_by('id_transaksi', 'desc'); 
        return $this->db->get()->result();
    }

    public function diproses()
    {
        $this->db->select('*');
        $this->db->from('tbl_transaksi');
        $this->db->where('id_pelanggan', $this->session->userdata('id_pelanggan'));
        $this->db->where('status_order=1');
        $this->db->order_by('id_transaksi', 'desc'); 
        return $this->db->get()->result();
    }

    public function dikirim()
    {
        $this->db->select('*');
        $this->db->from('tbl_transaksi');
        $this->db->where('id_pelanggan', $this->session->userdata('id_pelanggan'));
        $this->db->where('status_order=2');
        $this->db->order_by('id_transaksi', 'desc'); 
        return $this->db->get()->result();
    }

    public function selesai()
    {
        $this->db->select('*');
        $this->db->from('tbl_transaksi');
        $this->db->where('id_pelanggan', $this->session->userdata('id_pelanggan'));
        $this->db->where('status_order=3');
        $this->db->order_by('id_transaksi', 'desc'); 
        return $this->db->get()->result();
    }

    public function detail_pesanan($id_transaksi)
    {
        $this->db->select('*');
        $this->db->from('tbl_transaksi');
        $this->db->where('id_transaksi', $id_transaksi);
        return $this->db->get()->row();
        
    }

    public function rekening()
    {
        $this->db->select('*');
        $this->db->from('tbl_rekening');
        return $this->db->get()->result();
        
                
    }

    public function upload_buktibayar($data)
    {
        $this->db->where('id_transaksi', $data['id_transaksi']);
        $this->db->update('tbl_transaksi', $data); 
    }

    public function invoice($id_invoice)
    {
        $n_order = $this->uri->segment('3');
        $query = "select tr.no_order, br.nama_barang, br.harga, r.qty, (br.harga * r.qty ) 
        as subtotal from tbl_transaksi tr inner join tbl_rinci_transaksi r on r.no_order = tr.no_order inner join tbl_barang br on br.id_barang = r.id_barang where tr.no_order = '".$n_order."';";
        return $this->db->query($query)->result(); 
        //return $this->db->get()->result();
        //return "aaaa";
    }
}
