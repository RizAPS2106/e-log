<?php 
include '../../connection.php';
session_start();

$id = $_GET['id'];
$idwk = $_GET['idwk'];
$idbk = $_GET['idbk'];

$querycekwk = mysqli_query($conn, "SELECT * FROM pemkel WHERE id_pembimbing = $idwk AND id_kelas IS NOT NULL"); 
$querycekbk = mysqli_query($conn, "SELECT * FROM pemkel WHERE id_pembimbing = $idbk AND id_kelas IS NOT NULL");

$adatidakwk = mysqli_num_rows($querycekwk);
$adatidakbk = mysqli_num_rows($querycekbk);

if ($adatidakwk > 1) {
	$sql1 = "DELETE FROM pemkel WHERE id_pembimbing = $idwk AND id_kelas = $id";
}else if ($adatidakwk == 1) {
	$sql1 = "UPDATE pemkel SET id_kelas = NULL WHERE id_pembimbing = $idwk AND id_kelas = $id";
}

if ($adatidakbk > 1) {
	$sql2 = "DELETE FROM pemkel WHERE id_pembimbing = $idbk AND id_kelas = $id";
}else if ($adatidakbk == 1) {
	$sql2 = "UPDATE pemkel SET id_kelas = NULL WHERE id_pembimbing = $idbk AND id_kelas = $id";
}

$sql3 = "DELETE FROM kelas WHERE id_kelas = $id";

$query1 =  mysqli_query($conn, $sql1);
$query2 =  mysqli_query($conn, $sql2);
$query3 =  mysqli_query($conn, $sql3);

$message = "Data Berhasil Dihapus";

header("location:kelas.php?pesan=$message");
?>