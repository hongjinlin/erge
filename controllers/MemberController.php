<?php
namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use app\models\Setting;
use app\models\Member;
use PHPExcel;
use yii\data\Pagination;
class MemberController extends Controller
{

    public $layout = 'erge';

    public function behaviors()
    {
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
        $request = Yii::$app->request;
        $time = $request->post('birthday');
        $time = $time ? strtotime($time) : time();
        $today = strtotime(date('m/d', $time));
        $memberData = Member::find()->where(['birthday' => $today]);
        $pages = new Pagination(['totalCount' => $memberData->count(), 'pageSize' => '2']);
        $members = $memberData->offset($pages->offset)->limit($pages->limit)->all();
        $data['members'] = $members;
        $data['pages'] = $pages;
        $data['today'] = $today;
        return $this->render('index', $data);
    }

    public function actionSend(){
        $request = Yii::$app->request;
        var_dump($request->post());
    }

    public function actionTest(){
        $inputFileName = "uploads/excel/test.xlsx";
        $objPHPExcel = \PHPExcel_IOFactory::load($inputFileName);
        $sheetData = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
        $data = array();
        foreach ($sheetData as $key => $value) {
            if(!$value['A']){
                continue;
            }
            $data[$key]['id'] = $value['A'];
            $data[$key]['name'] = $value['B'];
            $data[$key]['phone'] = $value['C'];
            $data[$key]['birthday'] = strtotime($value['D']);

        }
        Yii::$app->db->createCommand()->batchInsert(Member::tableName(), ['id','name','phone','birthday'], $data)->execute();
        echo 'success';      
    }

    public function actionTest2(){
        $members = Member::find()->all();
        echo date('m/d',$members[0]['birthday']);   
    }

}
