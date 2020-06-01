<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* 
 * Content - Feed View
 *
 * This is the listing view that shows feed items for a specified $type.
 * 
 */
 $_icon = array(
	 'html' => 'fas fa-globe',
	 'video' => 'fas fa-tv',
	 'book' => 'fas fa-book-open',
	 'paper' => 'fas fa-file',
	 'profile' => 'fas fa-id-badge',
	 'file' => 'fas fa-newspaper-o',
	 'other' => 'fas fa-tree',
 );
 
 ?><!-- General Content Block --
<div class="container-fluid build-wrapper">
	<div class="row topbottom-somespace">
		<div class="col-md-12">
			<div class="feed-menu">
				<a class="<?php if ($type == 'html') echo ' active'; ?>" href="/feed/html"><i class="fas fa-globe"></i><span>Websites</span></a>
				<a class="<?php if ($type == 'video') echo ' active'; ?>" href="/feed/video"><i class="fas fa-television"></i><span>Videos</span></a>
				<a class="<?php if ($type == 'book') echo ' active'; ?>" href="/feed/book"><i class="fas fa-book"></i><span>Books</span></a>
				<a class="<?php if ($type == 'paper') echo ' active'; ?>" href="/feed/paper"><i class="fas fa-file-text-o"></i><span>Papers</span></a>
				<a class="<?php if ($type == 'profile') echo ' active'; ?>" href="/feed/profile"><i class="fas fa-id-badge"></i><span>Profiles</span></a>
				<a class="<?php if ($type == 'file') echo ' active'; ?>" href="/feed/file"><i class="fas fa-newspaper-o"></i><span>Files</span></a>
				<a class="<?php if ($type == 'other') echo ' active'; ?>" href="/feed/other"><i class="fas fa-tree"></i><span>Other</span></a>
			</div>
			<h1>The Feed</h1>
			<p style="font-weight: bold;">Dive into all of the <?php echo ($type == 'html') ? 'websites' : $type.'s'; ?> that have been posted to the feed across the Complexity Explorer.</p>
		</div>
	</div>
