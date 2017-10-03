<?php

require '_header.php';

?>

<div class="container">
  <h2>Tracking Dokumen SOP</h2>
  <p>User: <?php echo $_SESSION['namaLog']." (".$_SESSION['id'].")" ?></p>
  <hr />
  <p><a href="#" class="btn btn-success" data-target="#ModalAdd" data-toggle="modal">Add Dokumen</a></p>      

<table id="mytable" class="table table-bordered">
    <thead>
      <th>No</th>
      <th>Kode Dokumen</th>
      <th>Judul</th>
      <th>Keterangan</th>
      <th>Status</th>
      <th>Tanggal</th>
      <th>Aksi</th>
    </thead>
<?php 
  //menampilkan data mysqli
  include "../koneksi.php";
  $no = 0;
  $result_riwayat = mysqli_query($connect,"SELECT * FROM tbl_riwayat");

  if($result_riwayat) {
    if($result_riwayat->num_rows > 0) {
      while ($row = $result_riwayat->fetch_object()) {
        $no++;
?>
        <tr>
          <td><?php echo "$no."; ?></td>
          <td><?php echo $row->kode_dokumen; ?></td>
          <?php
            $result_dokumen = mysqli_query($connect,"SELECT judul_dokumen FROM tbl_dokumen WHERE kode_dokumen='$row->kode_dokumen'");
            if($result_dokumen) {
              if($result_dokumen->num_rows > 0) {
                while($row_dokumen = $result_dokumen->fetch_object()) {
                  echo "<td>$row_dokumen->judul_dokumen</td>";
                }
              }
            }
          ?>
          <td><?php echo $row->keterangan; ?></td>
          <td><?php echo $row->status; ?></td>
          <td><?php echo $row->tanggal; ?></td>
          <td>
            <a href='#' class='open_modal_details' id='<?php echo $row->kode_dokumen; ?>'><img src='../images/more_details.png' alt='detail' title='More Details' class='button-action hover-shadow' /></a> 
            <a href='uploads/<?php echo $row->file; ?>' target="_blank" ><img src='../images/view_file.png' alt='view' title='View File' class='button-action hover-shadow' /></a> 
            <a href='#' class='open_modal_edit' id='<?php echo $row->kode_dokumen; ?>'><img src='../images/edit.png' alt='edit' title='Edit' class='button-action hover-shadow' /></a> 
            <a href='#' onclick="confirm_modal('proses_delete.php?&kode_dokumen=<?php echo  $row->kode_dokumen; ?>');" ><img src='../images/delete.png' alt='delete' title='Delete' class='button-action hover-shadow' /></a>
          </td>
        </tr>
<?php
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

<!-- Modal Popup untuk Add--> 
<div id="ModalAdd" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">

        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title" id="myModalLabel">Add Dokumen SOP</h4>
        </div>

        <div class="modal-body">
          <form action="proses_save.php" name="modal_popup" enctype="multipart/form-data" method="POST">
            
                <div class="form-group" style="padding-bottom: 20px;">
                  <label for="Tanggal Upload">Tanggal Upload</label>
                  <input type="text" name="tanggal_upload"  class="form-control" value="<?php echo date('d-m-Y'); ?>" required />
                </div>

                <div class="form-group" style="padding-bottom: 20px;">
                  <label for="Kode Dokumen">Kode Dokumen</label>
                   <input type="text" name="kode_dokumen"  class="form-control" placeholder="Kode Dokumen" required />
                </div>

                <div class="form-group" style="padding-bottom: 20px;">
                  <label for="Judul Dokumen">Judul Dokumen</label>
                  <input type="text" name="judul_dokumen"  class="form-control" placeholder="Judul Dokumen" required/>
                </div>

                <div class="form-group" style="padding-bottom: 20px;">
                  <label for="Unit Kerja">Unit Kerja</label>
                  <select name="unit_kerja" class="form-control" required>
                    <option value="" disabled selected> - Pilih Unit Kerja - </option>
                    <option value="PSTBM">PSTBM</option>
                    <option value="UJM">UJM</option>
                    <option value="BKKK">BKKK</option>
                  </select>
                </div>

                <div class="form-group" style="padding-bottom: 20px;">
                  <label for="Kategori">Kategori</label>
                  <select name="kategori" class="form-control" required>
                    <option value="" disabled selected> - Pilih Kategori - </option>
                    <option value="Administratif">Administratif</option>
                    <option value="Teknis">Teknis</option>
                  </select>
                </div>

                <div class="form-group" style="padding-bottom: 20px;">
                  <label for="File">File</label>
                  <input type="file" name="file_upload" required />
                </div>

              <div class="modal-footer">
                <button class="btn btn-success" type="submit">
                  Simpan
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
        <a href="#" class="btn btn-danger" id="delete_link">Ya</a>
        <button type="button" class="btn btn-success" data-dismiss="modal">Tidak</button>
      </div>
    </div>
  </div>
</div>

<!-- Javascript untuk popup modal Details--> 
<script type="text/javascript">
   $(document).ready(function () {
   $(".open_modal_details").click(function(e) {
      var m = $(this).attr("id");
       $.ajax({
             url: "menu_detail_dokumen.php",
             type: "GET",
             data : {kode_dokumen: m,},
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
             url: "menu_edit_dokumen.php",
             type: "GET",
             data : {kode_dokumen: m,},
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
    function confirm_modal(delete_url)
    {
      $('#ModalDelete').modal('show', {backdrop: 'static'});
      document.getElementById('delete_link').setAttribute('href' , delete_url);
    }
</script>

<?php

$connect->close();
require '_footer.php';

?>