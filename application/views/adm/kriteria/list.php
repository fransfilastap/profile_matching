						<div class="row-fluid">
							<div>
								<a href="<?php echo site_url('kriteria/tambah') ?>" class="btn blue"><i class="icon-plus"></i> Tambah</a>
							</div>
						</div>
						<p></p>
						<div class="portlet box blue">
							<div class="portlet-title">
								<h4><i class="icon-reorder"></i>Data Kriteria</h4>
								<div class="tools">
									<a href="javascript:;" class="collapse"></a>
									<a href="#portlet-config" data-toggle="modal" class="config"></a>
									<a href="javascript:;" class="reload"></a>
									<a href="javascript:;" class="remove"></a>
								</div>
							</div>
							<div class="portlet-body">
								<table class="table table-striped table-bordered" id="sample_1">
									<thead>
										<tr>
											<th>Kode Kriteria</th>
											<th class="hidden-phone">Nama Kriteria</th>
											<th class="hidden-phone">Keterangan</th>
											<th class="hidden-phone">Aksi</th>
										</tr>
									</thead>
									<tbody>
									  <?php foreach ($kriterias as $key => $kriteria) { ?>
									  	<tr>
											<td><?php echo $kriteria->kode_kriteria ?></td>
											<td class="center"><?php echo $kriteria->nama_kriteria ?></td>
											<td><?php echo $kriteria->keterangan; ?></td>
											<td class="center">
												<a class="btn green mini" href="<?php echo site_url('kriteria/lihat/'.$kriteria->kode_kriteria) ?>">
													<i class="icon-zoom-in icon-white"></i>  
													View                                            
												</a>
												<a class="btn mini" href="<?php echo site_url('kriteria/edit/'.$kriteria->kode_kriteria) ?>">
													<i class="icon-edit icon-white"></i>  
													Edit                                            
												</a>
												<a class="btn red mini hapus" data-kode="<?php echo $kriteria->kode_kriteria ?>" href="<?php echo site_url('kriteria/hapus/'.$kriteria->kode_kriteria) ?>">
													<i class="icon-trash icon-white"></i> 
													Delete
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