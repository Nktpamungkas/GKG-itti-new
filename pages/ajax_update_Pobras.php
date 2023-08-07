<?php
ini_set("error_reporting", 1);
session_start();
include("../koneksi.php");


$sql_ = mysqli_query($con,"SELECT * from tbl_gerobak where id_schedule = '$_POST[id]' LIMIT 1");
$count = mysqli_num_rows($sql_);

if ($count > 0) {
    mysqli_query($con,"UPDATE `tbl_schedule` SET
    `petugas_obras`='$_POST[petugas_obras]'
    WHERE `id`='$_POST[id]'");
} else {
    mysqli_query($con,"UPDATE `tbl_schedule` SET 
    `tgl_stop`= now(),				
    `petugas_obras` = '$_POST[petugas_obras]',
    `tgl_update` = now()
    WHERE `id` = '$_POST[id]'");
}

$response = 'berhasil update row 1';
echo json_encode($response);
