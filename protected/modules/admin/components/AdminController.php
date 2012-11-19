<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class AdminController extends CController
{
    public $channel;
    public $title;
    public $breadcrumbs = array();
    
    /**
     * 当前登录用户的ID
     * @var integer
     */
    public $uid;
    
    /**
     * 当前登录用户
     * @var AdminUser
     */
    public $user;
    
    /**
     * 当前登录用户的资料
     * @var UserProfile
     */
    public $profile;
    
    public function init()
    {
        parent::init();
        $user = AdminUser::model()->findByPk(user()->id);
        if ($user === null)
            throw new CHttpException(500, '未找到用户');
        
        $this->uid = $user->id;
        $this->user = $user;
        $this->profile = $user->profile;
    }
    
	public function setSiteTitle($text)
	{
	    $this->pageTitle = $text . '_' . app()->name;
	}
}