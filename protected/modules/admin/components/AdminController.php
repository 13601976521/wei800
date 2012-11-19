<?php
/**
 * @author chendong
 *
 * @property integer $uid
 * @property AdminUser $user
 */
class AdminController extends CController
{
    public $channel;
    public $title;
    public $breadcrumbs = array();
    
    public function getUid()
    {
        return (int)user()->id;
    }
    
    public function getUser()
    {
        $user = AdminUser::model()->findByPk($this->getUid());
        if ($user === null)
            throw new CHttpException(500, '未找到用户');
        
        return $user;
    }
    
	public function setSiteTitle($text)
	{
	    $this->pageTitle = $text . '_' . app()->name;
	}
}