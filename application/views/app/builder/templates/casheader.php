<?php //setup
	if (!isset($loadjs)) $loadjs = array();
	if (!isset($section)) $section = 'home';
	
	?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="initial-scale=1,maximum-scale=1,user-scalable=no">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<meta name="description" content="Sean likes to ski and collect information and photos of the things he does.">
	<meta name="author" content="Sean Wittmeyer">
	<link rel="icon" href="/includes/img/favicon.png">
	
	<title>Complexity Explorer - <?php echo $pagetitle; ?></title>
	
	<!-- Bootstrap core CSS -->
	<script src="/includes/js/pace.min.js"></script>
	<link href="/includes/css/bootstrap.min.css" rel="stylesheet">
	<link href="/includes/css/font-awesome.min.css" rel="stylesheet">
	<link href="/includes/css/summernote.css" rel="stylesheet" />
	<link href="/includes/css/bootstrap-select.min.css" rel="stylesheet" />
	<?php if (isset($loadjs['contenttools'])) { ?> 
	<link href='/includes/css/content-tools.min.css' rel='stylesheet' />
	<?php } ?> 
	<link href="/includes/css/base.css?191113e" rel="stylesheet">
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
	<?php if (isset($loadjs['lazy'])) { ?> 
	<script src='/includes/js/jquery.lazy.min.js'></script>
	<script src='/includes/js/jquery.lazy.plugins.min.js'></script>
	<?php } ?> 
	<?php if (isset($loadjs['nanogallery'])) { ?> 
	<script src='/includes/js/jquery.nanogallery2.min.js'></script>
	<link href='/includes/css/nanogallery2.min.css' rel='stylesheet' />
	<?php } ?> 

	<?php if (isset($loadjs['masonry'])) { ?>
	<script src="/includes/js/masonry.min.js"></script>
	<script src="/includes/js/imagesloaded.min.js"></script>
	<script>
	$(document).ready( function(){
		function masonrygo() {
			$('.masonrygrid').masonry({
				itemSelector: '.masonryblock'
			});
		}

	});
	//	Pace.done(alert('done'));
	Pace.on('done', function(){$('.masonrygrid').masonry({
		fitWidth: true, 
		gutter: 0,
		itemSelector: '.masonryblock',
		horizontalOrder: true
	})});
	</script>
	<?php } ?> 
	<?php if (isset($loadjs['chartjs'])) { ?>
	<script src="/includes/js/chart/Chart.bundle.2.7.3.js"></script>
	<script src="/includes/js/chart/utils.js"></script>
	<?php } ?> 
	<?php if (isset($loadjs['sparkline'])) { ?>
	<script src="/includes/js/jquery.sparkline.js"></script>
	<?php } ?> 
	<?php if (isset($loadjs['nvd3'])) { ?>
	<link href='/includes/css/nvd3.css?20181203' rel='stylesheet' />
	<script src="/includes/js/d3.v3.min.fixed.js"></script>
	<script src="/includes/js/nvd3-1.8.4.js"></script>
	<?php } ?> 
	<script type="text/javascript">
		function herowindowheight() {
			$('.windowminheight').css({'min-height': window.innerHeight-110});
			$('.windowheight').css({'min-height': window.innerHeight-110,'height': window.innerHeight-110});
			if (window.innerWidth < 1200) { $('.windowheightwide').css({'min-height': 'auto','height': 'auto'}); } else { $('.windowheightwide').css({'min-height': window.innerHeight-110,'height': window.innerHeight-110}); }
			<?php if (isset($loadjs['skimaponload'])) { ?> 
			map.resize();
			map.fitBounds(bounds);
			<?php } ?> 
		}
		$(document).ready(herowindowheight);
	<?php if (isset($loadjs['exploreapp'])) { ?>
		$(document).ready( function(){
			function unactiveOther( source ){
				// Source element
				var $sourceTabLink = $(source),
				$sourceTab = $sourceTabLink.parent('li');
				
				// wrapper element
				var activeNav = $sourceTab.closest('.multipleTabNav')
				// find all active
				.find('[role=presentation].active');
				
				activeNav.each( function(){
				
					// Get current active nav
					var curActiveNav = $(this),
					curActiveNavLink = curActiveNav.find('a');
					
					// inactive unmatched nav
					if ( curActiveNavLink.attr('data-target') !== $sourceTabLink.attr('data-target') ){
						curActiveNav.removeClass('active');
					}
				
				})
			}
			
			$('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
				//console.log( e.target ); // newly activated tab
				//console.log( e.relatedTarget );// previous active tab
				unactiveOther( e.target );
			})
		});

		var currentapp = 'center';
		function appwidths() {
			$('.app-center').css({'width': window.innerWidth - 400});
			$('.app-side').css({'width': window.innerWidth - 200});
			$('.app').css({'width': (3 * window.innerWidth) - 800});
			appslide(currentapp);
			//if (window.innerWidth < 1200) { $('.windowheightwide').css({'min-height': 'auto','height': 'auto'}); } else { $('.windowheightwide').css({'min-height': window.innerHeight-110,'height': window.innerHeight-110}); }
		}
		function appslide(side) {
			window.currentapp = side;
			if (side == 'left') {
				$('.app').css({'left': 0});
				$('.app-concepts').addClass('active-app');
				$('.app-principles, .app-fields').removeClass('active-app');
			}
			if (side == 'center') {
				$('.app').css({'left': -(window.innerWidth-400)});
				$('.app-principles').addClass('active-app');
				$('.app-concepts, .app-fields').removeClass('active-app');
			}
			if (side == 'right') {
				$('.app').css({'left': -(2*(window.innerWidth)-800)});
				$('.app-fields').addClass('active-app');
				$('.app-principles, .app-concepts').removeClass('active-app');
			}
		}
		$(document).ready(appwidths);
		$(document).ready( function(){
        	$('.lazy').lazy({
				effect: "fadeIn",
				effectTime: 2000,
				threshold: 0,
				visibleOnly: true, 
				effect: 'fadein'
			});
	    });
		
	<?php } ?>
		$(document).ready( function(){
			$( ".site--tabs a" ).click(function() {
				$('.site-menu').slideUp('40');
			});
	    });
	    function menutoggle() {
		    $('.site-menu').slideToggle('400',drawcartograph);
		    $('.site-menu-toggle').toggle();
	    }
	    function menuopen() {
		    $('.site-menu').slideDown('400',drawcartograph);
		    $('.site-menu-open').hide();
		    $('.site-menu-close').show();
	    }
	</script>
