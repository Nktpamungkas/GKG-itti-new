<?PHP
ini_set("error_reporting", 1);
session_start();
include "../../koneksi.php";
$date_s = $_SESSION['date_s'];
$date_e = $_SESSION['date_e'];
$group = $_SESSION['group'];
$shift = $_SESSION['shift'];
?>
<!DOCTYPE html>
<html lang="en">
<title>Data Pemakaian Bahan Baku <?php echo date('Y-m-d')  ?></title>
<link rel="stylesheet" href="../../bower_components/bootstrap/dist/css/bootstrap.min.css">
<!-- <link href="../../bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css"> -->

<style>
    @page {
        size: A4;
        margin: 20px 20px 20px 20px;
        font-size: 8pt !important;
        font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
        size: landscape;
    }

    @media print {
        @page {
            size: A4;
            margin: 20px 20px 20px 20px;
            size: landscape;
            font-size: 8pt !important;
        }

        html,
        body {
            width: 330mm;
            height: 210mm;
            background: #FFF;
            overflow: visible;
        }

        .table-ttd {
            border-collapse: collapse;
            width: 100%;
            font-size: 8pt !important;
        }

        .table-ttd tr,
        .table-ttd tr td {
            border: 0.5px solid black;
            padding: 4px;
            padding: 4px;
            font-size: 8pt !important;
        }
    }

    input,
    textarea,
    select {
        font-family: inherit;
    }

    .table-ttd {
        border-collapse: collapse;
        width: 100%;
        font-size: 8pt !important;
    }

    .table-ttd tr,
    .table-ttd tr td {
        border: 1px solid black;
        padding: 5px;
        padding: 5px;
        font-size: 8pt !important;
    }

    tr {
        page-break-before: always;
        page-break-inside: avoid;
        font-size: 8pt !important;
    }

    .tablee td,
    .tablee th {
        /* border: 1px solid black; */
        padding: 5px;
        font-size: 8pt !important;

    }

    .rotation {
        transform: rotate(-90deg);
        /* Legacy vendor prefixes that you probably don't need... */
        /* Safari */
        -webkit-transform: rotate(-90deg);
        /* Firefox */
        -moz-transform: rotate(-90deg);
        /* IE */
        -ms-transform: rotate(-90deg);
        /* Opera */
        -o-transform: rotate(-90deg);
        /* Internet Explorer */
        filter: progid:DXImageTransform.Microsoft.BasicImage(rotation=3);
    }

    ul,
    li {
        list-style-type: none;
        font-size: 8pt !important;
    }

    .tablee tr:nth-child(even) {
        background-color: #f2f2f2;
        font-size: 8pt !important;
    }

    .table-ttd thead tr td,
    #tr-footer {
        font-weight: bold;
    }

    .tablee th {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: left;
        background-color: #4CAF50;
        color: white;
        font-size: 8pt !important;
    }
