<?php
namespace lib;

class MultilingualSlim extends \Slim\Slim {
    public function urlFor( $name, $params = array() ) {
        return sprintf('/%s%s', $this->view()->getLang(), parent::urlFor($name, $params));
    }
}