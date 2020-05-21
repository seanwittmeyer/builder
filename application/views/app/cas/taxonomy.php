<?php // setup for the related dropdown module something
	$relatedprinciples = array(
			$settings['principles']['value'],
			'taxonomy',
			'Related '.$settings['principles']['title'], 
			'This is a list of '.$settings['principles']['title'].' that '.$title.' is related to.');
	$p__type = 'taxonomy';
	$p__list = $this->shared->get_related($relatedprinciples[1],$relatedprinciples[0]);
	if (!empty($p__list)) { 
	$p__host = $this->shared->get_data($relatedprinciples[1],$relatedprinciples[0]);  ?>

<code>
<?php 
$all = array();
$all = get_defined_vars();
//foreach ($all as $a) print_r($a); 
//die;
print(json_encode($all));// (get_defined_vars()); 
die;
?>
</code>

	<!-- Nav --> 
	<div class="principle-container-nav hide">
		<!-- Nav tabs -->
		<span class="app-section-title"><a href="/taxonomy/<?php echo $settings['principles']['title']; ?>" aria-controls="principle-home" role="tab" data-toggle="tab"><?php echo $settings['principles']['title']; ?></a></span>
		<ul class="nav app-section-nav" role="tablist">
			<!--<li role="presentation" class="active"><a href="#principle-home" aria-controls="principle-home" role="tab" data-toggle="tab">Home</a></li>-->
			<?php foreach ($cartograph['principles']['children'] as $d) { 
				// Prep titles and acronyms
					$thispage = ($d['type'] == $type && $d['id'] == $id) ? true : false; ?> 
			<li role="presentation" class="<?php if ($thispage || $this->shared->is_parent($d['type'], $d['id'], $type, $id)) echo 'active'; ?>"><a href="/<?php echo "{$d['type']}/{$d['slug']}"; ?>" style="background-image: url('<?php echo (isset($d['img']['header']) && !empty($d['img']['header'])) ? $d['img']['header']['url']: '/includes/test/assets/Moofushi_Kandu_fish.jpg'; ?>');" ><?php echo $d['title']; ?></a></li>
			<?php } ?> 
		</ul>
		<div class="clear"></div>
	</div>
	<?php } ?>

	<div class="principle-wrapper">
	<!-- Hero Background -->
		<div class="container-fluid build-wrapper home-hero">
			<div id="imgheader" class="hero-wrapper" style="background-image: url(<?php echo (isset($img['header']) && !empty($img['header'])) ? $img['header']['url']: '/includes/test/assets/Moofushi_Kandu_fish.jpg'; ?>);">
				<div class="hero"></div>
			</div>
		</div>
		<!-- /background -->
		<!-- Content Wrapper -->
		<div class="container-fluid build-wrapper top-nospace">
			<!-- Hero -->
			<div class="row">
				<!-- Hero Title  -->
				<div class="col-lg-7 col-md-9 hero-heading">
					<?php 
						if ($this->shared->is_parent($type, $id, 'taxonomy', $settings['principles']['value'])) { ?><a class="subnav-heading" href="/taxonomy/<?php echo $this->shared->get_data('taxonomy',$settings['principles']['value'])['slug']; ?>"><?php echo $settings['principles']['title']; ?></a><?php } 
						elseif ($this->shared->is_parent($type, $id, 'taxonomy', $settings['fields']['value'])) { ?><a class="subnav-heading" href="/taxonomy/<?php echo $this->shared->get_data('taxonomy',$settings['fields']['value'])['slug']; ?>"><?php echo $settings['fields']['title']; ?></a><?php } 
						elseif ($this->shared->is_parent($type, $id, 'taxonomy', $settings['concepts']['value'])) { ?><a class="subnav-heading" href="/taxonomy/<?php echo $this->shared->get_data('taxonomy',$settings['concepts']['value'])['slug']; ?>"><?php echo $settings['concepts']['title']; ?></a><?php } 
						?>
					<div data-editable="" data-name="payload[title]">
						<h1><?php echo $title; ?></h1>
					</div>
					<div data-editable="" data-name="payload[subtitle]">
						<h2><?php echo $this->shared->handlebar_links($subtitle); ?></h2>
					</div>
				</div>
				<!-- /title -->
				<!-- Hero Next -->
				<div class="col-lg-offset-2 col-lg-3 hero-heading hero-related hide">
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
							if (!$this->shared->is_parent($type, $id, 'taxonomy', $settings['concepts']['value'])) $relatedsetup['concepts'] = array(
									$settings['concepts']['value'],
									'taxonomy',
									'Related '.$settings['concepts']['title'], 
									'This is a list of '.$settings['concepts']['title'].' that '.$title.' is related to.');
							if (!$this->shared->is_parent($type, $id, 'taxonomy', $settings['principles']['value'])) $relatedsetup['principles'] = array(
									$settings['principles']['value'],
									'taxonomy',
									'Related '.$settings['principles']['title'], 
									'This is a list of '.$settings['principles']['title'].' that '.$title.' is related to.');
							if (!$this->shared->is_parent($type, $id, 'taxonomy', $settings['fields']['value'])) $relatedsetup['fields'] = array(
									$settings['fields']['value'],
									'taxonomy',
									'Related '.$settings['fields']['title'], 
									'This is a list of '.$settings['fields']['title'].' that '.$title.' is related to.');
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
					<!-- /related -->

				</div>
			</div>
			<!-- /Hero -->
			<!-- Content -->
			<div class="row" style="margin: 0;">
				<!-- Left -->
				<div class="col-lg-7 col-md-9">
					<!-- Body -->
					<div class="topno-space bodytext">
						<?php if (isset($excerpt) && !empty($excerpt)) { ?> 
						<div data-editable="" data-name="payload[excerpt]">
							<p><?php echo $this->shared->handlebar_links($excerpt); ?></p>
						</div><?php } ?> 
						<div>
							<a href="#fulltext" onclick="$('#fulltext').toggle('100'); $(this).hide(); return false;" style="display: block; padding-bottom: 40px;">Keep reading →</a>
						</div>
						<div id="fulltext" style="display: none;">
							<hr />
							<div data-editable="" data-name="payload[body]"><?php echo $this->shared->handlebar_links($body); ?></div>
							<p>&nbsp;</p>
						</div>
						
					</div>
					<!-- /body -->
					<!-- Footer cards -->
					<?php if (isset($payload['footer']) && in_array('cards', $payload['footer'])) : ?>
					<div class="row footer-cards" style="padding-top: 00px;">
						<?php $set = $this->shared->get_related($type,$id,true);
							if ($set !== false) :
								$n=0;
								foreach ($set as $single) { 
									if (in_array($single['id'], $excludearray[$single['type']])) continue; 
									if (isset($single['img']) && !empty($single['img'])) $single['img'] = unserialize($single['img']); 
									if ($n % 3 == 0) echo '<div class="clear hidden-sm"></div>';
									if ($n % 2 == 0) echo '<div class="clear visible-sm"></div>'; ?>
						<div class="col-sm-6 col-md-4">
							<div class="well">
								<?php if ($single['type'] == 'definition') { 
									$single['diagrams'] = $this->shared->get_diagrams('diagram','definition',$single['id']);
									foreach ($single['diagrams']['sorted'] as $diagram) {
										if (isset($diagram['url'])) { $icon = $diagram; break; }
									} ?>
								<a href="/<?php echo $single['type']; ?>/<?php echo $single['slug']; ?>"><div class="cards-diagram"><img class="cas-def-diagram-preview" src="<?php echo (isset($icon['url'])) ? $icon['url']: '/upload/img/defdefault.png'; ?>" alt="Diagram: <?php echo $single['title']; ?>" /></div></a>
								<?php unset($icon); } else { ?> 
								<a href="/<?php echo $single['type']; ?>/<?php echo $single['slug']; ?>"><div class="cardimagepreview" style="background-image: url(<?php echo (isset($single['img']['header']) && !empty($single['img']['header'])) ? $single['img']['header']['url']: '/includes/test/assets/Moofushi_Kandu_fish.jpg'; ?>);"></div></a>
								<?php } ?>
								<span class="subnav-title"><a class="t_list_<?php echo $single['id']; ?>" href="/<?php echo $single['type']; ?>/<?php echo $single['slug']; ?>"><?php echo $single['title']; ?></a></span>
								<p><?php echo $single['subtitle']; ?> </p>
								<p><a href="/<?php echo $single['type']; ?>/<?php echo $single['slug']; ?>">Learn More &rarr;</a></p>
							</div>
						</div>
						<?php $n++; } ?> 
						<?php elseif ($this->ion_auth->is_admin()): ?><blockquote>No connected topics...yet.<br /><button class="btn btn-success" data-toggle="modal" data-target="#pageeditor">Add Relationships</button></blockquote><?php endif; ?>
					</div>
					<?php endif; ?>
					<!-- /Footer List -->
					<!-- Footer parentchild -->
					<?php if (isset($payload['footer']) && in_array('parentchild', $payload['footer'])) : ?>
					<hr>
					<div class="row">
						<div class="col-md-6">
							<h4><strong>Children</strong></h4>
							<p>Explore <?php echo $title; ?> further in the topics and collections below.</p>
							<?php $set = $this->shared->get_related($type,$id,true); ?>
							<?php if ($set !== false) : ?>
							<?php foreach ($set as $single) { 
								if (in_array($single['id'], $excludearray[$single['type']])) continue; ?>
								<h4><a class="t_list_<?php echo $single['id']; ?>" href="/<?php echo $single['type']; ?>/<?php echo $single['slug']; ?>"><?php echo $single['title']; ?></a></h4>
								<!--<p><?php echo $single['excerpt']; ?> <a href="/<?php echo $single['type']; ?>/<?php echo $single['slug']; ?>">Learn More about <?php echo $single['title']; ?> &rarr;</a></p>-->
							<?php } ?> 
							<?php elseif ($this->ion_auth->is_admin()): ?><blockquote>No connected topics...yet.<br /><button class="btn btn-success" data-toggle="modal" data-target="#pageeditor">Add Relationships</button></blockquote><?php endif; ?>
						</div>
						<div class="col-md-6">
							<h4><strong>Parents</strong></h4>
							<p><?php echo $title; ?> is part of the following collections.</p>
							<?php $set = $this->shared->get_related_parents($type,$id,true); ?>
							<?php /* */ ?>
							<?php if ($set !== false) : ?>
							<?php foreach ($set as $single) { 
								if (!isset($single['id'])) continue; 
								if (in_array($single['id'], $excludearray[$single['type']])) continue; ?>
								<h4><a class="t_list_<?php echo $single['id']; ?>" href="/<?php echo $single['type']; ?>/<?php echo $single['slug']; ?>"><?php echo $single['title']; ?></a></h4>
								<!--<p><?php echo $single['excerpt']; ?> <a href="/<?php echo $single['type']; ?>/<?php echo $single['slug']; ?>">Learn More about <?php echo $single['title']; ?> &rarr;</a></p>-->
							<?php } ?> 
							<?php elseif ($this->ion_auth->is_admin()): ?><blockquote>No connected topics...yet.<br /><button class="btn btn-success" data-toggle="modal" data-target="#pageeditor">Add Relationships</button></blockquote><?php endif; ?>
							<?php /**/ ?>
						</div>
					</div>
					<?php endif; ?>
					<!-- /Footer List -->
					<?php $this->cas->footer_photocitation($id,$img,$timestamp,$slug,$title); ?>
					<!-- Related -->
					<div class="row related hide">
						<?php // exclude the following for these taxonomy IDs
							$excludearray = array(
								'taxonomy' => array(),
								'definition' => array(),
							);
						?>
						<div class="col-sm-12">
							<span class="subnav-title">Applying <?php echo $title; ?></span>
						</div>
						<?php // setup for the related dropdown module 
							$relatedsetup = array(
								'concepts' => array(
									$settings['concepts']['value'],
									'taxonomy',
									'Related '.$settings['concepts']['title'], 
									'This is a list of '.$settings['concepts']['title'].' that '.$title.' is related to.'),
								'principles' => array(
									$settings['principles']['value'],
									'taxonomy',
									'Related '.$settings['principles']['title'], 
									'This is a list of '.$settings['principles']['title'].' that '.$title.' is related to.'),
								'fields' => array(
									$settings['fields']['value'],
									'taxonomy',
									'Related '.$settings['fields']['title'], 
									'This is a list of '.$settings['fields']['title'].' that '.$title.' is related to.'),
							);
							foreach ($relatedsetup as $__k => $__i) {
								$__type = 'taxonomy';
								$__list = $this->shared->get_related($__i[1],$__i[0]);
								if (!empty($__list)) { 
								$__host = $this->shared->get_data($__i[1],$__i[0]);
						?><div class="col-md-5">
							<p><strong><?php echo $__i[2]; ?></strong></p>
							<p><?php echo $__i[3]; ?></p>
							<?php foreach ($__list as $__child) { if ($this->shared->is_parent($type, $id, $__child['type'], $__child['id'])) { $excludearray[$__child['type']][] = $__child['id']; ?><li><a href="/<?php echo $__child['type']; ?>/<?php echo $__child['slug']; ?>"><?php echo $__child['title']; ?></a></li><?php }} // end is_child and foreach ?><li><a href="/<?php echo $__host['type']; ?>/<?php echo $__host['slug']; ?>">See all <em><?php echo $__host['title']; ?></em> &rarr;</a></li>
						</div><?php }} ?>
					</div>
					<!-- /related -->
				</div>
				<!-- /left -->
				<!-- Right -->
				<div class="col-lg-5 col-md-9">
					<!-- Dive in Tabs -->
					<div class="feed">
						<span class="subnav-title">Dive In</span>
						<div class="divein">
						
							<!-- Nav tabs -->
							<ul class="nav nav-tabs" role="tablist">
								<li role="presentation" class="active"><a href="#feed" aria-controls="home" role="tab" data-toggle="tab">Feed</a></li>
								<!--
								<li role="presentation"><a href="#people" aria-controls="profile" role="tab" data-toggle="tab">People</a></li>
								<li role="presentation"><a href="#terms" aria-controls="messages" role="tab" data-toggle="tab">Terms</a></li>
								<li role="presentation"><a href="#thoughts" aria-controls="settings" role="tab" data-toggle="tab">Thought Experiments</a></li>
								-->
							</ul>
							
							<!-- Tab panes -->
							<div class="tab-content">
								<div role="tabpanel" class="tab-pane fade in active" id="feed">
									<p>This is the feed, a series of related links and resources. <a data-toggle="modal" data-target="#createlink">Add a link to the feed →</a></p>
									<?php echo $this->cas->related_html($type,$id); ?>
								</div>
							</div>
						
						</div>
	    			</div>
	    		</div>
	
			</div>
			<!-- /content -->
		</div>
	</div>	
	
	
	<!-- /Panels -->
	<div class="modal fade" id="pageeditor" tabindex="-1" role="dialog" aria-labelledby="pageeditor" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">Edit <?php echo $title; ?></h4>
					<p>Fill in all boxes here, each piece of information has a role in making pages, links, and visualizations in the site work well.</p>
				</div>
				<form id="formeditor" >
				<div class="modal-body">
					<div class="form-group">
						<label for="payload[title]" class="">Title</label>
						<div class=""><input type="text" class="form-control" id="cas-def-title" name="payload[title]" value="<?php echo $title; ?>"></div>
					</div>
					<div class="form-group">
						<label for="payload[subtitle]" class="">Subtitle - Single sentence description</label>
						<div class=""><textarea class="form-control" id="cas-def-edit-subtitle" name="payload[subtitle]"><?php echo $subtitle; ?></textarea></div>
					</div>
					
					<div class="form-group">
						<label for="payload[excerpt]" class="">Excerpt</label>
						<div class=""><textarea class="form-control" id="cas-def-excerpt" name="payload[excerpt]"><?php echo $excerpt; ?></textarea></div>
					</div>
					
					<div class="form-group">
						<label for="payload[body]" class="">Body</label>
						<p class="small"><span class="glyphicon glyphicon-exclamation-sign" style="color:red;" aria-hidden="true"></span> This has issues when copying-and-pasting from websites and Microsoft Word. It is best if you write the content here in this text-box.<br>Make links by using {{handlebars}} in your text!</p>
						<!--<div class="cas-summernote">Hello Summernote</div>-->
						<div class=""><textarea class="cas-summernote" id="cas-def-body" name="payload[body]"><?php echo $body; ?></textarea></div>
					</div>
					<h4><strong>Children</strong> of <?php echo $title; ?></h4>
					<?php $set = $this->shared->get_related($type,$id,true); ?>
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
					<h4>Footer Content</h4>
					<p>Choose which blocks you want at the bottom of this page.</p>
					<div class="panel panel-default">
						<div class="panel-body">
							<div class="form-group">
								<label class="col-sm-2 control-label" style="padding-top: 16px;">Blocks</label>
								<div class="col-sm-10">
									<select name="payload[payload][footer][]" class="selectpicker btn-sm dropup" data-width="100%" data-live-search="true" data-size="5" multiple data-selected-text-format="count > 4">
										<option value="cards"<?php if (isset($payload['footer']) && in_array('cards', $payload['footer'])) echo ' selected'; ?> >Grid of Cards</option>
										<option value="attgrid"<?php if (isset($payload['footer']) && in_array('attgrid', $payload['footer'])) echo ' selected'; ?> >Attribute Grid</option>
										<option value="excerpts"<?php if (isset($payload['footer']) && in_array('excerpts', $payload['footer'])) echo ' selected'; ?> >List with Excerpts</option>
										<option value="networkdiagram"<?php if (isset($payload['footer']) && in_array('networkdiagram', $payload['footer'])) echo ' selected'; ?>>Network Diagram</option>
										<option value="parentchild"<?php if (isset($payload['footer']) && in_array('parentchild', $payload['footer'])) echo ' selected'; ?> >Parents/Children</option>
										<option value="list"<?php if (isset($payload['footer']) && in_array('list', $payload['footer'])) echo ' selected'; ?> >Simple List</option>
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
						<a class="btn btn-danger pull-left" href="/api/remove/taxonomy/<?php echo $id; ?>/home" data-toggle="tooltip" data-title="Are you sure? No undo...">Delete this Page</a>
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
	<script>
		$('#pageeditor').on('shown.bs.modal', function () {
			$('.cas-summernote').summernote({
			  toolbar: [
			    // [groupName, [list of button]]
			    ['style', ['style']],
			    ['simple', ['bold', 'italic', 'underline', 'clear']],
			    ['para', ['ul', 'ol', 'paragraph']],
			    ['link', ['linkDialogShow']],
			    ['code', ['codeview']],
			    ['fullscreen', ['fullscreen']],
			    
			  ],
			});
			$('.note-editable.panel-body').attr("spellcheck","true");
		})


		$('#pageupload').on('shown.bs.modal', function () {
		    $("#cas-tax-file").fileinput({
		        uploadAsync: false,
				url: "/api/uploadimage", // remove X or it wont work...
		        uploadExtraData: function() {
		            return {
		                id: '<?php echo $id; ?>',
		                type: 'taxonomy'
		            };
		        }
		    });
		});

		$('#cas-tax-file').fileinput({
		    uploadUrl: "/api/uploadimage", // server upload action
		    uploadAsync: true,
		    showUpload: false, // hide upload button
		    showRemove: false, // hide remove button
		    minFileCount: 1,
		    maxFileCount: 1
		}).on("filebatchselected", function(event, files) {
		    // trigger upload method immediately after files are selected
		    $('#cas-tax-file').fileinput("upload");
		}).on('fileuploaded', function(event, data, previewId, index) {
		    var form = data.form, files = data.files, extra = data.extra,
		        response = data.response, reader = data.reader;
		    console.log(response.filename + ' has been uploaded');
		    $('#imgheader').css('background-image','url('+response.filename+')');
		    $('#cas-tax-fileurl').val(response.filename);
		});


		$('#submiteditor').click(function() {
			$.ajax({
				type: "POST",
				beforeSend: function() {
					$('#editorbuttons').hide(); 
					$('#editorfail').hide(); 
					$('#editorloading').show();
				},
				url: "/api/update/taxonomy/<?php echo $id; ?>",
				data: $("#formeditor").serialize(),
				statusCode: {
					200: function(data) {
						$('#editorloading').hide(); 
						$('#editorsuccess').show();
						var response = JSON.parse(data); 
						$('#editorbuttons').show(); 
						//alert('updated 202');
						window.location.reload();
					},
					403: function(data) {
						//var response = JSON.parse(data);
						$('#editorloading').hide(); 
						$('#editorfail').show();
						$('#editorbuttons').show(); 
					},
					404: function(data) {
						//var response = JSON.parse(data);
						$('#editorloading').hide(); 
						$('#editorfail').show();
						$('#editorbuttons').show(); 
					}
				}
			});
		});
		$('#submitupload').click(function() {
			$.ajax({
				type: "POST",
				beforeSend: function() {
					$('#uploadbuttons').hide(); 
					$('#uploadfail').hide(); 
					$('#uploadloading').show();
				},
				url: "/api/update/taxonomy/<?php echo $id; ?>/header", 
				data: $("#formupload").serialize(),
				statusCode: {
					200: function(data) {
						$('#uploadloading').hide(); 
						$('#uploadsuccess').show();
						var response = JSON.parse(data); 
						$('#uploadbuttons').show(); 
						window.location.reload();
					},
					403: function(data) {
						//var response = JSON.parse(data);
						$('#uploadloading').hide(); 
						$('#uploadfail').show();
						$('#uploadbuttons').show(); 
					},
					404: function(data) {
						//var response = JSON.parse(data);
						$('#uploadloading').hide(); 
						$('#uploadfail').show();
						$('#uploadbuttons').show(); 
					}
				}
			});
		});

	</script>
	<!-- Javascript -->
	<?php if ($this->ion_auth->logged_in() && isset($loadjs['contenttools'])) { ?> 
	<script src='/includes/js/content-tools.js'></script>
	<script>
	/* Content Tools Image Save */
	function imageUploader(dialog) {
	     var image, xhr, xhrComplete, xhrProgress;
	
	    // Set up the event handlers
	    dialog.addEventListener('imageuploader.cancelupload', function () {
	        // Cancel the current upload
	
	        // Stop the upload
	        if (xhr) {
	            xhr.upload.removeEventListener('progress', xhrProgress);
	            xhr.removeEventListener('readystatechange', xhrComplete);
	            xhr.abort();
	        }
	
	        // Set the dialog to empty
	        dialog.state('empty');
	    });
	    dialog.addEventListener('imageuploader.clear', function () {
	        // Clear the current image
	        dialog.clear();
	        image = null;
	    });
	
	    dialog.addEventListener('imageuploader.fileready', function (ev) {
	
	        // Upload a file to the server
	        var formData;
	        var file = ev.detail().file;
	
	        // Define functions to handle upload progress and completion
	        xhrProgress = function (ev) {
	            // Set the progress for the upload
	            dialog.progress((ev.loaded / ev.total) * 100);
	        }
	
	        xhrComplete = function (ev) {
	            var response;
	
	            // Check the request is complete
	            if (ev.target.readyState != 4) {
	                return;
	            }
	
	            // Clear the request
	            xhr = null
	            xhrProgress = null
	            xhrComplete = null
	
	            // Handle the result of the upload
	            if (parseInt(ev.target.status) == 200) {
	                // Unpack the response (from JSON)
	                response = JSON.parse(ev.target.responseText);
	                // Store the image details
	                image = {
	                    size: response.size,
	                    url: response.filename
	                    };
					console.log(image);
	
	                // Populate the dialog
	                dialog.populate(image.url, image.size);
	
	            } else {
	                // The request failed, notify the user
	                new ContentTools.FlashUI('no');
	            }
	        }
	
	        // Set the dialog state to uploading and reset the progress bar to 0
	        dialog.state('uploading');
	        dialog.progress(0);
	
	        // Build the form data to post to the server
	        formData = new FormData();
	        formData.append('userfile', file);
	        formData.append('file_id', 0);
	
	        // Make the request
	        xhr = new XMLHttpRequest();
	        xhr.upload.addEventListener('progress', xhrProgress);
	        xhr.addEventListener('readystatechange', xhrComplete);
	        xhr.open('POST', '/api/uploadimage', true);
	        xhr.send(formData);
	    });
	
	    function rotateImage(direction) {
	        // Request a rotated version of the image from the server
	        var formData;
	
	        // Define a function to handle the request completion
	        xhrComplete = function (ev) {
	            var response;
	
	            // Check the request is complete
	            if (ev.target.readyState != 4) {
	                return;
	            }
	
	            // Clear the request
	            xhr = null
	            xhrComplete = null
	
	            // Free the dialog from its busy state
	            dialog.busy(false);
	
	            // Handle the result of the rotation
	            if (parseInt(ev.target.status) == 200) {
	                // Unpack the response (from JSON)
	                response = JSON.parse(ev.target.responseText);
	
	                // Store the image details (use fake param to force refresh)
	                image = {
	                    size: response.size,
	                    url: response.url + '?_ignore=' + Date.now()
	                    };
	
	                // Populate the dialog
	                dialog.populate(image.url, image.size);
	
	            } else {
	                // The request failed, notify the user
	                new ContentTools.FlashUI('no');
	            }
	        }
	
	        // Set the dialog to busy while the rotate is performed
	        dialog.busy(true);
	
	        // Build the form data to post to the server
	        formData = new FormData();
	        formData.append('url', image.url);
	        formData.append('direction', direction);
	
	        // Make the request
	        xhr = new XMLHttpRequest();
	        xhr.addEventListener('readystatechange', xhrComplete);
	        xhr.open('POST', '/rotate-image', true);
	        xhr.send(formData);
	    }
	
	    dialog.addEventListener('imageuploader.rotateccw', function () {
	        rotateImage('CCW');
	    });
	
	    dialog.addEventListener('imageuploader.rotatecw', function () {
	        rotateImage('CW');
	    });
	
	    dialog.addEventListener('imageuploader.save', function () {
	        var crop, cropRegion, formData;
	
	        // Define a function to handle the request completion
	        xhrComplete = function (ev) {
	            // Check the request is complete
	            if (ev.target.readyState !== 4) {
	                return;
	            }
	
	            // Clear the request
	            xhr = null
	            xhrComplete = null
	
	            // Free the dialog from its busy state
	            dialog.busy(false);
	
	            // Handle the result of the rotation
	            if (parseInt(ev.target.status) === 200) {
	                // Unpack the response (from JSON)
	                var response = JSON.parse(ev.target.responseText);
	
	                // Trigger the save event against the dialog with details of the
	                // image to be inserted.
	                dialog.save(
	                    response.filename,
	                    response.size,
	                    {
	                        'alt': response.alt,
	                        'data-ce-max-width': response.size[0]
	                    });
	
	            } else {
	                // The request failed, notify the user
	                new ContentTools.FlashUI('no');
	            }
	        }
	
	        // Set the dialog to busy while the rotate is performed
	        dialog.busy(true);
	
	        // Build the form data to post to the server
	        formData = new FormData();
	        formData.append('url', image.url);
	
	        // Set the width of the image when it's inserted, this is a default
	        // the user will be able to resize the image afterwards.
	        formData.append('width', 600);
	
	        // Check if a crop region has been defined by the user
	        if (dialog.cropRegion()) {
	            formData.append('crop', dialog.cropRegion());
	        }
	
	        // Make the request
	        xhr = new XMLHttpRequest();
	        xhr.addEventListener('readystatechange', xhrComplete);
	        xhr.open('POST', '/api/insertimage', true);
	        xhr.send(formData);
	    });
	
	}
	/* End Image Save */

		/* Content Tools Content Save */
		window.addEventListener('load', function() {
		    var editor;
		    ContentTools.IMAGE_UPLOADER = imageUploader;
			ContentTools.StylePalette.add([
			    new ContentTools.Style('Author', 'author', ['p'])
			]);
			editor = ContentTools.EditorApp.get();
			editor.init('*[data-editable]', 'data-name');
			editor._emptyRegionsAllowed = true;
			editor.addEventListener('saved', function (ev) {
			    var name, payload, regions, xhr;
			
			    // Check that something changed
			    regions = ev.detail().regions;
			    if (Object.keys(regions).length == 0) {
			        return;
			    }
			
			    // Set the editor as busy while we save our changes
			    this.busy(true);
			
			    // Collect the contents of each region into a FormData instance
			    payload = new FormData();
			    for (name in regions) {
			        if (regions.hasOwnProperty(name)) {
			            payload.append(name, regions[name]);
			        }
			    }
			
			    // Send the update content to the server to be saved
			    function onStateChange(ev) {
			        // Check if the request is finished
			        if (ev.target.readyState == 4) {
			            editor.busy(false);
			            if (ev.target.status == '200') {
			                // Save was successful, notify the user with a flash
			                new ContentTools.FlashUI('ok');
			            } else {
			                // Save failed, notify the user with a flash
			                new ContentTools.FlashUI('no');
			            }
			        }
			    };
			
			    /*
				xhr = new XMLHttpRequest();
			    xhr.addEventListener('readystatechange', onStateChange);
			    xhr.open('POST', '/save-my-page');
			    xhr.send(payload);
			    */
			    
			    // Sean's code for the editor, not sure what will happen, maybe bad things...
			    
				$.ajax({
					type: "POST",
					beforeSend: function() {
						//$('#editorbuttons').hide(); 
					},
					url: "/api/update/taxonomy/<?php echo $id; ?>?passive=true",
					//data: $("#formeditor").serialize(),
					processData: false,
					contentType: false,
					data: payload,
					statusCode: {
						200: function(data) {
							var response = JSON.parse(data); 
							//$('#editorbuttons').show(); 
							new ContentTools.FlashUI('ok');
							//window.location.reload();
						},
						403: function(data) {
							//var response = JSON.parse(data);
							//$('#editorloading').hide(); 
							new ContentTools.FlashUI('no');

						},
						404: function(data) {
							//var response = JSON.parse(data);
							//$('#editorloading').hide(); 
							new ContentTools.FlashUI('no');

						}
					}
				});
				this.busy(false);

			});
		});
		
		
	</script>
	<?php } /*?> 



				<?php if (isset($payload['footer']) && in_array('parentchild', $payload['footer'])) : ?>
				<!-- Footer parentchild -->
						<hr>
						<div class="row">
							<div class="col-md-6">
								<h4><strong>Children</strong></h4>
								<p>Explore <?php echo $title; ?> further in the topics and collections below.</p>
								<?php $set = $this->shared->get_related($type,$id,true); ?>
								<?php if ($set !== false) : ?>
								<?php foreach ($set as $single) { 
									if (in_array($single['id'], $excludearray[$single['type']])) continue; ?>
									<h4><a class="t_list_<?php echo $single['id']; ?>" href="/<?php echo $single['type']; ?>/<?php echo $single['slug']; ?>"><?php echo $single['title']; ?></a></h4>
									<!--<p><?php echo $single['excerpt']; ?> <a href="/<?php echo $single['type']; ?>/<?php echo $single['slug']; ?>">Learn More about <?php echo $single['title']; ?> &rarr;</a></p>-->
								<?php } ?> 
								<?php elseif ($this->ion_auth->is_admin()): ?><blockquote>No connected topics...yet.<br /><button class="btn btn-success" data-toggle="modal" data-target="#pageeditor">Add Relationships</button></blockquote><?php endif; ?>
							</div>
							<div class="col-md-6">
								<h4><strong>Parents</strong></h4>
								<p><?php echo $title; ?> is part of the following collections.</p>
								<?php $set = $this->shared->get_related_parents($type,$id,true); ?>
								<?php if ($set !== false) : ?>
								<?php foreach ($set as $single) { 
									if (!isset($single['id'])) continue; 
									if (in_array($single['id'], $excludearray[$single['type']])) continue; ?>
									<h4><a class="t_list_<?php echo $single['id']; ?>" href="/<?php echo $single['type']; ?>/<?php echo $single['slug']; ?>"><?php echo $single['title']; ?></a></h4>
									<!--<p><?php echo $single['excerpt']; ?> <a href="/<?php echo $single['type']; ?>/<?php echo $single['slug']; ?>">Learn More about <?php echo $single['title']; ?> &rarr;</a></p>-->
								<?php } ?> 
								<?php elseif ($this->ion_auth->is_admin()): ?><blockquote>No connected topics...yet.<br /><button class="btn btn-success" data-toggle="modal" data-target="#pageeditor">Add Relationships</button></blockquote><?php endif; ?>
							</div>
						</div>
				<!-- /Footer List -->
				<?php endif; ?>
				<?php if (isset($payload['footer']) && in_array('excerpts', $payload['footer'])) : ?>
				<!-- Footer List -->
					<?php $set = $this->shared->get_related($type,$id,true); ?>
					<?php if ($set !== false) : ?>
						<hr><h4><strong>Explore Further</strong></h4>
						<p>These are elements and topics related to <?php echo $title; ?>. <?php if ($this->ion_auth->is_admin()) { ?>You can also <a data-toggle="modal" data-target="#pageeditor">modify relationships &rarr;</a><?php } ?></p>
						<?php foreach ($set as $single) { 
							if (in_array($single['id'], $excludearray[$single['type']])) continue;
						?>
							<h4><a class="t_list_<?php echo $single['id']; ?>" href="/<?php echo $single['type']; ?>/<?php echo $single['slug']; ?>"><?php echo $single['title']; ?></a></h4>
							<p><?php echo $single['excerpt']; ?> <a href="/<?php echo $single['type']; ?>/<?php echo $single['slug']; ?>">Learn More about <?php echo $single['title']; ?> &rarr;</a></p>
							<hr>
						<?php } ?> <?php elseif ($this->ion_auth->is_admin()): ?><blockquote>No connected topics...yet.<br /><button class="btn btn-success" data-toggle="modal" data-target="#pageeditor">Add Relationships</button></blockquote><?php endif; ?>
				<!-- /Footer List -->
				<?php endif; ?>
				<?php if (isset($payload['footer']) && in_array('list', $payload['footer'])) : ?>
				<!-- Footer List -->
				<div class="page-header">
					<hr><h4><strong>Explore Further</strong></h4>
					<p>These are elements and topics related to <?php echo $title; ?>. <?php if ($this->ion_auth->is_admin()) { ?>You can also <a data-toggle="modal" data-target="#pageeditor">modify relationships &rarr;</a><?php } ?></p>
					<?php $set = $this->shared->get_related($type,$id,true); ?>
					<?php if ($set !== false) : ?>
					<!--
					<hr />
					<h3>Related elements and topics</h3>
					<p>These are elements and topics related to <?php echo $title; ?>. You can also <a data-toggle="modal" data-target="#pageeditor">modify relationships &rarr;</a></p>
					-->
					<?php foreach ($set as $single) { 
						if (in_array($single['id'], $excludearray[$single['type']])) continue;
					?>
						<h4><a class="t_list_<?php echo $single['id']; ?>" href="/<?php echo $single['type']; ?>/<?php echo $single['slug']; ?>"><?php echo $single['title']; ?></a></h4>
					<?php } ?> <?php elseif ($this->ion_auth->is_admin()): ?><blockquote>No connected topics...yet.<br /><button class="btn btn-success" data-toggle="modal" data-target="#pageeditor">Add Relationships</button></blockquote><?php endif; ?>

				</div>
				<!-- /Footer List -->
				<?php endif; ?>


	<script>
		$('#pageeditor').on('shown.bs.modal', function () {
			$('.cas-summernote').summernote({
			  toolbar: [
			    // [groupName, [list of button]]
			    ['style', ['style']],
			    ['simple', ['bold', 'italic', 'underline', 'clear']],
			    ['para', ['ul', 'ol', 'paragraph']],
			    ['link', ['linkDialogShow']],
			    ['code', ['codeview']],
			    ['fullscreen', ['fullscreen']],
			    
			  ],
			});
			$('.note-editable.panel-body').attr("spellcheck","true");
		})


		$('#pageupload').on('shown.bs.modal', function () {
		    $("#cas-tax-file").fileinput({
		        uploadAsync: false,
				url: "/api/uploadimage", // remove X or it wont work...
		        uploadExtraData: function() {
		            return {
		                id: '<?php echo $id; ?>',
		                type: 'taxonomy'
		            };
		        }
		    });
		});

		$('#cas-tax-file').fileinput({
		    uploadUrl: "/api/uploadimage", // server upload action
		    uploadAsync: true,
		    showUpload: false, // hide upload button
		    showRemove: false, // hide remove button
		    minFileCount: 1,
		    maxFileCount: 1
		}).on("filebatchselected", function(event, files) {
		    // trigger upload method immediately after files are selected
		    $('#cas-tax-file').fileinput("upload");
		}).on('fileuploaded', function(event, data, previewId, index) {
		    var form = data.form, files = data.files, extra = data.extra,
		        response = data.response, reader = data.reader;
		    console.log(response.filename + ' has been uploaded');
		    $('#imgheader').css('background-image','url('+response.filename+')');
		    $('#cas-tax-fileurl').val(response.filename);
		});


		$('#submiteditor').click(function() {
			$.ajax({
				type: "POST",
				beforeSend: function() {
					$('#editorbuttons').hide(); 
					$('#editorfail').hide(); 
					$('#editorloading').show();
				},
				url: "/api/update/taxonomy/<?php echo $id; ?>",
				data: $("#formeditor").serialize(),
				statusCode: {
					200: function(data) {
						$('#editorloading').hide(); 
						$('#editorsuccess').show();
						var response = JSON.parse(data); 
						$('#editorbuttons').show(); 
						//alert('updated 202');
						window.location.reload();
					},
					403: function(data) {
						//var response = JSON.parse(data);
						$('#editorloading').hide(); 
						$('#editorfail').show();
						$('#editorbuttons').show(); 
					},
					404: function(data) {
						//var response = JSON.parse(data);
						$('#editorloading').hide(); 
						$('#editorfail').show();
						$('#editorbuttons').show(); 
					}
				}
			});
		});
		$('#submitupload').click(function() {
			$.ajax({
				type: "POST",
				beforeSend: function() {
					$('#uploadbuttons').hide(); 
					$('#uploadfail').hide(); 
					$('#uploadloading').show();
				},
				url: "/api/update/taxonomy/<?php echo $id; ?>/header", 
				data: $("#formupload").serialize(),
				statusCode: {
					200: function(data) {
						$('#uploadloading').hide(); 
						$('#uploadsuccess').show();
						var response = JSON.parse(data); 
						$('#uploadbuttons').show(); 
						window.location.reload();
					},
					403: function(data) {
						//var response = JSON.parse(data);
						$('#uploadloading').hide(); 
						$('#uploadfail').show();
						$('#uploadbuttons').show(); 
					},
					404: function(data) {
						//var response = JSON.parse(data);
						$('#uploadloading').hide(); 
						$('#uploadfail').show();
						$('#uploadbuttons').show(); 
					}
				}
			});
		});

	</script>
	<?php */ 