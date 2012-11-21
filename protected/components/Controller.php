<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 * @property integer $userID
 * @property string $nickname
 * @property User $user
 */
class Controller extends CController
{
    public $channel;
    public $breadcrumbs = array();
    
    public function actions()
	{
		return array(
			'captcha'=>array(
				'class'=>'application.extensions.CDCaptcha.CDCaptchaAction',
				'backColor' => 0xFFFFFF,
				'height' => 30,
				'width' => 100,
				'maxLength' => 4,
				'minLength' => 4,
		        'foreColor' => 0xFF0000,
		        'padding' => 5,
		        'testLimit' => 3,
			),
			'bigCaptcha'=>array(
				'class'=>'application.extensions.CDCaptcha.CDCaptchaAction',
				'backColor' => 0xFFFFFF,
				'height' => 50,
				'width' => 170,
				'maxLength' => 4,
				'minLength' => 4,
		        'foreColor' => 0xFF0000,
		        'padding' => 5,
		        'testLimit' => 3,
			),
		);
	}
	
	protected function setPageKeyWords($value)
	{
	    if (empty($value)) return false;
	    
	    $value = (array)$value;
	    array_push($value, app()->name);
	    $text = strip_tags(trim(join(',', $value)));
	    cs()->registerMetaTag($text, 'keywords');
	}
	
    protected function setPageDescription($value)
	{
	    if (empty($value)) return false;
	    
	    $value = (array)$value;
	    $sitename = app()->name;
	    if (param('shortdesc'))
	        $sitename = $sitename . ' - ' . param('shortdesc');
	    array_push($value, $sitename);
	    $text = strip_tags(trim(join(',', $value)));
	    cs()->registerMetaTag($text, 'description');
	}

	public function setSiteTitle($value = '')
	{
        $titleArray = array(app()->name);
        if (param('shortdesc'))
            array_push($titleArray, param('shortdesc'));
        if (!empty($value))
    	    array_unshift($titleArray, $value);

        $text = strip_tags(trim(join(' - ', $titleArray)));
	    $this->pageTitle = $text;
	}


	public function getUserID()
	{
	    return (int)user()->id;
	}
	
	public function getNickname()
	{
	    return $this->user->name;
	}
	
	public function getUser()
	{
	    $user = User::model()->findByPk($this->getUserID());
	    if ($user === null)
	        throw new CHttpException(500, '未找到用户');
	
	    return $user;
	}
}


