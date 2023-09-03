<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "User".
 *
 * @property int $UserID
 * @property string $Username
 * @property string $Email
 * @property string $Password
 *
 * @property Comment[] $comments
 * @property Highlight[] $highlights
 * @property Post[] $posts
 */
class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    /**
     * {@inheritdoc}
     */
    //public $is_deleted;

    public $id;
    public $username;
    public $password;
    public $authKey;
    public $auth_key;
    public $accessToken;
    public $password_hash;




    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'User';
    }
/*
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord) {
                $this->auth_key = \Yii::$app->security->generateRandomString();
            }
            return true;
        }
        return false;
    }
*/

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord || $this->isAttributeChanged('Password')) {
                // Hash the password only if it's a new record or if the password has changed
                $security = Yii::$app->security;
                $this->Password = $security->generatePasswordHash($this->Password);
            }
            return true;
        }
        return false;
    }




    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);

    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['Username' => $username]);
    }
    public static function find()
    {
        return parent::find()->where(['is_deleted' => false]);
    }


    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */

    public function getAuthKey()
    {
        return $this->auth_key;
    }

    public function setAuthKey($authKey)
    {
        $this->auth_key = $authKey;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */


    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->Password);
    }



    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Username', 'Email', 'Password'], 'required'],
            [['Username', 'Email', 'Password'], 'string', 'max' => 255],
            ['is_deleted', 'boolean'],
            ['password_hash', 'safe'],


        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'UserID' => 'User ID',
            'Username' => 'Username',
            'Email' => 'Email',
            'Password' => 'Password',
        ];
    }

    /**
     * Gets query for [[Comments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comment::class, ['UserID' => 'UserID']);
    }

    /**
     * Gets query for [[Highlights]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getHighlights()
    {
        return $this->hasMany(Highlight::class, ['UserID' => 'UserID']);
    }

    /**
     * Gets query for [[Posts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPosts()
    {
        return $this->hasMany(Post::class, ['UserID' => 'UserID']);
    }
}

/*
namespace app\models;

class User extends \yii\base\BaseObject
{

}*/






