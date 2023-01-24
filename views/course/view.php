<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

$this->title = $model['title'];
$this->params['breadcrumbs'][] = ['label' => 'Courses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="course-view">
    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?= Html::a('Update', ['update','id'=>$model['id']], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete','id'=>$model['id']], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method'  => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
            'model'       => $model,
            'attributes'  => [
                'title',
                'category',
                'level',
                'status',
            ],
    ])?>

</div>