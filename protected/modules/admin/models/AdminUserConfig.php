<?php
class AdminUserConfig extends UserConfig
{
    const TYPE_SYSTEM = 0;
    const TYPE_CUSTOM = 1;
    
    const CATEGORY_CUSTOM = 1;

    const CATEGORY_SYSTEM = 10;
    const CATEGORY_SYSTEM_SITE = 11;
    const CATEGORY_SYSTEM_CACHE = 13;
    const CATEGORY_SYSTEM_ATTACHMENTS = 14;
    
    const CATEGORY_DISPLAY = 20;
    const CATEGORY_DISPLAY_TEMPLATE = 21;
    const CATEGORY_DISPLAY_UI = 22;
    
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
        // @todo not complete
        return array(
            self::CATEGORY_CUSTOM => '自定义参数',
        
            self::CATEGORY_SYSTEM_SITE => '网站设置',
            self::CATEGORY_SYSTEM_CACHE => '缓存设置',
            self::CATEGORY_SYSTEM_ATTACHMENTS => '附件设置',
        
            self::CATEGORY_DISPLAY_TEMPLATE => '模板配置',
            self::CATEGORY_DISPLAY_UI => '界面元素',
        
            self::CATEGORY_SNS_INTERFACE => 'SNS接口',
            self::CATEGORY_SNS_STATS => 'SNS统计',
            self::CATEGORY_SNS_TEMPLATE => 'SNS模板',
        );
    }
    
    public function flushConfig()
    {
        return self::flushAllConfig($this->user_id);
    }
    
    public static function flushAllConfig($userID)
    {
        $userID = (int)$userID;
        if ($userID === 0) return false;
        
        $rows = app()->getDb()->createCommand()
            ->select(array('config_name', 'config_value'))
            ->from(TABLE_USER_CONFIG)
            ->where('user_id = :userid', array(':userid' => $userID))
            ->queryAll();
        
        if (empty($rows)) return false;
        
        $rows = CHtml::listData($rows, 'config_name', 'config_value');
        $data = "<?php\nreturn " . var_export($rows, true) . ';';
        $filename = self::cacheFilename($userID);
        return ($filename === false) ? false : file_put_contents($filename, $data);
    }
    
    public static function cacheFilename($userID)
    {
        $userID = (int)$userID;
        if ($userID === 0) return false;
        
        $filename = dp(sprintf('user_config_%d.php', $userID));
        return $filename;
    }

    protected function beforeDelete()
    {
        throw new CException('系统参数不允许删除');
    }
}

