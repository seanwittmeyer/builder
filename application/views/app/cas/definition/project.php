<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* 
* Definition - Article View
*
* This is a view used by single definitions with the 'article' template set.
* 
*/

$set = $this->shared->get_related_parents($type,$id,true); ?> 
<!-- Page map as a page nav in the top right corner -->
	<canvas id="pagemap" class="article"></canvas>
	<!-- /pagemap -->
	<article class="article-project container-fluid">
		<div class="row">
			<nav class="col-md-5 vh100">
				<!-- Nav -->
					<header>
						<div class="subtitle">Recent work</div>
						<div class="title"><a href="/projects">Projects</a> <?php $this->load->view('helpers/menu-projects'); ?></div>
					</header>
					<summary>
						<div class="subtitle" data-editable="" data-name="payload[subtitle]"><p><?=$subtitle?></p></div>
						<div data-editable="" data-name="payload[title]"><h1><?=$title?></h1></div><!-- (<?=$id?>)-->
						<div class="excerpt" data-editable="" data-name="payload[excerpt]"><p><?=$this->shared->handlebar_links($excerpt)?></p></div>
					</summary>
					<aside>
						<p class="meta">This project was last updated <br><?php echo $this->shared->twitterdate($timestamp, true); ?>.</p>
						<ul class="articlethemes">
							<?php /* Get related themes */
							$themes = $this->shared->get_related('taxonomy','34'); 
							$_themes = array(); 
							foreach ($themes as $i) $_themes[] = $i['id'];
							if (is_array($set)) foreach ($set as $s) if ($s['type']=='taxonomy' && in_array($s['id'],$_themes)) { ?>
							<li style="background-image: url(<?=$s['icon']?>);"><a class="" href="/theme/<?=$s['slug']?>"><?=$s['title']?></a></li>
							<?php } ?> 
						</ul>
					</aside>
				<!-- /Nav -->
			</nav>
			<main class="col-md-7 vh100">
				<!-- Body -->
					<div class="body" data-editable="" data-name="payload[body]">
						<?php echo $this->shared->handlebar_links($body); ?>
					</div>
					<?php $this->shared->footer_photocitation($id,$img,$timestamp,$slug,$title); ?>
				<!-- /Body -->
			</main>
		</div>
	</article>
							
							
							
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
					<li class="nav-item" role="presentation"><a class="nav-link" id="editor-link-tab" data-toggle="tab" href="#editlink" role="tab" aria-controls="editlink" aria-selected="false">New Link</a></li> 
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
									<?php foreach (get_filenames("./application/views/app/cas/definition") as $pagetemplate) { $pagetemplate = str_replace('.php', '', $pagetemplate); ?>
									<option value="<?php echo $pagetemplate; ?>"<?php if ($pagetemplate == $template) { ?> selected="selected"<?php } ?>><?php echo ucfirst($pagetemplate); ?></option>
									<?php } ?>
								</select>
								<label for="payload[template]">Page Template</label>
							</div>
							<div class="form-label-group">
								<input type="text" class="form-control" placeholder="Subtitle" required="" autocomplete="off" name="payload[subtitle]" value="<?=$subtitle?>">
								<label for="payload[subtitle]">Subtitle</label>
							</div>
							<div class="form-label-group">
								<input type="text" class="form-control" placeholder="Page Title" required="" autocomplete="off" name="payload[author]" value="<?=$author?>">
								<label for="payload[author]">Author</label>
							</div>
							<div class="">
								<label for="payload[relationships][definition][]">Definitions</label>
								<select name="payload[relationships][definition][]" class="selectpicker form-control" data-width="100%" data-live-search="true" data-size="5" multiple data-selected-text-format="count > 4">
									<?php // List definitions
									$list = $this->shared->list_bytype('definition'); $relationships = array(); $relationships = $this->shared->get_related($type, $id, true, false); if ($relationships === false) $relationships = array(); 
									if (!isset($relationships['definition'])) $relationships['definition'] = array(); //var_dump($relationships);
									if ($list === false) { echo '<option disabled>No definitions to display.</option>'; } else {
									foreach ($list as $a) { $selected = (in_array($a['id'],$relationships['definition'])) ? ' selected' : ''; echo '<option value="'.$a['id'].'"'.$selected.'>'.$a['title']."</option>\n"; }} ?> 
								</select>
							</div>
							<div class="">
								<label for="payload[relationships][taxonomy][]">Taxonomy</label>
								<select name="payload[relationships][taxonomy][]" class="selectpicker form-control" data-width="100%" data-live-search="true" data-size="5" multiple data-selected-text-format="count > 4">
									<?php // List taxonomy
									$list = $this->shared->list_bytype('taxonomy'); if (!isset($relationships['taxonomy'])) $relationships['taxonomy'] = array();
									if ($list === false) { echo '<option disabled>No taxonomy to display.</option>'; } else {
									foreach ($list as $a) { $selected = (in_array($a['id'],$relationships['taxonomy'])) ? ' selected' : ''; echo '<option value="'.$a['id'].'"'.$selected.'>'.$a['title']."</option>\n"; }} ?> 
								</select>
							</div>
							<div class="">
								<label for="payload[relationships][page][]">Pages</label>
								<select name="payload[relationships][page][]" class="selectpicker form-control" data-width="100%" data-live-search="true" data-size="5" multiple data-selected-text-format="count > 4">
									<?php // List taxonomy
									$list = $this->shared->list_bytype('page');  if (!isset($relationships['page'])) $relationships['page'] = array();
									if ($list === false) { echo '<option disabled>No pages to display.</option>'; } else {
									foreach ($list as $a) { $selected = (in_array($a['id'],$relationships['page'])) ? ' selected' : ''; echo '<option value="'.$a['id'].'"'.$selected.'>'.$a['title']."</option>\n"; }} ?> 
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
					<div class="tab-pane fade" id="editlink" role="tabpanel" aria-labelledby="editor-link-tab">
						<!-- Start New Link Tab -->
						<?php $this->load->view('helpers/editor-link'); ?> 
						<!-- End New Link Tab -->
					</div>
				</div>
			</nav>
		<!-- /main nav -->
		</div>
	</div>
	<!-- /Off canvas -->
	<?php } ?>
	<!-- Modal -->
	<div class="modal fade" id="deletemodal" tabindex="-1" role="dialog" aria-labelledby="deletemodal" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Delete</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				</div>
				<div class="modal-body">You are about to delete this page.</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary pull-right" data-dismiss="modal">Just kidding, close</button>
					<a href="/api/remove/page/<?php echo $id; ?>/home" class="btn btn-danger">Delete this page</a>
				</div>
			</div>
		</div>
	</div>
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
																