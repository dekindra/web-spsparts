<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setting_model extends CI_Model {

	public function getSetting()
	{
		$query = $this->db->get('site_setting');

		$result = $query->row();
        $this->db->save_queries = false;

        return $result;
	}

}

/* End of file Setting_model.php */
/* Location: ./application/models/Setting_model.php */