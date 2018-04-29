<!DOCTYPE html>
<html>
<head>
	<title>predictions</title>
	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
	<table id="leaderboardTable" class="table table-striped">
		<tr>
			<td><bold><strong>Rank</strong></bold></td>
			<td><bold><strong>Username</strong></bold></td>
			<td><strong><bold>Points</bold></strong></td>
		</tr>
	</table>

</body>
</html>
<script type="text/javascript">
	$(document).ready(function(){
		$.ajax({
			type: 'GET',
			url: "https://myipl-199419.appspot.com/player/leaderboard/saurabhsingh",
			success: function(data){
				var leaderboard=data.leaderBoardDetails;
				var table_row='';
				$.each(leaderboard, function(key, value){
					table_row += '<tr>';
					table_row += '<td>'+value.rank+'</td>';
					table_row += '<td>'+value.userId+'</td>';
					table_row += '<td>'+value.points+'</td>';
					table_row += '</tr>';
				});
				$('#leaderboardTable').append(table_row);
			}
		});
	});
</script>