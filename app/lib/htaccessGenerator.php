<?php
namespace lib;

class htaccessGenerator {

	public $output = array();

	public $withComments;
	public $protectionName;
	public $protectionPath;
	public $protectionUserName;
	public $protectionUserPassword;
	public $badBot;
	public $vulnerabilityScanners;
	public $chineseSearchEngine;
	public $russianSearchEngine;
	public $customRewriteRules;

	public function __construct($withComments) {
		$this->withComments = $withComments;
	}

	public function crossOriginRequests()
	{
		$output = '';
		if($this->withComments){
			$output ='
				# ----------------------------------------------------------------------
				# | Cross-origin requests                                              |
				# ----------------------------------------------------------------------

				# Allow cross-origin requests.
				#
				# https://developer.mozilla.org/en-US/docs/Web/HTTP/Access_control_CORS
				# http://enable-cors.org/
				# http://www.w3.org/TR/cors/';
		}

		$output .='
			<IfModule mod_headers.c>
	     		Header set Access-Control-Allow-Origin "*"
			</IfModule>';
		return $this->output[] = $output;
	}

	public function crossOriginImages()
	{
		$output = '';
		if($this->withComments){
			$output ='
				# ----------------------------------------------------------------------
				# | Cross-origin images                                                |
				# ----------------------------------------------------------------------

				# Send the CORS header for images when browsers request it.
				#
				# https://developer.mozilla.org/en-US/docs/Web/HTML/CORS_enabled_image
				# https://blog.chromium.org/2011/07/using-cross-domain-images-in-webgl-and.html';
		}
		$output .='
				<IfModule mod_setenvif.c>
				    <IfModule mod_headers.c>
				        <FilesMatch "\.(bmp|cur|gif|ico|jpe?g|png|svgz?|webp)$">
				            SetEnvIf Origin ":" IS_CORS
				            Header set Access-Control-Allow-Origin "*" env=IS_CORS
				        </FilesMatch>
				    </IfModule>
				</IfModule>';
		return $this->output[] = $output;
	}

	public function crossOriginWebfonts()
	{
		$output = '';
		if($this->withComments){
			$output ='
				# ----------------------------------------------------------------------
				# | Cross-origin web fonts                                             |
				# ----------------------------------------------------------------------

				# Allow cross-origin access to web fonts.';
		}
		$output .='
			<IfModule mod_headers.c>
			    <FilesMatch "\.(eot|otf|tt[cf]|woff2?)$">
			        Header set Access-Control-Allow-Origin "*"
			    </FilesMatch>
			</IfModule>';
		return $this->output[] = $output;
	}

	public function CrossOriginResourceTiming()
	{
		$output = '';
		if($this->withComments){
			$output ='
				# Allow cross-origin access to the timing information for all resources.
				#
				# If a resource isn\'t served with a `Timing-Allow-Origin` header that
				# would allow its timing information to be shared with the document,
				# some of the attributes of the `PerformanceResourceTiming` object will
				# be set to zero.
				#
				# http://www.w3.org/TR/resource-timing/
				# http://www.stevesouders.com/blog/2014/08/21/resource-timing-practical-tips/';
		}
		$output .='
				<IfModule mod_headers.c>
				    Header set Timing-Allow-Origin: "*"
				</IfModule>';
			return $this->output[] = $output;
	}

	public function internetExplorer()
	{
		$output = '';
		if($this->withComments){
			$output = '
				# Force Internet Explorer 8/9/10 to render pages in the highest mode
				# available in the various cases when it may not.
				#
				# https://hsivonen.fi/doctype/#ie8
				#
				# (!) Starting with Internet Explorer 11, document modes are deprecated.
				# If your business still relies on older web apps and services that were
				# designed for older versions of Internet Explorer, you might want to
				# consider enabling `Enterprise Mode` throughout your company.
				#
				# https://msdn.microsoft.com/en-us/library/ie/bg182625.aspx#docmode
				# http://blogs.msdn.com/b/ie/archive/2014/04/02/stay-up-to-date-with-enterprise-mode-for-internet-explorer-11.aspx';
		}
		$output .='
			<IfModule mod_headers.c>

			    Header set X-UA-Compatible "IE=edge"

			    # `mod_headers` cannot match based on the content-type, however,
			    # the `X-UA-Compatible` response header should be send only for
			    # HTML documents and not for the other resources.

			    <FilesMatch "\.(appcache|atom|bbaw|bmp|crx|css|cur|eot|f4[abpv]|flv|geojson|gif|htc|ico|jpe?g|js|json(ld)?|m4[av]|manifest|map|mp4|oex|og[agv]|opus|otf|pdf|png|rdf|rss|safariextz|svgz?|swf|topojson|tt[cf]|txt|vcard|vcf|vtt|webapp|web[mp]|webmanifest|woff2?|xloc|xml|xpi)$">
			        Header unset X-UA-Compatible
			    </FilesMatch>

			</IfModule>';
		return $this->output[] = $output;
	}

	public function iframeCookies()
	{
		$output = '';
		if($this->withComments){
			$output ='
				# Allow cookies to be set from iframes in Internet Explorer.
				#
				# https://msdn.microsoft.com/en-us/library/ms537343.aspx
				# http://www.w3.org/TR/2000/CR-P3P-20001215/';
		}
		$output .='
			<IfModule mod_headers.c>
			     Header set P3P "policyref=\"/w3c/p3p.xml\", CP=\"IDC DSP COR ADM DEVi TAIi PSA PSD IVAi IVDi CONi HIS OUR IND CNT\""
			</IfModule>';
		return $this->output[] = $output;
	}

	public function mediaTypes()
	{
		$output = '';
		if($this->withComments){
			$output ='
				# ----------------------------------------------------------------------
				# | Media types                                                        |
				# ----------------------------------------------------------------------

				# Serve resources with the proper media types (f.k.a. MIME types).
				#
				# https://www.iana.org/assignments/media-types/media-types.xhtml
				# https://httpd.apache.org/docs/current/mod/mod_mime.html#addtype';
		} 
		$output .='
				<IfModule mod_mime.c>
				    AddType application/atom+xml                        atom
				    AddType application/json                            json map topojson
				    AddType application/ld+json                         jsonld
				    AddType application/rss+xml                         rss
				    AddType application/vnd.geo+json                    geojson
				    AddType application/xml                             rdf xml
				    AddType application/javascript                      js
				    AddType application/manifest+json                   webmanifest
				    AddType application/x-web-app-manifest+json         webapp
				    AddType text/cache-manifest                         appcache
				    AddType audio/mp4                                   f4a f4b m4a
				    AddType audio/ogg                                   oga ogg opus
				    AddType image/bmp                                   bmp
				    AddType image/svg+xml                               svg svgz
				    AddType image/webp                                  webp
				    AddType video/mp4                                   f4v f4p m4v mp4
				    AddType video/ogg                                   ogv
				    AddType video/webm                                  webm
				    AddType video/x-flv                                 flv
				    AddType image/x-icon                                cur ico
				    AddType application/font-woff                       woff
				    AddType application/font-woff2                      woff2
				    AddType application/vnd.ms-fontobject               eot
				    AddType application/x-font-ttf                      ttc ttf
				    AddType font/opentype                               otf
				    AddType application/octet-stream                    safariextz
				    AddType application/x-bb-appworld                   bbaw
				    AddType application/x-chrome-extension              crx
				    AddType application/x-opera-extension               oex
				    AddType application/x-xpinstall                     xpi
				    AddType text/vcard                                  vcard vcf
				    AddType text/vnd.rim.location.xloc                  xloc
				    AddType text/vtt                                    vtt
				    AddType text/x-component                            htc
				</IfModule>';
		return $this->output[] = $output;
	}

