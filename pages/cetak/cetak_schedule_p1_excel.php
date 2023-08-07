<?php
session_start();

header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=schedule_fin".substr($_GET['Awal'],0,10).".xls");//ganti nama sesuai keperluan
header("Pragma: no-cache");
header("Expires: 0");

$con=mysqli_connect("10.0.1.91","dit","4dm1n","db_finishing");
include "../../tgl_indo.php";
//--
$idkk=$_REQUEST['idkk'];
$act=$_GET['g'];
//-
$Awal=$_GET['Awal'];
$Akhir=$_GET['Akhir'];
$NoMC=$_GET['no_mc'];
$Gshft=$_GET['shift'];
$qTgl=mysqli_query($con,"SELECT DATE_FORMAT(now(),'%Y-%m-%d') as tgl_skrg,DATE_FORMAT(now(),'%H:%i:%s') as jam_skrg");
$rTgl=mysqli_fetch_array($qTgl);
if($Awal!=""){$tgl=substr($Awal,0,10); $jam=$Awal;}else{$tgl=$rTgl['tgl_skrg']; $jam=$rTgl['jam_skrg'];}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="styles_cetak.css" rel="stylesheet" type="text/css">
<title>Cetak Schedule Page 1</title>
<style>
.hurufvertical {
 writing-mode:tb-rl;
    -webkit-transform:rotate(-90deg);
    -moz-transform:rotate(-90deg);
    -o-transform: rotate(-90deg);
    -ms-transform:rotate(-90deg);
    transform: rotate(180deg);
    white-space:nowrap;
    float:left;
}	

input{
text-align:center;
border:hidden;
}
@media print {
  ::-webkit-input-placeholder { /* WebKit browsers */
      color: transparent;
  }
  :-moz-placeholder { /* Mozilla Firefox 4 to 18 */
      color: transparent;
  }
  ::-moz-placeholder { /* Mozilla Firefox 19+ */
      color: transparent;
  }
  :-ms-input-placeholder { /* Internet Explorer 10+ */
      color: transparent;
  }
  .pagebreak { page-break-before:always; }
  .header {display:block}
  table thead 
   {
    display: table-header-group;
   }
}	
</style>	
</head>

<body>
<table width="100%">
  <thead>
    <tr>
      <td><table width="100%" border="1" class="table-list1"> 
  <tr>
    <td width="9%" align="center"><img src="indo.jpg" width="40" height="40"  /></td>
    <td align="center" valign="middle"><h2>&nbsp;</h2></td>
    <td align="center" valign="middle">&nbsp;</td>
    <td align="center" valign="middle">&nbsp;</td>
    <td align="center" valign="middle">&nbsp;</td>
    <td align="center" valign="middle">&nbsp;</td>
    <td align="center" valign="middle">SCHEDULE FINISHING <?php echo strtoupper($NoMC); ?></td>
    <td align="center" valign="middle">&nbsp;</td>
    <td align="center" valign="middle">&nbsp;</td>
    <td align="center" valign="middle">&nbsp;</td>
    <td align="center" valign="middle">&nbsp;</td>
    <td align="center" valign="middle">&nbsp;</td>
    <td align="center" valign="middle">&nbsp;</td>
    <td align="center" valign="middle">&nbsp;</td>
    </tr>
  </table>
