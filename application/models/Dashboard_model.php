<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
		$this->load->database();
	}

// ----------------------------------dashboard Admin------------------------------------
	// jika mau dibuat perbulan
	public function jumOrder()
	{
		$this->db->select('count(id_order) as jumorder');
		$this->db->join('gudang', 'gudang.id_gudang = order.id_gudang');

		$query = $this->db->get('order');
        $row = $query->row();
        $this->db->save_queries = false;

        return $row;
	}


	public function jumPendapatan()
	{
		$this->db->select('sum(nominal) as pendapatan, ');
		$this->db->join('order', 'order.id_order = pembayaran.id_order', 'right');
		$this->db->join('gudang', 'gudang.id_gudang = order.id_gudang');
		$this->db->where('pembayaran.status', '1');

		$query = $this->db->get('pembayaran');
        $row = $query->row();
        $this->db->save_queries = false;

        return $row;
	}

	public function jumTagihan()
	{
		$this->db->select('sum(total_tagihan) as tagihan');
		$this->db->join('pembayaran', 'pembayaran.id_order = order.id_order', 'left');
        $this->db->join('gudang', 'gudang.id_gudang = order.id_gudang');
        $this->db->where('jatuh_tempo >', date('Y-m-d H:i:s', time()));
        $this->db->where('pembayaran.id =', null);
        $this->db->or_where('tanggal_pembayaran >=', 'jatuh_tempo');

		$query = $this->db->get('order');

		$row = $query->row();
		$this->db->save_queries = false;

		return $row;
	}

	public function jumTunggakan()
	{
		$this->db->select('sum(total_tagihan) as tunggakan');
		$this->db->join('pembayaran', 'pembayaran.id_order = order.id_order', 'left');
       	$this->db->join('gudang', 'gudang.id_gudang = order.id_gudang');
		$this->db->where('jatuh_tempo <', date('Y-m-d H:i:s', time()));

		$query = $this->db->get('order');

		$row = $query->row();
		$this->db->save_queries = false;

		return $row;
	}

	public function jumGudang()
	{
		$this->db->select('count(id_gudang) as gudang');
		$query = $this->db->get('gudang');

		$row = $query->row();
		$this->db->save_queries = false;

		return $row;
	}

	public function jumBengkel()
	{
		$this->db->select('count(id_bengkel) as bengkel');
		$query = $this->db->get('bengkel');

		$row = $query->row();
		$this->db->save_queries = false;

		return $row;
	}

	public function jumPelanggan()
	{
		$this->db->select('count(id) as pelanggan');
		$this->db->not_like('nama', 'pelanggan');
		$query = $this->db->get('pelanggan');

		$row = $query->row();
		$this->db->save_queries = false;

		return $row;
	}


	public function recentOrder()
	{
		$this->db->join('gudang', 'gudang.id_gudang = order.id_gudang');
		$this->db->order_by('id_order', 'desc');
		$this->db->limit(5);

		$query = $this->db->get('order');

		$result = $query->result();
		$this->db->save_queries = false;

		return $result;
	}

	public function getTotalPenjualanAdmin($start='', $end='')
    {	
		$this->db->select('sum(total_tagihan) as totalpenjualan');
		$this->db->join('gudang', 'gudang.id_gudang = order.id_gudang');
		$this->db->where('status_order =', '3');
        $this->db->where("(order.tanggal_order BETWEEN '$start' and '$end')");

		$query = $this->db->get('order');
        $row = $query->row();
        $this->db->save_queries = false;

        return $row;
    }

    public function getBebanAdmin($start='', $end='')
    {
    	$this->db->select('kategori_pengeluaran.name, sum(amount) as totalbeban');
    	$this->db->join('kategori_pengeluaran', 'kategori_pengeluaran.id = pengeluaran.expense_category');
    	$this->db->where('pengeluaran.type', 'admin');
        $this->db->where("(pengeluaran.created_datetime BETWEEN '$start' and '$end')");

        $this->db->group_by('pengeluaran.expense_category');
       
        $query = $this->db->get('pengeluaran');
        $result = $query->result();
        $this->db->save_queries = false;

        return $result;
    }

