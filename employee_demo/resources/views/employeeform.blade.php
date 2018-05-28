<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Employee Form</title>   
    <link rel="stylesheet" href="{{asset('/')}}css/bootstrap.min.css">

</head>
<body>
    <div ng-app="employeeApp" ng-controller="mainController">
        <div class="container">
            <h3>Employee form</h3>
            <form class="form-horizontal" name="employeeForm" ng-submit="submitForm()" novalidate enctype="multipart/form-data">

                <div ng-if="success" class="alert alert-success">
                <ul>
                    <li>@{{success}}</li>
                </ul>
                </div>        
                <div ng-if="errors" class="alert alert-danger">
                <ul>
                    <li ng-repeat="error in errors">@{{error}}</li>
                </ul>
                </div>        

                <!-- NAME -->
                <div class="form-group">
                    <label class="control-label col-sm-2">Name* :</label>
                    <div class="col-sm-10" ng-class="{ 'has-error' : employeeForm.name.$invalid && !employeeForm.name.$pristine }">
                        <input type="text" name="name" class="col-sm-12" ng-model="employee.name" placeholder="Enter name" required>
                        <p ng-show="employeeForm.name.$invalid && !employeeForm.name.$pristine" class="help-block">Your name is required.</p>
                    </div>
                </div>      

                <!-- EMAIL -->
                <div class="form-group">
                    <label class="control-label col-sm-2">Email* :</label>
                    <div class="col-sm-10" ng-class="{ 'has-error' : employeeForm.email.$invalid && !employeeForm.email.$pristine }">
                    <input type="email" class="col-sm-12" name="email" ng-model="employee.email" placeholder="Enter email" required>
                        <p ng-show="employeeForm.email.$invalid && !employeeForm.email.$pristine" class="help-block">Email is required.</p>
                        <p ng-show="employeeForm.email.$invalid && !employeeForm.email.$pristine" class="help-block">Enter a valid email.</p>
                    </div>
                </div>


                <!-- Mobile number -->
                <div class="form-group">
                    <label class="control-label col-sm-2">Mobile Number* :</label>
                    <div class="col-sm-10" ng-class="{ 'has-error' : employeeForm.contact_number.$invalid && !employeeForm.contact_number.$pristine }">
                        <input type="text" name="contact_number" class="col-sm-12" ng-model="employee.contact_number" placeholder="Enter mobile number" ng-pattern="/^\+?\d{10}$/" required>
                        <p ng-show="employeeForm.contact_number.$invalid && !employeeForm.contact_number.$pristine" class="help-block">Please enter a 10 digit number.</p>
                    </div>
                </div>

                <!-- profile picture -->
                <div class="form-group">
                    <label class="control-label col-sm-2">Profile Picture* :</label>
                    <div class="col-sm-10" ng-class="{ 'has-error' : employeeForm.profile_picture.$invalid && !employeeForm.profile_picture.$pristine }">
                        <input type="file" ngf-select ng-model="employee.profile_picture" id="profile_picture" name="profile_picture"    
                         accept="image/*" ngf-max-size="5MB" required
                         ngf-model-invalid="errorFile" onchange="angular.element(this).scope().uploadFile(this,1)">
                        <i ng-show="employeeForm.profile_picture.$error.required" class="help-block">*required</i><br>
                        <i ng-show="employeeForm.profile_picture.$error.maxSize" class="help-block">File too large 
                            @{{errorFile.size / 1000000|number:1}}MB: max 2M</i>
                        <img height="100" width="100" ng-show="employeeForm.profile_picture.$valid" ng-model="employee.uploadedprofile_picture" ngf-thumbnail="employee.profile_picture" class="thumb"> <button ng-click="employee.profile_picture = null" ng-show="employee.profile_picture">Remove</button>
                    </div>
                <br>
                </div>
                <div class="form-group">        
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" class="btn btn-primary" ng-disabled="employeeForm.$invalid">Submit</button>
                    </div>
                </div>
            </form>
          <br>
          <br>
          <hr>
            <div class="container" ng-init="getUserData()">
                <div ng-if="employees.length>0">
                <h3>Employee details</h3>      
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>Index</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Mobile Number</th>
                      <th align="center">Profile Picture</th>
                      <th>Created at</th>
                    </tr>
                  </thead>
                  <tbody>
                      <tr ng-repeat="employee in employees">
                      <td>@{{$index+1}}</td>
                      <td>@{{employee.name}}</td>
                      <td>@{{employee.email}}</td>
                      <td>@{{employee.contact_number}}</td>
                      <td><img src="{{asset('/')}}images/uploads/@{{employee.profile_picture}}" height="50" width="50"></td>
                      <td>@{{employee.created_at}}</td>
                    </tr>      
                  </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
    <script src="{{asset('/')}}js/angular.min.js"></script>
    <script src="{{asset('/')}}js/ng-file-upload-shim.js"></script>
    <script src="{{asset('/')}}js/ng-file-upload.js"></script>
    <script src="{{asset('/')}}js/controller.js"></script>
</body>
</html>