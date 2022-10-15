<h3 class="block">Hasil Analisis</h3>
<p></p>
<h5 class="block"><?php echo "Profile Mutasi : <strong>".$profile->nama_profil_mutasi."</strong> - <i>".$profile->wilayah."</i>"; ?></h5>
<legend>Parameter</legend>
<table class="table table-bordered table-striped">
	<?php foreach ($parameter as $key => $prm) { ?>
		<tr>
			<td><?php echo $prm->parameter; ?></td>
			<td><?php echo $prm->persentase;?></td>
		</tr>
	<?php } ?>
</table>
<legend>Grafik Hasil Analisis</legend>
<div id="chart_hasil" class="chart"></div>
<legend>Tabel Rekomendasi</legend>
<table class="table table-hover table-striped table-bordered hasil">
	<thead>
		<tr>
			<th>#</th>
			<th>Kode Pegawai</th>
			<th>Nama Pegawai</th>
			<?php foreach ($criteria as $key => $crit) { ?>
				<th class="hidden-phone"><?php echo $crit->nama_kriteria; ?></th>
			<?php } ?>	
			<th>Nilai Akhir</th>
		</tr>
	</thead>
	<tbody>
	<?php 
	$no = 1;
	foreach ($tabel_hasil as $key => $hasil) { ?>
		<tr>
			<td><?php echo $no; ?></td>
			<td><?php echo $hasil->kd_pegawai ?></td>
			<td><?php echo $hasil->nama_pegawai ?></td>
			<?php foreach ($criteria as $key => $crit) { ?>
				<td><?php echo $hasil->{$crit->the_key}; ?></td>
			<?php } ?>	
			<td><?php echo $hasil->hasil_akhir; ?></td>
		</tr>
	<?php 
	$no++;
	} ?>
	</tbody>
</table>
