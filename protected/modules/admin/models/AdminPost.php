<?php
/**
 * @author chendong
 *
 * @property string $editUrl
 * @property string $statsUrl
 * @property string $listUrl
 * @property string $deleteUrl
 * @property string $commentUrl
 */
class AdminPost extends Post
{
    /**
     * Returns the static model of the specified AR class.
     * @return AdminPost the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
    
    public function getEditUrl()
    {
        return aurl('admin/post/create', array('id'=>$this->id));
    }
    
    public function getStatsUrl()
    {
        return aurl('admin/post/stats', array('id'=>$this->id));
    }
    
    public function getListUrl()
    {
        return aurl('admin/post/list');
    }
    
    public function getDeleteUrl()
    {
        return aurl('admin/post/delete', array('id'=>$this->id));
    }
    
    public function getCommentUrl()
    {
        return aurl('admin/post/comments', array('id'=>$this->id));
    }

    public static function fetchList($uid, $wxid = 0, $requirePages = true, $requireSort = true)
    {
        $uid = (int)$uid;
        $criteria = new CDbCriteria();
        $criteria->addColumnCondition(array('user_id' => $uid));
        if ($wxid > 0)
            $criteria->addColumnCondition(array('weixin_id' => $wxid));
        
        if ($requirePages) {
            $pages = new CPagination(self::model()->count($criteria));
            $pages->setPageSize(param('admin_post_list_page_size'));
            $pages->applyLimit($criteria);
        }
        
        if ($requireSort) {
            $sort = new CSort(__CLASS__);
            $sort->defaultOrder = 'create_time desc';
            $sort->applyOrder($criteria);
        }
        else
            $criteria->order = 'create_time desc';
        
        $models = self::model()->findAll($criteria);
        
        $data = array(
            'models' => $models,
            'pages' => $pages,
            'sort' => $sort,
        );
        
        return ($requirePages || $requireSort) ? $data : $models;
    }
    
    /**
     * 获取文章推广账号的统计信息
     * @param integer $wxid
     * @return Ambigous array
     */
    public function getPostWeixin($wxid = 0, $column = '')
    {
        $rows = app()->getDb()->createCommand()
            ->from(TABLE_POST_WEIXIN)
            ->where('post_id = :postid', array(':postid' => $this->id))
            ->queryAll();
        
        $data = array();
        foreach ($rows as $row)
            $data[$row['wx_id']] = $row;
        
        if ($wxid > 0)
            return empty($column) ? $data[$wxid] : $data[$wxid][$column];
        else
            return $data;
    }
}


