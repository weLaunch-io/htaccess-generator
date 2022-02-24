		<footer id="footer" class="footer row">
			<div id="footerText" class="col-lg-12 col-lg-sm-12 col-lg-lg-12">
				<hr class="grey">
				<p>DB-Dzine | Support: <a href="mailto:contact@db-dzine.de">contact@db-dzine.de</a> | <a target="_blank" href="#">Buy script</a></p>
			</div>
		</footer>
	</div>

	<!-- Libs -->
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script>window.jQuery || document.write('jQuery not loaded');
		var <?php echo $csrf_key; ?> = '<?php echo $csrf_token; ?>';

	</script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.5/js/bootstrap.min.js"></script>

	<script src="//cdnjs.cloudflare.com/ajax/libs/zeroclipboard/2.2.0/ZeroClipboard.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/pnotify/2.0.0/pnotify.all.min.js"></script>
	
	<script src="//cdnjs.cloudflare.com/ajax/libs/jQuery-Validation-Engine/2.6.4/jquery.validationEngine.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/jQuery-Validation-Engine/2.6.4/languages/jquery.validationEngine-<?= substr($lang, 0, 2) ?>.js"></script>

	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery.form/3.51/jquery.form.min.js"></script>

	<!-- Scripts -->
	<script src="assets/js/plugins.js"></script>
	<script src="assets/js/script.js"></script>

	</body>
</html>