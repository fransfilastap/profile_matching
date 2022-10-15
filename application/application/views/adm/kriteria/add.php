						<div class="portlet box blue">
							<div class="portlet-title">
								<h4><i class="icon-user"></i><?php echo (isset( $kriteria ) ? "Edit" : "Tambah" ) ?> Kriteria</h2></h4>
								<div class="tools">
									<a href="javascript:;" class="collapse"></a>
									<a href="#portlet-config" data-toggle="modal" class="config"></a>
									<a href="javascript:;" class="reload"></a>
									<a href="javascript:;" class="remove"></a>
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
						<form class="form-horizontal" action="<?php echo ( isset( $kriteria ) ? site_url("kriteria/update") : site_url("kriteria/simpan") ) ?>" method="post"> 
							<fieldset>
								<div class="control-group">
									<label class="control-label">Kode Kriteria</label>
									<div class="controls">
									  <input class="span4 m-wrap" <?php echo isset($kriteria) ? "disabled" : "" ?> type="text" value="<?php echo (isset($kriteria) ? $kriteria->kode_kriteria : "") ?>" name="kode_kriteria" value="" placeholder="Kode Kriteria">
									</div>
								</div>
								<?php if( isset($kriteria) ) { ?>
									<input type="hidden" name="k_krit" value="<?php echo $kriteria->id_kriteria; ?>" />
								<?php } ?>
								<div class="control-group">
									<label class="control-label">Nama Kriteria</label>
									<div class="controls">
									  <input class="span4 m-wrap" type="text" name="nama_kriteria" value="<?php echo (isset($kriteria) ? $kriteria->nama_kriteria : "") ?>" placeholder="Nama Kriteria">
									</div>
								</div>
								<div class="control-group">
								  <label class="control-label" for="textarea2">Keterangan</label>
								  <div class="controls">
									<textarea class="cleditor m-wrap" name="keterangan" id="textarea2" rows="3"><?php echo (isset($kriteria) ? $kriteria->keterangan : "") ?></textarea>
								  </div>
								</div>
								<div class="form-actions">
								  <button type="submit" class="btn btn-primary"><i class="icon icon-white icon-save"></i>Simpan</button>
								  <button type="reset" class="btn">Reset</button>
								  <a href="<?php echo site_url('kriteria') ?>" class="btn btn-default"><i class="icon icon-black icon-undo"></i>Kembali</a>
								</div>
							</fieldset>
						</form>
							</div>
						</div>				
