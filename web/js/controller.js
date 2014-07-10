'use strict';

var app = angular.module('App', []);

app.controller('HeaderCtrl', function HeaderCtrl($scope, $http) {

	$scope.showAddFeed = function (){
 		
		if($("#divAddFeed").css("display") == "none")
		{
			$("#btnShowAddFeed").html("Undo");
			$("#divAddFeed").show();
		}else{
			$("#btnShowAddFeed").html("Add a feed :)");
			$("#divAddFeed").hide();
		}
 		
 		
 	};
});

app.controller('AddFeedCtrl', function AddFeedCtrl($scope, $http) {

	$scope.addFeed = function(){
		$("#alert-add-success").hide();
		$("#alert-add-danger").hide();
		$("#divAddFeedUrl").removeClass("has-error");
		$("#divAddFeedCategory").removeClass("has-error");
		
		if($("#fldAddFeedUrl").val() == "")
		{
			$("#divAddFeedUrl").addClass("has-error");
			$("#alert-add-danger").html("Field 'Feed Url' is required.");
		    $("#alert-add-danger").show();
		    return false;
		}
		

		if($("#fldAddFeedCategory").val() == "0" || $("#fldAddFeedCategory").val() == "")
		{
			$("#divAddFeedCategory").addClass("has-error");
			$("#alert-add-danger").html("Select a category for this feed.");
		    $("#alert-add-danger").show();
		    return false;
		}
		
		$("#btnAddFeed").button('loading');
		$("#alert-add").show();
		$("#alert-add-success").hide();
		$("#alert-add-danger").hide();
		
		$http.post('/Service/AddFeed.php', { feed: $("#fldAddFeedUrl").val(), tagId: $("#fldAddFeedCategory").val() })
				.success(function(data, status, headers, config) {
				   if(data.response == true)
				   {
				   		$("#divSuccess").show();
				   		$("#alert-success").html(data.text);
						
						$("#btnShowAddFeed").html("Add a feed :)");
						$("#divAddFeed").hide();
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
					$("#alert-add-danger").html("Whoa, something wrong happened, please report this bug.");
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