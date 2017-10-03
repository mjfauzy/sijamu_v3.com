<?php
  session_start();
  include "../koneksi.php";
	$id = $_GET['id'];

	$result_dokumen = mysqli_query($connect, "SELECT * FROM tbl_dokumen WHERE id='$id'");

	if ($result_dokumen) {
		if ($result_dokumen->num_rows > 0) {
			while ($row_dokumen = $result_dokumen->fetch_object()) {
?>

<div class="modal-dialog">
    <div class="modal-content">

        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title" id="myModalLabel">Upload Dokumen yang Telah Diperiksa</h4>
        </div>

        <div class="modal-body">
          <form action="proses_checked_dokumen.php" name="modal_popup" enctype="multipart/form-data" method="POST">
          		  <input type="hidden" name="id" value="<?php echo $row_dokumen->id; ?>" />

                <div class="form-group" style="padding-bottom: 20px;">
                  <label for="No. Dokumen">No. Dokumen</label>
                  <input type="text" name="no_dokumen"  class="form-control" placeholder="Nomor Dokumen" value="<?php echo $row_dokumen->no_dokumen; ?>" disabled/>
                </div>

                <div class="form-group" style="padding-bottom: 20px;">
                  <label for="Judul Dokumen">Judul Dokumen</label>
                  <input type="text" name="judul_dokumen"  class="form-control" placeholder="Judul Dokumen" value="<?php echo $row_dokumen->judul_dokumen; ?>" disabled/>
                </div>

                <div class="form-group" style="padding-bottom: 20px;">
                  <label for="File">File</label>
                  <input type="file" name="file_upload" value="<?php echo $row_dokumen->file; ?>" required />
                </div>

              <div class="modal-footer">
                  <button class="btn btn-success" type="submit">
                    Upload
                  </button>

                  <button type="reset" class="btn btn-danger"  data-dismiss="modal" aria-hidden="true">
                    Kembali
                  </button>
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