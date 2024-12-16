<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "courses".
 *
 * @property int $id_course
 * @property string $name
 * @property int $category
 * @property string $description
 * @property int $price
 *
 * @property Categories $category
 * @property User[] $users
 * @property VisitedCourses[] $visitedCourses
 */
class Courses extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'courses';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'photo', 'category', 'description', 'price'], 'required'],
            [['category', 'price'], 'integer'],
            [['description'], 'string'],
            [['name'], 'string', 'max' => 255],
            ['photo', 'file', 'extensions' => 'png, jpg, jpeg'],
            [['category'], 'exist', 'skipOnError' => true, 'targetClass' => Categories::class, 'targetAttribute' => ['category' => 'id_category']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_course' => 'Id Course',
            'name' => 'Name',
            'photo' => 'Photo',
            'category' => 'Category',
            'description' => 'Description',
            'price' => 'Price',
        ];
    }

    /**
     * Gets query for [[Category]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Categories::class, ['id_category' => 'category']);
    }

    /**
     * Gets query for [[Users]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::class, ['id_user' => 'user_id'])->viaTable('visitedCourses', ['course_id' => 'id_course']);
    }

    /**
     * Gets query for [[VisitedCourses]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getVisitedCourses()
    {
        return $this->hasMany(VisitedCourses::class, ['course_id' => 'id_course']);
    }
}
