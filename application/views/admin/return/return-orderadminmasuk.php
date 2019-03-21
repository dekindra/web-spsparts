<!-- JQUERY CORE -->
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<!-- JQUERY UI -->
<link href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" rel="stylesheet">
<!-- CHART JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.js"></script>

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
                <p><span class="badge badge-lg badge-warning"><b>Grand Total : Rp. <?php echo formatRP($totalreturn->totalreturn) ?></b></span></p>
              </div>

<!-- <table class="table table-hover dataTable table w-full" data-plugin="dataTable" > -->
  <table class="table table-hover dataTable table w-full" id="exampleTableTools" >
    <thead>
      <tr>
        <th style="background:  #ececec;">#</th>
        <!-- <th style="background:  #ececec;">Kode</th> -->
        <th style="background:  #ececec;">Tanggal</th>
        <th style="background:  #ececec;">Total Return</th>
        <th style="background:  #ececec;">Status Return</th>
        <th class="text-nowrap" style="background:  #ececec;">Action</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $i=1;
      if (!is_null($returns))
        foreach ($returns as $or) {
          ?>
          <tr>
            <td><?php echo $i; ?></td>
            <!-- <td class=""><?php echo $or -> id_retur; ?></td> -->
            <td class=""><?php echo date('d F Y',strtotime($or -> created_datetime)); ?></td>
            <td class="">Rp. <?php echo formatRP($or -> total_retur); ?></td>
            <td class="">
              <?php
              if ($or -> status_retur == '1') {
                echo '<span class="badge badge-lg badge-success">Diterima</span>';
              }else {
                echo '<span class="badge badge-lg badge-dark">Menunggu</span>';
              } 
              ?>                          
            </td>
            <td class="text-nowrap">
              <button type="button" class="btn btn-sm btn-icon btn-primary btn-outline" data-toggle="tooltip"
              data-original-title="Detail" onclick="detail_account(<?php echo $or->id_retur; ?>)">
              <i class="icon wb-info-circle" aria-hidden="true"></i>
              </button>
              <?php if ($or -> status_retur == 0): ?>
                <button type="button" class="btn btn-sm btn-icon btn-success btn-outline" data-toggle="tooltip"
                data-original-title="Delete" onclick="diterima_account(<?php echo $or->id_retur; ?>)">
                <i class="icon wb-check" aria-hidden="true"></i>
                </button>
              <?php endif ?>
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
                <option value="1">Diterima</option>
              </select>
              <label class="floating-label">Status Return</label>
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
  <div class="modal fade modal-fade-in-scale-up" id="modal_detail" aria-hidden="true"
  aria-labelledby="exampleModalTitle" role="dialog" tabindex="-1">

</div>
<!-- End Modal -->

<!-- JQUERY UI -->
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>

<script>

  function diterima_account(id)
  {
    // $('[name="nipy"]').removeAttr("disabled");
    $('#btnSave').text('saving...'); //change button text
    $('#btnSave').attr('disabled',true); //set button disable 
    var url;

    url = "<?php echo site_url('returnadmin/diterima')?>/" + id;

    // ajax adding data to database

    var formData = new FormData($('#form')[0]);
    $.ajax({
      url : url,
      type: "POST",
      data: formData,
      contentType: false,
      processData: false,
      dataType: "JSON",
      success: function(data)
      {

            if(data.status) //if success close modal and reload ajax table
            {
                $('#exampleNiftyFadeScale').modal('hide');

                var alert = `<div class="alert alert-alt alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                    ${data.flash_header} <br><a class="alert-link" style="margin-left: 0" href="javascript:void(0)">${data.flash_desc}</a>
                  </div>`

                  $('.page-header').append(alert)
                  
               location.reload();  

            } else {

              $('#exampleNiftyFadeScale').modal('hide');

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
            // location.reload();
            alert('eror')
          }
        });
  }

  function detail_account(id)
  {

    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string

    //Ajax Load data from ajax
    $.ajax({
      url : "<?php echo site_url('returnadmin/ajax_editmasuk')?>/" + id,
      type: "GET",
        // dataType: "JSON",
        success: function(data)
        {

            $('#modal_detail').html(data); // show bootstrap modal when complete loaded
            $('#modal_detail').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Data Detail Return'); // Set title to Bootstrap modal title

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
        url: '<?php echo site_url('returnadmin/lapReturnBy') ?>',
        data: $('#formLapPenjualan').serialize(),
        success: function(data){
          $('#tampiltable').html(data)
        }
      })
    })
  })



  </script>

