<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<div class="course-form">
    <?php $form = ActiveForm::begin(); ?>
        <?= $form->field($model, 'id')->textInput() ?>
        <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'short_description')->textarea(['rows' => 6]) ?>
        <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>
        <?= $form->field($model, 'outcomes')->textarea(['rows' => 6]) ?>
        <?= $form->field($model, 'language')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'category_id')->textInput() ?>
        <?= $form->field($model, 'sub_category_id')->textInput() ?>
        <?= $form->field($model, 'section')->textarea(['rows' => 6]) ?>
        <?= $form->field($model, 'requirements')->textarea(['rows' => 6]) ?>
        <?= $form->field($model, 'price')->textInput() ?>
        <?= $form->field($model, 'discount_flag')->textInput() ?>
        <?= $form->field($model, 'discounted_price')->textInput() ?>
        <?= $form->field($model, 'level')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'user_id')->textInput() ?>
        <?= $form->field($model, 'thumbnail')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'video_url')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'date_added')->textInput() ?>
        <?= $form->field($model, 'last_modified')->textInput() ?>
        <?= $form->field($model, 'visibility')->textInput() ?>
        <?= $form->field($model, 'is_top_course')->textInput() ?>
        <?= $form->field($model, 'is_admin')->textInput() ?>
        <?= $form->field($model, 'status')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'course_overview_provider')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'meta_keywords')->textarea(['rows' => 6]) ?>
        <?= $form->field($model, 'meta_description')->textarea(['rows' => 6]) ?>
        <?= $form->field($model, 'is_free_course')->textInput() ?>
        <div class="form-group">
            <?= Html::submitButton('Submit',['class' => 'btn btn-success']) ?>
        </div>
    <?php ActiveForm::end(); ?>
</div>