<?php

namespace app\controllers;

use app\models\VisitedCourses;
use app\models\User;
use app\models\Courses;
use app\models\Categories;
use app\models\VisitedCoursesSearch;
use yii\rest\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\db\ActiveQuery;

/**
 * VisitedCoursesController implements the CRUD actions for VisitedCourses model.
 */
class VisitedCoursesController extends FunctionController
{
    public function actionView()
    {
        $user = User::getByToken();
        $courses=$user->getVisitedCourses()->all();

        if (!$user || !$user->isAuthorized()) {
            return $this->asJson([
                'error' => [
                    'code' => 403,
                    'message' => 'Доступ запрещен'
                ]
            ])->setStatusCode(403);
        }

        
        $result = [];
        foreach ($courses as $course){
            $result[]=Courses::findOne($course->course_id);
        }

        return $this->asJson($result)->setStatusCode(200); // Возвращаем результат в формате JSON*/

        }

    public function actionDelete($id)
    {
        $user = User::getByToken();
        $course=VisitedCourses::find()->where(['user_id' => $user->id_user])->andWhere(['course_id' => $id])->one();
        //var_dump($course);die;
       // $courses=$user->getVisitedCourses()->one();
        if (!($user && $user->isAuthorized())) {
                return $this->send(403, ['error' => ['message' => 'Доступ запрещен']]);
        }
            if(!empty($course)){
            $course->delete();
            return $this->send(204,['message' => 'Вы покинули курс']);
            }
            else{
            return $this->send(404,['error'=>['code'=>404, 'message'=>'Курс не найден', 'errors'=>['Курс не найден']]]);
            }
    }

    
    }
