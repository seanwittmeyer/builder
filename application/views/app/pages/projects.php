<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* 
 * Page - Projects Index
 *
 * This is a view used by single tax with the 'article' template set.
 * 
 */
 
$set = $this->shared->get_related($type,$id,true,true,array("order", "asc")); 
$excludearray = array(
	'taxonomy' => array(),
	'definition' => array(),
	'page' => array(),
);
?> 
<!-- Page map as a page nav in the top right corner -->
	<canvas id="pagemap-horiz" class="article"></canvas>
	<!-- /pagemap -->
<div class="wrapper horiz vh-100 flex-column" >		
	<!-- Header -->
	<header class="article-fieldnotes container-fluid" style="background-image: url('<?php echo (isset($img['header']) && !empty($img['header'])) ? $img['header']['url']: '/includes/test/assets/Moofushi_Kandu_fish.jpg'; ?>');">
		<div class="row">
			<div class="col-md d-none d-lg-block"></div>
			<div class="col-sm-5 sectionheader text-center">
				<div class="subtitle" data-editable="" data-name="payload[blogtype]"><p><?=$this->shared->handlebar_links($blogtype)?></p></div>
				<div data-editable="" data-name="payload[title]"><h1><?=$title?></h1></div><!-- (<?=$id?>)-->
				<div class="excerpt" data-editable="" data-name="payload[excerpt]"><p><?=$excerpt?></p></div>
			</div>
			<div class="col-md d-none d-lg-block"></div>
		</div>
	</header>
	<!-- /Header -->
	<!-- Article -->
	<article class="article-theme article-fieldnotes flex-1">
		<div class="container-fluid h-100">
			<div class="row h-100">
				<div class="col-md-3 text-right ">
					<aside class="col float-right">
						<p class="meta">Projects by Scale</p>
						<nav id="themenav" class="pilltabs">
							<ul class="nav nav-tabs" role="tablist">
								<?php /* Get related themes */
								$themes = $set; 
								array_multisort(array_map(function($element) {
									return $element['order'];
								}, $themes), SORT_ASC, $themes);
								
								foreach ($themes as $i) { ?> 
								<li class="nav-item d-block"><a class="nav-link" onclick="sortCards('<?=strtolower($i['title'])?>'); return false;" style="background-image: url(<?=$i['icon']?>)" href="/theme/<?=$i['slug']?>"><?=$i['title']?></a></li> 
								<?php } ?>
								<li onclick="sortCards('scale'); return false;" style="font-style: italic; font-size: .8rem; font-weight: 700; cursor: pointer; border: 1px solid white; padding: .7rem;">Show all projects &rarr;</li>
							</ul>
						</nav>
						<ul class="articlethemes">
						<?php /* Get related themes */
						$themes = $this->shared->get_related('taxonomy','34'); 
						$_themes = array(); 
						if (is_array($set) && !empty($set)) {
						foreach ($themes as $i) $_themes[] = $i['id'];
						foreach ($set as $s) if ($s['type']=='taxonomy' && in_array($s['id'],$_themes)) { ?>
								<li style="background-image: url(<?=$s['icon']?>);"><a class="" href="/theme/<?=$s['slug']?>"><?=$s['title']?></a></li>
						<?php } } ?> 
						</ul>
					</aside>
				</div>
				<div class="col-md-9 h-100">
					<div class="row" style="padding-top: 4px;">
						<p class="meta">Projects</p>
					</div>
					<div class="row children horiz h-100" style="padding-top: 0px;">
						<?php $set = $this->shared->get_data2('definition', false, array('template'=>'project')); ?>
						<?php if ($set !== false) : ?>
						<?php foreach ($set as $single) { ?>
							<div class="child-article col-md-3 <?=strtolower($single['subtitle'])?>" onclick="window.location.assign('/projects/<?=$single['slug']?>');">
								<a href="/projects/<?=$single['slug']?>" class="img" style="background-image: url(<?php $single['img'] = unserialize($single['img']); echo (isset($single['img']['header']) && !empty($single['img']['header'])) ? $single['img']['header']['url']: '/includes/test/assets/Moofushi_Kandu_fish.jpg'; ?>);"></a>
								<?php if (isset($single['blogtype'])) { ?><span class="subtitle"><?=$single['blogtype']?></span><?php } elseif (isset($single['subtitle'])) { ?><span class="subtitle"><?=$single['subtitle']?></span><?php } ?>
								<a class="title t_list_<?=$single['id']?>" href="/projects/<?=$single['slug']?>"><?=$single['title']?></a>
								<p><?php echo $single['excerpt']; ?> <br><a href="/projects/<?=$single['slug']?>"> Keep reading... &rarr;</a></p>
							</div>
						<?php } ?> 
						<?php elseif ($this->ion_auth->is_admin()): ?><blockquote>No connected topics...yet.<br /><button class="btn btn-success" data-toggle="modal" data-target="#pageeditor">Add Relationships</button></blockquote><?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	</article>
	<!-- /Article -->
</div>
<script>

