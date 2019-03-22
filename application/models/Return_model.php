<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Return_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		//Load Dependencies

	}
    //////////////////////////admin///////////////////////////////////
    public function getTotalReturnAdmin()
    {
        $this->db->select('sum(total_retur) as totalreturn');
        $this->db->join('gudang', 'gudang.id_gudang = retur.id_gudang');

        $query = $this->db->get('retur');
        $row = $query->row();
        $this->db->save_queries = false;

        return $row;
    }

    public function getReturnMasukAdmin($start='', $end='', $status='' )
    {
        $outlet_id = $this->session->userdata('outlet_id');
        
        $this->db->join('gudang', 'gudang.id_gudang = retur.id_gudang');
        if( $start!='' && $end!='' && $status!='' && $status!='all' ){
            $this->db->where("status_retur='$status' and (retur.created_datetime BETWEEN '$start' and '$end' )");
        }else if( $start!='' && $end!='' && $status!='' && $status=='all' ){
            $this->db->where("(retur.created_datetime BETWEEN '$start' and '$end' )");
        }

        $this->db->order_by('id_retur', 'desc');
       
        $query = $this->db->get('retur');
        $result = $query->result();
        $this->db->save_queries = false;

        return $result;
    }

    public function getReturnJudulMasukAdmin($start='', $end='', $status='' )
    {
        $outlet_id = $this->session->userdata('outlet_id');
        
        $this->db->select('count(id_retur) as totaltransaksi, sum(total_retur) as totalreturn');
        $this->db->join('gudang', 'gudang.id_gudang = retur.id_gudang');

        if( $start!='' && $end!='' && $status!='' && $status!='all' ){
            $this->db->where("status_retur='$status' and (retur.created_datetime BETWEEN '$start' and '$end' )");
        }else if( $start!='' && $end!='' && $status!='' && $status=='all' ){
            $this->db->where("(retur.created_datetime BETWEEN '$start' and '$end' )");
        }

        $this->db->order_by('id_retur', 'desc');
       
        $query = $this->db->get('retur');
        $result = $query->row();
        $this->db->save_queries = false;

        return $result;
    }

    /////////////////////////bengkel/////////////////////////////////
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

    public function getDataDetail($id)
    {   
        $this->db->join('produk', 'produk.id_p = retur_detail.id_p');
        $this->db->where('id_retur', $id);

        $query = $this->db->get('retur_detail');
        $result = $query->result();
        $this->db->save_queries = false;

        return $result;
    }

    public function getDataGudangBengkel($id)
    {
        $this->db->select('bengkel.*, gudang.name as nameg, gudang.instansi as instansig, gudang.address as addressg, gudang.email as emailg, gudang.tel as telg');
        $this->db->join('gudang', 'gudang.id_gudang = bengkel.wh');
        $this->db->where('id_bengkel', $id);
        
        $query = $this->db->get('bengkel');
        $result = $query->row_array();
        $this->db->save_queries = false;

        return $result;
    }

    public function getTotalReturn($id)
    {
        $this->db->select('sum(total_retur) as totalreturn');
        $this->db->where('id_bengkel', $id);

        $query = $this->db->get('retur');
        $row = $query->row();
        $this->db->save_queries = false;

        return $row;
    }

    public function getReturn( $start='', $end='', $status='' )
    {
        $outlet_id = $this->session->userdata('outlet_id');

        if( $start!='' && $end!='' && $status!='' && $status!='all' ){
            $this->db->where("status_retur='$status' and (created_datetime BETWEEN '$start' and '$end' )");
        }else if( $start!='' && $end!='' && $status!='' && $status=='all' ){
            $this->db->where("(created_datetime BETWEEN '$start' and '$end' )");
        }
        $this->db->where('id_bengkel', $outlet_id);
        $this->db->order_by('id_retur', 'desc');
       
        $query = $this->db->get('retur');
        $result = $query->result();
        $this->db->save_queries = false;

        return $result;
    }

    public function getReturnJudul( $start='', $end='', $status='' )
    {
        $outlet_id = $this->session->userdata('outlet_id');
        
        $this->db->select('count(id_retur) as totaltransaksi, sum(total_retur) as totalreturn');
        if( $start!='' && $end!='' && $status!='' && $status!='all' ){
            $this->db->where("status_retur='$status' and (created_datetime BETWEEN '$start' and '$end' )");
        }else if( $start!='' && $end!='' && $status!='' && $status=='all' ){
            $this->db->where("(created_datetime BETWEEN '$start' and '$end' )");
        }
        $this->db->where('id_bengkel', $outlet_id);
        $this->db->order_by('id_retur', 'desc');
       
        $query = $this->db->get('retur');
        $result = $query->row();
        $this->db->save_queries = false;

        return $result;
    }

    //////////////end bengkel ////////////////////////
    ///////////////gudang.////////////////////////////

    public function getDataReturn($id)
    {
        $this->db->join('bengkel', 'bengkel.id_bengkel = retur.id_bengkel');
        $this->db->where('wh', $id);
        $this->db->order_by('id_retur', 'desc');
        
        $query = $this->db->get('retur');
        $result = $query->result();
        $this->db->save_queries = false;

        return $result;
    }

    public function getDataReturnProduk($id)
    {
        $this->db->select('id_p');
        $this->db->join('retur_detail', 'retur_detail.id_retur = retur.id_retur');
        $this->db->where('retur.id_retur', $id);
        
        $query = $this->db->get('retur');
        $result = $query->result();
        $this->db->save_queries = false;

        return $result;
    }

    public function getTotalReturnMasuk($id)
    {
        $this->db->select('sum(total_retur) as totalreturn');
        $this->db->join('bengkel','bengkel.id_bengkel = retur.id_bengkel');
        $this->db->where('bengkel.wh', $id);

        $query = $this->db->get('retur');
        $row = $query->row();
        $this->db->save_queries = false;

        return $row;
    }

    public function getReturnMasuk( $start='', $end='', $status='' )
    {
        $outlet_id = $this->session->userdata('outlet_id');

        $this->db->join('bengkel', 'bengkel.id_bengkel = retur.id_bengkel');
        if( $start!='' && $end!='' && $status!='' && $status!='all' ){
            $this->db->where("status_retur='$status' and (retur.created_datetime BETWEEN '$start' and '$end' )");
        }else if( $start!='' && $end!='' && $status!='' && $status=='all' ){
            $this->db->where("(retur.created_datetime BETWEEN '$start' and '$end' )");
        }
        $this->db->where('wh', $outlet_id);
        $this->db->order_by('id_retur', 'desc');
       
        $query = $this->db->get('retur');
        $result = $query->result();
        $this->db->save_queries = false;

        return $result;
    }

    public function getReturnJudulMasuk( $start='', $end='', $status='' )
    {
        $outlet_id = $this->session->userdata('outlet_id');
        
        $this->db->join('bengkel', 'bengkel.id_bengkel = retur.id_bengkel');

        $this->db->select('count(id_retur) as totaltransaksi, sum(total_retur) as totalreturn');
        if( $start!='' && $end!='' && $status!='' && $status!='all' ){
            $this->db->where("status_retur='$status' and (retur.created_datetime BETWEEN '$start' and '$end' )");
        }else if( $start!='' && $end!='' && $status!='' && $status=='all' ){
            $this->db->where("(retur.created_datetime BETWEEN '$start' and '$end' )");
        }
        $this->db->where('wh', $outlet_id);
        $this->db->order_by('id_retur', 'desc');
       
        $query = $this->db->get('retur');
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


    public function getTotalReturnGd($id)
    {
        $this->db->select('sum(total_retur) as totalreturn');
        $this->db->where('id_gudang', $id);

        $query = $this->db->get('retur');
        $row = $query->row();
        $this->db->save_queries = false;

        return $row;
    }

    public function getReturnKeluar( $start='', $end='', $status='' )
    {
        $outlet_id = $this->session->userdata('outlet_id');

        if( $start!='' && $end!='' && $status!='' && $status!='all' ){
            $this->db->where("status_retur='$status' and (retur.created_datetime BETWEEN '$start' and '$end' )");
        }else if( $start!='' && $end!='' && $status!='' && $status=='all' ){
            $this->db->where("(retur.created_datetime BETWEEN '$start' and '$end' )");
        }
        $this->db->where('id_gudang', $outlet_id);
        $this->db->order_by('id_retur', 'desc');
       
        $query = $this->db->get('retur');
        $result = $query->result();
        $this->db->save_queries = false;

        return $result;
    }

    public function getReturnJudulKeluar( $start='', $end='', $status='' )
    {
        $outlet_id = $this->session->userdata('outlet_id');

        $this->db->select('count(id_retur) as totaltransaksi, sum(total_retur) as totalreturn');
        if( $start!='' && $end!='' && $status!='' && $status!='all' ){
            $this->db->where("status_retur='$status' and (retur.created_datetime BETWEEN '$start' and '$end' )");
        }else if( $start!='' && $end!='' && $status!='' && $status=='all' ){
            $this->db->where("(retur.created_datetime BETWEEN '$start' and '$end' )");
        }
        $this->db->where('id_gudang', $outlet_id);
        $this->db->order_by('id_retur', 'desc');
       
        $query = $this->db->get('retur');
        $result = $query->row();
        $this->db->save_queries = false;

        return $result;
    }

     public function getDtProdukGudang($cari, $id)
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
        $this->db->where('inventory.id_gudang', $id);
        $query = $this->db->get('produk');
        $result = $query->result();
        $this->db->save_queries = false;

        return $result;
    }



}

/* End of file penjualan_model.php */
/* Location: ./application/models/penjualan_model.php */