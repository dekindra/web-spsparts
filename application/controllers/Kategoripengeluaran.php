<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategoripengeluaran extends CI_Controller {

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

	private function getDataAdmin(){
        $data = array(
            'title' => "Data Kategori Pengeluaran",
            // 'breadcumb' => "",
            'menu' => "kategoripengeluaran",
            'posisi' => "pengeluaran",
            'content' => "admin/beban/index-kategoribeban",
            'param'=> array(
                'kategoripengeluarans' => $this->Constant_model->getDataOneColumnResult('kategori_pengeluaran','type','admin'),
                // 'absensis' => $this->Absensi_model->getAllAccount(),
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
                14 => 'assets/base/assets/examples/js/charts/peity', //men gelem tampil
                15 => 'assets/global/js/Plugin/jquery-placeholder', //material
                16 => 'assets/global/js/Plugin/material', //material
                17 => 'assets/global/js/Plugin/datatables', //datatable
                18 => 'assets/base/assets/examples/js/tables/datatable' //datatable
            )
        );
        return $data;
    }
    private function getDataGudang(){
        $outlet_id = $this->session->userdata('outlet_id');
        $data = array(
            'title' => "Data Kategori Pengeluaran",
            // 'breadcumb' => "",
            'menu' => "kategoripengeluaran",
            'posisi' => "pengeluaran",
            'content' => "admin/beban/index-kategoribeban",
            'param'=> array(
                'kategoripengeluarans' => $this->Constant_model->getDataTwoColumn('kategori_pengeluaran','type','gudang','outlet_id',"$outlet_id"),
                // 'absensis' => $this->Absensi_model->getAllAccount(),
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
                14 => 'assets/base/assets/examples/js/charts/peity', //men gelem tampil
                15 => 'assets/global/js/Plugin/jquery-placeholder', //material
                16 => 'assets/global/js/Plugin/material', //material
                17 => 'assets/global/js/Plugin/datatables', //datatable
                18 => 'assets/base/assets/examples/js/tables/datatable' //datatable
            )
        );
        return $data;
    }

    private function getDataBengkel(){
        $outlet_id = $this->session->userdata('outlet_id');
        $data = array(
            'title' => "Data Kategori Pengeluaran",
            // 'breadcumb' => "",
            'menu' => "kategoripengeluaran",
            'posisi' => "pengeluaran",
            'content' => "admin/beban/index-kategoribeban",
            'param'=> array(
                'kategoripengeluarans' => $this->Constant_model->getDataTwoColumn('kategori_pengeluaran','type','bengkel','outlet_id',"$outlet_id"),
                // 'absensis' => $this->Absensi_model->getAllAccount(),
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
                14 => 'assets/base/assets/examples/js/charts/peity', //men gelem tampil
                15 => 'assets/global/js/Plugin/jquery-placeholder', //material
                16 => 'assets/global/js/Plugin/material', //material
                17 => 'assets/global/js/Plugin/datatables', //datatable
                18 => 'assets/base/assets/examples/js/tables/datatable' //datatable
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

        if ($this->session->userdata('type') == 'admin') {
            $data = array_merge($content, $this->getDataAdmin());
            $this->load->view('admin/templates/layout', $data);
            // $this->load->view('admin/templates/layout', $this->getDataAdmin());
        } elseif ($this->session->userdata('type') == 'gudang') {
            $data = array_merge($content, $this->getDataGudang());
            $this->load->view('admin/templates/layout', $data);
            // $this->load->view('admin/templates/layout', $this->getDataGudang());
        } else {
            $data = array_merge($content, $this->getDataBengkel());
            $this->load->view('admin/templates/layout', $data);
            // $this->load->view('admin/templates/layout', $this->getDataBengkel());
        }
	}

	// ****************************** Action To Database -- START ****************************** //

    public function ajax_edit($id)
    {
        $data = $this->Constant_model->getDataOneColumn('kategori_pengeluaran','id', $id);
        // $data->tgl_lahir = ($data->tgl_lahir == '0000-00-00') ? '' : $data->tgl_lahir; // if 0000-00-00 set tu empty for datepicker compatibility
        echo json_encode($data);
    }

 
    public function update()
    {
        // $this->_validate();
        $id = $this->input->post('id');
        
        $data = array(
            'name' => $this->input->post('nama'),
            'updated_user_id' => $this->session->userdata('id'),
            'updated_datetime' => date('Y-m-d H:i:s', time()),
            'status' => $this->input->post('status'),
        );
  
        $this->Constant_model->updateData('kategori_pengeluaran', $data, $id);
        $this->session->set_flashdata('alert_msg', array('success', 'Update Kategori Pengeluaran', 'Berhasil mengupdate Kategori '.$this->input->post('nama')));

        echo json_encode(array("status" => TRUE));
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
        $kategori = $this->Constant_model->getDataOneColumn('kategori_pengeluaran','id', $id);

        $this->Constant_model->deleteData('kategori_pengeluaran', $id);
        $this->session->set_flashdata('alert_msg', array('success', 'Delete Kategori Pengeluaran', 'Berhasil menghapus Kategori '.$kategori->name));

        echo json_encode(array("status" => TRUE));
    }

    // Insert New Bengkel;
    public function add()
    {
        $nama = $this->input->post('nama');
        $tm = date('Y-m-d H:i:s', time());

        if (empty($nama)) {
            $this->session->set_flashdata('alert_msg', array('failure', 'Tambah Kategori Pengeluaran', 'masukkan Nama Kategori!'));
            // redirect(base_url().'kategoriproduk');
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
                      'name' => $nama,
                      'type' => $this->session->userdata('type'),
                      'outlet_id' => $this->session->userdata('outlet_id'),
                      'created_user_id' => $this->session->userdata('id'),
                      'created_datetime' => date('Y-m-d H:i:s', time()),
                      'updated_user_id' => '0',
                      'updated_datetime' => date('Y-m-d H:i:s', time()),
                      'status' => $this->input->post('status'),
            );

            if ($this->Constant_model->insertData('kategori_pengeluaran', $data)) {
                $this->session->set_flashdata('alert_msg', array('success', 'Tambah Kategori Pengeluaran', "Berhasil menambahkan Kategori $nama"));
                // redirect(base_url().'kategoriproduk');
            }

        }

        echo json_encode(array("status" => TRUE));
    }
}

/* End of file controllername.php */
/* Location: ./application/controllers/controllername.php */
