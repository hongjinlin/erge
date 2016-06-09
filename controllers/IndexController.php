<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use app\models\Setting;

class IndexController extends Controller
{

    public $layout = 'erge';
    
	public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
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

    public function actionConfig(){
        $configData = Setting::find()->asArray()->all();
        $configArr = array();
        foreach ($configData as $key => $value) {
            $config[$value['name']] = $value['value'];
        }
        $data['config'] = $config;
        return $this->render('config', $data);
    }

    public function actionSaveconfig(){
        $transaction=\Yii::$app->db->beginTransaction();
        $mAppid = Setting::find()->where(['name' => 'submail_appid'])->one();
        $mAppid->value = $_POST['submail_appid'];
        $mAppid->save();

        $mAppkey = Setting::find()->where(['name' => 'submail_appkey'])->one();
        $mAppkey->value = $_POST['submail_appkey'];
        $mAppkey->save();

        $mProject = Setting::find()->where(['name' => 'submail_project'])->one();
        $mProject->value = $_POST['submail_project'];
        $mProject->save();
        $transaction->commit();
        \Yii::$app->getSession()->setFlash('success', '保存成功！');
        return $this->redirect(['config']);
    }
}
