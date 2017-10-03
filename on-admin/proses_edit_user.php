<?php

session_start();
include "../koneksi.php";

$id = $_POST['id_user'];
$nama = $_POST['nama'];
$jabatan = $_POST['jabatan'];
$kode_org = $_POST['kode_org'];
$result_org = mysqli_query($connect,"SELECT nama_org FROM tbl_organisasi WHERE kode_org='$kode_org'");
if($result_org) {
	if($result_org->num_rows > 0) {
		while($row_org = $result_org->fetch_object()) {
			$nama_org = $row_org->nama_org;
		}
	}
}
$pimpinan = $jabatan." ".$nama_org;
if($pimpinan == "Kepala Pusat Sains dan Teknologi Bahan Maju") {
	$eselon = "Eselon II";
} elseif($pimpinan == "Kepala Bagian Tata Usaha" || $pimpinan == "Kepala Bidang Sains Bahan Maju" || $pimpinan == "Kepala Bidang Teknologi Berkas Neutron" || $pimpinan == "Kepala Bidang Keselamatan Kerja dan Keteknikan") {
	$eselon = "Eselon III";
} elseif($pimpinan == "Kepala Sub Bag. PKDI" || $pimpinan == "Kepala Sub Bag. Keuangan" || $pimpinan == "Kepala Sub Bag. Perlengkapan" || $pimpinan == "Kepala Sub Bid. KKPR" || $pimpinan == "Kepala Sub Bid. Keteknikan" || $pimpinan == "Kepala Unit Jaminan Mutu") {
	$eselon = "Eselon IV";
} else {
	$eselon = "-";
}
$golongan = $_POST['golongan'];
$username = $_POST['username'];
$password = md5($_POST['password']);
$level = $_POST['level'];

$update = mysqli_query($connect, "UPDATE tbl_user SET nama='$nama',jabatan='$jabatan',eselon='$eselon',golongan='$golongan',kode_org='$kode_org',username='$username',password='$password',level='$level' WHERE id='$id'");

if($update) {
	echo "<script>alert('Berhasil Update Data');</script>";
	echo "<meta http-equiv='refresh' content='0; url=menu_data_user.php'>";
} else {
	echo "<script>alert('Gagal Update Data');</script>";
	echo "<meta http-equiv='refresh' content='0; url=menu_data_user.php'>";
}

$connect->close();
exit();

?>