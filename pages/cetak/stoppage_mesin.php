<?PHP
ini_set("error_reporting", 1);
session_start();
include "../../koneksi.php";
?>
<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
<style>
    @page {
        size: A4;
        margin: 30px 30px 30px 30px;
        font-size: 10pt !important;
        color: black;
        font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
        /* width: 210mm;
        height: 297mm; */
    }

    @media print {
        @page {
            size: A4;
            margin: 30px 30px 30px 30px;
            font-size: 10pt !important;
            color: black;
        }

        html,
        body {
            /* width: 210mm;
            height: 297mm; */
            background: #FFF;
            overflow: visible;
        }

        .table-ttd {
            border-collapse: collapse;
            width: 100%;
            font-size: 10pt !important;
            color: black;
        }

        .table-ttd tr,
        .table-ttd tr td {
            border: 0.5px solid black;
            padding: 4px;
            padding: 4px;
            font-size: 10pt !important;
            color: black;
        }
    }

    /* body {
        width: 210mm;
        height: 297mm;
    } */

    .table-ttd {
        border-collapse: collapse;
        width: 100%;
        font-size: 10pt !important;
        color: black;
    }

    .table-ttd tr,
    .table-ttd tr td {
        border: 1px solid black;
        padding: 5px;
        padding: 5px;
        font-size: 10pt !important;
        color: black;
    }

    tr {
        /* page-break-before: always; */
        page-break-inside: avoid;
        font-size: 10pt !important;
        color: black;
    }

    .tablee td,
    .tablee th {
        /* border: 1px solid black; */
        padding: 1px;
        font-size: 10pt !important;
        color: black;

    }

    ul,
    li {
        list-style-type: none;
        font-size: 10pt !important;
        color: black;
        font-weight: bold;
    }

    .tablee tr:nth-child(even) {
        background-color: #f2f2f2;
        font-size: 10pt !important;
        color: black;
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
        font-size: 10pt !important;
        color: black;
    }
</style>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stoppage Mesin</title>
</head>

<body>
    <table class="table-ttd" style="width: 100%">
        <tr>
            <td align="center">
                <img src="logo.png" width="40mm" height="40mm">
            </td>
            <td>
                <b>
                    <h5 class="text-center" style="font-weight: bold;">DATA STOPPAGE MESIN</h5>
            </td>
            <td style="width: 80mm;">
                <li>No. form : </li>
                <li>No. Revisi :</li>
                <li>Tanggal Terbit : <?php echo date('Y-m-d') ?></li>
            </td>
        </tr>
    </table>
    <li style="margin: 5px 5px 5px 5px;">Department : </li>
    <table class="table-ttd">
        <tr>
            <td style="width: 40mm; font-weight: bold;">Nama Mesin : </td>
            <td></td>
        </tr>
        <tr>
            <td style="width: 40mm; font-weight: bold;">No. Mesin : </td>
            <td></td>
        </tr>
    </table>
    <table class="table-ttd" style="width: 100%; margin-top: 15px">
        <thead>
            <tr style="font-weight: bold;">
                <td rowspan="2" align="center" valign="center">Tanggal</td>
                <td colspan="4" align="center" valign="center">Shift Pagi</td>
                <td colspan="4" align="center" valign="center">Shift Siang</td>
                <td colspan="4" align="center" valign="center">Shift Malam</td>
            </tr>
            <tr style="font-weight: bold;">
                <td align="center" valign="center" class="pagi">Stop</td>
                <td align="center" valign="center" class="pagi">Start</td>
                <td align="center" valign="center" class="pagi">Total</td>
                <td align="center" valign="center" class="pagi">Kode</td>
                <td align="center" valign="center" class="siang">Stop</td>
                <td align="center" valign="center" class="siang">Start</td>
                <td align="center" valign="center" class="siang">Total</td>
                <td align="center" valign="center" class="siang">Kode</td>
                <td align="center" valign="center" class="malam">Stop</td>
                <td align="center" valign="center" class="malam">Start</td>
                <td align="center" valign="center" class="malam">Total</td>
                <td align="center" valign="center" class="malam">Kode</td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><?php echo date('Y-m-d') ?></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td><?php echo date('Y-m-d') ?></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td><?php echo date('Y-m-d') ?></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td><?php echo date('Y-m-d') ?></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td><?php echo date('Y-m-d') ?></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td><?php echo date('Y-m-d') ?></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td><?php echo date('Y-m-d') ?></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td><?php echo date('Y-m-d') ?></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td><?php echo date('Y-m-d') ?></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td><?php echo date('Y-m-d') ?></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td><?php echo date('Y-m-d') ?></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td><?php echo date('Y-m-d') ?></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td><?php echo date('Y-m-d') ?></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td><?php echo date('Y-m-d') ?></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td><?php echo date('Y-m-d') ?></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td><?php echo date('Y-m-d') ?></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td><?php echo date('Y-m-d') ?></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td><?php echo date('Y-m-d') ?></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td><?php echo date('Y-m-d') ?></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td><?php echo date('Y-m-d') ?></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td><?php echo date('Y-m-d') ?></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td><?php echo date('Y-m-d') ?></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td><?php echo date('Y-m-d') ?></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td><?php echo date('Y-m-d') ?></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td><?php echo date('Y-m-d') ?></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td><?php echo date('Y-m-d') ?></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td><?php echo date('Y-m-d') ?></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td><?php echo date('Y-m-d') ?></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td><?php echo date('Y-m-d') ?></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td><?php echo date('Y-m-d') ?></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td><?php echo date('Y-m-d') ?></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td><?php echo date('Y-m-d') ?></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        </tbody>
    </table>
</body>
<li style="font-weight: bold; margin: 5px 5px 5px 5px;">Kode Data Stoppage Mesin :</li>
<table class="tablee" style="font-weight: bold;">
    <tr>
        <td style="width: 20mm;">LM : </td>
        <td style="width: 50mm;">Listrik Mati</td>
        <td style="width: 20mm;">PM : </td>
        <td>Pemeliharaan Mesin (Pemeliharaan rutin oleh departement Maintenance)</td>
    </tr>
    <tr>
        <td style="width: 20mm;">KM : </td>
        <td style="width: 50mm;">Kerusakan Mesin</td>
        <td rowspan="3" style="width: 20mm;">GT : </td>
        <td rowspan="3">Gangguan Teknis (Gangguan yang disebabkan oleh kerusakan pada mesin pendukung produksi, misalnya: steam kecil, tekanan angin compressor kurang, DLL)</td>
    </tr>
    <tr>
        <td style="width: 20mm;">PT : </td>
        <td style="width: 50mm;">Pembersihan Teknis</td>
    </tr>
    <tr>
        <td style="width: 20mm;">KO : </td>
        <td style="width: 50mm;">Kurang Order</td>
    </tr>
    <tr>
        <td style="width: 20mm;">AP : </td>
        <td style="width: 50mm;">Kerusakan Mesin</td>
        <td rowspan="2" style="width: 20mm;">TG : </td>
        <td rowspan="2">Tunggu (Misalnya: oper produksi, tunggu buka kain, tunggu gerobak)</td>
    </tr>
    <tr>
        <td style="width: 20mm;">PA : </td>
        <td style="width: 50mm;">Pelaksanaan Apel</td>
    </tr>
</table>
<script type="text/javascript">
    // setTimeout(function() {
    //     window.print()
    // }, 1500);
</script>

</html>