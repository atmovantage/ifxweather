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
 
// Update the timeout field with the current time.
$_SESSION['timeout'] = time();

function submit_input() {
	// Meta data variables
	$_SESSION["forecaster"] = $_SESSION["forecaster"];
	$_SESSION["stationid"] = $_SESSION["stationid"];
	$_SESSION["stationname"] = $_SESSION["stationname"];
	$_SESSION["date"] = $_SESSION["date"];
	$_SESSION["time"] = $_SESSION["time"];
	$_SESSION["fxstarttime"] = $_SESSION["fxstarttime"];
	$_SESSION["fxstartmonth"] = $_SESSION["fxstartmonth"];
	$_SESSION["fxstartday"] = $_SESSION["fxstartday"];
	$_SESSION["fxstartyear"] = $_SESSION["fxstartyear"];
	$_SESSION["tempunit"] = $_SESSION["tempunit"];
	$_SESSION["colortemp"] = $_SESSION["colortemp"];
	$_SESSION["windunit"] = $_SESSION["windunit"];
	
	$_SESSION["fxvalidname"] = $_SESSION["fxvalidname"];
	
	
	// Column 1 Forecast Period Variables
	$_SESSION["col1label"] = $_SESSION["col1label"];
	$_SESSION["col1wx"] = $_SESSION["col1wx"];
	$_SESSION["col1"] = $_SESSION["col1"];
	$_SESSION["col1highlow"] = $_SESSION["col1highlow"];
	$_SESSION["precipunit"] = $_SESSION["precipunit"];
	$_SESSION["col1pop"] = $_SESSION["col1pop"];
	$_SESSION["col1desc"] = $_SESSION["col1desc"];
	$_SESSION["col1temp"] = $_SESSION["col1temp"];
	$_SESSION["col1precip"] = $_SESSION["col1precip"];
	$_SESSION["col1showrain"] = $_SESSION["col1showrain"];
	$_SESSION["col1snowmin"] = $_SESSION["col1snowmin"];
	$_SESSION["col1snowmax"] = $_SESSION["col1snowmax"];
	$_SESSION["col1windmin"] = $_SESSION["col1windmin"];
	$_SESSION["col1windmax"] = $_SESSION["col1windmax"];
	$_SESSION["col1winddir"] = $_SESSION["col1winddir"];
	$_SESSION["col1showwind"] = $_SESSION["col1showwind"];
	$_SESSION["col1windgust"] = $_SESSION["col1windgust"];
	$_SESSION["col1detail"] = $_SESSION["col1detail"];
	
	// Column 2 Forecast Period Variables
	$_SESSION["col2label"] = $_SESSION["col2label"];
	$_SESSION["col2wx"] = $_SESSION["col2wx"];
	$_SESSION["col2"] = $_SESSION["col2"];
	$_SESSION["col2highlow"] = $_SESSION["col2highlow"];
	$_SESSION["precipunit"] = $_SESSION["precipunit"];
	$_SESSION["col2pop"] = $_SESSION["col2pop"];
	$_SESSION["col2desc"] = $_SESSION["col2desc"];
	$_SESSION["col2temp"] = $_SESSION["col2temp"];
	$_SESSION["col2precip"] = $_SESSION["col2precip"];
	$_SESSION["col2showrain"] = $_SESSION["col2showrain"];
	$_SESSION["col2snowmin"] = $_SESSION["col2snowmin"];
	$_SESSION["col2snowmax"] = $_SESSION["col2snowmax"];
	$_SESSION["col2windmin"] = $_SESSION["col2windmin"];
	$_SESSION["col2windmax"] = $_SESSION["col2windmax"];
	$_SESSION["col2winddir"] = $_SESSION["col2winddir"];
	$_SESSION["col2showwind"] = $_SESSION["col2showwind"];
	$_SESSION["col2windgust"] = $_SESSION["col2windgust"];
	$_SESSION["col2detail"] = $_SESSION["col2detail"];
	
	// Column 3 Forecast Period Variables
	$_SESSION["col3wx"] = $_SESSION["col3wx"];
	$_SESSION["col3"] = $_SESSION["col3"];
	$_SESSION["col3highlow"] = $_SESSION["col3highlow"];
	$_SESSION["precipunit"] = $_SESSION["precipunit"];
	$_SESSION["col3pop"] = $_SESSION["col3pop"];
	$_SESSION["col3desc"] = $_SESSION["col3desc"];
	$_SESSION["col3temp"] = $_SESSION["col3temp"];
	$_SESSION["col3precip"] = $_SESSION["col3precip"];
	$_SESSION["col3showrain"] = $_SESSION["col3showrain"];
	$_SESSION["col3snowmin"] = $_SESSION["col3snowmin"];
	$_SESSION["col3snowmax"] = $_SESSION["col3snowmax"];
	$_SESSION["col3windmin"] = $_SESSION["col3windmin"];
	$_SESSION["col3windmax"] = $_SESSION["col3windmax"];
	$_SESSION["col3winddir"] = $_SESSION["col3winddir"];
	$_SESSION["col3showwind"] = $_SESSION["col3showwind"];
	$_SESSION["col3windgust"] = $_SESSION["col3windgust"];
	$_SESSION["col3detail"] = $_SESSION["col3detail"];
	
	// Column 4 Forecast Period Variables
	$_SESSION["col4wx"] = $_SESSION["col4wx"];
	$_SESSION["col4"] = $_SESSION["col4"];
	$_SESSION["col4highlow"] = $_SESSION["col4highlow"];
	$_SESSION["precipunit"] = $_SESSION["precipunit"];
	$_SESSION["col4pop"] = $_SESSION["col4pop"];
	$_SESSION["col4desc"] = $_SESSION["col4desc"];
	$_SESSION["col4temp"] = $_SESSION["col4temp"];
	$_SESSION["col4precip"] = $_SESSION["col4precip"];
	$_SESSION["col4showrain"] = $_SESSION["col4showrain"];
	$_SESSION["col4snowmin"] = $_SESSION["col4snowmin"];
	$_SESSION["col4snowmax"] = $_SESSION["col4snowmax"];
	$_SESSION["col4windmin"] = $_SESSION["col4windmin"];
	$_SESSION["col4windmax"] = $_SESSION["col4windmax"];
	$_SESSION["col4winddir"] = $_SESSION["col4winddir"];
	$_SESSION["col4showwind"] = $_SESSION["col4showwind"];
	$_SESSION["col4windgust"] = $_SESSION["col4windgust"];
	$_SESSION["col4detail"] = $_SESSION["col4detail"];
	
	// Column 5 Forecast Period Variables
	$_SESSION["col5wx"] = $_SESSION["col5wx"];
	$_SESSION["col5"] = $_SESSION["col5"];
	$_SESSION["col5highlow"] = $_SESSION["col5highlow"];
	$_SESSION["precipunit"] = $_SESSION["precipunit"];
	$_SESSION["col5pop"] = $_SESSION["col5pop"];
	$_SESSION["col5desc"] = $_SESSION["col5desc"];
	$_SESSION["col5temp"] = $_SESSION["col5temp"];
	$_SESSION["col5precip"] = $_SESSION["col5precip"];
	$_SESSION["col5showrain"] = $_SESSION["col5showrain"];
	$_SESSION["col5snowmin"] = $_SESSION["col5snowmin"];
	$_SESSION["col5snowmax"] = $_SESSION["col5snowmax"];
	$_SESSION["col5windmin"] = $_SESSION["col5windmin"];
	$_SESSION["col5windmax"] = $_SESSION["col5windmax"];
	$_SESSION["col5winddir"] = $_SESSION["col5winddir"];
	$_SESSION["col5showwind"] = $_SESSION["col5showwind"];
	$_SESSION["col5windgust"] = $_SESSION["col5windgust"];
	$_SESSION["col5detail"] = $_SESSION["col5detail"];
	
	//Submit to the preview page
	header('Location: /iFxWx.php');
	//echo "/iFxWx.php";
	exit();
}

