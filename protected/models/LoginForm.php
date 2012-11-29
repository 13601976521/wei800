<?php
class LoginForm extends CFormModel
{
    const COOKIE_LOGIN_ERROR = 'sd7fh328fhs';
    
    public $email;
    public $username;
    public $password;
    public $captcha;
    public $rememberMe = 1;
    public $agreement = 1;
    public $returnUrl;

    private $_identity;
    private static $_maxLoginErrorNums = 3;

    public function rules()
    {
        return array(
            array('email', 'required', 'message'=>'请输入您的email'),
            array('email', 'unique', 'className'=>'User', 'attributeName'=>'email', 'on'=>'signup', 'message'=>'该email已经被已经'),
            array('email', 'email'),
            array('username', 'required', 'message'=>'请输入您的名字', 'on'=>'signup'),
            array('username', 'unique', 'className'=>'User', 'attributeName'=>'name', 'on'=>'signup', 'message'=>'该名字已经被已经'),
            array('username', 'checkReserveWords'),
            array('password', 'required', 'on'=>'signup', 'message'=>'请输入您的密码'),
            array('password', 'authenticate', 'on'=>'login'),
            array('captcha', 'captcha', 'allowEmpty'=>!$this->getEnableCaptcha(), 'on'=>'login'),
            array('captcha', 'captcha', 'allowEmpty'=>false, 'on'=>'signup'),
            array('rememberMe', 'boolean', 'on'=>'login'),
            array('username, password', 'length', 'min'=>3, 'max'=>50),
            array('email, returnUrl', 'length', 'max'=>255),
            array('agreement', 'compare', 'compareValue'=>true, 'on'=>'signup', 'message'=>'请同意服务条款和协议'),
            array('rememberMe', 'in', 'range'=>array(0, 1)),
        );
    }
    
    public function checkReserveWords($attribute, $params)
    {
        if ($this->hasErrors('username')) return false;
        foreach ((array)param('reservedWords') as $v) {
            $pos = stripos($this->$attribute, $v);
            if (false !== $pos) {
                $this->addError($attribute, '该名字已经被已经');
                break;
            }
        }
        return true;
    }

    public function authenticate($attribute, $params)
    {
        if ($this->hasErrors('email')) return false;
        $this->_identity = new UserIdentity($this->email, $this->password);

        if (!$this->_identity->authenticate()) {
            $this->addError($attribute, '账号或密码错误');
        }
    }

    public function attributeLabels()
    {
        return array(
            'username' => '名字',
            'password' => '密码',
            'captcha' => '验证码',
            'rememberMe' => '下次自动登录',
            'email' => '邮箱',
        	'agreement' => '同意协议',
            'reutrnUrl' => 'Return Url',
        );
    }

    /**
     * 用户登陆
     */
    public function login()
    {
        $duration = (user()->allowAutoLogin && $this->rememberMe) ? param('auto_login_duration') : 0;
        if (user()->login($this->_identity, $duration)) {
            $this->afterLogin();
            return true;
        }
        else
            return false;
    }

    /**
     * 创建新账号
     */
    public function signup()
    {
        $user = new User();
	    $user->email = $this->email;
	    $user->name = $this->username;
	    $user->password = $this->password;
	    $user->state = (param('user_required_admin_verfiy') || param('user_required_email_verfiy')) ? USER_STATE_UNVERIFY : USER_STATE_ENABLED;
	    $user->encryptPassword();
	    $result = $user->save();

	    if ($result) {
	        $this->afterSignup($user);
	        return true;
	    }
	    else
	        return false;
    }

    public function incrementErrorLoginNums()
    {
        $cookie = request()->cookies[self::COOKIE_LOGIN_ERROR];
        if ($cookie === null) {
            $cookie = new CHttpCookie(self::COOKIE_LOGIN_ERROR, 1);
        }
        elseif ($cookie->value < self::$_maxLoginErrorNums)
            $cookie->value += 1;
        else
            return ;
        
        $cookie->expire = $_SERVER['REQUEST_TIME'] + 3600;
        request()->cookies->add(self::COOKIE_LOGIN_ERROR, $cookie);
    }

    public function clearErrorLoginNums()
    {
        request()->cookies->remove(self::COOKIE_LOGIN_ERROR);
    }

    public function getEnableCaptcha()
    {
        $errorNums = (int)request()->cookies[self::COOKIE_LOGIN_ERROR]->value;
        return $errorNums >= self::$_maxLoginErrorNums;
    }

    public function afterValidate()
    {
        parent::afterValidate();
        if ($this->hasErrors())
            $this->incrementErrorLoginNums();
        else
            $this->clearErrorLoginNums();
    }

    public function afterLogin()
    {
        $returnUrl = urldecode($this->returnUrl);
        if (empty($returnUrl))
            $returnUrl = strip_tags(trim($_GET['url']));
        if (empty($returnUrl))
                $returnUrl = CDBase::adminHomeUrl();
        
        request()->redirect($returnUrl);
        exit(0);
    }
    
    public function afterSignup($user)
    {
        user()->loginRequired();
        exit(0);
    }
}


