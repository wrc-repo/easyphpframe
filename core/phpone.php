<?php
namespace core;
use core\lib\log;
use core\lib\route;
class phpone{

	public static $classMap = [];
	public $assign;

	static public function run(){
		log::init();
		$route = new route;
		$controller = $route->controller;
		$action = $route->action;
		$controller_file = APP.'/controller/'.$controller.'Controller.php';
		$ctrlClass = '\\'.MODEL.'\controller\\'.$controller.'Controller';

		if(is_file($controller_file)){
			include $controller_file;
			$ctrl = new $ctrlClass;
			$ctrl->$action();
			log::log('controller:'.$controller.'  '.'action:'.$action);  //记录日志
		}else{
			throw new \Exception("控制器不存在".$controller_file);
		}

	}


	static public function load($class){
		if(isset($classMap[$class])){
			return true;
		}else{
			$class = str_replace('\\', '/', $class);
			$file  = PHPONE . '/' .$class . '.php';
			if(is_file($file)){
				include $file;
				self::$classMap[$class] = $class;
			}else{
				return false;
			}
		}
	}

	public function assign($name,$value){
		$this->assign[$name] = $value;
	}

	public function view($file){
		$file = APP.'/view'.$file;
		if(is_file($file)){
			extract($this->assign);  //该函数使用数组键名作为变量名,使用数组键值作为变量值
			include $file;
		}
	}
}