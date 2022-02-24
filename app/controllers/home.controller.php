<?php

class home extends \SlimController\SlimController
{
    public function index()
    {
    	$app = $this->app;
    	$auth = $app->auth;

    	if($auth->isLoggedIn()){
            $app->redirect($app->view()->getLangPath().'/new-htaccess/');
		} else {
			$app->redirect($app->view()->getLangPath().'/login/');
		};
    }
}