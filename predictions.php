<!DOCTYPE html>
<html>
<head>
	<title>predictions</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<body>
	<table id="predictionTable">
		<tr>
			<thead>Player</thead>
			<thead>Match1</thead>
			<thead>Match2</thead>
		</tr>
	</table>

</body>
</html>
<script type="text/javascript">
	$(document).ready(function(){
		$.ajax({
			type: 'GET',
			url: "https://myipl-199419.appspot.com/player/predictions/saurabhsingh",
			success: function(data){
				var predictions=data.predictions;
				var table_row='';
				console.log(predictions);
				$.each(predictions, function(key, value){
					table_row += '<tr>';
					table_row += '<td>'+value.userId+'</td>';
					table_row += '<td>'+value.match1+'</td>';
					table_row += '<td>'+value.match2+'</td>';
					table_row += '</tr>';
				});
				$('#predictionTable').append(table_row);
			}
		});
	});
</script>