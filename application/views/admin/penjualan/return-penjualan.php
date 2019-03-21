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
         <!--  <header class="panel-heading">
            <h3 class="panel-title">Table Tools</h3>
          </header> -->
          <div class="panel-body">
            <div class="row">
              <div class="col-md-6">
                <div class="mb-15">
                  <button  class="btn btn-outline btn-primary" data-target="#exampleNiftyFadeScale"
                      data-toggle="modal" type="button"><i class="icon wb-plus" aria-hidden="true"></i> Tambah
                  </button>
                </div>
              </div>
                    <!-- Modal -->
                    <div class="modal fade modal-fade-in-scale-up" id="exampleNiftyFadeScale" aria-hidden="true"
                      aria-labelledby="exampleModalTitle" role="dialog" tabindex="-1">
                      <div class="modal-dialog modal-simple modal-lg">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">×</span>
                            </button>
                            <h4 class="modal-title">Buat Return</h4>
                          </div>
                          <div class="modal-body">
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
                            <form autocomplete="off">
                              <div class="row">
                                
                                <div class="col-md-6">
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
                                        <div class="form-group form-material floating" data-plugin="formMaterial">
                                                     <div class="input-group">
                                                        <input type="text" class="form-control" data-plugin="datepicker">
                                                        <label class="floating-label">Tanggal</label>
                                                      </div>
                                                    </div>
                                      <!-- </form> -->
                                    <!-- </div> -->
                                  <!-- </div> -->
                                  <!-- End Panel Static Labels -->
                                </div>
                                <div class="col-md-6">
                                  <!-- Panel Floating Labels -->
                                  <!-- <div class="panel"> -->
                                    <!-- <div class="panel-heading">
                                      <h3 class="panel-title">Total</h3>
                                    </div> -->
                                    <!-- <div class="panel-body container-fluid"> -->
                                        <div class="form-group form-material floating" data-plugin="formMaterial">
                                          <div class="input-group">
                                            <span class="input-group-addon">Rp</span>
                                            <div class="form-control-wrap">
                                              <input type="text" class="form-control" />
                                              <label class="floating-label">Total Return</label>
                                            </div>
                                          </div>
                                        </div>
                                    <!-- </div> -->
                                  <!-- </div> -->
                                  <!-- End Panel Floating Labels -->
                                </div>
                              </div>
                               <!-- Panel Table Tools -->
                              <!-- <div class="panel"> -->
                                <header class="panel-heading">
                                  <h3 class="panel-title">Tambah Return</h3>
                                </header>
                                <!-- <div class="panel-body"> -->
                                  <div class="table-responsive">
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
                                      <tbody>
                                                  <!-- Dynamic -->
                                      </tbody>
                                    </thead>
                                  </table>
                                </div>
                                  <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Tambah</button>
                                  <button type="button" class="btn btn-primary">Simpan</button> -->
                                <!-- </div> -->
                              <!-- </div> -->
                            </form>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" id="tambah">Tambah</button>
                            <button type="button" class="btn btn-primary">Simpan</button>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- End Modal -->
            </div>
            <table class="table table-hover dataTable table w-full" data-plugin="dataTable">
              <thead>
                <tr>
                  <!-- <th>#</th> -->
                  <th>Kode</th>
                  <th>Tanggal</th>
                  <th>Pelanggan</th>
                  <th>Total Return</th>
                  <th class="text-nowrap">Action</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>1</td>
                  <td>2018-05-05</td>
                  <td>Agus Budi</td>
                  <td>25000</td>
                  <td class="text-nowrap">
                    <button type="button" class="btn btn-sm btn-icon btn-flat btn-default" data-toggle="tooltip"
                              data-original-title="Detail">
                              <i class="icon wb-info-circle" aria-hidden="true"></i>
                    </button>
                   <!--  <button type="button" class="btn btn-sm btn-icon btn-flat btn-default" data-toggle="tooltip"
                              data-original-title="Edit">
                              <i class="icon wb-wrench" aria-hidden="true"></i>
                    </button> -->
                    <button type="button" class="btn btn-sm btn-icon btn-flat btn-default" data-toggle="tooltip"
                              data-original-title="Delete">
                              <i class="icon wb-close" aria-hidden="true"></i>
                    </button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        <!-- End Panel Table Tools -->
      </div>



<!-- Template digunakan untuk membuat input field -->
<template id="product-cart">
  <!-- #id# supaya membuat identik, sehingga value dapat diambil -->
  <tr data-row-id="#id#">
    <!-- Kode Ice Cream -->
    <td>#id#</td>
    <input type ="hidden" name = "produk[#id#][kode_produk]" class=""  id="kode#id#">
    <!-- Nama Ice Cream -->
    <td>
      <input type ="text" name = "produk[#id#][nama_produk]" class="form-control" id="autocomplete#id#" 
      placeholder = "Ketikan Nama Barang ..." autocomplete = "off">
      <!-- Autocomplete dibikin off supaya gak rese', karna kalau on suka keluar angka dari rekomendasi -->
    </td>
    <td>
      <input type ="text" name = "produk[#id#][harga_karton]" class="form-control" id="harga_karton#id#" >
    </td>
    <td>
      <input type ="text" name = "produk[#id#][quantity]" class="form-control" id="quantity#id#">
    </td>
    <td>
      <input type ="text" name = "produk[#id#][total_harga]" class="form-control" id="total_harga#id#" >
    </td>
    <td>
      <button type="button" class="btn btn-sm btn-icon btn-flat btn-danger delete" data-id="#id#"><i class="wb-close"></i></button>
    </td>
  </tr>
</template>

<script>
  $(function() {
    
    var template = $('#product-cart').html()
    // Ambil Template HTML DARI Id product-cart
    // Function untuk tambah baris tabel
    function tambahBaris(){
      var currentId = $('#cart tbody tr:last-child').data('row-id') || 0
      // Ambil Nomor ID, Jika tidak ada diganti dengan 0
      $('#cart tbody').append(template.replace(/#id#/g, currentId + 1))
      // Fungsi Append buat menambah element, dari template tadi dan diganti #id# dengan currentID
       
    }

    tambahBaris()

    console.log('a')
    // EVENT KLIK TOMBOL
    $('#tambah').on('click', function (e) {
      tambahBaris()
    })
    
    // DELETE
    $('body').on('click', '.delete', function (e) {
      $(this).parents('tr').remove()
      hitungTotal()
    })

    $(document).on('keydown', 'body', function(e){
      var charCode = ( e.which ) ? e.which : event.keyCode;
      if(charCode == 118) //F7
      {
        tambahBaris();
        return false;
      }
    });

   
  })
</script>