<?PHP
ini_set("error_reporting", 1);
session_start();
include "../../koneksi.php";
$time = date('Y-m-d H:i:s');

mysqli_query($con,"UPDATE tbl_schedule SET bruto = '$_POST[value]' where id = '$_POST[pk]'");

echo json_encode('success');
