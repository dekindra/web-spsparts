<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengumuman_model extends CI_Model {
	public function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->load->database();
    }

	public function getDtBengkel()
	{
		$this->db->where('status', '1');
        $query = $this->db->get('bengkel');
        $result = $query->result();
        $this->db->save_queries = false;

        return $result;
	}

	public function getDtGudang()
	{
		$this->db->where('status', '1');
        $query = $this->db->get('gudang');
        $result = $query->result();
        $this->db->save_queries = false;

        return $result;
	}

}

/* End of file Pengumuman_model.php */
/* Location: ./application/models/Pengumuman_model.php */