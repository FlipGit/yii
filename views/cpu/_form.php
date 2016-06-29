<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Cpu */
/* @var $form yii\widgets\ActiveForm */
/* @var $attributeGroupCollection app\models\CpuAttributeGroup[] */
/* @var $cpuAttributeCollection app\models\CpuAttribute[] */

?>

<div class="cpu-form">

    <?php $form = ActiveForm::begin([
        'enableClientValidation' => false,
        'enableAjaxValidation' => true
    ]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?php

        $cpuAttributeValuesCollection = $model->getAttributeValuesForForm();

        foreach ($cpuAttributeValuesCollection as $i => $cpuAttributeValue) {
            echo Html::hiddenInput($cpuAttributeValue->formName() . '[' . $i .'][cpu_id]', $model->cpu_id);
            echo Html::hiddenInput($cpuAttributeValue->formName() . '[' . $i .'][cpu_attribute_value_id]', $cpuAttributeValue->cpu_attribute_value_id);
            echo Html::hiddenInput($cpuAttributeValue->formName() . '[' . $i .'][cpu_attribute_id]', $cpuAttributeValue->cpu_attribute_id);
            echo $form
                ->field($cpuAttributeValue, '[' . $i . ']value')
                ->textInput(['maxlength' => true])
                ->label($cpuAttributeValue->cpuAttribute->name); // @TODO fix performance && fix bug
        }

     ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>