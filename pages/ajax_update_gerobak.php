<?php
ini_set("error_reporting", 1);
session_start();
include("../koneksi.php");
$id = mysqli_real_escape_string();
$no_gerobak = mysqli_real_escape_string($con,$_POST['gerobak']);
$petugas_obras = mysqli_real_escape_string($con,$_POST['petugas_obras']);
$Qrycek = mysqli_query($con,"SELECT * FROM tbl_schedule WHERE id='$id' LIMIT 1");
$rCek = mysqli_fetch_array($Qrycek);
$sqlupdate = mysqli_query($con,"UPDATE `tbl_produksi` SET 
            `status`='selesai'
            WHERE `id_schedule`='$_POST[id]' LIMIT 1");

mysqli_query($con,"UPDATE `tbl_schedule` SET 
            `tgl_stop`= now(),				
            `petugas_obras` = '$_POST[petugas_obras]',
            `tgl_update` = now()
            WHERE `id` = '$_POST[id]'");

$sqlinsert2 = mysqli_query($con,"INSERT INTO `tbl_gerobak` SET
                `id_schedule` = '$_POST[id]',
                `no_gerobak1`= '$_POST[gerobak]' ,
                `tgl_out1` = now()
                ");

$sqlUrut = mysqli_query($con,"UPDATE tbl_schedule 
              SET no_urut = no_urut - 1 
            WHERE no_mesin = '$rCek[no_mesin]' 
              AND `status` = 'antri mesin' AND not no_urut='1' ");
$response = 'berhasil update row 1';
$sqlupdate;
$sqlupdate1;
$sqlinsert2;
$sqlUrut;
echo json_encode($response);
