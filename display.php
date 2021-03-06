<!DOCTYPE html>
	<head>
	<!--<script src="config_json.js"></script>-->
	</head>
	<body>
		<table border='1' align='center'>
			<tr>
				<td>
					<div id='input'>
						<label for='url'>Enter Url<label>
						<input type='text' id='url' name='url' style="width: 500px;">
						
						<button type='submit' onclick='callAjax()'>submit</button>
					</div>
				</td>
			</tr>
			
			<div id='output'>
				<tr>
					<div>
						<td>
						<span><b>Total number of open issues:  </b></span></td><td><spaN id='openIssue'>0</span></td>
					</div>
				</tr>
				<tr>
					<div>
						<td>
						<span><b>Number of open issues that were opened in the last 24 hours: </b></span></td>
						<td><span id='openIssuein24hour'>0</span></td>
					</div>
				</tr>
				<tr>
					<div>
						<td><span><b>Number of open issues that were opened more than 24 hours ago but less than 7 days ago: </b></span></td>
						<td><span id='openIssueWithinWeek'>0</span></td>
					</div>
				</tr>
				<tr>
					<div>
						<td>
						<span><b>Number of open issues that were opened more than 7 days ago: </b></span></td>
						<td><span id='openIssueMoreThanWeek'>0</span></td>
					</div>
				</tr>
			</div>
		</table>
		
		<script>
			
			
			
			/***
			*callAjax();
			*ajax call to server
			*/	
			function callAjax()
			{
				var url = document.getElementById('url').value;
				var xhttp = new XMLHttpRequest();
				 xhttp.onreadystatechange = function() {
					if (xhttp.readyState == 4 && xhttp.status == 200) {
					  //document.getElementById("demo").innerHTML = xhttp.responseText;
					  Rawdata = xhttp.responseText;
					  //console.log (Rawdata);
					  data = JSON.parse(Rawdata);
					  CalculateOpenIssue(data);
					}
				  };
				  xhttp.open("POST", "request_by_api.php", true);
				  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
				 // application/json
				//xhttp.setRequestHeader("Content-type", "application/json");
				  xhttp.send("url="+url);	
			}
			
			
			/***
			*CalculateOpenIssue - calculate open issue
			*@param 1 - data in json
			*/
			function CalculateOpenIssue(data)
			{
				var openStateCount = 0;
				var openIssueCountinOneDay = 0;
				var openIssueCountinweek = 0;
				var openIssueCountmoreThanweek = 0;
				for (temp in data) {
					for (prop in data[temp]) {
						
						//open issue count
						if (prop == 'state') {
							if (data[temp][prop] == 'open')
								openStateCount++;	
						}
						
						if (prop == 'created_at'){
							d1 = new Date(data[temp][prop]).getTime() / 1000;
							d2 = Math.round(new Date().getTime() / 1000);
							
							time = d2-d1;
							
							//open issue in a day
							if (time < 86400)
								openIssueCountinOneDay++;
							
							//open issue in a week
							if (time > 86400 && time < 604800)
								openIssueCountinweek++;
							
							//open issue more than a week
							if (time > 604800)
								openIssueCountmoreThanweek++;
							
						}
					}
				}
				
				document.getElementById("openIssue").innerHTML = openStateCount;
				document.getElementById("openIssuein24hour").innerHTML = openIssueCountinOneDay;
				document.getElementById("openIssueWithinWeek").innerHTML = openIssueCountinweek;
				document.getElementById("openIssueMoreThanWeek").innerHTML = openIssueCountmoreThanweek;
			}
			
		</script>
	</body>

</html>
