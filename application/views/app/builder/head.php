<?php defined('BASEPATH') OR exit('No direct script access allowed');
	if (!isset($loadjs)) $loadjs = array();
	$uniquejsversion = '200601a'; // Set this to the date last edited or time() so that client js and css refreshes the cache
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
	<script src="/dist/index.bundle.js?<?=$uniquejsversion?>"></script>
	<script src="/dist/general.bundle.js?<?=$uniquejsversion?>"></script>
	<script src="/dist/fa.bundle.js" async></script>
	<?php if (isset($loadjs['builder_viz'])) { ?><script src="/dist/viz.bundle.js?<?=$uniquejsversion?>"></script><?php } ?> 
	<?php if (isset($loadjs['contenttools'])) { ?>
	<script src="/dist/editor.bundle.js?<?=$uniquejsversion?>"></script>
	<link href="/includes/css/content-tools.min.css" rel="stylesheet" />
	<?php } ?> 
	<?php if (isset($loadjs['builder_maps'])) { ?><script src="/dist/maps.bundle.js?<?=$uniquejsversion?>"></script>
	<script src='https://api.tiles.mapbox.com/mapbox-gl-js/v0.45.0/mapbox-gl.js'></script>
	<link href='https://api.tiles.mapbox.com/mapbox-gl-js/v0.45.0/mapbox-gl.css' rel='stylesheet' />
	<?php } ?> 
	<?php if (isset($loadjs['contenttools'])) { ?> 
	<link href='/includes/css/content-tools.min.css' rel='stylesheet' />
	<!--<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.0.8/css/fileinput.min.css" media="all" rel="stylesheet" type="text/css" />-->
	<?php } ?> 
	<link href="/includes/css/builder.css?<?=$uniquejsversion?>" rel="stylesheet">
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
		function initsummernoteinstances() {
			$('.cas-summernote').summernote({
			  toolbar: [
				// [groupName, [list of button]]
				['style', ['style']],
				['simple', ['bold', 'italic', 'underline', 'clear']],
				['para', ['ul', 'ol', 'paragraph']],
				['link', ['linkDialogShow']],
				['code', ['codeview']],
				['fullscreen', ['fullscreen']],
				
			  ],
			});
		}
		function openeditor() {
			$('body').addClass('offcanvas'); 
			initsummernoteinstances(); 
			return false;
		}
		function copyStringToClipboard(string) {
			function handler(event) {
				event.clipboardData.setData('text/plain', string);
				event.preventDefault();
				document.removeEventListener('copy', handler, true);
			}
		
			document.addEventListener('copy', handler, true);
			document.execCommand('copy');
		}

	</script>
</head>
<body onresize="herowindowheight()"<?php if (isset($bodyclass)) echo ' class="'.$bodyclass.'"';?>>
