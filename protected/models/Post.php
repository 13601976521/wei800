<?php

/**
 * This is the model class for table "{{Post}}".
 *
 * The followings are the available columns in table '{{Post}}':
 * @property integer $id
 * @property integer $weixin_id
 * @property integer $user_id
 * @property string $title
 * @property string $content
 * @property string $theme_name
 * @property integer $view_count
 * @property integer $back_count
 * @property integer $share_count
 * @property integer $comment_count
 * @property integer $create_time
 * @property string $create_ip
 * @property string $ad_accounts
 * @property integer $ad_line_count
 *
 * @property CDTheme $theme
 * @property integer $visitCount
 * @property string $filterContent
 * @property string $createTime
 * @property string $shortCreateTime
 * @property string $weixinUrl
 * @property string $backUrl
 * @property string $summary
 * @property AdWeixin $adweixin
 * @property Weixin $weixin
 * @property User $user
 * @property string $weixinShareImgUrl
 * @property array $lineShowWeixin
 * @property array $gridShowWeixin
 * @property array $groupPosts
 * @property array $adWeixinModels
 */
class Post extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Post the static model class
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
		return TABLE_POST;
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return array(
	        array('weixin_id, user_id, title, content', 'required'),
	        array('weixin_id, user_id, view_count, back_count, share_count, comment_count, create_time, ad_line_count', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>200),
			array('theme_name', 'length', 'max'=>50),
			array('create_ip', 'length', 'max'=>15),
			array('content, ad_accounts', 'safe'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		return array(
	        'weixin' => array(self::BELONGS_TO, 'Weixin', 'weixin_id'),
	        'user' => array(self::BELONGS_TO, 'User', 'user_id'),
	        'adweixin' => array(self::MANY_MANY, 'AdWeixin', '{{post_weixin}}(post_id, wx_id)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'weixin_id' => '绑定微信ID',
			'user_id' => '用户ID',
			'title' => '标题',
			'content' => '内容',
			'view_count' => '查看数',
			'back_count' => '回流数',
			'share_count' => '分享数',
			'comment_count' => '评论数',
			'create_time' => '创建时间',
			'create_ip' => '创建IP',
	        'ad_accounts' => '推广账号',
	        'ad_line_count' => '推广账号行数'
		);
	}

	public function getFilterContent()
	{
	    return $this->content;
	}

	public function getSummary($len = 0)
	{
	    $content = trim(strip_tags(nl2br($this->content)));
	    $len = ($len === 0) ? param('post_summary_len') : $len;
	    return mb_strimwidth($content, 0, $len, '...', app()->charset);
	}

	public function getCreateTime($format = null)
	{
	    if  (null === $format)
	        $format = param('formatDateTime');
	
	    return date($format, $this->create_time);
	}

	public function getShortCreateTime($format = null)
	{
	    if  (null === $format)
	        $format = param('formatShortDateTime');
	
	    return date($format, $this->create_time);
	}
	
	public function getFirstImageUrl()
	{
	    $url = '';
	    $pattern = '/<img.+?src="(.+?)"/is';
	    $result = preg_match($pattern, $this->content, $matches);
	    if ($result === 1)
	        $url = $matches[1];
	    
	    return $url;
	}
	
	public function getWeixinShareImgUrl()
	{
	    $url = $this->getFirstImageUrl();
	    if (empty($url))
	        $url = $this->weixin->rectAvatarUrl;

	    return $url;
	}

	public function getTheme()
	{
	    if ($this->theme_name) {
	        $theme = tm()->getTheme($this->theme_name);
	        if ($theme !== null)
	            return $theme;
	    }
	    
	    return null;
	}
	
	public function getWeixinUrl()
	{
	    return aurl('post/show', array('id'=>$this->id));
	}

	public function getBackUrl()
	{
	    return aurl('post/show', array('id'=>$this->id, 'back'=>1));
	}
	
	public function getAdWeixinIDArray()
	{
	    static $ids = null;
	    if ($ids !== null) return $ids;
	    
	    $ids = array();
	    if ($this->ad_accounts) {
	        $ids = explode(ADWEIXIN_DIVIDER, $this->ad_accounts);
	        $ids = self::filterIDs($ids);
	    }
	    
	    return $ids;
	}
	
	public function getAdWeixinText()
	{
	    $text = $this->ad_accounts;
	    if (is_array($text))
	        $text = join(ADWEIXIN_DIVIDER, $text);
	    
	    return $text;
	}
	
	public function getGridShowWeixin()
	{
	    // 按一行显示4个计算
	    $models = array();
	    $adweixins = $this->getAdWeixinModels();
	    if ($this->ad_line_count > 0 && $adweixins && count($adweixins) > 4) {
	        $offset = - $this->ad_line_count * 4;
	        $models = array_slice($adweixins, $offset);
	    }
	    
	    return $models;
	}
	
	public function getLineShowWeixin()
	{
	    $models = $this->getAdWeixinModels();
	    if ($this->ad_line_count > 0 && $models && count($models) > 4) {
	        $len = count($models) - $this->ad_line_count * 4;
	        $models = array_slice($models, 0, $len);
	    }
	    
	    return $models;
	}
	
	public function getContents()
	{
	    static $contents = null;
	    if ($contents === null) {
	        $contents = explode(POST_CONTENT_MULTIPLE_DIVIDER, $this->content);
	    }
	    
	    return (array)$contents;
	}
	
	public function getFilterContents()
	{
	    static $contents = null;
	    if ($contents === null) {
	        $contents = explode(POST_CONTENT_MULTIPLE_DIVIDER, $this->getFilterContent());
	    }
	    
	    return (array)$contents;
	}
	
	public function getAdWeixinModels()
	{
	    static $weixins = null;
	    if ($weixins !== null) return array();
	    
	    $weixins = array();
	    if ($this->ad_accounts) {
	        $ids = $this->getAdWeixinIDArray();
	        if (empty($ids)) return $weixins;
	        
	        $criteria = new CDbCriteria();
	        $criteria->addInCondition('id', $ids);
	        $models = AdWeixin::model()->findAll($criteria);
	        foreach ($ids as $id)
	            foreach ($models as $model)
	                if ($id == $model->id) $weixins[] = $model;
	    }
	    
        return $weixins;
	}
	
	public static function filterIDs(array $ids)
	{
	    array_walk($ids, 'trim');
	    array_walk($ids, 'intval');
	    array_unique($ids);
	    $ids = array_filter($ids);
	    
	    return $ids;
	}
	
	protected function beforeSave()
	{
	    if ($this->getIsNewRecord()) {
	        $this->create_time = time();
	        $this->create_ip = CDBase::getClientIp();
	    }
	    
	    return true;
	}

    protected function afterSave()
    {
        $weixins = $this->getAdWeixinIDArray();
        if ($weixins) {
            $models = PostWeixin::model()->findAllByAttributes(array('post_id'=>$this->id));
            $ids = array();
            foreach ($models as $model) {
                if (in_array($model->wx_id, $weixins))
                    $ids[] = $model->wx_id;
                else
                    $model->delete();
            }
            
            $diff = array_diff($weixins, $ids);
            foreach ($diff as $id) {
                $pw = new PostWeixin();
                $pw->post_id = $this->id;
                $pw->wx_id = $id;
                $pw->save();
            }
        }
    }

    protected function afterDelete()
    {
        app()->getDb()->createCommand()
            ->delete(TABLE_COMMENT, 'post_id = :pid', array(':pid'=>$this->id));
            
        app()->getDb()->createCommand()
            ->delete(TABLE_POST_WEIXIN, 'post_id = :pid', array(':pid'=>$this->id));
            
    }
}


