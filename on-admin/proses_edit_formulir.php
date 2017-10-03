<?php

session_start();
include "../koneksi.php";

$id = $_POST['id'];
$kode_formulir = $_POST['kode_formulir'];
$nama_formulir = $_POST['nama_formulir'];

if(!empty($_FILES['file_upload']['tmp_name'])) {
	$file_upload = rand(1000,100000)."-".$_FILES['file_upload']['name'];
	$file_loc = $_FILES['file_upload']['tmp_name'];
	$file_size = $_FILES['file_upload']['size'];
	$file_type = $_FILES['file_upload']['type'];
	$folder = "../files/uploads/formulir/";
} else {
	$file_upload = '';
}

$select_file = mysqli_query($connect,"SELECT file FROM tbl_formulir WHERE id='$id'");
if($select_file) {
	if($select_file->num_rows > 0) {
		while($row_select = $select_file->fetch_object()) {
			if($file_upload != '') {
				if($row_select->file != '') {
					$file = $row_select->file;
					unlink('../files/uploads/formulir/'.$file);
					move_uploaded_file($file_loc,$folder.$file_upload);
					$update = mysqli_query($connect, "UPDATE tbl_formulir SET kode_formulir='$kode_formulir',nama_formulir='$nama_formulir',file='$file_upload',file_size='$file_size',file_type='$file_type' WHERE id='$id'");
				}
			}
		}
	}
}

if($update) {
	echo "<script>alert('Berhasil Update Data');</script>";
	echo "<meta http-equiv='refresh' content='0; url=menu_data_formulir.php'>";
} else {
	echo "<script>alert('Gagal Update Data');</script>";
	echo "<meta http-equiv='refresh' content='0; url=menu_data_formulir.php'>";
}

$connect->close();
exit();

?>