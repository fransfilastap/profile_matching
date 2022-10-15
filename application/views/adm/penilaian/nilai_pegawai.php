						<!-- BEGIN TAB PORTLET-->   
						<div class="portlet box blue">
							<div class="portlet-title">
								<h4><i class="icon-reorder"></i>Nilai Kompetensi Pegawai</h4>
							</div>
							<div class="portlet-body form">
								<h3 class="block">Pilih Aspek Penilaian</h3>
								<div class="accordion" id="accordion1">
									<?php foreach ($kriterias as $key => $kriteria) { ?>
										<div class="accordion-group">
											<div class="accordion-heading">
												<a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse_<?php echo $key; ?>">
												<i class="icon-key"></i>
												<?php echo ucwords($kriteria['nama_kriteria']); ?>
												</a>
											</div>
											<div id="collapse_<?php echo $key; ?>" class="accordion-body collapse">
												<div class="accordion-inner">
														<table id="kriteria<?php echo $kriteria['id_kriteria']; ?>" class="table table-striped table-bordered profil ">
														<thead>
															<tr>
																<th rowspan="3" class="hidden-phone" style="text-align:center;vertical-align:middle;">Kode/Nama Pegawai</th>
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
															<?php foreach ($pegawais as $key => $pegawai) { ?>
															<tr data-id="<?php echo $pegawai['id']; ?>">
																<td><a target="_blank" href="<?php echo site_url('pegawai/view/'.$pegawai['id']); ?>"><?php echo $pegawai['nama_pegawai']; ?></a></td>
																<?php foreach ($kriteria['child'] as $key => $subkriteria) { ?>
																<td data-id="<?php echo $subkriteria['id_subkriteria']; ?>" style="text-align:center;">
																	<select class="span8 m-wrap nilai"> 
																		<?php for ($i=1; $i < 6 ; $i++) { ?>
																			<option value="<?php echo $i; ?>" <?php echo ( $pegawai['subs_value'][$kriteria['id_kriteria']][$key][$subkriteria['id_subkriteria']]== $i )? "selected" :""; ?>>
																				<?php echo $i; ?>
																			</option>
																		<?php } ?>
																	</select>
																</td>
																<?php } ?>														
															</tr>
															<?php } ?>
														</tbody>
													</table>
												</div>
											</div>
										</div>
									<?php } ?>
									<p></p>
									<p></p>
									<div id="ajax_loader"></div>
									<div class="form-actions clearfix">
										<a href="<?php echo site_url('penilaian/penilaian_pegawai') ?>" class="btn green proses"><i class='icon-save'></i> Simpan</a>
									</div>	
							</div>
						</div>
						<!-- END TAB PORTLET-->