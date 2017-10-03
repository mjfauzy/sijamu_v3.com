<?php
  
  session_start();
  include "../koneksi.php";
	$id = $_GET['id'];
	$result_dokumen = mysqli_query($connect, "SELECT * FROM tbl_dokumen WHERE id='$id'");

	if ($result_dokumen) {
		if ($result_dokumen->num_rows > 0) {
			while ($row_dokumen = $result_dokumen->fetch_object()) {
?>

<div class="modal-dialog modal-lg">
    <div class="modal-content">

        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title" id="myModalLabel">Daftar Distribusi Dokumen</h4>
        </div>

        <div class="modal-body">
          <form action="proses_distribusi.php" name="modal_popup" enctype="multipart/form-data" method="POST">
          		  <input type="hidden" name="id" value="<?php echo $row_dokumen->id; ?>" />

                <div class="form-group">
                  <label for="Judul Dokumen">Judul Dokumen</label>
                  <input type="text" name="judul_dokumen" class="form-control" disabled value="<?php echo $row_dokumen->judul_dokumen; ?>" />
                </div>

                <div class="form-group" style="padding-bottom: 10px">
                  <a href="../files/uploads/disahkan/<?php echo $row_dokumen->file; ?>" class="btn btn-success glyphicon glyphicon-download-alt"> Download</a>
                </div>
            
                <div class="form-group" style="padding-bottom: 20px;">
                  <table id="mytable" class="table">
                    <thead>
                      <th>No.</th>
                      <th>Jabatan</th>
                      <th>Salinan</th>
                      <th>File</th>
                      <th>Upload File</th>
                    </thead>
                  <?php 
                    //menampilkan data mysqli
                    include "../koneksi.php";
                    $no = 0;
                    $result_org = mysqli_query($connect,"SELECT * FROM tbl_organisasi");

                    if($result_org) {
                      if($result_org->num_rows > 0) {
                        while ($row_org = $result_org->fetch_object()) {
                            $no++;
                            $salinan_tmp = "Copy ".$no;
                            if($salinan_tmp == $row_org->kode_salinan) {
                              echo "<tr class='text-center'>";
                                echo "<td>$no.</td>";
                                echo "<td class='text-left'>Kepala $row_org->nama_org</td>";
                                echo "<td>$row_org->kode_salinan</td>";
                                echo "<td>";
                                  $result_file_distribusi = mysqli_query($connect,"SELECT * FROM tbl_rek_file_distribusi");
                                  if($result_file_distribusi) {
                                    if($result_file_distribusi->num_rows > 0) {
                                      while($row_file = $result_file_distribusi->fetch_object()) {
                                        if($row_dokumen->id == $row_file->id_dokumen && $row_org->kode_org == $row_file->kode_org) {
                                          if($row_file->file == '') {
                                            echo "-";
                                          } else {
                                            echo "<a href='../files/uploads/terkendali/copy/$row_file->file' class='btn btn-primary'>File Tersedia</a>";
                                          }
                                        }
                                      }
                                    } else {
                                      echo "-";
                                    }
                                  }
                                echo "</td>";
                                echo "<td>";
                                  echo "<input type='hidden' name='kode_org[]' value='$row_org->kode_org' />";
                                  echo "<input type='hidden' name='kode_salinan[]' value='$row_org->kode_salinan' />";
                                  echo "<input type='file' name='file_upload[]' />";
                                echo "</td>";
                              echo "</tr>";
                            } else {
                              echo "<tr class='text-center'>";
                                echo "<td>$no.</td>";
                                echo "<td class='text-left'>Kepala $row_org->nama_org</td>";
                                echo "<td>$row_org->kode_salinan</td>";
                                echo "<td>";
                                  $result_file_distribusi = mysqli_query($connect,"SELECT * FROM tbl_rek_file_distribusi");
                                  if($result_file_distribusi) {
                                    if($result_file_distribusi->num_rows > 0) {
                                      while($row_file = $result_file_distribusi->fetch_object()) {
                                        if($row_dokumen->id == $row_file->id_dokumen && $row_org->kode_org == $row_file->kode_org) {
                                          if($row_file->file == '') {
                                            echo "-";
                                          } else {
                                            echo "<a href='../files/uploads/terkendali/master/$row_file->file' class='btn btn-primary'>File Tersedia</a>";
                                          }
                                        }
                                      }
                                    } else {
                                      echo "-";
                                    }
                                  }
                                echo "</td>";
                                echo "<td>";
                                  echo "<input type='hidden' name='kode_org[]' value='$row_org->kode_org' />";
                                  echo "<input type='hidden' name='kode_salinan[]' value='$row_org->kode_salinan' />";
                                  echo "<input type='file' name='file_upload[]' />";
                                echo "</td>";
                              echo "</tr>";
                            }
                        }
                      } else {
                        echo "<tr>";
                          echo "<td colspan='5' class='text-center'>Data Tidak Tersedia</td>";
                        echo "</tr>";
                      }
                    }
                  ?>

                  </table>
                </div>

              <div class="modal-footer">
                <button class="btn btn-success" type="submit">
                  Kirim
                </button>                
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