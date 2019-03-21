<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    private $settingData;

	public function __construct()
	{
		parent::__construct();
		//Load Dependencies
        $this->load->model('User_model');
        $this->load->model('Constant_model');
        $this->load->model('Notifikasi_model');
        $this->load->model('M_Account','m_account');
        $this->load->model('Setting_model');

        $this->settingData = $this->Setting_model->getSetting();
        $setting_timezone = $this->settingData->timezone;  

        date_default_timezone_set("$setting_timezone");

	}

    // public function login(){
    //     $this->form_validation->set_rules('email', 'Username', 'trim|required');
    //     $this->form_validation->set_rules('password', 'Password', 'trim|required');
    //     if ($this->form_validation->run() === FALSE) {
    //         $this->load->view('admin/templates/login');
    //      } else {
    //         $email = $this->input->post('email');
    //         $password = $this->input->post('password');
    //         $cek = $this->User_model->verifyLogIn($email, $password);

    //         if($cek){
    //             // Ambil Data session
    //             $result = $this->User_model->getUser($email, $password);
    //             $nama = $result['nama'];
    //             $email = $result['email'];
    //             $role = $result['role_id'];
    //             $outlet_id = $result['outlet_id'];

    //             // Set Session
    //             $data = array(
    //                 'nama' => $nama,
    //                 'email' => $email, 
    //                 'role' => $role, 
    //                 'outlet_id' => $outlet_id, 
    //             );

    //             // Create Session
    //             $this->session->set_userdata($data);

    //             // Arahkan kemana
    //             $this->session->set_flashdata('alert_msg', array('success', 'Login Sukses', "Selamat Bekerja $nama"));
    //             redirect('dashboard');
    //         }else{

    //             $this->session->set_flashdata('alert_msg', array('failure', 'Login Gagal', "Mohon periksa kembali email dan password"));
    //             redirect('user/login');
    //         }
    //     }
        
    // }

    public function login(){

        if ($this->session->userdata('is_logged_in') == TRUE) {
            redirect('dashboard');
        } else {
            $this->form_validation->set_rules('email', 'Username', 'trim|required');
            $this->form_validation->set_rules('password', 'Password', 'trim|required');
            if ($this->form_validation->run() === FALSE) {
                $this->load->view('admin/templates/login');
             } else {
                $email = $this->input->post('email');
                $password = $this->input->post('password');
                //ambil ada email enggak
                $cek = $this->User_model->verifyLogIn($email);
                if($cek){
                    $result = $this->User_model->getUser($email, $password);
                        if ($password == $result['password']) {
                            if ($result['status'] == 0) {
                                $this->session->set_flashdata('alert_msg', array('failure', 'Login Gagal', "Akun anda tidak/belum aktif, silahkan hubungi administrator."));
                                redirect('','refresh');
                            } else {
                                 // Ambil Data session
                                $id = $result['id'];
                                $nama = $result['name'];
                                $email = $result['email'];
                                $role = $result['role_id'];
                                $type = $result['type'];
                                if ($type == 'gudang') {
                                    $outlet_id = $result['id_gudang'];
                                } elseif ($type == 'bengkel') {
                                    $outlet_id = $result['id_bengkel'];
                                } else {
                                    $outlet_id = $result['id_kasir'];
                                }
                                
                                // Set Session
                                $data = array(
                                    'id' => $id,
                                    'nama' => $nama,
                                    'email' => $email, 
                                    'role' => $role, 
                                    'type' => $type, 
                                    'outlet_id' => $outlet_id, 
                                    'is_logged_in' => TRUE, 
                                );

                                // Create Session
                                $this->session->set_userdata($data);

                                //fetch new session id
                                $sessionId = session_id();

                                //map new session id with userID and destroy prevoius mapped sessionId

                                $this->User_model->setSession($email,$sessionId);

                                // Arahkan kemana
                                $this->session->set_flashdata('alert_msg', array('success', 'Login Sukses', "Selamat Bekerja $nama"));
                                redirect('dashboard');
                            }
                            
                        }else{
                            $this->session->set_flashdata('alert_msg', array('failure', 'Login Gagal', "Mohon periksa kembali kesesuaian e-mail dan password"));
                            redirect('','refresh');
                        }
                }else{
                    $this->session->set_flashdata('alert_msg', array('failure', 'Login Gagal', "Mohon maaf Email anda belum terdaftar"));
                    redirect('user/login');
                }

            }
        }
        
        
    }

    public function logout(){
        $this->session->sess_destroy();
        redirect('user/login');
    }

    public function daftar(){
        $data = array(
            'title' => "Data User",
            // 'breadcumb' => "",
            'content' => "admin/templates/daftar",
            'param'=> array(
                // 'absensis' => $this->Absensi_model->getAllAccount(),
                // 'siswas'=>$this->Siswa_model->getAllAccount_byWk(),
            ),
            'css' => array(
                1 => 'assets/base/assets/examples/css/pages/login-v3', //
            ),
            // 'jscss' => array(
            //     1 => 'asset/bower_components/jquery/dist/jquery.min',
            //     // 2 => 'asset/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min',
            // ),
            // 'js' =>array(
            //     1 => 'assets/global/vendor/peity/jquery.peity.min',//mengelem tampil
            //     2 => 'assets/global/vendor/datatables.net/jquery.dataTables',//datatable
            //     3 => 'assets/global/vendor/datatables.net-bs4/dataTables.bootstrap4',
            //     4 => 'assets/global/vendor/datatables.net-responsive/dataTables.responsive',
            //     5 => 'assets/global/vendor/datatables.net-responsive-bs4/responsive.bootstrap4',
            //     6 => 'assets/global/vendor/datatables.net-buttons/dataTables.buttons',
            //     7 => 'assets/global/vendor/datatables.net-buttons/buttons.html5',
            //     8 => 'assets/global/vendor/datatables.net-buttons/buttons.flash',
            //     9 => 'assets/global/vendor/datatables.net-buttons/buttons.print',
            //     10 => 'assets/global/vendor/datatables.net-buttons/buttons.colVis',
            //     11 => 'assets/global/vendor/datatables.net-buttons-bs4/buttons.bootstrap4',
            //     12 => 'assets/global/vendor/asrange/jquery-asRange.min',
            //     13 => 'assets/global/vendor/bootbox/bootbox',
            //     14 => 'assets/global/vendor/formatter/jquery.formatter', //mask
            //     15 => 'assets/base/assets/examples/js/charts/peity', //men gelem tampil
            //     16 => 'assets/global/js/Plugin/jquery-placeholder', //material
            //     17 => 'assets/global/js/Plugin/material', //material
            //     18 => 'assets/global/js/Plugin/datatables', //datatable
            //     19 => 'assets/base/assets/examples/js/tables/datatable', //datatable
            //     20 => 'assets/global/js/Plugin/formatter', //mask
            //     21 => 'assets/global/vendor/jquery-strength/password_strength', //password
            //     22 => 'assets/global/vendor/jquery-strength/jquery-strength.min', //
            //     23 => 'assets/global/js/Plugin/jquery-strength'//
            // )
        );

        $this->load->view('admin/templates/layout-daftar', $data);
    }


    public function forgot_password()
    {
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');   
         
         if($this->form_validation->run() == FALSE) {  
             $data['title'] = 'Halaman Reset Password';  
             $this->load->view('admin/templates/forgot-password',$data);  
         }else{  
             $email = $this->input->post('email');   
             $clean = $this->security->xss_clean($email);  
             $userInfo = $this->m_account->getUserInfoByEmail($clean);  
               
             if(!$userInfo){  
              $this->session->set_flashdata('alert_msg', array('failure', 'Update Password', "email address salah, silakan coba lagi")); 
               redirect(site_url('user/login'),'refresh');   
             }    
               
             //build token   
                       
             $token = $this->m_account->insertToken($userInfo->id);              
             $qstring = $this->base64url_encode($token);           
             $url = site_url() . '/user/reset_password/token/' . $qstring;  
             $link = '<a href="' . $url . '">' . $url . '</a>';   
               
             $message = '';             
             $message .= '<strong>Hai, anda menerima email ini karena ada permintaan untuk memperbaharui  
                 password anda.</strong><br>';  
             $message .= '<strong>Silakan klik link ini:</strong> ' . $link;         
   
             // echo $message; //send this through mail
            $this->load->library('email');
            $this->email->from($this->settingData->email_broadcast, 'Sps Parts');
            $this->email->to($email);
            $this->email->subject('Order');
            $this->email->message($message);
          
            // $this->email->send();

            if (!$this->email->send()) {  
                echo $this->email->print_debugger();   
            } 

            echo "Silahkan cek email anda untuk melanjutkan proses reset password"; 

             exit;  
           
         }  
    }

     public function reset_password()  
     {  
       $token = $this->base64url_decode($this->uri->segment(4));           
       $cleanToken = $this->security->xss_clean($token);    
         
      $user_info = $this->m_account->isTokenValid($cleanToken); //either false or array();

       // var_dump($user_info);
       // die();          
         
       if(!$user_info){  
        $this->session->set_flashdata('alert_msg', array('failure', 'Update Password', "Token tidak valid atau kadaluarsa"));
         redirect(site_url('user/login'),'refresh');   
       }    
   
       $data = array(  
         'title'=> 'Halaman Reset Password',  
         'nama'=> $user_info->name,   
         'email'=>$user_info->email,   
         'token'=>$this->base64url_encode($token)  
       );  
         
       $this->form_validation->set_rules('password', 'Password', 'required|min_length[5]');  
       $this->form_validation->set_rules('passconf', 'Password Confirmation', 'required|matches[password]');         
         
       if ($this->form_validation->run() == FALSE) {    
         $this->load->view('admin/templates/reset_password', $data);  
       }else{  
                           
         $post = $this->input->post(NULL, TRUE);          
         $cleanPost = $this->security->xss_clean($post);          
         // $hashed = md5($cleanPost['password']);          
         $cleanPost['password'] = $cleanPost['password'];  
         $cleanPost['id'] = $user_info->id;  
         unset($cleanPost['passconf']);  

         // var_dump($user_info);
         // die();        
         if(!$this->m_account->updatePassword($cleanPost)){  
           $this->session->set_flashdata('sukses', 'Update password gagal.');  
         }else{
            if ($user_info->type == 'gudang') {
              $this->m_account->updatePasswordGudang($user_info);
              $this->session->set_flashdata('alert_msg', array('success', 'Update Password', "Password anda sudah  
             diperbaharui. Silakan login."));
            } elseif ($user_info->type == 'bengkel') {
              $this->m_account->updatePasswordBengkel($user_info);
              $this->session->set_flashdata('alert_msg', array('success', 'Update Password', "Password anda sudah  
             diperbaharui. Silakan login."));
            } elseif ($user_info->type == 'kasir') {
              $this->m_account->updatePasswordKasir($user_info);
              $this->session->set_flashdata('alert_msg', array('success', 'Update Password', "Password anda sudah  
             diperbaharui. Silakan login."));
            } else {
               $this->session->set_flashdata('alert_msg', array('success', 'Update Password', "Password anda sudah  
             diperbaharui. Silakan login."));
            }
         }  
         redirect(site_url('user/login'),'refresh');         
       }  
     }  
       
   public function base64url_encode($data) {   
    return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');   
   }   
   
   public function base64url_decode($data) {   
    return base64_decode(str_pad(strtr($data, '-_', '+/'), strlen($data) % 4, '=', STR_PAD_RIGHT));   
   }

}

/* End of file User.php */
/* Location: ./application/controllers/User.php */