	public function characterEncoding() 
	{
		$output = '';
		if($this->withComments){
			$output ='
				# ----------------------------------------------------------------------
				# | Character encodings                                                |
				# ----------------------------------------------------------------------

				# Serve all resources labeled as `text/html` or `text/plain`
				# with the media type `charset` parameter set to `UTF-8`.
				#
				# https://httpd.apache.org/docs/current/mod/core.html#adddefaultcharset';
		}
		$output .= '
				AddDefaultCharset utf-8
				';
		return $this->output[] = $output;
	}

	public function characterEncodingFiles()
	{
		$output = '';
		if($this->withComments){
			$output ='
				# Serve the following file types with the media type `charset`
				# parameter set to `UTF-8`.
				#
				# https://httpd.apache.org/docs/current/mod/mod_mime.html#addcharset';
		} 
		$output .='
				<IfModule mod_mime.c>
				    AddCharset utf-8 .atom \
				                     .bbaw \
				                     .css \
				                     .geojson \
				                     .js \
				                     .json \
				                     .jsonld \
				                     .manifest \
				                     .rdf \
				                     .rss \
				                     .topojson \
				                     .vtt \
				                     .webapp \
				                     .webmanifest \
				                     .xloc \
				                     .xml
				</IfModule>';
		return $this->output[] = $output;
	}

	public function compression()
	{
		if($this->withComments){
			$output ='
				# ----------------------------------------------------------------------
				# | Compression                                                        |
				# ----------------------------------------------------------------------

				<IfModule mod_deflate.c>

				    # Force compression for mangled `Accept-Encoding` request headers
				    # https://developer.yahoo.com/blogs/ydn/pushing-beyond-gzipping-25601.html

				    <IfModule mod_setenvif.c>
				        <IfModule mod_headers.c>
				            SetEnvIfNoCase ^(Accept-EncodXng|X-cept-Encoding|X{15}|~{15}|-{15})$ ^((gzip|deflate)\s*,?\s*)+|[X~-]{4,13}$ HAVE_Accept-Encoding
				            RequestHeader append Accept-Encoding "gzip,deflate" env=HAVE_Accept-Encoding
				        </IfModule>
				    </IfModule>

				    # - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

				    # Compress all output labeled with one of the following media types.
				    #
				    # (!) For Apache versions below version 2.3.7 you don\'t need to
				    # enable `mod_filter` and can remove the `<IfModule mod_filter.c>`
				    # and `</IfModule>` lines as `AddOutputFilterByType` is still in
				    # the core directives.
				    #
				    # https://httpd.apache.org/docs/current/mod/mod_filter.html#addoutputfilterbytype

				    <IfModule mod_filter.c>
				        AddOutputFilterByType DEFLATE "application/atom+xml" \
				                                      "application/javascript" \
				                                      "application/json" \
				                                      "application/ld+json" \
				                                      "application/manifest+json" \
				                                      "application/rdf+xml" \
				                                      "application/rss+xml" \
				                                      "application/schema+json" \
				                                      "application/vnd.geo+json" \
				                                      "application/vnd.ms-fontobject" \
				                                      "application/x-font-ttf" \
				                                      "application/x-javascript" \
				                                      "application/x-web-app-manifest+json" \
				                                      "application/xhtml+xml" \
				                                      "application/xml" \
				                                      "font/eot" \
				                                      "font/opentype" \
				                                      "image/bmp" \
				                                      "image/svg+xml" \
				                                      "image/vnd.microsoft.icon" \
				                                      "image/x-icon" \
				                                      "text/cache-manifest" \
				                                      "text/css" \
				                                      "text/html" \
				                                      "text/javascript" \
				                                      "text/plain" \
				                                      "text/vcard" \
				                                      "text/vnd.rim.location.xloc" \
				                                      "text/vtt" \
				                                      "text/x-component" \
				                                      "text/x-cross-domain-policy" \
				                                      "text/xml"

				    </IfModule>

				    # - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

				    # Map the following filename extensions to the specified
				    # encoding type in order to make Apache serve the file types
				    # with the appropriate `Content-Encoding` response header
				    # (do note that this will NOT make Apache compress them!).
				    #
				    # If these files types would be served without an appropriate
				    # `Content-Enable` response header, client applications (e.g.:
				    # browsers) wouldn\'t know that they first need to uncompress
				    # the response, and thus, wouldn\'t be able to understand the
				    # content.
				    #
				    # https://httpd.apache.org/docs/current/mod/mod_mime.html#addencoding

				    <IfModule mod_mime.c>
				        AddEncoding gzip              svgz
				    </IfModule>

				</IfModule>';
		} else {
			$output ='
				<IfModule mod_deflate.c>

				    <IfModule mod_setenvif.c>
				        <IfModule mod_headers.c>
				            SetEnvIfNoCase ^(Accept-EncodXng|X-cept-Encoding|X{15}|~{15}|-{15})$ ^((gzip|deflate)\s*,?\s*)+|[X~-]{4,13}$ HAVE_Accept-Encoding
				            RequestHeader append Accept-Encoding "gzip,deflate" env=HAVE_Accept-Encoding
				        </IfModule>
				    </IfModule>

				    <IfModule mod_filter.c>
				        AddOutputFilterByType DEFLATE "application/atom+xml" \
				                                      "application/javascript" \
				                                      "application/json" \
				                                      "application/ld+json" \
				                                      "application/manifest+json" \
				                                      "application/rdf+xml" \
				                                      "application/rss+xml" \
				                                      "application/schema+json" \
				                                      "application/vnd.geo+json" \
				                                      "application/vnd.ms-fontobject" \
				                                      "application/x-font-ttf" \
				                                      "application/x-javascript" \
				                                      "application/x-web-app-manifest+json" \
				                                      "application/xhtml+xml" \
				                                      "application/xml" \
				                                      "font/eot" \
				                                      "font/opentype" \
				                                      "image/bmp" \
				                                      "image/svg+xml" \
				                                      "image/vnd.microsoft.icon" \
				                                      "image/x-icon" \
				                                      "text/cache-manifest" \
				                                      "text/css" \
				                                      "text/html" \
				                                      "text/javascript" \
				                                      "text/plain" \
				                                      "text/vcard" \
				                                      "text/vnd.rim.location.xloc" \
				                                      "text/vtt" \
				                                      "text/x-component" \
				                                      "text/x-cross-domain-policy" \
				                                      "text/xml"

				    </IfModule>

				    <IfModule mod_mime.c>
				        AddEncoding gzip              svgz
				    </IfModule>

				</IfModule>';
		}
		return $this->output[] = $output;
	}

