<?php
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=report-schadule-produksi-".substr($_GET['awal'],0,10).".xls");//ganti nama sesuai keperluan
header("Pragma: no-cache");
header("Expires: 0");
//disini script laporan anda
?>
<?php 
$con=mysqli_connect("10.0.1.91","dit","4dm1n","db_qc");
include "../../tgl_indo.php";
//--
$idkk=$_REQUEST['idkk'];
$act=$_GET['g'];
//-
$qTgl=mysqli_query($con,"SELECT DATE_FORMAT(now(),'%Y-%m-%d %H:%i') as tgl_skrg, DATE_FORMAT(now(),'%Y-%m-%d %H:%i')+ INTERVAL 1 DAY as tgl_besok");
$rTgl=mysqli_fetch_array($qTgl);
$Awal=$_GET['awal'];
$Akhir=$_GET['akhir'];
$shft=$_GET['shft'];
function cekDesimal($angka){
	$bulat=round($angka);
	if($bulat>$angka){
		$jam=$bulat-1;
		$waktu=$jam." Jam 30 Menit";
	}else{
		$jam=$bulat;
		$waktu=$jam." Jam 00 Menit";
	}
	return $waktu;
}
?>
<body>
	
<strong>Periode: <?php echo $Awal; ?> s/d <?php echo $Akhir; ?></strong><br>
<strong>Shift: <?php echo $shft; ?></strong><br />
<table width="100%" border="1">
    <tr>
      <th bgcolor="#99FF99">NO.</th>
      <th bgcolor="#99FF99">NO MC</th>
      <th bgcolor="#99FF99">SHIFT</th>
      <th bgcolor="#99FF99">NOKK</th>
      <th bgcolor="#99FF99">KAPASITAS</th>
      <th bgcolor="#99FF99">LANGGANAN</th>
      <th bgcolor="#99FF99">BUYER</th>
      <th bgcolor="#99FF99">NO PO</th>
      <th bgcolor="#99FF99">NO ORDER</th>
      <th bgcolor="#99FF99">JENIS KAIN</th>
      <th bgcolor="#99FF99">WARNA</th>
      <th bgcolor="#99FF99">NO WARNA</th>
      <th bgcolor="#99FF99">LOT</th>
      <th bgcolor="#99FF99">ROLL</th>
      <th bgcolor="#99FF99">QUANTITY</th>
      <th bgcolor="#99FF99">LOADING</th>
      <th bgcolor="#99FF99">PROSES</th>
      <th bgcolor="#99FF99">TARGET PROSES</th>
      <th bgcolor="#99FF99">LAMA PROSES</th>
      <th bgcolor="#99FF99">LAMA STOP</th>
    </tr>
    <?php
	$Awal=$_GET['awal'];
	$Akhir=$_GET['akhir'];	
	if($_GET['shft']=="ALL"){$shft=" ";}else{$shft=" if(ISNULL(a.g_shift),b.g_shift,a.g_shift)='$_GET[shft]' AND ";}
		$sql=mysqli_query($con,"SELECT
	a.kd_stop,
	a.mulai_stop,
	a.selesai_stop,
	a.ket,	if(ISNULL(TIMEDIFF(c.tgl_mulai,c.tgl_stop)),a.lama_proses,CONCAT(LPAD(FLOOR((((HOUR(a.lama_proses)*60)+MINUTE(a.lama_proses))-((HOUR(TIMEDIFF(c.tgl_mulai,c.tgl_stop))*60)+MINUTE(TIMEDIFF(c.tgl_mulai,c.tgl_stop))))/60),2,0),':',LPAD(((((HOUR(a.lama_proses)*60)+MINUTE(a.lama_proses))-((HOUR(TIMEDIFF(c.tgl_mulai,c.tgl_stop))*60)+MINUTE(TIMEDIFF(c.tgl_mulai,c.tgl_stop))))%60),2,0))) as lama_proses,
	a.status as sts_hasil,	TIME_FORMAT(if(ISNULL(TIMEDIFF(c.tgl_mulai,c.tgl_stop)),a.lama_proses,CONCAT(LPAD(FLOOR((((HOUR(a.lama_proses)*60)+MINUTE(a.lama_proses))-((HOUR(TIMEDIFF(c.tgl_mulai,c.tgl_stop))*60)+MINUTE(TIMEDIFF(c.tgl_mulai,c.tgl_stop))))/60),2,0),':',LPAD(((((HOUR(a.lama_proses)*60)+MINUTE(a.lama_proses))-((HOUR(TIMEDIFF(c.tgl_mulai,c.tgl_stop))*60)+MINUTE(TIMEDIFF(c.tgl_mulai,c.tgl_stop))))%60),2,0))),'%H') as jam,	TIME_FORMAT(if(ISNULL(TIMEDIFF(c.tgl_mulai,c.tgl_stop)),a.lama_proses,CONCAT(LPAD(FLOOR((((HOUR(a.lama_proses)*60)+MINUTE(a.lama_proses))-((HOUR(TIMEDIFF(c.tgl_mulai,c.tgl_stop))*60)+MINUTE(TIMEDIFF(c.tgl_mulai,c.tgl_stop))))/60),2,0),':',LPAD(((((HOUR(a.lama_proses)*60)+MINUTE(a.lama_proses))-((HOUR(TIMEDIFF(c.tgl_mulai,c.tgl_stop))*60)+MINUTE(TIMEDIFF(c.tgl_mulai,c.tgl_stop))))%60),2,0))),'%i') as menit,
	a.point,
	DATE_FORMAT(a.mulai_stop,'%Y-%m-%d') as t_mulai,
	DATE_FORMAT(a.selesai_stop,'%Y-%m-%d') as t_selesai,
	TIME_FORMAT(a.mulai_stop,'%H:%i') as j_mulai,
	TIME_FORMAT(a.selesai_stop,'%H:%i') as j_selesai,
	TIMESTAMPDIFF(MINUTE,a.mulai_stop,a.selesai_stop) as lama_stop_menit,
	a.acc_keluar,
	b.proses,
	b.buyer,
	b.langganan,
	b.no_order,
	b.jenis_kain,
	b.no_mesin,
	b.warna,
	b.lot,
	b.energi,
	b.dyestuff,	
	b.ket_status,
	b.kapasitas,
	b.loading,
	b.resep,
	b.kategori_warna,
	c.l_r,
	c.rol,
	c.bruto,
	c.pakai_air,
	DATE_FORMAT(c.tgl_buat,'%Y-%m-%d') as tgl_in,
	DATE_FORMAT(a.tgl_buat,'%Y-%m-%d') as tgl_out,
	DATE_FORMAT(c.tgl_buat,'%H:%i') as jam_in,
	DATE_FORMAT(a.tgl_buat,'%H:%i') as jam_out,
	if(ISNULL(a.g_shift),b.g_shift,a.g_shift) as shft,
	a.operator_keluar,
	b.nokk,
	b.no_warna,
	b.lebar,
	b.gramasi,
	c.carry_over,
	b.no_hanger,
	b.no_item,
	b.po,
	b.tgl_delivery,
	b.target,
	if((TIME_FORMAT(a.lama_proses,'%H')+round(TIME_FORMAT(a.lama_proses,'%i')/60,2))>b.target,'lebih','kurang') as jjm
FROM
	tbl_schedule b
	LEFT JOIN  tbl_montemp c ON c.id_schedule = b.id
	LEFT JOIN tbl_hasilcelup a ON a.id_montemp=c.id	
WHERE
	$shft 
	( DATE_FORMAT(a.tgl_buat,'%Y-%m-%d %H:%i') BETWEEN '$Awal' AND '$Akhir' OR b.`status`='sedang jalan') OR
	((b.ket_status='MC Stop' OR b.ket_status='Cuci Mesin' OR b.ket_status='MC Rusak') AND b.`status`='antri mesin')  
	ORDER BY
	b.no_mesin ASC");
  
   $no=1;
   
   $c=0;
   
    while($rowd=mysqli_fetch_array($sql)){
		   ?>
      <tr valign="top">
      <td><?php echo $no;?></td>
      <td>'<?php echo $rowd['no_mesin'];?></td>
      <td><?php echo $rowd['shft'];?></td>
      <td>'<?php echo $rowd['nokk'];?></td>
      <td><?php echo $rowd['kapasitas'];?></td>
      <td><?php echo $rowd['langganan'];?></td>
      <td><?php echo $rowd['buyer'];?></td>
      <td><?php echo $rowd['po'];?></td>
      <td><?php echo $rowd['no_order']; ?></td>
      <td><?php echo $rowd['jenis_kain'];?></td>
      <td><?php echo $rowd['warna']; ?></td>
      <td><?php echo $rowd['no_warna'];?></td>
      <td>'<?php echo $rowd['lot']; ?></td>
      <td align="right"><?php if($rowd['tgl_out']!=""){$rol=$rowd['rol'];}else{ $rol=" "; } echo $rol; ?></td>
      <td align="right"><?php if($rowd['tgl_out']!=""){$brt=$rowd['bruto'];}else{ $brt=" "; } echo $brt; ?></td>
      <td><?php echo $rowd['loading']; ?></td>
      <td><?php echo $rowd['proses']; ?></td>
      <td><?php echo cekDesimal($rowd['target']); ?></td>
      <td bgcolor="<?php if($rowd['jjm']=="lebih"){echo"yellow";} ?>"><?php if($rowd['lama_proses']!=""){echo $rowd['jam']." Jam ".$rowd['menit']." Menit";}?><br><?php echo $rowd['sts_hasil']; ?></td>
      <td><?php if($rowd['lama_stop_menit'] !=""){$jam=floor(round($rowd['lama_stop_menit'])/60);$menit=round($rowd['lama_stop_menit'])%60; echo $jam." Jam ".$menit." Menit";}?></td>
    </tr>
     <?php 
	 $totrol +=$rol;
	 $totberat +=$brt;
	 $no++;} ?>
    <tr>
       <td bgcolor="#99FF99">&nbsp;</td>
       <td bgcolor="#99FF99">&nbsp;</td>
       <td bgcolor="#99FF99">&nbsp;</td>
       <td bgcolor="#99FF99">&nbsp;</td>
       <td bgcolor="#99FF99">&nbsp;</td>
       <td bgcolor="#99FF99">&nbsp;</td>
       <td bgcolor="#99FF99">&nbsp;</td>
       <td bgcolor="#99FF99">&nbsp;</td>
       <td bgcolor="#99FF99">&nbsp;</td>
       <td bgcolor="#99FF99">&nbsp;</td>
       <td bgcolor="#99FF99">&nbsp;</td>
       <td bgcolor="#99FF99">&nbsp;</td>
       <td bgcolor="#99FF99">&nbsp;</td>
       <td bgcolor="#99FF99">&nbsp;</td>
       <td bgcolor="#99FF99">&nbsp;</td>
       <td bgcolor="#99FF99">&nbsp;</td>
       <td bgcolor="#99FF99">&nbsp;</td>
       <td bgcolor="#99FF99">&nbsp;</td>
       <td bgcolor="#99FF99">&nbsp;</td>
       <td bgcolor="#99FF99">&nbsp;</td>
    </tr>
    <tr>
      <td bgcolor="#99FF99">&nbsp;</td>
      <td bgcolor="#99FF99">&nbsp;</td>
      <td bgcolor="#99FF99">&nbsp;</td>
      <td bgcolor="#99FF99">&nbsp;</td>
      <td bgcolor="#99FF99">&nbsp;</td>
      <td bgcolor="#99FF99">&nbsp;</td>
      <td bgcolor="#99FF99">&nbsp;</td>
      <td bgcolor="#99FF99">&nbsp;</td>
      <td bgcolor="#99FF99">&nbsp;</td>
      <td bgcolor="#99FF99">&nbsp;</td>
      <th bgcolor="#99FF99">Total</th>
      <td bgcolor="#99FF99">&nbsp;</td>
      <th bgcolor="#99FF99">&nbsp;</th>
      <th bgcolor="#99FF99"><?php echo $totrol;?></th>
      <th bgcolor="#99FF99"><?php echo $totberat;?></th>
      <th bgcolor="#99FF99">&nbsp;</th>
      <th bgcolor="#99FF99">&nbsp;</th>
      <th bgcolor="#99FF99">&nbsp;</th>
      <td bgcolor="#99FF99">&nbsp;</td>
      <td bgcolor="#99FF99">&nbsp;</td>
    </tr>
</table>
</body>