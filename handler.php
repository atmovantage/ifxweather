<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html><head>
<meta content="text/html; charset=ISO-8859-1" http-equiv="content-type"><title>iFx Weather</title>
<meta name="viewport" content="initial-scale=1.0">
<style type="text/css"></style>
<link title="skeleton" rel="stylesheet" href="css/skeleton.css" type="text/css">
<link rel="icon" type="image/png" href="http://ifxweather.austinsatmosphere.com/images/favicon.png">
</head>
<body>
<div class="container">
<div class="twelve columns" style="font-weight: bold; text-align: center">
<p><big style="font-family: Helvetica,Arial,sans-serif;"><big><big><span><img style="width: 70px; height: 61px;" alt="" src="http://ifxweather.austinsatmosphere.com/wp-content/uploads/2015/05/logo.png"><br>iFx
Weather</span></big></big></big>
Version 0.7.0 pre-alpha</p>
</div>
	<div class="twelve columns">
				<hr>
			</div>
		
	
	
	<div class="three columns">
				<p>
		<strong>Forecaster: </strong><?php echo $_POST["forecaster"] ?>
		</p>
			</div>
				<div class="two columns">
				<p>
		<strong>Location: </strong><?php echo $_POST["stationid"] . " " . $_POST["stationname"] ?>
		</p>
			</div>
			<div class="three columns">
				<p>
		<strong>Published: </strong><?php echo $_POST["date"] . " " . $_POST["time"] ?>
		</p>
			</div>
	<div class="three columns">
				<p>
					<strong>Valid From: </strong><?php echo $_POST["fxstarttime"] . " " . $_POST["fxstartmonth"] . "/" . $_POST["fxstartday"] . "/" . $_POST["fxstartyear"] ?>
		</p>
			</div>
			
	<div class="twelve columns">
				<hr>
			</div>
	<?php
	
	switch ($_POST["tempunit"]) {
	case "fahrenheit": $tempunit = "&#8457";
		break;
	case "celsius": $tempunit = "&#8451;";
	break;
	default: $tempunit = "&#8451;";
}

    if ($_POST["colortemp"] == "yes") {
      $tempcolor = $_POST["highlow"];
	  }
      else {
		  $tempcolor = "black";
	  }

	switch ($_POST["precipunit"]) {
		case "in.": $precipunit = "in.";
		break;
		case "mm": $precipunit = "mm";
		break;
		default: $precipunit = "in.";
	}

	switch ($_POST["windunit"]) {
		case "mph": $windunit = "mph";
		break;
		case "km/h": $windunit = "km/h";
		break;
		case "m/s": $windunit = "m/s";
		break;
		case "kts": $windunit = "kts";
		break;
		default: $windunit = "mph";
	}

