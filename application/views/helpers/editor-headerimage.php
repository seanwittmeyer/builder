<!-- Start Header Image Editor Tab -->
<div class="editorheaderimgpreview" style="background-image: url('<?php echo (isset($img['header']) && !empty($img['header'])) ? $img['header']['url']: '/includes/test/assets/Moofushi_Kandu_fish.jpg'; ?>');"></div>
<form id="formupload" >
	<div class="form-label-group">
		<input type="text" class="form-control" placeholder="Page Title" required="" autocomplete="off" name="payload[img][header][caption]" value="<?php echo (isset($img['header']['caption'])) ? $img['header']['caption']: $title; ?>">
		<label for="payload[img][header][caption]">Image Caption</label>
		<p style="font-size: .7em;"><strong>Example:</strong> Underwater image of fish in Moofushi Kandu, Maldives, by Bruno de Giusti (via Wikimedia Commons)</p>
	</div>

	<div class="form-label-group">
		<input type="file" id="cas-tax-file" name="userfile" value="">
		<label for="payload[excerpt]">Image</label>
		<input type="hidden" id="cas-tax-fileurl" name="payload[img][header][url]" value="<?php echo (isset($img['header']) && !empty($img['header'])) ? $img['header']['url']: ''; ?>">
	</div>
	<br />
	<hr>
	<div id="uploadfail" class="alert alert-danger " style="display: none;" role="alert">Uh oh, the <?php echo $type; ?> didn't save, make sure everything above is filled and try again.</div>
	<div id="uploadsuccess" class="alert alert-success " style="display: none;" role="alert">Great success, content posted.</div>
	<div id="uploadloading" class="alert alert-info progress-bar progress-bar-striped active" style="display: block; width: 100%; display: none;" role="alert">working...</div>
	<div id="uploadbuttons" class="offcanvasbuttons">
		<button type="button" class="btn btn-primary tt" id="submitupload">Save</button>
		<button type="reset" class="btn btn-default" >Reset</button>
	</div>
</form>
<!-- End Header Image Editor Tab -->
