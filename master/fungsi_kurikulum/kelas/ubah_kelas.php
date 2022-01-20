<?php 
include '../../connection.php';
session_start();

$id = $_GET['idkel'];
$kelas = $_GET['kelas'];
$jurusan = $_GET['jurusan'];
$abjad = $_GET['abjad'];
$namakel = "$kelas $jurusan $abjad"; 
$wk = $_GET['wk'];
$bk = $_GET['bk'];
$wkper = $_GET['wkper'];
$bkper = $_GET['bkper'];

$queryceknamkel = mysqli_query($conn,"SELECT * FROM kelas WHERE nama_kelas = '$namakel' AND id_kelas != $id");
$ceknamkel = mysqli_num_rows($queryceknamkel);

if ($ceknamkel > 0) {
	$message = "Nama Kelas Sudah Digunakan";
}else{

//query kelas
$sqlkelas = "UPDATE kelas SET nama_kelas = '$namakel' WHERE id_kelas = $id";
$querykelas = mysqli_query($conn, $sqlkelas);

if ($wkper != $wk) {
	$querypemkwk = mysqli_query($conn, "SELECT * FROM pemkel WHERE id_pembimbing = $wk");
	$querypemkwkper = mysqli_query($conn, "SELECT * FROM pemkel WHERE id_pembimbing = $wkper");

	while ($keypemkwk = mysqli_fetch_array($querypemkwk)) {
		while ($keypemkwkper = mysqli_fetch_array($querypemkwkper)) {
			$idpemkwk = $keypemkwk['id_pemkel'];
			$idpemkwkper = $keypemkwkper['id_pemkel'];
			$idkelwk = $keypemkwk['id_kelas'];
			$idkelwkper = $keypemkwkper['id_kelas'];

			$sqlwk = "UPDATE pemkel SET id_kelas = $idkelwkper WHERE id_pemkel = $idpemkwk";
			$sqlwkper = "UPDATE pemkel SET id_kelas = $idkelwk WHERE id_pemkel = $idpemkwkper";

			//query wk pertama dan wk baru
			$querywk = mysqli_query($conn, $sqlwk);
			$querywkper = mysqli_query($conn, $sqlwkper);

			$sqlkelaswk = "UPDATE kelas SET id_pembimbing = $wkper WHERE id_kelas = $idkelwk";
			$sqlkelaswkper = "UPDATE kelas SET id_pembimbing = $wk WHERE id_kelas = $idkelwkper";
			
			//query kelas wk pertama dan kelas wk baru
			$querykelaswk = mysqli_query($conn, $sqlkelaswk);
			$querykelaswkper = mysqli_query($conn, $sqlkelaswkper);
		}
	}	
}else if ($wkper == $wk) {
	//do nothing
}

if ($bkper != $bk) {
	$querycekbkper = mysqli_query($conn, "SELECT * FROM pemkel WHERE id_pembimbing = $bkper");
	$adatidakbkper = mysqli_num_rows($querycekbkper);

	if ($adatidakbkper == 1) {
		$sqlbkper = "UPDATE pemkel SET id_kelas = NULL WHERE id_pembimbing = $bkper";
	}else if($adatidakbkper > 1){
		$sqlbkper = "DELETE FROM pemkel WHERE id_pembimbing = $bkper AND id_kelas = $id";
	}

	//query bk pertama
	$querybkper = mysqli_query($conn, $sqlbkper);

	$queryidpemknew = mysqli_query($conn , "SELECT MAX(id_pemkel) as idpemkel FROM pemkel");

	while ($keyidpemknew = mysqli_fetch_array($queryidpemknew)) {
		if ($keyidpemknew['idpemkel'] == "") {
    		$idpemkelnew = 1;
		}else if ($keyidpemknew['idpemkel'] != "") {
    		$idpemkelnew = $keyidpemknew['idpemkel'] + 1;
		}else{
    		$idpemkelnew = 1;
		}

		$querydelbknul = mysqli_query($conn, "DELETE FROM pemkel WHERE id_pembimbing = $bk AND id_kelas IS NULL"); 

		//query bk baru
		$sqlbk = "INSERT INTO pemkel VALUES('$idpemkelnew','$bk','$id')";
		$querybk = mysqli_query($conn, $sqlbk);
	}	
}else if ($bkper == $bk) {
	//do nothing
}

$message = "Data Berhasil Diubah";

}
header("location:kelas.php?pesan=$message");
?>