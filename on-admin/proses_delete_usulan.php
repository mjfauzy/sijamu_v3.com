<?php
	include "../koneksi.php";
	$id = $_GET['id'];

	$delete = mysqli_query($connect,"DELETE FROM tbl_rek_usulan WHERE id_usulan='$id'");

	$connect->close();
	header('location:menu_4.php');
	exit();
?>