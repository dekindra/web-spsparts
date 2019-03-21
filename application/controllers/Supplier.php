<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Supplier extends CI_Controller {

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
        $data = array(
            'title' => "Data Supplier",
            // 'breadcumb' => "",
            'menu' => "supplier",
            'posisi' => "mitra",
            'content' => "admin/supplier/index-supplier",
            'param'=> array(
                'suppliers' => $this->Constant_model->getDataAll('supplier','name','asc'),
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
                20 => 'assets/global/js/Plugin/formatter' //mask
            )
        );
        return $data;
    }

    private function getDaftar(){
        $data = array(
            'title' => "Daftar Supplier",
            // 'breadcumb' => "",
            'content' => "admin/supplier/daftar-supplier",
            'param'=> array(
                // 'absensis' => $this->Absensi_model->getAllAccount(),
                // 'siswas'=>$this->Siswa_model->getAllAccount_byWk(),
            ),
            'css' => array(
                1 => 'assets/base/assets/examples/css/pages/login-v3', //
                2 => 'assets/global/vendor/jquery-wizard/jquery-wizard', //wizard
                3 => 'assets/global/vendor/formvalidation/formValidation', //formvalidation ..
            ),
            // 'jscss' => array(
            //     1 => 'asset/bower_components/jquery/dist/jquery.min',
            //     // 2 => 'asset/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min',
            // ),
            'js' =>array(
                1 => 'assets/global/vendor/jquery-placeholder/jquery.placeholder',//placeholder
                2 => 'assets/global/vendor/formvalidation/formValidation',//validation
                3 => 'assets/global/vendor/formvalidation/framework/bootstrap',
                4 => 'assets/global/vendor/matchheight/jquery.matchHeight-min',
                5 => 'assets/global/vendor/jquery-wizard/jquery-wizard', //wizard
                6 => 'assets/global/js/Plugin/jquery-placeholder',
                7 => 'assets/global/js/Plugin/jquery-wizard',
                8 => 'assets/global/js/Plugin/matchheight',
                9 => 'assets/base/assets/examples/js/forms/wizard',
                10 => 'assets/global/js/Plugin/material'
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

	// Add a new item
	public function add()
	{
		$this->load->view('admin/templates/layout-daftar', $this->getDaftar());

	}


    // ****************************** Action To Database -- START ****************************** //
    public function ajax_edit($id)
    {
        $data = $this->Constant_model->getDataOneColumn('supplier','id_supplier', $id);
        // $data->tgl_lahir = ($data->tgl_lahir == '0000-00-00') ? '' : $data->tgl_lahir; // if 0000-00-00 set tu empty for datepicker compatibility
        echo json_encode($data);
    }

 
    public function update()
    {   
        $id = $this->input->post('id');
        $status = $this->input->post('status');
        $tm = date('Y-m-d H:i:s', time());

        // $this->_validate();
            $data = array(
                'name' => $this->input->post('nama'),
                'address' => $this->input->post('alamat'),
                'tel' => $this->input->post('telepon'),
                'pj' => $this->input->post('pj'),
                'telpj' => $this->input->post('telpj'),
                'email' => $this->input->post('email'),
                'updated_datetime' => date('Y-m-d H:i:s', time()),
                'status' => $status,
            );
 
        if($this->input->post('remove_photo')) // if remove photo checked
        {
            if(file_exists('assets/images/supplier/'.$this->input->post('remove_photo')) && $this->input->post('remove_photo'))
                unlink('assets/images/supplier/'.$this->input->post('remove_photo'));
            $data['file'] = '';
        }
 
        if(!empty($_FILES['file']['name']))
        {
            $upload = $this->_do_upload();
             
            //delete file
            $supplier = $this->Constant_model->getDataOneColumn('supplier','id_supplier', $id);
            if(file_exists('assets/images/supplier/'.$supplier->file) && $supplier->file)
                unlink('assets/images/supplier/'.$supplier->file);
 
            $data['file'] = $upload;
        }
 
        if($this->Constant_model->updateDataDinamis('supplier', $data, 'id_supplier', $id)){
            if($status == 1){
                $emailtemp=$this->load->view('admin/notif/konfir_emailsupplier.php',$data,TRUE);

                $this->load->library('email');
                $this->email->from($this->settingData->email_broadcast, 'Sps Parts');
                $this->email->to($data['email']);
                $this->email->subject('Pendaftaran Supplier');
                $this->email->message($emailtemp);
              
                // $this->email->send();

                if (!$this->email->send()) {  
                    echo $this->email->print_debugger();   
                }

                $this->session->set_flashdata('alert_msg', array('success', 'Update Supplier', 'Berhasil mengupdate Supplier '.$this->input->post('nama')));

            }else{
                $this->session->set_flashdata('alert_msg', array('success', 'Update Supplier', 'Berhasil mengupdate Supplier '.$this->input->post('nama')));  
            }
        }

        echo json_encode(array("status" => TRUE));
    }
    
    //Delete one item
    public function delete($id)
    {
        //delete file
        $supplier = $this->Constant_model->getDataOneColumn('supplier','id_supplier', $id);

        if(file_exists('assets/images/supplier/'.$supplier->file) && $supplier->file)
            unlink('assets/images/supplier/'.$supplier->file);

        $this->Constant_model->deleteDataDinamis('supplier','id_supplier', $id);
        $this->session->set_flashdata('alert_msg', array('success', 'Delete Supplier', 'Berhasil menghapus supplier '.$supplier->name));

        echo json_encode(array("status" => TRUE));
    }


    // Insert New Supplier;
    public function insert()
    {
        $nama = $this->input->post('nama');
        $email = $this->input->post('email');

        $tm = date('Y-m-d H:i:s', time());

        if (empty($nama)) {
            $this->session->set_flashdata('alert_msg', array('failure', 'Tambah Supplier', 'masukkan nama supplier!'));
            redirect(base_url().'supplier/add');
        } else {
            if (!empty($email)) {
                $ckEmailData = $this->Constant_model->getDataOneColumnResult('supplier', 'email', $email);

                if (count($ckEmailData) > 0) {
                    $this->session->set_flashdata('alert_msg', array('failure', 'Tambah supplier', "E-mail $email telah terdaftar di sistem! Tolong gunakan E-mail yang lain!"));
                    redirect(base_url().'supplier/add');
                    die();
                }
            }

            $data = array(
                      'name' => $nama,
                      'address' => $this->input->post('alamat'),
                      'tel' => $this->input->post('telepon'),
                      'pj' => $this->input->post('pj'),
                      'telpj' => $this->input->post('telpj'),
                      'email' => $this->input->post('email'),
                      'created_datetime' => date('Y-m-d H:i:s', time()),
                      'updated_datetime' => date('Y-m-d H:i:s', time()),
                      'status' => '0',
            );

            if(!empty($_FILES['file']['name']))
            {
                $upload = $this->_do_upload();
                $data['file'] = $upload;
            }

            if ($this->Constant_model->insertData('supplier', $data)) {
                $dtnotif = array(
                    'keterangan'        => 'Pendaftaran partnership Supplier '.$data['name'].' telah diterima',
                    'created_datetime'  => $tm,
                    'status'            => '0',
                    'role'              => '1',
                    'info'              => 'daftar'
                );

                $this->Constant_model->insertData('notifikasi', $dtnotif);

                $emailtemp=$this->load->view('admin/notif/temp_emailsupplier.php',$data,TRUE);

                $this->load->library('email');
                $this->email->from($this->settingData->email, 'Sps Parts');
                $this->email->to($data['email']);
                $this->email->subject('Pendaftaran Supplier');
                $this->email->message($emailtemp);
              
                // $this->email->send();

                if (!$this->email->send()) {  
                    echo $this->email->print_debugger();   
                }

                $emailtemplate=$this->load->view('admin/notif/notif_pendaftaransupplier.php',$data,TRUE);

                $this->load->library('email');
                $this->email->from($this->settingData->email_broadcast, 'Sps Parts');
                $this->email->to($this->settingData->email_broadcast);
                $this->email->subject('Pendaftaran Supplier');
                $this->email->message($emailtemplate);
              
                // $this->email->send();

                if (!$this->email->send()) {  
                    echo $this->email->print_debugger();   
                }

                $this->session->set_flashdata('alert_msg', array('success', 'Tambah Supplier', "Berhasil menambahkan supplier $nama"));
                redirect(base_url().'user/login');
            }
        }
    }

   
    // ****************************** Action To Database -- END ****************************** //

private function _do_upload()
    {
        $config['upload_path']          = 'assets/images/supplier';
        $config['allowed_types']        = 'gif|jpg|png|pdf';
        $config['max_size']             = 100; //set max size allowed in Kilobyte
        $config['max_width']            = 1000; // set max width image allowed
        $config['max_height']           = 1000; // set max height allowed
        $config['file_name']            = round(microtime(true) * 1000); //just milisecond timestamp fot unique name
 
        $this->load->library('upload', $config);
 
        if(!$this->upload->do_upload('file')) //upload and validate
        {
            $data['inputerror'][] = 'file';
            $data['error_string'][] = 'Upload error: '.$this->upload->display_errors('',''); //show ajax error
            $data['status'] = FALSE;
            echo json_encode($data);
            exit();
        }

        return $this->upload->data('file_name');
    }

}

/* End of file supplier.php */
/* Location: ./application/controllers/supplier.php */
