$message =<?php 
include '../../connection.php';
session_start();

if(isset($_POST['submit'])) {
    $nis = $_POST['nis'];
    $namasis = $_POST['namasis'];
    $nama = $_POST['nama'];
    $alamatsis = $_POST['alamatsis'];
    $alamat = $_POST['alamat'];
    $jeniskelaminsis = $_POST['jenissis'];
    $jeniskelamin = $_POST['jenis'];
    $nohpsis = $_POST['nohpsis'];
    $nohp = $_POST['nohp'];
    $kelas = $_POST['kelas'];
    $point = 100;
    $usernsis = $_POST['usernamesis'];
    $usern = $_POST['username'];
    $passsis = $_POST['passsis'];
    $pass = $_POST['pass'];

    $queryuser = mysqli_query($conn, "SELECT MAX(id_user) as iduser FROM user");

    while ($sisaw = mysqli_fetch_array($queryuser)) {
        if ($sisaw['iduser'] == "") {
            $idussis = 1;
        }else if ($sisaw['iduser'] != "") {
            $idussis = $sisaw['iduser'] + 1;
        }else{
            $idussis = 1;
        }

        $idusort = $idussis + 1;

        $sql1 = "INSERT INTO user VALUES('$idussis', '5', '$namasis', '$usernsis', '$passsis', '$jeniskelaminsis', '$alamatsis', '$nohpsis')";
        $sql2 = "INSERT INTO user VALUES('$idusort', '6', '$nama', '$usern', '$pass', '$jeniskelamin', '$alamat', '$nohp')";

        $querysis = mysqli_query($conn, "SELECT MAX(id_siswa) as idsiswa FROM siswa");
        $queryort = mysqli_query($conn, "SELECT MAX(id_ortu) as idortu FROM ortu");

        while ($sisid = mysqli_fetch_array($querysis)) {

            if ($sisid['idsiswa'] == "") {
                $idsis = 1;
            }else if ($sisid['idsiswa'] != "") {
                $idsis = $sisid['idsiswa'] + 1;
            }else{
                $idsis = 1;
            }

            $sql3 = "INSERT INTO siswa VALUES ('$idsis', '$idussis', '$namasis', '$nis', '$point', '$kelas')";
            
            while ($ortid = mysqli_fetch_array($queryort)) {

                if ($ortid['idortu'] == "") {
                    $idort = 1;
                }else if ($ortid['idortu'] != "") {
                    $idort = $ortid['idortu'] + 1;
                }else{
                    $idort = 1;
                }

                $querypemb = mysqli_query($conn, "SELECT pemkel.*, pembimbing.* FROM pemkel INNER JOIN pembimbing ON pembimbing.id_pembimbing = pemkel.id_pembimbing WHERE pemkel.id_kelas = $kelas");

                while ($pembimbing = mysqli_fetch_array($querypemb)) {
                    $pemb = $pembimbing['id_pembimbing'];

                    $sql4 = "INSERT INTO ortu VALUES ('$idort', '$idsis' , '$idusort' , '$pemb', '$nama')";

                    $cekuserno = mysqli_query($conn, "SELECT * FROM user WHERE username = '$usern'");
                    $cekuserns = mysqli_query($conn, "SELECT * FROM user WHERE username = '$usernsis'");
                    $ceknis = mysqli_query($conn, "SELECT * FROM siswa WHERE nis = '$nis'");
                    $adatidaksis = mysqli_num_rows($cekuserns);
                    $adatidakort = mysqli_num_rows($cekuserno);
                    $adatidaknis = mysqli_num_rows($ceknis);

                    $message1 = "";
                    $message2 = "";
                    $message3 = "";
                    $message4 = "";
                    $message5 = "";

                    if ($adatidaksis > 0 || $adatidakort > 0 || $usernsis == $usern || $adatidaknis > 0) {
                        if($adatidaksis > 0){
                            $message1 = "Username siswa telah digunakan ";
                        }if($adatidakort > 0){
                            $message2 = "Username ortu telah digunakan ";
                        }if($usernsis == $usern) { 
                            $message3 = "Username siswa dan orang tua tidak bisa sama ";   
                        }if ($adatidaknis > 0) {
                            $message4 = "NIS sudah terdaftar ";
                        }
                    }else{
                        $query1 =  mysqli_query($conn, $sql1);
                        $query2 =  mysqli_query($conn, $sql2);
                        $query3 =  mysqli_query($conn, $sql3);
                        $query4 =  mysqli_query($conn, $sql4);

                        $message5 = "Data Berhasil Di Simpan";
                    }

                    $message = "$message1 $message2 $message3 $message4 $message5";

                    header("location:ortu.php?pesan=$message");

                    break;     
                }
            } 
        } 
    } 

}
?>