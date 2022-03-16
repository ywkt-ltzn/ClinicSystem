var app = angular.module("myApp",["ngRoute","ngMaterial","angularTrix"]);

app.config(function($routeProvider,$mdThemingProvider) {
     'use strict';
    
    $mdThemingProvider.theme('default')
      .primaryPalette('blue');
    $routeProvider
    .when("/", {
        templateUrl : "main.html"
    })
    .when("/register", {
        templateUrl : "register.html"
    })
    .when("/register2", {
        templateUrl : "registerstudent.html"
    })
    .when("/course", {
        templateUrl : "course.html"
    })
    .when("/content", {
        templateUrl : "content.html"
    })
    .when("/lesson", {
        templateUrl : "lesson.html"
    })
    .when("/question", {
        templateUrl : "quiz.html"
    })
    .when("/coursepreview", {
        templateUrl : "courseview.html"
    })
    .when("/courselearn", {
        templateUrl : "courselearn.html"
    })
    .when("/enroll", {
        templateUrl : "enrollment.html"
    })
    .when("/login", {
        templateUrl : "login.html"
    })
    .when("/tutorial", {
        templateUrl : "tutorial.html"
    })
    .when("/result", {
        templateUrl : "result.html"
    })
    .when("/result2", {
        templateUrl : "result2.html"
    });
    
});


app.value("mainurl","http://localhost:8000/");
app.run(function($rootScope) {
  $rootScope.typeOf = function(value) {
    return typeof value;
  };
})

.directive('stringToNumber', function() {
  return {
    require: 'ngModel',
    link: function(scope, element, attrs, ngModel) {
      ngModel.$parsers.push(function(value) {
        return '' + value;
      });
      ngModel.$formatters.push(function(value) {
        return parseFloat(value);
      });
    }
  };
});
app.run(['$rootScope', '$location', 'Auth', function ($rootScope, $location, Auth) {
    $rootScope.uname = "test_user";

    $rootScope.$on('$routeChangeStart', function (event) {
        Auth.isLoggedIn().then(function(data){
                console.log("promise data " + data);
                loggedin = data;
                console.log("promise data2 " + loggedin);
                if (!data) {
                    if ($location.path() != '/register2' && $location.path() != '/' && $location.path() != '/coursepreview'){
                        console.log('DENY');
                        console.log($location.path());
                        //event.preventDefault();
                        $location.path('/login');
                        $rootScope.uname ="Login"
                        $rootScope.linklst = [];
                        $('#linklst').hide();
                        $('#usernv').hide();
                        $('#teachernv').hide();
                    }                    
                }
                else {                    
                    console.log('ALLOW');
                    console.log(Auth.getuser());//urid
                    console.log(Auth.getuid());
                    console.log(Auth.geturid());
                    $rootScope.uname = Auth.getuser();
                    $rootScope.uid = Auth.getuid();
                    $rootScope.urid = Auth.geturid();
                    $rootScope.linklst = [{lst:'shopdropdown', name:'Shop'},
                                          {lst:'stockdropdown', name:'Stock'},
                                          {lst:'persondropdown', name:'Person'}];
                    $('#viewnv').hide();
                    if ($rootScope.urid == 4){
                        $('#usernv').show();
                    }
                    else{
                        $('#teachernv').show();
                    }
                }
            });        
    });
}]);
app.factory('Auth', function($http,$q){
var user;
var uid;
var urid;

return{
    setUser : function(aUser,auid,aurid){
        user = aUser;
        uid = auid;
        urid = aurid;
        return $http.get('sessionset.php?uname=' + aUser + '&uid=' + auid + '&urid=' + aurid).then(function(result) {       
            return result.data; 
        });
    },
    getuser : function(){
        return user;
    },
    getuid : function(){
        return uid;  
    },
    geturid : function(){
        return urid;  
    },
    logout : function(){
        return $http.get('sessiondestroy.php').then(function(result) { 
            console.log("session destroy" + result.data);
            return result.data; 
        });
    },
    isLoggedIn : function(){
        var deferred = $q.defer();
        deferred.resolve(
            $http.get('sessionset.php').then(function(result) {      
            //return result.data; 
            console.log(result.data);
            var response = result.data;
            user = response.uname;
            uid = response.uid;
            urid = response.urid;
            console.log(response.uname);
            console.log(response.uid);
            //return(response.uname)? response.uname : false;
            return(user)? true : false;
            //return false;
        }));
        //return(user)? user : false;
        return deferred.promise;
    }
  }
});

