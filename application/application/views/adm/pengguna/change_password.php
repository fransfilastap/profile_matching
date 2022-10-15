						<div class="portlet box blue">
							<div class="portlet-title">
								<h4><i class="icon-user"></i>Ubah Password</h2></h4>
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
								<form id="tambahpengguna" class="form-horizontal" action="<?php echo site_url("pengguna/do_change_password") ?>" method="post"> 	
								<input type="hidden" name="id_user" value="<?php echo $pengguna->id_user; ?>" />
	                           <div class="control-group">
	                              <label class="control-label">Password</label>
	                              <div class="controls">
	                                 <input type="password" name="password" class="span8 m-wrap" value=""/>
	                                 <span class="help-inline"></span>
	                              </div>
	                           </div>                           	                                                       
		                        <div class="form-actions clearfix">
	                              <button type="submit" class="btn blue">Simpan</button>
	                              <?php if( !role('pegawai') ){ ?>
<a href="<?php echo site_url('pengguna') ?>" class="btn">Cancel</a>
	                              	<?php } ?>
	                           </div>                                                      								
								</form>
							</div>							
						</div>	
