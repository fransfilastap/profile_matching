						<div class="portlet box blue">
							<div class="portlet-title">
								<h4><i class="icon-user"></i><?php echo (isset( $pegawai ) ? "Edit" : "Tambah" ) ?> Pegawai</h2></h4>
								<div class="tools">
									<a href="javascript:;" class="collapse"></a>
								</div>
							</div>
							<div class="portlet-body">
							<?php if( $this->session->flashdata('error') != "" ){ ?>
							<div class="alert alert-warning alert-dismissible" role="alert">
							  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							  <strong>Warning!</strong> <?php echo $this->session->flashdata('error'); ?>
							</div>
							<?php } 
							if( $this->session->flashdata('success') != '' ){ ?>
							<div class="alert alert-success alert-dismissible" role="alert">
							  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							  <?php echo $this->session->flashdata('success') ?>
							</div>
							<?php }?>
								<form id="tambahPegawai" class="form-horizontal" action="<?php echo site_url("pegawai/simpan") ?>" method="post"> 
								<div class="control-group">
	                              <label class="control-label">Kode Pegawai</label>
	                              <div class="controls">
	                                 <input type="text" name="kode_pegawai" class="span8 m-wrap" />
	                                 <span class="help-inline"></span>
	                              </div>
	                           </div>	
								<div class="control-group">
	                              <label class="control-label">Nama Pegawai</label>
	                              <div class="controls">
	                                 <input type="text" name="nama_pegawai" class="span8 m-wrap" />
	                                 <span class="help-inline"></span>
	                              </div>
	                           </div>                           
	                           	<div class="control-group">
	                              <label class="control-label">Tempat Lahir</label>
	                              <div class="controls">
	                                 <input type="text" name="tempat_lahir" class="span8 m-wrap" />
	                                 <span class="help-inline"></span>
	                              </div>
	                           </div>
								<div class="control-group">
	                              <label class="control-label">Jenis Kelamin</label>
	                              <div class="controls">
	                                 <select name="jenis_kelamin" class="span8 m-wrap">
	                                 	<option value="L">Laki-laki</option>
	                                 	<option value="P">Perempuan</option>
	                                 </select>
	                                 <span class="help-inline"></span>
	                              </div>
	                           </div>		                           
	                           <div class="control-group">
	                              <label class="control-label">Tanggal Lahir</label>
	                              <div class="controls">
	                                 <div class="input-append date date-picker" data-date="2012-02-12" data-date-format="yyyy-mm-dd">
	                                    <input name="tanggal_lahir" class="m-wrap m-ctrl-medium date-picker" size="16" type="text" value="2012-02-12" /><span class="add-on"><i class="icon-calendar"></i></span>
	                                 </div>
	                              </div>
	                           </div>	
	                          <div class="control-group">
	                              <label class="control-label">Alamat</label>
	                              <div class="controls">
	                                 <textarea name="alamat" id="alamat" class="span6 m-wrap" rows="3"></textarea>
	                              </div>
	                           </div>
	                           <div class="control-group">
	                              <label class="control-label">Tanggal Diangkat</label>
	                              <div class="controls">
	                                 <div class="input-append date date-picker" data-date="2012-02-12" data-date-format="yyyy-mm-dd">
	                                    <input name="diangkat_per" class="m-wrap m-ctrl-medium date-picker" size="16" type="text" value="2012-02-12" /><span class="add-on"><i class="icon-calendar"></i></span>
	                                 </div>
	                              </div>
	                           </div>
	                           <div class="control-group">
	                              <label class="control-label">Pendidikan Formal</label>
	                              <div class="controls">
	                              	<table id="pendidikan" class="table table-bordered table-advance" style="position: relative;top:-18px">
	                              		<thead>
	                              			<tr>
	                              				<th class="hidden-phone">Tingkat</th>
	                              				<th class="hidden-phone">Institusi</th>
	                              				<th class="hidden-phone">Jurusan</th>
	                              				<th class="hidden-phone">Tahun Masuk</th>
	                              				<th class="hidden-phone">Tahun Keluar</th>
	                              				<th class="hidden-phone">IPK</th>
	                              				<th class="hidden-phone">Aksi</th>
	                              			</tr>
	                              		</thead>
	                              		<tbody>
	                              		</tbody>
	                              	</table>
	                              	<a href="#" id="tambah" class="btn green"><i class="icon-plus"></i> Tambah</a>
	                              </div>
	                           </div>
	                           <div class="control-group">
	                              <label class="control-label">Pendidikan Non Formal</label>
	                              <div class="controls">
	                              	<table id="pendidikan_nonformal" class="table table-bordered table-advance" style="position: relative;top:-18px">
	                              		<thead>
	                              			<tr>
	                              				<th class="hidden-phone">Jenis Pendidikan</th>
	                              				<th class="hidden-phone">Tempat</th>
	                              				<th class="hidden-phone">Lamanya</th>
	                              				<th class="hidden-phone">Keterangan</th>
	                              				<th class="hidden-phone">Aksi</th>
	                              			</tr>
	                              		</thead>
	                              		<tbody>
	                              		</tbody>
	                              	</table>
	                              	<a href="#" id="tambah_nonformal" class="btn green"><i class="icon-plus"></i> Tambah</a>
	                              </div>
	                           </div>
	                           <div class="control-group">
	                              <label class="control-label">Riwayat Pekerjaan</label>
	                              <div class="controls">
	                              	<table id="riwayat_jabatan" class="table table-bordered table-advance" style="position: relative;top:-18px">
	                              		<thead>
	                              			<tr>
	                              				<th class="hidden-phone">Jabatan</th>
	                              				<th class="hidden-phone">Perusahaan</th>
	                              				<th class="hidden-phone">Tahun</th>
	                              				<th class="hidden-phone">Ket.</th>
	                              				<th class="hidden-phone">Aksi</th>
	                              			</tr>
	                              		</thead>
	                              		<tbody>
	                              		</tbody>
	                              	</table>
	                              	<a href="#" id="tambah_jabatan" class="btn green"><i class="icon-plus"></i> Tambah</a>
	                              </div>
	                           </div>	                           	                           	                            
		                        <div class="form-actions">
	                              <button type="submit" class="btn blue">Simpan</button>
	                              <button type="button" class="btn">Cancel</button>
	                           </div>                                                      								
								</form>
							</div>							
						</div>	
