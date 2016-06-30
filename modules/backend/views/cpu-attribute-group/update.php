<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\CpuAttributeGroup */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Cpu Attribute Group',
]) . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Cpu Attribute Groups'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->cpu_attribute_group_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="cpu-attribute-group-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
