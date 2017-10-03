<?php
  session_start();
  include "../koneksi.php";
	$id = $_GET['id'];
?>

<div class="modal-dialog">
    <div class="modal-content">

        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title" id="myModalLabel">Change Password</h4>
        </div>

        <div class="modal-body">
          <form action="proses_change_password.php" name="modal_popup" enctype="multipart/form-data" method="POST">
          		  <input type="hidden" name="id" value="<?php echo $id; ?>" />

                <div class="form-group" style="padding-bottom: 20px;">
                  <label for="Password Lama">Password Lama</label>
                  <input type="password" name="password_lama"  class="form-control" placeholder="Password Lama Anda" required />
                </div>

                <div class="form-group" style="padding-bottom: 20px;">
                  <label for="Password Baru">Password Baru</label>
                  <input type="password" name="password_baru"  class="form-control" placeholder="Password Baru Anda" required />
                </div>

                <div class="modal-footer">
                  <button class="btn btn-success" type="submit">
                    Simpan
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
	$connect->close();
  exit();
?>