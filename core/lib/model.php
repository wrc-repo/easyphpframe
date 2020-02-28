<?php
namespace core\lib;
use core\lib\config;
use Medoo\Medoo;

class model extends Medoo{
	public function __construct(){
		$option = config::getAll('database');
		parent::__construct($option);
	}

	public function db($table){
		$rs = $this->select($table,'*');
		return $rs;
	}

	public function find($table,$id){
		$rs = $this->get($table,'*',['id' => $id]);
		return $rs;
	}
}