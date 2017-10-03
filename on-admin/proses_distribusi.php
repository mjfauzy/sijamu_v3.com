<?php

session_start();
include "../koneksi.php";

$jumlah_data = count($_POST['kode_org']);
$id_dokumen = $_POST['id'];
$kode_org = $_POST['kode_org'];
$kode_salinan = $_POST['kode_salinan'];
$status = "Telah Didistribusi";
$tanggal_upload = date('d-m-Y, H:i:s');

if(!empty($_FILES['file_upload']['tmp_name'])) {
	$file_name = $_FILES['file_upload']['name'];
	$file_loc = $_FILES['file_upload']['tmp_name'];
	$file_size = $_FILES['file_upload']['size'];
	$file_type = $_FILES['file_upload']['type'];
} else {
	$file_name = '';
}

$update = false;
$insert = false;

for($i=0; $i<$jumlah_data;$i++) {
	$search_data = mysqli_query($connect,"SELECT * FROM tbl_rek_file_distribusi WHERE id_dokumen='$id_dokumen' AND kode_salinan='$kode_salinan[$i]'");
	if($search_data) {
		if($search_data->num_rows > 0) {
			while($row_data = $search_data->fetch_object()) {
				$file = $row_data->file;
				if($file_name[$i] != '') {
					if($file != '') {
						if($kode_salinan[$i] == "MASTER") {
							$file_upload = $file_name[$i];
							unlink('../files/uploads/terkendali/master/'.$file);
							$folder = "../files/uploads/terkendali/master/";
							move_uploaded_file($file_loc[$i],$folder.$file_upload);
							$update_data = mysqli_query($connect,"UPDATE tbl_rek_file_distribusi SET file='$file_upload',file_type='$file_type[$i]',file_size='$file_size[$i]',tanggal_upload='$tanggal_upload' WHERE id_daftar_distribusi='$row_data->id_daftar_distribusi'");

							$update = true;
						} else {
							$file_upload = $file_name[$i];
							unlink('../files/uploads/terkendali/copy/'.$file);
							$folder = "../files/uploads/terkendali/copy/";
							move_uploaded_file($file_loc[$i],$folder.$file_upload);
							$update_data = mysqli_query($connect,"UPDATE tbl_rek_file_distribusi SET file='$file_upload',file_type='$file_type[$i]',file_size='$file_size[$i]',tanggal_upload='$tanggal_upload' WHERE id_daftar_distribusi='$row_data->id_daftar_distribusi'");

							$update = true;
						}
					} else {
						if($kode_salinan[$i] == "MASTER") {
							$file_upload = $file_name[$i];
							$folder = "../files/uploads/terkendali/master/";
							move_uploaded_file($file_loc[$i],$folder.$file_upload);
							$update_data = mysqli_query($connect,"UPDATE tbl_rek_file_distribusi SET file='$file_upload',file_type='$file_type[$i]',file_size='$file_size[$i]',tanggal_upload='$tanggal_upload' WHERE id_daftar_distribusi='$row_data->id_daftar_distribusi'");

							$update = true;
						} else {
							$file_upload = $file_name[$i];
							$folder = "../files/uploads/terkendali/copy/";
							move_uploaded_file($file_loc[$i],$folder.$file_upload);
							$update_data = mysqli_query($connect,"UPDATE tbl_rek_file_distribusi SET file='$file_upload',file_type='$file_type[$i]',file_size='$file_size[$i]',tanggal_upload='$tanggal_upload' WHERE id_daftar_distribusi='$row_data->id_daftar_distribusi'");

							$update = true;
						}
					}
				}
			}
		} else {
			if($file_name[$i] != '') {
				if($kode_salinan[$i] == 'MASTER') {
					$file_upload = $file_name[$i];
					$folder = "../files/uploads/terkendali/master/";
					move_uploaded_file($file_loc[$i],$folder.$file_upload);
					$insert_data = mysqli_query($connect,"INSERT INTO tbl_rek_file_distribusi (id_dokumen,kode_org,kode_salinan,file,file_type,file_size,tanggal_upload) VALUES ('$id_dokumen','$kode_org[$i]','$kode_salinan[$i]','$file_upload','$file_type[$i]','$file_size[$i]','$tanggal_upload')");

					$insert = true;
				} else {
					$file_upload = $file_name[$i];
					$folder = "../files/uploads/terkendali/copy/";
					move_uploaded_file($file_loc[$i],$folder.$file_upload);
					$insert_data = mysqli_query($connect,"INSERT INTO tbl_rek_file_distribusi (id_dokumen,kode_org,kode_salinan,file,file_type,file_size,tanggal_upload) VALUES ('$id_dokumen','$kode_org[$i]','$kode_salinan[$i]','$file_upload','$file_type[$i]','$file_size[$i]','$tanggal_upload')");

					$insert = true;
				}
			}
		}
	}
}

$result_dokumen = mysqli_query($connect,"SELECT * FROM tbl_dokumen WHERE id='$id'");
if($result_dokumen) {
	if($result_dokumen->num_rows > 0) {
		$row_dokumen = $result_dokumen->fetch_object();
		$no_dokumen = $row_dokumen->no_dokumen;
		$keterangan = "Dokumen Telah Didistribusikan Oleh yang Berwenang";
		$jenis_dokumen = $row_dokumen->kode_jenis;
	}
}

if($insert) {
	$update_status_dokumen = mysqli_query($connect,"UPDATE tbl_dokumen SET status='$status' WHERE id='$id_dokumen'");
	$insert_daftar_induk = mysqli_query($connect,"INSERT INTO tbl_rek_daftar_induk_dokumen (tanggal,no_dokumen,no_revisi,jumlah_salinan,keterangan,status,jenis_dokumen) VALUES('$tanggal_upload','$no_dokumen','0','1','$keterangan','$status','$jenis_dokumen')");
	echo "<script>alert('Berhasil Distribusi Dokumen Terkendali');</script>";
	echo "<meta http-equiv='refresh' content='0; url=menu_2.php'>";
} elseif($update) {
	echo "<script>alert('Berhasil Update Distribusi Dokumen Terkendali');</script>";
	echo "<meta http-equiv='refresh' content='0; url=menu_2.php'>";
} else {
	echo "<script>alert('Gagal Proses Distribusi Dokumen Terkendali');</script>";
	echo "<meta http-equiv='refresh' content='0; url=menu_2.php'>";
}


$connect->close();
exit();

?>