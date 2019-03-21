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
            <!-- <table class="table table-hover dataTable table w-full" data-plugin="dataTable"> -->
            <table class="table table-hover dataTable table w-full" id="exampleTableTools" >
              <thead>
                <tr>
                  <th>#</th>
                  <th>Gudang</th>
                  <th>Produk</th>
                  <th>Quantity</th>
                  <th>Total Pembelian</th>
                  <!-- <th>Status</th>
                  <th>Pembayaran</th>
                  <th class="text-nowrap">Action</th> -->
                </tr>
              </thead>
              <tbody>
                <!-- <tr>
                  <td>0706001</td>
                  <td>2018-06-07</td>
                  <td>300000</td>
                  <td><span class="badge badge-warning">Dikirim</span></td>
                  <td><span class="badge badge-warning">Belum Lunas</span></td>
                  <td class="text-nowrap">
                    <button type="button" class="btn btn-sm btn-icon btn-flat btn-default" data-toggle="tooltip"
                              data-original-title="Detail">
                              <i class="icon wb-info-circle" aria-hidden="true"></i>
                    </button>
                    <button type="button" class="btn btn-sm btn-icon btn-flat btn-default" data-toggle="tooltip"
                              data-original-title="Kirim">
                              <i class="icon wb-check" aria-hidden="true"></i>
                    </button>
                    <button type="button" class="btn btn-sm btn-icon btn-flat btn-default" data-toggle="tooltip"
                              data-original-title="Print">
                              <i class="icon wb-print" aria-hidden="true"></i>
                    </button>
                    <button type="button" class="btn btn-sm btn-icon btn-flat btn-default" data-toggle="tooltip"
                              data-original-title="Lunas Pembayaran">
                              <i class="icon wb-thumb-up" aria-hidden="true"></i>
                    </button>
                  </td>
                </tr> -->
                <?php 
                  $i=1;
                  if (!is_null($orderkeluars))
                    foreach ($orderkeluars as $ok) {
                 ?>
                  <tr>
                    <td><?php echo $i; ?></td>
                    <td class=""><?php echo $ok -> namagudang; ?></td>
                    <td class=""><?php echo $ok -> name_p; ?></td>
                    <td class=""><?php echo $ok -> quantity; ?></td>
                    <td class="">Rp. <?php echo formatRP($ok -> totalsub); ?></td>
                    <!-- <td class="">
                    <?php
                      if ($ok -> status_order_supplier == '1') {
                        echo '<span class="badge badge-info">Diproses '.date("d F Y",strtotime($ok -> tanggal_diproses)).'</span>';
                      }else {
                        echo '<span class="badge badge-dark">Menunggu</span>';
                      } 
                    ?>                           
                    </td>
                    <td class="">
                    <?php
                      if ($ok -> status_pembayaran_supplier==1) {
                        echo '<span class="badge badge-success">Lunas '.date("d F Y",strtotime($ok -> lunassupplier)).'</span>';
                      }else {
                        echo '<span class="badge badge-danger">Belum Bayar</span>';
                      } 
                    ?>                            
                    </td>
                    <td class="text-nowrap">
                      <button type="button" class="btn btn-sm btn-icon btn-flat btn-default" data-toggle="tooltip"
                                data-original-title="Detail" onclick="detail_account(<?php echo $ok->id_order; ?>)">
                                <i class="icon wb-info-circle" aria-hidden="true"></i>
                      </button>
                      <button type="button" class="btn btn-sm btn-icon btn-flat btn-default" data-toggle="tooltip"
                              data-original-title="Kirim" onclick="kirimOrder(<?php echo $ok->id_order; ?>)">
                              <i class="icon wb-check" aria-hidden="true"></i>
                      </button>
                      <button type="button" class="btn btn-sm btn-icon btn-flat btn-default" data-toggle="tooltip"
                                data-original-title="Lunas Pembayaran" onclick="lunas(<?php echo $om->id_order; ?>)">
                                <i class="icon wb-thumb-up" aria-hidden="true"></i>
                      </button>
                      <button type="button" class="btn btn-sm btn-icon btn-flat btn-default" data-toggle="tooltip"
                              data-original-title="Print">
                              <i class="icon wb-print" aria-hidden="true"></i>
                    </button>
                    </td> -->
                  </tr> 
                <?php  $i++; } ?>
              </tbody>
            </table>
          </div>
        </div>
        <!-- End Panel Table Tools -->
      </div>

<script type="text/javascript">

function kirimOrder(id)
{
    // $('[name="nipy"]').removeAttr("disabled");
    $('#btnSave').text('saving...'); //change button text
    $('#btnSave').attr('disabled',true); //set button disable 
    var url;

    url = "<?php echo site_url('orderadmin/terimaOrderMasuk')?>/" + id;

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

function lunas(id)
{
    // $('[name="nipy"]').removeAttr("disabled");
    $('#btnSave').text('saving...'); //change button text
    $('#btnSave').attr('disabled',true); //set button disable 
    var url;

    url = "<?php echo site_url('ordergudang/lunasMasuk')?>/" + id;

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

</script>