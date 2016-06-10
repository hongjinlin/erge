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
<div class="container theme-showcase" role="main">
  <div class="panel panel-default">
    <div class="panel-heading">
    导入会员信息
    </div>
    <div class="panel-body">
    <form method="post" action="/index.php?r=member/importexcel" enctype="multipart/form-data">
    <input type="hidden" name="_csrf" value="<?php echo yii::$app->request->csrfToken; ?>" />
      <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-6 form-horizontal">
          <div class="form-group">
          </div>
          <div class="form-group">
            <input type="file" name="file" >            
          </div>
        </div>
      </div>

      <hr role="separator" class="divider"></hr>
      <div class="row">
        <div class="form-group">
          <label for="des" class="col-md-4 control-label"></label>
          <input type="submit" name="submit" class="btn btn-default navbar-btn" value="导入" />
        </div>
      </div>
    </form>
    </div>
  </div>
</div>