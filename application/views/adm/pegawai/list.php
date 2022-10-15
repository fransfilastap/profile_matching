						<p></p>
						<div class="portlet box blue">
							<div class="portlet-title">
								<h4><i class="icon-reorder"></i>Data Pegawai</h4>
								<div class="tools">
									<a href="javascript:;" class="collapse"></a>
									<a href="#portlet-config" data-toggle="modal" class="config"></a>
									<a href="javascript:;" class="reload"></a>
									<a href="javascript:;" class="remove"></a>
								</div>
							</div>
							<div class="portlet-body">
								<div class="row-fluid">
									<div class="btn-group">
										<a href="<?php echo site_url('pegawai/tambah') ?>" class="btn blue"><i class="icon-plus"></i> Tambah</a>
									</div>
									<div class="btn-group pull-right">
										<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
										Tools <i class="icon-angle-down"></i>
										</a>
										<ul class="dropdown-menu">
											
											<li><a href="<?php echo site_url('laporan/daftar_pegawai_detil') ?>">Save as PDF</a></li>
											
										</ul>
									</div>
								</div>
								<table class="table table-striped table-bordered" id="table_pegawai">
									<thead>
										<tr>
											<td>Kode Pegawai</td>
											<td class="hidden-phone">Nama Pegawai</td>
											<td class="hidden-phone">Alamat</td>
											<td class="hidden-phone">Tempat Lahir</td>
											<td class="hidden-phone">Tanggal Lahir</td>
											<td class="hidden-phone">Diangkat Per</td>
											<td class="hidden-phone">Aksi</td>
										</tr>
									</thead>
									<tbody>
									<?php foreach ($pegawai as $key => $peg) { ?>
										<tr>
											<td><?php echo $peg->kd_pegawai; ?></td>
											<td><?php echo $peg->nama_pegawai; ?></td>
											<td><?php echo $peg->alamat; ?></td>
											<td><?php echo $peg->tempat_lahir; ?></td>
											<td><?php echo $peg->tanggal_lahir; ?></td>
											<td><?php echo $peg->diangkat_per; ?></td>
											<td>
												<a href="<?php echo site_url('pegawai/view/'.$peg->id);?>" class="btn mini blue"><i class="icon-zoom-in"></i>Detil</a>
												<a href="<?php echo site_url('pegawai/cetak/'.$peg->id);?>" class="btn mini green"><i class="icon-print"></i>Cetak</a>												
												<a href="<?php echo site_url('pegawai/edit/'.$peg->id);?>" class="btn mini"><i class="icon-edit"></i>Edit</a>
												<a href="<?php echo site_url('pegawai/hapus/'.$peg->id); ?>" class="btn mini red hapus"><i class="icon-trash"></i>Hapus</a>
											</td>
										</tr>										
									<?php } ?>
									</tbody>
								</table>
								<p></p>
								<p></p>
								
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