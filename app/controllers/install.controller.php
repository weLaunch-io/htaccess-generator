<?php

class install extends \SlimController\SlimController
{
    public function index()
    {
    	$app = $this->app;
    	$auth = $app->auth;

    	$this->render('install.php');
    }

    public function install2()
    {
        $app = $this->app;

        $request = $app->request()->post();

        if($request['password'] != $request['passwordRepeat']){
          $message['message'][] = _('<h3>Passwords did not match</h3>');
          $message['return'] = "0";
          $app->flash('messages', $message);
          $app->redirect($app->view()->getLangPath().'/install/');
        }

        if(empty($request['password']) || empty($request['host']) || empty($request['basename']) ||
            empty($request['user']) || empty($request['dbpassword'])){
            $message['message'][] = _('<h3>You left something out ...</h3>');
            $message['return'] = "0";
            $app->flash('messages', $message);
            $app->redirect($app->view()->getLangPath().'/install/');
        }
        
        $sampleConfig = array(

            'custom' => array(
                // DB Config
                'db.host'       => 'localhost',
                'db.basename'   => '',
                'db.port'       => '',
                'db.user'       => '',
                'db.password'   => '',

                // Project Config
                'path'          => 'http://'.$_SERVER['SERVER_NAME'],
                'password'      => '',
                'installed'     => false,

                // Language Config
                'availableLangs'=> array('en-US', 'de-DE')
            ),

            // Debug
            'debug' => true,
            'log.enable' => true,
            'log.level' => \Slim\Log::DEBUG,

            // Controller
            'controller.class_suffix'    => '',
            'controller.method_suffix'   => '',
            'controller.template_suffix'   => 'php',

        );

        $sampleConfig['custom']['password'] = $request['password'];
        $sampleConfig['custom']['installed'] = true;

        $sampleConfig['custom']['db.host'] = $request['host'];
        $sampleConfig['custom']['db.basename'] = $request['basename'];
        $sampleConfig['custom']['db.port'] = $request['port'];
        $sampleConfig['custom']['db.user'] = $request['user'];
        $sampleConfig['custom']['db.password'] = $request['dbpassword'];

        $config = $sampleConfig;

        $dsn = 'mysql:host=' . $request['host'].
               ';dbname='    . $request['basename'].
               ';port='      . $request['port'].
               ';connect_timeout=15';          
        $dbuser = $request['user'];        
        $dbpass = $request['dbpassword'];

        try {
           $db = new PDO($dsn, $dbuser, $dbpass, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
           $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            $message['message'][] = $e->getMessage();
            $message['return'] = "0";
            $app->flash('messages', $message);
            $app->redirect($app->view()->getLangPath().'/install/');
        }

        $htaccessModel = new \models\htaccesses($app);
        
        $createDatabase = $htaccessModel->create($db, $request['basename']);

        if(file_put_contents('../app/config/config.json', json_encode($config))){
           $app->redirect($app->view()->getLangPath().'/');     
        } else {
            echo "File put contents failed ...";
        }
    }
}