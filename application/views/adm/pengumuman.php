<?php foreach ($pengumuman as $key => $peng) { ?>
<div class="alert alert-block alert-info fade in">
	<button type="button" class="close" data-dismiss="alert"></button>
	<h4 class="alert-heading"><?php echo $peng->judul; ?></h4>
	<p><?php echo $peng->pesan; ?></p>
</div>
<?php } ?>