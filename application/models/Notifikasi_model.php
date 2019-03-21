<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notifikasi_model extends CI_Model {

	public function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->load->database();
    }

    public function getData($role,$outlet)
    {
        $this->db->where('role', $role);
        $this->db->where('outlet', $outlet);
        $this->db->where('status', '0');
        $this->db->order_by('created_datetime', 'desc');

        $query = $this->db->get('notifikasi');
        $result = $query->result();
        $this->db->save_queries = false;

        return $result;
    }

    public function updateData($role,$outlet)
    {
        $this->db->set('status', '1');
        $this->db->where('role', $role);
        $this->db->where('outlet', $outlet);
        $this->db->update('notifikasi');

        return true;
    }



}

/* End of file Notifikasi_model.php */
/* Location: ./application/models/Notifikasi_model.php */