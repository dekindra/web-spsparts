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
            </div>
            <table class="table table-hover dataTable table w-full" id="exampleTableTools">
              <thead>
                <tr>
                  <th style="background:  #ececec;">Kode</th>
                  <th style="background:  #ececec;">Nama</th>
                  <th style="background:  #ececec;">Merk</th>
                  <th style="background:  #ececec;">Kategori</th>
                  <th style="background:  #ececec;">HET</th>
                  <th style="background:  #ececec;">Supplier [Disc]</th>
                  <!-- <th class="text-center">HET Gudang</th>
                  <th class="text-center">% Gudang</th>
                  <th class="text-center">HET Bengkel</th>
                  <th class="text-center">% Bengkel</th>
                  <th class="text-nowrap">Action</th> -->
                  <th class="text-center" style="background:  #ececec;">Gudang [Disc]</th>
                  <th class="text-center" style="background:  #ececec;">Bengkel [Disc]</th>
                  <th class="text-nowrap" style="background:  #ececec;">Action</th>
                </tr>
              </thead>
              <tbody>
                <!-- <tr>
                  <td>OL001</td>
                  <td>Yamalube</td>
                  <td>Oli</td>
                  <td>20000</td>
                  <td>35000</td>
                  <td>20</td>
                  <td>10</td>
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
                </tr>
                <tr>
                  <td>BN002</td>
                  <td>Pirelli</td>
                  <td>Ban</td>
                  <td>200000</td>
                  <td>350000</td>
                  <td>20</td>
                  <td>10</td>
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
                    if (!is_null($produks))
                    foreach ($produks as $ps) {
                  ?>
                  <tr>
                    <!-- <td><?php echo $i; ?></td> -->
                    <td class=""><?php echo $ps -> code_p; ?></td>
                    <!-- <div class="pr-20">
                          <a class="avatar" href="#">
                            <img class="img-responsive" src="../../../global/portraits/1.jpg" alt="..." />
                          </a>
                        </div> -->
                    <!-- if($ps->photo)
                        $row[] = '<span class="pull-left"><a href="'.base_url('upload/ps/'.$ps->photo).'" target="_blank"><img src="'.base_url('upload/ps/'.$ps->photo).'" class="img-circle" style="width:25px;border-radius:50%" /></a></span><span><a onclick="detail_account('."'".$ps->nipy."'".')" href="javascript:void(0);">'.$ps->nama.'</span>';
                    else
                        $row[] = '<span><a onclick="detail_account('."'".$ps->nipy."'".')" href="javascript:void(0);">'.$ps->nama.'</span>'; -->
                    <td class="">
                      <?php if ($ps -> thumbnail) :?>
                         <!-- <span class=""> -->
                          <a class="avatar" href="<?php echo base_url(); ?>assets/images/produk/<?php echo $ps -> thumbnail; ?>" target="_blank">
                            <img class="img-responsive" src="<?php echo base_url(); ?>assets/images/produk/<?php echo $ps -> thumbnail; ?>"/>
                          </a>
                        <!-- </span> -->
                        <?php echo $ps -> name_p; ?>
                      <?php else: ?>
                        <?php echo $ps -> name_p; ?>
                    <?php endif; ?>
                    </td>
                    <td class=""><?php echo $ps -> merk; ?></td>
                    <td class=""><?php echo $ps -> name_kp; ?></td>
                    <td class="">Rp. <?php echo formatRP($ps -> purchase_price); ?></td>
                    <td class="">Rp. <?php echo formatRP($ps -> purchase_price * (100 - $ps -> het_supplier) / 100); ?><br> [<?php echo $ps -> het_supplier; ?>%]</td>
                    <!-- <td class=""><?php echo $ps -> purchase_price * (100 - $ps -> het_gudang) / 100; ?></td>
                    <td class=""><?php echo $ps -> het_gudang; ?>%</td>
                    <td class=""><?php echo $ps -> purchase_price * (100 - $ps -> het_bengkel) / 100; ?></td>
                    <td class=""><?php echo $ps -> het_bengkel; ?>%</td> -->
                    <td class="text-center">Rp. <?php echo formatRP($ps -> purchase_price * (100 - $ps -> het_gudang) / 100); ?> <br> [<?php echo $ps -> het_gudang; ?>%]</td>
                    <td class="text-center">Rp. <?php echo formatRP($ps -> purchase_price * (100 - $ps -> het_bengkel) / 100); ?> <br> [<?php echo $ps -> het_bengkel; ?>%]</td>
             <!--        <td class="">
                    <?php
                      if ($ps -> status == '1') {
                        echo '<span class="badge-lg badge-success">Aktif</span>';
                      }
                      if ($ps -> status == '0') {
                        echo '<span class="badge-lg badge-danger">InAktif</span>';
                      } 
                    ?>                            
                    </td> -->
                    <td class="text-nowrap">
                      <button type="button" class="btn btn-sm btn-icon btn-info btn-outline" data-toggle="tooltip"
                                data-original-title="Edit" onclick="edit_account(<?php echo $ps->id_p; ?>)">
                                <i class="icon wb-wrench" aria-hidden="true"></i>
                      </button>
                      <button type="button" class="btn btn-sm btn-icon btn-danger btn-outline" data-toggle="tooltip"
                                data-original-title="Delete" onclick="delete_account(<?php echo $ps->id_p; ?>)">
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
              <h4 class="modal-title">Tambah Produk</h4>
            </div>
            <div class="modal-body">
                <!-- <div class="form-group form-material floating" data-plugin="formMaterial">
                  <input type="text" class="form-control" readonly="" />
                  <input type="file" name="inputFloatingFile" multiple="" />
                  <label class="floating-label">Gambar..</label>
                </div> -->
                <div class="form-horizontal">
                  <div class="nav-tabs-horizontal" data-plugin="tabs">
                    <ul class="nav nav-tabs nav-tabs-line" role="tablist">
                      <li class="nav-item" role="presentation"><a class="nav-link active" data-toggle="tab" href="#exampleTabsLineOne"
                          aria-controls="exampleTabsLineOne" role="tab">Input</a></li>
                      <li class="nav-item" role="presentation"><a class="nav-link" data-toggle="tab" href="#exampleTabsLineTwo"
                          aria-controls="exampleTabsLineTwo" role="tab">Import</a></li>
                    </ul>
                    <div class="tab-content pt-20">
                      <div class="tab-pane active" id="exampleTabsLineOne" role="tabpanel">
                      <form autocomplete="off" id="form">
                        <input type="hidden" name="id">
                          <div class="form-group form-material" data-plugin="formMaterial">
                            <input type="text" class="form-control" name="kode" data-hint="Masukkan Kode Barang"
                            />
                            <label class="floating-label">Kode</label>
                          </div>
                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group form-material" data-plugin="formMaterial">
                                <input type="text" class="form-control" name="nama" data-hint="Masukkan Nama Barang"/>
                                <label class="floating-label">Nama</label>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group form-material" data-plugin="formMaterial">
                                <input type="text" class="form-control" name="merk" data-hint="Masukkan Merk Barang"
                                />
                                <label class="floating-label">Merk</label>
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group form-material" data-plugin="formMaterial">
                                <input type="text" class="form-control" name="deskripsi" data-hint="Masukkan Deskripsi Barang"/>
                                <label class="floating-label">Deskripsi</label>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group form-material" data-plugin="formMaterial">
                                <select class="form-control" name="kategori">
                                  <option>&nbsp;</option>
                                  <?php foreach ($kategoris as $ks) { ?>
                                     <option value="<?php echo $ks->id_kp; ?>"><?php echo $ks->name_kp; ?></option>
                                  <?php } ?>
                                </select>
                                <label class="floating-label">Kategori</label>
                              </div>
                            </div>
                          </div>
                          <!-- <div class="form-group form-material floating" data-plugin="formMaterial">
                            <div class="input-group">
                              <span class="input-group-addon">Rp.</span>
                              <div class="form-control-wrap">
                                <input type="text" class="form-control" name="beli" data-hint="Masukkan Harga Beli Barang" />
                                <label class="floating-label">Harga Beli</label>
                              </div>
                            </div>
                          </div> -->
                          <!-- <div class="form-group form-material">
                            <label class="form-control-label">Diskon Pembelian</label>
                              <input type="text" class="form-control" id="inputPercent" name="diskon" data-plugin="formatter"
                                data-pattern="[[99]].[[99]]%" />
                              <p class="text-help">99.99%</p>
                          </div> -->
                          <br>
                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group form-material" data-plugin="formMaterial">
                                <div class="input-group">
                                  <span class="input-group-addon">Rp.</span>
                                  <div class="form-control-wrap">
                                    <input type="text" class="form-control" name="beli" data-hint="Masukkan Harga Jual Barang" />
                                    <input type="hidden" name="hetgudang">
                                    <input type="hidden" name="het_bengkel">
                                    <label class="floating-label">Harga Eceran Tertinggi</label>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="col-md-3">
                              <div class="form-group form-material" data-plugin="formMaterial">
                                <input type="text" class="form-control" name="isi" data-hint="Masukkan Nama Barang"/>
                                <label class="floating-label">Isi</label>
                              </div>
                            </div>
                            <div class="col-md-3">
                              <div class="form-group form-material" data-plugin="formMaterial">
                                <select class="form-control" name="satuan">
                                  <option>&nbsp;</option>
                                  <option value="SET">SET</option>
                                  <option value="PCS">PCS</option>
                                </select>
                                <label class="floating-label">Satuan</label>
                              </div>
                            </div>
                          </div>
                          
                          <!-- <div class="row">
                            <div class="col-md-6">
                              <div class="form-group form-material">
                                <label class="form-control-label">% HET Gudang</label>
                                  <input type="text" class="form-control" id="inputPercent" name="hetgudang" data-plugin="formatter"
                                    data-pattern="[[99]].[[99]]%" />
                                  <p class="text-help">99.99%</p>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group form-material">
                                <label class="form-control-label">% HET Bengkel</label>
                                  <input type="text" class="form-control" id="inputPercent" name="hetbengkel" data-plugin="formatter"
                                    data-pattern="[[99]].[[99]]%" />
                                  <p class="text-help">99.99%</p>
                              </div>
                            </div>
                          </div> -->
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
                                <input type="file" name="thumbnail" multiple="" />
                                <label class="floating-label" id="label-photo">Upload Gambar..</label>
                              </div>
                            </div>
                          </div>
                          <div class="text-right">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Simpan</button>
                          </div>
                        </form>
                      </div>
                      <div class="tab-pane" id="exampleTabsLineTwo" role="tabpanel">
                        <div class="text-center">

                              <!-- <div class="mb-15">
                                <a href="<?php echo base_url("excel/format.xlsx"); ?>">
                                <button id="" class="btn btn-outline btn-warning"><i class="icon fa-download" aria-hidden="true"></i> Download Format Produk</button></a>  
                              </div> -->
                              <div class="row mb-15">
                                <div class="col-md-6">
                                  <a href="<?php echo base_url("excel/format.xlsx"); ?>">
                                <button id="" class="btn btn-outline btn-warning"><i class="icon fa-download" aria-hidden="true"></i> Download Format Produk</button></a>
                                </div>
                                <div class="col-md-6">
                                  <a href="<?php echo base_url('produk/exportproduk'); ?>">
                                <button id="" class="btn btn-outline btn-success"><i class="icon fa-download" aria-hidden="true"></i> Download Data Produk Sekarang</button></a>
                                </div>
                              </div>
                              <form autocomplete="off" id="formimport">
                                <div class="mb-15">
                                  <input type="file" name="importproduk" id="input-file-now" data-plugin="dropify" data-allowed-file-extensions="xlsx"  data-default-file="" required="required" />
                                </div>
                                <div>
                                  <button type="button" onclick="import_produk()" class="btn btn-outline btn-primary"><i class="icon fa-upload" aria-hidden="true"></i> Import Produk</button>  
                                </div>
                              </form>

                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              
            </div>
            <!-- <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Simpan</button>
            </div> -->
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
    $('.modal-title').text('Tambah Produk'); // Set Title to Bootstrap modal title

    $('#photo-preview').hide(); // hide photo preview modal
    // $('[name="nipy"]').removeAttr("disabled");
    $('#label-photo').text('Upload Photo'); // label photo upload
}