switch ($_POST["day1wx"]) {
case "Sunny": $day1wximg = "http://ifxweather.austinsatmosphere.com/wp-content/uploads/2015/06/sunny.png";
break;
case "Partly Sunny": $day1wximg = "http://ifxweather.austinsatmosphere.com/wp-content/uploads/2015/06/partly_cloudy_day.png";
break;
case "Mostly Cloudy": $day1wximg = "http://ifxweather.austinsatmosphere.com/wp-content/uploads/2015/06/overcast.png";
break;
case "Clear": $day1wximg = "http://ifxweather.austinsatmosphere.com/wp-content/uploads/2015/06/clear_night.png";
break;
case "Partly Cloudy": $day1wximg = "http://ifxweather.austinsatmosphere.com/wp-content/uploads/2015/06/partly_cloudy_night.png";
break;
case "Overcast": $day1wximg = "http://ifxweather.austinsatmosphere.com/wp-content/uploads/2015/06/overcast.png";
break;
case "Isolated Rain Showers": $day1wximg = "http://ifxweather.austinsatmosphere.com/wp-content/uploads/2015/06/showers_isolated.png";
break;
case "Scattered Rain Showers": $day1wximg = "http://ifxweather.austinsatmosphere.com/wp-content/uploads/2015/06/showers_scattered.png";
break;
case "Rain": $day1wximg = "http://ifxweather.austinsatmosphere.com/wp-content/uploads/2015/06/rain.png";
break;
case "Heavy Rain": $day1wximg = "http://ifxweather.austinsatmosphere.com/wp-content/uploads/2015/06/rain_heavy.png";
break;
case "Rain and Fog": $day1wximg = "http://ifxweather.austinsatmosphere.com/wp-content/uploads/2015/06/showers_haze.png";
break;
case "Isolated T-Storms": $day1wximg = "http://ifxweather.austinsatmosphere.com/wp-content/uploads/2015/06/tstorms_isolated.png";
break;
case "Scattered T-Storms": $day1wximg = "http://ifxweather.austinsatmosphere.com/wp-content/uploads/2015/06/tstorms_scattered.png";
break;
case "Thunderstorms": $day1wximg = "http://ifxweather.austinsatmosphere.com/wp-content/uploads/2015/06/tstorms_rain.png";
break;
case "Severe T-Storms": $day1wximg = "http://ifxweather.austinsatmosphere.com/wp-content/uploads/2015/06/tstorms_severe.png";
break;
case "Snow Flurries": $day1wximg = "http://ifxweather.austinsatmosphere.com/wp-content/uploads/2015/06/snow_flurries.png";
break;
case "Scattered Snow Showers": $day1wximg = "http://ifxweather.austinsatmosphere.com/wp-content/uploads/2015/06/snow_scattered.png";
break;
case "Snow": $day1wximg = "http://ifxweather.austinsatmosphere.com/wp-content/uploads/2015/06/snow.png";
break;
case "Heavy Snow": $day1wximg = "http://ifxweather.austinsatmosphere.com/wp-content/uploads/2015/06/snow_heavy.png";
break;
case "Blizzard": $day1wximg = "http://ifxweather.austinsatmosphere.com/wp-content/uploads/2015/06/snow_blizzard.png";
break;
case "Blowing Snow": $day1wximg = "http://ifxweather.austinsatmosphere.com/wp-content/uploads/2015/06/blowing_snow.png";
break;
case "Rain/Snow": $day1wximg = "http://ifxweather.austinsatmosphere.com/wp-content/uploads/2015/06/rain_snow.png";
break;
case "Freezing Rain/Snow": $day1wximg = "http://ifxweather.austinsatmosphere.com/wp-content/uploads/2015/06/freezing_rain_snow.png";
break;
case "Freezing Rain/Rain": $day1wximg = "http://ifxweather.austinsatmosphere.com/wp-content/uploads/2015/06/freezing_rain.png";
break;
case "Freezing Rain/Sleet": $day1wximg = "http://ifxweather.austinsatmosphere.com/wp-content/uploads/2015/06/freezing_rain_sleet.png";
break;
case "Rain/Sleet": $day1wximg = "http://ifxweather.austinsatmosphere.com/wp-content/uploads/2015/06/rain_sleet.png";
break;
case "Sleet": $day1wximg = "http://ifxweather.austinsatmosphere.com/wp-content/uploads/2015/06/sleet.png";
break;
case "Overcast/Haze": $day1wximg = "http://ifxweather.austinsatmosphere.com/wp-content/uploads/2015/06/overcast_haze.png";
break;
case "Haze": $day1wximg = "http://ifxweather.austinsatmosphere.com/wp-content/uploads/2015/06/haze_day_night.png";
break;
case "Sunny/Fog": $day1wximg = "http://ifxweather.austinsatmosphere.com/wp-content/uploads/2015/06/fog_day.png";
break;
case "Morning Fog": $day1wximg = "http://ifxweather.austinsatmosphere.com/wp-content/uploads/2015/06/fog_morning.png";
break;
case "Overnight Fog": $day1wximg = "http://ifxweather.austinsatmosphere.com/wp-content/uploads/2015/06/fog_night.png";
break;
case "Cloudy/Fog": $day1wximg = "http://ifxweather.austinsatmosphere.com/wp-content/uploads/2015/06/fog_overcast.png";
break;
case "Dense Fog": $day1wximg = "http://ifxweather.austinsatmosphere.com/wp-content/uploads/2015/06/fog_dense.png";
break;
case "Windy": $day1wximg = "http://ifxweather.austinsatmosphere.com/wp-content/uploads/2015/06/windy.png";
break;
case "Lunar Eclipse": $day1wximg = "http://ifxweather.austinsatmosphere.com/wp-content/uploads/2015/06/lunar_eclipse.png";
break;
case "Solar Eclipse": $day1wximg = "http://ifxweather.austinsatmosphere.com/wp-content/uploads/2015/06/solar_eclipse.png";
break;
default: $day1wximg = "http://ifxweather.austinsatmosphere.com/wp-content/uploads/2015/06/fog_dense.png";
}
?>
<div style="text-align: center;" class="two columns">
	<p><strong><big><u><?php echo $_POST["day1"]; ?></u></big></strong><br></p>
