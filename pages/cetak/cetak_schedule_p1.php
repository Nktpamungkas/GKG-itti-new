<?php
session_start();
/*$lReg_username=$_SESSION['labReg_username'];

$host1="svr4";
$username1="timdit";
$password1="4dm1n";
$db_name1="TM";
 set_time_limit(600);
	$conn1=mssql_connect($host1,$username1,$password1) or die ("Sorry our web is under maintenance. Please visit us later");
	$db=mssql_select_db($db_name1) or die ("Under maintenance");
include "../../koneksiLAB.php";
db_connect($db_name);*/
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
    <td align="center" valign="middle"><strong><font size="+1" >DATA PEMAKAIAN BAHAN BAKU</font><br>FW-14-GKG-09/04</strong></td>
    </tr>
  </table>
<table width="100%" border="0">
    <tbody>
      <tr>
        <td width="78%"><font size="-1">Tanggal : <?php echo tanggal_indo ($tgl, true);?><br />
          Shift
        :</font></td>
        <td width="22%" align="right"><!--Jam: <?php echo date('H:i:s', strtotime($jam));?>--></td>
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
      <?php if($NoMC=="Semua Mesin"){ ?>	
      <?php } ?>	
      <td width="18%" rowspan="2" scope="col"><div align="center">Langganan</div></td>
      <td width="8%" rowspan="2" scope="col"><div align="center">No. Order</div></td>
      <td width="14%" rowspan="2" scope="col"><div align="center">Jenis Kain</div></td>
      <td width="8%" rowspan="2" scope="col"><div align="center">Warna</div></td>
      <td width="8%" rowspan="2" scope="col"><div align="center">Lot</div></td>
      <td width="3%" rowspan="2" scope="col"><div align="center">Roll</div></td>
      <td colspan="7" scope="col"><div align="center">Quantity</div></td>
      <td width="20%" colspan="2" scope="col"><div align="center">Buka</div></td>
      <td width="20%" colspan="2" scope="col"><div align="center">Jam</div></td>
      <td width="20%" rowspan="2" scope="col"><div align="center">No. Gerobak</div></td>
      <td width="20%" colspan="2" scope="col"><div align="center">Petugas</div></td>
      <td width="20%" rowspan="2" scope="col"><div align="center">Loader Check</div></td>
    </tr>
    <tr>
      <td width="3%"><div align="center">Celup</div></td>
      <td width="6%"><div align="center">Scouring</div></td>
      <td width="6%"><div align="center">Priset</div></td>
      <td width="6%"><div align="center">Relexing</div></td>
      <td width="6%"><div align="center">J. Pinggir</div></td>
      <td width="6%"><div align="center">Bongkaran</div></td>
      <td width="6%"><div align="center">Lain-lain</div></td>
      <td width="10%" scope="col"><div align="center">Biasa</div></td>
      <td width="10%" scope="col"><div align="center">Balik</div></td>
      <td width="10%" scope="col"><div align="center">Mulai</div></td>
      <td width="10%" scope="col"><div align="center">Selesai</div></td>
      <td width="10%" scope="col"><div align="center">Buka</div></td>
      <td width="10%" scope="col"><div align="center">Obras</div></td>
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
      <?php if($NoMC=="Semua Mesin"){ ?>
	  <?php } ?>	
      <td align="center" valign="top"><span style="height: 0.35in;"><?php echo $rowd['langganan']."/".$rowd['buyer'];?></span></td>
      <td align="center" valign="top"><span style="height: 0.35in;"><?php echo $rowd['no_order'];?></span></td>
      <td align="left" valign="top"><span style="height: 0.35in;"><?php echo $rowd['jenis_kain'];?></span></td>
      <td align="center" valign="top"><span style="height: 0.35in;"><?php echo $rowd['lebar']."X".$rowd['gramasi'];?></span></td>
      <td align="center" valign="top"><span style="height: 0.35in;"><?php echo $rowd['warna'];?></span></td>
      <td align="center" valign="top"><span style="height: 0.35in;"><?php echo $rowd['lot'];?></span></td>
      <td align="center" valign="top"><span style="height: 0.35in;"><?php echo $rowd['rol'];?></span></td>
      <td align="right" valign="top"><span style="height: 0.35in;"><?php echo $rowd['bruto'];?></span></td>
      <td align="right" valign="top">&nbsp;</td>
      <td align="right" valign="top">&nbsp;</td>
      <td align="right" valign="top">&nbsp;</td>
      <td align="right" valign="top">&nbsp;</td>
      <td align="right" valign="top">&nbsp;</td>
      <td colspan="2" valign="top"><span style="height: 0.35in;"><?php echo $rowd['proses'];?><br><?php echo $rowd['status'];?><br><?php echo $rowd['catatan'];?><br><?php echo $rowd['tgl_update']; ?></span></td>
      <td colspan="2" valign="top">&nbsp;</td>
      <td valign="top">&nbsp;</td>
      <td colspan="2" valign="top">&nbsp;</td>
      <td valign="top">&nbsp;</td>	  
    </tr>
    
  <?php
	$totRol=$totRol+$rowd['rol'];
	$totKG=$totKG+ $rowd['bruto']; 
	  $no++;
  
  } 
  ?>
		  <tr>
      <?php if($NoMC=="Semua Mesin"){ ?>		  
      <?php } ?>		  
      <td align="center" valign="top">&nbsp;</td>
      <td align="center" valign="top">&nbsp;</td>
      <td align="center" valign="top">&nbsp;</td>
      <td align="center" valign="top">&nbsp;</td>
      <td align="center" valign="top">&nbsp;</td>
      <td align="center" valign="top">&nbsp;</td>
      <td align="right" valign="top"><strong><span style="height: 0.35in;"><?php echo $totRol;?></span></strong></td>
      <td align="right" valign="top"><strong><span style="height: 0.35in;"><?php echo $totKG;?></span></strong></td>
      <td align="right" valign="top">&nbsp;</td>
      <td align="right" valign="top">&nbsp;</td>
      <td align="right" valign="top">&nbsp;</td>
      <td align="right" valign="top">&nbsp;</td>
      <td align="right" valign="top">&nbsp;</td>
      <td colspan="2" valign="top">&nbsp;</td>
      <td colspan="2" valign="top">&nbsp;</td>
      <td valign="top">&nbsp;</td>
      <td colspan="2" valign="top">&nbsp;</td>
      <td valign="top">&nbsp;</td>
        </tr>
