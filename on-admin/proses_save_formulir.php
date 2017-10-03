<?php

session_start();
include "../koneksi.php";

$kode_formulir = $_POST['kode_formulir'];
$nama_formulir = $_POST['nama_formulir'];
$file = rand(1000,100000)."-".$_FILES['file_upload']['name'];
$file_loc = $_FILES['file_upload']['tmp_name'];
$file_size = $_FILES['file_upload']['size'];
$file_type = $_FILES['file_upload']['type'];
$folder = "../files/uploads/formulir/";

move_uploaded_file($file_loc,$folder.$file);

$search = mysqli_query($connect,"SELECT * FROM tbl_formulir WHERE kode_formulir='$kode_formulir'");
if($search) {
	if($search->num_rows > 0) {
		while($row = $search->fetch_object()) {	
			echo "<script>alert('Formulir dengan Kode $kode_formulir Sudah Tersedia');</script>";
			echo "<meta http-equiv='refresh' content='0; url=menu_data_formulir.php'>";
		}	
	} else {
		$simpan = mysqli_query($connect, "INSERT INTO tbl_formulir (kode_formulir,nama_formulir,file,file_size,file_type) VALUES ('$kode_formulir','$nama_formulir','$file','$file_size','$file_type')");

		if($simpan) {
			echo "<script>alert('Berhasil Simpan Data');</script>";
			echo "<meta http-equiv='refresh' content='0; url=menu_data_formulir.php'>";
		} else {
			echo "<script>alert('Gagal Simpan Data');</script>";
			echo "<meta http-equiv='refresh' content='0; url=menu_data_formulir.php'>";
		}
	}
}

$connect->close();
exit();

?>