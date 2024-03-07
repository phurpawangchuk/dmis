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


//YDF Events
var chart1 = new CanvasJS.Chart("chartContainer1", {
	theme: "light2",
	exportEnabled: false,
	animationEnabled: true,
	title: {
		text: "My contribution"
	},
	data: [{
		type: "column",
		startAngle: 25,
		toolTipContent: "<b>{label}</b>: {y}",
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
}
</script>
</head>
<body>
<div class="p-3">
<div class="row">
  <div class="col-6">
    <div id="chartContainer1" style="height: 370px; max-width: 920px; margin: 0px auto;"></div>
  </div>

  <div class="col-6">
	<div style="background:#fff; height: 370px; max-width: 920px; margin: 0px auto;">
	  <div class="p-3">
		<div class="card">
			<div class="card-header bg-warning">
				<strong>YDF Upcoming Events</strong>
			</div>
			<ul class="list-group list-group-flush">
			@foreach($events as $i=>$item)
				<li class="list-group-item">
					 <i class="nav-icon fa fa-calendar mr-3"></i>
					 {{ $item->event_name }} on {{ $item->event_date }}
				</li>
			@endforeach
			</ul>
		</div>
	  </div>
	</div>
  </div>
</div>
<div class="row m-2">
</div>
<div class="row">
   <div class="col-6">
    <div id="chartContainer2" style="height: 370px; max-width: 920px; margin: 0px auto;"></div>
  </div>

  <div class="col-6">
    <div id="chartContainer3" style="height: 370px; max-width: 920px; margin: 0px auto;"></div>
  </div>
</div>

<script src="{{ asset('js/canvasjs.min.js')}}"></script>
</div>
</body>
</html>

@endsection