</table></td>
    </tr>
    <tr>
      <td><table width="100%" border="1" class="table-list1">
  
    <tr>
      <td width="16%" scope="col">&nbsp;</td>
      <td width="29%" scope="col"><div align="center">Dibuat Oleh</div></td>
      <td width="29%" scope="col"><div align="center">DIperiksa Oleh</div></td>
      <td width="26%" scope="col"><div align="center">Diketahui Oleh</div></td>
    </tr>
    <tr>
      <td>Nama</td>
      <td align="center">Husni Jr</td>
      <td align="center">Putri</td>
      <td align="center">Yayan</td>
    </tr>
    <tr>
      <td>Jabatan</td>
      <td align="center">Staff Schedule</td>
      <td align="center">SPV</td>
      <td align="center"> Ast. Manager</td>
    </tr>
    <tr>
      <td>Tanggal</td>
      <td align="center"><?php echo tanggal_indo ($tgl, false);?></td>
      <td align="center"><?php echo tanggal_indo ($tgl, false);?></td>
      <td align="center"><?php echo tanggal_indo ($tgl, false);?></td>
    </tr>
    <tr>
      <td valign="top" style="height: 0.5in;">Tanda Tangan</td>
      <td align="center"><?php if($_SESSION['nama1Fin']=="Husni"){ ?><img src="ttd/husni.jpg" width="80" height="73" alt=""/><?php } ?></td>
      <td align="center"><img src="ttd/putri.jpg" width="80" height="73" alt=""/></td>
      <td align="center"><img src="ttd/yayan.jpg" width="80" height="73" alt=""/></td>
    </tr>
  
</table></td>
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