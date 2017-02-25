<?php
/**
 *  IronPHP核心代码
 */
class Core{

    ##运行程序
    function run() {
        spl_autoload_register(array($this, 'loadClass'));
        $this->setReporting();
        $this->removeMagicQuotes();

        $this->unregisterGlobals();

        $this->route();
    }

    /**
     * @param $class
     */
    function loadClass($class){
        $framework = FRAME_PATH . $class . '.class.php';
        $controller = APP_PATH . 'application/Controllers/' . $class . '.class.php';
        $model = APP_PATH . 'application/Models/' . $class . '.class.php';
        if(file_exists($framework)){
            include $framework;
        } elseif(file_exists($controller)){
            include $controller;
        } elseif(file_exists($model)){
            include $model;
        } else {
            var_dump('false');
        }

    }

    /**
     * 检测开发环境
     */
    function setReporting(){
        if(APP_DEBUG === true){
            error_reporting(E_ALL);
            ini_set('display_errors', true);

        } else {
            error_reporting(E_ALL);
            ini_set('display_errors', false);
            ini_set('log_errors', true);
//            exit(RUNTIME_PATH);
            ini_set('error_log', RUNTIME_PATH.'logs/error.log');

        }
    }

    function stripSlashesDeep($value){
        $value = is_array($value)? array_map('stripSlashesDeep', $value) : stripslashes($value);
        return $value;
    }

    /**
     * 检测敏感词
     */
    function removeMagicQuotes(){
//        $_GET = $this->stripSlashesDeep($_GET);
//        $_POST = $this->stripSlashesDeep($_POST);
//        $_COOKIE = $this->stripSlashesDeep($_COOKIE);
//        $_SESSION = $this->stripSlashesDeep($_SESSION);
    }

    function unregisterGlobals(){
        if(ini_get('register_globals')){
            $array = array('_SESSION', '_POST', '_GET', '_COOKIE', '_REQUEST', '_SERVER', '_ENV', '_FILES');
            foreach($array as $val){
                foreach($GLOBALS[$val] as $k => $v){
                    if($v == $GLOBALS[$k]){
                        unset($GLOBALS[$k]);
                    }
                }
            }
         }
    }

    //路由设置
    function route(){
        $controllerName = 'Index';
        $action = 'index';
        if(!empty($_GET['url'])){
            $url = $_GET['url'];
            $urlArray = explode('/', $url);
            array_shift($urlArray);

            $controllerName = ucfirst($urlArray[0]);

            array_shift($urlArray);
            $action = !empty($urlArray) ? $urlArray[0] : 'index';

            //获取url参数
            array_shift($urlArray);
            $queryString = empty($urlArray) ? array() : $urlArray;
        }

        $queryString = empty($queryString) ? array() : $queryString;

        $controller = $controllerName . 'Controller';

        $dispatch = new $controller($controllerName, $action);

        //判断控制器中的方法是否存在
        if (intval(method_exists($controller, $action))) {
            call_user_func_array(array($dispatch, $action), $queryString);
        } else {
            exit($controller. '->' . $action . '   not found');
        }
    }
}