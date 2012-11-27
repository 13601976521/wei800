<?php
require dirname(__FILE__) . '/header.php';
?>

<form action="" method="post" class="form-horizontal install-form">
    <fieldset>
        <legend>网站配置参数</legend>
        <div class="control-group">
            <label class="control-label">数据库服务器</label>
            <div class="controls">
                <input type="text" value="localhost" />
                <span class="help-inline">数据库服务器IP，如果程序与数据库在一台服务器上，一般为localhost</span>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label">数据库名</label>
            <div class="controls">
                <input type="text" value="wei800" />
            </div>
        </div>
        <div class="control-group">
            <label class="control-label">数据库用户名</label>
            <div class="controls">
                <input type="text" value="root" />
            </div>
        </div>
        <div class="control-group">
            <label class="control-label">数据库密码</label>
            <div class="controls">
                <input type="text" value="" />
            </div>
        </div>
        <div class="control-group">
            <label class="control-label">数据表前缀</label>
            <div class="controls">
                <input type="text" value="cd_" />
                <span class="help-inline">同一数据库运行多个论坛时，请修改前缀</span>
            </div>
        </div>
    </fieldset>
</form>
<div class="buttons">
    <a class="btn" href="javascript:history.back();">上一步</a>
    <a class="btn btn-primary" href="./index.php?step=3">下一步</a>
</div>


<?php require dirname(__FILE__) . '/footer.php';?>