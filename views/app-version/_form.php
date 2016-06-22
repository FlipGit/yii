<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\App;

/* @var $this yii\web\view */
/* @var $model app\models\AppVersion */
/* @var $items[] */

?>

<div class="version-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'app_id')->dropDownList($items)->label('Application'); ?>

    <?= $form->field($model, 'version')->textInput(['maxlength' => true]); ?>

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
