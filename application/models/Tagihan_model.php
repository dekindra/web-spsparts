<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tagihan_model extends CI_Model {

	public function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->load->database();
    }



    public function getAllAccount()
    {
    	$this->db->join('order_detail', 'order_detail.id_order = order.id_order');
    	$this->db->join('gudang', 'gudang.id_gudang = order.id_gudang');
        $this->db->where('status_order', '3');
    	$this->db->group_by('order.id_order');

    	$query = $this->db->get('order');

		$result = $query->result();
        $this->db->save_queries = false;

        return $result;
    }

    //get data tunggakan gudang ke admin (controller tunggakan gudang)
    // public function getDataTunggakanAdmin($id)
    // {
    //     $this->db->where('status_pembayaran', '2');
    //     $this->db->where('jatuh_tempo <', 'tanggal_pembayaran');
    //     $this->db->where('id_gudang', $id);
    //     $this->db->or_where('jatuh_tempo <', date('Y-m-d H:i:s', time()));
    //     $this->db->where('id_gudang', $id);
    //     $this->db->group_by('order.id_order');
    //     $query = $this->db->get('order');
    //     // $query = $this->db->query("SELECT * FROM `order` JOIN gudang ON gudang.id_gudang = `order`.`id_gudang` WHERE status_pembayaran = 2 AND (jatuh_tempo < tanggal_pembayaran) OR (jatuh_tempo < CURRENT_DATE)  GROUP BY `order`.id_order");

    //     $result = $query->result();
    //     $this->db->save_queries = false;

    //     return $result;
    // }

    //get data tagihan gudang ke admin (controller tagihan gudang)
    public function getDataTagihanAdmin($id)
    {
      $this->db->select('order.*, sum(nominal) as jumpembayaran');
      $this->db->join('pembayaran', 'pembayaran.id_order = order.id_order', 'left');
       // $this->db->join('gudang', 'gudang.id_gudang = order.id_gudang');
       // $this->db->where('status_pembayaran', '2');
       // $this->db->where('jatuh_tempo >', 'tanggal_pembayaran');
       // $this->db->where('jatuh_tempo >', date('Y-m-d H:i:s', time()));
       $this->db->where('id_gudang', $id);
       $this->db->where('status_order', '3');
       $this->db->group_by('order.id_order');
       $this->db->order_by('order.id_order', 'desc');
       $query = $this->db->get('order');

        // $query = $this->db->query("SELECT * FROM `order` JOIN gudang ON gudang.id_gudang = `order`.`id_gudang` WHERE status_pembayaran = 2 AND (jatuh_tempo > tanggal_pembayaran) OR (jatuh_tempo > CURRENT_DATE)  GROUP BY `order`.id_order");

        $result = $query->result();
        $this->db->save_queries = false;

        return $result;
    }

    //get data tunggakan bengkel ke gudang (controller tunggakan bengkel)
    public function getDataTunggakanBengkel($id)
    {   
        $this->db->select('order.*,bengkel.*, sum(nominal) as jumpembayaran');
        $this->db->join('pembayaran', 'pembayaran.id_order = order.id_order', 'left');
        $this->db->join('bengkel', 'bengkel.id_bengkel = order.id_bengkel');
        // $this->db->where('status_pembayaran', '2');
        // $this->db->where('jatuh_tempo <', 'tanggal_pembayaran');
        $this->db->where('jatuh_tempo <', date('Y-m-d H:i:s', time()));
        $this->db->where('bengkel.wh', $id);
        $this->db->where('pembayaran.id =', null);
        $this->db->or_where('tanggal_pembayaran >=', 'jatuh_tempo');
        $this->db->where('bengkel.wh', $id);
        $this->db->group_by('order.id_order');
        $this->db->order_by('order.id_order', 'desc');
        $query = $this->db->get('order');
        // $query = $this->db->query("SELECT * FROM `order` JOIN gudang ON gudang.id_gudang = `order`.`id_gudang` WHERE status_pembayaran = 2 AND (jatuh_tempo < tanggal_pembayaran) OR (jatuh_tempo < CURRENT_DATE)  GROUP BY `order`.id_order");

        $result = $query->result();
        $this->db->save_queries = false;

        return $result;
    }

    //get data tagihan bengkel ke gudang (controller tagihan bengkel)
    public function getDataTagihanBengkel($id)
    {
       $this->db->select('order.*,bengkel.*, sum(nominal) as jumpembayaran');
       $this->db->join('pembayaran', 'pembayaran.id_order = order.id_order', 'left');
       $this->db->join('bengkel', 'bengkel.id_bengkel = order.id_bengkel');
       // $this->db->where('jatuh_tempo >', 'tanggal_pembayaran');
       $this->db->where('jatuh_tempo >', date('Y-m-d H:i:s', time()));
       $this->db->where('bengkel.wh', $id);
       $this->db->group_by('order.id_order');
       $this->db->order_by('order.id_order', 'desc');
       $query = $this->db->get('order');

        $result = $query->result();
        $this->db->save_queries = false;

        return $result;
    }

    // get data tagihan ke gudang (controller tagihan order)
    public function getDataTagihan($id)
    {
      $this->db->select('order.*, sum(nominal) as jumpembayaran');
      $this->db->join('pembayaran', 'pembayaran.id_order = order.id_order', 'left');
       // $this->db->join('gudang', 'gudang.id_gudang = order.id_gudang');
       // $this->db->where('status_pembayaran', '2');
       // $this->db->where('jatuh_tempo >', 'tanggal_pembayaran');
       // $this->db->where('jatuh_tempo >', date('Y-m-d H:i:s', time()));
       $this->db->where('id_bengkel', $id);
       $this->db->where('status_order', '2');
       $this->db->group_by('order.id_order');
       $this->db->order_by('order.id_order', 'desc');
       $query = $this->db->get('order');

        // $query = $this->db->query("SELECT * FROM `order` JOIN gudang ON gudang.id_gudang = `order`.`id_gudang` WHERE status_pembayaran = 2 AND (jatuh_tempo > tanggal_pembayaran) OR (jatuh_tempo > CURRENT_DATE)  GROUP BY `order`.id_order");

        $result = $query->result();
        $this->db->save_queries = false;

        return $result;
    }

    public function getDataTunggakanGudang()
    {   
        $this->db->select('order.*,gudang.*, sum(nominal) as jumpembayaran');
        $this->db->join('pembayaran', 'pembayaran.id_order = order.id_order', 'left');
        $this->db->join('gudang', 'gudang.id_gudang = order.id_gudang');
        $this->db->where('jatuh_tempo <', date('Y-m-d H:i:s', time()));
        $this->db->where('pembayaran.id =', null);
        $this->db->or_where('tanggal_pembayaran >=', 'jatuh_tempo');
        $this->db->group_by('order.id_order');
        $this->db->order_by('order.id_order', 'desc');
        $query = $this->db->get('order');
        // $query = $this->db->query("SELECT * FROM `order` JOIN gudang ON gudang.id_gudang = `order`.`id_gudang` WHERE status_pembayaran = 2 AND (jatuh_tempo < tanggal_pembayaran) OR (jatuh_tempo < CURRENT_DATE)  GROUP BY `order`.id_order");

        $result = $query->result();
        $this->db->save_queries = false;

        return $result;
    }

    public function getDataTagihanGudang()
    {  
      $this->db->select('order.*, gudang.*, sum(nominal) as jumpembayaran');
      $this->db->join('pembayaran', 'pembayaran.id_order = order.id_order', 'left');
       $this->db->join('gudang', 'gudang.id_gudang = order.id_gudang');
       // $this->db->where('status_pembayaran', '2');
       // $this->db->where('jatuh_tempo >', 'tanggal_pembayaran');
       $this->db->where('jatuh_tempo >', date('Y-m-d H:i:s', time()));
       $this->db->group_by('order.id_order');
       $this->db->order_by('order.id_order', 'desc');
       $query = $this->db->get('order');

        // $query = $this->db->query("SELECT * FROM `order` JOIN gudang ON gudang.id_gudang = `order`.`id_gudang` WHERE status_pembayaran = 2 AND (jatuh_tempo > tanggal_pembayaran) OR (jatuh_tempo > CURRENT_DATE)  GROUP BY `order`.id_order");

        $result = $query->result();
        $this->db->save_queries = false;

        return $result;
    }


    public function getTunggakanGudang()
    {
        // $this->db->select('name, count(order.id_order) as tunggakan, sum(total_tagihan) as nominal');
        // $this->db->join('gudang', 'gudang.id_gudang = order.id_gudang');
        // $this->db->join('pembayaran', 'pembayaran.id_order = order.id_order', 'left');
        // $this->db->where('jatuh_tempo <', date('Y-m-d H:i:s', time()));
        // $this->db->where('pembayaran.id =', null);
        // $this->db->or_where('tanggal_pembayaran >=', 'jatuh_tempo');
        // $this->db->group_by('order.id_gudang');
        // $this->db->order_by('order.id_order', 'desc');

        // $query = $this->db->get('order');

        $query = $this->db->query("SELECT name, COUNT(`order`.id_order) as tunggakan, sum(`order`.`total_tagihan`)as nominal
                                  FROM `order`
                                  JOIN gudang ON gudang.id_gudang = order.id_gudang
                                  WHERE `order`.`jatuh_tempo` < CURRENT_DATE
                                  OR (
                                      SELECT COUNT(pembayaran.id)
                                      FROM pembayaran
                                      WHERE pembayaran.id_order = `order`.`id_order`
                                      AND pembayaran.tanggal_pembayaran > `order`.`jatuh_tempo`
                                  ) > 0
                                  GROUP BY `order`.`id_gudang`");

        $result = $query->result();
        $this->db->save_queries = false;

        return $result;
    }

    public function getTunggakanBengkel()
    {
        // $this->db->select('bengkel.name as namabengkel,gudang.name as namagudang, count(order.id_order) as tunggakan, sum(total_tagihan) as nominal');
        // $this->db->join('bengkel', 'bengkel.id_bengkel = order.id_bengkel');
        // $this->db->join('gudang', 'gudang.id_gudang = bengkel.wh');
        // $this->db->join('pembayaran', 'pembayaran.id_order = order.id_order', 'left');
        // $this->db->where('jatuh_tempo <', date('Y-m-d H:i:s', time()));
        // $this->db->where('pembayaran.id =', null);
        // $this->db->or_where('tanggal_pembayaran >=', 'jatuh_tempo');
        // $this->db->group_by('order.id_bengkel');
        // $this->db->order_by('order.id_order', 'desc');

        // $query = $this->db->get('order');

        $query = $this->db->query("SELECT bengkel.name as namabengkel, gudang.name as namagudang, COUNT(`order`.id_order) as tunggakan, sum(`order`.`total_tagihan`)as nominal
                                  FROM `order`
                                  JOIN bengkel ON bengkel.id_bengkel = `order`.`id_bengkel`
                                  JOIN gudang ON gudang.id_gudang = bengkel.wh
                                  WHERE `order`.`jatuh_tempo` < CURRENT_DATE
                                  OR (
                                      SELECT COUNT(pembayaran.id)
                                      FROM pembayaran
                                      WHERE pembayaran.id_order = `order`.`id_order`
                                      AND pembayaran.tanggal_pembayaran > `order`.`jatuh_tempo`
                                  ) > 0
                                  GROUP BY `order`.`id_bengkel`");

        $result = $query->result();
        $this->db->save_queries = false;

        return $result;
    }

    public function getDataDetailTagihan($id)
    {
       $this->db->join('produk', 'produk.id_p = order_detail.id_p');
       $this->db->join('kategori_produk', 'kategori_produk.id_kp = produk.category');
       $this->db->where('order_detail.id_order', $id);
       $query = $this->db->get('order_detail');

        $result = $query->result();
        $this->db->save_queries = false;

        return $result;
    }

    public function getJumPembayaran($id)
    {
      $this->db->select('sum(nominal) as jumlah');
      $this->db->where('id_order', $id);

      $query = $this->db->get('pembayaran');

      $result = $query->row();
      $this->db->save_queries = false;

      return $result;

    }

/////////////////////////////////tagihan order bengkel/////////////////////////////////////////
    public function getTotalTagihan($id)
    {
        $this->db->select('sum(total_tagihan) as totaltagihan');
        $this->db->where('id_bengkel', $id);

        $query = $this->db->get('order');
        $row = $query->row();
        $this->db->save_queries = false;

        return $row;
    }


    public function getTagihan($start='', $end='')
    {
        $outlet_id = $this->session->userdata('outlet_id');

        $this->db->select('order.*, sum(nominal) as jumpembayaran');
        $this->db->join('pembayaran', 'pembayaran.id_order = order.id_order', 'left');

        $this->db->where("(order.tanggal_order BETWEEN '$start' and '$end' )");
        $this->db->where('id_bengkel', $outlet_id);
        $this->db->where('status_order', '2');

        $this->db->group_by('order.id_order');
        $this->db->order_by('order.id_order', 'desc');

        $query = $this->db->get('order');
        $result = $query->result();
        $this->db->save_queries = false;

        return $result;
    }


}

/* End of file Tagihan_model.php */
/* Location: ./application/models/Tagihan_model.php */