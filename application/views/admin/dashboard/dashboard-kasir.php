<!-- Function -->
<?php 
function formatRP($angka){
 $jadi = number_format($angka,0,',','.');
 return $jadi;
}

function getprevious($jml1,$jml2){
  $previous = (($jml1 - $jml2) / $jml2) * 100;
  return $previous;
}

?>
      <!-- <div class="page-header">
        <h1 class="page-title font-size-26 font-weight-100">Ecommerce Overview</h1>
      </div> -->

      <div class="page-content container-fluid">
        <div class="row">
          <!-- First Row -->
          <div class="col-xl-6 col-md-6 info-panel">
            <div class="card card-shadow">
              <div class="card-block bg-white p-20">
                <button type="button" class="btn btn-floating btn-sm btn-primary">
                  <i class="icon wb-shopping-cart"></i>
                </button>
                <span class="ml-15 font-weight-400">Penjualan</span>
                <div class="content-text text-center mb-0">
                    <span class="font-size-40 font-weight-100"><?php echo $jumlahorder->jumorder; ?></span>                  
                </div>
              </div>
            </div>
          </div>
          <div class="col-xl-6 col-md-6 info-panel">
            <div class="card card-shadow">
              <div class="card-block bg-white p-20">
                <button type="button" class="btn btn-floating btn-sm btn-default">
                  <i class="icon wb-user"></i>
                </button>
                <span class="ml-15 font-weight-400">Pelanggan</span>
                <div class="content-text text-center mb-0">
                    <span class="font-size-40 font-weight-100"><?php echo $jumlahpelanggan->pelanggan; ?></span>
                </div>
              </div>
            </div>
          </div>
          <!-- End First Row -->

          <!-- second Row -->
          <!-- <div class="col-12" id="ecommerceChartView">
            <div class="card card-shadow">
              <div class="card-header card-header-transparent py-20">
                <div class="btn-group dropdown">
                  <a href="#" class="text-body dropdown-toggle blue-grey-700" data-toggle="dropdown">PRODUCTS SALES</a>
                  <div class="dropdown-menu animate" role="menu">
                    <a class="dropdown-item" href="#" role="menuitem">Sales</a>
                    <a class="dropdown-item" href="#" role="menuitem">Total sales</a>
                    <a class="dropdown-item" href="#" role="menuitem">profit</a>
                  </div>
                </div>
                <ul class="nav nav-pills nav-pills-rounded chart-action">
                  <li class="nav-item"><a class="active nav-link" data-toggle="tab" href="#scoreLineToDay">Day</a></li>
                  <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#scoreLineToWeek">Week</a></li>
                  <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#scoreLineToMonth">Month</a></li>
                </ul>
              </div>
              <div class="widget-content tab-content bg-white p-20">
                <div class="ct-chart tab-pane active" id="scoreLineToDay"></div>
                <div class="ct-chart tab-pane" id="scoreLineToWeek"></div>
                <div class="ct-chart tab-pane" id="scoreLineToMonth"></div>
              </div>
            </div>
          </div> -->
          <!-- End Second Row -->

          <!-- Third Row -->
          <!-- Third Left -->
          <!-- <div class="col-lg-8" id="ecommerceRecentOrder"> -->
          <!-- <div class="col-lg-12" id="ecommerceRecentOrder">
            <div class="card card-shadow table-row">
              <div class="card-header card-header-transparent py-20">
                <div class="btn-group dropdown">
                  <a href="#" class="text-body dropdown-toggle blue-grey-700" data-toggle="dropdown">RECENT ORDER</a>
                  <div class="dropdown-menu animate" role="menu">
                    <a class="dropdown-item" href="#" role="menuitem">Sales</a>
                    <a class="dropdown-item" href="#" role="menuitem">Total sales</a>
                    <a class="dropdown-item" href="#" role="menuitem">profit</a>
                  </div>
                </div>
              </div>
              <div class="card-block bg-white table-responsive">
                <table class="table">
                  <thead>
                    <tr>
                      <th>Image</th>
                      <th>Product</th>
                      <th>Customer</th>
                      <th>Purchased On</th>
                      <th>Status</th>
                      <th>Tracking No#</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>
                        <img src="../../assets/examples/images/products/imac.png"
                          alt="iMac" />
                      </td>
                      <td>iMac</td>
                      <td>Russell</td>
                      <td>22/08/2018</td>
                      <td>
                        <span class="badge badge-success font-weight-100">Paid</span>
                      </td>
                      <td>#98BC85SD84</td>
                    </tr>
                    <tr>
                      <td>
                        <img src="../../assets/examples/images/products/iphone.png"
                          alt="iPhone" />
                      </td>
                      <td>iPhone</td>
                      <td>Carol</td>
                      <td>15/07/2018</td>
                      <td>
                        <span class="badge badge-warning font-weight-100">Pending</span>
                      </td>
                      <td>#98SA3C9SC</td>
                    </tr>
                    <tr>
                      <td>
                        <img src="../../assets/examples/images/products/applewatch.png"
                          alt="apple_watch" />
                      </td>
                      <td>apple Watch</td>
                      <td>Austin Pena</td>
                      <td>10/07/2018</td>
                      <td>
                        <span class="badge badge-success font-weight-100">Paid</span>
                      </td>
                      <td>#98BC85SD84</td>
                    </tr>
                    <tr>
                      <td>
                        <img src="../../assets/examples/images/products/macmouse.png"
                          alt="mac_mouse" />
                      </td>
                      <td>mac Mouse</td>
                      <td>Randy</td>
                      <td>22/04/2018</td>
                      <td>
                        <span class="badge badge-default font-weight-100">Failed</span>
                      </td>
                      <td>#98SA3C9SC</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div> -->
          <!-- End Third Left -->

          <!-- Third Right -->
        <!--   <div class="col-lg-4" id="ecommerceRevenue">
            <div class="card card-shadow text-center pt-10">
              <h3 class="card-header card-header-transparent blue-grey-700 font-size-14 mt-0">REVENUE</h3>
              <div class="card-block bg-white">
                <div class="ct-chart barChart"></div>
                <div class="pie-view row">
                  <div class="col-6 pie-left text-center">
                    <h5 class="blue-grey-500 font-size-14 font-weight-100">GROS REVENUE</h5>
                    <p class="font-size-20 blue-grey-700">
                      9,362,74
                    </p>
                    <div class="pie-progress pie-progress-sm" data-plugin="pieProgress" data-valuemax="100"
                      data-valuemin="0" data-barcolor="#a57afa" data-size="100" data-barsize="4"
                      data-goal="60" aria-valuenow="60" role="progressbar">
                      <span class="pie-progress-number">60%</span>
                    </div>
                  </div>
                  <div class="col-6 pie-right text-center">
                    <h5 class="blue-grey-500 font-size-14 font-weight-100">NET REVENUE</h5>
                    <p class="font-size-20 blue-grey-700">
                      6,734,58
                    </p>
                    <div class="pie-progress pie-progress-sm" data-plugin="pieProgress" data-valuemax="100"
                      data-valuemin="0" data-barcolor="#28c0de" data-size="100" data-barsize="4"
                      data-goal="78" aria-valuenow="78" role="progressbar">
                      <span class="pie-progress-number">78%</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div> -->
          <!-- End Third Right -->
          <!-- End Third Row -->
        </div>
      </div>

