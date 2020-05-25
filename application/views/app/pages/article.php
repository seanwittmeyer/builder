	<!-- Page map as a page nav in the top right corner -->
	<canvas id="pagemap" class="article"></canvas>
	<!-- /pagemap -->
	<!-- Header -->
	<header class="article-header container-fluid" style="background-image: url('<?php echo (isset($img['header']) && !empty($img['header'])) ? $img['header']['url']: '/includes/test/assets/Moofushi_Kandu_fish.jpg'; ?>');">
		<div class="row">
			<div class="col-sm-5 wrapper">
				<div class="subtitle">A blog on the built environment</div>
				<div class="title">&larr; Field Notes &dtrif;</div>
			</div>
			<div class="col-sm-7"></div>
		</div>
	</header>
	<!-- Header -->
	<!-- Article -->
	<article class="article-article">
		<div class="container-fluid">
			<div class="row text-center">
				<div class="d-none d-sm-block col-sm"></div>
				<header class="col-sm-10 col-lg-6">
					<div class="subtitle" data-editable="" data-name="payload[blogtype]"><p><?=$blogtype?></p></div>
					<div data-editable="" data-name="payload[title]"><h1><?=$title?></h1></div><!-- (<?=$id?>)-->
					<div class="excerpt" data-editable="" data-name="payload[excerpt]"><p><?=$this->shared->handlebar_links($excerpt)?></p></div>
				</header>
				<div class="d-none d-sm-block col-sm"></div>
			</div>
			<div class="row">
				<div class="col-md d-none d-lg-block"></div>
				<div class="col-md-5 col-lg-4 text-right">
					<p class="">This article was published <?php echo $this->shared->twitterdate($timestamp, true); ?> by <?php echo $author; ?>.</p>
				</div>
				<div class="col-md-7 col-lg-6">
					<div class="body" data-editable="" data-name="payload[body]">
						<?php echo $this->shared->handlebar_links($body); ?></p>
					</div>
					<?php $this->cas->footer_photocitation($id,$img,$timestamp,$slug,$title); ?>
				</div>
				<div class="col-md d-none d-lg-block"></div>
			</div>
		</div>
	</article>
	<!-- /Article -->

	
	<!-- /Page editor -->
	<div class="modal fade" id="pageeditor" tabindex="-1" role="dialog" aria-labelledby="pageeditor" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">Edit <?php echo $title; ?></h4>
					<p>Fill in all boxes here, each piece of information has a role in making pages, links, and visualizations in the site work well.</p>
				</div>
				<form id="formeditor" >
				<div class="modal-body">
					<div class="form-group">
						<label for="payload[title]" class="">Title</label>
						<div class=""><input type="text" class="form-control" id="cas-page-title" name="payload[title]" value="<?php echo $title; ?>"></div>
					</div>
					<div class="form-group">
						<label for="payload[excerpt]" class="">Excerpt</label>
						<div class=""><textarea type="text" class="form-control" id="cas-page-excerpt" name="payload[excerpt]"><?php echo $excerpt; ?></textarea></div>
					</div>
					<div class="form-group">
						<label for="payload[author]" class="">Author</label>
						<div class=""><input type="text" class="form-control" id="cas-page-author" name="payload[author]" <?php if (empty($author)) { ?>placeholder="Bill Nye the Science Guy" <?php } else { ?>value="<?php echo $author; ?>"<?php } ?>></div>
					</div>
					<div class="form-group">
						<label for="payload[template]" class="">Template <span class="glyphicon glyphicon-question-sign" aria-hidden="true" data-toggle="popover" data-trigger="hover" title="Page Templates"  data-content="Select the template to use for this page. By changing this, you may lose some settings when you save the page."> </i></label>
						<div class="">
							<select id="cas-page-template" name="payload[template]" class="form-control">
								<?php foreach (get_filenames("./application/views/app/pages") as $pagetemplate) { $pagetemplate = str_replace('.php', '', $pagetemplate); ?>
								<option value="<?php echo $pagetemplate; ?>"<?php if ($pagetemplate == $template) { ?> selected="selected"<?php } ?>><?php echo ucfirst($pagetemplate); ?></option>
								<?php } ?>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label for="payload[body]" class="">Body</label>
						<!--<div class="cas-summernote">Hello Summernote</div>-->
						<div class=""><textarea type="text" class="cas-summernote" id="cas-def-body" name="payload[body]"><?php echo $body; ?></textarea></div>
					</div>
					<h4>Metadata</h4>
					<p>The richness of the site comes in its content relationships and connections. Select relationships this definition has with other content in the website.</p>
					<div class="panel panel-default">
						<div class="panel-body">
							<div class="form-group">
								<label class="col-sm-2 control-label" style="padding-top: 16px;">Definitions</label>
								<div class="col-sm-10">
									<select name="payload[relationships][definition][]" class="selectpicker btn-sm" data-width="100%" data-live-search="true" data-size="5" multiple data-selected-text-format="count > 4">
									<?php // List definitions
										$list = $this->shared->list_bytype('definition'); $relationships = array(); foreach ($set as $ss) $relationships[] = $ss['id'];
										if ($list === false) { echo '<option disabled>No definitions to display.</option>'; } else {
										foreach ($list as $a) { $selected = (in_array($a['id'],$relationships)) ? ' selected' : ''; echo '<option value="'.$a['id'].'"'.$selected.'>'.$a['title']."</option>\n"; }} ?> 
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label" style="padding-top: 16px;">Taxonomy</label>
								<div class="col-sm-10">
									<select name="payload[relationships][taxonomy][]" class="selectpicker btn-sm" data-width="100%" data-live-search="true" data-size="5" multiple data-selected-text-format="count > 4">
									<?php // List taxonomy
										$list = $this->shared->list_bytype('taxonomy');
										if ($list === false) { echo '<option disabled>No taxonomy to display.</option>'; } else {
										foreach ($list as $a) { $selected = (in_array($a['id'],$relationships)) ? ' selected' : ''; echo '<option value="'.$a['id'].'"'.$selected.'>'.$a['title']."</option>\n"; }} ?> 
									</select>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<div id="editorfail" class="alert alert-danger " style="display: none;" role="alert">Uh oh, the <?php echo $type; ?> didn't save, make sure everything above is filled and try again.</div>
					<div id="editorsuccess" class="alert alert-success " style="display: none;" role="alert">Great success, content posted.</div>
					<div id="editorloading" class="alert alert-info progress-bar progress-bar-striped active" style="display: block; width: 100%; display: none;" role="alert">working...</div>
					<div id="editorbuttons">
						<a class="btn btn-danger pull-left" href="/api/remove/page/<?php echo $id; ?>/home" data-toggle="tooltip" data-title="Are you sure? No undo...">Delete this Page</a>
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						<button type="reset" class="btn btn-default" >Reset</button>
						<button type="button" class="btn btn-primary tt" id="submiteditor">Save changes</button>
					</div>
				</div>
				</form>
			</div>
		</div>
	</div>
	<!-- /Page Editor -->
	<!-- Header Image File Uploader -->
	<div class="modal fade" id="pageupload" tabindex="-1" role="dialog" aria-labelledby="pageupload" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">Edit <?php echo $title; ?></h4>
					<p>Fill in all boxes here, each piece of information has a role in making pages, links, and visualizations in the site work well.</p>
				</div>
				<form id="formupload" enctype="multipart/form-data">
				<div class="modal-body">
					<div class="form-group">
						<label for="upload" class="">Header Image</label>
						<div class=""><input type="file" id="cas-tax-file" name="userfile" value=""></div>
						<input type="hidden" id="cas-tax-fileurl" name="payload[img][header][url]" value="<?php echo (isset($img['header']) && !empty($img['header'])) ? $img['header']['url']: ''; ?>">
					</div>
					<div class="form-group">
						<label for="payload[title]" class="">Caption</label>
						<p style="font-size: .7em;"><strong>Example:</strong> Underwater image of fish in Moofushi Kandu, Maldives, by Bruno de Giusti (via Wikimedia Commons)</p>
						<div class=""><input type="text" class="form-control" id="cas-img-title" name="payload[img][header][caption]" value="<?php echo (isset($img['header']['caption'])) ? $img['header']['caption']: $title; ?>"></div>
					</div>
				</div>
				<div class="modal-footer">
					<div id="uploadfail" class="alert alert-danger " style="display: none;" role="alert">Uh oh, the <?php echo $type; ?> didn't save, make sure everything above is filled and try again.</div>
					<div id="uploadsuccess" class="alert alert-success " style="display: none;" role="alert">Great success, content posted.</div>
					<div id="uploadloading" class="alert alert-info progress-bar progress-bar-striped active" style="display: block; width: 100%; display: none;" role="alert">working...</div>
					<div id="uploadbuttons">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						<button type="reset" class="btn btn-default" >Reset</button>
						<button type="button" class="btn btn-primary tt" id="submitupload">Save changes</button>
					</div>
				</div>
				</form>
			</div>
		</div>
	</div>
	<!-- /File Uploader -->




	<?php if ($this->ion_auth->logged_in() && isset($loadjs['contenttools'])) { 
		$this->load->view("helpers/contenttools");
		$this->load->view("helpers/editcontent");
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
