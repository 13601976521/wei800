<?php
/**
 * AdminWeixin
 * @author chendong
 * @property string $postsUrl
 * @property string $editUrl
 * @property string $listUrl
 * @property string $deleteUrl
 *
 */
class AdminWeixin extends Weixin
{
    /**
     * Returns the static model of the specified AR class.
     * @return AdminWeixin the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
    
    public function getPostsUrl()
    {
        return aurl('admin/post/list', array('wxid'=>$this->id));
    }
    
    public function getEditUrl()
    {
        return aurl('admin/weixin/create', array('id'=>$this->id));
    }
    
    public function getListUrl()
    {
        return aurl('admin/weixin/list');
    }
    
    public function getDeleteUrl()
    {
        return aurl('admin/weixin/delete', array('id'=>$this->id));
    }
    
    public static function fetchList($uid, $requirePages = true, $requireSort = true)
    {
        $uid = (int)$uid;
        $criteria = new CDbCriteria();
        $criteria->addColumnCondition(array('user_id' => $uid));
        
        if ($requirePages) {
            $pages = new CPagination(self::model()->count($criteria));
            $pages->setPageSize(param('admin_weixin_list_page_size'));
            $pages->applyLimit($criteria);
        }
        
        if ($requireSort) {
            $sort = new CSort(__CLASS__);
            $sort->defaultOrder = 't.state desc, t.create_time desc';
            $sort->applyOrder($criteria);
        }
        else
            $criteria->order = 't.state desc, t.create_time desc';
        
        $models = self::model()->findAll($criteria);
        
        $data = array(
            'models' => $models,
            'pages' => $pages,
            'sort' => $sort,
        );
        
        return ($requirePages || $requireSort) ? $data : $models;
    }

}


