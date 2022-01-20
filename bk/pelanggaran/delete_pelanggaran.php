<?php 
include '../../connection.php';
session_start();

$idd = $_GET['idd'];
$id = $_GET['id'];
// $idpel = $_SESSION['id_pelanggaran'];


$result = mysqli_query($conn, "DELETE FROM pelanggaran WHERE id_pelanggaran='$idd'");

echo "<script>
        alert('Data berhasil dihapus');
        document.location.href='lihat_pelanggaran.php?id=$id';
    </script>";

// header("location:lihat_pelanggaran.php?id=$id");
?>