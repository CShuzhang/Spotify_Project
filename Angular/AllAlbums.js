var app = angular.module('myApp', []);
app.controller('customersCtrl', function($scope, $http) {
    $http.post("../PHP/route.php/?search=AllAlbumsR").then(function(response) {
            $scope.myData = response.data;
            console.log($scope.myData);
    });
});