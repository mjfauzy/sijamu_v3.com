<?php

session_start();
include "../koneksi.php";

$id = $_POST['id'];
$password_lama = md5($_POST['password_lama']);
$password_baru = md5($_POST['password_baru']);

$result_password = mysqli_query($connect,"SELECT password FROM tbl_user WHERE id='$id'");
if($result_password) {
	if($result_password->num_rows > 0) {
		$row_result = $result_password->fetch_object();
		$get_password_lama = $row_result->password;
		if($get_password_lama != $password_lama) {
			echo "<script>alert('Password Lama Tidak Sesuai');</script>";
			echo "<meta http-equiv='refresh' content='0; url=menu_data_user.php'>";
			exit();
			break;
		}
	}
}

$tanggal_edit = date('d-m-Y, H:i:s');

$update_password = mysqli_query($connect,"UPDATE tbl_user SET password='$password_baru' WHERE id='$id'");

if($update_password) {
	echo "<script>alert('Berhasil Update Password');</script>";
	echo "<meta http-equiv='refresh' content='0; url=menu_data_user.php'>";
} else {
	echo "<script>alert('Gagal Update Password');</script>";
	echo "<meta http-equiv='refresh' content='0; url=menu_data_user.php'>";
}

$connect->close();
exit();

?>