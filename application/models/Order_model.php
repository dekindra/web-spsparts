<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
		$this->load->database();
	}

//-----------------------------Order Admin---------------------------
	public function getDataDetail($id)
	{
		$this->db->join('order', 'order.id_order = order_detail.id_order');
		$this->db->join('produk', 'produk.id_p = order_detail.id_p');
		$this->db->join('kategori_produk', 'kategori_produk.id_kp = produk.category');
		$this->db->where('order_detail.id_order', $id);
		$query = $this->db->get('order_detail');
        $result = $query->result();
        $this->db->save_queries = false;

        return $result;
	}

	public function getDataEmailGudang($id)
	{
		$this->db->join('gudang', 'gudang.id_gudang = order.id_gudang');
		$this->db->where('id_order', $id);
		// $query = $this->db->query('SELECT * FROM `order` JOIN bengkel ON bengkel.id_bengkel = `order`.`id_bengkel` JOIN gudang ON gudang.id_gudang = bengkel.wh WHERE id_order = 64');
		$query = $this->db->get('order');
        $result = $query->row();
        $this->db->save_queries = false;

        return $result;
	}

    public function getTotalOrderAdmin()
    {
        $this->db->select('sum(total_pembelian) as totalorder');
        $this->db->join('gudang', 'gudang.id_gudang = order.id_gudang');

        $query = $this->db->get('order');
        $row = $query->row();
        $this->db->save_queries = false;

        return $row;
    }


    public function getOrderMasukAdmin($start='', $end='', $status='' )
    {
        $outlet_id = $this->session->userdata('outlet_id');
        
        $this->db->join('gudang', 'gudang.id_gudang = order.id_gudang');
        if( $start!='' && $end!='' && $status!='' && $status!='all' ){
            $this->db->where("status_order='$status' and (tanggal_order BETWEEN '$start' and '$end' )");
        }else if( $start!='' && $end!='' && $status!='' && $status=='all' ){
            $this->db->where("(tanggal_order BETWEEN '$start' and '$end' )");
        }

        $this->db->order_by('id_order', 'desc');
       
        $query = $this->db->get('order');
        $result = $query->result();
        $this->db->save_queries = false;

        return $result;
    }

    public function getOrderJudulMasukAdmin($start='', $end='', $status='' )
    {
        $outlet_id = $this->session->userdata('outlet_id');
        
        $this->db->select('count(id_order) as totaltransaksi, sum(total_pembelian) as totalpembelian');
        $this->db->join('gudang', 'gudang.id_gudang = order.id_gudang');

        if( $start!='' && $end!='' && $status!='' && $status!='all' ){
            $this->db->where("status_order='$status' and (tanggal_order BETWEEN '$start' and '$end' )");
        }else if( $start!='' && $end!='' && $status!='' && $status=='all' ){
            $this->db->where("(tanggal_order BETWEEN '$start' and '$end' )");
        }

        $this->db->order_by('id_order', 'desc');
       
        $query = $this->db->get('order');
        $result = $query->row();
        $this->db->save_queries = false;

        return $result;
    }

