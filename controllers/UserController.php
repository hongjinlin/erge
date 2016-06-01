<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\DoLogin;
    
class UserController extends Controller
{

    public $layout = 'erge';

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            
        ];
    }

    public function actionLogin(){
        $session = Yii::$app->session;
        if(!$session->isActive){
            $session->open();
        }
        if (!Yii::$app->user->isGuest) {
            return $this->redirect(['index/index']);
        }
        $model = new DoLogin();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->redirect(['index/index']);
        }
        return $this->render('login',['model' => $model]);
    }

    public function actionLoginout(){
        Yii::$app->user->logout();
        return $this->redirect(['user/login']);
    }
}
