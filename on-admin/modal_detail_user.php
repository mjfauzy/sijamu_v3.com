<?php
  include "../koneksi.php";
	$id = $_GET['id_user'];
	$result = mysqli_query($connect, "SELECT * FROM tbl_user WHERE id='$id'");

	if ($result) {
		if ($result->num_rows > 0) {
			while ($row = $result->fetch_object()) {
?>

<div class="modal-dialog">
    <div class="modal-content">

        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title" id="myModalLabel">Detail User</h4>
        </div>

        <div class="modal-body">
              <div class="form-group" style="padding-bottom: 20px;">
                  <label for="Nama">Nama</label>
                  <input type="text" name="nama"  class="form-control" value="<?php echo $row->nama; ?>" disabled/>
                </div>

                <div class="form-group" style="padding-bottom: 20px;">
                  <label for="Username">Username</label>
                  <input type="text" name="username"  class="form-control" value="<?php echo $row->username; ?>" disabled/>
                </div>

                <div class="form-group" style="padding-bottom: 20px;">
                  <label for="Jabatan">Jabatan</label>
                  <?php
                    $result_org = mysqli_query($connect,"SELECT nama_org FROM tbl_organisasi WHERE kode_org='$row->kode_org'");
                    if($result_org->num_rows > 0) {
                      $row_org = $result_org->fetch_object();
                      $jabatan = $row->jabatan." ".$row_org->nama_org;
                    }
                  ?>
                  <input type="text" name="jabatan"  class="form-control" disabled value="<?php echo $jabatan; ?>" />
                </div>

                <div class="form-group" style="padding-bottom: 20px;">
                  <label for="Golongan">Golongan</label>
                  <input type="text" name="golongan"  class="form-control" value="<?php echo $row->golongan; ?>" disabled/>
                </div>

                <div class="form-group" style="padding-bottom: 20px;">
                  <label for="Hak Akses">Hak Akses</label>
                  <input type="text" name="level"  class="form-control" value="<?php echo $row->level; ?>" disabled/>
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