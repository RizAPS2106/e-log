<?php 
include '../../connection.php';
session_start();

$idus = $_GET['id_user'];
$idusort = $_GET['id_userort'];
$nis = $_GET['nis'];
$namasis = $_GET['namasis'];
$namaort = $_GET['namaort'];
$alamat = $_GET['alamat'];
$alamatort = $_GET['alamatort'];
$jeniskelamin = $_GET['jenis'];
$jeniskelaminort = $_GET['jenisort'];
$nohp = $_GET['nohp'];
$nohport = $_GET['nohport'];
$kelas = $_GET['kelas'];
$point = 100;
$usern = $_GET['username'];
$usernort = $_GET['usernameort'];
$pass = $_GET['pass'];
$passort = $_GET['passort'];

$cekuserns = mysqli_query($conn, "SELECT * FROM user WHERE username = '$usern' AND id_user != $idus");
$cekuserno = mysqli_query($conn, "SELECT * FROM user WHERE username = '$usernort' AND id_user != $idusort");
$ceknip = mysqli_query($conn, "SELECT * FROM siswa WHERE nis = '$nis' AND id_user != $idus");
$adatidaksis = mysqli_num_rows($cekuserns);
$adatidakort = mysqli_num_rows($cekuserno);
$adatidaknip = mysqli_num_rows($ceknip);

$message;

if($adatidaksis > 0 && $adatidakort > 0 && $adatidaknip > 0){
	$message = "Username siswa dan username orang tua telah digunakan dan NIS sudah terdaftar";
}else if($adatidaksis > 0 && $adatidakort == 0){
	$message = "Username siswa telah digunakan";
}else if($adatidaksis == 0 && $adatidakort > 0){
	$message = "Username orang tua telah digunakan";
}else if($usern == $usernort) {
	$message = "Username siswa dan orang tua tidak bisa sama";    
}else if ($adatidaknip > 0) {
	$message = "NIS sudah terdaftar";
}else{
	$sql1 = "UPDATE user SET nama = '$namasis' , username = '$usern' , password = '$pass' , alamat = '$alamat' , jk = '$jeniskelamin' , nohp = '$nohp' WHERE id_user = $idus";
	$sql2 = "UPDATE user SET nama = '$namaort' , username = '$usernort' , password = '$passort' , alamat = '$alamatort' , jk = '$jeniskelaminort' , nohp = '$nohport' WHERE id_user = $idusort";
	$sql3 = "UPDATE siswa SET nama_siswa = '$namasis' , nis = '$nis' , id_kelas = '$kelas' , sisa_point = '$point' WHERE id_user = $idus";
	$query1 =  mysqli_query($conn, $sql1);
	$query2 =  mysqli_query($conn, $sql2);
	$query3 =  mysqli_query($conn, $sql3);

	$message = "Data Berhasil Di Ubah";
}

header("location:siswa.php?pesan=$message");
?>