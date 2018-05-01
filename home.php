<?php
	session_start();
	//echo($_SESSION['login_user']);
	if(empty($_SESSION['login_user'])){
		header("location: index.php");
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<style type="text/css">
	/*	#team1{
			width: 50%;
			height: 50%;
			background-image: url("srh.png");
		}
		#predictions {
			width: 100%;
			height: 200px;
			background-image: url("srh.png");
		}*/
		body{
			min-height:100%;
			min-width:100%;
			text-align:center; 
		}
		.team1,.team2{
			display: inline-block;
			width:40%;

		}
		img{
			max-height:40vh;
			width:20vw;
		}
		#leaderboard button,#predictions button{
			border-color:#4DB6AC;
			background-color:white;
			color:#4DB6AC;
			border-radius:25px;
			height:6.5vh;
			width:20vw;
			font-family: "Comic Sans MS", cursive, sans-serif;
			font-size:2vw;
		}

		#leaderboard button:hover,#predictions button:hover{
			cursor: pointer;
			background-color: #4DB6AC;
			color:white;
		}
	</style>
</head>
<body>
	<div id="leaderboard">
		<button id="leaderboardButton">Leaderboard</button>
	</div>
	<br>
	<br>
	<div id="predictions">
		<button id="predictionButton">Predictions</button>
	</div>
	<div id="givePredictions">
		<h3>Your Predictions</h3>
		
	</div>

	<b id="logout"><a href="logout.php">Log Out</a></b>
</body>
</html>
<script type="text/javascript">
	$(document).ready(function(){
		$.ajax({
			type: 'GET',
			url : 'http://api.timezonedb.com/v2/get-time-zone?key=JEXI0R6B5SQL&format=json&by=zone&zone=Asia/Kolkata',
			success : function(data){
				var date=data.formatted.split(" ")[0];
				//console.log("Date is  " +date);
				$.ajax({
				type: 'GET',
				url : 'https://myipl-199419.appspot.com/player/scheduler',
				dataType: 'json',
				success: function(data) {
					//console.log(data.scheduler);
					var schedule=data.scheduler;
					//console.log(schedule);
					for(var i in schedule){
						//console.log(schedule[i].date);
						var currentDate=schedule[i].date;
						//console.log("curent date " +currentDate);
						var n=date.localeCompare(currentDate);
						//console.log(n)
						if(n==0){ 
							//console.log("current date  " +currentDate);
							team1=schedule[i].match1;
							team2=schedule[i].match2;
							//console.log(team1 +" VS " +team2);
							team1=team1.toLowerCase();
							team2=team2.toLowerCase();
							var teamContainer=document.getElementById("givePredictions");
							teamContainer.innerHTML+='<div class="team-logo"><div class="team1" id="teamOne"><a href="#"><img src="teamLogo/'+team1+'.png" /></a></div><span><storng><b>VS</b></strong></span><div class="team2" id="teamTwo"><a href="#"><img src="teamLogo/'+team2+'.png" /></a></div></div><br><br>';
						}
					}
			}
		});
			}
		});
		$('#teamOne').click(function(){
			console.log("clicked");
		});

	});
</script>
<script type="text/javascript">
    document.getElementById("leaderboardButton").onclick = function () {
        location.href = "leaderboard.php";
    };
</script>
<script type="text/javascript">
    document.getElementById("predictionButton").onclick = function () {
        location.href = "predictions.php";
    };
</script>