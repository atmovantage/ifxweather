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

// Global Variables
$fieldErr2 ="**All fields highlighted in red must be filled in before submitting your forecast**";
$proceed = false;
$logic = false;
$snowlogic = $windlogic = $gustlogic= "";
$logicnotice = "" ;

// Global field error varibles
$fieldErr1 = $fieldErr3 = $fieldErr4 = $fieldErr5 = $fieldErr6 = $fieldErr7 = $fieldErr8 = $fieldErr9 = $fieldErr10 =  "#FFF";

// Column 1 variables

	// Field Error variables are set white as default but will turn red if the specified field is left blank after user submits the form
	$fieldErr11 = $fieldErr12 = $fieldErr13 = $fieldErr14 = "#FFF";
	
	// Logic Error variables are set to white as default but will turn blue if the specified fields do not pass the logic check
	$logicErr1 = $logicErr2 = $logicErr3 = "FFF" ;

// Column 2 variables

	// Field Error variables are set white as default but will turn red if the specified field is left blank after user submits the form
	$col2fieldErr1 = $col2fieldErr3 = $col2fieldErr4 = $col2fieldErr5 = $col2fieldErr6 = $col2fieldErr7 = $col2fieldErr8 = $col2fieldErr9 = $col2fieldErr10 = $col2fieldErr11 = $col2fieldErr12 = $col2fieldErr13 = $col2fieldErr14 = "#FFF";
	
	// Logic Error variables are set to white as default but will turn blue if the specified fields do not pass the logic check
	$col2logicErr1 = $col2logicErr2 = $col2logicErr3 = "FFF" ;

//
//
// Validation of required variables
if ($_SERVER["REQUEST_METHOD"] == "POST" && $proceed == false) {
	
	//Check to see if any of the required fields are blank or set at the default values
	if (empty($_POST["forecaster"]) || empty($_POST["stationname"]) || empty($_POST["date"])|| empty($_POST["time"]) || empty($_POST["fxstartmonth"]) || $_POST["fxstartmonth"] == "Select Month" || empty($_POST["fxstartday"]) || $_POST["fxstartday"] == "Select Day" || empty($_POST["fxstartyear"]) || $_POST["fxstartyear"] == "Select Year" || empty($_POST["fxstarttime"]) || $_POST["fxstarttime"] == "Select Time" || empty($_POST["col1"]) || $_POST["col1wx"] == "Weather" || empty($_POST["col1desc"]) || empty($_POST["col1temp"]) || empty($_POST["col2"]) || $_POST["col2wx"] == "Weather" || empty($_POST["col2desc"]) || empty($_POST["col2temp"])) {
		//if any required variables are empty then do not proceed to preview page
		$proceed = false;
	}
	else {
		//if all required variables are filled in properly then proceed to preview page
		$proceed = true;
	}
}

		//if proceed has been set to false after hitting submit then turn any empty required fields red
if ($_SERVER["REQUEST_METHOD"] == "POST" && $proceed == false) {
	// Global variables
	if (empty($_POST["forecaster"])) {
		$fieldErr3 = "#FF8080";
	}
	if (empty($_POST["stationname"])) {
		$fieldErr4 = "#FF8080";
	}
	if (empty($_POST["date"])) {
		$fieldErr5 = "#FF8080";
	}
	if (empty($_POST["time"])) {
		$fieldErr6 = "#FF8080";
	}
	if ($_POST["fxstartmonth"] == "Select Month" || empty($_POST["fxstartmonth"])) {
		$fieldErr7 = "#FF8080";
	}
	if ($_POST["fxstartday"] == "Select Day" || empty($_POST["fxstartday"])) {
		$fieldErr8 = "#FF8080";
	}
	if ($_POST["fxstartyear"] == "Select Year" || empty($_POST["fxstartyear"])) {
		$fieldErr9 = "#FF8080";
	}
	if ($_POST["fxstarttime"] == "Select Time" || empty($_POST["fxstarttime"])) {
		$fieldErr10 = "#FF8080";
	}
	// Column 1 variables
	if (empty($_POST["col1"])) {
		$fieldErr11 = "#FF8080";
	}
	if ($_POST["col1wx"] == "Weather") {
		$fieldErr12 = "#FF8080";
	}
	if (empty($_POST["col1desc"])) {
		$fieldErr13 = "#FF8080";
	}
	if (empty($_POST["col1temp"])) {
		$fieldErr14 = "#FF8080";
	}
	// Column 2 variables
	if (empty($_POST["col2"])) {
		$col2fieldErr11 = "#FF8080";
	}
	if ($_POST["col2wx"] == "Weather") {
		$col2fieldErr12 = "#FF8080";
	}
	if (empty($_POST["col2desc"])) {
		$col2fieldErr13 = "#FF8080";
	}
	if (empty($_POST["col2temp"])) {
		$col2fieldErr14 = "#FF8080";
	}
}

// Logic check - test certain variables to make sure they make logical sense before proceeding
if ($_SERVER["REQUEST_METHOD"] == "POST" && $logic == false) {
	
	// Column 1 logic check
	if ($_POST["col1snowmin"] > $_POST["col1snowmax"]) {
		$snowlogic = "Minimum snow accumulation cannot be larger than maximum snow accumulation. <br>";
		$logic = false;
		$logicErr1 = "#2681FF";
	}

	if ($_POST["col1windmin"] > $_POST["col1windmax"]) {
		$windlogic = "Minimum sustained wind cannot be larger than maximum sustained wind. <br>";
		$logic = false;
		$logicErr2 = "#2681FF";
	}

	if ($_POST["col1windmax"] >= $_POST["col1windgust"] && $_POST["col1windgust"] != "") {
		$gustlogic = "Maximum sustained wind cannot be larger than or equal to wind gusts. <br>";
		$logic = false;
		$logicErr3 = "#2681FF";
	}
	
	// Column 2 logic check
	if ($_POST["col2snowmin"] > $_POST["col2snowmax"]) {
		$snowlogic = "Minimum snow accumulation cannot be larger than maximum snow accumulation. <br>";
		$logic = false;
		$col2logicErr1 = "#2681FF";
	}

	if ($_POST["col2windmin"] > $_POST["col2windmax"]) {
		$windlogic = "Minimum sustained wind cannot be larger than maximum sustained wind. <br>";
		$logic = false;
		$col2logicErr2 = "#2681FF";
	}

	if ($_POST["col2windmax"] >= $_POST["col2windgust"] && $_POST["col2windgust"] != "") {
		$gustlogic = "Maximum sustained wind cannot be larger than or equal to wind gusts. <br>";
		$logic = false;
		$col2logicErr3 = "#2681FF";
	}
}

	// After completing the logic check for all columns test to see if the form passes the logic check
if ($_SERVER["REQUEST_METHOD"] == "POST" && $snowlogic == "" && $windlogic == "" && $gustlogic == ""){
	// If all the variables pass the logic check then we can proceed to preview page
	$logicnotice = "";
	$logic = true;
}
else {
	// If any of the variables in any column fails the logic test then the following notice is displayed at the top of the page
		$logicnotice = "<big><strong>The following items failed the logic check (highlighted in blue):</strong></big><br>";
}

//
//
//if the form has been submitted and the required fields are filled in properly then we can proceed to submit all variables
if ($_SERVER["REQUEST_METHOD"] == "POST" && $proceed == true && $logic == true) {
submit_input();	
}
//
//
//submit all variables to preview page
function submit_input() {
	// Meta data variables
	$_SESSION["forecaster"] = $_POST["forecaster"];
	$_SESSION["stationid"] = $_POST["stationid"];
	$_SESSION["stationname"] = $_POST["stationname"];
	$_SESSION["date"] = $_POST["date"];
	$_SESSION["time"] = $_POST["time"];
	$_SESSION["fxstarttime"] = $_POST["fxstarttime"];
	$_SESSION["fxstartmonth"] = $_POST["fxstartmonth"];
	$_SESSION["fxstartday"] = $_POST["fxstartday"];
	$_SESSION["fxstartyear"] = $_POST["fxstartyear"];
	$_SESSION["tempunit"] = $_POST["tempunit"];
	$_SESSION["colortemp"] = $_POST["colortemp"];
	$_SESSION["windunit"] = $_POST["windunit"];
	
	$_SESSION["fxvalidname"] = $_POST["fxvalidname"];
	
	
	// Column 1 Forecast Period Variables
	$_SESSION["col1label"] = $_POST["col1label"];
	$_SESSION["col1wx"] = $_POST["col1wx"];
	$_SESSION["col1"] = $_POST["col1"];
	$_SESSION["col1highlow"] = $_POST["col1highlow"];
	$_SESSION["precipunit"] = $_POST["precipunit"];
	$_SESSION["col1pop"] = $_POST["col1pop"];
	$_SESSION["col1desc"] = $_POST["col1desc"];
	$_SESSION["col1temp"] = $_POST["col1temp"];
	$_SESSION["col1precip"] = $_POST["col1precip"];
	$_SESSION["col1showrain"] = $_POST["col1showrain"];
	$_SESSION["col1snowmin"] = $_POST["col1snowmin"];
	$_SESSION["col1snowmax"] = $_POST["col1snowmax"];
	$_SESSION["col1windmin"] = $_POST["col1windmin"];
	$_SESSION["col1windmax"] = $_POST["col1windmax"];
	$_SESSION["col1winddir"] = $_POST["col1winddir"];
	$_SESSION["col1showwind"] = $_POST["col1showwind"];
	$_SESSION["col1windgust"] = $_POST["col1windgust"];
	$_SESSION["col1detail"] = $_POST["col1detail"];
	
	// Column 2 Forecast Period Variables
	$_SESSION["col2label"] = $_POST["col2label"];
	$_SESSION["col2wx"] = $_POST["col2wx"];
	$_SESSION["col2"] = $_POST["col2"];
	$_SESSION["col2highlow"] = $_POST["col2highlow"];
	$_SESSION["precipunit"] = $_POST["precipunit"];
	$_SESSION["col2pop"] = $_POST["col2pop"];
	$_SESSION["col2desc"] = $_POST["col2desc"];
	$_SESSION["col2temp"] = $_POST["col2temp"];
	$_SESSION["col2precip"] = $_POST["col2precip"];
	$_SESSION["col2showrain"] = $_POST["col2showrain"];
	$_SESSION["col2snowmin"] = $_POST["col2snowmin"];
	$_SESSION["col2snowmax"] = $_POST["col2snowmax"];
	$_SESSION["col2windmin"] = $_POST["col2windmin"];
	$_SESSION["col2windmax"] = $_POST["col2windmax"];
	$_SESSION["col2winddir"] = $_POST["col2winddir"];
	$_SESSION["col2showwind"] = $_POST["col2showwind"];
	$_SESSION["col2windgust"] = $_POST["col2windgust"];
	$_SESSION["col2detail"] = $_POST["col2detail"];
	
	//Submit to the preview page
	header('Location: /preview.php');
	exit();
}

