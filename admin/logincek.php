<?php
session_start();
include '../connection.php';

$username = $_POST['username'];
$password = $_POST['password'];

$query = mysqli_query($conn, "select * from user where username='$username' and password='$password'" );
$cek = mysqli_num_rows($query);

if($cek > 0){
    $login = mysqli_fetch_assoc($query);

    $id = $login['id_user'];

    $_SESSION['id']=$login['id_user'];

    if ($login['id_role'] == 1) {
        // bk
        $_SESSION['username'] = $username;
        $_SESSION['password'] = $password;
        $_SESSION['id_role'] = 1;
        $_SESSION['status'] = "login";
        header("location:../bk/dashboard_bk.php?id=$id");
    }elseif ($login['id_role'] == 2) {
        // wali kelas
        $_SESSION['username'] = $username;
        $_SESSION['password'] = $password;
        $_SESSION['id_role'] = 2;
        $_SESSION['status'] = "login";
        header("location:dashboard_wk.php?id=$id");
    }elseif ($login['id_role'] == 3) {
        // kurikulum
        $_SESSION['username'] = $username;
        $_SESSION['password'] = $password;
        $_SESSION['id_role'] = 3;
        $_SESSION['status'] = "login";
        header("location:..//kurikulum/dashboard_kurikulum.php?id=$id");
    }elseif ($login['id_role'] == 4) {
        // kesiswaan
        $_SESSION['username'] = $username;
        $_SESSION['password'] = $password;
        $_SESSION['id_role'] = 4;
        $_SESSION['status'] = "login";
        header("location:../kesiswaan/dashboard_kesiswaan.php?id=$id");
    }elseif ($login['id_role'] == 5) {
        // siswa
        $_SESSION['username'] = $username;
        $_SESSION['password'] = $password;
        $_SESSION['id_role'] = 5;
        $_SESSION['status'] = "login";
        header("location:dashboard_siswa.php?id=$id");
    }elseif ($login['id_role'] == 6) {
        // ortu
        $_SESSION['username'] = $username;
        $_SESSION['password'] = $password;
        $_SESSION['id_role'] = 6;
        $_SESSION['status'] = "login";
        header("location:dashboard_ortu.php?id=$id");
    }elseif ($login['id_role'] == 7) {
        // ortu
        $_SESSION['username'] = $username;
        $_SESSION['password'] = $password;
        $_SESSION['id_role'] = 7;
        $_SESSION['status'] = "login";
        header("location:../master/dashboard_master.php?id=$id");
    }
}else{
    header("location:login.php?pesan=gagal");
}
?>