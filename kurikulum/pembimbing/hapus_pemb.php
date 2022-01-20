<?php 
include '../../connection.php';
session_start();

$id = $_GET['id'];
$idpemb = $_GET['idpemb'];

$sql1 = "DELETE FROM user WHERE id_user = $id";
$sql2 = "DELETE FROM pembimbing WHERE id_user = $id";
$sql3 = "DELETE FROM pemkel WHERE id_pembimbing = $idpemb";

$querylistkel = mysqli_query($conn, "SELECT * FROM pemkel WHERE id_pembimbing = $idpemb");
$jumlistkel = mysqli_num_rows($querylistkel);

if ($jumlistkel > 0) {
	while ($keykel = mysqli_fetch_array($querylistkel)) {
		$idkelas = $keykel['id_kelas'];
		$querydeletekel = mysqli_query($conn, "DELETE FROM kelas WHERE id_kelas = $idkelas");	
	}
}else{
	//do nothing
}

$query1 =  mysqli_query($conn, $sql1);
$query2 =  mysqli_query($conn, $sql2);
$query3 =  mysqli_query($conn, $sql3);

$message = "Data Berhasil Dihapus";

header("location:pembimbing.php?pesan=$message");
?>