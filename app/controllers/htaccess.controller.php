<?php

class htaccess extends \SlimController\SlimController
{
    public function index()
    {
    	$app = $this->app;
    	$auth = $app->auth;

    	if($auth->isLoggedIn()){
            $app->view->setMasterView('master.php');
            $this->render('newHtaccess.php');
		} else {
			$app->redirect($app->view()->getLangPath().'/login/');
		};
    }

    public function getHtaccess($id = null)
    {
        $app = $this->app;
        
        if($id !== null){ 
            $htaccessModel = new \models\htaccesses($app);
            $request = $htaccessModel->getHtaccess($id);
        } else {
            $request = $app->request()->post();
        }
        extract($request);

        $output = '';
        if($showComments == "yes")
        {
            $htaccessGenerator = new lib\htaccessGenerator(true);
        } else {
            $htaccessGenerator = new lib\htaccessGenerator(false);
        }

        if($crossOriginRequests == "yes"){
            $htaccessGenerator->crossOriginRequests();
        }

        if($crossOriginImages == "yes"){
            $htaccessGenerator->crossOriginImages();
        }

        if($crossOriginWebfonts == "yes") {
            $htaccessGenerator->crossOriginWebfonts();
        }

        if($CrossOriginResourceTiming == "yes") {
            $htaccessGenerator->CrossOriginResourceTiming();
        }

        if($internetExplorer == "yes") {
            $htaccessGenerator->internetExplorer();
        }

        if($iframeCookies == "yes") {
            $htaccessGenerator->iframeCookies();
        }

        if($mediaTypes == "yes") {
            $htaccessGenerator->mediaTypes();
        }

        if($characterEncoding == "yes") {
            $htaccessGenerator->characterEncoding();
        }

        if($characterEncodingFiles == "yes") {
            $htaccessGenerator->characterEncodingFiles();
        }

        if($compression == "yes") {
            $htaccessGenerator->compression();
        }

        if($contentTransformation == "yes") {
            $htaccessGenerator->contentTransformation();
        }

        if($fileConcatentation == "yes") {
            $htaccessGenerator->fileConcatentation();
        }

        if($fileCacheBusting == "yes") {
            $htaccessGenerator->fileCacheBusting();
        }

        if($ETags == "yes") {
            $htaccessGenerator->ETags();
        }

        if($expiresHeader == "yes") {
            if(!isset($expires)){
                $expires = $htaccessGenerator->buildExpires($expireType, $expireTimeValue, $expireTime);
            }
            $htaccessGenerator->expiresHeader($expiresDefault, $expires);
        }

        if($protection == "yes") {
            if(!empty($protectionName)) {
                $htaccessGenerator->protectionName = $protectionName;
            }

            if(!empty($protectionPath)) {
                $htaccessGenerator->protectionPath = $protectionPath;
            }

            if(!empty($protectionUserName)) {
                $htaccessGenerator->protectionUserName = $protectionUserName;
            }

            if(!empty($protectionUserPassword)) {
                $htaccessGenerator->protectionUserPassword = $protectionUserPassword;
            }
            $htaccessGenerator->generateProtection();
        }

        if($errorPrevention == "yes") {
            $htaccessGenerator->errorPrevention();
        }

        if(!empty($errorCode)){
            $errors = $htaccessGenerator->buildErrors($errorCode, $errorDocument);
            $htaccessGenerator->errorPages($errors);
        }

        if($clickjacking == "yes") {
            $htaccessGenerator->clickjacking();
        }

        // if($CSP == "yes") {
        //     $htaccessGenerator->CSP();
        // }

        if($fileAccess == "yes") {
            $htaccessGenerator->fileAccess();
        }

        if($blockHiddenFiles == "yes") {
            $htaccessGenerator->blockHiddenFiles();
        }

        if($blockSensitiveInformation == "yes") {
            $htaccessGenerator->blockSensitiveInformation();
        }

        if($HSTS == "yes") {
            $htaccessGenerator->HSTS();
        }

        if($MIMETypeSecurity == "yes") {
            $htaccessGenerator->MIMETypeSecurity();
        }

        if($enableXSSFilter == "yes") {
            $htaccessGenerator->enableXSSFilter();
        }

        if($removeXpowered == "yes") {
            $htaccessGenerator->removeXpowered();
        }

        if($showServerInformation == "yes") {
            $htaccessGenerator->showServerInformation();
        }

        if($rewriteEngine == "yes") {
            $htaccessGenerator->followSymlinks = $followSymlinks;
            $htaccessGenerator->SymLinksIfOwnerMatch = $SymLinksIfOwnerMatch;
            $htaccessGenerator->rewriteBase = $rewriteBase;
            // $htaccessGenerator->rewriteOptions = $rewriteOptions;
            $htaccessGenerator->allowAppropriateSchema = $allowAppropriateSchema;
            if(!empty($customRewriterulePattern)){
                $customRewriteRules = $htaccessGenerator->buildCustomRewriteRules($customRewriterulePattern, $customRewriteruleSubstitution, $customRewriteruleFlag);
                $htaccessGenerator->customRewriteRules = $customRewriteRules;
            }
            $htaccessGenerator->rewriteEngine();
        }

        if($forcehttps == "yes") {
            $htaccessGenerator->forcehttps();
        }

        if($forcewww == "yes") {
            $htaccessGenerator->forcewww();
        }

        if($blockBadBots == "yes") {
            if(isset($badBot) && $badBot == "yes") {
                $htaccessGenerator->badBot = true;
            }
            if(isset($vulnerabilityScanners) && $vulnerabilityScanners == "yes") {
                $htaccessGenerator->vulnerabilityScanners = true;
            }
            if(isset($chineseSearchEngine) && $chineseSearchEngine == "yes") {
                $htaccessGenerator->chineseSearchEngine = true;
            }
            if(isset($russianSearchEngine) && $russianSearchEngine == "yes") {
                $htaccessGenerator->russianSearchEngine = true;
            }
            $htaccessGenerator->blockBadBots();     
        }

        echo json_encode($htaccessGenerator->generate());
        return true;
    }

