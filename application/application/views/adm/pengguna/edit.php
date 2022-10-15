						<div class="portlet box blue">
							<div class="portlet-title">
								<h4><i class="icon-user"></i><?php echo (isset( $pengguna ) ? "Edit" : "Tambah" ) ?> Pengguna</h2></h4>
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
								<form id="tambahpengguna" class="form-horizontal" action="<?php echo site_url("pengguna/update") ?>" method="post"> 	
								<input type="hidden" name="id_user" value="<?php echo $pengguna->id_user; ?>" />
								<div class="control-group">
	                              <label class="control-label">Nama</label>
	                              <div class="controls">
	                                 <input type="text" name="nama_pengguna" class="span8 m-wrap" value="<?php echo $pengguna->nama; ?>" />
	                                 <span class="help-inline"></span>
	                              </div>
	                           </div>
	                           <div class="control-group">
	                              <label class="control-label">Username</label>
	                              <div class="controls">
	                                 <input type="text" name="username" class="span8 m-wrap" value="<?php echo $pengguna->username; ?>" />
	                                 <span class="help-inline"></span>
	                              </div>
	                           </div>
	                           <div class="control-group">
	                              <label class="control-label">Role</label>
	                              <div class="controls">
	                                 <select class="span8 m-wrap" name="role">
	                                 	<option value="Kepegawaian" <?php echo ($pengguna->role == "Kepegawaian" ? "selected" : ""); ?>>Kepegawaian</option>
	                                 	<option value="Manager" <?php echo ($pengguna->role == "Manager" ? "selected" : ""); ?>>Manager</option>
	                                 </select>
	                              </div>
	                           </div>	                           	                                                       
		                        <div class="form-actions clearfix">
	                              <button type="submit" class="btn blue">Simpan</button>
	                              <a href="<?php echo site_url('pengguna') ?>" class="btn">Cancel</a>
	                              </form>
	                           </div>                                                      								
							</div>							
						</div>	
