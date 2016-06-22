<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\view */
/* @var $model app\models\AppOutputStructure */

?>

<div class="app-output-structure-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]); ?>

    <?= $form->field($model, 'note')->textarea(['maxlength' => true]); ?>

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
