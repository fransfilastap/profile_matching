<html>
<head>
	<style>
	body{
		text-align: center;
	}
	table {
    border-collapse: collapse;
    margin:0px auto;
	}
	table, th, td{
		border-top:1px solid #000;
	}

	td{
	}

	thead tr{
		background:#eee;
		height:40px;
	}

	h3{	
		margin-top: 100px;
	}
	</style>
</head>
<body>

<center>
<h3>Biodata</h3><hr>
	<table class='table table-striped' style='width:100%;margin:15px' id='datatables'>
		<tr><td style='font-weight:bold'>Kode Pegawai</td><td>:</td><td>  <?php echo $pegawai->kd_pegawai?></td></tr>
		<tr><td style='font-weight:bold'>Nama </td><td>:</td><td>  <?php echo $pegawai->nama_pegawai?></td></tr>
		<tr><td style='font-weight:bold'>Tempat, Tanggal Lahir</td><td>: </td><td> <?php echo $pegawai->tempat_lahir.", ".$pegawai->tanggal_lahir ?></td></tr>
		<tr><td style='font-weight:bold'>Jenis Kelamin</td><td>:</td><td>  <?php echo ( $pegawai->jenis_kelamin == "L" ? "Laki-laki" : "Perempuan" ) ?></td></tr>
		<tr><td style='font-weight:bold'>Alamat</td><td>: </td><td> <?php echo $pegawai->alamat?></td></tr>
	</table>

	<h3>Pendidikan Formal</h3><hr>
	<table width="100%" style='width:80%;margin:15px' id='datatables'>
	<thead>
		<tr style="background:#eee;">
			<td>Jenjang</td>
			<td>Institusi</td>
			<td>Jurusan</td>
			<td>Tahun Masuk</td>
			<td>Tahun Keluar</td>
			<td>IPK</td>
		</tr>
	</thead>
	<tbody>
	<?php foreach ($pegawai->formal as $key => $formal) { ?>
	<tr>
		<td>  <?php switch ($formal->tingkat) {
			case 1 :
				echo "D3";
				break;
			case 2 :
				echo "S1";
				break;
			case 3 :
				echo "S2";
				break;
			case 4 :
				echo "S3";
				break;
			
			default:
				echo "Undefined";
				break;
		}?></td>
		<td>  <?php echo $formal->institusi?></td>
		<td> <?php echo $formal->jurusan?></td>
		<td> <?php echo $formal->tahun_masuk?></td>
		<td> <?php echo $formal->tahun_keluar?></td>
		<td>  <?php echo $formal->nilai?></td>
	</tr>	
	<?php } ?>
	</tbody>
	</table>

	<h3>Pendidikan Non Formal</h3>
	<table border="0" width="100%">
	<thead>
		<tr>
			<th>Kursus</th>
			<th>Tempat</th>
			<th>Lama</th>
			<th>Ket.</th>
		</tr>
	</thead>
	<tbody>
	<?php foreach ($pegawai->non_formal as $key => $non_formal) { ?>
			<tr>
				<td><?php echo $non_formal->nama_kursus; ?></td>
				<td><?php echo $non_formal->tempat; ?></td>
				<td><?php echo $non_formal->lamanya ?></td>
				<td><?php echo $non_formal->keterangan; ?></td>
			</tr>
	<?php } ?>
	</tbody>
	</table>
	
	<h3>Riwayat Jabatan</h3>	
				<table class="tableInner" border="0" width="100%">
				<thead>
					<tr>
						<th>Jabatan</th>
						<th>Perusahaan</th>
						<th>Masa jabatan</th>
					</tr>
				</thead>
				<tbody>
				<?php foreach ($pegawai->jabatan as $key => $jabatan) { ?>
						<tr>
							<td><?php echo $jabatan->jabatan; ?></td>
							<td><?php echo $jabatan->wilayah; ?></td>
							<td><?php echo $jabatan->dari." - ".$jabatan->sampai; ?></td>
						</tr>
				<?php } ?>
				</tbody>
				</table>	
</center>
</body>
</html>