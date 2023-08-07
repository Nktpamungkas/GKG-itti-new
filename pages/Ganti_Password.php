<?PHP
ini_set("error_reporting", 1);
session_start();
include "koneksi.php";
$alert = '';
if ($_POST) {
    $password = $_POST['password_lama'];
    $password_baru = $_POST['password_baru'];
    $Rpassword_baru = $_POST['Rpassword_baru'];

    $get_password_sql = mysqli_query($con,"SELECT * from tbl_user where `id_user` =  '$_SESSION[id_user]'");
    $get_password = mysqli_fetch_array($get_password_sql);

    if ($password != $get_password['password']) {
        $alert = '<div class="alert alert-danger" role="alert">
                    Password Anda Salah !
                  </div>';
    } else {
        if ($password_baru != $Rpassword_baru) {
            $alert = '<div class="alert alert-danger" role="alert">
                        Password baru anda tidak match !
                      </div>';
        } else {
            $sqlupdate = mysqli_query($con,"UPDATE `tbl_user` SET
                                     `password` = '$Rpassword_baru'
                                     WHERE `id_user`='$_SESSION[id_user]'");
            $sqlupdate;
            $alert = '<div class="alert alert-success" role="alert">
                        Password berhasil di rubah <i class="fa fa-check"></i>
                      </div>';
        }
    }
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Schedule</title>
</head>

<body>
    <div class="row">
        <div class="container">
            <div class="form-group row">
                <label for="inputPassword" class="col-sm-12 col-form-label bg-primary" style="text-align: center;">
                    <h2>Ganti Password</h2>
                </label>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="container">
            <?php echo $alert ?>
            <form action="" method="post" autocomplete="off">
                <div class="form-group row">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Password Lama</label>
                    <div class="col-sm-5">
                        <input type="password" minlength="5" autofocus required name="password_lama" class="form-control" placeholder="Password" autocomplete="off">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Password Baru</label>
                    <div class="col-sm-5">
                        <input type="password" minlength="5" autocomplete="off" required name="password_baru" class="form-control" placeholder="New Password">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Ulang Password Baru</label>
                    <div class="col-sm-5">
                        <input type="password" minlength="5" autocomplete="off" name="Rpassword_baru" class="form-control" placeholder="Repeat Password">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputPassword" required class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-5">
                        <button class="btn btn-info" type="submit">Change Password</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>

</html>