<?php
namespace core\lib;
use core\lib\config;
class route{

	public $controller; //控制器
	public $action; //方法

	public function __construct(){
		if(isset($_SERVER['REQUEST_URI']) && $_SERVER['REQUEST_URI'] != '/'){

			//先处理 控制器/方法 controller/action
			$path = $_SERVER['REQUEST_URI'];
			$patharr = explode('/', trim($path,'/'));
			if(isset($patharr[0])){
				$this->controller = $patharr[0];
			}
			unset($patharr[0]);

			if(isset($patharr[1])){
				$this->action = $patharr[1];
				unset($patharr[1]);
			}else{
				$this->action = config::get('action','route');
			}

			//参数部分
			$count = count($patharr) + 2;
			$i = 2;
			while ($i<$count) {
				if(isset($patharr[$i + 1])){
					$_GET[$patharr[$i]] = $patharr[$i + 1];
				}
				$i = $i + 2;
			}
			
		}else{
			$this->controller = config::get('controller','route');
			$this->action = config::get('action','route');
		}
	}
}