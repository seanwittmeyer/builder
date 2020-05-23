<?php defined('BASEPATH') OR exit('No direct script access allowed');
	if (!isset($loadjs)) $loadjs = array();
	$uniquejsversion = time(); // Set this to the date last edited or time() so that client js and css refreshes the cache
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
	<!--<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">-->
	<link href="/includes/css/bootstrap-select.min.css" rel="stylesheet" />
	<link href="/includes/css/summernote.css" rel="stylesheet" />
	<link href="/includes/css/font-awesome.min.css" rel="stylesheet">
	<?php if (in_array('nvd3', $loadjs)) { ?> 
	<link href='/includes/css/nvd3.css' rel='stylesheet' />
	<?php } ?> 
	<link href="/includes/css/builder.css?<?=$uniquejsversion?>" rel="stylesheet">
	<script src="/dist/index.bundle.js?<?=$uniquejsversion?>"></script>
	<script src="/dist/general.bundle.js?<?=$uniquejsversion?>"></script>
	<?php if (isset($loadjs['builder_viz'])) { ?><script src="/dist/viz.bundle.js?<?=$uniquejsversion?>"></script><?php } ?> 
	<?php if (isset($loadjs['builder_maps'])) { ?><script src="/dist/maps.bundle.js?<?=$uniquejsversion?>"></script>
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
