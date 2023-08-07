<?PHP
ini_set("error_reporting", 1);
session_start();
include "koneksi.php";
$sql_mesin = mysqli_query($con,"SELECT * from history_status_mesin order by id desc limit 100");
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
        /* border-spacing: 0; */
        border: 1px solid #515357 !important;
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
                    <i class="fa fa-plus-circle"></i> &nbsp;Add New Mesin
                </button>
            </div>
            <p></p>
            <table class="display compact nowrap" id="tbl_mesin" width="100%">
                <thead>
                    <tr style="background: #070721; color: white;">
                        <th width="20">#</th>
                        <th>No. Mesin</th>
                        <th>Status</th>
                        <th>Tanggal Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    while ($mesins = mysqli_fetch_array($sql_mesin)) { ?>
                        <tr>
                            <td width=""><?php echo $no++; ?></td>
                            <td align="center" style="font-style: italic;"><b><?php echo $mesins['no_mesin'] ?></b></td>
                            <td align="center">Change To :&nbsp;
                                <?php if ($mesins['status'] == 'Normal') { ?>
                                    <span class="label label-success"><?php echo $mesins['status'] ?></span>
                                <?php } else if ($mesins['status'] == 'OFF') { ?>
                                    <span class="label label-default"><?php echo $mesins['status'] ?></span>
                                <?php } else { ?>
                                    <span class="label label-danger"><?php echo $mesins['status'] ?></span>
                                <?php } ?>
                            </td>
                            <td align="center"><?php echo $mesins['date_status'] ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

</html>
<script>
    $(document).ready(function() {
        $('#tbl_mesin').DataTable({
            search: true,
            "pageLength": 20,
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        });
    });
</script>