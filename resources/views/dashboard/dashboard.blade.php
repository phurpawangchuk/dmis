@extends('layouts.primary', [
    'class' => '',
    'elementActive' => 'home'
])
@section('title','Dashboard')
@section('content')
<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8">

<script>
window.onload = function() {

var chart = new CanvasJS.Chart("chartContainer", {
	theme: "light2", // "light1", "light2", "dark1", "dark2"
	exportEnabled: false,
	animationEnabled: true,
	title: {
		text: "Donor Registered - Country Wise"
	},
	data: [{
		type: "pie",
		startAngle: 25,
		toolTipContent: "<b>{label}</b>: {y}",
		// showInLegend: "true",
		// legendText: "{label}",
		indexLabelFontSize: 16,
		indexLabel: "{label} - {y}",
    dataPoints: [
					 <?php for($i=0; $i<count($users); $i++){
            $country = $users[$i]->countryName;
            $number = $users[$i]->country;
					    echo "{ label: '$country',y: ".$number."},";
					}?>
					]
	}]
});
chart.render();

//Project Wise Donation Received
var chart1 = new CanvasJS.Chart("chartContainer1", {
	theme: "light2", // "light1", "light2", "dark1", "dark2"
	exportEnabled: false,
	animationEnabled: true,
	title: {
		text: "Project Wise Donation Received"
	},
	data: [{
		type: "column",
		startAngle: 25,
		toolTipContent: "<b>{label}</b>: {y}",
		// showInLegend: "true",
		indexLabelFontSize: 16,
		indexLabel: "Nu.{y}",
    dataPoints: [
					 <?php for($i=0; $i<count($projects); $i++){
            $name = $projects[$i]->name;
            $amount = $projects[$i]->amount;
					    echo "{ label: '$name',y: ".$amount."},";
					}?>
					]
	}]
});
chart1.render();

//Chart 2
var chart2 = new CanvasJS.Chart("chartContainer2", {
	theme: "light2", // "light1", "light2", "dark1", "dark2"
	exportEnabled: false,
	animationEnabled: true,
	title: {
		text: "Donors contribution"
	},
	data: [{
		type: "spline",
		startAngle: 25,
		toolTipContent: "<b>{label}</b>: {y}",
		// showInLegend: "true",
		indexLabelFontSize: 16,
		indexLabel: "Nu.{y}",
    dataPoints: [
					 <?php for($i=0; $i<count($donors); $i++){
            $name = $donors[$i]->name;
            $amount = $donors[$i]->amount;
					    echo "{ label: '$name',y: ".$amount."},";
					}?>
					]
	}]
});
chart2.render();


//Chart 3
var chart3 = new CanvasJS.Chart("chartContainer3", {
	theme: "light2", // "light1", "light2", "dark1", "dark2"
	exportEnabled: false,
	animationEnabled: true,
	title: {
		text: "Number of users"
	},
	data: [{
		type: "doughnut",
		startAngle: 25,
		toolTipContent: "<b>{label}</b>: {y}",
		// showInLegend: "true",
		indexLabelFontSize: 16,
    indexLabel: "{label}:{y}",

    dataPoints: [
					 <?php for($i=0; $i<count($userList); $i++){
            $name = $userList[$i]->role_name;
            $amount = $userList[$i]->count;
					    echo "{ label: '$name',y: ".$amount."},";
					}?>
					]
	}]
});
chart3.render();
}
</script>

</head>
<body>
<div class="p-3">
<div class="row">
  <div class="col-12">
    <div id="chartContainer" style="height: 490px; max-width: 920px; margin: -20px auto 20px auto;"></div>
  </div>

  <div class="col-12">
    <div id="chartContainer1" style="height: 490px; max-width: 920px; margin: 20px auto;"></div>
  </div>
</div>
<div class="row m-2">
</div>
<div class="row">
   <div class="col-12">
    <div id="chartContainer2" style="height: 490px; max-width: 920px; margin: 20px auto;"></div>
  </div>

  <div class="col-12">
    <div id="chartContainer3" style="height: 490px; max-width: 920px; margin: 20px auto;"></div>
  </div>
</div>

<script src="{{ asset('js/canvasjs.min.js')}}"></script>
<script src="{{asset('/js/jquery.min.js')}}"></script>

</div>
</body>
</html>

@endsection
