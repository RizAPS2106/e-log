<?php
include '../../connection.php';
session_start();

if (isset($_POST['submit'])) {
    // $idkasus = $_POST['idkasus'];
    $siswa = $_POST['siswa'];
    $jenis = $_POST['jenis'];
    $pegawai = $_POST['pegawai'];
    $pembimbing = $_POST['pembimbing'];
    date_default_timezone_set("Asia/Jakarta");
	$tanggal = date("Y-m-d");
    $penanganan = $_POST['penanganan'];

    $querykasus = mysqli_query($conn, "SELECT MAX(id_kasus) as idkasus FROM kasus");

    while ($keykasus = mysqli_fetch_array($querykasus)) {
        $idkas = $keykasus['idkasus']+1;
        $sql1 = "INSERT INTO kasus VALUES('$idkas', '$siswa', '$jenis', '$pegawai', '$pembimbing', '$tanggal', '$penanganan')";
        $query1 = mysqli_query($conn, $sql1);

        $result = mysqli_query($conn, "SELECT pelanggaran.point FROM pelanggaran WHERE pelanggaran.id_pelanggaran='$jenis'");
            while ($keypelang = mysqli_fetch_array($result)){
                $pointpelang = $keypelang['point'];
                // echo $hasil;
                // die;
                $cari = mysqli_query($conn, "SELECT sisa_point FROM siswa WHERE id_siswa = '$siswa'");
            while ($keypointsis = mysqli_fetch_array($cari)) {
                $pointsis = $keypointsis['sisa_point'];
                $akhir = $pointsis - $pointpelang;
                // echo $nilai;
                // die;
                $sql2 = "UPDATE siswa SET sisa_point = '$akhir' WHERE id_siswa = '$siswa'";
                // echo $sql2;
                // die;
                $query2 = mysqli_query($conn, $sql2);
                    if ($pointsis < $pointpelang) {
                        echo "<script>
                            alert('Sisa Poin siswa tersebut kurang dari 75(Tujuh puluh lima)');
                            document.location.href='pelanggaran_siswa.php?id=$pembimbing';
                        </script>";
                    }elseif ($pointsis>=50) {
                        echo "<script>
                            alert('Sisa Point siswa tersebut kurang dari 55(Lima puluh lima)');
                            document.location.href='pelanggaran_siswa.php?id=$pembimbing';
                        </script>";
                    }elseif ($pointsis>=40) {
                        echo "<script>
                            alert('Sisa Point siswa tersebut kurang dari 45(Empat puluh lima) silahkan akses link berikut untuk mendownload sanksi teguran tertulis ');
                            document.location.href='pelanggaran_siswa.php?id=$pembimbing';
                        </script>";
                    }elseif ($pointsis>=25) {
                        echo "<script>
                            alert('Sisa Point siswa tersebut kurang dari 30(Tiga Puluh) silahkan akses link dibawah untuk sanksi skorsing');
                            document.location.href='pelanggaran_siswa.php?id=$pembimbing';
                        </script>";
                    }elseif ($pointsis>=10) {
                        echo "<script>
                            alert('Sisa Poin siswa tersebuthanya 10 (Sepuluh)');
                            document.location.href='pelanggaran_siswa.php?id=$pembimbing';
                        </script>";
                    }
                    // elseif ($pointsis < $pointpelang) {
                    //     echo "<script>
                    //         alert('Siswa tersebut sudah tidak memiliki poin yang cukup');
                    //         document.location.href='pelanggaran_siswa.php?id=$pembimbing';
                    //     </script>";
                    // }
                }
            }
        }
    }
?>
