<?php

/* @var $this yii\web\view */
/* @var $model app\models\AppOutputStructure */

$this->title = 'Create Output Structure';

$this->params['breadcrumbs'][] = ['label' => 'Output Structure', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>


<div class="app-output-structure-create">

    <h1><?= $this->title; ?></h1>

    <?= $this->render('_form', [
        'model' => $model
    ]); ?>

</div>
