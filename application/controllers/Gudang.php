<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gudang extends CI_Controller {

    private $settingData;

	public function __construct()
	{
		parent::__construct();
		//Load Dependencies

        $this->load->model('Constant_model');
        $this->load->model('Mitra_model');
        $this->load->model('Notifikasi_model');
        $this->load->model('Setting_model');
        $this->settingData = $this->Setting_model->getSetting();
        $setting_timezone = $this->settingData->timezone;  

        date_default_timezone_set("$setting_timezone");
	}

	private function getData(){
        $data = array(
            'title' => "Data Gudang",
            // 'breadcumb' => "",
            'menu' => "gudang",
            'posisi' => "mitra",
            'content' => "admin/gudang/index-gudang",
            'param'=> array(
                'gudangs' => $this->Mitra_model->getGudang(),
                // 'gudangs' => $this->Constant_model->getDataAll('gudang','name','asc'),
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

   
	// List all your items
	public function index()
	{
		$role = $this->session->userdata('role');
        $outlet = $this->session->userdata('outlet_id');
        $content['notif'] = $this->Notifikasi_model->getData($role,$outlet);

        $data = array_merge($content, $this->getData());
        $this->load->view('admin/templates/layout', $data);
	}

     private function getDaftar(){
        $data = array(
            'title' => "Daftar Gudang",
            // 'breadcumb' => "",
            'content' => "admin/gudang/daftar-gudang",
            'param'=> array(
                // 'absensis' => $this->Absensi_model->getAllAccount(),
                // 'siswas'=>$this->Siswa_model->getAllAccount_byWk(),
            ),
            'css' => array(
                1 => 'assets/base/assets/examples/css/pages/login-v3', //
                2 => 'assets/global/vendor/jquery-wizard/jquery-wizard', //wizard
                3 => 'assets/global/vendor/formvalidation/formValidation', //formvalidation ..
                4 => 'assets/global/vendor/blueimp-file-upload/jquery.fileupload', //formvalidation ..
                5 => 'assets/global/vendor/dropify/dropify', //formvalidation ..
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
                10 => 'assets/global/js/Plugin/material',
                11 => 'assets/global/vendor/jquery-ui/jquery-ui',
                12 => 'assets/global/vendor/blueimp-tmpl/tmpl',
                13 => 'assets/global/vendor/blueimp-canvas-to-blob/canvas-to-blob',
                14 => 'assets/global/vendor/blueimp-load-image/load-image.all.min',
                15 => 'assets/global/vendor/blueimp-file-upload/jquery.fileupload',
                16 => 'assets/global/vendor/blueimp-file-upload/jquery.fileupload-process',
                17 => 'assets/global/vendor/blueimp-file-upload/jquery.fileupload-image',
                18 => 'assets/global/vendor/blueimp-file-upload/jquery.fileupload-audio',
                19 => 'assets/global/vendor/blueimp-file-upload/jquery.fileupload-video',
                20 => 'assets/global/vendor/blueimp-file-upload/jquery.fileupload-validate',
                21 => 'assets/global/vendor/blueimp-file-upload/jquery.fileupload-ui',
                22 => 'assets/global/vendor/dropify/dropify.min',
                23 => 'assets/global/js/Plugin/dropify',
                24 => 'assets/base/assets/examples/js/forms/uploads'
            )
        );
        return $data;
    }


	// Add a new item
	public function add()
	{
		$this->load->view('admin/templates/layout-daftar', $this->getDaftar());

	}


     // ****************************** Action To Database -- START ****************************** //
     public function ajax_edit($id)
    {
        $data = $this->Constant_model->getDataOneColumn('gudang','id_gudang', $id);
        // $data->tgl_lahir = ($data->tgl_lahir == '0000-00-00') ? '' : $data->tgl_lahir; // if 0000-00-00 set tu empty for datepicker compatibility
        echo json_encode($data);
    }

    public function update()
    {
        // $this->_validate();
        $id = $this->input->post('id');
        $nama = $this->input->post('nama');
        $status = $this->input->post('status');
        $tm = date('Y-m-d H:i:s', time());
        $data = array(
                      'name' => $nama,
                      'instansi' => $this->input->post('instansi'),
                      'address' => $this->input->post('alamat'),
                      'area' => $this->input->post('area'),
                      'tel' => $this->input->post('telepon'),
                      'pj' => $this->input->post('pj'),
                      'telpj' => $this->input->post('telpj'),
                      'email' => $this->input->post('email'),
                      'password' => $this->input->post('password'),
                      'updated_datetime' => $tm,
                      'status' => $status,
                      'limit_order' => $this->input->post('limit'),
            );

        $udata = array(
                'name' => $this->input->post('pj'),
                'email' => $this->input->post('email'),
                'password' => $this->input->post('password'),
                'role_id' => '2',
                'type' => 'gudang',
                'id_gudang' => $id,
                'created_user_id' => $this->session->userdata('id'),
                'created_datetime' => $tm,
                'updated_user_id' => $this->session->userdata('id'),
                'updated_datetime' => $tm,
                'status' => $status,
            );
 
        if($this->input->post('remove_photo')) // if remove photo checked
        {
            if(file_exists('assets/images/gudang/'.$this->input->post('remove_photo')) && $this->input->post('remove_photo'))
                unlink('assets/images/gudang/'.$this->input->post('remove_photo'));
            $data['ktp'] = '';
        }
 
        if(!empty($_FILES['ktp']['name']))
        {
            $upload = $this->_do_uploadktp();
             
            //delete file
            $gudang = $this->Constant_model->getDataOneColumn('gudang','id_gudang', $id);
            if(file_exists('assets/images/gudang/'.$gudang->ktp) && $gudang->ktp)
                unlink('assets/images/gudang/'.$gudang->ktp);
 
            $data['ktp'] = $upload;
        }

        if($this->input->post('remove_photo1')) // if remove photo checked
        {
            if(file_exists('assets/images/gudang/'.$this->input->post('remove_photo1')) && $this->input->post('remove_photo1'))
                unlink('assets/images/gudang/'.$this->input->post('remove_photo1'));
            $data['wh'] = '';
        }
 
        if(!empty($_FILES['wh']['name']))
        {
            $upload = $this->_do_uploadwh();
             
            //delete file
            $gudang = $this->Constant_model->getDataOneColumn('gudang','id_gudang', $id);
            if(file_exists('assets/images/gudang/'.$gudang->wh) && $gudang->wh)
                unlink('assets/images/gudang/'.$gudang->wh);
 
            $data['wh'] = $upload;
        }

        if ($this->Constant_model->updateDataDinamis('gudang', $data, 'id_gudang', $id)) {
                if ($status == '1') {
                    $ckData = $this->Constant_model->getDataOneColumnResult('users', 'id_gudang', $id);
                    if (count($ckData) > 0) {
                        $this->Constant_model->updateDataDinamis('users', $udata, 'id_gudang', $id);
                        $this->session->set_flashdata('alert_msg', array('success', 'Update Gudang', "Berhasil update Gudang $nama"));
                        // die();
                    }else{
                        $this->Constant_model->insertData('users', $udata);

                        $dtnotif = array(
                            'keterangan'        => 'Selamat bergabung '.$data['name'].' dalam keluarga besar SPS Parts',
                            'created_datetime'  => $tm,
                            'status'            => '0',
                            'role'              => '2',
                            'outlet'              => $id,
                            'info'              => 'konfirmasi'
                        );

                        $this->Constant_model->insertData('notifikasi', $dtnotif);

                        $emailtemp=$this->load->view('konfir_email.php',$data,TRUE);

                        $this->load->library('email');
                        $this->email->from($this->settingData->email_broadcast, 'Sps Parts');
                        $this->email->to($data['email']);
                        $this->email->subject('Pendaftaran Gudang');
                        $this->email->message($emailtemp);
                      
                        // $this->email->send();

                        if (!$this->email->send()) {  
                            echo $this->email->print_debugger();   
                        }

                        $this->session->set_flashdata('alert_msg', array('success', 'Update Gudang', "Berhasil update Gudang $nama")); 
                    }
                }else{
                    $ckData = $this->Constant_model->getDataOneColumnResult('users', 'id_gudang', $id);
                    if (count($ckData) > 0) {
                        $this->Constant_model->updateDataDinamis('users', $udata, 'id_gudang', $id);
                        $this->session->set_flashdata('alert_msg', array('success', 'Update Gudang', "Berhasil update Gudang $nama"));
                        // die();
                    }else{
                       $this->session->set_flashdata('alert_msg', array('success', 'Update Gudang', "Berhasil update Gudang $nama")); 
                    }
                }
            }
 
        // $this->berita->update(array('id_berita' => $this->input->post('id_berita')), $data);
        echo json_encode(array("status" => TRUE));
    }


     public function delete($id)
    {
        //delete file
        $gudang = $this->Constant_model->getDataOneColumn('gudang','id_gudang', $id);

        if(file_exists('assets/images/gudang/'.$gudang->ktp) && $gudang->ktp)
            unlink('assets/images/gudang/'.$gudang->ktp);
        if(file_exists('assets/images/gudang/'.$gudang->wh) && $gudang->wh) 
            unlink('assets/images/gudang/'.$gudang->wh);

        $this->Constant_model->deleteDataDinamis('gudang', 'id_gudang', $id);
        $this->Constant_model->deleteDataDinamis('users', 'id_gudang', $id);

        $this->session->set_flashdata('alert_msg', array('success', 'Delete Gudang', 'Berhasil menghapus gudang '.$gudang->name));

        echo json_encode(array("status" => TRUE));
    }

    public function sendemail(){
        $this->load->library('email');

        $this->email->from('mandra1899@gmail.com', 'Your Name');
        $this->email->to('indrapman86@gmail.com');
        $this->email->cc('another@another-example.com');
        $this->email->bcc('them@their-example.com');
        $this->email->subject('Email Test');
        $this->email->message('Testing the email class.');
        $this->email->send();

        echo $this->email->print_debugger();
    }


    // Insert New Gudang;
    public function insert()
    {
        $nama = $this->input->post('nama');
        $email = $this->input->post('email');

        $tm = date('Y-m-d H:i:s', time());

        if (empty($nama)) {
            $this->session->set_flashdata('alert_msg', array('failure', 'Tambah Gudang', 'masukkan nama gudang!'));
            redirect(base_url().'gudang/add');
        } else {
            if (!empty($email)) {
                $ckEmailData = $this->Constant_model->getDataOneColumnResult('gudang', 'email', $email);

                if (count($ckEmailData) > 0) {
                    $this->session->set_flashdata('alert_msg', array('failure', 'Tambah Gudang', "E-mail $email telah terdaftar di sistem! Tolong gunakan E-mail yang lain!"));
                    redirect(base_url().'gudang/add');
                    die();
                }
            }

            $limit = $this->Setting_model->getSetting();

            $data = array(
                      'name' => $nama,
                      'instansi' => $this->input->post('instansi'),
                      'address' => $this->input->post('alamat'),
                      'area' => $this->input->post('area'),
                      'tel' => $this->input->post('telepon'),
                      'pj' => $this->input->post('pj'),
                      'telpj' => $this->input->post('telpj'),
                      'email' => $this->input->post('email'),
                      'password' => $this->input->post('password'),
                      'created_datetime' => date('Y-m-d H:i:s', time()),
                      'updated_datetime' => date('Y-m-d H:i:s', time()),
                      'status' => '0',
                      'limit_order' => $limit->default_limit,
            );


            if(!empty($_FILES['ktp']['name']))
            {
                $upload = $this->_do_uploadktp();
                $data['ktp'] = $upload;
            }

            if(!empty($_FILES['wh']['name']))
            {
                $upload = $this->_do_uploadwh();
                $data['wh'] = $upload;
            }

            if ($this->Constant_model->insertData('gudang', $data)) {

                $dtnotif = array(
                    'keterangan'        => 'Pendaftaran partnership Gudang '.$data['name'].' telah diterima',
                    'created_datetime'  => $tm,
                    'status'            => '0',
                    'role'              => '1',
                    'info'              => 'daftar'
                );

                $this->Constant_model->insertData('notifikasi', $dtnotif);

                $emailtemp = $this->load->view('admin/notif/temp_email.php',$data,TRUE);

                $this->load->library('email');
                $this->email->from($this->settingData->email_broadcast, 'Sps Parts');
                $this->email->to($data['email']);
                $this->email->subject('Pendaftaran Gudang');
                $this->email->message($emailtemp);
              
                // $this->email->send();

                if (!$this->email->send()) {  
                    echo $this->email->print_debugger();   
                }

                $emailtemplate=$this->load->view('admin/notif/notif_pendaftaran.php',$data,TRUE);

                $this->load->library('email');
                $this->email->from($this->settingData->email_broadcast, 'Sps Parts');
                $this->email->to($this->settingData->email_broadcast);
                $this->email->subject('Pendaftaran Gudang');
                $this->email->message($emailtemplate);
              
                // $this->email->send();

                if (!$this->email->send()) {  
                    echo $this->email->print_debugger();   
                }

                $this->session->set_flashdata('alert_msg', array('success', 'Tambah Gudang', "Berhasil menambahkan gudang $nama"));
                redirect(base_url().'user/login');
            }
        }
    }

   
    // ****************************** Action To Database -- END ****************************** //

private function _do_uploadktp()
    {
        $config['upload_path']          = 'assets/images/gudang';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 100; //set max size allowed in Kilobyte
        $config['max_width']            = 1000; // set max width image allowed
        $config['max_height']           = 1000; // set max height allowed
        $config['file_name']            = round(microtime(true) * 1000); //just milisecond timestamp fot unique name
 
        $this->load->library('upload', $config);
 
        if(!$this->upload->do_upload('ktp')) //upload and validate
        {
            $data['inputerror'][] = 'ktp';
            $data['error_string'][] = 'Upload error: '.$this->upload->display_errors('',''); //show ajax error
            $data['status'] = FALSE;
            echo json_encode($data);
            exit();
        }

        return $this->upload->data('file_name');
    }

    private function _do_uploadwh()
    {
        $config['upload_path']          = 'assets/images/gudang';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 100; //set max size allowed in Kilobyte
        $config['max_width']            = 1000; // set max width image allowed
        $config['max_height']           = 1000; // set max height allowed
        $config['file_name']            = round(microtime(true) * 1000); //just milisecond timestamp fot unique name
 
        $this->load->library('upload', $config);
 

        if(!$this->upload->do_upload('wh')) //upload and validate
        {
            $data['inputerror'][] = 'wh';
            $data['error_string'][] = 'Upload error: '.$this->upload->display_errors('',''); //show ajax error
            $data['status'] = FALSE;
            echo json_encode($data);
            exit();
        }
        return $this->upload->data('file_name');
    }

}

/* End of file gudang.php */
/* Location: ./application/controllers/gudang.php */
