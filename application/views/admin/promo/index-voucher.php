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
                  <th>Kode Promo</th>
                  <th>Nominal Promo</th>
                  <th>Max Penggunaan</th>
                  <th>Min Transaksi</th>
                  <th>Kadaluarsa</th>
                  <th class="text-nowrap">Action</th>
                </tr>
              </thead>
              <tbody>
                <!-- <tr>
                  <td>7170 6219 6623 1752</td>
                  <td>50000</td>
                  <td>2018-07-07</td>
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
                  <td>6219 7170 1752 6623</td>
                  <td>25000</td>
                  <td>2018-07-08</td>
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
                    if (!is_null($promos))
                    foreach ($promos as $ps) {
                  ?>
                  <tr>
                    <!-- <td><?php echo $i; ?></td> -->
                    <td class=""><?php echo $ps -> card_number; ?></td>
                    <td class="">Rp. <?php echo formatRP($ps -> value); ?></td>
                    <td class=""><?php echo $ps -> penggunaan; ?> Kali</td>
                    <td class="">Rp. <?php echo formatRP($ps -> buy_minimal); ?></td>
                    <td class=""><?php echo $ps -> expiry_date; ?></td>
                    <td class="text-nowrap">
                      <button type="button" class="btn btn-sm btn-icon btn-flat btn-default" data-toggle="tooltip"
                                data-original-title="Edit" onclick="edit_account(<?php echo $ps->id; ?>)">
                                <i class="icon wb-wrench" aria-hidden="true"></i>
                      </button>
                      <a href="<?php echo base_url() ?>promo/cetak/<?php echo $ps->id; ?>">
                        <button type="button" class="btn btn-sm btn-icon btn-flat btn-default" data-toggle="tooltip"
                                  data-original-title="Print" onclick="">
                                  <i class="icon wb-print" aria-hidden="true"></i>
                        </button>
                      </a>
                      <button type="button" class="btn btn-sm btn-icon btn-flat btn-default" data-toggle="tooltip"
                                data-original-title="Delete" onclick="delete_account(<?php echo $ps->id; ?>)">
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
                            <h4 class="modal-title">Tambah Promo</h4>
                          </div>
                          <div class="modal-body">
                            <form autocomplete="off" id="form">
                              <input type="hidden" name="id">
                              <!-- <div class="form-group form-material" data-plugin="formMaterial">
                                <label class="form-control-label" for="inputAddons">Kode Promo</label>
                                <div class="input-group">
                                  <div class="form-control-wrap">
                                    <input type="text" class="form-control" id="btn-input" data-plugin="formatter"
                                    data-pattern="[[9999]]-[[9999]]-[[9999]]-[[9999]]" />
                                  </div>
                                  <span class="input-group-btn">
                                    <button class="btn btn-outline btn-default" id="btn-todo" type="button">Generate</button>
                                  </span>
                                </div>
                              </div> -->
                              <div class="form-group form-material" data-plugin="formMaterial">
                                <label class="form-control-label">Kode Promo</label>
                                <div class="input-group">
                                  <div class="form-control-wrap">
                                    <input type="text" class="form-control" name="card_number" id="btn-input" data-hint="Masukkan Kode Promo 16 Digit" />
                                  </div>
                                  <span class="input-group-btn">
                                    <button class="btn btn-outline btn-default" id="btn-todo" type="button">Generate</button>
                                  </span>
                                </div>
                              </div>
                              <div class="form-group form-material floating" data-plugin="formMaterial">
                                <div class="input-group">
                                  <span class="input-group-addon">Rp.</span>
                                  <div class="form-control-wrap">
                                    <input type="text" class="form-control" name="value" data-hint="Masukkan Nominal Promo" />
                                    <label class="floating-label">Nominal Voucher</label>
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-6">
                                  <div class="form-group form-material floating" data-plugin="formMaterial">
                                    <div class="input-group">
                                      <div class="form-control-wrap">
                                        <input type="text" class="form-control" name="max" data-hint="Masukkan maksimal penggunaan voucher (ex : 3)" />
                                        <label class="floating-label">Penggunaan</label>
                                      </div>
                                      <span class="input-group-addon">Kali</span>
                                    </div>
                                  </div>
                                </div>
                                <div class="col-6">
                                  <div class="form-group form-material floating" data-plugin="formMaterial">
                                    <div class="input-group">
                                      <span class="input-group-addon">Rp.</span>
                                      <div class="form-control-wrap">
                                        <input type="text" class="form-control" name="transaksi" data-hint="Masukkan Nominal minimal transaksi" />
                                        <label class="floating-label">Minimal Transaksi</label>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="form-group form-material floating" data-plugin="formMaterial">
                               <div class="input-group">
                                  <input type="text" class="form-control" name="date" data-plugin="datepicker">
                                  <label class="floating-label">Berlaku Sampai</label>
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

  function generateCardNo(x) {
    if(!x) { x = 16; }
    chars = "1234567890";
    no = "";
    for (var i=0; i<x; i++) {
        var rnum = Math.floor(Math.random() * chars.length);
        no += chars.substring(rnum,rnum+1);
    }
    return no;
}
  $(document).ready(function () {
        // $('#btn-input').data-pattern("9999 9999 9999 9999");
        // $('#btn-input').input-mask("9999-9999-9999-9999");
        // data-pattern="[[9999]]-[[9999]]-[[9999]]-[[9999]]"
        $('#btn-todo').click(function () {
            var numb = generateCardNo();
            document.getElementById("btn-input").value  = numb;
            return false;
        });
    });


var save_method; //for save method string
var base_url = '<?php echo base_url();?>';


function addAccount()
{
    save_method = 'add';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#exampleNiftyFadeScale').modal('show'); // show bootstrap modal
    $('.modal-title').text('Tambah Promo'); // Set Title to Bootstrap modal title
}

function edit_account(id)
{
    save_method = 'update';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string

    //Ajax Load data from ajax
    $.ajax({
        url : "<?php echo site_url('promo/ajax_edit')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {

            // $('[name="nipy"]').val(data.nipy);
            // $('[name="nipy"]').attr("disabled","disabled");
            $('[name="id"]').val(data.id);
            $('[name="card_number"]').val(data.card_number);
            $('[name="value"]').val(data.value);
            $('[name="max"]').val(data.penggunaan);
            $('[name="transaksi"]').val(data.buy_minimal);
            $('[name="date"]').val(data.expiry_date);

            $('#exampleNiftyFadeScale').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Promo'); // Set title to Bootstrap modal title

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
        url = "<?php echo site_url('promo/add')?>";
    } else {
        url = "<?php echo site_url('promo/update')?>";
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
            url : "<?php echo site_url('promo/delete')?>/"+id,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
                //if success reload ajax table
                $('#exampleNiftyFadeScale').modal('hide');
                // reload_table();
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
    