<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;

class IndexController extends Controller
{

    public $layout = 'erge';
    
	public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index','member'],
                'rules' => [
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            
        ];
    }

    public function actionIndex(){
        $session = Yii::$app->session;
        if(!$session->isActive){
            $session->open();
        }
        return $this->render('index');
    }

    public function actionMember(){

    }
}
