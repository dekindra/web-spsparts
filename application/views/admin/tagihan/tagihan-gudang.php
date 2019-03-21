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
         <!--  <header class="panel-heading">
            <h3 class="panel-title">Table Tools</h3>
          </header> -->
          <div class="panel-body">
            <!-- <div class="row">
              <div class="col-md-6">
                <div class="mb-15">
                  <button  class="btn btn-outline btn-primary" data-target="#exampleNiftyFadeScale"
                      data-toggle="modal" type="button"><i class="icon wb-plus" aria-hidden="true"></i> Tambah
                  </button>
                </div>
              </div> -->
                    <!-- Modal -->
                    <!-- <div class="modal fade modal-fade-in-scale-up" id="exampleNiftyFadeScale" aria-hidden="true"
                      aria-labelledby="exampleModalTitle" role="dialog" tabindex="-1">
                      <div class="modal-dialog modal-simple modal-lg">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">×</span>
                            </button>
                            <h4 class="modal-title">Buat Return</h4>
                          </div>
                          <div class="modal-body"> -->
                            <!-- <form autocomplete="off">
                              <div class="form-group form-material floating has-danger" data-plugin="formMaterial">
                                <input type="text" class="form-control" name="kode" data-hint="Masukkan Kode Barang"
                                />
                                <label class="floating-label">Kode</label>
                              </div>
                              <div class="form-group form-material floating has-danger" data-plugin="formMaterial">
                                <input type="text" class="form-control" name="nama" data-hint="Masukkan Nama Barang"
                                />
                                <label class="floating-label">Nama</label>
                              </div>
                              <div class="form-group form-material floating" data-plugin="formMaterial">
                                <select class="form-control">
                                  <option>&nbsp;</option>
                                  <option>1</option>
                                  <option>2</option>
                                  <option>3</option>
                                  <option>4</option>
                                  <option>5</option>
                                </select>
                                <label class="floating-label">Kategori</label>
                              </div>
                              <div class="form-group form-material floating" data-plugin="formMaterial">
                                <div class="input-group">
                                  <span class="input-group-addon">Rp.</span>
                                  <div class="form-control-wrap">
                                    <input type="text" class="form-control" name="beli" data-hint="Masukkan Harga Beli Barang" />
                                    <label class="floating-label">Harga Beli</label>
                                  </div>
                                </div>
                              </div>
                              <div class="form-group form-material floating" data-plugin="formMaterial">
                                <div class="input-group">
                                  <span class="input-group-addon">Rp.</span>
                                  <div class="form-control-wrap">
                                    <input type="text" class="form-control" name="jual" data-hint="Masukkan Harga Jual Barang" />
                                    <label class="floating-label">Harga Jual</label>
                                  </div>
                                </div>
                              </div>
                              <div class="form-group form-material floating" data-plugin="formMaterial">
                                <input type="text" class="form-control" readonly="" />
                                <input type="file" name="inputFloatingFile" multiple="" />
                                <label class="floating-label">Browse..</label>
                              </div>
                            </form> -->
                           <!--  <form autocomplete="off">
                              <div class="row">
                                
                                <div class="col-md-6"> -->
                                  <!-- Panel Static Labels -->
                                  <!-- <div class="panel"> -->
                                    <!-- <div class="panel-heading">
                                      <h3 class="panel-title">Static Labels</h3>
                                    </div> -->
                                    <!-- <div class="panel-body container-fluid"> -->
                                      <!-- <form autocomplete="off"> -->
                                       <!--  <div class="form-group form-material floating" data-plugin="formMaterial">
                                                  <select class="form-control">
                                            <option>&nbsp;</option>
                                            <option>1</option>
                                            <option>2</option>
                                            <option>3</option>
                                            <option>4</option>
                                            <option>5</option>
                                          </select>
                                          <label class="floating-label">Supplier</label>
                                        </div> -->
                                        <!-- <div class="form-group form-material floating" data-plugin="formMaterial">
                                                     <div class="input-group">
                                                        <input type="text" class="form-control" data-plugin="datepicker">
                                                        <label class="floating-label">Tanggal</label>
                                                      </div>
                                                    </div> -->
                                      <!-- </form> -->
                                    <!-- </div> -->
                                  <!-- </div> -->
                                  <!-- End Panel Static Labels -->
                               <!--  </div>
                                <div class="col-md-6"> -->
                                  <!-- Panel Floating Labels -->
                                  <!-- <div class="panel"> -->
                                    <!-- <div class="panel-heading">
                                      <h3 class="panel-title">Total</h3>
                                    </div> -->
                                    <!-- <div class="panel-body container-fluid"> -->
                                        <!-- <div class="form-group form-material floating" data-plugin="formMaterial">
                                          <div class="input-group">
                                            <span class="input-group-addon">Rp</span>
                                            <div class="form-control-wrap">
                                              <input type="text" class="form-control" />
                                              <label class="floating-label">Total Return</label>
                                            </div>
                                          </div>
                                        </div> -->
                                    <!-- </div> -->
                                  <!-- </div> -->
                                  <!-- End Panel Floating Labels -->
                               <!--  </div>
                              </div> -->
                               <!-- Panel Table Tools -->
                              <!-- <div class="panel"> -->
                                <!-- <header class="panel-heading">
                                  <h3 class="panel-title">Tambah Return</h3>
                                </header> -->
                                <!-- <div class="panel-body"> -->
                                  <!-- <div class="table-responsive">
                                  <table class="table table-hover" id="cart">
                                    <thead>
                                      <tr>
                                        <th>#</th>
                                        <th>Barang</th>
                                        <th>Harga</th>
                                        <th>Qty</th>
                                        <th>Sub Total</th>
                                        <th class="text-nowrap">&nbsp;</th>
                                      </tr>
                                      <tbody> -->
                                                  <!-- Dynamic -->
                                      <!-- </tbody>
                                    </thead>
                                  </table>
                                </div> -->
                                  <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Tambah</button>
                                  <button type="button" class="btn btn-primary">Simpan</button> -->
                                <!-- </div> -->
                              <!-- </div> -->
                            <!-- </form>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" id="tambah">Tambah</button>
                            <button type="button" class="btn btn-primary">Simpan</button>
                          </div>
                        </div>
                      </div>
                    </div> -->
                    <!-- End Modal -->
            <!-- </div> -->
            <!-- <table class="table table-hover dataTable table w-full" data-plugin="dataTable"> -->
            <table class="table table-hover dataTable table w-full" id="exampleTableTools" >
              <thead>
                <tr>
                  <th style="background:  #ececec;">#</th>
                  <!-- <th style="background:  #ececec;">Kode</th> -->
                  <th style="background:  #ececec;">Gudang</th>
                  <th style="background:  #ececec;">Tanggal Order</th>
                  <th style="background:  #ececec;">Jatuh Tempo</th>
                  <th style="background:  #ececec;">Total Tagihan</th>
                  <th style="background:  #ececec;">Status</th>
                  <th class="text-nowrap" style="background:  #ececec;">Action</th>
                </tr>
              </thead>
              <tbody>
                <!-- <tr>
                  <td>0706001</td>
                  <td>Smksw Jaya</td>
                  <td>2018-06-07</td>
                  <td>2018-06-21</td>
                  <td>300000</td>
                  <td><span class="badge badge-lg badge-warning">Belum Dibayar</span></td>
                  <td class="text-nowrap">
                    <button type="button" class="btn btn-sm btn-icon btn-info btn-outline" data-toggle="tooltip"
                              data-original-title="Detail">
                              <i class="icon wb-info-circle" aria-hidden="true"></i>
                    </button>
                    <button type="button" class="btn btn-sm btn-icon btn-success btn-outline" data-toggle="tooltip"
                              data-original-title="Terima Return">
                              <i class="icon wb-check" aria-hidden="true"></i>
                    </button>
                    <button type="button" class="btn btn-sm btn-icon btn-flat btn-default" data-toggle="tooltip"
                              data-original-title="Lunas Pembayaran">
                              <i class="icon wb-thumb-up" aria-hidden="true"></i>
                    </button>
                  </td>
                </tr>
                <tr>
                  <td>0705001</td>
                  <td>Smksw Jaya</td>
                  <td>2018-05-3</td>
                  <td>2018-05-17</td>
                  <td>200000</td>
                  <td><span class="badge badge-lg badge-success">Lunas</span></td>
                  <td class="text-nowrap">
                    <button type="button" class="btn btn-sm btn-icon btn-info btn-outline" data-toggle="tooltip"
                              data-original-title="Detail">
                              <i class="icon wb-info-circle" aria-hidden="true"></i>
                    </button>
                    <button type="button" class="btn btn-sm btn-icon btn-danger btn-outline" data-toggle="tooltip"
                              data-original-title="Terima Return">
                              <i class="icon wb-reply" aria-hidden="true"></i>
                    </button>
                    <button type="button" class="btn btn-sm btn-icon btn-flat btn-default" data-toggle="tooltip"
                              data-original-title="Lunas Pembayaran">
                              <i class="icon wb-thumb-up" aria-hidden="true"></i>
                    </button>
                  </td>
                </tr> -->
                <?php
                  $i=1;
                    if (!is_null($tagihans))
                    foreach ($tagihans as $tg) {
                ?>
                    <tr>
                      <td><?php echo $i; ?></td>
                      <!-- <td class=""><?php echo $tg -> id_order; ?></td> -->
                      <td class=""><?php echo $tg -> name; ?></td>
                      <td class=""><?php echo date("d F Y",strtotime($tg -> tanggal_order)); ?></td>
                      <td class=""><?php echo date("d F Y",strtotime($tg -> jatuh_tempo)); ?></td>
                      <td class=""><?php echo $tg -> total_tagihan; ?></td>
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
                      <td class="text-nowrap">
                        <!-- <button type="button" class="btn btn-sm btn-icon btn-info btn-outline" data-toggle="tooltip"
                              data-original-title="Detail">
                              <i class="icon wb-info-circle" aria-hidden="true"></i>
                        </button> -->
                         <button class="btn btn-sm btn-icon btn-info btn-outline" onclick="detail_account(<?php echo $tg->id_order; ?>)" data-content="Melihat rincian tagihan" data-trigger="hover" data-toggle="popover" data-original-title="Lihat Detail" tabindex="0" title="" type="button">
                          <i class="icon wb-info-circle" aria-hidden="true"></i>
                        </button>
                        <button class="btn btn-sm btn-icon btn-warning btn-outline" onclick="validasibukti(<?php echo $tg->id_order; ?>)" data-content="Melihat daftar cicilan" data-trigger="hover" data-toggle="popover" data-original-title="Lunas" tabindex="0" title="" type="button">
                        <i class="icon wb-edit" aria-hidden="true"></i>
                        </button>
                      </td>
                    </tr> 
                <?php  $i++; } ?>
              </tbody>
            </table>
          </div>
        </div>
        <!-- End Panel Table Tools -->
      </div>

      <!-- Modal -->
      <div class="modal fade modal-fade-in-scale-up" id="modal_detail" aria-hidden="true" aria-labelledby="exampleModalTitle" role="dialog" tabindex="-1">
        <!-- ambil html lewat controller -->
      </div>
      <!-- End Modal -->

      <!-- Modal Upload Bukti -->
    <div class="modal fade modal-fade-in-scale-up" id="exampleNiftyFadeScale" aria-hidden="true"
      aria-labelledby="exampleModalTitle" role="dialog" tabindex="-1">
      <div class="modal-dialog modal-simple">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
            <h4 class="modal-title">Tambah Pembayaran</h4>
          </div>
          <div class="modal-body">
            <form autocomplete="off" id="form">
              <input type="hidden" name="id" value="">
            </form>
            <table class="table table-hover dataTable table w-full" id="rincian-pembayaran-table">
              <thead>
                <tr>
                  <th style="background:  #ececec;">#</th>
                  <!-- <th style="background:  #ececec;">Kode</th> -->
                  <th style="background:  #ececec;">Tanggal Pembayaran</th>
                  <th style="background:  #ececec;">Nominal Pembayaran</th>
                  <th style="background:  #ececec;">Nota</th>
                  <th style="background:  #ececec;">Status Cicilan</th>
                  <th class="text-nowrap" style="background:  #ececec;">Action</th>
                </tr>
              </thead>
              <tbody>
                <!-- data diambil dari template javascript function uploadbukti-->
                
              </tbody>
            </table>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
    <!-- End Modal -->


