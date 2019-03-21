<!-- Function -->
<?php 
function formatRP($angka){
 $jadi = number_format($angka,0,',','.');
 return $jadi;
}

?>

      <div class="page-header">
        <h1 class="page-title"><?php  echo $title ?></h1>
       <!--  <div class="page-header-actions">
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
          <!-- <header class="panel-heading">
            <h3 class="panel-title">Table Tools</h3>
          </header> -->
          <div class="panel-body">
            <div class="row">
              <div class="col-md-6">
                <div class="mb-15">
                  <button onclick="addAccount();" href="javascript:void(0);" class="btn btn-outline btn-primary" type="button"><i class="icon wb-plus" aria-hidden="true"></i> Tambah
                  </button>
                </div>
              </div>
              <div class="col-md-6"> 
                <div class="text-right">
                  <p><span class="badge badge-lg badge-warning"><b>Grand Total : Rp. <?php echo formatRP($totalpengeluaran->totalpengeluaran) ?></b></span></p>
                </div>
              </div>
            </div>
            <table class="table table-hover dataTable table w-full" id="exampleTableTools">
              <thead>
                <tr>
                  <th style="background:  #ececec;">Kode</th>
                  <th style="background:  #ececec;">Kategori</th>
                  <th style="background:  #ececec;">Keterangan</th>
                  <th style="background:  #ececec;">Nominal</th>
                  <th style="background:  #ececec;">Tanggal</th>
                  <th class="text-nowrap" style="background:  #ececec;">Action</th>
                </tr>
              </thead>
              <tbody>
                <!-- <tr>
                  <td>B001</td>
                  <td>Listrik</td>
                  <td>Listrik Bulan mei</td>
                  <td>35000</td>
                  <td>2018/05/05</td>
                  <td class="text-nowrap">
                    <button type="button" class="btn btn-sm btn-icon btn-flat btn-default" data-toggle="tooltip"
                              data-original-title="Edit">
                              <i class="icon wb-wrench" aria-hidden="true"></i>
                    </button>
                    <button type="button" class="btn btn-sm btn-icon btn-flat btn-default" data-toggle="tooltip"
                              data-original-title="Delete">
                              <i class="icon wb-close" aria-hidden="true"></i>
                    </button>
                  </td>
                </tr> -->
                <?php
                  $i=1;
                    if (!is_null($pengeluarans))
                    foreach ($pengeluarans as $ps) {
                  ?>
                  <tr>
                    <!-- <td><?php echo $i; ?></td> -->
                    <td class=""><?php echo $ps -> code; ?></td>
                    <td class=""><?php echo $ps -> name; ?></td>
                    <td class="">
                      <?php if ($ps -> nota) :?>
                         <span class="">
                          <a class="avatar" href="<?php echo base_url(); ?>assets/images/pengeluaran/<?php echo $ps -> nota; ?>" download="nota" target="_blank">
                            <img class="img-responsive" src="<?php echo base_url(); ?>assets/images/pengeluaran/<?php echo $ps -> nota; ?>"/>
                          </a>
                        </span>
                        <?php echo $ps -> reason; ?>
                      <?php else: ?>
                        <?php echo $ps -> reason; ?>
                    <?php endif; ?>
                    </td>
                    <td class="">Rp. <?php echo formatRP($ps -> amount); ?></td>
                    <td class=""><?php echo date("d M Y", strtotime($ps -> date)); ?></td>
                    <td class="text-nowrap">
                      <button type="button" class="btn btn-sm btn-icon btn-info btn-outline" data-toggle="tooltip"
                                data-original-title="Edit" onclick="edit_account(<?php echo $ps -> id_pengeluaran; ?>)">
                                <i class="icon wb-wrench" aria-hidden="true"></i>
                      </button>
                      <button type="button" class="btn btn-sm btn-icon btn-danger btn-outline" data-toggle="tooltip"
                                data-original-title="Delete" onclick="delete_account(<?php echo $ps -> id_pengeluaran; ?>)">
                                <i class="icon wb-close" aria-hidden="true"></i>
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
            <h3 class="panel-title">Laporan Pengeluaran</h3>
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
                    <select class="form-control" name="kategori">
                      <option value="all">Semua</option>
                      <?php foreach ($kategoris as $ks) { ?>
                             <option value="<?php echo $ks->id; ?>"><?php echo $ks->name; ?></option>
                          <?php } ?>
                    </select>
                    <label class="floating-label">Kategori Pengeluaran</label>
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
                    <div class="modal fade modal-fade-in-scale-up" id="exampleNiftyFadeScale" aria-hidden="true"
                      aria-labelledby="exampleModalTitle" role="dialog" tabindex="-1">
                      <div class="modal-dialog modal-simple">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">×</span>
                            </button>
                            <h4 class="modal-title">Tambah Pengeluaran</h4>
                          </div>
                          <div class="modal-body">
                            <form autocomplete="off" id="form">
                              <input type="hidden" name="id">
                              <div class="form-group form-material " data-plugin="formMaterial">
                                <input type="text" class="form-control" name="kode" data-hint="Masukkan Kode Pengeluaran"
                                />
                                <label class="floating-label">Kode</label>
                              </div>
                              <div class="form-group form-material floating" data-plugin="formMaterial">
                                <select class="form-control" name="kategori">
                                  <option>&nbsp;</option>
                                  <?php foreach ($kategoris as $ks) { ?>
                                         <option value="<?php echo $ks->id; ?>"><?php echo $ks->name; ?></option>
                                      <?php } ?>
                                </select>
                                <label class="floating-label">Kategori</label>
                              </div>
                              <div class="form-group form-material " data-plugin="formMaterial">
                                <input type="text" class="form-control" name="keterangan" data-hint="Masukkan Keterangan Pengeluaran"
                                />
                                <label class="floating-label">Keterangan</label>
                              </div>
                              <div class="form-group form-material " data-plugin="formMaterial">
                                <div class="input-group">
                                  <span class="input-group-addon">Rp.</span>
                                  <div class="form-control-wrap">
                                    <input type="text" class="form-control" name="nominal" data-hint="Masukkan Harga Nominal Pengeluaran" />
                                    <label class="floating-label">Nominal</label>
                                  </div>
                                </div>
                              </div>
                              <div class="form-group form-material " data-plugin="formMaterial">
                               <div class="input-group">
                                  <input type="text" name="date" class="form-control" data-plugin="datepicker">
                                  <label class="floating-label">Tanggal</label>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-md-12">
                                  <div class="" id="photo-preview">
                                      <label>Photo</label>
                                      <div class="col-md-12">
                                          (No photo)
                                          <span class="help-block"></span>
                                      </div>
                                  </div>
                                </div>
                                <div class="col-md-12">
                                  <div class="form-group form-material floating" style="margin-top: 0" data-plugin="formMaterial">
                                    <input type="text" class="form-control" readonly="" />
                                    <input type="file" name="nota" multiple="" />
                                    <label class="floating-label" id="label-photo">Upload Gambar..</label>
                                  </div>
                                </div>
                              </div>
                            </form>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Simpan</button>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- End Modal -->

<script type="text/javascript">

var save_method; //for save method string
var base_url = '<?php echo base_url();?>';


function addAccount()
{
    save_method = 'add';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#exampleNiftyFadeScale').modal('show'); // show bootstrap modal
    $('.modal-title').text('Tambah Pengeluaran'); // Set Title to Bootstrap modal title

    $('#photo-preview').hide(); // hide photo preview modal
    // $('[name="nipy"]').removeAttr("disabled");
    $('#label-photo').text('Nota..'); // label photo upload
}

function edit_account(id)
{
    save_method = 'update';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string

    //Ajax Load data from ajax
    $.ajax({
        url : "<?php echo site_url('pengeluaran/ajax_edit')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {

            // $('[name="nipy"]').val(data.nipy);
            // $('[name="nipy"]').attr("disabled","disabled");
            $('[name="id"]').val(data.id_pengeluaran);
            $('[name="kode"]').val(data.code);
            $('[name="keterangan"]').val(data.reason);
            $('[name="kategori"]').val(data.expense_category);
            $('[name="nominal"]').val(data.amount);
            $('[name="date"]').val(data.date);

            $('#exampleNiftyFadeScale').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Pengeluaran'); // Set title to Bootstrap modal title

            $('#photo-preview').show(); // show photo preview modal

            if(data.nota)
            {
                $('#label-photo').text('Change Nota..'); // label photo upload
                $('#photo-preview div').html('<img src="'+base_url+'assets/images/pengeluaran/'+data.nota+'" class="img-responsive" style="width: 160px">'); // show photo
                $('#photo-preview div').append('<br><input type="checkbox" name="remove_photo" value="'+data.nota+'"/> Remove photo when saving<br><br>'); // remove photo

            }
            else
            {
                $('#label-photo').text('Upload Photo'); // label photo upload
               $('#photo-preview div').html('<img src="'+base_url+'assets/images/d.png" class="img-responsive" style="width: 160px">'); // show photo
            }


        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}


function reload_table()
{
    table.ajax.reload(null,false); //reload datatable ajax 
}

function save()
{
    // $('[name="nipy"]').removeAttr("disabled");
    $('#btnSave').text('saving...'); //change button text
    $('#btnSave').attr('disabled',true); //set button disable 
    var url;

    if(save_method == 'add') {
        url = "<?php echo site_url('pengeluaran/add')?>";
    } else {
        url = "<?php echo site_url('pengeluaran/update')?>";
    }

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
            alert('Error adding / update data');
            $('#btnSave').text('save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable 

        }
    });
}

function delete_account(id)
{
    if(confirm('Are you sure delete this data?'))
    {
        // ajax delete data to database
        $.ajax({
            url : "<?php echo site_url('pengeluaran/delete')?>/"+id,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
                if(data.status) //if success close modal and reload ajax table
              {

                  var alert = `<div class="alert alert-alt alert-success alert-dismissible" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                      ${data.flash_header} <br><a class="alert-link" style="margin-left: 0" href="javascript:void(0)">${data.flash_desc}</a>
                    </div>`

                    $('.page-header').append(alert)

                  location.reload();

              } else {

                 var alertgagal = `<div class="alert alert-alt alert-danger alert-dismissible" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                      ${data.flash_header} <br><a class="alert-link" style="margin-left: 0" href="javascript:void(0)">${data.flash_desc}</a>
                    </div>`

                    $('.page-header').append(alertgagal)
              }
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error deleting data');
            }
        });

    }
}

$('document').ready(function(){
    $('#formLapPenjualan').submit(function(e){
      e.preventDefault()
      $.ajax({
        type: "POST",
        url: '<?php echo site_url('pengeluaran/lapPengeluaranBy') ?>',
        data: $('#formLapPenjualan').serialize(),
        success: function(data){
          $('#tampiltable').html(data)
        }
      })
    })
  })

</script>