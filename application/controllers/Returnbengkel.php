<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Returnbengkel extends CI_Controller {

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
        $outlet_id = $this->session->userdata('outlet_id');
        $data = array(
            'title' => "Return Barang",
            // 'breadcumb' => "",
            'menu' => "returnbengkel",
            'posisi' => "orderbengkel",
            'content' => "admin/return/return-orderbengkel",
            'param'=> array(
                'returns' => $this->Constant_model->getDataOneColumnSortColumn('retur','id_bengkel',"$outlet_id", 'created_datetime', 'desc'),
                'totalreturn' => $this->Return_model->getTotalReturn($outlet_id),
                'statusgudang' => $this->Dashboard_model->statusGudang($outlet_id),
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
        $ckDtretur = $this->Constant_model->getDataOneColumnRowArray('retur','id_retur',$id);

        if ($ckDtretur['status_retur']==0) {
            //delete file
            $this->Constant_model->deleteDataDinamis('retur', 'id_retur', $id);
            $this->Constant_model->deleteDataDinamis('retur_detail', 'id_retur', $id);

            echo json_encode(array(
                "status" => TRUE,
                "flash_header"  => 'Delete Return',
                "flash_desc"  => 'Berhasil menghapus Orderan',
            ));
        }else{
            echo json_encode(array(
                "status" => FALSE,
                "flash_header"  => 'Delete Return',
                "flash_desc"  => 'Gagal menghapus return dikarenakan status retur sudah diterima',
            ));
        }
    }

     // Insert New Bengkel;
    public function add()
    {
        $tm = date('Y-m-d H:i:s', time());
        $outlet_id = $this->session->userdata('outlet_id');

        $data = array(
        // 'id_supplier'       => '0',
            'id_bengkel'         => $this->session->userdata('outlet_id'),
            'total_retur'       => $this->input->post('total_retur'),
            'created_user_id'   => $this->session->userdata('id'),
            'created_datetime'  => $tm,
        );


        $create = $this->Constant_model->insertDataReturnLastId('retur', $data);
    
        foreach ($_POST['order'] as $id => $detail){
            if($detail['id_produk']!=''){
                $upddata = array(
                    'id_retur'  => $create,
                    'id_p'      => $detail['id_produk'],
                    'qty'       => $detail['quantity'],
                    'subtotal'  => $detail['sub_total']
                );

                $this->Constant_model->insertData('retur_detail', $upddata);
            }
        }

        // $ckDtorder = $this->Order_model->getDataEmail($create);

        // $dtnotif = array(
        //     'keterangan'        => 'Order baru dari bengkel '.$data['id_bengkel'].' telah diterima',
        //     'created_datetime'  => $tm,
        //     'status'            => '0',
        //     'role'              => '2',
        //     'outlet'            =>  $ckDtorder->id_gudang,
        //     'info'              => 'order_baru'
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
        // $this->email->subject('Order');
        // $this->email->message($emailtemp);
      
        // // $this->email->send();

        // if (!$this->email->send()) {  
        //     echo $this->email->print_debugger();   
        // }
    
        echo json_encode(array(
            "status" => TRUE,
            "flash_header"  => 'Tambah Return',
            "flash_desc"  => 'Berhasil menambah return',
        ));

    }

    public function lapReturnBy()
    {
        $start              = date("Y-m-d",strtotime($this->input->post('start')));
        $end                = date("Y-m-d",strtotime($this->input->post('end')));
        $status             = $this->input->post('status');

        $data['start']      = $start;
        $data['end']        = $end;
        $data['status']     = $status;

        $data['return'] = $this->Return_model->getReturn($start,$end,$status);
        $data['judulreturn'] = $this->Return_model->getReturnJudul($start,$end,$status);

        $this->load->view('admin/return/table-tampildatareturnbengkel', $data); 
        
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


        $data['return'] = $this->Return_model->getReturn($data['start'],$data['end'],$status);
        $data['judulreturn'] = $this->Return_model->getReturnJudul($data['start'],$data['end'],$status);
        $data['bengkel'] = $this->Constant_model->getDataOneColumnRowArray('bengkel', 'id_bengkel',$kdbengkel);

        $this->load->view('admin/laporan/print-lapreturnorderbengkel',$data);
    }


    public function ajax_edit($id)
    {
        $outlet_id = $this->session->userdata('outlet_id');
        $data['data'] = $this->Constant_model->getDataOneColumnRowArray('retur','id_retur', $id);
        $data['array'] = $this->Return_model->getDataDetail($id);

        $this->load->view('admin/return/detail-returnorderbengkel', $data);
    }


    public function autocompleteproduk(){
        // Ambil nama 
        $cari = $_GET['cari'];
        $outlet_id = $this->session->userdata('outlet_id');
        // Cari Nama
        // $data = $this->db->from('produk')->like('name_p',$cari)->get();
        $data = $this->Return_model->getDtProduk($cari, $outlet_id);
        // Inisialisasi Array

        $arrays = array();
        // foreach($data->result() as $row)
        foreach($data as $row)
        {
            $arrays[] = array(
                'id'            => $row->id_p,
                'name'          => $row->name_p,
                'code'          => $row->code_p,
                'price'         => $row->purchase_price,
                'het_bengkel'   => $row->het_bengkel,
                'search'        => $row->searchdeskripsi,
            );
        }
        echo json_encode($arrays);
    }

    public function cetak($id)
    {
        $outlet_id = $this->session->userdata('outlet_id');

        if (empty($id))
        {
            show_404();
        }

        $data['data'] = $this->Return_model->getDataGudangBengkel($outlet_id);
        $data['return'] = $this->Constant_model->getDataOneColumnRowArray('retur','id_retur',$id);
        $data['array'] = $this->Return_model->getDataDetail($id);

        $this->load->view('admin/laporan/print-returbengkel.php',$data);
    }

}

/* End of file controllername.php */
/* Location: ./application/controllers/controllername.php */