	public function contentTransformation()
	{
		$output = '';
		if($this->withComments){
			$output ='
						# ----------------------------------------------------------------------
						# | Content transformation                                             |
						# ----------------------------------------------------------------------

						# Prevent intermediate caches or proxies (e.g.: such as the ones
						# used by mobile network providers) from modifying the website\'s
						# content.
						#
						# https://tools.ietf.org/html/rfc2616#section-14.9.5
						#
						# (!) If you are using `mod_pagespeed`, please note that setting
						# the `Cache-Control: no-transform` response header will prevent
						# `PageSpeed` from rewriting `HTML` files, and, if the
						# `ModPagespeedDisableRewriteOnNoTransform` directive isn\'t set
						# to `off`, also from rewriting other resources.
						#
						# https://developers.google.com/speed/pagespeed/module/configuration#notransform';
		}
		$output .= '
				<IfModule mod_headers.c>
				    Header merge Cache-Control "no-transform"
				</IfModule>';
		return $this->output[] = $output;
	}

	public function fileConcatentation()
	{
		$output = '';
		if($this->withComments){
			$output ='
						# ----------------------------------------------------------------------
						# | File concatenation                                                 |
						# ----------------------------------------------------------------------

						# Allow concatenation from within specific files.
						#
						# e.g.:
						#
						#   If you have the following lines in a file called, for
						#   example, `main.combined.js`:
						#
						#       <!--#include file="js/jquery.js" -->
						#       <!--#include file="js/jquery.timer.js" -->
						#
						#   Apache will replace those lines with the content of the
						#   specified files.';
		}
		$output .='
				<IfModule mod_include.c>
					    <FilesMatch "\.combined\.js$">
					        Options +Includes
					        AddOutputFilterByType INCLUDES application/javascript \
					                                       application/x-javascript \
					                                       text/javascript
					        SetOutputFilter INCLUDES
					    </FilesMatch>
					    <FilesMatch "\.combined\.css$">
					        Options +Includes
					        AddOutputFilterByType INCLUDES text/css
					        SetOutputFilter INCLUDES
					    </FilesMatch>
					</IfModule>';
		return $this->output[] = $output;
	}

	public function fileCacheBusting()
	{
		$output = '';
		if($this->withComments){
			$output ='
						# ----------------------------------------------------------------------
						# | Filename-based cache busting                                       |
						# ----------------------------------------------------------------------

						# If you\'re not using a build process to manage your filename version
						# revving, you might want to consider enabling the following directives
						# to route all requests such as `/style.12345.css` to `/style.css`.
						#
						# To understand why this is important and even a better solution than
						# using something like `*.css?v231`, please see:
						# http://www.stevesouders.com/blog/2008/08/23/revving-filenames-dont-use-querystring/';
		}
		$output .='
					<IfModule mod_rewrite.c>
					    RewriteEngine On
					    RewriteCond %{REQUEST_FILENAME} !-f
					    RewriteRule ^(.+)\.(\d+)\.(bmp|css|cur|gif|ico|jpe?g|js|png|svgz?|webp|webmanifest)$ $1.$3 [L]
					</IfModule>';
		return $this->output[] = $output;
	}


	public function ETags()
	{
		$output = '';
		if($this->withComments){
			$output ='
						# ----------------------------------------------------------------------
						# | ETags                                                              |
						# ----------------------------------------------------------------------

						# Remove `ETags` as resources are sent with far-future expires headers.
						#
						# https://developer.yahoo.com/performance/rules.html#etags
						# https://tools.ietf.org/html/rfc7232#section-2.3

						# `FileETag None` doesn\'t work in all cases.';
		}
		$output .= '
						<IfModule mod_headers.c>
						    Header unset ETag
						</IfModule>

						FileETag None';
		return $this->output[] = $output;

	}

	public function expiresHeader($expiresDefault, $expires = null)
	{
		$output = '';
		if($this->withComments){
			$output ='
						# ----------------------------------------------------------------------
						# | Expires headers                                                    |
						# ----------------------------------------------------------------------

						# Serve resources with far-future expires headers.
						#
						# (!) If you don\'t control versioning with filename-based
						# cache busting, you should consider lowering the cache times
						# to something like one week.
						#
						# https://httpd.apache.org/docs/current/mod/mod_expires.html
			';
		}

		$output .= '	
						<IfModule mod_expires.c>

						    ExpiresActive on';
	    $output .= '		
    						ExpiresDefault '.$expiresDefault;

	    if(isset($expires) && !empty($expires) && ($expires != "false")){
		    foreach($expires as $expire)
		    {
		    	 $output .= '	
	    	 				ExpiresByType '.$expire['expireType'].' "access plus '.$expire['expireTimeValue'].' '.$expire['expireTime'].'"';
		    }
	    }

	    $output .= '
						</IfModule>
	    				';
		return $this->output[] = $output;
	}

	public function buildExpires($expireType, $expireTimeValue, $expireTime)
	{
 		$i = 0;
        $expireCount = count($expireType);
        $expires = array();
        for ($i=0; $i < $expireCount; $i++) { 
            if(!empty($expireType[$i]) && !empty($expireTimeValue[$i]) && !empty($expireTime[$i])){
                $expires[$i]['expireType'] = $expireType[$i];
                $expires[$i]['expireTimeValue'] = $expireTimeValue[$i];
                if($expireTimeValue[$i] > 1) {
                    $expireTime[$i].'s';
                }
                $expires[$i]['expireTime'] = $expireTime[$i];
            }
        }
        return $expires;
	}
	
	public function generateProtection()
	{
		$output = '
					AuthUserFile '.$this->protectionPath.'
					AuthGroupFile /dev/null
					AuthName "'.$this->protectionName.'"
					AuthType Basic
					require valid-user 
					';

		return $this->output[] = $output;
	}

	public function errorPrevention()
	{
		$output = '';
		if($this->withComments){
			$output ='
						# ----------------------------------------------------------------------
						# | Error prevention                                                   |
						# ----------------------------------------------------------------------

						# Disable the pattern matching based on filenames.
						#
						# This setting prevents Apache from returning a 404 error as the result
						# of a rewrite when the directory with the same name does not exist.
						#
						# https://httpd.apache.org/docs/current/content-negotiation.html#multiviews
			';
		}

		$output .= '	
						Options -MultiViews';
		return $this->output[] = $output;
	}

	public function errorPages($errors) 
	{
		$output = '';
		if($this->withComments){
			$output ='
						# ----------------------------------------------------------------------
						# | Custom error messages/pages                                        |
						# ----------------------------------------------------------------------

						# Customize what Apache returns to the client in case of an error.
						# https://httpd.apache.org/docs/current/mod/core.html#errordocument
			';
		}
		if(isset($errors) && !empty($errors)){
		    foreach($errors as $error)
		    {
		    	 $output .= 'ErrorDocument '.$error['errorCode'].' '.$error['errorDocument'];
		    }
	    }
		return $this->output[] = $output;
	}

	public function buildErrors($errorCode, $errorDocument)
	{
		$i = 0;
        $errorCount = count($errorCode);
        $errors = array();
        for ($i=0; $i <= $errorCount; $i++) { 
            if(!empty($errorCode[$i]) && !empty($errorDocument[$i])){
                $errors[$i]['errorCode'] = $errorCode[$i];
                $errors[$i]['errorDocument'] = $errorDocument[$i];
            }
        }
        return $errors;
	}

