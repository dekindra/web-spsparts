<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orderbengkel extends CI_Controller {

    private $settingData;

	public function __construct()
	{
		parent::__construct();
		//Load Dependencies
        $this->load->model('Constant_model');
        $this->load->model('Notifikasi_model');
        $this->load->model('Dashboard_model');
        $this->load->model('Order_model');
        $this->load->model('Setting_model');

        $this->settingData = $this->Setting_model->getSetting();
        $setting_timezone = $this->settingData->timezone;  

        date_default_timezone_set("$setting_timezone");

	}

	private function getData(){
        $outlet_id = $this->session->userdata('outlet_id');
        $data = array(
            'title' => "Order Baru",
            // 'breadcumb' => "",
            'menu' => "baru",
            'posisi' => "orderbengkel",
            'content' => "admin/order/index-orderbaru",
            'param'=> array(
                'orders' => $this->Constant_model->getDataOneColumnSortColumn('order','id_bengkel',"$outlet_id", 'tanggal_order', 'desc'),
                'totalorder' => $this->Order_model->getTotalOrder($outlet_id),
                'statusgudang' => $this->Dashboard_model->statusGudang($outlet_id),
                'limitorder' => $this->Constant_model->getDataOneColumnRowArray('bengkel','id_bengkel',"$outlet_id"),
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
        $limitorder = $this->Constant_model->getDataOneColumnRowArray('bengkel','id_bengkel',"$outlet_id");

        if ($this->input->post('total_pembelian') <=  $limitorder["limit_order"]) {
            $data = array(
            // 'id_supplier'       => '0',
                'id_bengkel'         => $this->session->userdata('outlet_id'),
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

            $ckDtorder = $this->Order_model->getDataEmail($create);

            $dtnotif = array(
                'keterangan'        => 'Order baru dari bengkel '.$data['id_bengkel'].' telah diterima',
                'created_datetime'  => $tm,
                'status'            => '0',
                'role'              => '2',
                'outlet'            =>  $ckDtorder->id_gudang,
                'info'              => 'order_baru'
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
                "flash_desc"  => 'Gagal Menambah Orderan, Tolong untuk diperhatikan Total nilai maksimal Orderan',
            ));
            die();
        }
        
        echo json_encode(array(
            "status" => TRUE,
            "flash_header"  => 'Tambah Order',
            "flash_desc"  => 'Berhasil menambah orderan',
        ));

    }

    public function addWishlist()
    {
        $tm = date('Y-m-d H:i:s', time());
        $outlet_id = $this->session->userdata('outlet_id');

        if (!is_null($outlet_id)) {
        
            foreach ($_POST['order'] as $id => $detail){
                if($detail['id_produk']!=''){
                    $data = array(
                        'id_p'      => $detail['id_produk'],
                        'qty'       => $detail['quantity'],
                        'subtotal'  => $detail['sub_total'],
                        'type'      => 'bengkel',
                        'id_outlet' => $outlet_id,
                        'tanggal'   => $tm
                    );

                    $this->Constant_model->insertData('order_wishlist', $data);
                }
            }

            echo json_encode(array(
                "status" => TRUE,
                "flash_header"  => 'Tambah Wishlist',
                "flash_desc"  => 'Berhasil menambah wishlist',
            ));

        } else {
            echo json_encode(array(
                "status" => FALSE,
                "flash_header"  => 'Tambah Wishlist',
                "flash_desc"  => 'Gagal Menambah Wishlist',
            ));
        }

        
    }

    public function lapOrderBy()
    {
        $start              = date("Y-m-d",strtotime($this->input->post('start')));
        $end                = date("Y-m-d",strtotime($this->input->post('end')));
        $status             = $this->input->post('status');

        $data['start']      = $start;
        $data['end']        = $end;
        $data['status']     = $status;

        $data['order'] = $this->Order_model->getOrder($start,$end,$status);
        $data['judulorder'] = $this->Order_model->getOrderJudul($start,$end,$status);

        $this->load->view('admin/order/table-tampildataorderbaru', $data); 
        
    }

    public function cetakLaporan($start, $end, $status)
    {

        $kdbengkel = $this->session->userdata('outlet_id');

        if (empty($kdbengkel))
        {
            show_404();
        }



        $data['start']      = date("Y-m-d",strtotime($start));
        $data['end']        = date("Y-m-d",strtotime($end));


        $data['order'] = $this->Order_model->getOrder($data['start'],$data['end'],$status);
        $data['judulorder'] = $this->Order_model->getOrderJudul($data['start'],$data['end'],$status);
        $data['bengkel'] = $this->Constant_model->getDataOneColumnRowArray('bengkel', 'id_bengkel',$kdbengkel);

        $this->load->view('admin/laporan/print-laporderbaru',$data);
    }

    // public function detailview($id)
    // {
    //     $outlet_id = $this->session->userdata('outlet_id');
    //     $data = array(
    //         'title' => "Order Baru",
    //         // 'breadcumb' => "",
    //         'menu' => "baru",
    //         'posisi' => "order",
    //         'content' => "admin/order/detail-orderbaru",
    //         'param'=> array(
    //             'orders' => $this->Constant_model->getDataOneJoinTwoWhere('order_detail','id_order','order','id_order','id_bengkel',$outlet_id, 'order.id_order', $id, 'order_detail.id_order', 'desc'),
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

    //     $this->load->view('admin/templates/layout', $data);
    // }


    // public function ajax_edit($id)
    // {
    //     $outlet_id = $this->session->userdata('outlet_id');
    //     $data['data'] = $this->Constant_model->getDataOneJoinTwoWhereRowArray('order_detail','id_order','order','id_order','id_bengkel',$outlet_id, 'order.id_order', $id, 'order_detail.id_order', 'desc');
    //     $data['array'] = $this->Constant_model->getDataOneJoinWhere('order_detail','id_p','produk','id_p','order_detail.id_order',$id, 'order_detail.id_order', 'desc');

    //     // echo json_encode($data);
    //     // var_dump($data['array']);

    //     // die();
    //     $this->load->view('admin/order/detail-orderbaru', $data);
    // }

    public function ajax_edit($id)
    {
        $outlet_id = $this->session->userdata('outlet_id');
        $data['data'] = $this->Constant_model->getDataOneJoinTwoWhereRowArray('order_detail','id_order','order','id_order','id_bengkel',$outlet_id, 'order.id_order', $id, 'order_detail.id_order', 'desc');
        $data['array'] = $this->Order_model->getDataDetail($id);
        // $data['array'] = $this->Constant_model->getDataOneJoinWhere('order_detail','id_p','produk','id_p','order_detail.id_order',$id, 'order_detail.id_order', 'desc');

        // echo json_encode($data);
        // var_dump($data['array']);

        // die();
        $this->load->view('admin/order/detail-orderinputbengkel', $data);
    }

    public function selesaiOrder($kode)
    {
        $tm = date('Y-m-d H:i:s', time());

        $ckStOrder = $this->Constant_model->getDataTwoColumn('order', 'status_order', '1', 'id_order',$kode); 

        // var_dump(count($ckStOrder));
        // die();

        if (count($ckStOrder) == 1) {
            $limit = $this->Setting_model->getSetting();
            $jatuh_tempo = date('Y-m-d H:i:s',strtotime($tm)  + (86400 * $limit->jatuh_tempo));
            // var_dump($jatuh_tempo);
            // die();

            $data = array(
                'status_order'      => '2',
                'tanggal_selesai'   => $tm,
                'jatuh_tempo'       => $jatuh_tempo,
                    // 'tanggal_pembayaran' => $jatuh_tempo,
            );

            if ($this->Constant_model->updateDataDinamis('order', $data, 'id_order', $kode)) {

                $id_produk = $this->input->post('id');

                $result = array();

                foreach($id_produk AS $key => $val){
                 $result = array(
                  "id_p"        => $_POST['id'][$key],
                  "id_bengkel"  => $this->session->userdata('outlet_id'),
                  "stock"       => $_POST['qty'][$key],
                  "harga_jual"  => $_POST['het'][$key],
              );

                 $ckDtInven = $this->Constant_model->getDataTwoColumn('inventory', 'id_p', $result['id_p'], 'id_bengkel',$result['id_bengkel']);

                 if (count($ckDtInven) == 1) {
                     $this->Constant_model->updateDataDinamisTwoWhere('inventory', $result, 'id_p', $val, 'id_bengkel', $result['id_bengkel']);
                 } else {
                     $this->Constant_model->insertData('inventory', $result);
                 }  
             }

             $ckDtorder = $this->Order_model->getDataEmail($kode);

            $dtnotif = array(
                'keterangan'        => 'Order dengan kode '.$kode.' telah diselesai',
                'created_datetime'  => $tm,
                'status'            => '0',
                'role'              => '2',
                'outlet'            =>  $ckDtorder->id_gudang,
                'info'              => 'order_selesai'
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
            $this->email->subject('Order Selesai');
            $this->email->message($emailtemp);
          
            // $this->email->send();

            if (!$this->email->send()) {  
                echo $this->email->print_debugger();   
            }

             $this->session->set_flashdata('alert_msg', array('success', 'Selesai Order', 'Berhasil Menyelesaikan Orderan'));
            };

        }else{
        $this->session->set_flashdata('alert_msg', array('failure', 'Selesai Order', "Status Orderan bukan Diproses!"));
        }

        echo json_encode(array("status" => TRUE));
    }

    // public function bulk_produk($kode)
    // {
    //     $total_tagihan = 0;
    //     $tm = date('Y-m-d H:i:s', time());
    //     $id = $this->input->post('id');
 
    //     $result = array();

    //     foreach($id AS $key => $val){
    //      $result = array(
    //       "subtotalditerima" => $_POST['harga'][$key] * $_POST['qty'][$key],
    //       "qtyditerima"  => $_POST['qty'][$key],
    //      );
    //      $total_tagihan = $total_tagihan + $result['subtotalditerima'];
    //      $this->Constant_model->updateDataDinamisTwoWhere('order_detail', $result, 'id_order', $kode, 'id_p', $val);
    //     }

    //     $data = array(
    //         'total_tagihan'     => $total_tagihan,
    //         'status_order'      => '2',
    //         'tanggal_valid'     => $tm,
    //     );

    //     $this->Constant_model->updateDataDinamis('order', $data, 'id_order', $kode);

    //     $this->session->set_flashdata('alert_msg', array('success', 'Validasi Order', "Orderan Telah Divalidasi!"));

    //     echo json_encode(array("status" => TRUE));
    // }

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
                'het_bengkel'     => $row->het_bengkel,
                'search'     => $row->searchdeskripsi,
            );
        }
        echo json_encode($arrays);
    }

    public function cetak($id)
    {

        if (empty($id))
        {
            show_404();
        }

        $data['data'] = $this->Order_model->getDataGudangBengkel($id);
        // $data['array'] = $this->Constant_model->getDataOneJoinWhere('order_detail','id_p','produk','id_p','order_detail.id_order',$id, 'order_detail.id_order', 'desc');
        $data['array'] = $this->Order_model->getDataDetail($id);

        $this->load->view('admin/laporan/print-orderbengkel.php',$data);
    }

}

/* End of file controllername.php */
/* Location: ./application/controllers/controllername.php */
