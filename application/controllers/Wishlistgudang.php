<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Wishlistgudang extends CI_Controller {

	private $settingData;

	public function __construct()
	{
		parent::__construct();
		//Load Dependencies
        $this->load->model('Constant_model');
        $this->load->model('Notifikasi_model');
        $this->load->model('Dashboard_model');
        $this->load->model('Wishlist_model');
        $this->load->model('Order_model');
        $this->load->model('Setting_model');

        $this->settingData = $this->Setting_model->getSetting();
        $setting_timezone = $this->settingData->timezone;  

        date_default_timezone_set("$setting_timezone");

	}

	private function getData(){
        $outlet_id = $this->session->userdata('outlet_id');
        $data = array(
            'title' => "Wishlist Order",
            // 'breadcumb' => "",
            'menu' => "wishlistgudang",
            'posisi' => "ordergudang",
            'content' => "admin/order/order-wishlistgudang",
            'param'=> array(
                'wishlist' => $this->Wishlist_model->getWishlist('gudang', $outlet_id),
                'totalwishlist' => $this->Wishlist_model->getTotalWishlist('gudang', $outlet_id),
                'limitorder' => $this->Constant_model->getDataOneColumnRowArray('gudang','id_gudang',"$outlet_id"),
            ),
            'css' => array(
                1 => 'assets/global/fonts/font-awesome/font-awesome', //font
            ),
            // 'jscss' => array(
            //     1 => 'asset/bower_components/jquery/dist/jquery.min',
            //     // 2 => 'asset/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min',
            // ),
            'js' =>array(
                1 => 'assets/global/vendor/peity/jquery.peity.min',//mengelem tampil
                2 => 'assets/global/js/Plugin/peity',
                3 => 'assets/global/js/Plugin/asselectable',
                4 => 'assets/global/js/Plugin/selectable',
                5 => 'assets/global/js/Plugin/table',
                6 => 'assets/global/js/Plugin/asscrollable',
            )
        );
        return $data;
    }

	// List all your items
	public function index( $offset = 0 )
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
        $idcheck = $this->input->post('idcheck');
        // var_dump($idcheck);
        // die();

        // piye carane jupuk datane karo ngitung total pembeliane ?????????????
        $datawishlist = [];
        $total = 0;

        foreach ($idcheck as $id => $key) {
            $datawishlist[] = $this->Constant_model->getDataOneColumnRowArray('order_wishlist','id',$key);
            
            $total = $total + $datawishlist[$id]['subtotal'];
        }

        // var_dump($datawishlist);
        // die();

        $tm = date('Y-m-d H:i:s', time());
        $outlet_id = $this->session->userdata('outlet_id');
        $limitorder = $this->Constant_model->getDataOneColumnRowArray('gudang','id_gudang',"$outlet_id");

        if ($total <=  $limitorder["limit_order"]) {
            $data = array(
                'id_gudang'        => $outlet_id,
                'total_pembelian'   => $total,
                'tanggal_order'     => $tm,
                'created_user_id'   => $this->session->userdata('id'),
                'created_datetime'  => $tm,
            );

            $create = $this->Constant_model->insertDataReturnLastId('order', $data);
        
            foreach ($datawishlist as $kode => $detail){
                $upddata = array(
                    'id_order'  => $create,
                    'id_p'      => $detail['id_p'],
                    'qty'       => $detail['qty'],
                    'subtotal'  => $detail['subtotal']
                );

                $this->Constant_model->insertData('order_detail', $upddata);

            }


            foreach ($idcheck as $idwish) {
                $this->Constant_model->deleteDataDinamis('order_wishlist','id',$idwish);
            }

            $dtnotif = array(
                'keterangan'        => 'Order baru dari gudang '.$data['id_gudang'].' telah diterima',
                'created_datetime'  => $tm,
                'status'            => '0',
                'role'              => '1',
                'info'              => 'order_baru'
            );

            $this->Constant_model->insertData('notifikasi', $dtnotif);

            $emailtemp=$this->load->view('admin/notif/notif_ordergudang.php',$data,TRUE);

            $this->load->library('email');
            $this->email->from($this->settingData->email_broadcast, 'Sps Parts');
            $this->email->to($this->settingData->email_broadcast);
            $this->email->subject('Order');
            $this->email->message($emailtemp);
          
            // $this->email->send();

            if (!$this->email->send()) {  
                echo $this->email->print_debugger();   
            }

        } else {
            echo json_encode(array(
                "status" => FALSE,
                "flash_header"  => 'Tambah Order',
                "flash_desc"  => 'Gagal Menambah Orderan, Tolong untuk diperhatikan Total nilai maksimal Orderan',
            ));
            die();
        }
        
        echo json_encode(array(
            "status" => TRUE,
            "flash_header"  => 'Tambah Order',
            "flash_desc"  => 'Berhasil menambah orderan',
        ));

	}

	//Update one item
	public function update( $id = NULL )
	{

	}

	//Delete one item
	public function delete()
	{
        $idcheck = $this->input->post('idcheck');

        foreach ($idcheck as $id) {
            $this->Constant_model->deleteDataDinamis('order_wishlist','id',$id);
        }

         echo json_encode(array(
            "status" => TRUE,
            "flash_header"  => 'Hapus Wishlist',
            "flash_desc"  => 'Berhasil menghapus wishlist',
        ));

	}
}

/* End of file controllername.php */
/* Location: ./application/controllers/controllername.php */
