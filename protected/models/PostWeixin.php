<?php

/**
 * This is the model class for table "{{post_weixin}}".
 *
 * The followings are the available columns in table '{{post_weixin}}':
 * @property integer $id
 * @property integer $post_id
 * @property integer $wx_id
 * @property integer $follow_success
 * @property integer $follow_fail
 */
class PostWeixin extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return PostWeixin the static model class
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
		return TABLE_POST_WEIXIN;
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return array(
    		array('post_id, wx_id', 'required'),
    		array('post_id, wx_id, follow_success, follow_fail', 'numerical', 'integerOnly'=>true),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		return array(
    		'post' => array(self::BELONGS_TO, 'Post', 'post_id'),
    		'weixin' => array(self::BELONGS_TO, 'Weixin', 'wx_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'post_id' => '文章ID',
			'wx_id' => '微信ID',
			'follow_success' => '关注成功数',
			'follow_fail' => '关注失败数',
		);
	}

}