</style>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <table class="table-ttd" style="width: 367mm;">
        <tr>
            <td align="center">
                <img src="logo.png" width="40mm" height="40mm">
            </td>
            <td>
                <b>
                    <li>
                        <h5 style="font-weight: bold;">DATA PEMAKAIAN BAHAN BAKU</h5>
                    </li>
                    <li><span>No. Form : <b>FW-14-GKG-09/05</b></span></li>
                    <li><span>-</span></li>
                </b>
            </td>
        </tr>
    </table>
    <li style="display:inline; margin-left: 5px;">Tanggal : <?php echo $date_s . ' S/d ' . $date_e ?></li>
    <li style="display:inline; margin-left: 150px;">Shift : <?php echo $group; ?></li>
    <table class="table-ttd" style="width: 367mm;">
        <thead>
            <tr>
                <td align="center" rowspan=" 2">Langganan</td>
                <td align="center" rowspan="2">No.order</td>
                <td align="center" rowspan="2">Jns.kain</td>
                <td align="center" rowspan="2">Warna</td>
                <td align="center" rowspan="2">Lot</td>
                <td align="center" rowspan="2">Roll</td>
                <td align="center" colspan="12" align="center">Qantity</td>
                <td align="center" colspan="4" align="center">Proses GKG</td>
                <td align="center" colspan="2" align="center">Jam</td>
                <td align="center" rowspan="2">No.MC</td>
                <td align="center" rowspan="2">No.Grbk</td>
                <td align="center" colspan="2" align="center">Petugas</td>
                <td align="center" class="rotation" rowspan="2">Leader <br> Check</td>
            </tr>
            <tr>
                <!--  -->
                <td align="center">Clup</td>
                <td align="center">Scrng</td>
                <td align="center">Prst</td>
                <td align="center">Rlxng</td>
                <td align="center">J.Pggr</td>
                <td align="center">Bngkrn</td>
                <td align="center">Blh</td>
                <td align="center">Cnt<br>Blchg</td>
                <td align="center">Psh.grbk</td>
                <td align="center">BC</td>
                <td align="center">Peach</td>
                <td align="center">Lain</td>
                <!--  -->
                <td colspan="2" align="center">BK</td>
                <td colspan="2" align="center">BLK</td>
                <!--  -->
                <td align="center">Mulai</td>
                <td align="center">Selesai</td>
                <td align="center">Buka</td>
                <td align="center">Obras</td>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($group == 'ALL') {
                $sql = mysqli_query($con,"SELECT b.langganan, b.buyer, b.no_order, b.jenis_kain, b.warna, b.lot, b.rol, b.proses, b.pic_schedule,
                                b.bruto, b.buka, b.tgl_mulai, b.tgl_stop, b.no_mesin, b.petugas_buka, b.petugas_obras,
                                b.no_gerobak, b.leader_check, a.no_gerobak1, a.tgl_out1, a.no_gerobak2, a.tgl_out2,
                                a.no_gerobak3, a.tgl_out3, a.no_gerobak4, a.tgl_out4,
                                a.no_gerobak5, a.tgl_out5, a.no_gerobak6, a.tgl_out6
                         from tbl_schedule b
                         join tbl_gerobak a on b.id = a.id_schedule
                         where b.`status` = 'selesai' AND b.leader_check = 'TRUE'
                         and DATE_FORMAT(b.tgl_update,'%Y-%m-%d') >= '$date_s'
                         AND DATE_FORMAT(b.tgl_update,'%Y-%m-%d') <= '$date_e'
                         GROUP by b.nokk, b.proses, b.no_mesin, b.no_urut,
                         ORDER by b.tgl_stop DESC");
            } else {
                if ($shift != 'ALL') {
                    if ($shift == 1) {
                        $start_shift3 = $_SESSION["date_s"] . " 07:00";
                        $end_shift3 = $_SESSION["date_e"] . " 15:00";
                    } else if ($shift == 2) {
                        $start_shift3 = $_SESSION["date_s"] . " 15:00";
                        $end_shift3 = $_SESSION["date_e"] . " 23:00";
                    } else if ($shift == 3) {
                        $start_shift3 = $_SESSION["date_s"] . " 23:00";
                        $end_shift3 = $_SESSION["date_e"] . " 07:00";
                    }
                    $sql = mysqli_query($con,"SELECT b.langganan, b.buyer, b.no_order, b.jenis_kain, b.warna, b.lot, b.rol, b.proses, b.pic_schedule,
                    b.bruto, b.buka, b.tgl_mulai, b.tgl_stop, b.no_mesin, b.petugas_buka, b.petugas_obras,
                    b.no_gerobak, b.leader_check, a.no_gerobak1, a.tgl_out1, a.no_gerobak2, a.tgl_out2,
                    a.no_gerobak3, a.tgl_out3, a.no_gerobak4, a.tgl_out4,
                    a.no_gerobak5, a.tgl_out5, a.no_gerobak6, a.tgl_out6
                    from tbl_schedule b
                    join tbl_gerobak a on b.id = a.id_schedule
                    where b.`status` = 'selesai' AND b.leader_check = 'TRUE' and b.g_shift = '$group' and
                    DATE_FORMAT(b.tgl_update,'%Y-%m-%d %H:%i') >= '$start_shift3'
                    AND DATE_FORMAT(b.tgl_update,'%Y-%m-%d %H:%i') <= '$end_shift3'
                    GROUP by b.nokk, b.proses, b.no_mesin, b.no_urut
                    ORDER by b.tgl_stop DESC");
                } else if ($shift == 'ALL') {
                    $sql = mysqli_query($con,"SELECT b.langganan, b.buyer, b.no_order, b.jenis_kain, b.warna, b.lot, b.rol, b.proses, b.pic_schedule,
                    b.bruto, b.buka, b.tgl_mulai, b.tgl_stop, b.no_mesin, b.petugas_buka, b.petugas_obras,
                    b.no_gerobak, b.leader_check, a.no_gerobak1, a.tgl_out1, a.no_gerobak2, a.tgl_out2,
                    a.no_gerobak3, a.tgl_out3, a.no_gerobak4, a.tgl_out4,
                    a.no_gerobak5, a.tgl_out5, a.no_gerobak6, a.tgl_out6
                    from tbl_schedule b
                    join tbl_gerobak a on b.id = a.id_schedule
                    where b.`status` = 'selesai' AND b.leader_check = 'TRUE' and b.g_shift = '$group' and DATE_FORMAT(b.tgl_update,'%Y-%m-%d') >= '$date_s'
                    AND DATE_FORMAT(b.tgl_update,'%Y-%m-%d') <= '$date_e'
                    GROUP by b.nokk, b.proses, b.no_mesin, b.no_urut
                    ORDER by b.tgl_stop DESC");
                }
            }

            while ($data = mysqli_fetch_array($sql)) {
            ?>
                <tr>
                    <td align="left" valign="top" id="lggnan"><?php echo $data['langganan']; ?>/<?php echo $data['buyer'] ?></td>
                    <td align="left" valign="top" id="no-order"><?php echo $data['no_order']; ?></td>
                    <td align="left" valign="top" id="jenis-kain" style="font-size: 10px;"><?php echo $data['jenis_kain']; ?></td>
                    <td align="left" valign="top" id="warna"><?php echo $data['warna']; ?></td>
                    <td align="left" valign="top" id="LOT"><?php echo $data['lot']; ?></td>
                    <td align="left" valign="top" class="Roll"><?php echo $data['rol']; ?></td>
                    <!-- Qty here -->
                    <?php
                    if ($data['proses'] == 'Celup') {
                        echo '<td align="center" valign="top" class="celup">' . $data["bruto"] . '</td>
                        <td align="center" valign="top" class="scouring">0</td>
                        <td align="center" valign="top" class="priset">0</td>
                        <td align="center" valign="top" class="relexing">0</td>
                        <td align="center" valign="top" class="J-pinggir">0</td>
                        <td align="center" valign="top" class="Bongkaran">0</td>
                        <td align="center" valign="top" class="Belah">0</td>
                        <td align="center" valign="top" class="Continious_bleaching">0</td>
                        <td align="center" valign="top" class="Pisah_gerobak">0</td>
                        <td align="center" valign="top" class="BC">0</td>
                        <td align="center" valign="top" class="Peach">0</td>
                        <td align="center" valign="top" class="Lain-lain">0</td>';
                    } elseif ($data['proses'] == 'Scouring') {
                        echo '<td align="center" valign="top" class="celup">0</td>
                        <td align="center" valign="top" class="scouring">' . $data["bruto"] . '</td>
                        <td align="center" valign="top" class="priset">0</td>
                        <td align="center" valign="top" class="relexing">0</td>
                        <td align="center" valign="top" class="J-pinggir">0</td>
                        <td align="center" valign="top" class="Bongkaran">0</td>
                        <td align="center" valign="top" class="Belah">0</td>
                        <td align="center" valign="top" class="Continious_bleaching">0</td>
                        <td align="center" valign="top" class="Pisah_gerobak">0</td>
                        <td align="center" valign="top" class="BC">0</td>
                        <td align="center" valign="top" class="Peach">0</td>
                        <td align="center" valign="top" class="Lain-lain">0</td>';
                    } elseif ($data['proses'] == 'Priset') {
                        echo '<td align="center" valign="top" class="celup">0</td>
                        <td align="center" valign="top" class="scouring">0</td>
                        <td align="center" valign="top" class="priset">' . $data["bruto"] . '</td>
                        <td align="center" valign="top" class="relexing">0</td>
                        <td align="center" valign="top" class="J-pinggir">0</td>
                        <td align="center" valign="top" class="Bongkaran">0</td>
                        <td align="center" valign="top" class="Belah">0</td>
                        <td align="center" valign="top" class="Continious_bleaching">0</td>
                        <td align="center" valign="top" class="Pisah_gerobak">0</td>
                        <td align="center" valign="top" class="BC">0</td>
                        <td align="center" valign="top" class="Peach">0</td>
                        <td align="center" valign="top" class="Lain-lain">0</td>';
                    } elseif ($data['proses'] == 'Relexing') {
                        echo '<td align="center" valign="top" class="celup">0</td>
                        <td align="center" valign="top" class="scouring">0</td>
                        <td align="center" valign="top" class="priset">0</td>
                        <td align="center" valign="top" class="relexing">' . $data["bruto"] . '</td>
                        <td align="center" valign="top" class="J-pinggir">0</td>
                        <td align="center" valign="top" class="Bongkaran">0</td>
                        <td align="center" valign="top" class="Belah">0</td>
                        <td align="center" valign="top" class="Continious_bleaching">0</td>
                        <td align="center" valign="top" class="Pisah_gerobak">0</td>
                        <td align="center" valign="top" class="BC">0</td>
                        <td align="center" valign="top" class="Peach">0</td>
                        <td align="center" valign="top" class="Lain-lain">0</td>';
                    } elseif ($data['proses'] == 'J. Pinggir') {
                        echo '<td align="center" valign="top" class="celup">0</td>
                        <td align="center" valign="top" class="scouring">0</td>
                        <td align="center" valign="top" class="priset">0</td>
                        <td align="center" valign="top" class="relexing">0</td>
                        <td align="center" valign="top" class="J-pinggir">' . $data["bruto"] . '</td>
                        <td align="center" valign="top" class="Bongkaran">0</td>
                        <td align="center" valign="top" class="Belah">0</td>
                        <td align="center" valign="top" class="Continious_bleaching">0</td>
                        <td align="center" valign="top" class="Pisah_gerobak">0</td>
                        <td align="center" valign="top" class="BC">0</td>
                        <td align="center" valign="top" class="Peach">0</td>
                        <td align="center" valign="top" class="Lain-lain">0</td>';
                    } elseif ($data['proses'] == 'Bongkaran') {
                        echo '<td align="center" valign="top" class="celup">0</td>
                        <td align="center" valign="top" class="scouring">0</td>
                        <td align="center" valign="top" class="priset">0</td>
                        <td align="center" valign="top" class="relexing">0</td>
                        <td align="center" valign="top" class="J-pinggir">0</td>
                        <td align="center" valign="top" class="Bongkaran">' . $data["bruto"] . '</td>
                        <td align="center" valign="top" class="Belah">0</td>
                        <td align="center" valign="top" class="Continious_bleaching">0</td>
                        <td align="center" valign="top" class="Pisah_gerobak">0</td>
                        <td align="center" valign="top" class="BC">0</td>
                        <td align="center" valign="top" class="Peach">0</td>
                        <td align="center" valign="top" class="Lain-lain">0</td>';
                    } else if ($data['proses'] == 'Belah') {
                        echo '<td align="center" valign="top" class="celup">0</td>
                        <td align="center" valign="top" class="scouring">0</td>
                        <td align="center" valign="top" class="priset">0</td>
                        <td align="center" valign="top" class="relexing">0</td>
                        <td align="center" valign="top" class="J-pinggir">0</td>
                        <td align="center" valign="top" class="Bongkaran">0</td>
                        <td align="center" valign="top" class="Belah">' . $data["bruto"] . '</td>
                        <td align="center" valign="top" class="Continious_bleaching">0</td>
                        <td align="center" valign="top" class="Pisah_gerobak">0</td>
                        <td align="center" valign="top" class="BC">0</td>
                        <td align="center" valign="top" class="Peach">0</td>
                        <td align="center" valign="top" class="Lain-lain">0</td>';
                    } else if ($data['proses'] == 'Continious Bleaching') {
                        echo '<td align="center" valign="top" class="celup">0</td>
                        <td align="center" valign="top" class="scouring">0</td>
                        <td align="center" valign="top" class="priset">0</td>
                        <td align="center" valign="top" class="relexing">0</td>
                        <td align="center" valign="top" class="J-pinggir">0</td>
                        <td align="center" valign="top" class="Bongkaran">0</td>
                        <td align="center" valign="top" class="Belah">0</td>
                        <td align="center" valign="top" class="Continious_bleaching">' . $data["bruto"] . '</td>
                        <td align="center" valign="top" class="Pisah_gerobak">0</td>
                        <td align="center" valign="top" class="BC">0</td>
                        <td align="center" valign="top" class="Peach">0</td>
                        <td align="center" valign="top" class="Lain-lain">0</td>';
                    } else if ($data['proses'] == 'Pisah Gerobak') {
                        echo '<td align="center" valign="top" class="celup">0</td>
                        <td align="center" valign="top" class="scouring">0</td>
                        <td align="center" valign="top" class="priset">0</td>
                        <td align="center" valign="top" class="relexing">0</td>
                        <td align="center" valign="top" class="J-pinggir">0</td>
                        <td align="center" valign="top" class="Bongkaran">0</td>
                        <td align="center" valign="top" class="Belah">0</td>
                        <td align="center" valign="top" class="Continious_bleaching">0</td>
                        <td align="center" valign="top" class="Pisah_gerobak">' . $data["bruto"] . '</td>
                        <td align="center" valign="top" class="BC">0</td>
                        <td align="center" valign="top" class="Peach">0</td>
                        <td align="center" valign="top" class="Lain-lain">0</td>';
                    } else if ($data['proses'] == 'Belah Cuci') {
                        echo '<td align="center" valign="top" class="celup">0</td>
                        <td align="center" valign="top" class="scouring">0</td>
                        <td align="center" valign="top" class="priset">0</td>
                        <td align="center" valign="top" class="relexing">0</td>
                        <td align="center" valign="top" class="J-pinggir">0</td>
                        <td align="center" valign="top" class="Bongkaran">0</td>
                        <td align="center" valign="top" class="Belah">0</td>
                        <td align="center" valign="top" class="Continious_bleaching">0</td>
                        <td align="center" valign="top" class="Pisah_gerobak">0</td>
                        <td align="center" valign="top" class="BC">' . $data["bruto"] . '</td>
                        <td align="center" valign="top" class="Peach">0</td>
                        <td align="center" valign="top" class="Lain-lain">0</td>';
                    } else if ($data['proses'] == 'Peach') {
                        echo '<td align="center" valign="top" class="celup">0</td>
                        <td align="center" valign="top" class="scouring">0</td>
                        <td align="center" valign="top" class="priset">0</td>
                        <td align="center" valign="top" class="relexing">0</td>
                        <td align="center" valign="top" class="J-pinggir">0</td>
                        <td align="center" valign="top" class="Bongkaran">0</td>
                        <td align="center" valign="top" class="Belah">0</td>
                        <td align="center" valign="top" class="Continious_bleaching">0</td>
                        <td align="center" valign="top" class="Pisah_gerobak">0</td>
                        <td align="center" valign="top" class="BC">0</td>
                        <td align="center" valign="top" class="Peach">' . $data["bruto"] . '</td>
                        <td align="center" valign="top" class="Lain-lain">0</td>';
                    } else {
                        echo '<td align="center" valign="top" class="celup">0</td>
                        <td align="center" valign="top" class="scouring">0</td>
                        <td align="center" valign="top" class="priset">0</td>
                        <td align="center" valign="top" class="relexing">0</td>
                        <td align="center" valign="top" class="J-pinggir">0</td>
                        <td align="center" valign="top" class="Bongkaran">0</td>
                        <td align="center" valign="top" class="Belah">0</td>
                        <td align="center" valign="top" class="Continious_bleaching">0</td>
                        <td align="center" valign="top" class="Pisah_gerobak">0</td>
                        <td align="center" valign="top" class="BC">0</td>
                        <td align="center" valign="top" class="Peach">0</td>
                        <td align="center" valign="top" class="Lain-lain">' . $data["bruto"] . '</td>';
                    }
                    ?>
                    <!-- Qty end -->
                    <!-- Open here -->
                    <?php
                    if ($data['buka'] == 'Biasa') {
                        echo '<td colspan="2" align="center" valign="center" id="Biasa" style="font-weight: bold;">√</td>
                        <td colspan="2" align="center" valign="center" id="Balik">-</td>';
                    } elseif ($data['buka'] == 'Balik') {
                        echo '<td colspan="2" align="center" valign="center" id="Biasa">-</td>
                        <td colspan="2" align="center" valign="center" id="Balik" style="font-weight: bold;">√</td>';
                    }
                    ?>
                    <!-- Open end -->
                    <!-- time here -->
                    <td align="left" valign="top" id="Mulai"><?php if (strlen($data['tgl_mulai']) == 0) {
                                                                    echo '-';
                                                                } else {
                                                                    echo date('H:i', strtotime($data['tgl_mulai']));
                                                                } ?></td>
                    <td align="left" valign="top" id="Selesai"><?php if (strlen($data['tgl_stop']) == 0) {
                                                                    echo '-';
                                                                } else {
                                                                    echo date('H:i', strtotime($data['tgl_stop']));
                                                                } ?></td>
                    <!-- End here stupid ! -->
                    <!-- mulai disini -->
                    <td align="left" valign="top" id="No.Mc"><?php echo $data['no_mesin'] ?></td>
                    <td align="left" valign="top" id="No. Gerobak">
                        <?php if (empty($data['no_gerobak2'])) {
                            echo strtoupper($data['no_gerobak1']);
                        } else {
                            echo strtoupper($data['no_gerobak1']) . ' + ';
                        }
                        if (empty($data['no_gerobak3'])) {
                            echo strtoupper($data['no_gerobak2']);
                        } else {
                            echo strtoupper($data['no_gerobak2']) . ' + ';
                        }
                        if (empty($data['no_gerobak4'])) {
                            echo strtoupper($data['no_gerobak3']);
                        } else {
                            echo strtoupper($data['no_gerobak3']) . ' + ';
                        }
                        if (empty($data['no_gerobak5'])) {
                            echo strtoupper($data['no_gerobak4']);
                        } else {
                            echo strtoupper($data['no_gerobak4']) . ' + ';
                        }
                        if (empty($data['no_gerobak6'])) {
                            echo strtoupper($data['no_gerobak5']);
                        } else {
                            echo strtoupper($data['no_gerobak5']) . ' + ';
                        }
                        echo strtoupper($data['no_gerobak6']) ?>
                    </td>

                    <td align="left" valign="top" id="buka"><?php echo substr($data['pic_schedule'], 0, 3); ?></td>
                    <td align="left" valign="top" id="obras"><?php echo strtoupper(substr($data['petugas_obras'], 0, 3)); ?></td>

                    <td align="center" valign="top" id="leader check" style="font-weight: bold;"><?php
                                                                                                    if ($data['leader_check'] == 'TRUE') {
                                                                                                        echo "√";
                                                                                                    } else {
                                                                                                        echo "-";
                                                                                                    }
                                                                                                    ?></td>
                    <!-- better end -->
                </tr>
            <?php } ?>
            <tr id="tr-footer">
                <td align="center" valign="bottom" colspan="5" style="text-align: right;" valign="bottom">Total</td>
                <td align="center" valign="bottom" id="roll"></td>
                <td align="center" valign="bottom" id="Celup"></td>
                <td align="center" valign="bottom" id="Scouring"></td>
                <td align="center" valign="bottom" id="Priset"></td>
                <td align="center" valign="bottom" id="Relexing"></td>
                <td align="center" valign="bottom" id="j-pinggir"></td>
                <td align="center" valign="bottom" id="bongkaran"></td>
                <td align="center" valign="bottom" id="belah"></td>
                <td align="center" valign="bottom" id="continious_bleaching"></td>
                <td align="center" valign="bottom" id="pisah_gerobak"></td>
                <td align="center" valign="bottom" id="bc"></td>
                <td align="center" valign="bottom" id="peach"></td>
                <td align="center" valign="bottom" id="lain-lain"></td>
                <td align="center" valign="center" id="Satuan" colspan="4">KG</td>
                <td align="left" valign="bottom" id="summarytotal" colspan="7"></td>
            </tr>
        </tbody>
    </table>
    <li><strong>Keterangan : Sebelum diserahkan ke Dyeing/Finishing Leader shift memastikan product telah sesuai dengan permintaan pada kartu
            kerja dan diberitanda tickmark(√) pada kolom leader check</strong></li>
    <table class="table-ttd" style="width: 367mm;">
        <thead>
            <tr>
                <td></td>
                <td>Dibuat Oleh</td>
                <td>Diketahui Oleh</td>
                <td>Disetujui Oleh</td>
            </tr>
        </thead>
        <?php
        $sql_ = mysqli_query($con,"SELECT * from tbl_footer_cetak 
                    where `date_start` = '$date_s' 
                    and `date_end` = '$date_e' 
                    and `group` = '$group' 
                    and shift = '$shift' LIMIT 1");
        $footer = mysqli_fetch_array($sql_);
        ?>
        <tbody>
            <tr>
                <td style="font-weight: bold; width: 25mm;">Nama</td>

                <td align="center" class="leader_1">
                    <?php if ($footer['leader_1'] == '') { ?>
                        <input type="text" name="leader_1" id="leader_1" width="100%" style="text-align:center; text-transform: uppercase; border:none; font-size: 8pt;" placeholder="_ _ _ _ _ _ _ _ _ _ _ _"> &nbsp;&nbsp; <button type="button" id="act_leader_1"> ✔ </button>
                    <?php } else { ?>
                        <strong width="100%"><?php echo $footer['leader_1'] ?></strong>
                    <?php } ?>
                </td>

                <td align="center" class="leader_2">
                    N/A
                </td>
                <td align="center" class="ass_spv">
                    <?php if ($footer['ass_spv'] == '') { ?>
                        <input type="text" name="ass_spv" id="ass_spv" width="100%" style="text-align:center; text-transform: uppercase; border:none; font-size: 8pt;" placeholder="_ _ _ _ _ _ _ _ _ _ _ _"> &nbsp;&nbsp; <button type="button" id="act_ass_spv"> ✔ </button>
                    <?php } else { ?>
                        <strong width="100%"><?php echo $footer['ass_spv'] ?></strong>
                    <?php } ?>
                </td>
            </tr>

            <tr>
                <td style=" font-weight: bold;">Jabatan</td>
                <td align="center">LEADER</td>
                <td align="center">N/A</td>
                <td align="center">Assistant SPV</td>
            </tr>
            <tr>
                <td style="font-weight: bold;">Tanggal</td>
                <td align="center" class="tgl_left">&nbsp;<?php echo $footer['tgl_left'] ?></td>
                <td align="center" class="tgl_center">&nbsp;N/A</td>
                <td align="center" class="tgl_right">&nbsp;<?php echo $footer['tgl_right'] ?></td>
            </tr>
        </tbody>
    </table>
</body>
<script src="../../bower_components/print_tools/jquery.3.5.1.js"></script>
<script>
    $(document).ready(function() {
        $('#act_leader_1').click(function() {
            if ($('#leader_1').val() == '') {
                alert('Nama Leader Kosong !');
            } else {
                $.ajax({
                    url: "../ajax/insert_leader_1.php",
                    type: "POST",
                    data: {
                        date_start: '<?php echo $date_s ?>',
                        date_end: '<?php echo $date_e ?>',
                        group: '<?php echo $group ?>',
                        shift: '<?php echo $shift ?>',
                        leader_1: $('#leader_1').val().toUpperCase()
                    },
                    success: function(response) {
                        res = JSON.parse(response)
                        $('.leader_1').html('<strong width="100%">' + res.leader + '</strong>');
                        $('.tgl_left').html('<strong width="100%">' + res.tgl + '</strong>');
                    },
                    error: function() {
                        alert('insert data error hubungi DIT Dept !')
                    }
                });
            }
        })
        $('#act_leader_2').click(function() {
            if ($('#leader_2').val() == '') {
                alert('Nama Leader Kosong !');
            } else {
                $.ajax({
                    url: "../ajax/insert_leader_2.php",
                    type: "POST",
                    data: {
                        date_start: '<?php echo $date_s ?>',
                        date_end: '<?php echo $date_e ?>',
                        group: '<?php echo $group ?>',
                        shift: '<?php echo $shift ?>',
                        leader_2: $('#leader_2').val().toUpperCase()
                    },
                    success: function(response) {
                        res = JSON.parse(response)
                        $('.leader_2').html('<strong width="100%">' + res.leader + '</strong>');
                        $('.tgl_center').html('<strong width="100%">' + res.tgl + '</strong>');
                    },
                    error: function() {
                        alert('insert data error hubungi DIT Dept !')
                    }
                });
            }
        })
        $('#act_ass_spv').click(function() {
            if ($('#ass_spv').val() == '') {
                alert('Nama Ass Spv Kosong !');
            } else {
                $.ajax({
                    url: "../ajax/insert_ass_spv.php",
                    type: "POST",
                    data: {
                        date_start: '<?php echo $date_s ?>',
                        date_end: '<?php echo $date_e ?>',
                        group: '<?php echo $group ?>',
                        shift: '<?php echo $shift ?>',
                        ass_spv: $('#ass_spv').val().toUpperCase()
                    },
                    success: function(response) {
                        res = JSON.parse(response)
                        $('.ass_spv').html('<strong width="100%">' + res.leader + '</strong>');
                        $('.tgl_right').html('<strong width="100%">' + res.tgl + '</strong>');
                    },
                    error: function() {
                        alert('insert data error hubungi DIT Dept !')
                    }
                });
            }
        })


    })
</script>









<script type="text/javascript">
    $(document).ready(function() {
        $("#roll").html(function() {
            let a = 0;
            $(".Roll").each(function() {
                if ($(this).html().length == 0) {
                    console.log(0)
                } else {
                    a += parseFloat($(this).html());
                }
            });
            $(this).html(parseFloat(a).toFixed(2))
        });
    });
    $(document).ready(function() {
        $("#Celup").html(function() {
            let a = 0;
            $(".celup").each(function() {
                if ($(this).html().length == 0) {
                    console.log(0)
                } else {
                    a += parseFloat($(this).html());
                }
            });
            $(this).html(parseFloat(a).toFixed(2))
        });
    });
    $(document).ready(function() {
        $("#Scouring").html(function() {
            let a = 0;
            $(".scouring").each(function() {
                if ($(this).html().length == 0) {
                    console.log(0)
                } else {
                    a += parseFloat($(this).html());
                }
            });
            $(this).html(parseFloat(a).toFixed(2))
        });
    });
    $(document).ready(function() {
        $("#Priset").html(function() {
            let a = 0;
            $(".priset").each(function() {
                if ($(this).html().length == 0) {
                    console.log(0)
                } else {
                    a += parseFloat($(this).html());
                }
            });
            $(this).html(parseFloat(a).toFixed(2))
        });
    });
    $(document).ready(function() {
        $("#Relexing").html(function() {
            let a = 0;
            $(".relexing").each(function() {
                if ($(this).html().length == 0) {
                    console.log(0)
                } else {
                    a += parseFloat($(this).html());
                }
            });
            $(this).html(parseFloat(a).toFixed(2))
        });
    });
    $(document).ready(function() {
        $("#j-pinggir").html(function() {
            let a = 0;
            $(".J-pinggir").each(function() {
                if ($(this).html().length == 0) {
                    console.log(0)
                } else {
                    a += parseFloat($(this).html());
                }
            });
            $(this).html(parseFloat(a).toFixed(2))
        });
    });
    $(document).ready(function() {
        $("#bongkaran").html(function() {
            let a = 0;
            $(".Bongkaran").each(function() {
                if ($(this).html().length == 0) {
                    console.log(0)
                } else {
                    a += parseFloat($(this).html());
                }
            });
            $(this).html(parseFloat(a).toFixed(2))
        });
    });
    $(document).ready(function() {
        $("#belah").html(function() {
            let a = 0;
            $(".Belah").each(function() {
                if ($(this).html().length == 0) {
                    console.log(0)
                } else {
                    a += parseFloat($(this).html());
                }
            });
            $(this).html(parseFloat(a).toFixed(2))
        });
    });
    $(document).ready(function() {
        $("#continious_bleaching").html(function() {
            let a = 0;
            $(".Continious_bleaching").each(function() {
                if ($(this).html().length == 0) {
                    console.log(0)
                } else {
                    a += parseFloat($(this).html());
                }
            });
            $(this).html(parseFloat(a).toFixed(2))
        });
    });
    $(document).ready(function() {
        $("#pisah_gerobak").html(function() {
            let a = 0;
            $(".Pisah_gerobak").each(function() {
                if ($(this).html().length == 0) {
                    console.log(0)
                } else {
                    a += parseFloat($(this).html());
                }
            });
            $(this).html(parseFloat(a).toFixed(2))
        });
    });
    $(document).ready(function() {
        $("#bc").html(function() {
            let a = 0;
            $(".BC").each(function() {
                if ($(this).html().length == 0) {
                    console.log(0)
                } else {
                    a += parseFloat($(this).html());
                }
            });
            $(this).html(parseFloat(a).toFixed(2))
        });
    });
    $(document).ready(function() {
        $("#peach").html(function() {
            let a = 0;
            $(".Peach").each(function() {
                if ($(this).html().length == 0) {
                    console.log(0)
                } else {
                    a += parseFloat($(this).html());
                }
            });
            $(this).html(parseFloat(a).toFixed(2))
        });
    });
    // lain lain
    $(document).ready(function() {
        $("#lain-lain").html(function() {
            let a = 0;
            $(".Lain-lain").each(function() {
                if ($(this).html().length == 0) {
                    console.log(0)
                } else {
                    a += parseFloat($(this).html());
                }
            });
            $(this).html(parseFloat(a).toFixed(2))
        });
    });

    $(document).ready(function() {
        var Celup = parseFloat($('#Celup').html())
        var Scouring = parseFloat($('#Scouring').html())
        var Priset = parseFloat($('#Priset').html())
        var Relexing = parseFloat($('#Relexing').html())
        var j_pinggir = parseFloat($('#j-pinggir').html())
        var bongkaran = parseFloat($('#bongkaran').html())
        var belah = parseFloat($('#belah').html())
        var continious_bleaching = parseFloat($('#continious_bleaching').html())
        var pisah_gerobak = parseFloat($('#pisah_gerobak').html())
        var bc = parseFloat($('#bc').html())
        var peach = parseFloat($('#peach').html())
        var lain_lain = parseFloat($('#lain-lain').html())

        var total = Celup + Scouring + Priset + Relexing + j_pinggir + bongkaran + belah + continious_bleaching + pisah_gerobak + bc + peach + lain_lain;
        $("#summarytotal").html('Total : ' + parseFloat(total).toFixed(2))
    })

    // setTimeout(function() {
    //     window.print()
    // }, 105000);
</script>

</html>