						<div class="row-fluid">
							<div>
								<a href="<?php echo site_url('pengguna/tambah') ?>" class="btn"><i class="icon-plus"></i> Tambah</a>
							</div>
						</div>
						<p></p>
						<div class="portlet box blue">
							<div class="portlet-title">
								<h4><i class="icon-reorder"></i>Data Pegawai</h4>
								<div class="tools">
									<a href="javascript:;" class="collapse"></a>
									<a href="#portlet-config" data-toggle="modal" class="config"></a>
									<a href="javascript:;" class="reload"></a>
									<a href="javascript:;" class="remove"></a>
								</div>
							</div>
							<div class="portlet-body">
								<table class="table table-striped table-bordered" id="table_pengguna">
									<thead>
										<tr>
											<td>User Id</td>
											<td class="hidden-phone">Nama</td>
											<td class="hidden-phone">Username</td>
											<td class="hidden-phone">Password</td>
											<td class="hidden-phone">Role</td>
											<td class="hidden-phone">Aksi</td>
										</tr>
									</thead>
									<tbody>
									<?php foreach ($users as $key => $user) { ?>
										<tr>
											<td><?php echo $user->id_user; ?></td>
											<td><?php echo $user->nama; ?></td>
											<td><?php echo $user->username; ?></td>
											<td>**********</td>
											<td><?php echo $user->role; ?></td>
											<td>
												<?php if( $user->id_user != $this->session->userdata( md5('user_id') ) ) { ?>
												<a href="<?php echo site_url('pengguna/ganti_password/'.$user->id_user);?>" class="btn mini green"><i class="icon-undo"></i> Ganti Password</a>	
												<?php } ?>																							
												<a href="<?php echo site_url('pengguna/edit/'.$user->id_user);?>" class="btn mini"><i class="icon-edit"></i>Edit</a>
												<?php if( $user->id_user != $this->session->userdata( md5('user_id') ) ) { ?>
												<a href="<?php echo site_url('pengguna/hapus/'.$user->id_user); ?>" class="btn mini red hapus"><i class="icon-trash"></i>Hapus</a>
												<?php } ?>
											</td>
										</tr>										
									<?php } ?>
									</tbody>
								</table>
								<p></p>
								<p></p>
								
							</div>
						</div>
		<div class="modal hide fade" id="deleteModal">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">×</button>
				<h3>Hapus Data Pegawai</h3>
			</div>
			<div class="modal-body">
				<p>Apakah Anda Yakin akan menghapus data ini?</p>
			</div>
			<div class="modal-footer">
				<a href="#" class="btn" data-dismiss="modal">Tidak</a>
				<a href="#" class="btn btn-primary" id="btn-ya">Ya</a>
			</div>
		</div>