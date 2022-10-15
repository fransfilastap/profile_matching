						<div class="portlet box blue">
							<div class="portlet-title">
								<h4><i class="icon-reorder"></i>Nilai Kompetensi Pegawai</h4>
								<div class="tools">
									<a href="javascript:;" class="collapse"></a>
								</div>
							</div>
							<div class="portlet-body">
							<?php foreach ($kriterias as $key => $kriteria) { ?>
								<legend><?php echo ucfirst($kriteria['nama_kriteria']); ?></legend>
								<table class="table table-striped table-bordered profil">
									<thead>
										<tr>
											<th rowspan="3" class="hidden-phone" style="text-align:center;vertical-align:middle;">Kandidat</th>
											<th class="hidden-phone" style="text-align:center" colspan="6">Nilai</th>
										</tr>
										<tr>
										<?php foreach ($kriteria['child'] as $key => $subkriteria) { ?>
											<th class="hidden-phone" style="text-align:center;"><?php echo $subkriteria['kode_subkriteria']; ?></th>
										<?php } ?>
										</tr>
										<tr>
										<?php foreach ($kriteria['child'] as $key => $subkriteria) { ?>
											<th class="hidden-phone" style="font-size : 0.7em; height=20px; text-align: center;"><?php echo $subkriteria['nama_subkriteria']; ?></th>
										<?php } ?>											
										</tr>
									</thead>
									<tbody>
									</tbody>
								</table>
								<p></p>
								<p></p>
								<p></p>
								<p></p>
							<?php } ?>		
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