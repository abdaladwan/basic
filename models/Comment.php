<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Comment".
 *
 * @property int $CommentID
 * @property string|null $content
 * @property string|null $Timestamp
 * @property int|null $PostID
 * @property int|null $UserID
 *
 * @property Post $post
 * @property User $user
 */
class Comment extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Comment';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['content'], 'string'],
            [['Timestamp'], 'safe'],
            [['PostID', 'UserID'], 'integer'],
            [['PostID'], 'exist', 'skipOnError' => true, 'targetClass' => Post::class, 'targetAttribute' => ['PostID' => 'PostID']],
            [['UserID'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['UserID' => 'UserID']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'CommentID' => 'Comment ID',
            'content' => 'Content',
            'Timestamp' => 'Timestamp',
            'PostID' => 'Post ID',
            'UserID' => 'User ID',
        ];
    }

    /**
     * Gets query for [[Post]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPost()
    {
        return $this->hasOne(Post::class, ['PostID' => 'PostID']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['UserID' => 'UserID']);
    }
}