if (isset($_POST['Edit'])) {
	submit_input();
}
	
	switch ($_SESSION["tempunit"]) {
	case "fahrenheit": $tempunit = "&#8457";
		break;
	case "celsius": $tempunit = "&#8451;";
	break;
	default: $tempunit = "&#8451;";
}

    if ($_SESSION["colortemp"] == "yes") {
      $tempcolor = $_SESSION["col1highlow"];
	$tempcolor2 = $_SESSION["col2highlow"];
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
case "Sunny": $col1wximg = "/ifxwx_images/sunny.png";
break;
case "Partly Sunny": $col1wximg = "/ifxwx_images/partly_cloudy_day.png";
break;
case "Mostly Cloudy": $col1wximg = "/ifxwx_images/overcast.png";
break;
case "Clear": $col1wximg = "/ifxwx_images/clear_night.png";
break;
case "Partly Cloudy": $col1wximg = "/ifxwx_images/partly_cloudy_night.png";
break;
case "Overcast": $col1wximg = "/ifxwx_images/overcast.png";
break;
case "Isolated Rain Showers": $col1wximg = "/ifxwx_images/showers_isolated.png";
break;
case "Scattered Rain Showers": $col1wximg = "/ifxwx_images/showers_scattered.png";
break;
case "Rain": $col1wximg = "/ifxwx_images/rain.png";
break;
case "Heavy Rain": $col1wximg = "/ifxwx_images/rain_heavy.png";
break;
case "Rain and Fog": $col1wximg = "/ifxwx_images/showers_haze.png";
break;
case "Isolated T-Storms": $col1wximg = "/ifxwx_images/tstorms_isolated.png";
break;
case "Scattered T-Storms": $col1wximg = "/ifxwx_images/tstorms_scattered.png";
break;
case "Thunderstorms": $col1wximg = "/ifxwx_images/tstorms_rain.png";
break;
case "Severe T-Storms": $col1wximg = "/ifxwx_images/tstorms_severe.png";
break;
case "Snow Flurries": $col1wximg = "/ifxwx_images/snow_flurries.png";
break;
case "Scattered Snow Showers": $col1wximg = "/ifxwx_images/snow_scattered.png";
break;
case "Snow": $col1wximg = "/ifxwx_images/snow.png";
break;
case "Heavy Snow": $col1wximg = "/ifxwx_images/snow_heavy.png";
break;
case "Blizzard": $col1wximg = "/ifxwx_images/snow_blizzard.png";
break;
case "Blowing Snow": $col1wximg = "/ifxwx_images/blowing_snow.png";
break;
case "Rain/Snow": $col1wximg = "/ifxwx_images/rain_snow.png";
break;
case "Freezing Rain/Snow": $col1wximg = "/ifxwx_images/freezing_rain_snow.png";
break;
case "Freezing Rain/Rain": $col1wximg = "/ifxwx_images/freezing_rain.png";
break;
case "Freezing Rain/Sleet": $col1wximg = "/ifxwx_images/freezing_rain_sleet.png";
break;
case "Rain/Sleet": $col1wximg = "/ifxwx_images/rain_sleet.png";
break;
case "Sleet": $col1wximg = "/ifxwx_images/sleet.png";
break;
case "Overcast/Haze": $col1wximg = "/ifxwx_images/overcast_haze.png";
break;
case "Haze": $col1wximg = "/ifxwx_images/haze_day_night.png";
break;
case "Sunny/Fog": $col1wximg = "/ifxwx_images/fog_day.png";
break;
case "Morning Fog": $col1wximg = "/ifxwx_images/fog_morning.png";
break;
case "Overnight Fog": $col1wximg = "/ifxwx_images/fog_night.png";
break;
case "Cloudy/Fog": $col1wximg = "/ifxwx_images/fog_overcast.png";
break;
case "Dense Fog": $col1wximg = "/ifxwx_images/fog_dense.png";
break;
case "Windy": $col1wximg = "/ifxwx_images/windy.png";
break;
case "Lunar Eclipse": $col1wximg = "/ifxwx_images/lunar_eclipse.png";
break;
case "Solar Eclipse": $col1wximg = "/ifxwx_images/solar_eclipse.png";
break;
default: $col1wximg = "/ifxwx_images/fog_dense.png";
}
// Column 2 Weather Icon
switch ($_SESSION["col2wx"]) {
case "Sunny": $col2wximg = "/ifxwx_images/sunny.png";
break;
case "Partly Sunny": $col2wximg = "/ifxwx_images/partly_cloudy_day.png";
break;
case "Mostly Cloudy": $col2wximg = "/ifxwx_images/overcast.png";
break;
case "Clear": $col2wximg = "/ifxwx_images/clear_night.png";
break;
case "Partly Cloudy": $col2wximg = "/ifxwx_images/partly_cloudy_night.png";
break;
case "Overcast": $col2wximg = "/ifxwx_images/overcast.png";
break;
case "Isolated Rain Showers": $col2wximg = "/ifxwx_images/showers_isolated.png";
break;
case "Scattered Rain Showers": $col2wximg = "/ifxwx_images/showers_scattered.png";
break;
case "Rain": $col2wximg = "/ifxwx_images/rain.png";
break;
case "Heavy Rain": $col2wximg = "/ifxwx_images/rain_heavy.png";
break;
case "Rain and Fog": $col2wximg = "/ifxwx_images/showers_haze.png";
break;
case "Isolated T-Storms": $col2wximg = "/ifxwx_images/tstorms_isolated.png";
break;
case "Scattered T-Storms": $col2wximg = "/ifxwx_images/tstorms_scattered.png";
break;
case "Thunderstorms": $col2wximg = "/ifxwx_images/tstorms_rain.png";
break;
case "Severe T-Storms": $col2wximg = "/ifxwx_images/tstorms_severe.png";
break;
case "Snow Flurries": $col2wximg = "/ifxwx_images/snow_flurries.png";
break;
case "Scattered Snow Showers": $col2wximg = "/ifxwx_images/snow_scattered.png";
break;
case "Snow": $col2wximg = "/ifxwx_images/snow.png";
break;
case "Heavy Snow": $col2wximg = "/ifxwx_images/snow_heavy.png";
break;
case "Blizzard": $col2wximg = "/ifxwx_images/snow_blizzard.png";
break;
case "Blowing Snow": $col2wximg = "/ifxwx_images/blowing_snow.png";
break;
case "Rain/Snow": $col2wximg = "/ifxwx_images/rain_snow.png";
break;
case "Freezing Rain/Snow": $col2wximg = "/ifxwx_images/freezing_rain_snow.png";
break;
case "Freezing Rain/Rain": $col2wximg = "/ifxwx_images/freezing_rain.png";
break;
case "Freezing Rain/Sleet": $col2wximg = "/ifxwx_images/freezing_rain_sleet.png";
break;
case "Rain/Sleet": $col2wximg = "/ifxwx_images/rain_sleet.png";
break;
case "Sleet": $col2wximg = "/ifxwx_images/sleet.png";
break;
case "Overcast/Haze": $col2wximg = "/ifxwx_images/overcast_haze.png";
break;
case "Haze": $col2wximg = "/ifxwx_images/haze_day_night.png";
break;
case "Sunny/Fog": $col2wximg = "/ifxwx_images/fog_day.png";
break;
case "Morning Fog": $col2wximg = "/ifxwx_images/fog_morning.png";
break;
case "Overnight Fog": $col2wximg = "/ifxwx_images/fog_night.png";
break;
case "Cloudy/Fog": $col2wximg = "/ifxwx_images/fog_overcast.png";
break;
case "Dense Fog": $col2wximg = "/ifxwx_images/fog_dense.png";
break;
case "Windy": $col2wximg = "/ifxwx_images/windy.png";
break;
case "Lunar Eclipse": $col2wximg = "/ifxwx_images/lunar_eclipse.png";
break;
case "Solar Eclipse": $col2wximg = "/ifxwx_images/solar_eclipse.png";
break;
default: $col2wximg = "/ifxwx_images/fog_dense.png";
}
// Column 3 Weather Icon
switch ($_SESSION["col3wx"]) {
case "Sunny": $col3wximg = "/ifxwx_images/sunny.png";
break;
case "Partly Sunny": $col3wximg = "/ifxwx_images/partly_cloudy_day.png";
break;
case "Mostly Cloudy": $col3wximg = "/ifxwx_images/overcast.png";
break;
case "Clear": $col3wximg = "/ifxwx_images/clear_night.png";
break;
case "Partly Cloudy": $col3wximg = "/ifxwx_images/partly_cloudy_night.png";
break;
case "Overcast": $col3wximg = "/ifxwx_images/overcast.png";
break;
case "Isolated Rain Showers": $col3wximg = "/ifxwx_images/showers_isolated.png";
break;
case "Scattered Rain Showers": $col3wximg = "/ifxwx_images/showers_scattered.png";
break;
case "Rain": $col3wximg = "/ifxwx_images/rain.png";
break;
case "Heavy Rain": $col3wximg = "/ifxwx_images/rain_heavy.png";
break;
case "Rain and Fog": $col3wximg = "/ifxwx_images/showers_haze.png";
break;
case "Isolated T-Storms": $col3wximg = "/ifxwx_images/tstorms_isolated.png";
break;
case "Scattered T-Storms": $col3wximg = "/ifxwx_images/tstorms_scattered.png";
break;
case "Thunderstorms": $col3wximg = "/ifxwx_images/tstorms_rain.png";
break;
case "Severe T-Storms": $col3wximg = "/ifxwx_images/tstorms_severe.png";
break;
case "Snow Flurries": $col3wximg = "/ifxwx_images/snow_flurries.png";
break;
case "Scattered Snow Showers": $col3wximg = "/ifxwx_images/snow_scattered.png";
break;
case "Snow": $col3wximg = "/ifxwx_images/snow.png";
break;
case "Heavy Snow": $col3wximg = "/ifxwx_images/snow_heavy.png";
break;
case "Blizzard": $col3wximg = "/ifxwx_images/snow_blizzard.png";
break;
case "Blowing Snow": $col3wximg = "/ifxwx_images/blowing_snow.png";
break;
case "Rain/Snow": $col3wximg = "/ifxwx_images/rain_snow.png";
break;
case "Freezing Rain/Snow": $col3wximg = "/ifxwx_images/freezing_rain_snow.png";
break;
case "Freezing Rain/Rain": $col3wximg = "/ifxwx_images/freezing_rain.png";
break;
case "Freezing Rain/Sleet": $col3wximg = "/ifxwx_images/freezing_rain_sleet.png";
break;
case "Rain/Sleet": $col3wximg = "/ifxwx_images/rain_sleet.png";
break;
case "Sleet": $col3wximg = "/ifxwx_images/sleet.png";
break;
case "Overcast/Haze": $col3wximg = "/ifxwx_images/overcast_haze.png";
break;
case "Haze": $col3wximg = "/ifxwx_images/haze_day_night.png";
break;
case "Sunny/Fog": $col3wximg = "/ifxwx_images/fog_day.png";
break;
case "Morning Fog": $col3wximg = "/ifxwx_images/fog_morning.png";
break;
case "Overnight Fog": $col3wximg = "/ifxwx_images/fog_night.png";
break;
case "Cloudy/Fog": $col3wximg = "/ifxwx_images/fog_overcast.png";
break;
case "Dense Fog": $col3wximg = "/ifxwx_images/fog_dense.png";
break;
case "Windy": $col3wximg = "/ifxwx_images/windy.png";
break;
case "Lunar Eclipse": $col3wximg = "/ifxwx_images/lunar_eclipse.png";
break;
case "Solar Eclipse": $col3wximg = "/ifxwx_images/solar_eclipse.png";
break;
default: $col3wximg = "/ifxwx_images/fog_dense.png";
}
// Column 4 Weather Icon
switch ($_SESSION["col4wx"]) {
case "Sunny": $col4wximg = "/ifxwx_images/sunny.png";
break;
case "Partly Sunny": $col4wximg = "/ifxwx_images/partly_cloudy_day.png";
break;
case "Mostly Cloudy": $col4wximg = "/ifxwx_images/overcast.png";
break;
case "Clear": $col4wximg = "/ifxwx_images/clear_night.png";
break;
case "Partly Cloudy": $col4wximg = "/ifxwx_images/partly_cloudy_night.png";
break;
case "Overcast": $col4wximg = "/ifxwx_images/overcast.png";
break;
case "Isolated Rain Showers": $col4wximg = "/ifxwx_images/showers_isolated.png";
break;
case "Scattered Rain Showers": $col4wximg = "/ifxwx_images/showers_scattered.png";
break;
case "Rain": $col4wximg = "/ifxwx_images/rain.png";
break;
case "Heavy Rain": $col4wximg = "/ifxwx_images/rain_heavy.png";
break;
case "Rain and Fog": $col4wximg = "/ifxwx_images/showers_haze.png";
break;
case "Isolated T-Storms": $col4wximg = "/ifxwx_images/tstorms_isolated.png";
break;
case "Scattered T-Storms": $col4wximg = "/ifxwx_images/tstorms_scattered.png";
break;
case "Thunderstorms": $col4wximg = "/ifxwx_images/tstorms_rain.png";
break;
case "Severe T-Storms": $col4wximg = "/ifxwx_images/tstorms_severe.png";
break;
case "Snow Flurries": $col4wximg = "/ifxwx_images/snow_flurries.png";
break;
case "Scattered Snow Showers": $col4wximg = "/ifxwx_images/snow_scattered.png";
break;
case "Snow": $col4wximg = "/ifxwx_images/snow.png";
break;
case "Heavy Snow": $col4wximg = "/ifxwx_images/snow_heavy.png";
break;
case "Blizzard": $col4wximg = "/ifxwx_images/snow_blizzard.png";
break;
case "Blowing Snow": $col4wximg = "/ifxwx_images/blowing_snow.png";
break;
case "Rain/Snow": $col4wximg = "/ifxwx_images/rain_snow.png";
break;
case "Freezing Rain/Snow": $col4wximg = "/ifxwx_images/freezing_rain_snow.png";
break;
case "Freezing Rain/Rain": $col4wximg = "/ifxwx_images/freezing_rain.png";
break;
case "Freezing Rain/Sleet": $col4wximg = "/ifxwx_images/freezing_rain_sleet.png";
break;
case "Rain/Sleet": $col4wximg = "/ifxwx_images/rain_sleet.png";
break;
case "Sleet": $col4wximg = "/ifxwx_images/sleet.png";
break;
case "Overcast/Haze": $col4wximg = "/ifxwx_images/overcast_haze.png";
break;
case "Haze": $col4wximg = "/ifxwx_images/haze_day_night.png";
break;
case "Sunny/Fog": $col4wximg = "/ifxwx_images/fog_day.png";
break;
case "Morning Fog": $col4wximg = "/ifxwx_images/fog_morning.png";
break;
case "Overnight Fog": $col4wximg = "/ifxwx_images/fog_night.png";
break;
case "Cloudy/Fog": $col4wximg = "/ifxwx_images/fog_overcast.png";
break;
case "Dense Fog": $col4wximg = "/ifxwx_images/fog_dense.png";
break;
case "Windy": $col4wximg = "/ifxwx_images/windy.png";
break;
case "Lunar Eclipse": $col4wximg = "/ifxwx_images/lunar_eclipse.png";
break;
case "Solar Eclipse": $col4wximg = "/ifxwx_images/solar_eclipse.png";
break;
default: $col4wximg = "/ifxwx_images/fog_dense.png";
}
// Column 5 Weather Icon
switch ($_SESSION["col5wx"]) {
case "Sunny": $col5wximg = "/ifxwx_images/sunny.png";
break;
case "Partly Sunny": $col5wximg = "/ifxwx_images/partly_cloudy_day.png";
break;
case "Mostly Cloudy": $col5wximg = "/ifxwx_images/overcast.png";
break;
case "Clear": $col5wximg = "/ifxwx_images/clear_night.png";
break;
case "Partly Cloudy": $col5wximg = "/ifxwx_images/partly_cloudy_night.png";
break;
case "Overcast": $col5wximg = "/ifxwx_images/overcast.png";
break;
case "Isolated Rain Showers": $col5wximg = "/ifxwx_images/showers_isolated.png";
break;
case "Scattered Rain Showers": $col5wximg = "/ifxwx_images/showers_scattered.png";
break;
case "Rain": $col5wximg = "/ifxwx_images/rain.png";
break;
case "Heavy Rain": $col5wximg = "/ifxwx_images/rain_heavy.png";
break;
case "Rain and Fog": $col5wximg = "/ifxwx_images/showers_haze.png";
break;
case "Isolated T-Storms": $col5wximg = "/ifxwx_images/tstorms_isolated.png";
break;
case "Scattered T-Storms": $col5wximg = "/ifxwx_images/tstorms_scattered.png";
break;
case "Thunderstorms": $col5wximg = "/ifxwx_images/tstorms_rain.png";
break;
case "Severe T-Storms": $col5wximg = "/ifxwx_images/tstorms_severe.png";
break;
case "Snow Flurries": $col5wximg = "/ifxwx_images/snow_flurries.png";
break;
case "Scattered Snow Showers": $col5wximg = "/ifxwx_images/snow_scattered.png";
break;
case "Snow": $col5wximg = "/ifxwx_images/snow.png";
break;
case "Heavy Snow": $col5wximg = "/ifxwx_images/snow_heavy.png";
break;
case "Blizzard": $col5wximg = "/ifxwx_images/snow_blizzard.png";
break;
case "Blowing Snow": $col5wximg = "/ifxwx_images/blowing_snow.png";
break;
case "Rain/Snow": $col5wximg = "/ifxwx_images/rain_snow.png";
break;
case "Freezing Rain/Snow": $col5wximg = "/ifxwx_images/freezing_rain_snow.png";
break;
case "Freezing Rain/Rain": $col5wximg = "/ifxwx_images/freezing_rain.png";
break;
case "Freezing Rain/Sleet": $col5wximg = "/ifxwx_images/freezing_rain_sleet.png";
break;
case "Rain/Sleet": $col5wximg = "/ifxwx_images/rain_sleet.png";
break;
case "Sleet": $col5wximg = "/ifxwx_images/sleet.png";
break;
case "Overcast/Haze": $col5wximg = "/ifxwx_images/overcast_haze.png";
break;
case "Haze": $col5wximg = "/ifxwx_images/haze_day_night.png";
break;
case "Sunny/Fog": $col5wximg = "/ifxwx_images/fog_day.png";
break;
case "Morning Fog": $col5wximg = "/ifxwx_images/fog_morning.png";
break;
case "Overnight Fog": $col5wximg = "/ifxwx_images/fog_night.png";
break;
case "Cloudy/Fog": $col5wximg = "/ifxwx_images/fog_overcast.png";
break;
case "Dense Fog": $col5wximg = "/ifxwx_images/fog_dense.png";
break;
case "Windy": $col5wximg = "/ifxwx_images/windy.png";
break;
case "Lunar Eclipse": $col5wximg = "/ifxwx_images/lunar_eclipse.png";
break;
case "Solar Eclipse": $col5wximg = "/ifxwx_images/solar_eclipse.png";
break;
default: $col5wximg = "/ifxwx_images/fog_dense.png";
}
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
<link rel="icon" type="image/png" href="/images/favicon.png">
</head>
<body>
<div class="container">
<div class="twelve columns" style="font-weight: bold; text-align: center">
<p><big style="font-family: Helvetica,Arial,sans-serif;"><big><big><span><img style="width: 70px; height: 61px;" alt="" src="/ifxwx_images/logo.png"><br>iFx
Weather Preview</span></big></big></big>
Version 0.15.1 pre-alpha</p>
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
		<strong><big><big><?php echo "<p style='color:" . $tempcolor2 . "'>" . $_SESSION["col1temp"] . $tempunit . " </p>" 
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
		<strong><big><big><?php echo "<p style='color:" . $tempcolor . "'>" . $_SESSION["col2temp"] . $tempunit . " </p>" 
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
		<strong><big><big><?php echo "<p style='color:" . $tempcolor . "'>" . $_SESSION["col4temp"] . $tempunit . " </p>" 
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
		<div class="twelve columns">
				<hr>
			</div>
	<div class="three columns">
		<form action="/preview.php" method="POST">
			<input name="Edit" id="Edit" value="Edit" type="submit">
		</form></div>
<div class="three columns offset-by-six">
<form action="/publish.php">
	<input name="Publish" id="Publish" value="Publish" type="submit">
	</form></div>
</div>
	
</div>
</body></html>