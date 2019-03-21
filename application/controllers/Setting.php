<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setting extends CI_Controller {
	public function __construct()
  {
   parent::__construct();
			//Load Dependencies
   $this->load->model('Constant_model');
   $this->load->model('Notifikasi_model');
   $this->load->model('Kasir_model');
   $this->load->model('Setting_model');

   $settingData = $this->Setting_model->getSetting();
   $setting_timezone = $settingData->timezone;  

   date_default_timezone_set("$setting_timezone");

}

private function getData(){
    $data = array(
        'title' => "Pengaturan",
                // 'breadcumb' => "",
        'menu' => "pengaturan",
        'posisi' => "pengaturan",
        'content' => "admin/templates/setting",
        'param'=> array(
            'settings' => $this->Constant_model->getDataRow('site_setting'),
            'timezones' => $this->Constant_model->getDataAll('timezones','timezone','asc'),
                //     // 'siswas'=>$this->Siswa_model->getAllAccount_byWk(),
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
public function index()
{
        $role = $this->session->userdata('role');
        $outlet = $this->session->userdata('outlet_id');
        $content['notif'] = $this->Notifikasi_model->getData($role,$outlet);

        $data = array_merge($content, $this->getData());
        $this->load->view('admin/templates/layout', $data);
}

    // ****************************** Action To Database -- START ****************************** //
public function update()
{   
    $id = $this->input->post('id');
    $tm = date('Y-m-d H:i:s', time());
        // $this->_validate();
    $data = array(
        'site_name'         => $this->input->post('site_name'),
        'email_broadcast'   => $this->input->post('email'),
        'password_email'    => $this->input->post('password'),
        'jatuh_tempo'    => $this->input->post('jatuh_tempo'),
        'min_stock'    => $this->input->post('stock'),
        'timezone'    => $this->input->post('timezone'),
        'default_limit'    => $this->input->post('default_limit'),
        'updated_user_id'   => $this->session->userdata('id'),
        'updated_datetime'  => $tm,
    );
    
        if($this->input->post('remove_photo')) // if remove photo checked
        {

            if(file_exists('assets/images/'.$this->input->post('remove_photo') ) && $this->input->post('remove_photo'))
                unlink('assets/images/'.$this->input->post('remove_photo'));
            $data['site_logo'] = '';
            
        }
        
        if(!empty($_FILES['site_logo']['name']))
        {
            $upload = $this->_do_upload();

            $setting = $this->Constant_model->getDataRow('site_setting');
            if(file_exists('assets/images/'.$setting->site_logo) && $setting->site_logo)
                unlink('assets/images/'.$setting->site_logo);

            $data['site_logo'] = $upload;
        }
        
        $this->Constant_model->updateData('site_setting', $data, $id);
        
        $this->session->set_flashdata('alert_msg', array('success', 'Update Pengaturan', 'Berhasil Mengupdate Pengaturan'));

        echo json_encode(array("status" => TRUE));
    }

    private function _do_upload()
    {
        
        $config['upload_path']          = 'assets/images';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 100; //set max size allowed in Kilobyte
        $config['max_width']            = 1000; // set max width image allowed
        $config['max_height']           = 1000; // set max height allowed
        $config['file_name']            = round(microtime(true) * 1000); //just milisecond timestamp fot unique name
        
        $this->load->library('upload', $config);
        
        if(!$this->upload->do_upload('site_logo')) //upload and validate
        {
            $data['inputerror'][] = 'site_logo';
            $data['error_string'][] = 'Upload error: '.$this->upload->display_errors('',''); //show ajax error
            $data['status'] = FALSE;
            echo json_encode($data);
            exit();
        }

        return $this->upload->data('file_name');
    }
}

/* End of file Setting.php */
/* Location: ./application/controllers/Setting.php */