//Get the date and time and set as variables
date_default_timezone_set("America/New_York");
$month = date("m");
$day = date("d");
$year = date("Y");
$dayofweek = date("l");
$hour = date("h");
$minutes = date("i");
$am_pm = date("a");

//Convert the numerical month into the name of the month for displaying to the user
switch ($month) {
	case "01": $monthname = "January";
	break;
	case "02": $monthname = "February";
	break;
	case "03": $monthname = "March";
	break;
	case "04": $monthname = "April";
	break;
	case "05": $monthname = "May";
	break;
	case "06": $monthname = "June";
	break;
	case "07": $monthname = "July";
	break;
	case "08": $monthname = "August";
	break;
	case "09": $monthname = "September";
	break;
	case "10": $monthname = "October";
	break;
	case "11": $monthname = "November";
	break;
	case "12": $monthname = "December";
	break;
	default: $monthname = "Select Month";
}

// Determine the present time and when the first forecast period would be valid from
if ($hour < "05" && $am_pm == "am") {
	$fxvalid = "5AM";
	$col1string = date('l');
	$col2string = date('l') . " Night";
}
elseif ($hour < "06" && $am_pm == "am") {
	$fxvalid = "6AM";
	$col1string = date('l');
	$col2string = date('l') . " Night";
}
elseif ($hour < "07" && $am_pm == "am") {
	$fxvalid = "7AM";
	$col1string = date('l');
	$col2string = date('l') . " Night";
}
elseif ($hour < "08" && $am_pm == "am") {
	$fxvalid = "8AM";
	$col1string = date('l');
	$col2string = date('l') . " Night";
}
elseif ($hour >= "08" && $hour < "12" && $am_pm == "am") {
	$fxvalid = "5PM";
	$col1string = date('l') . " Night";
	$col2string = date('l', strtotime("+1 day"));
	//$col1string = date('l', strtotime("+1 day")) . " Night";
}
elseif ($hour == "12" && $am_pm == "am") {
	$fxvalid = "5AM";
	$col1string = date('l');
	$col2string = date('l') . " Night";
}
elseif ($hour < "05" && $am_pm == "pm") {
	$fxvalid = "5PM";
	$col1string = date('l') . " Night";
	$col2string = date('l', strtotime("+1 day"));
}
elseif ($hour < "06" && $am_pm == "pm") {
	$fxvalid = "6PM";
	$col1string = date('l') . " Night";
	$col2string = date('l', strtotime("+1 day"));
}
elseif ($hour < "07" && $am_pm == "pm") {
	$fxvalid = "7PM";
	$col1string = date('l') . " Night";
	$col2string = date('l', strtotime("+1 day"));
}
elseif ($hour < "08" && $am_pm == "pm") {
	$fxvalid = "8PM";
	$col1string = date('l') . " Night";
	$col2string = date('l', strtotime("+1 day"));
}
elseif ($hour >= "08" && $hour < "12" && $am_pm == "pm") {
	$fxvalid = "5AM";
	$col1string = date('l');
	$col2string = date('l') . " Night";
}
elseif ($hour == "12" && $am_pm == "pm") {
	$fxvalid = "5PM";
	$col1string = date('l') . " Night";
	$col2string = date('l', strtotime("+1 day"));
}
else {
	$fxvalid = "Select Time";
	$col1string = date('l');
	$col2string = date('l') . " Night";
}
// Convert the start time from the numerical value into a logical string for user to understand the duration of the forecast period
switch ($fxvalid) {
	case "5AM": $fxvalidname = $col1label = "5am - 5pm";
	$col2label = "5pm - 5am";
	break;
	case "6AM": $fxvalidname = $col1label = "6am - 6pm";
	$col2label = "6pm - 6am";
	break;
	case "7AM": $fxvalidname = $col1label = "7am - 7pm";
	$col2label = "7pm - 7am";
	break;
	case "8AM": $fxvalidname = $col1label = "8am - 8pm";
	$col2label = "8pm - 8am";
	break;
	case "5PM": $fxvalidname = $col1label = "5pm - 5am";
	$col2label = "5am - 5pm";
	break;
	case "6PM": $fxvalidname = $col1label = "6pm - 6am";
	$col2label = "6am - 6pm";
	break;
	case "7PM": $fxvalidname = $col1label = "7pm - 7am";
	$col2label = "7am - 7pm";
	break;
	case "8PM": $fxvalidname = $col1label = "8pm - 8am";
	$col2label = "8am - 8pm";
	break;
	default: $fxvalidname = "Select Time";
	$col1label = "0-12hr";
	$col2label = "12-24hr";
	break;
}

//Checkbox values
$checked = "checked";
$unchecked = "";

//Column 1 check for pre-existing user selection for High/Low
if (!empty($_POST["col1highlow"]) && $_POST["col1highlow"] == "red") {
	$highcheck = "checked";
	$lowcheck = "";
}

elseif (!empty($_SESSION["col1highlow"]) && $_SESSION["col1highlow"] == "red") 
{
	$highcheck = "checked";
	$lowcheck = "";
} 

elseif (($fxvalid == '5AM' || $fxvalid == '6AM' || $fxvalid == '7AM' || $fxvalid == '8AM') && empty($_SESSION["col1highlow"]) && empty($_POST["col1highlow"])) {
	$highcheck = "checked";
	$lowcheck = "";
}

elseif (!empty($_POST["col1highlow"]) && $_POST["col1highlow"] == "blue") {
	$lowcheck = "checked";
	$highcheck = "";
}

elseif (!empty($_SESSION["col1highlow"]) && $_SESSION["col1highlow"] == "blue") 
{
	$lowcheck = "checked";
	$highcheck = "";
} 

elseif (($fxvalid == '5PM' || $fxvalid == '6PM' || $fxvalid == '7PM' || $fxvalid == '8PM') && empty($_SESSION["col1highlow"]) && empty($_POST["col1highlow"])) {
	$lowcheck = "checked";
	$highcheck = "";
						   }
else {
	$lowcheck = "";
	$highcheck = "checked";
	 }

// Column 2 check for pre-existing user selection for High/Low
if (!empty($_POST["col2highlow"]) && $_POST["col2highlow"] == "red") {
	$col2highcheck = "checked";
	$col2lowcheck = "";
}

elseif (!empty($_SESSION["col2highlow"]) && $_SESSION["col2highlow"] == "red") 
{
	$col2highcheck = "checked";
	$col2lowcheck = "";
} 

elseif (($fxvalid == '5AM' || $fxvalid == '6AM' || $fxvalid == '7AM' || $fxvalid == '8AM') && empty($_SESSION["col2highlow"]) && empty($_POST["col2highlow"])) {
	$col2highcheck = "";
	$col2lowcheck = "checked";
}

elseif (!empty($_POST["col2highlow"]) && $_POST["col2highlow"] == "blue") {
	$col2lowcheck = "checked";
	$col2highcheck = "";
}

elseif (!empty($_SESSION["col2highlow"]) && $_SESSION["col2highlow"] == "blue") 
{
	$col2lowcheck = "checked";
	$col2highcheck = "";
} 

elseif (($fxvalid == '5PM' || $fxvalid == '6PM' || $fxvalid == '7PM' || $fxvalid == '8PM') && empty($_SESSION["col2highlow"]) && empty($_POST["col2highlow"])) {
	$col2lowcheck = "";
	$col2highcheck = "checked";
						   }
else {
	$col2lowcheck = "checked";
	$col2highcheck = "";
	 }
//
//Check for pre-existing user selection for temperature units
if (!empty($_POST["tempunit"]) && $_POST["tempunit"] == "fahrenheit") {
	$tempf = "checked";
	$tempc = "";
}

elseif (!empty($_SESSION["tempunit"]) && $_SESSION["tempunit"] == "fahrenheit") 
{
	$tempf = "checked";
	$tempc = "";
} 

elseif (!empty($_POST["tempunit"]) && $_POST["tempunit"] == "celsius") {
	$tempf = "";
	$tempc = "checked";
}

elseif (!empty($_SESSION["tempunit"]) && $_SESSION["tempunit"] == "celsius") {

	$tempf = "";
	$tempc = "checked";
} 

else {
	$tempf = "checked";
	$tempc = "";
	 }

//Check for pre-existing user selection for precipitation units
if (!empty($_POST["precipunit"]) && $_POST["precipunit"] == "in.") {
	$precipin = "checked";
	$precipmm = "";
}

elseif (!empty($_SESSION["precipunit"]) && $_SESSION["precipunit"] == "in.") 
{
	$precipin = "checked";
	$precipmm = "";
} 

elseif (!empty($_POST["precipunit"]) && $_POST["precipunit"] == "mm") {
	$precipin = "";
	$precipmm = "checked";
}

elseif (!empty($_SESSION["precipunit"]) && $_SESSION["precipunit"] == "mm") {

	$precipin = "";
	$precipmm = "checked";
} 

else {
	$precipin = "checked";
	$precipmm = "";
	 }

//Check for pre-existing user selection for colorization of temperature 
if (!empty($_POST["colortemp"]) && $_POST["colortemp"] == "no") {
	$colorno = "checked";
	$coloryes = "";
}

elseif (!empty($_SESSION["colortemp"]) && $_SESSION["colortemp"] == "no") 
{
	$colorno = "checked";
	$coloryes = "";
} 

elseif (!empty($_POST["colortemp"]) && $_POST["colortemp"] == "yes") {
	$colorno = "";
	$coloryes = "checked";
}

elseif (!empty($_SESSION["colortemp"]) && $_SESSION["colortemp"] == "yes") {

	$colorno = "";
	$coloryes = "checked";
} 

else {
	$colorno = "checked";
	$coloryes = "";
	 }

// Column 1 weather icons
	// For POST (form validation) check for pre-selected weather in column 1 and set the icon to match, otherwise default icon will show
