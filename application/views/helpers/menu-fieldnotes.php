<!-- Field Notes section menu -->

<div class="dropdown" style="display: inline-block;">
	<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></a>
	<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
		<span class="dropdown-header">Field Notes, a blog on the built environment</span>
		<a class="dropdown-item" href="/fieldnotes">Index - Start here</a>
		<a class="dropdown-item" href="/primers">Primers - Quick deep dives</a>
		<a class="dropdown-item" href="/feed/books">The Feed - What I'm reading</a>
		<div class="dropdown-divider"></div>
		<span class="dropdown-header">General Themes</span>
		<?php foreach ($this->shared->get_related('taxonomy','34') as $i) { ?><a class="dropdown-item" href="/theme/<?php echo $i['slug']; ?>"><?php echo $i['title']; ?></a><?php } ?> 
		<?php if ($this->ion_auth->logged_in()) { ?>
		<div class="dropdown-divider"></div>
		<span class="dropdown-header">Manage This Page</span>
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
		<?php } ?> 
	</div>
</div>

<!-- /Field Notes menu -->