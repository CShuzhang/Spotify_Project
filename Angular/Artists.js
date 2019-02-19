var app = angular.module('myApp', []);
app.controller('customersCtrl', function($scope, $http, $location) {
	$http.post("../PHP/route.php/?search=Artist&value="+$location.hash()).then(function(response) {
            $scope.myData = response.data[0];
            $scope.albums = response.data;
    });
});