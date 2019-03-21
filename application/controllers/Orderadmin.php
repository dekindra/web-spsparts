<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orderadmin extends CI_Controller {

    private $settingData;

	public function __construct()
	{
		parent::__construct();
		//Load Dependencies
        $this->load->model('Constant_model');
        $this->load->model('Notifikasi_model');
        $this->load->model('Order_model');
        $this->load->model('Setting_model');

        $this->settingData = $this->Setting_model->getSetting();
        $setting_timezone = $this->settingData->timezone;  

        date_default_timezone_set("$setting_timezone");

	}

    private function getDataMasuk(){
        $outlet_id = $this->session->userdata('outlet_id');
        $data = array(
            'title' => "Order Masuk",
            // 'breadcumb' => "",
            'menu' => "ordermasukadmin",
            'posisi' => "orderadmin",
            'content' => "admin/order/index-ordermasukadmin",
            'param'=> array(
                'ordermasuks' => $this->Constant_model->getDataOneJoin('order','id_gudang','gudang','id_gudang','id_order','desc'),
                'totalorder' => $this->Order_model->getTotalOrderAdmin(),
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
                10 => 'assets/base/assets/examples/css/pages/invoice', 
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
                22 => 'assets/global/js/Plugin/bootstrap-datepicker', //datepicker
                // 23 => 'assets/global/js/Plugin/asselectable', //datepicker
                // 24 => 'assets/global/js/Plugin/animate-list', //datepicker
                // 25 => 'assets/global/js/Plugin/selectable', //datepicker
                // 26 => 'assets/base/assets/js/BaseApp', //datepicker
                // 27 => 'assets/base/assets/js/App/Contacts', //datepicker
                // 28 => 'assets/base/assets/examples/js/apps/contacts' //datepicker
            )
        );
        return $data;
    }

    public function masuk()
    {
        $role = $this->session->userdata('role');
        $outlet = $this->session->userdata('outlet_id');
        $content['notif'] = $this->Notifikasi_model->getData($role,$outlet);

        $data = array_merge($content, $this->getDataMasuk());
        $this->load->view('admin/templates/layout', $data);
    }

    public function prosesOrderMasuk($id)
    {
        $tm = date('Y-m-d H:i:s', time());

        $data = array(
            'status_order'       => '1',
            'tanggal_diproses' => $tm,
        );

        if ($this->Constant_model->updateDataDinamis('order', $data, 'id_order', $id)) {
            $ckDtorder = $this->Order_model->getDataEmailGudang($id);

            $dtnotif = array(
                'keterangan'        => 'Order dengan kode '.$id.' telah diproses',
                'created_datetime'  => $tm,
                'status'            => '0',
                'role'              => '2',
                'outlet'            =>  $ckDtorder->id_gudang,
                'info'              => 'order_diproses'
            );

            $this->Constant_model->insertData('notifikasi', $dtnotif);


            $dtemail = array(
                'id_gudang'  =>  $ckDtorder->id_gudang,
                'tanggal_order'  =>  $ckDtorder->tanggal_order,
                'total_pembelian'  =>  $ckDtorder->total_pembelian,
            );

            $emailtemp=$this->load->view('admin/notif/notif_ordergudang.php',$dtemail,TRUE);

            $this->load->library('email');
            $this->email->from($this->settingData->email_broadcast, 'Sps Parts');
            $this->email->to($ckDtorder->email);
            $this->email->subject('Order Diproses');
            $this->email->message($emailtemp);
          
            // $this->email->send();

            if (!$this->email->send()) {  
                echo $this->email->print_debugger();   
            }

            // $this->session->set_flashdata('alert_msg', array('success', 'Proses Order', 'Berhasil Memproses Orderan'));
            echo json_encode(array(
                "status" => TRUE,
                "flash_header"  => 'Proses Order',
                "flash_desc"  => 'Berhasil memproses orderan',
            ));
        };


    }

    public function validOrderMasuk($id)
    {
        $tm = date('Y-m-d H:i:s', time());

        $ckStOrder = $this->Constant_model->getDataTwoColumn('order', 'status_order', '1', 'id_order',$id);
        // var_dump(count($ckStOrder));
        // die();

        if (count($ckStOrder) == 1) {
                $data = array(
                    'status_order'     => '2',
                    'tanggal_valid' => $tm,
                );

                if ($this->Constant_model->updateDataDinamis('order', $data, 'id_order', $id)) {
                    $ckDtorder = $this->Order_model->getDataEmailGudang($id);

                    $dtnotif = array(
                        'keterangan'        => 'Order dengan kode '.$id.' dinyatakan valid',
                        'created_datetime'  => $tm,
                        'status'            => '0',
                        'role'              => '2',
                        'outlet'            =>  $ckDtorder->id_gudang,
                        'info'              => 'order_valid'
                    );

                    $this->Constant_model->insertData('notifikasi', $dtnotif);

                    $dtemail = array(
                        'id_gudang'  =>  $ckDtorder->id_gudang,
                        'tanggal_order'  =>  $ckDtorder->tanggal_order,
                        'total_pembelian'  =>  $ckDtorder->total_pembelian,
                    );


                    $emailtemp=$this->load->view('admin/notif/notif_ordergudang.php',$dtemail,TRUE);

                    $this->load->library('email');
                    $this->email->from($this->settingData->email_broadcast, 'Sps Parts');
                    $this->email->to($ckDtorder->email);
                    $this->email->subject('Order Tervalidasi');
                    $this->email->message($emailtemp);
                  
                    // $this->email->send();

                    if (!$this->email->send()) {  
                        echo $this->email->print_debugger();   
                    }

                    // $this->session->set_flashdata('alert_msg', array('success', 'Validasi Order', 'Berhasil Memvalidasi Orderan'));
                };

            }else{

                echo json_encode(array(
                    "status" => FALSE,
                    "flash_header"  => 'Validasi Order',
                    "flash_desc"  => 'Status Orderan bukan diproses!',
                ));

                die();
            }

        echo json_encode(array(
                "status" => TRUE,
                "flash_header"  => 'Validasi Order',
                "flash_desc"  => 'Berhasil memvalidasi orderan',
            ));

    }

    public function selesaiOrderMasuk($id)
    {
        $tm = date('Y-m-d H:i:s', time());

        $ckStOrder = $this->Constant_model->getDataTwoColumn('order', 'status_order', '2', 'id_order',$id);     
        // var_dump(count($ckStOrder));
        // die();

        if (count($ckStOrder) == 1) {
            // $tglorder = $this->Constant_model->getDataTwoColumnRow('order', 'status_order', '2', 'id_order',$id);
            $limit = $this->Setting_model->getSetting();
            $jatuh_tempo = date('Y-m-d H:i:s',strtotime($tm)  + (86400 * $limit->jatuh_tempo));
            // var_dump($jatuh_tempo);
            // die();

            $data = array(
                'status_order'     => '3',
                'tanggal_selesai' => $tm,
                'jatuh_tempo' => $jatuh_tempo,
                    // 'tanggal_pembayaran' => $jatuh_tempo,
            );

            if ($this->Constant_model->updateDataDinamis('order', $data, 'id_order', $id)) {
                $id_produk = $this->input->post('id');

                $result = array();

                foreach($id_produk AS $key => $val){
                   $result = array(
                      "id_p" => $_POST['id'][$key],
                      "id_gudang" => $_POST['id_gudang'][$key],
                      "stock"  => $_POST['qty'][$key],
                  );

                   $ckDtInven = $this->Constant_model->getDataTwoColumn('inventory', 'id_p', $result['id_p'], 'id_gudang',$result['id_gudang']);

                   if (count($ckDtInven) == 1) {
                       $this->Constant_model->updateDataDinamisTwoWhere('inventory', $result, 'id_p', $val, 'id_gudang', $result['id_gudang']);
                   } else {
                       $this->Constant_model->insertData('inventory', $result);
                   }  
               }

               $ckDtorder = $this->Order_model->getDataEmailGudang($id);

               $dtnotif = array(
                'keterangan'        => 'Order dengan kode '.$id.' telah selesai',
                'created_datetime'  => $tm,
                'status'            => '0',
                'role'              => '2',
                'outlet'            =>  $ckDtorder->id_gudang,
                'info'              => 'order_selesai'
                );

                $this->Constant_model->insertData('notifikasi', $dtnotif);

                

                $dtemail = array(
                    'id_gudang'  =>  $ckDtorder->id_gudang,
                    'tanggal_order'  =>  $ckDtorder->tanggal_order,
                    'total_pembelian'  =>  $ckDtorder->total_pembelian,
                );


                $emailtemp=$this->load->view('admin/notif/notif_ordergudang.php',$dtemail,TRUE);

                $this->load->library('email');
                $this->email->from($this->settingData->email_broadcast, 'Sps Parts');
                $this->email->to($ckDtorder->email);
                $this->email->subject('Order Selesai');
                $this->email->message($emailtemp);
              
                // $this->email->send();

                if (!$this->email->send()) {  
                    echo $this->email->print_debugger();   
                }

               // $this->session->set_flashdata('alert_msg', array('success', 'Selesai Order', 'Berhasil Menyelesaikan Orderan'));
           };

        }else{
        
            echo json_encode(array(
                "status" => FALSE,
                "flash_header"  => 'Selesai Order',
                "flash_desc"  => 'Status Orderan bukan Validasi!',
            ));
            die();
        }

        echo json_encode(array(
            "status" => TRUE,
            "flash_header"  => 'Selesai Order',
            "flash_desc"  => 'Berhasil Menyelesaikan orderan',
        ));

    }

    public function detailMasuk($id)
    {
        $data['data'] = $this->Constant_model->getDataOneJoinOneWhereRowArray('order_detail','id_order','order','id_order','order.id_order', $id, 'order_detail.id_order', 'desc');
        // $data['array'] = $this->Constant_model->getDataOneJoinWhere('order_detail','id_p','produk','id_p','order_detail.id_order',$id, 'order_detail.id_order', 'desc');
        $data['array'] = $this->Order_model->getDataDetail($id);

        // echo json_encode($data);
        // var_dump($data['array']);

        // die();
        $this->load->view('admin/order/detail-orderinputadmin', $data);
    }

    // public function bulk_produk($kode)
    // {
    //     $list_check = $this->input->post('check');
    //     $list_notcheck = $this->input->post('notcheck');

    //     $data = array(
    //         'status_approval'       => '1',
    //     );

    //     $udata = array(
    //         'status_approval'       => '0',
    //     );

    //     if(!is_null($list_check))
    //     foreach ($list_check as $check) {
    //         $this->Constant_model->updateDataDinamisTwoWhere('order_detail', $data, 'id_order', $kode, 'id_p', $check);
    //     }

    //     if(!is_null($list_notcheck))
    //     foreach ($list_notcheck as $notcheck) {
    //         $this->Constant_model->updateDataDinamisTwoWhere('order_detail', $udata, 'id_order', $kode, 'id_p', $notcheck);
    //     }
            
    //     $this->session->set_flashdata('alert_msg', array('success', 'Approval Order', "Orderan Telah Diterima!"));

    //     echo json_encode(array("status" => TRUE));
    // }

    public function cetak($id)
    {
        if (empty($id))
        {
            show_404();
        }

        $data['data'] = $this->Constant_model->getDataOneJoinOneWhereRowArray('order','id_gudang','gudang','id_gudang','order.id_order', $id, 'order.id_order', 'desc');
        // $data['array'] = $this->Constant_model->getDataOneJoinWhere('order_detail','id_p','produk','id_p','order_detail.id_order',$id, 'order_detail.id_order', 'desc');
        $data['array'] = $this->Order_model->getDataDetail($id);

        $this->load->view('admin/laporan/print-orderadmin.php',$data);
    }

    public function lapOrderBy()
    {
        $start              = date("Y-m-d",strtotime($this->input->post('start')));
        $end                = date("Y-m-d",strtotime($this->input->post('end')));
        $status             = $this->input->post('status');

        $data['start']      = $start;
        $data['end']        = $end;
        $data['status']     = $status;

        $data['order'] = $this->Order_model->getOrderMasukAdmin($start,$end,$status);
        $data['judulorder'] = $this->Order_model->getOrderJudulMasukAdmin($start,$end,$status);

        $this->load->view('admin/order/table-tampildataordermasukadmin', $data); 
        
    }

    public function cetakLaporan($start, $end, $status)
    {

        $role = $this->session->userdata('role');

        if (empty($role))
        {
            show_404();
        }



        $data['start']      = date("Y-m-d",strtotime($start));
        $data['end']        = date("Y-m-d",strtotime($end));


        $data['order'] = $this->Order_model->getOrderMasukAdmin($start,$end,$status);
        $data['judulorder'] = $this->Order_model->getOrderJudulMasukAdmin($start,$end,$status);

        $this->load->view('admin/laporan/print-lapordermasukadmin',$data);
    }

}

/* End of file controllername.php */
/* Location: ./application/controllers/controllername.php */
