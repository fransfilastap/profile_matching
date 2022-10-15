<div class="well">
<strong>
<?php echo $profile->nama_profil_mutasi." - <i>".$profile->wilayah."</i>"; ?>
</strong>
</div>


						<div class="portlet box blue">
							<div class="portlet-title">
								<h4><i class="icon-reorder"></i>Rekomendasi</h4>
								<div class="tools">
									<a href="javascript:;" class="collapse"></a>
								</div>
							</div>
							<div class="portlet-body form">
								<form id="simpanKeputusan" class="form-horizontal" action="<?php echo site_url('simpan_keputusan'); ?>" method="POST">
								<input type="hidden" name="id_hasil" value="<?php echo $keputusan->id_hasil; ?>">
								<table class="table table-hover table-bordered" id="keputusan">
									<thead>
										<tr>
											<th>Rank</th>
											<th>Kode Pegawai</th>
											<th>Nama Pegawai</th>
											<?php foreach ($criteria as $key => $crit) { ?>
												<th class="hidden-phone"><?php echo $crit->nama_kriteria; ?></th>
											<?php } ?>	
											<th>Hasil Akhir</th>
											<th>Lulus/Tidak Lulus</th>
										</tr>
									</thead>
									<tbody>
										<?php 
										$no = 1;
										foreach ($decisions as $key => $hasil) { ?>
											<tr data-id="<?php echo $hasil->id ?>">
												<td><?php echo $no; ?></td>
												<td><?php echo $hasil->kd_pegawai ?></td>
												<td><?php echo $hasil->nama_pegawai ?></td>
												<?php foreach ($criteria as $key => $crit) { ?>
													<td><?php echo $hasil->{$crit->the_key}; ?></td>
												<?php } ?>	
												<td><?php echo $hasil->hasil_akhir; ?></td>
												<td>
													<select class="m-wrap span12" name="status">
														<option value="0" <?php echo $hasil->keputusan == 0 ? "selected" : ""?>>Tidak Lulus</option>
														<option value="1" <?php echo $hasil->keputusan == 1 ? "selected" : ""?>>Lulus</option>
													</select>
												</td>
											</tr>
										<?php 
										$no++;
										} ?>
									</tbody>
								</table>
								<div class="form-actions clearfix">
									<button type="submit" class="btn blue"><i class="icon-save"></i> Simpan</button>
									
									</form>
								</div>
							</div>
						</div>
								<div class="modal hide fade" id="confirmModal">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal">×</button>
										<h3>Simpan Keputusan</h3>
									</div>
									<div class="modal-body">
										<p> Apakah anda yakin dengan keputusan ini ? </p>
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
										<h3>Notifikasi</h3>
									</div>
									<div class="modal-body">
										<strong>Keputusan telah disimpan. </strong>
									</div>
									<div class="modal-footer">
										<a href="#" class="btn blue" id="btn_ok">Ok</a>
									</div>
								</div>