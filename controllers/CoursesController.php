<?php
namespace app\controllers;
use app\models\Courses;
use app\models\Categories;
use app\models\User;
use yii\web\UploadedFile;
use Yii;

class CoursesController extends FunctionController
{
 public $modelClass = 'app\models\Courses';
 
 public function actionSearch()
    {
        $queryP = Yii::$app->request->get('category');

        // Проверяем, передан ли параметр query
        if (empty($queryP)) {
            return $this->asJson([
                'error' => [
                    'code' => 400,
                    'message' => 'Массив пуст'
                ]
            ])->setStatusCode(400);
        }

        // Выполняем поиск по курсам и категориям
        $courses = Courses::find()
            ->joinWith('category')
            ->where(['like', 'courses.name', $queryP])
            ->orWhere(['like', 'categories.name', $queryP])->all();

            if (empty($courses)) {
                return $this->asJson([
                    'error' => [
                        'code' => 404,
                        'message' => 'Курсы не найдены'
                    ]
                ])->setStatusCode(404);
            }
    
            // Формируем ответ
            $result = [];
            foreach ($courses as $course) {
                $result[] = [
                    'id' => $course->id_course,
                    'name' => $course->name,
                    'courses' => Categories::find($course->category)->one()->name, // Получаем название категории
                    'description' => $course->description,
                    'photo' => $course->photo,
                    'price' => $course->price,
                ];
            }
    
            return $this->asJson([
                'data' => [
                    'courses' => $result
                ]
            ])->setStatusCode(200);
        }

        public function actionView() {
            $courses = Courses::find()->all();
            
            if (empty($courses)) {
                return $this->send(404, [
                    'error' => [
                        'code' => 404,
                        'message' => 'Курсы не найдены'
                    ]
                ]);
            }
            $courseList = [];
            foreach ($courses as $course) {
                $courseList[] = [
                    'id' => $course->id_course,
                    'name' => $course->name,
                    'courses' => Categories::find($course->category)->one()->name, // Получаем название категории
                    'description' => $course->description,
                    'photo' => $course->photo, 
                    'price' => $course->price,
                ];
            }
        
            // Возврат успешного ответа с данными о продуктах
            return $this->send(200, [
                'data' => [
                    'courses' => $courseList
                ]
            ]);
        }

    public function actionCreate(){
        $user = User::getByToken();
        $post_data=\Yii::$app->request->post();
        if (!($user && $user->isAuthorized() && $user->isAdmin())) {
           return $this->send(403, ['error' => ['message' => 'Доступ запрещен']]);
       }
            $post_data=\Yii::$app->request->post();
            $course=new Courses();
            $course->load($post_data, '');
            $course->photo=UploadedFile::getInstanceByName('photo');
            if (!$course->validate()) return $this->validation($course);
             $hash=hash('sha256', $course->photo->baseName) . '.' . $course -> photo->extension;
             $course->photo->saveAs(\Yii::$app->basePath. '/api/assets/upload/' . $hash);
             $course->photo=$hash;
             $course->save(false);
             return $this->send(201, null);
            } 

            public function actionChange()
            {
                $id_course = Yii::$app->request->get('id_course');
                    $user = User::getByToken();
                    if (!($user && $user->isAuthorized() && $user->isAdmin())) {
                        return $this->send(403, ['error' => ['message' => 'Доступ запрещен!']]);
                    }
                        $data = Yii::$app->request->post();
                        $course = Courses::findOne($id_course);
                        if (!$course) {
                            return $this->send(404, [
                                'error' => [
                                    'code' => 404,
                                    'message' => 'Курс не найден'
                                ]
                            ]);
                        }
                        if (isset($data['name'])) {
                            $course->name = $data['name'];
                        }
                        
                        if (isset($data['category'])) {
                            $course->type_id = $data['category'];
                        }
                    
                        if (isset($data['price'])) {
                            $course->cost = $data['price'];
                        }
                    
                        if (isset($data['description'])) {
                            $course->description = $data['description'];
                        }
                        if ($course->validate() && $course->save()) {
                            return $this->send(200, [
                                'data' => [
                                    'status' => 'ok'
                                    
                                ]
                            ]);
                        }
                        return $this->validation($course);
            }


    public function actionDelete($id_course){
        $user = User::getByToken();
        $course = Courses::findOne($id_course);
        if (!($user && $user->isAuthorized() && $user->isAdmin())) {
            return $this->send(403, ['error' => ['message' => 'Доступ запрещен']]);
        }
             if(!empty($course -> id_course)){
             $course -> delete();
             return $this->send(204,null);
             }
             else{
                 return $this->send(404,['error'=>['code'=>404, 'message'=>'Not found', 'errors'=>['Курс не найден']]]);
             }
             }
}