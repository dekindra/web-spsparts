<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Promo extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		//Load Dependencies
        $this->load->model('Constant_model');
        $this->load->model('Notifikasi_model');
        $this->load->model('Setting_model');

        $settingData = $this->Setting_model->getSetting();
        $setting_timezone = $settingData->timezone;  

        date_default_timezone_set("$setting_timezone");

	}

	private function getData(){
        $id_bengkel = $this->session->userdata('outlet_id');
        $data = array(
            'title' => "Data Promo",
            // 'breadcumb' => "",
            'menu' => "promo",
            'posisi' => "promo",
            'content' => "admin/promo/index-voucher",
            'param'=> array(
                'promos' => $this->Constant_model->getDataOneColumnResult('promo','id_bengkel',"$id_bengkel"),
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
                14 => 'assets/global/vendor/formatter/jquery.formatter', //mask
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

    public function ajax_edit($id)
    {
        $data = $this->Constant_model->getDataOneColumn('promo','id', $id);
        // $data->tgl_lahir = ($data->tgl_lahir == '0000-00-00') ? '' : $data->tgl_lahir; // if 0000-00-00 set tu empty for datepicker compatibility
        echo json_encode($data);
    }

 
    public function update()
    {
        // $this->_validate();
        $id = $this->input->post('id');
        
        $data = array(
            'card_number' => $this->input->post('card_number'),
            'value' => $this->input->post('value'),
            'penggunaan' => $this->input->post('max'),
            'sisa_penggunaan' => $this->input->post('max'),
            'buy_minimal' => $this->input->post('transaksi'),
            'expiry_date' => $this->input->post('date'),
            'updated_user_id' => $this->session->userdata('id'),
            'updated_datetime' => date('Y-m-d H:i:s', time()),
        );
  
        $this->Constant_model->updateData('promo', $data, $id);
        $this->session->set_flashdata('alert_msg', array('success', 'Update Promo', 'Berhasil mengupdate Promo '.$this->input->post('card_number')));

        echo json_encode(array("status" => TRUE));
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
        $promo = $this->Constant_model->getDataOneColumn('promo','id', $id);

        $this->Constant_model->deleteData('promo', $id);
        $this->session->set_flashdata('alert_msg', array('success', 'Delete Promo', 'Berhasil menghapus Promo '.$promo->card_number));

        echo json_encode(array("status" => TRUE));
    }

    // Insert New Bengkel;
    public function add()
    {
        $card_number = $this->input->post('card_number');
        $id_bengkel = $this->session->userdata('outlet_id');
        $tm = date('Y-m-d H:i:s', time());

        if (empty($card_number)) {
            $this->session->set_flashdata('alert_msg', array('failure', 'Tambah Promo', 'masukkan Kode Promo!'));
            // redirect(base_url().'kategoriproduk');
        } else {
            if (!empty($card_number)) {
                $ckEmailData = $this->Constant_model->getDataTwoColumn('promo', 'card_number', "$card_number",'id_bengkel',"$id_bengkel");
                if (count($ckEmailData) > 0) {
                    $this->session->set_flashdata('alert_msg', array('failure', 'Tambah Promo', "Kode $card_number telah terdaftar di sistem! Tolong gunakan Kode yang lain!"));
                    // redirect(base_url().'produk');
                    die();
                }
            }

            $data = array(
                      'card_number' => $card_number,
                      'value' => $this->input->post('value'),
                      'penggunaan' => $this->input->post('max'),
                      'sisa_penggunaan' => $this->input->post('max'),
                      'buy_minimal' => $this->input->post('transaksi'),
                      'expiry_date' => $this->input->post('date'),
                      'id_bengkel' => $id_bengkel,
                      'created_user_id' => $this->session->userdata('id'),
                      'created_datetime' => date('Y-m-d H:i:s', time()),
                      'updated_user_id' => '0',
                      'updated_datetime' => date('Y-m-d H:i:s', time()),
                      'status' => '1',
            );

            if ($this->Constant_model->insertData('promo', $data)) {
                $this->session->set_flashdata('alert_msg', array('success', 'Tambah Promo', "Berhasil menambahkan Promo $card_number"));
                // redirect(base_url().'kategoriproduk');
            }

        }

        echo json_encode(array("status" => TRUE));
    }

    public function cetak($id)
    {
        if (empty($id))
        {
            show_404();
        }

        $data['data'] = $this->Constant_model->getDataOneJoinOneWhereRowArray('promo','id_bengkel','bengkel','id_bengkel','id', $id, 'id', 'desc');

        $this->load->view('admin/promo/print-promo.php',$data);
    }
}

/* End of file Promo.php */
/* Location: ./application/controllers/Promo.php */
