						<div class="portlet box blue">
							<div class="portlet-title">
								<h4><i class="icon-reorder"></i>Pemilihan Kandidat Seleksi</h4>
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
											<th>Kandidat</th>
											<th class="hidden-phone">Aksi</th>
										</tr>
									</thead>
									<tbody>
									  <?php foreach ($profiles as $key => $profile) { ?>
									  	<tr>
											<td><?php echo $profile->nama_profil_mutasi ?></td>
											<td><?php echo $profile->wilayah;?></td>
											<th><a href=""> <?php echo $profile->jumlah_kandidat." Kandiat"; ?> </a></th>
											<td class="center">
												<a href="<?php echo site_url('kandidat/'.$profile->id_pm.'/pilih_kandidat') ?>" class="btn mini"><i class="icon-edit"></i> Pilih Kandidat</a>
												<a href="#" class="btn mini blue ranking" data-total="<?php echo $profile->jumlah_kandidat; ?>" data-id="<?php echo $profile->id_pm; ?>"><i class="icon-edit"></i> Rangking</a>
												<div class="loading"></div>
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