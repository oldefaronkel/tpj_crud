<?php
session_start();
include_once 'includes/functions.inc.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="viho admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
  <meta name="keywords" content="admin template, viho admin template, dashboard template, flat admin template, responsive admin template, web app">
  <meta name="author" content="pixelstrap">
  <link rel="icon" href="assets/images/favicon.png" type="image/x-icon">
  <link rel="shortcut icon" href="assets/images/favicon.png" type="image/x-icon">
  <title>viho - Premium Admin Template</title>
  <!-- Google font-->
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&amp;display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap" rel="stylesheet">
  <!-- Font Awesome-->
  <link rel="stylesheet" type="text/css" href="assets/css/fontawesome.css">
  <!-- ico-font-->
  <link rel="stylesheet" type="text/css" href="assets/css/icofont.css">
  <!-- Themify icon-->
  <link rel="stylesheet" type="text/css" href="assets/css/themify.css">
  <!-- Flag icon-->
  <link rel="stylesheet" type="text/css" href="assets/css/flag-icon.css">
  <!-- Feather icon-->
  <link rel="stylesheet" type="text/css" href="assets/css/feather-icon.css">
  <!-- Plugins css start-->
  <link rel="stylesheet" type="text/css" href="assets/css/prism.css">
  <!-- Plugins css Ends-->
  <!-- Bootstrap css-->
  <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
  <!-- App css-->
  <link rel="stylesheet" type="text/css" href="assets/css/style.css">
  <link id="color" rel="stylesheet" href="assets/css/color-1.css" media="screen">
  <!-- Responsive css-->
  <link rel="stylesheet" type="text/css" href="assets/css/responsive.css">
</head>

<body>
  <!-- Loader starts-->
  <div class="loader-wrapper">
    <div class="theme-loader">
      <div class="loader-p"></div>
    </div>
  </div>
  <!-- Loader ends-->
  <!-- page-wrapper Start-->
  <div class="page-wrapper" id="pageWrapper">
    <!-- Page Header Start-->
    <div class="page-main-header">
      <div class="main-header-right row m-0">
        <div class="main-header-left">
          <div class="logo-wrapper"><a href="index.html"><img class="img-fluid" src="assets/images/logo/logo.png" alt=""></a></div>
          <div class="dark-logo-wrapper"><a href="index.html"><img class="img-fluid" src="assets/images/logo/dark-logo.png" alt=""></a></div>
          <div class="toggle-sidebar"><i class="status_toggle middle" data-feather="align-center" id="sidebar-toggle"></i></div>
        </div>
        <div class="left-menu-header col">
          <ul>
            <li>
              <form class="form-inline search-form">
                <div class="search-bg"><i class="fa fa-search"></i>
                  <input class="form-control-plaintext" placeholder="Search here.....">
                </div>
              </form><span class="d-sm-none mobile-search search-bg"><i class="fa fa-search"></i></span>
            </li>
          </ul>
        </div>
        <div class="nav-right col pull-right right-menu p-0">
          <ul class="nav-menus">
            <li><a class="text-dark" href="#!" onclick="javascript:toggleFullScreen()"><i data-feather="maximize"></i></a></li>
            <li>
              <div class="mode"><i class="fa fa-moon-o"></i></div>
            </li>
            <li class="onhover-dropdown p-0">
              <?php
              if (isset($_SESSION["useruid"])) {
                echo "<button class='btn btn-primary-light' type='button'><a href='./logout.php'><i data-feather='log-out'></i>Log out</a></button>";
              } else {
                echo "<button class='btn btn-primary-light' type='button'><a href='./login.php'><i data-feather='log-in'></i>Log in</a></button> ";
                echo "<button class='btn btn-primary-light' type='button'><a href='./signup.php'><i data-feather='user-plus'></i>Sign up</a></button>";
              }
              ?>
            </li>
          </ul>
        </div>
        <div class="d-lg-none mobile-toggle pull-right w-auto"><i data-feather="more-horizontal"></i></div>
      </div>
    </div>
    <!-- Page Header Ends                              -->
    <!-- Page Body Start-->
    <div class="page-body-wrapper horizontal-menu">
      <!-- Page Sidebar Start-->
      <header class="main-nav">

    <?php  if (isset($_SESSION["useruid"])) { ?>

      <div class="sidebar-user text-center"><a class="setting-primary" href="javascript:void(0)"><i data-feather="settings"></i></a><img class="img-90 rounded-circle" src="assets/images/dashboard/1.png" alt="">
            <div class="badge-bottom"><span class="badge badge-primary">New</span></div><a href="user-profile.html">
              <h6 class="mt-3 f-14 f-w-600">Emay Walter</h6></a>
            <p class="mb-0 font-roboto">Human Resources Department</p>
            <ul>
              <li><span><span class="counter">19.8</span>k</span>
                <p>Follow</p>
              </li>
              <li><span>2 year</span>
                <p>Experince</p>
              </li>
              <li><span><span class="counter">95.2</span>k</span>
                <p>Follower </p>
              </li>
            </ul>
          </div>
  <?php  } ?>


        <nav>
          <div class="main-navbar">
            <div id="mainnav">
              <ul class="nav-menu custom-scrollbar">
                <li class="back-btn">
                  <div class="mobile-back text-end"><span>Back</span><i class="fa fa-angle-right ps-2" aria-hidden="true"></i></div>
                </li>
                <li class="dropdown"><a class="nav-link menu-title" href="../theme/index.html" target="_blank"><i data-feather="home"></i><span>Dashboard</span></a></li>
                <li class="dropdown"><a class="nav-link menu-title" href="javascript:void(0)"><i data-feather="anchor"></i><span>Starter kit</span></a>
                  <ul class="nav-submenu menu-content">
                    <li><a class="submenu-title" href="javascript:void(0)">color version<span class="sub-arrow"><i class="fa fa-chevron-right"></i></span></a>
                      <ul class="nav-sub-childmenu submenu-content">
                        <li><a href="index.html">Layout Light</a></li>
                        <li><a href="layout-dark.html">Layout Dark</a></li>
                      </ul>
                    </li>
                    <li> <a class="submenu-title" href="javascript:void(0)">Page layout<span class="sub-arrow"><i class="fa fa-chevron-right"></i></span></a>
                      <ul class="nav-sub-childmenu submenu-content">
                        <li><a href="boxed.html">Boxed</a></li>
                        <li><a href="layout-rtl.html">RTL </a></li>
                      </ul>
                    </li>
                    <li> <a class="submenu-title" href="javascript:void(0)">Footers<span class="sub-arrow"><i class="fa fa-chevron-right"></i></span></a>
                      <ul class="nav-sub-childmenu submenu-content">
                        <li><a href="footer-light.html">Footer Light</a></li>
                        <li><a href="footer-dark.html">Footer Dark</a></li>
                        <li><a href="footer-fixed.html">Footer Fixed</a></li>
                      </ul>
                    </li>
                  </ul>
                </li>
                <li class="dropdown"><a class="nav-link menu-title" href="http://support.pixelstrap.com/help-center" target="_blank"><i data-feather="headphones"></i><span>Raise Support</span></a></li>
                <li class="dropdown"><a class="nav-link menu-title" href="https://docs.pixelstrap.com/viho/document/" target="_blank"><i data-feather="file-text"></i><span>Documentation </span></a></li>
              </ul>
            </div>
          </div>
        </nav>
      </header>
      <!-- Page Sidebar Ends-->