// ----------------------------------dashboard Gudang------------------------------------

	public function jumPendapatanGd()
	{
		$outlet = $this->session->userdata('outlet_id');

		$this->db->select('sum(total_tagihan) as jumlahpendapatan');
		$this->db->join('bengkel', 'bengkel.id_bengkel = order.id_bengkel');
		$this->db->where('status_order =', '2');
		$this->db->where('bengkel.wh', $outlet);

		$query = $this->db->get('order');
        $row = $query->row();
        $this->db->save_queries = false;

        return $row;
	}

	public function jumTagihanGd()
	{
		$outlet = $this->session->userdata('outlet_id');

		$this->db->select('sum(total_tagihan) as jumlahtagihan');
		$this->db->where('status_order', '3');
		$this->db->where('id_gudang', $outlet);

		$query = $this->db->get('order');
        $row = $query->row();
        $this->db->save_queries = false;

        return $row;
	}

	public function jumpembayaranGd()
	{
		$outlet = $this->session->userdata('outlet_id');

		$this->db->select('sum(nominal) as jumlahpembayaran');
		$this->db->join('pembayaran', 'pembayaran.id_order = order.id_order', 'left');
		$this->db->where('status_order', '3');
		$this->db->where('id_gudang', $outlet);
		$this->db->where('pembayaran.status =', '1' );

		$query = $this->db->get('order');
        $row = $query->row();
        $this->db->save_queries = false;

        return $row;
	}


	public function jumBengkelGd()
	{
		$outlet = $this->session->userdata('outlet_id');

		$this->db->select('count(id_bengkel) as jumlahbengkel');
		$this->db->where('bengkel.wh', $outlet);

		$query = $this->db->get('bengkel');

		$row = $query->row();
		$this->db->save_queries = false;

		return $row;
	}

	public function recentOrderGd()
	{
		$outlet = $this->session->userdata('outlet_id');

		$this->db->where('id_gudang', $outlet);
		$this->db->where('status_order = ', '1' );
		$this->db->or_where('status_order =', '2' );
		$this->db->where('id_gudang', $outlet);
		$this->db->order_by('id_order', 'desc');

		$query = $this->db->get('order');

		$result = $query->result();
		$this->db->save_queries = false;

		return $result;
	}

	public function orderJatuhTempoGd()
	{
		$outlet = $this->session->userdata('outlet_id');

		$this->db->select('order.*, sum(nominal) as jumpembayaran');
      	$this->db->join('pembayaran', 'pembayaran.id_order = order.id_order', 'left');

		$this->db->where('id_gudang', $outlet);
		$this->db->where('jatuh_tempo <', date('Y-m-d'));
		$this->db->order_by('id_order', 'desc');
       	$this->db->group_by('order.id_order');

		$query = $this->db->get('order');

		$result = $query->result();
		$this->db->save_queries = false;

		return $result;
	}

	public function reorderProdukGd($minstock)
	{	
		$outlet = $this->session->userdata('outlet_id');

		$this->db->join('produk', 'produk.id_p = inventory.id_p');
		$this->db->join('kategori_produk', 'kategori_produk.id_kp = produk.category');
		$this->db->where('id_gudang', $outlet);
		$this->db->where('stock <=', $minstock);
		$this->db->order_by('inventory.id_p', 'asc');

		$query = $this->db->get('inventory');

		$result = $query->result();
        $this->db->save_queries = false;

        return $result;
	}

	public function getTotalPenjualanGd($start='', $end='')
    {	
    	$outlet = $this->session->userdata('outlet_id');

		$this->db->select('sum(total_tagihan) as totalpenjualan');
		$this->db->join('bengkel', 'bengkel.id_bengkel = order.id_bengkel');
		$this->db->where('status_order =', '2');
		$this->db->where('bengkel.wh', $outlet);
        $this->db->where("(order.tanggal_order BETWEEN '$start' and '$end')");

		$query = $this->db->get('order');
        $row = $query->row();
        $this->db->save_queries = false;

        return $row;
    }

    public function getBebanGd($start='', $end='')
    {
    	$outlet_id = $this->session->userdata('outlet_id');

    	$this->db->select('kategori_pengeluaran.name, sum(amount) as totalbeban');
    	$this->db->join('kategori_pengeluaran', 'kategori_pengeluaran.id = pengeluaran.expense_category');
    	$this->db->where('pengeluaran.type', 'gudang');
    	$this->db->where('pengeluaran.outlet_id', $outlet_id);
        $this->db->where("(pengeluaran.created_datetime BETWEEN '$start' and '$end')");

        $this->db->group_by('pengeluaran.expense_category');
       
        $query = $this->db->get('pengeluaran');
        $result = $query->result();
        $this->db->save_queries = false;

        return $result;
    }

	


