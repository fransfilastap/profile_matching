						<div class="row-fluid">
							<div>
								<a href="<?php echo site_url('profil_mutasi/tambah') ?>" class="btn blue"><i class="icon-plus"></i> Tambah</a>
							</div>
						</div>
						<p></p>
						<div class="portlet box blue">
							<div class="portlet-title">
								<h4><i class="icon-reorder"></i>Data Profil Mutasi</h4>
								<div class="tools">
									<a href="javascript:;" class="collapse"></a>
								</div>
							</div>
							<div class="portlet-body">
								<table class="table table-striped table-bordered" id="profil">
									<thead>
										<tr>
											<th>Nama Jabatan</th>
											<th>Wilayah</th>
											<th>Min. Pendidikan</th>
											<th>Min. IPK</th>
											<th class="hidden-phone">Aksi</th>
										</tr>
									</thead>
									<tbody>
									  <?php foreach ($profiles as $key => $profile) { ?>
									  	<tr>
											<td><?php echo $profile->nama_profil_mutasi ?></td>
											<td><?php echo $profile->wilayah;?></td>
											<td><?php switch ($profile->pendidikan_minimum) {
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
													echo "undefined";
													break;
											} ?></td>
											<td><?php echo $profile->nilai; ?></td>
											<td class="center">
												<a href="<?php echo site_url('profil_mutasi/edit/'.$profile->id_pm) ?>" class="btn mini"><i class="icon-edit"></i> Ubah</a>
												<a href="<?php echo site_url('profil_mutasi/hapus/'.$profile->id_pm) ?>" class="btn mini red hapus"><i class="icon-trash"></i> Hapus</a>
											</td>
										</tr>
									  <?php } ?>
									</tbody>
								</table>
							</div>
						</div>
		<div class="modal hide fade" id="deleteModal">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">×</button>
				<h3>Hapus Profil Jabatan</h3>
			</div>
			<div class="modal-body">
				<p>Apakah Anda Yakin akan menghapus data ini?</p>
			</div>
			<div class="modal-footer">
				<a href="#" class="btn" data-dismiss="modal">Tidak</a>
				<a href="#" class="btn btn-primary" id="btn-ya">Ya</a>
			</div>
		</div>