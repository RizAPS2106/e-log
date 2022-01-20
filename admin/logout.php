<?php
session_start();  //aktifkan session
session_destroy();  //hapus semua session
header("location:login.php?pesan=logout");  //mengalihhkan halaman dan mengirim pesn
?>