app.controller('loginCtrl', function($scope, $http, $location,Auth,mainurl) {
    console.log(mainurl);
    //$http.get("http://localhost:8000/user/login?email=admin2@mail.com&password=admin2")
    $scope.loginFunction = function() {
        
        $http({
		method : "GET",
		url : mainurl + "user/login?email="+ $scope.email +"&password=" +$scope.password 
			}).success(function(data, status, header, config) {
            $scope.myWelcome = status + data.status + '-' + data.message;
			 if (data.status == 'fail'){
					  var errmsg = document.getElementById('message');
                      errmsg.innerHTML = "<b>" + data.message + "</b>"
					  errmsg.style.display = '';
				  }
				  else{
                      console.log(data.message);
                      console.log(data.uid);
                      Auth.setUser(data.message,data.uid,data.urid);
                      if (data.urid == 4){
                          $location.path('/courselearn');
                      }
                      else{
                          $location.path('/register');
                      }
                      
					  //$window.location.href = 'main.php?uname=' + data.username;
					  //userrole = data.role;
					  //$window.location.href = 'index_chat.php?uname=' + data.username + '&' + 'urole=' + data.role;
				  }
			}).error ( function (data, status, header, config) {
			  //$scope.myStatus = status;
			  //$scope.myWelcome = 'ERROR';
            $scope.myWelcome = status + data;
		});
    }
})
.controller('logoutCtrl',function($scope, $http, $location,$window,Auth){
    $scope.logoutFunction = function() {
        console.log ('here logout');
        Auth.logout();
        $location.path('/');
        $('#viewnv').show();
        $('#usernv').hide();
        $('#teachernv').hide();
        $window.location.reload();
    }    
})
.controller('mainCtrl', function($scope, $http, $location,Auth,mainurl) {
    Auth.isLoggedIn().then(function(data){
        if(!data){
            console.log("Not login");
            $('#border').show();
        }
        else{
            $('#border').hide();
        }
    });
})
.controller('registerCtrl', function($scope, $http, $location,$window,mainurl){
    
    var divusertable = document.getElementById('usertable');
    var divuserinfo = document.getElementById('userinfo');
    var cborole = document.getElementById('role');
    $http({
		method : "GET",
		url : mainurl + "user/listuser"
			}).success(function(data, status, header, config) {
			 if (data.status == 'fail'){
					  var errmsg = document.getElementById('message');
                      errmsg.innerHTML = "<b>" + data.message + "</b>"
					  errmsg.style.display = '';
				  }
				  else{
                      $scope.userlist = data;
				  }
			}).error ( function (data, status, header, config) {
			  //$scope.myStatus = status;
			  //$scope.myWelcome = 'ERROR';
            $scope.myWelcome = status + data;
		});
    
    $scope.editUser = function(uid) {  
        divusertable.style.display='none';
		divuserinfo.style.display='';
        $scope.uid = uid; 
        $scope.rid = 0;
        if (uid != 0){
            console.log($scope.userlist.findIndex(el => el.uId === uid));
            id =$scope.userlist.findIndex(el => el.uId === uid);
            $scope.username = $scope.userlist[id].uUserName;
            $scope.name= $scope.userlist[id].uName;
            $scope.email= $scope.userlist[id].uEmail;
            $scope.phone = $scope.userlist[id].uPhone;
            $scope.rid = $scope.userlist[id].uRole;
            $("#role").val($scope.userlist[id].uRole);
            
            var dobdate = new Date($scope.userlist[id].uDOB);
		    dobdate.setDate(dobdate.getDate() - parseInt(1));
            $scope.dob =dobdate;
            
            $scope.address = $scope.userlist[id].uAddress; 
            $scope.gender = $scope.userlist[id].uGender; 
            console.log($scope.userlist[id].uRole);
        }  
        else {
            $scope.username ='';
            $scope.name= '';
            $scope.email='';
            $scope.phone = '';
        } 
    }
    
    $scope.roleselect = function(){
        $scope.rid = $scope.roleselected;
    }
    
    $scope.cancelFunction = function() {  
        divusertable.style.display='';
		divuserinfo.style.display='none';
    }
    
    $scope.regFunction = function() {
        console.log($scope.username);
        console.log($scope.name);
        console.log($scope.email);
        console.log($scope.phone);
        console.log($scope.rid);
        console.log($scope.dob);
        console.log($scope.address);
        console.log($scope.gender);
        console.log($scope.password);
        console.log($scope.uid);
        
        var dobdate = new Date($scope.dob);
		dobdate.setDate(dobdate.getDate() + parseInt(1));
        
        $http({
		  method : "Post",
		  url : mainurl + "user/register",
		  data : {"uId":$scope.uid,"uName":$scope.name,"uUserName":$scope.username,"uPhone":$scope.phone,"uEmail":$scope.email,"uAddress":$scope.address,"plainPassword":$scope.password,"uRole":$scope.rid,"uGender":$scope.gender,"uDOB":dobdate,
            "uActive":1,"uCreateuid":1,"uModifyuid":1} ,			
		  headers:{'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'}
        }).success(function(data, status, header, config) {
			if (data.status == 'success'){
				console.log(data.message); 
                $window.location.reload();
			}
			else  {
				console.log(data.message);
			}
			
			console.log(data.status);
        }).error ( function (data, status, header, config) {
			  $scope.myStatus = status;
			  $scope.myWelcome = 'ERROR';
		});
    }
    
    
    $scope.enrollFunction = function() {
        console.log($scope.username);
        console.log($scope.name);
        console.log($scope.email);
        console.log($scope.phone);
        console.log($scope.rid);
        console.log($scope.dob);
        console.log($scope.address);
        console.log($scope.gender);
        console.log($scope.password);
        console.log($scope.uid);
        
        var dobdate = new Date($scope.dob);
		dobdate.setDate(dobdate.getDate() + parseInt(1));
        
        $http({
		  method : "Post",
		  url : mainurl + "user/register",
		  data : {"uId":$scope.uid,"uName":$scope.name,"uUserName":$scope.username,"uPhone":$scope.phone,"uEmail":$scope.email,"uAddress":$scope.address,"plainPassword":$scope.password,"uRole":4,"uGender":$scope.gender,"uDOB":dobdate,
            "uActive":1,"uCreateuid":1,"uModifyuid":1} ,			
		  headers:{'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'}
        }).success(function(data, status, header, config) {
			if (data.status == 'success'){
				console.log(data.message); 
                $location.path('/courselearn');
			}
			else  {
				console.log(data.message);
			}
			
			console.log(data.status);
        }).error ( function (data, status, header, config) {
			  $scope.myStatus = status;
			  $scope.myWelcome = 'ERROR';
		});
    }
    
    $scope.enrollCancel = function() {
        $location.path('/');
    }
    
    $scope.deleteUser = function(uid,uname) {
        if (confirm("Are you sure to delete " + uname)) {
            $http({
                method : "GET",
                url : mainurl + "user/delete?id=" +uid + "&uid=" + 1
                    }).success(function(data, status, header, config) {
                        console.log("status : " + status);
                        console.log("success : " + data.status);
                        if(data.status == "success"){
                            $window.location.reload();
                        }
                        else{
                            alert(data.message);
                        }
                    }).error ( function (data, status, header, config) {
                      $scope.myStatus = status;
                      $scope.myWelcome = 'ERROR';
                });
        }
     }
    
    
})
.controller('courseCtrl', function($scope, $http, $location,$window,mainurl){
    
    var divcoursetable = document.getElementById('coursetable');
    var divcourseinfo = document.getElementById('courseinfo');
    //var cborole = document.getElementById('role');
    $http({
		method : "GET",
		url : mainurl + "course/listcourse"
			}).success(function(data, status, header, config) {
			 if (data.status == 'fail'){
					  var errmsg = document.getElementById('message');
                      errmsg.innerHTML = "<b>" + data.message + "</b>"
					  errmsg.style.display = '';
				  }
				  else{
                      $scope.courselist = data;
				  }
			}).error ( function (data, status, header, config) {
			  //$scope.myStatus = status;
			  //$scope.myWelcome = 'ERROR';
            $scope.myWelcome = status + data;
		});
    
    $http({
		method : "GET",
		url : mainurl + "user/listbyrole?urole=3"
			}).success(function(data, status, header, config) {
			 if (data.status == 'fail'){
					  var errmsg = document.getElementById('message');
                      errmsg.innerHTML = "<b>" + data.message + "</b>"
					  errmsg.style.display = '';
				  }
				  else{
                      $scope.userlist = data;
				  }
			}).error ( function (data, status, header, config) {
			  //$scope.myStatus = status;
			  //$scope.myWelcome = 'ERROR';
            $scope.myWelcome = status + data;
		});
    
    $scope.editCourse = function(couid) {  
        divcoursetable.style.display='none';
		divcourseinfo.style.display='';
        $scope.couid = couid; 
        $scope.tuid = 0;
        
        if (couid != 0){
            console.log($scope.courselist.findIndex(el => el.couId === couid));
            id =$scope.courselist.findIndex(el => el.couId === couid);
            $scope.coursename = $scope.courselist[id].couName;
            $scope.tuid = $scope.courselist[id].uId;
            $("#teacher").val($scope.courselist[id].uId);
            $scope.userselected = $scope.courselist[id].uId;
            console.log($scope.courselist[id].uId);
        }  
        else {
            $scope.coursename ='';
            $scope.userselected ='';
        } 
    }
    
    $scope.teacherselect = function(){
        $scope.tuid = $scope.userselected;
    }
    
    $scope.cancelFunction = function() {  
        divcoursetable.style.display='';
		divcourseinfo.style.display='none';
    }
    
    $scope.courseFunction = function() {
        $http({
		  method : "Post",
		  url : mainurl + "course/coursecreate",
		  data : {"couId":$scope.couid,"couName":$scope.coursename,"uId":$scope.userselected,"couCreateuid":1,"couModifyuid":1},		
		  headers:{'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'}
        }).success(function(data, status, header, config) {
			if (data.status == 'success'){
				console.log(data.message); 
                $window.location.reload();
			}
			else  {
				console.log(data.message);
			}
			
			console.log(data.status);
        }).error ( function (data, status, header, config) {
			  $scope.myStatus = status;
			  $scope.myWelcome = 'ERROR';
		});
    }
    
    $scope.deleteCourse = function(couid,couname) {
        if (confirm("Are you sure to delete " + couname)) {
            $http({
                method : "GET",
                url : mainurl + "course/coursedelete?id=" + couid + "&uid=" + 1
                    }).success(function(data, status, header, config) {
                        console.log("status : " + status);
                        console.log("success : " + data.status);
                        if(data.status == "success"){
                            $window.location.reload();
                        }
                        else{
                            alert(data.message);
                        }
                    }).error ( function (data, status, header, config) {
                      $scope.myStatus = status;
                      $scope.myWelcome = 'ERROR';
                });
        }
     }
})

