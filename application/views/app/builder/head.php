<?php defined('BASEPATH') OR exit('No direct script access allowed');
	if (!isset($loadjs)) $loadjs = array();
	?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="initial-scale=1,maximum-scale=1">
	<meta name="description" content="A personal digital playground for projects, thoughts, and hobbies.">
	<meta name="generator" content="Builder 2 v2005">
	<meta name="author" content="Sean Wittmeyer">
	<link rel="icon" href="/includes/img/favicon.jpg">
	<title><?php echo $pagetitle; ?> - Sean's Website</title>
	<script src="/includes/js/pace.min.js"></script>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
	<link href="/includes/css/bootstrap-select.min.css" rel="stylesheet" />
	<link href="/includes/css/summernote.css" rel="stylesheet" />
	<link href="/includes/css/font-awesome.min.css" rel="stylesheet">
	<?php if (in_array('nvd3', $loadjs)) { ?> 
	<link href='/includes/css/nvd3.css?20181203' rel='stylesheet' />
	<?php } ?> 
	<link href="/includes/css/builder.css?20200519" rel="stylesheet">
	<script src="/dist/index.bundle.js?<?=time()?>"></script>
	<!-- - ->
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
	-->
	<script>window.jQuery || document.write('<script src="/includes/js/jquery.min.js"><\/script>')</script>
	<script src="/dist/general.bundle.js?<?=time()?>"></script>
	<?php if (isset($loadjs['builder_viz'])) { ?> 
	<script src="/dist/viz.bundle.js?<?=time()?>"></script>
	<?php } ?>
	<?php if (isset($loadjs['builder_maps'])) { ?> 
	<script src="/dist/maps.bundle.js?<?=time()?>"></script>
	<script src='https://api.tiles.mapbox.com/mapbox-gl-js/v0.45.0/mapbox-gl.js'></script>
	<link href='https://api.tiles.mapbox.com/mapbox-gl-js/v0.45.0/mapbox-gl.css' rel='stylesheet' />
	<?php } ?> 
 	<script type="text/javascript">
		function herowindowheight() {
			$('.windowminheight').css({'min-height': window.innerHeight-110});
			$('.windowheight').css({'min-height': window.innerHeight-110,'height': window.innerHeight-110});
			<?php if (isset($loadjs['skimaponload'])) { ?> 
			map.resize();
			map.fitBounds(bounds);
			<?php } ?> 
		}
		$(document).ready(herowindowheight);
	</script>
</head>
<body onresize="herowindowheight()">
