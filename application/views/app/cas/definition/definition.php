<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* 
 * Definition - Default View
 *
 * This is a view used by single definitions with the 'default' template set.
 * 
 */

	foreach (array('principles','fields','people','terms','concepts') as $a) {
		$is[$a] = false;
	}
	$attributes = $this->shared->get_attributes();
	if ($this->ion_auth->logged_in()) {
		$user = $this->ion_auth->user()->row(); 
		$d_ratings = $this->shared->get_ratings($user->id,'diagram','');
		$a_ratings = $this->shared->get_ratings($user->id,'diagram','attribute');
	}
	$diagrams = $this->shared->get_diagrams('diagram','definition',$id);
	$k = 1;
	foreach ($diagrams['sorted'] as $diagram) {
		if (isset($diagram['url'])) {
			$icon = $diagram;
			break;
		}
	} 
	$set = $this->shared->get_related($type,$id,true); 
?>
	<!-- Page map as a page nav in the top right corner -->
	<canvas id="pagemap" class="article"></canvas>
	<!-- /pagemap -->
	<!-- Header -->
	<header class="article-header container-fluid" style="background-image: url('<?php echo (isset($img['header']) && !empty($img['header'])) ? $img['header']['url']: '/includes/test/assets/Moofushi_Kandu_fish.jpg'; ?>');">
		<div class="row">
			<div class="col-sm-5 wrapper">
				<div class="subtitle">A blog on the built environment</div>
				<div class="title"><a href="/notes">&larr; Field Notes</a> <?php $this->load->view('helpers/menu-fieldnotes'); ?></div>
			</div>
			<div class="col-sm-7"></div>
		</div>
	</header>
	<!-- Header -->
	<!-- Article -->
	<article class="article-article">
		<div class="container-fluid">
			<header class="col-sm-10 col-lg-8">
				<div data-editable="" data-name="payload[title]">
					<h1><?php echo $title; ?></h1>
				</div>
			</header>
			<div class="row">
				<!-- Aside -->
				<div class="col-sm-5 col-md-4">
					<div class="hero-diagram">
						<img class="cas-def-diagram-preview" data-toggle="modal" data-target="#<?php echo (empty($diagrams['sorted'])) ? 'diagramnew':'diagramrate'; ?>" src="<?php echo (isset($icon['url'])) ? $icon['url']: '/upload/img/defdefault.png'; ?>" width="200px" height="200px" alt="Diagram: <?php echo $title; ?>" />
						<?php if ($this->ion_auth->logged_in()) { ?><div style="position: absolute; left: 140px; top: 49px; width: 75px;">
							<button type="button" class="btn btn-fail btn-sm" data-toggle="modal" data-target="#diagramnew"><span class="glyphicon glyphicon-plus" data-toggle="tooltip" title="Suggest new image/diagram" aria-hidden="true"></span></button>
							<button type="button" class="btn btn-fail btn-sm" data-toggle="modal" data-target="#diagramrate"><span class="glyphicon glyphicon-th-list" data-toggle="tooltip" title="Rate <?php echo lcfirst(str_replace('"',"'",$title)); ?> diagrams" aria-hidden="true"></span></button>
						</div><?php } ?>
					</div>
					<!-- Related -->
					<div class="row related">
						<?php // exclude the following for these taxonomy IDs
							$excludearray = array(
								'taxonomy' => array(),
								'definition' => array(),
							);
						?>
						<div class="">
							<span class="subnav-title">Explore</span>
						<?php // setup for the related dropdown module something
							$relatedsetup = array();
							if (!$this->shared->is_parent($type, $id, 'taxonomy', $settings['themes']['value'])) $relatedsetup['themes'] = array(
									$settings['themes']['value'],
									'taxonomy',
									'Related '.$settings['themes']['title'], 
									'This is a list of '.$settings['themes']['title'].' that '.$title.' is related to.');
							foreach ($relatedsetup as $__k => $__i) {
								$__type = 'taxonomy';
								$__list = $this->shared->get_related($__i[1],$__i[0]);
								if (!empty($__list)) { 
								$__host = $this->shared->get_data($__i[1],$__i[0]); ?>
							<p><strong><a href="/<?php echo $__host['type']; ?>/<?php echo $__host['slug']; ?>"><?php echo $__i[2]; ?></a></strong></p>
							<?php foreach ($__list as $__child) { 
								if ($this->shared->is_parent($type, $id, $__child['type'], $__child['id'])) { 
									$excludearray[$__child['type']][] = $__child['id']; 
									?><li><a href="/<?php echo $__child['type']; ?>/<?php echo $__child['slug']; ?>"><?php echo $__child['title']; ?></a></li><?php }} // end is_child and foreach ?>
						<?php }} ?>
						</div>
					</div>
					<!-- /Related -->
				</div>
				<!-- /Aside -->

				<div class="d-none d-md-block col-md"></div>
				<!-- Body -->
				<div class="col-sm-7 index">
					<div data-editable="" data-name="payload[excerpt]" class="excerpt">
						<p><?php echo $this->shared->handlebar_links($excerpt); ?></p>
					</div>
					<div class="body" data-editable="" data-name="payload[body]">
						<?php echo $this->shared->handlebar_links($body); ?>
					</div>
					<?php $this->shared->footer_photocitation($id,$img,$timestamp,$slug,$title); ?>

<!-- Feed -->
	<div class="input-group">
		<div class="input-group-prepend">
			<div class="input-group-text"><i class="fas fa-search"></i></div>
		</div>
		<input type="text" class="form-control" id="livesearch" placeholder="find a link...">
		<div class="input-group-append">
			<button class="btn btn-outline-secondary" type="button" data-toggle="modal" data-target="#createlink"><i class="fas fa-plus"></i> &nbsp; Add a link </button>
		</div>
	</div>
	<?php echo $this->shared->related_html($type,$id); ?>
<!-- /Feed -->

				</div>
				<!-- /Body -->
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
						<textarea type="text" class="form-control" placeholder="Subtitle" required="" autocomplete="off" name="payload[subtitle]"><?=$subtitle?></textarea>
						<label for="payload[excerpt]">Subtitle</label>
					</div>
					<div class="form-label-group">
						<select name="payload[template]" class="form-control">
							<?php foreach (get_filenames("./application/views/app/cas/definition") as $pagetemplate) { $pagetemplate = str_replace('.php', '', $pagetemplate); ?>
							<option value="<?php echo $pagetemplate; ?>"<?php if ($pagetemplate == $template) { ?> selected="selected"<?php } ?>><?php echo ucfirst($pagetemplate); ?></option>
							<?php } ?>
						</select>
						<label for="payload[template]">Page Template</label>
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
					<div class="form-label-group">
						<input type="date" class="form-control" placeholder="Date Posted" required="" autocomplete="off" name="payload[date]" value="<?=date('Y-m-d',$date)?>">
						<label for="payload[date]">Date Posted</label>
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

