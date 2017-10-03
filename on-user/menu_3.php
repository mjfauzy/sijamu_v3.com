<?php

require '_header.php';
$id_user = $_SESSION['id'];
$nama_org = $_SESSION['nama_org'];
$eselon = $_SESSION['eselon'];

?>

<div class="container">
  <h2>Dokumen Terkendali</h2>
  <p><b>User Log :</b> <?php echo $_SESSION['nama']." (".$_SESSION['jabatan'].")" ?></p>
  <hr />

<table id="tabelDokumen" class="table table-bordered">
    <thead>
      <tr>
        <th>No.</th>
        <th>No. Dokumen</th>
        <th>Judul</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
<?php 
  //menampilkan data mysqli
  include "../koneksi.php";
  $no = 0;
  $result_org = mysqli_query($connect,"SELECT * FROM tbl_organisasi WHERE nama_org='$nama_org'");
  if($result_org) {
    $row_org = $result_org->fetch_object();
    $kode_org = $row_org->kode_org;
  }

  $result_dokumen = mysqli_query($connect,"SELECT * FROM tbl_rek_file_distribusi WHERE kode_org='$kode_org' AND file NOT IN ('')");

  if($result_dokumen) {
    if($result_dokumen->num_rows > 0) {
      while ($row_dokumen = $result_dokumen->fetch_object()) {
          $no++;
          $load_dokumen = mysqli_query($connect,"SELECT no_dokumen,judul_dokumen FROM tbl_dokumen WHERE id='$row_dokumen->id_dokumen' AND status='Telah Didistribusi'");
          if($load_dokumen) {
            if($load_dokumen->num_rows > 0) {
              while($row_load = $load_dokumen->fetch_object()) {
?>

                <tr>
                  <td><?php echo "$no."; ?></td>
                  <td><?php echo $row_load->no_dokumen; ?></td>
                  <td><?php echo $row_load->judul_dokumen; ?></td>
                  <td class="text-center">
                    <a href="#" class="open_modal_detail btn btn-success glyphicon glyphicon-option-horizontal" title="View Details" id="<?php echo $row_dokumen->id_dokumen; ?>"></a>
                    <?php
                      if($nama_org == "Unit Jaminan Mutu") {
                        echo "<a href='../files/uploads/terkendali/master/".$row_dokumen->file."' class='btn btn-success glyphicon glyphicon-file' title='View Document' target='_blank'></a>";
                      } else {
                        echo "<a href='../files/uploads/terkendali/copy/".$row_dokumen->file."' class='btn btn-success glyphicon glyphicon-file' title='View Document' target='_blank'></a>";
                      }
                    ?>
                  </td>
                </tr>
<?php
              }
            } 
          }          
      }
    } else {
      $result_dokumen = mysqli_query($connect,"SELECT * FROM tbl_rek_file_distribusi WHERE kode_org='SBM.5' AND file NOT IN ('')");
      if($result_dokumen) {
        if($result_dokumen->num_rows > 0) {
          while ($row_dokumen = $result_dokumen->fetch_object()) {
            $no++;
            $load_dokumen = mysqli_query($connect,"SELECT no_dokumen,judul_dokumen FROM tbl_dokumen WHERE id='$row_dokumen->id_dokumen' AND status='Telah Didistribusi'");
            if($load_dokumen) {
              if($load_dokumen->num_rows > 0) {
                while($row_load = $load_dokumen->fetch_object()) {
?>

                  <tr>
                    <td><?php echo "$no."; ?></td>
                    <td><?php echo $row_load->no_dokumen; ?></td>
                    <td><?php echo $row_load->judul_dokumen; ?></td>
                    <td class="text-center">
                      <a href="#" class="open_modal_detail btn btn-success glyphicon glyphicon-option-horizontal" title="View Details" id="<?php echo $row_dokumen->id_dokumen; ?>"></a>
                      <?php
                        echo "<a href='../files/uploads/terkendali/master/".$row_dokumen->file."' class='btn btn-success glyphicon glyphicon-file' title='View Document' target='_blank'></a>";
                      ?>
                    </td>
                  </tr>
<?php
                }
              }
            }          
          }
        }
      }
    }
  }
?>
  </tbody>
</table>
</div>

<!-- Modal Popup untuk Details--> 
<div id="ModalDetail" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

</div>

<!-- Javascript untuk dataTables -->
<script type="text/javascript">
  $(function() {
    $("#tabelDokumen").dataTable();
  });
</script>

<!-- Javascript untuk popup modal Details--> 
<script type="text/javascript">
   $(document).ready(function () {
   $(".open_modal_detail").click(function(e) {
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

<?php

$connect->close();
require '_footer.php';

?>