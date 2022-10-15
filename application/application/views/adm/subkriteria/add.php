						<div class="portlet box blue">
							<div class="portlet-title">
								<h4><i class="icon-user"></i><?php echo (isset( $subkriteria ) ? "Edit" : "Tambah" ) ?> Sub-Kriteria</h2></h4>
								<div class="tools">
									<a href="javascript:;" class="collapse"></a>
								</div>
							</div>
							<div class="portlet-body form">
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
						<form class="form-horizontal" action="<?php echo ( isset( $subkriteria ) ? site_url("subkriteria/update") : site_url("subkriteria/simpan") ) ?>" method="post"> 
							<fieldset>
								<div class="control-group">
									<label class="control-label">Sub-Kriteria</label>
									<div class="controls">
									  <select name="parent_kriteria"  class="span4 m-wrap">
									  	<?php foreach ($kriterias as $key => $kriteria) { ?>
									  		<option value="<?php echo $kriteria->id_kriteria ?>" <?php echo isset($subkriteria) ? ($subkriteria->id_kriteria == $kriteria->id_kriteria ? "selected" :"") : "" ?>><?php echo $kriteria->nama_kriteria; ?></option>
									  	<?php } ?>
									  </select>
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">Kode Sub Kriteria</label>
									<div class="controls">
									  <input  class="span4 m-wrap" <?php echo isset($subkriteria) ? "disabled" : "" ?> type="text" value="<?php echo (isset($subkriteria) ? $subkriteria->kode_subkriteria : "") ?>" name="kode_kriteria" value="" placeholder="Kode Kriteria">
									</div>
								</div>
								<?php if( isset($subkriteria) ) { ?>
									<input type="hidden" name="k_krit" value="<?php echo $subkriteria->id_subkriteria; ?>" />
								<?php } ?>
								<div class="control-group">
									<label class="control-label">Nama SubKriteria</label>
									<div class="controls">
									  <input  class="span4 m-wrap" type="text" name="nama_kriteria" value="<?php echo (isset($subkriteria) ? $subkriteria->nama_subkriteria : "") ?>" placeholder="Nama Sub Kriteria">
									</div>
								</div>
								<div class="control-group">
	                              <label class="control-label">Jenis Nilai</label>
	                              <div class="controls">
	                              	 <select name="jenis_nilai" class="span4 m-wrap">
	                              	 	<option value="">Pilih...</option>
	                              	 	<option value="CF" <?php echo isset($subkriteria) ? ($subkriteria->jenis_nilai == "CF" ? "selected" :"") : "" ?>><i>Core Factor</i></option>
	                              	 	<option value="SF"  <?php echo isset($subkriteria) ? ($subkriteria->jenis_nilai == "SF" ? "selected" :"") : "" ?>><i>Secondary Factor</i></option>
	                              	 </select>
	                                 <span class="help-inline"></span>
	                              </div>
	                           </div>
								<div class="control-group">
								  <label class="control-label" for="textarea2">Keterangan</label>
								  <div class="controls">
									<textarea class="cleditor m-wrap" name="keterangan" id="textarea2" rows="3"><?php echo (isset($subkriteria) ? $subkriteria->keterangan : "") ?></textarea>
								  </div>
								</div>
								<div class="form-actions clearfix">
								  <button type="submit" class="btn green"><i class="icon-save"></i> Simpan</button>
								  <button type="reset" class="btn red"> Reset</button>
								  <a href="<?php echo site_url('subkriteria') ?>" class="btn"><i class="icon-undo"></i> Kembali</a>
								</div>
							</fieldset>
						</form>
							</div>
						</div>				
