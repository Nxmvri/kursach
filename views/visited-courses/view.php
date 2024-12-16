<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\VisitedCourses $model */

$this->title = $model->id_link;
$this->params['breadcrumbs'][] = ['label' => 'Visited Courses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="visited-courses-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id_link' => $model->id_link], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id_link' => $model->id_link], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_link',
            'user_id',
            'course_id',
        ],
    ]) ?>

</div>
