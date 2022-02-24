	<!--[if lt IE 7]>
		<p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
	<![endif]-->

	<div id="site" class="site container">
		<header id="header" class="header row">
			<div id="logo" class="col-sm-5">
				<h1><?= _('htaccess Generator') ?></h1>
			</div>
			<div class="form-group col-sm-3 pull-right">
				<select name="language" class="form-control bfh-languages">
				<? foreach($availableLangs as $availableLang) {
					$lang == $availableLang ? $active = "selected" : $active = "";
					echo '<option value="'.$availableLang.'" '.$active.'>'.$availableLang.'</option>';
				} ?>
				</select>
			</div>
		</header><!-- end header -->