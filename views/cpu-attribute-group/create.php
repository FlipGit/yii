<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\CpuAttributeGroup */

$this->title = Yii::t('app', 'Create Cpu Attribute Group');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Cpu Attribute Groups'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cpu-attribute-group-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
