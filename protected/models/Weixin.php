<?php

/**
 * This is the model class for table "{{Weixin}}".
 *
 * The followings are the available columns in table '{{Weixin}}':
 * @property string $id
 * @property integer $user_id
 * @property string $original_wxid
 * @property string $custom_wxid
 * @property string $wxname
 * @property string $rect_avatar
 * @property string $circle_avatar
 * @property string $qrcode
 * @property integer $fans_count
 * @property string $contact
 * @property string $phone
 * @property string $qq
 * @property string $email
 * @property string $site
 * @property string $tags
 * @property integer $post_count
 * @property string $create_time
 * @property string $create_ip
 * @property string $desc
 * @property integer $state
 *
 * @property string $createTime
 * @property string $rectAvatarUrl
 * @property string $circleAvatarUrl
 * @property string $qrcodeUrl
 * @property string $rectAvatarImage
 * @property string $circleAvatarImage
 * @property string $qrcodeImage
 * @property string $stateText
 * @property string $stateLabel
 * @property string $homeUrl
 */
class Weixin extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Weixin the static model class
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
		return TABLE_WEIXIN;
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return array(
	        array('user_id, original_wxid, custom_wxid, wxname', 'required'),
			array('user_id, state, fans_count, post_count, create_time', 'numerical', 'integerOnly'=>true),
			array('original_wxid, contact, phone, qq', 'length', 'max'=>20),
			array('custom_wxid, wxname', 'length', 'max'=>50),
			array('rect_avatar, circle_avatar, qrcode, email, site, tags', 'length', 'max'=>250),
			array('create_ip', 'length', 'max'=>15),
	        array('email', 'email'),
	        array('site', 'url'),
	        array('rect_avatar, circle_avatar, qrcode', 'file', 'allowEmpty'=>true),
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
			'rect_avatar' => '方形头像',
			'circle_avatar' => '圆形头像',
			'qrcode' => '二维码',
			'fans_count' => '订阅人数',
			'contact' => '联系人',
			'phone' => '联系电话',
			'qq' => '联系QQ',
			'email' => '电子邮箱',
			'site' => '网站',
			'tags' => '标签',
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
	
	public function getRectAvatarUrl()
	{
	    $url = $this->rect_avatar;
	    if (empty($url))
	        $url = '';
	    elseif (!CDBase::isHttpUrl($url))
	        $url = fbu($url);
	    
	    return $url;
	}
	
	public function getCircleAvatarUrl()
	{
	    $url = $this->circle_avatar;
	    if (empty($url))
	        $url = '';
	    elseif (!CDBase::isHttpUrl($url))
	        $url = fbu($url);
	    
	    return $url;
	}
	
	public function getQrcodeUrl()
	{
	    $url = $this->qrcode;
	    if (empty($url))
	        $url = '';
	    elseif (!CDBase::isHttpUrl($url))
	        $url = fbu($url);
	    
	    return $url;
	}
	
	public function getRectAvatarImage()
	{
	    $html = '';
	    if ($this->getRectAvatarUrl())
	        $html = image($this->getRectAvatarUrl(), '方形头像', array('class'=>'wx-avatar'));
	    
	    return $html;
	}
	
	public function getCircleAvatarImage()
	{
	    $html = '';
	    if ($this->getCircleAvatarUrl())
	        $html = image($this->getCircleAvatarUrl(), '圆形头像', array('class'=>'wx-avatar'));
	    
	    return $html;
	}
	
	public function getQrcodeImage()
	{
	    $html = '';
	    if ($this->getQrcodeUrl())
	        $html = image($this->getQrcodeUrl(), '二维码', array('class'=>'wx-qrcode'));
	    
	    return $html;
	}
	
	public static function states()
	{
	    return array(
            WEIXIN_STATE_DISABLED,
            WEIXIN_STATE_ENABLED
        );
	}
	
	public function getStateText()
	{
	    $class = $this->state == WEIXIN_STATE_ENABLED ? 'label-success' : 'label-warning';
	    $text = self::stateLabels($this->state);
	    $html = sprintf('<span class="label %s">%s</span>', $class, $text);
	    return $html;
	}

	public static function stateLabels($state = null)
	{
	    $labels = array(
	        WEIXIN_STATE_DISABLED => '审核中',
	        WEIXIN_STATE_ENABLED => '已审核',
	    );
	     
	    if ($state === null)
	        return $labels;
	    else
	        return $labels[$state];
	}
	
	public function getStateLabel()
	{
	    return self::stateLabels($this->state);
	}
	
	public function getHomeUrl()
	{
	    return aurl('weixin/gh', array('id'=>$this->id));
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
	
	protected function afterSave()
	{
	}
	
	public function upload()
	{
	    $attributes = array();
	    $files = array();
	    $upload = CUploadedFile::getInstance($this, 'rect_avatar');
	    if ($upload !== null) {
	        $filename = CDBase::uploadImage($upload, 'avatars', false);
	        if ($filename !== false) {
	            $files[] = $filename['path'];
	            $this->rect_avatar = $filename['url'];
	            $attributes[] = 'rect_avatar';
	        }
	    }
	    $upload = CUploadedFile::getInstance($this, 'circle_avatar');
	    if ($upload !== null) {
	        $filename = CDBase::uploadImage($upload, 'avatars', false);
	        if ($filename !== false) {
	            $files[] = $filename['path'];
	            $this->circle_avatar = $filename['url'];
	            $attributes[] = 'circle_avatar';
	        }
	    }
	    $upload = CUploadedFile::getInstance($this, 'qrcode');
	    if ($upload !== null) {
	        $filename = CDBase::uploadImage($upload, 'avatars', false);
	        if ($filename !== false) {
	            $files[] = $filename['path'];
	            $this->qrcode = $filename['url'];
	            $attributes[] = 'qrcode';
	        }
	    }
	    if (!empty($attributes)) {
	        if (!$this->save(true, $attributes)) {
	            foreach ($files as $file)
	                if (!empty($file)) @unlink(realpath($file));
	        }
	    }
	}
	
}




