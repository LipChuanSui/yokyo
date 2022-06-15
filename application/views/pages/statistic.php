<h1>Statistic</h1>
<label for="cars">Choose type:</label>
<select id="type_id" onchange="getType()">
  <option value="competition">Competition</option>
  <option value="class">Class</option>
</select>
<body>
	<div class="chart-container">
    <canvas id="line-chartcanvas"></canvas>
	</div>
	<!-- javascript -->
</body>
</html>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
<script>
function getType(){
  if($("#type_id").val() == "class"){
    displayChart(2, "Class");
  }else if($("#type_id").val() == "competition"){
    displayChart(1, "Compeition");
  }
}
$(document).ready(function() {
  displayChart(1, "Compeition");
});

	function displayChart(type, title) {
		$.ajax({
			url: "<?php echo base_url();?>statistic/fetch_data/" + type,
			type: "GET",
			dataType: 'json',
			success: function(data) {
				console.log(data);
				var name = [];
				var number = [];
				var len = data.length;
				for (var i = 0; i < len; i++) {
					name.push(data[i].name);
					number.push(data[i].number);
				}

				//get canvas
				var ctx = $("#line-chartcanvas");

				var data = {
					labels: name,
					datasets: [{
						label: "Sports",
						data: number,
						backgroundColor: '#49e2ff',
						borderColor: '#46d5f1',
						hoverBackgroundColor: '#CCCCCC',
						hoverBorderColor: '#666666',
					}]

				};

				var options = {
					title: {
						display: true,
						position: "top",
						text: "Total Booking Number for all " + title,
						fontSize: 18,
						fontColor: "#111"
					},
          scales: {
            yAxes: [{
              ticks: {
                beginAtZero: true
              }
            }]
          },
					legend: {
						display: true,
						position: "bottom"
					}
				};

				var chart = new Chart(ctx, {
					type: "bar",
					data: data,
					options: options
				});

			},
			error: function(data) {
				console.log(data);
			}
		});
	}
</script>