	public function clickjacking()
	{
		$output = '';
		if($this->withComments){
			$output ='
						# Protect website against clickjacking.
						#
						# The example below sends the `X-Frame-Options` response header with
						# the value `DENY`, informing browsers not to display the content of
						# the web page in any frame.
						#
						# This might not be the best setting for everyone. You should read
						# about the other two possible values the `X-Frame-Options` header
						# field can have: `SAMEORIGIN` and `ALLOW-FROM`.
						# https://tools.ietf.org/html/rfc7034#section-2.1.
						#
						# Keep in mind that while you could send the `X-Frame-Options` header
						# for all of your website’s pages, this has the potential downside that
						# it forbids even non-malicious framing of your content (e.g.: when
						# users visit your website using a Google Image Search results page).
						#
						# Nonetheless, you should ensure that you send the `X-Frame-Options`
						# header for all pages that allow a user to make a state changing
						# operation (e.g: pages that contain one-click purchase links, checkout
						# or bank-transfer confirmation pages, pages that make permanent
						# configuration changes, etc.).
						#
						# Sending the `X-Frame-Options` header can also protect your website
						# against more than just clickjacking attacks:
						# https://cure53.de/xfo-clickjacking.pdf.
						#
						# https://tools.ietf.org/html/rfc7034
						# http://blogs.msdn.com/b/ieinternals/archive/2010/03/30/combating-clickjacking-with-x-frame-options.aspx
						# https://www.owasp.org/index.php/Clickjacking
			';
		}

		$output .= '	 
						<IfModule mod_headers.c>
						     Header set X-Frame-Options "DENY"
						     # `mod_headers` cannot match based on the content-type, however,
						     # the `X-Frame-Options` response header should be send only for
						     # HTML documents and not for the other resources.
						     <FilesMatch "\.(appcache|atom|bbaw|bmp|crx|css|cur|eot|f4[abpv]|flv|geojson|gif|htc|ico|jpe?g|js|json(ld)?|m4[av]|manifest|map|mp4|oex|og[agv]|opus|otf|pdf|png|rdf|rss|safariextz|svgz?|swf|topojson|tt[cf]|txt|vcard|vcf|vtt|webapp|web[mp]|webmanifest|woff2?|xloc|xml|xpi)$">
						         Header unset X-Frame-Options
						     </FilesMatch>
						 </IfModule>
						';
		return $this->output[] = $output;
	}

	public function CSP()
	{
		$output = '';
		if($this->withComments){
			$output ='
						# ----------------------------------------------------------------------
						# | Content Security Policy (CSP)                                      |
						# ----------------------------------------------------------------------

						# Mitigate the risk of cross-site scripting and other content-injection
						# attacks.
						#
						# This can be done by setting a `Content Security Policy` which
						# whitelists trusted sources of content for your website.
						#
						# The example header below allows ONLY scripts that are loaded from
						# the current website\'s origin (no inline scripts, no CDN, etc).
						# That almost certainly won\'t work as-is for your website!
						#
						# To make things easier, you can use an online CSP header generator
						# such as: http://cspisawesome.com/.
						#
						# http://content-security-policy.com/
						# http://www.html5rocks.com/en/tutorials/security/content-security-policy/
						# http://www.w3.org/TR/CSP11/).
			';
		}

		$output .= '	 <IfModule mod_headers.c>
						     Header set Content-Security-Policy "script-src \'self\'; object-src \'self\'"
						     # `mod_headers` cannot match based on the content-type, however,
						     # the `Content-Security-Policy` response header should be send
						     # only for HTML documents and not for the other resources.
						     <FilesMatch "\.(appcache|atom|bbaw|bmp|crx|css|cur|eot|f4[abpv]|flv|geojson|gif|htc|ico|jpe?g|js|json(ld)?|m4[av]|manifest|map|mp4|oex|og[agv]|opus|otf|pdf|png|rdf|rss|safariextz|svgz?|swf|topojson|tt[cf]|txt|vcard|vcf|vtt|webapp|web[mp]|webmanifest|woff2?|xloc|xml|xpi)$">
						         Header unset Content-Security-Policy
						     </FilesMatch>
						 </IfModule>
						';
		return $this->output[] = $output;
	}

	public function fileAccess()
	{
		$output = '';
		if($this->withComments){
			$output ='
						# ----------------------------------------------------------------------
						# | File access                                                        |
						# ----------------------------------------------------------------------

						# Block access to directories without a default document.
						#
						# You should leave the following uncommented, as you shouldn\'t allow
						# anyone to surf through every directory on your server (which may
						# includes rather private places such as the CMS\'s directories).
			';
		}

		$output .= '	
						<IfModule mod_autoindex.c>
						    Options -Indexes
						</IfModule>
						';
		return $this->output[] = $output;
	}

	public function blockHiddenFiles()
	{
		$output = '';
		if($this->withComments){
			$output ='
						# Block access to all hidden files and directories with the exception of
						# the visible content from within the `/.well-known/` hidden directory.
						#
						# These types of files usually contain user preferences or the preserved
						# state of an utility, and can include rather private places like, for
						# example, the `.git` or `.svn` directories.
						#
						# The `/.well-known/` directory represents the standard (RFC 5785) path
						# prefix for "well-known locations" (e.g.: `/.well-known/manifest.json`,
						# `/.well-known/keybase.txt`), and therefore, access to its visible
						# content should not be blocked.
						#
						# https://www.mnot.net/blog/2010/04/07/well-known
						# https://tools.ietf.org/html/rfc5785
			';
		}

		$output .= '	<IfModule mod_rewrite.c>
						    RewriteEngine On
						    RewriteCond %{REQUEST_URI} "!(^|/)\.well-known/([^./]+./?)+$" [NC]
						    RewriteCond %{SCRIPT_FILENAME} -d [OR]
						    RewriteCond %{SCRIPT_FILENAME} -f
						    RewriteRule "(^|/)\." - [F]
						</IfModule>
						';
		return $this->output[] = $output;
	}

	public function blockSensitiveInformation()
	{
		$output = '';
		if($this->withComments){
			$output ='
						# Block access to files that can expose sensitive information.
						#
						# By default, block access to backup and source files that may be
						# left by some text editors and can pose a security risk when anyone
						# has access to them.
						#
						# http://feross.org/cmsploit/
						#
						# (!) Update the `<FilesMatch>` regular expression from below to
						# include any files that might end up on your production server and
						# can expose sensitive information about your website. These files may
						# include: configuration files, files that contain metadata about the
						# project (e.g.: project dependencies), build scripts, etc..
			';
		}

		$output .= '	<FilesMatch "(^#.*#|\.(bak|conf|dist|fla|in[ci]|log|psd|sh|sql|sw[op])|~)$">

						    # Apache < 2.3
						    <IfModule !mod_authz_core.c>
						        Order allow,deny
						        Deny from all
						        Satisfy All
						    </IfModule>

						    # Apache ≥ 2.3
						    <IfModule mod_authz_core.c>
						        Require all denied
						    </IfModule>

						</FilesMatch>
						';
		return $this->output[] = $output;
	}

	public function HSTS()
	{
		$output = '';
		if($this->withComments){
			$output ='
						# ----------------------------------------------------------------------
						# | HTTP Strict Transport Security (HSTS)                              |
						# ----------------------------------------------------------------------

						# Force client-side SSL redirection.
						#
						# If a user types `example.com` in their browser, even if the server
						# redirects them to the secure version of the website, that still leaves
						# a window of opportunity (the initial HTTP connection) for an attacker
						# to downgrade or redirect the request.
						#
						# The following header ensures that browser will ONLY connect to your
						# server via HTTPS, regardless of what the users type in the browser\'s
						# address bar.
						#
						# (!) Remove the `includeSubDomains` optional directive if the website\'s
						# subdomains are not using HTTPS.
						#
						# http://www.html5rocks.com/en/tutorials/security/transport-layer-security/
						# https://tools.ietf.org/html/draft-ietf-websec-strict-transport-sec-14#section-6.1
						# http://blogs.msdn.com/b/ieinternals/archive/2014/08/18/hsts-strict-transport-security-attacks-mitigations-deployment-https.aspx
			';
		}

		$output .= '	<IfModule mod_headers.c>
						    Header always set Strict-Transport-Security "max-age=16070400; includeSubDomains"
						</IfModule>
						';
		return $this->output[] = $output;
	}

