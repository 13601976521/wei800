<?php

/**
 * This is the model class for table "{{AdWeixin}}".
 *
 * The followings are the available columns in table '{{AdWeixin}}':
 * @property string $id
 * @property integer $user_id
 * @property string $original_wxid
 * @property string $custom_wxid
 * @property string $wxname
 * @property string $avatar
 * @property string $contact
 * @property string $phone
 * @property string $qq
 * @property string $email
 * @property string $site
 * @property string $create_time
 * @property string $create_ip
 * @property string $desc
 * @property integer $state
 *
 * @property string $createTime
 * @property string $avatarUrl
 * @property string $avatarImage
 * @property string $filterDesc
 */
class AdWeixin extends CActiveRecord
{
    public static function states()
    {
        return array(ADWEIXIN_STATE_DISABLED, ADWEIXIN_STATE_ENABLED);
    }
    
	/**
	 * Returns the static model of the specified AR class.
	 * @return AdWeixin the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return TABLE_ADWEIXIN;
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return array(
	        array('user_id, original_wxid, custom_wxid, wxname', 'required'),
			array('user_id, create_time, state', 'numerical', 'integerOnly'=>true),
			array('original_wxid, contact, phone, qq', 'length', 'max'=>20),
			array('custom_wxid, wxname', 'length', 'max'=>50),
			array('avatar, email, site', 'length', 'max'=>250),
			array('create_ip', 'length', 'max'=>15),
	        array('email', 'email'),
	        array('site', 'url'),
	        array('avatar', 'file', 'allowEmpty'=>true),
	        array('state', 'in', 'range'=>self::states()),
			array('desc', 'safe'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		return array(
            'user' => array(self::BELONGS_TO, 'User', 'user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'user_id' => '用户ID',
			'original_wxid' => '原始微信号',
			'custom_wxid' => '微信号',
			'wxname' => '公众号名称',
			'avatar' => '圆形头像',
			'contact' => '联系人',
			'phone' => '联系电话',
			'qq' => '联系QQ',
			'email' => '电子邮箱',
			'site' => '网站',
			'create_time' => '收录时间',
			'create_ip' => '收录IP',
			'desc' => '简介',
		    'state' => '状态',
		);
	}
	

	public function getCreateTime($format = null)
	{
	    if  (null === $format)
	        $format = param('formatShortDateTime');
	
	    return date($format, $this->create_time);
	}
	
	public function getAvatarUrl()
	{
	    $url = $this->avatar;
	    if (empty($url))
	        $url = '';
	    elseif (!CDBase::isHttpUrl($url))
	        $url = fbu($url);
	    
	    return $url;
	}
	
	public function getAvatarImage()
	{
	    $html = '';
	    if ($this->getAvatarUrl())
	        $html = image($this->getAvatarUrl(), '圆形头像', array('class'=>'wx-avatar'));
	    
	    return $html;
	}
	
	public function getFilterDesc($len = 0)
	{
	    $desc = strip_tags(trim($this->desc));
	    if ($len > 0)
	        $desc = mb_strimwidth($desc, 0, $len, '...', app()->charset);
	    
	    return $desc;
	}
	
	protected function beforeSave()
	{
	    if ($this->getIsNewRecord()) {
	        $this->create_time = time();
	        $this->create_ip = CDBase::getClientIp();
	    }
	    $this->desc = strip_tags(trim($this->desc));
	    return true;
	}
	
	public function upload()
	{
	    $upload = CUploadedFile::getInstance($this, 'avatar');
	    if ($upload !== null) {
	        $filename = CDBase::uploadImage($upload, 'adavatars', false);
	        if ($filename !== false)  {
	            $this->avatar = $filename['url'];
	    
	            if (!$this->save(true, array('avatar'))) {
	                $file = realpath($filename['path']);
	                if ($file !== false) @unlink($file);
	            }
	        }
	    }
	}
}




