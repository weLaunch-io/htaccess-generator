<?
$config = file_get_contents('../app/config/config.json');
$config = json_decode($config, true);
$config['custom']['path'] = 'http://'.$_SERVER['SERVER_NAME'];
$config['templates.path'] = dirname(__DIR__) .'/templates';
            // Cookies
$config['cookies.secret_key'] = md5($_SERVER['SERVER_NAME']);
$config['cookies.lifetime'] = time() + (1 * 24 * 60 * 60); // = 1 da;
$config['cookies.cipher'] = MCRYPT_RIJNDAEL_256;
$config['cookies.cipher_mode'] = MCRYPT_MODE_CBC;

$app = new \SlimController\Slim($config);

// Check debugging
if ($app->config('debug') === true) {
    ini_set('display_errors', 'On');
    error_reporting(E_ALL);
    $app->config('whoops.editor', 'sublime');
    $app->add(new \Zeuxisoo\Whoops\Provider\Slim\WhoopsMiddleware);
} else {
    function handleError($exception) {
        $message = 'Message: '.$exception->getMessage()."\r\n";
        $message .= 'Code: '.$exception->getCode()."\r\n";
        $message .= 'File: '.$exception->getFile()."\r\n";
        $message .= 'Line: '.$exception->getLine()."\r\n";
        $message .= 'Request URL: '.$_SERVER['SERVER_NAME']."\r\n";
        mail('contact@db-dzine.de', 'Exception - htaccess generator', $message);
        echo "<html><head><title>Error</title><style>body{margin:0;padding:30px;font:12px/1.5 Helvetica,Arial,Verdana,sans-serif;}h1{margin:0;font-size:48px;font-weight:normal;line-height:48px;}strong{display:inline-block;width:65px;}</style></head><body><h1>Error</h1><p>A website error has occurred. The website administrator has been notified of the issue. Sorry for the temporary inconvenience.</p></body></html>";
        return true;
    }

    $app->error('handleError');
    set_error_handler("handleError"); 
    set_exception_handler("handleError");
}

// Create monolog logger
$app->container->singleton('log', function () use ($app) {

    $logpath = APP_PATH.'/logs/'.date('Y/m');
    $logfile = $logpath.'/'.date('d').'.log';
    $old = umask(0);
    if (!is_dir($logpath)){ mkdir($logpath, 0777, true); }
    if (!is_writable($logpath)){ chmod($logfile, 0777); }
    if (!file_exists($logfile)){ file_put_contents($logfile, ''); }
    umask($old);
    $log = new \Monolog\Logger(strtoupper($app->request->getHost()));
    $log->pushHandler(new \Monolog\Handler\StreamHandler($logfile, \Psr\Log\LogLevel::DEBUG, true, 0777));
    return $log;
});

\Monolog\ErrorHandler::register($app->log);

$app->container->singleton('db', function ($container) {
    if($container['settings']['custom']['installed'] == false) {
        return false;
    }

    $settings = $container['settings']['custom'];

    $dsn = 'mysql:host=' . $settings['db.host'].
           ';dbname='    . $settings['db.basename'].
           ';port='      . $settings['db.port'].
           ';connect_timeout=15';          
    $dbuser = $settings['db.user'];        
    $dbpass = $settings['db.password'];

    try {
       $db = new PDO($dsn, $dbuser, $dbpass, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
       $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo _("<h2>MySQL Error:</h2>");
        echo $e->getMessage();
        echo "<br/><br/><b>";
        echo _('Maybe you have entered wrong MySQL credentials? Please fix this by installing the script again with the right credentials!');
        echo "</b>";
        die();
    }

    return $db;
});

$app->container->singleton('auth', function () use ($app) {
    return new lib\Auth($app);
});

$app->add(new \Slim\Middleware\SessionCookie(array('secret' => $app->setttings['cookies.secret_key'])));
$app->add(new \Slim\Extras\Middleware\CsrfGuard());

// Set view object for Slim to use
$app->view(new lib\MultilingualView($app, './lang'));

/**
 * Require all models
 */
foreach (glob(dirname(__DIR__)."/models/*.model.php") as $filename) {
    require $filename;
}
/**
 * Require all controllers
 */
foreach (glob(dirname(__DIR__)."/controllers/*.controller.php") as $filename) {
    require $filename;
}
require dirname(__DIR__)."/hooks.php";
require dirname(__DIR__)."/routes.php";

$app->run();