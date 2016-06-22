<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\view */
/* @var $model app\models\AppSettings */
/* @var $app_items[] */
/* @var $app_version_items[] */
/* @var $app_output_structure_items[] */

?>

<div class="version-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="form-group">
        <label for="app-settings__app_id">Application</label>
        <?= Html::dropDownList('app_id', $model->isNewRecord ? null : $model->appVersion->app_id, $app_items, [
            'prompt' => 'Select application',
            'class' => 'form-control',
            'id' => 'app-settings__app_id',
            'onchange' =>
                '$.get("' . Yii::$app
                        ->urlManager
                        ->createUrl('app-version/list?app_id=') . '" + $(this).val(), function (data) {
                        var target = $("select#appsettings-app_version_id");
                        target.html(data);

                        if (!data) {
                            target.parent().removeClass("has-success");
                            target.prop("disabled", true);
                            return;
                        }

                        target.prop("disabled", false);
                    }
                );'
        ]); ?>
    </div>

    <?= $form
        ->field($model, 'app_version_id')
        ->dropDownList(
            $model->isNewRecord
                ? []
                : ArrayHelper::map($model->appVersion->app->versionCollection, 'app_version_id', 'version'),
            $model->isNewRecord
                ? ['disabled' => '']
                : []
        )
        ->label('Version'); ?>

    <?= $form
        ->field($model, 'app_output_structure_id')
        ->dropDownList($app_output_structure_items, [
            'prompt' => 'Select output structure'
        ])->label('Output Structure'); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]); ?>

    <?= $form->field($model, 'details')->textarea(['maxlength' => true]); ?>

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
