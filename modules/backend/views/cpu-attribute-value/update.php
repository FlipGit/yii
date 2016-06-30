<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\CpuAttributeValue */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Cpu Attribute Value',
]) . $model->cpu_attribute_value_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Cpu Attribute Values'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->cpu_attribute_value_id, 'url' => ['view', 'id' => $model->cpu_attribute_value_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="cpu-attribute-value-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
