<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CpuSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cpu-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'cpu_id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'created_date') ?>

    <?= $form->field($model, 'updated_date') ?>

    <?= $form->field($model, 'attribute_json') ?>

    <?php // echo $form->field($model, 'performance_rank') ?>

    <?php // echo $form->field($model, 'performance_per_vat') ?>

    <?php // echo $form->field($model, 'performance_per_dollar') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