if (isset($_POST['col1wx'])) {
	switch ($_POST["col1wx"]) {
case "Sunny": $col1wximg= "/ifxwx_images/sunny.png";
break;
case "Partly Sunny": $col1wximg= "/ifxwx_images/partly_cloudy_day.png";
break;
case "Mostly Cloudy": $col1wximg= "/ifxwx_images/overcast.png";
break;
case "Clear": $col1wximg= "/ifxwx_images/clear_night.png";
break;
case "Partly Cloudy": $col1wximg= "/ifxwx_images/partly_cloudy_night.png";
break;
case "Overcast": $col1wximg= "/ifxwx_images/overcast.png";
break;
case "Isolated Rain Showers": $col1wximg= "/ifxwx_images/showers_isolated.png";
break;
case "Scattered Rain Showers": $col1wximg= "/ifxwx_images/showers_scattered.png";
break;
case "Rain": $col1wximg= "/ifxwx_images/rain.png";
break;
case "Heavy Rain": $col1wximg= "/ifxwx_images/rain_heavy.png";
break;
case "Rain and Fog": $col1wximg= "/ifxwx_images/showers_haze.png";
break;
case "Isolated T-Storms": $col1wximg= "/ifxwx_images/tstorms_isolated.png";
break;
case "Scattered T-Storms": $col1wximg= "/ifxwx_images/tstorms_scattered.png";
break;
case "Thunderstorms": $col1wximg= "/ifxwx_images/tstorms_rain.png";
break;
case "Severe T-Storms": $col1wximg= "/ifxwx_images/tstorms_severe.png";
break;
case "Snow Flurries": $col1wximg= "/ifxwx_images/snow_flurries.png";
break;
case "Scattered Snow Showers": $col1wximg= "/ifxwx_images/snow_scattered.png";
break;
case "Snow": $col1wximg= "/ifxwx_images/snow.png";
break;
case "Heavy Snow": $col1wximg= "/ifxwx_images/snow_heavy.png";
break;
case "Blizzard": $col1wximg= "/ifxwx_images/snow_blizzard.png";
break;
case "Blowing Snow": $col1wximg= "/ifxwx_images/blowing_snow.png";
break;
case "Rain/Snow": $col1wximg= "/ifxwx_images/rain_snow.png";
break;
case "Freezing Rain/Snow": $col1wximg= "/ifxwx_images/freezing_rain_snow.png";
break;
case "Freezing Rain/Rain": $col1wximg= "/ifxwx_images/freezing_rain.png";
break;
case "Freezing Rain/Sleet": $col1wximg= "/ifxwx_images/freezing_rain_sleet.png";
break;
case "Rain/Sleet": $col1wximg= "/ifxwx_images/rain_sleet.png";
break;
case "Sleet": $col1wximg= "/ifxwx_images/sleet.png";
break;
case "Overcast/Haze": $col1wximg= "/ifxwx_images/overcast_haze.png";
break;
case "Haze": $col1wximg= "/ifxwx_images/haze_day_night.png";
break;
case "Sunny/Fog": $col1wximg= "/ifxwx_images/fog_day.png";
break;
case "Morning Fog": $col1wximg= "/ifxwx_images/fog_morning.png";
break;
case "Overnight Fog": $col1wximg= "/ifxwx_images/fog_night.png";
break;
case "Cloudy/Fog": $col1wximg= "/ifxwx_images/fog_overcast.png";
break;
case "Dense Fog": $col1wximg= "/ifxwx_images/fog_dense.png";
break;
case "Windy": $col1wximg= "/ifxwx_images/windy.png";
break;
case "Lunar Eclipse": $col1wximg= "/ifxwx_images/lunar_eclipse.png";
break;
case "Solar Eclipse": $col1wximg= "/ifxwx_images/solar_eclipse.png";
break;
default: $col1wximg= "/ifxwx_images/select.png";
}
	// For SESSION (form editing) check for pre-selected weather in column 1 and set the icon to match, otherwise default icon will show
} 
elseif (isset($_SESSION['col1wx'])) {
	switch ($_SESSION["col1wx"]) {
case "Sunny": $col1wximg= "/ifxwx_images/sunny.png";
break;
case "Partly Sunny": $col1wximg= "/ifxwx_images/partly_cloudy_day.png";
break;
case "Mostly Cloudy": $col1wximg= "/ifxwx_images/overcast.png";
break;
case "Clear": $col1wximg= "/ifxwx_images/clear_night.png";
break;
case "Partly Cloudy": $col1wximg= "/ifxwx_images/partly_cloudy_night.png";
break;
case "Overcast": $col1wximg= "/ifxwx_images/overcast.png";
break;
case "Isolated Rain Showers": $col1wximg= "/ifxwx_images/showers_isolated.png";
break;
case "Scattered Rain Showers": $col1wximg= "/ifxwx_images/showers_scattered.png";
break;
case "Rain": $col1wximg= "/ifxwx_images/rain.png";
break;
case "Heavy Rain": $col1wximg= "/ifxwx_images/rain_heavy.png";
break;
case "Rain and Fog": $col1wximg= "/ifxwx_images/showers_haze.png";
break;
case "Isolated T-Storms": $col1wximg= "/ifxwx_images/tstorms_isolated.png";
break;
case "Scattered T-Storms": $col1wximg= "/ifxwx_images/tstorms_scattered.png";
break;
case "Thunderstorms": $col1wximg= "/ifxwx_images/tstorms_rain.png";
break;
case "Severe T-Storms": $col1wximg= "/ifxwx_images/tstorms_severe.png";
break;
case "Snow Flurries": $col1wximg= "/ifxwx_images/snow_flurries.png";
break;
case "Scattered Snow Showers": $col1wximg= "/ifxwx_images/snow_scattered.png";
break;
case "Snow": $col1wximg= "/ifxwx_images/snow.png";
break;
case "Heavy Snow": $col1wximg= "/ifxwx_images/snow_heavy.png";
break;
case "Blizzard": $col1wximg= "/ifxwx_images/snow_blizzard.png";
break;
case "Blowing Snow": $col1wximg= "/ifxwx_images/blowing_snow.png";
break;
case "Rain/Snow": $col1wximg= "/ifxwx_images/rain_snow.png";
break;
case "Freezing Rain/Snow": $col1wximg= "/ifxwx_images/freezing_rain_snow.png";
break;
case "Freezing Rain/Rain": $col1wximg= "/ifxwx_images/freezing_rain.png";
break;
case "Freezing Rain/Sleet": $col1wximg= "/ifxwx_images/freezing_rain_sleet.png";
break;
case "Rain/Sleet": $col1wximg= "/ifxwx_images/rain_sleet.png";
break;
case "Sleet": $col1wximg= "/ifxwx_images/sleet.png";
break;
case "Overcast/Haze": $col1wximg= "/ifxwx_images/overcast_haze.png";
break;
case "Haze": $col1wximg= "/ifxwx_images/haze_day_night.png";
break;
case "Sunny/Fog": $col1wximg= "/ifxwx_images/fog_day.png";
break;
case "Morning Fog": $col1wximg= "/ifxwx_images/fog_morning.png";
break;
case "Overnight Fog": $col1wximg= "/ifxwx_images/fog_night.png";
break;
case "Cloudy/Fog": $col1wximg= "/ifxwx_images/fog_overcast.png";
break;
case "Dense Fog": $col1wximg= "/ifxwx_images/fog_dense.png";
break;
case "Windy": $col1wximg= "/ifxwx_images/windy.png";
break;
case "Lunar Eclipse": $col1wximg= "/ifxwx_images/lunar_eclipse.png";
break;
case "Solar Eclipse": $col1wximg= "/ifxwx_images/solar_eclipse.png";
break;
default: $col1wximg= "/ifxwx_images/select.png";
}
}

// Column 2 weather icons
	// For POST (form validation) check for pre-selected weather in column 2 and set the icon to match, otherwise default icon will show
