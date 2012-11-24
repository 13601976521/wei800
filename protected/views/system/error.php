<div class="cd-error">
    <div class="error-detail fleft cd-container">
        <div class="alert alert-block alert-error"><?php echo $message;?></div>
        <p>出现这个问题，也许是因为您访问了不正确的链接地址，但更可能是由于我们对程序做出了更新，没有即时通知您所造成的。</p>
    </div>
    <div class="error-icon cd-sidebar fright ac">囧</div>
    <div class="clear"></div>
</div>


<?php if (YII_DEBUG): // 以下内容为调试信息 ?>
<div><?php echo $code . ' - ' . $message;?></div>
<div><?php echo $file . ' - ' . $line;?></div>
<div><?php echo $trace;?></div>
<?php endif;?>