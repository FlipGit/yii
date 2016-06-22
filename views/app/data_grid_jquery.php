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
                    echo '<a href="/app-version/view?id=' . $version->app_version_id . '">' . $version->version . '</a>';
                    if ($k + 1 < count($app->versionCollection)) {
                        echo ', ';
                    }
                }

            ?></td>
            <td><?php
                echo '<a href="/app/view?id=' . $app->app_id . '">View</a>, ';
                echo '<a href="/app/update?id=' . $app->app_id . '">Update</a>, ';
                echo '<a href="/app/delete?id=' . $app->app_id . '">Delete</a>';
            ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<script type="text/javascript">

    document.addEventListener('DOMContentLoaded', function () {

        setInterval(function () {
            $.ajax({
                dataType: 'json',
                method: 'POST',
                url: window.location.href,
                success: function (json) {
                    table = jQueryDataGrid.drawTable(json);
                    $('#app-data-grid-jquery tbody').html(table);
                }
            });
        }, 10000);


    }, false);

    var jQueryDataGrid = {

        // tbody content
        'drawTable' : function (json) {
            items = JSON.parse(json);
            result = '';

            for (i = 0; i < items.length; i++) {
                result += '<tr>' +
                    '<td>' + items[i]['app_id'] + '</td>' +
                    '<td><a href="/app/view?id=' + items[i]['app_id'] + '">' + items[i]['name'] + '</a></td>' +
                    '<td>';

                for (j = 0; j < items[i]['versionCollection'].length; j++) {
                    result += '<a href="/app-version/view?id=' + items[i]['versionCollection'][j]['app_version_id'] + '">' + items[i]['versionCollection'][j]['version'] + '</a>';
                    if (j + 1 < items[i]['versionCollection'].length) {
                        result += ', ';
                    }
                }

                result += '</td><td>' +
                    '<a href="/app/view?id=' + items[i]['app_id'] + '">View</a>, ' +
                    '<a href="/app/update?id=' + items[i]['app_id'] + '">Update</a>, ' +
                    '<a href="/app/delete?id=' + items[i]['app_id'] + '">Delete</a>';

                result += '</tr>';
            }

            return result;
        }

    };

</script>