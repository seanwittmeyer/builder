<!-- Page map as a page nav in the top right corner -->
	<canvas id="pagemap" class="article"></canvas>
	<!-- /pagemap -->
	<!-- Header -->
	<header class="article-header container-fluid">
		<div class="row">
			<div class="col-sm-5 wrapper" style="background: none;">
				<div class="subtitle">Content Explorer</div>
				<div class="title">Pages 
				<!-- Field Notes section menu -->
				<?php if ($this->ion_auth->logged_in()) { ?>
				<div class="dropdown" style="display: inline-block;">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></a>
					<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
						<a class="dropdown-item" href="/definition">View all Definitions/People/Terms</a>
						<a class="dropdown-item" href="/taxonomy">View all Taxonomy/Categories/Collections</a>
						<a class="dropdown-item" href="/pages">View all Pages</a>
						<div class="dropdown-divider"></div>
						<span class="dropdown-header">Create New Content</span>
						<a class="dropdown-item" onclick="openeditor();"><i class="fas fa-book"></i> New Definition</a>
						<a class="dropdown-item" onclick="openeditor();"><span class="glyphicon glyphicon-link" aria-hidden="true"></span> New Taxonomy (or collection)</a>
						<a class="dropdown-item" onclick="openeditor();"><span class="glyphicon glyphicon-file" aria-hidden="true"></span> New Page</a>
					</div>
				</div>
				<?php } ?> 
				<!-- /Field Notes menu -->
				</div>
			</div>
			<div class="col-sm-7"></div>
		</div>
	</header>
	<!-- Header -->
	<!-- Article -->
	<article class="article-article">
		<div class="container-fluid">
			<header class="col-sm-10 col-lg-8">
				<div><h1>All Pages</h1></div>
			</header>
			<div class="row">
				<div class="col-sm-5 col-md-4">
					<div class="excerpt"><p>This is a listing of all pages in the site. Much of the content in this site is also categorized as <a href="/definition">definitions (key thinkers, attributes, etc)</a> and <a href="/taxonomy">taxonomies (collections, applications, sets, etc.)</a>, both good places to find what you may be looking for.</p></div>
				</div>
				<div class="d-none d-md-block col-md"></div>
				<div class="col-sm-7">

			<?php $set = $this->shared->get_data2('page',false,false,true); ?>
			<?php foreach ($set as $single) { ?>
				<?php if ($this->ion_auth->is_admin()) { ?><a href="/api/remove/page/<?php echo $single['id']; ?>/refresh" class="btn btn-danger btn-sm float-right" data-toggle="tooltip" data-title="Are you sure? No going back..."><span class=""></span>Delete</a><?php } ?>
				<h4><a class="t_list_<?php echo $single['id']; ?>" href="/<?php echo $single['slug']; ?>"><?php echo $single['title']; ?></a></h4>
				<hr>
			<?php } ?>

				</div>
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
