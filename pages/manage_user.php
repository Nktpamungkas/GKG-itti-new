<?PHP
ini_set("error_reporting", 1);
session_start();
include "koneksi.php";
$sql_user = mysqli_query($con,"SELECT id_user, nama, `level`, dept, jabatan, `status` from tbl_user order by id_user DESC");

// handle add
if ($_POST['submit']) {
    $a = mysqli_query($con,"SELECT max(id_user) as maxid FROM tbl_user");
    $b = mysqli_fetch_array($a);
    $c = intval(substr($b['maxid'], 3, 6));
    $d = $c + 1;
    $id = 'USR0' . $d;
    mysqli_query($con,"INSERT into tbl_user (id_user, nama, `level`, dept, jabatan, `status`, foto, akses, `password`) 
                values ('$id', '$_POST[Nama]', '$_POST[Level]', '$_POST[Dept]', '$_POST[Jabatan]', '$_POST[Status]', 'avatar', 'biasa', '123456')");
    echo '<script>window.location="manage_user"</script>';
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    table thead tr th {
        text-align: center;
    }

    table thead tr th,
    table tbody tr td {
        border-bottom: 1px solid #515357 !important;
    }

    tr:hover {
        background-color: #ffff99;
    }
</style>

<body>

</body>
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <br />
            <div style="margin-left: 15px;">
                <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal">
                    <i class="fa fa-plus-circle"></i> &nbsp;Add New User
                </button>
            </div>
            <p></p>
            <table class="display compact nowrap table table-sm table-bordered" id="tbl_user" width="100%">
                <thead>
                    <tr style="background: #72e8de;">
                        <th width="20">#</th>
                        <th>NAMA</th>
                        <th>LEVEL</th>
                        <th>DEPT</th>
                        <th>JABATAN</th>
                        <th>STATUS</th>
                        <th width="20">ACTION</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    while ($users = mysqli_fetch_array($sql_user)) { ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $users['nama'] ?></td>
                            <td><?php echo $users['level'] ?></td>
                            <td><?php echo $users['dept'] ?></td>
                            <td><?php echo $users['jabatan'] ?></td>
                            <td align="center"><?php if ($users['status'] == 'Aktif') {
                                                    echo '<span class="label label-success">' . $users['status'] . '</span>';
                                                } else {
                                                    echo '<span class="label label-default">' . $users['status'] . '</span>';
                                                } ?></td>
                            <td>
                                <button type="button" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#Modaledit<?php echo  $users['id_user']  ?>"><i class="fa fa-pencil"></i></button>

                                <?php if ($users['status'] == 'Aktif') { ?>
                                    <button type="button" class="btn btn-success btn-xs" data-attribute="<?php echo $users['id_user'] ?>"><i class="fa fa-toggle-on" aria-hidden="true"></i>
                                    </button>
                                <?php } else { ?>
                                    <button class="btn btn-danger btn-xs" data-attribute="<?php echo  $users['id_user'] ?>"><i class="fa fa-toggle-off" aria-hidden="true"></i>
                                    </button>
                                <?php } ?>
                            </td>
                        </tr>
                        <!-- modal -->
                        <div class="modal fade" id="Modaledit<?php echo $users['id_user'] ?>" data-backdrop="static" keyboard="false" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel">Edit User <?php echo $users['nama'] ?></h4>
                                    </div>
                                    <form action="pages/edit_user_data.php" method="post">
                                        <input type="hidden" value="<?php echo $users['id_user'] ?>" name="id">
                                        <div class="modal-body">
                                            <div class="form-group" style="border-bottom: 1px solid black;">
                                                <label for="Nama">Nama</label>
                                                <input required type="text" title="Nama" value="<?php echo $users['nama'] ?>" class="form-control" name="Nama" id="Nama" placeholder="Nama...">
                                            </div>
                                            <div class="form-group" style="border-bottom: 1px solid black;">
                                                <label for="Level">Level</label>
                                                <input required type="text" title="Level" value="USER" readonly="true" class="form-control" name="Level" id="Level" placeholder="Level...">
                                            </div>
                                            <div class="form-group" style="border-bottom: 1px solid black;">
                                                <label for="Dept">Departement</label>
                                                <input required type="text" value="<?php echo $users['dept'] ?>" title="Dept" class="form-control" name="Dept" id="Dept" placeholder="Dept...">
                                            </div>
                                            <div class="form-group" style="border-bottom: 1px solid black;">
                                                <label for="Jabatan">Jabatan</label>
                                                <input required type="text" title="Jabatan" class="form-control" name="Jabatan" id="Jabatan" placeholder="Jabatan..." value="<?php echo $users['jabatan'] ?>">
                                            </div>
                                            <div class="form-group" style="border-bottom: 1px solid black;">
                                                <label for="Status">Status</label>
                                                <select type="text" required title="Status" class="form-control" name="Status" id="Status" placeholder="Status...">
                                                    <option <?php if ($users['status'] == 'Aktif') echo "selected" ?> value="Aktif">Aktif</option>
                                                    <option <?php if ($users['status'] == 'Non-Aktif') echo "selected" ?> value="Non-aktif">Non-Aktif</option>
                                                </select>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                <button type="submit" name="submit" value="edit" class="btn btn-primary">Save</button>
                                            </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- //modal -->
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- MODAL ADD -->
<div class="modal fade" id="myModal" data-backdrop="static" keyboard="false" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Add New User</h4>
            </div>
            <form action="" method="post">
                <div class="modal-body">
                    <div class="form-group" style="border-bottom: 1px solid black;">
                        <label for="Nama">Nama</label>
                        <input required type="text" title="Nama" class="form-control" name="Nama" id="Nama" placeholder="Nama...">
                    </div>
                    <div class="form-group" style="border-bottom: 1px solid black;">
                        <label for="Level">Level</label>
                        <input required type="text" title="Level" value="USER" readonly="true" class="form-control" name="Level" id="Level" placeholder="Level...">
                    </div>
                    <div class="form-group" style="border-bottom: 1px solid black;">
                        <label for="Dept">Departement</label>
                        <input required type="text" title="Dept" class="form-control" name="Dept" id="Dept" placeholder="Dept...">
                    </div>
                    <div class="form-group" style="border-bottom: 1px solid black;">
                        <label for="Jabatan">Jabatan</label>
                        <input required type="text" title="Jabatan" class="form-control" name="Jabatan" id="Jabatan" placeholder="Jabatan...">
                    </div>
                    <div class="form-group" style="border-bottom: 1px solid black;">
                        <label for="Status">Status</label>
                        <select type="text" required title="Status" class="form-control" name="Status" id="Status" placeholder="Status...">
                            <option selected disabled>Pilih status ...</option>
                            <option value="Aktif">Aktif</option>
                            <option value="Non-aktif">Non-Aktif</option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" name="submit" value="add" class="btn btn-primary">Save</button>
                    </div>
            </form>
        </div>
    </div>
</div>

</html>
<script>
    $(document).ready(function() {
        $('#tbl_user').DataTable({
            select: true,
        });

        $('.btn.btn-success.btn-xs').click(function() {
            var id = $(this).attr('data-attribute')
            var confirmm = confirm("Anda Akan Menon-aktifkan user ini, apakah anda yakin ?");
            if (confirmm) {
                $.ajax({
                    dataType: "json",
                    type: "POST",
                    url: 'pages/ajax_nonaktifkan_user.php',
                    data: {
                        id: id
                    },
                    success: function(response) {
                        toastr.success('User telah di non-aktifkan');
                        location.reload()
                    },
                    error: function() {
                        alert("Error");
                    }
                });
            }
        })
        $('.btn.btn-danger.btn-xs').click(function() {
            var id = $(this).attr('data-attribute')
            var confirmm = confirm("Anda Akan Mengaktifkan user ini, apakah anda yakin ?");
            if (confirmm) {
                $.ajax({
                    dataType: "json",
                    type: "POST",
                    url: 'pages/ajax_aktifkan_user.php',
                    data: {
                        id: id
                    },
                    success: function(response) {
                        toastr.success('User telah di aktifkan');
                        location.reload()
                    },
                    error: function() {
                        alert("Error");
                    }
                });
            }
        })
    });
</script>