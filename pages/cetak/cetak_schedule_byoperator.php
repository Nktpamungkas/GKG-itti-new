<?PHP
ini_set("error_reporting", 1);
session_start();
include "../../koneksi.php";
$date_s = $_SESSION['date_s'];
$date_e = $_SESSION['date_e'];
$operator = $_SESSION['operator'];
?>
<!DOCTYPE html>
<html lang="en">
<title>Data Pemakaian Bahan Baku <?php echo date('Y-m-d')  ?></title>
<link href="../../bower_components/print_tools/bootstrap4.css">
<style>
    @page {
        size: A4;
        margin: 30px 30px 30px 30px;
        font-size: 8pt !important;
        font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
        size: landscape;
    }

    @media print {
        @page {
            size: A4;
            margin: 30px 30px 30px 30px;
            size: landscape;
            font-size: 8pt !important;
        }

        html,
        body {
            width: 297mm;
            height: 210mm;
            background: #FFF;
            overflow: visible;
        }

        /* body {
            padding-top: 15mm;
        } */

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
    <table class="table-ttd" style="width: 360mm;">
        <tr>
            <td align="center">
                <img src="logo.png" width="40mm" height="40mm">
            </td>
            <td>
                <b>
                    <li>
                        <h5 class="text-center" style="font-weight: bold;">DATA PEMAKAIAN BAHAN BAKU</h5>
                    </li>
                    <li class="text-center"><span>No. Form : <b>FW-14-GKG-09/04</b></span></li>
                    <li class="text-center"><span>Halaman &nbsp;: </span></li>
                </b>
            </td>
        </tr>
    </table>
    <li style="display:inline; margin-left: 5px;">Tanggal : <?php echo $date_s . ' S/d ' . $date_e ?></li>
    <!-- <li style="display:inline; margin-left: 150px;">Shift : <php echo $group; ?></li> -->
    <table class="table-ttd" style="width: 360mm;">
        <thead>
            <tr>
                <td align="center" rowspan=" 2">Langganan</td>
                <td align="center" rowspan="2">No.order</td>
                <td align="center" rowspan="2">Jns.kain</td>
                <td align="center" rowspan="2">Warna</td>
                <td align="center" rowspan="2">Lot</td>
                <td align="center" rowspan="2">Roll</td>
                <td align="center" colspan="10" align="center">Qantity</td>
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
                <td align="center">Lain-lain</td>
                <!--  -->
                <td colspan="2" align="center">Biasa</td>
                <td colspan="2" align="center">Buka</td>
                <!--  -->
                <td align="center">Mulai</td>
                <td align="center">Selesai</td>
                <td align="center">Buka</td>
                <td align="center">Obras</td>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($operator == 'ALL') {
                $sql = mysqli_query($con,"SELECT b.langganan, b.buyer, b.no_order, b.jenis_kain, b.warna, b.lot, b.rol, b.proses,
                                b.bruto, b.buka, b.tgl_mulai, b.tgl_stop, b.no_mesin, b.petugas_buka, b.petugas_obras,
                                b.no_gerobak, b.leader_check, a.no_gerobak1, a.tgl_out1, a.no_gerobak2, a.tgl_out2,
                                a.no_gerobak3, a.tgl_out3, a.no_gerobak4, a.tgl_out4,
                                a.no_gerobak5, a.tgl_out5, a.no_gerobak6, a.tgl_out6
                         from tbl_schedule b
                         join tbl_gerobak a on b.id = a.id_schedule
                         where b.`status` = 'selesai' AND b.leader_check = 'TRUE'
                         and DATE_FORMAT(b.tgl_update,'%Y-%m-%d') >= '$date_s'
                         AND DATE_FORMAT(b.tgl_update,'%Y-%m-%d') <= '$date_e'
                         GROUP by b.no_mesin, b.no_urut
                         ORDER by b.no_mesin ASC, b.no_urut asc");
            } else {
                $sql = mysqli_query($con,"SELECT b.langganan, b.buyer, b.no_order, b.jenis_kain, b.warna, b.lot, b.rol, b.proses,
                b.bruto, b.buka, b.tgl_mulai, b.tgl_stop, b.no_mesin, b.petugas_buka, b.petugas_obras,
                b.no_gerobak, b.leader_check, a.no_gerobak1, a.tgl_out1, a.no_gerobak2, a.tgl_out2,
                a.no_gerobak3, a.tgl_out3, a.no_gerobak4, a.tgl_out4,
                a.no_gerobak5, a.tgl_out5, a.no_gerobak6, a.tgl_out6
                from tbl_schedule b
                join tbl_gerobak a on b.id = a.id_schedule
                where b.`status` = 'selesai' AND b.leader_check = 'TRUE' AND b.petugas_buka = '$operator' and DATE_FORMAT(b.tgl_update,'%Y-%m-%d') >= '$date_s'
                AND DATE_FORMAT(b.tgl_update,'%Y-%m-%d') <= '$date_e'
                GROUP by b.no_mesin, b.no_urut
                ORDER by b.no_mesin ASC, b.no_urut asc");
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
                            echo $data['no_gerobak1'];
                        } else {
                            echo $data['no_gerobak1'] . ' + ';
                        }
                        if (empty($data['no_gerobak3'])) {
                            echo $data['no_gerobak2'];
                        } else {
                            echo $data['no_gerobak2'] . ' + ';
                        }
                        if (empty($data['no_gerobak4'])) {
                            echo $data['no_gerobak3'];
                        } else {
                            echo $data['no_gerobak3'] . ' + ';
                        }
                        if (empty($data['no_gerobak5'])) {
                            echo $data['no_gerobak4'];
                        } else {
                            echo $data['no_gerobak4'] . ' + ';
                        }
                        if (empty($data['no_gerobak6'])) {
                            echo $data['no_gerobak5'];
                        } else {
                            echo $data['no_gerobak5'] . ' + ';
                        }
                        echo $data['no_gerobak6'] ?>
                    </td>

                    <td align="left" valign="top" id="buka"><?php echo substr($data['petugas_buka'], 0, 3); ?></td>
                    <td align="left" valign="top" id="obras"><?php echo substr($data['petugas_obras'], 0, 3); ?></td>

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
                <td align="center" valign="bottom" id="lain-lain"></td>
                <td align="left" valign="bottom" id="Satuan" colspan="11">KG</td>
            </tr>
        </tbody>
    </table>
    <li><strong>Keterangan : Sebelum diserahkan ke Dyeing/Finishing Leader shift memastikan product telah sesuai dengan permintaan pada kartu
            kerja dan diberitanda tickmark(√) pada kolom leader check</strong></li>
    <table class="table-ttd" style="width: 360mm;">
        <thead>
            <tr>
                <td></td>
                <td>Dibuat Oleh</td>
                <td>Diketahui Oleh</td>
                <td>Disetujui Oleh</td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="font-weight: bold; width: 25mm;">Nama</td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td style=" font-weight: bold;">Jabatan</td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td style="font-weight: bold;">Tanggal</td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr style="height: 50px;">
                <td style="font-weight: bold;">TTD</td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        </tbody>
    </table>
</body>
<script src="../../bower_components/print_tools/jquery.3.5.1.js"></script>
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

    setTimeout(function() {
        window.print()
    }, 1500);
</script>

</html>
