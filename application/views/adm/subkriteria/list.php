						<div class="row-fluid">
							<div>
								<a href="<?php echo site_url('subkriteria/tambah') ?>" class="btn blue"><i class="icon-plus"></i> Tambah</a>
							</div>
						</div>
						<p></p>
						<div class="portlet box blue">
							<div class="portlet-title">
								<h4><i class="icon-reorder"></i>Data Sub-Kriteria</h4>
								<div class="tools">
									<a href="javascript:;" class="collapse"></a>
								</div>
							</div>
							<div class="portlet-body">
								<table class="table table-striped table-bordered" id="table_subkriteria">
									<thead>
										<tr>
											<th>Kode Kriteria</th>
											<th class="hidden-phone">Kriteria</th>
											<th class="hidden-phone">Nama Sub-Kriteria</th>
											<th class="hidden-phone">Jenis Nilai</th>
											<th class="hidden-phone">Ket.</th>
											<th class="hidden-phone">Aksi</th>
										</tr>
									</thead>
									<tbody>
									  <?php foreach ($subkriterias as $key => $subkriteria) { ?>
									  	<tr>
											<td><?php echo $subkriteria->kode_subkriteria ?></td>
											<td class="center"><?php echo $subkriteria->nama_kriteria ?></td>
											<td class="center"><?php echo $subkriteria->nama_subkriteria ?></td>
											<td class="center"><?php echo $subkriteria->jenis_nilai ?></td>
											<td><?php echo $subkriteria->keterangan; ?></td>
											<td class="center">
												<a class="btn mini" href="<?php echo site_url('subkriteria/edit/'.$subkriteria->kode_subkriteria) ?>">
													<i class="icon-edit icon-white"></i>  
													Ubah                                           
												</a>
												<a class="btn mini red hapus" data-kode="<?php echo $subkriteria->kode_subkriteria ?>" href="<?php echo site_url('subkriteria/hapus/'.$subkriteria->kode_subkriteria) ?>">
													<i class="icon-trash icon-white"></i> 
													Hapus
												</a>
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
				<h3>Hapus Kriteria/Subkriteria</h3>
			</div>
			<div class="modal-body">
				<p>Apakah Anda Yakin akan menghapus data ini?</p>
			</div>
			<div class="modal-footer">
				<a href="#" class="btn" data-dismiss="modal">Tidak</a>
				<a href="#" class="btn btn-primary" id="btn-ya">Ya</a>
			</div>
		</div>