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
          <p>Kode Return : <?php echo $data["id_retur"] ?></p>
          <p>Tanggal : <?php echo date("d F Y",strtotime($data["created_datetime"])) ?></p>
          <p>Total Pembelian    : <b>Rp. <?php echo formatRP($data["total_retur"]) ?></b></p>
          <hr>
        </div>
        <div class="table-responsive">
          <table class="table table-hover">
            <thead>
              <tr>
                <th>#</th>
                <th>Nama Barang</th>
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
                      <td class=""><?php echo $d -> qty; ?></td>
                      <td class="">Rp. <?php echo formatRP($d -> subtotal); ?></td>
                    </tr> 
                    <?php $totalqty = $totalqty + $d-> qty ?>
                    <?php $total = $total + $d-> subtotal ?>
                    <?php  $i++; } ?>

                    <tr>
                      <td></td>
                      <td colspan=""><b>Grand Total</b></td>
                      <td class=" "><b><?php echo $totalqty ?></b></td>
                      <td class=" "><b>Rp. <?php echo formatRP($total) ?></b></td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="modal-footer text-right">
                <a href="<?php echo base_url() ?>returngudang/cetak/<?php echo $data["id_retur"]; ?>">
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
