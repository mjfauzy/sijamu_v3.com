<?php

session_start();
include "../koneksi.php";

$tanggal_upload = $_POST['tanggal_upload'];
$kode_jenis = $_POST['jenis_dokumen'];
$no_dokumen = $_POST['no_dokumen'];
$judul_dokumen = $_POST['judul_dokumen'];
$keterangan_output = $_POST['keterangan_output'];
$tahun_prioritas = $_POST['tahun_prioritas'];
$kode_org = $_POST['organisasi'];
$status = "Draf";
$file = rand(1000,100000)."-".$_FILES['file_upload']['name'];
$file_loc = $_FILES['file_upload']['tmp_name'];
$file_size = $_FILES['file_upload']['size'];
$file_type = $_FILES['file_upload']['type'];
$folder = "../files/uploads/draf/";
$id_user = $_SESSION['id'];
$last_edited = date('d-m-Y, H:i:s');

$disiapkan_oleh_2 = $_POST['disiapkan_oleh_2'];
$diperiksa_oleh_1 = $_POST['diperiksa_oleh_1'];
$diperiksa_oleh_2 = $_POST['diperiksa_oleh_2'];

move_uploaded_file($file_loc,$folder.$file);

$search = mysqli_query($connect,"SELECT * FROM tbl_dokumen WHERE no_dokumen='$no_dokumen' AND status NOT IN ('Telah Dihapus','Tidak Berlaku')");
if($search) {
	if($search->num_rows > 0) {
		while($row = $search->fetch_object()) {	
			echo "<script>alert('Dokumen Dengan Nomor $no_dokumen Sudah Tersedia');</script>";
			echo "<meta http-equiv='refresh' content='0; url=menu_1.php'>";
		}	
	} else {
		$simpan = mysqli_query($connect, "INSERT INTO tbl_dokumen (tgl_upload,kode_jenis,no_dokumen,judul_dokumen,keterangan_output,tahun_prioritas,kode_org,status,file,file_type,file_size,id_user,last_edited) VALUES ('$tanggal_upload','$kode_jenis','$no_dokumen','$judul_dokumen','$keterangan_output','$tahun_prioritas','$kode_org','$status','$file','$file_type','$file_size','$id_user','$last_edited')");
		
		$insert_daftar_induk = mysqli_query($connect,"INSERT INTO tbl_rek_daftar_induk_dokumen (tanggal,no_dokumen,no_revisi,jumlah_salinan,keterangan,status,jenis_dokumen) VALUES ('$tanggal_upload','$no_dokumen','0','1','$keterangan_output','$status','$kode_jenis')");
		
		if($disiapkan_oleh_2 != '-') {
			if($diperiksa_oleh_2 != '-') {
				$insert_autentikasi_dokumen = mysqli_query($connect,"INSERT INTO tbl_rek_autentikasi_dokumen (no_dokumen,disiapkan_oleh,tanggal_disiapkan,disiapkan_oleh_2,tanggal_disiapkan_2,diperiksa_oleh,diperiksa_oleh_2) VALUES ('$no_dokumen','$id_user','$tanggal_upload','$disiapkan_oleh_2','$tanggal_upload','$diperiksa_oleh_1','$diperiksa_oleh_2')");
			} else {
				$insert_autentikasi_dokumen = mysqli_query($connect,"INSERT INTO tbl_rek_autentikasi_dokumen (no_dokumen,disiapkan_oleh,tanggal_disiapkan,disiapkan_oleh_2,tanggal_disiapkan_2,diperiksa_oleh) VALUES ('$no_dokumen','$id_user','$tanggal_upload','$disiapkan_oleh_2','$tanggal_upload','$diperiksa_oleh_1')");

			}
		} else {
			if($diperiksa_oleh_2 != '-') {
				$insert_autentikasi_dokumen = mysqli_query($connect,"INSERT INTO tbl_rek_autentikasi_dokumen (no_dokumen,disiapkan_oleh,tanggal_disiapkan,diperiksa_oleh,diperiksa_oleh_2) VALUES ('$no_dokumen','$id_user','$tanggal_upload','$diperiksa_oleh_1','$diperiksa_oleh_2')");
			} else {
				$insert_autentikasi_dokumen = mysqli_query($connect,"INSERT INTO tbl_rek_autentikasi_dokumen (no_dokumen,disiapkan_oleh,tanggal_disiapkan,diperiksa_oleh) VALUES ('$no_dokumen','$id_user','$tanggal_upload','$diperiksa_oleh_1')");

			}
		}

		if($simpan && $insert_daftar_induk && $insert_autentikasi_dokumen) {
			echo "<script>alert('Berhasil Simpan Data');</script>";
			echo "<meta http-equiv='refresh' content='0; url=menu_0.php'>";
		} else {
			echo "<script>alert('Gagal Simpan Data');</script>";
			echo "<meta http-equiv='refresh' content='0; url=menu_0.php'>";
		}
	}
}

$connect->close();
exit();

?>