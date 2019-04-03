<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk extends CI_Controller {
    private $filename = "import_data"; // Kita tentukan nama filenya

	public function __construct()
	{
		parent::__construct();
		//Load Dependencies
        $this->load->model('Constant_model');
        $this->load->model('Produk_model');
        $this->load->model('Notifikasi_model');
        $this->load->model('Setting_model');

        $settingData = $this->Setting_model->getSetting();
        $setting_timezone = $settingData->timezone;  

        date_default_timezone_set("$setting_timezone");

	}

	private function getData(){
        $data = array(
            'title' => "Data Produk",
            // 'breadcumb' => "",
            'menu' => "produk",
            'posisi' => "produk",
            'content' => "admin/produk/index-produk",
            'param'=> array(
                'produks' => $this->Constant_model->getDataOneJoin('produk','category','kategori_produk','id_kp','id_p','desc'),
                'kategoris' => $this->Constant_model->getDataAll('kategori_produk','id_kp','desc'),
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
                9 => 'assets/global/vendor/dropify/dropify', //font
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
                21 => 'assets/global/vendor/dropify/dropify.min',
                22 => 'assets/global/js/Plugin/dropify',
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

    public function ajax_edit($id)
    {
        $data = $this->Constant_model->getDataOneColumn('produk','id_p', $id);
        // $data->tgl_lahir = ($data->tgl_lahir == '0000-00-00') ? '' : $data->tgl_lahir; // if 0000-00-00 set tu empty for datepicker compatibility
        echo json_encode($data);
    }

 
    public function update()
    {   
        $nama = $this->input->post('nama');
        $kode = $this->input->post('kode');
        $id = $this->input->post('id');
        $tm = date('Y-m-d H:i:s', time());
        // $this->_validate();
            $data = array(
                    'name_p' => $nama,
                    'merk' => $this->input->post('merk'),
                    'deskripsi' => $this->input->post('deskripsi'),
                    'searchdeskripsi' => $this->input->post('kode').' '.$nama.' '. $this->input->post('merk').' '.$this->input->post('deskripsi').' '.$this->input->post('spec'),
                    'code_p' => $kode,
                    'category' => $this->input->post('kategori'),
                    'isi' => $this->input->post('isi'),
                    'satuan' => $this->input->post('satuan'),
                    'purchase_price' => $this->input->post('beli'),
                    'updated_user_id' => $this->session->userdata('id'),
                    'updated_datetime' => $tm,
                    'status' => '1',
            );
 
        if($this->input->post('remove_photo')) // if remove photo checked
        {
            if(file_exists('assets/images/produk/'.$this->input->post('remove_photo')) && $this->input->post('remove_photo'))
                unlink('assets/images/produk/'.$this->input->post('remove_photo'));
            $data['thumbnail'] = '';
        }
 
        if(!empty($_FILES['thumbnail']['name']))
        {
            $upload = $this->_do_upload();
             
            //delete file
            $produk = $this->Constant_model->getDataOneColumn('produk','id_p', $id);
            if(file_exists('assets/images/produk/'.$produk->thumbnail) && $produk->thumbnail)
                unlink('assets/images/produk/'.$produk->thumbnail);
 
            $data['thumbnail'] = $upload;
        }
 
        $this->Constant_model->updateDataDinamis('produk', $data, 'id_p', $id);

        echo json_encode(array(
            "status" => TRUE,
            "flash_header"  => 'Update Produk',
            "flash_desc"  => 'Berhasil mengupdate produk dengan kode '.$kode,
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
        $produk = $this->Constant_model->getDataOneColumn('produk','id_p', $id);

        if(file_exists('assets/images/produk/'.$produk->thumbnail) && $produk->thumbnail)
            unlink('assets/images/produk/'.$produk->thumbnail);

        $this->Constant_model->deleteDataDinamis('produk','id_p', $id);

        echo json_encode(array(
            "status" => TRUE,
            "flash_header"  => 'Delete Produk',
            "flash_desc"  => 'Berhasil menghapus produk dengan kode '.$produk->name_p,
        ));
    }

    // Insert New Bengkel;
    public function add()
    {
        $nama = $this->input->post('nama');
        $kode = $this->input->post('kode');
        $tm = date('Y-m-d H:i:s', time());

        if (empty($nama)) {
            echo json_encode(array(
                "status" => FALSE,
                "flash_header"  => 'Tambah Produk',
                "flash_desc"  => 'Gagal menambah produk, nama tidak boleh kosong !',
            ));
        } else {
            if (!empty($kode)) {
                $ckEmailData = $this->Constant_model->getDataOneColumnResult('produk', 'code_p', $kode);
                if (count($ckEmailData) > 0) {
                    echo json_encode(array(
                        "status" => FALSE,
                        "flash_header"  => 'Tambah Produk',
                        "flash_desc"  => 'Gagal menambah produk, kode telah digunakan didalam sistem !',
                    ));
                    // redirect(base_url().'produk');
                    die();
                }
            }

            $data = array(
                      'name_p' => $nama,
                      'merk' => $this->input->post('merk'),
                      'deskripsi' => $this->input->post('deskripsi'),
                      'code_p' => $kode,
                      'searchdeskripsi' => $kode.' '.$nama.' '. $this->input->post('merk').' '.$this->input->post('deskripsi').' '.$this->input->post('spec'),
                      'category' => $this->input->post('kategori'),
                      'isi' => $this->input->post('isi'),
                      'satuan' => $this->input->post('satuan'),
                      'purchase_price' => $this->input->post('beli'),
                      'created_user_id' => $this->session->userdata('id'),
                      'created_datetime' => $tm,
                      'updated_user_id' => '0',
                      'updated_datetime' => $tm,
                      'status' => '1',
            );

            if(!empty($_FILES['thumbnail']['name']))
            {
                $upload = $this->_do_upload();
                $data['thumbnail'] = $upload;
            }

            $this->Constant_model->insertData('produk', $data);

           echo json_encode(array(
                "status" => TRUE,
                "flash_header"  => 'Tambah Produk',
                "flash_desc"  => 'Berhasil menambah produk dengan kode '.$kode,
            ));
        }
    }

    private function _do_upload()
    {
        $config['upload_path']          = 'assets/images/produk';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 100; //set max size allowed in Kilobyte
        $config['max_width']            = 1000; // set max width image allowed
        $config['max_height']           = 1000; // set max height allowed
        $config['file_name']            = round(microtime(true) * 1000); //just milisecond timestamp fot unique name
 
        $this->load->library('upload', $config);
 
        if(!$this->upload->do_upload('thumbnail')) //upload and validate
        {
            $data['inputerror'][] = 'thumbnail';
            $data['error_string'][] = 'Upload error: '.$this->upload->display_errors('',''); //show ajax error
            $data['status'] = FALSE;
            echo json_encode($data);
            exit();
        }

        return $this->upload->data('file_name');
    }

    public function autocomplete(){
        // Ambil nama 
        $cari = $_GET['cari'];
        // Cari Nama
        $data = $this->db->from('produk')->like('name_p',$cari)->get();  
        // Inisialisasi Array
        $arrays = array();
        foreach($data->result() as $row)
        {
            $arrays[] = array(
                'id'        => $row->id_p,
                'name'      => $row->name_p,
                'code'      => $row->code_p,
                'diskon'    => $row->diskon,
                'price'     => $row->purchase_price,
            );
        }
        echo json_encode($arrays);
    }

    public function importproduk(){
        $tm = date('Y-m-d H:i:s', time());

        $upload = $this->Produk_model->upload_file($this->filename);

        if($upload['result'] == "success"){ // Jika proses upload sukses
            // Load plugin PHPExcel nya
            include APPPATH.'third_party/PHPExcel/PHPExcel.php';
            
            $excelreader = new PHPExcel_Reader_Excel2007();
            $loadexcel = $excelreader->load('excel/'.$this->filename.'.xlsx'); // Load file yang tadi diupload ke folder excel
            $sheet = $loadexcel->getActiveSheet()->toArray(null, true, true ,true, true, true , true, true, true);
            
            // Masukan variabel $sheet ke dalam array data yang nantinya akan di kirim ke file form.php
            // Variabel $sheet tersebut berisi data-data yang sudah diinput di dalam excel yang sudha di upload sebelumnya
            // $data['sheet'] = $sheet;

            // var_dump($sheet[2]['A']);
            // die();
            
            foreach($sheet as $row => $key){
                // var_dump($row);
                if ($row > 1) {
                    // var_dump($key['A']);
                    $cek = $this->Produk_model->cekdata($key['A']);

                    if ($cek) {
                        $data = array(
                            'name_p'            => $key['B'], // Insert data nama dari kolom B di excel
                            'category'          => $key['C'], // Insert data alamat dari kolom C di excel
                            'deskripsi'         => $key['D'], // Insert data jenis kelamin dari kolom D di excel
                            'purchase_price'    => $key['E'], // Insert data alamat dari kolom E di excel
                            'isi'               => $key['F'], // Insert data alamat dari kolom F di excel
                            'satuan'            => $key['G'], // Insert data alamat dari kolom G di excel
                            'merk'              => $key['I'], // Insert data jenis kelamin dari kolom I di excel
                            'searchdeskripsi'   => $key['A'].' '.$key['B'].' '.$key['I'].' '.$key['D'].' '.$key['H'], // Insert data alamat dari kolom A,B,I,D,H di excel
                            'created_user_id'   => $this->session->userdata('id'),
                            'created_datetime'  => $tm,
                            'updated_user_id'   => '0',
                            'updated_datetime'  => $tm,
                            'status'            => '1',
                        );

                        $this->Produk_model->updateData($key['A'], $data);
                    } else {
                        $data = array(
                            'code_p'            => $key['A'], // Insert data alamat dari kolom A di excel
                            'name_p'            => $key['B'], // Insert data nama dari kolom B di excel
                            'category'          => $key['C'], // Insert data alamat dari kolom C di excel
                            'deskripsi'         => $key['D'], // Insert data jenis kelamin dari kolom D di excel
                            'purchase_price'    => $key['E'], // Insert data alamat dari kolom E di excel
                            'isi'               => $key['F'], // Insert data alamat dari kolom F di excel
                            'satuan'            => $key['G'], // Insert data alamat dari kolom G di excel
                            'merk'              => $key['I'], // Insert data jenis kelamin dari kolom I di excel
                            'searchdeskripsi'   => $key['A'].' '.$key['B'].' '.$key['I'].' '.$key['D'].' '.$key['H'], // Insert data alamat dari kolom A,B,I,D,H di excel
                            'created_user_id'   => $this->session->userdata('id'),
                            'created_datetime'  => $tm,
                            'updated_user_id'   => '0',
                            'updated_datetime'  => $tm,
                            'status'            => '1',
                        );

                        $this->Produk_model->insertData($data);
                    }
                    
                }
            } 

            echo json_encode(array(
                "status"        => TRUE,
                "flash_header"  => 'Tambah Produk',
                "flash_desc"    => 'Berhasil import produk',
            ));

        }else{ // Jika proses upload gagal
            echo json_encode(array(
               "status"         => FALSE,
                "flash_header"  => 'Tambah Produk',
                "flash_desc"    => 'Gagal import produk',
            ));
        }

    }

}

/* End of file Produk.php */
/* Location: ./application/controllers/Produk.php */
