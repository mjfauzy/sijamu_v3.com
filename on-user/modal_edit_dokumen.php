<?php
  session_start();
  include "../koneksi.php";
	$id = $_GET['id'];
  $eselon = $_SESSION['eselon'];
  $nama_org = $_SESSION['nama_org'];
	$result_dokumen = mysqli_query($connect, "SELECT * FROM tbl_dokumen WHERE id='$id'");

	if ($result_dokumen) {
		if ($result_dokumen->num_rows > 0) {
			while ($row_dokumen = $result_dokumen->fetch_object()) {
?>

<div class="modal-dialog">
    <div class="modal-content">

        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title" id="myModalLabel">Edit Data Dokumen</h4>
        </div>

        <div class="modal-body">
          <form action="proses_edit_dokumen.php" name="modal_popup" enctype="multipart/form-data" method="POST">
          		  <input type="hidden" name="id" value="<?php echo $row_dokumen->id; ?>" />

                <div class="form-group" style="padding-bottom: 20px;">
                  <label for="Jenis Dokumen">Jenis Dokumen</label>
                  <select name="jenis_dokumen" class="form-control" required>
                    <?php
                      if($eselon == "Eselon IV") {
                        $result_jenis_dok = mysqli_query($connect,"SELECT * FROM tbl_jenis_dokumen WHERE disiapkan_oleh='$eselon'");
                        if($result_jenis_dok) {
                          if($result_jenis_dok->num_rows > 0) {
                            while($row_jenis = $result_jenis_dok->fetch_object()) {
                              echo "<option value='$row_jenis->kode_jenis' selected>$row_jenis->jenis_dokumen ($row_jenis->kode_jenis)</option>";
                            }
                          }
                        }
                      } else {
                        $result_jenis_dok = mysqli_query($connect,"SELECT * FROM tbl_jenis_dokumen WHERE kode_jenis='SOP.03'");
                        if($result_jenis_dok) {
                          if($result_jenis_dok->num_rows > 0) {
                            while($row_jenis = $result_jenis_dok->fetch_object()) {
                              echo "<option value='$row_jenis->kode_jenis' selected>$row_jenis->jenis_dokumen ($row_jenis->kode_jenis)</option>";
                            }
                          }
                        }
                      }
                    ?>
                  </select>
                </div>

                <div class="form-group" style="padding-bottom: 20px;">
                  <label for="No. Dokumen">No. Dokumen</label>
                  <input type="text" name="no_dokumen"  class="form-control" placeholder="Nomor Dokumen" value="<?php echo $row_dokumen->no_dokumen; ?>" required/>
                </div>

                <div class="form-group" style="padding-bottom: 20px;">
                  <label for="Judul Dokumen">Judul Dokumen</label>
                  <input type="text" name="judul_dokumen"  class="form-control" placeholder="Judul Dokumen" value="<?php echo $row_dokumen->judul_dokumen; ?>" required/>
                </div>

                <div class="form-group" style="padding-bottom: 20px;">
                  <label for="Keterangan Output">Keterangan Output</label>
                  <textarea name="keterangan_output" class="form-control" required><?php echo $row_dokumen->keterangan_output; ?></textarea>
                </div>

                <div class="form-group" style="padding-bottom: 20px;">
                  <label for="Tahun Prioritas">Tahun Prioritas</label>
                  <select name="tahun_prioritas" class="form-control" required>
                    <option value="" disabled selected> - Pilih Tahun - </option>
                    <?php
                      for($i=2000;$i<=date('Y');$i++) {
                        echo "<option value='$i'"; 
                        if($row_dokumen->tahun_prioritas == $i) echo "selected";
                        echo ">$i</option>";
                      }
                    ?>
                  </select>
                </div>

                <div class="form-group" style="padding-bottom: 20px;">
                  <label for="Bid/Bag/Subbid/Subbag">Bid/Bag/Subbid/Subbag</label>
                  <select name="organisasi" class="form-control" required>
                    <?php
                      $result_organisasi = mysqli_query($connect,"SELECT * FROM tbl_organisasi WHERE nama_org='$nama_org'");
                      if($result_organisasi) {
                        if($result_organisasi->num_rows > 0) {
                          while($row_org = $result_organisasi->fetch_object()) {
                            echo "<option value='$row_org->kode_org'>$nama_org</option>";
                          }
                        }
                      }
                    ?>
                  </select>
                </div>

                <div class="form-group" style="padding-bottom: 20px;">
                  <label for="File">File
                    <?php
                      if($row_dokumen->file != '') {
                        echo " - Tersedia";
                      }
                    ?>
                  </label>
                  <input type="file" name="file_upload" value="<?php echo $row_dokumen->file; ?>" />
                </div>

              <div class="modal-footer">
                  <button class="btn btn-success" type="submit">
                      Update
                  </button>

                  <button type="reset" class="btn btn-danger"  data-dismiss="modal" aria-hidden="true">
                    Batal
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