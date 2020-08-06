<!-- Field Notes section menu -->
				<div class="dropdown" style="display: inline-block;">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></a>
					<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
						<span class="dropdown-header">The feed is a curated collection of <br>articles, videos, books, people, <br>and links related to my interests in <br>the built environment and technology.</span>
						<a class="dropdown-item<?php if ($type == '') echo ' active'; ?>" href="/feed"><span>Everything &rarr;</span></a>
						<div class="dropdown-divider"></div>
						<a class="dropdown-item<?php if ($type == 'html') echo ' active'; ?>" href="/feed/html"><i class="<?=$_icon['html']?>"></i> <span>Websites</span></a>
						<a class="dropdown-item<?php if ($type == 'video') echo ' active'; ?>" href="/feed/video"><i class="<?=$_icon['video']?>"></i> <span>Videos</span></a>
						<a class="dropdown-item<?php if ($type == 'book') echo ' active'; ?>" href="/feed/book"><i class="<?=$_icon['book']?>"></i> <span>Books</span></a>
						<a class="dropdown-item<?php if ($type == 'paper') echo ' active'; ?>" href="/feed/paper"><i class="<?=$_icon['paper']?>"></i> <span>Papers</span></a>
						<a class="dropdown-item<?php if ($type == 'data') echo ' active'; ?>" href="/feed/data"><i class="<?=$_icon['data']?>"></i> <span>Data</span></a>
						<a class="dropdown-item<?php if ($type == 'file') echo ' active'; ?>" href="/feed/file"><i class="<?=$_icon['file']?>"></i> <span>Files</span></a>
						<a class="dropdown-item<?php if ($type == 'other') echo ' active'; ?>" href="/feed/other"><i class="<?=$_icon['other']?>"></i> <span>Other</span></a>
						<?php if ($this->ion_auth->logged_in()) { ?>
						<div class="dropdown-divider"></div>
						<span class="dropdown-header">Create New Content</span>
						<a class="dropdown-item" onclick="openeditor();"><i class="fas fa-book"></i> New Definition</a>
						<a class="dropdown-item" onclick="openeditor();"><i class="fas fa-box-open"></i> New Taxonomy (or collection)</a>
						<a class="dropdown-item" onclick="openeditor();"><i class="far fa-file"></i> New Page</a>
						<?php } ?> 
					</div>
				</div>
				<!-- /Field Notes menu -->