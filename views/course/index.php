<?php

use app\models\Course;

use yii\helpers\Html;
use yii\helpers\Url;

use yii\grid\GridView;
use yii\grid\ActionColumn;


$this->title = "Courses";
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="course-index">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Course',['create'],['class' => 'btn btn-primary']) ?>
    </p>

    <?= $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView:: widget([
        'dataProvider'  =>  $dataProvider,
        'filterModel'   =>  $searchModel,
        'columns'       =>  [
            ['class'    =>  'yii\grid\SerialColumn'],
            [
                'attribute' => 'title',
                'label'    =>  'title',
                'format'    => 'raw',
                'value'     =>  function($model){
                    return Html::a($model->title,['/course/index']);
                },
            ],
            [
                'class' =>  ActionColumn::classname(),
                'urlCreator'    =>  function($action, Course $model, $key, $index, $column){
                    return Url::toRoute([$action, 'id' =>  $model->id]);
                }
            ]
        ]
    ]);?>

</div>


