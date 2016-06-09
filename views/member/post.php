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
    添加/修改会员信息
    </div>
    <div class="panel-body">
    <form method="post" action="/index.php?r=member/save">
    
    <input type="hidden" name="id" value="" />
    <input type="hidden" name="_csrf" value="<?php echo yii::$app->request->csrfToken; ?>" />
      <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-6 form-horizontal">
          <div class="form-group">
            <label for="id" class="control-label">卡号</label>
          </div>
          <div class="form-group">
            <input type="text" name="id" class="col-md-6 form-control" placeholder="会员卡号必须唯一" value="" aria-describedby="sizing-addon1">
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-6 form-horizontal">
          <div class="form-group">
            <label for="name" class="control-label">姓名</label>
          </div>
          <div class="form-group">
            <input type="text" name="name" class="col-md-6 form-control" placeholder="雷炎芳" value="" aria-describedby="sizing-addon1">
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-6 form-horizontal">
          <div class="form-group">
            <label for="phone" class="control-label">电话</label>
          </div>
          <div class="form-group">
            <input type="text" name="phone" id="phone" class="col-md-6 form-control" placeholder="18150107060" value="" aria-describedby="sizing-addon1">
          </div>
        </div>
      </div>
     
      <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-6 form-horizontal">
          <div class="form-group">
            <label for="birthday" class="control-label">生日</label>
          </div>
          <div class="form-group">
            <input type="text" name="birthday" id="birthday" class="col-md-6 form-control" placeholder="" value="" aria-describedby="sizing-addon1">
          </div>
        </div>
      </div>

      <hr role="separator" class="divider"></hr>
      <div class="row">
        <div class="form-group">
          <label for="des" class="col-md-4 control-label"></label>
          <input type="submit" name="submit" class="btn btn-default navbar-btn" value="添加" />
        </div>
      </div>
    </form>
    </div>
  </div>
</div>
<script type="text/javascript">
    $(function () {
        $('#birthday').datetimepicker({
          disabledHours: true
        });
    });
</script>