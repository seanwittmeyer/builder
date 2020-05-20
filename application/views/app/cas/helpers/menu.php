<div class="site-menu" style="display: none;">
	<div class="row">
			<div class="col-sm-5 col-md-5 col-lg-4">
			<div class="row">
				<div class="col-xs-5">
					<ul class="site-nav-pills" role="tablist">
						<li role="presentation" class=""><a href="#menu-start" aria-controls="menu-start" role="tab" data-toggle="tab" aria-expanded="false">Start Here</a></li>
						<li role="presentation" class=""><a href="#menu-search" aria-controls="menu-search" role="tab" data-toggle="tab" aria-expanded="false">Search</a></li>
						<li role="presentation" class="active"><a href="#menu-map" aria-controls="menu-map" role="tab" data-toggle="tab" aria-expanded="false">Complexity Cartograph</a></li>
						<li role="presentation" class=""><a href="#menu-urbanism" aria-controls="menu-urbanism" role="tab" data-toggle="tab" aria-expanded="false">Complexity &amp; Urbanism</a></li>
						<li role="presentation" class=""><a href="#menu-peopleterms" aria-controls="menu-peopleterms" role="tab" data-toggle="tab" aria-expanded="false">People &amp; Terms</a></li>
						<li role="presentation" class=""><a href="#menu-feeds" aria-controls="menu-feeds" role="tab" data-toggle="tab" aria-expanded="false">The Feed</a></li>
						<li role="presentation" class=""><a href="#menu-interactives" aria-controls="menu-interactives" role="tab" data-toggle="tab" aria-expanded="false">Interactive</a></li>
						<hr />
						<li role="presentation" class=""><a href="#menu-about" aria-controls="menu-about" role="tab" data-toggle="tab" aria-expanded="false">About This Site</a></li>
						<?php if($this->ion_auth->logged_in()) { ?><li role="presentation" class=""><a href="#menu-admin" aria-controls="menu-admin" role="tab" data-toggle="tab" aria-expanded="false">Site Tools</a></li>
						<li><a href="/auth/logout" onclick="$(this).text('See ya later...');">Sign Out</a></li>
						<?php } else { ?><li role="presentation" class=""><a href="#menu-auth" aria-controls="menu-auth" role="tab" data-toggle="tab" aria-expanded="false">Sign In</a></li><?php } ?>
						
					</ul>
				</div>
				<div class="col-xs-7">
					<div class="tab-content site-nav-tabs">
						<!-- Tab - asdasd -->
						<div role="tabpanel" class="tab-pane fade" id="menu-start">
							<span class="site-nav-title">History of Complexity</span>
							<p>We continue by telling people that they can look into the history and learn more about the cartograph.
							<a href="/history" class="site-nav-link">History</a></p>
							<span class="site-nav-title">Governing Features</span>
							<p>Maybe a single sentence on the principles with a link to its page. <a href="/taxonomy" class="site-nav-link">Governing Feature</a>
							</p>

							<span class="site-nav-title">Urbanism Through the Lens of Complexity</span>
							<p>we continue with the shortest intro to the urban fields. <a href="/taxonomy/urbanism" class="site-nav-link">Urbanism</a></p>
						</div>
						<!-- /Tab -->
						<!-- Tab - asdasd -->
						<div role="tabpanel" class="tab-pane fade" id="menu-search">
							<span class="site-nav-title">Search the Site</span>
							<p>Quickly dive into complexity theory and how it can work with urbanism fields through search.</p>
							<!-- Nav tabs -->
							<ul class="nav nav-pills nav-stacked col-sm-3 glossary-filter" role="tablist">
								<?php $__s = 'terms'; ?> 
								<li class="nav-pill-search"><input type="search" class="form-control" id="glossarysearch" placeholder="search the glossary..."></li>
								<?php $n = 0; foreach ($cartograph[$__s]['children'] as $t) { ?> 
								<li role="presentation" class="glossary-filter-single <?php if ($n===0) { ?>active<?php } ?>"><a href="#terms-<?php echo $t['id']; ?>" aria-controls="terms-<?php echo $t['id']; ?>" role="tab" data-toggle="tab"><?php echo $t['title']; ?></a></li>
								<?php $n++; } ?> 
							</ul>
							
							<!-- Tab panes -->
							<div class="tab-content col-sm-9">
								<?php $n = 0; foreach ($cartograph[$__s]['children'] as $t) { ?> 
								<div role="tabpanel" class="tab-pane fade<?php if ($n===0) { ?> active in<?php } ?>" id="terms-<?php echo $t['id']; ?>">
									<h3><?php echo $t['title']; ?></h3>
									<div><?php echo $t['excerpt']; ?></div>
									<p><a href="/definition/<?php echo $t['slug']; ?>">Explore more about <?php echo $t['title']; ?> &rarr;</a></p>
								</div>
								<?php $n++; } ?> 
		
							</div>
							<div class="clear"></div>

						</div>
						<!-- /Tab -->
						<!-- Tab - asdasd -->
						<div role="tabpanel" class="tab-pane fade active in" id="menu-map">
							<span class="site-nav-title">Complexity Cartograph</span>
							<p>Complex Adaptive Systems theory provides a useful lens with which to understand various phenomena. <a href="/complexity" class="site-nav-link">Keep reading about Complexity</a></p>
							<div class="row">
								<div class="col-sm-12 col-lg-12">
									<?php $__s = 'principles'; ?> 
									<span class="site-nav-title"><a href="/taxonomy/<?php echo $cartograph[$__s]['parent']['slug']; ?>"><?php echo $cartograph[$__s]['title']; ?></a></span>
									<ul class="site-nav-list">
										<?php foreach ($cartograph[$__s]['children'] as $d) { ?>
										<li><a href="<?php echo "/{$d['type']}/{$d['slug']}"; ?>"><?php echo $d['title']; ?></a></li>
										<?php } ?> 
									</ul>
									<div class="clear"></div>
								</div>
								<div class="col-sm-12 col-lg-12">
									<?php $__s = 'concepts'; ?> 
									<span class="site-nav-title"><a href="/taxonomy/<?php echo $cartograph[$__s]['parent']['slug']; ?>"><?php echo $cartograph[$__s]['title']; ?></a></span>
									<ul class="site-nav-list">
										<?php foreach ($cartograph[$__s]['children'] as $d) { ?>
										<li><a href="<?php echo "/{$d['type']}/{$d['slug']}"; ?>"><?php echo $d['title']; ?></a></li>
										<?php } ?> 
									</ul>
									<div class="clear"></div>
								</div>
							</div>
							
						</div>
						<!-- /Tab -->
						<!-- Tab - asdasd -->
						<div role="tabpanel" class="tab-pane fade" id="menu-urbanism">
							<span class="site-nav-title">Urbanism</span>
							<p>Well this is some nice and text to help us with whatever this should be. <a href="/taxonomy/urbanism" class="site-nav-link">Keep reading about Urbanism</a></p>
							<?php $__s = 'fields'; ?> 
							<span class="site-nav-title"><a href="/taxonomy/<?php echo $cartograph[$__s]['parent']['slug']; ?>"><?php echo $cartograph[$__s]['title']; ?></a></span>
							<ul class="site-nav-list">
								<?php foreach ($cartograph[$__s]['children'] as $d) { ?>
								<li><a href="<?php echo "/{$d['type']}/{$d['slug']}"; ?>"><?php echo $d['title']; ?></a></li>
								<?php } ?> 
							</ul>
							<div class="clear"></div>
							
						</div>
						<!-- /Tab -->
						<!-- Tab - asdasd -->
						<div role="tabpanel" class="tab-pane fade" id="menu-peopleterms">
							<span class="site-nav-title">People</span>
							<p>We continue by telling people that they can look into the history and learn more about the cartograph.
							<a href="/taxonomy/key-thinkers" class="site-nav-link">People</a></p>
							<span class="site-nav-title">Terms</span>
							<p>Maybe a single sentence on the principles with a link to its page. <a href="/taxonomy/terms" class="site-nav-link">Terms</a>
							</p>
							<div class="row hide">
								<div class="col-sm-12 col-lg-12">
									<?php $__s = 'people'; ?> 
									<span class="site-nav-title"><a href="/taxonomy/<?php echo $cartograph[$__s]['parent']['slug']; ?>"><?php echo $cartograph[$__s]['title']; ?></a></span>
									<ul class="site-nav-list">
										<?php foreach ($cartograph[$__s]['children'] as $d) { ?>
										<li><a href="<?php echo "/{$d['type']}/{$d['slug']}"; ?>"><?php echo $d['title']; ?></a></li>
										<?php } ?> 
									</ul>
									<div class="clear"></div>
								</div>
								<div class="col-sm-12 col-lg-12">
									<?php $__s = 'terms'; ?> 
									<span class="site-nav-title"><a href="/taxonomy/<?php echo $cartograph[$__s]['parent']['slug']; ?>"><?php echo $cartograph[$__s]['title']; ?></a></span>
									<ul class="site-nav-list">
										<?php foreach ($cartograph[$__s]['children'] as $d) { ?>
										<li><a href="<?php echo "/{$d['type']}/{$d['slug']}"; ?>"><?php echo $d['title']; ?></a></li>
										<?php } ?> 
									</ul>
									<div class="clear"></div>
								</div>
							</div>
							
						</div>
						<!-- /Tab -->
						<!-- Tab - asdasd -->
						<div role="tabpanel" class="tab-pane fade" id="menu-feeds">
							<span class="site-nav-title">The Feed</span>
							<p>Navigating Complexity brings in a wealth of resources and related content associated to the topics and terms. You can see all of them sorted by type.</p>
							<ul class="site-nav-list">
								<li><a href="/feed/video">Videos</a></li>
								<li><a href="/feed/html">Webpages</a></li>
								<li><a href="/feed/file">Files</a></li>
								<li><a href="/feed/paper">Papers</a></li>
								<li><a href="/feed/book">Books</a></li>
								<li><a href="/feed/profile">Profiles</a></li>
								<li><a href="/feed/other">Other</a></li>
							</ul>
						</div>
						<!-- /Tab -->
						<!-- Tab - asdasd -->
						<div role="tabpanel" class="tab-pane fade" id="menu-interactives">
							<span class="site-nav-title">Crowdsourcing Diagrams</span>
							<p>The site features a system for the submission and evaluation of explanatory diagrams relating to a variety of CAS topics.
							<br><a href="/diagrams" class="site-nav-link">Crowdsourcing Diagrams</a></p>
							<span class="site-nav-title">Complexity Explorer</span>
							<p>A new way to explore the content in an interactive dashboard of all topics in this site.
							<br><a href="/explore" class="site-nav-link">Complexity Explorer</a></p>
						</div>
						<!-- /Tab -->
						<!-- Tab - asdasd -->
						<div role="tabpanel" class="tab-pane fade" id="menu-about">
							<span class="site-nav-title">Navigating Complexity</span>
							<p><i>Navigating Complexity</i> is a platform for learning about complex adaptive systems and how they apply to the built environment.</p>
							<span class="site-nav-title">The Author</span>
							<p>Sharon has been involved in complexity research for over 20 years, and is the developer of the overall website content and content structure. <a href="/about" class="site-nav-link">Learn more about Sharon</a></p>
							<span class="site-nav-title">Site Stewards</span>
							<p>Specific components of the site are generously managed by a Site Stewards, working to keep the content fresh and accurate. <a href="/stewards" class="site-nav-link">Site Stewards</a></p>
						</div>
						<!-- /Tab -->
						<?php if($this->ion_auth->logged_in()) { ?>
						<!-- Tab - asdasd -->
						<div role="tabpanel" class="tab-pane fade" id="menu-admin">
							<span class="site-nav-title">Administrative Tools</span>
							<p>Hey <?php $user = $this->ion_auth->user()->row(); echo $user->first_name; ?>, feel free to edit and add <br />to the site with these tools</p>
							<span class="site-nav-title">Manage This Page</span>
							<li><a data-toggle="modal" data-target="#pageeditor"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Edit this page</a></li>
							<li<?php if (!isset($id)) echo ' class="disabled"'; ?>><a <?php if (isset($id)) echo 'data-toggle="modal" data-target="#createlink" '; ?>href="#"><span class="glyphicon glyphicon-facetime-video" aria-hidden="true"></span> Add a feed item</a></li>
							<span class="site-nav-title">Create New Content</span>
							<ul class="site-nav-list">
								<li><a data-toggle="modal" data-target="#createdefinition"><span class="glyphicon glyphicon-book" aria-hidden="true"></span> New Definition</a></li>
								<li><a data-toggle="modal" data-target="#createtaxonomy" href="#"><span class="glyphicon glyphicon-link" aria-hidden="true"></span> New Taxonomy (or collection)</a></li>
								<li><a data-toggle="modal" data-target="#createpage" href="#"><span class="glyphicon glyphicon-file" aria-hidden="true"></span> New Page</a></li>
							</ul>
							<span class="site-nav-title">Content Pages</span>
							<ul class="site-nav-list">
								<li><a href="/topic/principles">Governing Principles</a></li>
								<li><a href="/topic/key-concepts">Key Concepts</a></li>
								<li><a href="/topic/terms">Terms</a></li>
								<li><a href="/topic/key-thinkers">Key Thinkers</a></li>
							</ul>
							<ul class="site-nav-list">
								<li><a href="/pages">View all Pages</a></li>
								<li><a href="/taxonomy">View all Taxonomy/Categories/Collections</a></li>
								<li><a href="/definition">View all Definitions/People/Terms</a></li>
							</ul>
							<span class="site-nav-title">Platform Management</span>
							<ul class="site-nav-list">
								<li><a href="/auth">User Administration</a></li>
								<li><a href="/admin">Site Administration</a></li>
								<li><a href="/help">Help and Change Log</a></li>
							</ul>
						</div>
						<!-- /Tab -->
						<?php } else { ?>
						<!-- Tab - asdasd -->
						<div role="tabpanel" class="tab-pane fade" id="menu-auth">
							<span class="site-nav-title">Engage with Navigating Complexity</span>
							<?php echo form_open("auth/login");?>
							<div class="panel panel-default">
								<div class="panel-body">
									<a href="/auth/facebook" class="btn btn-sm btn-primary btn-block" onclick="$(this).text('signing you in...');">Log in / Sign up with Facebook &rarr;</a> <br />
									<a href="/auth/saml/login/?return=<?php echo uri_string(); ?>" class="btn btn-sm btn-primary btn-block btn-disabled" onclick="$(this).text('signing you in...');">Log in with SAML/SSO &rarr;</a>
								</div>
							</div>
							<p>or...</p>
							<div class="panel panel-default">
								<div class="panel-body" style="font-size: 13px;">
									<label for="identity" class="sr-only">Email address</label>
									<input type="email" id="identity" name="identity" class="form-control" placeholder="Email address" required autofocus>
									<label for="inputPassword" class="sr-only">Password</label>
									<input type="password" name="password" class="form-control" placeholder="Password" required>
									<label><a href="/auth/forgot_password">Forgot your password?</a></label>
									<div class="checkbox">
										<label>
											<input type="checkbox" name="remember" value="1"> Remember me
										</label>
									</div>
									<div class="btn-group btn-block" role="group" aria-label="logincreateaccount">
										<button class="btn btn-sm btn-info btn-block" style="margin-top:0;" type="submit" data-loading-text="checking...">Log in &rarr;</button>
									</div>
								</div>
							</div>
							</form>
						</div>
						<!-- /Tab -->
						<?php } ?> 
					</div>
				</div>
			</div>
		</div>
		<div class="col-sm-6 col-md-7 col-lg-8">
			<?php $this->load->view('app/cas/helpers/cartograph',array('path'=>'/api/visualization/conversation/6')); ?>
		</div>
	</div>
	<div class="clear"></div>
</div>