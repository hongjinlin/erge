<?php use yii\widgets\LinkPager; ?>
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
<div>
    <a class="btn btn-default" href="/index.php?r=member/post" role="button">添加会员</a>
    <a class="btn btn-default" href="/index.php?r=member/excel" role="button">导入名单</a>
</div>
<form class="form-inline col-md-6 col-md-offset-6" method="post" action="/index.php?r=member/index">
  <div class="form-group">
    <input type="hidden" name="_csrf" value="<?php echo Yii::$app->request->getCsrfToken()?>" />
    <label for="birthday">(默认显示今天生日会员)</label>
    <input type="text" class="form-control" id="birthday" name="birthday" placeholder="<?php if(isset($today)){echo date('Y-m-d', $today);}else{echo date('Y-m-d', time());} ?>">
  </div>
  <button type="submit" class="btn btn-default">确定</button>
</form>
<form action="/index.php?r=member/send" method="post">
    <input type="hidden" name="_csrf" value="<?php echo Yii::$app->request->getCsrfToken()?>" />
  <table class="table table-hover">
    <tr>
    	<th>卡号</th>
    	<th>姓名</th>
    	<th>电话</th>
    	<th>生日</th>
    	<th>是否发信息</th>
    	<th class=' col-md-4'>信息内容</th>
      <th>操作</th>
    </tr>
    <?php foreach($members as $key => $member): ?>
      <tr>
        <input type="hidden" name="member_<?php echo $key; ?>_phone" value="<?php echo $member['phone']; ?>">
        <input type="hidden" name="member_<?php echo $key; ?>_name" value="<?php echo $member['name']; ?>">
      	<td><?php echo $member['id']; ?></td>
      	<td><?php echo $member['name']; ?></td>
      	<td><?php echo $member['phone']; ?></td>
      	<td><?php echo date('m月d日', $member['birthday']); ?></td>
      	<td>
      		<input type="checkbox" name="isSelect<?php echo $key; ?>" value="1">
      	</td>
      	<td class=' col-md-3'><textarea name="member_<?php echo $key; ?>_msg" class="form-control" rows="1"></textarea></td>
        <td align="center">
          <a href="/index.php?r=member/post&id=<?php echo $member['id']; ?>">修改</a> |
          <a href="/index.php?r=member/delete&id=<?php echo $member['id']; ?>" onclick="if(confirm('确认删除吗？')){return true;}else{return false;}">删除</a>
        </td>
      </tr>
    <?php endforeach; ?>
  </table>  
  <button type="submit" class="btn btn-default col-md-offset-8">发送</button>
</form>
<?= LinkPager::widget(['pagination' => $pages]); ?>
<script type="text/javascript">
    $(function () {
        $('#birthday').datetimepicker({
          disabledHours: true
        });
    });
</script>