<?php
class test{
	public $param1;
	public $param2;
}

$arr['param1'] = 'aaaaa';
$arr['param2'] = 'bbbbb';

$test = new test($arr);

var_dump($test);