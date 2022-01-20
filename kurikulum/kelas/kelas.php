<?php
include '../../connection.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Data Kelas</title>
    
    <link rel="stylesheet" type="text/css" href="../../css/style.css">
    <link rel="stylesheet" type="text/css" href="../../css/bootstrap.css">
    
    <script type="text/javascript" src="../../js/jquery-3.3.1.slim.min.js"></script>
    <script type="text/javascript" src="../../js/bootstrap.js"></script>
</head>
<body>
<?php
    session_start();
    if($_SESSION['status']!="login"){
        header("location:dashboard_kurikulum.php?pesan=belum_login");
    }
    $id = $_SESSION['id'];
?>

<div class="wrapper">
    
    <!-- Sidebar -->
    <nav id="sidebar">
        <div class="sidebar-header">
            <center>
                <a href="../dashboard_kurikulum.php?id=<?=$id?>">
                    <img src="../images/logosmk2cimahi.png" style="width: 100px;height: 100px;">                    
                </a>
            </center>
        </div>

        <ul class="list-unstyled components">
            <li style="padding-top: 10px;padding-bottom: 10px;">
                <a href="../siswa/siswa.php?id=<?=$id?>">Siswa</a>
            </li>
            <li style="padding-top: 10px;padding-bottom: 10px;">
                <a href="../ortu/ortu.php?id=<?=$id?>">Orang Tua</a>
            </li>
            <li style="padding-top: 10px;padding-bottom: 10px;">
                <a href="../pembimbing/pembimbing.php?id=<?=$id?>">Wali Kelas</a>
            </li>
            <li style="padding-top: 10px;padding-bottom: 10px;">
                <a href="../bimbingan_konseling/bimbingankonseling.php?id=<?=$id?>">Bimbingan Konseling</a>
            </li>
            <li style="padding-top: 10px;padding-bottom: 10px;background-color: #2c3e50;border-radius: 5px;">
                <a href="../kelas/kelas.php?id=<?=$id?>">Kelas</a>
            </li>
            <li style="padding-top: 10px;padding-bottom: 10px;">
                <a href="../pegawai/pegawai.php?id=<?=$id?>">Pegawai</a>
            </li>
            <li style="padding-top: 10px;padding-bottom: 10px;">
                <a href="../../admin/logout.php">Keluar</a>
            </li>
        </ul>
    </nav>


<!--Content-->
<div id="content">
    <div class="container-fluid">
        
        <!--button tambah-->
        <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#exampleModal">Tambah</button>
        
        <!--tabel-->
        <div class="divtable">
            <table class="table">
            <thead class="thead-light">
            <br>
                <tr>
                    <th scope="col">Kelas</th> 
                    <th scope="col">Wali Kelas</th>
                    <th scope="col">Bimbingan Konseling</th>
                    <th scope="col">Jumlah Siswa</th>
                    <th scope="col">Ubah/Hapus</th>
                </tr>
            </thead>
            <tbody>

            <!--Isi Tabel-->    
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

            <tr>
                <td><?php echo $key['nama_kelas']; ?></td>
                <td><?php echo $key['name']?></td>
                <td><?php echo $keydua['name']?></td>
                <?php
                if ($jumsis > 0) {
                    ?>
                    <td><a href="../siswakelas.php?idkel=<?=$key['id_kelas']?>&&namakel=<?=$key['nama_kelas']?>" type="button"><?php echo $jumsis?></a></td>
                    <?php  
                }else{
                    ?>
                    <td><?php echo $jumsis?></td>
                    <?php
                }
                ?>
                <td>
                    <a href="#" type="button"  data-toggle="modal" data-target="#myModal<?php echo $key['id_kelas']; ?>">Ubah</a>
                    <!--Hapus User-->
                    <a href='hapus_kelas.php?id=<?=$key['id_kelas']?>&&idwk=<?=$key['id_pembimbing']?>&&idbk=<?=$keydua['id_pembimbing']?>' class='btn btn-danger btn-sm' onclick="return confirm('Apakah Anda yakin ingin menghapusnya ?')">Hapus</a>
                </td>

