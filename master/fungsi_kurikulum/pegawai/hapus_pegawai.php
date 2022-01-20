<?php 
include '../../connection.php';
session_start();

$id = $_GET['id'];
$idpeg = $_GET['idpeg'];

$sql1 = "DELETE FROM user WHERE id_user = $id";
$sql2 = "DELETE FROM pegawai WHERE id_pegawai = $idpeg";

$query1 =  mysqli_query($conn, $sql1);
$query2 =  mysqli_query($conn, $sql2);

$message = "Data Berhasil Dihapus";

header("location:pegawai.php?pesan=$message");
?>