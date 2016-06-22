<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CpuAttributeGroupSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cpu-attribute-group-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'cpu_attribute_group_id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'order') ?>

    <?= $form->field($model, 'parent_cpu_attribute_group_id') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
