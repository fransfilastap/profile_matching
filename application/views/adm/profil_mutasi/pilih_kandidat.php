
						<div class="portlet box blue">
							<div class="portlet-title">
								<h4><i class="icon-reorder"></i>Pilih Kandidat</h4>
								<div class="tools">
									<a href="javascript:;" class="collapse"></a>
									<a href="#portlet-config" data-toggle="modal" class="config"></a>
									<a href="javascript:;" class="reload"></a>
									<a href="javascript:;" class="remove"></a>
								</div>
							</div>
							<div class="portlet-body">
								<div class="well">
									<h5 style="font-weight:bolder;">Jabatan 		: <?php echo $profil_mutasi->nama_profil_mutasi; ?></h5>
									<h5 style="font-weight:bolder;">Wilayah 		: <?php echo $profil_mutasi->wilayah; ?></h5>
									<h5 style="font-weight:bolder;">Min. Pendidikan : <?php switch ($profil_mutasi->pendidikan_minimum) {
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
									} ?></h5>
									<h5 style="font-weight:bolder;">Min. IPK		: <?php echo $profil_mutasi->nilai; ?></h5>
								</div>
								<div class="row-fluid">
									<div class="btn-group pull-right">
										<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
										Tools <i class="icon-angle-down"></i>
										</a>
										<ul class="dropdown-menu">
											
											<li><a href="<?php echo site_url('laporan/daftar_pegawai_detil/'.$profil_mutasi->id_pm) ?>">Save as PDF</a></li>
											
										</ul>
									</div>
								</div>
								<table class="table table-striped table-bordered" id="table_pegawai">
									<thead>
										<tr>
											<th style="width:8px;"><input type="checkbox" class="group-checkable" data-set="#table_pegawai .checkboxes" /></th>
											<td class="hidden-phone">Kode Pegawai</td>
											<td class="hidden-phone">Nama Pegawai</td>
											<td class="hidden-phone">Alamat</td>
											<td class="hidden-phone">Tempat Lahir</td>
											<td class="hidden-phone">Tanggal Lahir</td>
											<td class="hidden-phone">Diangkat Per</td>
											<td class="hidden-phone">Pendidikan</td>
											<td class="hidden-phone">Jurusan</td>
											<td class="hidden-phone">IPK</td>
											<td class="hidden-phone">Aksi</td>
										</tr>
									</thead>
									<tbody>
									<?php foreach ($pegawai as $key => $peg) { ?>
										<tr>
											<td><input type="checkbox" class="checkboxes" value="<?php echo $peg->id
											; ?>" /></td>
											<td><?php echo $peg->kd_pegawai; ?></td>
											<td><?php echo $peg->nama_pegawai; ?></td>
											<td><?php echo $peg->alamat; ?></td>
											<td><?php echo $peg->tempat_lahir; ?></td>
											<td><?php echo $peg->tanggal_lahir; ?></td>
											<td><?php echo $peg->diangkat_per; ?></td>
											<td><?php echo $peg->tingkat_text; ?></td>
											<td><?php echo $peg->jurusan; ?></td>
											<td><?php echo $peg->nilai; ?></td>
											<td>
												<a href="<?php echo site_url('pegawai/cetak/'.$peg->id);?>" class="btn mini blue"><i class="icon-print"></i> Cetak</a>												
												<a href="<?php echo site_url('pegawai/view/'.$peg->id);?>" class="btn mini"><i class="icon-zoom-in"></i>Detil</a>
											</td>
										</tr>										
									<?php } ?>
									</tbody>
								</table>
								<div class="row-fluid">
									<div class="btn-group pull-left">
									<a href="<?php echo site_url('simpan_kandidat') ?>" id="simpan" data-id="<?php echo $id; ?>" class="btn blue"><i class="icon-save"></i> Simpan Kandidat</a>
									<div class="loading" style="margin-left: 10px;">
										<img src="<?php echo base_url('assets/img/ajax-loader.gif') ?>">
									</div>
									</div>
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