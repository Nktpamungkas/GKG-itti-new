<?PHP
ini_set("error_reporting", 1);
session_start();
include "../koneksi.php";

mysqli_query($con,"DELETE FROM tbl_schedule where id = '$_POST[id]'");
mysqli_query($con,"DELETE FROM tbl_gerobak where id_schedule = '$_POST[id]'");

$response = 'berhasil update row 1';
echo json_encode($response);
