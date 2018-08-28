<?php
  session_start();
  if (!isset($_SESSION['username'])) {
    header('Location: ../');
  }else if($_SESSION['akses'] != 2){
    if ($_SESSION['akses'] == 1) {
      header('Location: ../super/');
    }else{
      header('Location: ../admin/');
    }
  }
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
  <meta name="description" content="CoreUI - Open Source Bootstrap Admin Template">
  <meta name="author" content="Lukasz Holeczek">
  <meta name="keyword" content="Bootstrap,Admin,Template,Open,Source,jQuery,CSS,HTML,RWD,Dashboard">
  <title><?=$judul?></title>
  <!-- Icons-->
  <link href="../vendors/css/flag-icon.min.css" rel="stylesheet">
  <link href="../vendors/css/font-awesome.min.css" rel="stylesheet">
  <link href="../vendors/css/simple-line-icons.css" rel="stylesheet">
  <!-- Main styles for this application-->
  <link rel="stylesheet" href="../css/datatables.min.css"> <!--Data Tables-->
  <link href="../css/style.min.css" rel="stylesheet">
  <link href="../css/costum.css" rel="stylesheet">
  <link href="../css/pace.min.css" rel="stylesheet">

</head>

<body class="app header-fixed sidebar-fixed aside-menu-fixed sidebar-lg-show">
  <header class="app-header navbar">
    <button class="navbar-toggler sidebar-toggler d-lg-none mr-auto" type="button" data-toggle="sidebar-show">
      <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand" href="./">
      <img class="navbar-brand-full" src="../img/logo.png" width="150" height="50" alt="CoreUI Logo">
      <img class="navbar-brand-minimized" src="../img/favicon.png" width="45" height="45" alt="CoreUI Logo">
    </a>
    <button class="navbar-toggler sidebar-toggler d-md-down-none" type="button" data-toggle="sidebar-lg-show">
      <span class="navbar-toggler-icon"></span>
    </button>
    <ul class="nav navbar-nav ml-auto">
      <font class="text-value-sm">
        <?=$_SESSION['username']?>
      </font>
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
          <span class="fa fa-user-circle" style="font-size: 35px;"></span>
        </a>
        <div class="dropdown-menu dropdown-menu-right">
          <div class="dropdown-header text-center">
            <strong>Pengaturan Akun</strong>
          </div>
          <a class="dropdown-item" href="./ubahpassword.php">
            <i class="fa fa-key"></i> Ubah password
          </a>
          <a class="dropdown-item" href="../logout.php">
            <i class="fa fa-lock"></i> Logout</a>
        </div>
      </li>
    </ul>
  </header>