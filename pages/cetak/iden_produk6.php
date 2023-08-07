<?php
ini_set("error_reporting", 1);
session_start();
include "../../koneksi.php";
$kueri = mysqli_query($con,"SELECT *, a.no_order as nomor_order, a.warna as desc_warna, a.lot as lot_a, a.catatan as catatan_a
                      from tbl_schedule a 
                      left join tbl_gerobak b on a.id = b.id_schedule where a.id = '$_GET[id]'");
$data = mysqli_fetch_array($kueri);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <link href="styles_cetak.css" rel="stylesheet" type="text/css">
  <title>Cetak IDENTIFIKASI PRODUK</title>
  <script>

  </script>
  <style>
    .table-list td {
      color: #333;
      font-size: 12px;
      border-color: #fff;
      border-collapse: collapse;
      vertical-align: center;
      padding: 3px 5px;
      border-bottom: 1px #000000 solid;
      border-left: 1px #000000 solid;
      border-right: 1px #000000 solid;


    }

    .table-list1 {
      clear: both;
      text-align: left;
      border-collapse: collapse;
      margin: 0px 0px 5px 0px;
      background: #fff;
    }

    .table-list1 td {
      color: #333;
      font-size: 14px;
      border-color: #fff;
      border-collapse: collapse;
      vertical-align: center;
      padding: 1px 3px;
      border-bottom: 0px #000000 solid;
      border-top: 0px #000000 solid;
      border-left: 0px #000000 solid;
      border-right: 0px #000000 solid;


    }
  </style>
</head>

<body>
  <table width="100%" border="" class="table-list1" style="border-bottom:1px #000000 solid;
	border-top:1px #000000 solid;
	border-left:1px #000000 solid;
	border-right:1px #000000 solid;">
    <tr>
      <td width="10%" align="center"><img src="Indo.jpg" width="50" height="50
		" alt="" /></td>
      <td width="58%" align="center" style="border-bottom:0px #000000 solid;
	border-top:0px #000000 solid;
	border-left:1px #000000 solid;
	border-right:1px #000000 solid;"><strong>
          <font size="+2">IDENTIFIKASI PRODUK</font>
        </strong></td>
      <td width="32%" align="center">
        <table width="100%">
          <tbody>
            <tr>
              <td width="36%" style="border-top:0px #000000 solid; 
	border-bottom:0px #000000 solid;
	border-left:0px #000000 solid; 
	border-right:0px #000000 solid;">No. Form</td>
              <td width="5%" style="border-top:0px #000000 solid; 
	border-bottom:0px #000000 solid;
	border-left:0px #000000 solid; 
	border-right:0px #000000 solid;">:</td>
              <td width="59%" style="border-top:0px #000000 solid; 
	border-bottom:0px #000000 solid;
	border-left:0px #000000 solid; 
	border-right:0px #000000 solid;">20-03</td>
            </tr>
            <tr>
              <td style="border-top:0px #000000 solid; 
	border-bottom:0px #000000 solid;
	border-left:0px #000000 solid; 
	border-right:0px #000000 solid;">No Revisi</td>
              <td style="border-top:0px #000000 solid; 
	border-bottom:0px #000000 solid;
	border-left:0px #000000 solid; 
	border-right:0px #000000 solid;">:</td>
              <td style="border-top:0px #000000 solid; 
	border-bottom:0px #000000 solid;
	border-left:0px #000000 solid; 
	border-right:0px #000000 solid;">02</td>
            </tr>
            <tr>
              <td style="border-top:0px #000000 solid; 
	border-bottom:0px #000000 solid;
	border-left:0px #000000 solid; 
	border-right:0px #000000 solid;">Tgl. Terbit</td>
              <td style="border-top:0px #000000 solid; 
	border-bottom:0px #000000 solid;
	border-left:0px #000000 solid; 
	border-right:0px #000000 solid;">:</td>
              <td style="border-top:0px #000000 solid; 
	border-bottom:0px #000000 solid;
	border-left:0px #000000 solid; 
	border-right:0px #000000 solid;">15 April 2020</td>
            </tr>
          </tbody>
        </table>
      </td>
    </tr>
  </table>
  <table width="100%" border="" class="table-list1">
    <tbody>
      <tr>
        <td colspan="3" scope="col" style="border-bottom:0px #000000 solid;
	border-top:0px #000000 solid;
	border-left:0px #000000 solid;
	border-right:0px #000000 solid;">
          <table width="83" border="" class="table-list1">
            <tbody>
              <tr>
                <td align="center" valign="middle"><strong>FORM A</strong></td>
              </tr>
            </tbody>
          </table>
        </td>
      </tr>
      <tr>
        <td colspan="3" align="center" valign="top">
          <!-- <h2>DEPARTEMEN QCF</h2> -->
        </td>
      </tr>
      <tr>
        <td width="15%" style="height: 0.3in;">&nbsp;</td>
        <td width="48%">&nbsp;</td>
        <td width="37%" rowspan="6" valign="top">
          <table width="100%">
            <tbody>
              <tr align="center">
                <td colspan="3" scope="col">DEPARTEMENT TUJUAN :</td>
              </tr>
              <tr>
                <td width="7%" style="border-bottom:1px #000000 solid;
	border-top:1px #000000 solid;
	border-left:1px #000000 solid;
  border-right:1px #000000 solid;"><?php if ($data['dept_tujuan'] == 'QCF') echo "GKG√</b>" ?>
                </td>
                <td width="93%">GKG</td>
              </tr>
              <tr>
                <td style="border-bottom:1px #000000 solid;
	border-top:1px #000000 solid;
	border-left:1px #000000 solid;
  border-right:1px #000000 solid;"><?php if ($data['dept_tujuan'] == 'LAB') echo "<b>√</b>" ?>
                </td>
                <td>LAB</td>
              </tr>
              <tr>
                <td style="border-bottom:1px #000000 solid;
	border-top:1px #000000 solid;
	border-left:1px #000000 solid;
  border-right:1px #000000 solid;"><?php if ($data['dept_tujuan'] == 'DYE') echo "<b>√</b>" ?>
                </td>
                <td>DYE</td>
              </tr>
              <tr>
                <td style="border-bottom:1px #000000 solid;
	border-top:1px #000000 solid;
	border-left:1px #000000 solid;
  border-right:1px #000000 solid;"><?php if ($data['dept_tujuan'] == 'BRS') echo "<b>√</b>" ?>
                </td>
                <td>BRS</td>
              </tr>
              <tr>
                <td style="border-bottom:1px #000000 solid;
	border-top:1px #000000 solid;
	border-left:1px #000000 solid;
  border-right:1px #000000 solid;"><?php if ($data['dept_tujuan'] == 'FIN') echo "<b>√</b>" ?>
                </td>
                <td>FIN</td>
              </tr>
              <tr>
                <td style="border-bottom:1px #000000 solid;
	border-top:1px #000000 solid;
	border-left:1px #000000 solid;
  border-right:1px #000000 solid;"><?php if ($data['dept_tujuan'] == 'PRT') echo "<b>√</b>" ?>
                </td>
                <td>PRT</td>
              </tr>
              <tr>
                <td style="border-bottom:1px #000000 solid;
	border-top:1px #000000 solid;
	border-left:1px #000000 solid;
  border-right:1px #000000 solid;"><?php if ($data['dept_tujuan'] == 'QCF') echo "<b>√</b>" ?>
                </td>
                <td>QCF</td>
              </tr>
            </tbody>
          </table>
        </td>
      </tr>
      <tr>
        <td valign="top" style="height: 0.3in;">DEPARTEMEN</td>
        <td valign="top">: <?php echo $_SESSION['deptGkg'] ?></td>
      </tr>
      <tr>
        <td valign="top" style="height: 0.3in;">TANGGAL OUT</td>
        <td valign="top">: <?php echo $data['tgl_out6'] ?> <b style="font-style: italic;">*</b></td>
      </tr>
      <tr valign="top">
        <td style="height: 0.3in;">NO. ORDER </td>
        <td>: <?php echo $data['nomor_order'] ?></td>
      </tr>
      <tr valign="top">
        <td style="height: 0.3in;">HANGER</td>
        <td>: <?php echo $data['no_hanger'] . ' (' . $data["no_item"] . ')'; ?></td>
      </tr>
      <tr valign="top">
        <td style="height: 0.3in;">WARNA</td>
        <td>: <?php echo $data['desc_warna'] . ' (' . $data["no_warna"] . ')'; ?></td>
      </tr>
      <tr valign="top">
        <td style="height: 0.3in;">LOT</td>
        <td>: <?php echo $data['lot_a'] ?></td>
      </tr>
      <tr>
        <td valign="top" style="height: 0.3in;">&nbsp;</td>
        <td valign="top">&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td valign="top" style="height: 0.4in;">KODE STATUS :</td>
        <td valign="top">&nbsp; <?php echo $data['status'] ?></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td valign="top" style="height: 0.4in;">NO GEROBAK :</td>
        <td valign="top">&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td colspan="3">
          <table width="100%" border="0">
            <tbody>
              <tr>
                <td width="16%" valign="top" style="height: 0.4in;" scope="col">1. <span style="height: 0.4in;"><?php echo $data['no_gerobak1']  ?></span></td>
                <td width="16%" valign="top" scope="col">2. <span style="height: 0.4in;"><?php echo $data['no_gerobak2']  ?></span></td>
                <td width="16%" valign="top" scope="col">3. <span style="height: 0.4in;"><?php echo $data['no_gerobak3']  ?></span></td>
                <td width="16%" valign="top" scope="col">4. <span style="height: 0.4in;"><?php echo $data['no_gerobak4']  ?></span></td>
                <td width="16%" valign="top" scope="col">5. <span style="height: 0.4in;"><?php echo $data['no_gerobak5']  ?></span></td>
                <td width="16%" valign="top" scope="col">6. <span style="height: 0.4in;"><?php echo $data['no_gerobak6']  ?>*</span></td>
              </tr>
            </tbody>
          </table>
        </td>
      </tr>
      <tr>
        <td valign="top" style="height: 0.4in;">KETERANGAN</td>
        <td valign="top">: (MC > <?php echo $data['no_mesin'] ?>)&nbsp; <?php echo $data['catatan_a'] ?></td>
        <td></td>
      </tr>
      <tr>
        <td colspan="3" align="right">&nbsp;</td>
      </tr>
    </tbody>
  </table>
  <br />


</body>

</html>
<script>
  window.print();
</script>