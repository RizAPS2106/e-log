<?php 
include '../../connection.php';
session_start();

if(isset($_POST['submit'])) {
    $kelas = $_POST['kelas'];
    $jurusan = $_POST['jurusan'];
    $abjad = $_POST['abjad'];
    $namakel = "$kelas $jurusan $abjad";   
    $idwk = $_POST['wk'];
    $idbk = $_POST['bk'];

    $queryidkel = mysqli_query($conn , "SELECT MAX(id_kelas) as idkelas FROM kelas");
    $queryidpemk = mysqli_query($conn , "SELECT MAX(id_pemkel) as idpemkel FROM pemkel");

    while ($keyidkel = mysqli_fetch_array($queryidkel)) {
        while ($keyidpemk = mysqli_fetch_array($queryidpemk)) {

            if ($keyidkel['idkelas'] == "") {
                $idkel = 1;
            }else if ($keyidkel['idkelas'] != "") {
                $idkel = $keyidkel['idkelas'] + 1;
            }else{
                $idkel = 1;
            }
            
            if ($keyidpemk['idpemkel'] == "") {
                $idpemkel1 = 1;
            }else if ($keyidpemk['idpemkel'] != "") {
                $idpemkel1 = $keyidpemk['idpemkel'] + 1;
            }else{
                $idpemkel1 = 1;
            }

            $idpemkel2 = $idpemkel1 + 1;

            $querykel = mysqli_query($conn , "SELECT * FROM kelas WHERE nama_kelas = '$namakel'");
            $ceknamakel = mysqli_num_rows($querykel);

            if ($ceknamakel > 0) {
                $message = "Nama Kelas Sudah Digunakan";
            }else if ($idwk == "") {
                $message = "Wali Kelas tidak bisa kosong";
            }else if ($idbk == "") {
                $message = "Guru BK tidak bisa kosong";
            }else{
                $querydel1 = mysqli_query($conn, "DELETE FROM pemkel WHERE id_pembimbing = $idwk AND id_kelas IS NULL");
                $querydel2 = mysqli_query($conn, "DELETE FROM pemkel WHERE id_pembimbing = $idbk AND id_kelas IS NULL");
                
                $sql1 = "INSERT INTO kelas VALUES('$idkel', '$idwk', '$namakel')";
                $sql2 = "INSERT INTO pemkel VALUES ('$idpemkel1', '$idwk' , '$idkel')";
                $sql3 = "INSERT INTO pemkel VALUES ('$idpemkel2', '$idbk' , '$idkel')";
                $query1 =  mysqli_query($conn, $sql1);
                $query2 =  mysqli_query($conn, $sql2);
                $query3 =  mysqli_query($conn, $sql3);

                $message = "Data berhasil Disimpan";      
            }
            header("location:kelas.php?pesan=$message");

            break;  
        }
    }
}
?>