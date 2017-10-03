<?php

require '_header.php';
$id_user = $_SESSION['id'];
$nama_org = $_SESSION['nama_org'];
$eselon = $_SESSION['eselon'];

?>

<div class="container">
  <h2>Usulan Dokumen</h2>
  <p><b>User Log :</b> <?php echo $_SESSION['nama']." (".$_SESSION['jabatan'].")" ?></p>
  <hr />

<table id="tabelDokumen" class="table table-bordered">
    <thead>
      <tr>
        <th>No.</th>
        <th>No. Dokumen</th>
        <th>Judul</th>
        <th>Buat Usulan</th>
      </tr>
    </thead>
    <tbody>
<?php 
  //menampilkan data mysqli
  include "../koneksi.php";
  $no = 0;
  $result_dokumen = mysqli_query($connect,"SELECT DISTINCT id_dokumen FROM tbl_rek_file_distribusi");

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
                    <a href="#" class="open_modal_amandemen btn btn-primary" id="<?php echo $row_dokumen->id_dokumen; ?>">Amandemen</a> 
                    <a href="#" class="open_modal_pemusnahan btn btn-danger" id="<?php echo $row_dokumen->id_dokumen; ?>">Pemusnahan</a>
                  </td>
                </tr>
<?php
              }
            } else {
              break;
            }
          }          
      }
    }
  }
?>
  </tbody>
</table>

<hr />
<h2>Usulan Masuk</h2>
<hr />

<table id="tabelUsulanMasuk" class="table table-bordered">
    <thead>
      <tr>
        <th>No.</th>
        <th>No. Dokumen</th>
        <th>Judul Dokumen</th>
        <th>Jenis Usulan</th>
        <th>Catatan</th>
        <th>Pembuat Usulan</th>
        <th>Tanggal</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
<?php 
  $no = 0;
  $result_usulan = mysqli_query($connect,"SELECT * FROM tbl_rek_usulan");

  if($result_usulan) {
    if($result_usulan->num_rows > 0) {
      while ($row_usulan = $result_usulan->fetch_object()) {
          $no++;
          $load_dokumen = mysqli_query($connect,"SELECT no_dokumen,judul_dokumen FROM tbl_dokumen WHERE id='$row_usulan->id_dokumen'");
          if($load_dokumen) {
            if($load_dokumen->num_rows > 0) {
              while($row_load = $load_dokumen->fetch_object()) {
?>

                <tr>
                  <td><?php echo "$no."; ?></td>
                  <td><?php echo $row_load->no_dokumen; ?></td>
                  <td><?php echo $row_load->judul_dokumen; ?></td>
                  <td><?php echo $row_usulan->jenis_usulan; ?></td>
                  <td><?php echo $row_usulan->catatan; ?></td>
                  <td>
                    <?php
                      $result_user = mysqli_query($connect,"SELECT nama FROM tbl_user WHERE id='$row_usulan->pembuat_usulan'");
                      if($result_user) {
                        if($result_user->num_rows > 0) {
                          $row_user = $result_user->fetch_object();
                          echo "$row_user->nama";
                        }
                      }
                    ?>
                  </td>
                  <td><?php echo $row_usulan->tanggal_upload; ?></td>
                  <td class="text-center">
                    <a href='#' onclick="confirm_delete('proses_delete_usulan.php?&id=<?php echo $row_usulan->id_usulan; ?>');" class='btn btn-danger glyphicon glyphicon-trash' title='Delete'></a> 
                  </td>
                </tr>
<?php
              }
            } else {
              break;
            }
          }          
      }
    }
  }
?>
  </tbody>
</table>
</div>

<!-- Modal Popup untuk Amandemen--> 
<div id="ModalAmandemen" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

</div>

<!-- Modal Popup untuk Pemusnahan--> 
<div id="ModalPemusnahan" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

</div>

<!-- Modal Popup untuk delete--> 
<div class="modal fade" id="ModalDelete">
  <div class="modal-dialog">
    <div class="modal-content" style="margin-top:100px;">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" style="text-align:center;">Anda Yakin Ingin Menghapus Usulan Ini?</h4>
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

  $(function() {
    $("#tabelUsulanMasuk").dataTable();
  });
</script>

<!-- Javascript untuk popup modal Amandemen--> 
<script type="text/javascript">
   $(document).ready(function () {
   $(".open_modal_amandemen").click(function(e) {
      var m = $(this).attr("id");
       $.ajax({
             url: "modal_amandemen_dokumen.php",
             type: "GET",
             data : {id: m,},
             success: function (ajaxData){
               $("#ModalAmandemen").html(ajaxData);
               $("#ModalAmandemen").modal('show',{backdrop: 'true'});
             }
           });
        });
      });
</script>

<!-- Javascript untuk popup modal Pemushanan--> 
<script type="text/javascript">
   $(document).ready(function () {
   $(".open_modal_pemusnahan").click(function(e) {
      var m = $(this).attr("id");
       $.ajax({
             url: "modal_pemusnahan_dokumen.php",
             type: "GET",
             data : {id: m,},
             success: function (ajaxData){
               $("#ModalPemusnahan").html(ajaxData);
               $("#ModalPemusnahan").modal('show',{backdrop: 'true'});
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