	public function MIMETypeSecurity()
	{
		$output = '';
		if($this->withComments){
			$output ='
						# ----------------------------------------------------------------------
						# | Reducing MIME type security risks                                  |
						# ----------------------------------------------------------------------

						# Prevent some browsers from MIME-sniffing the response.
						#
						# This reduces exposure to drive-by download attacks and cross-origin
						# data leaks, and should be left uncommented, especially if the server
						# is serving user-uploaded content or content that could potentially be
						# treated as executable by the browser.
						#
						# http://www.slideshare.net/hasegawayosuke/owasp-hasegawa
						# http://blogs.msdn.com/b/ie/archive/2008/07/02/ie8-security-part-v-comprehensive-protection.aspx
						# https://msdn.microsoft.com/en-us/library/ie/gg622941.aspx
						# https://mimesniff.spec.whatwg.org/
			';
		}

		$output .= '	<IfModule mod_headers.c>
						    Header set X-Content-Type-Options "nosniff"
						</IfModule>
						';
		return $this->output[] = $output;
	}

	public function enableXSSFilter()
	{
		$output = '';
		if($this->withComments){
			$output ='
						# ----------------------------------------------------------------------
						# | Reflected Cross-Site Scripting (XSS) attacks                       |
						# ----------------------------------------------------------------------

						# (1) Try to re-enable the cross-site scripting (XSS) filter built
						#     into most web browsers.
						#
						#     The filter is usually enabled by default, but in some cases it
						#     may be disabled by the user. However, in Internet Explorer for
						#     example, it can be re-enabled just by sending the
						#     `X-XSS-Protection` header with the value of `1`.
						#
						# (2) Prevent web browsers from rendering the web page if a potential
						#     reflected (a.k.a non-persistent) XSS attack is detected by the
						#     filter.
						#
						#     By default, if the filter is enabled and browsers detect a
						#     reflected XSS attack, they will attempt to block the attack
						#     by making the smallest possible modifications to the returned
						#     web page.
						#
						#     Unfortunately, in some browsers (e.g.: Internet Explorer),
						#     this default behavior may allow the XSS filter to be exploited,
						#     thereby, it\'s better to inform browsers to prevent the rendering
						#     of the page altogether, instead of attempting to modify it.
						#
						#     https://hackademix.net/2009/11/21/ies-xss-filter-creates-xss-vulnerabilities
						#
						# (!) Do not rely on the XSS filter to prevent XSS attacks! Ensure that
						#     you are taking all possible measures to prevent XSS attacks, the
						#     most obvious being: validating and sanitizing your website\'s inputs.
						#
						# http://blogs.msdn.com/b/ie/archive/2008/07/02/ie8-security-part-iv-the-xss-filter.aspx
						# http://blogs.msdn.com/b/ieinternals/archive/2011/01/31/controlling-the-internet-explorer-xss-filter-with-the-x-xss-protection-http-header.aspx
						# https://www.owasp.org/index.php/Cross-site_Scripting_%28XSS%29
			';
		}

		$output .= '	 <IfModule mod_headers.c>
						     #                           (1)    (2)
						     Header set X-XSS-Protection "1; mode=block"
						     # `mod_headers` cannot match based on the content-type, however,
						     # the `X-XSS-Protection` response header should be send only for
						     # HTML documents and not for the other resources.
						     <FilesMatch "\.(appcache|atom|bbaw|bmp|crx|css|cur|eot|f4[abpv]|flv|geojson|gif|htc|ico|jpe?g|js|json(ld)?|m4[av]|manifest|map|mp4|oex|og[agv]|opus|otf|pdf|png|rdf|rss|safariextz|svgz?|swf|topojson|tt[cf]|txt|vcard|vcf|vtt|webapp|web[mp]|webmanifest|woff2?|xloc|xml|xpi)$">
						         Header unset X-XSS-Protection
						     </FilesMatch>
						 </IfModule>
					';
		return $this->output[] = $output;
	}

	public function removeXpowered()
	{
		$output = '';
		if($this->withComments){
			$output ='
						# ----------------------------------------------------------------------
						# | Server-side technology information                                 |
						# ----------------------------------------------------------------------

						# Remove the `X-Powered-By` response header that:
						#
						#  * is set by some frameworks and server-side languages
						#    (e.g.: ASP.NET, PHP), and its value contains information
						#    about them (e.g.: their name, version number)
						#
						#  * doesn\'t provide any value as far as users are concern,
						#    and in some cases, the information provided by it can
						#    be used by attackers
						#
						# (!) If you can, you should disable the `X-Powered-By` header from the
						# language / framework level (e.g.: for PHP, you can do that by setting
						# `expose_php = off` in `php.ini`)
						#
						# https://php.net/manual/en/ini.core.php#ini.expose-php
			';
		}

		$output .= '	 <IfModule mod_headers.c>
						    Header unset X-Powered-By
						</IfModule>
					';
		return $this->output[] = $output;
	}

	public function showServerInformation()
	{
		$output = '';
		if($this->withComments){
			$output ='
						# ----------------------------------------------------------------------
						# | Server software information                                        |
						# ----------------------------------------------------------------------

						# Prevent Apache from adding a trailing footer line containing
						# information about the server to the server-generated documents
						# (e.g.: error messages, directory listings, etc.)
						#
						# https://httpd.apache.org/docs/current/mod/core.html#serversignature
			';
		}

		$output .= '	 
						ServerSignature Off
					';
		return $this->output[] = $output;
	}

	public function rewriteEngine()
	{
		$output = '
						<IfModule mod_rewrite.c>

						    # (1)
						    RewriteEngine On
		';
		if($this->followSymlinks && !$this->SymLinksIfOwnerMatch)
		{
			$output .= ' 
						    Options +FollowSymlinks';
		}
		elseif($this->SymLinksIfOwnerMatch && !$this->followSymlinks)
		{
			$output .= ' 
						    Options +SymLinksIfOwnerMatch';
		} else {
			// Error only one symlink!
		}

		if($this->rewriteBase)
		{
			$output .= ' 
						    RewriteBase '.$this->rewriteBase;
		}

		// if($this->rewriteOptions)
		// {
			// $output .= ' 
			// 				RewriteOptions '.$this->rewriteOptions;
		// }

		if($this->allowAppropriateSchema) {
			$output .= ' 
						    RewriteCond %{HTTPS} =on
						    RewriteRule ^ - [env=proto:https]
						    RewriteCond %{HTTPS} !=on
						    RewriteRule ^ - [env=proto:http]';
		    
		}

		if(isset($this->customRewriteRules) && !empty($this->customRewriteRules))
		{
		    foreach($this->customRewriteRules as $customRewriteRule)
		    {
		    	 $output .= '
						    RewriteRule '.$customRewriteRule['customRewriterulePattern'].' '.$customRewriteRule['customRewriteruleSubstitution'].' '.$customRewriteRule['customRewriteruleFlag'];
		    }
	    }
		$output .= '
						</IfModule>';
	    return $this->output[] = $output;
	}