function edit_account(id)
{
    save_method = 'update';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string

    //Ajax Load data from ajax
    $.ajax({
        url : "<?php echo site_url('produk/ajax_edit')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {

            // $('[name="nipy"]').val(data.nipy);
            // $('[name="nipy"]').attr("disabled","disabled");
            $('[name="id"]').val(data.id_p);
            $('[name="kode"]').val(data.code_p);
            $('[name="nama"]').val(data.name_p);
            $('[name="merk"]').val(data.merk);
            $('[name="deskripsi"]').val(data.deskripsi);
            $('[name="isi"]').val(data.isi);
            $('[name="satuan"]').val(data.satuan);
            $('[name="kategori"]').val(data.category);
            // $('[name="diskon"]').val(data.diskon);
            $('[name="beli"]').val(data.purchase_price);
            // $('[name="hetgudang"]').val(data.retail_price_gudang);
            // $('[name="hetbengkel"]').val(data.retail_price_bengkel);

            $('#exampleNiftyFadeScale').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Produk'); // Set title to Bootstrap modal title

            $('#photo-preview').show(); // show photo preview modal

            if(data.thumbnail)
            {
                $('#label-photo').text('Change Photo'); // label photo upload
                $('#photo-preview div').html('<img src="'+base_url+'assets/images/produk/'+data.thumbnail+'" class="img-responsive" style="width: 160px">'); // show photo
                $('#photo-preview div').append('<br><input type="checkbox" name="remove_photo" value="'+data.thumbnail+'"/> Remove photo when saving<br><br>'); // remove photo

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
        url = "<?php echo site_url('produk/add')?>";
    } else {
        url = "<?php echo site_url('produk/update')?>";
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
            url : "<?php echo site_url('produk/delete')?>/"+id,
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

function import_produk()
{
    var url;

    url = "<?php echo site_url('produk/importproduk')?>";

    // ajax adding data to database

    var formData = new FormData($('#formimport')[0]);
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

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error adding / update data');

        }
    });
}

</script>