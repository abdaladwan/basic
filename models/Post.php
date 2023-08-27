<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Post".
 *
 * @property int $PostID
 * @property string $Title
 * @property string|null $Content
 * @property string|null $Timestamp
 * @property int|null $UserID
 *
 * @property Comment[] $comments
 * @property Highlight[] $highlights
 * @property User $user
 */
class Post extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Post';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Title'], 'required'],
            [['Content'], 'string'],
            [['Timestamp'], 'safe'],
            [['UserID'], 'integer'],
            [['Title'], 'string', 'max' => 255],
            [['UserID'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['UserID' => 'UserID']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'PostID' => 'Post ID',
            'Title' => 'Title',
            'Content' => 'Content',
            'Timestamp' => 'Timestamp',
            'UserID' => 'User ID',
        ];
    }

    /**
     * Gets query for [[Comments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comment::class, ['PostID' => 'PostID']);
    }

    /**
     * Gets query for [[Highlights]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getHighlights()
    {
        return $this->hasMany(Highlight::class, ['PostID' => 'PostID']);
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
