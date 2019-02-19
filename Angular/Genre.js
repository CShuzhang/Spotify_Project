var app = angular.module('myApp', []);
app.controller('customersCtrl', function($location, $scope, $http) {
    $http.post("../PHP/route.php/?search=Genre&value="+$location.hash()).then(function(response) {
            $scope.myData = response.data;
    });
});