<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengeluaran extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		//Load Dependencies
        $this->load->model('Constant_model');
        $this->load->model('Notifikasi_model');
        $this->load->model('Setting_model');
        $this->load->model('Pengeluaran_model');

        $settingData = $this->Setting_model->getSetting();
        $setting_timezone = $settingData->timezone;  

        date_default_timezone_set("$setting_timezone");

	}

	private function getDataAdmin(){
        $data = array(
            'title' => "Data Pengeluaran",
            // 'breadcumb' => "",
            'menu' => "pengeluaran",
            'posisi' => "pengeluaran",
            'content' => "admin/beban/index-beban",
            'param'=> array(
                // 'pengeluarans' => $this->Constant_model->getDataOneColumnResult('pengeluaran','type','admin'),
                'pengeluarans' => $this->Constant_model->getDataOneJoinWhere('pengeluaran','expense_category','kategori_pengeluaran','id', 'pengeluaran.type','admin', 'id_pengeluaran', 'desc'),
                'totalpengeluaran' => $this->Pengeluaran_model->totalPengeluaranAdmin(),
                'kategoris' => $this->Constant_model->getDataOneColumnResult('kategori_pengeluaran','type','admin'),
            ),
            'css' => array(
                1 => 'assets/base/assets/examples/css/uikit/modals', //modal
                2 => 'assets/global/vendor/datatables.net-bs4/dataTables.bootstrap4', //datatable ..
                3 => 'assets/global/vendor/datatables.net-responsive-bs4/dataTables.responsive.bootstrap4', //datatable ..
                4 => 'assets/global/vendor/datatables.net-buttons-bs4/dataTables.buttons.bootstrap4', //datatable ..
                5 => 'assets/global/vendor/datatables.net-select-bs4/dataTables.select.bootstrap4', //datatable ..
                6 => 'assets/base/assets/examples/css/tables/datatable', //datatable ..
                7 => 'assets/base/assets/examples/css/forms/masks', //mask
                8 => 'assets/global/fonts/font-awesome/font-awesome', //font
                9 => 'assets/global/vendor/bootstrap-datepicker/bootstrap-datepicker', //datepicker
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
                20 => 'assets/global/js/Plugin/formatter', //mask
                21 => 'assets/global/vendor/bootstrap-datepicker/bootstrap-datepicker', //datepicker
                22 => 'assets/global/js/Plugin/bootstrap-datepicker' //datepicker
            )
        );
        return $data;
    }

    private function getDataGudang(){
        $outlet_id = $this->session->userdata('outlet_id');
        $data = array(
            'title' => "Data Pengeluaran",
            // 'breadcumb' => "",
            'menu' => "pengeluaran",
            'posisi' => "pengeluaran",
            'content' => "admin/beban/index-beban",
            'param'=> array(
                // 'pengeluarans' => $this->Constant_model->getDataTwoColumn('pengeluaran','type','gudang','outlet_id',"$outlet_id"),
                'pengeluarans' => $this->Constant_model->getDataOneJoinTwoWhere('pengeluaran', 'expense_category', 'kategori_pengeluaran', 'id' ,'pengeluaran.type','gudang','pengeluaran.outlet_id',"$outlet_id", 'pengeluaran.id_pengeluaran', 'desc'),
                'totalpengeluaran' => $this->Pengeluaran_model->totalPengeluaranGd($outlet_id),
                'kategoris' => $this->Constant_model->getDataTwoColumn('kategori_pengeluaran','type','gudang','outlet_id',"$outlet_id"),
            ),
            'css' => array(
                1 => 'assets/base/assets/examples/css/uikit/modals', //modal
                2 => 'assets/global/vendor/datatables.net-bs4/dataTables.bootstrap4', //datatable ..
                3 => 'assets/global/vendor/datatables.net-responsive-bs4/dataTables.responsive.bootstrap4', //datatable ..
                4 => 'assets/global/vendor/datatables.net-buttons-bs4/dataTables.buttons.bootstrap4', //datatable ..
                5 => 'assets/global/vendor/datatables.net-select-bs4/dataTables.select.bootstrap4', //datatable ..
                6 => 'assets/base/assets/examples/css/tables/datatable', //datatable ..
                7 => 'assets/base/assets/examples/css/forms/masks', //mask
                8 => 'assets/global/fonts/font-awesome/font-awesome', //font
                9 => 'assets/global/vendor/bootstrap-datepicker/bootstrap-datepicker', //datepicker
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
                20 => 'assets/global/js/Plugin/formatter', //mask
                21 => 'assets/global/vendor/bootstrap-datepicker/bootstrap-datepicker', //datepicker
                22 => 'assets/global/js/Plugin/bootstrap-datepicker' //datepicker
            )
        );
        return $data;
    }

    private function getDataBengkel(){
        $outlet_id = $this->session->userdata('outlet_id');
        $data = array(
            'title' => "Data Pengeluaran",
            // 'breadcumb' => "",
            'menu' => "pengeluaran",
            'posisi' => "pengeluaran",
            'content' => "admin/beban/index-beban",
            'param'=> array(
                // 'pengeluarans' => $this->Constant_model->getDataTwoColumn('pengeluaran','type','bengkel','outlet_id',"$outlet_id"),
                'pengeluarans' => $this->Constant_model->getDataOneJoinTwoWhere('pengeluaran', 'expense_category', 'kategori_pengeluaran', 'id' ,'pengeluaran.type','bengkel','pengeluaran.outlet_id',"$outlet_id", 'pengeluaran.id_pengeluaran', 'desc'),
                'totalpengeluaran' => $this->Pengeluaran_model->totalPengeluaran($outlet_id),
                'kategoris' => $this->Constant_model->getDataTwoColumn('kategori_pengeluaran','type','bengkel','outlet_id',"$outlet_id"),
            ),
            'css' => array(
                1 => 'assets/base/assets/examples/css/uikit/modals', //modal
                2 => 'assets/global/vendor/datatables.net-bs4/dataTables.bootstrap4', //datatable ..
                3 => 'assets/global/vendor/datatables.net-responsive-bs4/dataTables.responsive.bootstrap4', //datatable ..
                4 => 'assets/global/vendor/datatables.net-buttons-bs4/dataTables.buttons.bootstrap4', //datatable ..
                5 => 'assets/global/vendor/datatables.net-select-bs4/dataTables.select.bootstrap4', //datatable ..
                6 => 'assets/base/assets/examples/css/tables/datatable', //datatable ..
                7 => 'assets/base/assets/examples/css/forms/masks', //mask
                8 => 'assets/global/fonts/font-awesome/font-awesome', //font
                9 => 'assets/global/vendor/bootstrap-datepicker/bootstrap-datepicker', //datepicker
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
                20 => 'assets/global/js/Plugin/formatter', //mask
                21 => 'assets/global/vendor/bootstrap-datepicker/bootstrap-datepicker', //datepicker
                22 => 'assets/global/js/Plugin/bootstrap-datepicker' //datepicker
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
        $data = $this->Constant_model->getDataOneColumn('pengeluaran','id_pengeluaran', $id);
        // $data->tgl_lahir = ($data->tgl_lahir == '0000-00-00') ? '' : $data->tgl_lahir; // if 0000-00-00 set tu empty for datepicker compatibility
        echo json_encode($data);
    }

 
    public function update()
    {   
        $id = $this->input->post('id');
        $tm = date('Y-m-d H:i:s', time());
        // $this->_validate();
            $data = array(
                    'code' => $this->input->post('kode'),
                      'expense_category' => $this->input->post('kategori'),
                      'date' => $this->input->post('date'),
                      'amount' => $this->input->post('nominal'),
                      'reason' => $this->input->post('keterangan'),
                      'updated_user_id' => $this->session->userdata('id'),
                      'updated_datetime' => $tm,
            );
 
        if($this->input->post('remove_photo')) // if remove photo checked
        {
            if(file_exists('assets/images/pengeluaran/'.$this->input->post('remove_photo')) && $this->input->post('remove_photo'))
                unlink('assets/images/pengeluaran/'.$this->input->post('remove_photo'));
            $data['nota'] = '';
        }
 
        if(!empty($_FILES['nota']['name']))
        {
            $upload = $this->_do_upload();
             
            //delete file
            $pengeluaran = $this->Constant_model->getDataOneColumn('pengeluaran','id_pengeluaran', $id);
            if(file_exists('assets/images/pengeluaran/'.$pengeluaran->nota) && $pengeluaran->nota)
                unlink('assets/images/pengeluaran/'.$pengeluaran->nota);
 
            $data['nota'] = $upload;
        }
 
        $this->Constant_model->updateDataDinamis('pengeluaran', $data, 'id_pengeluaran', $id);

        echo json_encode(array(
            "status" => TRUE,
            "flash_header"  => 'Update Pengeluaran',
            "flash_desc"  => 'Berhasil mengupdate Pengeluaran '.$this->input->post('code'),
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
        $pengeluaran = $this->Constant_model->getDataOneColumn('pengeluaran','id_pengeluaran', $id);

        if(file_exists('assets/images/pengeluaran/'.$pengeluaran->nota) && $pengeluaran->nota)
            unlink('assets/images/pengeluaran/'.$pengeluaran->nota);

        $this->Constant_model->deleteDataDinamis('pengeluaran','id_pengeluaran', $id);

        echo json_encode(array(
            "status" => TRUE,
            "flash_header"  => 'Delete Pengeluaran',
            "flash_desc"  => 'Berhasil menghapus pengeluaran '.$pengeluaran->code,
        ));

    }

    // Insert New Bengkel;
    public function add()
    {
        $reason = $this->input->post('keterangan');
        $kode = $this->input->post('kode');
        $outlet_id = $this->session->userdata('outlet_id');
        $tm = date('Y-m-d H:i:s', time());

        if (empty($reason)) {

            echo json_encode(array(
                "status" => FALSE,
                "flash_header"  => 'Tambah Pengeluaran',
                "flash_desc"  => 'Masukkan keterangan pengeluaran!',
            ));
        } else {
            if (!empty($kode)) {
                $ckEmailData = $this->Constant_model->getDataTwoColumn('pengeluaran', 'code', "$kode",'outlet_id',"$outlet_id");
                if (count($ckEmailData) > 0) {

                    echo json_encode(array(
                        "status" => FALSE,
                        "flash_header"  => 'Tambah Pengeluaran',
                        "flash_desc"  => 'Kode '.$kode.' telah terdaftar di sistem! Tolong gunakan Kode yang lain!',
                    ));
                    // redirect(base_url().'produk');
                    die();
                }
            }

            $data = array(
                      'code' => $this->input->post('kode'),
                      'expense_category' => $this->input->post('kategori'),
                      'type' => $this->session->userdata('type'),
                      'outlet_id' => $this->session->userdata('outlet_id'),
                      'date' => date("Y-m-d",strtotime($this->input->post('date'))),
                      'amount' => $this->input->post('nominal'),
                      'reason' => $reason,
                      'created_user_id' => $this->session->userdata('id'),
                      'created_datetime' => $tm,
                      'updated_user_id' => '0',
                      'updated_datetime' => $tm,
                      'status' => '1',
            );

            if(!empty($_FILES['nota']['name']))
            {
                $upload = $this->_do_upload();
                $data['nota'] = $upload;
            }

            // var_dump($data);
            // die();

            if ($this->Constant_model->insertData('pengeluaran', $data)) {
                $this->session->set_flashdata('alert_msg', array('success', 'Tambah Pengeluaran', "Berhasil menambahkan Pengeluaran $kode"));
                echo json_encode(array(
                    "status" => TRUE,
                    "flash_header"  => 'Tambah Pengeluaran',
                    "flash_desc"  => 'Berhasil menambahkan Pengeluaran '.$kode,
                ));
                // redirect(base_url().'produk');
            }
        }
    }

    // private function _do_upload()
    // {
    //     $config['upload_path']          = 'assets/images/pengeluaran';
    //     $config['allowed_types']        = 'gif|jpg|png';
    //     $config['max_size']             = 100; //set max size allowed in Kilobyte
    //     $config['max_width']            = 1000; // set max width image allowed
    //     $config['max_height']           = 1000; // set max height allowed
    //     $config['file_name']            = round(microtime(true) * 1000); //just milisecond timestamp fot unique name
 
    //     $this->load->library('upload', $config);
 
    //     if(!$this->upload->do_upload('nota')) //upload and validate
    //     {
    //         $data['inputerror'][] = 'nota';
    //         $data['error_string'][] = 'Upload error: '.$this->upload->display_errors('',''); //show ajax error
    //         $data['status'] = FALSE;
    //         echo json_encode($data);
    //         exit();
    //     }

    //     return $this->upload->data('file_name');
    // }

        private function _do_upload()
    {
        $config['upload_path']          = 'assets/images/pengeluaran';
        $config['allowed_types']        = 'jpg|png|pdf';
        // $config['max_size']             = 5000; //set max size allowed in Kilobyte
        // $config['max_width']            = 1000; // set max width image allowed
        // $config['max_height']           = 1000; // set max height allowed
        $config['file_name']            = round(microtime(true) * 1000); //just milisecond timestamp fot unique name
 
        $this->load->library('upload', $config);
 
        if(!$this->upload->do_upload('nota')) //upload and validate
        {
            $data['inputerror'][] = 'nota';
            $data['error_string'][] = 'Upload error: '.$this->upload->display_errors('',''); //show ajax error
            $data['status'] = FALSE;
            echo json_encode($data);
            exit();
        }else{
            $config['image_library'] = 'gd2';
            $config['source_image'] = $this->upload->upload_path.$this->upload->file_name;
            $config['new_image'] = './assets/images/pengeluaran_resize/';
            $config['quality'] = 80;
            $config['create_thumb'] = FALSE;
            $config['maintain_ratio'] = TRUE;
            $config['width'] = 640;
            $config['height'] = 360;
            
            // Load the Library
             $this->load->library('image_lib', $config);
             
             // resize image
             $this->image_lib->resize();


             // handle if there is any problem
             if ( ! $this->image_lib->resize()){
              echo $this->image_lib->display_errors();
             }
         }

        return $this->upload->data('file_name');
    }

    // private function getDataLaporan(){
    //     $data = array(
    //         'title' => "Laporan Pengeluaran",
    //         // 'breadcumb' => "",
    //         'menu' => "lap-pengeluaran",
    //         'posisi' => "laporan",
    //         'content' => "admin/laporan/lap-pengeluaran",
    //         'param'=> array(
    //             // 'absensis' => $this->Absensi_model->getAllAccount(),
    //             // 'siswas'=>$this->Siswa_model->getAllAccount_byWk(),
    //         ),
    //         'css' => array(
    //             1 => 'assets/base/assets/examples/css/uikit/modals', //modal
    //             2 => 'assets/global/vendor/datatables.net-bs4/dataTables.bootstrap4', //datatable ..
    //             3 => 'assets/global/vendor/datatables.net-responsive-bs4/dataTables.responsive.bootstrap4', //datatable ..
    //             4 => 'assets/global/vendor/datatables.net-buttons-bs4/dataTables.buttons.bootstrap4', //datatable ..
    //             5 => 'assets/global/vendor/datatables.net-select-bs4/dataTables.select.bootstrap4', //datatable ..
    //             6 => 'assets/base/assets/examples/css/tables/datatable', //datatable ..
    //             7 => 'assets/base/assets/examples/css/forms/masks', //mask
    //             8 => 'assets/global/fonts/font-awesome/font-awesome', //font
    //             8 => 'assets/global/vendor/bootstrap-datepicker/bootstrap-datepicker', //font
    //         ),
    //         // 'jscss' => array(
    //         //     1 => 'asset/bower_components/jquery/dist/jquery.min',
    //         //     // 2 => 'asset/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min',
    //         // ),
    //         'js' =>array(
    //             1 => 'assets/global/vendor/peity/jquery.peity.min',//mengelem tampil
    //             2 => 'assets/global/vendor/datatables.net/jquery.dataTables',//datatable
    //             3 => 'assets/global/vendor/datatables.net-bs4/dataTables.bootstrap4',
    //             4 => 'assets/global/vendor/datatables.net-responsive/dataTables.responsive',
    //             5 => 'assets/global/vendor/datatables.net-responsive-bs4/responsive.bootstrap4',
    //             6 => 'assets/global/vendor/datatables.net-buttons/dataTables.buttons',
    //             7 => 'assets/global/vendor/datatables.net-buttons/buttons.html5',
    //             8 => 'assets/global/vendor/datatables.net-buttons/buttons.flash',
    //             9 => 'assets/global/vendor/datatables.net-buttons/buttons.print',
    //             10 => 'assets/global/vendor/datatables.net-buttons/buttons.colVis',
    //             11 => 'assets/global/vendor/datatables.net-buttons-bs4/buttons.bootstrap4',
    //             12 => 'assets/global/vendor/asrange/jquery-asRange.min',
    //             13 => 'assets/global/vendor/bootbox/bootbox',
    //             14 => 'assets/global/vendor/formatter/jquery.formatter', //mask
    //             15 => 'assets/base/assets/examples/js/charts/peity', //men gelem tampil
    //             16 => 'assets/global/js/Plugin/jquery-placeholder', //material
    //             17 => 'assets/global/js/Plugin/material', //material
    //             18 => 'assets/global/js/Plugin/datatables', //datatable
    //             19 => 'assets/base/assets/examples/js/tables/datatable', //datatable
    //             20 => 'assets/global/js/Plugin/formatter', //mask
    //             21 => 'assets/global/vendor/bootstrap-datepicker/bootstrap-datepicker', //mask
    //             22 => 'assets/global/js/Plugin/bootstrap-datepicker' //mask
    //         )
    //     );
    //     return $data;
    // }

    // // List all your items
    // public function laporan()
    // {
    //     $role = $this->session->userdata('role');
    //     $outlet = $this->session->userdata('outlet_id');
    //     $content['notif'] = $this->Notifikasi_model->getData($role,$outlet);

    //     $data = array_merge($content, $this->getDataLaporan());
    //     $this->load->view('admin/templates/layout', $data);
    //     // $this->load->view('admin/templates/layout', $this->getDataLaporan());
    // }


    public function lapPengeluaranBy()
    {
        $start              = date("Y-m-d",strtotime($this->input->post('start')));
        $end                = date("Y-m-d",strtotime($this->input->post('end')));
        $kategori           = $this->input->post('kategori');

        $data['start']      = $start;
        $data['end']        = $end;
        $data['kategori']   = $kategori;

        $data['pengeluaran'] = $this->Pengeluaran_model->getPengeluaran($start,$end,$kategori);
        $data['judulpengeluaran'] = $this->Pengeluaran_model->getPengeluaranJudul($start,$end,$kategori);

        $this->load->view('admin/beban/table-tampildatapengeluaranbengkel', $data); 
        
    }

    public function cetakLaporan($start, $end, $kategori)
    {
        $outlet_id  = $this->session->userdata('outlet_id');
        $role       = $this->session->userdata('role');

        if (empty($role))
        {
            show_404();
        }


        $data['start']      = date("Y-m-d",strtotime($start));
        $data['end']        = date("Y-m-d",strtotime($end));
        $data['kategori']   = $kategori;

        $data['pengeluaran'] = $this->Pengeluaran_model->getPengeluaran($data['start'],$data['end'],$kategori);
        $data['judulpengeluaran'] = $this->Pengeluaran_model->getPengeluaranJudul($data['start'],$data['end'],$kategori);

        if ($this->session->userdata('role') == '1') {
            $this->load->view('admin/laporan/print-lappengeluaranadmin',$data);
        }elseif($this->session->userdata('role') == '2'){
            $data['gudang'] = $this->Constant_model->getDataOneColumnRowArray('gudang', 'id_gudang',$outlet_id);
            $this->load->view('admin/laporan/print-lappengeluaranadmin',$data);

        }elseif ($this->session->userdata('role') == '3') {
            
            $data['bengkel'] = $this->Constant_model->getDataOneColumnRowArray('bengkel', 'id_bengkel',$outlet_id);
            $this->load->view('admin/laporan/print-lappengeluaranbengkel',$data);

        }else{
            redirect('user/logout');
        }

        
    }
}

/* End of file controllername.php */
/* Location: ./application/controllers/controllername.php */
