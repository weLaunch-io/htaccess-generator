
				<form id="htaccessForm" action="<?= $langPath ?>/" method="POST" novalidate>
					<input type="hidden" name="<?php echo $csrf_key; ?>" value="<?= $csrf_token; ?>">
					<!-- Nav tabs -->
					<ul class="nav nav-tabs" role="tablist">
						<li role="presentation" class="active"><a href="#general" aria-controls="general" role="tab" data-toggle="tab"><?= _('General') ?></a></li>
						<li role="presentation"><a href="#performance" aria-controls="performance" role="tab" data-toggle="tab"><?= _('Performance') ?></a></li>
						<li role="presentation"><a href="#protection" aria-controls="protection" role="tab" data-toggle="tab"><?= _('Password Protection') ?></a></li>
						<li role="presentation"><a href="#error-pages" aria-controls="error-pages" role="tab" data-toggle="tab"><?= _('Error Pages') ?></a></li>
						<li role="presentation"><a href="#security" aria-controls="security" role="tab" data-toggle="tab"><?= _('Security') ?></a></li>
						<li role="presentation"><a href="#rewrites" aria-controls="rewrites" role="tab" data-toggle="tab"><?= _('Rewrites') ?></a></li>
						<li role="presentation"><a href="#bad-robots" aria-controls="bad-robots" role="tab" data-toggle="tab"><?= _('Bad Robots') ?></a></li>
					</ul>

					<!-- Tab panes -->
					<div class="tab-content">
						<div role="tabpanel" class="tab-pane active" id="general">
							<fieldset>
								<legend><?= _('Show comments') ?></legend>
								<div class="row">
									<div class="form-group col-sm-6 col-xs-12">
										<label for="showComments"><?= _('Show comments in the .htaccess?') ?></label>
							     		<select name="showComments" id="showComments" class="form-control validate[required]">
							     			<option value="no"><?= _('No') ?></option>
							     			<option value="yes"><?= _('Yes') ?></option>
							     		</select>
						     		</div>
					     		</div>
								<legend><?= _('Cross origin requests') ?></legend>
								<div class="row">
									<div class="form-group col-sm-6 col-xs-12">
										<label for="crossOriginRequests">
											<?= _('Allow cross-origin requests') ?>
											<i data-toggle="popover" 
											title="<?= _('Allow cross-origin requests') ?>" 
											data-content="http://enable-cors.org/" 
											class="fa fa-lg fa-info-circle blue"></i>
										</label>
							     		<select name="crossOriginRequests" id="crossOriginRequests" class="form-control validate[required]">
							     			<option value="no"><?= _('No') ?></option>
							     			<option value="yes"><?= _('Yes') ?></option>
							     		</select>   
						     		</div>
									<div class="form-group col-sm-6 col-xs-12">
										<label for="crossOriginImages">
											<?= _('Allow cross-origin images') ?>
											<i data-toggle="popover" 
											title="<?= _('Allow cross-origin images') ?>" 
											data-content="<?= _('Send the CORS header for images when browsers request it.') ?>" 
											class="fa fa-lg fa-info-circle blue"></i>
										</label>
							     		<select name="crossOriginImages" id="crossOriginImages" class="form-control validate[required]">
							     			<option value="yes"><?= _('Yes') ?></option>
							     			<option value="no"><?= _('No') ?></option>
							     		</select>
						     		</div>
					     		</div>
								<div class="row">
									<div class="form-group col-sm-6 col-xs-12">
										<label for="crossOriginWebfonts">
											<?= _('Allow cross-origin web fonts') ?>
											<i data-toggle="popover" 
											title="<?= _('Allow cross-origin web fonts') ?>" 
											data-content="<?= _('Allow cross-origin access to web fonts.') ?>" 
											class="fa fa-lg fa-info-circle blue"></i>
										</label>
							     		<select name="crossOriginWebfonts" id="crossOriginWebfonts" class="form-control validate[required]">
							     			<option value="yes"><?= _('Yes') ?></option>
							     			<option value="no"><?= _('No') ?></option>
							     		</select>
						     		</div>
									<div class="form-group col-sm-6 col-xs-12">
										<label for="CrossOriginResourceTiming">
											<?= _('Allow Cross-origin resource timing') ?>
											<i data-toggle="popover" 
											title="<?= _('Allow Cross-origin resource timing') ?>" 
											data-content="<?= _('Allow cross-origin access to the timing information for all resources.') ?>" 
											class="fa fa-lg fa-info-circle blue"></i>
										</label>
							     		<select name="CrossOriginResourceTiming" id="CrossOriginResourceTiming" class="form-control validate[required]">
							     			<option value="no"><?= _('No') ?></option>
							     			<option value="yes"><?= _('Yes') ?></option>
							     		</select>
						     		</div>
					     		</div>
								<legend><?= _('Internet Explorer') ?></legend>
								<div class="row">
									<div class="form-group col-sm-6 col-xs-12">
										<label for="internetExplorer">
											<i data-toggle="popover" 
											title="IE highest mode" 
											data-content="<?= _('Starting with Internet Explorer 11, document modes are deprecated. If your business still relies on older web apps and services that were designed for older versions of Internet Explorer, you might want to consider enabling `Enterprise Mode` throughout your company.') ?>" 
											class="fa fa-lg fa-exclamation-triangle red"></i>
											<?= _('Render pages in the highest IE-mode?') ?>
										</label>
							     		<select name="internetExplorer" id="internetExplorer" class="form-control validate[required]">
							     			<option value="yes"><?= _('Yes') ?></option>
							     			<option value="no"><?= _('No') ?></option>
							     		</select>
						     		</div>
									<div class="form-group col-sm-6 col-xs-12"> 
										<label for="iframeCookies">
											<?= _('Allow IFrame cookies?') ?>
											<i data-toggle="popover" 
											title="Iframes cookies" 
											data-content="<?= _('Allow cookies to be set from iframes in Internet Explorer.') ?>" 
											class="fa fa-lg fa-info-circle blue"></i>
										</label>
							     		<select name="iframeCookies" id="iframeCookies" class="form-control validate[required]">
							     			<option value="no"><?= _('No') ?></option>
							     			<option value="yes"><?= _('Yes') ?></option>
							     		</select>
						     		</div>
					     		</div>
								<legend><?= _('Media types') ?></legend>
								<div class="row">
									<div class="form-group col-sm-6 col-xs-12">
										<label for="mediaTypes"><?= _('Serve resources with the proper media types (f.k.a. MIME types)?') ?></label>
							     		<select name="mediaTypes" id="mediaTypes" class="form-control validate[required]">
							     			<option value="yes"><?= _('Yes') ?></option>
							     			<option value="no"><?= _('No') ?></option>
							     		</select>
						     		</div>
					     		</div>
								<legend><?= _('Character encodings') ?></legend>
								<div class="row">
									<div class="form-group col-sm-6 col-xs-12">
										<label for="characterEncoding"><?= _('Serve `text/html` or `text/plain` with charset `UTF-8`?') ?></label>
							     		<select name="characterEncoding" id="characterEncoding" class="form-control validate[required]">
							     			<option value="yes"><?= _('Yes') ?></option>
							     			<option value="no"><?= _('No') ?></option>
							     		</select>
						     		</div>
									<div class="form-group col-sm-6 col-xs-12">
										<label for="characterEncodingFiles"><?= _('Serve <abbr data-toggle="popover" title="File types" data-content=".atom, .bbaw, .css, .geojson, .js, .json, .jsonld, .manifest, .rdf, .rss, .topojson, .vtt, .webapp, .webmanifest, .xloc, .x, "> data interchange file types</abbr> with charset `UTF-8`?') ?></label>
							     		<select name="characterEncodingFiles" id="characterEncodingFiles" class="form-control validate[required]">
							     			<option value="yes"><?= _('Yes') ?></option>
							     			<option value="no"><?= _('No') ?></option>
							     		</select>
						     		</div>
					     		</div>
							</fieldset>
						</div>
						<div role="performance" class="tab-pane" id="performance">
							<fieldset>
								<legend><?= _('Compression') ?></legend>
								<div class="row">
									<div class="form-group col-sm-6 col-xs-12">
										<label for="compression"><?= _('Enable compression?') ?></label>
							     		<select name="compression" id="compression" class="form-control validate[required]">
							     			<option default value="yes"><?= _('Yes') ?></option>
							     			<option value="no"><?= _('No') ?></option>
							     		</select>
						     		</div>
									<div class="form-group col-sm-6 col-xs-12">
										<label for="contentTransformation">
											<i data-toggle="popover" 
											title="Content transformation" 
											data-content="<?= _('If you are using `mod_pagespeed`, please note that setting the `Cache-Control: no-transform` response header will prevent `PageSpeed` from rewriting `HTML` files, and, if the `ModPagespeedDisableRewriteOnNoTransform` directive isn\'t set to `off`, also from rewriting other resources.') ?>"></i>
											<?= _('Enable content transformation') ?>
											<i data-toggle="popover" 
											title="Content transformation" 
											data-content="Prevent intermediate caches or proxies (e.g.: such as the ones used by mobile network providers) from modifying the website's content." 
											class="fa fa-lg fa-info-circle blue"></i>
										</label>
							     		<select name="contentTransformation" id="contentTransformation" class="form-control validate[required]">
							     			<option value="no"><?= _('No') ?></option>
							     			<option value="yes"><?= _('Yes') ?></option>
							     		</select>   
						     		</div>
					     		</div>
					     		<legend><?= _('Files') ?></legend>
					     		<div class="row">
									<div class="form-group col-sm-6 col-xs-12">
										<label for="fileConcatentation">
											<?= _('Enable file concatenation?') ?>
											<i data-toggle="popover" 
											title="<?= _('Enable file concatenation?') ?>" 
											data-content="<?= _('Allow concatenation from within specific files.<br/><br/>If you have the following lines in a file called, e.g. `main.combined.js`:<br/><br/>#include file=\'js/jquery.js\'<br/>#include file=\'js/jquery.timer.js\'<br/><br/>Apache will replace those lines with the content of the specified files.') ?>" 
											class="fa fa-lg fa-info-circle blue"></i>
										</label>
							     		<select name="fileConcatentation" id="fileConcatentation" class="form-control validate[required]">
							     			<option value="no"><?= _('No') ?></option>
							     			<option value="yes"><?= _('Yes') ?></option>
							     		</select>
						     		</div>
									<div class="form-group col-sm-6 col-xs-12">
										<label for="fileCacheBusting">
											<?= _('Enable filename-based cache busting') ?>
											<i data-toggle="popover" 
											title="Filename-based cache busting" 
											data-content="<?= _('If you\'re not using a build process to manage your filename version revving, you might want to consider enabling the following directives	to route all requests such as `/style.12345.css` to `/style.css`.') ?>" 
											class="fa fa-lg fa-info-circle blue"></i>
										</label>
							     		<select name="fileCacheBusting" id="fileCacheBusting" class="form-control validate[required]">
							     			<option value="no"><?= _('No') ?></option>
							     			<option value="yes"><?= _('Yes') ?></option>
							     		</select>   
						     		</div>
					     		</div>
								<legend><?= _('Expiration') ?></legend>
								<div class="row">
									<div class="form-group col-sm-6 col-xs-12">
										<label for="ETags">
											<?= _('Remove ETags') ?>
											<i data-toggle="popover" 
											title="<?= _('Remove ETags') ?>" 
											data-content="<?= _('Remove `ETags` as resources are sent with far-future expires headers.') ?>" 
											class="fa fa-lg fa-info-circle blue"></i>
										</label>
							     		<select name="ETags" id="ETags" class="form-control validate[required]">
							     			<option value="yes"><?= _('Yes') ?></option>
							     			<option value="no"><?= _('No') ?></option>
							     		</select>
						     		</div>
					     		</div>
					     		<div class="row">
									<div class="form-group col-sm-6 col-xs-12">
										<label for="expiresHeader">
											<i data-toggle="popover" 
											title="Content transformation" 
											data-content="<?= _('If you don\'t control versioning with filename-based cache busting, you should consider lowering the cache times to something like one week.') ?>"
											class="fa fa-lg fa-exclamation-triangle red"></i>
											<?= _('Enable expires headers?') ?>
											<i data-toggle="popover" 
											title="Expires headers" 
											data-content="Serve resources with far-future expires headers." 
											class="fa fa-lg fa-info-circle blue"></i>
										</label>
							     		<select name="expiresHeader" id="expiresHeader" class="form-control validate[required]">
							     			<option value="yes"><?= _('Yes') ?></option>
							     			<option value="no"><?= _('No') ?></option>
							     		</select>
						     		</div>
									<div class="form-group col-sm-6 col-xs-12">
										<label for="expiresDefault"><?= _('Expires Default') ?></label>
							     		<input name="expiresDefault" id="expiresDefault" class="form-control validate[required]" value="access plus 1 month" type="text">
						     		</div>
					     		</div>
					     		<legend><?= _('Custom type expiration') ?></legend>
								<div class="expirationRow row">
									<div class="form-group col-sm-6 col-xs-12">
										<label for="expireType[]"><?= _('Type') ?></label>
							     		<select name="expireType[]" id="expireType" class="form-control validate[required]">
							     				<option value=""><?= _('-- Select document type --') ?></option>
											<optgroup label="CSS">
												<option value="text/css">text/css</option>
											</optgroup>
											<optgroup label="Data interchange">
												<option value="application/atom+xml">application/atom+xml</option>
												<option value="application/rdf+xml">application/rdf+xml</option>
												<option value="application/rss+xml">application/rss+xml</option>
												<option value="application/json">application/json</option>
												<option value="application/ld+json">application/ld+json</option>
												<option value="application/schema+json">application/schema+json</option>
												<option value="application/vnd.geo+json">application/vnd.geo+json</option>
												<option value="application/xml">application/xml</option>
												<option value="text/xml">text/xml</option>
											</optgroup>
											<optgroup label="Favicon and cursor images">
												<option value="image/vnd.microsoft.icon">image/vnd.microsoft.icon</option>
												<option value="image/x-icon">image/x-icon</option>
											</optgroup>
											<optgroup label="HTML">
												<option value="text/html">text/html</option>
											</optgroup>
											<optgroup label="Javscript">
												<option value="application/javascript">application/javascript</option>
												<option value="application/x-javascript">application/x-javascript</option>
												<option value="text/javascript">text/javascript</option>
											</optgroup>
											<optgroup label="Manifest files">
												<option value="application/manifest+json">application/manifest+json</option>
												<option value="application/x-web-app-manifest+json">application/x-web-app-manifest+json</option>
												<option value="text/cache-manifest">text/cache-manifest</option>
											</optgroup>
											<optgroup label="Media files">
												<option value="audio/ogg">audio/ogg</option>
												<option value="image/bmp">image/bmp</option>
												<option value="image/gif">image/gif</option>
												<option value="image/jpeg">image/jpeg</option>
												<option value="image/png">image/png</option>
												<option value="image/svg+xml">image/svg+xml</option>
												<option value="image/webp">image/webp</option>
												<option value="video/mp4">video/mp4</option>
												<option value="video/ogg">video/ogg</option>
												<option value="video/webm">video/webm</option>
											</optgroup>
											<optgroup label="Web fonts">
												<option value="application/vnd.ms-fontobject">application/vnd.ms-fontobject</option>
												<option value="font/eot">font/eot</option>
												<option value="font/opentype">font/opentype</option>
												<option value="application/x-font-ttf">application/x-font-ttf</option>
												<option value="application/font-woff">application/font-woff</option>
												<option value="application/x-font-woff">application/x-font-woff</option>
												<option value="font/woff">font/woff</option>
												<option value="application/font-woff2">application/font-woff2</option>
											</optgroup>
											<optgroup label="Other">
												<option value="text/x-cross-domain-policy">text/x-cross-domain-policy</option>
											</optgroup>
							     		</select>
						     		</div>
									<div class="form-group col-sm-3 col-xs-12">
										<label for="expireTimeValue[]"><?= _('Expire time value') ?></label>
							     		<input type="number" name="expireTimeValue[]" id="expireTimeValue" class="form-control validate[required]">
						     		</div>
									<div class="form-group col-sm-3 col-xs-12">
										<label for="expireTime[]"><?= _('Expire time') ?></label>
							     		<select name="expireTime[]" id="expireTime" class="form-control validate[required]">
							     			<option value="second"><?= _('Second(s)') ?></option>
											<option value="hour"><?= _('Hour(s)') ?></option>
							     			<option value="week"><?= _('Week(s)') ?></option>
											<option value="month"><?= _('Month(s)') ?></option>
											<option value="year"><?= _('Year(s)') ?></option>
							     		</select>
						     		</div>
					     		</div>
								<div class="expirationPageControls row">
					     			<div class="form-group col-sm-6 col-xs-12">
					     				<button id="addExpiration" type="button" class="btn btn-success fw"><i class="fa fa-plus"></i> <?= _('Add Expiration') ?></button>
				     				</div>
									<div class="form-group col-sm-6 col-xs-12">
					     				<button id="removeExpiration" type="button" class="btn btn-danger fw"><i class="fa fa-minus"></i> <?= _('Remove last Expiration') ?></button>
				     				</div>
				     			</div>
							</fieldset>
						</div>
						<div role="protection" class="tab-pane" id="protection">
							<fieldset>
					     		<div class="row">
									<div class="form-group col-sm-6 col-xs-12">
										<label for="protection"><?= _('Enable directory protection?') ?></label>
							     		<select name="protection" id="protection" class="form-control validate[required]">
							     			<option value="no"><?= _('No') ?></option>
							     			<option value="yes"><?= _('Yes') ?></option>
							     		</select>
						     		</div>
					     		</div>
								<legend><?= _('Settings (.htaccess)') ?></legend>
								<div class="row">
									<div class="form-group col-sm-6 col-xs-12">
										<label for="protectionName"><?= _('<abbr title="Password protected Area">Name of the proteced area</abbr>') ?></label>
							     		<input type="text" name="protectionName" id="protectionName" class="form-control validate[required]">
						     		</div>
									<div class="form-group col-sm-6 col-xs-12">
										<label for="protectionPath"><?= _('<abbr title="e.g. .htpasswd">Path to the .htpasswd</abbr>') ?></label>
							     		<input type="text" name="protectionPath" id="protectionPath" class="form-control validate[required]">
						     		</div>
					     		</div>
								<legend><?= _('Login (.htpasswd)') ?></legend>
								<div class="row">
									<div class="form-group col-sm-12">
										<label for="encryptionMethod"><?= _('Password encryption method') ?></label>
										<br/>
										<label class="radio-inline radio" style="margin-top:0px;">
											<input type="radio" name="encryptionMethod" value="des" class="htpasswdChange validate[required]"> DES
										</label>
										<label class="radio-inline radio">
											<input type="radio" name="encryptionMethod" checked value="md5" class="htpasswdChange validate[required]"> MD5
										</label>
										<label class="radio-inline radio">
											<input type="radio" name="encryptionMethod" value="sha1" class="htpasswdChange validate[required]"> SHA1
										</label>
									</div>
								</div>
								<div class="userRow row">
									<div class="form-group col-sm-6 col-xs-12">
										<label for="protectionUserName[]"><?= _('Username') ?></label>
							     		<input type="text" name="protectionUserName[]" class="htpasswdChange form-control validate[required]">
						     		</div>
									<div class="form-group col-sm-6 col-xs-12">
										<label for="protectionUserPassword[]"><?= _('Password for the User') ?></label>
							     		<input type="text" name="protectionUserPassword[]" class="htpasswdChange form-control validate[required]">
						     		</div>
					     		</div>	
								<div class="userControls row">
					     			<div class="form-group col-sm-6 col-xs-12">
					     				<button id="addUser" type="button" class="btn btn-success fw"><i class="fa fa-plus"></i> <?= _('Add User') ?></button>
				     				</div>
									<div class="form-group col-sm-6 col-xs-12">
					     				<button id="removeUser" type="button" class="btn btn-danger fw"><i class="fa fa-minus"></i> <?= _('Remove User') ?></button>
				     				</div>
				     			</div>
				     			<div class="row">
				     				<div class="col-sm-12">
				     					<h4><?= _('Your .htpasswd') ?></h4>
				     					<p><?= _('Save below text inside a file called ".htpasswd". Please be sure that you have specified the real path to this file (see above in settings)') ?></p>
					     				<pre id="htpasswd">
					     				</pre>
				     				</div>
				     			</div>
				     		</fieldset>						
						</div>

						<div role="error-pages" class="tab-pane" id="error-pages">
							<fieldset>
								<legend><?= _('Error prevention') ?></legend>
								<div class="row">
									<div class="form-group col-sm-6 col-xs-12">
										<label for="errorPrevention">
											<?= _('Disable the pattern matching based on filenames.') ?>
											<i data-toggle="popover" 
											title="<?= _('Error prevention') ?>" 
											data-content="<?= _('This setting prevents Apache from returning a 404 error as the result of a rewrite when the directory with the same name does not exist.') ?>" 
											class="fa fa-lg fa-info-circle blue"></i>
										</label>
							     		<select name="errorPrevention" id="errorPrevention" class="form-control validate[required]">
							     			<option value="yes"><?= _('yes') ?></option>
							     			<option value="no"><?= _('no') ?></option>
							     		</select>
						     		</div>
					     		</div>
								<legend><?= _('Custom error messages/pages') ?></legend>
								<div class="errorPageRow row">
									<div class="form-group col-sm-6 col-xs-12">
										<label for="errorCode[]"><?= _('Error Code') ?></label>
							     		<select name="errorCode[]" id="errorCode" class="form-control validate[required]">
							     			<option value=""><?= _('-- Select error Code --') ?></option>
											<option value="400">400 (Bad Request)</option>
											<option value="401">401 (Unauthorized)</option>
											<option value="402">402 (Payment Req'd)</option>
											<option value="403">403 (Forbidden)</option>
											<option value="404">404 (Not Found)</option>
											<option value="405">405 (Method Not Allowed)</option>
											<option value="406">406 (Not Acceptable)</option>
											<option value="407">407 (Proxy Auth Req'd)</option>
											<option value="408">408 (Request Timeout)</option>
											<option value="409">409 (Conflict)</option>
											<option value="410">410 (Gone)</option>
											<option value="411">411 (Length Required)</option>
											<option value="412">412 (Precondition Failed)</option>
											<option value="413">413 (Entity Too Large)</option>
											<option value="414">414 (URI Too Long)</option>
											<option value="500">500 (Internal Server Error)</option>
											<option value="501">501 (Not Implemented)</option>
											<option value="502">502 (Bad Gateway)</option>
											<option value="503">503 (Service Unavailable)</option>
											<option value="504">504 (Gateway Timeout)</option>
											<option value="505">505 (HTTP Version Not Supported)</option>
							     		</select>
						     		</div>
									<div class="form-group col-sm-6 col-xs-12">
										<label for="errorDocument[]"><?= _('Error document') ?></label>
							     		<input type="text" name="errorDocument[]" id="errorDocument" placeholder="/404.html" class="form-control validate[required]">
						     		</div>
					     		</div>
					     		<div class="errorPageControls row">
					     			<div class="form-group col-sm-6 col-xs-12">
					     				<button id="addErrorPage" type="button" class="btn btn-success fw"><i class="fa fa-plus"></i> <?= _('Add error page') ?></button>
				     				</div>
									<div class="form-group col-sm-6 col-xs-12">
					     				<button id="removeErrorPage" type="button" class="btn btn-danger fw"><i class="fa fa-minus"></i> <?= _('Remove last error page') ?></button>
				     				</div>
				     			</div>
							</fieldset>
						</div>
						<div role="security" class="tab-pane" id="security">
							<fieldset>
								<legend><?= _('Security') ?></legend>
								<div class="row">
									<div class="form-group col-sm-6 col-xs-12">
										<label for="clickjacking">
											<?= _('Enable Clickjacking-Protection?') ?>
											<i data-toggle="popover" 
											title="Clickjacking-Protection" 
											data-content="<?= _('Protect website against clickjacking.') ?>" 
											class="fa fa-lg fa-info-circle blue"></i>
										</label>
							     		<select name="clickjacking" id="clickjacking" class="form-control validate[required]">
							     			<option value="no"><?= _('No') ?></option>
							     			<option value="yes"><?= _('Yes') ?></option>
							     		</select>
						     		</div>
									<div class="form-group col-sm-6 col-xs-12">
										<label for="CSP">
											<?= _('Content Security Policy (CSP) - Please use <a href="https://cspbuilder.info" target="_blank">CSP Builder</a>') ?>
										</label>
							     		<select disabled="disabled" name="CSP" id="CSP" class="form-control validate[required]">
							     			<option value=""><?= _('No') ?></option>
							     			<option value=""><?= _('Yes') ?></option>
							     		</select>
						     		</div>
					     		</div>
								<legend><?= _('File access') ?></legend>
								<div class="row">
									<div class="form-group col-sm-6 col-xs-12">
										<label for="fileAccess">
											<?= _('No access to directories without default document?') ?>
											<i data-toggle="popover" 
											title="File acces" 
											data-content="<?= _('You should leave the following uncommented, as you shouldn\'t allow anyone to surf through every directory on your server (which may includes rather private places such as the CMS\'s directories)..') ?>" 
											class="fa fa-lg fa-info-circle blue"></i>
										</label>
							     		<select name="fileAccess" id="fileAccess" class="form-control validate[required]">
							     			<option value="yes"><?= _('Yes') ?></option>
							     			<option value="no"><?= _('No') ?></option>
							     		</select>
						     		</div>
									<div class="form-group col-sm-6 col-xs-12">
										<label for="blockHiddenFiles">
											<?= _('Block access to hidden files and directories (e.g. .git) except `/.well-known/` hidden directory.') ?>
											<i data-toggle="popover" 
											title="Block hidden files" 
											data-content="<?= _('These types of files usually contain user preferences or the preserved state of an utility, and can include rather private places like, for example, the `.git` or `.svn` directories. The `/.well-known/` directory represents the standard (RFC 5785) path prefix for well-known locations (e.g.: `/.well-known/manifest.json`, `/.well-known/keybase.txt`), and therefore, access to its visible content should not be blocked.') ?>" 
											class="fa fa-lg fa-info-circle blue"></i>
										</label>
							     		<select name="blockHiddenFiles" id="blockHiddenFiles" class="form-control validate[required]">
							     			<option value="yes"><?= _('Yes') ?></option>
							     			<option value="no"><?= _('No') ?></option>
							     		</select>
						     		</div>
					     		</div>
								<div class="row">
									<div class="form-group col-sm-6 col-xs-12">
										<label for="blockSensitiveInformation">
											<?= _('Block access to files that can expose sensitive information?') ?>
											<i data-toggle="popover" 
											title="<?= _('Block hidden files') ?>" 
											data-content="<?= _('By default, block access to backup and source files that may be left by some text editors and can pose a security risk when anyone has access to them.') ?>" 
											class="fa fa-lg fa-info-circle blue"></i>
										</label>
										<!-- TODO: list non accessible files -->
							     		<select name="blockSensitiveInformation" id="blockSensitiveInformation" class="form-control validate[required]">
							     			<option value="yes"><?= _('Yes') ?></option>
							     			<option value="no"><?= _('No') ?></option>
							     		</select>
						     		</div>
									<div class="form-group col-sm-6 col-xs-12">
										<label for="HSTS">
											<i data-toggle="popover" 
											title="HSTS" 
											data-content="<?= _('Remove the `includeSubDomains` optional directive if the website\'s subdomains are not using HTTPS.') ?>" 
											class="fa fa-lg fa-exclamation-triangle red"></i>
											<?= _('Enable HTTP Strict Transport Security (HSTS)?') ?>
											<i data-toggle="popover" 
											title="Force client-side SSL redirection" 
											data-content="<?= _('Ensures that browser will ONLY connect to your server via HTTPS, regardless of what the users type in the browser\'s address bar.') ?>" 
											class="fa fa-lg fa-info-circle blue"></i>
										</label>
							     		<select name="HSTS" id="HSTS" class="form-control validate[required]">
							     			<option value="no"><?= _('No') ?></option>
							     			<option value="yes"><?= _('Yes') ?></option>
							     		</select>
						     		</div>
					     		</div>
								<div class="row">
									<div class="form-group col-sm-6 col-xs-12">
										<label for="MIMETypeSecurity">
											<?= _('Reduce MIME type security risks?') ?>
											<i data-toggle="popover" 
											title="<?= _('MIME type security') ?>" 
											data-content="<?= _('Prevent some browsers from MIME-sniffing the response.<br/><br/>This reduces exposure to drive-by download attacks and cross-origin data leaks, and should be left uncommented, especially if the server is serving user-uploaded content or content that could potentially be treated as executable by the browser.') ?>" 
											class="fa fa-lg fa-info-circle blue"></i>
										</label>
							     		<select name="MIMETypeSecurity" id="MIMETypeSecurity" class="form-control validate[required]">
							     			<option value="yes"><?= _('Yes') ?></option>
							     			<option value="no"><?= _('No') ?></option>
							     		</select>
						     		</div>
									<div class="form-group col-sm-6 col-xs-12">
										<label for="enableXSSFilter">
											<i data-toggle="popover" 
											title="XSS Filter" 
											data-content="<?= _('Do not rely on the XSS filter to prevent XSS attacks! Ensure that you are taking all possible measures to prevent XSS attacks, the most obvious being: validating and sanitizing your website\'s inputs.') ?>" 
											class="fa fa-lg fa-exclamation-triangle red"></i>
											<?= _('Re-enable (XSS) filter') ?>
											<i data-toggle="popover" 
											title="<?= _('XSS Filter') ?>" 
											data-content="<?= _('Try to re-enable the cross-site scripting (XSS) filter built into most web browsers.') ?>" 
											class="fa fa-lg fa-info-circle blue"></i>
										</label>
							     		<select name="enableXSSFilter" id="enableXSSFilter" class="form-control validate[required]">
							     			<option value="no"><?= _('No') ?></option>
							     			<option value="yes"><?= _('Yes') ?></option>
							     		</select>
						     		</div>
					     		</div>
					     		<legend><?= _('Service Side Technology information') ?></legend>
								<div class="row">
									<div class="form-group col-sm-6 col-xs-12">
										<label for="removeXpowered"><?= _('Remove the `X-Powered-By` response header?') ?></label>
							     		<select name="removeXpowered" id="removeXpowered" class="form-control validate[required]">
							     			<option value="yes"><?= _('Yes') ?></option>
							     			<option value="no"><?= _('no') ?></option>
							     		</select>
						     		</div>
									<div class="form-group col-sm-6 col-xs-12">
										<label for="showServerInformation">
											<?= _('Show server software information?') ?>
											<i data-toggle="popover" 
											title="<?= _('Server information') ?>" 
											data-content="<?= _('Prevent Apache from adding a trailing footer line containing information about the server to the server-generated documents (e.g.: error messages, directory listings, etc.)') ?>" 
											class="fa fa-lg fa-info-circle blue"></i>
 										</label>
							     		<select name="showServerInformation" id="showServerInformation" class="form-control validate[required]">
							     			<option value="yes"><?= _('Yes') ?></option>
							     			<option value="no"><?= _('No') ?></option>
							     		</select>
						     		</div>
					     		</div>
							</fieldset>
						</div>

						<div role="rewrites" class="tab-pane" id="rewrites">
							<fieldset>
								<legend><?= _('Rewrite Engine') ?></legend>
								<div class="row">
									<div class="form-group col-sm-6 col-xs-12">
										<label for="rewriteEngine"><?= _('Enable Rewrites?') ?></label>
							     		<select name="rewriteEngine" id="rewriteEngine" class="form-control validate[required]">
							     			<option value="yes"><?= _('Yes') ?></option>
							     			<option value="no"><?= _('No') ?></option>
							     		</select>
						     		</div>
									<div class="form-group col-sm-6 col-xs-12">
										<label for="followSymlinks"><?= _('Enable follow Symlinks?') ?></label>
							     		<select name="followSymlinks" id="followSymlinks" class="form-control validate[required]">
							     			<option value="yes"><?= _('Yes') ?></option>
							     			<option value="no"><?= _('No') ?></option>
							     		</select>
						     		</div>
					     		</div>
								<div class="row">
									<div class="form-group col-sm-6 col-xs-12">
										<label for="SymLinksIfOwnerMatch">
											<i data-toggle="popover" 
											title="SymLinksIfOwnerMatch" 
											data-content="Enable only when FollowSymlinks is not allowed!" 
											class="fa fa-lg fa-exclamation-triangle red"></i>
											<?= _('Enable SymLinksIfOwnerMatch') ?>
										</label>
							     		<select name="SymLinksIfOwnerMatch" id="SymLinksIfOwnerMatch" class="form-control validate[required]">
							     			<option value="no"><?= _('No') ?></option>
							     			<option value="yes"><?= _('Yes') ?></option>
							     		</select>
						     		</div>
									<div class="form-group col-sm-6 col-xs-12">
										<label for="rewriteBase"><?= _('Rewrite Base') ?></label>
							     		<input value="/" name="rewriteBase" id="rewriteBase" type="text" class="form-control validate[required]">
						     		</div>
					     		</div>
								<div class="row">
									<div class="form-group col-sm-6 col-xs-12">
										<label for="allowAppropriateSchema">
											<?= _('Allow rewrites to redirect with the appropriate schema automatically (http or https)?') ?>
											<i data-toggle="popover" 
											title="<?= _('Appropriate scheme') ?>" 
											data-content="<?= _('Set %{ENV:PROTO} variable, to allow rewrites to redirect with the appropriate schema automatically (http or https).') ?>" 
											class="fa fa-lg fa-info-circle blue"></i>
										</label>
							     		<select name="allowAppropriateSchema" id="allowAppropriateSchema" class="form-control validate[required]">
							     			<option value="no"><?= _('No') ?></option>
							     			<option value="yes"><?= _('Yes') ?></option>
							     		</select>
						     		</div>
					     		</div>
					     		<legend><?= _('Forcings') ?></legend>
								<div class="row">
									<div class="form-group col-sm-6 col-xs-12">
										<label for="forcehttps">
											<?= _('Force https?') ?>
											<i data-toggle="popover" 
											title="<?= _('Force https') ?>" 
											data-content="<?= _('Redirect from the `http://` to the `https://` version of the URL.') ?>" 
											class="fa fa-lg fa-info-circle blue"></i>
										</label>
							     		<select name="forcehttps" id="forcehttps" class="form-control validate[required]">
							     			<option value="no"><?= _('No') ?></option>
							     			<option value="yes"><?= _('Yes') ?></option>
							     		</select>
						     		</div>
									<div class="form-group col-sm-6 col-xs-12">
										<label for="forcewww">
											<?= _('Force www?') ?>
											<i data-toggle="popover" 
											title="<?= _('Force www') ?>"
											data-content="<?= _('The same content should never be available under two different URLs, especially not with and without `www.` at the beginning. This can cause SEO problems (duplicate content), and therefore, you should choose one of the alternatives and redirect the other one.') ?>" 
											class="fa fa-lg fa-info-circle blue"></i>
										</label>
							     		<select name="forcewww" id="forcewww" class="form-control validate[required]">
							     			<option value="no"><?= _('No') ?></option>
							     			<option value="yes"><?= _('Yes') ?></option>
							     		</select>
						     		</div>
					     		</div>
					     		<legend><?= _('Custom rules') ?></legend>
					     		<p><?= _('For more information on how to use RewriteRules see:') ?></p>
					     		<ul>
					     			<li><a href="http://httpd.apache.org/docs/2.0/misc/rewriteguide.html" target="_blank"><?= _('Offical Documentation') ?></a></li>
					     			<li><a href="http://www.askapache.com/htaccess/modrewrite-tips-tricks.html" target="_blank"><?= _('Examples') ?></a></li>
					     			<li><a href="https://mediatemple.net/community/products/dv/204643270/using-htaccess-rewrite-rules" target="_blank">Tutorial 1</a></li>
					     			<li><a href="https://www.addedbytes.com/articles/for-beginners/url-rewriting-for-beginners/" target="_blank">Tutorial 2</a></li>
					     			<li><a href="http://www.cheatography.com/davechild/cheat-sheets/mod-rewrite/" target="_blank">Cheat Sheet 1</a></li>
					     			<li><a href="http://www.cheatography.com/davechild/cheat-sheets/regular-expressions/" target="_blank">Cheat Sheet 2</a></li>
					     		</ul>
								<div class="customRewriteruleRow row">
									<div class="form-group col-sm-5 col-xs-12">
										<label for="customRewriterulePattern[]"><?= _('Pattern (Tip: use <a href="http://regexr.com/" target="_blank">REGEXR</a>)') ?></label>
							     		<input name="customRewriterulePattern[]" id="customRewriterulePattern" placeholder="^(.*)$" type="text" class="form-control validate[required]">
						     		</div>
									<div class="form-group col-sm-5 col-xs-12">
										<label for="customRewriteruleSubstitution[]"><?= _('Substitution') ?></label>
							     		<input name="customRewriteruleSubstitution[]" id="customRewriteruleSubstitution" placeholder="http://example.net/$1" type="text" class="form-control validate[required]">
						     		</div>
									<div class="form-group col-sm-2 col-xs-12">
										<label for="customRewriteruleFlag[]"><?= _('Flags') ?></label>
										<input name="customRewriteruleFlag[]" id="customRewriteruleFlag" type="text" placeholder="[L,R=301,NC]" class="form-control validate[required]">
						     		</div>
					     		</div>
								<div class="rewriteCustomRuleControls row">
					     			<div class="form-group col-sm-6 col-xs-12">
					     				<button id="addCustomRewriteRule" type="button" class="btn btn-success fw"><i class="fa fa-plus"></i> <?= _('Add custom rule') ?></button>
				     				</div>
									<div class="form-group col-sm-6 col-xs-12">
					     				<button id="removeCustomRewriteRule" type="button" class="btn btn-danger fw"><i class="fa fa-minus"></i> <?= _('Remove custom rule') ?></button>
				     				</div>
				     			</div>
							</fieldset>
						</div>
						<div role="bad-robots" class="tab-pane" id="bad-robots">
							<fieldset>
								<legend><?= _('Block bad robots') ?></legend>
								<div class="row">
									<div class="form-group col-sm-6 col-xs-12">
										<label for="blockBadBots"><?= _('Block bad robots?') ?></label>
							     		<select name="blockBadBots" id="blockBadBots" class="form-control validate[required]">
							     			<option value="no"><?= _('No') ?></option>
							     			<option value="yes"><?= _('Yes') ?></option>
							     		</select>
									 	<div class="checkbox">
											<label>
												<input name="badBot" value="yes" type="checkbox"><?= _('Bad Bots & Scrapers') ?>
											</label>
										</div>
										<div class="checkbox">
											<label>
												<input name="vulnerabilityScanners" value="yes" type="checkbox"><?= _('Vulnerability Scanners') ?>
											</label>
										</div>
										<div class="checkbox">
											<label>
												<input name="chineseSearchEngine" value="yes" type="checkbox"><?= _('Aggressive Chinese Search Engine') ?>
											</label>
										</div>
										<div class="checkbox">
											<label>
												<input name="russianSearchEngine" value="yes" type="checkbox"><?= _('Aggressive Russian Search Engine') ?>
											</label>
										</div>
									</div>
								</div>
							</div>
						</fieldset>
					</div>

					<!-- Modal -->
					<div class="modal fade" id="yourHtaccessModal" tabindex="-1" role="dialog" aria-labelledby="yourHtaccess">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									<h4 class="modal-title" id="yourHtaccess"><?= _('Your Htaccess') ?></h4>
								</div>
								<div class="modal-body">
									<pre id="yourHtaccessModalBody">

									</pre>
								</div>
								<div class="modal-footer">
									<button type="button" class="copyHtaccess btn btn-primary" data-clipboard-target="yourHtaccessModalBody"><i class="fa fa-copy"></i> <?= _('Copy') ?></button>
									<button type="button" class="saveHtaccess btn btn-primary"><i class="fa fa-save"></i> <?= _('Save') ?></button>
									<button type="button" class="downloadHtaccess btn btn-primary"><i class="fa fa-download"></i> <?= _('Download') ?></button>
									<button type="button" class="btn btn-default" data-dismiss="modal"><?= _('Close') ?></button>
								</div>
							</div>
						</div>
					</div>
				</form>