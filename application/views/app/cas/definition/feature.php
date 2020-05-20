<?php 
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
	$relatedprinciples = array(
			$settings['principles']['value'],
			'taxonomy',
			'Related '.$settings['principles']['title'], 
			'This is a list of '.$settings['principles']['title'].' that '.$title.' is related to.');
	$p__type = 'taxonomy';
	$p__list = $this->shared->get_related($relatedprinciples[1],$relatedprinciples[0]);
	if (!empty($p__list)) { 
	$p__host = $this->shared->get_data($relatedprinciples[1],$relatedprinciples[0]);  ?>
	<!-- Nav -->
	<div class="principle-container-nav">
		<!-- Nav tabs -->
		<span class="app-section-title"><a href="/taxonomy/<?php echo $settings['principles']['host']['slug']; ?>" ><?php echo $settings['principles']['title']; ?></a></span>
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

	<div class="principle-wrapper concepts-wrapper">
	<!-- Hero Background -->
		<div class="container-fluid build-wrapper home-hero">
			<div id="imgheader" class="hero-wrapper" style="background-image: url(<?php echo (isset($img['header']) && !empty($img['header'])) ? $img['header']['url']: '/includes/test/assets/terms_background.jpg'; ?>);">
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
						if ($this->shared->is_parent($type, $id, 'taxonomy', $settings['terms']['value'])) { ?><a class="subnav-heading" href="/taxonomy/<?php echo $this->shared->get_data('taxonomy',$settings['terms']['value'])['slug']; ?>"><?php echo $settings['terms']['title']; ?></a><?php } 
						elseif ($this->shared->is_parent($type, $id, 'taxonomy', $settings['people']['value'])) { ?><a class="subnav-heading" href="/taxonomy/<?php echo $this->shared->get_data('taxonomy',$settings['people']['value'])['slug']; ?>"><?php echo $settings['people']['title']; ?></a><?php } 
						elseif ($this->shared->is_parent($type, $id, 'taxonomy', $settings['concepts']['value'])) { ?><a class="subnav-heading" href="/taxonomy/<?php echo $this->shared->get_data('taxonomy',$settings['concepts']['value'])['slug']; ?>"><?php echo $settings['concepts']['title']; ?></a><?php } 
						?>
					<div class="hero-diagram">
						<img class="cas-def-diagram-preview" data-toggle="modal" data-target="#<?php echo (empty($diagrams['sorted'])) ? 'diagramnew':'diagramrate'; ?>" src="<?php echo (isset($icon['url'])) ? $icon['url']: '/upload/img/defdefault.png'; ?>" width="200px" height="200px" alt="Diagram: <?php echo $title; ?>" />
						<?php if ($this->ion_auth->logged_in()) { ?><div style="position: absolute; left: 140px; top: 49px; width: 75px;">
							<button type="button" class="btn btn-fail btn-sm" data-toggle="modal" data-target="#diagramnew"><span class="glyphicon glyphicon-plus" data-toggle="tooltip" title="Suggest new image/diagram" aria-hidden="true"></span></button>
							<button type="button" class="btn btn-fail btn-sm" data-toggle="modal" data-target="#diagramrate"><span class="glyphicon glyphicon-th-list" data-toggle="tooltip" title="Rate <?php echo lcfirst(str_replace('"',"'",$title)); ?> diagrams" aria-hidden="true"></span></button>
						</div><?php } ?>
					</div>

					<div data-editable="" data-name="payload[title]">
						<h1><?php echo $title; ?></h1>
					</div>
					<div data-editable="" data-name="payload[subtitle]">
						<h2><?php echo $this->shared->handlebar_links($subtitle); ?></h2>
					</div>
				</div>
				<!-- /title -->
				<!-- Hero Next -->
				<div class="col-lg-offset-2 col-lg-3 hero-heading hero-related visible-lg">
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
						<div data-editable="" data-name="payload[excerpt]">
							<p><?php echo $this->shared->handlebar_links($excerpt); ?></p>
						</div>
						<div>
							<a href="#fulltext" onclick="$('#fulltext').toggle('100'); $(this).hide(); return false;" style="display: block; padding-bottom: 40px;">Keep reading →</a>
						</div>
						<div id="fulltext" style="display: none;">
							<hr />
							<div data-editable="" data-name="payload[body]"><?php echo $this->shared->handlebar_links($body); ?></div>
							<?php $this->shared->footer_photocitation($id,$img,$timestamp,$slug,$title); ?>
						</div>
					</div>
					<!-- /body -->
					<!-- Related -->
					<div class="row related hidden-lg">
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
								<li role="presentation"><a href="#people" aria-controls="profile" role="tab" data-toggle="tab">People</a></li>
								<li role="presentation"><a href="#terms" aria-controls="messages" role="tab" data-toggle="tab">Terms</a></li>
								<li role="presentation"><a href="#thoughts" aria-controls="settings" role="tab" data-toggle="tab">Thought Experiments</a></li>
							</ul>
							
							<!-- Tab panes -->
							<div class="tab-content">
								<div role="tabpanel" class="tab-pane fade in active" id="feed">
									<p>This is the feed, a series of related links and resources. <a data-toggle="modal" data-target="#createlink">Add a link to the feed →</a></p>
									<?php echo $this->shared->related_html($type,$id); ?>
								</div>
								<div role="tabpanel" class="tab-pane fade" id="people">
									<?php // setup for the related dropdown module 
										$relatedsetup = array(
											'people' => array(
												$settings['people']['value'],
												'taxonomy',
												'Related '.$settings['people']['title'], 
												'This is a list of '.$settings['people']['title'].' that '.$title.' is related to.'),
										); $i=1; ?>
									<div class="panel-group" id="accordion-people" role="tablist" aria-multiselectable="true"><?php
										foreach ($relatedsetup as $__k => $__i) {
											$__type = 'taxonomy';
											$__list = $this->shared->get_related($__i[1],$__i[0]);
											if (!empty($__list)) { 
											$__host = $this->shared->get_data($__i[1],$__i[0]); ?>
										<p><?php echo $__i[3]; ?></p>
										<?php foreach ($__list as $__child) { if ($this->shared->is_parent($type, $id, $__child['type'], $__child['id'])) { $excludearray[$__child['type']][] = $__child['id']; ?>
										<div class="panel panel-default">
											<div class="panel-heading" role="tab" id="headingTwo">
												<a <?php if ($i>1) echo 'class="collapsed" ';?>role="button" data-toggle="collapse" data-parent="#accordion-people" href="#<?php echo $__k.$__child['id']; ?>" aria-expanded="<?php echo ($i === 1) ? 'true':'false';?>" aria-controls="<?php echo $__k.$__child['id']; ?>">
													<?php echo $__child['title']; ?>
													</a>
											</div>
											<div id="<?php echo $__k.$__child['id']; ?>" class="panel-collapse collapse<?php if ($i === 1) echo ' in';?>" role="tabpanel" aria-labelledby="headingOne">
												<div class="panel-body">
													<p><?php echo $__child['subtitle']; ?></p>
													<?php echo $__child['excerpt']; ?>
												<a href="/<?php echo $__child['type']; ?>/<?php echo $__child['slug']; ?>">Read more and see related content for <?php echo $__child['title']; ?> &rarr;</a>
												</div>
											</div>
										</div>
										<?php $i++; }} // end is_child and foreach ?>
										<li><a href="/<?php echo $__host['type']; ?>/<?php echo $__host['slug']; ?>">See all <em><?php echo $__host['title']; ?></em> &rarr;</a></li>
									<?php }} ?>
									</div>
						
								</div>
								<div role="tabpanel" class="tab-pane fade" id="terms">
									<?php // setup for the related dropdown module 
										$relatedsetup = array(
											'terms' => array(
												$settings['terms']['value'],
												'taxonomy',
												'Related '.$settings['terms']['title'], 
												'This is a list of '.$settings['terms']['title'].' that '.$title.' is related to.'),
										); $i=1; ?>
									<div class="panel-group" id="accordion-terms" role="tablist" aria-multiselectable="true"><?php
										foreach ($relatedsetup as $__k => $__i) {
											$__type = 'taxonomy';
											$__list = $this->shared->get_related($__i[1],$__i[0]);
											if (!empty($__list)) { 
											$__host = $this->shared->get_data($__i[1],$__i[0]); ?>
										<p><?php echo $__i[3]; ?></p>
										<?php foreach ($__list as $__child) { if ($this->shared->is_parent($type, $id, $__child['type'], $__child['id'])) { $excludearray[$__child['type']][] = $__child['id']; ?>
										<div class="panel panel-default">
											<div class="panel-heading" role="tab" id="headingTwo">
												<a <?php if ($i>1) echo 'class="collapsed" ';?>role="button" data-toggle="collapse" data-parent="#accordion-terms" href="#<?php echo $__k.$__child['id']; ?>" aria-expanded="<?php echo ($i === 1) ? 'true':'false';?>" aria-controls="<?php echo $__k.$__child['id']; ?>">
												<?php echo $__child['title']; ?>
												</a>
											</div>
											<div id="<?php echo $__k.$__child['id']; ?>" class="panel-collapse collapse<?php if ($i === 1) echo ' in';?>" role="tabpanel" aria-labelledby="headingOne">
												<div class="panel-body">
													<p><?php echo $__child['subtitle']; ?></p>
													<?php echo $__child['excerpt']; ?>
												<a href="/<?php echo $__child['type']; ?>/<?php echo $__child['slug']; ?>">Read more and see related content for <?php echo $__child['title']; ?> &rarr;</a>
												</div>
											</div>
										</div>
										<?php $i++; }} // end is_child and foreach ?>
										<li><a href="/<?php echo $__host['type']; ?>/<?php echo $__host['slug']; ?>">See all <em><?php echo $__host['title']; ?></em> &rarr;</a></li>
									<?php }} ?>
									</div>
						
								</div>
								<div role="tabpanel" class="tab-pane fade" id="thoughts">There would be some thought experiments here.</div>
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
	<!-- New diagram modal -->
	<div class="modal fade" id="diagramnew" tabindex="-1" role="dialog" aria-labelledby="diagramnew" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">Suggest a new diagram for <?php echo $title; ?></h4>
				</div>
				<div class="modal-body">
				<form id="formdiagramnew" enctype="multipart/form-data">
					<div class="form-group">
						<label for="cas-diagram-file" class="">Step 1: Upload your diagram</label>
						<div class=""><input type="file" id="cas-diagram-file" name="userfile" value=""></div>
						<input type="hidden" id="cas-diagram-fileurl" name="payload[url]" value="">
						<p><br /></p>
						<label class="">Step 2: Rate your diagram</label>
						<p>Awesome, now let's rate your diagram. User the slider to see how you feel it rates for each of the attributes. You can <a href="/diagrams/" target="_blank">rate attributes and suggest new ones over here (in a new window)</a>.</p>
					</div>
					<div class="form-horizontal">
						<div class="form-group">
							<label class="col-sm-4 control-label top-nospace">&nbsp;</label><div class="col-sm-8"><div class="pull-left">Low</div><div class="pull-right">High</div>&nbsp;</div>
						</div>
						<?php // list top 5 attributes for evaluation
							$i = 1; 
							//$attributes = $this->shared->get_attributes();
							//$user = $this->ion_auth->user()->row(); 
							//$ratings = $this->shared->get_ratings($user->id,'attribute');
							foreach ($attributes['sorted'] as $attribute) { if ($i === 9) break; 
							/* if (isset($ratings[$attribute['id']]) && is_array($ratings[$attribute['id']])) { ?><span class="label label-default pull-right">Rated as <?php echo ($ratings[$attribute['id']][0]['value'] == '.9') ? 'important': 'not important'; ?>.</span><?php } else { ?><button type="button" class="pull-right btn btn-danger btn-xs" data-toggle="tooltip" title="Set as NOT important?" onclick="rate('attribute',<?php echo $attribute['id']; ?>,.1);"><span class="glyphicon glyphicon-minus" aria-hidden="true"></span></button>
							*/ 
							
							?> 
						<div class="form-group">
							<label class="col-sm-4 control-label top-nospace" for="payload[rating][<?php echo $attribute['id']; ?>" ><?php echo $attribute['title']; ?></label><div class="col-sm-8"><input type="range" for="cas-attribute-<?php echo $attribute['id']; ?>" name="payload[rating][<?php echo $attribute['id']; ?>]" value=".5" min="0" max="1.0" step=".1"></div>
						</div><?php $i++; } ?> 
						<div class="form-group">
							<input type="hidden" value="definition" name="payload[type]" id="cas-diagram-type" />
							<input type="hidden" value="<?php echo $id; ?>" name="payload[typeid]" id="cas-diagram-id" />
							<input type="hidden" value="attribute" name="payload[target]" id="cas-diagram-target" />
							<input type="hidden" value="<?php echo md5(md5(microtime())); ?>" name="<?php echo md5(md5(microtime())); ?>" id="cas-diagram-validate-submit" />
						</div>
					</div>
				</form>
				</div>
				<div class="modal-footer">
					<div id="diagramnewfail" class="alert alert-danger " style="display: none;" role="alert">Uh oh, the <?php echo $type; ?> didn't save, make sure everything above is filled and try again.</div>
					<div id="diagramnewsuccess" class="alert alert-success " style="display: none;" role="alert">Great success, content posted.</div>
					<div id="diagramnewloading" class="alert alert-info progress-bar progress-bar-striped active" style="display: block; width: 100%; display: none;" role="alert">climbing...</div>
					<div id="diagramnewbuttons">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						<button type="reset" class="btn btn-default" >Reset</button>
						<button type="button" class="btn btn-primary tt" id="submitdiagramnew">Save changes</button>
					</div>
				</div>
				</div>
			</div>
		</div>
	</div>
	<!-- /New diagram modal -->
	<!-- Rate diagrams modal -->
	<div class="modal fade" id="diagramrate" tabindex="-1" role="dialog" aria-labelledby="diagramrate" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">Rate diagrams for <?php echo $title; ?></h4>
				</div>
				<div class="modal-body">
					<div class="form-horizontal">
						<div class="form-group">
							<p class="col-sm-12">You can do two things here. First, you can influence the order of the diagrams for this topic by clicking on the (<span class="glyphicon glyphicon-plus"></span>) and (<span class="glyphicon glyphicon-minus"></span>) buttons. The diagrams with more plus votes will rise to the top. The second thing you can do here is rate the diagrams against the evolving set of attributes that you can <a href="/diagrams" target="_blank" >learn more about here</a>. You can only rate each thing once but as the attribute list changes, you can come back and update ratings.</p> 
							<label class="col-sm-12">Curent <?php echo $title; ?> Diagram</label>
						</div>
						<?php 
							//$attributes = $this->shared->get_attributes();
							//$user = $this->ion_auth->user()->row(); 
							//$d_ratings = $this->shared->get_ratings($user->id,'diagram','');
							//$a_ratings = $this->shared->get_ratings($user->id,'diagram','attribute');
							//$diagrams = $this->shared->get_diagrams('diagram','definition',$id);
							$k = 1;
							if (empty($diagrams['sorted'])) { ?><blockquote>No diagrams...yet.<!--<br /><button class="btn btn-success" data-toggle="modal" data-target="#diagramnew" onclick="$('#diagramrate').modal('hide'); return false;">Suggest the first diagram</button>--></blockquote><?php } 
							foreach ($diagrams['sorted'] as $diagram) { 
								$a_rated = array();
								if (isset($a_ratings[$diagram['id']])) foreach ($a_ratings[$diagram['id']] as $ar) $a_rated[$ar['targetid']] = $ar;

							?>
						<?php if ($k==2) { ?><div class="form-group">
							<label class="col-sm-12">Suggested <?php echo $title; ?> Diagrams</label>
						</div><?php } ?>
						<form id="formrate-<?php echo $diagram['id']; ?>">
						<div class="form-group">
							<img src="<?php echo $diagram['url']; ?>" class="col-xs-4" />
							<div class="col-sm-8 ">
								<div class="row raterow-<?php echo $diagram['id']; ?>">
									<label class="col-sm-5 control-label top-nospace">&nbsp;</label>
									<div class="col-sm-6"><small class="pull-left">Low</small><small class="pull-right">High</small>&nbsp;</div>
								</div>
								<?php 
									$rating_average = $this->shared->get_rating_average('diagram',$diagram['id'],'attribute'); 
									// list top 5 attributes for evaluation
									$i = 1; $j = 1; 
									foreach ($attributes['sorted'] as $attribute) { if ($i === 9) break; 
										$flag = false;
										if (isset($a_rated[$attribute['id']]) && is_array($a_rated[$attribute['id']])) { $flag = true; $j++; }


									?> 
								<div class="row raterow-<?php echo $diagram['id']; ?>"<?php if ($flag) { ?> style="background:#EEE;"<?php } ?>>
									<label class="col-sm-5 control-label top-nospace small" for="payload[rating][<?php echo $attribute['id']; ?>]" ><?php echo $attribute['title']; ?></label>
									<div class="col-sm-6"<?php if ($flag) { ?>data-toggle="tooltip" title="Feedback based on <?php echo $rating_average[$attribute['id']]['count']; ?> ratings"<?php } ?>><input type="range" <?php if (!$flag) { ?>name="payload[rating][<?php echo $attribute['id']; ?>]"<?php } ?> value="<?php echo ($flag) ? $rating_average[$attribute['id']]['value'].'" disabled="disabled' : '.5'; ?>" min="0" max="1.0" step=".1"></div>
								</div><?php $i++; } ?> 
								<?php if ($j > 1) { ?>
								<div class="row raterow-<?php echo $diagram['id']; ?>">
									<label class="col-sm-5 control-label top-nospace">&nbsp;</label>
									<div class="col-sm-6"><small class="pull-left"><em>*Ratings in grey are averages of all ratings for this diagram.</em></small></div>
								</div>
								<?php }	?>
								<hr />
								<div class="row">
									<div class="col-sm-6" id="formrateplusminus-<?php echo $diagram['id']; ?>">
										<?php if (isset($d_ratings[$diagram['id']]) && is_array($d_ratings[$diagram['id']])) { ?><span class="label label-default pull-right" data-toggle="tooltip" title="You rated this <?php echo $this->shared->twitterdate($d_ratings[$diagram['id']][0]['timestamp']); ?>">Rated as <?php echo ($d_ratings[$diagram['id']][0]['value'] == '.9') ? 'important': 'not important'; ?></span><?php } else { ?> 
										<div data-toggle="tooltip" title="Use these buttons to rate this diagram against the others">
											<div class="btn-group pull-right" data-toggle="buttons">
												<label class="btn btn-default btn-xs casradioplus" onclick="ratediagram('diagram',<?php echo $diagram['id']; ?>,.9,<?php echo $diagram['id']; ?>);"><input type="radio" autocomplete="off"><span class="glyphicon glyphicon-plus"></span></label> 
												<label class="btn btn-default btn-xs casradiominus" onclick="ratediagram('diagram',<?php echo $diagram['id']; ?>,.1,<?php echo $diagram['id']; ?>);"><input type="radio" autocomplete="off"><span class="glyphicon glyphicon-minus"></span></label>
											</div>
										</div><?php } ?>
									</div>
									<div class="col-sm-6" id="formrateplusminussuccess-<?php echo $diagram['id']; ?>" style="display: none;">
										<small>You've rated this diagram against the others, thanks!</small>
									</div>
									<div class="col-sm-6" id="formratebuttons-<?php echo $diagram['id']; ?>">
										<?php if ($j > 8) { ?><span class="label label-default ">You rated this diagram already!</span><?php } else { ?>
										<button type="button" class="btn btn-primary btn-xs tt" onclick="rate(<?php echo $diagram['id']; ?>);" id="submitrate-<?php echo $diagram['id']; ?>">Rate</button>
										<button type="reset" class="btn btn-default btn-xs" >Reset</button>
										<?php } ?>
									</div>
									<div class="col-sm-6" id="formratesuccess-<?php echo $diagram['id']; ?>" style="display: none;">
										<small>You've evaluated this diagram, thanks!</small>
									</div>
								</div>
							</div>
						</div>
						<input type="hidden" value="diagram" name="payload[type]" />
						<input type="hidden" value="<?php echo $diagram['id']; ?>" name="payload[typeid]" />
						<input type="hidden" value="attribute" name="payload[target]" />
						<input type="hidden" value="<?php echo md5(microtime()); ?>" name="<?php echo md5(md5(microtime())); ?>" />
						</form>
						<hr />
						<?php $k++; } ?>
					</div>
				</form>
				</div>
				<div class="modal-footer">
					<div id="diagramnewfail" class="alert alert-danger " style="display: none;" role="alert">Crap. Make sure your jpg/png/gif image is a 2000px or less square, less than 10mb.</div>
					<div id="diagramnewsuccess" class="alert alert-success " style="display: none;" role="alert">Great success, content posted.</div>
					<div id="diagramnewloading" class="alert alert-info progress-bar progress-bar-striped active" style="display: block; width: 100%; display: none;" role="alert">dancing...</div>
					<div id="diagramnewbuttons" style="display: none;">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						<button type="reset" class="btn btn-default" >Reset</button>
						<button type="button" class="btn btn-primary tt" id="submitdiagramnew">Suggest Diagram</button>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- /Rate diagrams modal -->

	<script>
		function rate(diagram) {
			$.ajax({
				type: "POST",
				beforeSend: function() {
					$('#submitrate-'+diagram).text('thinking...'); 
				},
				url: "/api/rate", 
				data: $("#formrate-"+diagram).serialize(),
				statusCode: {
					200: function(data) {
						$('#formratebuttons-'+diagram).hide(); 
						$('#formratesuccess-'+diagram).show(); 
						$('.raterow-'+diagram).css('opacity',.3); 
						///alert('ding ding ding!');
						//window.location.reload();
						
					},
					403: function(data) {
						alert('403 fail');
						//var response = JSON.parse(data);
					},
					404: function(data) {
						alert('404 fail');
						//var response = JSON.parse(data);
					}
				}
			});
			
		}
		function ratediagram(rt,ri,rr,di) {
			$.ajax({
				type: "POST",
				beforeSend: function() {
					$(this).prop("disabled",true).addClass('btn-fail'); 
				},
				url: "/api/rate",
				data: {'payload[type]':rt, 'payload[typeid]':ri, 'payload[value]':rr},
				statusCode: {
					200: function(data) {
						//alert('rated!');
						//window.location.reload();
						$('#formrateplusminus-'+di).hide(); 
						$('#formrateplusminussuccess-'+di).show(); 
					},
					403: function(data) {
						//var response = JSON.parse(data);
						alert('crap! Rating failed. Um, talk to Sean.');
					},
					404: function(data) {
						//var response = JSON.parse(data);
						alert('shoot! I think you already rated this.');
					}
				}
			});
			
		}
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
		})
		$('#diagramnew').on('shown.bs.modal', function () {
		    $("#cas-diagram-file").fileinput({
		        uploadAsync: false,
				url: "/api/uploadimage", // remove X or it wont work...
		        uploadExtraData: function() {
		            return {
		                id: '<?php echo $id; ?>',
		                type: 'definition'
		            };
		        }
		    });
		});

		$('#cas-diagram-file').fileinput({
		    uploadUrl: "/api/uploadimage", 
		    uploadAsync: true,
		    showUpload: false, // hide upload button
		    showRemove: false, // hide remove button
		    minFileCount: 1,
		    maxFileCount: 1
		}).on("filebatchselected", function(event, files) {
		    // trigger upload method immediately after files are selected
		    $('#cas-diagram-file').fileinput("upload");
		}).on('fileuploaded', function(event, data, previewId, index) {
		    var form = data.form, files = data.files, extra = data.extra,
		        response = data.response, reader = data.reader;
		    console.log(response.filename + ' has been uploaded');
		    //$('#imgheader').css('background-image','url('+response.filename+')');
		    $('#cas-diagram-fileurl').val(response.filename);
		});

		$('#submitdiagramnew').click(function() {
			$.ajax({
				type: "POST",
				beforeSend: function() {
					$('#diagramnewbuttons').hide(); 
					$('#diagramnewfail').hide(); 
					$('#diagramnewloading').show();
				},
				url: "/api/create/diagram", 
				data: $("#formdiagramnew").serialize(),
				statusCode: {
					200: function(data) {
						$('#diagramnewloading').hide(); 
						$('#diagramnewsuccess').show();
						var response = JSON.parse(data); 
						$('#diagramnewbuttons').show(); 
						window.location.reload();
					},
					403: function(data) {
						//var response = JSON.parse(data);
						$('#diagramnewloading').hide(); 
						$('#diagramnewfail').show();
						$('#diagramnewbuttons').show(); 
					},
					404: function(data) {
						//var response = JSON.parse(data);
						$('#diagramnewloading').hide(); 
						$('#diagramnewfail').show();
						$('#diagramnewbuttons').show(); 
					}
				}
			});
		});




		$('#pageupload').on('shown.bs.modal', function () {
		    $("#cas-tax-file").fileinput({
		        uploadAsync: false,
				url: "/api/uploadimage", // remove X or it wont work...
		        uploadExtraData: function() {
		            return {
		                id: '<?php echo $id; ?>',
		                type: 'definition'
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
				url: "/api/update/definition/<?php echo $id; ?>",
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
				url: "/api/update/definition/<?php echo $id; ?>/header", 
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
	        xhr.open('POST', '/api/rotate-image', true);
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
					url: "/api/update/definition/<?php echo $id; ?>?passive=true",
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
	<?php } ?> 
