<?php use yii\widgets\LinkPager; ?>
<form class="form-inline col-md-6 col-md-offset-6" method="post" action="/index.php?r=member/index">
  <div class="form-group">
    <input type="hidden" name="_csrf" value="<?php echo Yii::$app->request->getCsrfToken()?>" />
    <label for="birthday">(默认显示今天生日会员)</label>
    <input type="text" class="form-control" id="birthday" name="birthday" placeholder="<?php if($today){echo date('Y-m-d', $today);}else{echo date('Y-m-d', time());} ?>">
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
    </tr>
    <?php foreach($members as $key => $member): ?>
      <tr>
        <input type="hidden" name="member_<?php echo $key; ?>_id" value="<?php echo $member['id']; ?>">
        <input type="hidden" name="member_<?php echo $key; ?>_phone" value="<?php echo $member['phone']; ?>">
      	<th><?php echo $member['id']; ?></th>
      	<th><?php echo $member['name']; ?></th>
      	<th><?php echo $member['phone']; ?></th>
      	<th><?php echo date('m月d日', $member['birthday']); ?></th>
      	<th>
    		<input type="checkbox" name="isSelect<?php echo $key; ?>" value="1">
    	</th>
      	<th class=' col-md-3'><textarea name="member_<?php echo $key; ?>_msg" class="form-control" rows="1"></textarea></th>
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