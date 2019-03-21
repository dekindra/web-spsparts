<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengumuman extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		//Load Dependencies

		$this->load->model('Pengumuman_model');
		$this->load->model('Constant_model');

	}

	// List all your items
	public function index( $offset = 0 )
	{

	}

	// Add a new item
	public function add()
	{
        $data = [];
        $tm = date('Y-m-d H:i:s', time());
        $to = $this->input->post('inputRadios');

        if ($to == "bengkel") {
			$bengkel = $this->Pengumuman_model->getDtBengkel();
        		
        	foreach ($bengkel as $key) {
	    		$data[] = array(
		          	'judul' => $this->input->post('judul'),
		          	'pengumuman' => $this->input->post('pengumuman'),
		          	'tanggal' => date('Y-m-d H:i:s', time()),
		          	'jeniskirim' => 'Bengkel',
		          	'type' => 'bengkel',
		          	'id_outlet' => $key->id_bengkel,
	        	);
	    	}

        }elseif ($to == "gudang") {
        	$gudang = $this->Pengumuman_model->getDtGudang();
        		
        	foreach ($gudang as $key) {
	    		$data[] = array(
	    			'judul' => $this->input->post('judul'),
		          	'pengumuman' => $this->input->post('pengumuman'),
		          	'tanggal' => date('Y-m-d H:i:s', time()),
		          	'jeniskirim' => 'Gudang',
		          	'type' => 'gudang',
		          	'id_outlet' => $key->id_gudang,
	        	);
	    	}

        }elseif ($to == "all") {
        	$bengkel = $this->Pengumuman_model->getDtBengkel();
        	$gudang = $this->Pengumuman_model->getDtGudang();
        		
        	foreach ($bengkel as $key) {
	    		$data[] = array(
	    			'judul' => $this->input->post('judul'),
		          	'pengumuman' => $this->input->post('pengumuman'),
		          	'tanggal' => date('Y-m-d H:i:s', time()),
		          	'jeniskirim' => 'Semua',
		          	'type' => 'bengkel',
		          	'id_outlet' => $key->id_bengkel,
	        	);
	    	}

        	foreach ($gudang as $key) {
	    		$data[] = array(
	    			'judul' => $this->input->post('judul'),
		          	'pengumuman' => $this->input->post('pengumuman'),
		          	'tanggal' => date('Y-m-d H:i:s', time()),
		          	'jeniskirim' => 'Semua',
		          	'type' => 'gudang',
		          	'id_outlet' => $key->id_gudang,
	        	);
	    	}

        } else {
        	echo json_encode(array(
	            "status" => False,
	            "flash_header"  => 'Buat Pengumuman',
	            "flash_desc"  => 'Gagal mengirim pesan',
	        )); 
	        die();
        }
        

        if ($this->db->insert_batch('pengumuman', $data)) {
        	echo json_encode(array(
	            "status" => TRUE,
	            "flash_header"  => 'Buat Pengumuman',
	            "flash_desc"  => 'Berhasil mengirim pesan',
	        )); 
        }

	}

	public function ajax_detail($id)
    {
        $data = $this->Constant_model->getDataOneColumn('pengumuman','id', $id);
        echo json_encode($data);
    }

	//Update one item
	public function update( $id = NULL )
	{

	}

	//Delete one item
	public function delete( $id = NULL )
	{

	}
}

/* End of file Pengumuman.php */
/* Location: ./application/controllers/Pengumuman.php */
