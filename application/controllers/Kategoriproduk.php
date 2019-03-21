<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategoriproduk extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		//Load Dependencies
        $this->load->model('Constant_model');
        $this->load->model('Notifikasi_model');
        $this->load->model('Setting_model');

        $settingData = $this->Setting_model->getSetting();
        $setting_timezone = $settingData->timezone;  

        date_default_timezone_set("$setting_timezone");

	}

	private function getData(){
        $data = array(
            'title' => "Data Kategori Produk",
            // 'breadcumb' => "",
            'menu' => "kategoriproduk",
            'posisi' => "produk",
            'content' => "admin/produk/index-kategoriproduk",
            'param'=> array(
                'kategoriproduks' => $this->Constant_model->getDataAll('kategori_produk','id_kp','desc'),
                // 'siswas'=>$this->Siswa_model->getAllAccount_byWk(),
            ),
            'css' => array(
                1 => 'assets/base/assets/examples/css/uikit/modals', //modal
                2 => 'assets/global/vendor/datatables.net-bs4/dataTables.bootstrap4', //datatable ..
                3 => 'assets/global/vendor/datatables.net-responsive-bs4/dataTables.responsive.bootstrap4', //datatable ..
                4 => 'assets/global/vendor/datatables.net-buttons-bs4/dataTables.buttons.bootstrap4', //datatable ..
                5 => 'assets/global/vendor/datatables.net-select-bs4/dataTables.select.bootstrap4', //datatable ..
                6 => 'assets/base/assets/examples/css/tables/datatable', //datatable ..
                7 => 'assets/global/fonts/font-awesome/font-awesome', //font
                8 => 'assets/base/assets/examples/css/forms/masks', //mask
            ),
            // 'jscss' => array(
            //     1 => 'asset/bower_components/jquery/dist/jquery.min',
            //     // 2 => 'asset/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min',
            // ),
            'js' =>array(
                1 => 'assets/global/vendor/peity/jquery.peity.min',//mengelem tampil
                2 => 'assets/global/vendor/datatables.net/jquery.dataTables',//datatable
                3 => 'assets/global/vendor/datatables.net-bs4/dataTables.bootstrap4',
                4 => 'assets/global/vendor/datatables.net-responsive/dataTables.responsive',
                5 => 'assets/global/vendor/datatables.net-responsive-bs4/responsive.bootstrap4',
                6 => 'assets/global/vendor/datatables.net-buttons/dataTables.buttons',
                7 => 'assets/global/vendor/datatables.net-buttons/buttons.html5',
                8 => 'assets/global/vendor/datatables.net-buttons/buttons.flash',
                9 => 'assets/global/vendor/datatables.net-buttons/buttons.print',
                10 => 'assets/global/vendor/datatables.net-buttons/buttons.colVis',
                11 => 'assets/global/vendor/datatables.net-buttons-bs4/buttons.bootstrap4',
                12 => 'assets/global/vendor/asrange/jquery-asRange.min',
                13 => 'assets/global/vendor/bootbox/bootbox',
                14 => 'assets/global/vendor/formatter/jquery.formatter', //mask
                15 => 'assets/base/assets/examples/js/charts/peity', //men gelem tampil
                16 => 'assets/global/js/Plugin/jquery-placeholder', //material
                17 => 'assets/global/js/Plugin/material', //material
                18 => 'assets/global/js/Plugin/datatables', //datatable
                19 => 'assets/base/assets/examples/js/tables/datatable', //datatable
                20 => 'assets/global/js/Plugin/formatter' //mask
            )
        );
        return $data;
    }

	// List all your items
	public function index()
	{
        $role = $this->session->userdata('role');
        $outlet = $this->session->userdata('outlet_id');
        $content['notif'] = $this->Notifikasi_model->getData($role,$outlet);

        $data = array_merge($content, $this->getData());
        $this->load->view('admin/templates/layout', $data);

	}

