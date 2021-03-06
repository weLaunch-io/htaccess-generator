<?

/**
 * Log request info
 */
$app->hook('log.request.info', function ($msg = null) use ($app) {
    $data = array(
        'Request URL'       => $app->request()->getUrl().$app->request()->getPathInfo(),
        'Request referrer'  => $app->request()->getReferrer(),
        'Client IP'         => $app->request()->getIp(),
        'User Agent'        => $app->request()->getUserAgent(),
        'Script name'       => $app->request()->getScriptName(),
    );
    $app->log->info($msg, $data);
});
/**
 * Encode body data to Content-Type format
 * @todo handler for all formats
 */
$app->hook('slim.after.dispatch', function () use ($app) {
    $contentType = $app->response->header('Content-Type');
    if ($contentType == 'application/json') {
        $app->response->setBody(json_encode(array('body' => $app->response->getBody())));
    }
});
/**
 * Set response as JSON if request is AJAX
 */
$app->hook('slim.before.router', function () use ($app) {
    // if ($app->request->isAjax()) {
    //     $app->response->header('Content-Type', 'application/json');
    // }
});

$app->hook('slim.before.dispatch', function() use ($app) {
    $path = $app->request()->getPathInfo();

    if($app->config('custom')['installed'] == false && $path != "/install/"){
        $app->redirect($app->view()->getLangPath().'/install/');
    }

    if($path == "/install/" && $app->config('custom')['installed'] == true) {
        $app->redirect($app->view()->getLangPath().'/');
    }

    if($app->auth->isLoggedIn()) {
        $app->view()->setData('isLoggedIn', TRUE);
    }

});