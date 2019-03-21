<!-- Function -->
<?php 
function formatRP($angka){
 $jadi = number_format($angka,0,',','.');
 return $jadi;
}

?>

<div class="modal-dialog modal-simple modal-lg">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">×</span>
      </button>
      <h4 class="modal-title">Modal Title</h4>
    </div>
    <div class="modal-body">
      <div class="panel-body">
        <div class="mb-15">
          <p>Kode Pembelian : <?php echo $data["id_order"] ?></p>
          <p>Tanggal : <?php echo date("d F Y",strtotime($data["tanggal_order"])) ?></p>
          <p>Total Pembelian    : <b>Rp. <?php echo formatRP($data["total_pembelian"]) ?></b></p>
          <hr>
        </div>
        <div class="table-responsive">
          <table class="table table-hover">
            <thead>
              <tr>
                <th>#</th>
                <th>Nama Barang</th>
                <th>Harga</th>
                <th>Qty</th>
                <th>Sub Total</th>
                <?php if($data["status_order"]<=1): ?>
                <th>Stock Tersedia</th>
                <?php endif ?>
                <th>Qty Diterima</th>
              </tr>
            </thead>
            <tbody>
                <!-- <tr>
                  <td>1</td>
                  <td>Heath</td>
                  <td>6778 Howe Route</td>
                  <td>Antwanbury</td>
                  <td>32</td>
                </tr>
                <tr>
                  <td>2</td>
                  <td>Alisa</td>
                  <td>64838 D&#x27;Amore Cove</td>
                  <td>Port Lempi</td>
                  <td>25</td>
                </tr>
                <tr>
                  <td>3</td>
                  <td>Treva</td>
                  <td>308 Octavia Roads</td>
                  <td>East Eunaton</td>
                  <td>37</td>
                </tr>
                <tr>
                  <td>4</td>
                  <td>Nicolas</td>
                  <td>760 Hickle Causeway</td>
                  <td>Lake Nickolasshire</td>
                  <td>69</td>
                </tr>
                <tr>
                  <td>5</td>
                  <td>Gerhard</td>
                  <td>893 Mara Parkway</td>
                  <td>Elmermouth</td>
                  <td>32</td>
                </tr>
                <tr>
                  <td>6</td>
                  <td>Monica</td>
                  <td>0039 Heath Plain</td>
                  <td>West Bentonhaven</td>
                  <td>46</td>
                </tr> -->
                <?php
                $totalqty = 0;
                $total = 0;
                $totalpembeliangudang = 0;
                $tampil[] = 0; 
                $i=1;

                if (!is_null($array))
                  foreach ($array as $d) {
                    ?>
                    <tr>
                      <td><?php echo $i; ?></td>
                      <td class=""><?php echo $d -> name_p; ?></td>
                      <td class="">Rp. <?php echo formatRP(($d -> purchase_price *( 100 - $d-> het_bengkel))/100); ?></td>
                      <td class=""><?php echo $d -> qty; ?></td>
                      <td class="">Rp. <?php echo formatRP($d -> subtotal); ?></td>
                      <?php if($data["status_order"]<=1): ?>
                        <?php if(is_null($d -> stock)): ?>
                        <td class="">0</td>
                        <?php else: ?>
                        <td class=""><?php echo $d -> stock; ?></td>
                        <?php endif ?>
                      <?php endif ?>
                      <input type="hidden" name="id[]" value="<?php echo $d -> id_p ?>">
                      <input type="hidden" name="id_gudang[]" value="<?php echo $d -> id_gudang ?>">
                      <input type="hidden" name="harga[]" value="<?php echo ($d -> purchase_price *( 100 - $d-> het_bengkel))/100 ?>">
                      <input type="hidden" name="hargagudang[]" value="<?php echo ($d -> purchase_price *( 100 - $d-> het_gudang))/100 ?>">
                      <input type="hidden" name="qty[]" value="<?php echo $d-> qty ?>">
                      <td><input type="text" class="form-control" style="max-width: 75px" name="qtyditerima[]" value="<?php echo $d -> qty ?>"></td>
                    </tr>

                    <?php 
                      $totalqty = $totalqty + $d-> qty;
                      $total = $total + $d-> subtotal;
                      $totalpembeliangudang = $totalpembeliangudang + ((($d -> purchase_price *(100 - $d-> het_gudang))/100) * $d-> qty);

                      if ($d -> qty > ((int)$d -> stock)) {
                         $tampil[] = true;
                       }else{
                        $tampil[] = false;
                       } 

                    ?>
                    <?php  $i++; } ?>

                    <tr>
                      <td></td>
                      <td colspan="2"><b>Grand Total</b></td>
                      <td class=" "><b><?php echo $totalqty ?></b></td>
                      <td class=" "><b>Rp. <?php echo formatRP($total) ?></b></td>
                      <input type="hidden" name="total" value="<?php echo $totalpembeliangudang; ?>">
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="modal-footer text-right">
                <?php if($data["status_order"]<=1): ?>
                  <?php if(in_array(true, $tampil)): ?>
                    <button type="submit" class="btn btn-animate btn-animate-side btn-primary" onclick="orderkeadmin(<?php echo $data["id_order"]; ?>)">
                      <span><i class="icon wb-shopping-cart" aria-hidden="true"></i> Order Ke Admin</span>
                    </button>
                    <button type="submit" class="btn btn-animate btn-animate-side btn-primary" disabled="disabled" onclick="prosesOrder(<?php echo $data["id_order"]; ?>)">
                      <span><i class="icon wb-shopping-cart" aria-hidden="true"></i> Proses Order</span>
                    </button>
                  <?php else: ?>
                    <button type="submit" class="btn btn-animate btn-animate-side btn-primary" disabled="disabled" onclick="orderkeadmin(<?php echo $data["id_order"]; ?>)">
                      <span><i class="icon wb-shopping-cart" aria-hidden="true"></i> Order Ke Admin</span>
                    </button>
                    <button type="submit" class="btn btn-animate btn-animate-side btn-primary" onclick="prosesOrder(<?php echo $data["id_order"]; ?>)">
                      <span><i class="icon wb-shopping-cart" aria-hidden="true"></i> Proses Order</span>
                    </button>
                  <?php endif ?>
                <?php else: ?>
                <button type="submit" class="btn btn-animate btn-animate-side btn-primary" disabled="disabled" onclick="orderkeadmin(<?php echo $data["id_order"]; ?>)">
                    <span><i class="icon wb-shopping-cart" aria-hidden="true"></i> Order Ke Admin</span>
                  </button>
                  <button type="submit" class="btn btn-animate btn-animate-side btn-primary" disabled="disabled" onclick="prosesOrder(<?php echo $data["id_order"]; ?>)">
                    <span><i class="icon wb-shopping-cart" aria-hidden="true"></i> Proses Order</span>
                  </button>
                <?php endif ?>
                
                <a href="<?php echo base_url() ?>ordergudang/cetakMasuk/<?php echo $data["id_order"]; ?>">
                  <button type="button" class="btn btn-animate btn-animate-side btn-default btn-outline">
                    <span><i class="icon wb-print" aria-hidden="true"></i> Print</span>
                  </button>
                </a>
            </div>
          </div>
        </div>
      </div>
      <!-- End Panel Table Tools -->
    </div>

   <script type="text/javascript">

    function prosesOrder(kode){
      var qtyditerima = [];
      var id_produk = [];
      var harga = [];
      var id_gudang = [];

      $('[name="qtyditerima[]"]').each(function() {
        qtyditerima.push(this.value);
      });
      $('[name="id[]"]').each(function() {
        id_produk.push(this.value);
      });
      $('[name="harga[]"]').each(function() {
        harga.push(this.value);
      });
      $('[name="id_gudang[]"]').each(function() {
        id_gudang.push(this.value);
      });

    // console.log(qtyditerima);
    // console.log(list_idnotcheck);
    $.ajax({
      type: "POST",
      data: {qty:qtyditerima, id:id_produk, harga:harga, id_gudang: id_gudang},
      url: "<?php echo site_url('ordergudang/prosesOrderMasuk')?>/" + kode,
      dataType: "JSON",
      success: function(data)
      {
        if(data.status) //if success close modal and reload ajax table
            {
                $('#modal_detail').modal('hide');

                var alert = `<div class="alert alert-alt alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                    ${data.flash_header} <br><a class="alert-link" style="margin-left: 0" href="javascript:void(0)">${data.flash_desc}</a>
                  </div>`

                  $('.page-header').append(alert)
                  
               location.reload();  


            } else {

              $('#modal_detail').modal('hide');

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
        alert('Error proses data');
      }
    });
  }

  function orderkeadmin(kode){
    // console.log(qtyditerima);
    // console.log(list_idnotcheck);
      var qty = [];
      var id_produk = [];
      var hargagudang = [];
      var total = $('input[name=total]').val();

      $('[name="qty[]"]').each(function() {
        qty.push(this.value);
      });
      $('[name="id[]"]').each(function() {
        id_produk.push(this.value);
      });
      $('[name="hargagudang[]"]').each(function() {
        hargagudang.push(this.value);
      });
     

    $.ajax({
      type: "POST",
      data: {qty:qty, id:id_produk, harga:hargagudang, total:total},
      url: "<?php echo site_url('ordergudang/orderkeadmin')?>/" + kode,
      dataType: "JSON",
      success: function(data)
      {
         if(data.status) //if success close modal and reload ajax table
            {
                $('#modal_detail').modal('hide');

                var alert = `<div class="alert alert-alt alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                    ${data.flash_header} <br><a class="alert-link" style="margin-left: 0" href="javascript:void(0)">${data.flash_desc}</a>
                  </div>`

                  $('.page-header').append(alert)
                  
               // location.reload();  


            } else {

              $('#modal_detail').modal('hide');

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
        alert('Error proses data');
      }
    });
    }
    </script>