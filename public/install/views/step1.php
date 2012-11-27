<?php require dirname(__FILE__) . '/header.php';?>

<p class="page-desc">本网页用于确认您的服务器配置是否能满足运行<a href="http://www.weixin800.com/" target="_blank">"微800"</a> Web应用的要求。它将检查服务器所运行的PHP版本，查看是否安装了合适的PHP扩展模块，以及确认php.ini文件是否正确设置。</p>
<h2>检查结果</h2>
<?php if($result > 0):?>
<p class="alert alert-block alert-success">恭喜！您的服务器配置完全符合"微800"的要求。</p>
<?php elseif($result < 0): ?>
<p class="alert alert-block alert-info">您的服务器配置符合"微800"的最低要求。如果您需要使用特定的功能，请关注如下警告。</p>
<?php else: ?>
<p class="alert alert-block alert-error">您的服务器配置未能满足"微800"的要求。</p>
<?php endif; ?>

<h2>具体结果</h2>
<table class="check-result">
    <tr><th width="200" align="left">项目名称</th><th width="50" align="left">结果</th><th align="left">备注</th></tr>
    <?php foreach($requirements as $requirement): ?>
    <tr>
    	<td><?php echo $requirement[0]; ?></td>
    	<td class="<?php echo $requirement[2] ? 'passed' : ($requirement[1] ? 'failed' : 'warning'); ?>">
    	<?php echo $requirement[2] ? '通过' : ($requirement[1]? '未通过' : '警告'); ?>
    	</td>
    	<td><?php echo $requirement[3];?></td>
    </tr>
    <?php endforeach; ?>
</table>

<table class="check-result result-mark">
    <tr>
        <td class="passed">&nbsp;</td><td>通过</td>
        <td class="failed">&nbsp;</td><td>未通过</td>
        <td class="warning">&nbsp;</td><td>警告</td>
    </tr>
</table>
<div class="buttons">
    <a class="btn" href="./index.php?step=1">重新检测</a>
    <?php if ($result):?>
    <a class="btn btn-primary" href="./index.php?step=2">下一步</a>
    <?php endif;?>
</div>


<?php require dirname(__FILE__) . '/footer.php';?>