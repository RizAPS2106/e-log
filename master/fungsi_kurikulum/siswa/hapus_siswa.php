<?php 
include '../../connection.php';
session_start();

$id = $_GET['id'];
$idort = $_GET['idort'];

$sql1 = "DELETE FROM user WHERE id_user = $id";
$sql2 = "DELETE FROM user WHERE id_user = $idort";
$sql3 = "DELETE FROM siswa WHERE id_user = $id";
$sql4 = "DELETE FROM ortu WHERE id_user = $idort";

$query1 =  mysqli_query($conn, $sql1);
$query2 =  mysqli_query($conn, $sql2);
$query3 =  mysqli_query($conn, $sql3);
$query4 =  mysqli_query($conn, $sql4);

$message = "Data Siswa Berhasil Di Hapus";

header("location:siswa.php?pesan=$message");
?>