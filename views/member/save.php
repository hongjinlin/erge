<?php 
use yii\bootstrap\Alert;
if( Yii::$app->getSession()->hasFlash('error') ) {
  echo Alert::widget([
    'options' => [
    'class' => 'alert-error',
    ],
    'body' => Yii::$app->getSession()->getFlash('error'),
    ]);
}
if( Yii::$app->getSession()->hasFlash('success') ) {
  echo Alert::widget([
    'options' => [
    'class' => 'alert-success', //这里是提示框的class
    ],
    'body' => Yii::$app->getSession()->getFlash('success'), //消息体
]);
}
?>