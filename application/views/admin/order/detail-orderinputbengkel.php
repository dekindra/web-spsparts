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
                <?php if($data["status_order"]>0) :?>
                <th>Qty Diterima</th>
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
                $i=1;

                if (!is_null($array))
                  foreach ($array as $d) {
                    ?>
                    <tr>
                      <td><?php echo $i; ?></td>
                      <td class=""><?php echo $d -> name_p; ?></td>
                      <td class="">Rp. <?php echo formatRP($d -> subtotal / $d -> qty); ?></td>
                      <td class=""><?php echo $d -> qty; ?></td>
                      <td class="">Rp. <?php echo formatRP($d -> subtotal); ?></td>
                      <?php if($data["status_order"]>0) :?>
                      <input type="hidden" name="id[]" value="<?php echo $d -> id_p ?>">
                      <td><input type="text" class="form-control" style="max-width: 75px" name="qtyditerima[]" value="<?php echo $d -> qtyditerima ?>"></td>
                      <?php endif ?>
                    </tr> 
                    <?php $totalqty = $totalqty + $d-> qty ?>
                    <?php $total = $total + $d-> subtotal ?>
                    <?php  $i++; } ?>

                    <tr>
                      <td></td>
                      <td colspan="2"><b>Grand Total</b></td>
                      <td class=" "><b><?php echo $totalqty ?></b></td>
                      <td class=" "><b>Rp. <?php echo formatRP($total) ?></b></td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="modal-footer text-right">
                <?php if($data["status_order"]==1): ?>
                <button type="submit" class="btn btn-animate btn-animate-side btn-primary" onclick="selesaiOrder(<?php echo $data["id_order"]; ?>)">
                  <span><i class="icon wb-shopping-cart" aria-hidden="true"></i> Selesai Order</span>
                </button>
                <?php endif ?>
                <a href="<?php echo base_url() ?>orderbengkel/cetak/<?php echo $data["id_order"]; ?>">
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

      function selesaiOrder(kode){
        var qtyditerima = [];
        var id_produk = [];

        $('[name="qtyditerima[]"]').each(function() {
          qtyditerima.push(this.value);
        });
        $('[name="id[]"]').each(function() {
          id_produk.push(this.value);
        });

    // console.log(qtyditerima);
    // console.log(list_idnotcheck);
    $.ajax({
      type: "POST",
      data: {qty:qtyditerima, id:id_produk},
      url: "<?php echo site_url('orderbengkel/selesaiOrder')?>/" + kode,
      dataType: "JSON",
      success: function(data)
      {
        if(data.status)
        {
         // reload_table();
         location.reload();
       }
       else
       {
        alert('Failed.');
      }
    },
    error: function (jqXHR, textStatus, errorThrown)
    {
      alert('Error deleting data');
    }
  });
  }
</script>
