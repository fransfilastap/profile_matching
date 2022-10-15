						<div class="portlet box blue">
							<div class="portlet-title">
								<h4><i class="icon-user"></i>Detil Kriteria</h2></h4>
								<div class="tools">
									<a href="javascript:;" class="collapse"></a>
								</div>
							</div>
							<div class="portlet-body">
						<legend>Kriteria</legend>
						<div class="form-actions">
						 	<a href="<?php echo site_url('kriteria/edit/'.$kriteria->kode_kriteria) ?>" class="btn green">
						 		<i class="icon-edit"></i> Edit
						 	</a>
						 	<a href="<?php echo site_url('kriteria') ?>" class="btn"><i class="icon icon-black icon-undo"></i> Kembali</a>
						 </div>
						<table id="view" class="table table-bordered table-striped" style="tr td:first-child{width:20%;}">
							  <tbody>
								<tr>
									<td>Kode Kriteria</td>
									<td><?php echo $kriteria->kode_kriteria; ?></td>                                    
								</tr>
								<tr>
									<td>Nama Kriteria</td>
									<td><?php echo $kriteria->nama_kriteria; ?></td>                                    
								</tr>
								<tr>
									<td>Keterangan</td>
									<td><?php echo $kriteria->keterangan; ?></td>                                    
								</tr>
							  </tbody>
						 </table> 
						 <legend>Subkriteria</legend>
						 <div class="well">
						 	<a href="<?php echo site_url('subkriteria/tambah/'.$kriteria->kode_kriteria) ?>" class="btn blue"><i class="icon-plus"></i>Tambah Subkriteria</a>
						 </div>
						 <table class="table table-bordered table-striped">
						 	<thead>
						 		<tr>
						 			<th>Kode Subkriteria</th>
						 			<th>Nama Subkriteria</th>
						 			<th>Keterangan</th>
						 			<th>Actions</th>
						 		</tr>
						 	</thead>
						 	<tbody>
						 	<?php if( count($subkriterias) <= 0 ){ ?>
						 		<tr><td colspan="4">Tidak ada subkriteria</td></tr>
						 	<?php }else{ ?>
						 		<?php foreach ($subkriterias as $key => $subkriteria) { ?>
							 		<tr>
							 			<td><?php echo $subkriteria['kode_subkriteria']; ?></td>
							 			<td><?php echo $subkriteria['nama_subkriteria']; ?></td>
							 			<td><?php echo $subkriteria['keterangan']; ?></td>
									 	<td class="center">
											<a class="btn mini" href="<?php echo site_url('subkriteria/edit/'.$subkriteria['id_subkriteria']) ?>">
												<i class="icon-edit icon-white"></i>  
												Ubah                                            
											</a>
											<a class="btn red mini hapus" data-kode="<?php echo $subkriteria['kode_subkriteria'] ?>" href="<?php echo site_url('subkriteria/hapus/'.$subkriteria['kode_subkriteria']) ?>">
												<i class="icon-trash icon-white"></i> 
												Hapus
											</a>
										</td>
							 		</tr>
						 		<?php } ?>
						 	<?php } ?>
						 	</tbody>
						 </table>
						 <div class="form-actions">
						 	<a href="<?php echo site_url('kriteria/edit/'.$kriteria->kode_kriteria) ?>" class="btn green">
						 		<i class="icon-edit"></i> Edit
						 	</a>
						 	<a href="<?php echo site_url('kriteria') ?>" class="btn"><i class="icon icon-black icon-undo"></i> Kembali</a>
						 </div>
					</div>
				</div><!--/span-->
							<div class="modal hide fade" id="deleteModal">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">×</button>
				<h3>Hapus Sub-kriteria</h3>
			</div>
			<div class="modal-body">
				<p>Apakah Anda Yakin akan menghapus data ini?</p>
			</div>
			<div class="modal-footer">
				<a href="#" class="btn" data-dismiss="modal">Tidak</a>
				<a href="#" class="btn blue" id="btn-ya">Ya</a>
			</div>
		</div>							
							</div>
						</div>