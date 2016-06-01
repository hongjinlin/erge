<?php use yii\widgets\LinkPager; ?>
<form class="form-inline col-md-4 col-md-offset-8">
  <div class="form-group">
    <label for="birthday">生日：</label>
    <input type="text" class="form-control" id="birthday" placeholder="<?php echo date('Y-m-d', time()) ?>">
  </div>
  <button type="submit" class="btn btn-default">确定</button>
</form>
<table class="table table-hover">
  <tr>
  	<th>卡号</th>
  	<th>姓名</th>
  	<th>电话</th>
  	<th>生日</th>
  	<th>是否发信息</th>
  	<th class=' col-md-4'>信息内容</th>
  </tr>
  <?php foreach($members as $member): ?>
    <tr>
    	<th><?php echo $member['id']; ?></th>
    	<th><?php echo $member['name']; ?></th>
    	<th><?php echo $member['phone']; ?></th>
    	<th><?php echo date('m月d日', $member['birthday']); ?></th>
    	<th>
  		<input type="checkbox" value="">
  	</th>
    	<th class=' col-md-3'><textarea class="form-control" rows="1"></textarea></th>
    </tr>
  <?php endforeach; ?>
</table>
<?= LinkPager::widget(['pagination' => $pages]); ?>
<script type="text/javascript">
    $(function () {
        $('#birthday').datetimepicker({
          disabledHours: true
        });
    });
</script>