<?php
// Start the session
session_start();
 $timeout = 1800; // Number of seconds until it times out.
 
// Check if the timeout field exists.
if(isset($_SESSION['timeout'])) {
    // See if the number of seconds since the last
    // visit is larger than the timeout period.
    $duration = time() - (int)$_SESSION['timeout'];
    if($duration > $timeout) {
        // Destroy the session and restart it.
        session_destroy();
        session_start();
    }
}
 
// Update the timout field with the current time.
$_SESSION['timeout'] = time();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html><head>
<meta content="text/html; charset=ISO-8859-1" http-equiv="content-type"><title>iFx Weather Preview</title>
<meta name="viewport" content="initial-scale=1.0">
<style type="text/css">
	<link title="normalize" rel="stylesheet" href="css/normalize.css" type="text/css"> 
</style>
<link title="skeleton" rel="stylesheet" href="css/skeleton.css" type="text/css">
	<link title="skeleton" rel="stylesheet" href="css/preview.css" type="text/css">
<link rel="icon" type="image/png" href="http://ifxweather.austinsatmosphere.com/images/favicon.png">
</head>
<body>
<div class="container">
<div class="twelve columns" style="font-weight: bold; text-align: center">
<p><big style="font-family: Helvetica,Arial,sans-serif;"><big><big><span><img style="width: 70px; height: 61px;" alt="" src="http://ifxweather.austinsatmosphere.com/wp-content/uploads/2015/05/logo.png"><br>iFx
Weather Preview</span></big></big></big>
Version 0.8.2 pre-alpha</p>
</div>
	<div class="twelve columns">
				<hr>
			</div>
		
	
	
	<div class="three columns">
				<p>
		<strong>Forecaster: </strong><?php echo $_SESSION["forecaster"] ?>
		</p>
			</div>
				<div class="two columns">
				<p>
		<strong>Location: </strong><?php echo $_SESSION["stationid"] . " " . $_SESSION["stationname"] ?>
		</p>
			</div>
			<div class="three columns">
				<p>
		<strong>Published: </strong><?php echo $_SESSION["date"] . " " . $_SESSION["time"] ?>
		</p>
			</div>
	<div class="three columns">
				<p>
					<strong>Valid From: </strong><?php echo $_SESSION["fxstarttime"] . " " . $_SESSION["fxstartmonth"] . "/" . $_SESSION["fxstartday"] . "/" . $_SESSION["fxstartyear"] ?>
		</p>
			</div>
			
	<div class="twelve columns">
				<hr>
			</div>
	<?php
	
	switch ($_SESSION["tempunit"]) {
	case "fahrenheit": $tempunit = "&#8457";
		break;
	case "celsius": $tempunit = "&#8451;";
	break;
	default: $tempunit = "&#8451;";
}

    if ($_SESSION["colortemp"] == "yes") {
      $tempcolor = $_SESSION["highlow"];
	  }
      else {
		  $tempcolor = "black";
	  }

	switch ($_SESSION["precipunit"]) {
		case "in.": $precipunit = "in.";
		break;
		case "mm": $precipunit = "mm";
		break;
		default: $precipunit = "in.";
	}

	switch ($_SESSION["windunit"]) {
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

switch ($_SESSION["day1wx"]) {
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
	<p><strong><big><u><?php echo $_SESSION["day1"]; ?></u></big></strong><br></p>
<img style="width: 70px; height: 70px;" alt="day1wximg" src="<?php echo $day1wximg ; ?>" >
		<?php if ($_SESSION["day1pop"] > 0) {
	echo "<p><strong>" . $_SESSION["day1desc"] . "</strong> <small>(" . $_SESSION["day1pop"] . "%)</small></p>" ;
}
	else {
		echo "<p><strong>" . $_SESSION["day1desc"] . "</strong></p>" ;
}
?>
		<strong><big><big><?php echo "<p style='color:" . $tempcolor . "'>" . $_SESSION["day1temp"] . $tempunit . " </p>" 
?>  </big></big></strong>
	
		<small><?php if ($_SESSION["day1precip"] > 0 && empty($_SESSION["showrain"])) {
	echo "<p>Rain total " . $_SESSION["day1precip"] . " " . $precipunit . "</p>" ;
}
else {
	echo "<p></p>" ;
}

?>
		<?php if ($_SESSION["day1snowmin"] > 0 && $_SESSION["day1snowmax"] > 0 && $_SESSION["day1snowmin"] < $_SESSION["day1snowmax"]){
	echo "<p>Snow accumulation " . $_SESSION["day1snowmin"] . "-" . $_SESSION["day1snowmax"] . " " . $precipunit . "</p>" ;
}
elseif ($_SESSION["day1snowmin"] == $_SESSION["day1snowmax"] && $_SESSION["day1snowmin"] > 0 && $_SESSION["day1snowmax"] > 0){
	echo "<p>Snow accumulation up to " . $_SESSION["day1snowmax"] . " " . $precipunit . "</p>" ;
} 
?>
		
		<?php if ($_SESSION["day1windmin"] != " " && $_SESSION["day1windmax"] != " " && $_SESSION["day1windmin"] != $_SESSION["day1windmax"] && $_SESSION["day1windmin"] < $_SESSION["day1windmax"] && $_SESSION["day1winddir"] != " ") {
	echo "<p>Winds " . $_SESSION["day1winddir"] . " " . $_SESSION["day1windmin"] . "-" . $_SESSION["day1windmax"] . " " . $windunit . "<br>" ;
}
elseif ($_SESSION["day1windmin"] == 0 && $_SESSION["day1windmax"] == 0 && $_SESSION["day1winddir"] == " "){
	echo "<p>Winds Calm<br>" ;
}
elseif ($_SESSION["day1winddir"] == "Calm"){
	echo "<p>Winds Calm<br>" ;
}
elseif ($_SESSION["day1winddir"] == "Variable" && $_SESSION["day1windmin"] == 0 && $_SESSION["day1windmax"] == 0){
	echo "<p>Winds Light and Variable<br>" ;
}
elseif ($_SESSION["day1windmin"] == "" && $_SESSION["day1windmax"] == ""){
	echo "<p>Winds Light and Variable<br>" ;
}
elseif ($_SESSION["day1windmin"] == $_SESSION["day1windmax"]) {
	echo "<p>Winds " . $_SESSION["day1winddir"] . " around " . $_SESSION["day1windmin"] . " " . $windunit . "<br>" ;
}
	else 
		echo "<br>" ;
			?>
		
		<?php if ($_SESSION["day1windgust"] > 0 && $_SESSION["day1windgust"] > $_SESSION["day1windmax"]){
	echo "Gusts up to " . $_SESSION["day1windgust"] . " " . $windunit . "</p>" ;
			}
				else 
		echo "</p>" ;
?></small>
<small><?php echo $_SESSION["day1detail"] . "<br>"; ?>
</small>
	<hr>
</div>
<br>
		<div class="twelve columns">
				<hr>
			</div>
	<div class="three columns">
		<form action="/iFxWx-edit.php">
			<input name="Edit" id="Edit" value="Edit" type="submit">
		</form></div>
<div class="three columns">
<form action="/publish.php">
	<input name="Publish" id="Publish" value="Publish" type="submit">
	</form></div>
</div>
	
</div>
</body></html>