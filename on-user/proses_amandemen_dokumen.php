<?php

session_start();
include "../koneksi.php";

$id = $_POST['id'];
$id_user = $_SESSION['id'];
$catatan = $_POST['catatan'];
$jenis_usulan = "Amandemen";
$tanggal = date('d-m-Y, H:i:s');

$search_dokumen = mysqli_query($connect,"SELECT * FROM tbl_rek_usulan WHERE id_dokumen='$id'");
if($search_dokumen) {
	if($search_dokumen->num_rows > 0) {
		$row_dokumen = $search_dokumen->fetch_object();
		if($row_dokumen->jenis_usulan == "Amandemen") {
			echo "<script>alert('Dokumen Telah Memiliki Usulan Amandemen');</script>";
			echo "<meta http-equiv='refresh' content='0; url=menu_4.php'>";
		} elseif($row_dokumen->jenis_usulan == "Pemusnahan") {
			echo "<script>alert('Dokumen Telah Memiliki Usulan Pemusnahan');</script>";
			echo "<meta http-equiv='refresh' content='0; url=menu_4.php'>";
		}
	} else {
		$simpan_usulan = mysqli_query($connect,"INSERT INTO tbl_rek_usulan (id_dokumen,jenis_usulan,catatan,pembuat_usulan,tanggal_upload) VALUES ('$id','$jenis_usulan','$catatan','$id_user','$tanggal')");

		if($simpan_usulan) {
			echo "<script>alert('Berhasil Kirim Usulan');</script>";
			echo "<meta http-equiv='refresh' content='0; url=menu_4.php'>";
		} else {
			echo "<script>alert('Gagal Kirim Usulan');</script>";
			echo "<meta http-equiv='refresh' content='0; url=menu_4.php'>";
		}
	}
}

$connect->close();
exit();

?>