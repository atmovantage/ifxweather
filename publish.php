<?php

// Start the session
session_start();
 $timeout = 1800; // Number of seconds until it times out.
 $version = "1.3.1 Alpha";

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
 
// Update the timeout field with the current time.
$_SESSION['timeout'] = time();

//access WordPress required files
require('../../../wp-blog-header.php');

//Begin importing user-entered session data
switch ($_SESSION["tempunit"]) {
	case "fahrenheit": $tempunit = "&#8457";
		break;
	case "celsius": $tempunit = "&#8451;";
	break;
	default: $tempunit = "&#8451;";
}

   if ($_SESSION["colortemp"] == "yes") {
		if ($_SESSION["col1highlow"] == "red") {
      $tempcolor = "red";
	  $tempcolor2 = "blue";
	  }
      else if ($_SESSION["col1highlow"] == "blue") {
		  $tempcolor = "blue";
		  $tempcolor2 = "red";
	  }
   }
	else {
		$tempcolor = "black";
		  $tempcolor2 = "black";
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
// Column 1 Weather Icon
switch ($_SESSION["col1wx"]) {
case "Sunny": $col1wximg = "ifxwx_images/sunny.png";
break;
case "Partly Sunny": $col1wximg = "ifxwx_images/partly_cloudy_day.png";
break;
case "Mostly Cloudy": $col1wximg = "ifxwx_images/overcast.png";
break;
case "Clear": $col1wximg = "ifxwx_images/clear_night.png";
break;
case "Partly Cloudy": $col1wximg = "ifxwx_images/partly_cloudy_night.png";
break;
case "Overcast": $col1wximg = "ifxwx_images/overcast.png";
break;
case "Isolated Rain Showers": $col1wximg = "ifxwx_images/showers_isolated.png";
break;
case "Scattered Rain Showers": $col1wximg = "ifxwx_images/showers_scattered.png";
break;
case "Rain": $col1wximg = "ifxwx_images/rain.png";
break;
case "Heavy Rain": $col1wximg = "ifxwx_images/rain_heavy.png";
break;
case "Rain and Fog": $col1wximg = "ifxwx_images/showers_haze.png";
break;
case "Isolated T-Storms": $col1wximg = "ifxwx_images/tstorms_isolated.png";
break;
case "Scattered T-Storms": $col1wximg = "ifxwx_images/tstorms_scattered.png";
break;
case "Thunderstorms": $col1wximg = "ifxwx_images/tstorms_rain.png";
break;
case "Severe T-Storms": $col1wximg = "ifxwx_images/tstorms_severe.png";
break;
case "Snow Flurries": $col1wximg = "ifxwx_images/snow_flurries.png";
break;
case "Scattered Snow Showers": $col1wximg = "ifxwx_images/snow_scattered.png";
break;
case "Snow": $col1wximg = "ifxwx_images/snow.png";
break;
case "Heavy Snow": $col1wximg = "ifxwx_images/snow_heavy.png";
break;
case "Blizzard": $col1wximg = "ifxwx_images/snow_blizzard.png";
break;
case "Blowing Snow": $col1wximg = "ifxwx_images/blowing_snow.png";
break;
case "Rain/Snow": $col1wximg = "ifxwx_images/rain_snow.png";
break;
case "Freezing Rain/Snow": $col1wximg = "ifxwx_images/freezing_rain_snow.png";
break;
case "Freezing Rain/Rain": $col1wximg = "ifxwx_images/freezing_rain.png";
break;
case "Freezing Rain/Sleet": $col1wximg = "ifxwx_images/freezing_rain_sleet.png";
break;
case "Rain/Sleet": $col1wximg = "ifxwx_images/rain_sleet.png";
break;
case "Sleet": $col1wximg = "ifxwx_images/sleet.png";
break;
case "Overcast/Haze": $col1wximg = "ifxwx_images/overcast_haze.png";
break;
case "Haze": $col1wximg = "ifxwx_images/haze_day_night.png";
break;
case "Sunny/Fog": $col1wximg = "ifxwx_images/fog_day.png";
break;
case "Morning Fog": $col1wximg = "ifxwx_images/fog_morning.png";
break;
case "Overnight Fog": $col1wximg = "ifxwx_images/fog_night.png";
break;
case "Cloudy/Fog": $col1wximg = "ifxwx_images/fog_overcast.png";
break;
case "Dense Fog": $col1wximg = "ifxwx_images/fog_dense.png";
break;
case "Windy": $col1wximg = "ifxwx_images/windy.png";
break;
case "Lunar Eclipse": $col1wximg = "ifxwx_images/lunar_eclipse.png";
break;
case "Solar Eclipse": $col1wximg = "ifxwx_images/solar_eclipse.png";
break;
default: $col1wximg = "ifxwx_images/fog_dense.png";
}
// Column 2 Weather Icon
switch ($_SESSION["col2wx"]) {
case "Sunny": $col2wximg = "ifxwx_images/sunny.png";
break;
case "Partly Sunny": $col2wximg = "ifxwx_images/partly_cloudy_day.png";
break;
case "Mostly Cloudy": $col2wximg = "ifxwx_images/overcast.png";
break;
case "Clear": $col2wximg = "ifxwx_images/clear_night.png";
break;
case "Partly Cloudy": $col2wximg = "ifxwx_images/partly_cloudy_night.png";
break;
case "Overcast": $col2wximg = "ifxwx_images/overcast.png";
break;
case "Isolated Rain Showers": $col2wximg = "ifxwx_images/showers_isolated.png";
break;
case "Scattered Rain Showers": $col2wximg = "ifxwx_images/showers_scattered.png";
break;
case "Rain": $col2wximg = "ifxwx_images/rain.png";
break;
case "Heavy Rain": $col2wximg = "ifxwx_images/rain_heavy.png";
break;
case "Rain and Fog": $col2wximg = "ifxwx_images/showers_haze.png";
break;
case "Isolated T-Storms": $col2wximg = "ifxwx_images/tstorms_isolated.png";
break;
case "Scattered T-Storms": $col2wximg = "ifxwx_images/tstorms_scattered.png";
break;
case "Thunderstorms": $col2wximg = "ifxwx_images/tstorms_rain.png";
break;
case "Severe T-Storms": $col2wximg = "ifxwx_images/tstorms_severe.png";
break;
case "Snow Flurries": $col2wximg = "ifxwx_images/snow_flurries.png";
break;
case "Scattered Snow Showers": $col2wximg = "ifxwx_images/snow_scattered.png";
break;
case "Snow": $col2wximg = "ifxwx_images/snow.png";
break;
case "Heavy Snow": $col2wximg = "ifxwx_images/snow_heavy.png";
break;
case "Blizzard": $col2wximg = "ifxwx_images/snow_blizzard.png";
break;
case "Blowing Snow": $col2wximg = "ifxwx_images/blowing_snow.png";
break;
case "Rain/Snow": $col2wximg = "ifxwx_images/rain_snow.png";
break;
case "Freezing Rain/Snow": $col2wximg = "ifxwx_images/freezing_rain_snow.png";
break;
case "Freezing Rain/Rain": $col2wximg = "ifxwx_images/freezing_rain.png";
break;
case "Freezing Rain/Sleet": $col2wximg = "ifxwx_images/freezing_rain_sleet.png";
break;
case "Rain/Sleet": $col2wximg = "ifxwx_images/rain_sleet.png";
break;
case "Sleet": $col2wximg = "ifxwx_images/sleet.png";
break;
case "Overcast/Haze": $col2wximg = "ifxwx_images/overcast_haze.png";
break;
case "Haze": $col2wximg = "ifxwx_images/haze_day_night.png";
break;
case "Sunny/Fog": $col2wximg = "ifxwx_images/fog_day.png";
break;
case "Morning Fog": $col2wximg = "ifxwx_images/fog_morning.png";
break;
case "Overnight Fog": $col2wximg = "ifxwx_images/fog_night.png";
break;
case "Cloudy/Fog": $col2wximg = "ifxwx_images/fog_overcast.png";
break;
case "Dense Fog": $col2wximg = "ifxwx_images/fog_dense.png";
break;
case "Windy": $col2wximg = "ifxwx_images/windy.png";
break;
case "Lunar Eclipse": $col2wximg = "ifxwx_images/lunar_eclipse.png";
break;
case "Solar Eclipse": $col2wximg = "ifxwx_images/solar_eclipse.png";
break;
default: $col2wximg = "ifxwx_images/fog_dense.png";
}
// Column 3 Weather Icon
switch ($_SESSION["col3wx"]) {
case "Sunny": $col3wximg = "ifxwx_images/sunny.png";
break;
case "Partly Sunny": $col3wximg = "ifxwx_images/partly_cloudy_day.png";
break;
case "Mostly Cloudy": $col3wximg = "ifxwx_images/overcast.png";
break;
case "Clear": $col3wximg = "ifxwx_images/clear_night.png";
break;
case "Partly Cloudy": $col3wximg = "ifxwx_images/partly_cloudy_night.png";
break;
case "Overcast": $col3wximg = "ifxwx_images/overcast.png";
break;
case "Isolated Rain Showers": $col3wximg = "ifxwx_images/showers_isolated.png";
break;
case "Scattered Rain Showers": $col3wximg = "ifxwx_images/showers_scattered.png";
break;
case "Rain": $col3wximg = "ifxwx_images/rain.png";
break;
case "Heavy Rain": $col3wximg = "ifxwx_images/rain_heavy.png";
break;
case "Rain and Fog": $col3wximg = "ifxwx_images/showers_haze.png";
break;
case "Isolated T-Storms": $col3wximg = "ifxwx_images/tstorms_isolated.png";
break;
case "Scattered T-Storms": $col3wximg = "ifxwx_images/tstorms_scattered.png";
break;
case "Thunderstorms": $col3wximg = "ifxwx_images/tstorms_rain.png";
break;
case "Severe T-Storms": $col3wximg = "ifxwx_images/tstorms_severe.png";
break;
case "Snow Flurries": $col3wximg = "ifxwx_images/snow_flurries.png";
break;
case "Scattered Snow Showers": $col3wximg = "ifxwx_images/snow_scattered.png";
break;
case "Snow": $col3wximg = "ifxwx_images/snow.png";
break;
case "Heavy Snow": $col3wximg = "ifxwx_images/snow_heavy.png";
break;
case "Blizzard": $col3wximg = "ifxwx_images/snow_blizzard.png";
break;
case "Blowing Snow": $col3wximg = "ifxwx_images/blowing_snow.png";
break;
case "Rain/Snow": $col3wximg = "ifxwx_images/rain_snow.png";
break;
case "Freezing Rain/Snow": $col3wximg = "ifxwx_images/freezing_rain_snow.png";
break;
case "Freezing Rain/Rain": $col3wximg = "ifxwx_images/freezing_rain.png";
break;
case "Freezing Rain/Sleet": $col3wximg = "ifxwx_images/freezing_rain_sleet.png";
break;
case "Rain/Sleet": $col3wximg = "ifxwx_images/rain_sleet.png";
break;
case "Sleet": $col3wximg = "ifxwx_images/sleet.png";
break;
case "Overcast/Haze": $col3wximg = "ifxwx_images/overcast_haze.png";
break;
case "Haze": $col3wximg = "ifxwx_images/haze_day_night.png";
break;
case "Sunny/Fog": $col3wximg = "ifxwx_images/fog_day.png";
break;
case "Morning Fog": $col3wximg = "ifxwx_images/fog_morning.png";
break;
case "Overnight Fog": $col3wximg = "ifxwx_images/fog_night.png";
break;
case "Cloudy/Fog": $col3wximg = "ifxwx_images/fog_overcast.png";
break;
case "Dense Fog": $col3wximg = "ifxwx_images/fog_dense.png";
break;
case "Windy": $col3wximg = "ifxwx_images/windy.png";
break;
case "Lunar Eclipse": $col3wximg = "ifxwx_images/lunar_eclipse.png";
break;
case "Solar Eclipse": $col3wximg = "ifxwx_images/solar_eclipse.png";
break;
default: $col3wximg = "ifxwx_images/fog_dense.png";
}
// Column 4 Weather Icon
switch ($_SESSION["col4wx"]) {
case "Sunny": $col4wximg = "ifxwx_images/sunny.png";
break;
case "Partly Sunny": $col4wximg = "ifxwx_images/partly_cloudy_day.png";
break;
case "Mostly Cloudy": $col4wximg = "ifxwx_images/overcast.png";
break;
case "Clear": $col4wximg = "ifxwx_images/clear_night.png";
break;
case "Partly Cloudy": $col4wximg = "ifxwx_images/partly_cloudy_night.png";
break;
case "Overcast": $col4wximg = "ifxwx_images/overcast.png";
break;
case "Isolated Rain Showers": $col4wximg = "ifxwx_images/showers_isolated.png";
break;
case "Scattered Rain Showers": $col4wximg = "ifxwx_images/showers_scattered.png";
break;
case "Rain": $col4wximg = "ifxwx_images/rain.png";
break;
case "Heavy Rain": $col4wximg = "ifxwx_images/rain_heavy.png";
break;
case "Rain and Fog": $col4wximg = "ifxwx_images/showers_haze.png";
break;
case "Isolated T-Storms": $col4wximg = "ifxwx_images/tstorms_isolated.png";
break;
case "Scattered T-Storms": $col4wximg = "ifxwx_images/tstorms_scattered.png";
break;
case "Thunderstorms": $col4wximg = "ifxwx_images/tstorms_rain.png";
break;
case "Severe T-Storms": $col4wximg = "ifxwx_images/tstorms_severe.png";
break;
case "Snow Flurries": $col4wximg = "ifxwx_images/snow_flurries.png";
break;
case "Scattered Snow Showers": $col4wximg = "ifxwx_images/snow_scattered.png";
break;
case "Snow": $col4wximg = "ifxwx_images/snow.png";
break;
case "Heavy Snow": $col4wximg = "ifxwx_images/snow_heavy.png";
break;
case "Blizzard": $col4wximg = "ifxwx_images/snow_blizzard.png";
break;
case "Blowing Snow": $col4wximg = "ifxwx_images/blowing_snow.png";
break;
case "Rain/Snow": $col4wximg = "ifxwx_images/rain_snow.png";
break;
case "Freezing Rain/Snow": $col4wximg = "ifxwx_images/freezing_rain_snow.png";
break;
case "Freezing Rain/Rain": $col4wximg = "ifxwx_images/freezing_rain.png";
break;
case "Freezing Rain/Sleet": $col4wximg = "ifxwx_images/freezing_rain_sleet.png";
break;
case "Rain/Sleet": $col4wximg = "ifxwx_images/rain_sleet.png";
break;
case "Sleet": $col4wximg = "ifxwx_images/sleet.png";
break;
case "Overcast/Haze": $col4wximg = "ifxwx_images/overcast_haze.png";
break;
case "Haze": $col4wximg = "ifxwx_images/haze_day_night.png";
break;
case "Sunny/Fog": $col4wximg = "ifxwx_images/fog_day.png";
break;
case "Morning Fog": $col4wximg = "ifxwx_images/fog_morning.png";
break;
case "Overnight Fog": $col4wximg = "ifxwx_images/fog_night.png";
break;
case "Cloudy/Fog": $col4wximg = "ifxwx_images/fog_overcast.png";
break;
case "Dense Fog": $col4wximg = "ifxwx_images/fog_dense.png";
break;
case "Windy": $col4wximg = "ifxwx_images/windy.png";
break;
case "Lunar Eclipse": $col4wximg = "ifxwx_images/lunar_eclipse.png";
break;
case "Solar Eclipse": $col4wximg = "ifxwx_images/solar_eclipse.png";
break;
default: $col4wximg = "ifxwx_images/fog_dense.png";
}
// Column 5 Weather Icon
switch ($_SESSION["col5wx"]) {
case "Sunny": $col5wximg = "ifxwx_images/sunny.png";
break;
case "Partly Sunny": $col5wximg = "ifxwx_images/partly_cloudy_day.png";
break;
case "Mostly Cloudy": $col5wximg = "ifxwx_images/overcast.png";
break;
case "Clear": $col5wximg = "ifxwx_images/clear_night.png";
break;
case "Partly Cloudy": $col5wximg = "ifxwx_images/partly_cloudy_night.png";
break;
case "Overcast": $col5wximg = "ifxwx_images/overcast.png";
break;
case "Isolated Rain Showers": $col5wximg = "ifxwx_images/showers_isolated.png";
break;
case "Scattered Rain Showers": $col5wximg = "ifxwx_images/showers_scattered.png";
break;
case "Rain": $col5wximg = "ifxwx_images/rain.png";
break;
case "Heavy Rain": $col5wximg = "ifxwx_images/rain_heavy.png";
break;
case "Rain and Fog": $col5wximg = "ifxwx_images/showers_haze.png";
break;
case "Isolated T-Storms": $col5wximg = "ifxwx_images/tstorms_isolated.png";
break;
case "Scattered T-Storms": $col5wximg = "ifxwx_images/tstorms_scattered.png";
break;
case "Thunderstorms": $col5wximg = "ifxwx_images/tstorms_rain.png";
break;
case "Severe T-Storms": $col5wximg = "ifxwx_images/tstorms_severe.png";
break;
case "Snow Flurries": $col5wximg = "ifxwx_images/snow_flurries.png";
break;
case "Scattered Snow Showers": $col5wximg = "ifxwx_images/snow_scattered.png";
break;
case "Snow": $col5wximg = "ifxwx_images/snow.png";
break;
case "Heavy Snow": $col5wximg = "ifxwx_images/snow_heavy.png";
break;
case "Blizzard": $col5wximg = "ifxwx_images/snow_blizzard.png";
break;
case "Blowing Snow": $col5wximg = "ifxwx_images/blowing_snow.png";
break;
case "Rain/Snow": $col5wximg = "ifxwx_images/rain_snow.png";
break;
case "Freezing Rain/Snow": $col5wximg = "ifxwx_images/freezing_rain_snow.png";
break;
case "Freezing Rain/Rain": $col5wximg = "ifxwx_images/freezing_rain.png";
break;
case "Freezing Rain/Sleet": $col5wximg = "ifxwx_images/freezing_rain_sleet.png";
break;
case "Rain/Sleet": $col5wximg = "ifxwx_images/rain_sleet.png";
break;
case "Sleet": $col5wximg = "ifxwx_images/sleet.png";
break;
case "Overcast/Haze": $col5wximg = "ifxwx_images/overcast_haze.png";
break;
case "Haze": $col5wximg = "ifxwx_images/haze_day_night.png";
break;
case "Sunny/Fog": $col5wximg = "ifxwx_images/fog_day.png";
break;
case "Morning Fog": $col5wximg = "ifxwx_images/fog_morning.png";
break;
case "Overnight Fog": $col5wximg = "ifxwx_images/fog_night.png";
break;
case "Cloudy/Fog": $col5wximg = "ifxwx_images/fog_overcast.png";
break;
case "Dense Fog": $col5wximg = "ifxwx_images/fog_dense.png";
break;
case "Windy": $col5wximg = "ifxwx_images/windy.png";
break;
case "Lunar Eclipse": $col5wximg = "ifxwx_images/lunar_eclipse.png";
break;
case "Solar Eclipse": $col5wximg = "ifxwx_images/solar_eclipse.png";
break;
default: $col5wximg = "ifxwx_images/fog_dense.png";
}
// Column 6 Weather Icon
switch ($_SESSION["col6wx"]) {
case "Sunny": $col6wximg = "ifxwx_images/sunny.png";
break;
case "Partly Sunny": $col6wximg = "ifxwx_images/partly_cloudy_day.png";
break;
case "Mostly Cloudy": $col6wximg = "ifxwx_images/overcast.png";
break;
case "Clear": $col6wximg = "ifxwx_images/clear_night.png";
break;
case "Partly Cloudy": $col6wximg = "ifxwx_images/partly_cloudy_night.png";
break;
case "Overcast": $col6wximg = "ifxwx_images/overcast.png";
break;
case "Isolated Rain Showers": $col6wximg = "ifxwx_images/showers_isolated.png";
break;
case "Scattered Rain Showers": $col6wximg = "ifxwx_images/showers_scattered.png";
break;
case "Rain": $col6wximg = "ifxwx_images/rain.png";
break;
case "Heavy Rain": $col6wximg = "ifxwx_images/rain_heavy.png";
break;
case "Rain and Fog": $col6wximg = "ifxwx_images/showers_haze.png";
break;
case "Isolated T-Storms": $col6wximg = "ifxwx_images/tstorms_isolated.png";
break;
case "Scattered T-Storms": $col6wximg = "ifxwx_images/tstorms_scattered.png";
break;
case "Thunderstorms": $col6wximg = "ifxwx_images/tstorms_rain.png";
break;
case "Severe T-Storms": $col6wximg = "ifxwx_images/tstorms_severe.png";
break;
case "Snow Flurries": $col6wximg = "ifxwx_images/snow_flurries.png";
break;
case "Scattered Snow Showers": $col6wximg = "ifxwx_images/snow_scattered.png";
break;
case "Snow": $col6wximg = "ifxwx_images/snow.png";
break;
case "Heavy Snow": $col6wximg = "ifxwx_images/snow_heavy.png";
break;
case "Blizzard": $col6wximg = "ifxwx_images/snow_blizzard.png";
break;
case "Blowing Snow": $col6wximg = "ifxwx_images/blowing_snow.png";
break;
case "Rain/Snow": $col6wximg = "ifxwx_images/rain_snow.png";
break;
case "Freezing Rain/Snow": $col6wximg = "ifxwx_images/freezing_rain_snow.png";
break;
case "Freezing Rain/Rain": $col6wximg = "ifxwx_images/freezing_rain.png";
break;
case "Freezing Rain/Sleet": $col6wximg = "ifxwx_images/freezing_rain_sleet.png";
break;
case "Rain/Sleet": $col6wximg = "ifxwx_images/rain_sleet.png";
break;
case "Sleet": $col6wximg = "ifxwx_images/sleet.png";
break;
case "Overcast/Haze": $col6wximg = "ifxwx_images/overcast_haze.png";
break;
case "Haze": $col6wximg = "ifxwx_images/haze_day_night.png";
break;
case "Sunny/Fog": $col6wximg = "ifxwx_images/fog_day.png";
break;
case "Morning Fog": $col6wximg = "ifxwx_images/fog_morning.png";
break;
case "Overnight Fog": $col6wximg = "ifxwx_images/fog_night.png";
break;
case "Cloudy/Fog": $col6wximg = "ifxwx_images/fog_overcast.png";
break;
case "Dense Fog": $col6wximg = "ifxwx_images/fog_dense.png";
break;
case "Windy": $col6wximg = "ifxwx_images/windy.png";
break;
case "Lunar Eclipse": $col6wximg = "ifxwx_images/lunar_eclipse.png";
break;
case "Solar Eclipse": $col6wximg = "ifxwx_images/solar_eclipse.png";
break;
default: $col6wximg = "ifxwx_images/fog_dense.png";
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html><head>
<meta content="text/html; charset=ISO-8859-1" http-equiv="content-type"><title>iFx Weather Publish</title>
<meta name="viewport" content="initial-scale=1.0">
<style type="text/css">
	<link title="normalize" rel="stylesheet" href="css/normalize.css" type="text/css"> 
</style>
<link title="skeleton" rel="stylesheet" href="css/skeleton.css" type="text/css">
	<link title="skeleton" rel="stylesheet" href="css/preview.css" type="text/css">
<link rel="icon" type="image/png" href="/images/favicon.png">
</head>
<body>
<div class="container">
<div class="twelve columns" style="font-weight: bold; text-align: center">
<p><big style="font-family: Helvetica,Arial,sans-serif;"><big><big><span><img style="width: 70px; height: 61px;" alt="" src="ifxwx_images/logo.png"><br>iFx
Weather</span></big></big></big>
Version <?php echo " " . $version ?></p>
</div>
	<div class="twelve columns">
				<hr>
			</div>
<!-- Forecast Meta Data -->
	<div class="three columns">
				<p>
		<strong>Forecaster: </strong><?php echo $_SESSION["forecaster"] ?>
		</p>
			</div>
				<div class="three columns">
				<p>
		<strong>Location: </strong><?php echo $_SESSION["stationid"] . " " . $_SESSION["location"] ?>
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
	
	<!-- Begin Column 1-->
<div style="text-align: center;" class="two columns">
	<p id="title"><strong><big><u><?php echo $_SESSION["col1"]; ?></u></big></strong><br></p>
<p>
	<img class="wximg" style="width: 70px; height: 70px;" alt="col1wximg" src="<?php echo $col1wximg ; ?>" >
	</p>
		<?php if ($_SESSION["col1pop"] > 0) {
	echo "<p><strong>" . $_SESSION["col1desc"] . "</strong> <small>(" . $_SESSION["col1pop"] . "%)</small></p>" ;
}
	else {
		echo "<p><strong>" . $_SESSION["col1desc"] . "</strong></p>" ;
}
?>
		<strong><big><big><?php echo "<p style='color:" . $tempcolor . "'>" . $_SESSION["col1temp"] . $tempunit . " </p>" 
?>  </big></big></strong>
	
		<small><?php if ($_SESSION["col1precip"] > 0 && empty($_SESSION["col1showrain"])) {
	echo "<p>Rain total " . $_SESSION["col1precip"] . " " . $precipunit . "</p>" ;
}
else {
	echo "<p></p>" ;
}

?>
		<?php if ($_SESSION["col1snowmin"] > 0 && $_SESSION["col1snowmax"] > 0 && $_SESSION["col1snowmin"] < $_SESSION["col1snowmax"]){
	echo "<p>Snow accumulation " . $_SESSION["col1snowmin"] . "-" . $_SESSION["col1snowmax"] . " " . $precipunit . "</p>" ;
}
elseif ($_SESSION["col1snowmin"] == $_SESSION["col1snowmax"] && $_SESSION["col1snowmin"] > 0 && $_SESSION["col1snowmax"] > 0){
	echo "<p>Snow accumulation up to " . $_SESSION["col1snowmax"] . " " . $precipunit . "</p>" ;
} 
elseif ($_SESSION["col1snowmin"] == 0 && $_SESSION["col1snowmax"] == 1){
	echo "<p>Snow accumulation less than 1 " . $precipunit . "</p>" ;
} 
elseif ($_SESSION["col1snowmin"] == 0 && $_SESSION["col1snowmax"] > 0){
	echo "<p>Snow accumulation up to " . $_SESSION["col1snowmax"] . " " . $precipunit . "</p>" ;
} 
?>
		
		<?php if ($_SESSION["col1windmin"] != " " && $_SESSION["col1windmax"] != " " && $_SESSION["col1windmin"] != $_SESSION["col1windmax"] && $_SESSION["col1windmin"] < $_SESSION["col1windmax"] && $_SESSION["col1winddir"] != " " && empty($_SESSION["col1showwind"])) {
	echo "<p>Winds " . $_SESSION["col1winddir"] . " " . $_SESSION["col1windmin"] . "-" . $_SESSION["col1windmax"] . " " . $windunit . "<br>" ;
}
elseif ($_SESSION["col1windmin"] == 0 && $_SESSION["col1windmax"] == 0 && $_SESSION["col1winddir"] == " " && empty($_SESSION["col1showwind"])){
	echo "<p>Winds Calm<br>" ;
}
elseif ($_SESSION["col1winddir"] == "Calm" && empty($_SESSION["col1showwind"])){
	echo "<p>Winds Calm<br>" ;
}
elseif ($_SESSION["col1winddir"] == "Variable" && $_SESSION["col1windmin"] == 0 && $_SESSION["col1windmax"] == 0 && empty($_SESSION["col1showwind"])){
	echo "<p>Winds Light and Variable<br>" ;
}
elseif ($_SESSION["col1windmin"] == "" && $_SESSION["col1windmax"] == "" && empty($_SESSION["col1showwind"])){
	echo "<p>Winds Light and Variable<br>" ;
}
elseif ($_SESSION["col1windmin"] == $_SESSION["col1windmax"] && empty($_SESSION["col1showwind"])) {
	echo "<p>Winds " . $_SESSION["col1winddir"] . " around " . $_SESSION["col1windmin"] . " " . $windunit . "<br>" ;
}
	else {
	echo "<p>";}
		
			?>
		
		<?php if ($_SESSION["col1windgust"] > 0 && $_SESSION["col1windgust"] > $_SESSION["col1windmax"] && empty($_SESSION["col1showwind"])){
	echo "Gusts up to " . $_SESSION["col1windgust"] . " " . $windunit . "</p>" ;
			}
				else 
		echo "</p>" ;
?></small>
<small><?php echo $_SESSION["col1detail"] . "<br>"; ?>
</small>
	<hr>
</div>
<br>
	<!-- End Column 1 -->
	<!-- Begin Column 2-->
<div style="text-align: center;" class="two columns">
	<p id="title"><strong><big><u><?php echo $_SESSION["col2"]; ?></u></big></strong><br></p>
<p>
	<img class="wximg" style="width: 70px; height: 70px;" alt="col2wximg" src="<?php echo $col2wximg ; ?>" >
	</p>
		<?php if ($_SESSION["col2pop"] > 0) {
	echo "<p><strong>" . $_SESSION["col2desc"] . "</strong> <small>(" . $_SESSION["col2pop"] . "%)</small></p>" ;
}
	else {
		echo "<p><strong>" . $_SESSION["col2desc"] . "</strong></p>" ;
}
?>
		<strong><big><big><?php echo "<p style='color:" . $tempcolor2 . "'>" . $_SESSION["col2temp"] . $tempunit . " </p>" 
?>  </big></big></strong>
	
		<small><?php if ($_SESSION["col2precip"] > 0 && empty($_SESSION["col2showrain"])) {
	echo "<p>Rain total " . $_SESSION["col2precip"] . " " . $precipunit . "</p>" ;
}
else {
	echo "<p></p>" ;
}

?>
		<?php if ($_SESSION["col2snowmin"] > 0 && $_SESSION["col2snowmax"] > 0 && $_SESSION["col2snowmin"] < $_SESSION["col2snowmax"]){
	echo "<p>Snow accumulation " . $_SESSION["col2snowmin"] . "-" . $_SESSION["col2snowmax"] . " " . $precipunit . "</p>" ;
}
elseif ($_SESSION["col2snowmin"] == $_SESSION["col2snowmax"] && $_SESSION["col2snowmin"] > 0 && $_SESSION["col2snowmax"] > 0){
	echo "<p>Snow accumulation up to " . $_SESSION["col2snowmax"] . " " . $precipunit . "</p>" ;
} 
elseif ($_SESSION["col2snowmin"] == 0 && $_SESSION["col2snowmax"] == 1){
	echo "<p>Snow accumulation less than 1 " . $precipunit . "</p>" ;
} 
elseif ($_SESSION["col2snowmin"] == 0 && $_SESSION["col2snowmax"] > 0){
	echo "<p>Snow accumulation up to " . $_SESSION["col2snowmax"] . " " . $precipunit . "</p>" ;
} 
?>
		
		<?php if ($_SESSION["col2windmin"] != " " && $_SESSION["col2windmax"] != " " && $_SESSION["col2windmin"] != $_SESSION["col2windmax"] && $_SESSION["col2windmin"] < $_SESSION["col2windmax"] && $_SESSION["col2winddir"] != " " && empty($_SESSION["col2showwind"])) {
	echo "<p>Winds " . $_SESSION["col2winddir"] . " " . $_SESSION["col2windmin"] . "-" . $_SESSION["col2windmax"] . " " . $windunit . "<br>" ;
}
elseif ($_SESSION["col2windmin"] == 0 && $_SESSION["col2windmax"] == 0 && $_SESSION["col2winddir"] == " " && empty($_SESSION["col2showwind"])){
	echo "<p>Winds Calm<br>" ;
}
elseif ($_SESSION["col2winddir"] == "Calm" && empty($_SESSION["col2showwind"])){
	echo "<p>Winds Calm<br>" ;
}
elseif ($_SESSION["col2winddir"] == "Variable" && $_SESSION["col2windmin"] == 0 && $_SESSION["col2windmax"] == 0 && empty($_SESSION["col2showwind"])){
	echo "<p>Winds Light and Variable<br>" ;
}
elseif ($_SESSION["col2windmin"] == "" && $_SESSION["col2windmax"] == "" && empty($_SESSION["col2showwind"])){
	echo "<p>Winds Light and Variable<br>" ;
}
elseif ($_SESSION["col2windmin"] == $_SESSION["col2windmax"] && empty($_SESSION["col2showwind"])) {
	echo "<p>Winds " . $_SESSION["col2winddir"] . " around " . $_SESSION["col2windmin"] . " " . $windunit . "<br>" ;
}
	else {
	echo "<p>";}
		
			?>
		
		<?php if ($_SESSION["col2windgust"] > 0 && $_SESSION["col2windgust"] > $_SESSION["col2windmax"] && empty($_SESSION["col2showwind"])){
	echo "Gusts up to " . $_SESSION["col2windgust"] . " " . $windunit . "</p>" ;
			}
				else 
		echo "</p>" ;
?></small>
<small><?php echo $_SESSION["col2detail"] . "<br>"; ?>
</small>
	<hr>
</div>
<br>
	<!-- End Column 2 -->
	<!-- Begin Column 3-->
<div style="text-align: center;" class="two columns">
	<p id="title"><strong><big><u><?php echo $_SESSION["col3"]; ?></u></big></strong><br></p>
<p>
	<img class="wximg" style="width: 70px; height: 70px;" alt="col3wximg" src="<?php echo $col3wximg ; ?>" >
	</p>
		<?php if ($_SESSION["col3pop"] > 0) {
	echo "<p><strong>" . $_SESSION["col3desc"] . "</strong> <small>(" . $_SESSION["col3pop"] . "%)</small></p>" ;
}
	else {
		echo "<p><strong>" . $_SESSION["col3desc"] . "</strong></p>" ;
}
?>
		<strong><big><big><?php echo "<p style='color:" . $tempcolor . "'>" . $_SESSION["col3temp"] . $tempunit . " </p>" 
?>  </big></big></strong>
	
		<small><?php if ($_SESSION["col3precip"] > 0 && empty($_SESSION["col3showrain"])) {
	echo "<p>Rain total " . $_SESSION["col3precip"] . " " . $precipunit . "</p>" ;
}
else {
	echo "<p></p>" ;
}

?>
		<?php if ($_SESSION["col3snowmin"] > 0 && $_SESSION["col3snowmax"] > 0 && $_SESSION["col3snowmin"] < $_SESSION["col3snowmax"]){
	echo "<p>Snow accumulation " . $_SESSION["col3snowmin"] . "-" . $_SESSION["col3snowmax"] . " " . $precipunit . "</p>" ;
}
elseif ($_SESSION["col3snowmin"] == $_SESSION["col3snowmax"] && $_SESSION["col3snowmin"] > 0 && $_SESSION["col3snowmax"] > 0){
	echo "<p>Snow accumulation up to " . $_SESSION["col3snowmax"] . " " . $precipunit . "</p>" ;
} 
elseif ($_SESSION["col3snowmin"] == 0 && $_SESSION["col3snowmax"] == 1){
	echo "<p>Snow accumulation less than 1 " . $precipunit . "</p>" ;
} 
elseif ($_SESSION["col3snowmin"] == 0 && $_SESSION["col3snowmax"] > 0){
	echo "<p>Snow accumulation up to " . $_SESSION["col3snowmax"] . " " . $precipunit . "</p>" ;
} 
?>
		
		<?php if ($_SESSION["col3windmin"] != " " && $_SESSION["col3windmax"] != " " && $_SESSION["col3windmin"] != $_SESSION["col3windmax"] && $_SESSION["col3windmin"] < $_SESSION["col3windmax"] && $_SESSION["col3winddir"] != " " && empty($_SESSION["col3showwind"])) {
	echo "<p>Winds " . $_SESSION["col3winddir"] . " " . $_SESSION["col3windmin"] . "-" . $_SESSION["col3windmax"] . " " . $windunit . "<br>" ;
}
elseif ($_SESSION["col3windmin"] == 0 && $_SESSION["col3windmax"] == 0 && $_SESSION["col3winddir"] == " " && empty($_SESSION["col3showwind"])){
	echo "<p>Winds Calm<br>" ;
}
elseif ($_SESSION["col3winddir"] == "Calm" && empty($_SESSION["col3showwind"])){
	echo "<p>Winds Calm<br>" ;
}
elseif ($_SESSION["col3winddir"] == "Variable" && $_SESSION["col3windmin"] == 0 && $_SESSION["col3windmax"] == 0 && empty($_SESSION["col3showwind"])){
	echo "<p>Winds Light and Variable<br>" ;
}
elseif ($_SESSION["col3windmin"] == "" && $_SESSION["col3windmax"] == "" && empty($_SESSION["col3showwind"])){
	echo "<p>Winds Light and Variable<br>" ;
}
elseif ($_SESSION["col3windmin"] == $_SESSION["col3windmax"] && empty($_SESSION["col3showwind"])) {
	echo "<p>Winds " . $_SESSION["col3winddir"] . " around " . $_SESSION["col3windmin"] . " " . $windunit . "<br>" ;
}
	else {
	echo "<p>";}
		
			?>
		
		<?php if ($_SESSION["col3windgust"] > 0 && $_SESSION["col3windgust"] > $_SESSION["col3windmax"] && empty($_SESSION["col3showwind"])){
	echo "Gusts up to " . $_SESSION["col3windgust"] . " " . $windunit . "</p>" ;
			}
				else 
		echo "</p>" ;
?></small>
<small><?php echo $_SESSION["col3detail"] . "<br>"; ?>
</small>
	<hr>
</div>
<br>
	<!-- End Column 3 -->
	<!-- Begin Column 4-->
<div style="text-align: center;" class="two columns">
	<p id="title"><strong><big><u><?php echo $_SESSION["col4"]; ?></u></big></strong><br></p>
<p>
	<img class="wximg" style="width: 70px; height: 70px;" alt="col4wximg" src="<?php echo $col4wximg ; ?>" >
	</p>
		<?php if ($_SESSION["col4pop"] > 0) {
	echo "<p><strong>" . $_SESSION["col4desc"] . "</strong> <small>(" . $_SESSION["col4pop"] . "%)</small></p>" ;
}
	else {
		echo "<p><strong>" . $_SESSION["col4desc"] . "</strong></p>" ;
}
?>
		<strong><big><big><?php echo "<p style='color:" . $tempcolor2 . "'>" . $_SESSION["col4temp"] . $tempunit . " </p>" 
?>  </big></big></strong>
	
		<small><?php if ($_SESSION["col4precip"] > 0 && empty($_SESSION["col4showrain"])) {
	echo "<p>Rain total " . $_SESSION["col4precip"] . " " . $precipunit . "</p>" ;
}
else {
	echo "<p></p>" ;
}

?>
		<?php if ($_SESSION["col4snowmin"] > 0 && $_SESSION["col4snowmax"] > 0 && $_SESSION["col4snowmin"] < $_SESSION["col4snowmax"]){
	echo "<p>Snow accumulation " . $_SESSION["col4snowmin"] . "-" . $_SESSION["col4snowmax"] . " " . $precipunit . "</p>" ;
}
elseif ($_SESSION["col4snowmin"] == $_SESSION["col4snowmax"] && $_SESSION["col4snowmin"] > 0 && $_SESSION["col4snowmax"] > 0){
	echo "<p>Snow accumulation up to " . $_SESSION["col4snowmax"] . " " . $precipunit . "</p>" ;
} 
elseif ($_SESSION["col4snowmin"] == 0 && $_SESSION["col4snowmax"] == 1){
	echo "<p>Snow accumulation less than 1 " . $precipunit . "</p>" ;
} 
elseif ($_SESSION["col4snowmin"] == 0 && $_SESSION["col4snowmax"] > 0){
	echo "<p>Snow accumulation up to " . $_SESSION["col4snowmax"] . " " . $precipunit . "</p>" ;
} 
?>
		
		<?php if ($_SESSION["col4windmin"] != " " && $_SESSION["col4windmax"] != " " && $_SESSION["col4windmin"] != $_SESSION["col4windmax"] && $_SESSION["col4windmin"] < $_SESSION["col4windmax"] && $_SESSION["col4winddir"] != " " && empty($_SESSION["col4showwind"])) {
	echo "<p>Winds " . $_SESSION["col4winddir"] . " " . $_SESSION["col4windmin"] . "-" . $_SESSION["col4windmax"] . " " . $windunit . "<br>" ;
}
elseif ($_SESSION["col4windmin"] == 0 && $_SESSION["col4windmax"] == 0 && $_SESSION["col4winddir"] == " " && empty($_SESSION["col4showwind"])){
	echo "<p>Winds Calm<br>" ;
}
elseif ($_SESSION["col4winddir"] == "Calm" && empty($_SESSION["col4showwind"])){
	echo "<p>Winds Calm<br>" ;
}
elseif ($_SESSION["col4winddir"] == "Variable" && $_SESSION["col4windmin"] == 0 && $_SESSION["col4windmax"] == 0 && empty($_SESSION["col4showwind"])){
	echo "<p>Winds Light and Variable<br>" ;
}
elseif ($_SESSION["col4windmin"] == "" && $_SESSION["col4windmax"] == "" && empty($_SESSION["col4showwind"])){
	echo "<p>Winds Light and Variable<br>" ;
}
elseif ($_SESSION["col4windmin"] == $_SESSION["col4windmax"] && empty($_SESSION["col4showwind"])) {
	echo "<p>Winds " . $_SESSION["col4winddir"] . " around " . $_SESSION["col4windmin"] . " " . $windunit . "<br>" ;
}
	else {
	echo "<p>";}
		
			?>
		
		<?php if ($_SESSION["col4windgust"] > 0 && $_SESSION["col4windgust"] > $_SESSION["col4windmax"] && empty($_SESSION["col4showwind"])){
	echo "Gusts up to " . $_SESSION["col4windgust"] . " " . $windunit . "</p>" ;
			}
				else 
		echo "</p>" ;
?></small>
<small><?php echo $_SESSION["col4detail"] . "<br>"; ?>
</small>
	<hr>
</div>
<br>
	<!-- End Column 4 -->
	<!-- Begin Column 5-->
<div style="text-align: center;" class="two columns">
	<p id="title"><strong><big><u><?php echo $_SESSION["col5"]; ?></u></big></strong><br></p>
<p>
	<img class="wximg" style="width: 70px; height: 70px;" alt="col5wximg" src="<?php echo $col5wximg ; ?>" >
	</p>
		<?php if ($_SESSION["col5pop"] > 0) {
	echo "<p><strong>" . $_SESSION["col5desc"] . "</strong> <small>(" . $_SESSION["col5pop"] . "%)</small></p>" ;
}
	else {
		echo "<p><strong>" . $_SESSION["col5desc"] . "</strong></p>" ;
}
?>
		<strong><big><big><?php echo "<p style='color:" . $tempcolor . "'>" . $_SESSION["col5temp"] . $tempunit . " </p>" 
?>  </big></big></strong>
	
		<small><?php if ($_SESSION["col5precip"] > 0 && empty($_SESSION["col5showrain"])) {
	echo "<p>Rain total " . $_SESSION["col5precip"] . " " . $precipunit . "</p>" ;
}
else {
	echo "<p></p>" ;
}

?>
		<?php if ($_SESSION["col5snowmin"] > 0 && $_SESSION["col5snowmax"] > 0 && $_SESSION["col5snowmin"] < $_SESSION["col5snowmax"]){
	echo "<p>Snow accumulation " . $_SESSION["col5snowmin"] . "-" . $_SESSION["col5snowmax"] . " " . $precipunit . "</p>" ;
}
elseif ($_SESSION["col5snowmin"] == $_SESSION["col5snowmax"] && $_SESSION["col5snowmin"] > 0 && $_SESSION["col5snowmax"] > 0){
	echo "<p>Snow accumulation up to " . $_SESSION["col5snowmax"] . " " . $precipunit . "</p>" ;
} 
elseif ($_SESSION["col5snowmin"] == 0 && $_SESSION["col5snowmax"] == 1){
	echo "<p>Snow accumulation less than 1 " . $precipunit . "</p>" ;
} 
elseif ($_SESSION["col5snowmin"] == 0 && $_SESSION["col5snowmax"] > 0){
	echo "<p>Snow accumulation up to " . $_SESSION["col5snowmax"] . " " . $precipunit . "</p>" ;
} 
?>
		
		<?php if ($_SESSION["col5windmin"] != " " && $_SESSION["col5windmax"] != " " && $_SESSION["col5windmin"] != $_SESSION["col5windmax"] && $_SESSION["col5windmin"] < $_SESSION["col5windmax"] && $_SESSION["col5winddir"] != " " && empty($_SESSION["col5showwind"])) {
	echo "<p>Winds " . $_SESSION["col5winddir"] . " " . $_SESSION["col5windmin"] . "-" . $_SESSION["col5windmax"] . " " . $windunit . "<br>" ;
}
elseif ($_SESSION["col5windmin"] == 0 && $_SESSION["col5windmax"] == 0 && $_SESSION["col5winddir"] == " " && empty($_SESSION["col5showwind"])){
	echo "<p>Winds Calm<br>" ;
}
elseif ($_SESSION["col5winddir"] == "Calm" && empty($_SESSION["col5showwind"])){
	echo "<p>Winds Calm<br>" ;
}
elseif ($_SESSION["col5winddir"] == "Variable" && $_SESSION["col5windmin"] == 0 && $_SESSION["col5windmax"] == 0 && empty($_SESSION["col5showwind"])){
	echo "<p>Winds Light and Variable<br>" ;
}
elseif ($_SESSION["col5windmin"] == "" && $_SESSION["col5windmax"] == "" && empty($_SESSION["col5showwind"])){
	echo "<p>Winds Light and Variable<br>" ;
}
elseif ($_SESSION["col5windmin"] == $_SESSION["col5windmax"] && empty($_SESSION["col5showwind"])) {
	echo "<p>Winds " . $_SESSION["col5winddir"] . " around " . $_SESSION["col5windmin"] . " " . $windunit . "<br>" ;
}
	else {
	echo "<p>";}
		
			?>
		
		<?php if ($_SESSION["col5windgust"] > 0 && $_SESSION["col5windgust"] > $_SESSION["col5windmax"] && empty($_SESSION["col5showwind"])){
	echo "Gusts up to " . $_SESSION["col5windgust"] . " " . $windunit . "</p>" ;
			}
				else 
		echo "</p>" ;
?></small>
<small><?php echo $_SESSION["col5detail"] . "<br>"; ?>
</small>
	<hr>
</div>
<br>
	<!-- End Column 5 -->
	<!-- Begin Column 6-->
<div style="text-align: center;" class="two columns">
	<p id="title"><strong><big><u><?php echo $_SESSION["col6"]; ?></u></big></strong><br></p>
<p>
	<img class="wximg" style="width: 70px; height: 70px;" alt="col6wximg" src="<?php echo $col6wximg ; ?>" >
	</p>
		<?php if ($_SESSION["col6pop"] > 0) {
	echo "<p><strong>" . $_SESSION["col6desc"] . "</strong> <small>(" . $_SESSION["col6pop"] . "%)</small></p>" ;
}
	else {
		echo "<p><strong>" . $_SESSION["col6desc"] . "</strong></p>" ;
}
?>
		<strong><big><big><?php echo "<p style='color:" . $tempcolor2 . "'>" . $_SESSION["col6temp"] . $tempunit . " </p>" 
?>  </big></big></strong>
	
		<small><?php if ($_SESSION["col6precip"] > 0 && empty($_SESSION["col6showrain"])) {
	echo "<p>Rain total " . $_SESSION["col6precip"] . " " . $precipunit . "</p>" ;
}
else {
	echo "<p></p>" ;
}

?>
		<?php if ($_SESSION["col6snowmin"] > 0 && $_SESSION["col6snowmax"] > 0 && $_SESSION["col6snowmin"] < $_SESSION["col6snowmax"]){
	echo "<p>Snow accumulation " . $_SESSION["col6snowmin"] . "-" . $_SESSION["col6snowmax"] . " " . $precipunit . "</p>" ;
}
elseif ($_SESSION["col6snowmin"] == $_SESSION["col6snowmax"] && $_SESSION["col6snowmin"] > 0 && $_SESSION["col6snowmax"] > 0){
	echo "<p>Snow accumulation up to " . $_SESSION["col6snowmax"] . " " . $precipunit . "</p>" ;
} 
elseif ($_SESSION["col6snowmin"] == 0 && $_SESSION["col6snowmax"] == 1){
	echo "<p>Snow accumulation less than 1 " . $precipunit . "</p>" ;
} 
elseif ($_SESSION["col6snowmin"] == 0 && $_SESSION["col6snowmax"] > 0){
	echo "<p>Snow accumulation up to " . $_SESSION["col6snowmax"] . " " . $precipunit . "</p>" ;
} 
?>
		
		<?php if ($_SESSION["col6windmin"] != " " && $_SESSION["col6windmax"] != " " && $_SESSION["col6windmin"] != $_SESSION["col6windmax"] && $_SESSION["col6windmin"] < $_SESSION["col6windmax"] && $_SESSION["col6winddir"] != " " && empty($_SESSION["col6showwind"])) {
	echo "<p>Winds " . $_SESSION["col6winddir"] . " " . $_SESSION["col6windmin"] . "-" . $_SESSION["col6windmax"] . " " . $windunit . "<br>" ;
}
elseif ($_SESSION["col6windmin"] == 0 && $_SESSION["col6windmax"] == 0 && $_SESSION["col6winddir"] == " " && empty($_SESSION["col6showwind"])){
	echo "<p>Winds Calm<br>" ;
}
elseif ($_SESSION["col6winddir"] == "Calm" && empty($_SESSION["col6showwind"])){
	echo "<p>Winds Calm<br>" ;
}
elseif ($_SESSION["col6winddir"] == "Variable" && $_SESSION["col6windmin"] == 0 && $_SESSION["col6windmax"] == 0 && empty($_SESSION["col6showwind"])){
	echo "<p>Winds Light and Variable<br>" ;
}
elseif ($_SESSION["col6windmin"] == "" && $_SESSION["col6windmax"] == "" && empty($_SESSION["col6showwind"])){
	echo "<p>Winds Light and Variable<br>" ;
}
elseif ($_SESSION["col6windmin"] == $_SESSION["col6windmax"] && empty($_SESSION["col6showwind"])) {
	echo "<p>Winds " . $_SESSION["col6winddir"] . " around " . $_SESSION["col6windmin"] . " " . $windunit . "<br>" ;
}
	else {
	echo "<p>";}
		
			?>
		
		<?php if ($_SESSION["col6windgust"] > 0 && $_SESSION["col6windgust"] > $_SESSION["col6windmax"] && empty($_SESSION["col6showwind"])){
	echo "Gusts up to " . $_SESSION["col6windgust"] . " " . $windunit . "</p>" ;
			}
				else 
		echo "</p>" ;
?></small>
<small><?php echo $_SESSION["col6detail"] . "<br>"; ?>
</small>
	<hr>
</div>
<br>
	<!-- End Column 6 -->

		<div class="twelve columns">
				<hr>
			</div>
	<div class="three columns">
		<form action="iFxWx.php">
			<input name="New" id="New" value="Make a New Forecast" type="submit">
		</form></div>
	<div class="eight columns" align="right">
				<form  action="verify.php" method="POST" >
	<input name="Verify" id="Verify" value="Verify" type="submit">
	</form>
			</div>
	<div class="eleven columns" align="right">
		<?php 
						//insert published data into database
global $wpdb;
	
	//$welcome_forecaster = 'Adam';
	//$welcome_station = 'K1P1';
	//$welcome_location = 'Plymouth, NH';
	//$welcome_fx_valid_month = '03';
	//$welcome_fx_valid_day = '15';
	//$welcome_fx_valid_year = '2016';
	//$welcome_fx_valid_time = '5PM - 5AM';
	
	$table_name = $wpdb->prefix . '3dayforecasts';
	
	$wpdb->insert( 
		$table_name, 
		array( 
			/*'time' => current_time( 'mysql' ),*/ 
			'type' => "F",
			'verified' => "N",
			'forecaster' => $_SESSION["forecaster"], 
			'station' => $_SESSION["stationid"],
			'location'=> $_SESSION["location"],
			'date' => $_SESSION["date"],
			'time' => $_SESSION["time"],
			'fx_valid_month' => $_SESSION["fxstartmonth"],
			'fx_valid_day' => $_SESSION["fxstartday"],
			'fx_valid_year' => $_SESSION["fxstartyear"],
			'fx_valid_time' => $_SESSION["fxstarttime"],
			'col1_title' => $_SESSION["col1"],
			'col1_icon' => $col1wximg,
			'col1_weather' => $_SESSION["col1wx"],
			'col1_temp' => $_SESSION["col1temp"],
			'col1_highlow' => $tempcolor,
			'col1_pop' => $_SESSION["col1pop"],
			'col1_precip' => $_SESSION["col1precip"],
			'col1_hiderain' => $_SESSION["col1showrain"],
			'col1_snowmin' => $_SESSION["col1snowmin"],
			'col1_snowmax' =>  $_SESSION["col1snowmax"],
			'col1_windmin' => $_SESSION["col1windmin"],
			'col1_winmax' => $_SESSION["col1windmax"],
			'col1_windgust' => $_SESSION["col1windgust"],
			'col1_winddir' => $_SESSION["col1winddir"],
			'col1_hidewind' => $_SESSION["col1showwind"],
			'col1_details' => $_SESSION["col1detail"],
			'col2_title' => $_SESSION["col2"],
			'col2_icon' => $col2wximg,
			'col2_weather' => $_SESSION["col2wx"],
			'col2_temp' => $_SESSION["col2temp"],
			'col2_highlow' => $tempcolor2,
			'col2_pop' => $_SESSION["col2pop"],
			'col2_precip' => $_SESSION["col2precip"],
			'col2_hiderain' => $_SESSION["col2showrain"],
			'col2_snowmin' => $_SESSION["col2snowmin"],
			'col2_snowmax' =>  $_SESSION["col2snowmax"],
			'col2_windmin' => $_SESSION["col2windmin"],
			'col2_winmax' => $_SESSION["col2windmax"],
			'col2_windgust' => $_SESSION["col2windgust"],
			'col2_winddir' => $_SESSION["col2winddir"],
			'col2_hidewind' => $_SESSION["col2showwind"],
			'col2_details' => $_SESSION["col2detail"],
			'col3_title' => $_SESSION["col3"],
			'col3_icon' => $col3wximg,
			'col3_weather' => $_SESSION["col3wx"],
			'col3_temp' => $_SESSION["col3temp"],
			'col3_highlow' => $tempcolor,
			'col3_pop' => $_SESSION["col3pop"],
			'col3_precip' => $_SESSION["col3precip"],
			'col3_hiderain' => $_SESSION["col3showrain"],
			'col3_snowmin' => $_SESSION["col3snowmin"],
			'col3_snowmax' =>  $_SESSION["col3snowmax"],
			'col3_windmin' => $_SESSION["col3windmin"],
			'col3_winmax' => $_SESSION["col3windmax"],
			'col3_windgust' => $_SESSION["col3windgust"],
			'col3_winddir' => $_SESSION["col3winddir"],
			'col3_hidewind' => $_SESSION["col3showwind"],
			'col3_details' => $_SESSION["col3detail"],
			'col4_title' => $_SESSION["col4"],
			'col4_icon' => $col4wximg,
			'col4_weather' => $_SESSION["col4wx"],
			'col4_temp' => $_SESSION["col4temp"],
			'col4_highlow' => $tempcolor2,
			'col4_pop' => $_SESSION["col4pop"],
			'col4_precip' => $_SESSION["col4precip"],
			'col4_hiderain' => $_SESSION["col4showrain"],
			'col4_snowmin' => $_SESSION["col4snowmin"],
			'col4_snowmax' =>  $_SESSION["col4snowmax"],
			'col4_windmin' => $_SESSION["col4windmin"],
			'col4_winmax' => $_SESSION["col4windmax"],
			'col4_windgust' => $_SESSION["col4windgust"],
			'col4_winddir' => $_SESSION["col4winddir"],
			'col4_hidewind' => $_SESSION["col4showwind"],
			'col4_details' => $_SESSION["col4detail"],
			'col5_title' => $_SESSION["col5"],
			'col5_icon' => $col5wximg,
			'col5_weather' => $_SESSION["col5wx"],
			'col5_temp' => $_SESSION["col5temp"],
			'col5_highlow' => $tempcolor,
			'col5_pop' => $_SESSION["col5pop"],
			'col5_precip' => $_SESSION["col5precip"],
			'col5_hiderain' => $_SESSION["col5showrain"],
			'col5_snowmin' => $_SESSION["col5snowmin"],
			'col5_snowmax' =>  $_SESSION["col5snowmax"],
			'col5_windmin' => $_SESSION["col5windmin"],
			'col5_winmax' => $_SESSION["col5windmax"],
			'col5_windgust' => $_SESSION["col5windgust"],
			'col5_winddir' => $_SESSION["col5winddir"],
			'col5_hidewind' => $_SESSION["col5showwind"],
			'col5_details' => $_SESSION["col5detail"],
			'col6_title' => $_SESSION["col6"],
			'col6_icon' => $col6wximg,
			'col6_weather' => $_SESSION["col6wx"],
			'col6_temp' => $_SESSION["col6temp"],
			'col6_highlow' => $tempcolor2,
			'col6_pop' => $_SESSION["col6pop"],
			'col6_precip' => $_SESSION["col6precip"],
			'col6_hiderain' => $_SESSION["col6showrain"],
			'col6_snowmin' => $_SESSION["col6snowmin"],
			'col6_snowmax' =>  $_SESSION["col6snowmax"],
			'col6_windmin' => $_SESSION["col6windmin"],
			'col6_winmax' => $_SESSION["col6windmax"],
			'col6_windgust' => $_SESSION["col6windgust"],
			'col6_winddir' => $_SESSION["col6winddir"],
			'col6_hidewind' => $_SESSION["col6showwind"],
			'col6_details' => $_SESSION["col6detail"],
			'temp_unit' => $_SESSION["tempunit"],
			'precip_unit' => $_SESSION["precipunit"],
			'wind_unit' => $_SESSION["windunit"],
			'colorize_temp' => $_SESSION["colortemp"]
		) 
	);
	$lastid = $wpdb->insert_id;
	$_SESSION["lastid"] = $lastid;
		
		echo "Forecast ID Number: " . $_SESSION["lastid"]; ?>
	</div>
	
	</div>
</div>
	
	
</body></html>