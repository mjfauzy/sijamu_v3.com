<?php

require '_header.php';

?>

<div class="container">
  <h2>Dokumen Masuk</h2>
  <p><b>User Log :</b> <?php echo $_SESSION['nama']." (".$_SESSION['jabatan'].")" ?></p>
  <hr />      

<table id="mytable" class="table table-bordered">
    <thead>
      <th>No.</th>
      <th>No. Dokumen</th>
      <th>Judul</th>
      <th>Aksi</th>
    </thead>
<?php 
  //menampilkan data mysqli
  include "../koneksi.php";
  $no = 0;
  $result_dokumen = mysqli_query($connect,"SELECT * FROM tbl_dokumen WHERE status NOT IN ('Tidak Berlaku','Telah Dihapus')");

  if($result_dokumen) {
    if($result_dokumen->num_rows > 0) {
      while ($row = $result_dokumen->fetch_object()) {
          $no++;
          $jabatan = $_SESSION['jabatan'];
          $result_jenis_dokumen = mysqli_query($connect,"SELECT * FROM tbl_jenis_dokumen WHERE disahkan_oleh='$jabatan'");
          if($result_jenis_dokumen) {
            if($result_jenis_dokumen->num_rows > 0) {
              while($row_jenis_dokumen = $result_jenis_dokumen->fetch_object()) {
                if($row_jenis_dokumen->keterangan != '') {
                  $jenis_dokumen = $row_jenis_dokumen->jenis_dokumen." ".$row_jenis_dokumen->keterangan;
                  if($jenis_dokumen == $row->kode_level) {
                    if($row->status == 'Telah Diperiksa') {
                      echo "<tr>";
                        echo "<td class='text-center'>$no.</td>";
                        echo "<td>$row->no_dokumen</td>";
                        echo "<td>$row->judul_dokumen</td>";
                        echo "<td class='text-center'>";
                          echo "<a href='#' class='open_modal_details btn btn-success glyphicon glyphicon-info-sign' id='$row->id' title='Details'></a> | ";
                          echo "<a href='../files/uploads/draf/$row->file' class='btn btn-success glyphicon glyphicon-file' title='View File'></a> | ";
                          echo "<a href='#' class='btn btn-primary glyphicon glyphicon-ok' title='Sahkan Dokumen' onclick='confirm_approve(\"proses_approve_dokumen.php?&id=$row->id\");'></a>";
                        echo "</td>";
                      echo "</tr>";
                    } elseif($row->status == 'Telah Disahkan' || $row->status == 'Telah Dipublikasi') {
                      echo "<tr>";
                        echo "<td class='text-center'>$no.</td>";
                        echo "<td>$row->no_dokumen</td>";
                        echo "<td>$row->judul_dokumen</td>";
                        echo "<td class='text-center'>";
                          echo "<a href='#' class='open_modal_details btn btn-success glyphicon glyphicon-info-sign' id='$row->id' title='Details'></a> | ";
                          echo "<a href='../files/uploads/draf/$row->file' class='btn btn-success glyphicon glyphicon-file' title='View File'></a> | ";
                          echo "Telah Disahkan";
                        echo "</td>";
                      echo "</tr>";
                    }
                  }
                }
              }
            } else {
              echo "<tr class='text-center'><td colspan='4'>Tidak Ada Dokumen Baru yang Masuk</td></tr>";
            }
          }
      }
    } else {
      echo "<tr>";
        echo "<td colspan='4' class='text-center'>Data Tidak Tersedia</td>";
        echo "</tr>";
    }
  }
?>

</table>
</div>

<!-- Modal Popup untuk Detail--> 
<div id="ModalDetail" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

</div>

<!-- Modal Popup untuk approve--> 
<div class="modal fade" id="ModalApprove">
  <div class="modal-dialog">
    <div class="modal-content" style="margin-top:100px;">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" style="text-align:center;">Anda Yakin Ingin Mengesahkan Dokumen Ini?</h4>
      </div>
                
      <div class="modal-footer" style="margin:0px; border-top:0px; text-align:center;">
        <a href="#" class="btn btn-success" id="approve_link">Ya</a>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Tidak</button>
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

<!-- Javascript untuk popup modal Approve--> 
<script type="text/javascript">
    function confirm_approve(approve_url)
    {
      $('#ModalApprove').modal('show', {backdrop: 'static'});
      document.getElementById('approve_link').setAttribute('href' , approve_url);
    }
</script>

<?php

$connect->close();
require '_footer.php';

?>