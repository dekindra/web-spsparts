<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penjualan extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        //Load Dependencies
        $this->load->model('Constant_model');
        $this->load->model('Notifikasi_model');
        $this->load->model('Penjualan_model');

        $this->load->model('Setting_model');

        $settingData = $this->Setting_model->getSetting();
        $setting_timezone = $settingData->timezone;  

        date_default_timezone_set("$setting_timezone");

    }

    private function getData(){
        $data = array(
            'title' => "Penjualan",
            // 'breadcumb' => "",
            'menu' => "penjualan",
            'posisi' => "aplikasi",
            'content' => "admin/penjualan/pos",
            'param'=> array(
                // 'absensis' => $this->Absensi_model->getAllAccount(),
                // 'siswas'=>$this->Siswa_model->getAllAccount_byWk(),
            ),
        );
        return $data;
    }

    // List all your items
    public function index()
    {
        $kdbengkel = $this->Penjualan_model->getIdBengkel($this->session->userdata('outlet_id'));

         $data = array(
            'title' => "Penjualan",
            // 'breadcumb' => "",
            'menu' => "penjualan",
            'posisi' => "aplikasi",
        );

        $param = array('pelanggans' => $this->Constant_model->getDataOneColumnResult('pelanggan', 'id_bengkel', $kdbengkel->idbengkelkasir));

        $adata = array_merge($param, $data);
        
        $this->load->view('admin/penjualan/pos', $adata);
    }


    public function add()
    {
        $bayar = $_POST['bayar'];
        $pelanggan = $_POST['pelanggan'];
         
        // validasi seadanya :v
        if ($bayar == '') {
            $data['error']['bayar'] = 'Bayar tidak boleh kosong';
        }

        if ($pelanggan == '') {
            $data['error']['pelanggan'] = 'Pelanggan tidak boleh kosong';
        }

        // var_dump($data['error']);
        // die();
         
        if (empty($data['error'])) {
            // jika validasi berhasil 
            // lakukan proses simpan data disini atau perintah lainnya
            // INSERT INTO bla bla bla...

            $tm = date('Y-m-d H:i:s', time());

            $kdbengkel = $this->Penjualan_model->getIdBengkel($this->session->userdata('outlet_id'));

            // $this->form_validation->set_rules('bayar', 'Nominal Bayar', 'trim|required');

            // if ($this->form_validation->run() === TRUE) {

            // }

            foreach ($_POST['order'] as $id => $detail){ 
                $cekstock = $this->Constant_model->getDataTwoColumnRow('inventory', 'id_p', $detail['id_produk'] , 'id_bengkel', $kdbengkel->idbengkelkasir);

                if (!is_null($cekstock->stock)) {
                    if ($detail['quantity'] > $cekstock->stock ) {

                        $this->session->set_flashdata('alert_msg', array('failure', 'Tambah Penjualan', 'Mohon cek lagi stock setiap barang yang dibeli'));
                        // redirect(base_url().'penjualan');
                         $data['hasil'] = 'gagal';
                        die();

                    }
                }else{
                    $this->session->set_flashdata('alert_msg', array('failure', 'Tambah Penjualan', 'Mohon cek lagi stock setiap barang yang dibeli'));
                    // redirect(base_url().'penjualan');
                    die();
                }
            }

            $dataa = array(
            // 'id_supplier'       => '0',
                'id_bengkel'        => $kdbengkel->idbengkelkasir,
                'id_pelanggan'      => $this->input->post('pelanggan'),
                'total'             => $this->input->post('total_pembelian'),
                'bayar'             => $this->input->post('bayar'),
                'kembali'           => $this->input->post('kembaliannya'),
                'created_user_id'   => $this->session->userdata('outlet_id'),
                'created_datetime'  => $tm,
            );


            $create = $this->Constant_model->insertDataReturnLastId('penjualan', $dataa);
        
            foreach ($_POST['order'] as $id => $detail){
                if($detail['id_produk']!=''){
                    $upddata = array(
                        'id_penjualan'  => $create,
                        'id_p'      => $detail['id_produk'],
                        'qty'       => $detail['quantity'],
                        'subtotal'  => $detail['sub_total']
                    );

                    $cekstockbrng = $this->Constant_model->getDataTwoColumnRow('inventory', 'id_p', $detail['id_produk'] , 'id_bengkel', $kdbengkel->idbengkelkasir);

                    $dtinven = array(
                        'stock'     => $cekstockbrng->stock - $upddata['qty'],
                    );

                    $this->Constant_model->updateDataDinamisTwoWhere('inventory',$dtinven, 'id_p', $detail['id_produk'] , 'id_bengkel', $kdbengkel->idbengkelkasir);
                    $this->Constant_model->insertData('penjualan_detail', $upddata);
                }
            }

            // $ckDtorder = $this->Order_model->getDataEmail($kode);

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

            $this->session->set_flashdata('alert_msg', array('success', 'Tambah Order', 'Berhasil Menambah Orderan'));

            $data['hasil'] = 'sukses';

        } else {
            // jika validasi gagal
            $data['hasil'] = 'gagal';
        }

        echo json_encode($data);
       
        
        // echo json_encode(array("status" => TRUE));

    }

    public function addPelanggan()
    {
        $nama = $this->input->post('nama');
        $tm = date('Y-m-d H:i:s', time());

        // $kdbengkel = $this->Kasir_model->getIdBengkel($this->session->userdata('outlet_id'));
        // var_dump($this->session->userdata('outlet_id'));
        // var_dump($this->input->post('nama'));
        // die();

        if (empty($nama)) {
            $this->session->set_flashdata('alert_msg', array('failure', 'Tambah Pelanggan', 'masukkan Nama Pelanggan!'));
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
            $kdbengkel = $this->Penjualan_model->getIdBengkel($this->session->userdata('outlet_id'));

            $data = array(
                      'nama' => $nama,
                      'email' => $this->input->post('email'),
                      'telepon' => $this->input->post('telepon'),
                      'id_bengkel' => $kdbengkel->idbengkelkasir,
                      'created_user_id' => $this->session->userdata('outlet_id'),
                      'created_datetime' => date('Y-m-d H:i:s', time()),
                      'updated_user_id' => '0',
                      'updated_datetime' => date('Y-m-d H:i:s', time()),
                      'status' => '1',
            );

            if ($this->Constant_model->insertData('pelanggan', $data)) {
                $this->session->set_flashdata('alert_msg', array('success', 'Tambah Pelanggan', "Berhasil menambahkan Pelanggan $nama"));
                // redirect(base_url().'kategoriproduk');
            }

        }

        echo json_encode(array("status" => TRUE));
    }

    public function autocomplete(){
        $kdbengkel = $this->Penjualan_model->getIdBengkel($this->session->userdata('outlet_id'));
        // Ambil nama 
        $cari = $_GET['cari'];
        // Cari Nama
        $data = $this->db->from('pelanggan')->like('nama',$cari)->where('id_bengkel',$kdbengkel->idbengkelkasir)->get();  
        // Inisialisasi Array
        $arrays = array();
        foreach($data->result() as $row)
        {
            $arrays[] = array(
                'id'        => $row->id,
                'nama'      => $row->nama,
                'telepon'   => $row->telepon,
                'email'    => $row->email,
            );
        }
        echo json_encode($arrays);
    }

    public function autocompleteproduk(){
        // Ambil nama 
        $cari = $_GET['cari'];
        $kdbengkel = $this->Penjualan_model->getIdBengkel($this->session->userdata('outlet_id'));
        // Cari Nama
        // $data = $this->db->from('produk')->like('name_p',$cari)->get();
        $data = $this->Penjualan_model->getDtProduk($cari, $kdbengkel->idbengkelkasir);
        // Inisialisasi Array

        $arrays = array();
        // foreach($data->result() as $row)
        foreach($data as $row)
        {
            $arrays[] = array(
                'id'        => $row->id_p,
                'name'      => $row->name_p,
                'code'      => $row->code_p,
                'diskon'    => $row->diskon,
                'price'     => $row->purchase_price,
                'stock'     => $row->stock,
            );
        }
        echo json_encode($arrays);
    }



    private function getDataList(){
        $kdbengkel = $this->Penjualan_model->getIdBengkel($this->session->userdata('outlet_id'));

        $data = array(
            'title' => "Daftar Penjualan",
            // 'breadcumb' => "",
            'menu' => "penjualan",
            'posisi' => "penjualan",
            'content' => "admin/penjualan/index-penjualan",
            'param'=> array(
                'penjualans' => $this->Penjualan_model->getDtPenjualan($kdbengkel->idbengkelkasir),
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
    public function list()
    {
        $role = $this->session->userdata('role');
        $outlet = $this->session->userdata('outlet_id');
        $content['notif'] = $this->Notifikasi_model->getData($role,$outlet);

        $data = array_merge($content, $this->getDataList());
        $this->load->view('admin/templates/layout', $data);
        // $this->load->view('admin/templates/layout', $this->getDataList());

    }

    
    public function detail($id)
    {
        $kdbengkel = $this->Penjualan_model->getIdBengkel($this->session->userdata('outlet_id'));
   
        $data['data'] = $this->Constant_model->getDataOneColumnRowArray('penjualan','id_bengkel',$kdbengkel->idbengkelkasir);
        $data['array'] = $this->Constant_model->getDataOneJoinWhere('penjualan_detail','id_p','produk','id_p','penjualan_detail.id_penjualan',$id, 'penjualan_detail.id_penjualan', 'desc');

        $this->load->view('admin/penjualan/detail-penjualan', $data);
    }




    private function getDataLaporan(){
        $data = array(
            'title' => "Penjualan",
            // 'breadcumb' => "",
            'menu' => "lap-penjualan",
            'posisi' => "laporan",
            'content' => "admin/laporan/lap-penjualan",
            'param'=> array(
                // 'pelanggans' => $this->Constant_model->Penjualan_model(),
                // 'siswas'=>$this->Siswa_model->getAllAccount_byWk(),
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
                8 => 'assets/global/vendor/bootstrap-datepicker/bootstrap-datepicker', //font
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
                21 => 'assets/global/vendor/bootstrap-datepicker/bootstrap-datepicker', //mask
                22 => 'assets/global/js/Plugin/bootstrap-datepicker' //mask
            )
        );
        return $data;
    }

    // List all your items
    public function laporan()
    {
        $role = $this->session->userdata('role');
        $outlet = $this->session->userdata('outlet_id');
        $content['notif'] = $this->Notifikasi_model->getData($role,$outlet);

        $data = array_merge($content, $this->getDataLaporan());
        $this->load->view('admin/templates/layout', $data);
        // $this->load->view('admin/templates/layout', $this->getDataLaporan());
    }
}

/* End of file Penjualan.php */
/* Location: ./application/controllers/Penjualan.php */
