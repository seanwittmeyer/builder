<?php //setup
	if (!isset($loadjs)) $loadjs = array();
	?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="initial-scale=1,maximum-scale=1,user-scalable=no">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<meta name="description" content="Sean likes to ski and collect information and photos of the things he does.">
	<meta name="author" content="Sean Wittmeyer">
	<link rel="icon" href="/favicon.ico">
	<title><?php echo $pagetitle; ?> - Sean's Website</title>
	<script src="/includes/js/pace.min.js"></script>
	<link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Mono:ital,wght@0,100;0,400;0,600;0,700;1,100;1,400;1,600;1,700&family=IBM+Plex+Sans:ital,wght@0,100;0,400;0,600;0,700;1,100;1,400;1,600;1,700&display=swap" rel="stylesheet">
	<link href="/includes/css/bootstrap.min.css" rel="stylesheet">
	<link href="/includes/css/font-awesome.min.css" rel="stylesheet">
	<link href="/includes/css/summernote.css" rel="stylesheet" />
	<link href="/includes/css/bootstrap-select.min.css" rel="stylesheet" />
	<link href="/includes/css/base.css?20200519" rel="stylesheet">
	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script>window.jQuery || document.write('<script src="/includes/js/jquery.min.js"><\/script>')</script>
	<!--<script src="/includes/js/typeahead.bundle.min.js"></script>-->
	<script src="/includes/js/fileinput.min.js"></script>
	<?php if (isset($loadjs['mapbox'])) { ?> 
	<script src='https://api.tiles.mapbox.com/mapbox-gl-js/v0.45.0/mapbox-gl.js'></script>
	<link href='https://api.tiles.mapbox.com/mapbox-gl-js/v0.45.0/mapbox-gl.css' rel='stylesheet' />
	<?php } ?> 
	<?php if (isset($loadjs['nanogallery'])) { ?> 
	<script src='/includes/js/jquery.nanogallery2.min.js'></script>
	<link href='/includes/css/nanogallery2.min.css' rel='stylesheet' />
	<?php } ?> 
	<?php if (isset($loadjs['masonry'])) { ?>
	<script>
	$( document ).ready(function() {
		function masonrygo() {
			$('.masonrygrid').masonry({
				itemSelector: '.masonryblock'
			});
		}
	});
	//	Pace.done(alert('done'));
	Pace.on('done', masonrygo());
	</script>
	<?php } ?> 

	<?php if (in_array('masonry', $loadjs)) { ?> 
	<script src="/includes/js/masonry.min.js"></script>
	<script src="/includes/js/imagesloaded.min.js"></script>
	<?php } ?> 
	<?php if (in_array('chartsjs', $loadjs)) { ?> 
	<script src="/includes/js/chart/Chart.bundle.2.7.3.js"></script>
	<script src="/includes/js/chart/utils.js"></script>
	<?php } ?> 
	<?php if (in_array('sparkline', $loadjs)) { ?> 
	<script src="/includes/js/jquery.sparkline.js"></script>
	<?php } ?> 
	<?php if (in_array('nvd3', $loadjs)) { ?> 
	<link href='/includes/css/nvd3.css?20181203' rel='stylesheet' />
	<script src="/includes/js/d3.v3.min.fixed.js"></script>
	<script src="/includes/js/nvd3-1.8.4.js"></script>
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
