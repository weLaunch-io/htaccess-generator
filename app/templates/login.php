<? include('head.php'); ?>
<? include('header.php'); ?>

		<div id="main" class="row">
			<? include('message.php'); ?>
			<div class="col-sm-12">
				<form id="login" action="<?= $langPath ?>/login/" method="POST" novalidate>
					<input type="hidden" name="<?php echo $csrf_key; ?>" value="<?= $csrf_token; ?>">
					<fieldset>
						<legend><?= _('Login') ?></legend>
						<div class="row">
							<div class="form-group col-sm-12">
						      <label for="password"><?= _('Password') ?></label>
						      <input name="password" type="password" class="form-control validate[required]" required>
						    </div>
				    	</div>
						<div class="row">
							<div class="form-group col-lg-12">
								<button class="btn btn-primary pull-right" type="submit"><?= _('Login') ?> <i class="icon-terminal icon-white"></i></button>
							</div>
						</div>
					</fieldset>
				</form>
			</div>
		</div>

<? include('footer.php'); ?>