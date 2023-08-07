<?php
ini_set("error_reporting", 1);
session_start();
include("../koneksi.php");
$id = mysqli_real_escape_string($con,$_POST['id']);
$selesai_by = mysqli_real_escape_string($con,$_POST['selesai_by']);
// $no_gerobak = mysqli_real_escape_string($_POST['gerobak']);
// $petugas_obras = mysqli_real_escape_string($_POST['petugas_obras']);
// $catatan = mysqli_real_escape_string($_POST['catatan']);
// $istirahat = mysqli_real_escape_string($_POST['istirahat']);
$Qrycek = mysqli_query($con,"SELECT * FROM tbl_schedule WHERE id='$id' LIMIT 1");
$rCek = mysqli_fetch_array($Qrycek);
$sqlupdate = mysqli_query($con,"UPDATE `tbl_produksi` SET 
				`catatan`=' ',
				`status`='selesai'
				WHERE `id_schedule`='$id' LIMIT 1");

$sqlupdate1 = mysqli_query($con,"UPDATE `tbl_schedule` SET 
				`status`='selesai',
				`tgl_stop`=now(),
				`selesai_by`= '$selesai_by',				
				`istirahat`=' '
				WHERE `id`='$id' LIMIT 1");

$sqlinsert3 = mysqli_query($con,"UPDATE `tbl_gerobak` SET
					`kd_status` = 'selesai'
					WHERE `id_schedule`='$id' LIMIT 1
					");


$sqlUrut = mysqli_query($con,"UPDATE tbl_schedule 
		  		SET no_urut = no_urut - 1 
				WHERE no_mesin = '$rCek[no_mesin]' 
		  		AND `status` = 'antri mesin' AND not no_urut='1' ");

echo " <script>window.location='Scheduleongoing';</script>";
