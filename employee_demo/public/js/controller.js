// create angular app
var employeeApp = angular.module('employeeApp', ['ngFileUpload'])
            .constant('API_URL', 'http://localhost:8000/');


// create angular controller
employeeApp.controller('mainController', function($scope, $http, API_URL) {
    
    $scope.employee = {};
    $scope.getUserData = function() {
        $http.get(API_URL + "employeedetails")
            .success(function(response) {
                    $scope.employees = response;
        });
    }
    
    // function to submit the form after all validation has occurred			
    $scope.submitForm = function() {
        $scope.errors = '';
        $scope.success = '';
            // check to make sure the form is completely valid
            if ($scope.employeeForm.$valid) {
                if ($scope.employeeForm.$valid) {
                    var formdata = new FormData();
                    formdata.append('profile_picture', $scope.employee.profile_picture);
                    formdata.append('name', $scope.employee.name);
                    formdata.append('email', $scope.employee.email);
                    formdata.append('contact_number', $scope.employee.contact_number);

                    $http({method: 'post', url: API_URL+'employeedetails', data : formdata,transformRequest: angular.identity,headers: {'Content-Type': undefined}})
                            .success(function(data) {
                                if(!data.error){
                                    $scope.success = data.success;
                                     setTimeout( function() {
                                        window.location.reload();
                                    }  , 1000 );
                                    //$scope.getUserData();
                                }else{
                                    $scope.errors = data.error;
                                }
                        });
                }
            }

    };
        
        

});
