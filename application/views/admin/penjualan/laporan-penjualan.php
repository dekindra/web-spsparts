<!-- Function -->
<?php 
function formatRP($angka){
 $jadi = number_format($angka,0,',','.');
 return $jadi;
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>SPS Parts</title>
  <!-- Designed by https://github.com/kaytcat -->
  <!-- Robot header image designed by Freepik.com -->

  <style type="text/css">
  @import url(http://fonts.googleapis.com/css?family=Droid+Sans);

  /* Take care of image borders and formatting */

  img {
    max-width: 600px;
    outline: none;
    text-decoration: none;
    -ms-interpolation-mode: bicubic;
  }

  a {
    text-decoration: none;
    border: 0;
    outline: none;
    color: #bbbbbb;
  }

  a img {
    border: none;
  }

  /* General styling */

  td, h1, h2, h3  {
    font-family: Helvetica, Arial, sans-serif;
    font-weight: 400;
  }

  td {
    text-align: center;
  }

  body {
    -webkit-font-smoothing:antialiased;
    -webkit-text-size-adjust:none;
    width: 100%;
    height: 100%;
    color: #37302d;
    background: #ffffff;
    font-size: 16px;
  }

   table {
    border-collapse: collapse !important;
  }

  .headline {
    color: #ffffff;
    font-size: 36px;
  }

 .force-full-width {
  width: 100% !important;
 }




  </style>

  <style type="text/css" media="screen">
      @media screen {
         /*Thanks Outlook 2013! http://goo.gl/XLxpyl*/
        td, h1, h2, h3 {
          font-family: 'Droid Sans', 'Helvetica Neue', 'Arial', 'sans-serif' !important;
        }
      }
  </style>

  <style type="text/css" media="only screen and (max-width: 480px)">
    /* Mobile styles */
    @media only screen and (max-width: 480px) {

      table[class="w320"] {
        width: 320px !important;
      }


    }
  </style>
</head>
<body class="body" style="padding:0; margin:0; display:block; background:#ffffff; -webkit-text-size-adjust:none" bgcolor="#ffffff">
<table align="center" cellpadding="0" cellspacing="0" width="100%" height="100%" >
  <tr>
    <td align="center" valign="top" bgcolor="#ffffff"  width="100%">
      <center>
        <table style="margin: 0 auto;" cellpadding="0" cellspacing="0" width="600" class="w320">
          <tr>
            <td align="center" valign="top">

                <table style="margin: 0 auto;" cellpadding="0" cellspacing="0" width="100%" style="margin:0 auto;">
                  <tr>
                    <td style="font-size: 30px; text-align:center;">
                      <br>
                        Terimakasih atas Kepercayaanya
                      <br>
                      <br>
                    </td>
                  </tr>
                </table>

               <!--  <table style="margin: 0 auto;" cellpadding="0" cellspacing="0" width="100%" bgcolor="#4dbfbf">
                  <tr>
                    <td>
                    <br>
                      <img src="https://image.ibb.co/iWXEec/bitcoin.png" width="224" height="350" alt="bitcoin picture">
                      <img src="<?php echo base_url(); ?>assets/images/<?php echo $logo?>" width="224" height="350" alt="bitcoin picture">

                    </td>
                  </tr>
                  <tr>
                    <td class="headline">
                      Thank You For Register
                    </td>
                  </tr>
                </table> -->
                <table style="margin: 0 auto;" cellpadding="0" cellspacing="0" width="100%" bgcolor="#4dbfbf">
                  <tr>
                    <td style="text-align: left;">
                      <h3>
                        <img class="mr-10" src="<?php echo base_url().'assets/images/bengkel/'.$ckbengkel['photo']; ?>"
                          alt="..."><?php echo $ckbengkel['name']; ?></h3>
                      <address>
                        <?php echo $ckbengkel['address']; ?>
                        <br>
                        <br>
                        <abbr>E-mail:</abbr>&nbsp;&nbsp;<?php echo $ckbengkel['email']; ?>
                        <br>
                        <abbr>Phone:</abbr>&nbsp;&nbsp;<?php echo $ckbengkel['tel']; ?>
                      </address>
                    </td>
                    <td style="text-align: right;">
                      <h4>Info Nota</h4>
                      <p>
                        <a class="font-size-20" href="javascript:void(0)">#<?php echo $ckbengkel['id_penjualan']; ?></a>
                        <br>Total:
                        <!-- <br> -->
                        <span class="font-size-20"><?php echo formatRP($ckbengkel['total']);?></span>
                      </p>
                      <span>Tanggal: <?php echo date("d M Y",strtotime($ckbengkel['created_datetime'])); ?></span>
                      <br>
                    </td>
                  </tr>
                </table>

                <table style="margin: 0 auto;" cellpadding="0" cellspacing="0" class="force-full-width" bgcolor="#f5774e">
                  <tr>
                    <td style="background-color:#f5774e;">

                    <center>
                      <table class="table table-hover text-right">
                        <thead>
                          <tr>
                            <th class="text-center">#</th>
                            <th>Nama Barang</th>
                            <th class="text-right">Harga</th>
                            <th class="text-right">Quantity</th>
                            <th class="text-right">Sub Total</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                        $totalqty = 0;
                        $total = 0;
                        $i=1;

                        if (!is_null($array))
                          foreach ($array as $d) {
                            ?>
                            <tr>
                              <td><?php echo $i; ?></td>
                              <td class=""><?php echo $d -> name_p; ?></td>
                              <td class="">Rp. <?php echo formatRP(($d -> purchase_price *( 100 - $d-> diskon))/100); ?></td>
                              <td class=""><?php echo $d -> qty; ?></td>
                              <td class="">Rp. <?php echo formatRP($d -> subtotal); ?></td>
                            </tr> 
                            <?php $totalqty = $totalqty + $d-> qty ?>
                            <?php $total = $total + $d-> subtotal ?>
                            <?php  $i++; } ?>

                            <tr>
                              <td></td>
                              <td colspan="2"><b>Grand Total</b></td>
                              <td class=" "><b><?php echo $totalqty ?></b></td>
                              <td class=" "><b>Rp. <?php echo formatRP($total) ?></b></td>
                            </tr>
                        </tbody>
                      </table>

                      <table style="margin: 0 auto;" cellspacing="0" cellpadding="0" class="force-width-80">
                        <tr>
                          <td style="text-align:left; color:#933f24;">
                          <br>
                            Terima kasih atas partisipasi anda. hubungi kami jika anda ada pertanyaan<br>
                            <span style="margin-left:5px" color="#f5774e">CP 1 : </span>  <span style="color:white">0895703829140 (WhatsApp Only) </span><br>
                            <span style="margin-left:-4px" color="#f5774e">CP 2 : </span>  <span style="color:white">085786564030 (WhatsApp Only) </span><br>
                          <br><br><br>
                          </td>
                        </tr>
                      </table>
                    </center>



                    </td>
                  </tr>


                </table>

                <table style="margin: 0 auto;" cellpadding="0" cellspacing="0" class="force-full-width" bgcolor="#414141" style="margin: 0 auto">
                  <tr>
                    <td style="color:#bbbbbb; font-size:12px;">
                    <br>
                       SPS Parts @<?php echo date('Y'); ?>
                    <br><br>
                    </td>
                  </tr>
                </table>

            </td>
          </tr>
        </table>
    </center>
    </td>
  </tr>
</table>
</body>
</html>
