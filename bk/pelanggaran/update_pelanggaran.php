<?php
include('../../connection.php');
$idpel = $_GET['id_pelanggaran'];
$namapel = $_GET['nama_pelanggaran'];
$kategori = $_GET['id_kategori'];
$point = $_GET['point'];
//query update
$query = "UPDATE pelanggaran SET id_pelanggaran = '$idpel', nama_pelanggaran = '$namapel', id_kategori = '$kategori', point = '$point' WHERE pelanggaran.id_pelanggaran = '$idpel'";
if (mysqli_query($conn, $query)) {
    # credirect ke page index
    echo "<script>
    alert('Data berhasil diubah');
    document.location.href='lihat_pelanggaran.php';
</script>";
    // header("location:lihat_pelanggaran.php");    
}
else{
    echo "ERROR, data gagal diupdate";
}
?>