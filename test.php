<?php  
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="styleTest.css">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
	<div id="wrapper">
		<div id="header">
			MYIPL
		</div>
		<div id="container">
			<div id="leaderboard">
				<button id="leaderboardButton">LeaderBoard</button>
			</div>
			<div id="predictions">
				<button id="predictionButton">Predictions</button>
			</div>
			<div id="givepredictions">
				<div id="match1" style="display: none">
					<p><strong><b>match1</b></strong></p>
				</div>
				<div id="match2" style="display: none">
					<p><strong><b>match2</b></strong></p>
				</div>
			</div>
			<div id="expired" style="display: none">
				<p><strong><b>Sorry! you missed the deadline</b></strong></p>
			</div>
			<div id="start" style="display: none">
				<p><strong><b>Predictions will start shortly</b></strong></p>
			</div>
		</div>
	</div>
</body>
</html>

<script type="text/javascript">
	
	var userId="sudeetmhatre";
	//var userId="BAT";
	var count=0;
	var selectedTeam1=null,selectedTeam2=null;
	var predictionInfo={};
	$(document).ready(function(){

		$.ajax({
			type: 'GET',
			url: 'http://api.timezonedb.com/v2/get-time-zone?key=JEXI0R6B5SQL&format=json&by=zone&zone=Asia/Kolkata',
			success : function(data){
				var date=data.formatted.split(" ")[0];
				// console.log(date);
				//+date="2018-05-08";
				// console.log(date);
				var info= data.formatted.split(" ");
				console.log(info[0]);
				console.log(info[1]);
				var time=info[1].split(":");
				console.log(time);
				var hours=parseInt(time[0]);
				var min=parseInt(time[1]);
				console.log("hours is " +hours +" min is " +min +"    "  +(hours+min));
				if(hours>=14){
					$('#expired').css({
						"display":"block"
					});
				}
				else if(hours>=0 && hours<=2) {
					$('#start').css({
						"display":"block"
					});
				}
				else {
					$.ajax({
						type: 'GET',
						url: 'https://myipl-199419.appspot.com/player/scheduler',
						dataType: 'json',
						success : function(data){
							var schedule=data.scheduler;
							for(var i in schedule){
								var currentDate=schedule[i].date;
								var n=date.localeCompare(currentDate)
								if(n==0){
									count++;
									if(count==1){
										$('#match1').css({
											"display":"block"
										});
										team1=schedule[i].match1;
										team2=schedule[i].match2;
										team1=team1.toLowerCase();
										team2=team2.toLowerCase();
										var teamContainer1=document.getElementById("match1");
										teamContainer1.innerHTML+='<div class="team-logo"><div class="team1" id="teamOne"><a class="teamName1" data-team='+team1+' data-match="match1" href="#"><img src="teamLogo/'+team1+'.png" /></a></div><span><storng><b>VS</b></strong></span><div class="team2" id="teamTwo"><a class="teamName1"  data-team='+team2+' data-match="match1" href="#"><img src="teamLogo/'+team2+'.png" /></a></div></div><br><br>';
									}
									if(count==2){
										$('#match2').css({
											"display":"block"
										});
										team1=schedule[i].match1;
										team2=schedule[i].match2;
										team1=team1.toLowerCase();
										team2=team2.toLowerCase();
										var teamContainer2=document.getElementById("match2");
										teamContainer2.innerHTML+='<div class="team-logo"><div class="team1" id="teamOne"><a class="teamName2" data-team='+team1+' data-match="match2" href="#"><img src="teamLogo/'+team1+'.png" /></a></div><span><storng><b>VS</b></strong></span><div class="team2" id="teamTwo"><a class="teamName2" data-team='+team2+' data-match="match2" href="#`"><img src="teamLogo/'+team2+'.png" /></a></div></div><br><br>';
									}
								}
							}
						}
					});
				}
			}
		});
		
		var match1=null,match2=null;
		$.ajax({
				type:'GET',
				url:'https://myipl-199419.appspot.com/player/predictions/saurabhsingh',
				dataType:'json',
				success: function(data){
					var prediction=data.predictions;
					//console.log(prediction);
					for(var i in prediction){
						var user=prediction[i].userId;
						var n=user.localeCompare(userId);
						if(n==0){
							//console.log(prediction[i].match1 +"       "  +prediction[i].match2);
							//console.log("Number of matches is " +count);
							match1=prediction[i].match1;
							match2=prediction[i].match2;
							//console.log(userId +" match1 is " +match1 +" match2 is " +match2);
						}	
					}
				}
			});
		$(document).on("click",".teamName1",function(){
			if(match1==null){
				selectedTeam1= $(this).attr('data-team');
				//console.log(selectedTeam1);
				predictionInfo={"userid":userId,"match1":selectedTeam1,"match2":null};
				console.log(predictionInfo);
			}
			else{
				alert("Predictions already submitted");
			}
		});
		$(document).on("click",".teamName2",function(){
			if(match2==null){
				selectedTeam2= $(this).attr('data-team');
				//console.log(selectedTeam1);
				predictionInfo={"userid":userId,"match1":selectedTeam1,"match2":selectedTeam2};
				console.log(predictionInfo);
			}
			else{
				alert("Predictions already submitted");
			}
		});
		console.log("prediction object is " +predictionInfo)
	});
</script>
