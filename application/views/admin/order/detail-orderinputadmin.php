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
          <p>Total Pembelian    : <b>Rp. <?php echo formatRP($data["total_pembelian"]); ?></b></p>
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
                <?php if($data["status_order"]>1) :?>
                <th style="background:  #ececec;">Qty Diterima</th>
                <?php endif ?>
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
                $totalqtyditerima = 0;
                $i=1;

                if (!is_null($array))
                  foreach ($array as $d) {
                    ?>
                    <tr>
                      <td><?php echo $i; ?></td>
                      <td class=""><?php echo $d -> name_p; ?></td>
                      <td class="">Rp. <?php echo formatRP($d -> subtotal / $d-> qty); ?></td>
                      <td class=""><?php echo $d -> qty; ?></td>
                      <td class="">Rp. <?php echo formatRP($d -> subtotal); ?></td>
                      <?php if($data["status_order"]>1) :?>
                      <input type="hidden" name="id[]" value="<?php echo $d -> id_p ?>">
                      <input type="hidden" name="id_gudang[]" value="<?php echo $d -> id_gudang ?>">
                      <input type="hidden" name="qtyditerima[]" value="<?php echo $d -> qtyditerima ?>">
                      <td class="" style="background:  #ececec;"><?php echo $d -> qtyditerima; ?></td>
                      <?php endif ?>
                    </tr> 
                    <?php $totalqty = $totalqty + $d-> qty ?>
                    <?php $total = $total + $d-> subtotal ?>
                    <?php $totalqtyditerima = $totalqtyditerima + $d-> qtyditerima ?>
                    <?php  $i++; } ?>

                    <tr>
                      <td></td>
                      <td colspan="2"><b>Grand Total</b></td>
                      <td class=" "><b><?php echo $totalqty ?></b></td>
                      <td class=" "><b>Rp. <?php echo formatRP($total) ?></b></td>
                      <?php if($data["status_order"]>1) :?>
                      <td style="background:  #ececec;"><b><?php echo $totalqtyditerima ?></b></td>
                      <?php endif ?>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="modal-footer text-right">
                <?php if($data["status_order"]==2): ?>
                <button type="submit" class="btn btn-animate btn-animate-side btn-primary" onclick="selesaiOrder(<?php echo $data["id_order"]; ?>)">
                  <span><i class="icon wb-shopping-cart" aria-hidden="true"></i> Selesai Order</span>
                </button>
                <?php elseif($data["status_order"]==0): ?>
                <button type="submit" class="btn btn-animate btn-animate-side btn-primary" onclick="prosesOrder(<?php echo $data["id_order"]; ?>)">
                  <span><i class="icon wb-shopping-cart" aria-hidden="true"></i> Proses Order</span>
                </button>
              <?php endif ?>
                <a href="<?php echo base_url() ?>orderadmin/cetak/<?php echo $data["id_order"]; ?>">
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
  function selesaiOrder(id)
  {
    // $('[name="nipy"]').removeAttr("disabled");
    $('#btnSave').text('saving...'); //change button text
    $('#btnSave').attr('disabled',true); //set button disable 
    var qtyditerima = [];
    var id_produk = [];
    var id_gudang = [];

    $('[name="qtyditerima[]"]').each(function() {
      qtyditerima.push(this.value);
    });
    $('[name="id[]"]').each(function() {
      id_produk.push(this.value);
    });
    $('[name="id_gudang[]"]').each(function() {
      id_gudang.push(this.value);
    });


    $.ajax({
      type: "POST",
      data: {qty:qtyditerima, id:id_produk, id_gudang:id_gudang},
      url: "<?php echo site_url('orderadmin/selesaiOrderMasuk')?>/" + id,
      dataType: "JSON",
      success: function(data)
      {
        if(data.status) //if success close modal and reload ajax table
            {
                $('#addUserForm').modal('hide');

                var alert = `<div class="alert alert-alt alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                    ${data.flash_header} <br><a class="alert-link" style="margin-left: 0" href="javascript:void(0)">${data.flash_desc}</a>
                  </div>`

                  $('.page-header').append(alert)
                  
               location.reload();  



            } else {

              $('#addUserForm').modal('hide');

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