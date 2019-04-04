<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Wishlist_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
		$this->load->database();
	}

	public function getWishlist($type, $id_outlet){
		$this->db->join('produk', 'produk.id_p = order_wishlist.id_p');
		$this->db->where('type', $type);
		$this->db->where('id_outlet', $id_outlet);
		$this->db->order_by('tanggal', 'desc');

		$query = $this->db->get('order_wishlist');
        $result = $query->result();
        $this->db->save_queries = false;

        return $result;
		
	}

	public function getTotalWishlist($type, $id_outlet){
		$this->db->select('sum(subtotal) as totalwishlist');
		$this->db->where('type', $type);
		$this->db->where('id_outlet', $id_outlet);

		$query = $this->db->get('order_wishlist');
        $row = $query->row();
        $this->db->save_queries = false;

        return $row;
		
	}


	

}

/* End of file Wishlist_model.php */
/* Location: ./application/models/Wishlist_model.php */