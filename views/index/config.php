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
    系统配置
    </div>
    <div class="panel-body">
    <form method="post" action="/index.php?r=index/saveconfig">    
    <input type="hidden" name="_csrf" value="<?php echo yii::$app->request->csrfToken; ?>" />
      <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-6 form-horizontal">
          <div class="form-group">
            <label for="submail_appid" class="control-label">submail_appid</label>
          </div>
          <div class="form-group">
            <input type="text" name="submail_appid" class="col-md-6 form-control" placeholder="" value="<?php echo $config['submail_appid']; ?>" aria-describedby="sizing-addon1">
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-6 form-horizontal">
          <div class="form-group">
            <label for="submail_appkey" class="control-label">submail_appkey</label>
          </div>
          <div class="form-group">
            <input type="text" name="submail_appkey" class="col-md-6 form-control" placeholder="" value="<?php echo $config['submail_appkey']; ?>" aria-describedby="sizing-addon1">
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-6 form-horizontal">
          <div class="form-group">
            <label for="phone" class="control-label">submail_project</label>
          </div>
          <div class="form-group">
            <input type="text" name="submail_project" class="col-md-6 form-control" placeholder="" value="<?php echo $config['submail_project']; ?>" aria-describedby="sizing-addon1">
          </div>
        </div>
      </div>
    
      <hr role="separator" class="divider"></hr>
      <div class="row">
        <div class="form-group">
          <label for="des" class="col-md-4 control-label"></label>
          <input type="submit" name="submit" class="btn btn-default navbar-btn" value="修改" />
        </div>
      </div>
    </form>
    </div>
  </div>
</div>