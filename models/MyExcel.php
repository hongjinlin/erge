<?php

namespace app\models;

use yii\db\ActiveRecord;
use PHPExcel;

class MyExcel extends ActiveRecord{

    public function import($inputFileName){
        $objPHPExcel = \PHPExcel_IOFactory::load($inputFileName);
        $sheetData = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
        $data = array();
        foreach ($sheetData as $key => $value) {
            if(!$value['A'] || $value['A'] <= 0){
                continue;
            }
            $data[$key]['id'] = $value['A'];
            $data[$key]['name'] = $value['B'];
            $data[$key]['phone'] = $value['C'];
            $data[$key]['birthday'] = strtotime($value['D']);

        }
        $transaction=\Yii::$app->db->beginTransaction();
        \Yii::$app->db->createCommand()->batchInsert(Member::tableName(), ['id','name','phone','birthday'], $data)->execute();
        $transaction->commit();
        return true;
    }
	
}