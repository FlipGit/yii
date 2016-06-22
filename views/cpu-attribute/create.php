<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\CpuAttribute */

$this->title = Yii::t('app', 'Create Cpu Attribute');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Cpu Attributes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cpu-attribute-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
