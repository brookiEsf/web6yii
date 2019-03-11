<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%posts}}".
 *
 * @property int $id
 * @property int $user_id
 * @property string $date_created
 * @property string $date_updated
 * @property string $body
 * @property string $title
 *
 * @property Comments[] $comments
 * @property Users $user
 */
class Posts extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%posts}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'body', 'title'], 'required'],
            [['user_id'], 'integer'],
            [['date_created', 'date_updated'], 'safe'],
            [['body'], 'string'],
            [['title'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Userdb::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'Username',
            'date_created' => 'Date Created',
            'date_updated' => 'Date Updated',
            'body' => 'Body',
            'title' => 'Title',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comments::className(), ['post_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Userdb::className(), ['id' => 'user_id']);

    }

    public function beforeSave($insert)
    {
        $date = date('Y-m-d H:i:s');// $date= date('Y-m-d').(date('H')-1) . date(':i:s');
        if ($insert) {
            $this->date_created = $this->date_updated = $date;
        } else {
            $this->date_updated = $date;
        }
        return parent::beforeSave($insert);
    }
}
