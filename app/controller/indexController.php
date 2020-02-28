<?php
namespace app\controller;
use core\lib\model;

class indexController extends \core\phpone{
	public function index(){
		$db =  new model;
		$rs = $db->find('brand',3);
		dump($rs);
	}

}