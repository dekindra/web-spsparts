          <form id="exampleBillingForm" action="<?=base_url()?>supplier/insert" method="post" enctype="multipart/form-data">
                <!-- Panel Floating Labels -->
                <?php
              $alert_msg = $this->session->flashdata('alert_msg');
                  if (!empty($alert_msg)) {
                    $flash_status = $alert_msg[0];
                    $flash_header = $alert_msg[1];
                    $flash_desc = $alert_msg[2];

                    if ($flash_status == 'failure') {
                ?>
                    <div class="alert alert-alt alert-danger alert-dismissible" style="text-align: left;" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                      <?php echo $flash_header; ?><br><a class="alert-link" style="margin-left: 0" href="javascript:void(0)"><?php echo $flash_desc; ?></a>
                    </div>
                <?php 
                    }
                    if ($flash_status == 'success') {
                ?>
                    <div class="alert alert-alt alert-success alert-dismissible" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                      <?php echo $flash_header; ?>, <a class="alert-link" style="margin-left: 0" href="javascript:void(0)"><?php echo $flash_desc; ?></a>
                    </div>
                <?php
                    }
                  }
                ?>
            <div class="panel" style="text-align: left;">
              <div class="panel-heading">
                <h3 class="panel-title">Form Pendaftaran Supplier</h3>
              </div>
              <div class="panel-body" style="padding-top: 0">
                <div id="" autocomplete="off">
                      <div class="form-group form-material floating" data-plugin="formMaterial">
                        <input type="text" class="form-control" name="nama"/>
                        <label class="floating-label">Nama Perusahaan</label>
                      </div>
                      <div class="form-group form-material floating" data-plugin="formMaterial">
                        <input type="text" class="form-control" name="alamat"/>
                        <label class="floating-label">Alamat Perusahaan</label>
                      </div>
                       <div class="form-group form-material floating" data-plugin="formMaterial">
                        <input type="text" class="form-control" name="telepon"/>
                        <label class="floating-label">Telepon Perusahaan</label>
                      </div>
                      <div class="row">
                        <div class="col-md-7">
                          <div class="form-group form-material floating" data-plugin="formMaterial">
                            <input type="text" class="form-control" name="pj"/>
                            <label class="floating-label">Penanggung Jawab</label>
                          </div>
                        </div>
                        <div class="col-md-5">
                          <div class="form-group form-material floating" data-plugin="formMaterial">
                            <input type="text" class="form-control" name="telpj"/>
                            <label class="floating-label">Telepon PJ</label>
                          </div>
                        </div>
                      </div>
                      <div class="form-group form-material floating" data-plugin="formMaterial">
                        <input type="email" class="form-control" name="email"/>
                        <label class="floating-label">Email Penanggung Jawab</label>
                      </div>
                      <div class="form-group form-material floating" data-plugin="formMaterial">
                        <input type="text" class="form-control" readonly="" />
                        <input type="file" name="file" multiple="" />
                        <label class="floating-label">File Penawaran..</label>
                      </div>
                </div>
                <div class="card-block">
                  <!-- <button type="button" class="btn btn-default card-link" style="float: left;">Kembali</button> -->
                  <button type="submit" class="btn btn-outline btn-success card-link" style="float: right;">Finish</button>
                </div>
              </div>
            </div>
            <!-- End Panel Floating Labels -->
          </form>
       