<script type="text/javascript">

$('#exampleNiftyFadeScale').on('hidden.bs.modal', function (e) {
    $("#rincian-pembayaran-table tbody tr").remove(); 
  })

  function validasibukti(id)
{
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string

    //Ajax Load data from ajax
    $.ajax({
        url : "<?php echo site_url('tunggakanbengkel/getvalidasibukti')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            $('[name="id"]').val(data.data.id_order);

            $('#exampleNiftyFadeScale').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Bukti Pembayaran'); // Set title to Bootstrap modal title


            data.rincian_pembayaran.forEach(function(item, index) {

              var rowTemplate = `
                <tr id="pembayaran-${item.id}">
                  <td>${index+1}</td>
                  <td>${new Date(item.tanggal_pembayaran).toDateString()}</td>
                  <td>${item.nominal}</td>
                  <td>
                    <a href="<?php echo base_url(); ?>assets/images/tagihan/${item.nota}" target="_blank">
                    <img src="<?php echo base_url(); ?>assets/images/tagihan/${item.nota}" width="40px">
                  </td>

                  <td>
                    ${item.status == 1 ? 
                    `<span class="badge badge-lg badge-success">Diterima</span>                          
                    ` : `
                      <span class="badge badge-lg badge-dark">Menunggu</span>                          
                    `}
                  </td>
                  <td>
                  ${item.status == 1 ? 
                    `<button type="button" class="btn btn-sm btn-icon btn-warning btn-outline" data-toggle="tooltip"
                                  data-original-title="Validasi" onclick="batalvalidasi(${item.id})">
                                  <i class="icon wb-reply" aria-hidden="true"></i>
                    </button>
                    `
                    :

                    `<button type="button" class="btn btn-sm btn-icon btn-success btn-outline" data-toggle="tooltip"
                                  data-original-title="Validasi" onclick="validasi(${item.id})">
                                  <i class="icon wb-check" aria-hidden="true"></i>
                    </button>
                    `
                  }
                  </td>
                </tr>
                `;

              $('#rincian-pembayaran-table tbody').append(rowTemplate);
            })
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}

function validasi(id)
{
    // $('[name="nipy"]').removeAttr("disabled");
    $('#btnSave').text('saving...'); //change button text
    $('#btnSave').attr('disabled',true); //set button disable 
    var url;

    url = "<?php echo site_url('tunggakanbengkel/validasibukti')?>/" + id;

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
                // reload_table();
                location.reload();
            }
            else
            {
                for (var i = 0; i < data.inputerror.length; i++) 
                {
                    $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                    $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
                }
            }
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error adding / update data');
        }
    });
}

function batalvalidasi(id)
{
    // $('[name="nipy"]').removeAttr("disabled");
    $('#btnSave').text('saving...'); //change button text
    $('#btnSave').attr('disabled',true); //set button disable 
    var url;

    url = "<?php echo site_url('tunggakanbengkel/batalvalidasibukti')?>/" + id;

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
                // reload_table();
                location.reload();
            }
            else
            {
                for (var i = 0; i < data.inputerror.length; i++) 
                {
                    $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                    $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
                }
            }
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error adding / update data');
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
        url : "<?php echo site_url('tagihangudang/detail')?>/" + id,
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

</script>