	public function forcehttps()
	{
		$output = '';
		if($this->withComments){
			$output ='
						# ----------------------------------------------------------------------
						# | Forcing `https://`                                                 |
						# ----------------------------------------------------------------------

						# Redirect from the `http://` to the `https://` version of the URL.
						# https://wiki.apache.org/httpd/RewriteHTTPToHTTPS
			';
		}

		$output .= '	 
						<IfModule mod_rewrite.c>
						   RewriteEngine On
						   RewriteCond %{HTTPS} !=on
						   RewriteRule ^(.*)$ https://%{HTTP_HOST}/$1 [R=301,L]
						</IfModule>
					';
		return $this->output[] = $output;
	}

	public function forcewww()
	{
		$output = '';
		if($this->withComments){
			$output ='
						# ----------------------------------------------------------------------
						# | Suppressing / Forcing the `www.` at the beginning of URLs          |
						# ----------------------------------------------------------------------

						# The same content should never be available under two different
						# URLs, especially not with and without `www.` at the beginning.
						# This can cause SEO problems (duplicate content), and therefore,
						# you should choose one of the alternatives and redirect the other
						# one.
						#

						# rewrite www.example.com → example.com
			';
		}

		$output .= '	 
						<IfModule mod_rewrite.c>
						    RewriteEngine On
						    RewriteCond %{HTTPS} !=on
						    RewriteCond %{HTTP_HOST} ^www\.(.+)$ [NC]
						    RewriteRule ^ %{ENV:PROTO}://%1%{REQUEST_URI} [R=301,L]
						</IfModule>
					';
		return $this->output[] = $output;
		// else {
		// 	# - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

		// 	# Option 2: rewrite example.com → www.example.com
		// 	#
		// 	# Be aware that the following might not be a good idea if you use "real"
		// 	# subdomains for certain parts of your website.

		// 	# <IfModule mod_rewrite.c>
		// 	#     RewriteEngine On
		// 	#     RewriteCond %{HTTPS} !=on
		// 	#     RewriteCond %{HTTP_HOST} !^www\. [NC]
		// 	#     RewriteCond %{SERVER_ADDR} !=127.0.0.1
		// 	#     RewriteCond %{SERVER_ADDR} !=::1
		// 	#     RewriteRule ^ %{ENV:PROTO}://www.%{HTTP_HOST}%{REQUEST_URI} [R=301,L]
		// 	# </IfModule>
		// }
	}

	public function buildCustomRewriteRules($customRewriterulePattern, $customRewriteruleSubstitution, $customRewriteruleFlag)
	{
        $i = 0;
        $customRewriterulesCount = count($customRewriterulePattern);
        $customRewriteRules = array();
        for ($i=0; $i < $customRewriterulesCount; $i++) { 
            if(!empty($customRewriterulePattern[$i]) && !empty($customRewriteruleSubstitution[$i] && !empty($customRewriteruleFlag))){
                $customRewriteRules[$i]['customRewriterulePattern'] = $customRewriterulePattern[$i];
                $customRewriteRules[$i]['customRewriteruleSubstitution'] = $customRewriteruleSubstitution[$i];
                $customRewriteRules[$i]['customRewriteruleFlag'] = $customRewriteruleFlag[$i];
            }
        }
        return $customRewriteRules;
    }

	public function blockBadBots()
	{
		$output = '';
		if($this->badBot) {
			$output .= $this->getBadBots();
		}
		if($this->vulnerabilityScanners) {
			$output .= $this->getVulnerabilityScanners();
		}
		if($this->chineseSearchEngine) {
			$output .= $this->getChineseSearchEngine();
		}
		if($this->russianSearchEngine) {
			$output .= $this->getRussianSearchEngine();
		}
		$output .= '
			<Limit GET POST HEAD>
				Order Allow,Deny
				Allow from all

				# Cyveillance
				deny from 38.100.19.8/29
				deny from 38.100.21.0/24
				deny from 38.100.41.64/26
				deny from 38.105.71.0/25
				deny from 38.105.83.0/27
				deny from 38.112.21.140/30
				deny from 38.118.42.32/29
				deny from 65.213.208.128/27
				deny from 65.222.176.96/27
				deny from 65.222.185.72/29

				Deny from env=bad_bot
			</Limit>';
		return $this->output[] = $output;
	}

