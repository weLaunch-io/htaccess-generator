<?php

class Auth extends \SlimController\SlimController
{
	public function index()
	{
		$app = $this->app;
		$auth = $app->auth;

		if($auth->isLoggedIn()){
			$app->redirect($app->view()->getLangPath().'/admin/');
		}

		$this->render('login.php');
	}

	public function login()
	{
		$app = $this->app;
		$auth = $app->auth;

		if($auth->login()){
		  	$message['return'] = "1";
			$message['message'][] = _('<h4>Login successfull</h4><p>If you need help with operation or if you get any error please contact us via <b>codecanyon</b></p>');
		  	$app->flash('messages', $message);
		  	$app->redirect($app->view()->getLangPath().'/new-htaccess/');
		}
		else {
		  	$message['message'][] = _('<h4>Login failed</h4> Wrong password.');
		  	$message['return'] = "0";
		  	$app->flash('messages', $message);
		  	$app->redirect($app->view()->getLangPath().'/login/');
		}

	}

	public function logout()
	{
		$app = $this->app;
		$auth = $app->auth;

		if($auth->logout()){
			$message['message'][] = _('You have been signed out.');
			$message['return'] = "1";
			$app->flash('messages', $message);
			$app->redirect($app->view()->getLangPath().'/login/');
		} else {
			throw new Exception("Logout not successfull", 1);
			
		}

	}
}