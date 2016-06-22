<?php

use yii\helpers\Html;

/* @var $this yii\web\view */
/* @var $model app\models\AppOutputStructure */

$this->title = 'Update Output Structure: ' . $model->name;


$this->params['breadcrumbs'][] = ['label' => 'Output Structure', 'url' => ['index']];
$this->params['breadcrumbs'][] = [
    'label' => $model->name,
    'url' => ['view', 'id' => $model->app_output_structure_id]
];
$this->params['breadcrumbs'][] = 'Update';

?>


<div class="app-output-structure-update">

    <h1><?= Html::encode($this->title); ?></h1>

    <?= $this->render('_form', [
        'model' => $model
    ]); ?>

</div>