if (isset($_POST['col2wx'])) {
	switch ($_POST["col2wx"]) {
case "Sunny": $col2wximg= "/ifxwx_images/sunny.png";
break;
case "Partly Sunny": $col2wximg= "/ifxwx_images/partly_cloudy_day.png";
break;
case "Mostly Cloudy": $col2wximg= "/ifxwx_images/overcast.png";
break;
case "Clear": $col2wximg= "/ifxwx_images/clear_night.png";
break;
case "Partly Cloudy": $col2wximg= "/ifxwx_images/partly_cloudy_night.png";
break;
case "Overcast": $col2wximg= "/ifxwx_images/overcast.png";
break;
case "Isolated Rain Showers": $col2wximg= "/ifxwx_images/showers_isolated.png";
break;
case "Scattered Rain Showers": $col2wximg= "/ifxwx_images/showers_scattered.png";
break;
case "Rain": $col2wximg= "/ifxwx_images/rain.png";
break;
case "Heavy Rain": $col2wximg= "/ifxwx_images/rain_heavy.png";
break;
case "Rain and Fog": $col2wximg= "/ifxwx_images/showers_haze.png";
break;
case "Isolated T-Storms": $col2wximg= "/ifxwx_images/tstorms_isolated.png";
break;
case "Scattered T-Storms": $col2wximg= "/ifxwx_images/tstorms_scattered.png";
break;
case "Thunderstorms": $col2wximg= "/ifxwx_images/tstorms_rain.png";
break;
case "Severe T-Storms": $col2wximg= "/ifxwx_images/tstorms_severe.png";
break;
case "Snow Flurries": $col2wximg= "/ifxwx_images/snow_flurries.png";
break;
case "Scattered Snow Showers": $col2wximg= "/ifxwx_images/snow_scattered.png";
break;
case "Snow": $col2wximg= "/ifxwx_images/snow.png";
break;
case "Heavy Snow": $col2wximg= "/ifxwx_images/snow_heavy.png";
break;
case "Blizzard": $col2wximg= "/ifxwx_images/snow_blizzard.png";
break;
case "Blowing Snow": $col2wximg= "/ifxwx_images/blowing_snow.png";
break;
case "Rain/Snow": $col2wximg= "/ifxwx_images/rain_snow.png";
break;
case "Freezing Rain/Snow": $col2wximg= "/ifxwx_images/freezing_rain_snow.png";
break;
case "Freezing Rain/Rain": $col2wximg= "/ifxwx_images/freezing_rain.png";
break;
case "Freezing Rain/Sleet": $col2wximg= "/ifxwx_images/freezing_rain_sleet.png";
break;
case "Rain/Sleet": $col2wximg= "/ifxwx_images/rain_sleet.png";
break;
case "Sleet": $col2wximg= "/ifxwx_images/sleet.png";
break;
case "Overcast/Haze": $col2wximg= "/ifxwx_images/overcast_haze.png";
break;
case "Haze": $col2wximg= "/ifxwx_images/haze_day_night.png";
break;
case "Sunny/Fog": $col2wximg= "/ifxwx_images/fog_day.png";
break;
case "Morning Fog": $col2wximg= "/ifxwx_images/fog_morning.png";
break;
case "Overnight Fog": $col2wximg= "/ifxwx_images/fog_night.png";
break;
case "Cloudy/Fog": $col2wximg= "/ifxwx_images/fog_overcast.png";
break;
case "Dense Fog": $col2wximg= "/ifxwx_images/fog_dense.png";
break;
case "Windy": $col2wximg= "/ifxwx_images/windy.png";
break;
case "Lunar Eclipse": $col2wximg= "/ifxwx_images/lunar_eclipse.png";
break;
case "Solar Eclipse": $col2wximg= "/ifxwx_images/solar_eclipse.png";
break;
default: $col2wximg= "/ifxwx_images/select.png";
}
	// For SESSION (form editing) check for pre-selected weather in column 2 and set the icon to match, otherwise default icon will show
} 
elseif (isset($_SESSION['col2wx'])) {
	switch ($_SESSION["col2wx"]) {
case "Sunny": $col2wximg= "/ifxwx_images/sunny.png";
break;
case "Partly Sunny": $col2wximg= "/ifxwx_images/partly_cloudy_day.png";
break;
case "Mostly Cloudy": $col2wximg= "/ifxwx_images/overcast.png";
break;
case "Clear": $col2wximg= "/ifxwx_images/clear_night.png";
break;
case "Partly Cloudy": $col2wximg= "/ifxwx_images/partly_cloudy_night.png";
break;
case "Overcast": $col2wximg= "/ifxwx_images/overcast.png";
break;
case "Isolated Rain Showers": $col2wximg= "/ifxwx_images/showers_isolated.png";
break;
case "Scattered Rain Showers": $col2wximg= "/ifxwx_images/showers_scattered.png";
break;
case "Rain": $col2wximg= "/ifxwx_images/rain.png";
break;
case "Heavy Rain": $col2wximg= "/ifxwx_images/rain_heavy.png";
break;
case "Rain and Fog": $col2wximg= "/ifxwx_images/showers_haze.png";
break;
case "Isolated T-Storms": $col2wximg= "/ifxwx_images/tstorms_isolated.png";
break;
case "Scattered T-Storms": $col2wximg= "/ifxwx_images/tstorms_scattered.png";
break;
case "Thunderstorms": $col2wximg= "/ifxwx_images/tstorms_rain.png";
break;
case "Severe T-Storms": $col2wximg= "/ifxwx_images/tstorms_severe.png";
break;
case "Snow Flurries": $col2wximg= "/ifxwx_images/snow_flurries.png";
break;
case "Scattered Snow Showers": $col2wximg= "/ifxwx_images/snow_scattered.png";
break;
case "Snow": $col2wximg= "/ifxwx_images/snow.png";
break;
case "Heavy Snow": $col2wximg= "/ifxwx_images/snow_heavy.png";
break;
case "Blizzard": $col2wximg= "/ifxwx_images/snow_blizzard.png";
break;
case "Blowing Snow": $col2wximg= "/ifxwx_images/blowing_snow.png";
break;
case "Rain/Snow": $col2wximg= "/ifxwx_images/rain_snow.png";
break;
case "Freezing Rain/Snow": $col2wximg= "/ifxwx_images/freezing_rain_snow.png";
break;
case "Freezing Rain/Rain": $col2wximg= "/ifxwx_images/freezing_rain.png";
break;
case "Freezing Rain/Sleet": $col2wximg= "/ifxwx_images/freezing_rain_sleet.png";
break;
case "Rain/Sleet": $col2wximg= "/ifxwx_images/rain_sleet.png";
break;
case "Sleet": $col2wximg= "/ifxwx_images/sleet.png";
break;
case "Overcast/Haze": $col2wximg= "/ifxwx_images/overcast_haze.png";
break;
case "Haze": $col2wximg= "/ifxwx_images/haze_day_night.png";
break;
case "Sunny/Fog": $col2wximg= "/ifxwx_images/fog_day.png";
break;
case "Morning Fog": $col2wximg= "/ifxwx_images/fog_morning.png";
break;
case "Overnight Fog": $col2wximg= "/ifxwx_images/fog_night.png";
break;
case "Cloudy/Fog": $col2wximg= "/ifxwx_images/fog_overcast.png";
break;
case "Dense Fog": $col2wximg= "/ifxwx_images/fog_dense.png";
break;
case "Windy": $col2wximg= "/ifxwx_images/windy.png";
break;
case "Lunar Eclipse": $col2wximg= "/ifxwx_images/lunar_eclipse.png";
break;
case "Solar Eclipse": $col2wximg= "/ifxwx_images/solar_eclipse.png";
break;
default: $col2wximg= "/ifxwx_images/select.png";
}
}
//
//
// That concludes the PHP code that must precede the HTML code
// Now below is the HTML markup (with inline PHP code and scripts, of course!)
// Begin HTML markup
//
//
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
	<meta content="text/html; charset=ISO-8859-1" http-equiv="content-type">
	<meta name="viewport" content="initial-scale=1.0">
	<title>iFxWx Forecast Composer</title>

	<style type="text/css">
		<link title="normalize" rel="stylesheet" href="css/normalize.css" type="text/css"> 
</style>
	
		
	<link title="skeleton" rel="stylesheet" href="css/skeleton.css" type="text/css">
		
	<link title="skeleton" rel="stylesheet" href="css/composer.css" type="text/css">
	
	<link rel="icon" type="image/png" href="ifxwx_images/favicon.png">
	
	<style type="text/css">
	
</style>
</head>
<body>
	<!-- When form is submitted via POST we pass all variables back through this same page in order to perform validation and verification -->
	<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
		
		<div class="wrapper">
			<img src="/ifxwx_images/background.jpg" id="bg" alt="">
			<div class="container">
			<div class="twelve columns" style="font-weight: bold; text-align: center" id="header">
