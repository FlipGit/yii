<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\view */
/* @var $model app\models\AppOutputKey */

$this->title = $model->key;

$this->params['breadcrumbs'][] = ['label' => 'Output Key', 'url' => 'index'];
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="app-version-view">

    <h1><?= Html::encode($this->title); ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->app_output_key_id], ['class' => 'btn btn-primary']); ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->app_output_key_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure?',
                'method' => 'post'
            ]
        ]); ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'app_output_key_id',
            [
                'label' => 'Output Structure',
                'format' => 'raw',
                'value' => Html::a(
                    $model->appOutputStructure->name,
                    ['app-output-structure/view', 'id' => $model->app_output_structure_id])
            ],
            'key',
            'measure',
            'comparison'
        ]
    ]); ?>

</div>
