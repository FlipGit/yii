<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Cpu */
/* @var $cpuAttributeCollection app\models\CpuAttribute[] */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Cpu',
]) . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Cpus'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->cpu_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="cpu-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        //'cpuAttributeCollection' => $cpuAttributeCollection
    ]) ?>

</div>
