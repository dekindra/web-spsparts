<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kasir_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		//Load Dependencies

	}

	public function getDataOneJoinWhereRow()
    {   
    	$id = $this->session->userdata('outlet_id');
    	$this->db->select('id_kasir, kasir.name as namakasir, kasir.email, kasir.password, kasir.id_bengkel, bengkel.name as namabengkel, kasir.photo');
    	$this->db->join('bengkel', 'kasir.id_bengkel = bengkel.id_bengkel');
    	$this->db->where('id_kasir', $id);
        $this->db->order_by('kasir.id_kasir', 'desc');
        $query = $this->db->get('kasir');
        $result = $query->row();
        $this->db->save_queries = false;

        return $result;
    }

}

/* End of file Kasir_model.php */
/* Location: ./application/models/Kasir_model.php */
