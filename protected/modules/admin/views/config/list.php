<?php if (user()->hasFlash('save_config_success')):?>
<div class="alert alert-success">
    <a href="javascript:void(0);" data-dismiss="alert" class="close">&times;</a>
    <?php echo user()->getFlash('save_config_success');?>
</div>
<?php endif;?>
<div class="table-title"><?php echo $this->title;?></div>
<table class="table table-striped table-bordered config-table">
    <thead>
        <tr>
            <th class="span1 ac">ID</th>
            <th class="span2 ar">参数名称/变量名</th>
            <th class="span6">参数值</th>
            <th class="span3 ac"><?php echo l('编辑参数', url('admin/config/edit', array('cid'=>$categoryid)));?></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($models as $model):?>
        <tr>
            <td class="ac"><?php echo $model['id'];?></td>
            <td class="ar config-name">
                <strong><?php echo h($model['name']);?></strong>
                <em class="cgray f12px"><?php echo $model['config_name'];?></em>
            </td>
            <td><?php echo h($model['config_value']);?></td>
            <td><?php echo nl2br(h($model['desc']));?></td>
            <td>&nbsp;</td>
        </tr>
        <?php endforeach;?>
        <?php if (count($models) == 0):?>
        <tr><td class=ac colspan="5">此分类还没有配置条目</td></tr>
        <?php endif;?>
    </tbody>
</table>
