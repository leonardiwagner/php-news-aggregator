'use strict';

var app = angular.module('App', []);

app.controller('AddFeedCtrl', function AddFeedCtrl($scope, $http) {
 
	$scope.addFeed = function(){
		
		$("#btnAddFeed").button('loading');
		$("#alert-add").show();
		$("#alert-add-success").hide();
		$("#alert-add-danger").hide();

		
		$http.post('/Service/Feed.php', { feed: $("#fldAddFeed").val(), tag: $("#fldAddTag").tagsinput('items') })
				.success(function(data, status, headers, config) {
				   if(data.response == true)
				   {
				   		$("#alert-add-success").html(data.text);
						$("#alert-add-success").show();
					}else{
						$("#alert-add-danger").html(data.text);
						$("#alert-add-danger").show();
					}
					
					$("#alert-add").hide();
					$("#btnAddFeed").button('reset');
					
					$("#fldAddFeed").val('');
					$("#fldAddTag").tagsinput('removeAll');
					
			
				})
				.error(function(data) {
					$("#alert-add-danger").html("Woa, something wrong happened, please report this bug.");
				    $("#alert-add-danger").show();
				    
				    $("#alert-add").hide();
					$("#btnAddFeed").button('reset');
				});
				
				
			};
	}
	
);



app.controller('TagCloudCtrl', function TagCloudCtrl($scope, $http) {
 
	$scope.tagList = null;
	
		$("#alert-add-success").hide();

		$http.post('/Service/TagCloud.php',  { cache: false } )
		.success(function(data, status, headers, config) {
		   
			$scope.tagList = data;
	
		})
		.error(function(data) {

		});

		
	
	
});


app.controller('FeedBoxCtrl', function FeedBoxCtrl($scope, $http) {
 	$scope.feedBoxList = null;
 	
 	$http.post('/Service/FeedBoxGet.php', { cache: false })
	.success(function(data, status, headers, config) {
		$scope.feedBoxList = data;
	})
	.error(function(data) {
		
	});
			
});



/*
angular.module('App.controllers', [])

	.controller('AddFeedCtrl', function ($scope, $http, $sce, $rootScope) {
	    
		$scope.addFeed = function(){
			alert('ople');
			$http.post('/REST/User/Login', { name: $("#fldAddFeed").val(), tag: $("#fldAddTag").tagsinput('items') })
				.success(function(data, status, headers, config) {
				    
				    if(data.status) {
				       alert('ok');
				    } else {
				        alert('no');
				    }
			
				})
				.error(function(data) {
				    alert('error');
				});
			};
	
	})

}

*/