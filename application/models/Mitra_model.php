<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mitra_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
		$this->load->database();
	}

	// list data bengkel beserta nominal order(controler bengkel function getdatabengkel)
	public function getListBengkel($outlet_id){
		$this->db->select('*, SUM(total_tagihan) as nomorder');
		$this->db->join('bengkel', 'bengkel.id_bengkel = order.id_bengkel','right');
		$this->db->where('bengkel.wh', $outlet_id);
		$this->db->group_by('order.id_bengkel');

		$query = $this->db->get('order');
        $result = $query->result();
        $this->db->save_queries = false;

        return $result;
		
	}

	// list data bengkel beserta nominal order(controler bengkel function getdata)
	public function getBengkel(){
		$this->db->select('*, SUM(total_tagihan) as nomorder');
		$this->db->join('bengkel', 'bengkel.id_bengkel = order.id_bengkel','right');
		$this->db->group_by('bengkel.id_bengkel');

		$query = $this->db->get('order');
        $result = $query->result();
        $this->db->save_queries = false;

        return $result;
		
	}

	// list data gudang beserta nominal order(controler gudang function getdata)
	public function getGudang(){

		$this->db->select('*, SUM(total_tagihan) as nomorder');
		$this->db->join('gudang', 'gudang.id_gudang = order.id_gudang','right');
		$this->db->group_by('gudang.id_gudang');

		$query = $this->db->get('order');
        $result = $query->result();
        $this->db->save_queries = false;

        return $result;
		
	}


	

}

/* End of file Mitra_model.php */
/* Location: ./application/models/Mitra_model.php */