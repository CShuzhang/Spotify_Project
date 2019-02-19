var app = angular.module('myApp', []);
app.controller('customersCtrl', function($scope, $http) {
    $http.post("../PHP/route.php/?search=AllAlbums").then(function(response) {
            $scope.myData = response.data;
    });
});