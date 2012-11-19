<div class="table-title"><?php echo $this->title;?></div>
<table class="table table-striped table-bordered cd-list-table">
    <thead>
        <tr>
            <th class="span3"><?php echo $sort->link('wxname');?></th>
            <th class="span2"><?php echo $sort->link('custom_wxid');?></th>
            <th class="span2"><?php echo $sort->link('original_wxid');?></th>
            <th class="span1"><?php echo $sort->link('state');?></th>
            <th><?php echo $listAllLink;?></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($models as $model):?>
        <tr>
            <td><a href="<?php echo $model->editUrl;?>"><?php echo $model->wxname;?></a></td>
            <td><?php echo $model->custom_wxid;?></td>
            <td><?php echo $model->original_wxid;?></td>
            <td class="state-label"><?php echo $model->stateText;?></td>
            <td>
                <?php echo $model->getStateButton();?>
            </td>
        </tr>
        <?php endforeach;?>
    </tbody>
</table>
<?php if ($pages):?>
<div class="pagination"><?php $this->widget('CLinkPager', array('pages'=>$pages, 'skin'=>'admin'));?></div>
<?php endif;?>

<script type="text/javascript">
$(function(){
	$('td').on('click', '.change-state', function(event){
		var tthis = $(this);
		CDAdmin.changeWeixinState($(this).attr('data-url'), function(data){
			tthis.parents('tr').find('.state-label').html(data.text);
			tthis.html(data.label);
			tthis.toggleClass('btn-danger btn-success');
		});
	});
});
</script>