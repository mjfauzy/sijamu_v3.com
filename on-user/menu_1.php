<?php

require '_header.php';
$id_user = $_SESSION['id'];
$nama_org = $_SESSION['nama_org'];

?>

<div class="container">
  <h2>Data Dokumen</h2>
  <p><b>User Log :</b> <?php echo $_SESSION['nama']." (".$_SESSION['jabatan'].")" ?></p>
  <hr />
  <p>
    <a href="#" class="btn btn-primary glyphicon glyphicon-plus" data-target="#ModalAdd" data-toggle="modal" title="Tambah Dokumen Baru"></a>
  </p>      
  <hr />

<table id="tabelDokumen" class="table table-bordered">
    <thead>
      <tr>
        <th>No.</th>
        <th>No. Dokumen</th>
        <th>Judul</th>
        <th>Tahun Prioritas</th>
        <th>Aksi</th>
        <th>Status Dokumen</th>
      </tr>
    </thead>
    <tbody>
<?php 
  include "../koneksi.php";
  $no = 0;
  $result_dokumen = mysqli_query($connect,"SELECT * FROM tbl_dokumen WHERE status NOT IN ('Tidak Berlaku','Telah Dihapus') AND id_user='$id_user'");

  if($result_dokumen) {
    if($result_dokumen->num_rows > 0) {
      while ($row_dokumen = $result_dokumen->fetch_object()) {
          $no++;
?>
          <tr class="text-center">
            <td><?php echo "$no."; ?></td>
            <td class="text-left"><?php echo $row_dokumen->no_dokumen; ?></td>
            <td class="text-left"><?php echo $row_dokumen->judul_dokumen; ?></td>
            <td><?php echo $row_dokumen->tahun_prioritas; ?></td>
            <td>
              <a href='#' class="open_modal_details btn btn-success glyphicon glyphicon-option-horizontal" id='<?php echo $row_dokumen->id; ?>' title="View Details"></a> 
              <?php
                $status = $row_dokumen->status;
                if($status == 'Draf' || $status == 'Telah Diperiksa') {
                  echo "<a href='../files/uploads/draf/$row_dokumen->file' class=\"btn btn-success glyphicon glyphicon-file\" title='Open File'></a> ";
                  echo "<a href='#' class=\"open_modal_edit btn btn-success glyphicon glyphicon-pencil\" id='$row_dokumen->id' title='Edit Data'></a> ";
                  echo "<a href='#' onclick=\"confirm_delete('proses_delete_dokumen.php?&id=<?php echo  $row_dokumen->id; ?>');\" class='btn btn-danger glyphicon glyphicon-trash' title='Delete'></a> ";
                } elseif($status == 'Telah Disahkan') {
                  echo "<a href='../files/uploads/disahkan/$row_dokumen->file' class=\"btn btn-success glyphicon glyphicon-file\" title='Open File'></a> ";
                }
              ?>
            </td>
            <td>
              <?php 
                echo $status." | <a href='#' class='open_modal_tracking btn btn-primary' id='".$row_dokumen->id."' title='Show Document Tracking'>Tracking</a>";
              ?>
            </td>
          </tr>
<?php
      }
    }
  }
?>
  </tbody>
</table>
</div>

