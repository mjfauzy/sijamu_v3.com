<?php

session_start();
include "../koneksi.php";

$kode_jenis = $_POST['id'];

$file_upload = rand(1000,100000)."-".$_FILES['file_upload']['name'];
$file_loc = $_FILES['file_upload']['tmp_name'];
$file_size = $_FILES['file_upload']['size'];
$file_type = $_FILES['file_upload']['type'];
$folder = "../files/uploads/template/";

$tanggal_edit = date('d-m-Y, H:i:s');

$select_file = mysqli_query($connect,"SELECT * FROM tbl_jenis_dokumen WHERE kode_jenis='$kode_jenis'");
if($select_file) {
	if($select_file->num_rows > 0) {
		while($row_select = $select_file->fetch_object()) {
			$file = $row_select->file;
			if($file != '') {
				unlink('../files/uploads/template/'.$file);
				move_uploaded_file($file_loc,$folder.$file_upload);
			} else {
				move_uploaded_file($file_loc,$folder.$file_upload);
			}
			
			$reuploaded = mysqli_query($connect, "UPDATE tbl_jenis_dokumen SET file='$file_upload',file_type='$file_type',file_size='$file_size',last_edited='$tanggal_edit' WHERE kode_jenis='$kode_jenis'");
		}
	}
}


if($reuploaded) {
	echo "<script>alert('Berhasil Update Template');</script>";
	echo "<meta http-equiv='refresh' content='0; url=menu_5.php'>";
} else {
	echo "<script>alert('Gagal Update Template');</script>";
	echo "<meta http-equiv='refresh' content='0; url=menu_5.php'>";
}

$connect->close();
exit();

?>