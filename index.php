<?php

define('PHPONE',realpath('./'));  //框架目录
define('CORE',PHPONE.'/core');	//核心目录
define('APP',PHPONE.'/app');	//项目目录
define('MODEL','app');
define('DEBUG',true);
include "vendor/autoload.php";

if(DEBUG){
	$whoops = new \Whoops\Run;
	$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
	$whoops->register();
	ini_set('display_error','On');
}else{
	ini_set('display_error','Off');
}

include CORE.'/common/function.php';
include CORE.'/phpone.php';

spl_autoload_register('\core\phpone::load');
\core\phpone::run();

