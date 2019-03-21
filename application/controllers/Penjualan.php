<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penjualan extends CI_Controller {

    private $settingData;

	public function __construct()
	{
		parent::__construct();
		//Load Dependencies
        $this->load->model('Constant_model');
        $this->load->model('Notifikasi_model');
        $this->load->model('Penjualan_model');

        $this->load->model('Setting_model');

        $this->settingData = $this->Setting_model->getSetting();
        $setting_timezone = $this->settingData->timezone;  

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

        $param = array(
            'pelanggans' => $this->Constant_model->getDataOneColumnResult('pelanggan', 'id_bengkel', $kdbengkel->idbengkelkasir),
            'todaysale' => $this->Penjualan_model->getTdSale($this->session->userdata('outlet_id')),
            'transaksi' => $this->Penjualan_model->getTransaksi($this->session->userdata('outlet_id')),
        );

        $adata = array_merge($param, $data);
        
        $this->load->view('admin/penjualan/pos', $adata);
	}


    // public function add()
    // {
    //     $bayar = $_POST['bayar'];
    //     $pelanggan = $_POST['pelanggan'];
         
    //     // validasi seadanya :v
    //     if ($bayar == '') {
    //         $data['error']['bayar'] = 'Bayar tidak boleh kosong';
    //     }

    //     if ($pelanggan == '') {
    //         $data['error']['pelanggan'] = 'Pelanggan tidak boleh kosong';
    //     }

    //     // var_dump($data['error']);
    //     // die();
         
    //     if (empty($data['error'])) {
    //         // jika validasi berhasil 
    //         // lakukan proses simpan data disini atau perintah lainnya
    //         // INSERT INTO bla bla bla...

    //         $tm = date('Y-m-d H:i:s', time());

    //         $kdbengkel = $this->Penjualan_model->getIdBengkel($this->session->userdata('outlet_id'));

    //         $dataa = array(
    //         // 'id_supplier'       => '0',
    //             'id_bengkel'        => $kdbengkel->idbengkelkasir,
    //             'id_pelanggan'      => $this->input->post('pelanggan'),
    //             'total'             => $this->input->post('total_pembelian'),
    //             'bayar'             => $this->input->post('bayar'),
    //             'kembali'           => $this->input->post('kembaliannya'),
    //             'catatan'           => $this->input->post('catatan'),
    //             'created_user_id'   => $this->session->userdata('outlet_id'),
    //             'created_datetime'  => $tm,
    //         );


    //         $create = $this->Constant_model->insertDataReturnLastId('penjualan', $dataa);
        
    //         foreach ($_POST['order'] as $id => $detail){
    //             if($detail['id_produk']!=''){
    //                 $upddata = array(
    //                     'id_penjualan'  => $create,
    //                     'id_p'      => $detail['id_produk'],
    //                     'qty'       => $detail['quantity'],
    //                     'subtotal'  => $detail['sub_total']
    //                 );

    //                 $cekstockbrng = $this->Constant_model->getDataTwoColumnRow('inventory', 'id_p', $detail['id_produk'] , 'id_bengkel', $kdbengkel->idbengkelkasir);

    //                 $dtinven = array(
    //                     'stock'     => $cekstockbrng->stock - $upddata['qty'],
    //                 );

    //                 $this->Constant_model->updateDataDinamisTwoWhere('inventory',$dtinven, 'id_p', $detail['id_produk'] , 'id_bengkel', $kdbengkel->idbengkelkasir);
    //                 $this->Constant_model->insertData('penjualan_detail', $upddata);
    //             }
    //         }

    //         // email
    //         // $this->kirimemail();
    //         $ckEmailPelanggan = $this->Constant_model->getDataOneColumn('pelanggan', 'id', $pelanggan);

    //         $dtemail = array(
    //             'ckbengkel' => $this->Constant_model->getDataOneJoinOneWhereRowArray('penjualan','id_bengkel','bengkel','id_bengkel','penjualan.id_penjualan', $create, 'penjualan.id_penjualan', 'desc'),
    //             'array' => $this->Constant_model->getDataOneJoinWhere('penjualan_detail','id_p','produk','id_p','penjualan_detail.id_penjualan', $create, 'penjualan_detail.id_penjualan', 'desc'),
    //         );


    //         $emailtemp = $this->load->view('admin/penjualan/laporan-penjualan.php',$dtemail, TRUE);

    //         $this->load->library('email');
    //         $this->email->from($this->settingData->email_broadcast, 'Sps Parts');
    //         $this->email->to($ckEmailPelanggan->email);
    //         $this->email->subject('Nota Pembelian');
    //         $this->email->message($emailtemp);
          
    //         // $this->email->send();

    //         if (!$this->email->send()) {  
    //             echo $this->email->print_debugger();   
    //         }


    //         $this->session->set_flashdata('alert_msg', array('success', 'Tambah Penjualan', 'Berhasil Menambah Penjualan'));

    //         $data['hasil'] = 'sukses';

    //     } else {
    //         // jika validasi gagal
    //         $data['hasil'] = 'gagal';
    //     }

    //     echo json_encode($data);
       
        
    //     // echo json_encode(array("status" => TRUE));

    // }

    // public function kirimemail(){
    //      $dtemail = array(
    //             'ckbengkel' => $this->Constant_model->getDataOneJoinOneWhereRowArray('penjualan','id_bengkel','bengkel','id_bengkel','penjualan.id_penjualan', 8, 'penjualan.id_penjualan', 'desc'),
    //             'array' => $this->Constant_model->getDataOneJoinWhere('penjualan_detail','id_p','produk','id_p','penjualan_detail.id_penjualan', 8, 'penjualan_detail.id_penjualan', 'desc'),
    //         );
         

    //         $emailtemp = $this->load->view('admin/penjualan/laporan-penjualan.php',$dtemail, TRUE);

    //         $this->load->library('email');
    //         $this->email->from($this->settingData->email_broadcast, 'Sps Parts');
    //         $this->email->to('mandra1899@gmail.com');
    //         $this->email->subject('jajal');
    //         $this->email->message($emailtemp);
          
    //         // $this->email->send();

    //         if (!$this->email->send()) {  
    //             echo $this->email->print_debugger();   
    //         }

    // }

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


    public function addPenjualan()
    {
        $bayar = $_POST['bayar'];
        $diskon = $_POST['iddiskon'];
        $pelanggan = $_POST['pelanggan'];
        $tm = date('Y-m-d');
         
        // validasi seadanya :v
        if ($bayar == '') {
            $data['error']['bayar'] = 'Bayar tidak boleh kosong';
        }

        $cekdiskon = $this->Constant_model->getDataOneColumn('promo', 'id', $diskon);


        if ($diskon) {
            if ($cekdiskon->sisa_penggunaan != 0) {
                if (date('Y-m-d', strtotime($cekdiskon->expiry_date)) < $tm) {
                    $data['error']['diskon'] = 'Diskon sudah kadaluarsa';
                } else{
                   if ($this->input->post('total_pembelian') < $cekdiskon->buy_minimal) {
                       $data['error']['diskon'] = 'Total pembelian minimal '.$cekdiskon->buy_minimal; 
                    } 
                }
            }else{
                $data['error']['diskon'] = 'Diskon sudah digunakan';
            }
        }
         
        if (empty($data['error'])) {
            // jika validasi berhasil 
            // lakukan proses simpan data disini atau perintah lainnya
            // INSERT INTO bla bla bla...

            $kdbengkel = $this->Penjualan_model->getIdBengkel($this->session->userdata('outlet_id'));


            if (empty($pelanggan)) {
                // create pelanggan otomatisasi
                $namabarupelanggan = $this->defaultPelanggan($kdbengkel->idbengkelkasir);

                $dataPelanggan = array(
                  'nama' => $namabarupelanggan,
                  'id_bengkel' => $kdbengkel->idbengkelkasir,
                  'created_user_id' => $this->session->userdata('outlet_id'),
                  'created_datetime' => date('Y-m-d H:i:s', time()),
                  'updated_user_id' => '0',
                  'updated_datetime' => date('Y-m-d H:i:s', time()),
                  'status' => '1',
                );

                $pelangganbaru = $this->Constant_model->insertDataReturnLastId('pelanggan', $dataPelanggan);

                // insert penjualan

                $dataa = array(
                // 'id_supplier'       => '0',
                    'id_bengkel'        => $kdbengkel->idbengkelkasir,
                    'id_pelanggan'      => $pelangganbaru,
                    'total'             => $this->input->post('total_pembelian'),
                    'bayar'             => $this->input->post('bayar'),
                    'kembali'           => $this->input->post('kembaliannya'),
                    'untung'           => $this->input->post('total_keuntungan'),
                    'catatan'           => $this->input->post('catatan'),
                    'diskon'            => $this->input->post('nominaldiskon'),
                    'jasa'              => $this->input->post('biayajasa'),
                    'created_user_id'   => $this->session->userdata('outlet_id'),
                    'created_datetime'  => $tm,
                );

                $upddatapromo = array(
                // 'id_supplier'       => '0',
                    'sisa_penggunaan' => $cekdiskon->sisa_penggunaan - 1,
                );


                $create = $this->Constant_model->insertDataReturnLastId('penjualan', $dataa);
                $this->Constant_model->updateData('promo', $upddatapromo, $diskon);
            
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

                // die();

                $this->session->set_flashdata('alert_msg', array('success', 'Tambah Penjualan', 'Berhasil Menambah Penjualan'));

                // $data['hasil'] = 'sukses';

            } else {
                // insert penjaulan
                $dataa = array(
                // 'id_supplier'       => '0',
                    'id_bengkel'        => $kdbengkel->idbengkelkasir,
                    'id_pelanggan'      => $this->input->post('pelanggan'),
                    'total'             => $this->input->post('total_pembelian'),
                    'bayar'             => $this->input->post('bayar'),
                    'kembali'           => $this->input->post('kembaliannya'),
                    'untung'           => $this->input->post('total_keuntungan'),
                    'catatan'           => $this->input->post('catatan'),
                    'diskon'            => $this->input->post('nominaldiskon'),
                    'jasa'              => $this->input->post('biayajasa'),
                    'created_user_id'   => $this->session->userdata('outlet_id'),
                    'created_datetime'  => $tm,
                );

                $upddatapromo = array(
                // 'id_supplier'       => '0',
                    'sisa_penggunaan' => $cekdiskon->sisa_penggunaan - 1,
                );

                $create = $this->Constant_model->insertDataReturnLastId('penjualan', $dataa);
                $this->Constant_model->updateData('promo', $upddatapromo, $diskon);
            
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

                // email
                // $this->kirimemail();
                $ckEmailPelanggan = $this->Constant_model->getDataOneColumn('pelanggan', 'id', $pelanggan);

                $dtemail = array(
                    'ckbengkel' => $this->Constant_model->getDataOneJoinOneWhereRowArray('penjualan','id_bengkel','bengkel','id_bengkel','penjualan.id_penjualan', $create, 'penjualan.id_penjualan', 'desc'),
                    'array' => $this->Constant_model->getDataOneJoinWhere('penjualan_detail','id_p','produk','id_p','penjualan_detail.id_penjualan', $create, 'penjualan_detail.id_penjualan', 'desc'),
                );


                $emailtemp = $this->load->view('admin/penjualan/laporan-penjualan.php',$dtemail, TRUE);

                $this->load->library('email');
                $this->email->from($this->settingData->email_broadcast, 'Sps Parts');
                $this->email->to($ckEmailPelanggan->email);
                $this->email->subject('Nota Pembelian');
                $this->email->message($emailtemp);
              
                // $this->email->send();

                if (!$this->email->send()) {  
                    echo $this->email->print_debugger();   
                }


                $this->session->set_flashdata('alert_msg', array('success', 'Tambah Penjualan', 'Berhasil Menambah Penjualan'));

                $data['hasil'] = 'sukses';
            }
            
        } else {
            // jika validasi gagal
            $data['hasil'] = 'gagal';
        }

        echo json_encode($data);
       
        
        // echo json_encode(array("status" => TRUE));

    }

    public function defaultPelanggan($idbengkel)
    {
        $idterakhir = $this->Penjualan_model->getMaxIdPelanggan($idbengkel);

        $nobaru = (int)$idterakhir->id + 1;

        $namabaru = 'pelanggan'.$nobaru;

        return $namabaru;

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

    public function autocompletediskon(){
        $kdbengkel = $this->Penjualan_model->getIdBengkel($this->session->userdata('outlet_id'));
        // Ambil nama 
        $cari = $_GET['cari'];
        // Cari Nama
        $data = $this->db->from('promo')->like('card_number',$cari)->where('id_bengkel',$kdbengkel->idbengkelkasir)->get();  
        // Inisialisasi Array
        $arrays = array();
        foreach($data->result() as $row)
        {
            $arrays[] = array(
                'id'        => $row->id,
                'card_number'   => $row->card_number,
                'value'   => $row->value,
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
                // 'name'      => $row->name_p,
                'search'    => $row->searchdeskripsi,
                'code'      => $row->code_p,
                'het_bengkel'    => $row->het_bengkel,
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
        $data['data'] = $this->Penjualan_model->getDetailPenjualan($id);
        $data['array'] = $this->Constant_model->getDataOneJoinWhere('penjualan_detail','id_p','produk','id_p','penjualan_detail.id_penjualan',$id, 'penjualan_detail.id_penjualan', 'desc');

        $this->load->view('admin/penjualan/detail-penjualan', $data);
    }

    public function cetak($id)
    {
        $kdbengkel = $this->session->userdata('outlet_id');

        if (empty($id))
        {
            show_404();
        }

        $data['bengkel'] = $this->Constant_model->getDataOneColumnRowArray('bengkel', 'id_bengkel', $kdbengkel);
        $data['data'] = $this->Penjualan_model->getDetailPenjualan($id);
        $data['array'] = $this->Constant_model->getDataOneJoinWhere('penjualan_detail','id_p','produk','id_p','penjualan_detail.id_penjualan',$id, 'penjualan_detail.id_penjualan', 'desc');

        $this->load->view('admin/laporan/print-penjualan.php',$data);
    }


    private function getDataLaporan(){
        $kdbengkel = $this->session->userdata('outlet_id');

        $data = array(
            'title' => "Penjualan",
            // 'breadcumb' => "",
            'menu' => "laporanpenjualan",
            'posisi' => "laporanpenjualan",
            'content' => "admin/penjualan/index-laporanpenjualan",
            'param'=> array(
                'penjualans'        => $this->Penjualan_model->getDtPenjualan($kdbengkel),
                'totalpenjualan'    => $this->Penjualan_model->totalPenjualan($kdbengkel),
                'pelanggans'        => $this->Constant_model->getDataOneColumnResult('pelanggan', 'id_bengkel', $kdbengkel),
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

    public function lapPenjualanBy()
    {
        $start              = date("Y-m-d",strtotime($this->input->post('start')));
        $end                = date("Y-m-d",strtotime($this->input->post('end')));
        $pelanggan           = $this->input->post('pelanggan');

        $data['start']      = $start;
        $data['end']        = $end;
        $data['pelanggan']   = $pelanggan;
        $data['penjualan'] = $this->Penjualan_model->getPenjualan($start,$end,$pelanggan);
        $data['judulpenjualan'] = $this->Penjualan_model->getPenjualanJudul($start,$end,$pelanggan);

        $this->load->view('admin/penjualan/table-tampildata', $data); 
        
    }

    public function cetakLaporan($start, $end, $pelanggan)
    {
        $kdbengkel = $this->session->userdata('outlet_id');

        if (empty($kdbengkel))
        {
            show_404();
        }

        // $start              = date("Y-m-d",strtotime($this->input->post('start')));
        // $end                = date("Y-m-d",strtotime($this->input->post('end')));
        // $pelanggan           = $this->input->post('pelanggan');

        $data['start']      = date("Y-m-d",strtotime($start));
        $data['end']        = date("Y-m-d",strtotime($end));
        $data['pelanggan']   = $pelanggan;
        $data['penjualan'] = $this->Penjualan_model->getPenjualan($data['start'],$data['end'],$pelanggan);
        $data['judulpenjualan'] = $this->Penjualan_model->getPenjualanJudul($data['start'],$data['end'],$pelanggan);
        $data['bengkel'] = $this->Constant_model->getDataOneColumnRowArray('bengkel', 'id_bengkel',$kdbengkel);

        $this->load->view('admin/laporan/print-lappenjualan',$data);
    }
}

/* End of file Penjualan.php */
/* Location: ./application/controllers/Penjualan.php */
