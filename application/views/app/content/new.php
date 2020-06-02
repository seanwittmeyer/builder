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
				<div class="col-md-5 text-right"></div>
				<header class="col-md-7">
					<div><h1>Let's add some content</h1></div>
					<div class="excerpt"><p>The easiest way to add pages and other content is on this page. Either set initial content or click create to get an untitled template.</p></div>
				</header>
			</div>
			<div class="row">
				<div class="col-md d-none d-lg-block"></div>
				<div class="col-md-5 col-lg-4 text-right ">
					<aside class="col-sm-10 float-right">
						<nav id="themenav" class="pilltabs">
							<ul class="nav nav-tabs" role="tablist">
								<li class="nav-item d-block" role="presentation"><a class="nav-link active" id="new-all-tab" data-toggle="tab" href="#newall" role="tab" aria-controls="newall" aria-selected="true"><i class="fas fa-plus"></i> Quick Create</a></li> 
								<li class="nav-item d-block" role="presentation"><a class="nav-link" id="new-tax-tab" data-toggle="tab" href="#newtax" role="tab" aria-controls="newtax" aria-selected="false"><i class="fas fa-th-large"></i> Theme/Collection</a></li> 
								<li class="nav-item d-block" role="presentation"><a class="nav-link" id="new-def-tab" data-toggle="tab" href="#newdef" role="tab" aria-controls="newdef" aria-selected="false"><i class="fas fa-scroll"></i> Article</a></li> 
								<li class="nav-item d-block" role="presentation"><a class="nav-link" id="new-page-tab" data-toggle="tab" href="#newpage" role="tab" aria-controls="newpage" aria-selected="false"><i class="far fa-file-alt"></i> Page</a></li> 
								<li class="nav-item d-block" role="presentation"><a class="nav-link" id="new-link-tab" data-toggle="tab" href="#newlink" role="tab" aria-controls="newlink" aria-selected="false"><i class="fas fa-link"></i> Link/Feed Item</a></li> 
							</ul>
						</nav>
					</aside>
				</div>
				<div class="col-md-7 col-lg-6">
					<div class="tab-content" id="">
						<div class="tab-pane fade show active" id="newall" role="tabpanel" aria-labelledby="new-all-tab">
							<div id="simplefail" class="alert alert-danger " style="display: none;" role="alert">Uh oh, potentially the slug was taken?</div>
							<div id="simplesuccess" class="alert alert-success " style="display: none;" role="alert">Done, loading.</div>
							<div id="simpleloading" class="alert alert-info progress-bar progress-bar-striped active" style="display: block; width: 100%; display: none;" role="alert">wait!...</div>
						<!-- new all -->
							<h2>Link for a Theme</h2>
							<form id="formlink" >
								<div class="input-group">
									<div class="input-group-prepend">
										<div class="input-group-text" aria-hidden="true" data-toggle="popover" data-trigger="hover" title="Creating Links"  data-content="Start by entering the URL for the website or element you want to embed/add to this page. When you are done, click go and we will get details which you can edit.">Link URI, start here... <i class="fas fa-info-circle"></i></div>
									</div>
									<input type="text" class="form-control" id="cas-link-uri" name="payload[uri]" placeholder="http://youtube.com/watch?v=123abc456">
									<div class="input-group-append">
										<button class="btn btn-outline-secondary" id="cas-link-embed-trigger" type="button">Load &darr;</button>
									</div>
								</div>
								<div class="form-group">
									<label class="">Preview</label>
									<a id="cas-link-embed-preview"></a>
								</div>
								<div class="form-label-group">
									<input type="text" class="form-control" id="cas-link-title" placeholder="Link Title" required="" autocomplete="off" name="payload[title]">
									<label for="payload[title]">Link Title</label>
								</div>
								<div class="form-label-group">
									<textarea class="form-control" id="cas-link-excerpt" name="payload[excerpt]" placeholder="Excerpt"></textarea>
									<label for="payload[excerpt]" class="">Excerpt</label>
								</div>
								<div class="form-label-group">
									<textarea class="form-control" id="cas-link-caption" name="payload[caption]" placeholder="Caption"></textarea>
									<label for="payload[caption]" class="">Caption</label>
								</div>
								<div class="form-label-group">
									<select id="cas-link-type" name="payload[type]" class="form-control">
										<option selected="selected" disabled="disabled">Link Type</option>
										<option value="html" selected="selected">Webpage</option>
										<option value="video">Video</option>
										<option value="file">File</option>
										<option value="paper">Paper</option>
										<option value="book">Book</option>
										<option value="profile">Profile</option>
										<option value="other">Other</option>
									</select>
									<label for="payload[type]" class="">Link Type</label>
								</div>
								<?php $themes = $this->shared->get_related('taxonomy','34'); 
								foreach ($themes as $i) { ?> 
								<div class="custom-control custom-radio">
									<input type="radio" id="tax-option-<?=$i['id']?>" name="payload[hostid]" value="<?=$i['id']?>" class="custom-control-input">
									<label class="custom-control-label" for="tax-option-<?=$i['id']?>"><?=$i['title']?></label>
								</div>
								<?php } ?>
								<div class="custom-control custom-radio">
									<input type="radio" id="tax-option-60" name="payload[hostid]" value="60" class="custom-control-input">
									<label class="custom-control-label" for="tax-option-60">General Technology</label>
								</div>
								<p style="clear: both;">&nbsp;</p>
								<input type="hidden" id="cas-link-hostid" name="payload[hosttype]" value="taxonomy" />
								<div id="linkfail" class="alert alert-danger " style="display: none;" role="alert">Uh oh, the link didn't save, make sure everything above is filled and try again.</div>
								<div id="linksuccess" class="alert alert-success " style="display: none;" role="alert">Great success, content posted.</div>
								<div id="linkloading" class="alert alert-info progress-bar progress-bar-striped active" style="display: block; width: 100%; display: none;" role="alert">dancing...</div>
								<div id="linkbuttons">
									<button type="button" class="btn btn-primary tt" id="submitlink" data-toggle="tooltip" title="This is ">Add Link!</button>
									<button type="reset" class="btn btn-default" >Reset</button>
								</div>
							</form>
							<hr style="clear: both;">&nbsp;</hr>
							
							
							<h2>Taxonomy, Collection, or Theme</h2>
							<form id="simpletax" class="input-group clearfix">
								<div class="input-group-prepend">
									<div class="input-group-text"><i class="fas fa-th-large"></i></div>
									<div class="input-group-text">https://seanwittmeyer.com/taxonomy/</div>
								</div>
								<input type="text" class="form-control" placeholder="choose a slug" name="slug">
								<input type="hidden" value="taxonomy" name="template">
								<div class="input-group-append">
									<button class="btn btn-outline-secondary" onclick="simple_create('#simpletax')" type="button">Add the taxonomy &rarr;</button>
								</div>
							</form>
							<p style="clear: both;">&nbsp;<br></p>
							
							
							<h2>Definition or Article</h2>
							<form class="input-group clearfix" id="simpledef">
							<div class="input-group-prepend">
								<div class="input-group-text"><i class="fas fa-scroll"></i></div>
								<div class="input-group-text">https://seanwittmeyer.com/article/</div>
							</div>
							<input type="text" class="form-control" placeholder="choose a slug" name="slug">
							<input type="hidden" value="definition" name="template">
							<div class="input-group-append">
								<button class="btn btn-outline-secondary" onclick="simple_create('#simpledef')" type="button">Add the definition &rarr;</button>
							</div>
							</form>
							<p style="clear: both;">&nbsp;</p>
							
							
							<h2>Page</h2>
							<form class="input-group" id="simplepage">
							<div class="input-group-prepend">
								<div class="input-group-text"><i class="far fa-file-alt"></i></div>
								<div class="input-group-text">https://seanwittmeyer.com/</div>
							</div>
							<input type="text" class="form-control" placeholder="choose a slug" name="slug">
							<input type="hidden" value="page" name="template">
							<div class="input-group-append">
								<button class="btn btn-outline-secondary" onclick="simple_create('#simplepage')" type="button">Add the page &rarr;</button>
							</div>
							</form>

						<!-- /new all -->
						</div>
						<div class="tab-pane fade" id="newtax" role="tabpanel" aria-labelledby="new-tax-tab">
						<!-- tax -->
						This feature hasn't been set up yet, use the quick create tool.
						<!-- /tax -->
						</div>
						<div class="tab-pane fade" id="newdef" role="tabpanel" aria-labelledby="new-def-tab">
						<!-- def -->
						This feature hasn't been set up yet, use the quick create tool.
						<!-- /def -->
						</div>
						<div class="tab-pane fade" id="newpage" role="tabpanel" aria-labelledby="new-page-tab">
						<!-- page -->
						This feature hasn't been set up yet, use the quick create tool.
						<!-- /page -->
						</div>
						<div class="tab-pane fade" id="newlink" role="tabpanel" aria-labelledby="new-link-tab">
						<!-- link -->
						Use the link tool on the page you want it shown on or create a link associated to one of the main themes on the Quick Create tab.
						<!-- /link -->
						</div>
					</div>
				</div>
				<div class="col-md d-none d-lg-block"></div>
			</div>
		</div>
	</article>
	<!-- /Article -->
	
	
	
	<?php if ($this->ion_auth->logged_in() && isset($loadjs['contenttools'])) { 
		//$this->load->view("helpers/contenttools");
		$this->load->view("helpers/editor-scripts");
	} ?> 
	<script>
	function simple_create(whichform) {
		$.ajax({
			type: "POST",
			beforeSend: function() {
				$('#simplebuttons').hide(); 
				$('#simplefail').hide(); 
				$('#simpleloading').show();
			},
			url: "/api/simplecreate",
			data: $(whichform).serialize(),
			statusCode: {
				200: function(data) {
					$('#simpleloading').hide(); 
					$('#simplesuccess').show();
					var response = JSON.parse(data); 
					$('#simplebuttons').show(); 
					//alert(response.result.url);
					window.location.assign(response.result.url);
				},
				403: function(data) {
					//var response = JSON.parse(data);
					$('#simpleloading').hide(); 
					$('#simplefail').show();
					$('#simplebuttons').show(); 
				},
				404: function(data) {
					//var response = JSON.parse(data);
					$('#simpleloading').hide(); 
					$('#simplefail').show();
					$('#simplebuttons').show(); 
				}
			}
		});
	}
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
