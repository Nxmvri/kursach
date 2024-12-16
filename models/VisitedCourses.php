<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "visitedCourses".
 *
 * @property int $id_link
 * @property int $user_id
 * @property int $course_id
 *
 * @property Courses $course
 * @property User $user
 */
class VisitedCourses extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'visitedCourses';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'course_id'], 'required'],
            [['user_id', 'course_id'], 'integer'],
            [['user_id', 'course_id'], 'unique', 'targetAttribute' => ['user_id', 'course_id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id_user']],
            [['course_id'], 'exist', 'skipOnError' => true, 'targetClass' => Courses::class, 'targetAttribute' => ['course_id' => 'id_course']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_link' => 'Id Link',
            'user_id' => 'User ID',
            'course_id' => 'Course ID',
        ];
    }

    /**
     * Gets query for [[Course]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCourse()
    {
        return $this->hasOne(Courses::class, ['id_course' => 'course_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id_user' => 'user_id']);
    }
}
