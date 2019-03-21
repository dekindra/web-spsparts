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
        <div class="panel">
          <!-- <header class="panel-heading">
            <h3 class="panel-title">Table Tools</h3>
          </header> -->
          <div class="panel-body">
            <div class="row">
<!--               <div class="col-md-6">
                <div class="mb-15">
                  <button  class="btn btn-outline btn-primary" data-target="#exampleNiftyFadeScale"
                      data-toggle="modal" type="button"><i class="icon wb-plus" aria-hidden="true"></i> Add row
                  </button>
                </div>
              </div> -->
            </div>
            <table class="table table-hover dataTable table w-full" id="exampleTableTools">
              <thead>
                <tr>
                  <th style="background:  #ececec;">Nama</th>
                  <th style="background:  #ececec;">E-mail</th>
                  <th style="background:  #ececec;">Alamat</th>
                  <!-- <th>Penanggung Jawab</th> -->
                  <th style="background:  #ececec;">Telepon</th>
                  <th style="background:  #ececec;">Status</th>
                  <th class="text-nowrap" style="background:  #ececec;">Action</th>
                </tr>
              </thead>
              <tbody>
                <!-- <tr>
                  <td>Sudirman Jos</td>
                  <td>SMK Sudirman Secang</td>
                  <td>Kayupuring Grabag Magelang</td>
                  <td>Khanip Abu</td>
                  <td>+6281327000763</td>
                  <td><span class="badge badge-success">Aktif</span></td>
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
                  <td>Smksw Jaya</td>
                  <td>SMK Syubbanul Wathon Tegalrejo</td>
                  <td>Tegalrejo Magelang</td>
                  <td>Agus Cahyadi</td>
                  <td>+628509879876</td>
                  <td><span class="badge badge-success">Aktif</span></td>
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
                    if (!is_null($suppliers))
                    foreach ($suppliers as $sp) {
                  ?>
                  <tr>
                    <input type="hidden" value="" name="id"/>
                    <!-- <td><?php echo $i; ?></td> -->
                    <td class=""><?php echo $sp -> name; ?></td>
                    <td class=""><?php echo $sp -> email; ?></td>
                    <td class=""><?php echo $sp -> address; ?></td>
                    <!-- <td class=""><?php echo $sp -> pj; ?></td> -->
                    <td class=""><?php echo $sp -> tel; ?></td>
                    <td class="">
                    <?php
                      if ($sp -> status == '1') {
                        echo '<span class="badge badge-lg badge-success">Aktif</span>';
                      }
                      if ($sp -> status == '0') {
                        echo '<span class="badge badge-lg badge-danger">InAktif</span>';
                      } 
                  ?>
                                                    
                    </td>
                    <td class="text-nowrap">
                      <button type="button" class="btn btn-sm btn-icon btn-info btn-outline" data-toggle="tooltip"
                                data-original-title="Edit" onclick="edit_account(<?php echo $sp->id_supplier; ?>)">
                                <i class="icon wb-wrench" aria-hidden="true"></i>
                      </button>
                      <button type="button" class="btn btn-sm btn-icon btn-danger btn-outline" data-toggle="tooltip"
                                data-original-title="Delete" onclick="delete_account(<?php echo $sp->id_supplier; ?>)">
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

      <!-- Modal Detail-->
                    <div class="modal fade modal-fade-in-scale-up" id="exampleNiftyFadeScale" aria-hidden="true"
                      aria-labelledby="exampleModalTitle" role="dialog" tabindex="-1">
                      <div class="modal-dialog modal-simple">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">×</span>
                            </button>
                            <h4 class="modal-title">Modal Title</h4>
                          </div>
                          <div class="modal-body">
                            <form autocomplete="off" id="form">
                              <!-- <div class="form-group form-material floating has-danger" data-plugin="formMaterial">
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
                              </div> -->
                              <input type="hidden" name="id">
                              <div class="form-group form-material " data-plugin="formMaterial">
                                <input type="text" class="form-control" name="nama"/>
                                <label class="floating-label">Nama Perusahaan</label>
                              </div>
                              <div class="form-group form-material " data-plugin="formMaterial">
                                <input type="text" class="form-control" name="alamat"/>
                                <label class="floating-label">Alamat Perusahaan</label>
                              </div>
                               <div class="form-group form-material " data-plugin="formMaterial">
                                <input type="text" class="form-control" name="telepon"/>
                                <label class="floating-label">Telepon Perusahaan</label>
                              </div>
                              <div class="row">
                                <div class="col-md-7">
                                  <div class="form-group form-material " data-plugin="formMaterial">
                                    <input type="text" class="form-control" name="pj"/>
                                    <label class="floating-label">Penanggung Jawab</label>
                                  </div>
                                </div>
                                <div class="col-md-5">
                                  <div class="form-group form-material " data-plugin="formMaterial">
                                    <input type="text" class="form-control" name="telpj"/>
                                    <label class="floating-label">Telepon PJ</label>
                                  </div>
                                </div>
                              </div>
                              <div class="form-group form-material " data-plugin="formMaterial">
                                <input type="email" class="form-control" name="email"/>
                                <label class="floating-label">Email Penanggung Jawab</label>
                              </div>
                              <!-- <div class="form-group form-material floating" data-plugin="formMaterial">
                                <input type="text" class="form-control" readonly="" />
                                <input type="file" name="file" multiple="" />
                                <label class="floating-label">File Penawaran..</label>
                              </div> -->
                              <div class="row">
                                <div class="col-md-12">
                                  <div class="" id="photo-preview">
                                    <label>Bengkel</label>
                                    <div class="col-md-12">
                                      (No data)
                                      <span class="help-block"></span>
                                    </div>
                                  </div>
                                  <div class="form-group form-material floating" data-plugin="formMaterial">
                                    <input type="text" class="form-control" readonly="" />
                                    <input type="file" name="file" multiple="" />
                                    <label class="floating-label" id="label-photo">File Penawaran..</label>
                                  </div>
                                </div>
                              </div>
                              <div class="form-group form-material floating" data-plugin="formMaterial">
                                <select class="form-control" name="status">
                                  <option>&nbsp;</option>
                                  <option value="1">Aktif</option>
                                  <option value="0">InAktif</option>
                                </select>
                                <label class="floating-label">Status</label>
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
                    <!-- End Modal Detail-->

<script type="text/javascript">

function edit_account(id)
{
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string

    //Ajax Load data from ajax
    $.ajax({
        url : "<?php echo site_url('supplier/ajax_edit')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {

            // $('[name="nipy"]').val(data.nipy);
            // $('[name="nipy"]').attr("disabled","disabled");
            $('[name="id"]').val(data.id_supplier);
            $('[name="nama"]').val(data.name);
            $('[name="instansi"]').val(data.instansi);
            $('[name="alamat"]').val(data.address);
            $('[name="telepon"]').val(data.tel);
            $('[name="pj"]').val(data.pj);
            $('[name="telpj"]').val(data.telpj);
            $('[name="email"]').val(data.email);
            $('[name="status"]').val(data.status);

            $('#exampleNiftyFadeScale').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Supplier'); // Set title to Bootstrap modal title

            $('#photo-preview').show(); // show photo preview modal

            if(data.file)
            {
                $('#label-photo').text('Change Penawaran..'); // label photo upload
                $('#photo-preview div').html('<img src="'+base_url+'assets/images/supplier/'+data.file+'" class="img-responsive" style="width: 160px">'); // show photo
                $('#photo-preview div').append('<br><input type="checkbox" name="remove_photo" value="'+data.file+'"/> Remove photo when saving<br><br>'); // remove photo

            }
            else
            {
                $('#label-photo').text('File Penawaran..'); // label photo upload
               // $('#photo-preview div').html('<img src="'+base_url+'assets/images/d.png" class="img-responsive" style="width: 160px">'); // show photo
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

    url = "<?php echo site_url('supplier/update')?>";

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
            url : "<?php echo site_url('supplier/delete')?>/"+id,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
                //if success reload ajax table
                location.reload();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error deleting data');
            }
        });

    }
}

</script>
