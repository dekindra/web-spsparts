

<?php if(empty($penjualan)){echo "<b>Tidak Ada Data</b>";} ?>
<?php if(!empty($penjualan)): ?>
<!-- Function -->
<?php
function formatRP($angka){
  $jadi = number_format($angka,0,',','.');
  return $jadi;
}

?>
<div class="mb-15">
  <p>Total Transaksi : <?php  echo($judulpenjualan->totaltransaksi) ?></p>
  <p>Total Penjualan    : <b>Rp. <?php  echo formatRP($judulpenjualan->totalpembelian) ?></b></p>
  <p>Total Keuntungan    : <b>Rp. <?php  echo formatRP($judulpenjualan->totalkeuntungan) ?></b></p>
  <a href="<?php echo site_url('penjualan/cetakLaporan/'.$start.'/'.$end.'/'.$pelanggan) ?>">
    <button type="button" class="btn btn-animate btn-animate-side btn-success btn-outline">
      <span><i class="icon wb-print" aria-hidden="true"></i> Print</span>
    </button>
  </a>
  <hr>
</div>
<table class="table table-hover dataTable table w-full" id="exampleTableTools" >
  <thead>
    <tr>
      <!-- <th>#</th> -->
      <th style="background:  #ececec;">#</th>
      <!-- <th style="background:  #ececec;">Bengkel</th> -->
      <th style="background:  #ececec;">Pelanggan</th>
      <th style="background:  #ececec;">Tanggal</th>
      <th style="background:  #ececec;">Total Tagihan</th>
      <th style="background:  #ececec;">Diskon</th>
      <th style="background:  #ececec;">Keuntungan</th>
      <th class="text-nowrap" style="background:  #ececec;">Action</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $i=1;
    if (!is_null($penjualan))
      foreach ($penjualan as $pj) {
        ?>
        <tr>
          <td><?php echo $i; ?></td>
          <!-- <td class=""><?php echo $pj -> name; ?></td> -->
          <td class=""><?php echo $pj -> nama; ?></td>
          <td class=""><?php echo date("d-m-Y",strtotime($pj -> created_datetime)); ?></td>
          <td class="">Rp. <?php echo formatRP($pj -> total); ?></td>
          <td class="">Rp. <?php echo formatRP($pj -> diskon); ?></td>
          <td class="">Rp. <?php echo formatRP($pj -> untung); ?></td>
          <td class="text-nowrap">
          <button class="btn btn-sm btn-icon btn-info btn-outline" onclick="detail_account(<?php echo $pj->id_penjualan; ?>)" data-content="Melihat rincian tagihan" data-trigger="hover" data-toggle="popover" data-original-title="Lihat Detail" tabindex="0" title="" type="button">
            <i class="icon wb-info-circle" aria-hidden="true"></i>
          </button>
        </td>
      </tr> 
    <?php  $i++; } ?>
    <tr>
      <td></td>
      <td colspan="2"><b>Grand Total</b></td>
      <td class="page-invoice-amount"><b>Rp. <?php  echo formatRP($judulpenjualan->totalpembelian) ?></b></td>
      <td class="page-invoice-amount"><b>Rp. <?php  echo formatRP($judulpenjualan->totaldiskon) ?></b></td>
      <td class="page-invoice-amount"><b>Rp. <?php  echo formatRP($judulpenjualan->totalkeuntungan) ?></b></td>
      <td class="text-nowrap">
        <a href="<?php echo site_url('penjualan/cetakLaporan/'.$start.'/'.$end.'/'.$pelanggan) ?>">
          <button type="button" class="btn btn-success btn-outline">
            <span><i class="icon wb-print" aria-hidden="true"></i> Print</span>
          </button>
        </a>
      </td>
    </tr>
  </tbody>
</table>

<?php endif; ?>