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
            <th class="span5"><?php echo $sort->link('title');?></th>
            <th class="span-short-time ac"><?php echo $sort->link('create_time');?></th>
            <th>操作</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($models as $index => $model):?>
        <tr>
            <td class="ac"><?php echo $model->id;?></td>
            <td><?php echo $model->weixin->wxname;?></td>
            <td><a href="<?php echo $model->editUrl;?>"><?php echo $model->title;?></a></td>
            <td class="ac"><div class="cgray"><?php echo $model->shortCreateTime;?></div></td>
            <td class="group-btn">
                <button type="button" class="btn btn-mini btn-success btn-qrcode" data-url="<?php echo $model->weixinUrl;?>" target="_blank">浏览</button>
                <button type="button" data-toggle="button" class="btn btn-mini btn-primary btn-copyurl" data-loading-text="正在复制" data-complete-text="复制成功" data-url="<?php echo $model->weixinUrl;?>">复制链接</button>
                <button type="button" data-toggle="button" class="btn btn-mini btn-danger btn-delete" data-url="<?php echo $model->deleteUrl;?>" data-loading-text="正在删除" data-error-text="删除出错" data-complete-text="删除">删除</button>
            </td>
        </tr>
        <?php endforeach;?>
    </tbody>
</table>
<?php if ($pages):?>
<div class="pagination"><?php $this->widget('CLinkPager', array('pages'=>$pages, 'skin'=>'admin'));?></div>
<?php endif;?>

<div class="modal hide fade" id="qrcode-modal">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3>使用微信扫描此二维码</h3>
    </div>
    <div class="modal-body qrcode ac">
        <img src="<?php echo sbu('images/grey.gif');?>" class="preview-qrcode" />
        <p class="cgray page-url"></p>
    </div>
    <div class="modal-footer">
        <a class="btn hide page-url" href="#" target="_black">在电脑端浏览器里浏览</a>
        <a href="javascript:void(0);" class="btn btn-primary" data-dismiss="modal" aria-hidden="true">关闭窗口</a>
    </div>
</div>
        
<script type="text/javascript">
$(function(){
	$('#weixinid').chosen({
    	'no_results_text': '没有找到匹配的微信号'
	});
	
    ZeroClipboard.setMoviePath('<?php echo sbu('libs/clipboard/clipboard.swf')?>');
    $('.btn-copyurl').each(function(index){
    	var button = $(this);
    	var clip = new ZeroClipboard.Client();
        var url = button.attr('data-url');
        clip.setText(url);
        clip.glue(this);
        clip.addEventListener('onMouseUp', function(client, text){
            button.button('loading');
        });
        clip.addEventListener('onComplete', function(client, text){
        	button.button('complete').toggleClass('btn-primary btn-warning');
        	setTimeout(function(){button.button('reset').toggleClass('btn-primary btn-warning');}, 1000);
        });
    });

    var qrcodeModal = $('#qrcode-modal').modal({show: false});
    $(document).on('click', '.btn-qrcode', function(event){
        var tthis = $(this);
        var pageUrl = tthis.attr('data-url');
        qrcodeModal.find('p.page-url').text(pageUrl);
        qrcodeModal.find('a.page-url').attr('href', pageUrl).show();
        var qrcodeUrl = 'http://chart.apis.google.com/chart?chs=150x150&cht=qr&chld=L|0&chl=' + pageUrl;
        qrcodeModal.find('.preview-qrcode').attr('src', qrcodeUrl);
        qrcodeModal.modal('show');
    });

    $(document).on('click', '.btn-delete', function(event){
        var confirm = window.confirm('您确定要执行删除操作吗？');
        if (confirm != true) return false;
        
        var tthis = $(this);
        var url = tthis.attr('data-url');
        var row = tthis.parents('tr');
        CDAdmin.deleteRow(url, {}, function(data){
            if (data.errno == 0)
                row.fadeOut('fast');
        }, function(){
            tthis.button('loading');
        }, function(){
            tthis.button('error');
            setTimeout(function(){tthis.button('reset');}, 1500);
        });
    });
});
</script>

<?php cs()->registerScriptFile(sbu('libs/clipboard/clipboard.min.js'), CClientScript::POS_END);?>



