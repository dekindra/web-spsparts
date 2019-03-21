<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tunggakanbengkel extends CI_Controller {

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
            'menu' => "tunggakanbengkel",
            'posisi' => "tagihan",
            'content' => "admin/tagihan/tunggakan-bengkel",
            'param'=> array(
                'tunggakans' => $this->Tagihan_model->getDataTunggakanBengkel($outlet_id),
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

    public function getvalidasibukti($id)
    {
        $data['data'] = $this->Constant_model->getDataOneColumn('order','id_order', $id);
        $data['rincian_pembayaran'] = $this->Constant_model->getDataOneColumnResult('pembayaran','id_order', $id);
        // $data->tgl_lahir = ($data->tgl_lahir == '0000-00-00') ? '' : $data->tgl_lahir; // if 0000-00-00 set tu empty for datepicker compatibility
        echo json_encode($data);
    }

    public function validasibukti($id)
    {
        $tm = date('Y-m-d H:i:s', time());

        $data = array(
            'status'     => '1',
            'tanggal_diterima' => $tm,
        );

        if ($this->Constant_model->updateDataDinamis('pembayaran', $data, 'id', $id)) {
            $this->session->set_flashdata('alert_msg', array('success', 'Validasi Cicilan', 'Berhasil mem-validasi cicilan'));
        };

        echo json_encode(array("status" => TRUE));

    }

    public function batalvalidasibukti($id)
    {
        $data = array(
            'status'     => '0',
        );

        if ($this->Constant_model->updateDataDinamis('pembayaran', $data, 'id', $id)) {
            $this->session->set_flashdata('alert_msg', array('success', 'Validasi Cicilan', 'Bukti belum tervalidasi'));
        };

        echo json_encode(array("status" => TRUE));

    }

    public function detail($id)
    {
        // $data['data'] = $this->Constant_model->getDataOneJoinTwoWhereRowArray('order_detail','id_order','order','id_order','id_bengkel',$outlet_id, 'order.id_order', $id, 'order_detail.id_order', 'desc');
        $data['data'] = $this->Constant_model->getDataOneJoinOneWhereRowArray('order_detail','id_order','order','id_order','order.id_order', $id, 'order_detail.id_order', 'desc');
        // $data['array'] = $this->Constant_model->getDataOneJoinWhere('order_detail','id_p','produk','id_p','order_detail.id_order',$id, 'order_detail.id_order', 'desc');
        $data['array'] = $this->Tagihan_model->getDataDetailTagihan($id);
        // echo json_encode($data);
        // var_dump($data['array']);

        // die();
        $this->load->view('admin/tagihan/detail-tagihantunggakanbengkel', $data);
    }

}

