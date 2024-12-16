<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\VisitedCourses $model */

$this->title = 'Create Visited Courses';
$this->params['breadcrumbs'][] = ['label' => 'Visited Courses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="visited-courses-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
