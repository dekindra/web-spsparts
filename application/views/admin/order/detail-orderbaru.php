<!-- Function -->
<?php 
function formatRP($angka){
 $jadi = number_format($angka,0,',','.');
 return $jadi;
}

?>

<div class="modal-dialog modal-simple modal-lg">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">×</span>
      </button>
      <h4 class="modal-title">Modal Title</h4>
    </div>
    <div class="modal-body">
      <div class="panel-body">
        <div class="mb-15">
          <p>Kode Pembelian : <?php echo $data["id_order"] ?></p>
          <p>Tanggal : <?php echo date("d F Y",strtotime($data["tanggal_order"])) ?></p>
          <p>Total Pembelian    : <b>Rp. <?php echo formatRP($data["total_pembelian"]) ?></b></p>
          <hr>
        </div>
        <div class="table-responsive">
          <table class="table table-hover">
            <thead>
              <tr>
                <th>#</th>
                <th>Nama Barang</th>
                <th>Harga</th>
                <th>Qty</th>
                <th>Sub Total</th>
                <!-- <th><input type="checkbox" id="check-all" name=""></th> -->
                <th class="" >
                  <span class="checkbox-custom checkbox-primary checkbox-lg contacts-select-all">
                    <input type="checkbox" class="contacts-checkbox selectable-all" id="select_all"
                    />
                    <label for="select_all"></label>
                  </span>
                </th>
              </tr>
            </thead>
            <tbody>
                <!-- <tr>
                  <td>1</td>
                  <td>Heath</td>
                  <td>6778 Howe Route</td>
                  <td>Antwanbury</td>
                  <td>32</td>
                </tr>
                <tr>
                  <td>2</td>
                  <td>Alisa</td>
                  <td>64838 D&#x27;Amore Cove</td>
                  <td>Port Lempi</td>
                  <td>25</td>
                </tr>
                <tr>
                  <td>3</td>
                  <td>Treva</td>
                  <td>308 Octavia Roads</td>
                  <td>East Eunaton</td>
                  <td>37</td>
                </tr>
                <tr>
                  <td>4</td>
                  <td>Nicolas</td>
                  <td>760 Hickle Causeway</td>
                  <td>Lake Nickolasshire</td>
                  <td>69</td>
                </tr>
                <tr>
                  <td>5</td>
                  <td>Gerhard</td>
                  <td>893 Mara Parkway</td>
                  <td>Elmermouth</td>
                  <td>32</td>
                </tr>
                <tr>
                  <td>6</td>
                  <td>Monica</td>
                  <td>0039 Heath Plain</td>
                  <td>West Bentonhaven</td>
                  <td>46</td>
                </tr> -->
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
                      <?php if($d -> status_approval == 1): ?>
                        <td class="">
                          <span class="checkbox-custom checkbox-primary checkbox-lg">
                            <input type="checkbox" class="contacts-checkbox selectable-item" id="" checked="checked" value="<?php echo $d -> id_p ?>" 
                            />
                            <label for=""></label>
                          </span>
                        </td>
                        <?php else: ?>
                          <td class="">
                            <span class="checkbox-custom checkbox-primary checkbox-lg">
                              <input type="checkbox" class="contacts-checkbox selectable-item" id="" value="<?php echo $d -> id_p ?>" 
                              />
                              <label for=""></label>
                            </span>
                          </td>
                        <?php endif ?>
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
         <!--  </div>
            <a  href=""><button class="btn btn-outline btn-primary" style="float: right;" type="button"> <i class="wb-print"></i> Cetak</button></a>
          </div> -->
          <!-- <a  href=""><button class="btn btn-outline btn-primary" style="float: right;" type="button"> <i class="wb-print"></i> Cetak</button></a> -->
          <!-- </div> -->
        </div>
        <div class="modal-footer text-right">
          <button type="submit" class="btn btn-animate btn-animate-side btn-primary" onclick="bulk_produk(<?php echo $data["id_order"]; ?>)">
            <span><i class="icon wb-shopping-cart" aria-hidden="true"></i> Proceed
            to payment</span>
          </button>
          <button type="button" class="btn btn-animate btn-animate-side btn-default btn-outline"
          onclick="javascript:window.print();">
          <span><i class="icon wb-print" aria-hidden="true"></i> Print</span>
        </button>
      </div>
    </div>
  </div>
  <!-- </div> -->
  <!-- End Panel Table Tools -->
  <!-- </div> -->

  <script type="text/javascript">
    $(document).ready(function() {
    //check all
    $("#select_all").click(function(){
      $(".selectable-item").prop('checked', $(this).prop('checked'));
    });
  });

    function bulk_produk(kode){
      var list_idcheck = [];
      var list_idnotcheck = [];

      $(".selectable-item:checked").each(function() {
        list_idcheck.push(this.value);
      });

      $(".selectable-item:not(:checked)").each(function() {
        list_idnotcheck.push(this.value);
      });

    // console.log(list_idcheck);
    // console.log(list_idnotcheck);
    $.ajax({
      type: "POST",
      data: {check:list_idcheck, notcheck:list_idnotcheck},
      url: "<?php echo site_url('orderadmin/bulk_produk')?>/" + kode,
      dataType: "JSON",
      success: function(data)
      {
        if(data.status)
        {
          // reload_table();
          location.reload();
        }
        else
        {
          alert('Failed.');
        }
        
      },
      error: function (jqXHR, textStatus, errorThrown)
      {
        alert('Error deleting data');
      }
    });
  }
</script>
