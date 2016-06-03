<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
* 发短信
*/
class Message extends Model
{
	protected $_config;
	protected $_message_configs;
	public $error;
	

	public function init(){
		$data = Setting::find()->where(['like','name','submail%',false])->asArray()->all();
		foreach ($data as $key => $value) {
			$this->_config[$value['name']] = $value['value'];
		}
		$this->_message_configs['appid'] = $this->_config['submail_appid'];
		$this->_message_configs['appkey'] = $this->_config['submail_appkey'];
		$this->_message_configs['sign_type'] = $this->_config['submail_sign_type'];
	}

	public function send($sendData){
		$submail = new \MESSAGEXsend($this->_message_configs);
		foreach ($sendData as $key => $value) {
	        $submail->setTo($value['phone']);
	        $submail->SetProject($this->_config['submail_project']);
	    	$submail->AddVar('name',$value['name']);
	    	$submail->AddVar('msg',$value['msg']);
	        $xsend=$submail->xsend();
	        if($xsend['status'] == 'error'){
	        	$this->error[] = $xsend;
	        	continue;
	        }
		}
		if($this->error){
			return false;
		}
		return true;
	}
}