//-----------------------------Order Gudang---------------------------
	public function getDataDetailGudang($id)
	{
		$this->db->select('order_detail.*, produk.name_p, produk.purchase_price, kategori_produk.*, id_gudang, inventory.stock');
		$this->db->join('produk', 'produk.id_p = order_detail.id_p');
		$this->db->join('kategori_produk', 'kategori_produk.id_kp = produk.category');
		$this->db->join('inventory', 'inventory.id_p = produk.id_p', 'LEFT');
		$this->db->where('id_order', $id);
		// $this->db->where('id_gudang', $outlet_id);
		$this->db->group_by('order_detail.id_p');
		// $query = $this->db->query('SELECT * FROM `order_detail` JOIN produk ON produk.id_p = order_detail.id_p LEFT JOIN inventory ON inventory.id_p = produk.id_p WHERE order_detail.id_order = "$id"');
		$query = $this->db->get('order_detail');
        $result = $query->result();
        $this->db->save_queries = false;

        return $result;
	}

    public function getTotalOrderGd($id)
    {
        $this->db->select('sum(total_pembelian) as totalorder');
        $this->db->join('bengkel', 'bengkel.id_bengkel = order.id_bengkel');
        $this->db->where('wh', $id);

        $query = $this->db->get('order');
        $row = $query->row();
        $this->db->save_queries = false;

        return $row;
    }

    public function getTotalOrderKeluarGd($id)
    {
        $this->db->select('sum(total_pembelian) as totalorder');
        $this->db->where('id_gudang', $id);

        $query = $this->db->get('order');
        $row = $query->row();
        $this->db->save_queries = false;

        return $row;
    }

    public function getOrderMasukGd($start='', $end='', $status='' )
    {
        $outlet_id = $this->session->userdata('outlet_id');
        
        $this->db->join('bengkel', 'bengkel.id_bengkel = order.id_bengkel');
        if( $start!='' && $end!='' && $status!='' && $status!='all' ){
            $this->db->where("status_order='$status' and (tanggal_order BETWEEN '$start' and '$end' )");
        }else if( $start!='' && $end!='' && $status!='' && $status=='all' ){
            $this->db->where("(tanggal_order BETWEEN '$start' and '$end' )");
        }

        $this->db->where('wh', $outlet_id);
        $this->db->order_by('id_order', 'desc');
       
        $query = $this->db->get('order');
        $result = $query->result();
        $this->db->save_queries = false;

        return $result;
    }

    public function getOrderJudulMasukGd($start='', $end='', $status='' )
    {
        $outlet_id = $this->session->userdata('outlet_id');
        
        $this->db->select('count(id_order) as totaltransaksi, sum(total_pembelian) as totalpembelian');
        $this->db->join('bengkel', 'bengkel.id_bengkel = order.id_bengkel');

        if( $start!='' && $end!='' && $status!='' && $status!='all' ){
            $this->db->where("status_order='$status' and (tanggal_order BETWEEN '$start' and '$end' )");
        }else if( $start!='' && $end!='' && $status!='' && $status=='all' ){
            $this->db->where("(tanggal_order BETWEEN '$start' and '$end' )");
        }
        $this->db->where('wh', $outlet_id);
        $this->db->order_by('id_order', 'desc');
       
        $query = $this->db->get('order');
        $result = $query->row();
        $this->db->save_queries = false;

        return $result;
    }

    public function getDataBengkel($id)
    {
        $this->db->select('bengkel.*, gudang.name as nameg, gudang.instansi as instansig, gudang.address as addressg, gudang.email as emailg, gudang.tel as telg');
        $this->db->join('gudang', 'gudang.id_gudang = bengkel.wh');
        $this->db->where('id_gudang', $id);
        
        $query = $this->db->get('bengkel');
        $result = $query->row_array();
        $this->db->save_queries = false;

        return $result;
    }

    public function getOrderKeluarGd($start='', $end='', $status='' )
    {
        $outlet_id = $this->session->userdata('outlet_id');
        
        if( $start!='' && $end!='' && $status!='' && $status!='all' ){
            $this->db->where("status_order='$status' and (tanggal_order BETWEEN '$start' and '$end' )");
        }else if( $start!='' && $end!='' && $status!='' && $status=='all' ){
            $this->db->where("(tanggal_order BETWEEN '$start' and '$end' )");
        }

        $this->db->where('id_gudang', $outlet_id);
        $this->db->order_by('tanggal_order', 'desc');
       
        $query = $this->db->get('order');
        $result = $query->result();
        $this->db->save_queries = false;

        return $result;
    }

    public function getOrderJudulKeluarGd($start='', $end='', $status='' )
    {
        $outlet_id = $this->session->userdata('outlet_id');
        
        $this->db->select('count(id_order) as totaltransaksi, sum(total_pembelian) as totalpembelian');

        if( $start!='' && $end!='' && $status!='' && $status!='all' ){
            $this->db->where("status_order='$status' and (tanggal_order BETWEEN '$start' and '$end' )");
        }else if( $start!='' && $end!='' && $status!='' && $status=='all' ){
            $this->db->where("(tanggal_order BETWEEN '$start' and '$end' )");
        }
        $this->db->where('id_gudang', $outlet_id);
        $this->db->order_by('tanggal_order', 'desc');
       
        $query = $this->db->get('order');
        $result = $query->row();
        $this->db->save_queries = false;

        return $result;
    }


