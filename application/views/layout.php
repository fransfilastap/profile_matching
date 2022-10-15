<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
	<meta charset="utf-8" />
	<title>Profile Matching</title>
	<meta content="width=device-width, initial-scale=1.0" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />
	<link href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet" />
	<link href="<?php echo base_url('assets/css/metro.css') ?>" rel="stylesheet" />
	<link href="<?php echo base_url('assets/bootstrap/css/bootstrap-responsive.min.css') ?>" rel="stylesheet" />
	<link href="<?php echo base_url('assets/font-awesome/css/font-awesome.css') ?>" rel="stylesheet" />
	<link href="<?php echo base_url('assets/css/style.css') ?>" rel="stylesheet" />
	<link href="<?php echo base_url('assets/css/style_responsive.css') ?>" rel="stylesheet" />
	<link href="<?php echo base_url('assets/css/style_bumida.css') ?>" rel="stylesheet" id="style_color" />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/gritter/css/jquery.gritter.css') ?>" />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/uniform/css/uniform.default.css') ?>" />
	<?php if( isset( $styles ) ){ 
	foreach ($styles as $key => $style) { ?>
		<link rel="stylesheet" type="text/css" href="<?php echo $style; ?>">
	<?php }} ?>
	<link rel="shortcut icon" href="favicon.ico" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="fixed-top">
	<!-- BEGIN HEADER -->
	<div class="header navbar navbar-inverse navbar-fixed-top">
		<!-- BEGIN TOP NAVIGATION BAR -->
		<div class="navbar-inner">
			<div class="container-fluid">
				<!-- BEGIN LOGO -->
				<a class="brand" href="index.html">
				<img src="<?php echo base_url('assets/img/bumida_small.png') ?>" alt="logo" />
				</a>
				<!-- END LOGO -->
				<!-- BEGIN RESPONSIVE MENU TOGGLER -->
				<a href="javascript:;" class="btn-navbar collapsed" data-toggle="collapse" data-target=".nav-collapse">
				<img src="<?php echo base_url('assets/img/menu-toggler.png') ?>" alt="" />
				</a>          
				<!-- END RESPONSIVE MENU TOGGLER -->				
				<!-- BEGIN TOP NAVIGATION MENU -->					
				<ul class="nav pull-right">
					<!-- BEGIN USER LOGIN DROPDOWN -->
					<li class="dropdown user">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<img alt="" src="<?php echo base_url('assets/img/user_mini.png') ?>" />
						<span class="username"><?php echo ( $this->session->userdata( md5('nama') ) ) ?></span>
						<i class="icon-angle-down"></i>
						</a>
						<ul class="dropdown-menu">
							<li><a href="<?php echo site_url('ubah_password'); ?>"><i class="icon-key"></i> Ubah Password</a></li>
							<li class="divider"></li>
							<li><a href="<?php echo site_url('logout'); ?>"><i class="icon-signout"></i> Log Out</a></li>
						</ul>
					</li>
					<!-- END USER LOGIN DROPDOWN -->
				</ul>
				<!-- END TOP NAVIGATION MENU -->	
			</div>
		</div>
		<!-- END TOP NAVIGATION BAR -->
	</div>
	<!-- END HEADER -->
	<!-- BEGIN CONTAINER -->
	<div class="page-container row-fluid">
		<!-- BEGIN SIDEBAR -->
		<div class="page-sidebar nav-collapse collapse">
			<!-- BEGIN RESPONSIVE QUICK SEARCH FORM -->
			<div class="slide hide">
				<i class="icon-angle-left"></i>
			</div>
			<form class="sidebar-search" />
				<div class="input-box">
					<input type="text" class="" placeholder="Search" />
					<input type="button" class="submit" value=" " />
				</div>
			</form>
			<div class="clearfix"></div>
			<!-- END RESPONSIVE QUICK SEARCH FORM -->
			<!-- BEGIN SIDEBAR MENU -->
			<ul>
			<?php if ( role('Pegawai') ) { ?>
				<li <?php echo ( ( $this->uri->segment(1) == "user" && $this->uri->segment(2)=="" ) ? "class='active'" : "")  ?>>
					<a href="<?php echo site_url('user'); ?>">
					<i class="icon-home"></i> Beranda
					</a>					
				</li>	
				<li <?php echo ( ( $this->uri->segment(2) == "pengumuman" ) ? "class='active'" : "")  ?>>
					<a href="<?php echo site_url('user/pengumuman'); ?>">
					<i class="icon-info-sign"></i> Pengumuman <?php if( $this->unread_count > 0 ){ ?><span class="badge badge-important"><?php echo $this->unread_count; ?></span><?php } ?>
					</a>					
				</li>								
				<li <?php echo ( ( $this->uri->segment(2) == "biodata" && $this->uri->segment(1) == "user" ) ? "class='active'" : "")  ?>>
					<a href="<?php echo site_url('user/biodata'); ?>">
					<i class="icon-list"></i> Biodata
					</a>					
				</li>								
			<?php } ?>
			<?php if( role( 'Manager' ) or role('Kepegawaian') ){ ?>
				<li <?php echo ( ( $this->uri->segment(2) == "index" || $this->uri->segment(1) == "" ) ? "class='active'" : "")  ?>>
					<a href="<?php echo site_url('administrasi/index'); ?>">
					<i class="icon-home"></i> Beranda
					</a>					
				</li>
				<li class="<?php echo ( ( in_array( strtolower( $this->uri->segment(1) ) , array('pegawai'))  ) ? "active" : "")  ?>">
					<a href="<?php echo site_url('pegawai'); ?>">
					<i class="icon-user-md"></i> Data Pegawai
					</a>					
				</li>
				<li class="has-sub <?php echo ( ( in_array( strtolower( $this->uri->segment(1) ) , array('kriteria','subkriteria','profil_mutasi'))  ) ? "active" : "")  ?>">
					<a href="javascript:;" class="">
					<i class="icon-list"></i> Kriteria Penilaian
					<span class="arrow"></span>
					</a>
					<ul class="sub">
						<li class="<?php echo strtolower( $this->uri->segment(1) ) == 'kriteria' ? "active" : ""  ?>"><a  href="<?php echo site_url('kriteria'); ?>">Kriteria</a></li>
						<li class="<?php echo strtolower( $this->uri->segment(1) ) == 'subkriteria' ? "active" : ""  ?>"><a  href="<?php echo site_url('subkriteria'); ?>">Sub Kriteria</a></li>
						<li class="<?php echo strtolower( $this->uri->segment(1) ) == 'profil_mutasi' ? "active" : ""  ?>"><a href="<?php echo site_url('profil_mutasi'); ?>">Profile Mutasi</a></li>
					</ul>
				</li>				
				<li class="has-sub <?php echo ( ( in_array( strtolower( $this->uri->segment(1) ) , array('kandidat','penilaian','seleksi_mutasi','keputusan'))  ) ? "active" : "")  ?>">
					<a href="javascript:;" class="">
					<i class="icon-check"></i> Profile Matching
					<span class="arrow"></span>
					</a>
					<ul class="sub">
						<li class="<?php echo strtolower( $this->uri->segment(1) ) == 'penilaian' ? "active" : ""  ?>"><a class="" href="<?php echo site_url('penilaian'); ?>">Penilaian Pegawai</a></li>
						<li class="<?php echo strtolower( $this->uri->segment(1) ) == 'kandidat' ? "active" : ""  ?>"><a class="" href="<?php echo site_url('kandidat'); ?>">Seleksi Pendidikan</a></li>
						<li class="<?php echo strtolower( $this->uri->segment(1) ) == 'seleksi_mutasi' ? "active" : ""  ?>"><a class="" href="<?php echo site_url('seleksi_mutasi'); ?>">Seleksi Pegawai</a></li>
						<?php if( role('Manager') ) { ?>
						<li class="<?php echo strtolower( $this->uri->segment(1) ) == 'keputusan' ? "active" : ""  ?>"><a class="" href="<?php echo site_url('keputusan'); ?>">Keputusan</a></li>
						<?php } ?>
					</ul>
				</li>				
				<?php }  ?>
				<?php if ( role('Manager') ) { ?>
				<li class="<?php echo ( ( in_array( strtolower( $this->uri->segment(1) ) , array('laporan'))  ) ? "active" : "")  ?>">
					<a href="<?php echo site_url('laporan'); ?>">
					<i class="icon-book"></i> Laporan
					</a>					
				</li>
				<?php } ?>
				<?php if( role( 'Manager' ) ){ ?>
				<li class="<?php echo ( ( in_array( strtolower( $this->uri->segment(1) ) , array('pengguna'))  ) ? "active" : "")  ?>">
					<a href="<?php echo site_url('pengguna'); ?>">
					<i class="icon-user"></i> Users
					</a>					
				</li>
				<?php } ?>				
			</ul>
			<!-- END SIDEBAR MENU -->
		</div>
		<!-- END SIDEBAR -->
		<!-- BEGIN PAGE -->
		<div class="page-content">
			<!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
			<div id="portlet-config" class="modal hide">
				<div class="modal-header">
					<button data-dismiss="modal" class="close" type="button"></button>
					<h3>Widget Settings</h3>
				</div>
				<div class="modal-body">
					<p>Here will be a configuration form</p>
				</div>
			</div>
			<!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->
			<div class="container-fluid">
				<!-- BEGIN PAGE HEADER-->
				<div class="row-fluid">
					<div class="span12">         	
						<!-- BEGIN PAGE TITLE & BREADCRUMB-->		
						<h3 class="page-title">
							<?php echo @$page_title; ?>
							<small><?php echo @$page_subtitle; ?></small>
						</h3>
						<?php echo $breadcrumb; ?>
						<!-- END PAGE TITLE & BREADCRUMB-->
					</div>
				</div>
				<!-- END PAGE HEADER-->
				<!-- BEGIN PAGE CONTENT-->
				<?php echo $output; ?>
				<!-- END PAGE CONTENT-->
			</div>
			<!-- END PAGE CONTAINER-->			
		</div>
		<!-- BEGIN PAGE -->	 	
	</div>
	<!-- END CONTAINER -->
	<!-- BEGIN FOOTER -->
	<div class="footer">
		2013 &copy; Metronic by keenthemes.
		<div class="span pull-right">
			<span class="go-top"><i class="icon-angle-up"></i></span>
		</div>
	</div>
	<!-- END FOOTER -->
	<!-- BEGIN JAVASCRIPTS -->
	<!-- Load javascripts at bottom, this will reduce page load time -->
	<script src="<?php echo base_url('assets/js/jquery-1.8.3.min.js') ?>"></script>
	<script src="<?php echo base_url('assets/breakpoints/breakpoints.js') ?>"></script>
	<script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js') ?>"></script>
	<script src="<?php echo base_url('assets/js/jquery.blockui.js') ?>"></script>
	<script>
		jQuery(document).ready(function() {			
			// initiate layout and plugins
			App.init();
		});
	</script>
	<!-- ie8 fixes -->
	<!--[if lt IE 9]>
	<script src="assets/js/excanvas.js"></script>
	<script src="assets/js/respond.js"></script>
	<![endif]-->
	<script type="text/javascript" src="<?php echo base_url('assets/uniform/jquery.uniform.min.js') ?>"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/gritter/js/jquery.gritter.js') ?>"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.pulsate.min.js') ?>"></script>
	<?php if( isset( $scripts ) ){ 
	foreach ($scripts as $key => $script) { ?>
		<script type="text/javascript" src="<?php echo $script; ?>"></script>
	<?php }} ?>	
	<script src="<?php echo base_url('assets/js/app.js') ?>"></script>	

	<?php if( isset( $skript ) ){ ?> 
	<script type="text/javascript">
	<?php echo $skript; ?>
	</script>
	<?php } ?>
	<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>