	public function getBadBots()
	{
		$output = '
			# Block Bad Bots & Scrapers
			SetEnvIfNoCase User-Agent "Aboundex" bad_bot
			SetEnvIfNoCase User-Agent "80legs" bad_bot
			SetEnvIfNoCase User-Agent "360Spider" bad_bot
			SetEnvIfNoCase User-Agent "^Java" bad_bot
			SetEnvIfNoCase User-Agent "^Cogentbot" bad_bot
			SetEnvIfNoCase User-Agent "^Alexibot" bad_bot
			SetEnvIfNoCase User-Agent "^asterias" bad_bot
			SetEnvIfNoCase User-Agent "^attach" bad_bot
			SetEnvIfNoCase User-Agent "^BackDoorBot" bad_bot
			SetEnvIfNoCase User-Agent "^BackWeb" bad_bot
			SetEnvIfNoCase User-Agent "Bandit" bad_bot
			SetEnvIfNoCase User-Agent "^BatchFTP" bad_bot
			SetEnvIfNoCase User-Agent "^Bigfoot" bad_bot
			SetEnvIfNoCase User-Agent "^Black.Hole" bad_bot
			SetEnvIfNoCase User-Agent "^BlackWidow" bad_bot
			SetEnvIfNoCase User-Agent "^BlowFish" bad_bot
			SetEnvIfNoCase User-Agent "^BotALot" bad_bot
			SetEnvIfNoCase User-Agent "Buddy" bad_bot
			SetEnvIfNoCase User-Agent "^BuiltBotTough" bad_bot
			SetEnvIfNoCase User-Agent "^Bullseye" bad_bot
			SetEnvIfNoCase User-Agent "^BunnySlippers" bad_bot
			SetEnvIfNoCase User-Agent "^Cegbfeieh" bad_bot
			SetEnvIfNoCase User-Agent "^CheeseBot" bad_bot
			SetEnvIfNoCase User-Agent "^CherryPicker" bad_bot
			SetEnvIfNoCase User-Agent "^ChinaClaw" bad_bot
			SetEnvIfNoCase User-Agent "Collector" bad_bot
			SetEnvIfNoCase User-Agent "Copier" bad_bot
			SetEnvIfNoCase User-Agent "^CopyRightCheck" bad_bot
			SetEnvIfNoCase User-Agent "^cosmos" bad_bot
			SetEnvIfNoCase User-Agent "^Crescent" bad_bot
			SetEnvIfNoCase User-Agent "^Custo" bad_bot
			SetEnvIfNoCase User-Agent "^AIBOT" bad_bot
			SetEnvIfNoCase User-Agent "^DISCo" bad_bot
			SetEnvIfNoCase User-Agent "^DIIbot" bad_bot
			SetEnvIfNoCase User-Agent "^DittoSpyder" bad_bot
			SetEnvIfNoCase User-Agent "^Download\ Demon" bad_bot
			SetEnvIfNoCase User-Agent "^Download\ Devil" bad_bot
			SetEnvIfNoCase User-Agent "^Download\ Wonder" bad_bot
			SetEnvIfNoCase User-Agent "^dragonfly" bad_bot
			SetEnvIfNoCase User-Agent "^Drip" bad_bot
			SetEnvIfNoCase User-Agent "^eCatch" bad_bot
			SetEnvIfNoCase User-Agent "^EasyDL" bad_bot
			SetEnvIfNoCase User-Agent "^ebingbong" bad_bot
			SetEnvIfNoCase User-Agent "^EirGrabber" bad_bot
			SetEnvIfNoCase User-Agent "^EmailCollector" bad_bot
			SetEnvIfNoCase User-Agent "^EmailSiphon" bad_bot
			SetEnvIfNoCase User-Agent "^EmailWolf" bad_bot
			SetEnvIfNoCase User-Agent "^EroCrawler" bad_bot
			SetEnvIfNoCase User-Agent "^Exabot" bad_bot
			SetEnvIfNoCase User-Agent "^Express\ WebPictures" bad_bot
			SetEnvIfNoCase User-Agent "Extractor" bad_bot
			SetEnvIfNoCase User-Agent "^EyeNetIE" bad_bot
			SetEnvIfNoCase User-Agent "^Foobot" bad_bot
			SetEnvIfNoCase User-Agent "^flunky" bad_bot
			SetEnvIfNoCase User-Agent "^FrontPage" bad_bot
			SetEnvIfNoCase User-Agent "^Go-Ahead-Got-It" bad_bot
			SetEnvIfNoCase User-Agent "^gotit" bad_bot
			SetEnvIfNoCase User-Agent "^GrabNet" bad_bot
			SetEnvIfNoCase User-Agent "^Grafula" bad_bot
			SetEnvIfNoCase User-Agent "^Harvest" bad_bot
			SetEnvIfNoCase User-Agent "^hloader" bad_bot
			SetEnvIfNoCase User-Agent "^HMView" bad_bot
			SetEnvIfNoCase User-Agent "^HTTrack" bad_bot
			SetEnvIfNoCase User-Agent "^humanlinks" bad_bot
			SetEnvIfNoCase User-Agent "^IlseBot" bad_bot
			SetEnvIfNoCase User-Agent "^Image\ Stripper" bad_bot
			SetEnvIfNoCase User-Agent "^Image\ Sucker" bad_bot
			SetEnvIfNoCase User-Agent "Indy\ Library" bad_bot
			SetEnvIfNoCase User-Agent "^InfoNaviRobot" bad_bot
			SetEnvIfNoCase User-Agent "^InfoTekies" bad_bot
			SetEnvIfNoCase User-Agent "^Intelliseek" bad_bot
			SetEnvIfNoCase User-Agent "^InterGET" bad_bot
			SetEnvIfNoCase User-Agent "^Internet\ Ninja" bad_bot
			SetEnvIfNoCase User-Agent "^Iria" bad_bot
			SetEnvIfNoCase User-Agent "^Jakarta" bad_bot
			SetEnvIfNoCase User-Agent "^JennyBot" bad_bot
			SetEnvIfNoCase User-Agent "^JetCar" bad_bot
			SetEnvIfNoCase User-Agent "^JOC" bad_bot
			SetEnvIfNoCase User-Agent "^JustView" bad_bot
			SetEnvIfNoCase User-Agent "^Jyxobot" bad_bot
			SetEnvIfNoCase User-Agent "^Kenjin.Spider" bad_bot
			SetEnvIfNoCase User-Agent "^Keyword.Density" bad_bot
			SetEnvIfNoCase User-Agent "^larbin" bad_bot
			SetEnvIfNoCase User-Agent "^LexiBot" bad_bot
			SetEnvIfNoCase User-Agent "^lftp" bad_bot
			SetEnvIfNoCase User-Agent "^libWeb/clsHTTP" bad_bot
			SetEnvIfNoCase User-Agent "^likse" bad_bot
			SetEnvIfNoCase User-Agent "^LinkextractorPro" bad_bot
			SetEnvIfNoCase User-Agent "^LinkScan/8.1a.Unix" bad_bot
			SetEnvIfNoCase User-Agent "^LNSpiderguy" bad_bot
			SetEnvIfNoCase User-Agent "^LinkWalker" bad_bot
			SetEnvIfNoCase User-Agent "^lwp-trivial" bad_bot
			SetEnvIfNoCase User-Agent "^LWP::Simple" bad_bot
			SetEnvIfNoCase User-Agent "^Magnet" bad_bot
			SetEnvIfNoCase User-Agent "^Mag-Net" bad_bot
			SetEnvIfNoCase User-Agent "^MarkWatch" bad_bot
			SetEnvIfNoCase User-Agent "^Mass\ Downloader" bad_bot
			SetEnvIfNoCase User-Agent "^Mata.Hari" bad_bot
			SetEnvIfNoCase User-Agent "^Memo" bad_bot
			SetEnvIfNoCase User-Agent "^Microsoft.URL" bad_bot
			SetEnvIfNoCase User-Agent "^Microsoft\ URL\ Control" bad_bot
			SetEnvIfNoCase User-Agent "^MIDown\ tool" bad_bot
			SetEnvIfNoCase User-Agent "^MIIxpc" bad_bot
			SetEnvIfNoCase User-Agent "^Mirror" bad_bot
			SetEnvIfNoCase User-Agent "^Missigua\ Locator" bad_bot
			SetEnvIfNoCase User-Agent "^Mister\ PiX" bad_bot
			SetEnvIfNoCase User-Agent "^moget" bad_bot
			SetEnvIfNoCase User-Agent "^Mozilla/3.Mozilla/2.01" bad_bot
			SetEnvIfNoCase User-Agent "^Mozilla.*NEWT" bad_bot
			SetEnvIfNoCase User-Agent "^NAMEPROTECT" bad_bot
			SetEnvIfNoCase User-Agent "^Navroad" bad_bot
			SetEnvIfNoCase User-Agent "^NearSite" bad_bot
			SetEnvIfNoCase User-Agent "^NetAnts" bad_bot
			SetEnvIfNoCase User-Agent "^Netcraft" bad_bot
			SetEnvIfNoCase User-Agent "^NetMechanic" bad_bot
			SetEnvIfNoCase User-Agent "^NetSpider" bad_bot
			SetEnvIfNoCase User-Agent "^Net\ Vampire" bad_bot
			SetEnvIfNoCase User-Agent "^NetZIP" bad_bot
			SetEnvIfNoCase User-Agent "^NextGenSearchBot" bad_bot
			SetEnvIfNoCase User-Agent "^NG" bad_bot
			SetEnvIfNoCase User-Agent "^NICErsPRO" bad_bot
			SetEnvIfNoCase User-Agent "^niki-bot" bad_bot
			SetEnvIfNoCase User-Agent "^NimbleCrawler" bad_bot
			SetEnvIfNoCase User-Agent "^Ninja" bad_bot
			SetEnvIfNoCase User-Agent "^NPbot" bad_bot
			SetEnvIfNoCase User-Agent "^Octopus" bad_bot
			SetEnvIfNoCase User-Agent "^Offline\ Explorer" bad_bot
			SetEnvIfNoCase User-Agent "^Offline\ Navigator" bad_bot
			SetEnvIfNoCase User-Agent "^Openfind" bad_bot
			SetEnvIfNoCase User-Agent "^OutfoxBot" bad_bot
			SetEnvIfNoCase User-Agent "^PageGrabber" bad_bot
			SetEnvIfNoCase User-Agent "^Papa\ Foto" bad_bot
			SetEnvIfNoCase User-Agent "^pavuk" bad_bot
			SetEnvIfNoCase User-Agent "^pcBrowser" bad_bot
			SetEnvIfNoCase User-Agent "^PHP\ version\ tracker" bad_bot
			SetEnvIfNoCase User-Agent "^Pockey" bad_bot
			SetEnvIfNoCase User-Agent "^ProPowerBot/2.14" bad_bot
			SetEnvIfNoCase User-Agent "^ProWebWalker" bad_bot
			SetEnvIfNoCase User-Agent "^psbot" bad_bot
			SetEnvIfNoCase User-Agent "^Pump" bad_bot
			SetEnvIfNoCase User-Agent "^QueryN.Metasearch" bad_bot
			SetEnvIfNoCase User-Agent "^RealDownload" bad_bot
			SetEnvIfNoCase User-Agent "Reaper" bad_bot
			SetEnvIfNoCase User-Agent "Recorder" bad_bot
			SetEnvIfNoCase User-Agent "^ReGet" bad_bot
			SetEnvIfNoCase User-Agent "^RepoMonkey" bad_bot
			SetEnvIfNoCase User-Agent "^RMA" bad_bot
			SetEnvIfNoCase User-Agent "Siphon" bad_bot
			SetEnvIfNoCase User-Agent "^SiteSnagger" bad_bot
			SetEnvIfNoCase User-Agent "^SlySearch" bad_bot
			SetEnvIfNoCase User-Agent "^SmartDownload" bad_bot
			SetEnvIfNoCase User-Agent "^Snake" bad_bot
			SetEnvIfNoCase User-Agent "^Snapbot" bad_bot
			SetEnvIfNoCase User-Agent "^Snoopy" bad_bot
			SetEnvIfNoCase User-Agent "^sogou" bad_bot
			SetEnvIfNoCase User-Agent "^SpaceBison" bad_bot
			SetEnvIfNoCase User-Agent "^SpankBot" bad_bot
			SetEnvIfNoCase User-Agent "^spanner" bad_bot
			SetEnvIfNoCase User-Agent "^Sqworm" bad_bot
			SetEnvIfNoCase User-Agent "Stripper" bad_bot
			SetEnvIfNoCase User-Agent "Sucker" bad_bot
			SetEnvIfNoCase User-Agent "^SuperBot" bad_bot
			SetEnvIfNoCase User-Agent "^SuperHTTP" bad_bot
			SetEnvIfNoCase User-Agent "^Surfbot" bad_bot
			SetEnvIfNoCase User-Agent "^suzuran" bad_bot
			SetEnvIfNoCase User-Agent "^Szukacz/1.4" bad_bot
			SetEnvIfNoCase User-Agent "^tAkeOut" bad_bot
			SetEnvIfNoCase User-Agent "^Teleport" bad_bot
			SetEnvIfNoCase User-Agent "^Telesoft" bad_bot
			SetEnvIfNoCase User-Agent "^TurnitinBot/1.5" bad_bot
			SetEnvIfNoCase User-Agent "^The.Intraformant" bad_bot
			SetEnvIfNoCase User-Agent "^TheNomad" bad_bot
			SetEnvIfNoCase User-Agent "^TightTwatBot" bad_bot
			SetEnvIfNoCase User-Agent "^Titan" bad_bot
			SetEnvIfNoCase User-Agent "^True_Robot" bad_bot
			SetEnvIfNoCase User-Agent "^turingos" bad_bot
			SetEnvIfNoCase User-Agent "^TurnitinBot" bad_bot
			SetEnvIfNoCase User-Agent "^URLy.Warning" bad_bot
			SetEnvIfNoCase User-Agent "^Vacuum" bad_bot
			SetEnvIfNoCase User-Agent "^VCI" bad_bot
			SetEnvIfNoCase User-Agent "^VoidEYE" bad_bot
			SetEnvIfNoCase User-Agent "^Web\ Image\ Collector" bad_bot
			SetEnvIfNoCase User-Agent "^Web\ Sucker" bad_bot
			SetEnvIfNoCase User-Agent "^WebAuto" bad_bot
			SetEnvIfNoCase User-Agent "^WebBandit" bad_bot
			SetEnvIfNoCase User-Agent "^Webclipping.com" bad_bot
			SetEnvIfNoCase User-Agent "^WebCopier" bad_bot
			SetEnvIfNoCase User-Agent "^WebEMailExtrac.*" bad_bot
			SetEnvIfNoCase User-Agent "^WebEnhancer" bad_bot
			SetEnvIfNoCase User-Agent "^WebFetch" bad_bot
			SetEnvIfNoCase User-Agent "^WebGo\ IS" bad_bot
			SetEnvIfNoCase User-Agent "^Web.Image.Collector" bad_bot
			SetEnvIfNoCase User-Agent "^WebLeacher" bad_bot
			SetEnvIfNoCase User-Agent "^WebmasterWorldForumBot" bad_bot
			SetEnvIfNoCase User-Agent "^WebReaper" bad_bot
			SetEnvIfNoCase User-Agent "^WebSauger" bad_bot
			SetEnvIfNoCase User-Agent "^Website\ eXtractor" bad_bot
			SetEnvIfNoCase User-Agent "^Website\ Quester" bad_bot
			SetEnvIfNoCase User-Agent "^Webster" bad_bot
			SetEnvIfNoCase User-Agent "^WebStripper" bad_bot
			SetEnvIfNoCase User-Agent "^WebWhacker" bad_bot
			SetEnvIfNoCase User-Agent "^WebZIP" bad_bot
			SetEnvIfNoCase User-Agent "Whacker" bad_bot
			SetEnvIfNoCase User-Agent "^Widow" bad_bot
			SetEnvIfNoCase User-Agent "^WISENutbot" bad_bot
			SetEnvIfNoCase User-Agent "^WWWOFFLE" bad_bot
			SetEnvIfNoCase User-Agent "^WWW-Collector-E" bad_bot
			SetEnvIfNoCase User-Agent "^Xaldon" bad_bot
			SetEnvIfNoCase User-Agent "^Xenu" bad_bot
			SetEnvIfNoCase User-Agent "^Zeus" bad_bot
			SetEnvIfNoCase User-Agent "ZmEu" bad_bot
			SetEnvIfNoCase User-Agent "^Zyborg" bad_bot';
		return $output;
	}

	public function getVulnerabilityScanners()
	{
		$output = '# Vulnerability Scanners
					SetEnvIfNoCase User-Agent "Acunetix" bad_bot
					SetEnvIfNoCase User-Agent "FHscan" bad_bot';
		return $output;
	}

	public function getChineseSearchEngine()
	{
		$output = '# Aggressive Chinese Search Engine
					SetEnvIfNoCase User-Agent "Baiduspider" bad_bot';
		return $output;
	}

	public function getRussianSearchEngine()
	{
		$output = '# Aggressive Russian Search Engine
					SetEnvIfNoCase User-Agent "Yandex" bad_bot';
		return $output;
	}

	public function generate()
	{
		$outputString = '';
		foreach($this->output as $temp) {
			$outputString .= $temp;
		}
		return htmlentities(trim(preg_replace('/\t+/', '', $outputString))); 
	}
}