<?php 
include '../../connection.php';
session_start();
$id = $_GET['id'];
// echo $id;
// die;

if(isset($_POST['submit'])) {
    // $idpel = $_POST['idpel'];
    $namapel = $_POST['namapel'];
    $jenis = $_POST['jenis'];
    $point = $_POST['point'];

    $querytambah = mysqli_query($conn, "SELECT MAX(id_pelanggaran) as idpel FROM pelanggaran");
    while ($key = mysqli_fetch_array($querytambah)) {
        $idp = $key['idpel']+1;
        $sql = "INSERT INTO pelanggaran VALUES ('$idp', '$namapel', '$jenis', '$point')";
        $query =  mysqli_query($conn, $sql);
    if ($query) {
        # code redicet setelah insert ke index
        echo "<script>
        alert('Data berhasil ditambahkan');
        document.location.href='lihat_pelanggaran.php?id=$id';
    </script>";
        
    }
    else{
        echo "ERROR, tidak berhasil";
        }
    }
}
?>