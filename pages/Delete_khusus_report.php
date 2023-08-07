<?php
ini_set("error_reporting", 1);
session_start();
include "koneksi.php";
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title></title>
</head>
<style>
    #table_Report td.details-control {
        background: url('bower_components/datatables.net/img/details_open.png') no-repeat center center;
        cursor: pointer;
    }

    #table_Report tr.shown td.details-control {
        background: url('bower_components/datatables.net/img/details_close.png') no-repeat center center;
    }

    #table_Report tr:hover {
        background-color: rgb(151, 170, 212);
    }
</style>

<body>
    <?php
    if (!empty($_POST["submit"])) {
        $nodemand = $_POST['nodemand'];
        $data = mysqli_query($con,"SELECT a.id, b.id as id_tbl_grbk , a.no_mesin, a.no_urut, a.buyer, a.langganan, a.no_order, a.nokk, a.nodemand, a.jenis_kain,
        a.warna, a.no_warna, sum(a.rol) as rol, sum(a.bruto) as bruto, a.proses, a.`status`, a.lot, a.catatan, a.ket_status, 
        a.tgl_delivery, a.create_time, a.tgl_mulai, a.tgl_update, a.tgl_stop, a.approve_time, b.no_gerobak1, b.tgl_out1, b.no_gerobak2, b.tgl_out2, b.no_gerobak3, b.tgl_out3, b.no_gerobak4, 
        b.tgl_out4, b.no_gerobak5, b.tgl_out5, b.no_gerobak6, b.tgl_out6, a.petugas_buka, a.approve_by, a.create_by, a.selesai_by, a.dept_tujuan, a.pic_schedule
        FROM tbl_schedule a
        join tbl_gerobak b on a.id = b.id_schedule
        WHERE a.`status` = 'selesai' AND a.leader_check = 'TRUE' and a.nodemand = '$nodemand'
        GROUP BY a.nodemand, a.proses, a.no_mesin, a.no_urut
        ORDER by a.tgl_stop DESC");
    } else {
        $data = mysqli_query($con,"SELECT a.id, b.id as id_tbl_grbk , a.no_mesin, a.no_urut, a.buyer, a.langganan, a.no_order, a.nokk, a.nodemand, a.jenis_kain,
        a.warna, a.no_warna, sum(a.rol) as rol, sum(a.bruto) as bruto, a.proses, a.`status`, a.lot, a.catatan, a.ket_status, 
        a.tgl_delivery, a.create_time, a.tgl_mulai, a.tgl_update, a.tgl_stop, a.approve_time, b.no_gerobak1, b.tgl_out1, b.no_gerobak2, b.tgl_out2, b.no_gerobak3, b.tgl_out3, b.no_gerobak4, 
        b.tgl_out4, b.no_gerobak5, b.tgl_out5, b.no_gerobak6, b.tgl_out6, a.petugas_buka, a.approve_by, a.create_by, a.selesai_by, a.dept_tujuan, a.pic_schedule
        FROM tbl_schedule a
        join tbl_gerobak b on a.id = b.id_schedule
        WHERE a.`status` = 'selesai' AND a.leader_check = 'TRUE' and DATE_FORMAT(a.tgl_update,'%Y-%m-%d') = '2002-01-01'
        GROUP BY a.nodemand, a.proses, a.no_mesin, a.no_urut
        ORDER by a.tgl_stop DESC");
    }
    $no = 1;
    $n = 1;
    $c = 0;
    ?>
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <div class="container col-sm-10">
                        <div class="form-group row">
                            <form action="" method="post">
                                <div class="col-sm-3">
                                    <div class="input-group date">
                                        <div class=" input-group-addon"> <i class="fa fa-briefcase" aria-hidden="true"></i>
                                        </div>
                                        <input required class="form-control input-sm" type="text" autocomplete="off" name="nodemand" placeholder="Masukan No Demand" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-2">
                                        <button type="submit" name="submit" value="submit" class="btn btn-success btn-sm"> <i class="fa fa-search"></i> Search</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div>
                        <a href="<?php if (!empty($_POST['submit'])) {
                                        echo 'pages/cetak/cetak_schedule_bydate.php';
                                    } else {
                                        echo 'pages/cetak/cetak_schedule.php';
                                    } ?>" target="_blank" class="btn btn-danger pull-right" target="_blank"><i class="fa fa-print"></i> Cetak</a>
                    </div>
                </div>
                <div class="box-body">
                    <table id="table_Report" class="table table-bordered table-hover table-striped display compact" width="100%">
                        <thead class="bg-blue">
                            <tr>
                                <th width="10">
                                    #
                                </th>
                                <th width="5">
                                    hidden number
                                </th>
                                <th width="24">
                                    <div align="center">Mesin/Urut</div>
                                </th>
                                <th width="162">
                                    <div align="center">Pelanggan</div>
                                </th>
                                <th width="118">
                                    <div align="center">No. Order</div>
                                </th>
                                <th width="122">
                                    <div align="center">Item</div>
                                </th>
                                <th width="86">
                                    <div align="center">Warna</div>
                                </th>
                                <th width="46">
                                    <div align="center">Rol</div>
                                </th>
                                <th width="48">
                                    <div align="center">Kg</div>
                                </th>
                                <th width="38">
                                    <div align="center">Lot</div>
                                </th>
                                <th>
                                    <div align="center">Delivery</div>
                                </th>
                                <th width="79">
                                    <div align="center">No. Kartu</div>
                                </th>
                                <th class="12">gerobak 1</th>
                                <th class="13">out gerobak 1</th>
                                <th class="14">gerobak 2</th>
                                <th class="15">out gerobak 2</th>
                                <th class="16">gerobak 3</th>
                                <th class="17">out gerobak 3</th>
                                <th class="18">gerobak 4</th>
                                <th class="19">out gerobak 4</th>
                                <th class="20">gerobak 5</th>
                                <th class="21">out gerobak 5</th>
                                <th class="22">gerobak 6</th>
                                <th class="23">out gerobak 6</th>
                                <th class="24">id</th>
                                <th class="25">create_time</th>
                                <th class="26">tgl_mulai</th>
                                <th class="27">tgl_update</th>
                                <th class="28">tgl_stop</th>
                                <th class="29">approve_time</th>
                                <th class="30">petugas_buka</th>
                                <th class="31">approve_by</th>
                                <th class="32">create_by</th>
                                <th class="33">selesai_by</th>
                                <th class="34">Procs/To</th>
                                <th class="35">PIC</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $col = 0;
                            $no = 1;
                            while ($rowd = mysqli_fetch_array($data)) {
                                $bgcolor = ($col++ & 1) ? 'gainsboro' : 'antiquewhite';
                                // $qCek = mysqli_query($con,"SELECT `status` FROM tbl_fin_oven WHERE id_schedule='$rowd[id]' LIMIT 1");
                                // $rCEk = mysqli_fetch_array($qCek);
                            ?>
                                <tr bgcolor="<?php echo $bgcolor; ?>">
                                    <td class="details-control"></td>
                                    <td align="center">
                                        <?php echo $no ?>
                                    </td>
                                    <td align="center">
                                        <?php echo $rowd['no_mesin'] . ' / ' . $rowd['no_urut']; ?> /
                                        <button class="btn btn-xs btn-info disabled" disabled><?php echo $rowd['status']; ?></button>
                                        <br>
                                        <li <?php if ($_SESSION['lvl_idGkg'] == "USER") echo "style='display:none;'"; ?>><a href="index1.php?p=schedule_edit_admin&id=<?php echo $rowd['id']; ?>" id='
                                                <?php echo $rowd['id']; ?>' style="color: black;" class="btn btn-xs btn-warning schedule_edit <?php if ($_SESSION['lvl_idGkg'] == "USER") echo " disabled"; ?>">
                                                <i class="fa fa-edit"></i>
                                            </a></li>
                                        <li <?php if ($_SESSION['lvl_idGkg'] == "USER") echo "style='display:none;'"; ?>>
                                            <button style="color: black;" class="btn btn-xs btn-danger _delete_task" data-id="<?php echo $rowd['id'] ?>" data="<?php echo $rowd['nodemand']; ?>">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </li>
                                    </td>
                                    <td><?php echo $rowd['langganan'] . "/" . $rowd['buyer']; ?></td>
                                    <td align="center"><?php echo $rowd['no_order']; ?></td>
                                    <td><?php echo $rowd['jenis_kain']; ?></td>
                                    <td align="center"><?php echo $rowd['warna']; ?></td>
                                    <td align="center">
                                        <a data-pk="<?php echo $rowd['id'] ?>" data-value="<?php echo $rowd['rol'] ?>" id="roll_id" href="javascipt:void(0)"><?php echo $rowd['rol'] ?></a>
                                    </td>
                                    <td align="center"><a data-pk="<?php echo $rowd['id'] ?>" data-value="<?php echo $rowd['bruto'] ?>" id="bruto_id" href="javascipt:void(0)"><?php echo $rowd['bruto'] ?></a></td>
                                    <td align="center"><?php echo $rowd['lot']; ?> <br> <?php echo $rowd['nodemand']; ?></td>
                                    <td align="center" width="20"><?php echo $rowd['tgl_delivery']; ?></td>
                                    <td><i><?php echo $rowd['nodemand']; ?></i><br />
                                        <i style="color:red;"><strong><?php echo $rowd['catatan']; ?></strong></i><br />
                                        <a href="#" id='<?php echo $rowd['id']; ?>' class="detail_kartu"><span class="label label-danger"><?php echo $rowd['ket_kartu']; ?></span></a>
                                    </td>
                                    <td class="12">
                                        <a data-pk="<?php echo $rowd['id_tbl_grbk'] ?>" data-value="<?php echo  $rowd['no_gerobak1'] ?>" id="grbk1_id" href="javascipt:void(0)"><?php echo  $rowd['no_gerobak1'] ?></a>
                                    </td>
                                    <td class="13"><?php echo  $rowd['tgl_out1'] ?></td>
                                    <td class="14">
                                        <a data-pk="<?php echo $rowd['id_tbl_grbk'] ?>" data-value="<?php echo  $rowd['no_gerobak2'] ?>" id="grbk2_id" href="javascipt:void(0)"><?php echo  $rowd['no_gerobak2'] ?></a>
                                    </td>
                                    <td class="15"><?php echo  $rowd['tgl_out2'] ?></td>
                                    <td class="16">
                                        <a data-pk="<?php echo $rowd['id_tbl_grbk'] ?>" data-value="<?php echo  $rowd['no_gerobak3'] ?>" id="grbk3_id" href="javascipt:void(0)"><?php echo  $rowd['no_gerobak3'] ?></a>
                                    </td>
                                    <td class="17"><?php echo  $rowd['tgl_out3'] ?></td>
                                    <td class="18"><a data-pk="<?php echo $rowd['id_tbl_grbk'] ?>" data-value="<?php echo  $rowd['no_gerobak4'] ?>" id="grbk4_id" href="javascipt:void(0)"><?php echo  $rowd['no_gerobak4'] ?></a></td>
                                    <td class="19"><?php echo  $rowd['tgl_out4'] ?></td>
                                    <td class="20"><a data-pk="<?php echo $rowd['id_tbl_grbk'] ?>" data-value="<?php echo  $rowd['no_gerobak5'] ?>" id="grbk5_id" href="javascipt:void(0)"><?php echo  $rowd['no_gerobak5'] ?></a></td>
                                    <td class="21"><?php echo  $rowd['tgl_out5'] ?></td>
                                    <td class="22"><a data-pk="<?php echo $rowd['id_tbl_grbk'] ?>" data-value="<?php echo  $rowd['no_gerobak6'] ?>" id="grbk6_id" href="javascipt:void(0)"><?php echo  $rowd['no_gerobak6'] ?></a></td>
                                    <td class="23"><?php echo  $rowd['tgl_out6'] ?></td>
                                    <td class="24"><?php echo  $rowd['id'] ?></td>
                                    <td class="25"><?php echo $rowd['create_time'] ?></td>
                                    <td class="26"><?php echo $rowd['tgl_mulai'] ?></td>
                                    <td class="27"><?php echo $rowd['tgl_update'] ?></td>
                                    <td class="28"><?php echo $rowd['tgl_stop'] ?></td>
                                    <td class="29"><?php echo $rowd['approve_time'] ?></td>
                                    <th class="30"><?php echo $rowd['petugas_buka'] ?></th>
                                    <th class="31"><?php echo $rowd['approve_by'] ?></th>
                                    <th class="32"><?php echo $rowd['create_by'] ?></th>
                                    <th class="33"><?php echo $rowd['selesai_by'] ?></th>
                                    <td class="34"> <span class="badge badge-dark"><?php echo $rowd['proses']; ?></span> /
                                        <span class="label label-info"><?php echo $rowd['dept_tujuan']; ?></span>
                                    </td>
                                    <td class="35"><?php echo $rowd['pic_schedule'] ?></td>
                                </tr>
                            <?php
                                $no++;
                            } ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
<script type="text/javascript">
    $(document).ready(function() {
        $("._delete_task").click(function() {
            var nodemand = $(this).attr('data');
            var id = $(this).attr('data-id');
            if (confirm('Are you sure, to delete task ' + nodemand + ' ?')) {
                $.ajax({
                    type: 'POST',
                    url: 'pages/delete_task_on_leader_check.php',
                    data: {
                        nodemand: nodemand,
                        id: id
                    },
                    dataType: 'json',
                    success: function(response) {
                        location.reload();
                    },
                    error: function() {
                        swal({
                            title: 'Error !',
                            text: 'Hubungi DIT secepatnya',
                            type: 'warning'
                        })
                    }
                });
            } else {
                console.log('Thing was not saved to the database.');
            }

        })
    })
</script>
<script type="text/javascript">
    $(document).ready(function() {
        var table = $('#table_Report').DataTable({
            responsive: true,
            dom: 'Bfrtip',
            buttons: [
                'copyHtml5',
                'excelHtml5',
                'csvHtml5',
                'pdfHtml5'
            ],
            "columnDefs": [{
                    "className": "align-center",
                    "targets": [0]
                },
                {
                    "targets": [1, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33],
                    "visible": false
                },
                {
                    "targets": [0, 1, 2],
                    "orderable": false
                }
            ]
        });

        $('#table_Report tbody').on('click', 'td.details-control', function() {
            var tr = $(this).parents('tr');
            var row = table.row(tr);

            if (row.child.isShown()) {
                // This row is already open - close it
                row.child.hide();
                tr.removeClass('shown');
            } else {
                // Open this row (the format() function would return the data to be shown)
                row.child(format(row.data())).show();
                tr.addClass('shown');
            }
        });

        $('#table_Report tbody').on('click', 'tr', function() {
            $(this).toggleClass('selected');
        });

        function format(d) {
            return '<div class="col-md-12" style="background: #97aad4;">' +
                '<div class="container-fluid">' +
                '<table class="table table-bordered table-striped" width="100%">' +
                '<thead>' +
                '<tr style="background-color: blueviolet; border: 1px solid black;">' +
                '<th class="text-center" style="color: white; border: 1px solid black;">Waktu Buat / Oleh</th>' +
                '<th class="text-center" style="color: white; border: 1px solid black;">Waktu Mulai / Oleh</th>' +
                '<th class="text-center" style="color: white; border: 1px solid black;">Waktu Selesai / Oleh</th>' +
                '<th class="text-center" style="color: white; border: 1px solid black;">Waktu Approve / Oleh</th>' +
                '<th class="text-center" style="color: white; border: 1px solid black;">Delivery KK</th>' +
                '</tr>' +
                '</thead>' +
                '<tbody>' +
                '<tr style="border: 1px solid black;">' +
                '<td style="border: 1px solid black;">' + d[25] + ' / ' + d[32] + '</td>' +
                '<td style="border: 1px solid black;">' + d[26] + ' / ' + d[30] + '</td>' +
                '<td style="border: 1px solid black;">' + d[28] + ' / ' + d[33] + '</td>' +
                '<td style="border: 1px solid black;">' + d[29] + ' / ' + d[31] + '</td>' +
                '<td style="border: 1px solid black;">' + d[10] + '</td>' +
                '</tr>' +
                '</tbody>' +
                '</table>' +
                '<hr class="divider">' +

                // 
                '<table class="table table-sm table-striped table-bordered" id="tablee" width="100%" style="margin-top: 10px;">' +
                '<tbody>' +
                // 1
                '<tr style="border: 1px solid black;">' +
                '<th class="bg-primary" style="border: 1px solid black; width: 100px;">Gerobak 1 :</th>' +
                '<td align="center" style="border: 1px solid black;">' + d[12] + '</td>' +
                '<th class="bg-primary" style="border: 1px solid black; width: 100px;">Out Gerobak 1 :</th>' +
                '<td align="center" style="border: 1px solid black;">' + d[13] + '</td>' +
                '<td align="center" style="border: 1px solid black; width: 100px"><a href="pages/cetak/iden_produk.php?id=' + d[24] + '" class="btn btn-xs btn-danger" target="_blank"><i class="fa fa-print"></i> gerobak 1</a></td>' +
                '</tr>' +
                // 2
                '<tr style="border: 1px solid black;">' +
                '<th class="bg-primary" style="border: 1px solid black; width: 100px;">Gerobak 2 :</th>' +
                '<td align="center" style="border: 1px solid black;">' + d[14] + '</td>' +
                '<th class="bg-primary" style="border: 1px solid black; width: 100px;">Out Gerobak 2 :</th>' +
                '<td align="center" style="border: 1px solid black;">' + d[15] + '</td>' +
                '<td align="center" style="border: 1px solid black; width: 100px"><a href="pages/cetak/iden_produk2.php?id=' + d[24] + '" class="btn btn-xs btn-danger" target="_blank"><i class="fa fa-print"></i> gerobak 2</a></td>' +
                '</tr>' +
                // 3
                '<tr style="border: 1px solid black;">' +
                '<th class="bg-primary" style="border: 1px solid black; width: 100px;">Gerobak 3 :</th>' +
                '<td align="center" style="border: 1px solid black;">' + d[16] + '</td>' +
                '<th class="bg-primary" style="border: 1px solid black; width: 100px;">Out Gerobak 3 :</th>' +
                '<td align="center" style="border: 1px solid black;">' + d[17] + '</td>' +
                '<td align="center" style="border: 1px solid black; width: 100px"><a href="pages/cetak/iden_produk3.php?id=' + d[24] + '" class="btn btn-xs btn-danger" target="_blank"><i class="fa fa-print"></i> gerobak 3</a></td>' +
                '</tr>' +
                // 4
                '<tr style="border: 1px solid black;">' +
                '<th class="bg-primary" style="border: 1px solid black; width: 100px;">Gerobak 4 :</th>' +
                '<td align="center" style="border: 1px solid black;">' + d[18] + '</td>' +
                '<th class="bg-primary" style="border: 1px solid black; width: 100px;">Out Gerobak 4 :</th>' +
                '<td align="center" style="border: 1px solid black;">' + d[19] + '</td>' +
                '<td align="center" style="border: 1px solid black; width: 100px"><a href="pages/cetak/iden_produk4.php?id=' + d[24] + '" class="btn btn-xs btn-danger" target="_blank"><i class="fa fa-print"></i> gerobak 4</a></td>' +
                '</tr>' +
                // 5
                '<tr style="border: 1px solid black;">' +
                '<th class="bg-primary" style="border: 1px solid black; width: 100px;">Gerobak 5 :</th>' +
                '<td align="center" style="border: 1px solid black;">' + d[20] + '</td>' +
                '<th class="bg-primary" style="border: 1px solid black; width: 100px;">Out Gerobak 5 :</th>' +
                '<td align="center" style="border: 1px solid black;">' + d[21] + '</td>' +
                '<td align="center" style="border: 1px solid black; width: 100px"><a href="pages/cetak/iden_produk5.php?id=' + d[24] + '" class="btn btn-xs btn-danger" target="_blank"><i class="fa fa-print"></i> gerobak 5</a></td>' +
                '</tr>' +
                // 6
                '<tr style="border: 1px solid black;">' +
                '<th class="bg-primary" style="border: 1px solid black; width: 100px;">Gerobak 6 :</th>' +
                '<td align="center" style="border: 1px solid black;">' + d[22] + '</td>' +
                '<th class="bg-primary" style="border: 1px solid black; width: 100px;">Out Gerobak 6 :</th>' +
                '<td align="center" style="border: 1px solid black;">' + d[23] + '</td>' +
                '<td align="center" style="border: 1px solid black; width: 100px"><a href="pages/cetak/iden_produk6.php?id=' + d[24] + '" class="btn btn-xs btn-danger" target="_blank"><i class="fa fa-print"></i> gerobak 6</a></td>' +
                '</tr>' +
                // end here
                '</tbody>' +
                '</table>' +
                '</div>' +
                '</div>';
        }
    });
</script>