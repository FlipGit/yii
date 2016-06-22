<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider \yii\data\ActiveDataProvider */
/* @var $searchModel app\models\AppSearch */

$this->title = 'Applications';

$this->params['breadcrumbs'][] = $this->title;

?>

<div class="app-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create', ['create'], ['class' => 'btn btn-success']); ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'app_id',
            'name',
            [
                'label' => 'Description',
                'attribute' => 'description',
                'value' => function ($model) {
                    return mb_substr($model->description, 0, 128, 'utf-8') . '...';
                }
            ],
            [
                'label' => 'Versions',
                'format' => 'raw',
                'value' => function ($model) {
                    $links = [];

                    foreach ($model->versionCollection as $appVersion) {

                        $links[] = Html::a(Html::encode($appVersion->version), [
                            'app-version/view', 'id' => $appVersion->app_version_id
                        ]);

                    }

                    return implode($links, ', ');
                }
            ],
            ['class' => '\yii\grid\ActionColumn']
        ]
    ]) ?>

</div>