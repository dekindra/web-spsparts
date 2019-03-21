
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
            <!-- <div class="col-md-6"> -->
              <div class="text-right">
                <p><span class="badge badge-lg badge-warning"><b>Grand Total : Rp. <?php echo formatRP($totalorder->totalorder) ?></b></span></p>
              </div>
            <!-- </div> -->
            <!-- <div class="row"> -->
<!--               <div class="col-md-6">
                <div class="mb-15">
                  <button  class="btn btn-outline btn-primary" data-target="#exampleNiftyFadeScale"
                      data-toggle="modal" type="button"><i class="icon wb-plus" aria-hidden="true"></i> Add row
                  </button>
                </div>
              </div> -->
                    <!-- Modal -->
                   <!--  <div class="modal fade modal-fade-in-scale-up" id="exampleNiftyFadeScale" aria-hidden="true"
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
                            <form autocomplete="off">
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
                            </form>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
                  <th style="background:  #ececec;">Tanggal</th>
                  <th style="background:  #ececec;">Bengkel</th>
                  <th style="background:  #ececec;">Total Pembelian</th>
                  <th style="background:  #ececec;">Status</th>
                  <th class="text-nowrap" style="background:  #ececec;">Action</th>
                </tr>
              </thead>
              <tbody>
                <!-- <tr>
                  <td>2805001</td>
                  <td>2018-05-28</td>
                  <td>Smksw Jaya</td>
                  <td>2000000</td>
                  <td><span class="badge badge-info">Diterima</span></td>
                  <td><span class="badge badge-warning">Belom Lunas</span></td>
                  <td class="text-nowrap">
                    <button type="button" class="btn btn-sm btn-icon btn-flat btn-default" data-toggle="tooltip"
                              data-original-title="Detail">
                              <i class="icon wb-info-circle" aria-hidden="true"></i>
                    </button>
                    <button type="button" class="btn btn-sm btn-icon btn-flat btn-default" data-toggle="tooltip"
                              data-original-title="Terima Order">
                              <i class="icon wb-check" aria-hidden="true"></i>
                    </button>
                    <button type="button" class="btn btn-sm btn-icon btn-flat btn-default" data-toggle="tooltip"
                              data-original-title="Lunas Pembayaran">
                              <i class="icon wb-thumb-up" aria-hidden="true"></i>
                    </button>
                  </td>
                </tr> -->
                <?php 
                  $i=1;
                  if (!is_null($ordermasuks))
                    foreach ($ordermasuks as $om) {
                 ?>
                  <tr>
                    <td><?php echo $i; ?></td>
                    <!-- <td class=""><?php echo $om -> id_order; ?></td> -->
                    <td class=""><?php echo date("d F Y", strtotime($om -> tanggal_order)); ?></td>
                    <td class=""><?php echo $om -> name; ?></td>
                    <td class="">Rp. <?php echo formatRP($om -> total_pembelian); ?></td>
                    <td class="">
                    <?php
                      if ($om -> status_order == '2') {
                        echo '<span class="badge badge-lg badge-success">Selesai '.date("d F Y",strtotime($om -> tanggal_selesai)).'</span>';
                      }elseif ($om -> status_order == '1') {
                        echo '<span class="badge badge-lg badge-info">Diproses '.date("d F Y",strtotime($om -> tanggal_diproses)).'</span>';
                      }else {
                        echo '<span class="badge badge-lg badge-dark">Menunggu</span>';
                      } 
                    ?>                           
                    </td>
                    <!-- <td class=""><?php echo $om -> status_order; ?></td> -->
                    <td class="text-nowrap">
                      <button type="button" class="btn btn-sm btn-icon btn-primary btn-outline" data-toggle="tooltip"
                                data-original-title="Detail" onclick="detail_account(<?php echo $om->id_order; ?>)">
                                <i class="icon wb-info-circle" aria-hidden="true"></i>
                      </button>
                      <!-- <div class="btn-group" role="group">
                        <button type="button" class="btn  btn-sm btn-warning dropdown-toggle" id="exampleIconDropdown2"
                          data-toggle="dropdown" aria-expanded="false">
                          <i class="icon wb-edit" aria-hidden="true"></i>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="exampleIconDropdown2" role="menu">
                          <a class="dropdown-item" href="javascript:void(0)" onclick="prosesOrder(<?php echo $om->id_order; ?>)" role="menuitem">Diproses</a>
                          <a class="dropdown-item" href="javascript:void(0)" onclick="validOrder(<?php echo $om->id_order; ?>)" role="menuitem">Valid Order</a>
                          <a class="dropdown-item" href="javascript:void(0)" onclick="selesaiOrder(<?php echo $om->id_order; ?>)" role="menuitem">Selesai</a>
                        </div>
                      </div> -->
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
                              <option value="1">Siap Diambil</option>
                              <option value="2">Selesai</option>
                            </select>
                            <label class="floating-label">Status Order</label>
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
      </div>

      <!-- Modal -->
      <div class="modal fade modal-fade-in-scale-up" id="modal_detail" aria-hidden="true" aria-labelledby="exampleModalTitle" role="dialog" tabindex="-1">
        <!-- ambil html lewat controller -->
      </div>
      <!-- End Modal -->


<script type="text/javascript">

function detail_account(id)
{
    // save_method = 'update';
    // $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string

    //Ajax Load data from ajax
    $.ajax({
        url : "<?php echo site_url('ordergudang/detailMasuk')?>/" + id,
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

$('document').ready(function(){
      $('#formLapPenjualan').submit(function(e){
        e.preventDefault()
        $.ajax({
          type: "POST",
          url: '<?php echo site_url('ordergudang/lapOrderBy') ?>',
          data: $('#formLapPenjualan').serialize(),
          success: function(data){
            $('#tampiltable').html(data)
          }
        })
      })
    })

</script>