<?php

session_start();

if(!isset($_SESSION['nama']) && $_SESSION['nama'] == '') {
  header('location:../index.php');
} elseif($_SESSION['level'] != 'admin') {
  session_destroy();
  header('location:../index.php');
}

$jabatan = $_SESSION['jabatan'];

?>

<!doctype html>
<html lang="en">
<head>
  <title>SIJAMU - Sistem Informasi Jaminan Mutu</title>
  <meta content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" name="viewport"/>
  <meta content="MJFauzy" name="author"/>
  <link rel="stylesheet" href="../bootstrap/css/bootstrap.css"/>
  <link rel="stylesheet" href="../datatables/dataTables.bootstrap.css"/>
  <script src="../js/jquery-1.11.2.min.js"></script>
  <script src="../bootstrap/js/bootstrap.js"></script>
  <script src="../datatables/jquery.dataTables.js"></script>
  <script src="../datatables/dataTables.bootstrap.js"></script>
</head>
<body>

<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="index.php"><img src="../images/logo.jpg" /> SIJAMU</a>
    </div> 
    <ul class="nav navbar-nav navbar-right">
      <li><a href="index.php">Beranda</a></li>
      <li class="dropdown">
      	<a class="dropdown-toggle" data-toggle="dropdown" href="#">Data Dokumen <span class="caret"></span></a>
      	<ul class="dropdown-menu">
          <li><a href="menu_0.php">Tambah Dokumen</a></li>
        <?php
          if($jabatan == "Kepala Unit Jaminan Mutu") {
            echo "<li><a href='menu_1.php'>Dokumen Masuk</a></li>";
          }
        ?>
      		<li><a href="menu_2.php">Kendali Dokumen</a></li>
          <li><a href="menu_3.php">Dokumen Terkendali</a></li>
      		<li><a href="menu_4.php">Usulan Dokumen</a></li>
          <li><a href="menu_5.php">Template Dokumen</a></li>
      	</ul>
      </li>
      <li><a href="menu_history.php">History Dokumen</a></li>
      <li><a href="menu_data_formulir.php">Data Formulir</a></li>
      <li><a href="menu_data_user.php">Data Users</a></li>
      <li><a href="#">Panduan</a></li> 
      <li><a href="#" data-toggle="modal" data-target="#ModalLogout"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
    </ul>
  </div>
</nav>


<!-- Modal Login Form -->
    <div id="ModalLogout" class="modal fade" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <h4 class="modal-title text-center">Anda Yakin Ingin Logout?</h4>
          </div>
          <div class="modal-body text-center">
          	<a href="check-logout.php" class="btn btn-primary">Ya</a>
          	<button class="btn btn-danger" data-dismiss="modal">Tidak</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->