<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\CpuAttributeValue */

$this->title = Yii::t('app', 'Create Cpu Attribute Value');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Cpu Attribute Values'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cpu-attribute-value-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
