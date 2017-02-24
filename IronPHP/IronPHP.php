<?php

##初始化常量
defined('APP_PATH') or define('APP_PATH', dirname($_SERVER['SCRIPT_NAME']));
defined('FRAME_PATH') or define('FRAME_PATH', __DIR__.'/');

##引入配置文件
require APP_PATH.'config/config.php';

##引入框架
require FRAME_PATH.'IronPHP/IronPHP.php';

