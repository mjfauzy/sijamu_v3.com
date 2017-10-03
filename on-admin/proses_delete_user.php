<?php
	include "../koneksi.php";
	$id = $_GET['id'];

	$delete = mysqli_query($connect,"DELETE FROM tbl_user WHERE id='$id'");

	$connect->close();
	header('location:menu_data_user.php');
	exit();
?>