.controller('contentCtrl', function($scope, $http, $location,$window,mainurl){
    
    var divlessontable = document.getElementById('lessontable');
    var divlessoninfo = document.getElementById('lessoninfo');
    
    $http({
		method : "GET",
		url : mainurl + "course/listlesson"
			}).success(function(data, status, header, config) {
			 if (data.status == 'fail'){
					  var errmsg = document.getElementById('message');
                      errmsg.innerHTML = "<b>" + data.message + "</b>"
					  errmsg.style.display = '';
				  }
				  else{
                      $scope.lessonlist = data;
				  }
			}).error ( function (data, status, header, config) {
			  //$scope.myStatus = status;
			  //$scope.myWelcome = 'ERROR';
            $scope.myWelcome = status + data;
		});
    
    $http({
		method : "GET",
		url : mainurl + "course/listcourse"
			}).success(function(data, status, header, config) {
			 if (data.status == 'fail'){
					  var errmsg = document.getElementById('message');
                      errmsg.innerHTML = "<b>" + data.message + "</b>"
					  errmsg.style.display = '';
				  }
				  else{
                      $scope.courselist = data;
				  }
			}).error ( function (data, status, header, config) {
			  //$scope.myStatus = status;
			  //$scope.myWelcome = 'ERROR';
            $scope.myWelcome = status + data;
		});
    
    $scope.editLesson = function(lid) {  
        divlessontable.style.display='none';
		divlessoninfo.style.display='';
        $scope.lid = lid; 
        $scope.couid = 0;
        
        if (lid != 0){
            console.log($scope.lessonlist.findIndex(el => el.lId === lid));
            id =$scope.lessonlist.findIndex(el => el.lId === lid);
            $scope.ltitle = $scope.lessonlist[id].lTitle;
            $scope.couid = $scope.lessonlist[id].couId;
            $("#course").val($scope.lessonlist[id].couId);
            $scope.courseselected = $scope.lessonlist[id].couId;
            console.log($scope.lessonlist[id].couId);
        }  
        else {
            $scope.ltitle ='';
            $scope.courseselected ='';
        } 
    }
    
    $scope.courseselected = function(){
        $scope.couid = $scope.courseselected;
    }
    
    $scope.cancelFunction = function() {  
        divlessontable.style.display='';
		divlessoninfo.style.display='none';
    }
    
    $scope.lessonFunction = function() {
        $http({
		  method : "Post",
		  url : mainurl + "course/lessoncreate",
		  data : {"lId":$scope.lid ,"couId":$scope.courseselected,"lTitle":$scope.ltitle,"lCreateuid":1,"lModifyuid":1},		
		  headers:{'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'}
        }).success(function(data, status, header, config) {
			if (data.status == 'success'){
				console.log(data.message); 
                $window.location.reload();
			}
			else  {
				console.log(data.message);
			}
			
			console.log(data.status);
        }).error ( function (data, status, header, config) {
			  $scope.myStatus = status;
			  $scope.myWelcome = 'ERROR';
		});
    }
    
    $scope.deleteLesson = function(lid,ltitle) {
        if (confirm("Are you sure to delete " + ltitle)) {
            $http({
                method : "GET",
                url : mainurl + "course/lessondelete?id=" + lid + "&uid=" + 1
                    }).success(function(data, status, header, config) {
                        console.log("status : " + status);
                        console.log("success : " + data.status);
                        if(data.status == "success"){
                            $window.location.reload();
                        }
                        else{
                            alert(data.message);
                        }
                    }).error ( function (data, status, header, config) {
                      $scope.myStatus = status;
                      $scope.myWelcome = 'ERROR';
                });
        }
     }
})
.controller('lessonCtrl', function($scope, $http, $location,$window,mainurl){
    var txt = document.getElementById('rtf');
    var $txt2 = $('#rtf');
        
    
    var summaryDetailsRTE = $("textarea[Title='SummaryDetails']").closest("span").find("iframe[Title='Rich Text Editor']").contents().find("body");
 
    var textContent1='<div><b>Summary</b></div>'
    				+'<div id="Summary-Instruction">Instructions:</div></br></br>'
    				+'<div><b>Additional Comments</b></div>'
    				+'<div>Instructions:</div></br></br>'; 
     txt.innerHTML=textContent1;
    console.log(txt);
    //$txt2.val ('<div style="text-align: center;">test  <b>sdfsdf</b> test</div>');
    //$txt2.append ('<div style="text-align: center;">test  <b>sdfsdf</b> test</div>') ;
    
    $http({
		method : "GET",
		url : mainurl + "course/listlesson"
			}).success(function(data, status, header, config) {
			 if (data.status == 'fail'){
					  var errmsg = document.getElementById('message');
                      errmsg.innerHTML = "<b>" + data.message + "</b>"
					  errmsg.style.display = '';
				  }
				  else{
                      $scope.lessonlist = data;
				  }
			}).error ( function (data, status, header, config) {
			  //$scope.myStatus = status;
			  //$scope.myWelcome = 'ERROR';
            $scope.myWelcome = status + data;
		});
    
    $http({
                method : "GET",
		url : mainurl + "course/listcourse"
			}).success(function(data, status, header, config) {
			 if (data.status == 'fail'){
					  var errmsg = document.getElementById('message');
                      errmsg.innerHTML = "<b>" + data.message + "</b>"
					  errmsg.style.display = '';
				  }
				  else{
                      $scope.courselist = data;
				  }
			}).error ( function (data, status, header, config) {
			  //$scope.myStatus = status;
			  //$scope.myWelcome = 'ERROR';
            $scope.myWelcome = status + data;
		});
    
    $scope.saveFunction = function(){
        var txt = document.getElementById('rtf');
        console.log("course :" + $scope.courseselected);
        console.log("content :" + $scope.lessonselected);
        console.log("title :" + $scope.ltitle);
        console.log("lesson :" + txt.value);
        console.log($('#rtf').value);
        
    }
})
.controller('trixDemoCtrl', function($scope, $timeout, $http, $location,$window,mainurl) {
    var divlessontable = document.getElementById('lessontable');
    var divlessoninfo = document.getElementById('lessoninfo');
    var divlessondetail = document.getElementById('lessondetail');
    
    $http({
		method : "GET",
		url : mainurl + "course/listcontent"
			}).success(function(data, status, header, config) {
			 if (data.status == 'fail'){
					  var errmsg = document.getElementById('message');
                      errmsg.innerHTML = "<b>" + data.message + "</b>"
					  errmsg.style.display = '';
				  }
				  else{
                      $scope.lessonlist = data;
				  }
			}).error ( function (data, status, header, config) {
			  //$scope.myStatus = status;
			  //$scope.myWelcome = 'ERROR';
            $scope.myWelcome = status + data;
		});
    
    $http({
		method : "GET",
		url : mainurl + "course/listlesson"
			}).success(function(data, status, header, config) {
			 if (data.status == 'fail'){
					  var errmsg = document.getElementById('message');
                      errmsg.innerHTML = "<b>" + data.message + "</b>"
					  errmsg.style.display = '';
				  }
				  else{
                      $scope.contentlist = data;
				  }
			}).error ( function (data, status, header, config) {
			  //$scope.myStatus = status;
			  //$scope.myWelcome = 'ERROR';
            $scope.myWelcome = status + data;
		});
	$scope.trix = '<div><!--block--><strong>Edit the lesson</strong></div>';


    var events = ['trixInitialize', 'trixChange', 'trixSelectionChange', 'trixFocus', 'trixBlur', 'trixFileAccept', 'trixAttachmentAdd', 'trixAttachmentRemove'];

    for (var i = 0; i < events.length; i++) {
        $scope[events[i]] = function(e) {
            console.info('Event type:', e.type);
        }
    };

    var createStorageKey, host, uploadAttachment;

    $scope.trixAttachmentAdd = function(e) {
        var attachment;
        attachment = e.attachment;
        if (attachment.file) {
            return uploadAttachment(attachment);
        }
    }

    host = "https://d13txem1unpe48.cloudfront.net/";

    uploadAttachment = function(attachment) {
        var file, form, key, xhr;
        file = attachment.file;
        key = createStorageKey(file);
        form = new FormData;
        form.append("key", key);
        form.append("Content-Type", file.type);
        form.append("file", file);
        xhr = new XMLHttpRequest;
        xhr.open("POST", host, true);
        xhr.upload.onprogress = function(event) {
            var progress;
            progress = event.loaded / event.total * 100;
            return attachment.setUploadProgress(progress);
        };
        xhr.onload = function() {
            var href, url;
            if (xhr.status === 204) {
                url = href = host + key;
                return attachment.setAttributes({
                    url: url,
                    href: href
                });
            }
        };
        return xhr.send(form);
    };

    createStorageKey = function(file) {
        var date, day, time;
        date = new Date();
        day = date.toISOString().slice(0, 10);
        time = date.getTime();
        return "tmp/" + day + "/" + time + "-" + file.name;
    };
    
    $scope.editLesson = function(cId){
        divlessontable.style.display ='none';
        divlessondetail.style.display = 'none';
        divlessoninfo.style.display='';
        $scope.cid = cId; 
        
        if (cId != 0){
            console.log($scope.lessonlist.findIndex(el => el.cId === cId));
            id =$scope.lessonlist.findIndex(el => el.cId === cId);
            $scope.contentselected = $scope.lessonlist[id].lId;
            $scope.ltitle = $scope.lessonlist[id].cTitle;
            $scope.trix = $scope.lessonlist[id].cNote;
        }  
        else {
        } 
    }
    
    $scope.cancelFunction = function(){
        divlessontable.style.display ='';
        divlessoninfo.style.display='none';
        divlessondetail.style.display = 'none';
    }
    
    $scope.deleteLesson = function(cId,cName){
        if (confirm("Are you sure to delete " + cName)) {
            $http({
                method : "GET",
                url : mainurl + "course/contentdelete?id=" + cId + "&uid=" + 1
                    }).success(function(data, status, header, config) {
                        console.log("status : " + status);
                        console.log("success : " + data.status);
                        if(data.status == "success"){
                            $window.location.reload();
                        }
                        else{
                            alert(data.message);
                        }
                    }).error ( function (data, status, header, config) {
                      $scope.myStatus = status;
                      $scope.myWelcome = 'ERROR';
                });
        }
    }

	$scope.saveFunction= function(){
		console.log("course :" + $scope.courseselected);
        console.log("content :" + $scope.lessonselected);
        console.log("title :" + $scope.ltitle);
		console.log("lesson ;" +$scope.trix);
        $http({
              method : "Post",
              url : mainurl + "course/contentcreate",
              data : {"cId":$scope.cid,"lId":$scope.contentselected,"cTitle":$scope.ltitle,"cNote":$scope.trix,"cImg":"image1","cVideo":"video1","cCreateuid":1,"cModifyuid":1},		
              headers:{'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'}
            }).success(function(data, status, header, config) {
                if (data.status == 'success'){
                    console.log(data.message); 
                    $window.location.reload();
                }
                else  {
                    console.log(data.message);
                }

                console.log(data.status);
            }).error ( function (data, status, header, config) {
                  $scope.myStatus = status;
                  $scope.myWelcome = 'ERROR';
            });
	}
    
    $scope.viewFunction = function(cId){
        divlessontable.style.display ='none';
        divlessondetail.style.display = '';
        divlessoninfo.style.display='none';
        $scope.cid = cId; 
        
        console.log($scope.lessonlist.findIndex(el => el.cId === cId));
            id =$scope.lessonlist.findIndex(el => el.cId === cId);
            $scope.Title = $scope.lessonlist[id].cTitle;
            //$scope.Notes = $scope.lessonlist[id].cNote;
            $('#notes').empty();
            $('#notes').append ($scope.lessonlist[id].cNote);
    }

})
.controller('quizCtrl', function($scope, $timeout, $http, $location,$window,mainurl) {
    var divquestiontable = document.getElementById('questiontable');
    var divquestioninfo = document.getElementById('questioninfo');
    var divquestionview = document.getElementById('questionview');
    
    $http({
		method : "GET",
		url : mainurl + "course/listquestion"
			}).success(function(data, status, header, config) {
			 if (data.status == 'fail'){
					  var errmsg = document.getElementById('message');
                      errmsg.innerHTML = "<b>" + data.message + "</b>"
					  errmsg.style.display = '';
				  }
				  else{
                      $scope.questionlist = data;
				  }
			}).error ( function (data, status, header, config) {
			  //$scope.myStatus = status;
			  //$scope.myWelcome = 'ERROR';
            $scope.myWelcome = status + data;
		});
    
    $http({
		method : "GET",
		url : mainurl + "course/listlesson"
			}).success(function(data, status, header, config) {
			 if (data.status == 'fail'){
					  var errmsg = document.getElementById('message');
                      errmsg.innerHTML = "<b>" + data.message + "</b>"
					  errmsg.style.display = '';
				  }
				  else{
                      $scope.contentlist = data;
				  }
			}).error ( function (data, status, header, config) {
			  //$scope.myStatus = status;
			  //$scope.myWelcome = 'ERROR';
            $scope.myWelcome = status + data;
		});
    
    $scope.editQuestion = function(qId){
        divquestiontable.style.display ='none';
        divquestionview.style.display = 'none';
        divquestioninfo.style.display='';
        $scope.qid = qId; 
        $scope.ans = 0;
        if (qId != 0){
            console.log($scope.questionlist.findIndex(el => el.qId === qId));
            id =$scope.questionlist.findIndex(el => el.qId === qId);
            $scope.contentselected = $scope.questionlist[id].lId;
            $scope.trix = $scope.questionlist[id].qQuestion;
            $scope.ans1 = $scope.questionlist[id].qOption1;
            $scope.ans2 = $scope.questionlist[id].qOption2;
            $scope.ans3 = $scope.questionlist[id].qOption3;
            $scope.ans4 = $scope.questionlist[id].qOption4;
            $scope.ans = $scope.questionlist[id].qRightNumber;
            $("#rightans").val($scope.questionlist[id].qRightNumber);
        }  
        else {
        } 
    }
    
    $scope.ansselect = function(){
        $scope.ans = $scope.rightansselected;
    }
    
    $scope.cancelFunction = function(){
        divquestiontable.style.display ='';
        divquestionview.style.display = 'none';
        divquestioninfo.style.display='none';
    }
    
    $scope.viewFunction = function(qId){
        divquestiontable.style.display ='none';
        divquestionview.style.display = '';
        divquestioninfo.style.display='none';
        $scope.qid = qId; 
        $scope.ans = 0;
        
        console.log($scope.questionlist.findIndex(el => el.qId === qId));
        id =$scope.questionlist.findIndex(el => el.qId === qId);
        $scope.Title = $scope.questionlist[id].lTitle;
        $scope.option1 = $scope.questionlist[id].qOption1;
        $scope.option2 = $scope.questionlist[id].qOption2;
        $scope.option3 = $scope.questionlist[id].qOption3;
        $scope.option4 = $scope.questionlist[id].qOption4;
        $scope.ans = $scope.questionlist[id].qRightNumber;
        console.log($('#notes'));
        $('#notes').empty();
        $('#notes').append ($scope.questionlist[id].qQuestion);
    }
    
    $scope.testfunction = function(chkbox,ans){
        console.log ('check test');
        if(chkbox){
            console.log(ans);
        }
    }
    
    $scope.deleteQuestion = function(qId){
        if (confirm("Are you sure to delete ")) {
            $http({
                method : "GET",
                url : mainurl + "course/questiondelete?id=" + qId + "&uid=" + 1
                    }).success(function(data, status, header, config) {
                        console.log("status : " + status);
                        console.log("success : " + data.status);
                        if(data.status == "success"){
                            $window.location.reload();
                        }
                        else{
                            alert(data.message);
                        }
                    }).error ( function (data, status, header, config) {
                      $scope.myStatus = status;
                      $scope.myWelcome = 'ERROR';
                });
        }
    }

	$scope.saveFunction= function(){
		console.log("course :" + $scope.courseselected);
        console.log("content :" + $scope.lessonselected);
        console.log("title :" + $scope.ltitle);
		console.log("lesson ;" +$scope.trix);
        
        $http({
              method : "Post",
              url : mainurl + "course/questioncreate",
              data : {"qId":$scope.qid,"lId":$scope.contentselected,"qQuestion":$scope.trix,"qOption1":$scope.ans1,"qOption2":$scope.ans2,"qOption3":$scope.ans3,"qOption4":$scope.ans4,"qRightNumber":$scope.ans,"qCreateuid":1,"qModifyuid":1},		
              headers:{'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'}
            }).success(function(data, status, header, config) {
                if (data.status == 'success'){
                    console.log(data.message); 
                    $window.location.reload();
                }
                else  {
                    console.log(data.message);
                }

                console.log(data.status);
            }).error ( function (data, status, header, config) {
                  $scope.myStatus = status;
                  $scope.myWelcome = 'ERROR';
            });
	}
    
	//$scope.trix = '<div><!--block--><strong>Edit the lesson</strong></div>';


    var events = ['trixInitialize', 'trixChange', 'trixSelectionChange', 'trixFocus', 'trixBlur', 'trixFileAccept', 'trixAttachmentAdd', 'trixAttachmentRemove'];

    for (var i = 0; i < events.length; i++) {
        $scope[events[i]] = function(e) {
            console.info('Event type:', e.type);
        }
    };

    var createStorageKey, host, uploadAttachment;

    $scope.trixAttachmentAdd = function(e) {
        var attachment;
        attachment = e.attachment;
        if (attachment.file) {
            return uploadAttachment(attachment);
        }
    }

    host = "https://d13txem1unpe48.cloudfront.net/";

    uploadAttachment = function(attachment) {
        var file, form, key, xhr;
        file = attachment.file;
        key = createStorageKey(file);
        form = new FormData;
        form.append("key", key);
        form.append("Content-Type", file.type);
        form.append("file", file);
        xhr = new XMLHttpRequest;
        xhr.open("POST", host, true);
        xhr.upload.onprogress = function(event) {
            var progress;
            progress = event.loaded / event.total * 100;
            return attachment.setUploadProgress(progress);
        };
        xhr.onload = function() {
            var href, url;
            if (xhr.status === 204) {
                url = href = host + key;
                return attachment.setAttributes({
                    url: url,
                    href: href
                });
            }
        };
        return xhr.send(form);
    };

    createStorageKey = function(file) {
        var date, day, time;
        date = new Date();
        day = date.toISOString().slice(0, 10);
        time = date.getTime();
        return "tmp/" + day + "/" + time + "-" + file.name;
    };
})
.filter('htmlToPlaintext', function() {
    return function(text) {
      text = text ? String(text).replace(/<[^>]+>/gm, '') : '';
      return  text ? String(text).replace(/&nbsp;/gm, '') : '';
    };
  }
)
.controller('courseviewCtrl', function($scope, $timeout, $http, $location,$window,mainurl) {
    $http({
		method : "GET",
		url : mainurl + "course/listcontent"
			}).success(function(data, status, header, config) {
			 if (data.status == 'fail'){
					  var errmsg = document.getElementById('message');
                      errmsg.innerHTML = "<b>" + data.message + "</b>"
					  errmsg.style.display = '';
				  }
				  else{
                      $scope.lessonlist = data;
                      for (var i = 0; i < $scope.lessonlist.length; i++) {
                          console.log ("here is " + $scope.lessonlist[i].cNote);
                          var cnotes = $('<div>');
                          cnotes.append($scope.lessonlist[i].cNote);
                          console.log(cnotes.innerHtml);
                      }
				  }
			}).error ( function (data, status, header, config) {
			  //$scope.myStatus = status;
			  //$scope.myWelcome = 'ERROR';
            $scope.myWelcome = status + data;
		});
})
.controller('courselearnCtrl', function($scope, $timeout, $http, $location,$window,mainurl) {
    var divlessonlst = document.getElementById('lessonlst');
    var divcontentview = document.getElementById('contentview');
    $http({
		method : "GET",
		url : mainurl + "course/listcontent2"
			}).success(function(data, status, header, config) {
			 if (data.status == 'fail'){
					  var errmsg = document.getElementById('message');
                      errmsg.innerHTML = "<b>" + data.message + "</b>"
					  errmsg.style.display = '';
				  }
				  else{
                      $scope.lessonlist = data;
//                      for (var i = 0; i < $scope.lessonlist.length; i++) {
//                          console.log ("here is " + $scope.lessonlist[i].cNote);
//                          var cnotes = $('<div>');
//                          cnotes.append($scope.lessonlist[i].cNote);
//                          console.log(cnotes.innerHtml);
//                      }
				  }
			}).error ( function (data, status, header, config) {
			  //$scope.myStatus = status;
			  //$scope.myWelcome = 'ERROR';
            $scope.myWelcome = status + data;
		});
    
    $scope.showcontent = function(cId,lId){
        divlessonlst.style.display ='none';
        divcontentview.style.display='';
        
        
        $scope.lId = lId;
        $scope.cid = cId;
        
        if (lId != 0 && cId != 0){
            console.log($scope.lessonlist);
            console.log(lId);
            console.log($scope.lessonlist.findIndex(el => el.lid === lId));
            id =$scope.lessonlist.findIndex(el => el.lid === lId);
            cid =$scope.lessonlist[id].content.findIndex(el => el.cId === cId);
            
            $scope.ltitle = $scope.lessonlist[id].ltitle;
            $scope.cTitle = $scope.lessonlist[id].content[cid].cTitle;
            $('#notes').empty();
            $('#notes').append ($scope.lessonlist[id].content[cid].cNote);
            //$scope.cNote = $scope.lessonlist[id].content[cid].cNote;
            $scope.cindex = cid;
            $scope.lindex = id;
            
            console.log($scope.cindex);
            console.log($scope.lindex);
            
            
            
        }
    }
    
    $scope.nextcontent = function(){
        divlessonlst.style.display ='none';
        divcontentview.style.display='';
        cid = $scope.cindex;
        id = $scope.lindex;
        console.log(cid+1);
        console.log($scope.lessonlist[id].content.length);
        
        if (cid+1 < $scope.lessonlist[id].content.length){
            //console.log($scope.lessonlist.findIndex(el => el.lid === id));
            //id =$scope.lessonlist.findIndex(el => el.lid === id);
            //cid =$scope.lessonlist[id].content.findIndex(el => el.cId === cid);
            //cid = cid + 1;
            //console.log($scope.lessonlist[id].content);
            $scope.ltitle = $scope.lessonlist[id].ltitle;
            $scope.cTitle = $scope.lessonlist[id].content[cid+1].cTitle;
            $('#notes').empty();
            $('#notes').append ($scope.lessonlist[id].content[cid+1].cNote);
            //$scope.cNote = $scope.lessonlist[id].content[cid+1].cNote;
            $scope.cindex = cid+1;
            $scope.lindex = id;
        }
        else{
            $window.location.reload();
        }
    }
    
    $scope.backcontent = function(){
        divlessonlst.style.display ='none';
        divcontentview.style.display='';
        cid = $scope.cindex;
        id = $scope.lindex;
        console.log(cid-1);
        console.log($scope.lessonlist[id].content.length);
        
        if (cid == 0){
            $window.location.reload();
        }
        else{
            //console.log($scope.lessonlist.findIndex(el => el.lid === id));
            //id =$scope.lessonlist.findIndex(el => el.lid === id);
            //cid =$scope.lessonlist[id].content.findIndex(el => el.cId === cid);
            //cid = cid + 1;
            //console.log($scope.lessonlist[id].content);
            $scope.ltitle = $scope.lessonlist[id].ltitle;
            $scope.cTitle = $scope.lessonlist[id].content[cid-1].cTitle;
            $('#notes').empty();
            $('#notes').append ($scope.lessonlist[id].content[cid-1].cNote);
            //$scope.cNote = $scope.lessonlist[id].content[cid+1].cNote;
            $scope.cindex = cid-1;
            $scope.lindex = id;
        }
    }
})
.controller('tutorialCtrl', function($rootScope,$scope, $timeout, $http, $location,$window,mainurl) {
    var divlessonlst = document.getElementById('lessonlst');
    var divquestionview = document.getElementById('questionview');
    $http({
		method : "GET",
		url : mainurl + "course/listquestion2?uid=" + $rootScope.uid
			}).success(function(data, status, header, config) {
			 if (data.status == 'fail'){
					  var errmsg = document.getElementById('message');
                      errmsg.innerHTML = "<b>" + data.message + "</b>"
					  errmsg.style.display = '';
				  }
				  else{
                      $scope.lessonlist = data;
//                      for (var i = 0; i < $scope.lessonlist.length; i++) {
//                          console.log ("here is " + $scope.lessonlist[i].cNote);
//                          var cnotes = $('<div>');
//                          cnotes.append($scope.lessonlist[i].cNote);
//                          console.log(cnotes.innerHtml);
//                      }
				  }
			}).error ( function (data, status, header, config) {
			  //$scope.myStatus = status;
			  //$scope.myWelcome = 'ERROR';
            $scope.myWelcome = status + data;
		});
    
    $scope.showquestion = function(lId){
        
        $scope.lId = lId;
        if (lId != 0){
            console.log($scope.lessonlist);
            console.log(lId);
            console.log($scope.lessonlist.findIndex(el => el.lid === lId));
            id =$scope.lessonlist.findIndex(el => el.lid === lId);
            //cid =$scope.lessonlist[id].content.findIndex(el => el.cId === cId);
            if ($scope.lessonlist[id].question.length != 0){
                $('#lessonlst').hide();
                $('#questionview').show();
                divlessonlst.style.display ='none';
                divquestionview.style.display='';

                $scope.ltitle = $scope.lessonlist[id].ltitle;
                //$scope.cTitle = $scope.lessonlist[id].content[cid].cTitle;
                $('#notes').empty();
                $('#notes').append ($scope.lessonlist[id].question[0].q_question);
                $scope.answer1 = $scope.lessonlist[id].question[0].q_option1;
                $scope.answer2 = $scope.lessonlist[id].question[0].q_option2;
                $scope.answer3 = $scope.lessonlist[id].question[0].q_option3;
                $scope.answer4 = $scope.lessonlist[id].question[0].q_option4;
                $scope.qid = $scope.lessonlist[id].question[0].q_id;
                $scope.aid = ($scope.lessonlist[id].question[0].a_id == null)?0:$scope.lessonlist[id].question[0].a_id;
                $scope.answer = ($scope.lessonlist[id].question[0].a_answer == null)?1:$scope.lessonlist[id].question[0].a_answer;
                $scope.qindex = 0;
                $scope.lindex = id;
            }
            else
            {   $window.location.reload();}
        }
    }
    
    $scope.nextcontent = function(){
        $http({
		  method : "Post",
		  url : mainurl + "student/answercreate",
		  data : {"aId":$scope.aid,"qId":$scope.qid,"uId":$rootScope.uid,"lId":$scope.lId,"aAnswer":$scope.answer,"aCreateuid":1,"aModifyuid":1} ,			
		  headers:{'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'}
            }).success(function(data, status, header, config) {
                if (data.status == 'success'){
                    console.log(data.message); 
                    
                    divlessonlst.style.display ='none';
                    divquestionview.style.display='';
                    qid = $scope.qindex;
                    id = $scope.lindex;

                    if (qid+1 < $scope.lessonlist[id].question.length){
                        $('#lessonlst').hide();
                        $('#questionview').show();
                        divlessonlst.style.display ='none';
                        divquestionview.style.display='';

                        $scope.ltitle = $scope.lessonlist[id].ltitle;
                        //$scope.cTitle = $scope.lessonlist[id].content[cid].cTitle;
                        $('#notes').empty();
                        $('#notes').append ($scope.lessonlist[id].question[qid+1].q_question);
                        $scope.answer1 = $scope.lessonlist[id].question[qid+1].q_option1;
                        $scope.answer2 = $scope.lessonlist[id].question[qid+1].q_option2;
                        $scope.answer3 = $scope.lessonlist[id].question[qid+1].q_option3;
                        $scope.answer4 = $scope.lessonlist[id].question[qid+1].q_option4;
                        $scope.qid = $scope.lessonlist[id].question[qid+1].q_id;
                        $scope.aid = $scope.lessonlist[id].question[qid+1].a_id;
                        $scope.aid = ($scope.lessonlist[id].question[qid+1].a_id == null)?0:$scope.lessonlist[id].question[qid+1].a_id;
                        $scope.answer = ($scope.lessonlist[id].question[qid+1].a_answer == null)?1:$scope.lessonlist[id].question[qid+1].a_answer;
                        $scope.qindex = qid+1;
                        $scope.lindex = id;
                    }
                    else{
                        $window.location.reload();
                    }
                }
                else  {
                    console.log(data.message);
                }

                console.log(data.status);
            }).error ( function (data, status, header, config) {
                  $scope.myStatus = status;
                  $scope.myWelcome = 'ERROR';
            });
        
        
    }
    
    $scope.backcontent = function(){
        divlessonlst.style.display ='none';
        divquestionview.style.display='';
        qid = $scope.qindex;
        id = $scope.lindex;
        
        if (qid == 0 ){
            $window.location.reload();
        }
        else{
            $scope.ltitle = $scope.lessonlist[id].ltitle;
            $('#notes').empty();
            $('#notes').append ($scope.lessonlist[id].question[qid-1].q_question);
            $scope.answer1 = $scope.lessonlist[id].question[qid-1].q_option1;
            $scope.answer2 = $scope.lessonlist[id].question[qid-1].q_option2;
            $scope.answer3 = $scope.lessonlist[id].question[qid-1].q_option3;
            $scope.answer4 = $scope.lessonlist[id].question[qid-1].q_option4;
            $scope.qid = $scope.lessonlist[id].question[qid-1].q_id;
            $scope.aid = $scope.lessonlist[id].question[qid-1].a_id;
            $scope.aid = ($scope.lessonlist[id].question[qid-1].a_id == null)?0:$scope.lessonlist[id].question[qid-1].a_id;
            $scope.answer = ($scope.lessonlist[id].question[qid-1].a_answer == null)?1:$scope.lessonlist[id].question[qid-1].a_answer;
            $scope.qindex = qid-1;
            $scope.lindex = id;
        }
    }
})
.controller('resultCtrl', function($rootScope,$scope, $http, $location,$window,mainurl){
    $http({
		method : "GET",
		url : mainurl + "student/studentresult?uid=" + $rootScope.uid + "&lid=0"
			}).success(function(data, status, header, config) {
			 if (data.status == 'fail'){
					  var errmsg = document.getElementById('message');
                      errmsg.innerHTML = "<b>" + data.message + "</b>"
					  errmsg.style.display = '';
				  }
				  else{
                      $scope.resultlist = data;
				  }
			}).error ( function (data, status, header, config) {
			  //$scope.myStatus = status;
			  //$scope.myWelcome = 'ERROR';
            $scope.myWelcome = status + data;
		});
    console.log("result is " + $scope.resultlist);
})
.controller('result2Ctrl', function($rootScope,$scope, $http, $location,$window,mainurl){
    $http({
		method : "GET",
		url : mainurl + "student/studentresult?uid=0&lid=0"
			}).success(function(data, status, header, config) {
			 if (data.status == 'fail'){
					  var errmsg = document.getElementById('message');
                      errmsg.innerHTML = "<b>" + data.message + "</b>"
					  errmsg.style.display = '';
				  }
				  else{
                      $scope.resultlist = data;
				  }
			}).error ( function (data, status, header, config) {
			  //$scope.myStatus = status;
			  //$scope.myWelcome = 'ERROR';
            $scope.myWelcome = status + data;
		});
    console.log("result is " + $scope.resultlist);
});