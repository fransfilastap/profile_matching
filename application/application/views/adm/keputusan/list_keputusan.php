						<div class="portlet box blue">
							<div class="portlet-title">
								<h4><i class="icon-reorder"></i>Pengambilan Keputusan</h4>
								<div class="tools">
									<a href="javascript:;" class="collapse"></a>
								</div>
							</div>
							<div class="portlet-body">
								<table class="table table-hover table-bordered" id="table_history">
									<thead>
										<tr>
											<th>Jabatan</th>
											<th>Wilayah</th>
											<th>Jml. Kandidat</th>
											<th>Status Keputusan</th>
											<th>Aksi</th>
										</tr>
									</thead>
									<tbody>
										<?php foreach ($analisis as $key => $an) { ?>
										<tr>
											<td><?php echo $an->nama_profil_mutasi; ?></td>
											<td><?php echo $an->wilayah ?></td>
											<td><?php echo $an->jml_kandidat; ?></td>
											<td align="center"><strong><?php echo strtoupper( $an->status_keputusan ); ?></strong></td>
											<td>
												<a href="<?php echo site_url('laporan/cetak/'.$an->id_analisis.'/true') ?>" target="_blank" class="btn mini green"><i class="icon-print"></i> Cetak</a>
												<a href="<?php echo site_url('keputusan/id/'.$an->id_analisis) ?>" class="btn mini blue"><i class="icon-legal"></i> Keputusan</a>
											</td>
										</tr>
										<?php } ?>
									</tbody>
								</table>
							</div>
						</div>
								<div class="modal hide fade" id="truncateModal">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal">×</button>
										<h3>Hapus Riwayat</h3>
									</div>
									<div class="modal-body">
										<p>Apakah Anda Yakin akan menghapus semua data ini?</p>
									</div>
									<div class="modal-footer">
									<div id="heh" class="pull-left"><img src="<?php echo base_url('assets/img/ajax-loader.gif') ?>"> <i>Please Wait...</i></div>
										<a href="#" class="btn" data-dismiss="modal">Tidak</a>
										<a href="#" class="btn blue" id="btn-ya">Ya</a>
									</div>
								</div>
								<div class="modal hide fade" id="OkModal">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal">×</button>
										<h3>Hapus Riwayat</h3>
									</div>
									<div class="modal-body">
										<strong>Data berhasil dihapus</strong>
									</div>
									<div class="modal-footer">
										<a href="#" class="btn blue" id="btn_ok">Ok</a>
									</div>
								</div>