<!DOCTYPE html>
<html>
<head>
	<title>Home page</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<body>
	<button id="btn">Clickme</button>
</body>
</html>

<script type="text/javascript">
	$(document).ready(function(){
		$('#btn').on('click', function(){
			//console.log("clicked");
			$.ajax({
				type: 'GET',
				url : 'http://api.timezonedb.com/v2/get-time-zone?key=JEXI0R6B5SQL&format=json&by=zone&zone=Asia/Kolkata',
				success : function(data){
					//console.log(data.formatted);
					var info= data.formatted.split(" ");
					//console.log(info[0]);
					//console.log(info[1]);
					var time=info[1].split(":");
					//console.log(time);
					var hours=parseInt(time[0]);
					var min=parseInt(time[1]);
					console.log("hours is " +hours +" min is " +min +"    "  +(hours+min));
					if(hours>=14){
						console.log("you missed deadline");
					}
					else if(hours>=0 && hours<=2) {
						console.log("predictions will start shortly");
					}
					else {
						console.log("predictions recorder");
					}
				}, 
			});
		});
	});
</script>