<!--Ubah (pop-up)-->
<div class="modal fade" id="myModal<?php echo $key['id_kelas']; ?>" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ubah Data Kelas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
                <div class="modal-body">
                    <form role="form" action="ubah_kelas.php" method="get">
                        
                        <?php
                            $id = $key['id_kelas']; 
                            $query_edit = mysqli_query($conn, "SELECT * FROM kelas WHERE id_kelas = $id");
                            while($keyedit = mysqli_fetch_array($query_edit)){ 
                        ?>

                        <input type="hidden" name="idkel" value="<?php echo $key['id_kelas'];?>">    

                        <div class="form-group">
                            <label>Kelas</label>

                            <!--kelas-->
                            <select name="kelas" id="kelas" class="form-control">
                            <?php  
                                if (stripos($keyedit['nama_kelas'], "X ")!== FALSE) {
                            ?>
                                    <option value="X" selected>X</option>
                                    <option value="XI">XI</option>
                                    <option value="XII">XII</option>
                                    <option value="XIII">XIII</option>
                            <?php 
                                }else if(stripos($keyedit['nama_kelas'], "XI ")!== FALSE){ 
                            ?>
                                    <option value="X">X</option>
                                    <option value="XI" selected>XI</option>
                                    <option value="XII">XII</option>
                                    <option value="XIII">XIII</option>
                            <?php  
                                }else if(stripos($keyedit['nama_kelas'], "XII ")!== FALSE){ 
                            ?>
                                    <option value="X">X</option>
                                    <option value="XI">XI</option>
                                    <option value="XII" selected>XII</option>
                                    <option value="XIII">XIII</option>
                            <?php  
                                }else if(stripos($keyedit['nama_kelas'], "XIII ")!== FALSE){ 
                            ?>
                                    <option value="X">X</option>
                                    <option value="XI">XI</option>
                                    <option value="XII">XII</option>
                                    <option value="XIII" selected>XIII</option>
                            <?php  
                                }else{
                            ?>  
                                    <option value="X">X</option>
                                    <option value="XI">XI</option>
                                    <option value="XII">XII</option>
                                    <option value="XIII">XIII</option>
                            <?php    
                                }
                            ?>
                            </select>

                            <br>
                            
                            <!--jurusan-->
                            <select name="jurusan" id="jurusan" class="form-control">
                            <?php  
                                if (stripos($keyedit['nama_kelas'], " RPL ")!== FALSE) {
                            ?>
                                
                                    <option kelas="RPL" value="RPL" selected>Rekayasa Perangkat Lunak</option>
                                    <option kelas="MEKA" value="MEKA">Mekatronika</option>
                                    <option kelas="ANIMASI" value="ANIMASI">Animasi</option>
                                    <option kelas="MULTI" value="MULTI">Multimedia</option>
                                    <option kelas="MESIN" value="MESIN">Mesin</option>
                                    <option kelas="KIMIA" value="KIMIA">Kimia</option>
                            <?php 
                                }else if(stripos($keyedit['nama_kelas'], " MEKA ")!== FALSE){ 
                            ?>
                                    <option kelas="RPL" value="RPL">Rekayasa Perangkat Lunak</option>
                                    <option kelas="MEKA" value="MEKA" selected>Mekatronika</option>
                                    <option kelas="ANIMASI" value="ANIMASI">Animasi</option>
                                    <option kelas="MULTI" value="MULTI">Multimedia</option>
                                    <option kelas="MESIN" value="MESIN">Mesin</option>
                                    <option kelas="KIMIA" value="KIMIA">Kimia</option>
                            <?php  
                                }else if(stripos($keyedit['nama_kelas'], " ANIMASI ")!== FALSE){ 
                            ?>
                                    <option kelas="RPL" value="RPL">Rekayasa Perangkat Lunak</option>
                                    <option kelas="MEKA" value="MEKA">Mekatronika</option>
                                    <option kelas="ANIMASI" value="ANIMASI" selected>Animasi</option>
                                    <option kelas="MULTI" value="MULTI">Multimedia</option>
                                    <option kelas="MESIN" value="MESIN">Mesin</option>
                                    <option kelas="KIMIA" value="KIMIA">Kimia</option>
                            <?php  
                                }else if(stripos($keyedit['nama_kelas'], " MULTI ")!== FALSE){ 
                            ?>
                                    <option kelas="RPL" value="RPL">Rekayasa Perangkat Lunak</option>
                                    <option kelas="MEKA" value="MEKA">Mekatronika</option>
                                    <option kelas="ANIMASI" value="ANIMASI">Animasi</option>
                                    <option kelas="MULTI" value="MULTI" selected>Multimedia</option>
                                    <option kelas="MESIN" value="MESIN">Mesin</option>
                                    <option kelas="KIMIA" value="KIMIA">Kimia</option>
                            <?php  
                                }else if(stripos($keyedit['nama_kelas'], " MESIN ")!== FALSE){ 
                            ?>
                                    <option kelas="RPL" value="RPL">Rekayasa Perangkat Lunak</option>
                                    <option kelas="MEKA" value="MEKA">Mekatronika</option>
                                    <option kelas="ANIMASI" value="ANIMASI">Animasi</option>
                                    <option kelas="MULTI" value="MULTI">Multimedia</option>
                                    <option kelas="MESIN" value="MESIN" selected>Mesin</option>
                                    <option kelas="KIMIA" value="KIMIA">Kimia</option>
                            <?php  
                                }else if(stripos($keyedit['nama_kelas'], " KIMIA ")!== FALSE){ 
                            ?>
                                    <option kelas="RPL" value="RPL">Rekayasa Perangkat Lunak</option>
                                    <option kelas="MEKA" value="MEKA">Mekatronika</option>
                                    <option kelas="ANIMASI" value="ANIMASI">Animasi</option>
                                    <option kelas="MULTI" value="MULTI">Multimedia</option>
                                    <option kelas="MESIN" value="MESIN">Mesin</option>
                                    <option kelas="KIMIA" value="KIMIA" selected>Kimia</option>
                            <?php  
                                }else{
                            ?>  
                                    <option kelas="RPL" value="RPL">Rekayasa Perangkat Lunak</option>
                                    <option kelas="MEKA" value="MEKA">Mekatronika</option>
                                    <option kelas="ANIMASI" value="ANIMASI">Animasi</option>
                                    <option kelas="MULTI" value="MULTI">Multimedia</option>
                                    <option kelas="MESIN" value="MESIN">Mesin</option>
                                    <option kelas="KIMIA" value="KIMIA">Kimia</option>
                            <?php    
                                }
                            ?>
                            </select>

                            <br>

                            <!--abjad-->
                            <select name="abjad" id="abjad" class="form-control">
                            <?php  
                                if (stripos($keyedit['nama_kelas'], " A")!== FALSE) {
                            ?>
                                    <option value="A" selected>A</option>
                                    <option value="B">B</option>
                                    <option value="C">C</option>
                                    <option value="D">D</option>
                            <?php 
                                }else if(stripos($keyedit['nama_kelas'], " B")!== FALSE){ 
                            ?>                                
                                    <option value="A">A</option>
                                    <option value="B" selected>B</option>
                                    <option value="C">C</option>
                                    <option value="D">D</option>
                            <?php  
                                }else if(stripos($keyedit['nama_kelas'], " C")!== FALSE){ 
                            ?>
                                    <option value="A">A</option>
                                    <option value="B">B</option>
                                    <option value="C" selected>C</option>
                                    <option value="D">D</option>
                            <?php  
                                }else if(stripos($keyedit['nama_kelas'], " D")!== FALSE){ 
                            ?>
                                    <option value="A">A</option>
                                    <option value="B">B</option>
                                    <option value="C">C</option>
                                    <option value="D" selected>D</option>
                            <?php  
                                }else if(stripos($keyedit['nama_kelas'], " D")!== FALSE){ 
                            ?>
                                    <option value="A">A</option>
                                    <option value="B">B</option>
                                    <option value="C">C</option>
                                    <option value="D">D</option>
                            <?php  
                                }
                            ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Wali Kelas</label>
                            <br>
                            <font size="2" color="gray">*Wali Kelas akan bertukar kelas saat diubah</font>
                            <select name="wk" class="form-control">
                                
                                <!--Pertamakan wk yang sesuai database-->
                                <?php
                                    $idkel = $keyedit['id_kelas'];
                                    $querywk1 = mysqli_query($conn,  "SELECT user.*, user.nama as name, pembimbing.*, kelas.*, pemkel.* FROM ((( pembimbing INNER JOIN user ON  pembimbing.id_user = user.id_user)INNER JOIN pemkel ON pembimbing.id_pembimbing = pemkel.id_pembimbing)INNER JOIN kelas ON pemkel.id_kelas = kelas.id_kelas) WHERE pembimbing.bidang ='Wali Kelas' AND pemkel.id_kelas = $idkel");
                                    while ($keywk1 = mysqli_fetch_array($querywk1)) {
                                ?> 
                                    <option value="<?=$keywk1['id_pembimbing'];?>"><?=$keywk1['name'];?></option>

                                <!--Sisa nya-->
                                <?php
                                    $querywk2 = mysqli_query($conn,  "SELECT user.*, user.nama as name, pembimbing.*, pemkel.* FROM (( pembimbing INNER JOIN user ON  pembimbing.id_user = user.id_user)INNER JOIN pemkel ON pembimbing.id_pembimbing = pemkel.id_pembimbing) WHERE pembimbing.bidang ='Wali Kelas' AND (pemkel.id_kelas != $idkel OR pemkel.id_kelas IS NULL)");
                                    while ($keywk2 = mysqli_fetch_array($querywk2)) { 
                                    
                                        if ($keywk2['id_kelas'] == "") {
                                            $namakelaswk = "Kosong";
                                            ?>
                                                <option value="<?=$keywk2['id_pembimbing'];?>"><?=$keywk2['name'];?> - <?=$namakelaswk?></option>
                                            <?php        
                                        }else if ($keywk2['id_kelas'] != "") {
                                            $idkelaswk = $keywk2['id_kelas'];
                                            $querynamkelwk = mysqli_query($conn, "SELECT * FROM kelas WHERE id_kelas = $idkelaswk");
                                        
                                            while ($keynamkelwk = mysqli_fetch_array($querynamkelwk)) {
                                                $namakelaswk = $keynamkelwk['nama_kelas'];
                                                ?>
                                                <option value="<?=$keywk2['id_pembimbing'];?>"><?=$keywk2['name'];?> - <?=$namakelaswk?></option>
                                                <?php
                                            } 
                                        }else{
                                            $namakelaswk = "Kosong";
                                            ?>
                                                <option value="<?=$keywk2['id_pembimbing'];?>"><?=$keywk2['name'];?> - <?=$namakelaswk?></option>
                                            <?php
                                        }
                                    } 
                                ?>

                            </select>
                        </div>

                        <!--id wk pertama-->
                        <input type="hidden" name="wkper" value="<?php echo $keywk1['id_pembimbing']; ?>">

                        <?php
                            }
                        ?> 

                        <div class="form-group">
                            <label>Bimbingan Konseling</label>
                            <br>
                            <font size="2" color="gray">*Guru BK akan mengambil alih kelas tanpa bertukar saat di ubah</font>
                            <select name="bk" class="form-control">
                                
                                <!--Pertamakan bk yang sesuai database-->
                                <?php
                                    $idkel = $keyedit['id_kelas'];
                                    $querybk1 = mysqli_query($conn,  "SELECT user.*, pembimbing.*, kelas.*, pemkel.* FROM ((( pembimbing INNER JOIN user ON  pembimbing.id_user = user.id_user)INNER JOIN pemkel ON pembimbing.id_pembimbing = pemkel.id_pembimbing)INNER JOIN kelas ON pemkel.id_kelas = kelas.id_kelas) WHERE pembimbing.bidang ='BK' AND pemkel.id_kelas = $idkel");
                                    while ($keybk1 = mysqli_fetch_array($querybk1)) {
                                ?> 
                                    <option value="<?=$keybk1['id_pembimbing'];?>"><?=$keybk1['nama'];?></option>

                                <!--Sisa nya-->
                                <?php
                                    $idpembk1 = $keybk1['id_pembimbing']; 
                                    $querybk2 = mysqli_query($conn,  "SELECT user.*, user.nama as name, pembimbing.*, pemkel.* FROM (( pembimbing INNER JOIN user ON  pembimbing.id_user = user.id_user)INNER JOIN pemkel ON pembimbing.id_pembimbing = pemkel.id_pembimbing) WHERE pembimbing.bidang ='BK' AND pembimbing.id_pembimbing != $idpembk1 AND (pemkel.id_kelas != $idkel OR pemkel.id_kelas IS NULL)");
                                    while ($keybk2 = mysqli_fetch_array($querybk2)) { 
                                    
                                        if ($keybk2['id_kelas'] == "") {
                                            $namakelaswk = "Kosong";
                                            ?>
                                                <option value="<?=$keybk2['id_pembimbing'];?>"><?=$keybk2['name'];?> - <?=$namakelaswk?></option>
                                            <?php        
                                        }else if ($keybk2['id_kelas'] != "") {
                                            $idkelaswk = $keybk2['id_kelas'];
                                            $querynamkelwk = mysqli_query($conn, "SELECT * FROM kelas WHERE id_kelas = $idkelaswk");
                                        
                                            while ($keynamkelwk = mysqli_fetch_array($querynamkelwk)) {
                                                $namakelaswk = $keynamkelwk['nama_kelas'];
                                                ?>
                                                <option value="<?=$keybk2['id_pembimbing'];?>"><?=$keybk2['name'];?> - <?=$namakelaswk?></option>
                                                <?php
                                            } 
                                        }else{
                                            $namakelaswk = "Kosong";
                                            ?>
                                                <option value="<?=$keybk2['id_pembimbing'];?>"><?=$keybk2['name'];?> - <?=$namakelaswk?></option>
                                            <?php
                                        }
                                    } 
                                ?>
        
                            </select>
                        </div>
                        
                        <!--id bk pertama-->
                        <input type="hidden" name="bkper" value="<?php echo $keybk1['id_pembimbing']; ?>">

                        <?php
                            }
                        ?>

                        <div class="modal-footer">  
                            <button type="submit" class="btn btn-success">Ubah</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                        </div>
                        
                        <?php 
                            }
                        ?>

                    </form>
                </div>
        </div>
    </div>