</div>
<!-- /General Content Block -->

	<!-- Page map as a page nav in the top right corner -->
	<canvas id="pagemap" class="article"></canvas>
	<!-- /pagemap -->
	<!-- Header -->
	<header class="article-header container-fluid">
		<div class="row">
			<div class="col-sm-5 wrapper" style="background: none;">
				<div class="subtitle">Notable and worth sharing</div>
				<div class="title">The Feed &rarr; <?php echo (!empty($type)) ? ($type == 'html') ? 'Websites' : ucfirst($type.'s') : 'Everything'; ?> 
				<!-- Field Notes section menu -->
				<div class="dropdown" style="display: inline-block;">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></a>
					<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
						<span class="dropdown-header">The feed is a curated collection of <br>articles, videos, books, people, <br>and links related to my interests in <br>the built environment and technology.</span>
						<a class="dropdown-item<?php if ($type == '') echo ' active'; ?>" href="/feed"><span>Everything &rarr;</span></a>
						<div class="dropdown-divider"></div>
						<a class="dropdown-item<?php if ($type == 'html') echo ' active'; ?>" href="/feed/html"><i class="<?=$_icon['html']?>"></i> <span>Websites</span></a>
						<a class="dropdown-item<?php if ($type == 'video') echo ' active'; ?>" href="/feed/video"><i class="<?=$_icon['video']?>"></i> <span>Videos</span></a>
						<a class="dropdown-item<?php if ($type == 'book') echo ' active'; ?>" href="/feed/book"><i class="<?=$_icon['book']?>"></i> <span>Books</span></a>
						<a class="dropdown-item<?php if ($type == 'paper') echo ' active'; ?>" href="/feed/paper"><i class="<?=$_icon['paper']?>"></i> <span>Papers</span></a>
						<a class="dropdown-item<?php if ($type == 'profile') echo ' active'; ?>" href="/feed/profile"><i class="<?=$_icon['profile']?>"></i> <span>Profiles</span></a>
						<a class="dropdown-item<?php if ($type == 'file') echo ' active'; ?>" href="/feed/file"><i class="<?=$_icon['file']?>"></i> <span>Files</span></a>
						<a class="dropdown-item<?php if ($type == 'other') echo ' active'; ?>" href="/feed/other"><i class="<?=$_icon['other']?>"></i> <span>Other</span></a>
						<?php if ($this->ion_auth->logged_in()) { ?>
						<div class="dropdown-divider"></div>
						<span class="dropdown-header">Create New Content</span>
						<a class="dropdown-item" onclick="openeditor();"><i class="fas fa-book"></i> New Definition</a>
						<a class="dropdown-item" onclick="openeditor();"><i class="fas fa-box-open"></i> New Taxonomy (or collection)</a>
						<a class="dropdown-item" onclick="openeditor();"><i class="far fa-file"></i> New Page</a>
						<?php } ?> 
					</div>
				</div>
				<!-- /Field Notes menu -->
				</div>
			</div>
			<div class="col-sm-7">
					<div class="input-group naked align-bottom">
						<div class="input-group-prepend">
						<div class="input-group-text"><i class="fas fa-filter"></i> &nbsp; Themes:</div>
						<?php /* Get related themes */
						$themes = $this->shared->get_related('taxonomy','34'); 
						foreach ($themes as $i) { ?> 
						<button class="btn" type="button" onclick="$('#livesearch').val('<?=$i['title']?>').trigger('keyup'); return false;" data-toggle="tooltip" data-title="<?=$i['title']?>"><img src="<?=$i['icon']?>"></button>
						<?php } ?>
						<div class="input-group-text"> | </div>
						<div class="input-group-text"><i class="fas fa-search"></i></div>
					</div>
					<input type="text" class="form-control" id="livesearch" placeholder="search...">
					<div class="input-group-append">
						<button class="btn" type="button" onclick="$('#livesearch').val('').trigger('keyup');" data-toggle="tooltip" data-title="Show All"><i class="fas fa-times"></i></button>
					</div>
				</div>
		</div>
	</header>
	<!-- Header -->
	<!-- Article -->
	<article class="article-article">
		<div class="container-fluid">
			<div class="card-columns grid-filter">
				<?php $_where = (empty($type)) ? false: array('type'=>$type);
				$feeditems = $this->shared->get_data2('link',false,$_where); if ($feeditems) { ?>
					<?php foreach ($feeditems as $link) { 
						$__host = $this->shared->get_data($link['hosttype'],$link['hostid']); 
					?> 
					<div class="cas-embed card" data-searchval="<?php echo str_replace('"', '', ($link['title'].' '.$link['excerpt'].' '.$link['type'])).' '.$__host['title']; ?>">
						<blockquote class="embedly-card" data-card-key="74435e49e8fa468eb2602ea062017ceb" data-card-controls="0"><h4><a href="<?php echo $link['uri']; ?>"><?php echo $link['title']; ?></a></h4><p><?php echo $link['excerpt']; ?></p></blockquote><div class="feed-footer"><i class="far fa-comment-dots"></i> <?=$link['caption']?><br><address data-toggle="tooltip" data-title="<?php echo $link['type']; ?>"><i class="<?=$_icon[$link['type']]?>"></i></address> | <address data-toggle="tooltip" data-title="<?php echo $link['excerpt']; ?>">Description</address> | <i class="fas fa-link"></i> <a href="/<?php echo $link['hosttype']; ?>/<?php echo $__host['slug']; ?>"><?php echo $__host['title']; ?></a><?php if ($this->ion_auth->is_admin()) { ?> | <a href="/api/remove/link/<?php echo $link['id']; ?>/refresh" data-toggle="tooltip" data-title="Are you sure?"><i class="fas fa-trash"></i></a><?php } ?></div>
					</div><!-- /CAS Embed -->
					<?php } ?>
				<?php } else { ?>
				<div class="col-lg-5 col-sm-8">
					<h3>Well shoot...</h3>
					<p>The site is constantly evolving and it appears we don't have of this type of item in the feed. Check out the latest <a href="/feed/video">videos</a>, <a href="/feed/html">webpages</a> or one of the other types of items we have!</p>
				</div>
				<?php } ?>
			</div>
		</div>
	</article>
	<!-- /Article -->
	<?php if ($this->ion_auth->logged_in()) { ?>
	<!-- Off canvas -->
	<div class="offcanvaspane">
		<div class="container">
			<!-- Main nav tabs in the bottom left corner -->
			<nav id="editornav" class="inlinetabs">
				<a class="sectiontitle" onclick="$('body').removeClass('offcanvas'); return false;">Editor</a>
				<ul class="nav nav-tabs" id="offcanvastabs" role="tablist">
					<li class="nav-item" role="presentation"><a class="nav-link active" id="editor-new-tab" data-toggle="tab" href="#editnew" role="tab" aria-controls="editnew" aria-selected="false">+ New</a></li> 
				</ul>
				<div class="tab-content" id="offcanvaspanes">
					<div class="tab-pane fade show active" id="editnew" role="tabpanel" aria-labelledby="editor-new-tab">
					<!-- Start New Content Tab -->
					<?php $this->load->view('helpers/editor-new'); ?> 
					<!-- End New Content Tab -->
					</div>
				</div>
			</nav>
			<!-- /main nav -->
		</div>
	</div>
	<!-- /Off canvas -->
	<?php } ?>
	<script>
		//pagemap(document.querySelector('#pagemap'));
		pagemap(document.querySelector('#pagemap'), {
			viewport: null,
			styles: {
				'.title,nav,p': 'rgba(0,0,0,0.08)',
				'h1,a': 'rgba(0,0,0,0.10)',
				'h2,h3,h4': 'rgba(0,0,0,0.08)',
			},
			back: 'rgba(0,0,0,0.02)',
			view: 'rgba(0,0,0,0.05)',
			drag: 'rgba(0,0,0,0.10)',
			interval: null,
		});
	</script>
	<script type="text/javascript">
		$(document).ready(function(){
			$("#livesearch").keyup(function(){
				// Retrieve the input field text and reset the count to zero
				$(".hideonsearch").hide();
				var filter = $(this).val(), count = 0;
				console.log(filter);
				// Loop through the comment list
				$(".card").each(function(){
					// If the list item does not contain the text phrase fade it out
					/*if ($(this).text().search(new RegExp(filter, "i")) < 0) {
						$(this).fadeOut();
					// Show the list item if the phrase matches and increase the count by 1
					} else */ if ($(this).attr('data-searchval').search(new RegExp(filter, "i")) < 0) {
						$(this).fadeOut(30);
					// Show the list item if the phrase matches and increase the count by 1
					} else {
						$(this).show();
						count++;
					}
					//$('.masonrygrid').masonry();
				});
				// Update the count
				var numberItems = count;
				$("#filter-count").text(count+" results");
			});
		});
	
	</script>
	
