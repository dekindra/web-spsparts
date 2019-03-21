<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kasir extends CI_Controller {

    private $settingData;

    public function __construct()
    {
        parent::__construct();
        //Load Dependencies
        $this->load->model('Constant_model');
        $this->load->model('Notifikasi_model');
        $this->load->model('Setting_model');

        $this->settingData = $this->Setting_model->getSetting();
        $setting_timezone = $this->settingData->timezone;  

        date_default_timezone_set("$setting_timezone");

    }


     private function getData(){
        $outlet_id = $this->session->userdata('outlet_id');

        $data = array(
            'title' => "Data Kasir",
            // 'breadcumb' => "",
            'menu' => "kasir",
            'posisi' => "kasir",
            'content' => "admin/kasir/index-kasir",
            'param'=> array(
                'penggunas' => $this->Constant_model->getDataOneJoinWhere('kasir','id_kasir','users','id_kasir', 'kasir.id_bengkel' , "$outlet_id",'kasir.id_kasir','desc'),
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
                9 => 'assets/global/vendor/jquery-strength/jquery-strength', //password
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
                21 => 'assets/global/vendor/jquery-strength/password_strength', //password
                22 => 'assets/global/vendor/jquery-strength/jquery-strength.min', //
                23 => 'assets/global/js/Plugin/jquery-strength'//
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
        $data = $this->Constant_model->getDataOneColumn('kasir','id_kasir', $id);
        // $data->tgl_lahir = ($data->tgl_lahir == '0000-00-00') ? '' : $data->tgl_lahir; // if 0000-00-00 set tu empty for datepicker compatibility
        echo json_encode($data);
    }

 
    public function update()
    {
        // $this->_validate();
        $id = $this->input->post('id');
        
        $data = array(
                      'name' => $this->input->post('nama'),
                      'email' => $this->input->post('email'),
                      'password' => $this->input->post('password'),
                      'role_id' => $this->input->post('role'),
                      'updated_user_id' => $this->session->userdata('id'),
                      'updated_datetime' => date('Y-m-d H:i:s', time()),
                      'status' => $this->input->post('status'),
            );
  
        $this->Constant_model->updateDataDinamis('kasir', $data, 'id_kasir', $id);
        $this->Constant_model->updateDataDinamis('users', $data, 'id_kasir', $id);
        $this->session->set_flashdata('alert_msg', array('success', 'Update Kasir', 'Berhasil mengupdate Kasir '.$this->input->post('nama')));

        echo json_encode(array("status" => TRUE));
    }

     public function delete($id)
    {
        //delete file
        $pengguna = $this->Constant_model->getDataOneColumn('kasir','id_kasir', $id);

        $this->Constant_model->deleteDataDinamis('kasir', 'id_kasir', $id);
        $this->Constant_model->deleteDataDinamis('users', 'id_kasir', $id);
        $this->session->set_flashdata('alert_msg', array('success', 'Delete Kasir', 'Berhasil menghapus Kasir '.$pengguna->name));

        echo json_encode(array("status" => TRUE));
    }

    // Insert New Bengkel;
    public function add()
    {
        $nama = $this->input->post('nama');
        $email = $this->input->post('email');
        $tm = date('Y-m-d H:i:s', time());

        if (empty($nama)) {
            $this->session->set_flashdata('alert_msg', array('failure', 'Tambah Kasir', 'masukkan Nama Kasir!'));
            // redirect(base_url().'kategoriproduk');
        } else {
            if (!empty($email)) {
                $ckEmailData = $this->Constant_model->getDataOneColumnResult('users', 'email', $email);

                if (count($ckEmailData) > 0) {
                    $this->session->set_flashdata('alert_msg', array('failure', 'Tambah Kasir', "E-mail $email telah terdaftar di sistem! Tolong gunakan E-mail yang lain!"));
                    // redirect(base_url().'bengkel/add');
                    die();
                }
            }

            $data = array(
                      'name' => $nama,
                      'email' => $this->input->post('email'),
                      'password' => $this->input->post('password'),
                      'id_bengkel' => $this->session->userdata('outlet_id'),
                      'created_user_id' => $this->session->userdata('id'),
                      'created_datetime' => date('Y-m-d H:i:s', time()),
                      'updated_user_id' => '0',
                      'updated_datetime' => date('Y-m-d H:i:s', time()),
                      'status' => $this->input->post('status'),
            );

            $udata = array(
                      'name' => $nama,
                      'email' => $this->input->post('email'),
                      'password' => $this->input->post('password'),
                      'role_id' => '4',
                      'type' => 'kasir',
                      'created_user_id' => $this->session->userdata('id'),
                      'created_datetime' => date('Y-m-d H:i:s', time()),
                      'updated_user_id' => '0',
                      'updated_datetime' => date('Y-m-d H:i:s', time()),
                      'status' => $this->input->post('status'),
            );

            if ($this->Constant_model->insertDataReturnLastId('kasir', $data)) {
                $udata['id_kasir'] = $this->db->insert_id();
                $this->Constant_model->insertData('users', $udata);
                $this->session->set_flashdata('alert_msg', array('success', 'Tambah Kasir', "Berhasil menambahkan Kasir $nama"));
                // redirect(base_url().'kategoriproduk');
            }


            $this->session->set_flashdata('alert_msg', array('success', 'Tambah Kasir', "Berhasil menambahkan Kasir $nama"));

        }

        echo json_encode(array("status" => TRUE));
    }
   

}

/* End of file User.php */
/* Location: ./application/controllers/User.php */
