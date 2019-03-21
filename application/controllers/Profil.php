<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profil extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		//Load Dependencies
        $this->load->model('Constant_model');
        $this->load->model('Notifikasi_model');
        $this->load->model('Dashboard_model');
        $this->load->model('Kasir_model');
        $this->load->model('Setting_model');

        $settingData = $this->Setting_model->getSetting();
        $setting_timezone = $settingData->timezone;  

        date_default_timezone_set("$setting_timezone");

	}

	private function getData(){
            $data = array(
                'title' => "Profil",
                // 'breadcumb' => "",
                'menu' => "profil-user",
                'posisi' => "profil",
                'content' => "admin/user/profil-user",
                // 'param'=> array(
                //     'profils' => $this->Constant_model->getDataOneColumn('users','type','admin'),
                //     // 'siswas'=>$this->Siswa_model->getAllAccount_byWk(),
                // ),
                'css' => array(
                    1 => 'assets/base/assets/examples/css/uikit/modals', //modal
                    2 => 'assets/base/assets/examples/css/forms/masks', //mask
                    3 => 'assets/global/fonts/font-awesome/font-awesome', //font
                    4 => 'assets/base/assets/examples/css/pages/profile', //pages
                    5 => 'assets/global/vendor/jquery-strength/jquery-strength', //password
                ),
                // 'jscss' => array(
                //     1 => 'asset/bower_components/jquery/dist/jquery.min',
                //     // 2 => 'asset/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min',
                // ),
                'js' =>array(
                    1 => 'assets/global/vendor/peity/jquery.peity.min',//mengelem tampil
                    2 => 'assets/global/vendor/formatter/jquery.formatter', //mask
                    3 => 'assets/base/assets/examples/js/charts/peity', //men gelem tampil
                    4 => 'assets/global/js/Plugin/jquery-placeholder', //material
                    5 => 'assets/global/js/Plugin/material', //material
                    6 => 'assets/global/js/Plugin/formatter', //mask
                    7 => 'assets/global/js/Plugin/responsive-tabs', //
                    8 => 'assets/global/js/Plugin/tabs', //
                    9 => 'assets/global/vendor/jquery-strength/password_strength', //password
                    10 => 'assets/global/vendor/jquery-strength/jquery-strength.min', //
                    11 => 'assets/global/js/Plugin/jquery-strength'//
                )
            );

        return $data;
       
    }

	// List all your items
	public function index()
	{
        $role = $this->session->userdata('role');
        $id = $this->session->userdata('outlet_id');

        if ($this->session->userdata('type')=='admin') {
            $param = array('profils' => $this->Constant_model->getDataOneColumn('users','type','admin'));
        } elseif ($this->session->userdata('type')=='gudang') {
            $param = array('profils' => $this->Constant_model->getDataOneColumn('gudang','id_gudang',"$id"));
        } elseif ($this->session->userdata('type')=='bengkel') {
            $param = array('profils' => $this->Constant_model->getDataOneColumn('bengkel','id_bengkel',"$id"));
        } else {
            // $param = array('profils' => $this->Constant_model->getDataOneColumn('kasir', 'id_kasir', "$id"));
            $param = array('profils' => $this->Kasir_model->getDataOneJoinWhereRow());
        }

        $param['notif'] = $this->Notifikasi_model->getData($role,$id);
        $data = array_merge($param, $this->getData());
        // var_dump($this->session->userdata('outlet_id'));
        // var_dump($data);
        // die();

		$this->load->view('admin/templates/layout', $data);
	}

    // ****************************** Action To Database -- START ****************************** //
    public function update()
    {   
        $id = $this->input->post('id');
        $tm = date('Y-m-d H:i:s', time());
        $type = $this->session->userdata('type');
        // $this->_validate();
            $data = array(
                    'name' => $this->input->post('nama'),
                    'email' => $this->input->post('email'),
                    'password' => $this->input->post('inputPasswords'),
                    'updated_user_id' => $this->session->userdata('id'),
                    'updated_datetime' => $tm,
            );


            $upddata = array(
                    // 'pj' => $this->input->post('nama'),
                    'email' => $this->input->post('email'),
                    'password' => $this->input->post('inputPasswords'),
            );
 
        if($this->input->post('remove_photo')) // if remove photo checked
        {
            if ($type == 'gudang') {
                if(file_exists('assets/images/gudang/'.$this->input->post('remove_photo') ) && $this->input->post('remove_photo'))
                    unlink('assets/images/gudang/'.$this->input->post('remove_photo'));
                    $upddata['photo'] = '';
            } elseif ($type == 'bengkel') {
                if(file_exists('assets/images/bengkel/'.$this->input->post('remove_photo') ) && $this->input->post('remove_photo'))
                    unlink('assets/images/bengkel/'.$this->input->post('remove_photo'));
                    $upddata['photo'] = '';
            } else {
                if(file_exists('assets/images/kasir/'.$this->input->post('remove_photo') ) && $this->input->post('remove_photo'))
                    unlink('assets/images/kasir/'.$this->input->post('remove_photo'));
                    $upddata['photo'] = '';
            }
            
            // if(file_exists('assets/images/gudang/'.$this->input->post('remove_photo') ) && $this->input->post('remove_photo'))
            //     unlink('assets/images/gudang/'.$this->input->post('remove_photo'));
            // $upddata['photo'] = '';
        }
 
        if(!empty($_FILES['photo']['name']))
        {
            $upload = $this->_do_upload();
             
            //delete file
            if ($type == 'gudang') {
                $profil = $this->Constant_model->getDataOneColumn('gudang','id_gudang', $id);
                if(file_exists('assets/images/gudang/'.$profil->photo) && $profil->photo)
                    unlink('assets/images/gudang/'.$profil->photo);
 
                 $upddata['photo'] = $upload;
            } elseif ($type == 'bengkel') {
                $profil = $this->Constant_model->getDataOneColumn('bengkel','id_bengkel', $id);
                if(file_exists('assets/images/bengkel/'.$profil->photo) && $profil->photo)
                    unlink('assets/images/bengkel/'.$profil->photo);
 
                 $upddata['photo'] = $upload;
            } else {
                $profil = $this->Constant_model->getDataOneColumn('kasir','id_kasir', $id);
                if(file_exists('assets/images/kasir/'.$profil->photo) && $profil->photo)
                    unlink('assets/images/kasir/'.$profil->photo);
 
                 $upddata['photo'] = $upload;
            }
            
            
        }
 
        // $this->Constant_model->updateData('users', $data, $id);

        if ($this->session->userdata('type') == 'admin') {
            $this->Constant_model->updateData('users', $data, $id);
        } elseif ($this->session->userdata('type') == 'gudang') {
            $upddata['pj'] = $this->input->post('nama');
            $this->Constant_model->updateDataDinamis('gudang', $upddata, 'id_gudang', $id);
            $this->Constant_model->updateDataDinamis('users', $data, 'id_gudang', $id);
        } elseif ($this->session->userdata('type') == 'bengkel') {
            $upddata['pj'] = $this->input->post('nama');
            $this->Constant_model->updateDataDinamis('bengkel', $upddata,'id_bengkel', $id);
            $this->Constant_model->updateDataDinamis('users', $data, 'id_bengkel', $id);
        } else {
            $upddata['name'] = $this->input->post('nama');
            $this->Constant_model->updateDataDinamis('kasir', $upddata, 'id_kasir',$id);
            $this->Constant_model->updateDataDinamis('users', $data, 'id_kasir', $id);
        }
        
        // $this->Constant_model->updateData('kasir', $upddata, $id);
        $this->session->set_flashdata('alert_msg', array('success', 'Update Profil', 'Berhasil Profil '.$this->input->post('nama')));

        echo json_encode(array("status" => TRUE));
    }

