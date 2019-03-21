<!-- Function -->
<?php 
function formatRP($angka){
 $jadi = number_format($angka,0,',','.');
 return $jadi;
}

?>
      <!-- <div class="page-header">
        <h1 class="page-title font-size-26 font-weight-100">Ecommerce Overview</h1>
      </div> -->

      <div class="page-content container-fluid">
        <!-- End Panel Table Tools -->
        <div class="panel">
          <div class="panel-body">
            <h4>Pengumuman</h4>
            <div class="table-responsive">
              <table class="table table-hover dataTable table-striped w-full" data-plugin="dataTable">
                <thead>
                  <tr>
                    <th style="background:  #ececec;">#</th>
                    <th style="background: #ececec;">Tanggal</th>
                    <th style="background: #ececec;">Pesan</th>
                    <th style="background: #ececec;">Action</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                  $i=1;
                    if (!is_null($pengumuman))
                    foreach ($pengumuman as $pg) {
                  ?>
                  <tr>
                    <td><?php echo $i; ?></td>
                    <td class=""><?php echo date('d M Y', strtotime($pg -> tanggal)); ?></td>
                    <td class=""><?php echo $pg -> judul; ?></td>  
                    <td class="text-nowrap">
                      <button type="button" class="btn btn-sm btn-icon btn-info btn-outline" data-toggle="tooltip"
                                data-original-title="Detail" onclick="detail_pengumuman(<?php echo $pg->id; ?>)">
                                <i class="icon wb-info-circle" aria-hidden="true"></i>
                      </button>
                    </td>                                                
                  </tr> 
                <?php  $i++; } ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <!-- End Panel Table Tools -->
        <!-- Modal Detail-->
        <div class="modal fade modal-fade-in-scale-up" id="modalDetailPengumuman" aria-hidden="true"
          aria-labelledby="exampleModalTitle" role="dialog" tabindex="-1">
          <div class="modal-dialog modal-simple">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title">Detail Pengumuman</h4>
              </div>
              <div class="modal-body">
                <div class="row"> 
                    <div class="col-6 text-left"> 
                        <h4 id="judul" class="example-title"></h4>
                    </div>
                    <div class="col-6 text-right"> 
                        <p id="tanggal"></p>
                    </div>
                </div>
                <textarea id="isipengumuman" class="form-control" rows="12"></textarea>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>
        <!-- End Modal Detail-->
        <div class="row">
          <!-- First Row -->
          <div class="col-xl-3 col-md-6 info-panel">
            <div class="card card-shadow">
              <div class="card-block bg-white p-20">
                <button type="button" class="btn btn-floating btn-sm btn-success">
                  <i class="icon fa-dollar"></i>
                </button>
                <span class="ml-15 font-weight-400">PENDAPATAN</span>
                <div class="content-text text-center mb-0">
                  <div class="content-text text-center mb-0">
                    <span class="font-size-40 font-weight-100"><?php echo formatRP($jumlahpendapatan->jumlahpendapatan); ?>
                      
                    </span>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-md-6 info-panel">
            <div class="card card-shadow">
              <div class="card-block bg-white p-20">
                <button type="button" class="btn btn-floating btn-sm btn-warning">
                  <i class="icon fa-money"></i>
                </button>
                <span class="ml-15 font-weight-400">TAGIHAN</span>
                <div class="content-text text-center mb-0">
                  <div class="content-text text-center mb-0">
                    <span class="font-size-40 font-weight-100"><?php echo formatRP($jumlahtagihan->jumlahtagihan); ?></span>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-md-6 info-panel">
            <div class="card card-shadow">
              <div class="card-block bg-white p-20">
                <button type="button" class="btn btn-floating btn-sm btn-danger">
                  <i class="icon fa-dollar"></i>
                </button>
                <span class="ml-15 font-weight-400">PEMBAYARAN</span>
                <div class="content-text text-center mb-0">
                  <div class="content-text text-center mb-0">
                    <span class="font-size-40 font-weight-100"><?php echo formatRP($jumlahpembayaran->jumlahpembayaran); ?></span>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-md-6 info-panel">
            <div class="card card-shadow">
              <div class="card-block bg-white p-20">
                <button type="button" class="btn btn-floating btn-sm btn-info">
                  <i class="icon fa-motorcycle"></i>
                </button>
                <span class="ml-15 font-weight-400">BENGKEL</span>
                <div class="content-text text-center mb-0">
                  <div class="content-text text-center mb-0">
                    <span class="font-size-40 font-weight-100"><?php echo $jumlahbengkel->jumlahbengkel; ?></span>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- End First Row -->
        </div>
         <!-- Panel Tabs -->
        <div class="panel">
          <div class="panel-heading">
            <h3 class="panel-title">Informasi Penting</h3>
          </div>
          <div class="panel-body container-fluid">

          <!-- Example Tabs -->
                <div class="example-wrap">
                  <div class="nav-tabs-horizontal" data-plugin="tabs">
                    <ul class="nav nav-tabs" role="tablist">
                      <li class="nav-item" role="presentation"><a class="nav-link active" data-toggle="tab" href="#exampleTabsOne"
                          aria-controls="exampleTabsOne" role="tab">Order Siap</a></li>
                      <li class="nav-item" role="presentation"><a class="nav-link" data-toggle="tab" href="#exampleTabsTwo"
                          aria-controls="exampleTabsTwo" role="tab">Order Jatuh Tempo</a></li>
                      <li class="nav-item" role="presentation"><a class="nav-link" data-toggle="tab" href="#exampleTabsThree"
                          aria-controls="exampleTabsThree" role="tab">Darurat Inventori</a></li>
                      <!-- <li class="dropdown nav-item" role="presentation">
                        <a class="dropdown-toggle nav-link" data-toggle="dropdown" href="#" aria-expanded="false">Menu </a>
                        <div class="dropdown-menu" role="menu">
                          <a class="active dropdown-item" data-toggle="tab" href="#exampleTabsOne" aria-controls="exampleTabsOne"
                            role="tab">Home</a>
                          <a class="dropdown-item" data-toggle="tab" href="#exampleTabsTwo" aria-controls="exampleTabsTwo"
                            role="tab">Components</a>
                          <a class="dropdown-item" data-toggle="tab" href="#exampleTabsThree" aria-controls="exampleTabsThree"
                            role="tab">Css</a>
                          <a class="dropdown-item" data-toggle="tab" href="#exampleTabsFour" aria-controls="exampleTabsFour"
                            role="tab">Javascript</a>
                        </div>
                      </li> -->
                    </ul>
                    <div class="tab-content pt-20">
                      <div class="tab-pane active" id="exampleTabsOne" role="tabpanel">
                        <table class="table table-hover dataTable table w-full" >
                          <thead>
                            <tr>
                              <!-- <th>#</th> -->
                              <th style="background:  #ececec;">#</th>
                              <!-- <th style="background:  #ececec;">Bengkel</th> -->
                              <th style="background:  #ececec;">Tanggal</th>
                              <th style="background:  #ececec;">Status Order</th>
                              <th style="background:  #ececec;">Total Tagihan</th>
                              <th class="text-nowrap" style="background:  #ececec;">Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                            $i=1;
                            if (!is_null($orders))
                              foreach ($orders as $or) {
                                ?>
                                <?php if ($or->status_order == 1 || $or->status_order == 2): ?>
                                  <tr>
                                    <td><?php echo $i; ?></td>
                                    <!-- <td class=""><?php echo $or -> id_order; ?></td> -->
                                    <td class=""><?php echo date('d F Y',strtotime($or -> tanggal_order)); ?></td>
                                    <td class="">Rp. <?php echo formatRP($or -> total_pembelian); ?></td>
                                    <td class="">
                                      <?php
                                        if ($or -> status_order == '2') {
                                          echo '<span class="badge badge-lg badge-warning">Validasi '.date("d F Y",strtotime($or -> tanggal_valid)).'</span>';
                                        }else {
                                          echo '<span class="badge badge-lg badge-info">Diproses '.date("d F Y",strtotime($or -> tanggal_diproses)).'</span>';
                                        } 
                                      ?>                           
                                    </td>
                                    <td class="text-nowrap">
                                      <button type="button" class="btn btn-sm btn-icon btn-primary btn-outline" data-toggle="tooltip"
                                        data-original-title="Detail" onclick="detail_account(<?php echo $or->id_order; ?>)">
                                        <i class="icon wb-info-circle" aria-hidden="true"></i>
                                      </button>
                                    </td>
                                  </tr>
                                <?php endif ?>
                            <?php  $i++; } ?>
                          </tbody>
                        </table>
                      </div>
                      <div class="tab-pane" id="exampleTabsTwo" role="tabpanel">
                        <table class="table table-hover dataTable table w-full" >
                          <thead>
                            <tr>
                              <th style="background:  #ececec;">#</th>
                              <!-- <th style="background:  #ececec;">Kode</th> -->
                              <th style="background:  #ececec;">Tanggal Order</th>
                              <th style="background:  #ececec;">Jatuh Tempo</th>
                              <th style="background:  #ececec;">Total Tagihan</th>
                              <th style="background:  #ececec;">Status</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                              $i=1;
                                if (!is_null($tempos))
                                foreach ($tempos as $tg) {
                            ?>
                                <tr>
                                  <td><?php echo $i; ?></td>
                                  <!-- <td class=""><?php echo $tg -> id_order; ?></td> -->
                                  <td class=""><?php echo date("d F Y",strtotime($tg -> tanggal_order)); ?></td>
                                  <td class=""><?php echo date("d F Y",strtotime($tg -> jatuh_tempo)); ?></td>
                                  <td class="">
                                    Rp. <?php echo formatRP($tg -> total_tagihan); ?>
                                  </td>
                                  <td class="">
                                    <?php
                                      if ($tg -> jumpembayaran == $tg -> total_tagihan) {
                                        echo '<span class="badge badge-lg badge-success">Lunas</span>';
                                      } elseif ($tg -> jumpembayaran !=0) {
                                        echo '<span class="badge badge-lg badge-warning">Bayar Sebagian</span>';
                                      } else {
                                        echo '<span class="badge badge-lg badge-danger">Belum Dibayar</span>';
                                      } 
                                    ?>                       
                                  </td>
                                </tr> 
                            <?php  $i++; } ?>
                          </tbody>
                        </table>
                      </div>
                      <div class="tab-pane" id="exampleTabsThree" role="tabpanel">
                        <table class="table table-hover dataTable table w-full" id="exampleTableTools">
                          <thead>
                            <tr>
                              <th class="text-center" style="background:  #ececec;">#</th>
                              <th class="text-center" style="background:  #ececec;">Kode</th>
                              <th class="text-center" style="background:  #ececec;">Nama</th>
                              <th class="text-center" style="background:  #ececec;">Kategori</th>
                              <th class="text-center" style="background:  #ececec;">Stock</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                              $i=1;
                                if (!is_null($stocks))
                                foreach ($stocks as $in) {
                              ?>
                              <tr>
                                <td><?php echo $i; ?></td>
                                <td class=""><?php echo $in -> code_p; ?></td>
                                <td class="">
                                  <?php if ($in -> thumbnail) :?>
                                     <!-- <span class=""> -->
                                      <a class="avatar" href="<?php echo base_url(); ?>assets/images/produk/<?php echo $in -> thumbnail; ?>" target="_blank">
                                        <img class="img-responsive" src="<?php echo base_url(); ?>assets/images/produk/<?php echo $in -> thumbnail; ?>"/>
                                      </a>
                                    <!-- </span> -->
                                    <?php echo $in -> name_p; ?>
                                  <?php else: ?>
                                    <?php echo $in -> name_p; ?>
                                <?php endif; ?>
                                </td>
                                <td class=""><?php echo $in -> name_kp; ?></td>
                                <td class=""><span class="badge badge-lg badge-danger"><?php echo $in -> stock; ?></span></td>
                              </tr> 
                            <?php  $i++; } ?>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- End Example Tabs -->
              </div>
            </div>

            <div class="panel">
          <header class="panel-heading">
            <h3 class="panel-title">Laporan Laba Rugi</h3>
          </header>
          <div class="panel-body">
            <!-- Example Date Range -->

            <form id="formLapPenjualan">
              <div class="row">
                <div class="col-md-6">
                  <label class="form-control-label">Tanggal</label>
                  <div class="input-daterange form-group form-material" data-plugin="datepicker">
                    <div class="input-group">
                      <span class="input-group-addon">
                        <i class="icon wb-calendar" aria-hidden="true"></i>
                      </span>
                        <input type="text" class="form-control" name="start" autocomplete="off" required="required" />
                    </div>
                    <div class="input-group">
                      <span class="input-group-addon">to</span>
                      <input type="text" class="form-control" name="end" autocomplete="off" required="required" />
                    </div>
                  </div>
                  <br>

                </div>
              </div>
              <button type="submit" class="btn btn-primary">Tampilkan</button>
            </form>
          </div>
          <div class="panel-body">
              <div id="tampildata"></div>
          </div>
        </div>
      </div>

      <!-- Modal -->
      <div class="modal fade modal-fade-in-scale-up" id="modal_detail" aria-hidden="true" aria-labelledby="exampleModalTitle" role="dialog" tabindex="-1">
        <!-- ambil html lewat controller -->
      </div>
      <!-- End Modal -->


