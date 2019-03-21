<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notifikasi extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		//Load Dependencies
		$this->load->model('Notifikasi_model');

	}

	//Update one item
	public function read()
    {	
    	$role = $this->session->userdata('role');
    	$outlet = $this->session->userdata('outlet');


    	$this->Notifikasi_model->updateData($role,$outlet);

    	// redirect($this->uri->uri_string()); current page
    	redirect($_SERVER['HTTP_REFERER']);

	}

}

/* End of file Notifikasi.php */
/* Location: ./application/controllers/Notifikasi.php */
