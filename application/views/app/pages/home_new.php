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
 $_icon = array(
	'html' => 'fas fa-globe',
	'video' => 'fas fa-tv',
	'book' => 'fas fa-book-open',
	'paper' => 'fas fa-file',
	'profile' => 'fas fa-id-badge',
	'data' => 'fas pie-chart',
	'file' => 'fas fa-newspaper-o',
	'other' => 'fas fa-tree',
);
foreach (array('article1','article2','project1') as $a) if (!isset($payload[$a])) $payload[$a] = '215';

 ?> 
	

	<!-- Article -->
	<article class="article-home">
		<div class="container-fluid">
			<div class="row fullpage">
				<div class="col-sm-5 vh-100 intro">
				<!-- Intro Column -->
					<div class="subtitle"><?=date("g:ia",time())?> in <?=$weather['city']?>, <?=$weather['regionName']?></div>
					<div class="title">Good <?=$timeofday?>!</div>
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
								<div class="title"><a href="/projects">Projects</a>  <?php $this->load->view('helpers/menu-projects'); ?></div>
								<div class="row" style="padding-top:10px;">
									<?php $p = $this->shared->get_data2('definition', $payload['project1']); ?>
									<div class="col-3 image align-self-center">
										<a href="/projects/<?=$p['slug']?>"><img src="<?php $p['img'] = unserialize($p['img']); echo (isset($p['img']['header']) && !empty($p['img']['header'])) ? $p['img']['header']['url']: '/includes/test/assets/Moofushi_Kandu_fish.jpg'; ?>"></a>
									</div>
									<div class="col-9">
										<a href="/projects/<?=$p['slug']?>"><div class="title"><?=$p['title']?></div></a>
										<div class="excerpt"><?=$p['excerpt']?></div>
									</div>
								</div>
								<div class="links"><strong>More:</strong> <a href="/projects?scale=urban">Urban</a> | <a href="/projects?scale=large">Large</a> | <a href="/projects?scale=small">Small</a> | <a href="/projects?scale=web">Web Dev</a> | <a href="/resume"><i class="fas fa-file"></i> Resume &nearr;</a></div>
							</div>
							<div class="col-sm-4 portfolio" onclick="window.location.assign('//sean.wittmeyer.io')">
								<div class="subtitle">Portfolio</div>
								<div class="title" style="font-style: italic;">Digi-Arch</div>
								<a href="//sean.wittmeyer.io/" target="_blank">sean.wittmeyer.io</a>
							</div>
						<!-- /Projects Row -->
					</div>
					<div class="row">
						<!-- Projects Column -->
							<div class="col-sm-8 notes">
								<div class="subtitle">Observations &amp; ideas on the built environment</div>
								<div class="title"><a href="/notes">Field Notes</a> <?php $this->load->view('helpers/menu-fieldnotes');?></div>
								<?php foreach (array($payload['article1'],$payload['article2']) as $d) { ?> 
								<div class="row article" style="padding-top:10px;">
									<?php $p = $this->shared->get_data2('definition', $d); ?>
									<div class="col-3 image align-self-center d-none">
										<a href="/article/<?=$p['slug']?>"><img src="<?php $p['img'] = unserialize($p['img']); echo (isset($p['img']['header']) && !empty($p['img']['header'])) ? $p['img']['header']['url']: '/includes/test/assets/Moofushi_Kandu_fish.jpg'; ?>"></a>
									</div>
									<div class="col-9">
										<a href="/article/<?=$p['slug']?>"><div class="title"><?=$p['title']?></div></a>
										<div class="excerpt"><?=$p['excerpt']?></div>
									</div>
								</div>
								<?php } ?>
								<div class="p-3"></div>
								<div class="links d-none"><strong>Visit the </strong> <a href="/notes">Field Notes Index</a> for all articles, ideas, and observations.</div>
							</div>
							<div class="col-sm-4">
								<div class="subtitle">Themes</div>
								<div class="row no-gutters themeicons">
									<?php /* Get related themes */
									$themes = $this->shared->get_related('taxonomy','34'); 
									foreach ($themes as $i) { ?> 
									<div class="col-2" data-toggle="tooltip" data-title="<?=$i['title']?>"><a href="/theme/<?=$i['slug']?>"><img src="<?=$i['icon']?>"></a></div>
									<?php } ?>
								</div>
								<ul class="article-home asidelist">
									<?php /* Get related themes */
									foreach ($themes as $i) { ?> 
									<li><a href="/theme/<?=$i['slug']?>"><?=$i['title']?></a></li>
									<?php } ?>
								</ul>
							</div>
						<!-- /Projects Row -->
					</div>
					<div class="row flex-1">
						<!-- Projects Column -->
							<div class="col-sm-8">
								<div class="subtitle">Notable and worth sharing</div>
								<div class="title"><a href="/feed">The Feed</a> <?php $this->load->view('helpers/menu-feed',array('_icon'=>$_icon)); ?> <i class="fas fa-info-circle" data-toggle="tooltip" data-title="Card layouts and API from Embed.ly"></i></div>
									<div class="card-columns card-columns-2 grid-filter">
										<?php 
										$feeditems = $this->shared->get_data2('link',false,false,false,false,10); if ($feeditems) { ?>
											<?php foreach ($feeditems as $link) { 
												$__host = $this->shared->get_data($link['hosttype'],$link['hostid']); 
											?> 
											<div class="cas-embed card" data-searchval="<?php echo str_replace('"', '', ($link['title'].' '.$link['excerpt'].' '.$link['type'])).' '.$__host['title']; ?>">
												<blockquote class="embedly-card" data-card-key="74435e49e8fa468eb2602ea062017ceb" data-card-controls="0"><h4><a href="<?php echo $link['uri']; ?>"><?php echo $link['title']; ?></a></h4><p><?php echo $link['excerpt']; ?></p></blockquote><div class="feed-footer"><i class="far fa-comment-dots"></i> <?=$link['caption']?><br><address data-toggle="tooltip" data-title="<?php echo $link['type']; ?>"><i class="<?=$_icon[$link['type']]?>"></i></address> | <address data-toggle="tooltip" data-title="<?php echo $link['excerpt']; ?>">Description</address> | <i class="fas fa-link"></i> <a href="/<?php echo $link['hosttype']; ?>/<?php echo $__host['slug']; ?>"><?php echo $__host['title']; ?></a><?php if ($this->ion_auth->is_admin()) { ?> | <a href="/api/remove/link/<?php echo $link['id']; ?>/refresh" data-toggle="tooltip" data-title="Are you sure?"><i class="fas fa-trash"></i></a><?php } ?></div>
											</div><!-- /CAS Embed -->
											<?php } ?>
										<?php } else { ?>
										<div class="col-lg-5 col-sm-8">
											<h3>Well shoot...</h3>
											<p>The site is constantly evolving and it appears we don't have of this type of item in the feed. Check out the latest <a href="/feed/video">videos</a>, <a href="/feed/html">webpages</a> or one of the other types of items we have!</p>
										</div>
										<?php } ?>
									</div>

							</div>
							<div class="col-sm-4">
								<div class="subtitle">Types</div>
								<p><br></p>
								<ul class="article-home asidelist">
									<li><li><a class="" href="/feed/html"><i class="fas fa-globe"></i><span>Websites</span></a></li>
									<li><a class="" href="/feed/video"><i class="fas fa-television"></i><span>Videos</span></a></li>
									<li><a class="" href="/feed/book"><i class="fas fa-book"></i><span>Books</span></a></li>
									<li><a class="" href="/feed/paper"><i class="fas fa-file"></i><span>Papers</span></a></li>
									<li><a class="" href="/feed/data"><i class="fas fa-pie-chart"></i><span>Data</span></a></li>
									<li><a class="" href="/feed/profile"><i class="fas fa-id-badge"></i><span>Profiles</span></a></li>
									<li><a class="" href="/feed/file"><i class="fas fa-newspaper-o"></i><span>Files</span></a></li>
									<li><a class="" href="/feed/other"><i class="fas fa-tree"></i><span>Other</span></a></li>
								</ul>
							</div>
						<!-- /Projects Row -->
					</div>
				</div>
				<div class="col-sm-1 vh-100 data">
				<!-- Data Column -->
					<div class="subtitle">Data</div>
					<div class="title">Now</div>
					<!-- blocks --
					<div class="data-lg"></div>
					<div class="data-md"></div>
					<div class="data-sm"></div>
					<div class="data-xs"></div>
					<?=round($weather['weather']['currently']['temperature'])?>
					<?=$weather['weather']['currently']['temperature']?>
					<!-- /blocks -->
					<div class="data-lg"><div class="floatinline"><img src="https://darksky.net/images/weather-icons/<?=$weather['weather']['currently']['icon']?>.png"></div> <?=round($weather['weather']['currently']['temperature'])?>&deg;F</div>
					<div class="data-sm mb-2"><strong><?php if (isset($weather['weather']['minutely'])) echo $weather['weather']['minutely']['summary']; ?></strong></div>
					<div class="data-sm"><?=$weather['weather']['currently']['precipProbability']?>% <?php echo (isset($weather['weather']['daily']['data'][0]['precipType'])) ? $weather['weather']['daily']['data'][0]['precipType']: "rain"; ?>&nbsp; &nbsp;<?=round($weather['weather']['currently']['windSpeed'])?>mph <span class="windarrow" style="display: inline-block; transform: rotateZ(<?=$weather['weather']['currently']['windBearing']?>deg);">&uarr;</span></div>
					<div class="data-sm">&uarr; <?=date('g:i a', $weather['weather']['daily']['data'][0]['sunriseTime'])?> &darr; <?=date('g:i a',$weather['weather']['daily']['data'][0]['sunsetTime'])?></div>
					<div class="data-sm mb-2"><i>in <?=$weather['city']?></i></div>
					<hr>
					<div class="subtitle">Today</div>
					<div class="data-md mb-2"><div class="floatinline"><img src="https://darksky.net/images/weather-icons/<?=$weather['weather']['daily']['data'][0]['icon']?>.png"></div><div class="floatinline"><?=round($weather['weather']['daily']['data'][0]['apparentTemperatureLow'])?>&deg;&rarr;<span><?=date('g:i a', $weather['weather']['daily']['data'][0]['apparentTemperatureLowTime'])?></span></div> <div class="floatinline"><strong><?=round($weather['weather']['daily']['data'][0]['apparentTemperatureHigh'])?>&deg;</strong><span><?=date('g:i a', $weather['weather']['daily']['data'][0]['apparentTemperatureHighTime'])?></span></div></div>
					<div class="data-sm"><?=$weather['weather']['daily']['data'][0]['summary']?></div>
					<hr>
					<div class="subtitle">Tomorrow</div>
					<div class="data-md mb-2"><div class="floatinline"><img src="https://darksky.net/images/weather-icons/<?=$weather['weather']['daily']['data'][1]['icon']?>.png"></div><div class="floatinline"><?=round($weather['weather']['daily']['data'][1]['apparentTemperatureLow'])?>&deg;&rarr;<span><?=date('g:i a', $weather['weather']['daily']['data'][1]['apparentTemperatureLowTime'])?></span></div> <div class="floatinline"><strong><?=round($weather['weather']['daily']['data'][1]['apparentTemperatureHigh'])?>&deg;</strong><span><?=date('g:i a', $weather['weather']['daily']['data'][1]['apparentTemperatureHighTime'])?></span></div></div>
					<div class="data-sm mb-2"><?=$weather['weather']['daily']['data'][1]['summary']?></div>
					<div class="data-sm">Data from DarkSky<br><a href="https://darksky.net/forecast/<?=$weather['lat']?>/<?=$weather['lon']?>/us12/en" target="_blank">Full Forecast &rarr;</a><br>

					<hr>
					<div class="subtitle">Sailing</div>
					<div class="data-sm"><?=$weather['weather']['currently']['precipProbability']?>% <?php echo (isset($weather['weather']['daily']['data'][0]['precipType'])) ? $weather['weather']['daily']['data'][0]['precipType']: "rain"; ?>, max at <?=date('g:i a', $weather['weather']['daily']['data'][0]['precipIntensityMaxTime'])?></div>
					<div class="data-sm"><span class="windarrow" style="display: inline-block; transform: rotateZ(<?=$weather['weather']['currently']['windBearing']?>deg);">&uarr;</span> <?=round($weather['weather']['currently']['windSpeed'])?>mph, <?=round($weather['weather']['daily']['data'][0]['windGust'])?> mph gusts<br>Highest winds at <?=date('g:i a', $weather['weather']['daily']['data'][0]['windGustTime'])?></div>
					<div class="data-sm"><a href="https://www.windfinder.com/#9/<?=$weather['lat']?>/<?=$weather['lon']?>" target="_blank">Windfinder &rarr;</a><br>
					
					<hr>
					<div class="subtitle">Tools</div>
					<div class="data-md"><div class="custom-control custom-switch">
					<input type="checkbox" class="custom-control-input" name="model[photorun]">
					<label class="custom-control-label data-sm" value="true" data-toggle="tooltip" data-title="error: API Error: Daily api call limit reached (1000)" for="model[photorun]">Tag Model (Down)</label>
					</div></div>
					<div class="data-md"><div class="custom-control custom-switch">
					<input type="checkbox" class="custom-control-input" checked name="cuzco[simpsonhouse][4]">
					<label class="custom-control-label data-sm" data-toggle="tooltip" data-title="Sign in to access tools" for="cuzco[simpsonhouse][4]">Front Door</label>
					</div></div>
					<div class="data-md"><div class="custom-control custom-switch">
					<input type="checkbox" class="custom-control-input" checked name="cuzco[simpsonhouse][12]">
					<label class="custom-control-label data-sm" data-toggle="tooltip" data-title="Sign in to access tools" for="cuzco[simpsonhouse][12]">Garage</label>
					</div></div>
					<div class="data-md"><div class="custom-control custom-switch">
					<input type="checkbox" class="custom-control-input" name="cuzco[simpsonhouse][2]">
					<label class="custom-control-label data-sm" data-toggle="tooltip" data-title="Sign in to access tools" for="cuzco[simpsonhouse][2]">Roomba</label>
					</div></div>

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
						<br>
						<hr>
						<div class="">
							<label for="payload[payload][project1]">Project</label>
							<select name="payload[payload][project1]" class="selectpicker form-control" data-width="100%" data-live-search="true" data-size="5">
								<?php // List definitions
								$list = $this->shared->list_bytype('definition');
								if ($list === false) { echo '<option disabled>No definitions to display.</option>'; } else {
								foreach ($list as $a) { $selected = ($a['id'] == $payload['project1']) ? ' selected' : ''; echo '<option value="'.$a['id'].'"'.$selected.'>'.$a['title']."</option>\n"; }} ?> 
							</select>
						</div>
						<div class="">
							<label for="payload[payload][article1]">Article 1</label>
							<select name="payload[payload][article1]" class="selectpicker form-control" data-width="100%" data-live-search="true" data-size="5">
								<?php // List definitions
								$list = $this->shared->list_bytype('definition');
								if ($list === false) { echo '<option disabled>No definitions to display.</option>'; } else {
								foreach ($list as $a) { $selected = ($a['id'] == $payload['article1']) ? ' selected' : ''; echo '<option value="'.$a['id'].'"'.$selected.'>'.$a['title']."</option>\n"; }} ?> 
							</select>
						</div>
						<div class="">
							<label for="payload[payload][article2]">Article 2</label>
							<select name="payload[payload][article2]" class="selectpicker form-control" data-width="100%" data-live-search="true" data-size="5">
								<?php // List definitions
								$list = $this->shared->list_bytype('definition');
								if ($list === false) { echo '<option disabled>No definitions to display.</option>'; } else {
								foreach ($list as $a) { $selected = ($a['id'] == $payload['article2']) ? ' selected' : ''; echo '<option value="'.$a['id'].'"'.$selected.'>'.$a['title']."</option>\n"; }} ?> 
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
