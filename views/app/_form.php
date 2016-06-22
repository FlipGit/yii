<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Country */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="app-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]); ?>

    <?= $form->field($model, 'description')->textarea(['maxlength' => true]); ?>

    <?= Html::submitButton(
        $model->isNewRecord
            ? 'Create'
            : 'Update',
        $model->isNewRecord
            ? ['class' => 'btn btn-success']
            : ['class' => 'btn btn-primary']
    ); ?>

    <?php $form->end(); ?>

</div>
