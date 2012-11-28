<?php require dirname(__FILE__) . '/header.php';?>

<?php if (!$validRequest || !$dbSeverStatus || !$createTableResult):?>
<div class="alert alert-block alert-error">
    <?php if (!$validRequest):?>非法请求
    <?php elseif (!$dbSeverStatus):?>数据库连接信息不正确，请返回重新填写。
    <?php else:?> 创建表结构出错。
    <?php endif;?>
</div>
<div class="buttons">
    <a class="btn" href="javascript:history.back();">上一步</a>
</div>
<?php endif;?>

<?php require dirname(__FILE__) . '/footer.php';?>