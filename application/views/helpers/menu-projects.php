<!-- Projects section menu -->

<div class="dropdown" style="display: inline-block;">
	<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></a>
	<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
		<span class="dropdown-header">Recent academic and professional <br>projects and work</span>
		<a class="dropdown-item" href="/projects">Projects Index - Start here</a>
		<div class="dropdown-divider"></div>
		<span class="dropdown-header">By scale</span>
		<a class="dropdown-item" href="/projects?scale=urban">Urban and Master Planning</a>
		<a class="dropdown-item" href="/projects?scale=large">Large Scale Architecture</a>
		<a class="dropdown-item" href="/projects?scale=small">Small Scale / Design Build</a>
		<!--<a class="dropdown-item" href="/collection/theory">Theory</a>-->
		<span class="dropdown-header">Digital Work</span>
		<a class="dropdown-item" href="/projects?scale=web">Web Design &amp; Development</a>
		<?php if ($this->ion_auth->logged_in()) { ?>
		<div class="dropdown-divider"></div>
		<span class="dropdown-header">Manage This Page</span>
		<a class="dropdown-item" onclick="openeditor();">Edit this Page</a>
		<?php } ?> 
	</div>
</div>

<!-- /Projects menu -->