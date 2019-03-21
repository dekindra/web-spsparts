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
      </div>

      <div class="page-content">
       <!-- Panel Table Tools -->
        <div class="panel">
         <!--  <header class="panel-heading">
            <h3 class="panel-title">Table Tools</h3>
          </header> -->
          <div class="panel-body">
            <div class="text-right">
                <p><span class="badge badge-lg badge-warning"><b>Grand Total : Rp. <?php echo formatRP($totalorder->totalorder) ?></b></span></p>
              </div>
            <!-- <table class="table table-hover dataTable table w-full" data-plugin="dataTable"> -->
            <table class="table table-hover dataTable table w-full" id="exampleTableTools" >
              <thead>
                <tr>
                  <th style="background:  #ececec;">#</th>
                  <!-- <th style="background:  #ececec;">Kode</th> -->
                  <th style="background:  #ececec;">Tanggal Order</th>
                  <th style="background:  #ececec;">Gudang</th>
                  <th style="background:  #ececec;">Total Pembelian</th>
                  <th style="background:  #ececec;">Status</th>
                  <th class="text-nowrap" style="background:  #ececec;">Action</th>
                </tr>
              </thead>
              <tbody>
                <!-- <tr>
                  <td>0706001</td>
                  <td>2018-06-07</td>
                  <td>Smksw Jaya</td>
                  <td>300000</td>
                  <td><span class="badge badge-warning">Dikirim</span></td>
                  <td><span class="badge badge-warning">Belom Lunas</span></td>
                  <td class="text-nowrap">
                    <button type="button" class="btn btn-sm btn-icon btn-flat btn-default" data-toggle="tooltip"
                              data-original-title="Detail">
                              <i class="icon wb-info-circle" aria-hidden="true"></i>
                    </button>
                    <button type="button" class="btn btn-sm btn-icon btn-flat btn-default" data-toggle="tooltip"
                              data-original-title="Terima Order">
                              <i class="icon wb-check" aria-hidden="true"></i>
                    </button>
                    <button type="button" class="btn btn-sm btn-icon btn-flat btn-default" data-toggle="tooltip"
                              data-original-title="Lunas Pembayaran">
                              <i class="icon wb-thumb-up" aria-hidden="true"></i>
                    </button>
                  </td>
                </tr> -->
                <?php 
                  $i=1;
                  if (!is_null($ordermasuks))
                    foreach ($ordermasuks as $om) {
                 ?>
                  <tr>
                    <td><?php echo $i; ?></td>
                    <!-- <td class=""><?php echo $om -> id_order; ?></td> -->
                    <td class=""><?php echo date('d F Y',strtotime($om -> tanggal_order)); ?></td>
                    <td class=""><?php echo $om -> name; ?></td>
                    <td class="">Rp. <?php echo formatRP($om -> total_pembelian); ?></td>
                    <td class="">
                    <?php
                      if ($om -> status_order == '3') {
                        echo '<span class="badge badge-lg badge-success">Selesai '.date("d F Y",strtotime($om -> tanggal_selesai)).'</span>';
                      }elseif ($om -> status_order == '2') {
                        echo '<span class="badge badge-lg badge-warning">Validasi '.date("d F Y",strtotime($om -> tanggal_valid)).'</span>';
                      }elseif ($om -> status_order == '1') {
                        echo '<span class="badge badge-lg badge-info">Diproses '.date("d F Y",strtotime($om -> tanggal_diproses)).'</span>';
                      }else {
                        echo '<span class="badge badge-lg badge-dark">Menunggu</span>';
                      } 
                    ?>                           
                    </td>
                    <!-- <td class=""><?php echo $om -> status_order; ?></td> -->
                    <td class="text-nowrap">
                      <button type="button" class="btn btn-sm btn-icon btn-primary btn-outline" data-toggle="tooltip"
                                data-original-title="Detail" onclick="detail_account(<?php echo $om->id_order; ?>)">
                                <i class="icon wb-info-circle" aria-hidden="true"></i>
                      </button>
                      <div class="btn-group" role="group">
                        <button type="button" class="btn  btn-sm btn-warning dropdown-toggle" id="exampleIconDropdown2"
                          data-toggle="dropdown" aria-expanded="false">
                          <i class="icon wb-edit" aria-hidden="true"></i>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="exampleIconDropdown2" role="menu">
                          <a class="dropdown-item" href="javascript:void(0)" onclick="prosesOrder(<?php echo $om->id_order; ?>)" role="menuitem">Diproses</a>
                          <a class="dropdown-item" href="javascript:void(0)" onclick="validOrder(<?php echo $om->id_order; ?>)" role="menuitem">Valid Order</a>
                          <a class="dropdown-item" href="javascript:void(0)" onclick="selesaiOrder(<?php echo $om->id_order; ?>)" role="menuitem">Selesai</a>
                        </div>
                      </div>
                      <!--  <?php if ($om -> status_order == 2): ?>
                      <button type="button" class="btn btn-sm btn-icon btn-flat btn-default" data-toggle="tooltip"
                                data-original-title="Terima Order" onclick="terimaOrder(<?php echo $om->id_order; ?>)">
                                <i class="icon wb-check" aria-hidden="true"></i>
                      </button>
                      <?php endif ?>
                      <?php if ($om -> status_order == 3): ?>
                        <button type="button" class="btn btn-sm btn-icon btn-flat btn-default" data-toggle="tooltip"
                                data-original-title="Lunas Pembayaran" onclick="lunas(<?php echo $om->id_order; ?>)">
                                <i class="icon wb-thumb-up" aria-hidden="true"></i>
                      </button>
                      <button type="button" class="btn btn-sm btn-icon btn-flat btn-default" data-toggle="tooltip"
                                data-original-title="Lunas Pembayaran" onclick="lunassupplier(<?php echo $om->id_order; ?>)">
                                <i class="icon wb-plus" aria-hidden="true"></i>
                      </button>
                      <?php endif ?> -->
                      
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
                    <h3 class="panel-title">Laporan Order</h3>
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
                          <div class="form-group form-material floating" data-plugin="formMaterial">
                            <select class="form-control" name="status">
                              <option value="all">Semua</option>
                              <option value="0">Menunggu</option>
                              <option value="1">Diproses</option>
                              <option value="2">Validasi</option>
                              <option value="3">Selesai</option>
                            </select>
                            <label class="floating-label">Status Order</label>
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
      </div>

<!-- Modal -->
      <div class="modal fade modal-fade-in-scale-up" id="addUserForm" aria-hidden="true" aria-labelledby="exampleModalTitle" role="dialog" tabindex="-1">
        <!-- ambil html lewat controller -->
      </div>
      <!-- End Modal -->



<script type="text/javascript">

function prosesOrder(id)
{
    // $('[name="nipy"]').removeAttr("disabled");
    $('#btnSave').text('saving...'); //change button text
    $('#btnSave').attr('disabled',true); //set button disable 
    var url;

    url = "<?php echo site_url('orderadmin/prosesOrderMasuk')?>/" + id;

    // ajax adding data to database

    // var formData = new FormData($('#form')[0]);
    $.ajax({
        url : url,
        type: "POST",
        // data: formData,
        contentType: false,
        processData: false,
        dataType: "JSON",
        success: function(data)
        {

            if(data.status) //if success close modal and reload ajax table
            {
                $('#addUserForm').modal('hide');

                var alert = `<div class="alert alert-alt alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                    ${data.flash_header} <br><a class="alert-link" style="margin-left: 0" href="javascript:void(0)">${data.flash_desc}</a>
                  </div>`

                  $('.page-header').append(alert)
                  
               location.reload();  



            } else {

              $('#addUserForm').modal('hide');

               var alertgagal = `<div class="alert alert-alt alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                    ${data.flash_header} <br><a class="alert-link" style="margin-left: 0" href="javascript:void(0)">${data.flash_desc}</a>
                  </div>`

                  $('.page-header').append(alertgagal)
            }


            $('#btnSave').text('save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable 


        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error adding / update data');
            $('#btnSave').text('save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable 

        }
    });
}

function validOrder(id)
{
    // $('[name="nipy"]').removeAttr("disabled");
    $('#btnSave').text('saving...'); //change button text
    $('#btnSave').attr('disabled',true); //set button disable 
    var url;

    url = "<?php echo site_url('orderadmin/validOrderMasuk')?>/" + id;

    // ajax adding data to database

    // var formData = new FormData($('#form')[0]);
    $.ajax({
        url : url,
        type: "POST",
        // data: formData,
        contentType: false,
        processData: false,
        dataType: "JSON",
        success: function(data)
        {

            if(data.status) //if success close modal and reload ajax table
            {
                $('#addUserForm').modal('hide');

                var alert = `<div class="alert alert-alt alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                    ${data.flash_header} <br><a class="alert-link" style="margin-left: 0" href="javascript:void(0)">${data.flash_desc}</a>
                  </div>`

                  $('.page-header').append(alert)
                  
               location.reload();  



            } else {

              $('#addUserForm').modal('hide');

               var alertgagal = `<div class="alert alert-alt alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                    ${data.flash_header} <br><a class="alert-link" style="margin-left: 0" href="javascript:void(0)">${data.flash_desc}</a>
                  </div>`

                  $('.page-header').append(alertgagal)
            }


            $('#btnSave').text('save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable 


        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error adding / update data');
            $('#btnSave').text('save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable 

        }
    });
}

function detail_account(id)
{
    // save_method = 'update';
    // $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string

    //Ajax Load data from ajax
    $.ajax({
        url : "<?php echo site_url('orderadmin/detailMasuk')?>/" + id,
        type: "GET",
        // dataType: "JSON",
        success: function(data)
        {

            $('#addUserForm').html(data); // show bootstrap modal when complete loaded
            $('#addUserForm').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Data Detail Order'); // Set title to Bootstrap modal title

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
          url: '<?php echo site_url('orderadmin/lapOrderBy') ?>',
          data: $('#formLapPenjualan').serialize(),
          success: function(data){
            $('#tampiltable').html(data)
          }
        })
      })
    })



</script>