<!-- Function -->
<?php 
$user_id = $this->session->userdata('id');

  if (empty($user_id)) {
        redirect(base_url(), 'refresh');
    }

function formatRP($angka){
 $jadi = number_format($angka,0,',','.');
 return $jadi;
}

?>


<!DOCTYPE html>
<html class="no-js css-menubar" lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="bootstrap admin template">
    <meta name="author" content="">
    
    <title>Kupon Promo</title>
    
    <link rel="apple-touch-icon" href="<?php echo base_url(); ?>assets/base/assets/images/apple-touch-icon.png">
    <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/base/assets/images/favicon.ico">
    
    <!-- Stylesheets -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/global/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/global/css/bootstrap-extend.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/base/assets/css/site.min.css">

    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/base/assets/examples/css/structure/ribbon.css">
    
    <!-- Fonts -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/global/fonts/web-icons/web-icons.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/global/fonts/brand-icons/brand-icons.min.css">
    <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,300italic'>

    <style type="text/css" media="print">
      @page { size: a4; portrait;}
      body {border: 0px ; padding: 16px;} 
      th {vertical-align: middle !important; text-align: center;border: 0px ;}
      td {border: 0px s}
    </style>
   
  </head>
  <body class="animsition" onload="window.print()">
    <!-- Example Pricing List2 -->
    <div class="">
      <div class="" style="padding: 30px 30px">
        <div class="col-6" style="padding-left: 0px">
          <div class="ribbon ribbon-clip">
            <span class="ribbon-inner">Exp <?php echo date("d M Y",strtotime($data['expiry_date'])); ?></span>
          </div>
          <div class="pricing-list">
            <div class="pricing-header bg-orange-600">
                <div class="pricing-title"><?php echo $data['name']; ?></div>
                  <div class="pricing-price">
                    <span class="pricing-currency">GIFT</span>
                    <span class="pricing-amount">Voucher</span>
                    <br> 
                    <span class="pricing-amount">Rp. <?php echo formatRP($data['value']); ?></span>
                  </div>
                  <span class="px-20"><?php echo $data['tel']; ?></span>
                  <span class="px-20">Kode : <?php echo $data['card_number']; ?></span>
                  <span class="px-20"><?php echo $data['email']; ?></span>
                  <hr> 
                  <p class="" style="font-size: 10px;">*Dapat digunakan <?php echo $data['penggunaan']; ?> kali dan berlaku pembelian minimal Rp. <?php echo formatRP($data['buy_minimal']); ?> hanya di bengkel <?php echo $data['name']; ?></p>
              </div>
            </div>
            <div class="text-right">
              <button type="button" class="btn btn-animate btn-animate-side btn-default btn-outline d-print-none"
                onclick="javascript:window.print();">
                <span><i class="icon wb-print" aria-hidden="true"></i> Print</span>
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- End Example Pricing List2 -->
  </body>
</html>
