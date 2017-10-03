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
            <h4 class="modal-title" id="myModalLabel">Tracking Dokumen</h4>
        </div>

        <div class="modal-body">
            <div class="form-group" style="padding-bottom: 20px;">
              <label for="Judul Dokumen">Judul Dokumen</label>
              <input type="text" name="judul_dokumen" class="form-control" disabled value="<?php echo $row_dokumen->judul_dokumen; ?>" />
            </div>
            
            <div class="form-group" style="padding-bottom: 20px;">
              <table id="mytable" class="table table-bordered">
                <thead>
                  <th>Disiapkan Oleh</th>
                  <th>Tanggal</th>
                </thead>
                  
                  <?php
                    $result_autentikasi = mysqli_query($connect,"SELECT * FROM tbl_rek_autentikasi_dokumen WHERE no_dokumen='$row_dokumen->no_dokumen'");
                    if($result_autentikasi->num_rows > 0) {
                      $row_autentikasi = $result_autentikasi->fetch_object();
                      $result_user = mysqli_query($connect,"SELECT * FROM tbl_user WHERE id='$row_autentikasi->disiapkan_oleh'");
                      if($result_user->num_rows > 0) {
                        $row_user = $result_user->fetch_object();
                        $result_org = mysqli_query($connect,"SELECT * FROM tbl_organisasi WHERE kode_org='$row_user->kode_org'");
                        if($result_org->num_rows > 0) {
                          $row_org = $result_org->fetch_object();
                          $disiapkan_oleh = $row_user->nama." (".$row_user->jabatan." ".$row_org->nama_org.")";
                          $tanggal_disiapkan = $row_autentikasi->tanggal_disiapkan;
                          echo "<tr class='text-center'>";
                            echo "<td>$disiapkan_oleh</td>";
                            echo "<td>$tanggal_disiapkan</td>";
                          echo "</tr>";
                        }
                      }
                    } else {
                        echo "<tr>";
                          echo "<td colspan='2' class='text-center'>Data Tidak Tersedia</td>";
                        echo "</tr>";
                    }
                  ?>
                  </table>
                </div>

                <div class="form-group" style="padding-bottom: 20px;">
                  <table id="mytable" class="table  table-bordered">
                    <thead>
                      <th>Diperiksa Oleh</th>
                      <th>Tanggal</th>
                    </thead>
                      
                      <?php
                        $result_autentikasi = mysqli_query($connect,"SELECT * FROM tbl_rek_autentikasi_dokumen WHERE no_dokumen='$row_dokumen->no_dokumen'");
                        if($result_autentikasi->num_rows > 0) {
                          $row_autentikasi = $result_autentikasi->fetch_object();
                          $result_user = mysqli_query($connect,"SELECT * FROM tbl_user WHERE id='$row_autentikasi->diperiksa_oleh'");
                          if($result_user->num_rows > 0) {
                            $row_user = $result_user->fetch_object();
                            $result_org = mysqli_query($connect,"SELECT * FROM tbl_organisasi WHERE kode_org='$row_user->kode_org'");
                            if($result_org->num_rows > 0) {
                              $row_org = $result_org->fetch_object();
                              $diperiksa_oleh = $row_user->nama." (".$row_user->jabatan." ".$row_org->nama_org.")";
                              $tanggal_diperiksa = $row_autentikasi->tanggal_diperiksa;
                              echo "<tr class='text-center'>";
                                echo "<td>$diperiksa_oleh</td>";
                                echo "<td>$tanggal_diperiksa</td>";
                              echo "</tr>";
                            }
                          } else {
                            echo "<tr class='text-center'>";
                              echo "<td>Dokumen Belum Diperiksa</td>";
                              echo "<td>-</td>";
                            echo "</tr>";
                          }
                        } else {
                            echo "<tr>";
                              echo "<td colspan='2' class='text-center'>Data Tidak Tersedia</td>";
                            echo "</tr>";
                        }
                      ?>
                      </table>
                    </div>

                <div class="form-group" style="padding-bottom: 20px;">
                  <table id="mytable" class="table table-bordered">
                    <thead class="text-left">
                      <th>Disahkan Oleh</th>
                      <th>Tanggal</th>
                    </thead>
                      
                      <?php
                        $result_autentikasi = mysqli_query($connect,"SELECT * FROM tbl_rek_autentikasi_dokumen WHERE no_dokumen='$row_dokumen->no_dokumen'");
                        if($result_autentikasi->num_rows > 0) {
                          $row_autentikasi = $result_autentikasi->fetch_object();
                          $result_user = mysqli_query($connect,"SELECT * FROM tbl_user WHERE id='$row_autentikasi->disahkan_oleh'");
                          if($result_user->num_rows > 0) {
                            $row_user = $result_user->fetch_object();
                            $result_org = mysqli_query($connect,"SELECT * FROM tbl_organisasi WHERE kode_org='$row_user->kode_org'");
                            if($result_org->num_rows > 0) {
                              $row_org = $result_org->fetch_object();
                              $disahkan_oleh = $row_user->nama." (".$row_user->jabatan." ".$row_org->nama_org.")";
                              $tanggal_disahkan = $row_autentikasi->tanggal_disahkan;
                              echo "<tr class='text-center'>";
                                echo "<td>$disahkan_oleh</td>";
                                echo "<td>$tanggal_disahkan</td>";
                              echo "</tr>";
                            }
                          } else {
                            echo "<tr class='text-center'>";
                              echo "<td>Dokumen Belum Disahkan</td>";
                              echo "<td>-</td>";
                            echo "</tr>";
                          }
                        } else {
                            echo "<tr>";
                              echo "<td colspan='2' class='text-center'>Data Tidak Tersedia</td>";
                            echo "</tr>";
                        }
                      ?>
                      </table>
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