private function _do_upload()
    {
        $type = $this->session->userdata('type');
        if ($type == 'gudang') {
            $config['upload_path']          = 'assets/images/gudang';
        } elseif ($type == 'bengkel') {
            $config['upload_path']          = 'assets/images/bengkel';
        } else {
            $config['upload_path']          = 'assets/images/kasir';
        }
        
        // $config['upload_path']          = 'assets/images/gudang';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 100; //set max size allowed in Kilobyte
        $config['max_width']            = 1000; // set max width image allowed
        $config['max_height']           = 1000; // set max height allowed
        $config['file_name']            = round(microtime(true) * 1000); //just milisecond timestamp fot unique name
 
        $this->load->library('upload', $config);
 
        if(!$this->upload->do_upload('photo')) //upload and validate
        {
            $data['inputerror'][] = 'photo';
            $data['error_string'][] = 'Upload error: '.$this->upload->display_errors('',''); //show ajax error
            $data['status'] = FALSE;
            echo json_encode($data);
            exit();
        }

        return $this->upload->data('file_name');
    }

    private function getDataUsaha(){
        $data = array(
            'title' => "Profil",
            // 'breadcumb' => "",
            'menu' => "profil-usaha",
            'posisi' => "profil",
            'content' => "admin/user/profil-usaha",
            'param'=> array(
                'gudangs' => $this->Constant_model->getDataAll('gudang','name','asc'),
                // 'siswas'=>$this->Siswa_model->getAllAccount_byWk(),
            ),
            'css' => array(
                1 => 'assets/base/assets/examples/css/uikit/modals', //modal
                2 => 'assets/base/assets/examples/css/forms/masks', //mask
                3 => 'assets/global/fonts/font-awesome/font-awesome', //font
                4 => 'assets/base/assets/examples/css/pages/profile', //pages
                5 => 'assets/global/vendor/jquery-strength/jquery-strength', //password
            ),
            // 'jscss' => array(
            //     1 => 'asset/bower_components/jquery/dist/jquery.min',
            //     // 2 => 'asset/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min',
            // ),
            'js' =>array(
                1 => 'assets/global/vendor/peity/jquery.peity.min',//mengelem tampil
                2 => 'assets/global/vendor/formatter/jquery.formatter', //mask
                3 => 'assets/base/assets/examples/js/charts/peity', //men gelem tampil
                4 => 'assets/global/js/Plugin/jquery-placeholder', //material
                5 => 'assets/global/js/Plugin/material', //material
                6 => 'assets/global/js/Plugin/formatter', //mask
                7 => 'assets/global/js/Plugin/responsive-tabs', //
                8 => 'assets/global/js/Plugin/tabs', //
                9 => 'assets/global/vendor/jquery-strength/password_strength', //password
                10 => 'assets/global/vendor/jquery-strength/jquery-strength.min', //
                11 => 'assets/global/js/Plugin/jquery-strength'//
            )
        );

        return $data;
    }

    // List all your items
    public function usaha()
    {
        $role = $this->session->userdata('role');
        $id = $this->session->userdata('outlet_id');
        if ($this->session->userdata('type')=='gudang') {
            $param = array('profils' => $this->Constant_model->getDataOneColumn('gudang','id_gudang',"$id"));
        } else {
            $param = array(
                'profils' => $this->Constant_model->getDataOneColumn('bengkel','id_bengkel',"$id"),
                'statusgudang' => $this->Dashboard_model->statusGudang($id),
            );
        }
        
        $param['notif'] = $this->Notifikasi_model->getData($role,$id);
        $data = array_merge($param, $this->getDataUsaha());
        // var_dump($this->session->userdata('outlet_id'));
        // var_dump($data);
        // die();

        $this->load->view('admin/templates/layout', $data);
        // $this->load->view('admin/templates/layout', $this->getDataUsaha());
    }

    // ****************************** Action To Database -- START ****************************** //
    public function update_usaha()
    {   
        $id = $this->input->post('id');
        $tm = date('Y-m-d H:i:s', time());
        $type = $this->session->userdata('type');
        // $this->_validate();
            $data = array(
                'name' => $this->input->post('nama'),
                'instansi' => $this->input->post('instansi'),
                'address' => $this->input->post('alamat'),
                'tel' => $this->input->post('telepon'),
                'telpj' => $this->input->post('telpj'),
                'updated_datetime' => $tm,
            );

            // ini yg dibuat dinamis
            // 'area' => $this->input->post('area'),
            // 'wh' => $this->input->post('gudang'),
 
        if($this->input->post('remove_photo')) // if remove photo checked
        {
            if ($type == 'gudang') {
                if(file_exists('assets/images/gudang/'.$this->input->post('remove_photo') ) && $this->input->post('remove_photo'))
                    unlink('assets/images/gudang/'.$this->input->post('remove_photo'));
                    $data['ktp'] = '';
            } else {
                if(file_exists('assets/images/bengkel/'.$this->input->post('remove_photo') ) && $this->input->post('remove_photo'))
                    unlink('assets/images/bengkel/'.$this->input->post('remove_photo'));
                    $data['ktp'] = '';
            }
            
            // if(file_exists('assets/images/gudang/'.$this->input->post('remove_photo') ) && $this->input->post('remove_photo'))
            //     unlink('assets/images/gudang/'.$this->input->post('remove_photo'));
            // $upddata['photo'] = '';
        }

        if($this->input->post('remove_photo1')) // if remove photo checked
        {
            if ($type == 'gudang') {
                if(file_exists('assets/images/gudang/'.$this->input->post('remove_photo1') ) && $this->input->post('remove_photo1'))
                    unlink('assets/images/gudang/'.$this->input->post('remove_photo1'));
                    $data['wh'] = '';
            } else {
                if(file_exists('assets/images/bengkel/'.$this->input->post('remove_photo1') ) && $this->input->post('remove_photo1'))
                    unlink('assets/images/bengkel/'.$this->input->post('remove_photo1'));
                    $data['ws'] = '';
            }
            
            // if(file_exists('assets/images/gudang/'.$this->input->post('remove_photo') ) && $this->input->post('remove_photo'))
            //     unlink('assets/images/gudang/'.$this->input->post('remove_photo'));
            // $upddata['photo'] = '';
        }
 
        if(!empty($_FILES['ktp']['name']))
        {
            $upload = $this->_do_upload_usaha();
             
            //delete file
            if ($type == 'gudang') {
                $profil = $this->Constant_model->getDataOneColumn('gudang','id_gudang', $id);
                if(file_exists('assets/images/gudang/'.$profil->ktp) && $profil->ktp)
                    unlink('assets/images/gudang/'.$profil->ktp);
 
                 $data['ktp'] = $upload;
            } else {
                $profil = $this->Constant_model->getDataOneColumn('bengkel','id_bengkel', $id);
                if(file_exists('assets/images/bengkel/'.$profil->ktp) && $profil->ktp)
                    unlink('assets/images/bengkel/'.$profil->ktp);
 
                 $data['ktp'] = $upload;
            } 
        }

        if(!empty($_FILES['rencana']['name']))
        {
            $upload = $this->_do_upload_usaha_w();
             
            //delete file
            if ($type == 'gudang') {
                $profil = $this->Constant_model->getDataOneColumn('gudang','id_gudang', $id);
                if(file_exists('assets/images/gudang/'.$profil->wh) && $profil->wh)
                    unlink('assets/images/gudang/'.$profil->wh);
 
                 $data['wh'] = $upload;
            } else {
                $profil = $this->Constant_model->getDataOneColumn('bengkel','id_bengkel', $id);
                if(file_exists('assets/images/bengkel/'.$profil->ws) && $profil->ws)
                    unlink('assets/images/bengkel/'.$profil->ws);
 
                 $data['ws'] = $upload;
            } 
        }
 
        // $this->Constant_model->updateData('users', $data, $id);

        if ($this->session->userdata('type') == 'gudang') {
            $data['area'] = $this->input->post('area');
            $this->Constant_model->updateDataDinamis('gudang', $data, 'id_gudang', $id);
        } else {
            $data['wh'] = $this->input->post('gudang');
            $this->Constant_model->updateDataDinamis('bengkel', $data, 'id_bengkel', $id);
        }
        
        // $this->Constant_model->updateData('kasir', $upddata, $id);
        $this->session->set_flashdata('alert_msg', array('success', 'Update Profil', 'Berhasil Profil '.$this->input->post('nama')));

        echo json_encode(array("status" => TRUE));
    }


     public function update_akun()
    {   
        $id = $this->input->post('id');
        $tm = date('Y-m-d H:i:s', time());
        $type = $this->session->userdata('type');
        // $this->_validate();
            $data = array(
                    'name' => $this->input->post('pj'),
                    'email' => $this->input->post('email'),
                    'password' => $this->input->post('password'),
                    'updated_user_id' => $this->session->userdata('id'),
                    'updated_datetime' => $tm,
            );


            $upddata = array(
                    'pj' => $this->input->post('pj'),
                    'email' => $this->input->post('email'),
                    'password' => $this->input->post('password'),
                    'updated_datetime' => $tm,
            );
 
        // $this->Constant_model->updateData('users', $data, $id);

        if ($this->session->userdata('type') == 'gudang') {
            $this->Constant_model->updateDataDinamis('gudang', $upddata, 'id_gudang', $id);
            $this->Constant_model->updateDataDinamis('users', $data, 'id_gudang', $id);
        } else {
            $this->Constant_model->updateDataDinamis('bengkel', $upddata,'id_bengkel', $id);
            $this->Constant_model->updateDataDinamis('users', $data, 'id_bengkel', $id);
        }
        
        // $this->Constant_model->updateData('kasir', $upddata, $id);
        $this->session->set_flashdata('alert_msg', array('success', 'Update Profil', 'Berhasil Profil '.$this->input->post('nama')));

        echo json_encode(array("status" => TRUE));
    }


    private function _do_upload_usaha()
    {
        $type = $this->session->userdata('type');
        if ($type == 'gudang') {
            $config['upload_path']          = 'assets/images/gudang';
        } else {
            $config['upload_path']          = 'assets/images/bengkel';
        }
        
        // $config['upload_path']          = 'assets/images/gudang';
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

    private function _do_upload_usaha_w()
    {
        $type = $this->session->userdata('type');
        if ($type == 'gudang') {
            $config['upload_path']          = 'assets/images/gudang';
        } else {
            $config['upload_path']          = 'assets/images/bengkel';
        }
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 100; //set max size allowed in Kilobyte
        $config['max_width']            = 1000; // set max width image allowed
        $config['max_height']           = 1000; // set max height allowed
        $config['file_name']            = round(microtime(true) * 1000); //just milisecond timestamp fot unique name
 
        $this->load->library('upload', $config);
 
        if(!$this->upload->do_upload('rencana')) //upload and validate
        {
            $data['inputerror'][] = 'rencana';
            $data['error_string'][] = 'Upload error: '.$this->upload->display_errors('',''); //show ajax error
            $data['status'] = FALSE;
            echo json_encode($data);
            exit();
        }
        return $this->upload->data('file_name');
    }
}

/* End of file Profil.php */
/* Location: ./application/controllers/Profil.php */
