<?php
require dirname(__FILE__) . '/header.php';
?>

<form action="./index.php?step=3" method="post" class="form-horizontal install-form">
    <fieldset>
        <legend>网站配置参数</legend>
        <div class="control-group">
            <label class="control-label">数据库服务器</label>
            <div class="controls">
                <input type="text" name="db[host]" value="localhost" />
                <span class="help-inline">数据库服务器IP，如果程序与数据库在一台服务器上，一般为localhost</span>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label">数据库名</label>
            <div class="controls">
                <input type="text" name="db[name]" value="wei800" />
            </div>
        </div>
        <div class="control-group">
            <label class="control-label">数据库用户名</label>
            <div class="controls">
                <input type="text" name="db[user]" value="root" />
            </div>
        </div>
        <div class="control-group">
            <label class="control-label">数据库密码</label>
            <div class="controls">
                <input type="text" name="db[passwd]" value="" />
            </div>
        </div>
    </fieldset>
    <div class="buttons">
        <a class="btn" href="javascript:history.back();">上一步</a>
        <input type="submit" class="btn btn-primary" value="安装数据库" />
    </div>
</form>

<?php require dirname(__FILE__) . '/footer.php';?>