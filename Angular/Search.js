var app = angular.module('myApp', []);
app.controller('customersCtrl', function($http, $scope ,$location) {
	var words = $location.absUrl().split('=');
	 $http.post("../PHP/route.php/?search=ArtistsName&value="+words[1]).then(function(response) {
            $scope.Artists = response.data;
    });

	$http.post("../PHP/route.php/?search=AlbumsName&value="+words[1]).then(function(response) {
            $scope.Albums = response.data;
    });

    $http.post("../PHP/route.php/?search=Title&value="+words[1]).then(function(response) {
            $scope.Title = response.data;
    });
});
