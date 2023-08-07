<?php
ini_set("error_reporting", 1);
session_start();
include "../../koneksi.php";

$date = date('Y-m-d');

$sql_ = mysqli_query($con,"SELECT * from tbl_footer_cetak 
                    where `date_start` = '$_POST[date_start]' 
                    and `date_end` = '$_POST[date_end]' 
                    and `group` = '$_POST[group]' 
                    and shift = '$_POST[shift]' LIMIT 1");
$count = mysqli_num_rows($sql_);

if ($count > 0) {
    $data = mysqli_fetch_array($sql_);
    mysqli_query($con,"UPDATE tbl_footer_cetak set 
                 `leader_2` = '$_POST[leader_2]',
                 `tgl_center` =  '$date'
                 where `id` = $data[id]");
} else {
    mysqli_query($con,"INSERT into tbl_footer_cetak set 
                `date_start` = '$_POST[date_start]',
                `date_end` = '$_POST[date_end]',
                `group` = '$_POST[group]',
                `shift` = '$_POST[shift]',
                `leader_2` = '$_POST[leader_2]',
                `tgl_center` = '$date',
                `inserted_at` = now(),
                `inserted_by` = '$_SESSION[nama1Gkg]'
    ");
}

$response = array(
    "msg" => "SUCCESS",
    "tgl" => date('Y-m-d'),
    "leader" => $_POST['leader_2']
);

echo json_encode($response);
