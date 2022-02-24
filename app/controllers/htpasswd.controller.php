<?php

class htpasswd extends \SlimController\SlimController
{
    public function getHtpasswd()
    {
        $app = $this->app;

        $request = $app->request()->post();

        $protectionUserNames = $request['protectionUserName'];
        $protectionUserPasswords = $request['protectionUserPassword'];
        $encryptionMethod = $request['encryptionMethod'];

        $htpasswd = "";
        $count = count($protectionUserNames);
        for($i = 0; $i < $count; $i++){
            $password = $protectionUserPasswords[$i];
            if($encryptionMethod == "md5"){
                $encryptedPassword = md5($password);
            } elseif($encryptionMethod == "des"){
                $encryptedPassword = crypt($password, base64_encode($password));
                // $encryptedPassword = password_hash($password, PASSWORD_DEFAULT);
            } elseif($encryptionMethod == "sha1"){
                $encryptedPassword = sha1($password);
            }
            $htpasswd .= $protectionUserNames[$i].':'.$encryptedPassword."\r";
        }
        echo json_encode($htpasswd);
        return true;
    }
}