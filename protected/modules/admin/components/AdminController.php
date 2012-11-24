<?php
/**
 * @author chendong
 *
 * @property integer $uid
 * @property AdminUser $user
 */
class AdminController extends Controller
{
    public $channel;
    public $title;
    public $breadcrumbs = array();
    
    public function init()
    {
        parent::init();
        $this->setSiteTitle();
    }
    
    public function getUser()
    {
        $user = AdminUser::model()->findByPk($this->getUserID());
        if ($user === null)
            throw new CHttpException(500, '未找到用户');
        
        return $user;
    }
    
	public function setSiteTitle($text = '')
	{
	    if (empty($text))
	        $text = app()->name;
	    $this->pageTitle = $text . ' - 管理中心';
	}
}