<p><img style="width: 70px; height: 61px;" alt="" src="/ifxwx_images/logo.png"> Version 0.15.0 pre-alpha<br><big style="font-family: Helvetica,Arial,sans-serif;"><big><big>Forecast Composer</big></big></big>
</p>
			<div class="twelve columns" >
				Welcome to the forecast composer page. This is the first step towards creating your own weather forecast. Enter the variables for your weather forecast using the forms below and click the 'Submit' button to view your final product.<small><br>Labels denoted with an asterisk (*) indicate required variables.</small>
				<!-- If the form was submitted but proceed is set to false then display the error notice at top of the page.-->
				<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && $proceed == false) {
	echo "<br>" . "<div style='color:red'>" . $fieldErr2 . "</div>";
}
?>
				<!-- If the form was submitted but the logic check is set to false then display the error notice at top of the page -->
				<br><div style='color:blue'>
		<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && $logic == false) {
	echo $logicnotice ;
	echo $snowlogic ;
	echo $windlogic ;
	echo $gustlogic ;
	
}
?>		
				</div>
				</div>
				</div>
				<div class="twelve columns">
				<hr>
			</div>
				<!-- The Meta Forms section is for global variables that apply to the entire forecast -->
			<div class= "twelve columns" id="metaforms">
			<div style="text-align: center;" class="three columns offset-by-one">
				<p>
					<label for="forecaster">Your Name*</label>
					<br>
					<input style="background-color: <?php echo $fieldErr3 ?>" size="15" name="forecaster" id="forecaster" placeholder="Austin" type="text" value="<?php echo (isset($_POST['forecaster']))?$_POST['forecaster']:''; echo (isset($_SESSION['forecaster']))?$_SESSION['forecaster']:'';?>">
					<br>
				</p>
			</div>
				<div style="text-align: center;" class="three columns offset-by-one">
				<p>
					<label for="stationid">Station ID</label>
					<br>
					<input size="5" name="stationid" id="stationid" placeholder="KDXR" type="text" value="<?php echo (isset($_POST['stationid']))?$_POST['stationid']:''; echo (isset($_SESSION['stationid']))?$_SESSION['stationid']:'';?>">
					<br>
				</p>
			</div>
			<div style="text-align: center;" class="three columns offset-by-one">
				<p>
					<label for="stationname">Location Name*</label>
					<br>
					<input style="background-color: <?php echo $fieldErr4 ?>" size="15" name="stationname" id="stationname" placeholder="Danbury, CT" type="text" value="<?php echo (isset($_POST['stationname']))?$_POST['stationname']:''; echo (isset($_SESSION['stationname']))?$_SESSION['stationname']:'';?>">
					<br>
				</p>
			</div>
			<div style="text-align: center;" class="two columns">
				<p>
					<label for="date">Publish Date*</label>
					<br>
					<input style="background-color: <?php echo $fieldErr5 ?>" size="10" name="date" id="date" placeholder="10/08/2015" type="date" value="<?php if (isset($_POST['date'])) {echo $_POST['date'];} elseif (isset($_SESSION['date'])) {echo $_SESSION['date'];} else {echo $month . '/' . $day . '/' . $year;};?>">
					<br>
				</p>
				</div>
				<div style="text-align: center;" class="two columns">
				<p>
					<label for="time">Publish Time*</label>
					<br>
					<input style="background-color: <?php echo $fieldErr6 ?>" size="7" name="time" id="time" placeholder="12:00PM" type="time" value="<?php if (isset($_POST['time'])) {echo $_POST['time'];} elseif (isset($_SESSION['time'])) {echo $_SESSION['time'];} else {echo $hour . ':' . $minutes . $am_pm;;};?>">
					<br>
				</p>
			</div>
				<div style="text-align: center;" class="seven columns" id="fxvalid">
					<big><strong>Forecast Start (Valid From)</strong></big><br>
				<div style="text-align: center;" class="three columns">
				<p>
					<label for="fxstartmonth">Month*</label>
					<br>
					<select style="width:100%; background-color: <?php echo $fieldErr7 ?>" name="fxstartmonth">
						<option value="<?php if (isset($_POST['fxstartmonth'])) {echo $_POST['fxstartmonth'];} elseif (isset($_SESSION['fxstartmonth'])) {echo $_SESSION['fxstartmonth'];} else {echo $month;};?>"><?php if (isset($_POST['fxstartmonth'])) {echo $_POST['fxstartmonth'];} elseif (isset($_SESSION['fxstartmonth'])) {echo $_SESSION['fxstartmonth'];} else {echo $monthname;};?></option>
						<option value="01">January</option>
						<option value="02">February</option>
						<option value="03">March</option>
						<option value="04">April</option>
						<option value="05">May</option>
						<option value="06">June</option>
						<option value="07">July</option>
						<option value="08">August</option>
						<option value="09">September</option>
						<option value="10">October</option>
						<option value="11">November</option>
						<option value="12">December</option>
					</select>
					<br>
				</p>
			</div>
					<div style="text-align: center;" class="three columns">
				<p>
					<label for="fxstartday">Day*</label>
					<br>
					<select style="width:100%; background-color: <?php echo $fieldErr8 ?>" name="fxstartday">
						<option value="<?php if (isset($_POST['fxstartday'])) {echo $_POST['fxstartday'];} elseif (isset($_SESSION['fxstartday'])) {echo $_SESSION['fxstartday'];} else {echo $day;};?>"><?php if (isset($_POST['fxstartday'])) {echo $_POST['fxstartday'];} elseif (isset($_SESSION['fxstartday'])) {echo $_SESSION['fxstartday'];} else {echo $day;};?></option>
						<option value="01">01</option>
						<option value="02">02</option>
						<option value="03">03</option>
						<option value="04">04</option>
						<option value="05">05</option>
						<option value="06">06</option>
						<option value="07">07</option>
						<option value="08">08</option>
						<option value="09">09</option>
						<option value="10">10</option>
						<option value="11">11</option>
						<option value="12">12</option>
						<option value="13">13</option>
						<option value="14">14</option>
						<option value="15">15</option>
						<option value="16">16</option>
						<option value="17">17</option>
						<option value="18">18</option>
						<option value="19">19</option>
						<option value="20">20</option>
						<option value="21">21</option>
						<option value="22">22</option>
						<option value="23">23</option>
						<option value="24">24</option>
						<option value="25">25</option>
						<option value="26">26</option>
						<option value="27">27</option>
						<option value="28">28</option>
						<option value="29">29</option>
						<option value="30">30</option>
						<option value="31">31</option>
					</select>
					<br>
				</p>
			</div>
					<div style="text-align: center;" class="two columns">
				<p>
					<label for="fxstartyear">Year*</label>
					<br>
					<select style="width:100%; background-color: <?php echo $fieldErr9 ?>" name="fxstartyear">
						<option value="<?php if (isset($_POST['fxstartyear'])) {echo $_POST['fxstartyear'];} elseif (isset($_SESSION['fxstartyear'])) {echo $_SESSION['fxstartyear'];} else {echo $year;};?>"><?php if (isset($_POST['fxstartyear'])) {echo $_POST['fxstartyear'];} elseif (isset($_SESSION['fxstartyear'])) {echo $_SESSION['fxstartyear'];} else {echo $year;};?></option>
						<option value="2015">2015</option>
						<option value="2014">2014</option>
						<option value="2013">2013</option>
						<option value="2012">2012</option>
						<option value="2011">2011</option>
						<option value="2010">2010</option>
						<option value="2009">2009</option>
						<option value="2008">2008</option>
						<option value="2007">2007</option>
						<option value="2006">2006</option>
						<option value="2005">2005</option>
						<option value="2004">2004</option>
						<option value="2003">2003</option>
						<option value="2002">2002</option>
						<option value="2001">2001</option>
						<option value="2000">2000</option>
					</select>
					<br>
				</p>
			</div>
					<div style="text-align: center;" class="three columns">
				<p>
					<label for="fxstarttime">Local Time*</label>
					<br>
					<select style="width:100%; background-color: <?php echo $fieldErr10 ?>" name="fxstarttime" onchange="updateTitles(this.value)">
						<option value="<?php if (isset($_POST['fxstarttime'])) {echo $_POST['fxstarttime'];} elseif (isset($_SESSION['fxstarttime'])) {echo $_SESSION['fxstarttime'];} else {echo $fxvalidname;};?>"><?php if (isset($_POST['fxstarttime'])) {echo $_POST['fxstarttime'];} elseif (isset($_SESSION['fxstarttime'])) {echo $_SESSION['fxstarttime'];} else {echo $fxvalidname;};?></option>
						<optgroup label="Morning">
						<option value="5am - 5pm">5am - 5pm</option>
						<option value="6am - 6pm">6am - 6pm</option>
						<option value="7am - 7pm">7am - 7pm</option>
						<option value="8am - 8pm">8am - 8pm</option>
						</optgroup>
						<optgroup label="Evening">
						<option value="5pm - 5am">5pm - 5am</option>
						<option value="6pm - 6am">6pm - 6am</option>
						<option value="7pm - 7am">7pm - 7am</option>
						<option value="8pm - 8am">8pm - 8am</option>
						</optgroup>
					</select>
					<br>
				</p>
			</div>
			</div>
						</div>
			<div style="text-align: center;" class="twelve columns">
				<hr>
			</div>
				<!-- Here starts the individual columns for each forecast period-->
			<div >
				<!-- Column 1 variables -->
			<div class="two columns" style="text-align: center;" id="hr0-12">
				
				<p>
					<label id="col1title" for="col1label"><?php if (isset($_POST['fxstarttime'])) {echo $_POST['fxstarttime'];} elseif (isset($_SESSION['fxstarttime'])) {echo $_SESSION['fxstarttime'];} else {echo $fxvalidname;};?></label><br>
					<input style="width:90%; background-color: <?php echo $fieldErr11 ?>" name="col1" id="col1label" placeholder="Monday" type="text" value="<?php if (isset($_POST['col1'])) {echo $_POST['col1'];} elseif (isset($_SESSION['col1'])) {echo $_SESSION['col1'];} else {echo $col1string;};?>">*
					<br>
				</p>
				<p>
					<select style="width:90%; background-color: <?php echo $fieldErr12 ?>" name="col1wx" onchange="document.getElementById('col1desc').value=this.value; updatecol1wximg(this.value)">
						<option value="<?php if (isset($_POST['col1wx'])) {echo $_POST['col1wx'];} elseif (isset($_SESSION['col1wx'])) {echo $_SESSION['col1wx'];} else {echo 'Weather';};?>"><?php if (isset($_POST['col1wx'])) {echo $_POST['col1wx'];} elseif (isset($_SESSION['col1wx'])) {echo $_SESSION['col1wx'];} else {echo 'Weather';};?></option>
						<optgroup label="General Day">
						<option value="Sunny">Sunny</option>
						<option value="Partly Sunny">Partly Sunny</option>
						<option value="Mostly Cloudy">Mostly Cloudy</option>
							</optgroup>
						<optgroup label="General Night">
							<option value="Clear">Clear (Night)</option>
							<option value="Partly Cloudy">Partly Cloudy (Night)</option>
							<option value="Overcast">Overcast (Night)</option>
							</optgroup>
						<optgroup label="Rain"> 
							<option value="Isolated Rain Showers">Isolated Rain Showers</option>
							<option value="Scattered Rain Showers">Scattered Rain Showers</option>
							<option value="Rain">Rain</option>
							<option value="Heavy Rain">Heavy Rain</option>
							<option value="Rain and Fog">Rain and Fog</option>
							<option value="Isolated T-Storms">Isolated T-Storms</option>
							<option value="Scattered T-Storms">Scattered T-Storms</option>
							<option value="Thunderstorms">T-Storms</option>
							<option value="Severe T-Storms">Severe T-Storms</option>
							</optgroup>
						<optgroup label="Snow"> 
							<option value="Snow Flurries">Flurries</option>
							<option value="Scattered Snow Showers">Scattered Snow Showers</option>
							<option value="Snow">Snow</option>
							<option value="Heavy Snow">Heavy Snow</option>
							<option value="Blizzard">Blizzard</option>
							<option value="Blowing Snow">Blowing Snow</option>
							</optgroup>
						<optgroup label="Mixed Precip"> 
							<option value="Rain/Snow">Rain/Snow</option>
							<option value="Freezing Rain/Snow">Freezing Rain/Snow</option>
							<option value="Freezing Rain/Rain">Freezing Rain/Rain</option>
							<option value="Freezing Rain/Sleet">Freezing Rain/Sleet</option>
							<option value="Rain/Sleet">Rain/Sleet</option>
							<option value="Sleet">Sleet</option>
							</optgroup>
						<optgroup label="Miscellaneous"> 
							<option value="Haze">Haze</option>
							<option value="Overcast/Haze">Overcast/Haze</option>
							<option value="Sunny/Fog">Sunny w/ Fog</option>
							<option value="Cloudy/Fog">Cloudy w/ Fog</option>
							<option value="Morning Fog">Fog Early AM</option>
							<option value="Overnight Fog">Fog Overnight</option>
							<option value="Dense Fog">Dense Fog</option>
							<option value="Windy">Windy/Breezy</option>
							<option value="Lunar Eclipse">Lunar Eclipse</option>
							<option value="Solar Eclipse">Solar Eclipse</option>
							</optgroup>
					</select>*
					<br>
					<?php
if (isset($_POST['col1wx'])) {
	echo '<img src="' . $col1wximg . '" alt="Weather Icon Preview" style="width:70px;height:70px;" id="col1wximg" name="col1wximg">';
} 
elseif (isset($_SESSION['col1wx'])) {
	echo '<img src="' . $col1wximg . '" alt="Weather Icon Preview" style="width:70px;height:70px;" id="col1wximg" name="col1wximg">';
} 
else {
	echo '<img src="/ifxwx_images/select.png" alt="Weather Icon Preview" style="width:70px;height:70px;" id="col1wximg" name="col1wximg">';
	 }
