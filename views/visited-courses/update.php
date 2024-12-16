<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\VisitedCourses $model */

$this->title = 'Update Visited Courses: ' . $model->id_link;
$this->params['breadcrumbs'][] = ['label' => 'Visited Courses', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_link, 'url' => ['view', 'id_link' => $model->id_link]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="visited-courses-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
