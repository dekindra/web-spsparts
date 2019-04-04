<!-- Function -->
<?php 
function formatRP($angka){
 $jadi = number_format($angka,0,',','.');
 return $jadi;
}

?>

      <div class="page-header">
        <h1 class="page-title"><?php  echo $title ?></h1>
        <div class="page-header-actions">
          <p><span class="badge badge-lg badge-warning"><b>Grand Total : Rp. <?php echo formatRP($totalwishlist->totalwishlist) ?></b></span></p>
        </div>
      </div>

      <div class="page-content">
       <!-- Panel Table Tools -->
       <div class="panel">
         <!--  <header class="panel-heading">
            <h3 class="panel-title">Table Tools</h3>
          </header> -->
          <div class="panel-body">
            <div class="table-responsive">
              <table class="table table-hover" data-plugin="selectable" data-row-selectable="true">
                <thead>
                  <tr>
                    <th class="w-50">
                      &nbsp;
                  </div>
                    </th>
                    <th>
                      Produk
                    </th>
                    <th>
                      Qty
                    </th>
                    <th>
                      Harga
                    </th>
                    <th>
                      Sub Total
                    </th>
                    <th>
                      Tanggal
                    </th>
                  </tr>
                </thead>
                <tbody>
                  <!-- <tr>
                    <td>
                      <span class="checkbox-custom checkbox-primary checkbox-lg">
                        <input class="selectable-item" type="checkbox" id="row-619" value="619">
                        <label for="row-619"></label>
                      </span>
                    </td>
                    <td>
                      <div class="content">
                        <div class="title">Edward Fletcher</div>
                        <div class="abstract">Genus alteram linguam ut isdem, desiderent litteris allicit
                          acuti iuvaret</div>
                      </div>
                    </td>
                    <td>The sun climbing plan</td>
                    <td>The sun climbing plan</td>
                    <td>
                      <span class="badge badge-primary">Developing</span>
                    </td>
                    <td>
                      <span data-plugin="peityLine">5,3,2,-1,-3,-2,2,3,5,2</span>
                    </td>
                  </tr> -->

                  <?php 
                    if (!is_null($wishlist))
                      foreach ($wishlist as $wh) {
                   ?>
                    <tr>
                      <td>
                        <span class="checkbox-custom checkbox-primary checkbox-lg">
                          <input class="selectable-item" type="checkbox" id="row-619" name="id" value="<?php echo $wh->id; ?>">
                          <label for="row-619"></label>
                        </span>
                      </td>
                      <td>
                        <div class="content">
                          <div class="title"><?php echo $wh->code_p; ?></div>
                          <div class="abstract"><?php echo $wh->name_p.' '.$wh->merk.' '.$wh->deskripsi; ?></div>
                        </div>
                      </td>
                      <td><?php echo $wh->qty; ?></td>
                      <td>Rp. <?php echo formatRP($wh->subtotal / $wh->qty); ?></td>
                      <td>Rp. <?php echo formatRP($wh->subtotal); ?></td>
                      <td><?php echo date('d F Y',strtotime($wh -> tanggal)) ?></td>
                    </tr>

                   <?php } ?>
                  
                </tbody>
                <tfoot>
                  <tr>
                    <th class="w-50" colspan="2">
                      <div class="btn-group">
                        <span class="checkbox-custom checkbox-primary checkbox-lg inline-block vertical-align-bottom">
                          <input class="selectable-all" type="checkbox">
                          <label></label>
                        </span>
                        <button class="btn btn-lg btn-icon btn-pure btn-default" type="button" onclick="save()">
                          <i class="icon fa-shopping-cart" aria-hidden="true" data-toggle="tooltip" data-original-title="Order"> 
                          </i>
                          </button>
                        <button class="btn btn-lg btn-icon btn-pure btn-default" type="button" onclick="delete_account()">
                          <i class="icon fa-trash" aria-hidden="true" data-toggle="tooltip" data-original-title="Hapus">
                          </i>
                        </button>
                      </div>
                    </th>
                    <th colspan="4">
                      &nbsp;
                    </th>
                  </tr>
                </tfoot>
              </table>
            </div>
          </div>
        </div>
        <!-- End Panel Table Tools -->
      </div>

              

<!-- JQUERY UI -->
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>

<script>
  (function($) {
    function to_rupiah(angka){
      var rev     = parseInt(angka, 10).toString().split('').reverse().join('');
      var rev2    = '';
      for(var i = 0; i < rev.length; i++){
        rev2  += rev[i];
        if((i + 1) % 3 === 0 && i !== (rev.length - 1)){
          rev2 += '.';
        }
      }
      return rev2.split('').reverse().join('');
    } 
    
  })(jQuery)

  function save()
  {
    var idchecked = [];

    $(".selectable-item:checked").each(function() {
      idchecked.push(this.value);
    });

    console.log(idchecked);

    // ajax adding data to database

    $.ajax({
      type: "POST",
      data: {idcheck:idchecked},
      url : "<?php echo site_url('wishlistgudang/add')?>",
      dataType: "JSON",
      success: function(data)
      {
        if(data.status) //if success close modal and reload ajax table
        {
          var alert = `<div class="alert alert-alt alert-success alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
              ${data.flash_header} <br><a class="alert-link" style="margin-left: 0" href="javascript:void(0)">${data.flash_desc}</a>
            </div>`

          $('.page-header').append(alert)
              
           location.reload();  

        } else {
         var alertgagal = `<div class="alert alert-alt alert-danger alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
              ${data.flash_header} <br><a class="alert-link" style="margin-left: 0" href="javascript:void(0)">${data.flash_desc}</a>
            </div>`

          $('.page-header').append(alertgagal)
        }

      },
      error: function (jqXHR, textStatus, errorThrown)
      {
        // location.reload();
      }
    }); 
  }

  
  function delete_account()
  {
    var idchecked = [];

    $(".selectable-item:checked").each(function() {
      idchecked.push(this.value);
    });

    if(confirm('Are you sure delete this data?'))
    {
        // ajax delete data to database
        $.ajax({
          type: "POST",
          data: {idcheck:idchecked},
          url : "<?php echo site_url('wishlistgudang/delete')?>",
          dataType: "JSON",
          success: function(data)
          {
                if(data.status) //if success close modal and reload ajax table
              {

                  var alert = `<div class="alert alert-alt alert-success alert-dismissible" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                      ${data.flash_header} <br><a class="alert-link" style="margin-left: 0" href="javascript:void(0)">${data.flash_desc}</a>
                    </div>`

                    $('.page-header').append(alert)

                  location.reload();

              } else {

                 var alertgagal = `<div class="alert alert-alt alert-danger alert-dismissible" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                      ${data.flash_header} <br><a class="alert-link" style="margin-left: 0" href="javascript:void(0)">${data.flash_desc}</a>
                    </div>`

                    $('.page-header').append(alertgagal)
              }
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
              alert('Error deleting data');
            }
          });

      }
    }

  </script>

