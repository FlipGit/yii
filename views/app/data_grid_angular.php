<div ng-app="myApp">
    <table ng-controller="DataGridAngular" class="table table-striped table-bordered">
        <thead>
            <tr>
                <th><a href="<?= Yii::$app->urlManager->createUrl(['app/data-grid-angular', 'sort' => $sort == 'id' ? '-id' : 'id']); ?>">ID</a></th>
                <th><a href="<?= Yii::$app->urlManager->createUrl(['app/data-grid-angular', 'sort' => $sort == 'name' ? '-name' : 'name']); ?>">Name</a></th>
                <th>Versions</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <tr ng-repeat="app in apps">
                <td>{{ app.app_id }}</td>
                <td><a href="<?= Yii::$app->urlManager->createUrl(['app/view', 'id' => '']); ?>{{ app.app_id }}">{{ app.name }}</td>
                <td>
                    <span ng-repeat="version in app.versionCollection">
                        <a href="<?= Yii::$app->urlManager->createUrl(['app-version/view', 'id' => '']); ?>{{ version.app_version_id }}">{{ version.version }}</a>{{ $last ? '' : ', ' }}
                    </span>
                </td>
                <td>
                    <a href="<?= Yii::$app->urlManager->createUrl(['app/view', 'id' => '']); ?>{{ app.app_id }}">View</a>,
                    <a href="<?= Yii::$app->urlManager->createUrl(['app/update', 'id' => '']); ?>{{ app.app_id }}">Update</a>,
                    <a href="<?= Yii::$app->urlManager->createUrl(['app/delete', 'id' => '']); ?>{{ app.app_id }}">Delete</a>
                </td>
            </tr>
        </tbody>
    </table>
</div>