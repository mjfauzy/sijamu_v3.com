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
            <h4 class="modal-title" id="myModalLabel">Detail Dokumen</h4>
        </div>

        <div class="modal-body">
                <div class="form-group" style="padding-bottom: 20px;">
                  <label for="No. Dokumen">No. Dokumen</label>
                  <input type="text" name="no_dokumen"  class="form-control" value="<?php echo $row_dokumen->no_dokumen; ?>" disabled/>
                </div>

                <div class="form-group" style="padding-bottom: 20px;">
                  <label for="Judul Dokumen">Judul Dokumen</label>
                  <input type="text" name="judul_dokumen"  class="form-control" value="<?php echo $row_dokumen->judul_dokumen; ?>" disabled/>
                </div>

                <div class="form-group" style="padding-bottom: 20px;">
                  <label for="Keterangan Output">Keterangan Output</label>
                  <textarea name="keterangan_output"  class="form-control" disabled><?php echo $row_dokumen->keterangan_output; ?></textarea>
                </div>

                <div class="form-group" style="padding-bottom: 20px;">
                  <label for="Tahun Prioritas">Tahun Prioritas</label>
                  <input type="text" name="tahun_prioritas"  class="form-control" value="<?php echo $row_dokumen->tahun_prioritas; ?>" disabled/>
                </div>

                <div class="form-group" style="padding-bottom: 20px;">
                  <label for="Bid/Bag/Subbid/Subbag">Bid/Bag/Subbid/Subbag</label>
                  <?php
                    $result_org = mysqli_query($connect,"SELECT nama_org FROM tbl_organisasi WHERE kode_org='$row_dokumen->kode_org'");
                    while($row_org = $result_org->fetch_object()) {
                      echo "<input type='text' name='organisasi' class='form-control' value='$row_org->nama_org' disabled />";
                    }
                  ?>
                </div>

                <div class="form-group" style="padding-bottom: 20px;">
                  <label for="Disiapkan Oleh">Disiapkan Oleh</label>
                  <?php
                    $result_user = mysqli_query($connect,"SELECT * FROM tbl_user WHERE id='$row_dokumen->id_user'");
                    while($row_user = $result_user->fetch_object()) {
                      $result_org = mysqli_query($connect,"SELECT * FROM tbl_organisasi WHERE kode_org='$row_user->kode_org'");
                      if($result_org->num_rows > 0) {
                        $row_org = $result_org->fetch_object();
                        echo "<input type='text' name='organisasi' class='form-control' value='$row_user->nama ($row_user->jabatan $row_org->nama_org)' disabled />";
                      }
                    }
                  ?>
                </div>

                <div class="form-group" style="padding-bottom: 20px;">
                  <label for="Tanggal Upload">Tanggal Upload</label>
                  <input type="text" name="tanggal_upload"  class="form-control" value="<?php echo $row_dokumen->tgl_upload; ?>" disabled/>
                </div>

              <div class="modal-footer">
                  <button type="reset" class="btn btn-danger"  data-dismiss="modal" aria-hidden="true">
                    Tutup
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