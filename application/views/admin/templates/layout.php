<?php 
  $alert_msg = $this->session->flashdata('alert_msg');
  $role = $this->session->userdata('role');
 ?>

<!DOCTYPE html>
<html class="no-js css-menubar" lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="bootstrap admin template">
    <meta name="author" content="">
    
    <title><?php echo $title; ?></title>
    
    <link rel="apple-touch-icon" href="<?php echo base_url(); ?>assets/base/assets/images/apple-touch-icon.png">
    <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/images/favicon.ico">
    
    <!-- Stylesheets -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/global/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/global/css/bootstrap-extend.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/base/assets/css/site.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/base/assets/examples/css/uikit/badges.css">
    
    <!-- Plugins -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/global/vendor/animsition/animsition.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/global/vendor/asscrollable/asScrollable.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/global/vendor/switchery/switchery.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/global/vendor/intro-js/introjs.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/global/vendor/slidepanel/slidePanel.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/global/vendor/flag-icon-css/flag-icon.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/global/vendor/webui-popover/webui-popover.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/global/vendor/toolbar/toolbar.css">
        
    <!-- Fonts -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/global/fonts/font-awesome/font-awesome.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/global/fonts/web-icons/web-icons.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/global/fonts/brand-icons/brand-icons.min.css">
    <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,300italic'>

     <?php
    if (isset($css)) {
        foreach ($css as $item) {
            echo ' <link href="' . base_url() . $item . '.css" rel="stylesheet">' . PHP_EOL;
        }
    }
    ?>

    <?php
        if (isset($jscss)) {
            foreach ($jscss as $item) {
                echo '<script type="text/javascript" src="'.base_url().$item.'.js"></script>'. PHP_EOL;
            }
        }
    ?>
    
    <!--[if lt IE 9]>
    <script src="<?php //echo base_url(); ?>global/vendor/html5shiv/html5shiv.min.js"></script>
    <![endif]-->
    
    <!--[if lt IE 10]>
    <script src="<?php //echo base_url(); ?>global/vendor/media-match/media.match.min.js"></script>
    <script src="<?php// echo base_url(); ?>global/vendor/respond/respond.min.js"></script>
    <![endif]-->
    
    <!-- Scripts -->
    <script src="<?php echo base_url(); ?>assets/global/vendor/breakpoints/breakpoints.js"></script>
    <script src="<?php echo base_url(); ?>assets/global/vendor/jquery/jquery.js"></script>
    <script>
      Breakpoints();
    </script>
  </head>
  <body class="animsition page-profile">
    <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->

    <nav class="site-navbar navbar navbar-default navbar-fixed-top navbar-mega" role="navigation">
    
      <div class="navbar-header">
        <button type="button" class="navbar-toggler hamburger hamburger-close navbar-toggler-left hided"
          data-toggle="menubar">
          <span class="sr-only">Toggle navigation</span>
          <span class="hamburger-bar"></span>
        </button>
        <button type="button" class="navbar-toggler collapsed" data-target="#site-navbar-collapse"
          data-toggle="collapse">
          <i class="icon wb-more-horizontal" aria-hidden="true"></i>
        </button>
        <div class="navbar-brand navbar-brand-center site-gridmenu-toggle" data-toggle="gridmenu">
          <img class="navbar-brand-logo" style="height: 40px" src="<?php echo base_url(); ?>/assets/images/logo-kop.png" title="Remark">
          <span class="navbar-brand-text hidden-xs-down"> SPS Parts</span>
        </div>
      </div>
    
      <div class="navbar-container container-fluid">
        <!-- Navbar Collapse -->
        <div class="collapse navbar-collapse navbar-collapse-toolbar" id="site-navbar-collapse">
          <!-- Navbar Toolbar -->
          <ul class="nav navbar-toolbar">
            <li class="nav-item hidden-float" id="toggleMenubar">
              <a class="nav-link" data-toggle="menubar" href="#" role="button">
                <i class="icon hamburger hamburger-arrow-left">
                  <span class="sr-only">Toggle menubar</span>
                  <span class="hamburger-bar"></span>
                </i>
              </a>
            </li>
            <li class="nav-item hidden-sm-down" id="toggleFullscreen">
              <a class="nav-link icon icon-fullscreen" data-toggle="fullscreen" href="#" role="button">
                <span class="sr-only">Toggle fullscreen</span>
              </a>
            </li>
          </ul>
          <!-- End Navbar Toolbar -->
    
          <!-- Navbar Toolbar Right -->
          <ul class="nav navbar-toolbar navbar-right navbar-toolbar-right">
            <li>
              <a class="nav-link">
                Hello, <?php echo $this->session->userdata('nama'); ?>
              </a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link" data-toggle="dropdown" href="javascript:void(0)" title="Notifications"
                aria-expanded="false" data-animation="scale-up" role="button">
                <i class="icon wb-bell" aria-hidden="true"></i>
                <?php if(count($notif) !=0): ?>
                <span class="badge badge-pill badge-danger up"><?php echo count($notif) ?></span>
                <?php else: ?>
                 <span class="badge badge-pill badge-danger up"></span>
                 <?php endif ?>
              </a>
              <div class="dropdown-menu dropdown-menu-right dropdown-menu-media" role="menu">
                <div class="dropdown-menu-header">
                  <h5>NOTIFICATIONS</h5>
                  <?php if(count($notif) !=0): ?>
                  <span class="badge badge-round badge-danger">New <?php echo count($notif) ?></span>
                  <?php endif ?>
                </div>
                <div class="list-group">
                  <div data-role="container">
                    <div data-role="content">
                      <!-- <a class="list-group-item dropdown-item" href="javascript:void(0)" role="menuitem">
                        <div class="media">
                          <div class="pr-10">
                            <i class="icon wb-order bg-red-600 white icon-circle" aria-hidden="true"></i>
                          </div>
                          <div class="media-body">
                            <h6 class="media-heading">A new order has been placed</h6>
                            <time class="media-meta" datetime="2018-06-12T20:50:48+08:00">5 hours ago</time>
                          </div>
                        </div>
                      </a>
                      <a class="list-group-item dropdown-item" href="javascript:void(0)" role="menuitem">
                        <div class="media">
                          <div class="pr-10">
                            <i class="icon wb-user bg-green-600 white icon-circle" aria-hidden="true"></i>
                          </div>
                          <div class="media-body">
                            <h6 class="media-heading">Completed the task</h6>
                            <time class="media-meta" datetime="2018-06-11T18:29:20+08:00">2 days ago</time>
                          </div>
                        </div>
                      </a>
                      <a class="list-group-item dropdown-item" href="javascript:void(0)" role="menuitem">
                        <div class="media">
                          <div class="pr-10">
                            <i class="icon wb-settings bg-red-600 white icon-circle" aria-hidden="true"></i>
                          </div>
                          <div class="media-body">
                            <h6 class="media-heading">Settings updated</h6>
                            <time class="media-meta" datetime="2018-06-11T14:05:00+08:00">2 days ago</time>
                          </div>
                        </div>
                      </a>
                      <a class="list-group-item dropdown-item" href="javascript:void(0)" role="menuitem">
                        <div class="media">
                          <div class="pr-10">
                            <i class="icon wb-calendar bg-blue-600 white icon-circle" aria-hidden="true"></i>
                          </div>
                          <div class="media-body">
                            <h6 class="media-heading">Event started</h6>
                            <time class="media-meta" datetime="2018-06-10T13:50:18+08:00">3 days ago</time>
                          </div>
                        </div>
                      </a>
                      <a class="list-group-item dropdown-item" href="javascript:void(0)" role="menuitem">
                        <div class="media">
                          <div class="pr-10">
                            <i class="icon wb-chat bg-orange-600 white icon-circle" aria-hidden="true"></i>
                          </div>
                          <div class="media-body">
                            <h6 class="media-heading">Message received</h6>
                            <time class="media-meta" datetime="2018-06-10T12:34:48+08:00">3 days ago</time>
                          </div>
                        </div>
                      </a> -->
                      <?php
                        if (!is_null($notif))
                        foreach ($notif as $nt) {
                      ?>
                        <?php if($nt->info == 'daftar'): ?>
                          <a class="list-group-item dropdown-item" href="javascript:void(0)" role="menuitem">
                            <div class="media">
                              <div class="pr-10">
                                <i class="icon wb-chat bg-blue-600 white icon-circle" aria-hidden="true"></i>
                              </div>
                              <div class="media-body">
                                <h6 class="media-heading" style="white-space: normal;"><?php echo $nt->keterangan ?></h6>
                                <time class="media-meta" datetime="2018-06-10T12:34:48+08:00"><?php echo time_ago(strtotime($nt->created_datetime)) ?></time>
                              </div>
                            </div>
                          </a>
                        <?php elseif($nt->info == 'konfirmasi'): ?>
                          <a class="list-group-item dropdown-item" href="javascript:void(0)" role="menuitem">
                            <div class="media">
                              <div class="pr-10">
                                <i class="icon wb-reply bg-orange-600 white icon-circle" aria-hidden="true"></i>
                              </div>
                              <div class="media-body">
                                <h6 class="media-heading" style="white-space: normal;"><?php echo $nt->keterangan ?></h6>
                                <time class="media-meta" datetime="2018-06-10T12:34:48+08:00"><?php echo time_ago(strtotime($nt->created_datetime)) ?></time>
                              </div>
                            </div>
                          </a>
                        <?php elseif($nt->info == 'order_diterima'): ?>
                          <a class="list-group-item dropdown-item" href="javascript:void(0)" role="menuitem">
                            <div class="media">
                              <div class="pr-10">
                                <i class="icon wb-shopping-cart bg-red-600 white icon-circle" aria-hidden="true"></i>
                              </div>
                              <div class="media-body">
                                <h6 class="media-heading" style="white-space: normal;"><?php echo $nt->keterangan ?></h6>
                                <time class="media-meta" datetime="2018-06-10T12:34:48+08:00"><?php echo time_ago(strtotime($nt->created_datetime)) ?></time>
                              </div>
                            </div>
                          </a>
                        <?php elseif($nt->info == 'order_diproses'): ?>
                          <a class="list-group-item dropdown-item" href="javascript:void(0)" role="menuitem">
                            <div class="media">
                              <div class="pr-10">
                                <i class="icon wb-shopping-cart bg-blue-600 white icon-circle" aria-hidden="true"></i>
                              </div>
                              <div class="media-body">
                                <h6 class="media-heading" style="white-space: normal;"><?php echo $nt->keterangan ?></h6>
                                <time class="media-meta" datetime="2018-06-10T12:34:48+08:00"><?php echo time_ago(strtotime($nt->created_datetime)) ?></time>
                              </div>
                            </div>
                          </a>
                        <?php elseif($nt->info == 'order_selesai'): ?>
                          <a class="list-group-item dropdown-item" href="javascript:void(0)" role="menuitem">
                            <div class="media">
                              <div class="pr-10">
                                <i class="icon wb-shopping-cart bg-green-600 white icon-circle" aria-hidden="true"></i>
                              </div>
                              <div class="media-body">
                                <h6 class="media-heading" style="white-space: normal;"><?php echo $nt->keterangan ?></h6>
                                <time class="media-meta" datetime="2018-06-10T12:34:48+08:00"><?php echo time_ago(strtotime($nt->created_datetime)) ?></time>
                              </div>
                            </div>
                          </a>
                        <?php elseif($nt->info == 'order_valid'): ?>
                          <a class="list-group-item dropdown-item" href="javascript:void(0)" role="menuitem">
                            <div class="media">
                              <div class="pr-10">
                                <i class="icon wb-shopping-cart bg-yellow-600 white icon-circle" aria-hidden="true"></i>
                              </div>
                              <div class="media-body">
                                <h6 class="media-heading" style="white-space: normal;"><?php echo $nt->keterangan ?></h6>
                                <time class="media-meta" datetime="2018-06-10T12:34:48+08:00"><?php echo time_ago(strtotime($nt->created_datetime)) ?></time>
                              </div>
                            </div>
                          </a>  
                        <?php else: ?>
                          <a class="list-group-item dropdown-item" href="javascript:void(0)" role="menuitem">
                            <div class="media">
                              <div class="pr-10">
                                <i class="icon wb-shopping-cart bg-orange-600 white icon-circle" aria-hidden="true"></i>
                              </div>
                              <div class="media-body">
                                <h6 class="media-heading" style="white-space: normal;"><?php echo $nt->keterangan ?></h6>
                                <time class="media-meta" datetime="2018-06-10T12:34:48+08:00"><?php echo time_ago(strtotime($nt->created_datetime)) ?></time>
                              </div>
                            </div>
                          </a>
                        <?php endif ?>
                    
                    <?php } ?>

                    </div>
                  </div>
                </div>
                <div class="dropdown-menu-footer">
                  <?php if($this->session->userdata('role') == 1): ?>
                  <a class="dropdown-menu-footer-btn" href="<?php echo base_url(); ?>setting" role="button">
                    <i class="icon wb-settings" aria-hidden="true"></i>
                  </a>
                  <?php endif ?>
                  <?php if(count($notif) !=0): ?>
                  <a class="dropdown-item" href="<?php echo base_url(); ?>notifikasi/read" role="menuitem">
                    Tandai telah dibaca semua
                  </a>
                  <?php else: ?>
                  <a class="dropdown-item" href="javascript:void(0)" role="menuitem">
                    Telah dibaca semua
                  </a>
                  <?php endif ?>
                </div>
              </div>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link navbar-avatar" data-toggle="dropdown" href="#" aria-expanded="false"
                data-animation="scale-up" role="button">
                <span class="avatar avatar-online">
                  <img src="<?php echo base_url(); ?>assets/global/portraits/5.jpg" alt="...">
                  <i></i>
                </span>
              </a>
              <div class="dropdown-menu" role="menu">
                <a class="dropdown-item" href="<?php echo base_url(); ?>profil" role="menuitem"><i class="icon wb-user" aria-hidden="true"></i> Profile</a>
                <?php if ($this->session->userdata('role')== 2 || $this->session->userdata('role')==3): ?>
                <a class="dropdown-item" href="<?php echo base_url(); ?>profil/usaha" role="menuitem"><i class="icon wb-payment" aria-hidden="true"></i> Profil Usaha</a>
                <?php endif ?>
                <?php if($this->session->userdata('role') == 1): ?>
                <a class="dropdown-item" href="<?php echo base_url(); ?>setting" role="menuitem"><i class="icon wb-settings" aria-hidden="true"></i> Settings</a>
                <?php endif ?>
                <div class="dropdown-divider" role="presentation"></div>
                <a class="dropdown-item" href="<?php echo base_url(); ?>user/logout" role="menuitem"><i class="icon wb-power" aria-hidden="true"></i> Logout</a>
              </div>
            </li>
          </ul>
          <!-- End Navbar Toolbar Right -->
        </div>
        <!-- End Navbar Collapse -->
      </div>
    </nav>
    <div class="site-menubar">
      <div class="site-menubar-body">
        <div>
          <div>
            <ul class="site-menu" data-plugin="menu">
              <li class="site-menu-category" style="color: #7fff00">Menu Utama</li>
              <?php if(!is_null($role)): ?>
              <li <?php if($menu =='dashboard'){echo 'class="site-menu-item active"';} else{ echo 'class="site-menu-item"';} ?>>
                <a href="<?php echo base_url() ?>dashboard">
                        <i class="site-menu-icon wb-dashboard" aria-hidden="true"></i>
                        <span class="site-menu-title">Dashboard</span>    
                </a>
              </li>
              <?php endif ?>
              <?php if($role == 4): ?>
              <li <?php if($menu =='penjualan'){echo 'class="site-menu-item active"';} else{ echo 'class="site-menu-item"';} ?>>
                <a href="<?php echo base_url() ?>penjualan/list">
                        <i class="site-menu-icon wb-shopping-cart" aria-hidden="true"></i>
                        <span class="site-menu-title">Penjualan</span>    
                </a>
              </li>
              <?php endif ?>
              <?php if($role == 3): ?>
              <li <?php if($menu =='laporanpenjualan'){echo 'class="site-menu-item active"';} else{ echo 'class="site-menu-item"';} ?>>
                <a href="<?php echo base_url() ?>penjualan/laporan">
                        <i class="site-menu-icon wb-shopping-cart" aria-hidden="true"></i>
                        <span class="site-menu-title">Penjualan</span>    
                </a>
              </li>
              <?php endif ?>
              <?php if($role == 1): ?>
              <li <?php if($posisi =='mitra'){echo 'class="site-menu-item has-sub active open"';} else{ echo 'class="site-menu-item has-sub"';} ?>>
                <a href="javascript:void(0)">
                        <i class="site-menu-icon wb-share" aria-hidden="true"></i>
                        <span class="site-menu-title">Mitra</span>
                                <span class="site-menu-arrow"></span>
                    </a>
                <ul class="site-menu-sub">
                  <li <?php if($menu =='gudang'){echo 'class="site-menu-item active"';} else{ echo 'class="site-menu-item"';} ?>>
                    <a class="animsition-link" href="<?php echo base_url() ?>gudang">
                      <span class="site-menu-title">Gudang</span>
                    </a>
                  </li>
                  <li <?php if($menu =='bengkel'){echo 'class="site-menu-item active"';} else{ echo 'class="site-menu-item"';} ?>>
                    <a class="animsition-link" href="<?php echo base_url() ?>bengkel">
                      <span class="site-menu-title">Bengkel</span>
                    </a>
                  </li>
                  <li <?php if($menu =='supplier'){echo 'class="site-menu-item active"';} else{ echo 'class="site-menu-item"';} ?>>
                    <a class="animsition-link" href="<?php echo base_url() ?>supplier">
                      <span class="site-menu-title">Supplier</span>
                    </a>
                  </li>
                </ul>
              </li>
              <?php endif ?>
              <?php if($role == 3 || $role==4): ?>
              <li <?php if($menu =='pelanggan'){echo 'class="site-menu-item active"';} else{ echo 'class="site-menu-item"';} ?>>
                <a href="<?php echo base_url() ?>pelanggan">
                        <i class="site-menu-icon wb-users" aria-hidden="true"></i>
                        <span class="site-menu-title">Pelanggan</span>    
                </a>
              </li>
              <?php endif ?>
              <?php if($role == 2): ?>
              <li <?php if($menu =='bengkel'){echo 'class="site-menu-item active"';} else{ echo 'class="site-menu-item"';} ?>>
                <a href="<?php echo base_url() ?>bengkel/list">
                        <i class="site-menu-icon wb-share" aria-hidden="true"></i>
                        <span class="site-menu-title">Bengkel</span>    
                </a>
              </li>
              <?php endif ?>
              <?php if($role == 1): ?>
              <li <?php if($posisi =='produk'){echo 'class="site-menu-item has-sub active open"';} else{ echo 'class="site-menu-item has-sub"';} ?>>
                <a href="javascript:void(0)">
                        <i class="site-menu-icon wb-briefcase" aria-hidden="true"></i>
                        <span class="site-menu-title">Produk</span>
                                <span class="site-menu-arrow"></span>
                    </a>
                <ul class="site-menu-sub">
                  <li <?php if($menu =='kategoriproduk'){echo 'class="site-menu-item active"';} else{ echo 'class="site-menu-item"';} ?>>
                    <a class="animsition-link" href="<?php echo base_url() ?>kategoriproduk">
                      <span class="site-menu-title">Kategori</span>
                    </a>
                  </li>
                  <li <?php if($menu =='produk'){echo 'class="site-menu-item active"';} else{ echo 'class="site-menu-item"';} ?>>
                    <a class="animsition-link" href="<?php echo base_url() ?>produk">
                      <span class="site-menu-title">Data Produk</span>
                    </a>
                  </li>
                </ul>
              </li>
              <?php endif ?>
              <?php if($role ==1): ?>
              <li <?php if($menu =='inventory'){echo 'class="site-menu-item active"';} else{ echo 'class="site-menu-item"';} ?>>
                <a href="<?php echo base_url() ?>inventory/inventoryCek">
                        <i class="site-menu-icon wb-hammer" aria-hidden="true"></i>
                        <span class="site-menu-title">Inventory</span>    
                </a>
              </li>
              <?php endif ?>
              <?php if($role ==2): ?>
              <li <?php if($menu =='inventory'){echo 'class="site-menu-item active"';} else{ echo 'class="site-menu-item"';} ?>>
                <a href="<?php echo base_url() ?>inventory">
                        <i class="site-menu-icon wb-hammer" aria-hidden="true"></i>
                        <span class="site-menu-title">Inventory</span>    
                </a>
              </li>
              <?php endif ?>
              <?php if($role == 3): ?>
              <li <?php if($menu =='inventorybengkel'){echo 'class="site-menu-item active"';} else{ echo 'class="site-menu-item"';} ?>>
                <a href="<?php echo base_url() ?>inventory/inventorybengkel">
                        <i class="site-menu-icon wb-hammer" aria-hidden="true"></i>
                        <span class="site-menu-title">Inventory</span>    
                </a>
              </li>
              <?php endif ?>
              <?php if($role == 3): ?>
              <li <?php if($posisi =='orderbengkel'){echo 'class="site-menu-item has-sub active open"';} else{ echo 'class="site-menu-item has-sub"';} ?>>
                <a href="javascript:void(0)">
                        <i class="site-menu-icon wb-payment" aria-hidden="true"></i>
                        <span class="site-menu-title">Order</span>
                                <span class="site-menu-arrow"></span>
                    </a>
                <ul class="site-menu-sub">
                  <li <?php if($menu =='baru'){echo 'class="site-menu-item active"';} else{ echo 'class="site-menu-item"';} ?>>
                    <a class="animsition-link" href="<?php echo base_url(); ?>orderbengkel">
                      <span class="site-menu-title">Order</span>
                    </a>
                  </li> 
                  <li <?php if($menu =='returnbengkel'){echo 'class="site-menu-item active"';} else{ echo 'class="site-menu-item"';} ?>>
                    <a class="animsition-link" href="<?php echo base_url(); ?>returnbengkel">
                      <span class="site-menu-title">Return Order</span>
                    </a>
                  </li>
                  <li <?php if($menu =='wishlistbengkel'){echo 'class="site-menu-item active"';} else{ echo 'class="site-menu-item"';} ?>>
                    <a class="animsition-link" href="<?php echo base_url(); ?>wishlistbengkel">
                      <span class="site-menu-title">Wishlist Order</span>
                    </a>
                  </li>
                </ul>
              </li>
              <?php endif ?>
              <?php if($role == 2): ?>
              <li <?php if($posisi =='ordergudang'){echo 'class="site-menu-item has-sub active open"';} else{ echo 'class="site-menu-item has-sub"';} ?>>
                <a href="javascript:void(0)">
                        <i class="site-menu-icon wb-payment" aria-hidden="true"></i>
                        <span class="site-menu-title">Order</span>
                                <span class="site-menu-arrow"></span>
                    </a>
                <ul class="site-menu-sub">
                  <li <?php if($menu =='ordermasukgudang'){echo 'class="site-menu-item active"';} else{ echo 'class="site-menu-item"';} ?>>
                    <a class="animsition-link" href="<?php echo base_url(); ?>ordergudang/masuk">
                      <span class="site-menu-title">Order Masuk</span>
                    </a>
                  </li>
                  <li <?php if($menu =='ordergudangkeluar'){echo 'class="site-menu-item active"';} else{ echo 'class="site-menu-item"';} ?>>
                    <a class="animsition-link" href="<?php echo base_url(); ?>ordergudang/keluar">
                      <span class="site-menu-title">Order</span>
                    </a>
                  </li>
                  <li <?php if($menu =='wishlistgudang'){echo 'class="site-menu-item active"';} else{ echo 'class="site-menu-item"';} ?>>
                    <a class="animsition-link" href="<?php echo base_url(); ?>wishlistgudang">
                      <span class="site-menu-title">Wishlist Order</span>
                    </a>
                  </li>
                  <li <?php if($menu =='returngudangmasuk'){echo 'class="site-menu-item active"';} else{ echo 'class="site-menu-item"';} ?>>
                    <a class="animsition-link" href="<?php echo base_url(); ?>returngudang/masuk">
                      <span class="site-menu-title">Return Masuk</span>
                    </a>
                  </li>
                  <li <?php if($menu =='returngudangkeluar'){echo 'class="site-menu-item active"';} else{ echo 'class="site-menu-item"';} ?>>
                    <a class="animsition-link" href="<?php echo base_url(); ?>returngudang">
                      <span class="site-menu-title">Return</span>
                    </a>
                  </li>
                </ul>
              </li>
              <?php endif ?>
              <?php if($role == 1): ?>
              <li <?php if($posisi =='orderadmin'){echo 'class="site-menu-item has-sub active open"';} else{ echo 'class="site-menu-item has-sub"';} ?>>
                <a href="javascript:void(0)">
                        <i class="site-menu-icon wb-payment" aria-hidden="true"></i>
                        <span class="site-menu-title">Order</span>
                                <span class="site-menu-arrow"></span>
                    </a>
                <ul class="site-menu-sub">
                  <li <?php if($menu =='ordermasukadmin'){echo 'class="site-menu-item active"';} else{ echo 'class="site-menu-item"';} ?>>
                    <a class="animsition-link" href="<?php echo base_url(); ?>orderadmin/masuk">
                      <span class="site-menu-title">Order</span>
                    </a>
                  </li>
                  <!-- <li <?php if($menu =='orderkeluaradmin'){echo 'class="site-menu-item active"';} else{ echo 'class="site-menu-item"';} ?>>
                    <a class="animsition-link" href="<?php echo base_url(); ?>orderAdmin/keluar">
                      <span class="site-menu-title">Order</span>
                    </a>
                  </li> -->
                  <li <?php if($menu =='returnadminmasuk'){echo 'class="site-menu-item active"';} else{ echo 'class="site-menu-item"';} ?>>
                    <a class="animsition-link" href="<?php echo base_url(); ?>returnadmin/masuk">
                      <span class="site-menu-title">Return</span>
                    </a>
                  </li>
                  <!-- <li <?php if($menu =='returnadminkeluar'){echo 'class="site-menu-item active"';} else{ echo 'class="site-menu-item"';} ?>>
                    <a class="animsition-link" href="<?php echo base_url(); ?>returnAdmin">
                      <span class="site-menu-title">Return</span>
                    </a>
                  </li> -->
                </ul>
              </li>
              <?php endif ?>
              <?php if($role ==1 || $role == 2 || $role == 3): ?>
              <li <?php if($posisi =='tagihan'){echo 'class="site-menu-item has-sub active open"';} else{ echo 'class="site-menu-item has-sub"';} ?>>
                <a href="javascript:void(0)">
                        <i class="site-menu-icon fa-money" aria-hidden="true"></i>
                        <span class="site-menu-title">Tagihan</span>
                                <span class="site-menu-arrow"></span>
                    </a>
                <ul class="site-menu-sub">
                  <?php if($role == 3): ?>
                  <li <?php if($menu =='tagihan'){echo 'class="site-menu-item active"';} else{ echo 'class="site-menu-item"';} ?>>
                    <a class="animsition-link" href="<?php echo base_url(); ?>tagihanorder">
                      <span class="site-menu-title">Tagihan</span>
                    </a>
                  </li>
                  <?php endif ?>
                  <?php if($role == 2): ?>
                  <li <?php if($menu =='tagihankeadmin'){echo 'class="site-menu-item active"';} else{ echo 'class="site-menu-item"';} ?>>
                    <a class="animsition-link" href="<?php echo base_url(); ?>tagihanadmin">
                      <span class="site-menu-title">Tagihan Admin</span>
                    </a>
                  </li>
                  <!-- <li <?php if($menu =='tunggakankeadmin'){echo 'class="site-menu-item active"';} else{ echo 'class="site-menu-item"';} ?>>
                    <a class="animsition-link" href="<?php echo base_url(); ?>tunggakanadmin">
                      <span class="site-menu-title">Tunggakan Admin</span>
                    </a>
                  </li> -->
                  <li <?php if($menu =='tagihankebengkel'){echo 'class="site-menu-item active"';} else{ echo 'class="site-menu-item"';} ?>>
                    <a class="animsition-link" href="<?php echo base_url(); ?>tagihanbengkel">
                      <span class="site-menu-title">Tagihan Bengkel</span>
                    </a>
                  </li>
                  <li <?php if($menu =='tunggakanbengkel'){echo 'class="site-menu-item active"';} else{ echo 'class="site-menu-item"';} ?>>
                    <a class="animsition-link" href="<?php echo base_url(); ?>tunggakanbengkel">
                      <span class="site-menu-title">Tunggakan Bengkel</span>
                    </a>
                  </li>
                  <?php endif ?>
                  <?php if($role == 1): ?>
                  <li <?php if($menu =='tagihangudang'){echo 'class="site-menu-item active"';} else{ echo 'class="site-menu-item"';} ?>>
                    <a class="animsition-link" href="<?php echo base_url(); ?>tagihangudang">
                      <span class="site-menu-title">Tagihan Gudang</span>
                    </a>
                  </li>
                  <li <?php if($menu =='tunggakangudang'){echo 'class="site-menu-item active"';} else{ echo 'class="site-menu-item"';} ?>>
                    <a class="animsition-link" href="<?php echo base_url(); ?>tunggakangudang">
                      <span class="site-menu-title">Tunggakan Gudang</span>
                    </a>
                  </li>
                  <li <?php if($menu =='statistiktunggakan'){echo 'class="site-menu-item active"';} else{ echo 'class="site-menu-item"';} ?>>
                    <a class="animsition-link" href="<?php echo base_url(); ?>statistiktunggakan">
                      <span class="site-menu-title">Statistik Tunggakan</span>
                    </a>
                  </li>
                  <?php endif ?>
                </ul>
              </li>
              <?php endif ?>
              <?php if($role == 3): ?>
              <li <?php if($menu =='promo'){echo 'class="site-menu-item active"';} else{ echo 'class="site-menu-item"';} ?>>
                <a href="<?php echo base_url() ?>promo">
                        <i class="site-menu-icon wb-tag" aria-hidden="true"></i>
                        <span class="site-menu-title">Voucher</span>
                    </a>
              </li>
              <?php endif ?>
              <?php if($role == 3): ?>
              <li <?php if($posisi =='pengeluaran'){echo 'class="site-menu-item has-sub active open"';} else{ echo 'class="site-menu-item has-sub"';} ?>>
                <a href="javascript:void(0)">
                        <i class="site-menu-icon wb-rubber" aria-hidden="true"></i>
                        <span class="site-menu-title">Pengeluaran</span>
                                <span class="site-menu-arrow"></span>
                    </a>
                <ul class="site-menu-sub">
                  <li <?php if($menu =='kategoripengeluaran'){echo 'class="site-menu-item active"';} else{ echo 'class="site-menu-item"';} ?>>
                    <a class="animsition-link" href="<?php echo base_url() ?>kategoripengeluaran">
                      <span class="site-menu-title">Kategori</span>
                    </a>
                  </li>
                  <li <?php if($menu =='pengeluaran'){echo 'class="site-menu-item active"';} else{ echo 'class="site-menu-item"';} ?>>
                    <a class="animsition-link" href="<?php echo base_url() ?>pengeluaran">
                      <span class="site-menu-title">Pengeluaran</span>
                    </a>
                  </li>
                </ul>
              </li>
              <?php endif ?>
              <?php if($role == 2): ?>
              <li <?php if($posisi =='pengeluaran'){echo 'class="site-menu-item has-sub active open"';} else{ echo 'class="site-menu-item has-sub"';} ?>>
                <a href="javascript:void(0)">
                        <i class="site-menu-icon wb-rubber" aria-hidden="true"></i>
                        <span class="site-menu-title">Pengeluaran</span>
                                <span class="site-menu-arrow"></span>
                    </a>
                <ul class="site-menu-sub">
                  <li <?php if($menu =='kategoripengeluaran'){echo 'class="site-menu-item active"';} else{ echo 'class="site-menu-item"';} ?>>
                    <a class="animsition-link" href="<?php echo base_url() ?>kategoripengeluaran">
                      <span class="site-menu-title">Kategori</span>
                    </a>
                  </li>
                  <li <?php if($menu =='pengeluaran'){echo 'class="site-menu-item active"';} else{ echo 'class="site-menu-item"';} ?>>
                    <a class="animsition-link" href="<?php echo base_url() ?>pengeluaran">
                      <span class="site-menu-title">Pengeluaran</span>
                    </a>
                  </li>
                </ul>
              </li>
              <?php endif ?>
              <?php if($role == 1): ?>
              <li <?php if($posisi =='pengeluaran'){echo 'class="site-menu-item has-sub active open"';} else{ echo 'class="site-menu-item has-sub"';} ?>>
                <a href="javascript:void(0)">
                        <i class="site-menu-icon wb-rubber" aria-hidden="true"></i>
                        <span class="site-menu-title">Pengeluaran</span>
                                <span class="site-menu-arrow"></span>
                    </a>
                <ul class="site-menu-sub">
                  <li <?php if($menu =='kategoripengeluaran'){echo 'class="site-menu-item active"';} else{ echo 'class="site-menu-item"';} ?>>
                    <a class="animsition-link" href="<?php echo base_url() ?>kategoripengeluaran">
                      <span class="site-menu-title">Kategori</span>
                    </a>
                  </li>
                  <li <?php if($menu =='pengeluaran'){echo 'class="site-menu-item active"';} else{ echo 'class="site-menu-item"';} ?>>
                    <a class="animsition-link" href="<?php echo base_url() ?>pengeluaran">
                      <span class="site-menu-title">Pengeluaran</span>
                    </a>
                  </li>
                </ul>
              </li>
              <?php endif ?>
              <?php if($role == 3): ?>
              <li <?php if($menu =='kasir'){echo 'class="site-menu-item active"';} else{ echo 'class="site-menu-item"';} ?>>
                <a href="<?php echo base_url() ?>kasir">
                        <i class="site-menu-icon wb-user-circle" aria-hidden="true"></i>
                        <span class="site-menu-title">Kasir</span>    
                </a>
              </li>
              <?php endif ?>
              <?php if($role == 4): ?>
              <li class="site-menu-category" style="color: #7fff00">Apps</li>
              <li <?php if($posisi =='aplikasi'){echo 'class="site-menu-item has-sub active open"';} else{ echo 'class="site-menu-item has-sub"';} ?>>
                <a href="javascript:void(0)">
                        <i class="site-menu-icon wb-shopping-cart" aria-hidden="true"></i>
                        <span class="site-menu-title">Aplikasi</span>
                                <span class="site-menu-arrow"></span>
                    </a>
                  <ul class="site-menu-sub">
                  <li class="site-menu-item">
                    <a class="animsition-link" href="<?php echo base_url(); ?>penjualan">
                      <span class="site-menu-title">POS</span>
                    </a>
                  </li>
                  <li class="site-menu-item">
                    <a class="animsition-link" href="javascript:void(0)">
                      <span class="site-menu-title">Panduan</span>
                    </a>
                  </li>
                  <!-- <li <?php if($menu =='penjualan'){echo 'class="site-menu-item active"';} else{ echo 'class="site-menu-item"';} ?>>
                    <a class="animsition-link" href="<?php echo base_url(); ?>penjualan/ListPenjualan">
                      <span class="site-menu-title">Penjualan</span>
                    </a>
                  </li> -->
                  <!-- <li <?php if($menu =='returnpenjualan'){echo 'class="site-menu-item active"';} else{ echo 'class="site-menu-item"';} ?>>
                    <a class="animsition-link" href="<?php echo base_url(); ?>returnpenjualan">
                      <span class="site-menu-title">Return Penjualan</span>
                    </a>
                  </li> -->
                </ul>
              </li>
              <?php endif ?>
            </ul>
          </div>
        </div>
      </div>
      <div class="site-menubar-footer">
        <?php if ($this->session->userdata('type')=='admin'): ?>
        <a href="<?php echo base_url(); ?>setting" class="fold-show" data-placement="top" data-toggle="tooltip"
          data-original-title="Settings">
          <span class="icon wb-settings" aria-hidden="true"></span>
        </a>
        <?php elseif($this->session->userdata('type')=='kasir'): ?>
          <a href="<?php echo base_url(); ?>profil" class="fold-show" data-placement="top" data-toggle="tooltip"
          data-original-title="Settings">
          <span class="icon wb-settings" aria-hidden="true"></span>
        <?php else: ?>
          <a href="<?php echo base_url(); ?>profil/usaha" class="fold-show" data-placement="top" data-toggle="tooltip"
          data-original-title="Settings">
          <span class="icon wb-settings" aria-hidden="true"></span>
        </a>
        <?php endif ?>
        <a href="javascript: void(0);" data-placement="top" data-toggle="tooltip" data-original-title="Bantuan">
          <span class="icon wb-help-circle" aria-hidden="true"></span>
        </a>
        <a href="<?php echo base_url(); ?>user/logout" data-placement="top" data-toggle="tooltip" data-original-title="Logout">
          <span class="icon wb-power" aria-hidden="true"></span>
        </a>
      </div>
     </div>
    <!-- Page -->
    <div class="page">

      <?php
        if (isset($param)) {
            $this->load->view($content, $param);
        } else {
            $this->load->view($content);
        }
        ?>

    </div>
    <!-- End Page -->


    <!-- Footer -->
    <footer class="site-footer">
      <div class="site-footer-legal">© 2018 <a href="">PT. Surya Prana Sesama</a></div>
      <div class="site-footer-right">
        Crafted with <i class="red-600 wb wb-heart"></i> by <a href="">Asri Network</a>
      </div>
    </footer>
    <!-- Core  -->
    <script src="<?php echo base_url(); ?>assets/global/vendor/babel-external-helpers/babel-external-helpers.js"></script>
    <script src="<?php echo base_url(); ?>assets/global/vendor/popper-js/umd/popper.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/global/vendor/bootstrap/bootstrap.js"></script>
    <script src="<?php echo base_url(); ?>assets/global/vendor/animsition/animsition.js"></script>
    <script src="<?php echo base_url(); ?>assets/global/vendor/mousewheel/jquery.mousewheel.js"></script>
    <script src="<?php echo base_url(); ?>assets/global/vendor/asscrollbar/jquery-asScrollbar.js"></script>
    <script src="<?php echo base_url(); ?>assets/global/vendor/asscrollable/jquery-asScrollable.js"></script>
    <script src="<?php echo base_url(); ?>assets/global/vendor/ashoverscroll/jquery-asHoverScroll.js"></script>
    
    <!-- Plugins -->
    <script src="<?php echo base_url(); ?>assets/global/vendor/switchery/switchery.js"></script>
    <script src="<?php echo base_url(); ?>assets/global/vendor/intro-js/intro.js"></script>
    <script src="<?php echo base_url(); ?>assets/global/vendor/screenfull/screenfull.js"></script>
    <script src="<?php echo base_url(); ?>assets/global/vendor/slidepanel/jquery-slidePanel.js"></script>
      <script src="<?php echo base_url(); ?>assets/global/vendor/webui-popover/jquery.webui-popover.min.js"></script>
      <script src="<?php echo base_url(); ?>assets/global/vendor/toolbar/jquery.toolbar.js"></script>

    <!-- Scripts -->
    <script src="<?php echo base_url(); ?>assets/global/js/Component.js"></script>
    <script src="<?php echo base_url(); ?>assets/global/js/plugin/jquery-ui.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/global/js/Plugin.js"></script>
    <script src="<?php echo base_url(); ?>assets/global/js/Base.js"></script>
    <script src="<?php echo base_url(); ?>assets/global/js/Config.js"></script>
    
    <script src="<?php echo base_url(); ?>assets/base/assets/js/Section/Menubar.js"></script>
    <script src="<?php echo base_url(); ?>assets/base/assets/js/Section/GridMenu.js"></script>
    <script src="<?php echo base_url(); ?>assets/base/assets/js/Section/Sidebar.js"></script>
    <script src="<?php echo base_url(); ?>assets/base/assets/js/Section/PageAside.js"></script>
    <script src="<?php echo base_url(); ?>assets/base/assets/js/Plugin/menu.js"></script>
    
    <script src="<?php echo base_url(); ?>assets/global/js/config/colors.js"></script>
    <script src="<?php echo base_url(); ?>assets/base/assets/js/config/tour.js"></script>
    <script>Config.set('assets', '<?php echo base_url(); ?>assets/base/assets');</script>
    
    <!-- Page -->
    <script src="<?php echo base_url(); ?>assets/base/assets/js/Site.js"></script>
    <script src="<?php echo base_url(); ?>assets/global/js/Plugin/asscrollable.js"></script>
    <script src="<?php echo base_url(); ?>assets/global/js/Plugin/slidepanel.js"></script>
    <script src="<?php echo base_url(); ?>assets/global/js/Plugin/switchery.js"></script>
      <script src="<?php echo base_url(); ?>assets/global/js/Plugin/webui-popover.js"></script>
      <script src="<?php echo base_url(); ?>assets/global/js/Plugin/toolbar.js"></script>
      <script src="<?php echo base_url(); ?>assets/base/assets/examples/js/uikit/tooltip-popover.js"></script>
    
    <script>
      (function(document, window, $){
        'use strict';
    
        var Site = window.Site;
        $(document).ready(function(){
          Site.run();
        });
      })(document, window, jQuery);
    </script>

    <script>
        var base_url = "<?php echo base_url();?>";
    </script>
    <?php

        if (isset($js)) {
            foreach ($js as $item) {
                echo '<script type="text/javascript" src="'.base_url().$item.'.js"></script>'. PHP_EOL;
            }
        }
    ?>

  </body>
</html>
