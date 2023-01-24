<?php

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

?>

<div class="row">
    <div class="col-lg-5">
        <?php $form = ActiveForm::begin(['id' => 'registration-form', 'options' => ['enctype' => 'multipart/form-data']]); ?>
            <?= $form->field($model, 'first_name') ?>
            <?= $form->field($model, 'last_name') ?>
            <?= $form->field($model, 'gender')->radioList(['m'=>'Male', 'f'=>'Female']) ?>
            <?= $form->field($model, 'age') ?>
            <?= $form->field($model, 'mobile_no') ?>
            <?= $form->field($model, 'email')->input('email') ?>
            <?= $form->field($model, 'username') ?>
            <?= $form->field($model, 'password')->passwordInput() ?>
            <?= $form->field($model, 'photos[]')->fileInput(['multiple'=>true, 'accept'=>'image/*']) ?>
            <?= $form->field($model, 'subscriptions[]')->checkboxList(['a'=>'Item A', 'b'=>'Item B', 'c'=>'Item C']) ?>
            <div class="form-group">
                <?= Html::submitButton('Submit',['class'=>'btn btn-primary', 'name'=>'registration-btn']) ?>
            </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>