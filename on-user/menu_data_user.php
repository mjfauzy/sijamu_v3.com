<?php

require '_header.php';
$id_user = $_SESSION['id'];
$nama_org = $_SESSION['nama_org'];
$eselon = $_SESSION['eselon'];

?>

<div class="container">
  <h2>Data User</h2>
  <p><b>User Log :</b> <?php echo $_SESSION['nama']." (".$_SESSION['jabatan'].")" ?></p>
  <hr />

<table id="mytable" class="table">
<?php 
  //menampilkan data mysqli
  include "../koneksi.php";
  $no = 0;
  $result_user = mysqli_query($connect,"SELECT * FROM tbl_user WHERE id='$id_user'");
  if($result_user) {
    $row_user = $result_user->fetch_object();
?>

    <tr>
      <td><b>Nama</b></td>
      <td>:</td>
      <td><?php echo $row_user->nama; ?></td>
    </tr>
    <tr>
      <td><b>Username / NIP</b></td>
      <td>:</td>
      <td><?php echo $row_user->username; ?></td>
    </tr>
    <tr>
      <td><b>Jabatan</b></td>
      <td>:</td>
      <td><?php echo $jabatan; ?></td>
    </tr>
    <tr>
      <td><b>Golongan</b></td>
      <td>:</td>
      <td><?php echo $row_user->golongan; ?></td>
    </tr>
    <tr>
      <td><b>Organisasi</b></td>
      <td>:</td>
      <td>
        <?php
          $result_org = mysqli_query($connect,"SELECT nama_org FROM tbl_organisasi WHERE kode_org='$row_user->kode_org'");
          if($result_org) {
            if($result_org->num_rows > 0) {
              $row_org = $result_org->fetch_object();
              echo "$row_org->nama_org";
            }
          }
        ?>
      </td>
    </tr>
    <tr>
      <td colspan="3" class="text-right"><a href="#" class="open_modal_change_password btn btn-primary" id="<?php echo $row_user->id; ?>">Change Password</a>
    </tr>

</table>
</div>

<!-- Modal Popup untuk Change Password--> 
<div id="ModalChangePassword" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

</div>  

<!-- Javascript untuk popup modal Change Password--> 
<script type="text/javascript">
   $(document).ready(function () {
   $(".open_modal_change_password").click(function(e) {
      var m = $(this).attr("id");
       $.ajax({
             url: "modal_change_password.php",
             type: "GET",
             data : {id: m,},
             success: function (ajaxData){
               $("#ModalChangePassword").html(ajaxData);
               $("#ModalChangePassword").modal('show',{backdrop: 'true'});
             }
           });
        });
      });
</script>

<?php
  
  }

$connect->close();
require '_footer.php';

?>