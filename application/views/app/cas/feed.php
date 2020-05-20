	<!-- General Content Block -->
	<div class="container-fluid build-wrapper">
		<div class="row topbottom-somespace">
			<div class="col-md-12">
				<div class="feed-menu">
					<a class="<?php if ($type == 'html') echo ' active'; ?>" href="/feed/html"><i class="fa fa-globe"></i><span>Websites</span></a>
					<a class="<?php if ($type == 'video') echo ' active'; ?>" href="/feed/video"><i class="fa fa-television"></i><span>Videos</span></a>
					<a class="<?php if ($type == 'book') echo ' active'; ?>" href="/feed/book"><i class="fa fa-book"></i><span>Books</span></a>
					<a class="<?php if ($type == 'paper') echo ' active'; ?>" href="/feed/paper"><i class="fa fa-file-text-o"></i><span>Papers</span></a>
					<a class="<?php if ($type == 'profile') echo ' active'; ?>" href="/feed/profile"><i class="fa fa-id-badge"></i><span>Profiles</span></a>
					<a class="<?php if ($type == 'file') echo ' active'; ?>" href="/feed/file"><i class="fa fa-newspaper-o"></i><span>Files</span></a>
					<a class="<?php if ($type == 'other') echo ' active'; ?>" href="/feed/other"><i class="fa fa-tree"></i><span>Other</span></a>
				</div>
				<h1>The Feed</h1>
				<p style="font-weight: bold;">Dive into all of the <?php echo ($type == 'html') ? 'websites' : $type.'s'; ?> that have been posted to the feed across the Complexity Explorer.</p>
			</div>
		</div>
	</div>
	<!-- /General Content Block -->
	<!-- Panels -->
	<div class="container-fluid top-nospace">
		<div class="">
			<div class="col-sm-12">
				<?php $feeditems = $this->shared->get_data2('link',false,array('type'=>$type)); if ($feeditems) { ?>
				<div class="masonrygrid grid-filter">
					<?php foreach ($feeditems as $link) { 
						$__host = $this->shared->get_data($link['hosttype'],$link['hostid']); 
					?> 
					<div class="cas-embed col-lg-2 col-md-3 col-sm-4 masonryblock grid-filter-single" data-searchval="<?php echo str_replace('"', '', ($link['title'].' '.$link['excerpt'])).' '.$__host['title']; ?>">
						<blockquote class="embedly-card" data-card-key="74435e49e8fa468eb2602ea062017ceb" data-card-controls="0"><h4><a href="<?php echo $link['uri']; ?>"><?php echo $link['title']; ?></a></h4><p><?php echo $link['excerpt']; ?></p></blockquote><div class="feed-footer"><address data-toggle="tooltip" data-title="<?php echo $link['excerpt']; ?>">Description</address> | This is linked to <a href="/<?php echo $link['hosttype']; ?>/<?php echo $__host['slug']; ?>"><?php echo $__host['title']; ?></a>.<?php if ($this->ion_auth->is_admin()) { ?> | <a href="/api/remove/link/<?php echo $link['id']; ?>/refresh" data-toggle="tooltip" data-title="Are you sure?">Delete</a><?php } ?></div>
					</div><!-- /CAS Embed -->
					<?php } ?>
				</div>
				<?php } else { ?>
				<div class="col-lg-5 col-sm-8">
					<h3>Well shoot...</h3>
					<p>The site is constantly evolving and it appears we don't have of this type of item in the feed. Check out the latest <a href="/feed/video">videos</a>, <a href="/feed/html">webpages</a> or one of the other types of items we have!</p>
				</div>
				<?php } ?>
			</div>
		</div>
	</div>
	<script type="text/javascript">
		$(document).ready(function(){
		    $("#livesearch").keyup(function(){
		        // Retrieve the input field text and reset the count to zero
		        $(".hideonsearch").hide();
		        var filter = $(this).val(), count = 0;
		        console.log(filter);
		        // Loop through the comment list
		        $(".grid-filter .grid-filter-single").each(function(){
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
		            $('.masonrygrid').masonry();
		        });
		        // Update the count
		        var numberItems = count;
		        $("#filter-count").text(count+" results");
		    });
		});
	
	</script>