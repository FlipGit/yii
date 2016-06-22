<?php

use yii\widgets\DetailView;
use yii\helpers\Html;

/* @var $this yii\web\view */
/* @var $model app\models\AppOutputStructure */

$this->title = $model->name;

$this->params['breadcrumbs'][] = ['label' => 'Output Structure', 'url' => 'index'];
$this->params['breadcrumbs'][] = ['label' => $this->title];

?>

<div class="app-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->app_output_structure_id], ['class' => 'btn btn-primary']); ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->app_output_structure_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure?',
                'method' => 'post'
            ]
        ]); ?>
    </p>

    <?= DetailView::widget([
        'model' => $model
    ]); ?>

</div>
