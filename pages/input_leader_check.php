<?php
ini_set("error_reporting", 1);
require("../koneksi.php");
$sql_update = mysqli_query($con,"UPDATE `tbl_schedule` SET 
				`leader_check`='TRUE',
                `approve_by`= '$_POST[nama]',
                `approve_time`= now()
                WHERE `id`='$_POST[id]'");
$sql_update;
$response = array(
    'code' => '200',
    'message' => 'Schedule was approved !',
    'id' => $id
);
echo json_encode($response);
