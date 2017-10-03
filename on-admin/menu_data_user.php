<?php

require '_header.php';

?>

<div class="container">
  <h2>Data Users</h2>
  <p>User: <?php echo $_SESSION['nama']." (".$_SESSION['jabatan'].")" ?></p>
  <hr />
  <div class="form-group text-left">
    <a href="#" class="btn btn-primary glyphicon glyphicon-plus" title="Tambah User" data-target="#ModalAdd" data-toggle="modal"></a>      
  </div>
  <hr />

<table id="tabelUser" class="table table-bordered">
    <thead>
      <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Username</th>
        <th>Jabatan</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
<?php 
  //menampilkan data mysqli
  include "../koneksi.php";
  $no = 0;
  $result = mysqli_query($connect,"SELECT * FROM tbl_user");

  if($result) {
    if($result->num_rows > 0) {
      while ($row = $result->fetch_object()) {
        $no++;
?>
        <tr class="text-center">
          <td><?php echo "$no."; ?></td>
          <td class="text-left"><?php echo $row->nama; ?></td>
          <td><?php echo $row->username; ?></td>
          <td>
            <?php 
              $result_org = mysqli_query($connect,"SELECT nama_org FROM tbl_organisasi WHERE kode_org='$row->kode_org'");
              if($result_org->num_rows > 0) {
                $row_org = $result_org->fetch_object();
                echo $row->jabatan." ".$row_org->nama_org;
              }
            ?>  
          </td>
          <td>
            <a href='#' class='open_modal_detail btn btn-success glyphicon glyphicon-option-horizontal' title="Details" id='<?php echo $row->id; ?>'></a>
            <a href='#' class='open_modal_edit btn btn-success glyphicon glyphicon-pencil' title="Edit" id='<?php echo $row->id; ?>'></a>
            <a href='#' onclick="confirm_modal('proses_delete_user.php?&id=<?php echo  $row->id; ?>');" class="btn btn-danger glyphicon glyphicon-trash" title="Delete" ></a>
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
            <h4 class="modal-title" id="myModalLabel">Add User</h4>
        </div>

        <div class="modal-body">
          <form action="proses_save_user.php" name="modal_popup" enctype="multipart/form-data" method="POST">
            
                <div class="form-group" style="padding-bottom: 20px;">
                  <label for="Nama">Nama</label>
                  <input type="text" name="nama"  class="form-control" placeholder="Nama User" required />
                </div>

                <div class="form-group" style="padding-bottom: 20px;">
                  <label for="Jabatan">Jabatan</label>
                  <select name="jabatan" class="form-control" required>
                    <option value="" disabled selected=""> - Pilih Jabatan - </option>
                    <option value="Kepala">Kepala</option>
                    <option value="Staf">Staf</option>
                    <option value="Penanggungjawab Alat">Penanggungjawab Alat</option>
                    <option value="Operator Alat">Operator Alat</option>
                  </select>
                </div>

                <div class="form-group" style="padding-bottom: 20px;">
                  <label for="Unit Kerja">Unit Kerja</label>
                  <select name="kode_org" id="kode_org" class="form-control" required>
                    <option value="" disabled selected=""> - Pilih Unit Kerja - </option>
                    <?php
                      $result_org = mysqli_query($connect,"SELECT * FROM tbl_organisasi");
                      if($result_org) {
                        if($result_org->num_rows > 0) {
                          while($row_org = $result_org->fetch_object()) {
                            echo "<option value='$row_org->kode_org'>$row_org->nama_org</option>";
                          }
                        }
                      }
                    ?>
                  </select>
                </div>

                <div class="form-group" style="padding-bottom: 20px;">
                  <label for="Pangkat (Golongan/Ruang)">Pangkat (Golongan/Ruang)</label>
                  <select name="golongan" class="form-control" required>
                    <option value="" disabled selected> - Pilih Pangkat - </option>
                    <?php
                      $result_pangkat = mysqli_query($connect,"SELECT * FROM tbl_pangkat_golongan");
                      if($result_pangkat) {
                        if($result_pangkat->num_rows > 0) {
                          while($row_pangkat = $result_pangkat->fetch_object()) {
                            echo "<option value='$row_pangkat->golongan'>$row_pangkat->pangkat ($row_pangkat->golongan)</option>";
                          }
                        }
                      }
                    ?>
                  </select>
                </div>

                <div class="form-group" style="padding-bottom: 20px;">
                  <label for="Username">Username</label>
                  <input type="text" name="username"  class="form-control" placeholder="Username" required/>
                </div>

                <div class="form-group" style="padding-bottom: 20px;">
                  <label for="Password">Password</label>
                  <input type="password" name="password"  class="form-control" placeholder="Password" required/>
                </div>

                <div class="form-group" style="padding-bottom: 20px;">
                  <label for="Hak Akses">Hak Akses</label>
                  <select name="level" class="form-control" required>
                    <option value="" disabled selected=""> - Pilih Hak Akses - </option>
                    <option value="admin">Admin</option>
                    <option value="user">User</option>
                  </select>
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

<!-- Modal Popup untuk Details--> 
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
        <h4 class="modal-title" style="text-align:center;">Anda Yakin Ingin Menghapus User Ini?</h4>
      </div>
                
      <div class="modal-footer" style="margin:0px; border-top:0px; text-align:center;">
        <a href="#" class="btn btn-danger" id="delete_link">Ya</a>
        <button type="button" class="btn btn-success" data-dismiss="modal">Tidak</button>
      </div>
    </div>
  </div>
</div>

<!-- Javascript untuk dataTables -->
<script type="text/javascript">
  $(function() {
    $("#tabelUser").dataTable();
  });
</script>

<!-- Javascript untuk popup modal Detail--> 
<script type="text/javascript">
   $(document).ready(function () {
   $(".open_modal_detail").click(function(e) {
      var m = $(this).attr("id");
       $.ajax({
             url: "modal_detail_user.php",
             type: "GET",
             data : {id_user: m,},
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
             url: "modal_edit_user.php",
             type: "GET",
             data : {id_user: m,},
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