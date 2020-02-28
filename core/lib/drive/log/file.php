<?php
namespace core\lib\drive\log;
use core\lib\config;
class file{
	public $path;//日志存储位置
	public function __construct(){
		$conf = config::get('option','log');
		$this->path = $conf['path'];
	}

	public function do_log($message,$file = 'log'){
		if(!is_dir($this->path.date('YmdH'))){
			mkdir($this->path.date('YmdH'),0777,true);
		}
		return file_put_contents($this->path.date('YmdH').'/'.$file.'.php',date('Y-m-d H:i:s').json_encode($message).PHP_EOL,FILE_APPEND);
	}
}