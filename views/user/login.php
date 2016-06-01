<?php
	use yii\helpers\Html;
	use yii\bootstrap\ActiveForm;
?>
<?php $form = ActiveForm::begin([
	'options' => ['class' => 'col-md-3'],
	'method' => 'post'
]); ?>
<!-- <form class="col-md-3" action="index.php?r=user/login" method="post"> -->
  <div class="form-group" >
    <label for="username">账号</label>
    <?php echo $form->field($model, 'username')->label(false)->textInput([
    													'autofocus' => true,
    													'class' => 'form-control',
    													'id' => 'username',
    													'placeholder' => 'Username'
    												]); ?>
    <!-- <input type="username" class="form-control" id="username" placeholder="Username"> -->
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">密码</label>
    <?php echo $form->field($model, 'password')->label(false)->passwordInput([
    														'class' => "form-control",
    														'id' => 'exampleInputPassword1',
    														'placeholder' => 'Password'
    													]); ?>
    <!-- <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password"> -->
  </div>
  
  <button type="submit" class="btn btn-default">登录</button>
<!-- </form> -->
<?php ActiveForm::end(); ?>
