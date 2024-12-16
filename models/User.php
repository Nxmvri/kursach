<?php

namespace app\models;

use Yii;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "users".
 *
 * @property int $id_user
 * @property string $full_name
 * @property string $username
 * @property string $avatar
 * @property string $email
 * @property string $phone
 * @property string $password
 * @property string $role
 *
 * @property Courses[] $courses
 * @property VisitedCourses[] $visitedCourses
 */
class User extends \yii\db\ActiveRecord implements IdentityInterface
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['full_name', 'username', 'email', 'phone', 'password'], 'required'],
            [['role'], 'string'],
            [['full_name', 'username', 'avatar', 'email', 'phone', 'password','token'], 'string', 'max' => 255],

            ['username', 'match', 'pattern' => '/^[A-Za-z]+$/', 'message'=>'Только латиница'],
            ['username', 'unique'],
            ['password', 'match', 'pattern' => '/^.{6,}$/', 'message'=>'От шести символов'],
            ['full_name', 'match', 'pattern' => '/^[а-яё\s]+$/iu', 'message'=>'Только кириллица и пробелы'],
            ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_user' => 'Id User',
            'full_name' => 'Full Name',
            'username' => 'Login',
            'avatar' => 'Avatar',
            'email' => 'Email',
            'phone' => 'Phone',
            'password' => 'Password',
            'role' => 'Role',
        ];
    }
    /**
     * Gets query for [[Courses]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCourses()
    {
        return $this->hasMany(Courses::class, ['id_course' => 'course_id'])->viaTable('visitedCourses', ['user_id' => 'id_user']);
    }

    /**
     * Gets query for [[VisitedCourses]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getVisitedCourses()
    {
        return $this->hasMany(VisitedCourses::class, ['user_id' => 'id_user']);
    }

    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    public function isAdmin() {
        $user = $this::getByToken();
        return boolval($user->role="Admin");
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['token' => $token]);
    }

    public static function getByToken() {
        return self::findOne(['token' => str_replace('Bearer ', '', Yii::$app->request->headers->get('Authorization'))]);
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey()
    {
        return $this->authKey;
    }

    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }
    public function isAuthorized() {
        $token = str_replace('Bearer ', '', Yii::$app->request->headers->get('Authorization'));
        if (!$token || $token != $this->token) {
            return false;
        }
        return true;
    }
}
