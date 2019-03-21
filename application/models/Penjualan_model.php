<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penjualan_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		//Load Dependencies

	}


	public function getIdBengkel($id)
    {   
        $this->db->select('kasir.id_bengkel as idbengkelkasir');
        $this->db->join('kasir', 'kasir.id_kasir = users.id_kasir');
        $this->db->where('users.id_kasir', $id);
        $query = $this->db->get('users');
        $result = $query->row();
        $this->db->save_queries = false;

        return $result;
    }

    public function getDtProduk($cari, $id)
    {   
        // hilangkan spasi kiri dan kanan
        $keyword = trim($cari);

        // // pisahkan dan hitung jumlah keyword
        $pisah_kata = explode(" ", $keyword);
        $jumlah_kata = (integer)count($pisah_kata);
        $jml_kata = $jumlah_kata - 1;

        foreach ($pisah_kata as $jml) {
            $this->db->like('searchdeskripsi', $jml);
        }

        // $this->db->like('searchdeskripsi', $cari);

        $this->db->join('inventory', 'inventory.id_p = produk.id_p');
        $this->db->join('kategori_produk', 'kategori_produk.id_kp = produk.category');
        $this->db->where('inventory.id_bengkel', $id);
        $query = $this->db->get('produk');
        $result = $query->result();
        $this->db->save_queries = false;

        return $result;
    }

    public function getDtPenjualan($id)
    {   
        $this->db->join('bengkel', 'bengkel.id_bengkel = penjualan.id_bengkel');
        $this->db->join('pelanggan', 'pelanggan.id = penjualan.id_pelanggan');
        $this->db->where('penjualan.id_bengkel', $id);
        $this->db->order_by('id_penjualan', 'desc');
        $query = $this->db->get('penjualan');
        $result = $query->result();
        $this->db->save_queries = false;

        return $result;
    }

    public function getDetailPenjualan($id)
    {   
        $this->db->join('pelanggan', 'pelanggan.id = penjualan.id_pelanggan');
        $this->db->where('penjualan.id_penjualan', $id);
        $query = $this->db->get('penjualan');
        $result = $query->row_array();
        $this->db->save_queries = false;

        return $result;
    }

    public function getTdSale($id){
        $this->db->select('count(penjualan_detail.id_p) as item, sum(penjualan_detail.qty) as qty');
        $this->db->join('penjualan_detail', 'penjualan_detail.id_penjualan = penjualan.id_penjualan');
        $this->db->where('penjualan.created_user_id', $id);
        $this->db->where('created_datetime',  date('Y-m-d'));

        $query = $this->db->get('penjualan');
        $result = $query->row();
        $this->db->save_queries = false;

        return $result;
    }

    public function getTransaksi($id){
        $this->db->select('count(penjualan.id_penjualan) as transaksi,sum(penjualan.total) as total');
        $this->db->where('penjualan.created_user_id', $id);
        $this->db->where('created_datetime',  date('Y-m-d'));

        $query = $this->db->get('penjualan');
        $result = $query->row();
        $this->db->save_queries = false;

        return $result;
    }

    public function getMaxIdPelanggan($id)
    {   
        $this->db->select_max('id');
        $this->db->like('nama', 'pelanggan');
        $this->db->where('id_bengkel', $id);

        $query = $this->db->get('pelanggan');
        $result = $query->row();
        $this->db->save_queries = false;

        return $result;
    }

    public function getPenjualan( $start='', $end='', $pelanggan='' )
    {   
        $id_bengkel = $this->session->userdata('outlet_id');

        $this->db->join('pelanggan', 'pelanggan.id = penjualan.id_pelanggan');
        if( $start!='' && $end!='' && $pelanggan!='' && $pelanggan!='all' ){
            $this->db->where("pelanggan.id='$pelanggan' and (penjualan.created_datetime BETWEEN '$start' and '$end' )");
        }else if( $start!='' && $end!='' && $pelanggan!='' && $pelanggan=='all' ){
            $this->db->where("(penjualan.created_datetime BETWEEN '$start' and '$end' )");
        }

        $this->db->where('penjualan.id_bengkel', $id_bengkel);
        $this->db->order_by('penjualan.created_datetime', 'desc');
       
        $query = $this->db->get('penjualan');
        $result = $query->result();
        $this->db->save_queries = false;

        return $result;
    }

    public function getPenjualanJudul( $start='', $end='', $pelanggan='' )
    {   
        $id_bengkel = $this->session->userdata('outlet_id');
        $this->db->select('count(penjualan.id_penjualan) as totaltransaksi, sum(penjualan.total) as totalpembelian, sum(untung) as totalkeuntungan, sum(diskon) as totaldiskon');
        $this->db->join('pelanggan', 'pelanggan.id = penjualan.id_pelanggan');
        if( $start!='' && $end!='' && $pelanggan!='' && $pelanggan!='all' ){
            $this->db->where("pelanggan.id='$pelanggan' and (penjualan.created_datetime BETWEEN '$start' and '$end' )");
        }else if( $start!='' && $end!='' && $pelanggan!='' && $pelanggan=='all' ){
            $this->db->where("(penjualan.created_datetime BETWEEN '$start' and '$end' )");
        }

        $this->db->where('penjualan.id_bengkel', $id_bengkel);
        $this->db->order_by('penjualan.created_datetime', 'desc');
       
        $query = $this->db->get('penjualan');
        $result = $query->row();
        $this->db->save_queries = false;

        return $result;
    }

    public function totalPenjualan($id){
        $this->db->select('sum(total) as totalpenjualan');
        $this->db->where('id_bengkel', $id);

        $query = $this->db->get('penjualan');
        $result = $query->row();
        $this->db->save_queries = false;

        return $result;
    }

    public function getDataPelanggan($id)
    {
        $this->db->not_like('nama', 'pelanggan');
        $this->db->where('id_bengkel', $id);

        $query = $this->db->get('pelanggan');
        $result = $query->result();
        $this->db->save_queries = false;

        return $result;
    }

}

/* End of file penjualan_model.php */
/* Location: ./application/models/penjualan_model.php */