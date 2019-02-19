var app = angular.module('myApp', []);
app.controller('customersCtrl', function($scope, $http, $location) {
	$http.post("../PHP/route.php/?search=Album&value="+$location.hash()).then(function(response) {
            $scope.myData = response.data;
            $scope.only = response.data[0];
    });
});
