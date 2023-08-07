<?php
ini_set("error_reporting", 1);
session_start();
include "koneksi.php";

$sql_user = mysqli_query($con,"SELECT * from tbl_user where `level` = 'USER' ");
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
        $date_s = $_POST["date-start"];
        $date_e = $_POST["date-end"];
        $operator = $_POST["operator"];
        $_SESSION['date_s'] = $_POST["date-start"];
        $_SESSION['date_e'] = $_POST["date-end"];
        $_SESSION['operator'] = $_POST["operator"];
        if ($operator == "ALL") {
            $data = mysqli_query($con,"SELECT a.id, a.nodemand, a.no_mesin, a.no_urut, a.buyer, a.langganan, a.no_order, a.nokk, a.jenis_kain,
            a.warna, a.no_warna, sum(a.rol) as rol, sum(a.bruto) as bruto, a.proses, a.dept_tujuan, a.pic_schedule, a.`status`, a.lot, a.catatan, a.ket_status, a.nokk_legacy,
            a.tgl_delivery, a.create_time, a.tgl_mulai, a.tgl_update, a.tgl_stop, a.approve_time, b.no_gerobak1, b.tgl_out1, b.no_gerobak2, b.tgl_out2, b.no_gerobak3, b.tgl_out3, b.no_gerobak4, 
            b.tgl_out4, b.no_gerobak5, b.tgl_out5, b.no_gerobak6, b.tgl_out6, a.petugas_buka, a.approve_by, a.create_by, a.selesai_by
            FROM tbl_schedule a
            join tbl_gerobak b on a.id = b.id_schedule
            where a.status = 'selesai' AND a.leader_check = 'TRUE' and DATE_FORMAT(a.tgl_update,'%Y-%m-%d') >= '$date_s' 
            AND DATE_FORMAT(a.tgl_update,'%Y-%m-%d') <= '$date_e'
            GROUP by a.no_mesin, a.no_urut
            ORDER by a.no_mesin ASC, a.no_urut asc");
        } else {
            $data = mysqli_query($con,"SELECT a.id, a.nodemand, a.no_mesin, a.no_urut, a.buyer, a.langganan, a.no_order, a.nokk, a.jenis_kain,
            a.warna, a.no_warna, sum(a.rol) as rol, sum(a.bruto) as bruto, a.proses, a.dept_tujuan, a.pic_schedule, a.`status`, a.lot, a.catatan, a.ket_status, a.nokk_legacy, 
            a.tgl_delivery, a.create_time, a.tgl_mulai, a.tgl_update, a.tgl_stop, a.approve_time, b.no_gerobak1, b.tgl_out1, b.no_gerobak2, b.tgl_out2, b.no_gerobak3, b.tgl_out3, b.no_gerobak4, 
            b.tgl_out4, b.no_gerobak5, b.tgl_out5, b.no_gerobak6, b.tgl_out6, a.petugas_buka, a.approve_by, a.create_by, a.selesai_by
            FROM tbl_schedule a
            join tbl_gerobak b on a.id = b.id_schedule
            where a.status = 'selesai' AND a.leader_check = 'TRUE' and a.petugas_buka = '$operator' and DATE_FORMAT(a.tgl_update,'%Y-%m-%d') >= '$date_s' 
            AND DATE_FORMAT(a.tgl_update,'%Y-%m-%d') <= '$date_e'
            GROUP by a.no_mesin, a.no_urut
            ORDER by a.no_mesin ASC, a.no_urut asc");
        }
    } else {
        unset($_SESSION['date_s'], $_SESSION['group'], $_SESSION['date_e']);
        $data = mysqli_query($con,"SELECT a.id, a.nodemand, a.no_mesin, a.no_urut, a.buyer, a.langganan, a.no_order, a.nokk, a.jenis_kain,
        a.warna, a.no_warna, sum(a.rol) as rol, sum(a.bruto) as bruto, a.proses, a.dept_tujuan, a.pic_schedule, a.`status`, a.lot, a.catatan, a.ket_status, a.nokk_legacy,
        a.tgl_delivery, a.create_time, a.tgl_mulai, a.tgl_update, a.tgl_stop, a.approve_time, b.no_gerobak1, b.tgl_out1, b.no_gerobak2, b.tgl_out2, b.no_gerobak3, b.tgl_out3, b.no_gerobak4, 
        b.tgl_out4, b.no_gerobak5, b.tgl_out5, b.no_gerobak6, b.tgl_out6, a.petugas_buka, a.approve_by, a.create_by, a.selesai_by
        FROM tbl_schedule a
        join tbl_gerobak b on a.id = b.id_schedule
        WHERE a.`status` = 'selesai' AND a.leader_check = 'TRUE' and DATE_FORMAT(a.tgl_update,'%Y-%m-%d') = CURDATE()
        GROUP BY a.no_mesin, a.no_urut
        ORDER BY a.no_mesin ASC, a.no_urut ASC");
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
                                <div class="col-sm-2">
                                    <div class="input-group date">
                                        <div class=" input-group-addon"> <i class="fa fa-calendar"></i> </div>
                                        <input required class="form-control" type="text" value="<?php
                                                                                                if (empty($date_s)) {
                                                                                                    echo date('Y-m-d');
                                                                                                } else {
                                                                                                    echo $date_s;
                                                                                                }
                                                                                                ?>" id="datepicker" autocomplete="off" name="date-start" />
                                    </div>
                                </div>
                                <div class="col-sm-1">
                                    <button disabled class="disable btn btn-outline-danger"><strong>S/D</strong></button>
                                </div>
                                <div class="col-sm-2">
                                    <div class="input-group date">
                                        <div class=" input-group-addon"> <i class="fa fa-calendar"></i> </div>
                                        <input required class="form-control" value="<?php
                                                                                    if (empty($date_e)) {
                                                                                        echo date('Y-m-d');
                                                                                    } else {
                                                                                        echo $date_e;
                                                                                    }
                                                                                    ?>" type="text" id="datepicker2" autocomplete="off" name="date-end" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-2">
                                        <select required name="operator" class="form-control" required>
                                            <option <?php if ($operator == 'ALL') echo 'selected' ?> value="ALL">ALL OPERATOR</option>
                                            <?php while ($li = mysqli_fetch_array($sql_user)) { ?>
                                                <option <?php if ($operator == $li['nama']) echo 'selected' ?> value="<?php echo $li['nama'] ?>"><?php echo $li['nama'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-2">
                                        <button type="submit" name="submit" value="submit" class="btn btn-success btn-block">Generate</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div>
                        <a href="<?php if (!empty($_POST['submit'])) {
                                        echo 'pages/cetak/cetak_schedule_byoperator.php';
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
                                    <div align="center">Prod. Demand</div>
                                </th>
                                <th>
                                    <div align="center">Delivery</div>
                                </th>
                                <th width="79">
                                    <div align="center">Prod. Order</div>
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
                                
                            ?>
                                <tr bgcolor="<?php echo $bgcolor; ?>">
                                    <td class="details-control"></td>
                                    <td align="center">
                                        <?php echo $no ?>
                                    </td>
                                    <td align="center"><?php echo $rowd['no_mesin'] . ' / ' . $rowd['no_urut']; ?> /
                                        <button class="btn btn-xs btn-info disabled" disabled><?php echo $rowd['status']; ?></button></td>
                                    <td><?php echo $rowd['langganan'] . "/" . $rowd['buyer']; ?></td>
                                    <td align="center"><?php echo $rowd['no_order']; ?></td>
                                    <td><?php echo $rowd['jenis_kain']; ?></td>
                                    <td align="center"><?php echo $rowd['warna']; ?></td>
                                    <td align="center"><?php echo $rowd['rol'] . $rowd['kk']; ?></td>
                                    <td align="center"><?php echo $rowd['bruto']; ?></td>
                                    <td align="center"><?php if($rowd['nodemand']!=""){echo $rowd['nodemand'];}else{echo $rowd['lot'];} ?><br/> <?php echo $rowd['nokk_legacy']; ?></td>
                                    <td align="center" width="20"><?php echo $rowd['tgl_delivery']; ?></td>
                                    <td><i><?php echo $rowd['nokk']; ?></i><br />
                                        <i style="color:red;"><strong><?php echo $rowd['catatan']; ?></strong></i><br />
                                        <a href="#" id='<?php echo $rowd['id']; ?>' class="detail_kartu"><span class="label label-danger"><?php echo $rowd['ket_kartu']; ?></span></a>
                                    </td>
                                    <td class="12"><?php echo  $rowd['no_gerobak1'] ?></td>
                                    <td class="13"><?php echo  $rowd['tgl_out1'] ?></td>
                                    <td class="14"><?php echo  $rowd['no_gerobak2'] ?></td>
                                    <td class="15"><?php echo  $rowd['tgl_out2'] ?></td>
                                    <td class="16"><?php echo  $rowd['no_gerobak3'] ?></td>
                                    <td class="17"><?php echo  $rowd['tgl_out3'] ?></td>
                                    <td class="18"><?php echo  $rowd['no_gerobak4'] ?></td>
                                    <td class="19"><?php echo  $rowd['tgl_out4'] ?></td>
                                    <td class="20"><?php echo  $rowd['no_gerobak5'] ?></td>
                                    <td class="21"><?php echo  $rowd['tgl_out5'] ?></td>
                                    <td class="22"><?php echo  $rowd['no_gerobak6'] ?></td>
                                    <td class="23"><?php echo  $rowd['tgl_out6'] ?></td>
                                    <td class="24"><?php echo  $rowd['id'] ?></td>
                                    <td class="25"><?php echo $rowd['create_time'] ?></td>
                                    <td class="26"><?php echo $rowd['tgl_mulai'] ?></td>
                                    <td class="27"><?php echo $rowd['tgl_update'] ?></td>
                                    <td class="28"><?php echo $rowd['tgl_stop'] ?></td>
                                    <td class="29"><?php echo $rowd['approve_time'] ?></td>
                                    <td class="30"><?php echo $rowd['petugas_buka'] ?></td>
                                    <td class="31"><?php echo $rowd['approve_by'] ?></td>
                                    <td class="32"><?php echo $rowd['create_by'] ?></td>
                                    <td class="33"><?php echo $rowd['selesai_by'] ?></td>
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