?>
				</p>
				<p>
					<label for="col1desc">Weather Description*</label>
					<br>
					<input style="width:90%; background-color: <?php echo $fieldErr13 ?>" name="col1desc" placeholder="Mostly Sunny" id="col1desc" type="text" value="<?php if (isset($_POST['col1desc'])) {echo $_POST['col1desc'];} elseif (isset($_SESSION['col1desc'])) {echo $_SESSION['col1desc'];} else {echo '';};?>">
				
					</p>
			<p>
					<label for="col1temp">Temperature*</label>
					<br>
					<input style="width:90%; background-color: <?php echo $fieldErr14 ?>" placeholder="High/Low" min="-100" max="134" maxlength="3" name="col1temp" id="col1temp" type="number" value="<?php if (isset($_POST['col1temp'])) {echo $_POST['col1temp'];} elseif (isset($_SESSION['col1temp'])) {echo $_SESSION['col1temp'];} else {echo '';};?>"><br>
				<form id="setcol1highlow">
					<input type="radio" id="col1high" name="col1highlow" value="red" <?php echo $highcheck; ?>><small>High</small>
					<input type="radio" id="col1low" name="col1highlow" value="blue" <?php echo $lowcheck; ?>><small>Low</small></form>
				</p>
				<br>
			<p>
					<label for="col1pop">Precipitation</label>
					<br>
					<input style="width:90%" min="0" max="100" size="15" maxlength="3" name="col1pop" placeholder="Probability %" id="col1pop" type="number" value="<?php if (isset($_POST['col1pop'])) {echo $_POST['col1pop'];} elseif (isset($_SESSION['col1pop'])) {echo $_SESSION['col1pop'];} else {echo '';};?>"><label style="display: none;" for="col1precip" id="col1precip_label">Precipitation Total</label><input style="width:90%" step=".01" min="0" max="100" name="col1precip" placeholder="Precip Total" id="col1precip" type="number" value="<?php if (isset($_POST['col1precip'])) {echo $_POST['col1precip'];} elseif (isset($_SESSION['col1precip'])) {echo $_SESSION['col1precip'];} else {echo '';};?>"><br><small><small><strong>Hide Rain Total<input type="checkbox" name="col1showrain" value="1" <?php echo (isset($_POST['col1showrain']))?$checked:$unchecked; echo (isset($_SESSION['col1showrain']))?$checked:$unchecked;?>></strong></small></small>
					</p>
			<p>
					<label for="col1snowmin">Snow</label>
					<br>
			<input style="width:90%; background-color: <?php echo $logicErr1; ?>" step=".5" min="0" max="100" name="col1snowmin" placeholder="Min Accum" id="col1snowmin" type="number" value="<?php if (isset($_POST['col1snowmin'])) {echo $_POST['col1snowmin'];} elseif (isset($_SESSION['col1snowmin'])) {echo $_SESSION['col1snowmin'];} else {echo '';};?>"><label style="display: none;" for="col1snowmax" id="col1snowmax_label">Day 1 Snow Maximum</label><input style="width:90%; background-color: <?php echo $logicErr1; ?>" step=".5" min="0" max="100" name="col1snowmax" placeholder="Max Accum" id="col1snowmax" type="number" value="<?php if (isset($_POST['col1snowmax'])) {echo $_POST['col1snowmax'];} elseif (isset($_SESSION['col1snowmax'])) {echo $_SESSION['col1snowmax'];} else {echo '';};?>"><br>
				</p>
			<p>
		
					<label for="col1wind">Wind</label>
					<br>
					<input style="width:90%; background-color: <?php echo $logicErr2; ?>" maxlength="3" max="240" min="0" name="col1windmin" placeholder="Min Sustained" id="col1windmin" type="number" value="<?php if (isset($_POST['col1windmin'])) {echo $_POST['col1windmin'];} elseif (isset($_SESSION['col1windmin'])) {echo $_SESSION['col1windmin'];} else {echo '';};?>"><input style="width:90%; background-color: <?php echo $logicErr2; ?>" maxlength="3" max="240" min="0" name="col1windmax" placeholder="Max Sustained" id="col1windmax" type="number" value="<?php if (isset($_POST['col1windmax'])) {echo $_POST['col1windmax'];} elseif (isset($_SESSION['col1windmax'])) {echo $_SESSION['col1windmax'];} else {echo '';};?>"><input style="width:90%; background-color: <?php echo $logicErr3; ?>" maxlength="3" max="240" min="0" name="col1windgust" placeholder="Max Gust" id="col1windgust" type="number" value="<?php if (isset($_POST['col1windgust'])) {echo $_POST['col1windgust'];} elseif (isset($_SESSION['col1windgust'])) {echo $_SESSION['col1windgust'];} else {echo '';};?>">
					<select style="width:80%" name="col1winddir">
						<option value="<?php if (isset($_POST['col1winddir'])) {echo $_POST['col1winddir'];} elseif (isset($_SESSION['col1winddir'])) {echo $_SESSION['col1winddir'];} else {echo '';};?>"><?php if (isset($_POST['col1winddir'])) {echo $_POST['col1winddir'];} elseif (isset($_SESSION['col1winddir'])) {echo $_SESSION['col1winddir'];} else {echo 'Direction';};?></option>
						<option value="North">North</option>
						<option value="NNE">North-Northeast</option>
						<option value="Northeast">Northeast</option>
						<option value="ENE">East-Northeast</option>
						<option value="East">East</option>
						<option value="ESE">East-Southeast</option>
						<option value="Southeast">Southeast</option>
						<option value="SSE<">South-Southeast</option>
						<option value="South">South</option>
						<option value="SSW">South-Southwest</option>
						<option value="Southwest">Southwest</option>
						<option value="WSW">West-Southwest</option>
						<option value="West">West</option>
						<option value="WNW">West-Northwest</option>
						<option value="Northwest">Northwest</option>
						<option value="NNW">North-Northwest</option>
						<option value="Variable">Variable</option>
						<option value="Calm">Calm</option>
					</select>
					<br><small><small><strong>Hide Wind Info?<input type="checkbox" name="col1showwind" value="1" <?php echo (isset($_POST['col1showwind']))?$checked:$unchecked; echo (isset($_SESSION['col1showwind']))?$checked:$unchecked;?>></strong></small></small>
				</p>
				<label for="col1detail">Additional Details</label>
				<br>
				<textarea style="width:95%" height="200px" name="col1detail" id="col1detail" placeholder="Timing, intensity, confidence, etc." type="text"><?php if (isset($_POST['col1detail'])) {echo $_POST['col1detail'];} elseif (isset($_SESSION['col1detail'])) {echo $_SESSION['col1detail'];} else {echo '';};?></textarea>
								<br>
			</div>
				<!-- End Column 1 Input-->
				<!-- Column 2 variables -->
			<div class="two columns" style="text-align: center;" id="hr12-24">
				
				<p>
					<label id="col2title" for="col2label"><?php if (isset($_POST['fxstarttime'])) {echo $_POST['fxstarttime'];} elseif (isset($_SESSION['fxstarttime'])) {echo $_SESSION['fxstarttime'];} else {echo $col2label;};?></label><br>
					<input style="width:90%; background-color: <?php echo $col2fieldErr11 ?>" name="col2" id="col2label" placeholder="Monday" type="text" value="<?php if (isset($_POST['col2'])) {echo $_POST['col2'];} elseif (isset($_SESSION['col2'])) {echo $_SESSION['col2'];} else {echo $col2string;};?>">*
					<br>
				</p>
				<p>
					<select style="width:90%; background-color: <?php echo $col2fieldErr12 ?>" name="col2wx" onchange="document.getElementById('col2desc').value=this.value; updatecol2wximg(this.value)">
						<option value="<?php if (isset($_POST['col2wx'])) {echo $_POST['col2wx'];} elseif (isset($_SESSION['col2wx'])) {echo $_SESSION['col2wx'];} else {echo 'Weather';};?>"><?php if (isset($_POST['col2wx'])) {echo $_POST['col2wx'];} elseif (isset($_SESSION['col2wx'])) {echo $_SESSION['col2wx'];} else {echo 'Weather';};?></option>
						<optgroup label="General Day">
						<option value="Sunny">Sunny</option>
						<option value="Partly Sunny">Partly Sunny</option>
						<option value="Mostly Cloudy">Mostly Cloudy</option>
							</optgroup>
						<optgroup label="General Night">
							<option value="Clear">Clear (Night)</option>
							<option value="Partly Cloudy">Partly Cloudy (Night)</option>
							<option value="Overcast">Overcast (Night)</option>
							</optgroup>
						<optgroup label="Rain"> 
							<option value="Isolated Rain Showers">Isolated Rain Showers</option>
							<option value="Scattered Rain Showers">Scattered Rain Showers</option>
							<option value="Rain">Rain</option>
							<option value="Heavy Rain">Heavy Rain</option>
							<option value="Rain and Fog">Rain and Fog</option>
							<option value="Isolated T-Storms">Isolated T-Storms</option>
							<option value="Scattered T-Storms">Scattered T-Storms</option>
							<option value="Thunderstorms">T-Storms</option>
							<option value="Severe T-Storms">Severe T-Storms</option>
							</optgroup>
						<optgroup label="Snow"> 
							<option value="Snow Flurries">Flurries</option>
							<option value="Scattered Snow Showers">Scattered Snow Showers</option>
							<option value="Snow">Snow</option>
							<option value="Heavy Snow">Heavy Snow</option>
							<option value="Blizzard">Blizzard</option>
							<option value="Blowing Snow">Blowing Snow</option>
							</optgroup>
						<optgroup label="Mixed Precip"> 
							<option value="Rain/Snow">Rain/Snow</option>
							<option value="Freezing Rain/Snow">Freezing Rain/Snow</option>
							<option value="Freezing Rain/Rain">Freezing Rain/Rain</option>
							<option value="Freezing Rain/Sleet">Freezing Rain/Sleet</option>
							<option value="Rain/Sleet">Rain/Sleet</option>
							<option value="Sleet">Sleet</option>
							</optgroup>
						<optgroup label="Miscellaneous"> 
							<option value="Haze">Haze</option>
							<option value="Overcast/Haze">Overcast/Haze</option>
							<option value="Sunny/Fog">Sunny w/ Fog</option>
							<option value="Cloudy/Fog">Cloudy w/ Fog</option>
							<option value="Morning Fog">Fog Early AM</option>
							<option value="Overnight Fog">Fog Overnight</option>
							<option value="Dense Fog">Dense Fog</option>
							<option value="Windy">Windy/Breezy</option>
							<option value="Lunar Eclipse">Lunar Eclipse</option>
							<option value="Solar Eclipse">Solar Eclipse</option>
							</optgroup>
					</select>*
					<br>
					<?php
