<?php
  include "../koneksi.php";

	$id_user = $_GET['id_user'];
	$result = mysqli_query($connect, "SELECT * FROM tbl_user WHERE id='$id_user'");

	if ($result) {
		if ($result->num_rows > 0) {
			while ($row = $result->fetch_object()) {
?>

<div class="modal-dialog">
    <div class="modal-content">

        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title" id="myModalLabel">Edit Data User</h4>
        </div>

        <div class="modal-body">
          <form action="proses_edit_user.php" name="modal_popup" enctype="multipart/form-data" method="POST">
          		  <input type="hidden" name="id_user" value="<?php echo $row->id; ?>" />

                <div class="form-group">
                  <input type="hidden" name="id_form" id="id_form">
                </div>

                <div class="form-group" style="padding-bottom: 20px;">
                  <label for="Nama">Nama</label>
                  <input type="text" name="nama"  class="form-control" value="<?php echo $row->nama; ?>" required/>
                </div>

                <div class="form-group" style="padding-bottom: 20px;">
                  <label for="Jabatan">Jabatan</label>
                  <select name="jabatan" class="form-control" required>
                    <option value="" disabled <?php if($row->jabatan == '') echo "selected" ?> > - Pilih Jabatan - </option>
                    <option value="Kepala" <?php if ($row->jabatan == 'Kepala') echo "selected" ?> >Kepala</option>
                    <option value="Staf" <?php if ($row->jabatan == 'Staf') echo "selected" ?> >Staf</option>
                    <option value="Penanggungjawab Alat" <?php if ($row->jabatan == 'Penanggungjawab Alat') echo "selected" ?> >Penanggungjawab Alat</option>
                    <option value="Operator Alat" <?php if ($row->jabatan == 'Operator Alat') echo "selected" ?> >Operator Alat</option>
                  </select>
                </div>

                <div class="form-group" style="padding-bottom: 20px;">
                  <label for="Unit Kerja">Unit Kerja</label>
                  <select name="kode_org" class="form-control" required>
                    <option value="" disabled <?php if($row->kode_org == '') echo "selected" ?> > - Pilih Unit Kerja - </option>
                    <?php
                      $result_org = mysqli_query($connect,"SELECT * FROM tbl_organisasi");
                      if($result_org) {
                        if($result_org->num_rows > 0) {
                          while($row_org = $result_org->fetch_object()) {
                            echo "<option value='$row_org->kode_org' ";
                            if($row->kode_org == $row_org->kode_org) echo "selected";
                            echo ">$row_org->nama_org</option>";
                          }
                        }
                      }
                    ?>
                  </select>
                </div>

                <div class="form-group" style="padding-bottom: 20px;">
                  <label for="Pangkat (Golongan/Ruang)">Pangkat (Golongan/Ruang)</label>
                  <select name="golongan" class="form-control" required>
                    <option value="" disabled <?php if($row->golongan == '') echo "selected" ?> > - Pilih Pangkat - </option>
                    <?php
                      $result_pangkat = mysqli_query($connect,"SELECT * FROM tbl_pangkat_golongan");
                      if($result_pangkat) {
                        if($result_pangkat->num_rows > 0) {
                          while($row_pangkat = $result_pangkat->fetch_object()) {
                            echo "<option value='$row_pangkat->golongan' ";
                              if($row->golongan == $row_pangkat->golongan) echo "selected";
                            echo ">$row_pangkat->pangkat ($row_pangkat->golongan)</option>";
                          }
                        }
                      }
                    ?>
                  </select>
                </div>

                <div class="form-group" style="padding-bottom: 20px;">
                  <label for="Username">Username</label>
                  <input type="text" name="username"  class="form-control" value="<?php echo $row->username ?>" required/>
                </div>

                <div class="form-group" style="padding-bottom: 20px;">
                  <label for="Password">Password</label>
                  <input type="password" name="password"  class="form-control" placeholder="Password" required/>
                </div>

                <div class="form-group" style="padding-bottom: 20px;">
                  <label for="Hak Akses">Hak Akses</label>
                  <select name="level" class="form-control" required>
                    <option value="" disabled <?php if($row->level == '') echo "selected" ?> > - Pilih Hak Akses - </option>
                    <option value="admin" <?php if ($row->level == 'admin') echo "selected" ?> >Admin</option>
                    <option value="user" <?php if ($row->level == 'user') echo "selected" ?> >User</option>
                  </select>
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
?>