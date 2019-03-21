<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Returnadmin extends CI_Controller {

	private $settingData;

    public function __construct()
    {
        parent::__construct();
        //Load Dependencies
        $this->load->model('Constant_model');
        $this->load->model('Notifikasi_model');
        $this->load->model('Dashboard_model');
        $this->load->model('Return_model');
        $this->load->model('Setting_model');

        $this->settingData = $this->Setting_model->getSetting();
        $setting_timezone = $this->settingData->timezone;  

        date_default_timezone_set("$setting_timezone");

    }

	private function getData(){
        $data = array(
            'title' => "Return Order",
            // 'breadcumb' => "",
            'menu' => "returnadminkeluar",
            'posisi' => "orderadmin",
            'content' => "admin/return/return-orderadminkeluar",
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
		$this->load->view('admin/templates/layout', $this->getData());

	}

    public function detailview()
    {
        $data = array(
            'title' => "Order Baru",
            // 'breadcumb' => "",
            'menu' => "baru",
            'posisi' => "order",
            'content' => "admin/return/detail-orderbaru",
            'param'=> array(
                // 'absensis' => $this->Absensi_model->getAllAccount(),
                // 'siswas'=>$this->Siswa_model->getAllAccount_byWk(),
            ),
            'css' => array(
                1 => 'assets/base/assets/examples/css/tables/basic', //datatable ..
                2 => 'assets/global/fonts/font-awesome/font-awesome', //font
            ),
            // 'jscss' => array(
            //     1 => 'asset/bower_components/jquery/dist/jquery.min',
            //     // 2 => 'asset/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min',
            // ),
            'js' =>array(
                1 => 'assets/global/vendor/peity/jquery.peity.min',//mengelem tampil
                2 => 'assets/global/js/Plugin/peity',//mengelem tampil
                3 => 'assets/global/js/Plugin/table',//mengelem tampil
                4 => 'assets/base/assets/examples/js/charts/peity'//mengelem tampil
            )
        );
        
        // <script src="../../../.js"></script>
        // <script src="../../../global/js/Plugin/asselectable.js"></script>
        // <script src="../../../global/js/Plugin/selectable.js"></script>
        // <script src="../../../.js"></script>
        // <script src="../../../global/js/Plugin/asscrollable.js"></script>
    
        // <script src="../../.js"></script>

        $this->load->view('admin/templates/layout', $data);
    }

	// Add a new item
	public function add()
	{

	}

	//Update one item
	public function update( $id = NULL )
	{

	}

	//Delete one item
	public function delete( $id = NULL )
	{

	}

    private function getDataMasuk(){
        $outlet_id = $this->session->userdata('outlet_id');
        $data = array(
            'title' => "Return Barang",
            // 'breadcumb' => "",
            'menu' => "returnadminmasuk",
            'posisi' => "orderadmin",
            'content' => "admin/return/return-orderadminmasuk",
            'param'=> array(
                'returns' => $this->Constant_model->getDataOneJoin('retur','id_gudang','gudang','id_gudang','id_retur','desc'),
                'totalreturn' => $this->Return_model->getTotalReturnAdmin(),
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
    public function masuk()
    {
        $role = $this->session->userdata('role');
        $outlet = $this->session->userdata('outlet_id');
        $content['notif'] = $this->Notifikasi_model->getData($role,$outlet);

        $data = array_merge($content, $this->getDataMasuk());
        $this->load->view('admin/templates/layout', $data);

    }

    public function ajax_editmasuk($id)
    {
        $data['data'] = $this->Constant_model->getDataOneColumnRowArray('retur','id_retur',$id);
        $data['array'] = $this->Return_model->getDataDetail($id);

        $this->load->view('admin/return/detail-returnorderadminmasuk', $data);
    }

    public function diterima($kode)
    {
        $tm = date('Y-m-d H:i:s', time());

        $data = array(
            'status_retur' => '1'
        );

        if($this->Constant_model->updateDataDinamis('retur', $data, 'id_retur', $kode)){

            $ckDtretur = $this->Constant_model->getDataOneJoinWhere('retur', 'id_retur', 'retur_detail', 'id_retur','retur.id_retur',$kode, 'retur.id_retur', 'desc'); 
            // $ckDtretur = $this->Return_model->getDataReturnProduk($kode);
            $idproduk = []; 
            $qty = []; 

            // for($i=0;$i<count($ckDtretur);$i++){
            //     $idproduk[$i] = $ckDtretur[$i]->id_p;
            //     $qty[$i] = $ckDtretur[$i]->qty;
            // };

            foreach ($ckDtretur as $dtretur => $dr) {
                $idproduk[$dtretur] = $ckDtretur[$dtretur]->id_p;
                $qty[$dtretur] = $ckDtretur[$dtretur]->qty;
            }


            foreach($idproduk AS $key => $val){
             $ckDtInven = $this->Constant_model->getDataTwoColumnRow('inventory', 'id_p', $val, 'id_gudang',$ckDtretur[0]->id_gudang);

                $result = array(
                    'stock'  => $ckDtInven->stock - $qty[$key],
                );

                $this->Constant_model->updateDataDinamisTwoWhere('inventory', $result, 'id_p', $val, 'id_gudang', $ckDtretur[0]->id_gudang);
             }



            //  $ckDtorder = $this->Order_model->getDataEmail($kode);

            // $dtnotif = array(
            //     'keterangan'        => 'Order dengan kode '.$kode.' telah diselesai',
            //     'created_datetime'  => $tm,
            //     'status'            => '0',
            //     'role'              => '2',
            //     'outlet'            =>  $ckDtorder->id_gudang,
            //     'info'              => 'order_selesai'
            // );

            // $this->Constant_model->insertData('notifikasi', $dtnotif);

            
            // $dtemail = array(
            //     'id_bengkel'  =>  $ckDtorder->id_bengkel,
            //     'tanggal_order'  =>  $ckDtorder->tanggal_order,
            //     'total_pembelian'  =>  $ckDtorder->total_pembelian,
            // );


            // $emailtemp=$this->load->view('admin/notif/notif_orderbengkel.php',$dtemail,TRUE);

            // $this->load->library('email');
            // $this->email->from($this->settingData->email_broadcast, 'Sps Parts');
            // $this->email->to($ckDtorder->email);
            // $this->email->subject('Order Selesai');
            // $this->email->message($emailtemp);
          
            // // $this->email->send();

            // if (!$this->email->send()) {  
            //     echo $this->email->print_debugger();   
            // }

            //  $this->session->set_flashdata('alert_msg', array('success', 'Selesai Order', 'Berhasil Menyelesaikan Orderan'));

            echo json_encode(array(
                "status" => TRUE,
                "flash_header"  => 'Terima Return',
                "flash_desc"  => 'Berhasil menerima return',
            ));

        }else{
            echo json_encode(array(
                "status" => FALSE,
                "flash_header"  => 'Terima Return',
                "flash_desc"  => 'Gagal menerima return',
            ));
        }
        
    }



    public function cetakmasuk($id)
    {
        $outlet_id = $this->session->userdata('outlet_id');

        if (empty($id))
        {
            show_404();
        }

        $data['data'] = $this->Constant_model->getDataOneJoinOneWhereRowArray('retur','id_gudang', 'gudang', 'id_gudang', 'id_retur', $id , 'id_retur', 'desc');
        $data['return'] = $this->Constant_model->getDataOneColumnRowArray('retur','id_retur',$id);
        $data['array'] = $this->Return_model->getDataDetail($id);

        $this->load->view('admin/laporan/print-returadminmasuk.php',$data);
    }

    public function lapReturnBy()
    {
        $start              = date("Y-m-d",strtotime($this->input->post('start')));
        $end                = date("Y-m-d",strtotime($this->input->post('end')));
        $status             = $this->input->post('status');

        $data['start']      = $start;
        $data['end']        = $end;
        $data['status']     = $status;

        $data['return'] = $this->Return_model->getReturnMasukAdmin($start,$end,$status);
        $data['judulreturn'] = $this->Return_model->getReturnJudulMasukAdmin($start,$end,$status);

        $this->load->view('admin/return/table-tampildatareturnmasukadmin', $data); 
        
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


        $data['return'] = $this->Return_model->getReturnMasukAdmin($data['start'],$data['end'],$status);
        $data['judulreturn'] = $this->Return_model->getReturnJudulMasukAdmin($data['start'],$data['end'],$status);

        $this->load->view('admin/laporan/print-lapreturnordermasukadmin',$data);
    }
}

/* End of file ReturnAdmin.php */
/* Location: ./application/controllers/ReturnAdmin.php */