<img style="width: 70px; height: 70px;" alt="day1wximg" src="<?php echo $day1wximg ; ?>" >
		<?php if ($_POST["day1pop"] > 0) {
	echo "<p><strong>" . $_POST["day1desc"] . "</strong> <small>(" . $_POST["day1pop"] . "%)</small></p>" ;
}
	else {
		echo "<p><strong>" . $_POST["day1desc"] . "</strong></p>" ;
}
?>
		<strong><big><big><?php echo "<p style='color:" . $tempcolor . "'>" . $_POST["day1temp"] . $tempunit . " </p>" 
?>  </big></big></strong>
	
		<small><?php if ($_POST["day1precip"] > 0 && empty($_POST["showrain"])) {
	echo "<p>Rain total " . $_POST["day1precip"] . " " . $precipunit . "</p>" ;
}
else {
	echo "<p></p>" ;
}

?>
		<?php if ($_POST["day1snowmin"] > 0 && $_POST["day1snowmax"] > 0 && $_POST["day1snowmin"] < $_POST["day1snowmax"]){
	echo "<p>Snow accumulation " . $_POST["day1snowmin"] . "-" . $_POST["day1snowmax"] . " " . $precipunit . "</p>" ;
}
elseif ($_POST["day1snowmin"] == $_POST["day1snowmax"] && $_POST["day1snowmin"] > 0 && $_POST["day1snowmax"] > 0){
	echo "<p>Snow accumulation up to " . $_POST["day1snowmax"] . " " . $precipunit . "</p>" ;
} 
?>
		
		<?php if ($_POST["day1windmin"] != " " && $_POST["day1windmax"] != " " && $_POST["day1windmin"] != $_POST["day1windmax"] && $_POST["day1windmin"] < $_POST["day1windmax"] && $_POST["day1winddir"] != " ") {
	echo "<p>Winds " . $_POST["day1winddir"] . " " . $_POST["day1windmin"] . "-" . $_POST["day1windmax"] . " " . $windunit . "<br>" ;
}
elseif ($_POST["day1windmin"] == 0 && $_POST["day1windmax"] == 0 && $_POST["day1winddir"] == " "){
	echo "<p>Winds Calm<br>" ;
}
elseif ($_POST["day1winddir"] == "Calm"){
	echo "<p>Winds Calm<br>" ;
}
elseif ($_POST["day1winddir"] == "Variable" && $_POST["day1windmin"] == 0 && $_POST["day1windmax"] == 0){
	echo "<p>Winds Light and Variable<br>" ;
}
elseif ($_POST["day1windmin"] == "" && $_POST["day1windmax"] == ""){
	echo "<p>Winds Light and Variable<br>" ;
}
elseif ($_POST["day1windmin"] == $_POST["day1windmax"]) {
	echo "<p>Winds " . $_POST["day1winddir"] . " around " . $_POST["day1windmin"] . " " . $windunit . "<br>" ;
}
	else 
		echo "<br>" ;
			?>
		
		<?php if ($_POST["day1windgust"] > 0 && $_POST["day1windgust"] > $_POST["day1windmax"]){
	echo "Gusts up to " . $_POST["day1windgust"] . " " . $windunit . "</p>" ;
			}
				else 
		echo "</p>" ;
?></small>
<small><?php echo $_POST["day1detail"] . "<br>"; ?>
</small>
	<hr>
</div>
<br>
		<div class="twelve columns">
				<hr>
			</div>
	<div class="three columns">
		<button onclick="goBack()">Make Changes</button></div>
<div class="three columns">
<form action="<?php echo "/iFxWx.php"; ?>"><input value="Reset Forecast Composer" type="submit"></form></div>
</div>
<script>
function goBack() {
    window.history.back();
}
</script>
</div>
</body></html>