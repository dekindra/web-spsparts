

<?php if(empty($tagihan)){echo "<b>Tidak Ada Data</b>";} ?>
<?php if(!empty($tagihan)): ?>
<!-- Function -->
<?php
function formatRP($angka){
  $jadi = number_format($angka,0,',','.');
  return $jadi;
}

?>

<table class="table table-hover dataTable table w-full" id="exampleTableTools" >
  <thead>
    <tr>
      <th style="background:  #ececec;">#</th>
      <!-- <th style="background:  #ececec;">Kode</th> -->
      <th style="background:  #ececec;">Tanggal Order</th>
      <th style="background:  #ececec;">Jatuh Tempo</th>
      <th style="background:  #ececec;">Total Tagihan</th>
      <th style="background:  #ececec;">Pembayaran</th>
      <th class="text-nowrap" style="background:  #ececec;">Action</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $i=1; $total = 0;
    if (!is_null($tagihan))
      foreach ($tagihan as $tg) {
        ?>
        <tr>
          <td><?php echo $i; ?></td>
          <!-- <td class=""><?php echo $tg -> id_order; ?></td> -->
          <td class=""><?php echo date("d F Y",strtotime($tg -> tanggal_order)); ?></td>
          <td class=""><?php echo date("d F Y",strtotime($tg -> jatuh_tempo)); ?></td>
          <td class="">Rp. <?php echo formatRP($tg -> total_tagihan); ?></td>
          <td class="">
          <?php
            if ($tg -> jumpembayaran == $tg -> total_tagihan) {
              echo '<span class="badge badge-lg badge-success">Lunas</span>';
            } elseif ($tg -> jumpembayaran !=0) {
              echo '<span class="badge badge-lg badge-warning">Bayar Sebagian</span>';
            } else {
              echo '<span class="badge badge-lg badge-danger">Belum Dibayar</span>';
            } 
          ?>                            
          </td>
          <td class="text-nowrap">
          <button class="btn btn-sm btn-icon btn-info btn-outline" onclick="detail_account(<?php echo $tg->id_order; ?>)" data-content="Melihat rincian tagihan" data-trigger="hover" data-toggle="popover" data-original-title="Lihat Detail" tabindex="0" title="" type="button">
            <i class="icon wb-info-circle" aria-hidden="true"></i>
          </button>
        </td>
      </tr> 
    <?php  

    $total = $total + $tg -> total_tagihan;

    $i++; 
    } ?>
    <tr>
      <td></td>
      <td colspan="2"><b>Grand Total</b></td>
      <td class="page-invoice-amount"><b>Rp. <?php  echo formatRP($total) ?></b></td>
      <td></td>
      <td class="text-nowrap">
        <a href="<?php echo site_url('tagihanorder/cetakLaporan/'.$start.'/'.$end) ?>">
          <button type="button" class="btn btn-success btn-outline">
            <span><i class="icon wb-print" aria-hidden="true"></i> Print</span>
          </button>
        </a>
      </td>
    </tr>
  </tbody>
</table>

<?php endif; ?>