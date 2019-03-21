      <div class="page-content container-fluid">
        <div class="row">
          <div class="col-lg-3">
            <!-- Page Widget -->
            <div class="card card-shadow text-center">
              <div class="card-block">
                <a class="avatar avatar-lg" href="javascript:void(0)">
                  <?php if ($settings -> site_logo): ?>
                        <img src="<?php echo base_url(); ?>assets/images/<?php echo $settings -> site_logo ?>" alt="...">
                  <?php else: ?>
                        <img src="<?php echo base_url(); ?>assets/images/d.png" alt="...">
                  <?php endif ?>
                </a>
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
                  <input type="hidden" name="id" value="<?php echo $settings -> id ?>">
                  <div class="form-group form-material floating" data-plugin="formMaterial">
                    <input type="text" class="form-control" name="site_name" data-hint="Masukkan nama website." value="<?php echo $settings -> site_name ?>"/>
                    <label class="floating-label">Site Name</label>
                  </div>
                  <div class="form-group form-material floating" data-plugin="formMaterial">
                    <input type="email" class="form-control" name="email" data-hint="Kirim Notifikasi dengan Email ini." value="<?php echo $settings -> email_broadcast ?>"/>
                    <label class="floating-label">E-mail</label>
                  </div>
                  <div class="form-group form-material floating" data-plugin="formMaterial">
                    <label class="form-control-label" for="inputPassword2">Password Email</label>
                    <input type="password" class="form-control" id="inputPassword2" name="password" data-plugin="strength" data-show-toggle="true" value="<?php echo $settings -> password_email ?>" />
                    <br>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group form-material floating" data-plugin="formMaterial">
                        <input type="text" class="form-control" name="jatuh_tempo" data-hint="Masukkan Maksimal jatuh pembayaran tagihan." value="<?php echo $settings -> jatuh_tempo ?>"/>
                        <label class="floating-label">Range Jatuh Tempo</label>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group form-material floating" data-plugin="formMaterial">
                        <input type="text" class="form-control" name="stock" data-hint="Masukkan Minimal Stock untuk mendapatkan Notifikasi." value="<?php echo $settings -> min_stock ?>"/>
                        <label class="floating-label">Minimal Stock</label>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group form-material floating" data-plugin="formMaterial">
                        <input type="text" class="form-control" name="default_limit" data-hint="Masukkan Default Limit Pengorderan." value="<?php echo $settings -> default_limit ?>"/>
                        <label class="floating-label">Default Limit Order</label>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group form-material floating" data-plugin="formMaterial">
                        <select class="form-control" name="timezone">
                          <option><?php echo $settings -> timezone ?></option>
                          <?php foreach ($timezones as $tz) { ?>
                            <option value="<?php echo $tz->timezone; ?>"><?php echo $tz->timezone; ?></option>
                          <?php } ?>
                        </select>
                        <label class="floating-label">Timezone</label>
                      </div>
                    </div>
                  </div>
                  <?php if ($settings -> site_logo): ?>
                      <br><input type="checkbox" name="remove_photo" value="<?php echo $settings -> site_logo ?>"/> Remove Logo when saving<br>
                      <div class="form-group form-material floating" data-plugin="formMaterial">
                            <input type="text" class="form-control" readonly="" />
                            <input type="file" name="site_logo" multiple="" />
                            <label class="floating-label">Change Logo..</label>
                      </div>
                    <?php else: ?>
                      <div class="form-group form-material floating" data-plugin="formMaterial">
                            <input type="text" class="form-control" readonly="" />
                            <input type="file" name="site_logo" multiple="" />
                            <label class="floating-label">Logo..</label>
                      </div>
                  <?php endif ?>
                  <!-- div class="form-group form-material floating" data-plugin="formMaterial">
                    <input type="text" class="form-control" readonly="" />
                    <input type="file" name="site_logo" multiple="" />
                    <label class="floating-label">Logo..</label>
                  </div> -->
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
    url = "<?php echo site_url('setting/update')?>";

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
                // $('#exampleNiftyFadeScale').modal('hide');
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