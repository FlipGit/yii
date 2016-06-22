<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CpuAttribute */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cpu-attribute-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'type')->dropDownList([ 'integer' => 'Integer', 'unsigned integer' => 'Unsigned integer', 'double' => 'Double', 'string' => 'String', 'datetime' => 'Datetime', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'comparison')->dropDownList([ 'incomparable' => 'Incomparable', 'higher_better' => 'Higher better', 'lower_better' => 'Lower better', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'order')->textInput() ?>

    <?= $form->field($model, 'cpu_attribute_group_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>