<!-- Projects section menu -->

<div class="dropdown" style="display: inline-block;">
	<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></a>
	<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
		<span class="dropdown-header">A simple collection of projects</span>
		<a class="dropdown-item" href="/projects">Projects Index - Start here</a>
		<div class="dropdown-divider"></div>
		<span class="dropdown-header">By scale</span>
		<a class="dropdown-item" href="/collection/urban">Urban and Master Planning</a>
		<a class="dropdown-item" href="/collection/large">Large Scale Architecture</a>
		<a class="dropdown-item" href="/collection/small">Small Scale / Design Build</a>
		<!--<a class="dropdown-item" href="/collection/theory">Theory</a>-->
		<span class="dropdown-header">Digital Work</span>
		<a class="dropdown-item" href="/collection/web">Web Design &amp; Development</a>
		<?php if ($this->ion_auth->logged_in()) { ?>
		<div class="dropdown-divider"></div>
		<span class="dropdown-header">Manage This Page</span>
		<a class="dropdown-item" onclick="openeditor();">Edit this Page</a>
		<div class="dropdown-divider"></div>
		<a class="dropdown-item" href="/pages">View all Pages</a>
		<a class="dropdown-item" href="/taxonomy">View all Taxonomy/Categories/Collections</a>
		<a class="dropdown-item" href="/definition">View all Definitions/People/Terms</a>
		<?php } ?> 
	</div>
</div>

<!-- /Projects menu -->