<table width="100%" border="0">
    <tbody>
      <tr>
        <td width="39%"><font size="-1">Hari/Tanggal : <?php echo tanggal_indo ($tgl, true);?></font></td>
        <td width="39%">&nbsp;</td>
        <td width="78%">&nbsp;</td>
        <td width="78%">&nbsp;</td>
        <td width="78%">&nbsp;</td>
        <td width="78%">&nbsp;</td>
        <td width="78%">&nbsp;</td>
        <td width="78%">&nbsp;</td>
        <td width="78%">&nbsp;</td>
        <td width="78%">&nbsp;</td>
        <td width="78%">&nbsp;</td>
        <td width="78%">&nbsp;</td>
        <td width="22%" align="right">Jam: <?php echo date('H:i:s', strtotime($jam));?></td>
      </tr>
    </tbody>
  </table>
	  </td>
    </tr>
  </thead>
    <tr>
      <td><table width="100%" border="1" class="table-list1">
	<thead>	  
    <tr>
      <td width="3%" rowspan="2" scope="col"><div align="center">No. Urut</div></td>
	  <?php if($NoMC=="Semua Mesin"){ ?>	
      <td width="3%" rowspan="2" scope="col"><div align="center">Mesin</div></td>
	  <?php } ?>	
      <td width="3%" rowspan="2" scope="col"><div align="center">Shift</div></td>
      <td width="18%" rowspan="2" scope="col"><div align="center">Langganan</div></td>
      <td width="8%" rowspan="2" scope="col"><div align="center">No. Order</div></td>
      <td width="14%" rowspan="2" scope="col"><div align="center">Jenis Kain</div></td>
      <td width="8%" rowspan="2" scope="col"><div align="center">Lebar/Grms</div></td>
      <td width="8%" rowspan="2" scope="col"><div align="center">Warna</div></td>
      <td width="3%" rowspan="2" scope="col"><div align="center">Lot</div></td>
      <td width="6%" rowspan="2" scope="col"><div align="center">Tanggal Delivery</div></td>
      <td colspan="2" scope="col"><div align="center">Quantity</div></td>
      <td width="20%" rowspan="2" scope="col"><div align="center">Keterangan</div></td>
    </tr>
    <tr>
      <td width="3%"><div align="center">Roll</div></td>
      <td width="6%"><div align="center">Kg</div></td>
    </tr>
	    </thead>
	
	<?php
	if($NoMC=="Semua Mesin"){$where=" ";}else if($NoMC!=""){ $where=" and no_mesin='$NoMC' "; }
	if($Gshft=="ALL"){$where1=" ";}else if($Gshft!="ALL"){ $where1=" and g_shift='$Gshft' "; }else{$where1=" ";}
	if($Awal!=""){ $where2=" DATE_FORMAT(tgl_update,'%Y-%m-%d')='$Awal' "; }else{ $where2=" DATE_FORMAT(tgl_update,'%Y-%m-%d')=DATE_FORMAT(now(),'%Y-%m-%d')";}	  
   $data=mysqli_query($con,"SELECT
    shift,
	g_shift,
   	no_urut,
	no_mesin,
	no_sch,
	lebar,
	gramasi,
	no_item,
	jenis_kain,
	buyer,
	langganan,
	no_order,
	lot,
	warna,
	sum(rol) as rol,
	sum(bruto) as bruto,
	proses,
	`status`,
	catatan,
	ket_status,
	ket_kain,
	tgl_delivery,
	tgl_update
FROM
	tbl_schedule 
WHERE
	$where2 $where $where1
GROUP BY
	id 
ORDER BY
	no_mesin ASC,no_urut ASC");
	$no=1;
	$n=1;	  
  $col=0;
  while($rowd=mysqli_fetch_array($data)){
			$bgcolor = ($col++ & 1) ? 'gainsboro' : 'antiquewhite';
		 ?>
    <tr>
      <td align="center" valign="top" style="height: 0.35in;"><?php echo $rowd['no_sch'];?></td>
      <?php if($NoMC=="Semua Mesin"){ ?>
	  <td align="center" valign="top"><?php echo $rowd['no_mesin'];?></td>
	  <?php } ?>	
      <td align="center" valign="top"><span style="height: 0.35in;"><?php echo $rowd['g_shift'];?></span></td>	  	
      <td align="center" valign="top"><span style="height: 0.35in;"><?php echo $rowd['langganan']."/".$rowd['buyer'];?></span></td>
      <td align="center" valign="top"><span style="height: 0.35in;"><?php echo $rowd['no_order'];?></span></td>
      <td align="left" valign="top"><span style="height: 0.35in;"><?php echo $rowd['jenis_kain'];?></span></td>
      <td align="center" valign="top"><span style="height: 0.35in;"><?php echo $rowd['lebar']."X".$rowd['gramasi'];?></span></td>
      <td align="center" valign="top"><span style="height: 0.35in;"><?php echo $rowd['warna'];?></span></td>
      <td align="center" valign="top"><span style="height: 0.35in;"><?php echo $rowd['lot'];?></span></td>
      <td align="center" valign="top"><span style="height: 0.35in;"><?php echo tanggal_indo ($rowd['tgl_delivery'],false);?></span></td>
      <td align="center" valign="top"><span style="height: 0.35in;"><?php echo $rowd['rol'];?></span></td>
      <td align="right" valign="top"><span style="height: 0.35in;"><?php echo $rowd['bruto'];?></span></td>
      <td valign="top"><span style="height: 0.35in;"><?php echo $rowd['proses'];?><br><?php echo $rowd['status'];?><br><?php echo $rowd['catatan'];?><br><?php echo $rowd['tgl_update']; ?></span></td>	  
    </tr>
    
  <?php
	$totRol=$totRol+$rowd['rol'];
	$totKG=$totKG+ $rowd['bruto']; 
	  $no++;
  
  } 
  ?>
		  <tr>
      <td align="center" valign="top" style="height: 0.35in;">&nbsp;</td>
	  <?php if($NoMC=="Semua Mesin"){ ?>		  
      <td align="center" valign="top">&nbsp;</td>
	  <?php } ?>		  
      <td align="center" valign="top">&nbsp;</td>
      <td align="center" valign="top">&nbsp;</td>
      <td align="center" valign="top">&nbsp;</td>
      <td align="center" valign="top">&nbsp;</td>
      <td align="center" valign="top">&nbsp;</td>
      <td align="center" valign="top">&nbsp;</td>
      <td align="center" valign="top">&nbsp;</td>
      <td align="right" valign="top"><strong>TOTAL</strong></td>
      <td align="right" valign="top"><strong><span style="height: 0.35in;"><?php echo $totRol;?></span></strong></td>
      <td align="right" valign="top"><strong><span style="height: 0.35in;"><?php echo $totKG;?></span></strong></td>
      <td valign="top">&nbsp;</td>
    </tr>
</table></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
  
</table>
<table width="100%" border="0">
  <tbody>
    <tr>
      <td width="87%">&nbsp;</td>
      <td width="13%">&nbsp;</td>
    </tr>
  </tbody>
</table>	
<script>
//alert('cetak');window.print();
</script> 
</body>
</html>