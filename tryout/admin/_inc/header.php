<?php
    require 'connect.php';
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Try Out - Admin</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/font-awesome-4.5.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="assets/ionicons-2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="dist/css/skins/skin-yellow.min.css">
  <!--link rel="stylesheet" href="plugins/datatables/jquery.dataTables.css"-->
  <link rel="stylesheet" href="plugins/datatables/extensions/TableTools/css/dataTables.tableTools.min.css">
  <link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <link rel="stylesheet" href="plugins/summernote/summernote.css">

  <script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
  <script src="bootstrap/js/bootstrap.min.js"></script>
  <script src="dist/js/app.min.js"></script>
  <script src="plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
  <script src="plugins/datatables/extensions/TableTools/js/dataTables.tableTools.min.js"></script>
  <script src="plugins/hideShowPassword/js/hideShowPassword.min.js"></script>
  <script src="plugins/daterangepicker/moment.min.js"></script>
  <script src="plugins/daterangepicker/daterangepicker.js"></script>
  <script src="plugins/summernote/summernote.js"></script>
  <script src="plugins/jquery.countdown.package-2.1.0/js/jquery.plugin.min.js"></script>
  <script src="plugins/jquery.countdown.package-2.1.0/js/jquery.countdown.min.js"></script>

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>

<body class="hold-transition skin-yellow sidebar-mini">
<div class="wrapper">

  <!-- Main Header -->
  <header class="main-header">

    <!-- Logo -->
    <a href="../tryout.php" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>TO</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Try Out</b></span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar Menu -->
      <ul class="sidebar-menu">
        <!--<li class="header"></li>-->
        <li<?php if(basename($_SERVER['SCRIPT_NAME']) === 'dasbor.php') echo ' class="active"'; ?>><a href="dasbor.php"><i class="fa fa-dashboard"></i> <span>Dasbor</span></a></li>
        <li<?php if(basename($_SERVER['SCRIPT_NAME']) === 'verifikasi.php') echo ' class="active"'; ?>><a href="verifikasi.php"><i class="fa fa-check"></i> <span>Verifikasi</span></a></li>
        <li<?php if(basename($_SERVER['SCRIPT_NAME']) === 'soal.php') echo ' class="active"'; ?>><a href="soal.php"><i class="fa fa-tags"></i> <span>Soal</span></a></li>
        <li class="treeview<?php if(basename($_SERVER['SCRIPT_NAME']) === 'pertanyaan.php') echo ' active'; ?>">
          <a href="#">
            <i class="fa fa-question-circle"></i> <span>Pertanyaan</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <?php
              $result = $connect->query('SELECT id_soal, nama_soal FROM soal');
              while($data = $result->fetch_object()) {
            ?>
            <li<?php if(basename($_SERVER['SCRIPT_NAME']) === 'pertanyaan.php' && $_GET['id'] === $data->id_soal) echo ' class="active"'; ?>><a href="pertanyaan.php?id=<?php echo $data->id_soal ?>"><i class="fa fa-question"></i> <span><?php echo $data->nama_soal ?></span></a></li>
            <?php
              }
            ?>
          </ul>
        </li>
        <li class="treeview<?php if(basename($_SERVER['SCRIPT_NAME']) === 'hasil.php') echo ' active'; ?>">
          <a href="#">
            <i class="fa fa-copy"></i> <span>Hasil</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <?php
              $result = $connect->query('SELECT id_soal, nama_soal FROM soal');
              while($data = $result->fetch_object()) {
            ?>
            <li<?php if(basename($_SERVER['SCRIPT_NAME']) === 'hasil.php' && $_GET['id'] === $data->id_soal) echo ' class="active"'; ?>><a href="hasil.php?id=<?php echo $data->id_soal ?>"><i class="fa fa-file-o"></i> <span><?php echo $data->nama_soal ?></span></a></li>
            <?php
              }
            ?>
          </ul>
        </li>
        <li<?php if(basename($_SERVER['SCRIPT_NAME']) === 'pengguna.php') echo ' class="active"'; ?>><a href="pengguna.php"><i class="fa fa-users"></i> <span>Pengguna</span></a></li>
        <!--<li<?php if(basename($_SERVER['SCRIPT_NAME']) === 'pengaturan.php') echo ' class="active"'; ?>><a href="pengaturan.php"><i class="fa fa-gear"></i> <span>Pengaturan</span></a></li>-->
      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>
