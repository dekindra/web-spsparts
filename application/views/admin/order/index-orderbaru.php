<!-- JQUERY CORE -->
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<!-- JQUERY UI -->
<link href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" rel="stylesheet">
<!-- CHART JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.js"></script>

<!-- Function -->
<?php 
function formatRP($angka){
 $jadi = number_format($angka,0,',','.');
 return $jadi;
}

?>

<div class="page-header">
  <h1 class="page-title"><?php  echo $title ?></h1>
      <?php if(is_null($statusgudang)): ?>
          <div class="alert alert-alt alert-danger alert-dismissible" style="text-align: left;" role="alert">
            <!-- <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button> -->
            Sistem telah menghapus Gudang anda<br><a class="alert-link" style="margin-left: 0" href="javascript:void(0)">Mohon segera memilih gudang terdekat, Order tidak dapat dilanjutkan selama belum menetapkan gudang kembali</a>
          </div>
        <?php else: ?>
          <?php if($statusgudang->status == 0): ?>
            <div class="alert alert-alt alert-danger alert-dismissible" style="text-align: left;" role="alert">
              <!-- <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button> -->
              Sistem telah menonaktifkan Gudang anda<br><a class="alert-link" style="margin-left: 0" href="javascript:void(0)">Mohon segera memilih gudang terdekat, Order tidak dapat dilanjutkan selama belum menetapkan gudang kembali</a>
            </div>
        <?php endif ?>
      <?php endif ?>
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
            <div class="row">
              <div class="col-md-6">
                <?php if(is_null($statusgudang)): ?>
                  <div class="mb-15">
                  <button  class="btn btn-outline btn-primary" disabled="disabled" data-target="#exampleNiftyFadeScale"
                    data-toggle="modal" type="button"><i class="icon wb-plus" aria-hidden="true"></i> Tambah
                  </button>
                </div>
                <?php else: ?>
                  <?php if($statusgudang->status == 0): ?>
                    <div class="mb-15">
                      <button  class="btn btn-outline btn-primary" disabled="disabled" data-target="#exampleNiftyFadeScale"
                        data-toggle="modal" type="button"><i class="icon wb-plus" aria-hidden="true"></i> Tambah
                      </button>
                    </div>
                    <?php else: ?>
                      <div class="mb-15">
                        <button  class="btn btn-outline btn-primary" data-target="#exampleNiftyFadeScale"
                          data-toggle="modal" type="button"><i class="icon wb-plus" aria-hidden="true"></i> Tambah
                        </button>
                      </div>
                <?php endif ?>
              <?php endif ?>


                <!-- <div class="mb-15">
                  <button  class="btn btn-outline btn-primary" disabled="disabled" data-target="#exampleNiftyFadeScale"
                    data-toggle="modal" type="button"><i class="icon wb-plus" aria-hidden="true"></i> Tambah
                  </button>
                </div> -->
            </div>
            <div class="col-md-6">
              <div class="text-right">
                <p><span class="badge badge-lg badge-warning"><b>Grand Total : Rp. <?php echo formatRP($totalorder->totalorder) ?></b></span></p>
              </div>
            </div>
            <!-- Modal -->
            <div class="modal fade modal-fade-in-scale-up" id="exampleNiftyFadeScale" aria-hidden="true"
            aria-labelledby="exampleModalTitle" role="dialog" tabindex="-1">
            <div class="modal-dialog modal-simple modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                  </button>
                  <h4 class="modal-title">Buat Order</h4>
                </div>
                <form autocomplete="off" id="form" class="formmodaltambah">
                  <div class="modal-body">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group form-material floating" data-plugin="formMaterial">
                         <div class="input-group">
                          <?php 
                          $date = date('m/d/Y');
                          ?>
                          <input type="text" class="form-control" name="tanggal" value="<?php echo $date ?>" data-plugin="datepicker">
                          <label class="floating-label">Tanggal</label>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <!-- Panel Floating Labels -->
                      <!-- <div class="panel"> -->
                                    <!-- <div class="panel-heading">
                                      <h3 class="panel-title">Total</h3>
                                    </div> -->
                                    <!-- <div class="panel-body container-fluid"> -->
                                        <!-- <div class="form-group form-material" data-plugin="formMaterial">
                                          <div class="input-group">
                                            <span class="input-group-addon" style="color: red; font-size: 30px;" >Rp</span>
                                            <div class="form-control-wrap">
                                              <label class="">Total Order</label>
                                              <input id="rupiah" type="hidden" class="form-control" /><br>
                                              <span class="tampilTotalBeli"></span></b>
                                            </div>
                                          </div>
                                        </div> -->
                                        <label for=""><b>TOTAL ORDER</b></label>
                                        <input id="rupiah" type="hidden" name="total_pembelian" class="form-control"><br>
                                        <b style="color: red; font-size: 30px;">Rp <span class="tampilTotalBeli"></span></b>
                                        <br>
                                        <label for=""><b>Maksimal Order adalah senilai </b><span class="badge badge-lg badge-warning">Rp <?php echo formatRP($limitorder["limit_order"]); ?></span></label>    
                                        <!-- </div> -->
                                        <!-- </div> -->
                                        <!-- End Panel Floating Labels -->
                                      </div>
                                    </div>
                                    <!-- Panel Table Tools -->
                                    <!-- <div class="panel"> -->
                                      <header class="panel-heading">
                                        <h3 class="panel-title">Tambah Order</h3>
                                      </header>
                                      <!-- <div class="panel-body"> -->
                                        <div class="table-responsive">
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
                                              <tbody>
                                                <!-- Dynamic -->
                                              </tbody>
                                            </thead>
                                          </table>
                                        </div>
                                  <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Tambah</button>
                                    <button type="button" class="btn btn-primary">Simpan</button> -->
                                    <!-- </div> -->
                                    <!-- </div> -->
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-default" id="tambah">Baris Baru</button>
                                    <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Simpan</button>
                                  </div>
                                </form>
                              </div>
                            </div>
                          </div>
                          <!-- End Modal -->
                        </div>
                        <!-- <table class="table table-hover dataTable table w-full" data-plugin="dataTable" > -->
                          <table class="table table-hover dataTable table w-full" id="exampleTableTools" >
                            <thead>
                              <tr>
                                <th style="background:  #ececec;">#</th>
                                <!-- <th style="background:  #ececec;">Kode</th> -->
                                <th style="background:  #ececec;">Tanggal</th>
                                <th style="background:  #ececec;">Total Order</th>
                                <th style="background:  #ececec;">Status Order</th>
                                <th class="text-nowrap" style="background:  #ececec;">Action</th>
                              </tr>
                            </thead>
                            <tbody>
                <!-- <tr>
                  <td>2805001</td>
                  <td>2018-05-28</td>
                  <td>2000000</td>
                  <td><span class="badge badge-dark">Menunggu</span></td>
                  <td><span class="badge badge-warning">Belom Lunas</span></td>
                  <td class="text-nowrap">
                    <button type="button" class="btn btn-sm btn-icon btn-flat btn-default" data-toggle="tooltip"
                              data-original-title="Detail">
                              <i class="icon wb-info-circle" aria-hidden="true"></i>
                            </button> -->
                   <!--  <button type="button" class="btn btn-sm btn-icon btn-flat btn-default" data-toggle="tooltip"
                              data-original-title="Edit">
                              <i class="icon wb-wrench" aria-hidden="true"></i>
                            </button> -->
                    <!-- <button type="button" class="btn btn-sm btn-icon btn-flat btn-default" data-toggle="tooltip"
                              data-original-title="Delete">
                              <i class="icon wb-close" aria-hidden="true"></i>
                    </button>
                  </td>
                </tr> -->
                <?php
                $i=1;
                if (!is_null($orders))
                  foreach ($orders as $or) {
                    ?>
                    <tr>
                      <td><?php echo $i; ?></td>
                      <!-- <td class=""><?php echo $or -> id_order; ?></td> -->
                      <td class=""><?php echo date('d F Y',strtotime($or -> tanggal_order)); ?></td>
                      <td class="">Rp. <?php echo formatRP($or -> total_pembelian); ?></td>
                      <td class="">
                        <?php
                        if ($or -> status_order == '2') {
                          echo '<span class="badge badge-lg badge-success">Selesai '.date("d F Y",strtotime($or -> tanggal_selesai)).'</span>';
                        }elseif ($or -> status_order == '1') {
                          echo '<span class="badge badge-lg badge-info">Siap Diambil '.date("d F Y",strtotime($or -> tanggal_diproses)).'</span>';
                        }else {
                          echo '<span class="badge badge-lg badge-dark">Menunggu</span>';
                        } 
                        ?>                          
                      </td>
                      <!-- <td class=""><?php echo $or -> status_order; ?></td> -->
                      <!-- <td class=""><?php echo $or -> status_pembayaran; ?></td> -->
                      <td class="text-nowrap">
                        <button type="button" class="btn btn-sm btn-icon btn-primary btn-outline" data-toggle="tooltip"
                        data-original-title="Detail" onclick="detail_account(<?php echo $or->id_order; ?>)">
                        <i class="icon wb-info-circle" aria-hidden="true"></i>
                      </button>
                      <!-- <button type="button" class="btn btn-sm btn-icon btn-flat btn-default" data-toggle="tooltip"
                                data-original-title="Edit" onclick="edit_account(<?php echo $or->id_order; ?>)">
                                <i class="icon wb-wrench" aria-hidden="true"></i>
                              </button> -->
                              <button type="button" class="btn btn-sm btn-icon btn-danger btn-outline" data-toggle="tooltip"
                              data-original-title="Delete" onclick="delete_account(<?php echo $or->id_order; ?>)">
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



              <!-- Template digunakan untuk membuat input field -->
              <template id="order-cart">
                <!-- #id# supaya membuat identik, sehingga value dapat diambil -->
                <tr data-row-id="#id#">
                  <!-- Kode Ice Cream -->
                  <td>#id#</td>
                  <input type ="hidden" name = "order[#id#][id_produk]" class=""  id="kode#id#">
                  <!-- Nama Ice Cream -->
                  <td>
                    <input type ="text" name = "order[#id#][nama_produk]" class="form-control" id="autocomplete#id#" 
                    placeholder = "Ketikan Kode/Nama Barang ..." autocomplete = "off">
                    <!-- Autocomplete dibikin off supaya gak rese', karna kalau on suka keluar angka dari rekomendasi -->
                  </td>
                  <td>
                    <input type ="text" name = "order[#id#][harga_produk]" class="form-control" id="harga_produk#id#" >
                  </td>
                  <td>
                    <input type ="text" name = "order[#id#][quantity]" class="form-control" id="quantity#id#">
                  </td>
                  <td>
                    <input type ="text" name = "order[#id#][sub_total]" class="form-control hitungTotal" id="sub_total#id#" >
                  </td>
                  <td>
                    <button type="button" class="btn btn-sm btn-icon btn-flat btn-danger delete" data-id="#id#"><i class="wb-close"></i></button>
                  </td>
                </tr>
              </template>

              <!-- Modal -->
              <div class="modal fade modal-fade-in-scale-up" id="modal_detail" aria-hidden="true"
              aria-labelledby="exampleModalTitle" role="dialog" tabindex="-1">

            </div>
            <!-- End Modal -->

<!-- JQUERY UI -->
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>

<script>
  (function($) {
    function to_rupiah(angka){
      var rev     = parseInt(angka, 10).toString().split('').reverse().join('');
      var rev2    = '';
      for(var i = 0; i < rev.length; i++){
        rev2  += rev[i];
        if((i + 1) % 3 === 0 && i !== (rev.length - 1)){
          rev2 += '.';
        }
      }
      return rev2.split('').reverse().join('');
    } 

    var template = $('#order-cart').html()
    // Ambil Template HTML DARI Id product-cart
    // Function untuk tambah baris tabel
    function tambahBaris(){
      var currentId = $('#cart tbody tr:last-child').data('row-id') || 0
      // Ambil Nomor ID, Jika tidak ada diganti dengan 0
      $('#cart tbody').append(template.replace(/#id#/g, currentId + 1))
      // Fungsi Append buat menambah element, dari template tadi dan diganti #id# dengan currentID
      $('body').on('keyup','#quantity'+ (currentId + 1), function(){
        var qty = $('#quantity'+ (currentId + 1)).val() 
        var hargaProduk = $('#harga_produk'+ (currentId + 1)).val()
        var subTotal  = qty * hargaProduk
        $('#sub_total'+(currentId + 1)).val(subTotal)
        hitungTotal()
      })

      $('body').on('click',"#autocomplete"+ (currentId + 1), function(){
        $("#autocomplete"+ (currentId + 1)).autocomplete({    
          minLength:1,
          source:function( request, result ) {
            $.ajax({
              url: '<?php echo site_url('orderbengkel/autocompleteproduk') ?>',
              dataType: "json",
              data: 'cari=' + request.term,
              success: function( data ) {
                result($.map(data, function (item) {
                  return {
                    label: item.search,
                    value: item.id,
                    data: item
                  };
                }));
              },
              error: function(e){  
                alert('Error: ' + request);  
              }  
            });
          },
          // appendTo : "#exampleNiftyFadeScale",
          select: function( event, ui ) {
            // console.log(ui)
            $('#harga_produk' + (currentId + 1)).val(ui.item.data.price * (100 - ui.item.data.het_bengkel)/100);
            $('#kode' + (currentId + 1)).val(ui.item.data.id);
            $("#autocomplete" + (currentId + 1)).val(ui.item.data.code);
            // reset input text
            $('#sub_total'+(currentId + 1)).val('0')
            $('#quantity'+(currentId + 1)).val('')
            // end reset input text
            return false;
          },
        });


        $("#autocomplete"+ (currentId + 1)).autocomplete("option" , "appendTo", ".formmodaltambah")

      })

      $('#sub_total'+ (currentId+1)).val(0)
      hitungTotal()   
    }

    tambahBaris()
    // EVENT KLIK TOMBOL
    $('#tambah').on('click', function (e) {
      tambahBaris()
    })
    
    // DELETE
    $('body').on('click', '.delete', function (e) {
      $(this).parents('tr').remove()
      hitungTotal()
    })

    $(document).on('keydown', 'body', function(e){
      var charCode = ( e.which ) ? e.which : event.keyCode;
      if(charCode == 118) //F7
      {
        tambahBaris();
        return false;
      }
    });

    function hitungTotal(){
      var total = 0
      $('.hitungTotal').each(function(){
        var totals = $(this).val()
        total = parseInt(total) + parseInt(totals)
        $('input[name=total_pembelian]').val(total)
        $('.tampilTotalBeli').html(to_rupiah(total))
      })
    }
  })(jQuery)

  function save()
  {
    // $('[name="nipy"]').removeAttr("disabled");
    $('#btnSave').text('saving...'); //change button text
    $('#btnSave').attr('disabled',true); //set button disable 
    var url;

    url = "<?php echo site_url('orderbengkel/add')?>";

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
            location.reload();

          }
        });
  }

  function detail_account(id)
  {
    save_method = 'update';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string

    //Ajax Load data from ajax
    $.ajax({
      url : "<?php echo site_url('orderbengkel/ajax_edit')?>/" + id,
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

  function delete_account(id)
  {
    if(confirm('Are you sure delete this data?'))
    {
        // ajax delete data to database
        $.ajax({
          url : "<?php echo site_url('orderbengkel/delete')?>/"+id,
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
          url: '<?php echo site_url('orderbengkel/lapOrderBy') ?>',
          data: $('#formLapPenjualan').serialize(),
          success: function(data){
            $('#tampiltable').html(data)
          }
        })
      })
    })

  </script>

