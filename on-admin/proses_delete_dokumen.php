<?php
	include "../koneksi.php";
	$id = $_GET['id'];
	$status = "Telah Dihapus";
	$tanggal = date('d-m-Y, H:i:s');

	$delete = mysqli_query($connect,"UPDATE tbl_dokumen set status='$status' WHERE id='$id'");
	$move_file = mysqli_query($connect,"SELECT * FROM tbl_dokumen WHERE id='$id'");
	if($move_file) {
		if($move_file->num_rows > 0) {
			while($row = $move_file->fetch_object()) {
				$file = $row->file;
				$no_dokumen = $row->no_dokumen;
				$jenis_dokumen = $row->kode_jenis;
				rename('../files/uploads/draf/'.$file,'../files/trash/'.$file);
			}
		}
	}

	$insert_daftar_induk = mysqli_query($connect,"INSERT INTO tbl_rek_daftar_induk_dokumen (tanggal,no_dokumen,no_revisi,jumlah_salinan,keterangan,status,jenis_dokumen) VALUES('$tanggal','$no_dokumen','0','1','$keterangan','$status','$jenis_dokumen')");

	$connect->close();
	$insert_daftar_induk->close();
	
	header('location:menu_0.php');
	exit();
?>