<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
    private $settingData;

    public function __construct()
    {
        parent::__construct();
        //Load Dependencies
        $this->load->model('Constant_model');
        $this->load->model('Notifikasi_model');
        $this->load->model('Dashboard_model');
        $this->load->model('Setting_model');
        
        $this->settingData = $this->Setting_model->getSetting();
        $setting_timezone = $this->settingData->timezone;  

        date_default_timezone_set("$setting_timezone");


    }

    private function getData(){
        $data = array(
            'title' => "Dashboard",
            // 'breadcumb' => "",
            'menu' => "dashboard",
            'posisi' => "dashboard",
            // 'content' => "admin/dashboard/dashboard-admin",
            // 'param'=> array(

            //     'siswas'=>$this->Siswa_model->getAllAccount_byWk(),
            // ),
            'css' => array(
                1 => 'assets/base/assets/examples/css/uikit/modals', //modal
                2 => 'assets/global/vendor/datatables.net-bs4/dataTables.bootstrap4', //datatable ..
                3 => 'assets/global/vendor/datatables.net-responsive-bs4/dataTables.responsive.bootstrap4', //datatable ..
                4 => 'assets/global/vendor/datatables.net-buttons-bs4/dataTables.buttons.bootstrap4', //datatable ..
                5 => 'assets/global/vendor/datatables.net-select-bs4/dataTables.select.bootstrap4', //datatable ..
                6 => 'assets/base/assets/examples/css/tables/datatable', //datatable ..
                7 => 'assets/global/fonts/font-awesome/font-awesome', //font
                8 => 'assets/base/assets/examples/css/forms/masks', //mask
                9 => 'assets/global/vendor/bootstrap-datepicker/bootstrap-datepicker', //font
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
                12 => 'assets/base/assets/examples/js/charts/peity', //men gelem tampil
                13 => 'assets/global/js/Plugin/datatables', //datatable
                14 => 'assets/base/assets/examples/js/tables/datatable', //datatable
                15 => 'assets/global/vendor/bootstrap-datepicker/bootstrap-datepicker', //date
                16 => 'assets/global/js/Plugin/bootstrap-datepicker' //date
            )
        );

        return $data;
    }

    // List all your items
    public function index()
    {
        $role = $this->session->userdata('role');
        $outlet = $this->session->userdata('outlet_id');
        $minstock = $this->settingData->min_stock;


        if ($this->session->userdata('type')=='admin') {
            $content = array(
                'pengumuman'        => $this->Dashboard_model->pengumumanAdmin(),
                'jumlahorder'       => $this->Dashboard_model->jumOrder(),
                'jumlahpendapatan'  => $this->Dashboard_model->jumPendapatan(),
                'jumlahtagihan'     => $this->Dashboard_model->jumTagihan(),
                'jumlahtunggakan'   => $this->Dashboard_model->jumTunggakan(),
                'jumlahgudang'      => $this->Dashboard_model->jumGudang(),
                'jumlahbengkel'     => $this->Dashboard_model->jumBengkel(),
                'jumlahpelanggan'   => $this->Dashboard_model->jumPelanggan(),
                'ordermasuks'       => $this->Dashboard_model->recentOrder(),
                'content'           => "admin/dashboard/dashboard-admin");

        } elseif ($this->session->userdata('type')=='gudang') {
            $content = array(
                'pengumuman'        => $this->Dashboard_model->pengumuman('gudang', $outlet),
                'jumlahpendapatan'  => $this->Dashboard_model->jumPendapatanGd(),
                'jumlahtagihan'     => $this->Dashboard_model->jumTagihanGd(),
                'jumlahpembayaran'  => $this->Dashboard_model->jumPembayaranGd(),
                'jumlahbengkel'     => $this->Dashboard_model->jumBengkelGd(),
                'orders'            => $this->Dashboard_model->recentOrderGd(),
                'tempos'            => $this->Dashboard_model->orderJatuhTempoGd(),
                'stocks'            => $this->Dashboard_model->reorderProdukGd($minstock),
                'content'           => "admin/dashboard/dashboard-gudang");

        } elseif ($this->session->userdata('type')=='bengkel') {
            $content = array(
                'pengumuman'        => $this->Dashboard_model->Pengumuman('bengkel', $outlet),
                'statusgudang'      => $this->Dashboard_model->statusGudang($outlet),
                'jumlahtagihan'     => $this->Dashboard_model->jumTagihanBk(),
                'jumlahpenjualan'   => $this->Dashboard_model->jumPenjualanBk(),
                'jumlahpelanggan'   => $this->Dashboard_model->jumPelangganBk(),
                'orders'            => $this->Dashboard_model->recentOrderBk(),
                'tempos'            => $this->Dashboard_model->orderJatuhTempoBk(),
                'stocks'            => $this->Dashboard_model->reorderProduk($minstock),
                'content'           => "admin/dashboard/dashboard-bengkel");
        } else {
            $content = array(
                'jumlahorder'       => $this->Dashboard_model->jumOrderKs(),
                'jumlahpelanggan'   => $this->Dashboard_model->jumPelangganKs(),
                'content'           => "admin/dashboard/dashboard-kasir");
        }
        
        $content['notif'] = $this->Notifikasi_model->getData($role,$outlet);

        $data = array_merge($content, $this->getData());

        $this->load->view('admin/templates/layout', $data);
    }

    // Add a new item
    public function add()
    {

    }

    //Update one item
    public function update( $id = NULL )
    {

    }

    //Delete one item
    public function delete( $id = NULL )
    {

    }

    public function lapPenjualanBy()
    {
        $start              = date("Y-m-d",strtotime($this->input->post('start')));
        $end                = date("Y-m-d",strtotime($this->input->post('end')));

        $data['start']      = $start;
        $data['end']        = $end;


        if ($this->session->userdata('role') == 1) {
            $data['penjualan']  = $this->Dashboard_model->getTotalPenjualanAdmin($start,$end);
            $data['bebans']     = $this->Dashboard_model->getBebanAdmin($start,$end);

            $this->load->view('admin/dashboard/tampil-datakeuangan', $data);   
            
        }elseif($this->session->userdata('role') == 2){
            $data['penjualan']  = $this->Dashboard_model->getTotalPenjualanGd($start,$end);
            $data['bebans']     = $this->Dashboard_model->getBebanGd($start,$end);

            $this->load->view('admin/dashboard/tampil-datakeuangan', $data); 

        }elseif($this->session->userdata('role') == 3){
            $data['penjualan']  = $this->Dashboard_model->getTotalPenjualan($start,$end);
            $data['bebans']     = $this->Dashboard_model->getBeban($start,$end);

            $this->load->view('admin/dashboard/tampil-datakeuangan', $data); 

        }else{
            redirect('user/logout');
        }
        
        
    }

    public function cetakLaporan($start, $end)
    {
        $role       = $this->session->userdata('role');
        $outlet_id  = $this->session->userdata('outlet_id');

        if (empty($role))
        {
            show_404();
        }

        // $start              = date("Y-m-d",strtotime($this->input->post('start')));
        // $end                = date("Y-m-d",strtotime($this->input->post('end')));
        // $pelanggan           = $this->input->post('pelanggan');

        $data['start']  = date("Y-m-d",strtotime($start));
        $data['end']    = date("Y-m-d",strtotime($end));

        if ($role == 1) {
            $data['penjualan']  = $this->Dashboard_model->getTotalPenjualanAdmin($start,$end);
            $data['bebans']     = $this->Dashboard_model->getBebanAdmin($start,$end);

            $this->load->view('admin/laporan/print-labarugiadmin',$data);
        }elseif ($role == 2) {
            $data['penjualan']  = $this->Dashboard_model->getTotalPenjualanGd($start,$end);
            $data['bebans']     = $this->Dashboard_model->getBebanGd($start,$end);

            $data['gudang']     = $this->Constant_model->getDataOneColumnRowArray('gudang', 'id_gudang',$outlet_id);
            $this->load->view('admin/laporan/print-labarugigudang',$data);
            
        }elseif ($role == 3) {
            $data['penjualan']  = $this->Dashboard_model->getTotalPenjualan($start,$end);
            $data['bebans']     = $this->Dashboard_model->getBeban($start,$end);

            $data['bengkel']    = $this->Constant_model->getDataOneColumnRowArray('bengkel', 'id_bengkel',$outlet_id);
            $this->load->view('admin/laporan/print-labarugi',$data);
        } else {
            redirect('user/logout');
        }
        


    }
}

/* End of file Dashboard.php */
/* Location: ./application/controllers/Dashboard.php */