</head>
<body onresize="herowindowheight()<?php if (isset($loadjs['exploreapp'])) { ?>; appwidths();<?php } ?> ">
	<!-- Navigation -->
	<div class="container-fluid build-wrapper site-nav">
		<div class="row">
			<div class="col-sm-3"><a class="sitelogo" href="/"></a></div>
			<!--<div class="col-sm-4 tablet-hide hidden-xs"><?php if (in_array('livesearch', $loadjs)) { ?><input id="livesearch" class="nav-search" data-toggle="tooltip" data-placement="bottom" title="" onclick="this.select();" placeholder="Search..." value="Search..." data-original-title="Type to filter this page..."><?php } else { ?><h3 class="text-center" id="livesearch" style="color:#bbb;">Search...</h3><?php } ?></div>-->
			<div class="col-sm-9">
				<nav class="text-right">
					<ul id="navbar" class="nav-list" style="margin-bottom: 0px;">
						<li class="hidden-xs hidden-sm dropdown<?php if ($section == 'complexity') { ?> active<?php } ?>">
							<a href="#menu-map" onclick="menuopen(); " aria-controls="menu-urbanism" role="tab" data-toggle="tab" aria-expanded="false"><i class="fa fa-map-o" data-toggle="tooltip" data-placement="bottom" title="Complexity"></i> Navigate</a>
						</li>
						<li class="hidden-xs hidden-sm dropdown<?php if ($section == 'urbanism') { ?> active<?php } ?>">
							<a href="#menu-urbanism" onclick="menuopen(); " aria-controls="menu-urbanism" role="tab" data-toggle="tab" aria-expanded="false"><i class="fa fa-comments"></i> Urbanism</a>
						</li>
						<li class="">
							<a href="#menu" class="dropdown-toggle" onclick="menutoggle();" aria-controls="menu-start" role="tab" data-toggle="tab" aria-expanded="false"><span class="site-menu-toggle site-menu-open"><i class="fa fa-bars"></i> Menu</span><span class="site-menu-toggle site-menu-close" style="display: none;"><i class="fa fa-times"></i> Close</span></a>
						</li>
						<?php if($this->ion_auth->logged_in()) { ?>
						<li class="dropdown">
							<a href="/sitemap"><i class="fa fa-tree" data-toggle="tooltip" data-placement="bottom" title="Sitemap"></i></a>
						</li>
						<li class="dropdown">
							<a data-toggle="modal" data-target="#pageeditor"><i class="fa fa-pencil text-danger" data-toggle="tooltip" data-placement="bottom" title="Edit"></i></a>
						</li>
						<?php } ?>
						</li>
					</ul><!--/.nav-collapse -->
				</nav>
			</div>
		</div>
	</div>
	<!-- /Navigation -->
