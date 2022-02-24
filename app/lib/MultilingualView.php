<?
namespace lib;

class MultilingualView extends \Slim\View {
    private $app;
    private $chars;
    private $translator;
    private $log;
    private $path;
    protected $masterView;

    public function __construct(\Slim\Slim $app, $path) {
        parent::__construct();
        $this->app = $app;
        $this->log = $app->getLog();

        $chars = get_html_translation_table(HTML_ENTITIES);
        $remove = get_html_translation_table(HTML_SPECIALCHARS);
        unset($remove['&']);

        $this->chars = array_diff($chars, $remove);

        $this->path = $path;
        if (substr($this->path, -1) != '/') {
            $this->path .= '/';
        }

        $app->hook('slim.before', function () use ($app) { 
            $this->initDefaults();
            $this->initGettext();
        });
    }

    public function setMasterView($masterView) 
    {
        $this->masterView = $masterView;
    }

    public function render($template, $data = NULL) {

        if($this->masterView !== null) {
            $this->setData('child', $template);
            return parent::render($this->masterView);
        }
        return parent::render($template);
    }

    public function getLang() {
        return $this->getData('lang');
    }
    public function setLang($lang) {
        $this->setData('lang', $lang);
    }
    public function getAvailableLangs() {
        return $this->getData('availableLangs');
    }
    public function setAvailableLangs($availableLangs) {
        $this->setData('availableLangs', $availableLangs);
    }
    public function setPathInfo($pathInfo) {
        $this->setData('pathInfo', $pathInfo);
    }
    public function getPathInfo() {
        return $this->getData('pathInfo');
    }
    public function setFullPath($fullPath) {
        $this->setData('fullPath', $fullPath);
    }
    public function getFullPath() {
        return $this->getData('fullPath');
    }
    public function setBasePath($basePath)
    {
        $this->setData('basePath', $basePath);
    }
    public function getBasePath() {
        return $this->getData('basePath');
    }
    public function setLangPath($langPath)
    {
        $this->setData('langPath', $langPath);
    }
    public function getLangPath() {
        return $this->getData('langPath');
    }
    public function urlFor($name, $params = array()) {
        return $this->app->urlFor($name, $params);
    }
    public function url($url, $lang = null) {
        return sprintf('/%s%s', ($lang != null) ? $lang : $this->getLang(), $url);
    }
    public function tr($key, $replacements = array()) {
        global $locale;
        $text = '';

        if (!array_key_exists($key, $locale)) {
            $this->log->error("Translation of $key was not found.");
            return '';
        } else {
            $text = $locale[$key];
        }

        if (is_array($replacements) && count($replacements) > 0) {
            foreach($replacements as $name => $value) {
                $text = str_replace('{{' . $name . '}}', $value, $text);
            }
        }

        return $text;
       // $this->htmlEntitiesButTags($this->translator->translate($this->getLang(), $key, $replacements));
    }
    private function htmlEntitiesButTags($txt) {
        return strtr($txt, $this->chars);
    }
    public function initDefaults(){
        $app = $this->app;
        $env = $app->environment();
        $config = $app->config('custom');
        $availableLangs = $config['availableLangs'];

        // setup default lang based on first in the list
        $lang = $availableLangs[0];
        // die(print_r($env));
        // if they are accessing the root, direct them to the correct language
        if ($env['PATH_INFO'] == '/') {

            $pathInfo = $env['PATH_INFO'];

            if (isset($env['HTTP_ACCEPT_LANGUAGE'])) {
                preg_match_all('/([a-z]{1,8}(-[a-z]{1,8})?)\s*(;\s*q\s*=\s*(1|0\.[0-9]+))?/i', $env['HTTP_ACCEPT_LANGUAGE'], $lang_parse);

                if (count($lang_parse[1])) {

                    $acceptedLangs = array_combine($lang_parse[1], $lang_parse[4]);

                    // set default to 1 for any without q factor
                    foreach ($acceptedLangs as $acceptedLang => $val) {
                        if ($val === '') $acceptedLangs[$acceptedLang] = 1;
                    }

                    // sort list based on value 
                    arsort($acceptedLangs, SORT_NUMERIC);
                }

                // look through sorted list and use first one that matches our languages
                foreach ($acceptedLangs as $acceptedLang => $val) {
                    if (in_array($acceptedLang, $availableLangs)) {
                        // die($config['path'].'/'.$acceptedLang.'/');
                        return $app->redirect($config['path'].'/'.$acceptedLang.'/');
                    }
                }

                return $app->redirect($config['path'].'/'.$lang.'/');
            }
        } else {

            $pathInfo = $env['PATH_INFO'] . (substr($env['PATH_INFO'], -1) !== '/' ? '/' : '');

            // extract lang from PATH_INFO
            foreach($availableLangs as $availableLang) {
                $match = '/'.$availableLang;
                if (strpos($pathInfo, $match.'/') === 0) {
                    $lang = $availableLang;
                    $env['PATH_INFO'] = substr($env['PATH_INFO'], strlen($match));

                    if (strlen($env['PATH_INFO']) == 0) {
                        $env['PATH_INFO'] = '/';
                    }
                }
            }
        }

        $this->setBasePath($config['path']);
        $this->setFullPath($config['path'].$pathInfo);
        $this->setLangPath($app->path.'/'.$lang);
        $this->setLang($lang);
        $this->setAvailableLangs($availableLangs);
        $this->setPathInfo($env['PATH_INFO']);
    }

    public function initGettext()
    {
        if (!function_exists("gettext")) {
            $this->app->log->info('gettext not supported!');
            function _($str) {
                return $str;
            }
        }

        $locale = str_replace("-", "_", $this->getLang());

        putenv("LANG=" . $locale); 
        setlocale(LC_ALL, $locale);

        $domain = "htaccess";
        bindtextdomain($domain, "../app/locale"); 
        bind_textdomain_codeset($domain, 'UTF-8');

        textdomain($domain);
    }
}