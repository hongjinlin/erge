<?php
namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use app\models\Setting;
use app\models\Message;
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
        $session = Yii::$app->session;
        if (!$session->isActive){
            $session->open();
        }
        if($time){
            $_SESSION['time'] = $time;
        }
        $time = isset($_SESSION['time']) ? strtotime($_SESSION['time']) : time();
        $today = strtotime(date('m/d', $time));
        $memberData = Member::find()->where(['birthday' => $today]);
        $pageSize = Setting::find()->where(['name' => 'pagesize'])->one();
        $pages = new Pagination(['totalCount' => $memberData->count(), 'pageSize' => $pageSize->value]);
        $members = $memberData->offset($pages->offset)->limit($pages->limit)->all();
        $data['members'] = $members;
        $data['pages'] = $pages;
        $data['today'] = $today;
        return $this->render('index', $data);
    }

    public function actionSend(){
        $request = Yii::$app->request;
        $pageSize = Setting::find()->where(['name' => 'pagesize'])->one();
        $end = $pageSize->value;
        $sendData = array();
        for($i=0; $i<$end; $i++){
            $paramName = 'isSelect'.$i;
            if($request->post($paramName) == 1){
                $arr['phone'] = $request->post('member_'.$i.'_phone');
                $arr['name'] = $request->post('member_'.$i.'_name');
                $arr['msg'] = $request->post('member_'.$i.'_msg');
                $sendData[] = $arr;
            }
        }
        if($sendData){
            $mMessage = new Message();
            $rzt = $mMessage->send($sendData);
            if($rzt){
                return '发送成功！';
            }else{
                echo '发送失败！';
                var_dump($mMessage->error);
            }       
        }


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

    public function actionPost(){
        $data = array();

        return $this->render('post', $data);
    }

    public function actionSave(){
        if(!$_POST['id']){
            \Yii::$app->getSession()->setFlash('error', '会员卡号不能为空！');
            return $this->render('post');
        }
        $mMember = new Member();
        $mMember->id = intval($_POST['id']);
        $mMember->name = $_POST['name'];
        $mMember->phone = $_POST['phone'];
        $mMember->birthday = strtotime(date('m/d',strtotime($_POST['birthday'])));
        $mMember->save();
        \Yii::$app->getSession()->setFlash('success', '添加成功！');
        return $this->redirect(['member/index']);

    }

}
