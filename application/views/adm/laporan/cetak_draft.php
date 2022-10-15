<!DOCTYPE html>

<html lang="en">
<head>

    <meta charset="utf-8" />
    <title>Laporan</title>

    <style type="text/css" media="screen,print">
         /* required for GS1-128 */ 
         body{
            font-family: arial;
            font-size: 0.799em;
         }
         table{
         	border-collapse: collapse;
         }
         table tr,th,td{

         	padding: 2px;
         	margin: 0;
         }

         table.list td{
         	text-align: center;
         }

         th{
         	background: #eee;
         }

    </style>
	
<style type="text/css">
</style>
</head>
<body>
	<table width="100%">
		<tr>
			<td colspan="8" style="text-align:center;">
				<h3>PT Asuransi Umum Bumiputera Muda 1967</h3>
			</td>
		</tr>
		<tr>
			<td colspan="8" style="text-align:center;">
				<h3>Sistem Pendukung Keputusan Pemindahan Tugas Pegawai</h3>
			</td>
		</tr>	
		<tr>
			<td colspan="8" style="text-align:center;">
				<h3>REKOMENDASI PEMINDAHAN TUGAS/JABATAN KARYAWAN</h3>
			</td>
		</tr>
		<tr>
			<td colspan="8" style="text-align:center;">
				<h4>JABATAN : <?php echo ucfirst( $profile->nama_profil_mutasi )." - ". $profile->wilayah; ?></h4>
			</td>
		</tr>
	</table>
	</br>
	</br>
	</br>
	</br>
	</br>
	</br>
	</br>
	</br>
	</br>
	</br>
	</br>
	</br>		
	<table border="1" cellpadding="0" cellspacing="0" class="list" width="100%">
		<tr>
			<th>No.</th>
			<th style="width:100px;">Kode Pegawai</th>
			<th>Nama Pegawai</th>
			<?php foreach ($criteria as $key => $crit) { ?>
				<th class="hidden-phone"><?php echo $crit->nama_kriteria; ?></th>
			<?php } ?>	
			<th>Nilai Akhir</th>
			<th>Keputusan</th>
		</tr>
		<?php $i = 1; ?>
		<?php foreach ($tabel_hasil as $key => $hasil) { ?>
			<tr>
				<td><?php echo $i; ?></td>
				<td><?php echo $hasil->kd_pegawai ?></td>
				<td><?php echo $hasil->nama_pegawai ?></td>
				<?php foreach ($criteria as $key => $crit) { ?>
					<td><?php echo $hasil->{$crit->the_key}; ?></td>
				<?php } ?>	
				<td><?php echo $hasil->hasil_akhir; ?></td>
				<td> Lulus / Tidak Lulus </td>
			</tr>
		<?php $i++; ?>
		<?php } ?>
	</table>	

	</br>
	</br>
	<!--
	<table border="1" cellpadding="0" cellspacing="0" class="list">
		<tr>
			<td colspan="2">
				Parameter
			</td>
		</tr>
		<?php foreach ($parameter as $key => $prm) { ?>
			<tr>
				<td><?php echo $prm->parameter; ?></td>
				<td><?php echo $prm->persentase;?></td>
			</tr>
		<?php } ?>

	</table>	
	-->
</body>

</html>