//-----------------------------Order Bengkel---------------------------
	public function getDataEmail($id)
	{
		$this->db->select('order.id_bengkel, gudang.id_gudang, order.tanggal_order, order.total_pembelian, gudang.email as email');
		$this->db->join('bengkel', 'bengkel.id_bengkel = order.id_bengkel');
		$this->db->join('gudang', 'gudang.id_gudang = bengkel.wh');
		$this->db->where('id_order', $id);
		// $query = $this->db->query('SELECT * FROM `order` JOIN bengkel ON bengkel.id_bengkel = `order`.`id_bengkel` JOIN gudang ON gudang.id_gudang = bengkel.wh WHERE id_order = 64');
		$query = $this->db->get('order');
        $result = $query->row();
        $this->db->save_queries = false;

        return $result;
	}

	public function getDataGudangBengkel($id)
	{
		$this->db->select('bengkel.*, gudang.name as nameg, gudang.instansi as instansig, gudang.address as addressg, gudang.email as emailg, gudang.tel as telg, tanggal_order');
		$this->db->join('bengkel', 'bengkel.id_bengkel = order.id_bengkel');
		$this->db->join('gudang', 'gudang.id_gudang = bengkel.wh');
		$this->db->where('id_order', $id);
		
		$query = $this->db->get('order');
        $result = $query->row_array();
        $this->db->save_queries = false;

        return $result;
	}

	public function getTotalOrder($id)
	{
		$this->db->select('sum(total_pembelian) as totalorder');
		$this->db->where('id_bengkel', $id);

		$query = $this->db->get('order');
        $row = $query->row();
        $this->db->save_queries = false;

        return $row;
	}

	public function getOrder( $start='', $end='', $status='' )
    {
    	$outlet_id = $this->session->userdata('outlet_id');
        // $this->db->join('pelanggan', 'pelanggan.id = penjualan.id_pelanggan');
        if( $start!='' && $end!='' && $status!='' && $status!='all' ){
            $this->db->where("status_order='$status' and (tanggal_order BETWEEN '$start' and '$end' )");
        }else if( $start!='' && $end!='' && $status!='' && $status=='all' ){
            $this->db->where("(tanggal_order BETWEEN '$start' and '$end' )");
        }
        $this->db->where('id_bengkel', $outlet_id);
        $this->db->order_by('id_order', 'desc');
       
        $query = $this->db->get('order');
        $result = $query->result();
        $this->db->save_queries = false;

        return $result;
    }

    public function getOrderJudul( $start='', $end='', $status='' )
    {
    	$outlet_id = $this->session->userdata('outlet_id');
    	
        $this->db->select('count(id_order) as totaltransaksi, sum(total_pembelian) as totalpembelian');
        if( $start!='' && $end!='' && $status!='' && $status!='all' ){
            $this->db->where("status_order='$status' and (tanggal_order BETWEEN '$start' and '$end' )");
        }else if( $start!='' && $end!='' && $status!='' && $status=='all' ){
            $this->db->where("(tanggal_order BETWEEN '$start' and '$end' )");
        }
        $this->db->where('id_bengkel', $outlet_id);
        $this->db->order_by('id_order', 'desc');
       
        $query = $this->db->get('order');
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
        $this->db->join('kategori_produk', 'kategori_produk.id_kp = produk.category');

        $query = $this->db->get('produk');
        $result = $query->result();
        $this->db->save_queries = false;

        return $result;
    }

}

/* End of file Order_model.php */
/* Location: ./application/models/Order_model.php */