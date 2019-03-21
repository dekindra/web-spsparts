        <form id="exampleWizardForm" action="<?=base_url()?>gudang/insert" method="post" enctype="multipart/form-data">
           <!-- Panel Wizard Form -->
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

            <div class="panel" style="text-align: left;" >
              <div class="panel-heading">
                <h3 class="panel-title">Form Pendaftaran Gudang</h3>
              </div>
              <div class="panel-body">
                <!-- Steps -->
                <div class="steps steps-sm row" data-plugin="matchHeight" data-by-row="true" role="tablist">
                  <div class="step col-lg-4 current" data-target="#exampleAccount" role="tab">
                    <span class="step-number">1</span>
                    <div class="step-desc">
                      <span class="step-title">Akun</span>
                      <p>Masuk SPS dengan akun ini.</p>
                    </div>
                  </div>

                  <div class="step col-lg-4" data-target="#exampleBilling" role="tab">
                    <span class="step-number">2</span>
                    <div class="step-desc">
                      <span class="step-title">Profil</span>
                      <p>Informasi gudang</p>
                    </div>
                  </div>

                  <div class="step col-lg-4" data-target="#exampleGetting" role="tab">
                    <span class="step-number">3</span>
                    <div class="step-desc">
                      <span class="step-title">Selesai</span>
                      <p>Menunggu Persetujuan</p>
                    </div>
                  </div>
                </div>
                <!-- End Steps -->

                <!-- Wizard Content -->
                <div class="wizard-content">
                  <div class="wizard-pane active" id="exampleAccount" role="tabpanel">
                    <div id="exampleAccountForm">
                      <!-- <div class="form-group">
                        <label class="form-control-label" for="inputUserName">Username</label>
                        <input type="text" class="form-control" id="inputUserName" name="username" required="required">
                      </div> -->
                      <div class="form-group form-material floating" data-plugin="formMaterial">
                        <input type="text" class="form-control" name="email"/>
                        <label class="floating-label">E-mail</label>
                      </div>
                     <!--  <div class="form-group">
                        <label class="form-control-label" for="inputPassword">Password</label>
                        <input type="password" class="form-control" id="inputPassword" name="password"
                          required="required">
                      </div> -->
                      <div class="form-group form-material floating" data-plugin="formMaterial">
                        <input type="password" class="form-control" name="password"/>
                        <label class="floating-label">Password</label>
                      </div>
                    </div>
                  </div>
                  <div class="wizard-pane" id="exampleBilling" role="tabpanel">
                    <div id="exampleBillingForm">
                      <!-- <div class="form-group">
                        <label class="form-control-label" for="inputCardNumber">Card Number</label>
                        <input type="text" class="form-control" id="inputCardNumber" name="nomer" placeholder="Card number">
                      </div>
                      <div class="form-group">
                        <label class="form-control-label" for="inputCVV">CVV</label>
                        <input type="text" class="form-control" id="" name="cvv" placeholder="CVV">
                      </div> -->
                      <div class="form-group form-material floating" data-plugin="formMaterial">
                        <input type="text" class="form-control" name="nama" required="required" />
                        <label class="floating-label">Nama Gudang</label>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group form-material floating" data-plugin="formMaterial">
                            <input type="text" class="form-control" name="instansi"/>
                            <label class="floating-label">Instansi</label>
                          </div>
                        </div>
                         <div class="col-md-6">
                          <div class="form-group form-material floating" data-plugin="formMaterial">
                            <input type="text" class="form-control" name="telepon" required="required" />
                            <label class="floating-label">Telepon Instansi</label>
                          </div>
                        </div>
                      </div>
                      <div class="form-group form-material floating" data-plugin="formMaterial">
                        <input type="text" class="form-control" name="alamat" required="required" />
                        <label class="floating-label">Alamat</label>
                      </div>
                      <div class="form-group form-material floating" data-plugin="formMaterial">
                        <input type="text" class="form-control" name="area" required="required" />
                        <label class="floating-label">Area Gudang</label>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group form-material floating" data-plugin="formMaterial">
                            <input type="text" class="form-control" name="pj"/>
                            <label class="floating-label">Penanggung Jawab</label>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group form-material floating" data-plugin="formMaterial">
                            <input type="text" class="form-control" name="telpj"/>
                            <label class="floating-label">Telepon Penanggung Jawab</label>
                          </div>
                        </div>
                      </div>
                      <!-- <div class="form-group form-material floating" data-plugin="formMaterial">
                        <input type="email" class="form-control" name="email"/>
                        <label class="floating-label">Email Penanggung Jawab</label>
                      </div> -->
                      <div class="row">
                        <!-- <div class="col-md-6">
                          <div class="form-group form-material floating" data-plugin="formMaterial">
                            <input type="text" class="form-control" readonly="" />
                            <input type="file" name="ktp" multiple="" />
                            <label class="floating-label">KTP Penanggung Jawab..</label>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group form-material floating" data-plugin="formMaterial">
                            <input type="text" class="form-control" readonly="" />
                            <input type="file" name="wh" multiple="" />
                            <label class="floating-label">Photo Rencana Gudang..</label>
                          </div>
                        </div> -->
                        <div class="col-md-6">
                          <!-- Example max file size -->
                          <div class="">
                            <h4 class="">KTP Penanggung Jawab.. (PNG/JPG)</h4>
                            <div class="example">
                              <input type="file" name="ktp" id="input-file-max-fs" data-plugin="dropify" data-max-file-size="1M"
                              />
                            </div>
                          </div>
                          <!-- End Example max file size -->
                        </div>
                        <div class="col-md-6">
                          <!-- Example max file size -->
                          <div class="">
                            <h4 class="example-title">Ruang Usaha.. (PNG/JPG)</h4>
                            <div class="example">
                              <input type="file" name="wh" id="input-file-max-fs" data-plugin="dropify" data-max-file-size="1M"
                              />
                            </div>
                          </div>
                          <!-- End Example max file size -->
                        </div>
                      </div>

                    </div>
                  </div>
                  <div class="wizard-pane" id="exampleGetting" role="tabpanel">
                    <div class="text-center my-20">
                      <i class="icon wb-check font-size-40" aria-hidden="true"></i>
                      <h4>Terimakasih telah mendaftar menjadi partner kami. Kami akan segera mengirim anda e-mail</h4>
                    </div>
                  </div>
                </div>
                <!-- End Wizard Content -->

              </div>
            </div>
            <!-- End Panel Wizard One Form -->
          </form>