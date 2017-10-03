<?php
	include "../koneksi.php";
	$id = $_GET['id'];

	$move_file = mysqli_query($connect,"SELECT * FROM tbl_formulir WHERE id='$id'");
	if($move_file) {
		if($move_file->num_rows > 0) {
			while($row = $move_file->fetch_object()) {
				$file = $row->file;
				unlink('../files/uploads/formulir/'.$file);
			}
		}
	}

	$delete = mysqli_query($connect,"DELETE FROM tbl_formulir WHERE id='$id'");

	$connect->close();
	
	header('location:menu_data_formulir.php');
	exit();
?>