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
          <header class="panel-heading">
            <h3 class="panel-title">Tunggakan Gudang</h3>
          </header>
          <div class="panel-body">
            <!-- <div class="row">
              <div class="col-md-6">
                <div class="mb-15">
                  <button  class="btn btn-outline btn-primary" data-target="#exampleNiftyFadeScale"
                      data-toggle="modal" type="button"><i class="icon wb-plus" aria-hidden="true"></i> Tambah
                  </button>
                </div>
              </div> -->
                    <!-- Modal -->
                    <!-- <div class="modal fade modal-fade-in-scale-up" id="exampleNiftyFadeScale" aria-hidden="true"
                      aria-labelledby="exampleModalTitle" role="dialog" tabindex="-1">
                      <div class="modal-dialog modal-simple modal-lg">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">×</span>
                            </button>
                            <h4 class="modal-title">Buat Return</h4>
                          </div>
                          <div class="modal-body"> -->
                            <!-- <form autocomplete="off">
                              <div class="form-group form-material floating has-danger" data-plugin="formMaterial">
                                <input type="text" class="form-control" name="kode" data-hint="Masukkan Kode Barang"
                                />
                                <label class="floating-label">Kode</label>
                              </div>
                              <div class="form-group form-material floating has-danger" data-plugin="formMaterial">
                                <input type="text" class="form-control" name="nama" data-hint="Masukkan Nama Barang"
                                />
                                <label class="floating-label">Nama</label>
                              </div>
                              <div class="form-group form-material floating" data-plugin="formMaterial">
                                <select class="form-control">
                                  <option>&nbsp;</option>
                                  <option>1</option>
                                  <option>2</option>
                                  <option>3</option>
                                  <option>4</option>
                                  <option>5</option>
                                </select>
                                <label class="floating-label">Kategori</label>
                              </div>
                              <div class="form-group form-material floating" data-plugin="formMaterial">
                                <div class="input-group">
                                  <span class="input-group-addon">Rp.</span>
                                  <div class="form-control-wrap">
                                    <input type="text" class="form-control" name="beli" data-hint="Masukkan Harga Beli Barang" />
                                    <label class="floating-label">Harga Beli</label>
                                  </div>
                                </div>
                              </div>
                              <div class="form-group form-material floating" data-plugin="formMaterial">
                                <div class="input-group">
                                  <span class="input-group-addon">Rp.</span>
                                  <div class="form-control-wrap">
                                    <input type="text" class="form-control" name="jual" data-hint="Masukkan Harga Jual Barang" />
                                    <label class="floating-label">Harga Jual</label>
                                  </div>
                                </div>
                              </div>
                              <div class="form-group form-material floating" data-plugin="formMaterial">
                                <input type="text" class="form-control" readonly="" />
                                <input type="file" name="inputFloatingFile" multiple="" />
                                <label class="floating-label">Browse..</label>
                              </div>
                            </form> -->
                           <!--  <form autocomplete="off">
                              <div class="row">
                                
                                <div class="col-md-6"> -->
                                  <!-- Panel Static Labels -->
                                  <!-- <div class="panel"> -->
                                    <!-- <div class="panel-heading">
                                      <h3 class="panel-title">Static Labels</h3>
                                    </div> -->
                                    <!-- <div class="panel-body container-fluid"> -->
                                      <!-- <form autocomplete="off"> -->
                                       <!--  <div class="form-group form-material floating" data-plugin="formMaterial">
                                                  <select class="form-control">
                                            <option>&nbsp;</option>
                                            <option>1</option>
                                            <option>2</option>
                                            <option>3</option>
                                            <option>4</option>
                                            <option>5</option>
                                          </select>
                                          <label class="floating-label">Supplier</label>
                                        </div> -->
                                        <!-- <div class="form-group form-material floating" data-plugin="formMaterial">
                                                     <div class="input-group">
                                                        <input type="text" class="form-control" data-plugin="datepicker">
                                                        <label class="floating-label">Tanggal</label>
                                                      </div>
                                                    </div> -->
                                      <!-- </form> -->
                                    <!-- </div> -->
                                  <!-- </div> -->
                                  <!-- End Panel Static Labels -->
                               <!--  </div>
                                <div class="col-md-6"> -->
                                  <!-- Panel Floating Labels -->
                                  <!-- <div class="panel"> -->
                                    <!-- <div class="panel-heading">
                                      <h3 class="panel-title">Total</h3>
                                    </div> -->
                                    <!-- <div class="panel-body container-fluid"> -->
                                        <!-- <div class="form-group form-material floating" data-plugin="formMaterial">
                                          <div class="input-group">
                                            <span class="input-group-addon">Rp</span>
                                            <div class="form-control-wrap">
                                              <input type="text" class="form-control" />
                                              <label class="floating-label">Total Return</label>
                                            </div>
                                          </div>
                                        </div> -->
                                    <!-- </div> -->
                                  <!-- </div> -->
                                  <!-- End Panel Floating Labels -->
                               <!--  </div>
                              </div> -->
                               <!-- Panel Table Tools -->
                              <!-- <div class="panel"> -->
                                <!-- <header class="panel-heading">
                                  <h3 class="panel-title">Tambah Return</h3>
                                </header> -->
                                <!-- <div class="panel-body"> -->
                                  <!-- <div class="table-responsive">
                                  <table class="table table-hover" id="cart">
                                    <thead>
                                      <tr>
                                        <th>#</th>
                                        <th>Barang</th>
                                        <th>Harga</th>
                                        <th>Qty</th>
                                        <th>Sub Total</th>
                                        <th class="text-nowrap">&nbsp;</th>
                                      </tr>
                                      <tbody> -->
                                                  <!-- Dynamic -->
                                      <!-- </tbody>
                                    </thead>
                                  </table>
                                </div> -->
                                  <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Tambah</button>
                                  <button type="button" class="btn btn-primary">Simpan</button> -->
                                <!-- </div> -->
                              <!-- </div> -->
                            <!-- </form>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" id="tambah">Tambah</button>
                            <button type="button" class="btn btn-primary">Simpan</button>
                          </div>
                        </div>
                      </div>
                    </div> -->
                    <!-- End Modal -->
            <!-- </div> -->
            <table class="table table-hover dataTable table w-full" data-plugin="dataTable">
            <!-- <table class="table table-hover dataTable table w-full" id="exampleTableTools" > -->
              <thead>
                <tr>
                  <th>#</th>
                  <th>Gudang</th>
                  <th>Jumlah Menunggak</th>
                  <th>Total</th>
                </tr>
              </thead>
              <tbody>
                <!-- <tr>
                  <td>1</td>
                  <td>Smksw Jaya</td>
                  <td><span class="badge badge-lg badge-warning">1</span></td>
                </tr>
                <tr>
                  <td>2</td>
                  <td>Karet Jaya</td>
                  <td><span class="badge badge-lg badge-warning">1</span></td>
                </tr> -->
                <?php
                  $i=1;
                    if (!is_null($tunggakangudangs))
                    foreach ($tunggakangudangs as $tg) {
                ?>
                    <tr>
                      <td><?php echo $i; ?></td>
                      <td class=""><?php echo $tg -> name; ?></td>
                      <td><span class="badge badge-lg badge-warning"><?php echo $tg->tunggakan ?></span> Kali</td>
                      <td><span class="badge badge-lg badge-warning">Rp. <?php echo formatRP($tg->nominal) ?></span></td>
                    </tr> 
                <?php  $i++; } ?>
              </tbody>
            </table>
          </div>
        </div>
        <!-- End Panel Table Tools -->
        <!-- Panel Table Tools -->
        <div class="panel">
          <header class="panel-heading">
            <h3 class="panel-title">Tunggakan Bengkel</h3>
          </header>
          <div class="panel-body">
            <!-- <div class="row">
              <div class="col-md-6">
                <div class="mb-15">
                  <button  class="btn btn-outline btn-primary" data-target="#exampleNiftyFadeScale"
                      data-toggle="modal" type="button"><i class="icon wb-plus" aria-hidden="true"></i> Tambah
                  </button>
                </div>
              </div> -->
                    <!-- Modal -->
                    <!-- <div class="modal fade modal-fade-in-scale-up" id="exampleNiftyFadeScale" aria-hidden="true"
                      aria-labelledby="exampleModalTitle" role="dialog" tabindex="-1">
                      <div class="modal-dialog modal-simple modal-lg">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">×</span>
                            </button>
                            <h4 class="modal-title">Buat Return</h4>
                          </div>
                          <div class="modal-body"> -->
                            <!-- <form autocomplete="off">
                              <div class="form-group form-material floating has-danger" data-plugin="formMaterial">
                                <input type="text" class="form-control" name="kode" data-hint="Masukkan Kode Barang"
                                />
                                <label class="floating-label">Kode</label>
                              </div>
                              <div class="form-group form-material floating has-danger" data-plugin="formMaterial">
                                <input type="text" class="form-control" name="nama" data-hint="Masukkan Nama Barang"
                                />
                                <label class="floating-label">Nama</label>
                              </div>
                              <div class="form-group form-material floating" data-plugin="formMaterial">
                                <select class="form-control">
                                  <option>&nbsp;</option>
                                  <option>1</option>
                                  <option>2</option>
                                  <option>3</option>
                                  <option>4</option>
                                  <option>5</option>
                                </select>
                                <label class="floating-label">Kategori</label>
                              </div>
                              <div class="form-group form-material floating" data-plugin="formMaterial">
                                <div class="input-group">
                                  <span class="input-group-addon">Rp.</span>
                                  <div class="form-control-wrap">
                                    <input type="text" class="form-control" name="beli" data-hint="Masukkan Harga Beli Barang" />
                                    <label class="floating-label">Harga Beli</label>
                                  </div>
                                </div>
                              </div>
                              <div class="form-group form-material floating" data-plugin="formMaterial">
                                <div class="input-group">
                                  <span class="input-group-addon">Rp.</span>
                                  <div class="form-control-wrap">
                                    <input type="text" class="form-control" name="jual" data-hint="Masukkan Harga Jual Barang" />
                                    <label class="floating-label">Harga Jual</label>
                                  </div>
                                </div>
                              </div>
                              <div class="form-group form-material floating" data-plugin="formMaterial">
                                <input type="text" class="form-control" readonly="" />
                                <input type="file" name="inputFloatingFile" multiple="" />
                                <label class="floating-label">Browse..</label>
                              </div>
                            </form> -->
                           <!--  <form autocomplete="off">
                              <div class="row">
                                
                                <div class="col-md-6"> -->
                                  <!-- Panel Static Labels -->
                                  <!-- <div class="panel"> -->
                                    <!-- <div class="panel-heading">
                                      <h3 class="panel-title">Static Labels</h3>
                                    </div> -->
                                    <!-- <div class="panel-body container-fluid"> -->
                                      <!-- <form autocomplete="off"> -->
                                       <!--  <div class="form-group form-material floating" data-plugin="formMaterial">
                                                  <select class="form-control">
                                            <option>&nbsp;</option>
                                            <option>1</option>
                                            <option>2</option>
                                            <option>3</option>
                                            <option>4</option>
                                            <option>5</option>
                                          </select>
                                          <label class="floating-label">Supplier</label>
                                        </div> -->
                                        <!-- <div class="form-group form-material floating" data-plugin="formMaterial">
                                                     <div class="input-group">
                                                        <input type="text" class="form-control" data-plugin="datepicker">
                                                        <label class="floating-label">Tanggal</label>
                                                      </div>
                                                    </div> -->
                                      <!-- </form> -->
                                    <!-- </div> -->
                                  <!-- </div> -->
                                  <!-- End Panel Static Labels -->
                               <!--  </div>
                                <div class="col-md-6"> -->
                                  <!-- Panel Floating Labels -->
                                  <!-- <div class="panel"> -->
                                    <!-- <div class="panel-heading">
                                      <h3 class="panel-title">Total</h3>
                                    </div> -->
                                    <!-- <div class="panel-body container-fluid"> -->
                                        <!-- <div class="form-group form-material floating" data-plugin="formMaterial">
                                          <div class="input-group">
                                            <span class="input-group-addon">Rp</span>
                                            <div class="form-control-wrap">
                                              <input type="text" class="form-control" />
                                              <label class="floating-label">Total Return</label>
                                            </div>
                                          </div>
                                        </div> -->
                                    <!-- </div> -->
                                  <!-- </div> -->
                                  <!-- End Panel Floating Labels -->
                               <!--  </div>
                              </div> -->
                               <!-- Panel Table Tools -->
                              <!-- <div class="panel"> -->
                                <!-- <header class="panel-heading">
                                  <h3 class="panel-title">Tambah Return</h3>
                                </header> -->
                                <!-- <div class="panel-body"> -->
                                  <!-- <div class="table-responsive">
                                  <table class="table table-hover" id="cart">
                                    <thead>
                                      <tr>
                                        <th>#</th>
                                        <th>Barang</th>
                                        <th>Harga</th>
                                        <th>Qty</th>
                                        <th>Sub Total</th>
                                        <th class="text-nowrap">&nbsp;</th>
                                      </tr>
                                      <tbody> -->
                                                  <!-- Dynamic -->
                                      <!-- </tbody>
                                    </thead>
                                  </table>
                                </div> -->
                                  <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Tambah</button>
                                  <button type="button" class="btn btn-primary">Simpan</button> -->
                                <!-- </div> -->
                              <!-- </div> -->
                            <!-- </form>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" id="tambah">Tambah</button>
                            <button type="button" class="btn btn-primary">Simpan</button>
                          </div>
                        </div>
                      </div>
                    </div> -->
                    <!-- End Modal -->
            <!-- </div> -->
            <table class="table table-hover dataTable table w-full" data-plugin="dataTable">
            <!-- <table class="table table-hover dataTable table w-full" id="exampleTableTools1" > -->
              <thead>
                <tr>
                  <th>#</th>
                  <th>Bengkel</th>
                  <th>Gudang</th>
                  <th>Jumlah Menunggak</th>
                  <th>Total</th>
                </tr>
              </thead>
              <tbody>
                <!-- <tr>
                  <td>1</td>
                  <td>Jaya SMK</td>
                  <td>Smksw Jaya</td>
                  <td><span class="badge badge-lg badge-warning">7</span></td>
                </tr>
                <tr>
                  <td>2</td>
                  <td>Maju terus</td>
                  <td>Smksw Jaya</td>
                  <td><span class="badge badge-lg badge-warning">3</span></td>
                </tr> -->
                <?php
                  $i=1;
                    if (!is_null($tunggakanbengkels))
                    foreach ($tunggakanbengkels as $tg) {
                ?>
                    <tr>
                      <td><?php echo $i; ?></td>
                      <td class=""><?php echo $tg -> namabengkel; ?></td>
                      <td class=""><?php echo $tg -> namagudang; ?></td>
                      <td><span class="badge badge-lg badge-warning"><?php echo $tg->tunggakan ?></span> Kali</td>
                      <td><span class="badge badge-lg badge-warning">Rp. <?php echo formatRP($tg->nominal) ?></span></td>
                    </tr> 
                <?php  $i++; } ?>
              </tbody>
            </table>
          </div>
        </div>
        <!-- End Panel Table Tools -->
      </div>