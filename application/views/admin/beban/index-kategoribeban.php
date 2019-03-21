      <div class="page-header">
        <h1 class="page-title"><?php  echo $title ?></h1>
       <!--  <div class="page-header-actions">
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
                  <th style="background:  #ececec;">Kategori</th>
                  <th style="background:  #ececec;">Status</th>
                  <th class="text-nowrap" style="background:  #ececec;">Action</th>
                </tr>
              </thead>
              <tbody>
               <!--  <tr>
                  <td>Listrik</td>
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
                  <td>Telepon</td>
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
                    if (!is_null($kategoripengeluarans))
                    foreach ($kategoripengeluarans as $kps) {
                  ?>
                  <tr>
                    <!-- <td><?php echo $i; ?></td> -->
                    <td class=""><?php echo $kps -> name; ?></td>
                    <td class="">
                    <?php
                      if ($kps -> status == '1') {
                        echo '<span class="badge badge-lg badge-success">Aktif</span>';
                      }
                      if ($kps -> status == '0') {
                        echo '<span class="badge badge-lg badge-danger">InAktif</span>';
                      } 
                  ?>
                                                    
                    </td>
                    <td class="text-nowrap">
                      <button type="button" class="btn btn-sm btn-icon btn-info btn-outline" data-toggle="tooltip"
                                data-original-title="Edit" onclick="edit_account(<?php echo $kps->id; ?>)">
                                <i class="icon wb-wrench" aria-hidden="true"></i>
                      </button>
                      <button type="button" class="btn btn-sm btn-icon btn-danger btn-outline" data-toggle="tooltip"
                                data-original-title="Delete" onclick="delete_account(<?php echo $kps->id; ?>)">
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
                            <h4 class="modal-title">Tambah Kategori Beban</h4>
                          </div>
                          <div class="modal-body">
                            <form autocomplete="off" id="form">
                              <input type="hidden" name="id">
                              <div class="form-group form-material " data-plugin="formMaterial">
                                <input type="text" class="form-control" name="nama" data-hint="Masukkan Nama Kategori Beban"
                                />
                                <label class="floating-label">Kategori</label>
                              </div>
                              <div class="form-group form-material floating" data-plugin="formMaterial">
                                <select class="form-control" name="status">
                                  <option>&nbsp;</option>
                                  <option value="1">Aktif</option>
                                  <option value="0">Tidak Aktif</option>
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
        $('.modal-title').text('Tambah Kategori Pengeluaran'); // Set Title to Bootstrap modal title
    }

    function edit_account(id)
    {
        save_method = 'update';
        $('#form')[0].reset(); // reset form on modals
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty(); // clear error string

        //Ajax Load data from ajax
        $.ajax({
            url : "<?php echo site_url('kategoripengeluaran/ajax_edit')?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {

                // $('[name="nipy"]').val(data.nipy);
                // $('[name="nipy"]').attr("disabled","disabled");
                $('[name="id"]').val(data.id);
                $('[name="nama"]').val(data.name);
                $('[name="status"]').val(data.status);

                $('#exampleNiftyFadeScale').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title').text('Edit Kategori'); // Set title to Bootstrap modal title
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
            url = "<?php echo site_url('kategoripengeluaran/add')?>";
        } else {
            url = "<?php echo site_url('kategoripengeluaran/update')?>";
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
                url : "<?php echo site_url('kategoripengeluaran/delete')?>/"+id,
                type: "POST",
                dataType: "JSON",
                success: function(data)
                {
                    //if success reload ajax table
                    $('#exampleNiftyFadeScale').modal('hide');
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