if (isset($_POST['col2wx'])) {
	echo '<img src="' . $col2wximg . '" alt="Weather Icon Preview" style="width:70px;height:70px;" id="col2wximg" name="col2wximg">';
} 
elseif (isset($_SESSION['col2wx'])) {
	echo '<img src="' . $col2wximg . '" alt="Weather Icon Preview" style="width:70px;height:70px;" id="col2wximg" name="col2wximg">';
} 
else {
	echo '<img src="/ifxwx_images/select.png" alt="Weather Icon Preview" style="width:70px;height:70px;" id="col2wximg" name="col2wximg">';
	 }
?>
				</p>
				<p>
					<label for="col2desc">Weather Description*</label>
					<br>
					<input style="width:90%; background-color: <?php echo $col2fieldErr13 ?>" name="col2desc" placeholder="Mostly Sunny" id="col2desc" type="text" value="<?php if (isset($_POST['col2desc'])) {echo $_POST['col2desc'];} elseif (isset($_SESSION['col2desc'])) {echo $_SESSION['col2desc'];} else {echo '';};?>">
				
					</p>
			
					<label for="col2temp">Temperature*</label>
					<br>
					<input style="width:90%; background-color: <?php echo $col2fieldErr14 ?>" placeholder="High/Low" min="-100" max="134" maxlength="3" name="col2temp" id="col2temp" type="number" value="<?php if (isset($_POST['col2temp'])) {echo $_POST['col2temp'];} elseif (isset($_SESSION['col2temp'])) {echo $_SESSION['col2temp'];} else {echo '';};?>"><br>
				<form id="setcol2highlow">
					<input type="radio" id="col2high" name="col2highlow" value="red" <?php echo $col2highcheck; ?>><small>High</small>
					<input type="radio" id="col2low" name="col2highlow" value="blue" <?php echo $col2lowcheck; ?>><small>Low</small></form>
				
				<br>
			<p>
					<label for="col2pop">Precipitation</label>
					<br>
					<input style="width:90%" min="0" max="100" size="15" maxlength="3" name="col2pop" placeholder="Probability %" id="col2pop" type="number" value="<?php if (isset($_POST['col2pop'])) {echo $_POST['col2pop'];} elseif (isset($_SESSION['col2pop'])) {echo $_SESSION['col2pop'];} else {echo '';};?>"><label style="display: none;" for="col2precip" id="col2precip_label">Precipitation Total</label><input style="width:90%" step=".01" min="0" max="100" name="col2precip" placeholder="Precip Total" id="col2precip" type="number" value="<?php if (isset($_POST['col2precip'])) {echo $_POST['col2precip'];} elseif (isset($_SESSION['col2precip'])) {echo $_SESSION['col2precip'];} else {echo '';};?>"><br><small><small><strong>Hide Rain Total<input type="checkbox" name="col2showrain" value="1" <?php echo (isset($_POST['col2showrain']))?$checked:$unchecked; echo (isset($_SESSION['col2showrain']))?$checked:$unchecked;?>></strong></small></small>
					</p>
			<p>
					<label for="col2snowmin">Snow</label>
					<br>
			<input style="width:90%; background-color: <?php echo $col2logicErr1; ?>" step=".5" min="0" max="100" name="col2snowmin" placeholder="Min Accum" id="col2snowmin" type="number" value="<?php if (isset($_POST['col2snowmin'])) {echo $_POST['col2snowmin'];} elseif (isset($_SESSION['col2snowmin'])) {echo $_SESSION['col2snowmin'];} else {echo '';};?>"><label style="display: none;" for="col2snowmax" id="col2snowmax_label">Day 1 Snow Maximum</label><input style="width:90%; background-color: <?php echo $col2logicErr1; ?>" step=".5" min="0" max="100" name="col2snowmax" placeholder="Max Accum" id="col2snowmax" type="number" value="<?php if (isset($_POST['col2snowmax'])) {echo $_POST['col2snowmax'];} elseif (isset($_SESSION['col2snowmax'])) {echo $_SESSION['col2snowmax'];} else {echo '';};?>"><br>
				</p>
			<p>
		
					<label for="col2wind">Wind</label>
					<br>
					<input style="width:90%; background-color: <?php echo $col2logicErr2; ?>" maxlength="3" max="240" min="0" name="col2windmin" placeholder="Min Sustained" id="col2windmin" type="number" value="<?php if (isset($_POST['col2windmin'])) {echo $_POST['col2windmin'];} elseif (isset($_SESSION['col2windmin'])) {echo $_SESSION['col2windmin'];} else {echo '';};?>"><input style="width:90%; background-color: <?php echo $col2logicErr2; ?>" maxlength="3" max="240" min="0" name="col2windmax" placeholder="Max Sustained" id="col2windmax" type="number" value="<?php if (isset($_POST['col2windmax'])) {echo $_POST['col2windmax'];} elseif (isset($_SESSION['col2windmax'])) {echo $_SESSION['col2windmax'];} else {echo '';};?>"><input style="width:90%; background-color: <?php echo $col2logicErr3; ?>" maxlength="3" max="240" min="0" name="col2windgust" placeholder="Max Gust" id="col2windgust" type="number" value="<?php if (isset($_POST['col2windgust'])) {echo $_POST['col2windgust'];} elseif (isset($_SESSION['col2windgust'])) {echo $_SESSION['col2windgust'];} else {echo '';};?>">
					<select style="width:80%" name="col2winddir">
						<option value="<?php if (isset($_POST['col2winddir'])) {echo $_POST['col2winddir'];} elseif (isset($_SESSION['col2winddir'])) {echo $_SESSION['col2winddir'];} else {echo '';};?>"><?php if (isset($_POST['col2winddir'])) {echo $_POST['col2winddir'];} elseif (isset($_SESSION['col2winddir'])) {echo $_SESSION['col2winddir'];} else {echo 'Direction';};?></option>
						<option value="North">North</option>
						<option value="NNE">North-Northeast</option>
						<option value="Northeast">Northeast</option>
						<option value="ENE">East-Northeast</option>
						<option value="East">East</option>
						<option value="ESE">East-Southeast</option>
						<option value="Southeast">Southeast</option>
						<option value="SSE<">South-Southeast</option>
						<option value="South">South</option>
						<option value="SSW">South-Southwest</option>
						<option value="Southwest">Southwest</option>
						<option value="WSW">West-Southwest</option>
						<option value="West">West</option>
						<option value="WNW">West-Northwest</option>
						<option value="Northwest">Northwest</option>
						<option value="NNW">North-Northwest</option>
						<option value="Variable">Variable</option>
						<option value="Calm">Calm</option>
					</select>
					<br><small><small><strong>Hide Wind Info?<input type="checkbox" name="col2showwind" value="1" <?php echo (isset($_POST['col2showwind']))?$checked:$unchecked; echo (isset($_SESSION['col2showwind']))?$checked:$unchecked;?>></strong></small></small>
				</p>
				<label for="col2detail">Additional Details</label>
				<br>
				<textarea style="width:95%" height="200px" name="col2detail" id="col2detail" placeholder="Timing, intensity, confidence, etc." type="text"><?php if (isset($_POST['col2detail'])) {echo $_POST['col2detail'];} elseif (isset($_SESSION['col2detail'])) {echo $_SESSION['col2detail'];} else {echo '';};?></textarea>
								<br>
			</div>
				<!-- End Column 2 Input-->
<div class="twelve columns">
	<hr>
				</div>
				<!-- At the bottom of the page is the section for user prefernces to be selected-->
					<div class="twelve columns" id="userpref">
					<div class="two columns" id="tempunit">
						<label for="tempunit">Temperature Units</label>
							<input type="radio" name="tempunit" value="fahrenheit" <?php echo $tempf; ?>><small>Fahrenheit</small><br>
							<input type="radio" name="tempunit" value="celsius" <?php echo $tempc; ?>><small>Celsius</small>
						</div>
				<div class="two columns" id="precipunit">
					<label for="precipunit">Precipitation Units</label>
							<input type="radio" name="precipunit" value="in." <?php echo $precipin; ?>><small>Inches (in.)</small><br>
							<input type="radio" name="precipunit" value="mm" <?php echo $precipmm; ?>><small>Millimeters (mm)</small>
				</div>
				<div class="two columns" id="windunit">
					<label for="windunit">Wind Units</label>
					<select style="width:100%" name="windunit">
						<option value="<?php if (isset($_POST['windunit'])) {echo $_POST['windunit'];} elseif (isset($_SESSION['windunit'])) {echo $_SESSION['windunit'];} else {echo 'mph';};?>"><?php if (isset($_POST['windunit'])) {echo $_POST['windunit'];} elseif (isset($_SESSION['windunit'])) {echo $_SESSION['windunit'];} else {echo 'Miles/Hour (mph)';};?></option>
						<option value="mph">Miles/Hour (mph)</option>
						<option value="km/h">Kilometers/Hour (km/h)</option>
						<option value="m/s">Meters/Second (m/s)</option>
						<option value="kts">Knots (kts)</option>
					</select>
				</div>
						<div class="two columns" id="colorize">
							<label for="colortemp1">Colorize Temperature</label>
							<input type="radio" id="colortempno" name="colortemp" value="no" <?php echo $colorno; ?>><small>No</small><br>
						<input type="radio" id="colortempyes" name="colortemp" value="yes" <?php echo $coloryes; ?>><small>Yes</small>
						</div>
						<div class="two columns" id="test">
							<label for="addopt1">Additional Options 1</label>
							<input type="radio" id="addopt1-1" name="addopt1" value="no" checked><small>No</small><br>
						<input type="radio" id="addopt1-2" name="addopt1" value="yes"><small>Yes</small>
						</div>
						<div class="two columns" id="test">
							<label for="addopt2">Additional Options 2</label>
							<input type="radio" id="addopt2-1" name="addopt2" value="no" checked><small>No</small><br>
						<input type="radio" id="addopt2-2" name="addopt2" value="yes"><small>Yes</small>
						</div>
				</div>
				<!-- Action buttons at the bottom of the page-->
			<p>
			<div class="three columns">
				<br>
					<input value="Submit" type="submit" id="submit">	
			</div>
				<div class="three columns offset-by-six">
					<br>
<form action="<?php reset_var() ?>"><input id="reset" value="Reset" type="submit"></form></div>
			</p>
		</div>
		</div>
	</form>
			<?php
