<div class="portlet box blue" id="seleksi_mutasi">
                     <div class="portlet-title">
                        <h4>
                           <i class="icon-reorder"></i> Tahapan Pemeringkatan - <span class="step-title">Tahap 1 of 3</span>
                        </h4>
                        <div class="tools hidden-phone">
                           <a href="javascript:;" class="collapse"></a>
                        </div>
                     </div>
                     <div class="portlet-body form">
                        <form action="#" class="form-horizontal" />
                           <div class="form-wizard">
                              <div class="navbar steps">
                                 <div class="navbar-inner">
                                    <ul class="row-fluid">
                                       <li class="span3">
                                          <a href="#tab1" data-toggle="tab" class="step active">
                                          <span class="number">1</span>
                                          <span class="desc"><i class="icon-ok"></i> Pilih Profil Mutasi</span>   
                                          </a>
                                       </li>
                                       <li class="span3">
                                          <a href="#tab2" data-toggle="tab" class="step">
                                          <span class="number">2</span>
                                          <span class="desc"><i class="icon-ok"></i> Kandidat Cocok</span>   
                                          </a>
                                       </li>
                                       <li class="span3">
                                          <a href="#tab3" data-toggle="tab" class="step">
                                          <span class="number">3</span>
                                          <span class="desc"><i class="icon-ok"></i> Parameter</span>   
                                          </a>
                                       </li>
                                       <li class="span3">
                                          <a href="#tab4" data-toggle="tab" class="step">
                                          <span class="number">4</span>
                                          <span class="desc"><i class="icon-ok"></i> Hasil</span>   
                                          </a> 
                                       </li>
                                    </ul>
                                 </div>
                              </div>
                              <div id="bar" class="progress progress-success progress-striped">
                                 <div class="bar"></div>
                              </div>
                              <div class="tab-content">
                                 <div class="tab-pane active" id="tab1">
                                    <h3 class="block">Pilih Profil Mutasi</h3>
                                    <div class="control-group">
                                       <label class="control-label"></label>
                                       <div class="controls">
                                       <?php foreach ($profiles as $key => $profil) { ?>
                                          <label class="radio">
                                          <input type="radio" name="optionsRadios" id="optionsRadios<?php echo $key; ?>" value="<?php echo $profil->id_pm ?>" <?php echo $key == 0 ? 'checked=""' : "" ?> />
                                          <?php echo $profil->nama_profil_mutasi." - "; ?>
                                          <?php echo "<i>".$profil->wilayah."</i>"; ?>
                                          </label>
                                          <div class="clearfix"></div>
                                       <?php } ?>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="tab-pane" id="tab2">
                                    <h3 class="block">Pilih Kandidat</h3>
                                    <div id="qualified_candidate">test</div>
                                 </div>
                                 <div class="tab-pane" id="tab3">
                                 <legend>Persentase CF & SF</legend>
									<div class="control-group">
		                              <label class="control-label">Core Factor</label>
		                              <div class="controls">
		                                 <div class="input-append">
		                                    <input class="m-wrap m-ctrl-small" name="CF" value="50" type="text" >
		                                    <span class="add-on"><i></i>%</span>
		                                 </div>
		                              </div>
		                            </div>
		                          	<div class="control-group">
		                              <label class="control-label">Secondary Factor</label>
		                              <div class="controls">
		                                 <div class="input-append">
		                                    <input class="m-wrap m-ctrl-small" name="SF" value="50" type="text" >
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
		                                    <input class="m-wrap m-ctrl-small aspek" name="<?php echo $kriteria['id_kriteria'] ?>" value="0" type="text" >
		                                    <span class="add-on"><i></i>%</span>
		                                 </div>
		                              </div>
		                            </div>
		                           <?php } ?>                          
                                 </div>
                                 <div class="tab-pane" id="tab4">
                                 	<p></p>
                                 	<div id="progress"></div>
								 	<p></p>
								 	<div id="result_yes">    
								 	</div>
								 </div> 	
                              </div>
                              <div class="form-actions clearfix">
                                 <a href="javascript:;" class="btn button-previous">
                                 <i class="m-icon-swapleft"></i> Kembali
                                 </a>
                                 <a href="javascript:;" class="btn blue button-next">
                                 Selanjutnya <i class="m-icon-swapright m-icon-white"></i>
                                 </a>
                                 <?php if( role('Manager') ){ ?>
                                <a href="<?php echo site_url('keputusan') ?>" target="_blank" class="btn green button-submit">
                                 Keputusan<i class="m-icon-swapright m-icon-white"></i>
                                 </a>
                                 <?php }else{ ?>
                                <a href="<?php echo site_url('seleksi_mutasi') ?>" class="btn green button-submit">
                                 Selesai<i class="m-icon-swapright m-icon-white"></i>
                                 </a>                                    
                                 <?php } ?>
                              </div>
                           </div>
                        </form>
                     </div>
                  </div>