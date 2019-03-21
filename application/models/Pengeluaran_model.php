<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengeluaran_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		//Load Dependencies

	}

    public function getPengeluaran( $start='', $end='', $kategori='' )
    {
        $outlet_id = $this->session->userdata('outlet_id');
        $role = $this->session->userdata('role');

        $this->db->join('kategori_pengeluaran', 'kategori_pengeluaran.id = pengeluaran.expense_category');
        if( $start!='' && $end!='' && $kategori!='' && $kategori!='all' ){
            $this->db->where("pengeluaran.expense_category='$kategori' and (pengeluaran.date BETWEEN '$start' and '$end' )");
        }else if( $start!='' && $end!='' && $kategori!='' && $kategori=='all' ){
            $this->db->where("(pengeluaran.date BETWEEN '$start' and '$end' )");
        }

        if ($role == '1') {
            $this->db->where('pengeluaran.type =', 'admin');
        }elseif($role == '2'){
            $this->db->where('pengeluaran.type = ', 'gudang');
            $this->db->where('pengeluaran.outlet_id =', $outlet_id);
        } else {
            $this->db->where('pengeluaran.type = ', 'bengkel');
            $this->db->where('pengeluaran.outlet_id =', $outlet_id);
        }
        

        $this->db->order_by('pengeluaran.date', 'desc');
       
        $query = $this->db->get('pengeluaran');
        $result = $query->result();
        $this->db->save_queries = false;

        return $result;
    }

    public function getPengeluaranJudul( $start='', $end='', $kategori='' )
    {
        $outlet_id = $this->session->userdata('outlet_id');
        $role = $this->session->userdata('role');

        $this->db->select('count(pengeluaran.id_pengeluaran) as totaltransaksi, sum(pengeluaran.amount) as totalpengeluaran');
         // $this->db->join('kategori_pengeluaran', 'kategori_pengeluaran.id = pengeluaran.expense_category');
        if( $start!='' && $end!='' && $kategori!='' && $kategori!='all' ){
            $this->db->where("pengeluaran.expense_category='$kategori' and (pengeluaran.date BETWEEN '$start' and '$end' )");
        }else if( $start!='' && $end!='' && $kategori!='' && $kategori=='all' ){
            $this->db->where("(pengeluaran.date BETWEEN '$start' and '$end' )");
        }

        if ($role == '1') {
            $this->db->where('pengeluaran.type =', 'admin');
        }elseif($role == '2'){
            $this->db->where('pengeluaran.type = ', 'gudang');
            $this->db->where('pengeluaran.outlet_id =', $outlet_id);
        } else {
            $this->db->where('pengeluaran.type = ', 'bengkel');
            $this->db->where('pengeluaran.outlet_id =', $outlet_id);
        }

        $this->db->order_by('pengeluaran.date', 'desc');
       
        $query = $this->db->get('pengeluaran');
        $result = $query->row();
        $this->db->save_queries = false;

        return $result;
    }

    public function totalPengeluaran($id){
        $this->db->select('sum(amount) as totalpengeluaran');
        $this->db->where('type = ', 'bengkel');
        $this->db->where('outlet_id', $id);

        $query = $this->db->get('pengeluaran');
        $result = $query->row();
        $this->db->save_queries = false;

        return $result;
    }

    public function totalPengeluaranGd($id){
        $this->db->select('sum(amount) as totalpengeluaran');
        $this->db->where('type = ', 'gudang');
        $this->db->where('outlet_id', $id);

        $query = $this->db->get('pengeluaran');
        $result = $query->row();
        $this->db->save_queries = false;

        return $result;
    }

    public function totalPengeluaranAdmin(){
        $this->db->select('sum(amount) as totalpengeluaran');
        $this->db->where('type = ', 'admin');

        $query = $this->db->get('pengeluaran');
        $result = $query->row();
        $this->db->save_queries = false;

        return $result;
    }

}

/* End of file penjualan_model.php */
/* Location: ./application/models/penjualan_model.php */