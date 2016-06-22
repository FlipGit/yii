<?php

use yii\helpers\Html;

/* @var $this yii\web\view */
/* @var $model app\models\AppOutputKey */
/* @var $items[] */

$this->title = 'Update Output Key: ' . $model->key;

$this->params['breadcrumbs'][] = ['label' => 'Output Key', 'url' => 'index'];
$this->params['breadcrumbs'][] = [
    'label' => $model->key,
    'url' => ['view', 'id' => $model->app_output_key_id]
];
$this->params['breadcrumbs'][] = 'Update';

?>

<div class="version-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'items' => $items
    ]); ?>

</div>
