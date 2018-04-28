<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<style type="text/css">
		#team1{
			width: 50%;
			height: 50%;
			background-image: url("srh.png");
		}
		#predictions {
			width: 100%;
			height: 200px;
			background-image: url("srh.png");
		}
	</style>
</head>
<body>
	<div id="leaderboard">
		<button>Leaderboard</button>
	</div>
	<div id="predictions">
		<button>Predictions</button>
	</div>
	<div id="givePredictions">
		<h3>Your Predictions</h3>
		<ul id="displayTeams">
			<li>
				<button id="team1"></button> <strong>VS</strong> <button id="team2"></button>
			</li>
		</ul>
	</div>
</body>
</html>
<script type="text/javascript">
	$(document).ready(function(){
		$.ajax({
			type: 'GET',
			url : 'http://api.timezonedb.com/v2/get-time-zone?key=JEXI0R6B5SQL&format=json&by=zone&zone=Asia/Kolkata',
			success : function(data){
				var date=data.formatted.split(" ")[0];
				console.log("Date is  " +date);
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
							console.log("current date  " +currentDate);
							team1=schedule[i].match1;
							team2=schedule[i].match2;
							console.log(team1 +" VS " +team2)
						}
					}
			},
		});
			}
		})
	});
</script>