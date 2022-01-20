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
$pdf->Cell(190,7,'DATA KELAS SMK NEGERI 2 CIMAHI',0,1,'C');
$pdf->SetFont('Arial','B',10);
$pdf->Cell(10,15,$tanggalind,0,1);

// Memberikan space kebawah agar tidak terlalu rapat
$pdf->Cell(10,0,'',0,1);
 
$pdf->SetFont('Arial','B',10);
$pdf->Cell(47,6,'NAMA KELAS',1,0);
$pdf->Cell(47,6,'WALI KELAS',1,0);
$pdf->Cell(47,6,'BIMBINGAN KONSELING',1,0);
$pdf->Cell(47,6,'JUMLAH SISWA',1,1);
$pdf->SetFont('Arial','',10);
 
include '../../connection.php';

?>
<?php
	$querykel = mysqli_query($conn, "SELECT user.*, user.nama as name, pembimbing.*, kelas.*, pemkel.* FROM ((( pembimbing INNER JOIN user ON  pembimbing.id_user = user.id_user)INNER JOIN pemkel ON pembimbing.id_pembimbing = pemkel.id_pembimbing)INNER JOIN kelas ON pemkel.id_kelas = kelas.id_kelas) WHERE kelas.id_kelas != 0 AND user.id_role = 2 ORDER BY kelas.id_kelas ASC");
?>

<?php while($key = mysqli_fetch_array($querykel)) {?> 

<?php 
    $idkel = $key['id_kelas'];

    $querykeldua = mysqli_query($conn, "SELECT user.*, user.nama as name, pembimbing.*, kelas.*, pemkel.* FROM ((( pembimbing INNER JOIN user ON  pembimbing.id_user = user.id_user)INNER JOIN pemkel ON pembimbing.id_pembimbing = pemkel.id_pembimbing)INNER JOIN kelas ON pemkel.id_kelas = kelas.id_kelas) WHERE kelas.id_kelas = $idkel AND user.id_role = 1 ORDER BY kelas.id_kelas ASC");

    $queryjumsis = mysqli_query($conn, "SELECT * FROM siswa WHERE id_kelas = $idkel");
    $jumsis = mysqli_num_rows($queryjumsis);
?>

<?php while($keydua = mysqli_fetch_array($querykeldua)) {?>
	<?php
		$pdf->Cell(47,6,$key['nama_kelas'],1,0);
    	$pdf->Cell(47,6,$key['name'],1,0);
    	$pdf->Cell(47,6,$keydua['name'],1,0);
    	$pdf->Cell(47,6,$jumsis,1,1);
	?>
<?php } ?>
<?php } ?>

<?php
	$pdf->Output();
?>