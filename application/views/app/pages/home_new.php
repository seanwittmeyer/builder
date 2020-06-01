<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* 
 * Page - Home View
 *
 * This is a view used by single pages with the 'home' template set.
 * 
 */
 
$t = date('G',time());
$timeofday = ($t>18) ? 'Evening': ($t>12) ? 'Afternoon': 'Morning';
$weather = $this->shared->weather($location=false,$source='ip',$formatted=false);


 ?> 
	<!--<pre><?php echo json_encode($weather); ?></pre>-->

	<!-- Article -->
	<article class="article-home">
		<div class="container-fluid">
			<div class="row fullpage">
				<div class="col-sm-5 vh-100 intro">
				<!-- Intro Column -->
					<div class="subtitle"><?=date("g:ia",time())?> in <?=$weather['city']?>, <?=$weather['regionName']?></div>
					<div class="title">Good <?=$timeofday?></div>
					<div class="body" data-editable="" data-name="payload[body]">
						<?=$body?>
					</div>
				<!-- /Intro Column -->
				</div>
				<div class="col-sm-6 vh-100 content flex-column">
					<div class="row">
						<!-- Projects Column -->
							<div class="col-sm-8 projects">
								<div class="subtitle">Recent work</div>
								<div class="title">Projects</div>
								<div class="row" style="padding-top:10px;">
									<?php $p = $this->shared->get_data2('definition', 216); ?>
									<div class="col-4 image align-self-center">
										<a href="/project/<?=$p['slug']?>"><img src="<?php $p['img'] = unserialize($p['img']); echo (isset($p['img']['header']) && !empty($p['img']['header'])) ? $p['img']['header']['url']: '/includes/test/assets/Moofushi_Kandu_fish.jpg'; ?>"></a>
									</div>
									<div class="col-8">
										<a href="/project/<?=$p['slug']?>"><div class="title"><?=$p['title']?></div></a>
										<div class="excerpt"><?=$p['excerpt']?></div>
									</div>
								</div>
								<div class="links"><strong>More:</strong> <a href="/project/architecture">Architectural Work</a> | <a href="/project/web">Web Development</a> | <a href="/resume">Resume</a></div>
							</div>
							<div class="col-sm-4 portfolio" onclick="window.location.assign('//sean.wittmeyer.io')">
								<div class="subtitle">Portfolio</div>
								<div class="title">Digi-Arch</div>
								<a href="//sean.wittmeyer.io/" target="_blank">sean.wittmeyer.io</a>
							</div>
						<!-- /Projects Row -->
					</div>
					<div class="row">
						<!-- Projects Column -->
							<div class="col-sm-8 notes">
								<div class="subtitle">Observations &amp; ideas on the built environment</div>
								<div class="title">Field Notes</div>
								<?php foreach (array('215','216') as $d) { ?> 
								<div class="row article" style="padding-top:10px;">
									<?php $p = $this->shared->get_data2('definition', $d); ?>
									<div class="col-4 image align-self-center">
										<a href="/project/<?=$p['slug']?>"><img src="<?php $p['img'] = unserialize($p['img']); echo (isset($p['img']['header']) && !empty($p['img']['header'])) ? $p['img']['header']['url']: '/includes/test/assets/Moofushi_Kandu_fish.jpg'; ?>"></a>
									</div>
									<div class="col-8">
										<a href="/project/<?=$p['slug']?>"><div class="title"><?=$p['title']?></div></a>
										<div class="excerpt"><?=$p['excerpt']?></div>
									</div>
								</div>
								<?php } ?>
								<div class="links"><strong>More:</strong> <a href="/project/architecture">Architectural Work</a> | <a href="/project/web">Web Development</a> | <a href="/resume">Resume</a></div>
							</div>
							<div class="col-sm-4">
								<div class="subtitle">Themes</div>
								<div class="row no-gutters themeicons">
									<?php /* Get related themes */
									$themes = $this->shared->get_related('taxonomy','34'); 
									foreach ($themes as $i) { ?> 
									<div class="col-2" data-toggle="tooltip" data-title="<?=$i['title']?>"><a href="<?=$i['slug']?>"><img src="<?=$i['icon']?>"></a></div>
									<?php } ?>
								</div>
								<ul class="article-home asidelist">
									<?php /* Get related themes */
									foreach ($themes as $i) { ?> 
									<li><a href="<?=$i['slug']?>"><?=$i['title']?></a></li>
									<?php } ?>
								</ul>
							</div>
						<!-- /Projects Row -->
					</div>
					<div class="row flex-1">
						<!-- Projects Column -->
							<div class="col-sm-8">
								<div class="subtitle">Sustainable Architecture Knowledge Base</div>
								<div class="title">Pylos</div>
							</div>
							<div class="col-sm-4">
								<div class="subtitle">List of strategies</div>
							</div>
						<!-- /Projects Row -->
					</div>
				</div>
				<div class="col-sm-1 vh-100 data">
				<!-- Data Column -->
					<div class="subtitle">Data</div>
					<div class="title">Now</div>
					<hr>
					<div class="subtitle">Weekend</div>

					<hr>
					<div class="subtitle">Snow</div>

					<hr>
					<div class="subtitle">Feed</div>
				<!-- /Data Column -->
				</div>
			</div>
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