    public function getMyHtaccesses()
    {
        $app = $this->app;

        $htaccessModel = new \models\htaccesses($app);
        
        $htaccesses = $htaccessModel->getAll();
        $htaccessesCount = count($htaccesses);
        echo json_encode($htaccessesCount);
    }

    public function myHtaccesses()
    {
        $app = $this->app;
        $auth = $app->auth;

        $htaccessModel = new \models\htaccesses($app);
        
        $htaccesses = $htaccessModel->getAll();

        if($auth->isLoggedIn()){
            $app->view->setMasterView('master.php');
            $this->render('myHtaccesses.php', array('htaccesses' => $htaccesses));
        } else {
            $app->redirect($app->view()->getLangPath().'/login/');
        };
    }
    
    public function generateTmpHtaccessDownloadLink()
    {
        $app = $this->app;
        $request = $app->request()->post();
        $id = uniqid();

        $htaccess = html_entity_decode($request['htaccess']);
        $f = fopen("assets/htaccess/.htaccess_".$id, "a+");
        fwrite($f, $htaccess);
        fclose($f);

        $return = array();
        $return['id'] = $id;
        $return['title'] = _('Download successfull!');
        $return['text'] = _('The download of your htaccess should have started automatically.');
        echo json_encode($return);
        return true;
    }

    public function downloadHtaccess($id)
    {
        $app = $this->app;
        $request = $app->request()->get();

        ob_start();
        $this->getHtaccess($id);
        $htaccess = ob_get_contents();
        ob_end_clean();

        $htaccess = html_entity_decode(json_decode($htaccess));
        $f = fopen("assets/htaccess/.htaccess_".$id, "w+");
        fwrite($f, $htaccess);
        fclose($f);

        header('Content-disposition: attachment; filename=_.htaccess');
        header('Content-type: text/plain');
        readfile("assets/htaccess/.htaccess_".$id);
    }

    public function deleteHtaccess($id)
    {
        $app = $this->app;
        $htaccessModel = new \models\htaccesses($app);
        $auth = $app->auth;

        if($auth->isLoggedIn()){
            $delete = $htaccessModel->delete($id);
            $message['message'][] = _('Delete successfull');
            $message['return'] = "1";
            $app->flash('messages', $message);

            $app->view->setMasterView('master.php');
            $app->redirect($app->view()->getLangPath().'/my-htaccesses/');
        } else {
            $app->redirect($app->view()->getLangPath().'/login/');
        };
    }

    public function downloadTmpHtaccess()
    {
        $app = $this->app;
        $request = $app->request()->get();

        $id = $request['id'];

        header('Content-disposition: attachment; filename=_.htaccess');
        header('Content-type: text/plain');
        readfile("assets/htaccess/.htaccess_".$id);

        unlink("assets/htaccess/.htaccess_".$id);
    }
    
    public function saveHtaccess()
    {
        $app = $this->app;
        $request = $app->request()->post();
        extract($request);
        $htaccessModel = new \models\htaccesses($app);
        $htaccessGenerator = new lib\htaccessGenerator(true);

        $data = $request;
        $data['expires'] = $htaccessGenerator->buildExpires($expireType, $expireTimeValue, $expireTime);
        $data['errors'] = $htaccessGenerator->buildErrors($errorCode, $errorDocument);
        $data['customRewriteRules'] = $htaccessGenerator->buildCustomRewriteRules($customRewriterulePattern, $customRewriteruleSubstitution, $customRewriteruleFlag);
        $htaccessModel->insert($data);

        $return = array();
        $return['title'] = _('htaccess saved!');
        $return['text'] = _('You can view your htaccess when you click on `my htaccess` in the left sidebar');
        echo json_encode($return);
        return true;
    }
}