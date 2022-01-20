<?php 
include '../../connection.php';
session_start();

$idus = $_GET['id_user'];
$idussis = $_GET['id_usersis'];
$nis = $_GET['nis'];
$namasis = $_GET['namasis'];
$namaort = $_GET['nama'];
$alamatsis = $_GET['alamatsis'];
$alamat = $_GET['alamat'];
$jeniskelaminsis = $_GET['jenissis'];
$jeniskelaminort = $_GET['jenis'];
$nohpsis = $_GET['nohpsis'];
$nohp = $_GET['nohp'];
$kelas = $_GET['kelas'];
$point = 100;
$usernsis = $_GET['usernamesis'];
$usern = $_GET['username'];
$passsis = $_GET['passsis'];
$pass = $_GET['pass'];

$cekuserno = mysqli_query($conn, "SELECT * FROM user WHERE username = '$usern' AND id_user != $idus");;
$cekuserns = mysqli_query($conn, "SELECT * FROM user WHERE username = '$usernsis' AND id_user != $idussis");;
$adatidakort = mysqli_num_rows($cekuserno);
$adatidaksis = mysqli_num_rows($cekuserns);

if($adatidaksis > 0 && $adatidakort > 0){
	$message = "Username siswa dan username orang tua telah digunakan";
}else if($adatidaksis > 0 && $adatidakort == 0){
	$message = "Username siswa telah digunakan";
}else if($adatidaksis == 0 && $adatidakort > 0){
	$message = "Username orang tua telah digunakan";
}else if($usern == $usernsis) {
	$message = "Username siswa dan orang tua tidak bisa sama";    
}else{
	$sql1 = "UPDATE user SET nama = '$namasis' , username = '$usernsis' , password = '$passsis' , alamat = '$alamatsis' , jk = '$jeniskelaminsis' , nohp = '$nohpsis' WHERE id_user = $idussis";
	$sql2 = "UPDATE user SET nama = '$namaort' , username = '$usern' , password = '$pass' , alamat = '$alamat' , jk = '$jeniskelaminort' , nohp = '$nohp' WHERE id_user = $idus";
	$sql3 = "UPDATE siswa SET nama_siswa = '$namasis', nis = '$nis' , id_kelas = '$kelas' , sisa_point = '$point' WHERE id_user = $idussis";
	$sql4 = "UPDATE ortu SET nama_ortu = '$namaort' WHERE id_user = $idus";
	$query1 =  mysqli_query($conn, $sql1);
	$query2 =  mysqli_query($conn, $sql2);
	$query3 =  mysqli_query($conn, $sql3);
	$query3 =  mysqli_query($conn, $sql4);

	$message = "Data Berhasil Diubah";
}
header("location:ortu.php?pesan=$message");
?>