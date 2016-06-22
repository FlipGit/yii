<?php

use yii\widgets\DetailView;
use yii\helpers\Html;

/* @var $this yii\web\view */
/* @var $model app\models\App */

$this->title = $model->name;

$this->params['breadcrumbs'][] = ['label' => 'Applications', 'url' => 'index'];
$this->params['breadcrumbs'][] = ['label' => $this->title];

?>

<div class="app-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php
            echo Html::a('Update', ['update', 'id' => $model->app_id], ['class' => 'btn btn-primary']);
            echo Html::a('Delete', ['delete', 'id' => $model->app_id], [
                'class' => 'btn btn-danger',
                'style' => 'margin-left: 5px;', //:D
                'data' => [
                    'confirm' => 'Are you sure?',
                    'method' => 'post'
                ]
            ]);
        ?>
    </p>

    <?php

    $links = []; // App versions

    foreach ($model->versionCollection as $appVersion) {

        $links[] = Html::a(Html::encode($appVersion->version), [
            'app-version/view', 'id' => $appVersion->app_version_id
        ]);

    }

    $links = implode($links, ', ');

    echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'app_id',
            'name',
            [
                'label' => 'Versions',
                'format' => 'raw',
                'value' => $links
            ],
            'description'
        ]
    ]); ?>

</div>
