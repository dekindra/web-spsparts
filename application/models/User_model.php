<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		//Load Dependencies
		$this->load->database();

	}


 //    public function verifyLogIn($email, $password)
	// {
	// 	$this->db->where('email', $email);
	// 	$this->db->where('password', $password);
	// 	$result = $this->db->get('users');
	// 	if($result->num_rows()>0){
	// 		$id = $result->row(0)->id;
	// 		return $id;
	// 	}else{
	// 		return false;
	// 	}
	// }

	public function verifyLogIn($email)
	{
		$this->db->where('email', $email);
		// $this->db->where('password', $password);
		$result = $this->db->get('users');
		if($result->num_rows()>0){
			$id = $result->row(0)->id;
			return $id;
		}else{
			return false;
		}
	}


	public function getUser($email, $password)
	{
		// $this->db->select('*');
		// $this->db->from('users');
		$this->db->where('email', $email);
		$this->db->where('password', $password);

        $query = $this->db->get('users');
		if($query->num_rows()>0){
			return $query->row_array();
		}
	}

	public function setSession($email, $sessionId)
	{
		//get previous mapped session ID
		$this->db->select('session_id');
		$this->db->where('email', $email);

		$oldSessionId = $this->db->get('users')->row('session_id');

		if (!is_null($oldSessionId)) {
			//hapus yg lama
			$this->db->where('id', $oldSessionId);
			$this->db->delete('ci_sessions');
		}

		//update yg baru
		$this->db->where('email', $email);
		$this->db->update('users', array('session_id' => $sessionId));

	}
}

/* End of file User_model.php */
/* Location: ./application/models/User_model.php */
