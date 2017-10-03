<?php
  session_start();
  include "../koneksi.php";
	$kode_jenis = $_GET['id'];

	$result_template = mysqli_query($connect, "SELECT * FROM tbl_jenis_dokumen WHERE kode_jenis='$kode_jenis'");

	if ($result_template) {
		if ($result_template->num_rows > 0) {
			while ($row_template = $result_template->fetch_object()) {
?>

<div class="modal-dialog">
    <div class="modal-content">

        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title" id="myModalLabel">Upload Template</h4>
        </div>

        <div class="modal-body">
          <form action="proses_reupload_template.php" name="modal_popup" enctype="multipart/form-data" method="POST">
                <input type="hidden" name="id" value="<?php echo $row_template->kode_jenis; ?>">
          		  
                <div class="form-group" style="padding-bottom: 20px;">
                  <label for="Kode Dokumen">Kode Dokumen</label>
                  <input type="text" name="kode_jenis"  class="form-control" placeholder="Kode Dokumen" value="<?php echo $row_template->kode_jenis; ?>" disabled/>
                </div>

                <div class="form-group" style="padding-bottom: 20px;">
                  <label for="Judul Template">Judul Template</label>
                  <input type="text" name="judul_template"  class="form-control" placeholder="Judul Template" value="<?php echo $row_template->jenis_dokumen; ?>" disabled/>
                </div>

                <div class="form-group" style="padding-bottom: 20px;">
                  <label for="File">File</label>
                  <input type="file" name="file_upload" required />
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