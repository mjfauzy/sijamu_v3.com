<?php
session_start();
require 'koneksi.php';

if (isset($_POST['username'])) { // check apakah ada pengiriman data
    $username = $_POST['username'];
    $password = md5($_POST['password']);
 
 
    $sql = "SELECT * FROM tbl_user WHERE username = '$username' AND password = '$password'";
 
    $query = mysqli_query($connect,$sql);
 
    if ($query->num_rows > 0) {
        $row = $query->fetch_assoc();
        $id = $row['id'];
        $kode_org = $row['kode_org'];
        $result_org = mysqli_query($connect,"SELECT nama_org FROM tbl_organisasi WHERE kode_org='$kode_org'");
        if($result_org->num_rows > 0) {
            $row_org = $result_org->fetch_object();
            $nama_org = $row_org->nama_org;
        }
        $_SESSION['id'] = $id;
        $_SESSION['nama'] = $row['nama'];
        $_SESSION['jabatan'] = $row['jabatan']." ".$nama_org;
        $_SESSION['nama_org'] = $nama_org;
        $_SESSION['username'] = $row['username'];
        $_SESSION['eselon'] = $row['eselon'];
        $_SESSION['level'] = $row['level'];

        $date = date('d-m-Y, H:i:s');

        $save_last_login = mysqli_query($connect,"UPDATE tbl_user SET last_login='$date' WHERE username='$username' AND id='$id'");

        if($_SESSION['level'] == 'admin') {
            echo "<meta http-equiv='refresh' content='0; url=on-admin'>";
        } elseif($_SESSION['level'] == 'user') {
            echo "<meta http-equiv='refresh' content='0; url=on-user'>";
        } else {
            echo "<script>window.location.href='index.php'</script>";
        }
 
    } else {
        echo "<script>alert('Username & Password Salah'); window.location.href='index.php'</script>";
    }
    $connect->close();
    exit();
}

?>