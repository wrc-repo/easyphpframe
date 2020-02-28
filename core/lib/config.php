<?php
namespace core\lib;
class config{

	/**
	 * 1.判断配置文件是否存在
	 * 2.判断配置是否存在
	 * 3.将配置缓存
	 */
	static public $conf = [];
	static public function get($name,$file){
		if(isset(self::$conf[$file])){
			return self::$conf[$file][$name];
		}else{
			$path = PHPONE.'/core/config/'.$file.'.php';
			if(is_file($path)){
				$conf = include $path;
				if(isset($conf[$name])){
					self::$conf[$file] = $conf;
					return $conf[$name];
				}else{
					throw new \Exception("配置项不存在".$name);	
				}
			}else{
				throw new \Exception("配置文件不存在".$file);	
			}
		}
	}

	static public function getAll($file){
		if(isset(self::$conf[$file])){
			return self::$conf[$file];
		}else{
			$path = PHPONE.'/core/config/'.$file.'.php';
			if(is_file($path)){
				$rs = include $path;
				self::$conf[$file] = $rs;
				return $rs;
			}else{
				throw new \Exception("配置文件不存在".$file);	
			}
		}
	}
}