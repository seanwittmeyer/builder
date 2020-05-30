<!-- Main nav tabs in the bottom left corner -->
<nav id="mainnav" class="<?php if (isset($navfullwidth)) echo 'fullwidth'; ?>">
	<a href="/" id="title">Sean Wittmeyer</a>&nbsp;
	<div class="dropup" style="display: inline-block;">
		<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></a>
		<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
			<span class="dropdown-header">Hi, this is Builder, my personal playground <br>for projects, thoughts, and tinkering <br>on the web.</span>
			<?php if ($this->ion_auth->logged_in()) { ?>
			<div class="dropdown-divider"></div>
			<span class="dropdown-header">Hey <?php $user = $this->ion_auth->user()->row(); echo $user->first_name; ?>, feel free to edit and add <br />to the site with these tools</span>
			<span class="dropdown-header">Manage This Page</span>
			<a class="dropdown-item" data-toggle="modal" data-target="#pageeditor">Old Page Editor</a>
			<a class="dropdown-item" onclick="openeditor();">Edit this Page</a>
			<?php if (isset($id)) { ?><a class="dropdown-item" data-toggle="modal" data-target="#createlink" href="#"><span class="glyphicon glyphicon-facetime-video" aria-hidden="true"></span> Add a feed item</a><?php } ?>
			<span class="dropdown-header">Create New Content</span>
			<a class="dropdown-item" data-toggle="modal" data-target="#createdefinition"><span class="glyphicon glyphicon-book" aria-hidden="true"></span> New Definition</a>
			<a class="dropdown-item" data-toggle="modal" data-target="#createtaxonomy" href="#"><span class="glyphicon glyphicon-link" aria-hidden="true"></span> New Taxonomy (or collection)</a>
			<a class="dropdown-item" data-toggle="modal" data-target="#createpage" href="#"><span class="glyphicon glyphicon-file" aria-hidden="true"></span> New Page</a>
			<div class="dropdown-divider"></div>
			<span class="dropdown-header">Content Pages</span>
			<a class="dropdown-item" href="/topic/principles">Governing Principles</a>
			<a class="dropdown-item" href="/topic/key-concepts">Key Concepts</a>
			<a class="dropdown-item" href="/topic/terms">Terms</a>
			<a class="dropdown-item" href="/topic/key-thinkers">Key Thinkers</a>
			<div class="dropdown-divider"></div>
			<a class="dropdown-item" href="/pages">View all Pages</a>
			<a class="dropdown-item" href="/taxonomy">View all Taxonomy/Categories/Collections</a>
			<a class="dropdown-item" href="/definition">View all Definitions/People/Terms</a>
			<div class="dropdown-divider"></div>
			<span class="dropdown-header">Platform Management</span>
			<a class="dropdown-item" href="/auth">User Administration</a>
			<a class="dropdown-item" href="/admin">Site Administration</a>
			<a class="dropdown-item" href="/help">Help and Change Log</a>
			<a class="dropdown-item" href="/auth/logout" onclick="$(this).text(\'See ya later...\');">I'm done, Sign Out &rarr;</a>
			<?php } else { ?>
			<span class="dropdown-header">Builder has a number of interactive <br> elements across the site you can access <br> by signing in. You will need to reach out <br>for an account.</span>
			<a href="/auth/facebook" class="btn btn-sm btn-warning" onclick="$(this).text('signing you in...');">Sign in via Facebook &rarr;</a>
			<a href="/auth/saml/login/" class="btn btn-sm btn-warning" onclick="$(this).text('signing you in...');">Sign in via SAML &rarr;</a>
        	<a href="/auth/login" class="btn btn-sm btn-none">Sign in with Email/Pass &rarr;</a>
			<?php } ?> 
		</div>
	</div>
	<ul class="nav nav-tabs" id="mainnavtabs" role="tablist">
		<li class="nav-item" role="presentation">
			<a class="nav-link<?php $section = (isset($section)) ? $section: array('',''); if ($section[0] == 'projects') echo ' active'; ?>" href="//sean.wittmeyer.io/">Projects</a>
			<!--<a class="nav-link" id="nav-projects-tab" data-toggle="tab" href="#projects" role="tab" aria-controls="home" aria-selected="true">Projects</a>-->
		</li>
		<li class="nav-item" role="presentation">
			<a class="nav-link<?php if ($section[0] == 'notes') echo ' active'; ?>" id="nav-fieldnotes-tab" data-toggle="tab" href="#fieldnotes" role="tab" aria-controls="profile" aria-selected="false">Field Notes</a>
		</li>
		<li class="nav-item" role="presentation">
			<a class="nav-link<?php if ($section[0] == 'pylos') echo ' active'; ?>" id="nav-pylos-tab" data-toggle="tab" href="#pylos" role="tab" aria-controls="profile" aria-selected="false">Pylos</a>
		</li>
		<li class="nav-item" role="presentation">
			<a class="nav-link<?php if ($section[0] == 'feed') echo ' active'; ?>" id="nav-feed-tab" data-toggle="tab" href="#feed" role="tab" aria-controls="profile" aria-selected="false">Feed</a>
		</li>
		<li class="nav-item" role="presentation">
			<a class="nav-link<?php if ($section[0] == 'playground') echo ' active'; ?>" id="nav-playground-tab" data-toggle="tab" href="#playground" role="tab" aria-controls="contact" aria-selected="false">Playground</a>
		</li>
	</ul>
	<div class="tab-content" id="mainnavpanes">
		<div class="tab-pane fade<?php if (!in_array($section[0],array('projects','notes','pylos','feed','playground'))) echo ' show active'; ?>" id="home" role="tabpanel" aria-labelledby="nav-home-tab">
			<ul>
				<li><a href="/resume">Resume &nearr;</a></li>
				<li><a href="//sean.wittmeyer.io/">Portfolio &nearr;</a></li>
				<li><a href="https://sean.wittmeyer.io/contact-form">Contact</a></li>
			</ul>
		</div>
		<div class="tab-pane fade<?php if ($section[0] == 'projects') echo ' show active'; ?>" id="projects" role="tabpanel" aria-labelledby="nav-projects-tab">
			<ul>
				<li><a href="/projects/architecture">Architecture</a></li>
				<li><a href="/projects/designbuild">Design Build</a></li>
				<li><a href="/projects/theoretical">Theoretical</a></li>
				<li><a href="/projects/digital">Digital</a></li>
				<li><a href="//sean.wittmeyer.io">Portfolio &nearr;</a></li>
				<li><a href="/resume">Resume &nearr;</a></li>
			</ul>
		</div>
		<div class="tab-pane fade<?php if ($section[0] == 'notes') echo ' show active'; ?>" id="fieldnotes" role="tabpanel" aria-labelledby="nav-fieldnotes-tab">
			<ul>
				<li><a  <?php if ($section[0] == 'notes' && $section[1] == 'notes') echo 'class="active" '; ?>href="/notes">Field Notes</a></li>
				<li class="dropup"><a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Themes</a>
					<div class="dropdown-menu" aria-labelledby="">
						<span class="dropdown-header">General Themes</span>
						<div class="dropdown-divider"></div>
						<?php foreach ($this->shared->get_related('taxonomy','34') as $i) { ?><a class="dropdown-item" href="/theme/<?php echo $i['slug']; ?>"><?php echo $i['title']; ?></a><?php } ?> 
					</div>
				</li>
				<li><a <?php if ($section[0] == 'notes' && $section[1] == 'observations') echo 'class="active" '; ?>href="/notes/observations">Observations</a></li>
				<li><a <?php if ($section[0] == 'notes' && $section[1] == 'ideas') echo 'class="active" '; ?>href="/notes/ideas">Ideas</a></li>
				<li><a <?php if ($section[0] == 'notes' && $section[1] == 'articles') echo 'class="active" '; ?>href="/notes/articles">Articles</a></li>
			</ul>
		</div>
		<div class="tab-pane fade<?php if ($section[0] == 'pylos') echo ' show active'; ?>" id="pylos" role="tabpanel" aria-labelledby="nav-pylos-tab">
			<ul>
				<li><a <?php if ($section[0] == 'pylos' && $section[1] == 'index') echo 'class="active" '; ?>href="/pylos">Pylos</a></li>
				<li><a <?php if ($section[0] == 'pylos' && $section[1] == 'strategies') echo 'class="active" '; ?>href="/pylos/strategies">Strategies</a></li>
				<li><a <?php if ($section[0] == 'pylos' && $section[1] == 'themes') echo 'class="active" '; ?>href="/pylos/themes">Themes</a></li>
				<li><a <?php if ($section[0] == 'pylos' && $section[1] == 'resources') echo 'class="active" '; ?>href="/pylos/blocks">Resources</a></li>
				<li><a <?php if ($section[0] == 'pylos' && $section[1] == 'tools') echo 'class="active" '; ?>href="/pylos/tools">Tools</a></li>
			</ul>
		</div>
		<div class="tab-pane fade<?php if ($section[0] == 'feed') echo ' show active'; ?>" id="feed" role="tabpanel" aria-labelledby="nav-feed-tab">
			<ul>
				<li><a <?php if ($section[0] == 'feed' && $section[1] == 'video') echo 'class="active" '; ?>href="/feed/video">Videos</a></li>
				<li><a <?php if ($section[0] == 'feed' && $section[1] == 'html') echo 'class="active" '; ?>href="/feed/html">Webpages</a></li>
				<li><a <?php if ($section[0] == 'feed' && $section[1] == 'paper') echo 'class="active" '; ?>href="/feed/paper">Papers</a></li>
				<li><a <?php if ($section[0] == 'feed' && $section[1] == 'book') echo 'class="active" '; ?>href="/feed/book">Books</a></li>
				<li><a <?php if ($section[0] == 'feed' && $section[1] == 'profile') echo 'class="active" '; ?>href="/feed/profile">Profiles</a></li>
				<li><a <?php if ($section[0] == 'feed' && $section[1] == 'other') echo 'class="active" '; ?>href="/feed/other">Other</a></li>
			</ul>
		</div>
		<div class="tab-pane fade<?php if ($section[0] == 'playground') echo ' show active'; ?>" id="playground" role="tabpanel" aria-labelledby="nav-playground-tab">
			<ul>
				<li><a <?php if ($section[0] == 'playground' && $section[1] == 'ski') echo 'class="active" '; ?>href="/ski">Ski</a></li>
				<li><a <?php if ($section[0] == 'playground' && $section[1] == 'trains') echo 'class="active" '; ?>href="/trains">Trains</a></li>
				<li><a <?php if ($section[0] == 'playground' && $section[1] == 'football') echo 'class="active" '; ?>href="/football">Football</a></li>
				<li><a href="https://sean.wittmeyer.io/contact-form">Contact</a></li>
			</ul>
		</div>
	</div>
</nav>
<!-- /main nav -->
