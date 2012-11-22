<div class="table-title"><?php echo $this->title;?></div>
<?php echo CHtml::form('', 'get', array('class'=>'form-inline table-header'));?>
    <?php echo CHtml::dropDownList('wxid', $wxid, $weixins, array('prompt'=>'所有账号', 'id'=>'weixinid'));?>
    <input type="submit" value="搜索" class="btn btn-mini2 btn-primary" />
<?php echo CHtml::endForm();?>
<table class="table table-striped table-bordered cd-list-table">
    <thead>
        <tr>
            <th class="span1 ac"><?php echo $sort->link('id');?></th>
            <th class="span2"><?php echo $sort->link('weixin_id');?></th>
            <th class="span4"><?php echo $sort->link('title');?></th>
            <th class="span1 ac"><?php echo $sort->link('view_count');?></th>
            <th class="span1 ac"><?php echo $sort->link('back_count');?></th>
            <th class="span1 ac"><?php echo $sort->link('share_count');?></th>
            <th>操作</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($models as $index => $model):?>
        <tr>
            <td class="ac"><?php echo $model->id;?></td>
            <td><?php echo $model->weixin->wxname;?></td>
            <td><?php echo $model->title;?></td>
            <td class="ac"><?php echo $model->view_count;?></td>
            <td class="ac"><?php echo $model->back_count;?></td>
            <td class="ac"><?php echo $model->share_count;?></td>
            <td class="group-btn">
                <a class="btn btn-mini btn-info btn-stats" href="<?php echo $model->statsUrl;?>">详细统计</a>
            </td>
        </tr>
        <?php endforeach;?>
    </tbody>
</table>
<?php if ($pages):?>
<div class="pagination"><?php $this->widget('CLinkPager', array('pages'=>$pages, 'skin'=>'admin'));?></div>
<?php endif;?>

<div class="modal hide fade" id="stats-modal">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3>使用微信扫描此二维码</h3>
    </div>
    <div class="modal-body">
    </div>
    <div class="modal-footer">
        <a href="javascript:void(0);" class="btn btn-primary" data-dismiss="modal" aria-hidden="true">关闭窗口</a>
    </div>
</div>

<script type="text/javascript">
$(function(){
	$('#weixinid').chosen({
    	'no_results_text': '没有找到匹配的微信号'
	});
});
</script>

