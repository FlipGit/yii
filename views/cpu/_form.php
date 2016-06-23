<?php

use app\models\CpuAttribute;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\CpuAttributeValue;

/* @var $this yii\web\View */
/* @var $model app\models\Cpu */
/* @var $form yii\widgets\ActiveForm */
/* @var $attributeGroupCollection app\models\CpuAttributeGroup[] */
/* @var $cpuAttributeCollection app\models\CpuAttribute[] */

?>

<div class="cpu-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'created_date')->textInput() ?>

    <?= $form->field($model, 'updated_date')->textInput() ?>

    <?= $form->field($model, 'attribute_json')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'performance_rank')->textInput() ?>

    <?= $form->field($model, 'performance_per_vat')->textInput() ?>

    <?= $form->field($model, 'performance_per_dollar')->textInput() ?>

    <?php if ($model->isNewRecord == false) {

        foreach ($cpuAttributeCollection as $i => $cpuAttribute) {

            $cpuAttributeValue = isset($cpuAttribute->cpuAttributeValues[0])
                ? $cpuAttribute->cpuAttributeValues[0]
                : new CpuAttributeValue();

            echo Html::hiddenInput('CpuAttributeValue[' . $i .'][cpu_id]', $model->cpu_id); // this shit for multiple load/validate
            echo Html::hiddenInput('CpuAttributeValue[' . $i .'][cpu_attribute_value_id]', $cpuAttributeValue->cpu_attribute_value_id);
            echo Html::hiddenInput('CpuAttributeValue[' . $i .'][cpu_attribute_id]', $cpuAttribute->cpu_attribute_id);
            echo $form->field($cpuAttributeValue, '[' . $i . ']value')->textInput(['maxlength' => true])->label($cpuAttribute->name);

        }

    } ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>