// ----------------------------------dashboard Bengkel------------------------------------
	public function jumTagihanBk()
	{
		$outlet = $this->session->userdata('outlet_id');

		$this->db->select('sum(total_tagihan) as totaltagihan, sum(nominal) as totalpembayaran');
		$this->db->join('pembayaran', 'pembayaran.id_order = order.id_order', 'left');
		$this->db->where('id_bengkel', $outlet);

		$query = $this->db->get('order');

		$row = $query->row();
		$this->db->save_queries = false;

		return $row;
	}

	public function jumPenjualanBk()
    {   
    	$outlet = $this->session->userdata('outlet_id');

    	$this->db->select('sum(total) as totalpenjualan');
        $this->db->join('bengkel', 'bengkel.id_bengkel = penjualan.id_bengkel');
        $this->db->join('pelanggan', 'pelanggan.id = penjualan.id_pelanggan');
        $this->db->where('penjualan.id_bengkel', $outlet);
        $this->db->order_by('id_penjualan', 'desc');
        $query = $this->db->get('penjualan');
        $row = $query->row();
        $this->db->save_queries = false;

        return $row;
    }


	public function jumPelangganBk()
	{
		$outlet = $this->session->userdata('outlet_id');

		$this->db->select('count(id) as totalpelanggan');
		$this->db->not_like('nama', 'pelanggan');
		$this->db->where('id_bengkel', $outlet);
		$query = $this->db->get('pelanggan');

		$row = $query->row();
		$this->db->save_queries = false;

		return $row;
	}



	public function recentOrderBk()
	{
		$outlet = $this->session->userdata('outlet_id');

		$this->db->where('id_bengkel', $outlet);
		$this->db->where('status_order =', 1 );
		$this->db->order_by('id_order', 'desc');

		$query = $this->db->get('order');

		$result = $query->result();
		$this->db->save_queries = false;

		return $result;
	}

	public function orderJatuhTempoBk()
	{
		$outlet = $this->session->userdata('outlet_id');

		$this->db->select('order.*, sum(nominal) as jumpembayaran');
      	$this->db->join('pembayaran', 'pembayaran.id_order = order.id_order', 'left');

		$this->db->where('id_bengkel', $outlet);
		$this->db->where('jatuh_tempo <', date('Y-m-d'));
		$this->db->order_by('id_order', 'desc');
       	$this->db->group_by('order.id_order');

		$query = $this->db->get('order');

		$result = $query->result();
		$this->db->save_queries = false;

		return $result;
	}

	public function reorderProduk($minstock)
	{	
		$outlet = $this->session->userdata('outlet_id');

		$this->db->join('produk', 'produk.id_p = inventory.id_p');
		$this->db->join('kategori_produk', 'kategori_produk.id_kp = produk.category');
		$this->db->where('id_bengkel', $outlet);
		$this->db->where('stock <=', $minstock);
		$this->db->order_by('inventory.id_p', 'asc');

		$query = $this->db->get('inventory');

		$result = $query->result();
        $this->db->save_queries = false;

        return $result;
	}

	public function statusGudang($id)
	{
		$this->db->join('gudang', 'gudang.id_gudang = bengkel.wh');
		$this->db->where('id_bengkel', $id);

		$query = $this->db->get('bengkel');

		$result = $query->row();
		$this->db->save_queries = false;

		return $result;
	}

	public function getTotalPenjualan($start='', $end='')
    {
    	$this->db->select('sum(total) as totalpenjualan');
        $this->db->where("(penjualan.created_datetime BETWEEN '$start' and '$end')");
       
        $query = $this->db->get('penjualan');
        $row = $query->row();
        $this->db->save_queries = false;

        return $row;
    }

    public function getBeban($start='', $end='')
    {
    	$outlet_id = $this->session->userdata('outlet_id');

    	$this->db->select('kategori_pengeluaran.name, sum(amount) as totalbeban');
    	$this->db->join('kategori_pengeluaran', 'kategori_pengeluaran.id = pengeluaran.expense_category');
    	$this->db->where('pengeluaran.type', 'bengkel');
    	$this->db->where('pengeluaran.outlet_id', $outlet_id);
        $this->db->where("(pengeluaran.created_datetime BETWEEN '$start' and '$end')");

        $this->db->group_by('pengeluaran.expense_category');
       
        $query = $this->db->get('pengeluaran');
        $result = $query->result();
        $this->db->save_queries = false;

        return $result;
    }


// ----------------------------------dashboard Kasir------------------------------------

	public function jumOrderKs()
	{
		$outlet = $this->session->userdata('outlet_id'); //id kasir

		// $this->db->select('count(id_order) as jumorder');
		// $this->db->join('bengkel', 'bengkel.id_bengkel = kasir.id_bengkel');
		// $this->db->join('order', 'order.id_bengkel = bengkel.id_bengkel');
		// $this->db->where('id_kasir', $outlet);
		$this->db->select('count(id_penjualan) as jumorder');
		$this->db->where('created_user_id', $outlet);

		// $query = $this->db->get('kasir');
		$query = $this->db->get('penjualan');
        $row = $query->row();
        $this->db->save_queries = false;

        return $row;
	}

	
	public function jumPelangganKs()
	{
		$outlet = $this->session->userdata('outlet_id');

		$this->db->select('count(id) as pelanggan');
		$this->db->join('bengkel', 'bengkel.id_bengkel = kasir.id_bengkel');
		$this->db->join('pelanggan', 'pelanggan.id_bengkel = bengkel.id_bengkel');
		$this->db->not_like('nama', 'pelanggan');
		$this->db->where('id_kasir', $outlet);

		$query = $this->db->get('kasir');

		$row = $query->row();
		$this->db->save_queries = false;

		return $row;
	}

	public function pengumumanAdmin()
	{
		$this->db->order_by('tanggal', 'desc');
		$this->db->group_by('tanggal');

		$query = $this->db->get('pengumuman');

		$result = $query->result();
		$this->db->save_queries = false;

		return $result;

	}

	public function pengumuman($type, $outlet)
	{
		$this->db->where('type', $type);
		$this->db->where('id_outlet', $outlet);
		$this->db->order_by('tanggal', 'desc');

		$query = $this->db->get('pengumuman');

		$result = $query->result();
		$this->db->save_queries = false;

		return $result;

	}
	

}

/* End of file Dashboard_model.php */
/* Location: ./application/models/Dashboard_model.php */