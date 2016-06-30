<?php

use yii\helpers\Html;
use yii\widgets\LinkPager;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Cpu';
$this->params['breadcrumbs'][] = $this->title;

echo LinkPager::widget([
    'pagination' => $dataProvider->pagination
]);