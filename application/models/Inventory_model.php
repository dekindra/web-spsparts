<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inventory_model extends CI_Model {
	public function __construct()
	{
		parent::__construct();
		//Do your magic here
		$this->load->database();
	}

	public function getInventoryGudang($id)
	{
		$this->db->join('produk', 'produk.id_p = inventory.id_p');
		$this->db->join('kategori_produk', 'kategori_produk.id_kp = produk.category');
		$this->db->where('id_gudang', $id);
		$this->db->order_by('inventory.id_p', 'asc');

		$query = $this->db->get('inventory');

		$result = $query->result();
        $this->db->save_queries = false;

        return $result;
	}

	public function getInventoryBengkel($id)
	{
		$this->db->join('produk', 'produk.id_p = inventory.id_p');
		$this->db->join('kategori_produk', 'kategori_produk.id_kp = produk.category');
		$this->db->where('id_bengkel', $id);
		$this->db->order_by('inventory.id_p', 'asc');

		$query = $this->db->get('inventory');

		$result = $query->result();
        $this->db->save_queries = false;

        return $result;
	}

	

}

/* End of file Inventory_model.php */
/* Location: ./application/models/Inventory_model.php */