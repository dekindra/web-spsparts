<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ordergudang extends CI_Controller {

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

	private function getData(){
        $data = array(
            'title' => "Order Baru",
            // 'breadcumb' => "",
            'menu' => "orderbarugudang",
            'posisi' => "ordergudang",
            'content' => "admin/order/index-orderbaru",
            'param'=> array(
                // 'absensis' => $this->Absensi_model->getAllAccount(),
                // 'siswas'=>$this->Siswa_model->getAllAccount_byWk(),
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
		// $this->load->view('admin/templates/layout', $this->getData());

	}

    // public function detailview()
    // {
    //     $data = array(
    //         'title' => "Order Baru",
    //         // 'breadcumb' => "",
    //         'menu' => "orderbarugudang",
    //         'posisi' => "ordergudang",
    //         'content' => "admin/order/detail-orderbaru",
    //         'param'=> array(
    //             // 'absensis' => $this->Absensi_model->getAllAccount(),
    //             // 'siswas'=>$this->Siswa_model->getAllAccount_byWk(),
    //         ),
    //         'css' => array(
    //             1 => 'assets/base/assets/examples/css/tables/basic', //datatable ..
    //             2 => 'assets/global/fonts/font-awesome/font-awesome', //font
    //         ),
    //         // 'jscss' => array(
    //         //     1 => 'asset/bower_components/jquery/dist/jquery.min',
    //         //     // 2 => 'asset/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min',
    //         // ),
    //         'js' =>array(
    //             1 => 'assets/global/vendor/peity/jquery.peity.min',//mengelem tampil
    //             2 => 'assets/global/js/Plugin/peity',//mengelem tampil
    //             3 => 'assets/global/js/Plugin/table',//mengelem tampil
    //             4 => 'assets/base/assets/examples/js/charts/peity'//mengelem tampil
    //         )
    //     );
        
    //     // <script src="../../../.js"></script>
    //     // <script src="../../../global/js/Plugin/asselectable.js"></script>
    //     // <script src="../../../global/js/Plugin/selectable.js"></script>
    //     // <script src="../../../.js"></script>
    //     // <script src="../../../global/js/Plugin/asscrollable.js"></script>
    
    //     // <script src="../../.js"></script>

    //     $this->load->view('admin/templates/layout', $data);
    // }

	
    private function getDataKeluar(){
        $outlet_id = $this->session->userdata('outlet_id');
        $data = array(
            'title' => "Order Keluar",
            // 'breadcumb' => "",
            'menu' => "ordergudangkeluar",
            'posisi' => "ordergudang",
            'content' => "admin/order/index-orderkeluargudang",
            'param'=> array(
                'orderkeluars' => $this->Constant_model->getDataOneColumnSortColumn('order','id_gudang',"$outlet_id",'tanggal_order','desc'),
                'limitorder' => $this->Constant_model->getDataOneColumnRowArray('gudang','id_gudang',"$outlet_id"),
                'totalorder' => $this->Order_model->getTotalOrderKeluarGd($outlet_id),
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
                22 => 'assets/global/js/Plugin/bootstrap-datepicker', //datepicker
            )
        );
        return $data;
    }

    public function keluar()
    {
        $role = $this->session->userdata('role');
        $outlet = $this->session->userdata('outlet_id');
        $content['notif'] = $this->Notifikasi_model->getData($role,$outlet);

        $data = array_merge($content, $this->getDataKeluar());
        $this->load->view('admin/templates/layout', $data);
        // $this->load->view('admin/templates/layout', $this->getDataKeluar());
    }

 // ****************************** Action To Database -- START ****************************** //

    public function delete($id)
    {
        //delete file
        $this->Constant_model->deleteDataDinamis('order', 'id_order', $id);
        $this->Constant_model->deleteDataDinamis('order_detail', 'id_order', $id);
        $this->session->set_flashdata('alert_msg', array('success', 'Delete Order', 'Berhasil menghapus Orderan'));

        echo json_encode(array(
            "status" => TRUE,
            "flash_header"  => 'Delete Order',
            "flash_desc"  => 'Berhasil menghapus Orderan',
        ));
    }

     // Insert New Bengkel;
    public function add()
    {
        $tm = date('Y-m-d H:i:s', time());
        $outlet_id = $this->session->userdata('outlet_id');
        $limitorder = $this->Constant_model->getDataOneColumnRowArray('gudang','id_gudang',"$outlet_id");

        if ($this->input->post('total_pembelian') <=  $limitorder["limit_order"]) {
            $data = array(
            // 'id_supplier'       => '0',
                'id_gudang'         => $this->session->userdata('outlet_id'),
                'total_pembelian'   => $this->input->post('total_pembelian'),
                'tanggal_order'     => date('Y-m-d H:i:s',strtotime($this->input->post('tanggal'))),
                'created_user_id'   => $this->session->userdata('id'),
                'created_datetime'  => $tm,
            );

            $create = $this->Constant_model->insertDataReturnLastId('order', $data);
        
            foreach ($_POST['order'] as $id => $detail){
                if($detail['id_produk']!=''){
                    $upddata = array(
                        'id_order'  => $create,
                        'id_p'      => $detail['id_produk'],
                        'qty'       => $detail['quantity'],
                        'subtotal'  => $detail['sub_total']
                    );

                    $this->Constant_model->insertData('order_detail', $upddata);
                }
            }

            $dtnotif = array(
                'keterangan'        => 'Order baru dari gudang '.$data['id_gudang'].' telah diterima',
                'created_datetime'  => $tm,
                'status'            => '0',
                'role'              => '1',
                'info'              => 'order_baru'
            );

            $this->Constant_model->insertData('notifikasi', $dtnotif);

            $emailtemp=$this->load->view('admin/notif/notif_ordergudang.php',$data,TRUE);

            $this->load->library('email');
            $this->email->from($this->settingData->email_broadcast, 'Sps Parts');
            $this->email->to($this->settingData->email_broadcast);
            $this->email->subject('Order');
            $this->email->message($emailtemp);
          
            // $this->email->send();

            if (!$this->email->send()) {  
                echo $this->email->print_debugger();   
            }

        } else {

            echo json_encode(array(
                "status" => FALSE,
                "flash_header"  => 'Tambah Order',
                "flash_desc"  => 'Gagal menambah orderan, Tolong untuk diperhatikan TOTAL nilai maksimal orderan!',
            ));

            die();
        }

        echo json_encode(array(
            "status" => TRUE,
            "flash_header"  => 'Tambah Order',
            "flash_desc"  => 'Berhasil menambah orderan',
        ));
        
    }

    // Insert New Bengkel;
    // public function kirimOrderKeluar($id)
    // {
    //     $tm = date('Y-m-d H:i:s', time());

    //     $data = array(
    //         'status_order'       => '2',
    //         'tanggal_diajukan' => $tm,
    //     );

    //     if ($this->Constant_model->updateDataDinamis('order', $data, 'id_order', $id)) {
    //         $this->session->set_flashdata('alert_msg', array('success', 'Terima Order', 'Berhasil Menerima Orderan'));
    //     };
     
    //     echo json_encode(array("status" => TRUE));

    // }

    
    public function detailKeluar($id)
    {
        $outlet_id = $this->session->userdata('outlet_id');
        $data['data'] = $this->Constant_model->getDataOneJoinTwoWhereRowArray('order_detail','id_order','order','id_order','id_gudang',$outlet_id, 'order.id_order', $id, 'order_detail.id_order', 'desc');
        $data['array'] = $this->Order_model->getDataDetailGudang($id,$outlet_id);
        // $data['array'] = $this->Constant_model->getDataOneJoinWhere('order_detail','id_p','produk','id_p','order_detail.id_order',$id, 'order_detail.id_order', 'desc');

        // echo json_encode($data);
        // var_dump($data['array']);

        // die();
        $this->load->view('admin/order/detail-orderinputgudang', $data);
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

    public function bulk_produk($kode)
    {
        $total_tagihan = 0;
        $tm = date('Y-m-d H:i:s', time());
        $id = $this->input->post('id');
    
        $result = array();

        foreach($id AS $key => $val){
         $result = array(
          "subtotalditerima" => $_POST['harga'][$key] * $_POST['qty'][$key],
          "qtyditerima"  => $_POST['qty'][$key],
         );

         $total_tagihan = $total_tagihan + $result['subtotalditerima'];
         $this->Constant_model->updateDataDinamisTwoWhere('order_detail', $result, 'id_order', $kode, 'id_p', $val);
        }

        $data = array(
            'total_tagihan'     => $total_tagihan,
            'status_order'      => '2',
            'tanggal_valid'     => $tm,
        );

        // var_dump($total_tagihan);
        // var_dump($data);
        // die();
        
        if($this->Constant_model->updateDataDinamis('order', $data, 'id_order', $kode)){
            $dtnotif = array(
                'keterangan'        => 'Order dengan kode '.$kode.' telah diterima',
                'created_datetime'  => $tm,
                'status'            => '0',
                'role'              => '1',
                'info'              => 'order_diterima',
            );

            $this->Constant_model->insertData('notifikasi', $dtnotif);

            $ckDtorder = $this->Constant_model->getDataOneColumn('order', 'id_order', $kode);

            $dtemail = array(
                'id_gudang'  =>  $ckDtorder->id_gudang,
                'tanggal_order'  =>  $ckDtorder->tanggal_order,
                'total_pembelian'  =>  $ckDtorder->total_pembelian,
            );


            $emailtemp=$this->load->view('admin/notif/notif_ordergudang.php',$dtemail,TRUE);

            $this->load->library('email');
            $this->email->from($this->settingData->email_broadcast, 'Sps Parts');
            $this->email->to($this->settingData->email_broadcast);
            $this->email->subject('Order Diterima');
            $this->email->message($emailtemp);
          
            // $this->email->send();

            if (!$this->email->send()) {  
                echo $this->email->print_debugger();   
            }

        }

        echo json_encode(array(
            "status" => TRUE,
            "flash_header"  => 'Validasi Order',
            "flash_desc"  => 'Orderan telah diproses!',
        ));
    }

     public function autocompleteproduk(){
        // Ambil nama 
        $cari = $_GET['cari'];
        $outlet_id = $this->session->userdata('outlet_id');
        // Cari Nama
        // $data = $this->db->from('produk')->like('name_p',$cari)->get();
        $data = $this->Order_model->getDtProduk($cari, $outlet_id);
        // Inisialisasi Array

        $arrays = array();
        // foreach($data->result() as $row)
        foreach($data as $row)
        {
            $arrays[] = array(
                'id'        => $row->id_p,
                'name'      => $row->name_p,
                'code'      => $row->code_p,
                'price'     => $row->purchase_price,
                'het_gudang'     => $row->het_gudang,
                'search'     => $row->searchdeskripsi,
            );
        }
        echo json_encode($arrays);
    }

    public function cetakKeluar($id)
    {
        if (empty($id))
        {
            show_404();
        }

        $data['data'] = $this->Constant_model->getDataOneJoinOneWhereRowArray('order','id_gudang','gudang','id_gudang','order.id_order', $id, 'order.id_order', 'desc');
        // $data['array'] = $this->Constant_model->getDataOneJoinWhere('order_detail','id_p','produk','id_p','order_detail.id_order',$id, 'order_detail.id_order', 'desc');
        $data['array'] = $this->Order_model->getDataDetail($id);

        $this->load->view('admin/laporan/print-ordergudangkeluar.php',$data);
    }

    public function lapOrderByKeluar()
    {
        $start              = date("Y-m-d",strtotime($this->input->post('start')));
        $end                = date("Y-m-d",strtotime($this->input->post('end')));
        $status             = $this->input->post('status');

        $data['start']      = $start;
        $data['end']        = $end;
        $data['status']     = $status;

        $data['order'] = $this->Order_model->getOrderKeluarGd($start,$end,$status);
        $data['judulorder'] = $this->Order_model->getOrderJudulKeluarGd($start,$end,$status);

        $this->load->view('admin/order/table-tampildataorderkeluargudang', $data); 
        
    }

    public function cetakLaporanKeluar($start, $end, $status)
    {

        $kdgudang = $this->session->userdata('outlet_id');

        if (empty($kdgudang))
        {
            show_404();
        }


        $data['start']      = date("Y-m-d",strtotime($start));
        $data['end']        = date("Y-m-d",strtotime($end));


        $data['order'] = $this->Order_model->getOrderKeluarGd($data['start'],$data['end'],$status);
        $data['judulorder'] = $this->Order_model->getOrderJudulKeluarGd($data['start'],$data['end'],$status);
        $data['gudang'] = $this->Constant_model->getDataOneColumnRowArray('gudang', 'id_gudang',$kdgudang);

        $this->load->view('admin/laporan/print-laporderkeluargudang',$data);
    }


    private function getDataMasuk(){
        $outlet_id = $this->session->userdata('outlet_id');
        $data = array(
            'title' => "Order Masuk",
            // 'breadcumb' => "",
            'menu' => "ordermasukgudang",
            'posisi' => "ordergudang",
            'content' => "admin/order/index-ordermasukgudang",
            'param'=> array(
                'ordermasuks' => $this->Constant_model->getDataOneJoinWhere('order','id_bengkel','bengkel','id_bengkel','wh',"$outlet_id",'id_order','desc'),
                'totalorder' => $this->Order_model->getTotalOrderGd($outlet_id),
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

    public function masuk()
    {
        $role = $this->session->userdata('role');
        $outlet = $this->session->userdata('outlet_id');
        $content['notif'] = $this->Notifikasi_model->getData($role,$outlet);

        $data = array_merge($content, $this->getDataMasuk());
        $this->load->view('admin/templates/layout', $data);
        // $this->load->view('admin/templates/layout', $this->getDataMasuk());
    }

    // public function prosesOrderMasuk($id)
    // {
    //     $tm = date('Y-m-d H:i:s', time());

    //     $data = array(
    //         'status_order'       => '1',
    //         'tanggal_diproses' => $tm,
    //     );

    //     if ($this->Constant_model->updateDataDinamis('order', $data, 'id_order', $id)) {
    //         $this->session->set_flashdata('alert_msg', array('success', 'Proses Order', 'Berhasil Memproses Orderan'));
    //     };
     
    //     echo json_encode(array("status" => TRUE));

    // }

    public function prosesOrderMasuk($kode)
    {
        $total_tagihan = 0;
        $tm = date('Y-m-d H:i:s', time());
        $id = $this->input->post('id');
    
        $result = array();

        foreach($id AS $key => $val){
           $result = array(
              "subtotalditerima" => $_POST['harga'][$key] * $_POST['qty'][$key],
              "qtyditerima"  => $_POST['qty'][$key],
          );

           $id_gudang = $_POST['id_gudang'][$key];

           $cekstock = $this->Constant_model->getDataTwoColumnRow('inventory', 'id_p', $val , 'id_gudang', $id_gudang);
           // var_dump($cekstock->stock);
           // die();

           if ($result['qtyditerima'] <= $cekstock->stock ) {
            $total_tagihan = $total_tagihan + $result['subtotalditerima'];

            $upddata = array(
                'stock'     => $cekstock->stock - $result['qtyditerima'],
            );


            $this->Constant_model->updateDataDinamisTwoWhere('inventory', $upddata, 'id_gudang', $id_gudang, 'id_p', $val);
            $this->Constant_model->updateDataDinamisTwoWhere('order_detail', $result, 'id_order', $kode, 'id_p', $val);
            } else {
                echo json_encode(array(
                    "status" => FALSE,
                    "flash_header"  => 'Stok Kurang',
                    "flash_desc"  => 'Tolong cek stok barang!',
                ));
                die();
            }
        }

        $data = array(
            'total_tagihan'     => $total_tagihan,
            'status_order'      => '1',
            'tanggal_diproses'     => $tm,
        );


        if($this->Constant_model->updateDataDinamis('order', $data, 'id_order', $kode)){
            $ckDtorder = $this->Constant_model->getDataOneJoinWhereRow('order', 'id_bengkel', 'bengkel', 'id_bengkel', 'id_order', $kode, 'id_order', 'asc');

            $dtnotif = array(
                'keterangan'        => 'Order dengan kode '.$kode.' telah diproses',
                'created_datetime'  => $tm,
                'status'            => '0',
                'role'              => '3',
                'outlet'            =>  $ckDtorder->id_bengkel,
                'info'              => 'order_diproses'
            );

            $this->Constant_model->insertData('notifikasi', $dtnotif);

            $dtemail = array(
                'id_bengkel'  =>  $ckDtorder->id_bengkel,
                'tanggal_order'  =>  $ckDtorder->tanggal_order,
                'total_pembelian'  =>  $ckDtorder->total_pembelian,
            );


            $emailtemp=$this->load->view('admin/notif/notif_orderbengkel.php',$dtemail,TRUE);

            $this->load->library('email');
            $this->email->from($this->settingData->email_broadcast, 'Sps Parts');
            $this->email->to($ckDtorder->email);
            $this->email->subject('Order Diproses');
            $this->email->message($emailtemp);
          
            // $this->email->send();

            if (!$this->email->send()) {  
                echo $this->email->print_debugger();   
            }

        }

        echo json_encode(array(
            "status" => TRUE,
            "flash_header"  => 'Validasi Order',
            "flash_desc"  => 'Orderan telah diproses',
        ));
    }

     public function orderkeadmin($kode)
    {
        $tm = date('Y-m-d H:i:s', time());
        $outlet_id = $this->session->userdata('outlet_id');
        $limitorder = $this->Constant_model->getDataOneColumnRowArray('gudang','id_gudang',"$outlet_id");
        $getdataorder = $this->Constant_model->getDataOneColumn('order', 'id_order', $kode);


        if ($this->input->post('total') <=  $limitorder["limit_order"]) {
            // $data = array(
            // // 'id_supplier'       => '0',
            //     'id_gudang'         => $this->session->userdata('outlet_id'),
            //     'total_pembelian'   => $getdataorder->total_pembelian,
            //     'tanggal_order'     => $tm,
            //     'created_user_id'   => $this->session->userdata('id'),
            //     'created_datetime'  => $tm,
            // );

            // $create = $this->Constant_model->insertDataReturnLastId('order', $data);

            // $getdatadetailorder = $this->Constant_model->getDataOneColumnResult('order_detail', 'id_order', $kode);

        
            // foreach($getdatadetailorder as $id => $detail){
            //     $upddata = array(
            //         'id_order'  => $create,
            //         'id_p'  => $detail->id_p,
            //         'qty'  => $detail->qty,
            //         'subtotal'  => $detail->subtotal,
            //     );

            //     $this->Constant_model->insertData('order_detail', $upddata);
            // }

            $data = array(
            // 'id_supplier'       => '0',
                'id_gudang'         => $this->session->userdata('outlet_id'),
                'total_pembelian'   => $this->input->post('total'),
                'tanggal_order'     => $tm,
                'created_user_id'   => $this->session->userdata('id'),
                'created_datetime'  => $tm,
            );

            $create = $this->Constant_model->insertDataReturnLastId('order', $data);

            $id = $this->input->post('id');
        
            foreach ($id AS $key => $detail){
                $upddata = array(
                    'id_order'  => $create,
                    'id_p'      => $this->input->post('id')[$key],
                    'qty'       => $this->input->post('qty')[$key],
                    'subtotal'  => $this->input->post('qty')[$key] * $this->input->post('harga')[$key]
                );

                $this->Constant_model->insertData('order_detail', $upddata);
                
            }


            $ckDtorder = $this->Order_model->getDataEmail($create);

            $dtnotif = array(
                'keterangan'        => 'Order baru dari Gudang '.$data['id_gudang'].' telah diterima',
                'created_datetime'  => $tm,
                'status'            => '0',
                'role'              => '1',
                'info'              => 'order_baru'
            );

            $this->Constant_model->insertData('notifikasi', $dtnotif);


        } else {
            echo json_encode(array(
                "status" => FALSE,
                "flash_header"  => 'Tambah Order',
                "flash_desc"  => 'Gagal Menambah Orderan, Tolong untuk diperhatikan Total nilai maksimal Orderan',
            ));

            die();
        }
        
        echo json_encode(array(
            "status" => TRUE,
            "flash_header"  => 'Tambah Order',
            "flash_desc"  => 'Berhasil menambah Orderan ke Admin',
        ));

    }


    // public function validOrderMasuk($id)
    // {
    //     $tm = date('Y-m-d H:i:s', time());

    //     $ckStOrder = $this->Constant_model->getDataTwoColumn('order', 'status_order', '1', 'id_order',$id);
    //     // var_dump(count($ckStOrder));
    //     // die();

    //     if (count($ckStOrder) == 1) {
    //             $data = array(
    //                 'status_order'     => '2',
    //                 'tanggal_valid' => $tm,
    //             );

    //             if ($this->Constant_model->updateDataDinamis('order', $data, 'id_order', $id)) {
    //                 $this->session->set_flashdata('alert_msg', array('success', 'Validasi Order', 'Berhasil Memvalidasi Orderan'));
    //             };

    //         }else{
    //             $this->session->set_flashdata('alert_msg', array('failure', 'Validasi Order', "Status Orderan bukan diproses!"));
    //         }

    //     echo json_encode(array("status" => TRUE));

    // }

    // public function selesaiOrderMasuk($id)
    // {
    //     $tm = date('Y-m-d H:i:s', time());

    //     $ckStOrder = $this->Constant_model->getDataTwoColumn('order', 'status_order', '1', 'id_order',$id);
    //     // var_dump($jthtmp->jatuh_tempo);
    //     // die();

    //     if (count($ckStOrder) == 1) {
    //         $tglorder = $this->Constant_model->getDataTwoColumnRow('order', 'status_order', '1', 'id_order',$id);
    //         $limit = $this->Setting_model->getSetting();
    //         $jatuh_tempo = date('Y-m-d H:i:s',strtotime($tglorder -> tanggal_order)  + (86400 * $limit->jatuh_tempo));
    //             // var_dump($jatuh_tempo);
    //             // die();

    //             $data = array(
    //                 'status_order'     => '2',
    //                 'tanggal_selesai' => $tm,
    //                 'jatuh_tempo' => $jatuh_tempo,
    //                 // 'tanggal_pembayaran' => $jatuh_tempo,

    //             );

    //             if ($this->Constant_model->updateDataDinamis('order', $data, 'id_order', $id)) {
    //                 $this->session->set_flashdata('alert_msg', array('success', 'Selesai Order', 'Berhasil Menyelesaikan Orderan'));
    //             };

    //         }else{
    //             $this->session->set_flashdata('alert_msg', array('failure', 'Selesai Order', "Status Orderan bukan Diproses!"));
    //         }

    //     echo json_encode(array("status" => TRUE));

    // }

   
    public function detailMasuk($id)
    {
        $outlet_id = $this->session->userdata('outlet_id');
        // $data['data'] = $this->Constant_model->getDataOneJoinTwoWhereRowArray('order_detail','id_order','order','id_order','id_bengkel',$outlet_id, 'order.id_order', $id, 'order_detail.id_order', 'desc');
        $data['data'] = $this->Constant_model->getDataOneJoinOneWhereRowArray('order_detail','id_order','order','id_order','order.id_order', $id, 'order_detail.id_order', 'desc');
        // $data['array'] = $this->Constant_model->getDataOneJoinWhere('order_detail','id_p','produk','id_p','order_detail.id_order',$id, 'order_detail.id_order', 'desc');
        $data['array'] = $this->Order_model->getDataDetailGudang($id);
        // echo json_encode($data);
        // var_dump($data['array']);

        // die();
        $this->load->view('admin/order/detail-ordermasukgudang', $data);
    }

    public function cetakMasuk($id)
    {
        if (empty($id))
        {
            show_404();
        }

        $data['data'] = $this->Order_model->getDataGudangBengkel($id);
        // $data['array'] = $this->Constant_model->getDataOneJoinWhere('order_detail','id_p','produk','id_p','order_detail.id_order',$id, 'order_detail.id_order', 'desc');
        $data['array'] = $this->Order_model->getDataDetail($id);

        $this->load->view('admin/laporan/print-ordergudangmasuk.php',$data);
    }

    public function lapOrderBy()
    {
        $start              = date("Y-m-d",strtotime($this->input->post('start')));
        $end                = date("Y-m-d",strtotime($this->input->post('end')));
        $status             = $this->input->post('status');

        $data['start']      = $start;
        $data['end']        = $end;
        $data['status']     = $status;

        $data['order'] = $this->Order_model->getOrderMasukGd($start,$end,$status);
        $data['judulorder'] = $this->Order_model->getOrderJudulMasukGd($start,$end,$status);

        $this->load->view('admin/order/table-tampildataordermasukgudang', $data); 
        
    }

    public function cetakLaporan($start, $end, $status)
    {

        $kdgudang = $this->session->userdata('outlet_id');

        if (empty($kdgudang))
        {
            show_404();
        }



        $data['start']      = date("Y-m-d",strtotime($start));
        $data['end']        = date("Y-m-d",strtotime($end));


        $data['order'] = $this->Order_model->getOrderMasukGd($data['start'],$data['end'],$status);
        $data['judulorder'] = $this->Order_model->getOrderJudulMasukGd($data['start'],$data['end'],$status);
        $data['bengkel'] = $this->Order_model->getDataBengkel($kdgudang);

        $this->load->view('admin/laporan/print-lapordermasukgudang',$data);
    }
}

/* End of file controllername.php */
/* Location: ./application/controllers/controllername.php */
