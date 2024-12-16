<?php

use app\models\VisitedCourses;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\VisitedCoursesSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Visited Courses';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="visited-courses-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Visited Courses', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_link',
            'user_id',
            'course_id',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, VisitedCourses $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id_link' => $model->id_link]);
                 }
            ],
        ],
    ]); ?>


</div>
