<!-- Function -->
<?php 
function formatRP($angka){
 $jadi = number_format($angka,0,',','.');
 return $jadi;
}

function getprevious($jml1,$jml2){
  $previous = (($jml1 - $jml2) / $jml2) * 100;
  return $previous;
}

?>
      <div class="page-header">
        <!-- <h1 class="page-title font-size-26 font-weight-100">Ecommerce Overview</h1> -->
      </div>

      <div class="page-content container-fluid">
       <!-- Panel Table Tools -->
        <div class="panel">
          <!-- <header class="panel-heading">
            <h3 class="panel-title">Table Tools</h3>
          </header> -->
          <div class="panel-body">
            <div class="row">
              <div class="col-md-6">
                <div class="mb-15">
                  <button onclick="addAccount();" href="javascript:void(0);" class="btn btn-outline btn-primary" type="button"><i class="icon wb-plus" aria-hidden="true"></i> Buat Pengumuman
                  </button>
                </div>
              </div>
            </div>
            <div class="table-responsive">
              <table class="table table-hover dataTable table-striped w-full" data-plugin="dataTable">
                <thead>
                  <tr>
                    <th style="background:  #ececec;">#</th>
                    <th style="background: #ececec;">Tanggal</th>
                    <th style="background: #ececec;">Subjek</th>
                    <th style="background: #ececec;">Ke</th>
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
                    <td class=""><?php echo $pg -> jeniskirim; ?></td> 
                    <td class="text-nowrap">
                      <button type="button" class="btn btn-sm btn-icon btn-info btn-outline" data-toggle="tooltip"
                                data-original-title="Detail" onclick="detail_account(<?php echo $pg->id; ?>)">
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

      <!-- Modal Tambah-->
      <div class="modal fade modal-fade-in-scale-up" id="modalBuatPengumuman" aria-hidden="true"
        aria-labelledby="exampleModalTitle" role="dialog" tabindex="-1">
        <div class="modal-dialog modal-simple">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
              <h4 class="modal-title">Tambah Pengumuman</h4>
            </div>
            <div class="modal-body">
              <form autocomplete="off" id="form">
                  <h4 class="example-title">Subjek</h4>
                  <input type="text" name="judul" class="form-control" id="inputPlaceholder" placeholder="isikan subjek pengumuman">
                <!-- Example Textarea -->
                  <h4 class="example-title">Pengumuman</h4>
                  <textarea class="form-control" id="pengumuman" name="pengumuman" rows="8"></textarea>
                <!-- End Example Textarea -->
                <!-- Example Radios -->
                  <h4 class="example-title">Kirim Ke</h4>
                  <div class="radio-custom radio-primary">
                    <input type="radio" id="inputRadiosUnchecked" value="bengkel" name="inputRadios" />
                    <label for="inputRadiosUnchecked">Bengkel</label>
                  </div>
                  <div class="radio-custom radio-primary">
                    <input type="radio" id="inputRadiosUnchecked" value="gudang" name="inputRadios" />
                    <label for="inputRadiosChecked">Gudang</label>
                  </div>
                  <div class="radio-custom radio-primary">
                    <input type="radio" id="inputRadiosChecked" value="all" name="inputRadios" checked />
                    <label for="inputRadiosChecked">Semua</label>
                  </div>
                <!-- End Example Radios -->
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Kirim</button>
            </div>
          </div>
        </div>
      </div>
      <!-- End Modal Tambah-->

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
                      <p id="jeniskirim"></p>
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
                <button type="button" class="btn btn-floating btn-sm btn-primary">
                  <i class="icon wb-shopping-cart"></i>
                </button>
                <span class="ml-15 font-weight-400">ORDER</span>
                <div class="content-text text-center mb-0">  
                    <span class="font-size-30 font-weight-100"><?php echo $jumlahorder->jumorder; ?></span>
                </div>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-md-6 info-panel">
            <div class="card card-shadow">
              <div class="card-block bg-white p-20">
                <button type="button" class="btn btn-floating btn-sm btn-success">
                  <i class="icon fa-dollar"></i>
                </button>
                <span class="ml-15 font-weight-400">PENDAPATAN</span>
                <div class="content-text text-center mb-0">  
                    <span class="font-size-30 font-weight-100"><?php echo formatRP($jumlahpendapatan->pendapatan); ?></span>
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
                    <span class="font-size-30 font-weight-100"><?php echo formatRP($jumlahtagihan->tagihan); ?></span>
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
                <span class="ml-15 font-weight-400">TUNGGAKAN</span>
                <div class="content-text text-center mb-0">
                    <span class="font-size-30 font-weight-100"><?php echo formatRP($jumlahtunggakan->tunggakan); ?></span>
                </div>
              </div>
            </div>
          </div>
          <div class="col-xl-4 col-md-6 info-panel">
            <div class="card card-shadow">
              <div class="card-block bg-white p-20">
                <button type="button" class="btn btn-floating btn-sm btn-dark">
                  <i class="icon fa-university"></i>
                </button>
                <span class="ml-15 font-weight-400">GUDANG</span>
                <div class="content-text text-center mb-0">
                    <span class="font-size-40 font-weight-100"><?php echo $jumlahgudang->gudang; ?></span>
                </div>
              </div>
            </div>
          </div>
          <div class="col-xl-4 col-md-6 info-panel">
            <div class="card card-shadow">
              <div class="card-block bg-white p-20">
                <button type="button" class="btn btn-floating btn-sm btn-info">
                  <i class="icon fa-motorcycle"></i>
                </button>
                <span class="ml-15 font-weight-400">BENGKEL</span>
                <div class="content-text text-center mb-0">
                    <span class="font-size-40 font-weight-100"><?php echo $jumlahbengkel->bengkel; ?></span>
                </div>
              </div>
            </div>
          </div>
          <div class="col-xl-4 col-md-6 info-panel">
            <div class="card card-shadow">
              <div class="card-block bg-white p-20">
                <button type="button" class="btn btn-floating btn-sm btn-default">
                  <i class="icon wb-user"></i>
                </button>
                <span class="ml-15 font-weight-400">CUSTOMERS</span>
                <div class="content-text text-center mb-0">  
                    <span class="font-size-40 font-weight-100"><?php echo $jumlahpelanggan->pelanggan; ?></span>
                </div>
              </div>
            </div>
          </div>
          <!-- End First Row -->

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


  function addAccount()
  {
      $('#form')[0].reset(); // reset form on modals
      $('.form-group').removeClass('has-error'); // clear error class
      $('.help-block').empty(); // clear error string
      $('#modalBuatPengumuman').modal('show'); // show bootstrap modal
      $('.modal-title').text('Tambah Pengumuman'); // Set Title to Bootstrap modal title
  }

  function detail_account(id)
    {
        $('#form')[0].reset(); // reset form on modals
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty(); // clear error string

        //Ajax Load data from ajax
        $.ajax({
            url : "<?php echo site_url('pengumuman/ajax_detail')?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
                $('#isipengumuman').html(data.pengumuman);
                $('#judul').html(data.judul);
                $('#jeniskirim').html(data.jeniskirim);
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

  function save()
  {
      // $('[name="nipy"]').removeAttr("disabled");
      $('#btnSave').text('saving...'); //change button text
      $('#btnSave').attr('disabled',true); //set button disable 
      
      var url;

      url = "<?php echo site_url('pengumuman/add')?>";

      // ajax adding data to database

      $.ajax({
          url : url,
          type: "POST",
          data: new FormData($('#form')[0]),
          contentType: false,
          processData: false,
          dataType: "JSON",
          success: function(data)
          {
            if(data.status) //if success close modal and reload ajax table
            {
                $('#modalBuatPengumuman').modal('hide');

                var alert = `<div class="alert alert-alt alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                    ${data.flash_header} <br><a class="alert-link" style="margin-left: 0" href="javascript:void(0)">${data.flash_desc}</a>
                  </div>`

                  $('.page-header').append(alert)
                  
               location.reload();  

            } else {

              $('#modalBuatPengumuman').modal('hide');

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

</script>
