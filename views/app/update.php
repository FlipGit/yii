<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var $this yii\web\view */
/** @var $model app\models\App */

$this->title = 'Update Application: ' . $model->name;

$this->params['breadcrumbs'][] = ['label' => 'Applications', 'url' => 'index'];
$this->params['breadcrumbs'][] = [
    'label' => $model->name, 'url' => [
        'view',
        'id' => $model->app_id
    ]
];
$this->params['breadcrumbs'][] = ['label' => 'Update'];

?>

<div class="app-update">

    <h1><?= Html::encode($this->title); ?></h1>

    <?= $this->render('_form', [
        'model' => $model
    ]); ?>

</div>
