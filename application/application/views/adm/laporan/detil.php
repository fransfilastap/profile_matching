						<div class="portlet box blue">
							<div class="portlet-title">
								<h4><i class="icon-reorder"></i>Detil Analisis</h4>
								<div class="tools">
									<a href="javascript:;" class="collapse"></a>
								</div>
							</div>
							<div class="portlet-body">
							<h3 class="block">Hasil Analisis</h3>
							<p></p>
							<h5 class="block"><?php echo "Profile Mutasi : ".$profile->nama_profil_mutasi; ?></h5>
							<legend>Parameter</legend>
							<table class="table table-bordered table-striped">
								<?php foreach ($parameter as $key => $prm) { ?>
									<tr>
										<td><?php echo $prm->parameter; ?></td>
										<td><?php echo $prm->persentase;?></td>
									</tr>
								<?php } ?>
							</table>
							<legend>Grafik Hasil Analisis</legend>
							<div id="chart_hasil" class="chart"></div>
							<legend>Tabel Peringkat Rekomendasi</legend>
							<table class="table table-hover table-striped table-bordered hasil">
								<thead>
									<tr>
										<th>Kode Pegawai</th>
										<th>Nama Pegawai</th>
										<?php foreach ($criteria as $key => $crit) { ?>
											<th class="hidden-phone"><?php echo $crit->nama_kriteria; ?></th>
										<?php } ?>	
										<th>Nilai Akhir</th>
									</tr>
								</thead>
								<tbody>
								<?php foreach ($tabel_hasil as $key => $hasil) { ?>
									<tr>
										<td><?php echo $hasil->kd_pegawai ?></td>
										<td><?php echo $hasil->nama_pegawai ?></td>
										<?php foreach ($criteria as $key => $crit) { ?>
											<td><?php echo $hasil->{$crit->the_key}; ?></td>
										<?php } ?>	
										<td><?php echo $hasil->hasil_akhir; ?></td>
									</tr>
								<?php } ?>
								</tbody>
							</table>
							</div>
						</div>