<script type="text/javascript">
  $('document').ready(function(){
    $('#formLapPenjualan').submit(function(e){
      e.preventDefault()
      $.ajax({
        type: "POST",
        url: '<?php echo site_url('dashboard/lapPenjualanBy') ?>',
        data: $('#formLapPenjualan').serialize(),
        success: function(data){
          $('#tampildata').html(data)
        }
      })
    })
  })

  function detail_account(id)
  {
    // save_method = 'update';
    // $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string

    //Ajax Load data from ajax
    $.ajax({
      url : "<?php echo site_url('ordergudang/detailKeluar')?>/" + id,
      type: "GET",
        // dataType: "JSON",
        success: function(data)
        {

            $('#modal_detail').html(data); // show bootstrap modal when complete loaded
            $('#modal_detail').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Data Detail Order'); // Set title to Bootstrap modal title

          },
          error: function (jqXHR, textStatus, errorThrown)
          {
            alert('Error get data from ajax');
          }
        });
  }

  function detail_pengumuman(id)
    {
        //Ajax Load data from ajax
        $.ajax({
            url : "<?php echo site_url('pengumuman/ajax_detail')?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
                $('#isipengumuman').html(data.pengumuman);
                $('#judul').html(data.judul);
                $('#tanggal').html(data.tanggal);

                $('#modalDetailPengumuman').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title').text('Detail Pengumuman'); // Set title to Bootstrap modal title
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        });
    }
</script>

