<?php
/**
 * AdminAdWeixin
 * @author chendong
 * @property string $postsUrl
 * @property string $editUrl
 * @property string $listUrl
 * @property string $deleteUrl
 * @property string $stateUrl
 *
 */
class AdminAdWeixin extends AdWeixin
{
    /**
     * Returns the static model of the specified AR class.
     * @return AdminAdWeixin the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
    
    public function getEditUrl()
    {
        return aurl('admin/adweixin/create', array('id'=>$this->id));
    }

    public function getListUrl()
    {
        return aurl('admin/adweixin/list');
    }
    
    public function getDeleteUrl()
    {
        return aurl('admin/adweixin/delete', array('id'=>$this->id));
    }

    public function getStateUrl()
    {
        return aurl('admin/adweixin/changestate', array('id'=>$this->id));
    }
    
    public function getStateText()
	{
	    $class = $this->state == ADWEIXIN_STATE_ENABLED ? 'label-success' : 'label-inverse';
	    $text = self::stateLabels($this->state);
	    $html = sprintf('<span class="label %s">%s</span>', $class, $text);
	    return $html;
	}

	public static function stateLabels($state = null)
	{
	    $labels = array(
	        ADWEIXIN_STATE_DISABLED => '隐藏',
	        ADWEIXIN_STATE_ENABLED => '正常',
	    );
	     
	    if ($state === null)
	        return $labels;
	    else
	        return $labels[$state];
	}
	
	public function getStateLabel()
	{
	    return $this->state == ADWEIXIN_STATE_ENABLED ? '隐藏' : '显示';
	}
	
	public function getStateButton()
	{
	    $class = $this->state == ADWEIXIN_STATE_ENABLED ? 'btn-danger' : 'btn-success';
	    $text = $this->state == ADWEIXIN_STATE_ENABLED ? '隐藏' : '显示';
	    $btn = '<button type="button" class="change-state btn btn-mini %s" data-url="%s">%s</button>';
	    
	    return sprintf($btn, $class, $this->getStateUrl(), $text);
	}
    
    public static function fetchList($uid, $all=false, $requirePages = true, $requireSort = true)
    {
        $uid = (int)$uid;
        $criteria = new CDbCriteria();
        $criteria->addColumnCondition(array('user_id' => $uid));
        if (!$all)
            $criteria->addColumnCondition(array('state' => ADWEIXIN_STATE_ENABLED));
        
        if ($requirePages) {
            $pages = new CPagination(self::model()->count($criteria));
            $pages->setPageSize(param('admin_weixin_list_page_size'));
            $pages->applyLimit($criteria);
        }
        
        if ($requireSort) {
            $sort = new CSort(__CLASS__);
            $sort->defaultOrder = 'state desc, create_time desc';
            $sort->applyOrder($criteria);
        }
        else
            $criteria->order = 'state desc, create_time desc';
        
        $models = self::model()->findAll($criteria);
        
        $data = array(
            'models' => $models,
            'pages' => $pages,
            'sort' => $sort,
        );
        
        return ($requirePages || $requireSort) ? $data : $models;
    }
}


