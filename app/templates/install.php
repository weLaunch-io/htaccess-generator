<? include('head.php'); ?>
<? include('header.php'); ?>

		<div id="main" class="row">
			<? include('message.php'); ?>
			<div class="col-sm-12">
				<form id="install" action="<?= $langPath ?>/install/" method="POST" novalidate>
					<input type="hidden" name="<?php echo $csrf_key; ?>" value="<?= $csrf_token; ?>">
					<fieldset>
						<legend><?= _('Install') ?></legend>
						<div class="row">
							<div class="form-group col-sm-6">
						      <label for="password"><?= _('Password') ?></label>
						      <input name="password" type="password" class="form-control validate[required]" required>
						    </div>
							<div class="form-group col-sm-6">
						      <label for="passwordRepeat"><?= _('Password Repeat') ?></label>
						      <input name="passwordRepeat" type="password" class="form-control validate[required]" required>
						    </div>
				    	</div>

						<legend><?= _('Database') ?></legend>
						<div class="row">
							<div class="form-group col-sm-4">
						      <label for="host"><?= _('Host') ?></label>
						      <input name="host" type="text" class="form-control validate[required]" value="localhost" required>
						    </div>
							<div class="form-group col-sm-4">
						      <label for="basename"><?= _('Basename') ?></label>
						      <input name="basename" type="text" class="form-control validate[required]" required>
						    </div>
							<div class="form-group col-sm-4">
						      <label for="port"><?= _('Port (leave empty for default 3306)') ?></label>
						      <input name="port" type="text" class="form-control validate[required]" required>
						    </div>
				    	</div>
						<div class="row">
							<div class="form-group col-sm-6">
						      <label for="user"><?= _('User') ?></label>
						      <input name="user" type="text" class="form-control validate[required]" required>
						    </div>
							<div class="form-group col-sm-6">
						      <label for="dbpassword"><?= _('Password') ?></label>
						      <input name="dbpassword" type="text" class="form-control validate[required]" required>
						    </div>
				    	</div>
						<div class="row">
							<div class="form-group col-lg-12">
								<button class="btn btn-primary pull-right" type="submit"><?= _('Install') ?> <i class="icon-terminal icon-white"></i></button>
							</div>
						</div>
					</fieldset>
				</form>
			</div>
		</div>

<? include('footer.php'); ?>