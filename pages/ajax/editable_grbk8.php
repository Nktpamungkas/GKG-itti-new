<?PHP
session_start();
include "../../koneksi.php";
$time = date('Y-m-d H:i:s');
mysqli_query($con,"UPDATE tbl_gerobak SET no_gerobak8 = '$_POST[value]' where id = '$_POST[pk]'");
echo json_encode('success');
