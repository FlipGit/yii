<?php

/* @var $this yii\web\View */
/* @var $appCollection app\models\App[] */
/* @var $sort string|null */

?>

<table class="table table-striped table-bordered" id="app-data-grid-jquery">
    <thead>
        <tr>
            <th><a href="<?= Yii::$app->urlManager->createUrl(['app/data-grid-jquery', 'sort' => $sort == 'id' ? '-id' : 'id']); ?>">ID</a></th>
            <th><a href="<?= Yii::$app->urlManager->createUrl(['app/data-grid-jquery', 'sort' => $sort == 'name' ? '-name' : 'name']); ?>">Name</a></th>
            <th>Versions</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($appCollection as $i => $app) : ?>
        <tr>
            <td><?= $app->app_id; ?></td>
            <td><?= $app->name; ?></td>
            <td><?php

                foreach ($app->versionCollection as $k => $version) {
                    echo '<a href="' . Yii::$app->urlManager->createUrl(['app-version/view', 'id' => $version->app_version_id]) . '">' . $version->version . '</a>';
                    if ($k + 1 < count($app->versionCollection)) {
                        echo ', ';
                    }
                }

            ?></td>
            <td><?php
                echo '<a href="' . Yii::$app->urlManager->createUrl(['app/view', 'id' => $app->app_id]) . '">View</a>, ';
                echo '<a href="' . Yii::$app->urlManager->createUrl(['app/update', 'id' => $app->app_id]) . '">Update</a>, ';
                echo '<a href="' . Yii::$app->urlManager->createUrl(['app/delete', 'id' => $app->app_id]) . '">Delete</a>';
            ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>