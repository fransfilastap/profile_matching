<div class="portlet box blue">
	<div class="portlet-title">
		<h4><i class="icon-user"></i><?php echo (isset( $profil ) ? "Edit" : "Tambah" ) ?> Profil Mutasi</h2></h4>
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

						<form id="tambahProfil" class="form-horizontal" action="<?php echo ( isset( $profil ) ? site_url("profil_mutasi/update") : site_url("profil_mutasi/simpan") ) ?>" method="post"> 
								<?php if( isset($profil) ) { ?>
									<input type="hidden" name="kode_profil_hidden" value="<?php echo $profil->id_pm; ?>" />
								<?php } ?>
								<div class="control-group">
	                              <label class="control-label">Nama Jabatan</label>
	                              <div class="controls">
	                                 <input type="text" name="nama_profil_mutasi" class="span8 m-wrap" value="<?php echo isset($profil)?$profil->nama_profil_mutasi:"" ?>" />
	                                 <span class="help-inline"></span>
	                              </div>
	                           </div>
								<div class="control-group">
	                              <label class="control-label">Wilayah</label>
	                              <div class="controls">
	                                 <input type="text" name="wilayah" class="span8 m-wrap" value="<?php echo isset($profil)?$profil->wilayah:"" ?>" />
	                                 <span class="help-inline"></span>
	                              </div>
	                           </div>	
	                           <div class="control-group">
	                              <label class="control-label">Pendidikan Minimal</label>
	                              <div class="controls">
	                                 	<select name="min_pendidikan" class="span12 m-wrap" data-placeholder="Choose a Category" tabindex="1">
					                        <option value="1" <?php echo ( $profil->pendidikan_minimum == 1 ? "selected" : "" ) ?>/>D3
					                        <option value="2" <?php echo ( $profil->pendidikan_minimum == 2 ? "selected" : "" ) ?>/>S1
					                        <option value="3" <?php echo ( $profil->pendidikan_minimum == 3 ? "selected" : "" ) ?>/>S2
					                        <option value="4" <?php echo ( $profil->pendidikan_minimum == 4 ? "selected" : "" ) ?>/>S3
					                    </select>
	                                 <span class="help-inline"></span>
	                              </div>
	                           </div>	
	                           <div class="control-group">
	                           	<label class="control-label">IPK Minimal</label>
	                           		<div class="controls">
	                           			<input type="text" class="span12 m-wrap" name="min_ipk" value="<?php echo $profil->nilai; ?>" />
	                                 <span class="help-inline"></span>
	                              </div>
	                           </div>  
	                           <legend>Persentase Core Factor & Secondary Factor</legend>
	                         	<div class="control-group">
		                              <label class="control-label">Core Factor</label>
		                              <div class="controls">
		                                 <div class="input-append">
		                                    <input class="m-wrap m-ctrl-small" name="CF" value="<?php echo $CF; ?>" type="text" >
		                                    <span class="add-on"><i></i>%</span>
		                                 </div>
		                              </div>
		                            </div>
		                          	<div class="control-group">
		                              <label class="control-label">Secondary Factor</label>
		                              <div class="controls">
		                                 <div class="input-append">
		                                    <input class="m-wrap m-ctrl-small" name="SF" value="<?php echo $SF; ?>" type="text" >
		                                    <span class="add-on"><i></i>%</span>
		                                 </div>
		                              </div>
		                            </div>	
		                       		<legend>Persentase Nilai Aspek/Kriteria</legend> 
		                           <?php foreach ($kriterias as $key => $kriteria) { ?>
		                           	<div class="control-group">
		                              <label class="control-label"><?php echo $kriteria['nama_kriteria'] ?></label>
		                              <div class="controls">
		                                 <div class="input-append">
		                                    <input class="m-wrap m-ctrl-small aspek" name="<?php echo $kriteria['id_kriteria'] ?>" value="<?php echo $kriteria['nilai_CP'] ?>" type="text" >
		                                    <span class="add-on"><i></i>%</span>
		                                 </div>
		                              </div>
		                            </div>
		                           <?php } ?>     	                                                     	
					<?php foreach ($kriterias as $key => $kriteria) { ?>
						<div class="control-group">
	                              <label class="control-label">Profil Ideal <?php echo $kriteria['nama_kriteria']; ?></label>
	                              <div class="controls">
	                              	<table id="tabel_<?php echo $kriteria['kode_kriteria'] ?>" class="table table-bordered table-advance" >
	                              		<thead>
	                              			<tr>
	                              				<th style="width:75px;"  class="hidden-phone">Kode Subkriteria</th>
	                              				<th class="hidden-phone">Nama SubKriteria</th>
	                              				<th class="hidden-phone">Nilai</th>
	                              			</tr>
	                              		</thead>
	                              		<tbody>
	                              		<?php foreach ($kriteria['child'] as $key => $subkriteria) { ?>
	                              			<tr>
	                              				<td data-id="<?php echo trim(ucfirst( $subkriteria['id_subkriteria'] )); ?>"><?php echo trim(ucfirst( $subkriteria['kode_subkriteria'] )); ?></td>
					                            <td>
					                            <?php echo trim(ucfirst( $subkriteria['nama_subkriteria']) ) ?>
					                            </td>
	                              				<td>
	                              					<select name="nilai" class="span12 m-wrap" data-placeholder="Choose a Category" tabindex="1">
	                              					<?php for ($i=1; $i <= 5 ; $i++) {  ?>
	                              						<option value="<?php echo $i; ?>" <?php echo ( $i == $subkriteria['nilai'] ) ? "selected" : ""; ?> /><?php echo $i; ?>
	                              					<?php } ?>
					                                 </select>
											    </td>                              				
	                              			</tr>
	                              		<?php } ?>
	                              		</tbody>
	                              	</table>
	                              </div>
	                           </div>	
					<?php } ?>                            
		                        <div class="form-actions">
	                              <button type="submit" class="btn blue"><i class="icon-save"></i> Simpan</button>
	                              <a href="<?php echo site_url('profil_mutasi') ?>" class="btn"><i class="icon-undo"></i> Cancel</a>
	                           </div>                                                      								
								</form>

	</div>
</div>