function reset_var() {
	session_destroy();
	echo "/iFxWx.php";
}
?>
	
<!-- All scripts are located at the end of the HTML markup so they are last to be executed -->
	<script>
		// This script sets the titles for each forecast period to alternate day/night depending on user selection of forecast start time
	function updateTitles(val) {
		if (val == "5pm - 5am"){
			document.getElementById("col1high").checked = false;
			document.getElementById("col1low").checked = true;
			document.getElementById("col1title").innerHTML=val;
			document.getElementById("col2title").innerHTML="5am - 5pm";
		}
		else if (val == "6pm - 6am"){
			document.getElementById("col1high").checked = false;
			document.getElementById("col1low").checked = true;
			document.getElementById("col1title").innerHTML=val;
			document.getElementById("col2title").innerHTML="6am - 6pm";
		}
		else if (val == "7pm - 7am"){
			document.getElementById("col1high").checked = false;
			document.getElementById("col1low").checked = true;
			document.getElementById("col1title").innerHTML=val;
			document.getElementById("col2title").innerHTML="7am - 7pm";
		}
		else if (val == "8pm - 8am"){
			document.getElementById("col1high").checked = false;
			document.getElementById("col1low").checked = true;
			document.getElementById("col1title").innerHTML=val;
			document.getElementById("col2title").innerHTML="8am - 8pm";
		}
		else if (val == "5am - 5pm"){
			document.getElementById("col1low").checked = false;
			document.getElementById("col1high").checked = true;
			document.getElementById("col1title").innerHTML=val;
			document.getElementById("col2title").innerHTML="5pm - 5am";
		}
		else if (val == "6am - 6pm"){
			document.getElementById("col1low").checked = false;
			document.getElementById("col1high").checked = true;
			document.getElementById("col1title").innerHTML=val;
			document.getElementById("col2title").innerHTML="6pm - 6am";

		}
		else if (val == "7am - 7pm"){
			document.getElementById("col1low").checked = false;
			document.getElementById("col1high").checked = true;
			document.getElementById("col1title").innerHTML=val;
			document.getElementById("col2title").innerHTML="7pm - 7am";
		}
		else if (val == "8am - 8pm"){
			document.getElementById("col1low").checked = false;
			document.getElementById("col1high").checked = true;
			document.getElementById("col1title").innerHTML=val;
			document.getElementById("col2title").innerHTML="8pm - 8am";

		}
		else {
			document.getElementById("col1title").innerHTML="";
			document.getElementById("col2title").innerHTML="";
		}
		
	}
		// Column 1 weather icon preview script
		// This script is to instantly change the weather icon preview in column 1 to whatever the user selects from the drop down menu
		function updatecol1wximg(val) {
switch (val) {
case "Sunny": col1wximg = "/ifxwx_images/sunny.png";
break;
case "Partly Sunny": col1wximg = "/ifxwx_images/partly_cloudy_day.png";
break;
case "Mostly Cloudy": col1wximg = "/ifxwx_images/overcast.png";
break;
case "Clear": col1wximg = "/ifxwx_images/clear_night.png";
break;
case "Partly Cloudy": col1wximg = "/ifxwx_images/partly_cloudy_night.png";
break;
case "Overcast": col1wximg = "/ifxwx_images/overcast.png";
break;
case "Isolated Rain Showers": col1wximg = "/ifxwx_images/showers_isolated.png";
break;
case "Scattered Rain Showers": col1wximg = "/ifxwx_images/showers_scattered.png";
break;
case "Rain": col1wximg = "/ifxwx_images/rain.png";
break;
case "Heavy Rain": col1wximg = "/ifxwx_images/rain_heavy.png";
break;
case "Rain and Fog": col1wximg = "/ifxwx_images/showers_haze.png";
break;
case "Isolated T-Storms": col1wximg = "/ifxwx_images/tstorms_isolated.png";
break;
case "Scattered T-Storms": col1wximg = "/ifxwx_images/tstorms_scattered.png";
break;
case "Thunderstorms": col1wximg = "/ifxwx_images/tstorms_rain.png";
break;
case "Severe T-Storms": col1wximg = "/ifxwx_images/tstorms_severe.png";
break;
case "Snow Flurries": col1wximg = "/ifxwx_images/snow_flurries.png";
break;
case "Scattered Snow Showers": col1wximg = "/ifxwx_images/snow_scattered.png";
break;
case "Snow": col1wximg = "/ifxwx_images/snow.png";
break;
case "Heavy Snow": col1wximg = "/ifxwx_images/snow_heavy.png";
break;
case "Blizzard": col1wximg = "/ifxwx_images/snow_blizzard.png";
break;
case "Blowing Snow": col1wximg = "/ifxwx_images/blowing_snow.png";
break;
case "Rain/Snow": col1wximg = "/ifxwx_images/rain_snow.png";
break;
case "Freezing Rain/Snow": col1wximg = "/ifxwx_images/freezing_rain_snow.png";
break;
case "Freezing Rain/Rain": col1wximg = "/ifxwx_images/freezing_rain.png";
break;
case "Freezing Rain/Sleet": col1wximg = "/ifxwx_images/freezing_rain_sleet.png";
break;
case "Rain/Sleet": col1wximg = "/ifxwx_images/rain_sleet.png";
break;
case "Sleet": col1wximg = "/ifxwx_images/sleet.png";
break;
case "Overcast/Haze": col1wximg = "/ifxwx_images/overcast_haze.png";
break;
case "Haze": col1wximg = "/ifxwx_images/haze_day_night.png";
break;
case "Sunny/Fog": col1wximg = "/ifxwx_images/fog_day.png";
break;
case "Morning Fog": col1wximg = "/ifxwx_images/fog_morning.png";
break;
case "Overnight Fog": col1wximg = "/ifxwx_images/fog_night.png";
break;
case "Cloudy/Fog": col1wximg = "/ifxwx_images/fog_overcast.png";
break;
case "Dense Fog": col1wximg = "/ifxwx_images/fog_dense.png";
break;
case "Windy": col1wximg = "/ifxwx_images/windy.png";
break;
case "Lunar Eclipse": col1wximg = "/ifxwx_images/lunar_eclipse.png";
break;
case "Solar Eclipse": col1wximg = "/ifxwx_images/solar_eclipse.png";
break;
default: col1wximg = "/ifxwx_images/select.png";
}
			document.getElementById("col1wximg").src = col1wximg;
		}
		
		// Column 2 weather icon preview script
		// This script is to instantly change the weather icon preview in column 2 to whatever the user selects from the drop down menu
		function updatecol2wximg(val) {
switch (val) {
case "Sunny": col2wximg = "/ifxwx_images/sunny.png";
break;
case "Partly Sunny": col2wximg = "/ifxwx_images/partly_cloudy_day.png";
break;
case "Mostly Cloudy": col2wximg = "/ifxwx_images/overcast.png";
break;
case "Clear": col2wximg = "/ifxwx_images/clear_night.png";
break;
case "Partly Cloudy": col2wximg = "/ifxwx_images/partly_cloudy_night.png";
break;
case "Overcast": col2wximg = "/ifxwx_images/overcast.png";
break;
case "Isolated Rain Showers": col2wximg = "/ifxwx_images/showers_isolated.png";
break;
case "Scattered Rain Showers": col2wximg = "/ifxwx_images/showers_scattered.png";
break;
case "Rain": col2wximg = "/ifxwx_images/rain.png";
break;
case "Heavy Rain": col2wximg = "/ifxwx_images/rain_heavy.png";
break;
case "Rain and Fog": col2wximg = "/ifxwx_images/showers_haze.png";
break;
case "Isolated T-Storms": col2wximg = "/ifxwx_images/tstorms_isolated.png";
break;
case "Scattered T-Storms": col2wximg = "/ifxwx_images/tstorms_scattered.png";
break;
case "Thunderstorms": col2wximg = "/ifxwx_images/tstorms_rain.png";
break;
case "Severe T-Storms": col2wximg = "/ifxwx_images/tstorms_severe.png";
break;
case "Snow Flurries": col2wximg = "/ifxwx_images/snow_flurries.png";
break;
case "Scattered Snow Showers": col2wximg = "/ifxwx_images/snow_scattered.png";
break;
case "Snow": col2wximg = "/ifxwx_images/snow.png";
break;
case "Heavy Snow": col2wximg = "/ifxwx_images/snow_heavy.png";
break;
case "Blizzard": col2wximg = "/ifxwx_images/snow_blizzard.png";
break;
case "Blowing Snow": col2wximg = "/ifxwx_images/blowing_snow.png";
break;
case "Rain/Snow": col2wximg = "/ifxwx_images/rain_snow.png";
break;
case "Freezing Rain/Snow": col2wximg = "/ifxwx_images/freezing_rain_snow.png";
break;
case "Freezing Rain/Rain": col2wximg = "/ifxwx_images/freezing_rain.png";
break;
case "Freezing Rain/Sleet": col2wximg = "/ifxwx_images/freezing_rain_sleet.png";
break;
case "Rain/Sleet": col2wximg = "/ifxwx_images/rain_sleet.png";
break;
case "Sleet": col2wximg = "/ifxwx_images/sleet.png";
break;
case "Overcast/Haze": col2wximg = "/ifxwx_images/overcast_haze.png";
break;
case "Haze": col2wximg = "/ifxwx_images/haze_day_night.png";
break;
case "Sunny/Fog": col2wximg = "/ifxwx_images/fog_day.png";
break;
case "Morning Fog": col2wximg = "/ifxwx_images/fog_morning.png";
break;
case "Overnight Fog": col2wximg = "/ifxwx_images/fog_night.png";
break;
case "Cloudy/Fog": col2wximg = "/ifxwx_images/fog_overcast.png";
break;
case "Dense Fog": col2wximg = "/ifxwx_images/fog_dense.png";
break;
case "Windy": col2wximg = "/ifxwx_images/windy.png";
break;
case "Lunar Eclipse": col2wximg = "/ifxwx_images/lunar_eclipse.png";
break;
case "Solar Eclipse": col2wximg = "/ifxwx_images/solar_eclipse.png";
break;
default: col2wximg = "/ifxwx_images/select.png";
}
			document.getElementById("col2wximg").src = col2wximg;
		}
	</script>
</body>
<!-- That's all she wrote folks!-->
</html>
