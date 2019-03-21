

<?php if(empty($order)){echo "<b>Tidak Ada Data</b>";} ?>
<?php if(!empty($order)): ?>
<!-- Function -->
<?php
function formatRP($angka){
  $jadi = number_format($angka,0,',','.');
  return $jadi;
}

?>
<div class="mb-15">
  <p>Total Transaksi : <?php  echo($judulorder->totaltransaksi) ?></p>
  <p>Total order    : <b>Rp. <?php  echo formatRP($judulorder->totalpembelian) ?></b></p>
  <a href="<?php echo site_url('ordergudang/cetakLaporan/'.$start.'/'.$end.'/'.$status) ?>">
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
      <th style="background:  #ececec;">Tanggal</th>
      <th style="background:  #ececec;">Total Order</th>
      <th style="background:  #ececec;">Status</th>
      <th class="text-nowrap" style="background:  #ececec;">Action</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $i=1;
    if (!is_null($order))
      foreach ($order as $or) {
        ?>
        <tr>
          <td><?php echo $i; ?></td>
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
          <td class="text-nowrap">
          <button class="btn btn-sm btn-icon btn-info btn-outline" onclick="detail_account(<?php echo $or->id_order; ?>)" data-content="Melihat rincian order" data-trigger="hover" data-toggle="popover" data-original-title="Lihat Detail" tabindex="0" title="" type="button">
            <i class="icon wb-info-circle" aria-hidden="true"></i>
          </button>
        </td>
      </tr> 
    <?php  $i++; } ?>
    <tr>
      <td></td>
      <td><b>Grand Total</b></td>
      <td class="page-invoice-amount"><b>Rp. <?php  echo formatRP($judulorder->totalpembelian) ?></b></td>
      <td></td>
      <td class="text-nowrap">
        <a href="<?php echo site_url('ordergudang/cetakLaporan/'.$start.'/'.$end.'/'.$status) ?>">
          <button type="button" class="btn btn-success btn-outline">
            <span><i class="icon wb-print" aria-hidden="true"></i> Print</span>
          </button>
        </a>
      </td>
    </tr>
  </tbody>
</table>

<?php endif; ?>