<!-- Modal Popup untuk Add--> 
<div id="ModalAdd" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">

        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title" id="myModalLabel">Tambah Dokumen Baru</h4>
        </div>

        <div class="modal-body">
          <form action="proses_save_dokumen.php" name="modal_popup" enctype="multipart/form-data" method="POST">
            
                <div class="form-group" style="padding-bottom: 20px;">
                  <label for="Tanggal Upload">Tanggal Upload</label>
                  <input type="text" name="tanggal_upload"  class="form-control" value="<?php echo date('d-m-Y'); ?>" required />
                </div>

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
                   <input type="text" name="no_dokumen"  class="form-control" placeholder="Nomor Dokumen" required />
                </div>

                <div class="form-group" style="padding-bottom: 20px;">
                  <label for="Judul Dokumen">Judul Dokumen</label>
                  <input type="text" name="judul_dokumen"  class="form-control" placeholder="Judul Dokumen" required/>
                </div>

                <div class="form-group" style="padding-bottom: 20px;">
                  <label for="Keterangan Output">Keterangan Output</label>
                  <textarea name="keterangan_output" class="form-control" required></textarea>
                </div>

                <div class="form-group" style="padding-bottom: 20px;">
                  <label for="Tahun Prioritas">Tahun Prioritas</label>
                  <select name="tahun_prioritas" class="form-control" required>
                    <option value="" disabled selected> - Pilih Tahun - </option>
                    <?php
                      for($i=2000;$i<=date('Y');$i++) {
                        echo "<option value='$i'>$i</option>";
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
                  <label for="File">File</label>
                  <input type="file" name="file_upload" required />
                </div>

              <div class="modal-footer">
                <button class="btn btn-success" type="submit" title="Simpan Dokumen">Simpan</button>                
                <button type="reset" class="btn btn-danger"  data-dismiss="modal" aria-hidden="true">Tutup</button>
              </div>
              </form>

            </div>
        </div>
    </div>
</div>

<!-- Modal Popup untuk Tracking--> 
<div id="ModalTracking" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

</div>

<!-- Modal Popup untuk Detail--> 
<div id="ModalDetail" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

</div>

<!-- Modal Popup untuk Edit--> 
<div id="ModalEdit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

</div>

<!-- Modal Popup untuk delete--> 
<div class="modal fade" id="ModalDelete">
  <div class="modal-dialog">
    <div class="modal-content" style="margin-top:100px;">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" style="text-align:center;">Anda Yakin Ingin Menghapus Dokumen Ini?</h4>
      </div>
                
      <div class="modal-footer" style="margin:0px; border-top:0px; text-align:center;">
        <a href="#" class="btn btn-primary" id="delete_link">Ya</a>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Tidak</button>
      </div>
    </div>
  </div>
</div>

<!-- Javascript untuk dataTables -->
<script type="text/javascript">
  $(function() {
    $("#tabelDokumen").dataTable();
  });
</script>

<!-- Javascript untuk popup modal Tracking--> 
<script type="text/javascript">
   $(document).ready(function () {
   $(".open_modal_tracking").click(function(e) {
      var m = $(this).attr("id");
       $.ajax({
             url: "modal_tracking.php",
             type: "GET",
             data : {id: m,},
             success: function (ajaxData){
               $("#ModalTracking").html(ajaxData);
               $("#ModalTracking").modal('show',{backdrop: 'true'});
             }
           });
        });
      });
</script>

<!-- Javascript untuk popup modal Details--> 
<script type="text/javascript">
   $(document).ready(function () {
   $(".open_modal_details").click(function(e) {
      var m = $(this).attr("id");
       $.ajax({
             url: "modal_detail_dokumen.php",
             type: "GET",
             data : {id: m,},
             success: function (ajaxData){
               $("#ModalDetail").html(ajaxData);
               $("#ModalDetail").modal('show',{backdrop: 'true'});
             }
           });
        });
      });
</script>

<!-- Javascript untuk popup modal Edit--> 
<script type="text/javascript">
   $(document).ready(function () {
   $(".open_modal_edit").click(function(e) {
      var m = $(this).attr("id");
       $.ajax({
             url: "modal_edit_dokumen.php",
             type: "GET",
             data : {id: m,},
             success: function (ajaxData){
               $("#ModalEdit").html(ajaxData);
               $("#ModalEdit").modal('show',{backdrop: 'true'});
             }
           });
        });
      });
</script>

<!-- Javascript untuk popup modal Delete--> 
<script type="text/javascript">
    function confirm_delete(delete_url)
    {
      $('#ModalDelete').modal('show', {backdrop: 'static'});
      document.getElementById('delete_link').setAttribute('href' , delete_url);
    }
</script>

<?php

$connect->close();
require '_footer.php';

?>