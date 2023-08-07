<?php
ini_set("error_reporting", 1);
session_start();
include("../koneksi.php");

$sql_ = mysqli_query($con,"SELECT * from tbl_gerobak where id_schedule = '$_POST[id]' LIMIT 1");
$count = mysqli_num_rows($sql_);

if ($count > 0) {
    mysqli_query($con,"UPDATE `tbl_gerobak` SET
            `no_gerobak7` = '$_POST[gerobak]',
            `tgl_out7` = now()
            WHERE `id_schedule`='$_POST[id]' LIMIT 1 ");
} else {
    mysqli_query($con,"INSERT INTO `tbl_gerobak` SET
                `id_schedule` = '$_POST[id]',
                `no_gerobak7`= '$_POST[gerobak]' ,
                `tgl_out7` = now()
                ");
}
$response = 'berhasil update row 1';
echo json_encode($response);
