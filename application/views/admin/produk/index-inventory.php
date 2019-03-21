      <!-- Function -->
      <?php 
        function formatRP($angka){
         $jadi = number_format($angka,0,',','.');
         return $jadi;
        }
     ?>

      <div class="page-header">
        <h1 class="page-title"><?php  echo $title ?></h1>
        <!-- <div class="page-header-actions">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="../index.html">Home</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0)">Tables</a></li>
            <li class="breadcrumb-item active">Basic</li>
          </ol>
        </div> -->
      </div>

      <div class="page-content">
       <!-- Panel Table Tools -->
        <div class="panel">
          <!-- <header class="panel-heading">
            <h3 class="panel-title">Table Tools</h3>
          </header> -->
          <div class="panel-body">
            <table class="table table-hover dataTable table w-full" id="exampleTableTools">
              <thead>
                <tr>
                  <th class="text-center" style="background:  #ececec;">Kode</th>
                  <th class="text-center" style="background:  #ececec;">Nama</th>
                  <th class="text-center" style="background:  #ececec;">Kategori</th>
                  <th class="text-center" style="background:  #ececec;">Het</th>
                  <th class="text-center" style="background:  #ececec;">Gudang [Disc]</th>
                  <th class="text-center" style="background:  #ececec;">Bengkel [Disc]</th>
                  <th class="text-center" style="background:  #ececec;">Stock</th>
                </tr>
              </thead>
              <tbody>
                <!-- <tr>
                  <td>BN002</td>
                  <td>Pirelli</td>
                  <td>Ban</td>
                  <td><span class="badge badge-danger">2</span></td>
                <tr>
                  <td>OL001</td>
                  <td>Yamalube</td>
                  <td>Oli</td>
                  <td><span class="badge badge-success">16</span></td>
                </tr> -->
                <?php
                  $i=1;
                    if (!is_null($inventoris))
                    foreach ($inventoris as $in) {
                  ?>
                  <tr>
                    <!-- <td><?php echo $i; ?></td> -->
                    <td class=""><?php echo $in -> code_p; ?></td>
                    <!-- <div class="pr-20">
                          <a class="avatar" href="#">
                            <img class="img-responsive" src="../../../global/portraits/1.jpg" alt="..." />
                          </a>
                        </div> -->
                    <!-- if($in->photo)
                        $row[] = '<span class="pull-left"><a href="'.base_url('upload/ps/'.$in->photo).'" target="_blank"><img src="'.base_url('upload/ps/'.$in->photo).'" class="img-circle" style="width:25px;border-radius:50%" /></a></span><span><a onclick="detail_account('."'".$in->nipy."'".')" href="javascript:void(0);">'.$in->nama.'</span>';
                    else
                        $row[] = '<span><a onclick="detail_account('."'".$in->nipy."'".')" href="javascript:void(0);">'.$in->nama.'</span>'; -->
                    <td class="">
                      <?php if ($in -> thumbnail) :?>
                         <!-- <span class=""> -->
                          <a class="avatar" href="<?php echo base_url(); ?>assets/images/produk/<?php echo $in -> thumbnail; ?>" target="_blank">
                            <img class="img-responsive" src="<?php echo base_url(); ?>assets/images/produk/<?php echo $in -> thumbnail; ?>"/>
                          </a>
                        <!-- </span> -->
                        <?php echo $in -> name_p; ?>
                      <?php else: ?>
                        <?php echo $in -> name_p; ?>
                    <?php endif; ?>
                    </td>
                    <td class=""><?php echo $in -> name_kp; ?></td>
                    <td class="">Rp <?php echo formatRP($in -> purchase_price); ?></td>
                    <td class="">Rp <?php echo formatRP($in -> purchase_price * (100 - $in -> het_gudang) / 100); ?> [<?php echo $in -> het_gudang; ?>%]</td>
                    <td class="">Rp <?php echo formatRP($in -> purchase_price * (100 - $in -> het_bengkel) / 100); ?> [<?php echo $in -> het_bengkel; ?>%]</td>
                    <?php if($in -> stock < $setting->min_stock): ?>
                      <td class=""><span class="badge badge-lg badge-danger"><?php echo $in -> stock; ?></span></td>
                    <?php elseif ($in -> stock < ($setting->min_stock * 2)): ?>
                       <td class=""><span class="badge badge-lg badge-warning"><?php echo $in -> stock; ?></span></td>
                    <?php else: ?>
                      <td class=""><span class="badge badge-lg badge-success"><?php echo $in -> stock; ?></span></td>
                    <?php endif ?>
                  </tr> 
                <?php  $i++; } ?>
              </tbody>
            </table>
          </div>
        </div>
        <!-- End Panel Table Tools -->
      </div>
