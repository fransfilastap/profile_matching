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
								<form id="editPegawai" class="form-horizontal" action="<?php echo site_url('pegawai/update') ?>" method="post"> 
								<input type="hidden" name="kode_pegawai_hidden" value="<?php echo $pegawai->id; ?>" />
								<div class="control-group">
	                              <label class="control-label">Kode Pegawai</label>
	                              <div class="controls">
	                                 <input type="text" name="kode_pegawai" class="span8 m-wrap" value="<?php echo $pegawai->kd_pegawai; ?>" <?php if(role('Pegawai')){?> disabled <?php } ?>/>
	                                 <span class="help-inline"></span>
	                              </div>
	                           </div>	
								<div class="control-group">
	                              <label class="control-label">Nama Pegawai</label>
	                              <div class="controls">
	                                 <input type="text" name="nama_pegawai" class="span8 m-wrap" value="<?php echo $pegawai->nama_pegawai; ?>" />
	                                 <span class="help-inline"></span>
	                              </div>
	                           </div>
	                           	<div class="control-group">
	                              <label class="control-label">Tempat Lahir</label>
	                              <div class="controls">
	                                 <input type="text" name="tempat_lahir" class="span8 m-wrap" value="<?php echo $pegawai->tempat_lahir; ?>" />
	                                 <span class="help-inline"></span>
	                              </div>
	                           </div>
	                           <div class="control-group">
	                              <label class="control-label">Tanggal Lahir</label>
	                              <div class="controls">
	                                 <div class="input-append date date-picker" data-date="2012-02-12" data-date-format="yyyy-mm-dd">
	                                    <input name="tanggal_lahir" value="<?php echo $pegawai->tanggal_lahir; ?>" class="m-wrap m-ctrl-medium date-picker" size="16" type="text" value="2012-02-12" data-date-format="yyyy-mm-dd"/><span class="add-on"><i class="icon-calendar"></i></span>
	                                 </div>
	                              </div>
	                           </div>
								<div class="control-group">
	                              <label class="control-label">Jenis Kelamin</label>
	                              <div class="controls">
	                                 <select name="jenis_kelamin" class="span8 m-wrap">
	                                 	<option value="L" <?php echo ( $pegawai->jenis_kelamin == "L" ? "selected" : "" ) ?>>Laki-laki</option>
	                                 	<option value="P" <?php echo ( $pegawai->jenis_kelamin == "P" ? "selected" : "" ) ?>>Perempuan</option>
	                                 </select>
	                                 <span class="help-inline"></span>
	                              </div>
	                           </div>		                           	
	                          <div class="control-group">
	                              <label class="control-label">Alamat</label>
	                              <div class="controls">
	                                 <textarea name="alamat" id="alamat" class="span6 m-wrap" rows="3"><?php echo $pegawai->alamat; ?></textarea>
	                              </div>
	                           </div>
	                           <div class="control-group">
	                              <label class="control-label">Tanggal Diangkat</label>
	                              <div class="controls">
	                                 <div class="input-append date date-picker" data-date="2012-02-12" data-date-format="yyyy-mm-dd">
	                                    <input name="diangkat_per" value="<?php echo $pegawai->diangkat_per; ?>" data-date-format="yyyy-mm-dd" class="m-wrap m-ctrl-medium date-picker" size="16" type="text" value="2012-02-12" /><span class="add-on"><i class="icon-calendar"></i></span>
	                                 </div>
	                              </div>
	                           </div>
	                           <div class="control-group">
	                              <label class="control-label">Pendidikan Formal</label>
	                              <div class="controls">
	                              	<table id="pendidikan" class="table table-bordered table-advance" >
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

	                              		<?php 
	                              		$total = count( $pendidikans );
	                              		for ($i=0; $i < $total ; $i++) { 
	                              		?>
	                              			<tr class="lama" data-id="<?php echo $pendidikans[$i]->id_pendidikan; ?>">
	                              				<td>
	                              					<select name="jenjang" class="span12 m-wrap jenjang" data-placeholder="Choose a Category" tabindex="1">
					                                    <option value="" />Pilih...
					                                    <option value="1" <?php echo ( $pendidikans[$i]->jenjang_pendidikan == "D3" ? "selected" :"" ) ?> />D3
					                                    <option value="2" <?php echo ( $pendidikans[$i]->jenjang_pendidikan == "S1" ? "selected" :"" ) ?> />S1
					                                    <option value="3" <?php echo ( $pendidikans[$i]->jenjang_pendidikan == "S2" ? "selected" :"" ) ?> />S2
					                                    <option value="4" <?php echo ( $pendidikans[$i]->jenjang_pendidikan == "S3" ? "selected" :"" ) ?> />S3
					                                    
					                                 </select>
											    </td>
	                              				<td><input type="text" value="<?php echo $pendidikans[$i]->institusi; ?>" name="nama_institusi" class="span12 m-wrap institusi" /></td>
	                              				<td><input type="text" value="<?php echo $pendidikans[$i]->jurusan; ?>" name="nama_jurusan"  class="span12 m-wrap jurusan" /></td>
	                              				<td><input type="text" value="<?php echo $pendidikans[$i]->tahun_masuk; ?>" name="tahun_masuk"  class="span12 m-wrap tahunmasuk" onkeypress="return isNumber(event)" /></td>
	                              				<td><input type="text" value="<?php echo $pendidikans[$i]->tahun_keluar; ?>" name="tahun_keluar"  class="span12 m-wrap tahunkeluar" onkeypress="return isNumber(event)" /></td>
	                              				<td><input type="text" value="<?php echo $pendidikans[$i]->nilai; ?>" name="ipk"  class="span12 m-wrap ipk" onkeypress="return isFloat(event)" /></td>	                              				
	                              				<td><a href="<?php echo site_url('pegawai/hapus_pendidikan/'.$pendidikans[$i]->id_pendidikan) ?>" id="hapusRow" class="btn mini red"><i class="icon-trash"></i></a></td>	                              				
	                              			</tr>
	                              		<?php } ?>                             		
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
	                              		<?php foreach ($nonformals as $key => $pnf) { ?>
	                              			<tr  class="lama" data-id="<?php echo $pnf->id; ?>">
	                              				<td><input type="text" class="span12 m-wrap kursus" name="nama_kursus" value="<?php echo $pnf->nama_kursus; ?>"></td>
	                              				<td><input type="text" class="span12 m-wrap tempat" name="tempat" value="<?php echo $pnf->tempat; ?>"></td>
	                              				<td><input type="text" class="span12 m-wrap lamanya" name="lamanya" value="<?php echo $pnf->lamanya; ?>"></td>
	                              				<td><input type="text" class="span12 m-wrap ket" name="keterangan" value="<?php echo $pnf->keterangan?>"></td>
	                              				<td><a href="#" id="hapusRow2" class="btn mini red"><i class="icon-trash"></i></a></td>
	                              			</tr>
	                              		<?php }  ?>
	                              		</tbody>
	                              	</table>
	                              	<a href="#" id="tambah_nonformal" class="btn green"><i class="icon-plus"></i> Tambah</a>
	                              </div>
	                           </div>
	                           <div class="control-group">
	                              <label class="control-label">Riwayat Jabatan</label>
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
	                              		<?php foreach ($jabatans as $key => $jabatan) { ?>
	                              			<tr  class="lama" data-id="<?php echo $jabatan->id; ?>">
	                              				<td><input type="text" class="span12 m-wrap jabatan" value="<?php echo $jabatan->jabatan; ?>"></td>
	                              				<td><input type="text" class="span12 m-wrap wilayah" value="<?php echo $jabatan->wilayah; ?>"></td>
	                              				<td><input type="text" class="span12 m-wrap dari date-picker" data-date-format="yyyy-mm-dd" value="<?php echo $jabatan->dari; ?>"></td>
	                              				<td><input type="text" class="span12 m-wrap ket" value="<?php echo $jabatan->keterangan ?>"></td>
	                              				<td><a href="#" id="hapusRow3" class="btn mini red"><i class="icon-trash"></i></a></td>
	                              			</tr>
	                              		<?php }  ?>
	                              		</tbody>
	                              	</table>
	                              	<a href="#" id="tambah_riwayat" class="btn green"><i class="icon-plus"></i> Tambah</a>
	                              </div>
	                           </div>	                           	                            
		                        <div class="form-actions">
	                              <button type="submit" class="btn blue">Simpan</button>
	                           </div>                                                      								
								</form>
							</div>							
						</div>	
