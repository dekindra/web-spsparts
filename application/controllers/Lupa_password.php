<?php  
 defined('BASEPATH') OR exit('No direct script access allowed');  
   
 class Lupa_password extends CI_Controller {  

  private $settingData;

  public function __construct()
  {
    parent::__construct();
    //Do your magic here
    $this->load->model('M_Account','m_account');

    $this->load->model('Setting_model');

        $this->settingData = $this->Setting_model->getSetting();
        $setting_timezone = $this->settingData->timezone;  

        date_default_timezone_set("$setting_timezone");
  }
   
   
     public function index()  
     {  
         
         $this->form_validation->set_rules('email', 'Email', 'required|valid_email');   
         
         if($this->form_validation->run() == FALSE) {  
             $data['title'] = 'Halaman Reset Password | Tutorial reset password CodeIgniter @ https://recodeku.blogspot.com';  
             $this->load->view('account/v_lupa_password',$data);  
         }else{  
             $email = $this->input->post('email');   
             $clean = $this->security->xss_clean($email);  
             $userInfo = $this->m_account->getUserInfoByEmail($clean);  
               
             if(!$userInfo){  
              $this->session->set_flashdata('alert_msg', array('failure', 'Update Password', "email address salah, silakan coba lagi")); 
               redirect(site_url('login'),'refresh');   
             }    
               
             //build token   
                       
             $token = $this->m_account->insertToken($userInfo->id);              
             $qstring = $this->base64url_encode($token);           
             $url = site_url() . '/lupa_password/reset_password/token/' . $qstring;  
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
         redirect(site_url('login'),'refresh');   
       }    
   
       $data = array(  
         'title'=> 'Halaman Reset Password | Tutorial reset password CodeIgniter @ https://recodeku.blogspot.com',  
         'nama'=> $user_info->name,   
         'email'=>$user_info->email,   
         'token'=>$this->base64url_encode($token)  
       );  
         
       $this->form_validation->set_rules('password', 'Password', 'required|min_length[5]');  
       $this->form_validation->set_rules('passconf', 'Password Confirmation', 'required|matches[password]');         
         
       if ($this->form_validation->run() == FALSE) {    
         $this->load->view('account/v_reset_password', $data);  
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