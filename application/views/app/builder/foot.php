<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?> 
	<?php if (isset($loadjs['embedly'])) { ?> 
	<!-- Format embedly content cards -->
	<script src="//cdn.embedly.com/widgets/platform.js"></script>
	<script src="//cdn.embed.ly/jquery.embedly-3.1.1.min.js"></script>
	<script>
		$.embedly.defaults.key = '74435e49e8fa468eb2602ea062017ceb';
		$('#cas-link-embed-trigger').click(function() {
			var originaluri = $('#cas-link-uri').val();
			$('#cas-link-embed-preview').attr("href", originaluri).text(originaluri);
			$('#cas-link-embed-preview').embedly({query: { maxwidth: '550' }});
			$.embedly.extract(originaluri).progress(function(data){
			  $('#cas-link-title').val(data.title);
			  $('#cas-link-excerpt').val(data.description);
			  $('#cas-link-uri').val(data.url);
			}).done(function(results){});
			return false;
		});
	</script>
	<!-- /embedly -->
	<?php } ?>
	
	<!-- Pagmap -->
	<script type="text/javascript">

	</script>
	<!-- /pagemap -->

	<!-- Make the site interactive -->
	<script type="text/javascript">
		/*$('#loginmodal').on('shown.bs.modal', function () {
			$('#identity').focus();
		})*/
		function postOrder() {
			$('#definitionbuttons').hide(); 
			$('#definitionloading').show();  
			$('#definitionloading').hide(); 
			$('#definitionsuccess').show();
		}
		<?php foreach (array('taxonomy','definition','page') as $type) { ?> 
		$('#create<?php echo $type; ?>').on('shown.bs.modal', function () {
			$('.cas-summernote').summernote({
			  toolbar: [
				['style', ['style']],
				['simple', ['bold', 'italic', 'underline', 'clear']],
				['para', ['ul', 'ol', 'paragraph']],
				['link', ['linkDialogShow']],
				['code', ['codeview']],
				['fullscreen', ['fullscreen']],
			  ],
			  placeholder: 'once upon a time...',
			});
		})
		<?php } foreach (array('taxonomy','definition','page','paper','link','relationship') as $type) { ?> 
		// New Content
		$('#submit<?php echo $type; ?>').click(function() {
			$.ajax({
				type: "POST",
				beforeSend: function() {
					<?php if ($type == 'definition') { ?> 
					<?php } ?> 
					$('#<?php echo $type; ?>buttons').hide(); 
					$('#<?php echo $type; ?>fail').hide(); 
					$('#<?php echo $type; ?>loading').show();
				},
				url: "/api/create/<?php echo $type; ?>",
				data: $("#form<?php echo $type; ?>").serialize(),
				statusCode: {
					200: function(data) {
						$('#<?php echo $type; ?>loading').hide(); 
						$('#<?php echo $type; ?>success').show();
						var response = JSON.parse(data);
						<?php echo ($type == 'link') ? "window.location.reload();" : "window.location.assign(response.result.url)"; ?> 
						$('#<?php echo $type; ?>buttons').show(); 
					},
					403: function(data) {
						//var response = JSON.parse(data);
						$('#<?php echo $type; ?>loading').hide(); 
						$('#<?php echo $type; ?>fail').show();
						$('#<?php echo $type; ?>buttons').show(); 
					},
					404: function(data) {
						//var response = JSON.parse(data);
						$('#<?php echo $type; ?>loading').hide(); 
						$('#<?php echo $type; ?>fail').show();
						$('#<?php echo $type; ?>buttons').show(); 
					}
				}
			});
		});
		<?php } ?>
	</script>	
	<!--<script>
	  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
	  ga('create', 'UA-336608-26', 'auto');
	  ga('send', 'pageview');
	</script>-->
</body>
</html>