<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\AppOutputKey;

/* @var $this yii\web\view */
/* @var $model app\models\AppOutputKey */
/* @var $items[] */

?>

<div class="version-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'app_output_structure_id')->dropDownList($items)->label('Output Structure'); ?>

    <?= $form->field($model, 'key')->textInput(['maxlength' => true]); ?>

    <?= $form->field($model, 'comparison')->dropDownList(AppOutputKey::getComparisonCollection()); ?>

    <?= $form->field($model, 'measure')->textInput(['maxlength' => true]); ?>

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
