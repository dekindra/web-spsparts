

<?php if(empty($penjualan)){echo "<b>Tidak Ada Data</b>";} ?>
<?php if(!empty($penjualan)): ?>
<!-- Function -->
<?php
function formatRP($angka){
  $jadi = number_format($angka,0,',','.');
  return $jadi;
}

?>
            <div class="col-8">
              <h2 class="text-center">Laporan Laba Rugi</h2>
                  <span><h4 class="text-center">Periode: <?php echo date("d M Y",strtotime($start)); ?> - <?php echo date("d M Y",strtotime($end)); ?></h4></span>
              <table class="table table-hover text-right">
                <tbody>
                  <tr>
                    <td>
                    </td>
                    <td class="text-left" colspan="4" style="font-size: 16px">
                      <b>Pendapatan</b>
                    </td>
                  </tr>
                  <tr>
                    <td></td>
                    <td class="text-left"><span style="padding-left: 10px">Pendapatan</span></td>
                    <td></td>
                    <td>Rp. <?php echo formatRP($penjualan->totalpenjualan) ?></td>
                  </tr>
                  <tr>
                    <td colspan="5"></td>
                  </tr>
                  <tr>
                    <td></td>
                    <td class="text-left" colspan="4" style="font-size: 16px"><b>Beban-beban</b></td>
                  </tr>
                     <?php
                     $beban = 0;
                        if (!is_null($bebans)){
                        foreach ($bebans as $bb) {
                      ?>
                      <tr>
                        <td></td>
                        <td class="text-left"><span style="padding-left: 10px"><?php echo $bb->name ?></span></td>
                        <td>Rp. <?php echo formatRP($bb->totalbeban) ?></td>
                        <td></td>
                      </tr>
                    <?php
                     $beban = $beban + $bb->totalbeban;
                     }
                      }else{ ?>
                      <tr>
                        <td></td>
                        <td class="text-left"><span style="padding-left: 10px">Tidak ada pengeluaran</span></td>
                        <td></td>
                        <td></td>
                      </tr>
                    <?php } ?>

                  <tr>
                    <td></td>
                    <td class="text-left" style="font-size: 16px">Total Beban</td>
                    <td></td>
                    <td>Rp. <?php echo formatRP($beban); ?></td>
                  </tr>
                  <tr>
                    <td colspan="5"></td>
                  </tr>
                  <tr>
                    <td></td>
                    <td class="text-left" style="font-size: 18px"><b>Laba</b></td>
                    <td></td>
                    <td style="font-size: 18px">Rp. <?php echo formatRP($penjualan->totalpenjualan - $beban) ?></td>
                  </tr>

                </tbody>
              </table>
            </div>
            <div class="text-right">
              <a href="<?php echo site_url('dashboard/cetakLaporan/'.$start.'/'.$end) ?>">
                <button type="button" class="btn btn-success btn-outline">
                  <span><i class="icon wb-print" aria-hidden="true"></i> Print</span>
                </button>
              </a>
            </div>
          </div>
<?php endif; ?>