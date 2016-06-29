// begin angular
var module = angular.module('myApp', []);

module.run(function run($http){
    $http.defaults.headers.post['X-CSRF-Token'] = yii.getCsrfToken();
});

module.controller('DataGridAngular', function ($scope, $http, $interval) {
    var tick = function () {
        $http({
            method: 'POST',
            url: window.location.href,
            contentType: 'application/json'
        }).then(function (response) {
            $scope.apps = response.data;
        }, function (response) {
            console.log(response);
        })
    };
    tick();
    $interval(tick, 10000);
});
// end angular

// begin jQuery
if ((target = $('#app-data-grid-jquery tbody')).length) {
    setInterval(function () {
        $.ajax({
            dataType: 'json',
            method: 'POST',
            url: window.location.href,
            success: function (json) {
                target.html(jQueryDataGrid.drawTable(json));
            }
        });
    }, 10000);
}

var jQueryDataGrid = {

    drawTable : function (json) {
        var items = JSON.parse(json);
        var result = '';

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
// end jQuery