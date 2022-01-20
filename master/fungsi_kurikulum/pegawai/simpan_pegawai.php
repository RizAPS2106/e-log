<?php 
include '../../connection.php';
session_start();

if(isset($_POST['submit'])) {
    $nip = $_POST['nip'];
    $nama = $_POST['nama'];    
    $alamat = $_POST['alamat'];
    $jeniskelamin = $_POST['jenis'];
    $nohp = $_POST['nohp'];
    $usern = $_POST['username'];
    $pass = $_POST['pass'];

    $queryuser = mysqli_query($conn, "SELECT MAX(id_user) as iduser FROM user");
    $adatidakuser = mysqli_num_rows($queryuser);

    while ($keyuser = mysqli_fetch_array($queryuser)) {
        if ($keyuser['iduser'] == "") {
            $idus = 1;
        }else if ($keyuser['iduser'] != "") {
            $idus = $keyuser['iduser']+1;
        }else{
            $idus = 1;
        }

        $sql1 = "INSERT INTO user VALUES('$idus', '4', '$nama', '$usern', '$pass', '$jeniskelamin', '$alamat', '$nohp')";

        $querypeg = mysqli_query($conn, "SELECT MAX(id_pegawai) as idpeg FROM pegawai");
        $adatidakpeg = mysqli_num_rows($querypeg);

        while ($keypeg = mysqli_fetch_array($querypeg)) {
            if ($keypeg['idpeg'] == "") {
                $idpeg = 1;
            }else if ($keypeg['idpeg'] != "") {
                $idpeg = $keypeg['idpeg']+1;
            }else{
                $idpeg = 1;
            }
            
            $sql2 = "INSERT INTO pegawai VALUES ('$idpeg' , 'Kesiswaan', '$nip', '$idus')";

            
            $cekusern = mysqli_query($conn, "SELECT * FROM user WHERE username = '$usern'");
            $ceknip = mysqli_query($conn, "SELECT * FROM pembimbing WHERE nip = '$nip'");
            $ceknip2 = mysqli_query($conn, "SELECT * FROM pegawai WHERE nip = '$nip'");
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
                $query1 =  mysqli_query($conn, $sql1);
                $query2 =  mysqli_query($conn, $sql2);
                
                $message = "Data Berhasil Disimpan";
            }

            header("location:pegawai.php?pesan=$message");

            break;
        }
    }
}
?>