// ****************************** Action To Database -- START ****************************** //

    public function ajax_edit($id)
    {
        $data = $this->Constant_model->getDataOneColumn('kategori_produk','id_kp', $id);
        // $data->tgl_lahir = ($data->tgl_lahir == '0000-00-00') ? '' : $data->tgl_lahir; // if 0000-00-00 set tu empty for datepicker compatibility
        echo json_encode($data);
    }

 
    public function update()
    {
        // $this->_validate();
        $id = $this->input->post('id');
        $nama = $this->input->post('nama');
        
        $data = array(
            'name_kp' => $nama,
            'het_supplier' => $this->input->post('het_supplier'),
            'het_gudang' => $this->input->post('het_gudang'),
            'het_bengkel' => $this->input->post('het_bengkel'),
            'updated_user_id' => $this->session->userdata('id'),
            'updated_datetime' => date('Y-m-d H:i:s', time()),
            'status' => $this->input->post('status'),
        );
  
        $this->Constant_model->updateDataDinamis('kategori_produk', $data, 'id_kp', $id);

        echo json_encode(array(
            "status" => TRUE,
            "flash_header"  => 'Update Kategori Produk',
            "flash_desc"  => 'Berhasil mengupdate Kategori '.$nama,
        ));
    }


    // Delete Bengkel;
    // public function delete()
    // {
    //     $id = $this->input->get('id');
    //     $cust_fn = $this->input->post('cust_fn');

    //     if ($this->Constant_model->deleteData('bengkel', $id)) {
    //         $this->session->set_flashdata('alert_msg', array('success', 'Delete Gudang', "Successfully Deleted Bengkel : $cust_fn."));
    //         redirect(base_url().'bengkel');
    //     }
    // }

     public function delete($id)
    {
        //delete file
        $kategori = $this->Constant_model->getDataOneColumn('kategori_produk','id_kp', $id);

        if ($this->Constant_model->deleteDataDinamis('kategori_produk','id_kp', $id)) {
            # code...
            echo json_encode(array(
                "status" => TRUE,
                "flash_header"  => 'Delete Kategori Produk',
                "flash_desc"  => 'Berhasil menghapus Kategori '.$kategori->name_kp,
            ));
        }

    }

    // Insert New Bengkel;
    public function add()
    {
        $nama = $this->input->post('nama');
        $tm = date('Y-m-d H:i:s', time());

        if (empty($nama)) {
            $this->session->set_flashdata('alert_msg', array('failure', 'Tambah Kategori Produk', 'masukkan Nama Kategori!'));
            // redirect(base_url().'kategoriproduk');
             echo json_encode(array(
                "status" => FALSE,
                "flash_header"  => 'Tambah Kategori Produk',
                "flash_desc"  => 'Gagal menambah produk, masukkan Nama Kategori!',
            ));

        } else {
            // if (!empty($email)) {
            //     $ckEmailData = $this->Constant_model->getDataOneColumn('bengkel', 'email', $email);

            //     if (count($ckEmailData) > 0) {
            //         $this->session->set_flashdata('alert_msg', array('failure', 'Tambah Bengkel', "E-mail $email telah terdaftar di sistem! Tolong gunakan E-mail yang lain!"));
            //         redirect(base_url().'bengkel/add');
            //         die();
            //     }
            // }

            $data = array(
                      'name_kp' => $nama,
                      // 'diskon' => $this->input->post('diskon'),
                      'het_supplier' => $this->input->post('het_supplier'),
                      'het_gudang' => $this->input->post('het_gudang'),
                      'het_bengkel' => $this->input->post('het_bengkel'),
                      'created_user_id' => $this->session->userdata('id'),
                      'created_datetime' => date('Y-m-d H:i:s', time()),
                      'updated_user_id' => '0',
                      'updated_datetime' => date('Y-m-d H:i:s', time()),
                      'status' => $this->input->post('status'),
            );

            if ($this->Constant_model->insertData('kategori_produk', $data)) {
                 echo json_encode(array(
                    "status" => TRUE,
                    "flash_header"  => 'Tambah Kategori Produk',
                    "flash_desc"  => 'Berhasil menambah Kategori '.$nama,
                ));
                
            }

        }

        // echo json_encode(array("status" => TRUE));
    }
}

/* End of file controllername.php */
/* Location: ./application/controllers/controllername.php */
