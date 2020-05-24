<!-- Edit Content -->
	<script>
	$('#pageeditor').on('shown.bs.modal', function () {
		$('.cas-summernote').summernote({
		  toolbar: [
			// [groupName, [list of button]]
			['style', ['style']],
			['simple', ['bold', 'italic', 'underline', 'clear']],
			['para', ['ul', 'ol', 'paragraph']],
			['link', ['linkDialogShow']],
			['code', ['codeview']],
			['fullscreen', ['fullscreen']],
		  ],
		});
		$('.note-editable.panel-body').attr("spellcheck","true");
	})
	$('#pageupload').on('shown.bs.modal', function () {
		$("#cas-tax-file").fileinput({
			uploadAsync: false,
			url: "/api/uploadimage", // remove X or it wont work...
			uploadExtraData: function() {
				return {
					id: '<?=$id?>',
					type: '<?=$type?>'
				};
			}
		});
	});
	$('#cas-tax-file').fileinput({
		uploadUrl: "/api/uploadimage", // server upload action
		uploadAsync: true,
		showUpload: false, // hide upload button
		showRemove: false, // hide remove button
		minFileCount: 1,
		maxFileCount: 1
	}).on("filebatchselected", function(event, files) {
		// trigger upload method immediately after files are selected
		$('#cas-tax-file').fileinput("upload");
	}).on('fileuploaded', function(event, data, previewId, index) {
		var form = data.form, files = data.files, extra = data.extra,
			response = data.response, reader = data.reader;
		console.log(response.filename + ' has been uploaded');
		$('#imgheader').css('background-image','url('+response.filename+')');
		$('#cas-tax-fileurl').val(response.filename);
	});
	$('#submiteditor').click(function() {
		$.ajax({
			type: "POST",
			beforeSend: function() {
				$('#editorbuttons').hide(); 
				$('#editorfail').hide(); 
				$('#editorloading').show();
			},
			url: "/api/update/<?=$type?>/<?=$id?>",
			data: $("#formeditor").serialize(),
			statusCode: {
				200: function(data) {
					$('#editorloading').hide(); 
					$('#editorsuccess').show();
					var response = JSON.parse(data); 
					$('#editorbuttons').show(); 
					//alert('updated 202');
					window.location.reload();
				},
				403: function(data) {
					//var response = JSON.parse(data);
					$('#editorloading').hide(); 
					$('#editorfail').show();
					$('#editorbuttons').show(); 
				},
				404: function(data) {
					//var response = JSON.parse(data);
					$('#editorloading').hide(); 
					$('#editorfail').show();
					$('#editorbuttons').show(); 
				}
			}
		});
	});
	$('#submitupload').click(function() {
		$.ajax({
			type: "POST",
			beforeSend: function() {
				$('#uploadbuttons').hide(); 
				$('#uploadfail').hide(); 
				$('#uploadloading').show();
			},
			url: "/api/update/<?=$type?>/<?=$id?>/header", 
			data: $("#formupload").serialize(),
			statusCode: {
				200: function(data) {
					$('#uploadloading').hide(); 
					$('#uploadsuccess').show();
					var response = JSON.parse(data); 
					$('#uploadbuttons').show(); 
					window.location.reload();
				},
				403: function(data) {
					//var response = JSON.parse(data);
					$('#uploadloading').hide(); 
					$('#uploadfail').show();
					$('#uploadbuttons').show(); 
				},
				404: function(data) {
					//var response = JSON.parse(data);
					$('#uploadloading').hide(); 
					$('#uploadfail').show();
					$('#uploadbuttons').show(); 
				}
			}
		});
	});
</script>

<!-- /Edit content -->