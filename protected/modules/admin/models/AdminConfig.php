<?php
class AdminConfig extends Config
{
    
    const CATEGORY_SYSTEM_SITE = 100;
    const CATEGORY_SYSTEM_CACHE = 110;
    const CATEGORY_SYSTEM_ATTACHMENTS = 120;
    
    const CATEGORY_DISPLAY_UI = 200;
    
    /**
     * Returns the static model of the specified AR class.
     * @return AdminConfig the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
    
    public static function categoryLabels()
    {
        return array(
            self::CATEGORY_SYSTEM_SITE => '网站设置',
            self::CATEGORY_SYSTEM_CACHE => '缓存设置',
            self::CATEGORY_SYSTEM_ATTACHMENTS => '附件设置',
            self::CATEGORY_DISPLAY_UI => '界面元素',
        );
    }
    
    public static function flushAllConfig()
    {
        $rows = app()->getDb()->createCommand()
            ->select(array('config_name', 'config_value'))
            ->from(TABLE_CONFIG)
            ->queryAll();
        
        if (empty($rows)) return false;
        
        $rows = CHtml::listData($rows, 'config_name', 'config_value');
        $data = "<?php\nreturn " . var_export($rows, true) . ';';
        $filename = self::cacheFilename();
        return ($filename === false) ? false : file_put_contents($filename, $data);
    }
    
    public static function saveConfig($name, $value)
    {
        $model = self::model()->findByAttributes(array('config_name'=>$name));
        if ($model === null) return false;
        
        $model->config_value = $value;
        $result = $model->save(true, array('config_value'));
        $result && self::flushAllConfig();
        return $result;
    }
    
    public static function saveThemeName($value)
    {
        return self::saveConfig('theme_name', $value);
    }
    
    public static function cacheFilename()
    {
        return dp(param('custom_config_filename'));
    }

    protected function beforeDelete()
    {
        throw new CException('系统参数不允许删除');
    }
}

