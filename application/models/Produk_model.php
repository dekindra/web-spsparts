<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk_model extends CI_Model {
	private $table = "produk";

	public function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->load->database();
    }

    // Fungsi untuk melakukan proses upload file
	public function upload_file($filename){
		$this->load->library('upload'); // Load librari upload
		
		$config['upload_path'] = './excel/';
		$config['allowed_types'] = 'xlsx';
		$config['max_size']	= '2048';
		$config['overwrite'] = true;
		$config['file_name'] = $filename;
	
		$this->upload->initialize($config); // Load konfigurasi uploadnya
		if($this->upload->do_upload('importproduk')){ // Lakukan upload dan Cek jika proses upload berhasil
			// Jika berhasil :
			$return = array('result' => 'success', 'importproduk' => $this->upload->data(), 'error' => '');
			return $return;
		}else{
			// Jika gagal :
			$return = array('result' => 'failed', 'importproduk' => '', 'error' => $this->upload->display_errors());
			return $return;
		}
	}

	public function cekdata($kode){
		$this->db->where('code_p', $kode);

        $query = $this->db->get($this->table);

        if($query->num_rows()>0){
			return $query->row_array();
		}
	}

	public function insertData($data)
    {
        return $this->db->insert($this->table, $data);
    }

	public function updateData($kode, $data)
    {
        $this->db->where('code_p', $kode);
        $this->db->update($this->table, $data);

        return true;
    }

	

}

/* End of file produk_model.php */
/* Location: ./application/models/produk_model.php */