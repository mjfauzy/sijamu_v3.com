<?php

session_start();
include "../koneksi.php";

$id = $_POST['id'];
$id_user = $_SESSION['id'];

$file_upload = rand(1000,100000)."-".$_FILES['file_upload']['name'];
$file_loc = $_FILES['file_upload']['tmp_name'];
$file_size = $_FILES['file_upload']['size'];
$file_type = $_FILES['file_upload']['type'];
$folder = "../files/uploads/draf/";

$status = "Telah Diperiksa";

$tanggal_edit = date('d-m-Y, H:i:s');
$tanggal_checked = date('d-m-Y');

$select_file = mysqli_query($connect,"SELECT * FROM tbl_dokumen WHERE id='$id'");
if($select_file) {
	if($select_file->num_rows > 0) {
		while($row_select = $select_file->fetch_object()) {
			$file = $row_select->file;
			$no_dokumen = $row_select->no_dokumen;
			$jenis_dokumen = $row_select->kode_jenis;
			unlink('../files/uploads/draf/'.$file);
			move_uploaded_file($file_loc,$folder.$file_upload);
		}
	}
}

$checked = mysqli_query($connect, "UPDATE tbl_dokumen SET status='$status',file='$file_upload',file_type='$file_type',file_size='$file_size',last_edited='$tanggal_edit' WHERE id='$id'");

$insert_autentikasi_dokumen = mysqli_query($connect,"UPDATE tbl_rek_autentikasi_dokumen SET diperiksa_oleh='$id_user',tanggal_diperiksa='$tanggal_checked' WHERE no_dokumen='$no_dokumen'");

$keterangan = "Dokumen Telah Diperiksa Oleh yang Berwenang";
$insert_daftar_induk = mysqli_query($connect,"INSERT INTO tbl_rek_daftar_induk_dokumen (tanggal,no_dokumen,no_revisi,jumlah_salinan,keterangan,status,jenis_dokumen) VALUES('$tanggal_edit','$no_dokumen','0','1','$keterangan','$status','$jenis_dokumen')");


if($checked && $insert_autentikasi_dokumen && $insert_daftar_induk) {
	echo "<script>alert('Berhasil Update Data');</script>";
	echo "<meta http-equiv='refresh' content='0; url=menu_1.php'>";
} else {
	echo "<script>alert('Gagal Update Data');</script>";
	echo "<meta http-equiv='refresh' content='0; url=menu_1.php'>";
}

$connect->close();
$select_file->close();
$checked->close();
$insert_autentikasi_dokumen->close();
$insert_daftar_induk->close();

exit();

?>