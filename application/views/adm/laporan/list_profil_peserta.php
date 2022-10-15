<!DOCTYPE html>

<html lang="en">
<head>

    <meta charset="utf-8" />
    <title></title>
    <style type="text/css" media="screen,print">
         /* required for GS1-128 */ 
         body{
            font-family: arial;
            font-size: 0.799em;
         }

         #heading{
         	margin: 0 auto;
         	text-align: center;
         }

         table{
         	border-collapse: collapse;
         }
         table tr,th,td{
         	border : 1px solid black;
         	padding: 2px;
         	margin: 0;
         	text-align: center;
         }

         table.list td{
         	text-align: center;
         }

         th.main{
         	background: #eee;
         }

         table.tableInner{
         	border-collapse: collapse;
         	table-layout: fixed;
         }

         table.tableInner tr{
			border: 0;
         }

         table.tableInner td{
         	width: 95px;
         	border: 0;
         }
		

         table.tableInner th{
         	font-weight: normal;
         	border: 0;
         	background-color: #eee;
         }

    </style>
	
<style type="text/css">
</style>
</head>
<body>
	<div id="heading">
		<h3>PT Asuransi Umum Bumiputera Muda 1967</h3>
		<h3>Sistem Pendukung Keputusan Pemindahan Tugas Pegawai</h3>
		<h3>PROFIL PESERTA</h3>
	</div>
	</br>
	</br>
	</br>	
	<table border="1" cellpadding="0" cellspacing="0" width="100%">
		<thead style="background: #eee;">
			<tr>
				<th class="main">No.</th>
				<th class="main">Kode Pegawai</th>
				<th class="main" style="width:200px">Nama Pegawai</th>
				<th class="main" style="width:300px">Pendidikan Formal</th>
				<th class="main" style="width:300px">Pendidikan Non Formal</th>
				<th class="main" style="width:300px">Riwayat Jabatan</th>
			</tr>
		</thead>
		<tbody>

		<?php 
		$i = 1;
		foreach ($profiles as $key => $profile) { ?>
			<tr>
				<td><?php echo $i; ?></td>
				<td style="width:70px"><?php echo $profile->kd_pegawai; ?></td>
				<td><?php echo $profile->nama_pegawai; ?></td>
				<td style="padding:0;vertical-align:top;">
				<?php if( count($profile->formal) > 0 ){ ?>
				<table class="tableInner" border="0" width="100%">
					<tr>
						<th>Jenjang</th>
						<th>Jurusan</th>
						<th>Masuk - Keluar</th>
						<th>IPK</th>
					</tr>
				<tbody>
				<?php foreach ($profile->formal as $key => $formal) { ?>
						<tr>
							<td><?php switch ($formal->tingkat) {
								case 1:
									echo "D3";
									break;
								case 2:
									echo "S1";
									break;
								case 3:
									echo "S2";
									break;
								case 4:
									echo "S3";
									break;
								default:
									echo "Undefined";
									break;
							} ?></td>
							<td><?php echo $formal->jurusan; ?></td>
							<td><?php echo $formal->tahun_masuk."-".$formal->tahun_keluar; ?></td>
							<td><?php echo $formal->nilai; ?></td>
						</tr>
				<?php } ?>
				</tbody>
				</table>				
				<?php } ?>
				</td>
				<td style="padding:0;vertical-align:top;">
				<?php if( count($profile->non_formal) > 0 ){ ?>
				<table class="tableInner" border="0" width="100%">
				<thead>
					<tr>
						<th>Kursus</th>
						<th>Tempat</th>
						<th>Lama</th>
						<th>Ket.</th>
					</tr>
				</thead>
				<tbody>
				<?php foreach ($profile->non_formal as $key => $non_formal) { ?>
						<tr>
							<td><?php echo $non_formal->nama_kursus; ?></td>
							<td><?php echo $non_formal->tempat; ?></td>
							<td><?php echo $non_formal->lamanya ?></td>
							<td><?php echo $non_formal->keterangan; ?></td>
						</tr>
				<?php } ?>
				</tbody>
				</table>				
				<?php } ?>					
				</td>
				<td style="padding:0;vertical-align:top;">
				<?php if( count($profile->jabatan) > 0 ){ ?>
				<table class="tableInner" border="0" width="100%">
				<thead>
					<tr>
						<th>Jabatan</th>
						<th>Perusahaan</th>
						<th>Masa jabatan</th>
					</tr>
				</thead>
				<tbody>
				<?php foreach ($profile->jabatan as $key => $jabatan) { ?>
						<tr>
							<td><?php echo $jabatan->jabatan; ?></td>
							<td><?php echo $jabatan->wilayah; ?></td>
							<td><?php echo $jabatan->dari." - ".$jabatan->sampai; ?></td>
						</tr>
				<?php } ?>
				</tbody>
				</table>				
				<?php } ?>					
				</td>				
			</tr>
		<?php 
		$i++;
		} ?>	
		</tbody>
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