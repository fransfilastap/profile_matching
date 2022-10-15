
<div class="portlet box blue">
	<div class="portlet-title">
		<h4><i class="icon-user"></i>Detil Data Pegawai</h2></h4>
		<div class="tools">
			<a href="javascript:;" class="collapse"></a>
		</div>
	</div>
	<div class="portlet-body">
		<div class="form-actions">
			<a href="<?php echo site_url('pegawai/edit/'.$pegawai->id) ?>"  class="btn green"><i class="icon-edit"></i> Edit</a>
			<a href="<?php echo site_url('pegawai/hapus/'.$pegawai->id) ?>" data-kode="<?php echo $pegawai->id; ?>" class="btn hapus red"><i class="icon-trash"></i> Hapus</a>
			<a href="<?php echo site_url('pegawai') ?>" class="btn"><i class="icon-edit"></i> Kembali</a>
		</div>
		<legend>Data Pribadi</legend>
		<table class="table table-bordered table-striped table-hover">
			<tr>
				<td style="width:150px;">Kode Pegawai</td>
				<td><?php echo $pegawai->kd_pegawai; ?></td>
			</tr>
			<tr>
				<td>Nama</td>
				<td><?php echo $pegawai->nama_pegawai; ?></td>
			</tr>
			<tr>
				<td>Tempat Lahir</td>
				<td><?php echo $pegawai->tempat_lahir; ?></td>
			</tr>
			<tr>
				<td>Tanggal Lahir</td>
				<td><?php echo $pegawai->tanggal_lahir; ?></td>
			</tr>
			<tr>
				<td>Jenis Kelamin</td>
				<td><?php echo $pegawai->jenis_kelamin; ?></td>
			</tr>			
			<tr>
				<td>Alamat</td>
				<td><?php echo $pegawai->alamat; ?></td>
			</tr>

		</table>
		<legend>Pendidikan Formal</legend>
		<table class="table table-bordered table-striped table-hover">
			<thead>
				<tr>
					<th>Jenjang</th>
					<th>Institusi</th>
					<th>Jurusan</th>
					<th>Tahun Masuk</th>
					<th>Tahun Keluar</th>
					<th>IPK</th>
				</tr>
			</thead>
			<tbody>
			<?php foreach ($pendidikans as $key => $pendidikan) { ?>
				<tr>
					<td><?php echo $pendidikan->jenjang_pendidikan; ?></td>
					<td><?php echo $pendidikan->institusi; ?></td>
					<td><?php echo $pendidikan->jurusan; ?></td>
					<td><?php echo $pendidikan->tahun_masuk; ?></td>
					<td><?php echo $pendidikan->tahun_keluar; ?></td>
					<td><?php echo $pendidikan->nilai; ?></td>
				</tr>
			<?php }?>
			</tbody>
		</table>
		<legend>Pendidikan Non Formal</legend>
		<table class="table table-bordered table-striped table-hover">
			<thead>
	            <tr>
	            	<th class="hidden-phone">Nama Kursus</th>
	            	<th class="hidden-phone">Tempat</th>
	            	<th class="hidden-phone">Lamanya</th>
	            	<th class="hidden-phone">Keterangan</th>
	            </tr>
			</thead>
			<tbody>
			<?php foreach ($pendidikanNonFormal as $key => $pnf) { ?>
				<tr>
					<td><?php echo $pnf->nama_kursus; ?></td>
					<td><?php echo $pnf->tempat; ?></td>
					<td><?php echo $pnf->lamanya; ?></td>
					<td><?php echo $pnf->keterangan; ?></td>
				</tr>
			<?php }?>
			</tbody>
		</table>	
		<legend>Riwayat Jabatan</legend>
		<table class="table table-bordered table-striped table-hover">
			<thead>
	            <tr>
	             	<th class="hidden-phone">Jabatan</th>
	             	<th class="hidden-phone">Perusahaan</th>
	             	<th class="hidden-phone">Tahun</th>
	             	<th class="hidden-phone">Ket.</th>
	            </tr>
			</thead>
			<tbody>
			<?php foreach ($jabatans as $key => $jabatan) { ?>
				<tr>
					<td><?php echo $jabatan->jabatan; ?></td>
					<td><?php echo $jabatan->wilayah; ?></td>
					<td><?php echo $jabatan->dari;  ?></td>
					<td><?php echo $jabatan->keterangan; ?></td>
				</tr>
			<?php }?>
			</tbody>
		</table>						
		<div class="form-actions">
			<a href="<?php echo site_url('pegawai/edit/'.$pegawai->id) ?>"  class="btn green"><i class="icon-edit"></i> Edit</a>
			<a href="<?php echo site_url('pegawai/hapus/'.$pegawai->id) ?>" data-kode="<?php echo $pegawai->id; ?>" class="btn hapus red"><i class="icon-trash"></i> Hapus</a>
			<a href="<?php echo site_url('pegawai') ?>" class="btn"><i class="icon-edit"></i> Kembali</a>
		</div>
	</div>
</div>
		<div class="modal hide fade" id="deleteModal">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">×</button>
				<h3>Hapus Data Pegawai</h3>
			</div>
			<div class="modal-body">
				<p>Apakah Anda Yakin akan menghapus data ini?</p>
			</div>
			<div class="modal-footer">
				<a href="#" class="btn" data-dismiss="modal">Tidak</a>
				<a href="#" class="btn btn-primary" id="btn-ya">Ya</a>
			</div>
		</div>