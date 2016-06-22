<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\view */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $searchModel app\models\AppOutputStructureSearch */

$this->title = 'Output Structure';

$this->params['breadcrumbs'][] = $this->title;

?>

<div class="app-output-structure-index">

    <h1><?= $this->title; ?></h1>

    <p>
        <?= Html::a('Create Output Structure', ['create'], ['class' => 'btn btn-success']); ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'app_output_structure_id',
            'name',
            'note',
            ['class' => '\yii\grid\ActionColumn']
        ]
    ]); ?>

</div>
