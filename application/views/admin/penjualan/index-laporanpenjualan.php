 <!-- Function -->
<?php 
function formatRP($angka){
 $jadi = number_format($angka,0,',','.');
 return $jadi;
}

?>
      <div class="page-header">
        <h1 class="page-title"><?php  echo $title ?></h1>
        <!-- <div class="page-header-actions">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="../index.html">Home</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0)">Tables</a></li>
            <li class="breadcrumb-item active">Basic</li>
          </ol>
        </div> -->
        <?php
              $alert_msg = $this->session->flashdata('alert_msg');
                  if (!empty($alert_msg)) {
                    $flash_status = $alert_msg[0];
                    $flash_header = $alert_msg[1];
                    $flash_desc = $alert_msg[2];

                    if ($flash_status == 'failure') {
                ?>
                    <div class="alert alert-alt alert-danger alert-dismissible" style="text-align: left;" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                      <?php echo $flash_header; ?><br><a class="alert-link" style="margin-left: 0" href="javascript:void(0)"><?php echo $flash_desc; ?></a>
                    </div>
                <?php 
                    }
                    if ($flash_status == 'success') {
                ?>
                    <div class="alert alert-alt alert-success alert-dismissible" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                      <?php echo $flash_header; ?>, <a class="alert-link" style="margin-left: 0" href="javascript:void(0)"><?php echo $flash_desc; ?></a>
                    </div>
                <?php
                    }
                  }
                ?>
      </div>

      <div class="page-content">
       <!-- Panel Table Tools -->
        <div class="panel">
          <!-- <header class="panel-heading">
            <div class="row"> 
              <div class="col-6"> 
                <h3 class="panel-title">Daftar Penjualan</h3>
              </div>
              <div class="col-6"> 
                <div class="text-right">
                  <p><span class="badge badge-lg badge-warning"><b>Grand Total : Rp. </b></span></p>
                </div>
              </div>
            </div>
          </header> -->
          <div class="panel-body">
            <div class="row"> 
              <div class="col-md-6"> 
                <h4>Daftar Penjualan</h4>
              </div>
              <div class="col-md-6"> 
                <div class="text-right">
                  <p><span class="badge badge-lg badge-warning"><b>Grand Total : Rp. <?php echo formatRP($totalpenjualan->totalpenjualan) ?></b></span></p>
                </div>
              </div>
            </div>
            <table class="table table-hover dataTable table w-full" id="exampleTableTools" >
              <thead>
                <tr>
                  <!-- <th>#</th> -->
                  <th style="background:  #ececec;">#</th>
                  <!-- <th style="background:  #ececec;">Bengkel</th> -->
                  <th style="background:  #ececec;">Pelanggan</th>
                  <th style="background:  #ececec;">Tanggal</th>
                  <th style="background:  #ececec;">Total Tagihan</th>
                  <th style="background:  #ececec;">Diskon</th>
                  <th class="text-nowrap" style="background:  #ececec;">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  $i=1;
                    if (!is_null($penjualans))
                    foreach ($penjualans as $pj) {
                ?>
                    <tr>
                      <td><?php echo $i; ?></td>
                      <!-- <td class=""><?php echo $pj -> name; ?></td> -->
                      <td class=""><?php echo $pj -> nama; ?></td>
                      <td class=""><?php echo date("d-m-Y",strtotime($pj -> created_datetime)); ?></td>
                      <td class="">Rp. <?php echo formatRP($pj -> total); ?></td>
                      <td class="">Rp. <?php echo formatRP($pj -> diskon); ?></td>
                      <td class="text-nowrap">
                        <!-- <button type="button" class="btn btn-sm btn-icon btn-info btn-outline" data-toggle="tooltip"
                              data-original-title="Detail">
                              <i class="icon wb-info-circle" aria-hidden="true"></i>
                        </button> -->
                         <button class="btn btn-sm btn-icon btn-info btn-outline" onclick="detail_account(<?php echo $pj->id_penjualan; ?>)" data-content="Melihat rincian tagihan" data-trigger="hover" data-toggle="popover" data-original-title="Lihat Detail" tabindex="0" title="" type="button">
                          <i class="icon wb-info-circle" aria-hidden="true"></i>
                        </button>
                      </td>
                    </tr> 
                <?php  $i++; } ?>
              </tbody>
            </table>
          </div>
        </div>
        <!-- End Panel Table Tools -->

        <div class="panel">
          <header class="panel-heading">
            <h3 class="panel-title">Laporan Penjualan</h3>
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

                
                  <!-- End Example Date Range -->
                 <!--  <div class="form-group form-material floating" data-plugin="formMaterial">
                                 <div class="input-group">
                                    <input type="text" class="form-control" data-plugin="datepicker">
                                    <label class="floating-label">Berlaku Sampai</label>
                                  </div>
                                </div> -->
                  <div class="form-group form-material floating" data-plugin="formMaterial">
                    <select class="form-control" name="pelanggan">
                      <option value="all">Semua</option>
                      <?php foreach ($pelanggans as $plg) { ?>
                        <option value="<?php echo $plg->id; ?>"><?php echo $plg->nama; ?></option>
                      <?php } ?>
                    </select>
                    <label class="floating-label">Pelanggan</label>
                  </div>
                </div>
              </div>
              <button type="submit" class="btn btn-primary">Tampilkan</button>
            </form>
          </div>
          <div class="panel-body">
              <div id="tampiltable"></div>
          </div>
        </div>
        <!-- End Panel Table Tools -->

      </div>

      <!-- Modal -->
      <div class="modal fade modal-fade-in-scale-up" id="modal_detail" aria-hidden="true" aria-labelledby="exampleModalTitle" role="dialog" tabindex="-1">
        <!-- ambil html lewat controller -->
      </div>
      <!-- End Modal -->

<script type="text/javascript">

function detail_account(id)
{
    // save_method = 'update';
    // $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string

    //Ajax Load data from ajax
    $.ajax({
        url : "<?php echo site_url('penjualan/detail')?>/" + id,
        type: "GET",
        // dataType: "JSON",
        success: function(data)
        {

            $('#modal_detail').html(data); // show bootstrap modal when complete loaded
            $('#modal_detail').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Data Detail Penjualan'); // Set title to Bootstrap modal title

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}

$('document').ready(function(){
    $('#formLapPenjualan').submit(function(e){
      e.preventDefault()
      $.ajax({
        type: "POST",
        url: '<?php echo site_url('penjualan/lapPenjualanBy') ?>',
        data: $('#formLapPenjualan').serialize(),
        success: function(data){
          $('#tampiltable').html(data)
        }
      })
    })
  })

</script>