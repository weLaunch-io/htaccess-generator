<?php
namespace lib;

class Auth {

	private $password;
	public $app;

	public function __construct($app) {
		$this->app = $app;
		$settings = $app->settings;

		$this->password = $settings['custom']['password'];
	}

	public function login()
	{
		$app = $this->app;
		$request = $app->request()->post();

		if($request['password'] === $this->password){
			$app->setCookie('admin', TRUE);
			return TRUE;
		}
		return FALSE;
	}

	public function logout()
	{
		$app = $this->app;
		$app->setCookie('admin', FALSE);
		return TRUE;
	}

	public function isLoggedIn()
	{
		return $this->app->getCookie('admin');
	}
}