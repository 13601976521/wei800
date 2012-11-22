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
    
    public function getUser()
    {
        $user = AdminUser::model()->findByPk($this->getUserID());
        if ($user === null)
            throw new CHttpException(500, '未找到用户');
        
        return $user;
    }
    
	public function setSiteTitle($text)
	{
	    $this->pageTitle = $text . '_' . app()->name;
	}

	public static function themeScreens()
	{
	    $data = array();
	    $names = tm()->getThemeNames();
	    foreach ($names as $name) {
	        $resourcePath = tm()->getTheme($name)->getBasePath() . DS . 'resources';
	        $assetsPath = realpath(am()->getPublishedPath($resourcePath));
	        if ($assetsPath === false)
	            $assetsUrl = am()->publish($resourcePath);
	        else
	            $assetsUrl = am()->getPublishedUrl($resourcePath);
	        $data[$name] = $assetsUrl . '/screenshoot.png';
	    }
	
	    return $data;
	}
}