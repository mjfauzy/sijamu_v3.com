<?php
  session_start();
  include "../koneksi.php";
	$id = $_GET['id'];
	$result_formulir = mysqli_query($connect, "SELECT * FROM tbl_formulir WHERE id='$id'");

	if ($result_formulir) {
		if ($result_formulir->num_rows > 0) {
			while ($row_formulir = $result_formulir->fetch_object()) {
?>

<div class="modal-dialog">
    <div class="modal-content">

        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title" id="myModalLabel">Edit Data Formulir</h4>
        </div>

        <div class="modal-body">
          <form action="proses_edit_formulir.php" name="modal_popup" enctype="multipart/form-data" method="POST">
                <input type="hidden" name="id" value="<?php echo $row_formulir->id; ?>" />
            
                <div class="form-group" style="padding-bottom: 20px;">
                  <label for="Kode Formulir">Kode Formulir</label>
                  <input type="text" name="kode_formulir"  class="form-control" value="<?php echo $row_formulir->kode_formulir; ?>" required />
                </div>

                <div class="form-group" style="padding-bottom: 20px;">
                  <label for="Nama Formulir">Nama Formulir</label>
                  <input type="text" name="nama_formulir"  class="form-control" value="<?php echo $row_formulir->nama_formulir; ?>" required />
                </div>

                <div class="form-group" style="padding-bottom: 20px;">
                  <label for="File">File</label>
                  <input type="file" name="file_upload" required />
                </div>

              <div class="modal-footer">
                <button class="btn btn-success" type="submit">Update</button>                
                <button type="reset" class="btn btn-danger"  data-dismiss="modal" aria-hidden="true">Tutup</button>
              </div>
              </form>

            </div>
        </div>

    </div>
</div>


<?php

			}
		}
	}

	$connect->close();
  exit();
?>