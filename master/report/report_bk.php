<?php
// memanggil library FPDF
require('fpdf.php');
// intance object dan memberikan pengaturan halaman PDF
$pdf = new FPDF('l','mm','A5');
// membuat halaman baru
$pdf->AddPage();
// setting jenis font yang akan digunakan
$pdf->SetFont('Arial','B',16);
// mencetak string 
$tanggal1 = date('l');
$tanggal2 = date(', d M Y');
if ($tanggal1 == "Monday") {
    $hari = "Senin";
}else if ($tanggal1 == "Tuesday") {
    $hari = "Selasa";
}else if ($tanggal1 == "Wednesday") {
    $hari = "Rabu";
}else if ($tanggal1 == "Thursday") {
    $hari = "Kamis";
}else if ($tanggal1 == "Friday") {
    $hari = "Jumat";
}else if ($tanggal1 == "Saturday") {
    $hari = "Sabtu";
}else if ($tanggal1 == "Sunday") {
    $hari = "Minggu";
}
$tanggalind = "$hari $tanggal2";
$pdf-> Image('kopsuratsmk.jpg' ,20,15,170,25);
$pdf-> Ln(40);
$pdf->Cell(190,7,'DAFTAR BIMBINGAN KONSELING SMK NEGERI 2 CIMAHI',0,1,'C');
$pdf->SetFont('Arial','B',10);
$pdf->Cell(10,15,$tanggalind,0,1); 

// Memberikan space kebawah agar tidak terlalu rapat
$pdf->Cell(10,0,'',0,1);
 
$pdf->SetFont('Arial','B',10);
$pdf->Cell(35,6,'NIP',1,0);
$pdf->Cell(35,6,'NAMA GURU BK',1,0);
$pdf->Cell(25,6,'KELAS',1,0);
$pdf->Cell(30,6,'JENIS KELAMIN',1,0);
$pdf->Cell(35,6,'ALAMAT',1,0);
$pdf->Cell(30,6,'NO. HP',1,1);
 
$pdf->SetFont('Arial','',10);
 
include '../../connection.php';
?>
<?php

$querypemb = mysqli_query($conn, "SELECT user.*, pembimbing.* FROM pembimbing INNER JOIN user ON pembimbing.id_user = user.id_user WHERE user.id_role = 1");       
?>  

<?php while($key = mysqli_fetch_array($querypemb)) {?>

<?php
    //Query select kelas
    $idpem = $key['id_pembimbing'];
    $querykel = mysqli_query($conn, "SELECT kelas.*, pembimbing.* , pemkel.*, MAX(pemkel.id_kelas) FROM ((pembimbing INNER JOIN pemkel ON pemkel.id_pembimbing = pembimbing.id_pembimbing) INNER JOIN kelas ON kelas.id_kelas = pemkel.id_kelas)  WHERE pembimbing.id_pembimbing = $idpem ORDER BY kelas.id_kelas ASC");
?>    

<?php while($keykel = mysqli_fetch_array($querykel)) {?>

<?php
    $querybakel = mysqli_query($conn, "SELECT pemkel.*, kelas.* FROM pemkel INNER JOIN kelas ON pemkel.id_kelas = kelas.id_kelas WHERE pemkel.id_pembimbing = $idpem");

    foreach ($querybakel as $bakel):
        ?>
        <?php
        $pdf->Cell(35,6,$key['nip'],1,0);
        $pdf->Cell(35,6,$key['nama'],1,0);
        $pdf->Cell(25,6,$bakel['nama_kelas'],1,0);
        $pdf->Cell(30,6,$key['jk'],1,0);
        $pdf->Cell(35,6,$key['alamat'],1,0);
        $pdf->Cell(30,6,$key['nohp'],1,1);
        ?>
        <?php      
    endforeach
?>

<?php } ?>
<?php } ?> 

<?php
$pdf->Output();
?>