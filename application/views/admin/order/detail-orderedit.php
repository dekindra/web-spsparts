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
        <p>Tanggal : <?php echo date('d F Y', strtotime($data["tanggal_order"])) ?></p>
        <p>Total Pembelian    : <b>Rp. <?php echo formatRP($data["total_pembelian"]) ?></b></p>
        <!-- <hr> -->
      </div>
  <!-- Example #TableditWithEditButtonOnly -->
      <!-- <div class="example-wrap"> -->
        <!-- <h4 class="example-title">Example #4</h4>
        <p>Inline edit like a spreadsheet, toolbar column with edit button
          only and without focus on first input.</p> -->
        <div class="example table-responsive">
          <table id="tableditWithEditButtonOnly" class="table table-striped table-bordered">
            <thead>
              <tr>
                <th>#</th>
                <th>Nama Barang</th>
                <th>Harga</th>
                <th>Qty</th>
                <th>Sub Total</th>
              </tr>
            </thead>
            <tbody>
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
                <td class="">Rp. <?php echo formatRP($d -> purchase_price *( 100 - $d-> diskon))/100); ?></td>
                <td class=""><?php echo $d -> qty; ?></td>
                <td class="">Rp. <?php echo $d -> subtotal; ?></td>
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
      <!-- </div> -->
      <!-- End Example #exampleTableditInlineEdit -->
        <div class="modal-footer text-right">
          <button type="submit" class="btn btn-animate btn-animate-side btn-default btn-outline" data-dismiss="modal" aria-label="Close" >
            <span><i class="icon wb-close" aria-hidden="true"></i> Close</span>
          </button>
          <button type="button" class="btn btn-animate btn-animate-side btn-primary"
            onclick="javascript:window.print();">
            <span><i class="icon wb-print" aria-hidden="true"></i> Print</span>
          </button>
        </div>
      </div>
    </div>
  </div>
  <!-- End Panel Table Tools -->
</div>