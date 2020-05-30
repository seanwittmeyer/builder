<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* 
 * Page - Article View
 *
 * This is a view used by single pages with the 'article' template set.
 * 
 */
 
?> 
<!-- Page map as a page nav in the top right corner -->
	<canvas id="pagemap" class="article"></canvas>
	<!-- /pagemap -->
	<!-- Header -->
	<header class="article-header container-fluid">
		<div class="row">
			<div class="col-sm-5 wrapper" style="background: transparent; ">
				<div class="subtitle">Site utilities</div>
				<div class="title">Add Content <?php $this->load->view('helpers/menu-fieldnotes'); ?></div>
			</div>
			<div class="col-sm-7"></div>
		</div>
	</header>
	<!-- /Header -->
	<!-- Article -->
	<article class="article-theme">
		<div class="container-fluid">
			<div class="row ">
				<div class="col-md d-none d-lg-block"></div>
				<div class="col-md-5 col-lg-4 text-right"></div>
				<header class="col-md-7 col-lg-6">
					<div data-editable="" data-name="payload[title]"><h1>Let's add some content</h1></div>
					<div class="excerpt" data-editable="" data-name="payload[subtitle]"><p>The easiest way to add pages and other content is on this page. Either set initial content or click create to get an untitled template.</p></div>
				</header>
				<div class="d-none d-sm-block col-sm"></div>
			</div>
			<div class="row">
				<div class="col-md d-none d-lg-block"></div>
				<div class="col-md-5 col-lg-4 text-right ">
					<aside class="col-sm-10 float-right">
						<nav id="themenav" class="pilltabs">
							<ul class="nav nav-tabs" role="tablist">
								<li class="nav-item d-block" role="presentation"><a class="nav-link active" id="new-all-tab" data-toggle="tab" href="#newall" role="tab" aria-controls="newall" aria-selected="true">Quick Create <i class="fas fa-plus"></i></a></li> 
								<li class="nav-item d-block" role="presentation"><a class="nav-link" id="new-tax-tab" data-toggle="tab" href="#newtax" role="tab" aria-controls="newtax" aria-selected="false">Theme/Collection <i class="fas fa-th-large"></i></a></li> 
								<li class="nav-item d-block" role="presentation"><a class="nav-link" id="new-def-tab" data-toggle="tab" href="#newdef" role="tab" aria-controls="newdef" aria-selected="false">Article <i class="fas fa-scroll"></i></a></li> 
								<li class="nav-item d-block" role="presentation"><a class="nav-link" id="new-page-tab" data-toggle="tab" href="#newpage" role="tab" aria-controls="newpage" aria-selected="false">Page <i class="far fa-file-alt"></i></a></li> 
								<li class="nav-item d-block" role="presentation"><a class="nav-link" id="new-link-tab" data-toggle="tab" href="#newlink" role="tab" aria-controls="newlink" aria-selected="false">Link/Feed Item <i class="fas fa-link"></i></a></li> 
							</ul>
						</nav>
					</aside>
				</div>
				<div class="col-md-7 col-lg-6">
					<div class="tab-content" id="offcanvaspanes">
						<div class="tab-pane fade show active" id="themeintro" role="tabpanel" aria-labelledby="theme-intro-tab">
						<!-- Introduction -->
						<!-- /Introduction -->
						</div>
						<div class="tab-pane fade" id="themebody" role="tabpanel" aria-labelledby="theme-body-tab">
						<!-- Body -->
						<!-- /Body -->
						</div>
						<div class="tab-pane fade" id="themefeed" role="tabpanel" aria-labelledby="theme-feed-tab">
						<!-- Feed -->
						<!-- /Feed -->
						</div>
					</div>
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
					<li class="nav-item" role="presentation"><a class="nav-link active" id="editor-edit-tab" data-toggle="tab" href="#edit" role="tab" aria-controls="edit" aria-selected="true">Page</a></li> 
					<li class="nav-item" role="presentation"><a class="nav-link" id="editor-img-tab" data-toggle="tab" href="#editimg" role="tab" aria-controls="editimg" aria-selected="false">Header Image</a></li> 
					<li class="nav-item" role="presentation"><a class="nav-link" id="editor-new-tab" data-toggle="tab" href="#editnew" role="tab" aria-controls="editnew" aria-selected="false">+ New</a></li> 
				</ul>
				<div class="tab-content" id="offcanvaspanes">
					<div class="tab-pane fade show active" id="edit" role="tabpanel" aria-labelledby="editor-edit-tab">
					<!-- Start Page Editor Tab -->
					<form id="formeditor" >
						<div class="form-label-group">
							<input type="text" class="form-control" placeholder="Page Title" required="" autocomplete="off" name="payload[title]" value="<?=$title?>">
							<label for="payload[title]">Page Title</label>
						</div>
						<div class="form-label-group">
							<textarea type="text" class="form-control" placeholder="Excerpt" required="" autocomplete="off" name="payload[excerpt]"><?=$excerpt?></textarea>
							<label for="payload[excerpt]">Excerpt</label>
						</div>
						<div class="form-label-group">
							<select name="payload[template]" class="form-control">
								<?php foreach (get_filenames("./application/views/app/pages") as $pagetemplate) { $pagetemplate = str_replace('.php', '', $pagetemplate); ?>
								<option value="<?php echo $pagetemplate; ?>"<?php if ($pagetemplate == $template) { ?> selected="selected"<?php } ?>><?php echo ucfirst($pagetemplate); ?></option>
								<?php } ?>
							</select>
							<label for="payload[template]">Page Template</label>
						</div>
						<div class="form-label-group">
							<select name="payload[pagetype]" class="form-control">
								<?php foreach (array('page','blog') as $__pagetype) { ?>
								<option value="<?php echo $__pagetype; ?>"<?php if ($__pagetype == $pagetype) { ?> selected="selected"<?php } ?>><?php echo ucfirst($__pagetype); ?></option>
								<?php } ?>
							</select>
							<label for="payload[pagetype]">Page Type</label>
						</div>
						<div class="form-label-group">
							<input type="text" class="form-control" placeholder="Page Title" required="" autocomplete="off" name="payload[blogtype]" value="<?=$blogtype?>">
							<label for="payload[blogtype]">Blog Type</label>
						</div>
						<div class="form-label-group">
							<input type="text" class="form-control" placeholder="Page Title" required="" autocomplete="off" name="payload[author]" value="<?=$author?>">
							<label for="payload[author]">Author</label>
						</div>
						<div class="">
							<label for="payload[relationships][definition][]">Definitions</label>
							<select name="payload[relationships][definition][]" class="selectpicker form-control" data-width="100%" data-live-search="true" data-size="5" multiple data-selected-text-format="count > 4">
							<?php // List definitions
								$list = $this->shared->list_bytype('definition'); $relationships = array(); if ($set !== false) foreach ($set as $ss) $relationships[] = $ss['id'];
								if ($list === false) { echo '<option disabled>No definitions to display.</option>'; } else {
								foreach ($list as $a) { $selected = (in_array($a['id'],$relationships)) ? ' selected' : ''; echo '<option value="'.$a['id'].'"'.$selected.'>'.$a['title']."</option>\n"; }} ?> 
							</select>
						</div>
						<div class="">
							<label for="payload[relationships][taxonomy][]">Taxonomy</label>
							<select name="payload[relationships][taxonomy][]" class="selectpicker form-control" data-width="100%" data-live-search="true" data-size="5" multiple data-selected-text-format="count > 4">
							<?php // List taxonomy
								$list = $this->shared->list_bytype('taxonomy');
								if ($list === false) { echo '<option disabled>No taxonomy to display.</option>'; } else {
								foreach ($list as $a) { $selected = (in_array($a['id'],$relationships)) ? ' selected' : ''; echo '<option value="'.$a['id'].'"'.$selected.'>'.$a['title']."</option>\n"; }} ?> 
							</select>
						</div>
						<div class="">
							<label for="payload[relationships][page][]">Pages</label>
							<select name="payload[relationships][page][]" class="selectpicker form-control" data-width="100%" data-live-search="true" data-size="5" multiple data-selected-text-format="count > 4">
							<?php // List taxonomy
								$list = $this->shared->list_bytype('page');
								if ($list === false) { echo '<option disabled>No pages to display.</option>'; } else {
								foreach ($list as $a) { $selected = (in_array($a['id'],$relationships)) ? ' selected' : ''; echo '<option value="'.$a['id'].'"'.$selected.'>'.$a['title']."</option>\n"; }} ?> 
							</select>
						</div>
						<br />
						<hr>
						<div id="editorfail" class="alert alert-danger " style="display: none;" role="alert">Uh oh, the <?php echo $type; ?> didn't save, make sure everything above is filled and try again.</div>
						<div id="editorsuccess" class="alert alert-success " style="display: none;" role="alert">Great success, content posted.</div>
						<div id="editorloading" class="alert alert-info progress-bar progress-bar-striped active" style="display: block; width: 100%; display: none;" role="alert">working...</div>
						<div id="editorbuttons" class="offcanvasbuttons">
							<a class="btn btn-danger pull-right" href="#" data-toggle="modal" data-target="#deletemodal">Delete</a>
							<button type="button" class="btn btn-primary tt" id="submiteditor">Save</button>
							<button type="reset" class="btn btn-default" >Reset</button>
						</div>
						<p>Body Content</p>
						<div class=""><textarea type="text" class="cas-summernote" id="cas-def-body" name="payload[body]"><?php echo $body; ?></textarea></div>
						<div class="form-label-group">
							<input type="text" class="form-control" placeholder="Link/Slug" required="" autocomplete="off" name="payload[slug]" value="<?=$slug?>">
							<label for="payload[slug]">Slug</label>
						</div>
					</form>
					<!-- End Page Editor Tab -->
					</div>
					<div class="tab-pane fade" id="editimg" role="tabpanel" aria-labelledby="editor-img-tab">
					<?php $this->load->view('helpers/editor-headerimage'); ?> 
					</div>
					<div class="tab-pane fade" id="editnew" role="tabpanel" aria-labelledby="editor-new-tab">
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
	<?php if ($this->ion_auth->logged_in() && isset($loadjs['contenttools'])) { 
		$this->load->view("helpers/contenttools");
		$this->load->view("helpers/editor-scripts");
	} ?> 
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
