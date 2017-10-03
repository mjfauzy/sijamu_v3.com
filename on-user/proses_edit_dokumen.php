<?php

session_start();
include "../koneksi.php";

$id = $_POST['id'];
$kode_jenis = $_POST['jenis_dokumen'];
$no_dokumen = $_POST['no_dokumen'];
$judul_dokumen = $_POST['judul_dokumen'];
$keterangan_output = $_POST['keterangan_output'];
$tahun_prioritas = $_POST['tahun_prioritas'];
$kode_org = $_POST['organisasi'];

if(!empty($_FILES['file_upload']['tmp_name'])) {
	$file_upload = rand(1000,100000)."-".$_FILES['file_upload']['name'];
	$file_loc = $_FILES['file_upload']['tmp_name'];
	$file_size = $_FILES['file_upload']['size'];
	$file_type = $_FILES['file_upload']['type'];
	$folder = "../files/uploads/draf/";
} else {
	$file_upload = '';
}

$tanggal_edit = date('d-m-Y, H:i:s');

$select_file = mysqli_query($connect,"SELECT file FROM tbl_dokumen WHERE id='$id'");
if($select_file) {
	if($select_file->num_rows > 0) {
		while($row_select = $select_file->fetch_object()) {
			if($file_upload != '') {
				$file = $row_select->file;
				unlink('../files/uploads/draf/'.$file);
				move_uploaded_file($file_loc,$folder.$file_upload);
				$update = mysqli_query($connect, "UPDATE tbl_dokumen SET kode_jenis='$kode_jenis',no_dokumen='$no_dokumen',judul_dokumen='$judul_dokumen',keterangan_output='$keterangan_output',tahun_prioritas='$tahun_prioritas',kode_org='$kode_org',file='$file_upload',file_type='$file_type',file_size='$file_size',last_edited='$tanggal_edit' WHERE id='$id'");
			} else {
				$update = mysqli_query($connect, "UPDATE tbl_dokumen SET kode_jenis='$kode_jenis',no_dokumen='$no_dokumen',judul_dokumen='$judul_dokumen',keterangan_output='$keterangan_output',tahun_prioritas='$tahun_prioritas',kode_org='$kode_org',file='$file_upload',file_type='$file_type',file_size='$file_size',last_edited='$tanggal_edit' WHERE id='$id'");
			}
		}
	}
}

if($update) {
	echo "<script>alert('Berhasil Update Data');</script>";
	echo "<meta http-equiv='refresh' content='0; url=menu_1.php'>";
} else {
	echo "<script>alert('Gagal Update Data');</script>";
	echo "<meta http-equiv='refresh' content='0; url=menu_1.php'>";
}

$connect->close();
exit();

?>