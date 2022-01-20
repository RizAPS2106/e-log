<?php
include "koneksi.php";
$jurusan = $GET_['jurusan'];

if ($jurusan == "MEKA") {
	$data_kelas = array('kelas'   	=>  array("X","XI","XII","XIII"););	
}else{
	$data_kelas = array('kelas'   	=>  array("X","XI","XII"););	
}

if ($jurusan == "ANIMASI" || $jurusan == "MULTIMEDIA" || $jurusan == "KIMIA") {
	$data_abjad = array('abjad'   	=>  array("A","B","C"););
}else{
	$data_abjad = array('abjad'   	=>  array("A","B"););
}

 echo json_encode($data_kelas && $data_abjad);
 ?>