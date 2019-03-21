      <div class="page-content container-fluid">
        <div class="row">
          <div class="col-lg-3">
            <!-- Page Widget -->
            <div class="card card-shadow text-center">
              <div class="card-block">
                <a class="avatar avatar-lg" href="javascript:void(0)">
                  <?php if ($this->session->userdata('role') >1 ): ?>
                    <?php if ($profils -> photo): ?>
                      <?php if ($this->session->userdata('type') == 'gudang'): ?>
                        <img src="<?php echo base_url(); ?>assets/images/gudang/<?php echo $profils -> photo ?>" alt="...">
                      <?php elseif ($this->session->userdata('type') == 'bengkel'): ?>
                        <img src="<?php echo base_url(); ?>assets/images/bengkel/<?php echo $profils -> photo ?>" alt="...">
                      <?php else: ?>
                        <img src="<?php echo base_url(); ?>assets/images/kasir/<?php echo $profils -> photo ?>" alt="...">
                      <?php endif ?>
                      <!-- <img src="<?php echo base_url(); ?>assets/images/gudang/<?php echo $profils -> photo ?>" alt="..."> -->
                    <?php else: ?>
                        <img src="<?php echo base_url(); ?>assets/images/d.png" alt="...">
                    <?php endif ?>
                  <?php else: ?>
                        <img src="<?php echo base_url(); ?>assets/images/d.png" alt="...">
                  <?php endif ?>
                </a>
                <h4 class="profile-user"><?php echo $profils->email ?></h4>
                <?php if ($this->session->userdata('type') == 'gudang'): ?>
                  <p class="profile-job">Admin Gudang</p>
                <?php elseif ($this->session->userdata('type') == 'bengkel'): ?>
                  <p class="profile-job">Admin Bengkel</p>
                <?php elseif ($this->session->userdata('type') == 'admin'): ?>
                  <p class="profile-job">Admin</p>
                <?php else: ?>
                  <p class="profile-job">Kasir</p>
                <?php endif ?>
                <?php if ($this->session->userdata('type') == 'gudang'): ?>
                  <p>Hi! I'm <?php echo $profils -> pj ?> the Admin of gudang <?php echo $profils -> name ?> </p>
                <?php elseif ($this->session->userdata('type') == 'bengkel'): ?>
                  <p>Hi! I'm <?php echo $profils -> pj ?> the Admin of bengkel <?php echo $profils -> name ?> </p>
                <?php elseif ($this->session->userdata('type') == 'admin'): ?>
                  <p>Hi! I'm <?php echo $profils -> name ?> the Admin of SPS Parts.</p>
                <?php else: ?>
                  <p>Hi! I'm <?php echo $profils -> namakasir ?> the Kasir of bengkel <?php echo $profils -> namabengkel ?> </p>
                <?php endif ?>
                <!-- <div class="profile-social">
                  <a class="icon bd-twitter" href="javascript:void(0)"></a>
                  <a class="icon bd-facebook" href="javascript:void(0)"></a>
                  <a class="icon bd-dribbble" href="javascript:void(0)"></a>
                  <a class="icon bd-github" href="javascript:void(0)"></a>
                </div> -->
                <!-- <button type="button" class="btn btn-primary">Follow</button> -->
              </div>
             <!--  <div class="card-footer">
                <div class="row no-space">
                  <div class="col-4">
                    <strong class="profile-stat-count">260</strong>
                    <span>Follower</span>
                  </div>
                  <div class="col-4">
                    <strong class="profile-stat-count">180</strong>
                    <span>Following</span>
                  </div>
                  <div class="col-4">
                    <strong class="profile-stat-count">2000</strong>
                    <span>Tweets</span>
                  </div>
                </div>
              </div> -->
            </div>
            <!-- End Page Widget -->
          </div>

          <div class="col-lg-9">
            <!-- Panel -->
            <div class="panel">
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
              <div class="panel-body">
                <form autocomplete="off" id="form">
                  <?php if ($this->session->userdata('type') == 'gudang'): ?>
                    <input type="hidden" value="<?php echo $profils -> id_gudang ?>" name="id">
                    <?php elseif ($this->session->userdata('type') == 'bengkel'): ?>
                    <input type="hidden" value="<?php echo $profils -> id_bengkel ?>" name="id">
                    <?php elseif ($this->session->userdata('type') == 'admin'): ?>
                    <input type="hidden" value="<?php echo $profils -> id ?>" name="id">
                    <?php else: ?>
                    <input type="hidden" value="<?php echo $profils -> id_kasir ?>" name="id">
                  <?php endif ?>

                  <!-- <input type="hidden" name="gambar" value="<?php echo $profils -> photo ?>"> -->
                  <div class="form-group form-material floating" data-plugin="formMaterial">
                    <?php if ($this->session->userdata('type') == 'gudang' || $this->session->userdata('type') == 'bengkel'): ?>
                    <input type="text" class="form-control" name="nama" data-hint="Masukkan nama lengkap anda" value="<?php echo $profils -> pj ?>"/>
                    <?php elseif($this->session->userdata('type') == 'admin'): ?>
                      <input type="text" class="form-control" name="nama" data-hint="Masukkan nama lengkap anda" value="<?php echo $profils -> name ?>"/>
                    <?php else: ?>
                      <input type="text" class="form-control" name="nama" data-hint="Masukkan nama lengkap anda" value="<?php echo $profils -> namakasir ?>"/>
                    <?php endif ?>
                    <label class="floating-label">Nama</label>
                  </div>
                  <div class="form-group form-material floating" data-plugin="formMaterial">
                    <input type="email" class="form-control" name="email" value="<?php echo $profils->email ?>" data-hint="Masuk dengan e-mail ini."/>
                    <label class="floating-label">E-mail</label>
                  </div>
                  <div class="form-group form-material floating" data-plugin="formMaterial">
                    <label class="form-control-label" for="inputPassword2">Password</label>
                    <input type="password" class="form-control" id="inputPassword2" name="inputPasswords" data-plugin="strength" data-show-toggle="true" value="<?php echo $profils->password ?>" />
                    <br>
                  </div>
                  <?php if ($this->session->userdata('role') >1 ): ?>
                  <?php if ($profils -> photo): ?>
                      <br><input type="checkbox" name="remove_photo" value="<?php echo $profils -> photo ?>"/> Remove photo when saving<br>
                      <div class="form-group form-material floating" data-plugin="formMaterial">
                            <input type="text" class="form-control" readonly="" />
                            <input type="file" name="photo" multiple="" />
                            <label class="floating-label">Change Foto..</label>
                      </div>
                    <?php else: ?>
                      <div class="form-group form-material floating" data-plugin="formMaterial">
                            <input type="text" class="form-control" readonly="" />
                            <input type="file" name="photo" multiple="" />
                            <label class="floating-label">Foto..</label>
                      </div>
                  <?php endif ?>
                  <?php endif ?>
                  
                  <button type="button" id="btnSave" onclick="save()" class="btn btn-primary" style="float: right;">Update</button>
                </form>

              </div>
            </div>
            <!-- End Panel -->
          </div>
        </div>
      </div>

<script type="text/javascript">

var save_method; //for save method string
var table;
var base_url = '<?php echo base_url();?>';


function save()
{
    url = "<?php echo site_url('profil/update')?>";

    // ajax adding data to database

    var formData = new FormData($('#form')[0]);
    $.ajax({
        url : url,
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        dataType: "JSON",
        success: function(data)
        {

            if(data.status) //if success close modal and reload ajax table
            {
                $('#exampleNiftyFadeScale').modal('hide');
                // reload_table();
                location.reload();
            }
            else
            {
                for (var i = 0; i < data.inputerror.length; i++) 
                {
                    $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                    $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
                }
            }
            $('#btnSave').text('save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable 


        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error adding / update data');
            $('#btnSave').text('save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable 

        }
    });
}
</script>