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
            <table class="table table-hover dataTable table w-full" id="exampleTableTools">
              <thead>
                <tr>
                  <th class="text-center" style="background:  #ececec;">Produk</th>
                  <th class="text-center" style="background:  #ececec;">Kategori</th>
                  <th class="text-center" style="background:  #ececec;">Het</th>
                  <th class="text-center" style="background:  #ececec;">Bengkel [Disc]</th>
                  <th class="text-center" style="background:  #ececec;">Harga Jual</th>
                  <th class="text-center" style="background:  #ececec;">Stock</th>
                  <th class="text-center" style="background:  #ececec;">Action</th>
                </tr>
              </thead>
              <tbody>
                <!-- <tr>
                  <td>BN002</td>
                  <td>Pirelli</td>
                  <td>Ban</td>
                  <td><span class="badge badge-danger">2</span></td>
                <tr>
                  <td>OL001</td>
                  <td>Yamalube</td>
                  <td>Oli</td>
                  <td><span class="badge badge-success">16</span></td>
                </tr> -->
                <?php
                  $i=1;
                    if (!is_null($inventoris))
                    foreach ($inventoris as $in) {
                  ?>
                  <tr>
                    <!-- <td><?php echo $i; ?></td> -->
                    <!-- <td class=""><?php echo $in -> code_p; ?></td> -->
                    <!-- <div class="pr-20">
                          <a class="avatar" href="#">
                            <img class="img-responsive" src="../../../global/portraits/1.jpg" alt="..." />
                          </a>
                        </div> -->
                    <!-- if($in->photo)
                        $row[] = '<span class="pull-left"><a href="'.base_url('upload/ps/'.$in->photo).'" target="_blank"><img src="'.base_url('upload/ps/'.$in->photo).'" class="img-circle" style="width:25px;border-radius:50%" /></a></span><span><a onclick="detail_account('."'".$in->nipy."'".')" href="javascript:void(0);">'.$in->nama.'</span>';
                    else
                        $row[] = '<span><a onclick="detail_account('."'".$in->nipy."'".')" href="javascript:void(0);">'.$in->nama.'</span>'; -->
                    <td class="">
                      <?php if ($in -> thumbnail) :?>
                         <!-- <span class=""> -->
                          <a class="avatar" href="<?php echo base_url(); ?>assets/images/produk/<?php echo $in -> thumbnail; ?>" target="_blank">
                            <img class="img-responsive" src="<?php echo base_url(); ?>assets/images/produk/<?php echo $in -> thumbnail; ?>"/>
                          </a>
                        <div class="content">
                          <div class="title"><?php echo $in->code_p; ?></div>
                          <div class="abstract"><?php echo $in->name_p.' '.$in->merk.' '.$in->deskripsi; ?></div>
                        </div>
                      <?php else: ?>
                        <div class="content">
                          <div class="title"><?php echo $in->code_p; ?></div>
                          <div class="abstract"><?php echo $in->name_p.' '.$in->merk.' '.$in->deskripsi; ?></div>
                        </div>
                    <?php endif; ?>
                    </td>
                    <td class=""><?php echo $in -> name_kp; ?></td>
                    <td class="">Rp <?php echo formatRP($in -> purchase_price); ?></td>
                    <td class="">Rp <?php echo formatRP($in -> purchase_price * (100 - $in -> het_bengkel) / 100); ?> [<?php echo $in -> het_bengkel; ?>%]</td>
                    <td class="">Rp <?php echo formatRP($in -> harga_jual); ?></td>
                    <?php if($in -> stock < $setting->min_stock): ?>
                      <td class=""><span class="badge badge-lg badge-danger"><?php echo $in -> stock; ?></span></td>
                    <?php elseif ($in -> stock < ($setting->min_stock * 2)): ?>
                       <td class=""><span class="badge badge-lg badge-warning"><?php echo $in -> stock; ?></span></td>
                    <?php else: ?>
                      <td class=""><span class="badge badge-lg badge-success"><?php echo $in -> stock; ?></span></td>
                    <?php endif ?>
                    <td>
                      <button type="button" class="btn btn-sm btn-icon btn-primary btn-outline" data-toggle="tooltip"
                        data-original-title="Edit" onclick="edit_account(<?php echo $in->id_p; ?>)">
                        <i class="icon wb-wrench" aria-hidden="true"></i>
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
              <h4 class="modal-title">Tambah Kategori Produk</h4>
            </div>
            <div class="modal-body">
              <form autocomplete="off" id="form">
                <input type="hidden" name="id">
                <div class="form-group form-material" data-plugin="formMaterial">
                  <div class="input-group">
                    <span class="input-group-addon">Rp.</span>
                    <div class="form-control-wrap">
                      <input type="text" class="form-control" name="harga_jual" data-hint="Masukkan Harga Jual Barang" />
                      <label class="floating-label">Harga Jual Produk</label>
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
  function edit_account(id)
{
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string

    //Ajax Load data from ajax
    $.ajax({
        url : "<?php echo site_url('inventory/ajax_edit')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {

            $('[name="id"]').val(data.id_p);
            $('[name="harga_jual"]').val(data.harga_jual);

            $('#exampleNiftyFadeScale').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Produk'); // Set title to Bootstrap modal title

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

    url = "<?php echo site_url('inventory/update')?>";

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
</script>
