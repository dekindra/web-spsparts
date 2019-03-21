

<?php if(empty($pengeluaran)){echo "<b>Tidak Ada Data</b>";} ?>
<?php if(!empty($pengeluaran)): ?>
<!-- Function -->
<?php
function formatRP($angka){
  $jadi = number_format($angka,0,',','.');
  return $jadi;
}

?>
<div class="mb-15">
  <p>Total Transaksi : <?php  echo($judulpengeluaran->totaltransaksi) ?></p>
  <p>Total pengeluaran    : <b>Rp. <?php  echo formatRP($judulpengeluaran->totalpengeluaran) ?></b></p>
  <a href="<?php echo site_url('pengeluaran/cetakLaporan/'.$start.'/'.$end.'/'.$kategori) ?>">
    <button type="button" class="btn btn-animate btn-animate-side btn-success btn-outline">
      <span><i class="icon wb-print" aria-hidden="true"></i> Print</span>
    </button>
  </a>
  <hr>
</div>
<table class="table table-hover dataTable table w-full" id="exampleTableTools" >
  <thead>
    <tr>
      <th style="background:  #ececec;">Tanggal</th>
      <th style="background:  #ececec;">Kode</th>
      <th style="background:  #ececec;">Kategori</th>
      <th style="background:  #ececec;">Keterangan</th>
      <th style="background:  #ececec;">Nominal</th>
    </tr>
  </thead>
  <tbody>
    <?php
      $i=1;
        if (!is_null($pengeluaran))
        foreach ($pengeluaran as $ps) {
      ?>
      <tr>
        <!-- <td><?php echo $i; ?></td> -->
        <td class=""><?php echo date("d M Y", strtotime($ps -> date)); ?></td>
        <td class=""><?php echo $ps -> code; ?></td>
        <td class=""><?php echo $ps -> name; ?></td>
        <td class="">
          <?php if ($ps -> nota) :?>
             <span class="">
              <a class="avatar" href="<?php echo base_url(); ?>assets/images/pengeluaran/<?php echo $ps -> nota; ?>" download="nota" target="_blank">
                <img class="img-responsive" src="<?php echo base_url(); ?>assets/images/pengeluaran/<?php echo $ps -> nota; ?>"/>
              </a>
              <a class="avatar" href="<?php echo base_url(); ?>assets/images/pengeluaran/<?php echo $ps -> nota; ?>" download="nota">
                <embed type="application/pdf" src="<?php echo base_url(); ?>assets/images/pengeluaran/<?php echo $ps -> nota; ?>"  height="50px" width="120">
              </a>
            </span>
            <?php echo $ps -> reason; ?>
          <?php else: ?>
            <?php echo $ps -> reason; ?>
        <?php endif; ?>
        </td>
        <td class="">Rp. <?php echo formatRP($ps -> amount); ?></td>
      </tr> 
    <?php  $i++; } ?>
    <tr>
      <td></td>
      <td colspan="3"><b>Grand Total</b></td>
      <td class="page-invoice-amount"><b>Rp. <?php  echo formatRP($judulpengeluaran->totalpengeluaran) ?></b></td>
    </tr>
  </tbody>
</table>

<?php endif; ?>