function sortCards(a) {
	$('.children .child-article').fadeOut(200);
	var _a = '.children .child-article.' + a; 
	setTimeout($(_a).fadeIn(200),200);
}
<?php 
$_section = $this->input->get('scale');
if ($_section) { ?>
$(document).ready(function(){
	$('.children .child-article').fadeOut(200);
	setTimeout($('.children .child-article.<?=$_section?>').fadeIn(200),200);
});
<?php } ?>
const target = document.querySelector('.children.horiz')
const targetparent = document.querySelector('body')

targetparent.addEventListener('wheel', event => {
  const toLeft  = event.deltaY < 0 && target.scrollLeft > 0
  const toRight = event.deltaY > 0 && target.scrollLeft < target.scrollWidth - target.clientWidth

  if (toLeft || toRight) {
    event.preventDefault()
    target.scrollLeft += event.deltaY
  }
})
</script>
	
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
							<textarea type="text" class="form-control" placeholder="Subtitle" required="" autocomplete="off" name="payload[blogtype]"><?=$blogtype?></textarea>
							<label for="payload[blogtype]">Subtitle</label>
						</div>
						<div class="form-label-group">
							<select name="payload[template]" class="form-control">
								<?php foreach (get_filenames("./application/views/app/pages") as $pagetemplate) { $pagetemplate = str_replace('.php', '', $pagetemplate); ?>
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
						<p>Excerpt Content</p>
						<div class=""><textarea type="text" class="cas-summernote" id="cas-def-excerpt" name="payload[excerpt]"><?php echo $excerpt; ?></textarea></div>
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


	<div class="modal fade" id="createlink" tabindex="-1" role="dialog" aria-labelledby="createlink" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Add a Link</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				</div>
				<div class="modal-body">
					<form id="formlink" >
					<div class="form-group">
						<label for="payload[title]" class="">Link URI <i>start here... <span class="glyphicon glyphicon-question-sign" aria-hidden="true" data-toggle="popover" data-trigger="hover" title="Creating Links"  data-content="Start by entering the URL for the website or element you want to embed/add to this page. When you are done, click go and we will get details which you can edit."> </i> </em></label>
						<div class="input-group">
							<input type="text" class="form-control" id="cas-link-uri" name="payload[uri]" placeholder="http://youtube.com/watch?v=123abc456"><span class="input-group-btn"><a id="cas-link-embed-trigger" class="btn btn-default">Go!</a></span>
						</div>
					</div>
					<div class="form-group">
						<label class="">Preview</label>
						<a id="cas-link-embed-preview"></a>
					</div>
					<div class="form-group">
						<label for="payload[title]" class="">Title</label>
						<div class=""><input type="text" class="form-control" id="cas-link-title" name="payload[title]" placeholder="Non Linearity"></div>
					</div>
					<div class="form-group">
						<label for="payload[excerpt]" class="">Excerpt</label>
						<div class=""><textarea type="text" class="form-control" id="cas-link-excerpt" name="payload[excerpt]" placeholder="This should be a brief definition in a sentence or two..."></textarea></div>
					</div>
					<div class="form-group">
						<label for="payload[type]" class="">Link Type</label>
						<div class="">
							<select id="cas-link-type" name="payload[type]" class="form-control">
								<option selected="selected" disabled="disabled">Select a type...</option>
								<option value="html" selected="selected">Webpage</option>
								<option value="video">Video</option>
								<option value="file">File</option>
								<option value="paper">Paper</option>
								<option value="book">Book</option>
								<option value="profile">Profile</option>
								<option value="other">Other</option>
							</select>
						</div>
					</div>
					<input type="hidden" id="cas-link-hostid" name="payload[hosttype]" value="<?=$type?>" />
					<input type="hidden" id="cas-link-hosttype" name="payload[hostid]" value="<?=$id?>" />
				</div><!-- /modal body -->
				<div class="modal-footer">
					<div id="linkfail" class="alert alert-danger " style="display: none;" role="alert">Uh oh, the link didn't save, make sure everything above is filled and try again.</div>
					<div id="linksuccess" class="alert alert-success " style="display: none;" role="alert">Great success, content posted.</div>
					<div id="linkloading" class="alert alert-info progress-bar progress-bar-striped active" style="display: block; width: 100%; display: none;" role="alert">dancing...</div>
					<div id="linkbuttons">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						<button type="reset" class="btn btn-default" >Reset</button>
						<button type="button" class="btn btn-primary tt" id="submitlink" data-toggle="tooltip" title="This is ">Add Link!</button>
					</div>
				</div>
				</form>
			</div>
		</div>
	</div>

	<?php if ($this->ion_auth->logged_in() && isset($loadjs['contenttools'])) { 
		$this->load->view("helpers/contenttools");
		$this->load->view("helpers/editor-scripts");
	} ?> 
	<script>
		//pagemap(document.querySelector('#pagemap'));
		pagemap(document.querySelector('#pagemap-horiz'), {
			viewport: document.querySelector('.children'),
			styles: {
				'.title,nav,p,.card': 'rgba(0,0,0,0.08)',
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
