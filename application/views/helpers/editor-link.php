<!-- New Link -->

<form id="formlink" >
	<div class="input-group">
		<div class="input-group-prepend">
			<div class="input-group-text" aria-hidden="true" data-toggle="popover" data-trigger="hover" title="Creating Links"  data-content="Start by entering the URL for the website or element you want to embed/add to this page. When you are done, click go and we will get details which you can edit.">URL</div>
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
			<option value="data">Data</option>
			<option value="other">Other</option>
		</select>
		<label for="payload[type]" class="">Link Type</label>
	</div>
	<input type="hidden" id="cas-link-hosttype" name="payload[hosttype]" value="<?=$type?>" />
	<input type="hidden" id="cas-link-hostid" name="payload[hostid]" value="<?=$id?>" />
	<div id="linkfail" class="alert alert-danger " style="display: none;" role="alert">Uh oh, the link didn't save, make sure everything above is filled and try again.</div>
	<div id="linksuccess" class="alert alert-success " style="display: none;" role="alert">Great success, content posted.</div>
	<div id="linkloading" class="alert alert-info progress-bar progress-bar-striped active" style="display: block; width: 100%; display: none;" role="alert">dancing...</div>
	<div id="linkbuttons float-left">
		<button type="button" class="btn btn-primary tt" id="submitlink" data-toggle="tooltip" title="This is ">Add Link!</button>
		<button type="reset" class="btn btn-default" >Reset</button>
	</div>
</form>


<!-- /New Link -->