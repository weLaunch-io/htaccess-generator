<?

$app->addRoutes(array(
    '/install/' => [
            'get' => 'install:index',
            'post' => 'install:install2',
            ],
    '/' => [
            'get' => 'home:index',
            ],
    '/new-htaccess/' => [
    		'get' => 'htaccess:index',
			],
    '/login/' => [
    		'get' => 'Auth:index',
    		'post' => 'Auth:login'
			],
    '/logout/' => [
    		'get' => 'Auth:logout',
			],
    '/get-htaccess/' => [
    		'post' => 'htaccess:getHtaccess',
			],
    '/get-htpasswd/' => [
            'post' => 'htpasswd:getHtpasswd',
            ],
    '/my-htaccesses/' => [
            'get'  => 'htaccess:myHtaccesses',
            'post' => 'htaccess:getMyHtaccesses',
            ],
    '/download-htaccess/:id/' => [
            'get' => 'htaccess:downloadHtaccess',
            ],
    '/delete-htaccess/:id/' => [
            'get' => 'htaccess:deleteHtaccess',
            ],
    '/tmp/get-htaccess-download-link/' => [
            'POST' => 'htaccess:generateTmpHtaccessDownloadLink',
            ],
    '/tmp/download-htaccess/' => [
            'get' => 'htaccess:downloadTmpHtaccess',
            ],
    '/save-htaccess/' => [
            'post' => 'htaccess:saveHtaccess',
            ],
    
));