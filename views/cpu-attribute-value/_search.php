<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CpuAttributeValueSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cpu-attribute-value-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'cpu_attribute_value_id') ?>

    <?= $form->field($model, 'value') ?>

    <?= $form->field($model, 'cpu_id') ?>

    <?= $form->field($model, 'cpu_attribute_id') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
