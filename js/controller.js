'use strict';

var app = angular.module('App', []);

app.controller('AddFeedCtrl', function AddFeedCtrl($scope, $http) {
 
	$scope.addFeed = function(){
		
		$("#btnAddFeed").button('loading');
		$("#alert-add").show();
		$("#alert-add-success").hide();
		$("#alert-add-danger").hide();

		alert($("#fldAddTag").tagsinput('items'));
		
		
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
			
				})
				.error(function(data) {
					$("#alert-add-danger").html("Eita, algo de estranho aconteceu, tente de novo.");
				    $("#alert-add-danger").show();
				    
				    $("#alert-add").hide();
					$("#btnAddFeed").button('reset');
				});
				
				
			};
	}
	
);




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