</div>
<!--akhir ubah--> 

        </tr>
        <?php } ?>
        <?php } ?>
        </tbody>
</table>

<!--Simpan--> 
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Kelas</h5><br>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
                <div class="modal-body">
                    <form action="simpan_kelas.php" method="POST" enctype="multipart/form-data">
                        <!--Form Kelas-->
                        <div class="form-group">
                            <label>Kelas</label>
                            <select name="kelas" id="kelas"  class="form-control">
                                <option value="X">X</option>
                                <option value="XI">XI</option>
                                <option value="XII">XII</option>
                                <option value="XIII">XIII</option>
                            </select>
                            <br>
                            <select name="jurusan" id="jurusan" class="form-control">
                                <option kelas="RPL" value="RPL">Rekayasa Perangkat Lunak</option>
                                <option kelas="MEKA" value="MEKA">Mekatronika</option>
                                <option kelas="ANIMASI" value="ANIMASI">Animasi</option>
                                <option kelas="MULTI" value="MULTI">Multimedia</option>
                                <option kelas="MESIN" value="MESIN">Mesin</option>
                                <option kelas="KIMIA" value="KIMIA">Kimia</option>
                            </select>
                            <br>
                            <select name="abjad" id="abjad" class="form-control">
                                <option value="A">A</option>
                                <option value="B">B</option>
                                <option value="C">C</option>
                                <option value="D">D</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Wali Kelas</label>
                            <select name="wk" class="form-control">                                
                                <?php
                                    $querywk = mysqli_query($conn,  "SELECT user.* , user.nama as name , pembimbing.* , pemkel.* FROM ((user INNER JOIN pembimbing ON user.id_user = pembimbing.id_user)INNER JOIN pemkel ON pembimbing.id_pembimbing = pemkel.id_pembimbing) WHERE user.id_role = 2 AND pemkel.id_kelas IS NULL");
                                    while ($keywk = mysqli_fetch_array($querywk)) { 
                                        ?>
                                            <option value="<?=$keywk['id_pembimbing'];?>"><?=$keywk['name'];?> - Kosong</option>
                                        <?php
                                    }     
                                ?>        
                            </select>
                        </div>
                        <div class="form-group">
                            <label>BK</label>
                            <select name="bk" class="form-control">
                                <?php
                                    $querybk = mysqli_query($conn,  "SELECT user.* , user.nama as name , pembimbing.* , pemkel.* FROM ((user INNER JOIN pembimbing ON user.id_user = pembimbing.id_user)INNER JOIN pemkel ON pembimbing.id_pembimbing = pemkel.id_pembimbing) WHERE user.id_role = 1 ");
                                    while ($keybk = mysqli_fetch_array($querybk)) {
                                         
                                        if ($keybk['id_kelas'] == "") {
                                            $namakelasbk = "Kosong";
                                            ?>
                                                <option value="<?=$keybk['id_pembimbing'];?>"><?=$keybk['name'];?> - <?=$namakelasbk?></option>
                                            <?php        
                                        }else if ($keybk['id_kelas'] != "") {
                                            $idkelasbk = $keybk['id_kelas'];
                                            $querynamkelbk = mysqli_query($conn, "SELECT * FROM kelas WHERE id_kelas = $idkelasbk");
                                        
                                            while ($keynamkelbk = mysqli_fetch_array($querynamkelbk)) {
                                                $namakelasbk = $keynamkelbk['nama_kelas'];
                                                ?>
                                                <option value="<?=$keybk['id_pembimbing'];?>"><?=$keybk['name'];?> - <?=$namakelasbk?></option>
                                                <?php
                                            } 
                                        }else{
                                            $namakelasbk = "Kosong";
                                            ?>
                                                <option value="<?=$keybk['id_pembimbing'];?>"><?=$keybk['name'];?> - <?=$namakelasbk?></option>
                                            <?php
                                        }
                                    }
                                ?>  
                            </select>

                        </div>
                        <div class="modal-footer">
                            <input type="submit" class="btn btn-primary" value="Tambah" name="submit">
                        </div>
                    </form>
                </div>
        </div>
    </div>
</div>
<!--akhir simpan-->

<!--alert-->

<?php
    if (isset($_GET['pesan'])) {
        $pesan = $_GET['pesan'];

        if ($pesan == "") {
        //do nothing
        }else{
        ?>
            <script type="text/javascript">alert("<?php echo $pesan?>")</script>
        <?php
        }
    }else{
        //do nothing
    } 
?>

<!--akhir alert-->

    </div>
</div>

</div>
</div>
</body>
</html>