<?php 
include '../../connection.php';
session_start();

$idus = $_GET['id_user'];
$idpemb = $_GET['id_pemb'];
$nip = $_GET['nip'];
$nama = $_GET['nama'];
$alamat = $_GET['alamat'];
$jeniskelamin = $_GET['jenis'];
$nohp = $_GET['nohp'];
$usern = $_GET['username'];
$pass = $_GET['pass'];

$cekusern = mysqli_query($conn, "SELECT * FROM user WHERE username = '$usern' AND id_user != $idus");
$ceknip = mysqli_query($conn, "SELECT * FROM pembimbing WHERE nip = '$nip' AND id_user != $idus");
$ceknip2 = mysqli_query($conn, "SELECT * FROM pegawai WHERE nip = '$nip' AND id_user != $idus");
$adatidak = mysqli_num_rows($cekusern);
$adatidaknip = mysqli_num_rows($ceknip);
$adatidaknip2 = mysqli_num_rows($ceknip2);

if($adatidak > 0 && $adatidaknip > 0) {
	$message = "Username telah digunakan dan NIP sudah terdaftar";                
}else if ($adatidak > 0 && $adatidaknip == 0) {
	$message = "Username telah digunakan";
}else if (($adatidaknip > 0 || $adatidaknip2 > 0) && $adatidak == 0) {
	$message = "NIP sudah terdaftar";
}else{
	$sql1 = "UPDATE user SET nama = '$nama' , username = '$usern' , password = '$pass' , alamat = '$alamat' , jk = '$jeniskelamin' , nohp = '$nohp' WHERE id_user = $idus";
	$sql2 = "UPDATE pembimbing SET nama = '$nama', nip = '$nip' WHERE id_user = $idus";
	$query1 =  mysqli_query($conn, $sql1);
	$query2 =  mysqli_query($conn, $sql2);

	$message = "Data Berhasil Diubah";
}

header("location:pembimbing.php?pesan=$message");
?>