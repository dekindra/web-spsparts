<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tunggakanadmin extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		//Load Dependencies
        $this->load->model('Tagihan_model');
        $this->load->model('Constant_model');
        $this->load->model('Notifikasi_model');
        $this->load->model('Setting_model');

        $settingData = $this->Setting_model->getSetting();
        $setting_timezone = $settingData->timezone;  

        date_default_timezone_set("$setting_timezone");

	}

	private function getData(){
        $outlet_id = $this->session->userdata('outlet_id');
        $data = array(
            'title' => "Tunggakan Order",
            // 'breadcumb' => "",
            'menu' => "tunggakankeadmin",
            'posisi' => "tagihan",
            'content' => "admin/tagihan/tunggakan-admin",
            'param'=> array(
                'tunggakans' => $this->Tagihan_model->getDataTunggakanAdmin($outlet_id),
                'setting' => $this->Setting_model->getSetting(),
            ),
            'css' => array(
                // 1 => 'assets/base/assets/examples/css/uikit/modals', //modal
                // 1 => 'assets/global/vendor/datatables.net-rowgroup-bs4/dataTables.rowgroup.bootstrap4', //addrow
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
                14 => 'assets/global/vendor/formatter/jquery.formatter', //maskx
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

        $data = array_merge($content, $this->getData());
        $this->load->view('admin/templates/layout', $data);

	}

    public function uploadbukti($id)
    {
        $data = $this->Constant_model->getDataOneColumn('order','id_order', $id);
        // $data->tgl_lahir = ($data->tgl_lahir == '0000-00-00') ? '' : $data->tgl_lahir; // if 0000-00-00 set tu empty for datepicker compatibility
        echo json_encode($data);
    }

    public function update()
    {   
        $id = $this->input->post('id');

        // $this->_validate();
 
        if(!empty($_FILES['nota']['name']))
        {
            $data = array(
                'status_pembayaran' => '1',
            );

            $upload = $this->_do_upload();
             
            //delete file
            $produk = $this->Constant_model->getDataOneColumn('order','id_order', $id);
            if(file_exists('assets/images/tagihan/'.$produk->nota) && $produk->nota)
                unlink('assets/images/tagihan/'.$produk->nota);
 
            $data['nota'] = $upload;

        }else{
           $data = array(
                'status_pembayaran' => '0',
            ); 
           
           if($this->input->post('remove_photo')) // if remove photo checked
            {
                if(file_exists('assets/images/tagihan/'.$this->input->post('remove_photo')) && $this->input->post('remove_photo'))
                    unlink('assets/images/tagihan/'.$this->input->post('remove_photo'));
                $data['nota'] = '';
            }
        }
 
        $this->Constant_model->updateDataDinamis('order', $data, 'id_order', $id);
        $this->session->set_flashdata('alert_msg', array('success', 'Upload Berhasil', 'Berhasil mengupload bukti pembayaran'));

        echo json_encode(array("status" => TRUE));
    }

    private function _do_upload()
    {
        $config['upload_path']          = 'assets/images/tagihan';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 100; //set max size allowed in Kilobyte
        $config['max_width']            = 1000; // set max width image allowed
        $config['max_height']           = 1000; // set max height allowed
        $config['file_name']            = round(microtime(true) * 1000); //just milisecond timestamp fot unique name
 
        $this->load->library('upload', $config);
 
        if(!$this->upload->do_upload('nota')) //upload and validate
        {
            $data['inputerror'][] = 'nota';
            $data['error_string'][] = 'Upload error: '.$this->upload->display_errors('',''); //show ajax error
            $data['status'] = FALSE;
            echo json_encode($data);
            exit();
        }

        return $this->upload->data('file_name');
    }

    public function detail($id)
    {
        // $data['data'] = $this->Constant_model->getDataOneJoinTwoWhereRowArray('order_detail','id_order','order','id_order','id_bengkel',$outlet_id, 'order.id_order', $id, 'order_detail.id_order', 'desc');
        $data['data'] = $this->Constant_model->getDataOneJoinOneWhereRowArray('order_detail','id_order','order','id_order','order.id_order', $id, 'order_detail.id_order', 'desc');
        $data['array'] = $this->Constant_model->getDataOneJoinWhere('order_detail','id_p','produk','id_p','order_detail.id_order',$id, 'order_detail.id_order', 'desc');
        // echo json_encode($data);
        // var_dump($data['array']);

        // die();
        $this->load->view('admin/tagihan/detail-tagihantunggakangudang', $data);
    }

}

