<?php
// Start the session
session_start();
 $timeout = 1800; // Number of seconds until it times out.
 $version = "1.1.0 Alpha";

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

// Column 3 variables

	// Field Error variables are set white as default but will turn red if the specified field is left blank after user submits the form
	$col3fieldErr1 = $col3fieldErr3 = $col3fieldErr4 = $col3fieldErr5 = $col3fieldErr6 = $col3fieldErr7 = $col3fieldErr8 = $col3fieldErr9 = $col3fieldErr10 = $col3fieldErr11 = $col3fieldErr12 = $col3fieldErr13 = $col3fieldErr14 = "#FFF";
	
	// Logic Error variables are set to white as default but will turn blue if the specified fields do not pass the logic check
	$col3logicErr1 = $col3logicErr2 = $col3logicErr3 = "FFF" ;

// Column 4 variables

	// Field Error variables are set white as default but will turn red if the specified field is left blank after user submits the form
	$col4fieldErr1 = $col4fieldErr3 = $col4fieldErr4 = $col4fieldErr5 = $col4fieldErr6 = $col4fieldErr7 = $col4fieldErr8 = $col4fieldErr9 = $col4fieldErr10 = $col4fieldErr11 = $col4fieldErr12 = $col4fieldErr13 = $col4fieldErr14 = "#FFF";
	
	// Logic Error variables are set to white as default but will turn blue if the specified fields do not pass the logic check
	$col4logicErr1 = $col4logicErr2 = $col4logicErr3 = "FFF" ;

// Column 5 variables

	// Field Error variables are set white as default but will turn red if the specified field is left blank after user submits the form
	$col5fieldErr1 = $col5fieldErr3 = $col5fieldErr4 = $col5fieldErr5 = $col5fieldErr6 = $col5fieldErr7 = $col5fieldErr8 = $col5fieldErr9 = $col5fieldErr10 = $col5fieldErr11 = $col5fieldErr12 = $col5fieldErr13 = $col5fieldErr14 = "#FFF";
	
	// Logic Error variables are set to white as default but will turn blue if the specified fields do not pass the logic check
	$col5logicErr1 = $col5logicErr2 = $col5logicErr3 = "FFF" ;

// Column 6 variables

	// Field Error variables are set white as default but will turn red if the specified field is left blank after user submits the form
	$col6fieldErr1 = $col6fieldErr3 = $col6fieldErr4 = $col6fieldErr5 = $col6fieldErr6 = $col6fieldErr7 = $col6fieldErr8 = $col6fieldErr9 = $col6fieldErr10 = $col6fieldErr11 = $col6fieldErr12 = $col6fieldErr13 = $col6fieldErr14 = "#FFF";
	
	// Logic Error variables are set to white as default but will turn blue if the specified fields do not pass the logic check
	$col6logicErr1 = $col6logicErr2 = $col6logicErr3 = "FFF" ;

//
//
// Validation of required variables
if ($_SERVER["REQUEST_METHOD"] == "POST" && $proceed == false) {
	
	//Check to see if any of the required fields are blank or set at the default values
	if (empty($_POST["forecaster"]) || empty($_POST["stationname"]) || empty($_POST["date"])|| empty($_POST["time"]) || empty($_POST["fxstartmonth"]) || $_POST["fxstartmonth"] == "Select Month" || empty($_POST["fxstartday"]) || $_POST["fxstartday"] == "Select Day" || empty($_POST["fxstartyear"]) || $_POST["fxstartyear"] == "Select Year" || empty($_POST["fxstarttime"]) || $_POST["fxstarttime"] == "Select Time" || empty($_POST["col1"]) || $_POST["col1wx"] == "Weather" || empty($_POST["col1desc"]) || empty($_POST["col1temp"]) || empty($_POST["col2"]) || $_POST["col2wx"] == "Weather" || empty($_POST["col2desc"]) || empty($_POST["col2temp"]) || empty($_POST["col3"]) || $_POST["col3wx"] == "Weather" || empty($_POST["col3desc"]) || empty($_POST["col3temp"]) || empty($_POST["col4"]) || $_POST["col4wx"] == "Weather" || empty($_POST["col4desc"]) || empty($_POST["col4temp"]) || empty($_POST["col5"]) || $_POST["col5wx"] == "Weather" || empty($_POST["col5desc"]) || empty($_POST["col5temp"]) || empty($_POST["col6"]) || $_POST["col6wx"] == "Weather" || empty($_POST["col6desc"]) || empty($_POST["col6temp"])) {
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
	// Column 3 variables
	if (empty($_POST["col3"])) {
		$col3fieldErr11 = "#FF8080";
	}
	if ($_POST["col3wx"] == "Weather") {
		$col3fieldErr12 = "#FF8080";
	}
	if (empty($_POST["col3desc"])) {
		$col3fieldErr13 = "#FF8080";
	}
	if (empty($_POST["col3temp"])) {
		$col3fieldErr14 = "#FF8080";
	}
	// Column 4 variables
	if (empty($_POST["col4"])) {
		$col4fieldErr11 = "#FF8080";
	}
	if ($_POST["col4wx"] == "Weather") {
		$col4fieldErr12 = "#FF8080";
	}
	if (empty($_POST["col4desc"])) {
		$col4fieldErr13 = "#FF8080";
	}
	if (empty($_POST["col4temp"])) {
		$col4fieldErr14 = "#FF8080";
	}
	// Column 5 variables
	if (empty($_POST["col5"])) {
		$col5fieldErr11 = "#FF8080";
	}
	if ($_POST["col5wx"] == "Weather") {
		$col5fieldErr12 = "#FF8080";
	}
	if (empty($_POST["col5desc"])) {
		$col5fieldErr13 = "#FF8080";
	}
	if (empty($_POST["col5temp"])) {
		$col5fieldErr14 = "#FF8080";
	}
	// Column 6 variables
	if (empty($_POST["col6"])) {
		$col6fieldErr11 = "#FF8080";
	}
	if ($_POST["col6wx"] == "Weather") {
		$col6fieldErr12 = "#FF8080";
	}
	if (empty($_POST["col6desc"])) {
		$col6fieldErr13 = "#FF8080";
	}
	if (empty($_POST["col6temp"])) {
		$col6fieldErr14 = "#FF8080";
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
	
	// Column 3 logic check
	if ($_POST["col3snowmin"] > $_POST["col3snowmax"]) {
		$snowlogic = "Minimum snow accumulation cannot be larger than maximum snow accumulation. <br>";
		$logic = false;
		$col3logicErr1 = "#2681FF";
	}

	if ($_POST["col3windmin"] > $_POST["col3windmax"]) {
		$windlogic = "Minimum sustained wind cannot be larger than maximum sustained wind. <br>";
		$logic = false;
		$col3logicErr2 = "#2681FF";
	}

	if ($_POST["col3windmax"] >= $_POST["col3windgust"] && $_POST["col3windgust"] != "") {
		$gustlogic = "Maximum sustained wind cannot be larger than or equal to wind gusts. <br>";
		$logic = false;
		$col3logicErr3 = "#2681FF";
	}
	
	// Column 4 logic check
	if ($_POST["col4snowmin"] > $_POST["col4snowmax"]) {
		$snowlogic = "Minimum snow accumulation cannot be larger than maximum snow accumulation. <br>";
		$logic = false;
		$col4logicErr1 = "#2681FF";
	}

	if ($_POST["col4windmin"] > $_POST["col4windmax"]) {
		$windlogic = "Minimum sustained wind cannot be larger than maximum sustained wind. <br>";
		$logic = false;
		$col4logicErr2 = "#2681FF";
	}

	if ($_POST["col4windmax"] >= $_POST["col4windgust"] && $_POST["col4windgust"] != "") {
		$gustlogic = "Maximum sustained wind cannot be larger than or equal to wind gusts. <br>";
		$logic = false;
		$col4logicErr3 = "#2681FF";
	}
	
	// Column 5 logic check
	if ($_POST["col5snowmin"] > $_POST["col5snowmax"]) {
		$snowlogic = "Minimum snow accumulation cannot be larger than maximum snow accumulation. <br>";
		$logic = false;
		$col5logicErr1 = "#2681FF";
	}

	if ($_POST["col5windmin"] > $_POST["col5windmax"]) {
		$windlogic = "Minimum sustained wind cannot be larger than maximum sustained wind. <br>";
		$logic = false;
		$col5logicErr2 = "#2681FF";
	}

	if ($_POST["col5windmax"] >= $_POST["col5windgust"] && $_POST["col5windgust"] != "") {
		$gustlogic = "Maximum sustained wind cannot be larger than or equal to wind gusts. <br>";
		$logic = false;
		$col5logicErr3 = "#2681FF";
	}
	
	// Column 6 logic check
	if ($_POST["col6snowmin"] > $_POST["col6snowmax"]) {
		$snowlogic = "Minimum snow accumulation cannot be larger than maximum snow accumulation. <br>";
		$logic = false;
		$col6logicErr1 = "#2681FF";
	}

	if ($_POST["col6windmin"] > $_POST["col6windmax"]) {
		$windlogic = "Minimum sustained wind cannot be larger than maximum sustained wind. <br>";
		$logic = false;
		$col6logicErr2 = "#2681FF";
	}

	if ($_POST["col6windmax"] >= $_POST["col6windgust"] && $_POST["col6windgust"] != "") {
		$gustlogic = "Maximum sustained wind cannot be larger than or equal to wind gusts. <br>";
		$logic = false;
		$col6logicErr3 = "#2681FF";
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
	
	// Column 3 Forecast Period Variables
	$_SESSION["col3wx"] = $_POST["col3wx"];
	$_SESSION["col3"] = $_POST["col3"];
	$_SESSION["col3highlow"] = $_POST["col3highlow"];
	$_SESSION["precipunit"] = $_POST["precipunit"];
	$_SESSION["col3pop"] = $_POST["col3pop"];
	$_SESSION["col3desc"] = $_POST["col3desc"];
	$_SESSION["col3temp"] = $_POST["col3temp"];
	$_SESSION["col3precip"] = $_POST["col3precip"];
	$_SESSION["col3showrain"] = $_POST["col3showrain"];
	$_SESSION["col3snowmin"] = $_POST["col3snowmin"];
	$_SESSION["col3snowmax"] = $_POST["col3snowmax"];
	$_SESSION["col3windmin"] = $_POST["col3windmin"];
	$_SESSION["col3windmax"] = $_POST["col3windmax"];
	$_SESSION["col3winddir"] = $_POST["col3winddir"];
	$_SESSION["col3showwind"] = $_POST["col3showwind"];
	$_SESSION["col3windgust"] = $_POST["col3windgust"];
	$_SESSION["col3detail"] = $_POST["col3detail"];
	
	// Column 4 Forecast Period Variables
	$_SESSION["col4wx"] = $_POST["col4wx"];
	$_SESSION["col4"] = $_POST["col4"];
	$_SESSION["col4highlow"] = $_POST["col4highlow"];
	$_SESSION["precipunit"] = $_POST["precipunit"];
	$_SESSION["col4pop"] = $_POST["col4pop"];
	$_SESSION["col4desc"] = $_POST["col4desc"];
	$_SESSION["col4temp"] = $_POST["col4temp"];
	$_SESSION["col4precip"] = $_POST["col4precip"];
	$_SESSION["col4showrain"] = $_POST["col4showrain"];
	$_SESSION["col4snowmin"] = $_POST["col4snowmin"];
	$_SESSION["col4snowmax"] = $_POST["col4snowmax"];
	$_SESSION["col4windmin"] = $_POST["col4windmin"];
	$_SESSION["col4windmax"] = $_POST["col4windmax"];
	$_SESSION["col4winddir"] = $_POST["col4winddir"];
	$_SESSION["col4showwind"] = $_POST["col4showwind"];
	$_SESSION["col4windgust"] = $_POST["col4windgust"];
	$_SESSION["col4detail"] = $_POST["col4detail"];
	
	// Column 5 Forecast Period Variables
	$_SESSION["col5wx"] = $_POST["col5wx"];
	$_SESSION["col5"] = $_POST["col5"];
	$_SESSION["col5highlow"] = $_POST["col5highlow"];
	$_SESSION["precipunit"] = $_POST["precipunit"];
	$_SESSION["col5pop"] = $_POST["col5pop"];
	$_SESSION["col5desc"] = $_POST["col5desc"];
	$_SESSION["col5temp"] = $_POST["col5temp"];
	$_SESSION["col5precip"] = $_POST["col5precip"];
	$_SESSION["col5showrain"] = $_POST["col5showrain"];
	$_SESSION["col5snowmin"] = $_POST["col5snowmin"];
	$_SESSION["col5snowmax"] = $_POST["col5snowmax"];
	$_SESSION["col5windmin"] = $_POST["col5windmin"];
	$_SESSION["col5windmax"] = $_POST["col5windmax"];
	$_SESSION["col5winddir"] = $_POST["col5winddir"];
	$_SESSION["col5showwind"] = $_POST["col5showwind"];
	$_SESSION["col5windgust"] = $_POST["col5windgust"];
	$_SESSION["col5detail"] = $_POST["col5detail"];
	
	// Column 6 Forecast Period Variables
	$_SESSION["col6wx"] = $_POST["col6wx"];
	$_SESSION["col6"] = $_POST["col6"];
	$_SESSION["col6highlow"] = $_POST["col6highlow"];
	$_SESSION["precipunit"] = $_POST["precipunit"];
	$_SESSION["col6pop"] = $_POST["col6pop"];
	$_SESSION["col6desc"] = $_POST["col6desc"];
	$_SESSION["col6temp"] = $_POST["col6temp"];
	$_SESSION["col6precip"] = $_POST["col6precip"];
	$_SESSION["col6showrain"] = $_POST["col6showrain"];
	$_SESSION["col6snowmin"] = $_POST["col6snowmin"];
	$_SESSION["col6snowmax"] = $_POST["col6snowmax"];
	$_SESSION["col6windmin"] = $_POST["col6windmin"];
	$_SESSION["col6windmax"] = $_POST["col6windmax"];
	$_SESSION["col6winddir"] = $_POST["col6winddir"];
	$_SESSION["col6showwind"] = $_POST["col6showwind"];
	$_SESSION["col6windgust"] = $_POST["col6windgust"];
	$_SESSION["col6detail"] = $_POST["col6detail"];
	
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
	$col3string = date('l', strtotime("+1 day"));
	$col4string = date('l', strtotime("+1 day")) . " Night";
	$col5string = date('l', strtotime("+2 day"));
	$col6string = date('l', strtotime("+2 day")) . " Night";
}
elseif ($hour < "06" && $am_pm == "am") {
	$fxvalid = "6AM";
	$col1string = date('l');
	$col2string = date('l') . " Night";
	$col3string = date('l', strtotime("+1 day"));
	$col4string = date('l', strtotime("+1 day")) . " Night";
	$col5string = date('l', strtotime("+2 day"));
	$col6string = date('l', strtotime("+2 day")) . " Night";
}
elseif ($hour < "07" && $am_pm == "am") {
	$fxvalid = "7AM";
	$col1string = date('l');
	$col2string = date('l') . " Night";
	$col3string = date('l', strtotime("+1 day"));
	$col4string = date('l', strtotime("+1 day")) . " Night";
	$col5string = date('l', strtotime("+2 day"));
	$col6string = date('l', strtotime("+2 day")) . " Night";
}
elseif ($hour < "08" && $am_pm == "am") {
	$fxvalid = "8AM";
	$col1string = date('l');
	$col2string = date('l') . " Night";
	$col3string = date('l', strtotime("+1 day"));
	$col4string = date('l', strtotime("+1 day")) . " Night";
	$col5string = date('l', strtotime("+2 day"));
	$col6string = date('l', strtotime("+2 day")) . " Night";
}
elseif ($hour >= "08" && $hour < "12" && $am_pm == "am") {
	$fxvalid = "5PM";
	$col1string = date('l') . " Night";
	$col2string = date('l', strtotime("+1 day"));
	$col3string = date('l', strtotime("+1 day")) . " Night";
	$col4string = date('l', strtotime("+2 day"));
	$col5string = date('l', strtotime("+2 day")) . " Night";
	$col6string = date('l', strtotime("+3 day"));
}
elseif ($hour == "12" && $am_pm == "am") {
	$fxvalid = "5AM";
	$col1string = date('l');
	$col2string = date('l') . " Night";
	$col3string = date('l', strtotime("+1 day"));
	$col4string = date('l', strtotime("+1 day")) . " Night";
	$col5string = date('l', strtotime("+2 day"));
	$col6string = date('l', strtotime("+2 day")) . " Night";
	$col6string = date('l', strtotime("+3 day"));
}
elseif ($hour < "05" && $am_pm == "pm") {
	$fxvalid = "5PM";
	$col1string = date('l') . " Night";
	$col2string = date('l', strtotime("+1 day"));
	$col3string = date('l', strtotime("+1 day")) . " Night";
	$col4string = date('l', strtotime("+2 day"));
	$col5string = date('l', strtotime("+2 day")) . " Night";
	$col6string = date('l', strtotime("+3 day"));
}
elseif ($hour < "06" && $am_pm == "pm") {
	$fxvalid = "6PM";
	$col1string = date('l') . " Night";
	$col2string = date('l', strtotime("+1 day"));
	$col3string = date('l', strtotime("+1 day")) . " Night";
	$col4string = date('l', strtotime("+2 day"));
	$col5string = date('l', strtotime("+2 day")) . " Night";
	$col6string = date('l', strtotime("+3 day"));
}
elseif ($hour < "07" && $am_pm == "pm") {
	$fxvalid = "7PM";
	$col1string = date('l') . " Night";
	$col2string = date('l', strtotime("+1 day"));
	$col3string = date('l', strtotime("+1 day")) . " Night";
	$col4string = date('l', strtotime("+2 day"));
	$col5string = date('l', strtotime("+2 day")) . " Night";
	$col6string = date('l', strtotime("+3 day"));
}
elseif ($hour < "08" && $am_pm == "pm") {
	$fxvalid = "8PM";
	$col1string = date('l') . " Night";
	$col2string = date('l', strtotime("+1 day"));
	$col3string = date('l', strtotime("+1 day")) . " Night";
	$col4string = date('l', strtotime("+2 day"));
	$col5string = date('l', strtotime("+2 day")) . " Night";
	$col6string = date('l', strtotime("+3 day"));
}
elseif ($hour >= "08" && $hour < "12" && $am_pm == "pm") {
	$fxvalid = "5AM";
	$col1string = date('l', strtotime("+1 day"));
	$col2string = date('l', strtotime("+1 day")) . " Night";
	$col3string = date('l', strtotime("+2 day"));
	$col4string = date('l', strtotime("+2 day")) . " Night";
	$col5string = date('l', strtotime("+3 day"));
	$col6string = date('l', strtotime("+3 day")) . " Night";
	$month = date("m", strtotime("+1 day"));
	$day = date("d", strtotime("+1 day"));
	$year = date("Y", strtotime("+1 day"));
}
elseif ($hour == "12" && $am_pm == "pm") {
	$fxvalid = "5PM";
	$col1string = date('l') . " Night";
	$col2string = date('l', strtotime("+1 day"));
	$col3string = date('l', strtotime("+1 day")) . " Night";
	$col4string = date('l', strtotime("+2 day"));
	$col5string = date('l', strtotime("+2 day")) . " Night";
	$col6string = date('l', strtotime("+3 day"));
}
else {
	$fxvalid = "Select Time";
	$col1string = date('l');
	$col2string = date('l') . " Night";
	$col3string = date('l', strtotime("+1 day"));
	$col4string = date('l', strtotime("+1 day")) . " Night";
	$col5string = date('l', strtotime("+2 day"));
	$col6string = date('l', strtotime("+2 day")) . " Night";
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
	$col1label = "12 Hour Period";
	$col2label = "12 Hour Period";
	break;
}
// Set Column 2 label to alternate with whatever forecast start time is set as
if (isset($_POST['fxstarttime'])) {
switch ($_POST["fxstarttime"]) {
	case "5am - 5pm": $col2label = "5pm - 5am";
	break;
	case "6am - 6pm": $col2label = "6pm - 6am";
	break;
	case "7am - 7pm": $col2label = "7pm - 7am";
	break;
	case "8am - 8pm": $col2label = "8pm - 8am";
	break;
	case "5pm - 5am": $col2label = "5am - 5pm";
	break;
	case "6pm - 6am": $col2label = "6am - 6pm";
	break;
	case "7pm - 7am": $col2label = "7am - 7pm";
	break;
	case "8pm - 8am": $col2label = "8am - 8pm";
	break;
	default:
	$col2label = "12 Hour Period";
	break;
}
}
if (isset($_SESSION['fxstarttime'])) {
switch ($_SESSION["fxstarttime"]) {
	case "5am - 5pm": $col2label = "5pm - 5am";
	break;
	case "6am - 6pm": $col2label = "6pm - 6am";
	break;
	case "7am - 7pm": $col2label = "7pm - 7am";
	break;
	case "8am - 8pm": $col2label = "8pm - 8am";
	break;
	case "5pm - 5am": $col2label = "5am - 5pm";
	break;
	case "6pm - 6am": $col2label = "6am - 6pm";
	break;
	case "7pm - 7am": $col2label = "7am - 7pm";
	break;
	case "8pm - 8am": $col2label = "8am - 8pm";
	break;
	default:
	$col2label = "12 Hour Period";
	break;
}
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

//Column 3 check for pre-existing user selection for High/Low
if (!empty($_POST["col3highlow"]) && $_POST["col3highlow"] == "red") {
	$col3highcheck = "checked";
	$col3lowcheck = "";
}

elseif (!empty($_SESSION["col3highlow"]) && $_SESSION["col3highlow"] == "red") 
{
	$col3highcheck = "checked";
	$col3lowcheck = "";
} 

elseif (($fxvalid == '5AM' || $fxvalid == '6AM' || $fxvalid == '7AM' || $fxvalid == '8AM') && empty($_SESSION["col3highlow"]) && empty($_POST["col3highlow"])) {
	$col3highcheck = "checked";
	$col3lowcheck = "";
}

elseif (!empty($_POST["col3highlow"]) && $_POST["col3highlow"] == "blue") {
	$col3lowcheck = "checked";
	$col3highcheck = "";
}

elseif (!empty($_SESSION["col3highlow"]) && $_SESSION["col3highlow"] == "blue") 
{
	$col3lowcheck = "checked";
	$col3highcheck = "";
} 

elseif (($fxvalid == '5PM' || $fxvalid == '6PM' || $fxvalid == '7PM' || $fxvalid == '8PM') && empty($_SESSION["col3highlow"]) && empty($_POST["col3highlow"])) {
	$col3lowcheck = "checked";
	$col3highcheck = "";
						   }
else {
	$col3lowcheck = "";
	$col3highcheck = "checked";
	 }

// Column 4 check for pre-existing user selection for High/Low
if (!empty($_POST["col4highlow"]) && $_POST["col4highlow"] == "red") {
	$col4highcheck = "checked";
	$col4lowcheck = "";
}

elseif (!empty($_SESSION["col4highlow"]) && $_SESSION["col4highlow"] == "red") 
{
	$col4highcheck = "checked";
	$col4lowcheck = "";
} 

elseif (($fxvalid == '5AM' || $fxvalid == '6AM' || $fxvalid == '7AM' || $fxvalid == '8AM') && empty($_SESSION["col4highlow"]) && empty($_POST["col4highlow"])) {
	$col4highcheck = "";
	$col4lowcheck = "checked";
}

elseif (!empty($_POST["col4highlow"]) && $_POST["col4highlow"] == "blue") {
	$col4lowcheck = "checked";
	$col4highcheck = "";
}

elseif (!empty($_SESSION["col4highlow"]) && $_SESSION["col4highlow"] == "blue") 
{
	$col4lowcheck = "checked";
	$col4highcheck = "";
} 

elseif (($fxvalid == '5PM' || $fxvalid == '6PM' || $fxvalid == '7PM' || $fxvalid == '8PM') && empty($_SESSION["col4highlow"]) && empty($_POST["col4highlow"])) {
	$col4lowcheck = "";
	$col4highcheck = "checked";
						   }
else {
	$col4lowcheck = "checked";
	$col4highcheck = "";
	 }
//Column 5 check for pre-existing user selection for High/Low
if (!empty($_POST["col5highlow"]) && $_POST["col5highlow"] == "red") {
	$col5highcheck = "checked";
	$col5lowcheck = "";
}

elseif (!empty($_SESSION["col5highlow"]) && $_SESSION["col5highlow"] == "red") 
{
	$col5highcheck = "checked";
	$col5lowcheck = "";
} 

elseif (($fxvalid == '5AM' || $fxvalid == '6AM' || $fxvalid == '7AM' || $fxvalid == '8AM') && empty($_SESSION["col5highlow"]) && empty($_POST["col5highlow"])) {
	$col5highcheck = "checked";
	$col5lowcheck = "";
}

elseif (!empty($_POST["col5highlow"]) && $_POST["col5highlow"] == "blue") {
	$col5lowcheck = "checked";
	$col5highcheck = "";
}

elseif (!empty($_SESSION["col5highlow"]) && $_SESSION["col5highlow"] == "blue") 
{
	$col5lowcheck = "checked";
	$col5highcheck = "";
} 

elseif (($fxvalid == '5PM' || $fxvalid == '6PM' || $fxvalid == '7PM' || $fxvalid == '8PM') && empty($_SESSION["col5highlow"]) && empty($_POST["col5highlow"])) {
	$col5lowcheck = "checked";
	$col5highcheck = "";
						   }
else {
	$col5lowcheck = "";
	$col5highcheck = "checked";
	 }
// Column 6 check for pre-existing user selection for High/Low
if (!empty($_POST["col6highlow"]) && $_POST["col6highlow"] == "red") {
	$col6highcheck = "checked";
	$col6lowcheck = "";
}

elseif (!empty($_SESSION["col6highlow"]) && $_SESSION["col6highlow"] == "red") 
{
	$col6highcheck = "checked";
	$col6lowcheck = "";
} 

elseif (($fxvalid == '5AM' || $fxvalid == '6AM' || $fxvalid == '7AM' || $fxvalid == '8AM') && empty($_SESSION["col6highlow"]) && empty($_POST["col6highlow"])) {
	$col6highcheck = "";
	$col6lowcheck = "checked";
}

elseif (!empty($_POST["col6highlow"]) && $_POST["col6highlow"] == "blue") {
	$col6lowcheck = "checked";
	$col6highcheck = "";
}

elseif (!empty($_SESSION["col6highlow"]) && $_SESSION["col6highlow"] == "blue") 
{
	$col6lowcheck = "checked";
	$col6highcheck = "";
} 

elseif (($fxvalid == '5PM' || $fxvalid == '6PM' || $fxvalid == '7PM' || $fxvalid == '8PM') && empty($_SESSION["col6highlow"]) && empty($_POST["col6highlow"])) {
	$col6lowcheck = "";
	$col6highcheck = "checked";
						   }
else {
	$col6lowcheck = "checked";
	$col6highcheck = "";
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

//
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

//
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

//
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
// Column 3 weather icons
	// For POST (form validation) check for pre-selected weather in column 3 and set the icon to match, otherwise default icon will show
if (isset($_POST['col3wx'])) {
	switch ($_POST["col3wx"]) {
case "Sunny": $col3wximg= "/ifxwx_images/sunny.png";
break;
case "Partly Sunny": $col3wximg= "/ifxwx_images/partly_cloudy_day.png";
break;
case "Mostly Cloudy": $col3wximg= "/ifxwx_images/overcast.png";
break;
case "Clear": $col3wximg= "/ifxwx_images/clear_night.png";
break;
case "Partly Cloudy": $col3wximg= "/ifxwx_images/partly_cloudy_night.png";
break;
case "Overcast": $col3wximg= "/ifxwx_images/overcast.png";
break;
case "Isolated Rain Showers": $col3wximg= "/ifxwx_images/showers_isolated.png";
break;
case "Scattered Rain Showers": $col3wximg= "/ifxwx_images/showers_scattered.png";
break;
case "Rain": $col3wximg= "/ifxwx_images/rain.png";
break;
case "Heavy Rain": $col3wximg= "/ifxwx_images/rain_heavy.png";
break;
case "Rain and Fog": $col3wximg= "/ifxwx_images/showers_haze.png";
break;
case "Isolated T-Storms": $col3wximg= "/ifxwx_images/tstorms_isolated.png";
break;
case "Scattered T-Storms": $col3wximg= "/ifxwx_images/tstorms_scattered.png";
break;
case "Thunderstorms": $col3wximg= "/ifxwx_images/tstorms_rain.png";
break;
case "Severe T-Storms": $col3wximg= "/ifxwx_images/tstorms_severe.png";
break;
case "Snow Flurries": $col3wximg= "/ifxwx_images/snow_flurries.png";
break;
case "Scattered Snow Showers": $col3wximg= "/ifxwx_images/snow_scattered.png";
break;
case "Snow": $col3wximg= "/ifxwx_images/snow.png";
break;
case "Heavy Snow": $col3wximg= "/ifxwx_images/snow_heavy.png";
break;
case "Blizzard": $col3wximg= "/ifxwx_images/snow_blizzard.png";
break;
case "Blowing Snow": $col3wximg= "/ifxwx_images/blowing_snow.png";
break;
case "Rain/Snow": $col3wximg= "/ifxwx_images/rain_snow.png";
break;
case "Freezing Rain/Snow": $col3wximg= "/ifxwx_images/freezing_rain_snow.png";
break;
case "Freezing Rain/Rain": $col3wximg= "/ifxwx_images/freezing_rain.png";
break;
case "Freezing Rain/Sleet": $col3wximg= "/ifxwx_images/freezing_rain_sleet.png";
break;
case "Rain/Sleet": $col3wximg= "/ifxwx_images/rain_sleet.png";
break;
case "Sleet": $col3wximg= "/ifxwx_images/sleet.png";
break;
case "Overcast/Haze": $col3wximg= "/ifxwx_images/overcast_haze.png";
break;
case "Haze": $col3wximg= "/ifxwx_images/haze_day_night.png";
break;
case "Sunny/Fog": $col3wximg= "/ifxwx_images/fog_day.png";
break;
case "Morning Fog": $col3wximg= "/ifxwx_images/fog_morning.png";
break;
case "Overnight Fog": $col3wximg= "/ifxwx_images/fog_night.png";
break;
case "Cloudy/Fog": $col3wximg= "/ifxwx_images/fog_overcast.png";
break;
case "Dense Fog": $col3wximg= "/ifxwx_images/fog_dense.png";
break;
case "Windy": $col3wximg= "/ifxwx_images/windy.png";
break;
case "Lunar Eclipse": $col3wximg= "/ifxwx_images/lunar_eclipse.png";
break;
case "Solar Eclipse": $col3wximg= "/ifxwx_images/solar_eclipse.png";
break;
default: $col3wximg= "/ifxwx_images/select.png";
}
	// For SESSION (form editing) check for pre-selected weather in column 3 and set the icon to match, otherwise default icon will show
} 
elseif (isset($_SESSION['col3wx'])) {
	switch ($_SESSION["col3wx"]) {
case "Sunny": $col3wximg= "/ifxwx_images/sunny.png";
break;
case "Partly Sunny": $col3wximg= "/ifxwx_images/partly_cloudy_day.png";
break;
case "Mostly Cloudy": $col3wximg= "/ifxwx_images/overcast.png";
break;
case "Clear": $col3wximg= "/ifxwx_images/clear_night.png";
break;
case "Partly Cloudy": $col3wximg= "/ifxwx_images/partly_cloudy_night.png";
break;
case "Overcast": $col3wximg= "/ifxwx_images/overcast.png";
break;
case "Isolated Rain Showers": $col3wximg= "/ifxwx_images/showers_isolated.png";
break;
case "Scattered Rain Showers": $col3wximg= "/ifxwx_images/showers_scattered.png";
break;
case "Rain": $col3wximg= "/ifxwx_images/rain.png";
break;
case "Heavy Rain": $col3wximg= "/ifxwx_images/rain_heavy.png";
break;
case "Rain and Fog": $col3wximg= "/ifxwx_images/showers_haze.png";
break;
case "Isolated T-Storms": $col3wximg= "/ifxwx_images/tstorms_isolated.png";
break;
case "Scattered T-Storms": $col3wximg= "/ifxwx_images/tstorms_scattered.png";
break;
case "Thunderstorms": $col3wximg= "/ifxwx_images/tstorms_rain.png";
break;
case "Severe T-Storms": $col3wximg= "/ifxwx_images/tstorms_severe.png";
break;
case "Snow Flurries": $col3wximg= "/ifxwx_images/snow_flurries.png";
break;
case "Scattered Snow Showers": $col3wximg= "/ifxwx_images/snow_scattered.png";
break;
case "Snow": $col3wximg= "/ifxwx_images/snow.png";
break;
case "Heavy Snow": $col3wximg= "/ifxwx_images/snow_heavy.png";
break;
case "Blizzard": $col3wximg= "/ifxwx_images/snow_blizzard.png";
break;
case "Blowing Snow": $col3wximg= "/ifxwx_images/blowing_snow.png";
break;
case "Rain/Snow": $col3wximg= "/ifxwx_images/rain_snow.png";
break;
case "Freezing Rain/Snow": $col3wximg= "/ifxwx_images/freezing_rain_snow.png";
break;
case "Freezing Rain/Rain": $col3wximg= "/ifxwx_images/freezing_rain.png";
break;
case "Freezing Rain/Sleet": $col3wximg= "/ifxwx_images/freezing_rain_sleet.png";
break;
case "Rain/Sleet": $col3wximg= "/ifxwx_images/rain_sleet.png";
break;
case "Sleet": $col3wximg= "/ifxwx_images/sleet.png";
break;
case "Overcast/Haze": $col3wximg= "/ifxwx_images/overcast_haze.png";
break;
case "Haze": $col3wximg= "/ifxwx_images/haze_day_night.png";
break;
case "Sunny/Fog": $col3wximg= "/ifxwx_images/fog_day.png";
break;
case "Morning Fog": $col3wximg= "/ifxwx_images/fog_morning.png";
break;
case "Overnight Fog": $col3wximg= "/ifxwx_images/fog_night.png";
break;
case "Cloudy/Fog": $col3wximg= "/ifxwx_images/fog_overcast.png";
break;
case "Dense Fog": $col3wximg= "/ifxwx_images/fog_dense.png";
break;
case "Windy": $col3wximg= "/ifxwx_images/windy.png";
break;
case "Lunar Eclipse": $col3wximg= "/ifxwx_images/lunar_eclipse.png";
break;
case "Solar Eclipse": $col3wximg= "/ifxwx_images/solar_eclipse.png";
break;
default: $col3wximg= "/ifxwx_images/select.png";
}
}
// Column 4 weather icons
	// For POST (form validation) check for pre-selected weather in column 3 and set the icon to match, otherwise default icon will show
if (isset($_POST['col4wx'])) {
	switch ($_POST["col4wx"]) {
case "Sunny": $col4wximg= "/ifxwx_images/sunny.png";
break;
case "Partly Sunny": $col4wximg= "/ifxwx_images/partly_cloudy_day.png";
break;
case "Mostly Cloudy": $col4wximg= "/ifxwx_images/overcast.png";
break;
case "Clear": $col4wximg= "/ifxwx_images/clear_night.png";
break;
case "Partly Cloudy": $col4wximg= "/ifxwx_images/partly_cloudy_night.png";
break;
case "Overcast": $col4wximg= "/ifxwx_images/overcast.png";
break;
case "Isolated Rain Showers": $col4wximg= "/ifxwx_images/showers_isolated.png";
break;
case "Scattered Rain Showers": $col4wximg= "/ifxwx_images/showers_scattered.png";
break;
case "Rain": $col4wximg= "/ifxwx_images/rain.png";
break;
case "Heavy Rain": $col4wximg= "/ifxwx_images/rain_heavy.png";
break;
case "Rain and Fog": $col4wximg= "/ifxwx_images/showers_haze.png";
break;
case "Isolated T-Storms": $col4wximg= "/ifxwx_images/tstorms_isolated.png";
break;
case "Scattered T-Storms": $col4wximg= "/ifxwx_images/tstorms_scattered.png";
break;
case "Thunderstorms": $col4wximg= "/ifxwx_images/tstorms_rain.png";
break;
case "Severe T-Storms": $col4wximg= "/ifxwx_images/tstorms_severe.png";
break;
case "Snow Flurries": $col4wximg= "/ifxwx_images/snow_flurries.png";
break;
case "Scattered Snow Showers": $col4wximg= "/ifxwx_images/snow_scattered.png";
break;
case "Snow": $col4wximg= "/ifxwx_images/snow.png";
break;
case "Heavy Snow": $col4wximg= "/ifxwx_images/snow_heavy.png";
break;
case "Blizzard": $col4wximg= "/ifxwx_images/snow_blizzard.png";
break;
case "Blowing Snow": $col4wximg= "/ifxwx_images/blowing_snow.png";
break;
case "Rain/Snow": $col4wximg= "/ifxwx_images/rain_snow.png";
break;
case "Freezing Rain/Snow": $col4wximg= "/ifxwx_images/freezing_rain_snow.png";
break;
case "Freezing Rain/Rain": $col4wximg= "/ifxwx_images/freezing_rain.png";
break;
case "Freezing Rain/Sleet": $col4wximg= "/ifxwx_images/freezing_rain_sleet.png";
break;
case "Rain/Sleet": $col4wximg= "/ifxwx_images/rain_sleet.png";
break;
case "Sleet": $col4wximg= "/ifxwx_images/sleet.png";
break;
case "Overcast/Haze": $col4wximg= "/ifxwx_images/overcast_haze.png";
break;
case "Haze": $col4wximg= "/ifxwx_images/haze_day_night.png";
break;
case "Sunny/Fog": $col4wximg= "/ifxwx_images/fog_day.png";
break;
case "Morning Fog": $col4wximg= "/ifxwx_images/fog_morning.png";
break;
case "Overnight Fog": $col4wximg= "/ifxwx_images/fog_night.png";
break;
case "Cloudy/Fog": $col4wximg= "/ifxwx_images/fog_overcast.png";
break;
case "Dense Fog": $col4wximg= "/ifxwx_images/fog_dense.png";
break;
case "Windy": $col4wximg= "/ifxwx_images/windy.png";
break;
case "Lunar Eclipse": $col4wximg= "/ifxwx_images/lunar_eclipse.png";
break;
case "Solar Eclipse": $col4wximg= "/ifxwx_images/solar_eclipse.png";
break;
default: $col4wximg= "/ifxwx_images/select.png";
}
	// For SESSION (form editing) check for pre-selected weather in column 3 and set the icon to match, otherwise default icon will show
} 
elseif (isset($_SESSION['col4wx'])) {
	switch ($_SESSION["col4wx"]) {
case "Sunny": $col4wximg= "/ifxwx_images/sunny.png";
break;
case "Partly Sunny": $col4wximg= "/ifxwx_images/partly_cloudy_day.png";
break;
case "Mostly Cloudy": $col4wximg= "/ifxwx_images/overcast.png";
break;
case "Clear": $col4wximg= "/ifxwx_images/clear_night.png";
break;
case "Partly Cloudy": $col4wximg= "/ifxwx_images/partly_cloudy_night.png";
break;
case "Overcast": $col4wximg= "/ifxwx_images/overcast.png";
break;
case "Isolated Rain Showers": $col4wximg= "/ifxwx_images/showers_isolated.png";
break;
case "Scattered Rain Showers": $col4wximg= "/ifxwx_images/showers_scattered.png";
break;
case "Rain": $col4wximg= "/ifxwx_images/rain.png";
break;
case "Heavy Rain": $col4wximg= "/ifxwx_images/rain_heavy.png";
break;
case "Rain and Fog": $col4wximg= "/ifxwx_images/showers_haze.png";
break;
case "Isolated T-Storms": $col4wximg= "/ifxwx_images/tstorms_isolated.png";
break;
case "Scattered T-Storms": $col4wximg= "/ifxwx_images/tstorms_scattered.png";
break;
case "Thunderstorms": $col4wximg= "/ifxwx_images/tstorms_rain.png";
break;
case "Severe T-Storms": $col4wximg= "/ifxwx_images/tstorms_severe.png";
break;
case "Snow Flurries": $col4wximg= "/ifxwx_images/snow_flurries.png";
break;
case "Scattered Snow Showers": $col4wximg= "/ifxwx_images/snow_scattered.png";
break;
case "Snow": $col4wximg= "/ifxwx_images/snow.png";
break;
case "Heavy Snow": $col4wximg= "/ifxwx_images/snow_heavy.png";
break;
case "Blizzard": $col4wximg= "/ifxwx_images/snow_blizzard.png";
break;
case "Blowing Snow": $col4wximg= "/ifxwx_images/blowing_snow.png";
break;
case "Rain/Snow": $col4wximg= "/ifxwx_images/rain_snow.png";
break;
case "Freezing Rain/Snow": $col4wximg= "/ifxwx_images/freezing_rain_snow.png";
break;
case "Freezing Rain/Rain": $col4wximg= "/ifxwx_images/freezing_rain.png";
break;
case "Freezing Rain/Sleet": $col4wximg= "/ifxwx_images/freezing_rain_sleet.png";
break;
case "Rain/Sleet": $col4wximg= "/ifxwx_images/rain_sleet.png";
break;
case "Sleet": $col4wximg= "/ifxwx_images/sleet.png";
break;
case "Overcast/Haze": $col4wximg= "/ifxwx_images/overcast_haze.png";
break;
case "Haze": $col4wximg= "/ifxwx_images/haze_day_night.png";
break;
case "Sunny/Fog": $col4wximg= "/ifxwx_images/fog_day.png";
break;
case "Morning Fog": $col4wximg= "/ifxwx_images/fog_morning.png";
break;
case "Overnight Fog": $col4wximg= "/ifxwx_images/fog_night.png";
break;
case "Cloudy/Fog": $col4wximg= "/ifxwx_images/fog_overcast.png";
break;
case "Dense Fog": $col4wximg= "/ifxwx_images/fog_dense.png";
break;
case "Windy": $col4wximg= "/ifxwx_images/windy.png";
break;
case "Lunar Eclipse": $col4wximg= "/ifxwx_images/lunar_eclipse.png";
break;
case "Solar Eclipse": $col4wximg= "/ifxwx_images/solar_eclipse.png";
break;
default: $col4wximg= "/ifxwx_images/select.png";
}
}
// Column 5 weather icons
	// For POST (form validation) check for pre-selected weather in column 5 and set the icon to match, otherwise default icon will show
if (isset($_POST['col5wx'])) {
	switch ($_POST["col5wx"]) {
case "Sunny": $col5wximg= "/ifxwx_images/sunny.png";
break;
case "Partly Sunny": $col5wximg= "/ifxwx_images/partly_cloudy_day.png";
break;
case "Mostly Cloudy": $col5wximg= "/ifxwx_images/overcast.png";
break;
case "Clear": $col5wximg= "/ifxwx_images/clear_night.png";
break;
case "Partly Cloudy": $col5wximg= "/ifxwx_images/partly_cloudy_night.png";
break;
case "Overcast": $col5wximg= "/ifxwx_images/overcast.png";
break;
case "Isolated Rain Showers": $col5wximg= "/ifxwx_images/showers_isolated.png";
break;
case "Scattered Rain Showers": $col5wximg= "/ifxwx_images/showers_scattered.png";
break;
case "Rain": $col5wximg= "/ifxwx_images/rain.png";
break;
case "Heavy Rain": $col5wximg= "/ifxwx_images/rain_heavy.png";
break;
case "Rain and Fog": $col5wximg= "/ifxwx_images/showers_haze.png";
break;
case "Isolated T-Storms": $col5wximg= "/ifxwx_images/tstorms_isolated.png";
break;
case "Scattered T-Storms": $col5wximg= "/ifxwx_images/tstorms_scattered.png";
break;
case "Thunderstorms": $col5wximg= "/ifxwx_images/tstorms_rain.png";
break;
case "Severe T-Storms": $col5wximg= "/ifxwx_images/tstorms_severe.png";
break;
case "Snow Flurries": $col5wximg= "/ifxwx_images/snow_flurries.png";
break;
case "Scattered Snow Showers": $col5wximg= "/ifxwx_images/snow_scattered.png";
break;
case "Snow": $col5wximg= "/ifxwx_images/snow.png";
break;
case "Heavy Snow": $col5wximg= "/ifxwx_images/snow_heavy.png";
break;
case "Blizzard": $col5wximg= "/ifxwx_images/snow_blizzard.png";
break;
case "Blowing Snow": $col5wximg= "/ifxwx_images/blowing_snow.png";
break;
case "Rain/Snow": $col5wximg= "/ifxwx_images/rain_snow.png";
break;
case "Freezing Rain/Snow": $col5wximg= "/ifxwx_images/freezing_rain_snow.png";
break;
case "Freezing Rain/Rain": $col5wximg= "/ifxwx_images/freezing_rain.png";
break;
case "Freezing Rain/Sleet": $col5wximg= "/ifxwx_images/freezing_rain_sleet.png";
break;
case "Rain/Sleet": $col5wximg= "/ifxwx_images/rain_sleet.png";
break;
case "Sleet": $col5wximg= "/ifxwx_images/sleet.png";
break;
case "Overcast/Haze": $col5wximg= "/ifxwx_images/overcast_haze.png";
break;
case "Haze": $col5wximg= "/ifxwx_images/haze_day_night.png";
break;
case "Sunny/Fog": $col5wximg= "/ifxwx_images/fog_day.png";
break;
case "Morning Fog": $col5wximg= "/ifxwx_images/fog_morning.png";
break;
case "Overnight Fog": $col5wximg= "/ifxwx_images/fog_night.png";
break;
case "Cloudy/Fog": $col5wximg= "/ifxwx_images/fog_overcast.png";
break;
case "Dense Fog": $col5wximg= "/ifxwx_images/fog_dense.png";
break;
case "Windy": $col5wximg= "/ifxwx_images/windy.png";
break;
case "Lunar Eclipse": $col5wximg= "/ifxwx_images/lunar_eclipse.png";
break;
case "Solar Eclipse": $col5wximg= "/ifxwx_images/solar_eclipse.png";
break;
default: $col5wximg= "/ifxwx_images/select.png";
}
	// For SESSION (form editing) check for pre-selected weather in column 5 and set the icon to match, otherwise default icon will show
} 
elseif (isset($_SESSION['col5wx'])) {
	switch ($_SESSION["col5wx"]) {
case "Sunny": $col5wximg= "/ifxwx_images/sunny.png";
break;
case "Partly Sunny": $col5wximg= "/ifxwx_images/partly_cloudy_day.png";
break;
case "Mostly Cloudy": $col5wximg= "/ifxwx_images/overcast.png";
break;
case "Clear": $col5wximg= "/ifxwx_images/clear_night.png";
break;
case "Partly Cloudy": $col5wximg= "/ifxwx_images/partly_cloudy_night.png";
break;
case "Overcast": $col5wximg= "/ifxwx_images/overcast.png";
break;
case "Isolated Rain Showers": $col5wximg= "/ifxwx_images/showers_isolated.png";
break;
case "Scattered Rain Showers": $col5wximg= "/ifxwx_images/showers_scattered.png";
break;
case "Rain": $col5wximg= "/ifxwx_images/rain.png";
break;
case "Heavy Rain": $col5wximg= "/ifxwx_images/rain_heavy.png";
break;
case "Rain and Fog": $col5wximg= "/ifxwx_images/showers_haze.png";
break;
case "Isolated T-Storms": $col5wximg= "/ifxwx_images/tstorms_isolated.png";
break;
case "Scattered T-Storms": $col5wximg= "/ifxwx_images/tstorms_scattered.png";
break;
case "Thunderstorms": $col5wximg= "/ifxwx_images/tstorms_rain.png";
break;
case "Severe T-Storms": $col5wximg= "/ifxwx_images/tstorms_severe.png";
break;
case "Snow Flurries": $col5wximg= "/ifxwx_images/snow_flurries.png";
break;
case "Scattered Snow Showers": $col5wximg= "/ifxwx_images/snow_scattered.png";
break;
case "Snow": $col5wximg= "/ifxwx_images/snow.png";
break;
case "Heavy Snow": $col5wximg= "/ifxwx_images/snow_heavy.png";
break;
case "Blizzard": $col5wximg= "/ifxwx_images/snow_blizzard.png";
break;
case "Blowing Snow": $col5wximg= "/ifxwx_images/blowing_snow.png";
break;
case "Rain/Snow": $col5wximg= "/ifxwx_images/rain_snow.png";
break;
case "Freezing Rain/Snow": $col5wximg= "/ifxwx_images/freezing_rain_snow.png";
break;
case "Freezing Rain/Rain": $col5wximg= "/ifxwx_images/freezing_rain.png";
break;
case "Freezing Rain/Sleet": $col5wximg= "/ifxwx_images/freezing_rain_sleet.png";
break;
case "Rain/Sleet": $col5wximg= "/ifxwx_images/rain_sleet.png";
break;
case "Sleet": $col5wximg= "/ifxwx_images/sleet.png";
break;
case "Overcast/Haze": $col5wximg= "/ifxwx_images/overcast_haze.png";
break;
case "Haze": $col5wximg= "/ifxwx_images/haze_day_night.png";
break;
case "Sunny/Fog": $col5wximg= "/ifxwx_images/fog_day.png";
break;
case "Morning Fog": $col5wximg= "/ifxwx_images/fog_morning.png";
break;
case "Overnight Fog": $col5wximg= "/ifxwx_images/fog_night.png";
break;
case "Cloudy/Fog": $col5wximg= "/ifxwx_images/fog_overcast.png";
break;
case "Dense Fog": $col5wximg= "/ifxwx_images/fog_dense.png";
break;
case "Windy": $col5wximg= "/ifxwx_images/windy.png";
break;
case "Lunar Eclipse": $col5wximg= "/ifxwx_images/lunar_eclipse.png";
break;
case "Solar Eclipse": $col5wximg= "/ifxwx_images/solar_eclipse.png";
break;
default: $col5wximg= "/ifxwx_images/select.png";
}
}
// Column 6 weather icons
	// For POST (form validation) check for pre-selected weather in column 6 and set the icon to match, otherwise default icon will show
if (isset($_POST['col6wx'])) {
	switch ($_POST["col6wx"]) {
case "Sunny": $col6wximg= "/ifxwx_images/sunny.png";
break;
case "Partly Sunny": $col6wximg= "/ifxwx_images/partly_cloudy_day.png";
break;
case "Mostly Cloudy": $col6wximg= "/ifxwx_images/overcast.png";
break;
case "Clear": $col6wximg= "/ifxwx_images/clear_night.png";
break;
case "Partly Cloudy": $col6wximg= "/ifxwx_images/partly_cloudy_night.png";
break;
case "Overcast": $col6wximg= "/ifxwx_images/overcast.png";
break;
case "Isolated Rain Showers": $col6wximg= "/ifxwx_images/showers_isolated.png";
break;
case "Scattered Rain Showers": $col6wximg= "/ifxwx_images/showers_scattered.png";
break;
case "Rain": $col6wximg= "/ifxwx_images/rain.png";
break;
case "Heavy Rain": $col6wximg= "/ifxwx_images/rain_heavy.png";
break;
case "Rain and Fog": $col6wximg= "/ifxwx_images/showers_haze.png";
break;
case "Isolated T-Storms": $col6wximg= "/ifxwx_images/tstorms_isolated.png";
break;
case "Scattered T-Storms": $col6wximg= "/ifxwx_images/tstorms_scattered.png";
break;
case "Thunderstorms": $col6wximg= "/ifxwx_images/tstorms_rain.png";
break;
case "Severe T-Storms": $col6wximg= "/ifxwx_images/tstorms_severe.png";
break;
case "Snow Flurries": $col6wximg= "/ifxwx_images/snow_flurries.png";
break;
case "Scattered Snow Showers": $col6wximg= "/ifxwx_images/snow_scattered.png";
break;
case "Snow": $col6wximg= "/ifxwx_images/snow.png";
break;
case "Heavy Snow": $col6wximg= "/ifxwx_images/snow_heavy.png";
break;
case "Blizzard": $col6wximg= "/ifxwx_images/snow_blizzard.png";
break;
case "Blowing Snow": $col6wximg= "/ifxwx_images/blowing_snow.png";
break;
case "Rain/Snow": $col6wximg= "/ifxwx_images/rain_snow.png";
break;
case "Freezing Rain/Snow": $col6wximg= "/ifxwx_images/freezing_rain_snow.png";
break;
case "Freezing Rain/Rain": $col6wximg= "/ifxwx_images/freezing_rain.png";
break;
case "Freezing Rain/Sleet": $col6wximg= "/ifxwx_images/freezing_rain_sleet.png";
break;
case "Rain/Sleet": $col6wximg= "/ifxwx_images/rain_sleet.png";
break;
case "Sleet": $col6wximg= "/ifxwx_images/sleet.png";
break;
case "Overcast/Haze": $col6wximg= "/ifxwx_images/overcast_haze.png";
break;
case "Haze": $col6wximg= "/ifxwx_images/haze_day_night.png";
break;
case "Sunny/Fog": $col6wximg= "/ifxwx_images/fog_day.png";
break;
case "Morning Fog": $col6wximg= "/ifxwx_images/fog_morning.png";
break;
case "Overnight Fog": $col6wximg= "/ifxwx_images/fog_night.png";
break;
case "Cloudy/Fog": $col6wximg= "/ifxwx_images/fog_overcast.png";
break;
case "Dense Fog": $col6wximg= "/ifxwx_images/fog_dense.png";
break;
case "Windy": $col6wximg= "/ifxwx_images/windy.png";
break;
case "Lunar Eclipse": $col6wximg= "/ifxwx_images/lunar_eclipse.png";
break;
case "Solar Eclipse": $col6wximg= "/ifxwx_images/solar_eclipse.png";
break;
default: $col6wximg= "/ifxwx_images/select.png";
}
	// For SESSION (form editing) check for pre-selected weather in column 6 and set the icon to match, otherwise default icon will show
} 
elseif (isset($_SESSION['col6wx'])) {
	switch ($_SESSION["col6wx"]) {
case "Sunny": $col6wximg= "/ifxwx_images/sunny.png";
break;
case "Partly Sunny": $col6wximg= "/ifxwx_images/partly_cloudy_day.png";
break;
case "Mostly Cloudy": $col6wximg= "/ifxwx_images/overcast.png";
break;
case "Clear": $col6wximg= "/ifxwx_images/clear_night.png";
break;
case "Partly Cloudy": $col6wximg= "/ifxwx_images/partly_cloudy_night.png";
break;
case "Overcast": $col6wximg= "/ifxwx_images/overcast.png";
break;
case "Isolated Rain Showers": $col6wximg= "/ifxwx_images/showers_isolated.png";
break;
case "Scattered Rain Showers": $col6wximg= "/ifxwx_images/showers_scattered.png";
break;
case "Rain": $col6wximg= "/ifxwx_images/rain.png";
break;
case "Heavy Rain": $col6wximg= "/ifxwx_images/rain_heavy.png";
break;
case "Rain and Fog": $col6wximg= "/ifxwx_images/showers_haze.png";
break;
case "Isolated T-Storms": $col6wximg= "/ifxwx_images/tstorms_isolated.png";
break;
case "Scattered T-Storms": $col6wximg= "/ifxwx_images/tstorms_scattered.png";
break;
case "Thunderstorms": $col6wximg= "/ifxwx_images/tstorms_rain.png";
break;
case "Severe T-Storms": $col6wximg= "/ifxwx_images/tstorms_severe.png";
break;
case "Snow Flurries": $col6wximg= "/ifxwx_images/snow_flurries.png";
break;
case "Scattered Snow Showers": $col6wximg= "/ifxwx_images/snow_scattered.png";
break;
case "Snow": $col6wximg= "/ifxwx_images/snow.png";
break;
case "Heavy Snow": $col6wximg= "/ifxwx_images/snow_heavy.png";
break;
case "Blizzard": $col6wximg= "/ifxwx_images/snow_blizzard.png";
break;
case "Blowing Snow": $col6wximg= "/ifxwx_images/blowing_snow.png";
break;
case "Rain/Snow": $col6wximg= "/ifxwx_images/rain_snow.png";
break;
case "Freezing Rain/Snow": $col6wximg= "/ifxwx_images/freezing_rain_snow.png";
break;
case "Freezing Rain/Rain": $col6wximg= "/ifxwx_images/freezing_rain.png";
break;
case "Freezing Rain/Sleet": $col6wximg= "/ifxwx_images/freezing_rain_sleet.png";
break;
case "Rain/Sleet": $col6wximg= "/ifxwx_images/rain_sleet.png";
break;
case "Sleet": $col6wximg= "/ifxwx_images/sleet.png";
break;
case "Overcast/Haze": $col6wximg= "/ifxwx_images/overcast_haze.png";
break;
case "Haze": $col6wximg= "/ifxwx_images/haze_day_night.png";
break;
case "Sunny/Fog": $col6wximg= "/ifxwx_images/fog_day.png";
break;
case "Morning Fog": $col6wximg= "/ifxwx_images/fog_morning.png";
break;
case "Overnight Fog": $col6wximg= "/ifxwx_images/fog_night.png";
break;
case "Cloudy/Fog": $col6wximg= "/ifxwx_images/fog_overcast.png";
break;
case "Dense Fog": $col6wximg= "/ifxwx_images/fog_dense.png";
break;
case "Windy": $col6wximg= "/ifxwx_images/windy.png";
break;
case "Lunar Eclipse": $col6wximg= "/ifxwx_images/lunar_eclipse.png";
break;
case "Solar Eclipse": $col6wximg= "/ifxwx_images/solar_eclipse.png";
break;
default: $col6wximg= "/ifxwx_images/select.png";
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
<p><img style="width: 70px; height: 61px;" alt="" src="/ifxwx_images/logo.png"> Version <?php echo " " . $version ?> <br><big style="font-family: Helvetica,Arial,sans-serif;"><big><big>Forecast Composer</big></big></big>
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
					<label id="col2title" for="col2label"><?php if (isset($_POST['col2label'])) {echo $_POST['col2label'];} elseif (isset($_SESSION['col2label'])) {echo $_SESSION['col2label'];} else {echo $col2label;};?></label><br>
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
				<!-- Column 3 variables -->
			<div class="two columns" style="text-align: center;" id="hr24-36">
				
				<p>
					<label id="col3title" for="col3label"><?php if (isset($_POST['fxstarttime'])) {echo $_POST['fxstarttime'];} elseif (isset($_SESSION['fxstarttime'])) {echo $_SESSION['fxstarttime'];} else {echo $fxvalidname;};?></label><br>
					<input style="width:90%; background-color: <?php echo $col3fieldErr11 ?>" name="col3" id="col3label" placeholder="Monday" type="text" value="<?php if (isset($_POST['col3'])) {echo $_POST['col3'];} elseif (isset($_SESSION['col3'])) {echo $_SESSION['col3'];} else {echo $col3string;};?>">*
					<br>
				</p>
				<p>
					<select style="width:90%; background-color: <?php echo $col3fieldErr12 ?>" name="col3wx" onchange="document.getElementById('col3desc').value=this.value; updatecol3wximg(this.value)">
						<option value="<?php if (isset($_POST['col3wx'])) {echo $_POST['col3wx'];} elseif (isset($_SESSION['col3wx'])) {echo $_SESSION['col3wx'];} else {echo 'Weather';};?>"><?php if (isset($_POST['col3wx'])) {echo $_POST['col3wx'];} elseif (isset($_SESSION['col3wx'])) {echo $_SESSION['col3wx'];} else {echo 'Weather';};?></option>
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
if (isset($_POST['col3wx'])) {
	echo '<img src="' . $col3wximg . '" alt="Weather Icon Preview" style="width:70px;height:70px;" id="col3wximg" name="col3wximg">';
} 
elseif (isset($_SESSION['col3wx'])) {
	echo '<img src="' . $col3wximg . '" alt="Weather Icon Preview" style="width:70px;height:70px;" id="col3wximg" name="col3wximg">';
} 
else {
	echo '<img src="/ifxwx_images/select.png" alt="Weather Icon Preview" style="width:70px;height:70px;" id="col3wximg" name="col3wximg">';
	 }
?>
				</p>
				<p>
					<label for="col3desc">Weather Description*</label>
					<br>
					<input style="width:90%; background-color: <?php echo $col3fieldErr13 ?>" name="col3desc" placeholder="Mostly Sunny" id="col3desc" type="text" value="<?php if (isset($_POST['col3desc'])) {echo $_POST['col3desc'];} elseif (isset($_SESSION['col3desc'])) {echo $_SESSION['col3desc'];} else {echo '';};?>">
				
					</p>
			
					<label for="col3temp">Temperature*</label>
					<br>
					<input style="width:90%; background-color: <?php echo $col3fieldErr14 ?>" placeholder="High/Low" min="-100" max="134" maxlength="3" name="col3temp" id="col3temp" type="number" value="<?php if (isset($_POST['col3temp'])) {echo $_POST['col3temp'];} elseif (isset($_SESSION['col3temp'])) {echo $_SESSION['col3temp'];} else {echo '';};?>"><br>
				<form id="setcol3highlow">
					<input type="radio" id="col3high" name="col3highlow" value="red" <?php echo $col3highcheck; ?>><small>High</small>
					<input type="radio" id="col3low" name="col3highlow" value="blue" <?php echo $col3lowcheck; ?>><small>Low</small></form>
				
				<br>
			<p>
					<label for="col3pop">Precipitation</label>
					<br>
					<input style="width:90%" min="0" max="100" size="15" maxlength="3" name="col3pop" placeholder="Probability %" id="col3pop" type="number" value="<?php if (isset($_POST['col3pop'])) {echo $_POST['col3pop'];} elseif (isset($_SESSION['col3pop'])) {echo $_SESSION['col3pop'];} else {echo '';};?>"><label style="display: none;" for="col3precip" id="col3precip_label">Precipitation Total</label><input style="width:90%" step=".01" min="0" max="100" name="col3precip" placeholder="Precip Total" id="col3precip" type="number" value="<?php if (isset($_POST['col3precip'])) {echo $_POST['col3precip'];} elseif (isset($_SESSION['col3precip'])) {echo $_SESSION['col3precip'];} else {echo '';};?>"><br><small><small><strong>Hide Rain Total<input type="checkbox" name="col3showrain" value="1" <?php echo (isset($_POST['col3showrain']))?$checked:$unchecked; echo (isset($_SESSION['col3showrain']))?$checked:$unchecked;?>></strong></small></small>
					</p>
			<p>
					<label for="col3snowmin">Snow</label>
					<br>
			<input style="width:90%; background-color: <?php echo $col3logicErr1; ?>" step=".5" min="0" max="100" name="col3snowmin" placeholder="Min Accum" id="col3snowmin" type="number" value="<?php if (isset($_POST['col3snowmin'])) {echo $_POST['col3snowmin'];} elseif (isset($_SESSION['col3snowmin'])) {echo $_SESSION['col3snowmin'];} else {echo '';};?>"><label style="display: none;" for="col3snowmax" id="col3snowmax_label">Day 1 Snow Maximum</label><input style="width:90%; background-color: <?php echo $col3logicErr1; ?>" step=".5" min="0" max="100" name="col3snowmax" placeholder="Max Accum" id="col3snowmax" type="number" value="<?php if (isset($_POST['col3snowmax'])) {echo $_POST['col3snowmax'];} elseif (isset($_SESSION['col3snowmax'])) {echo $_SESSION['col3snowmax'];} else {echo '';};?>"><br>
				</p>
			<p>
		
					<label for="col3wind">Wind</label>
					<br>
					<input style="width:90%; background-color: <?php echo $col3logicErr2; ?>" maxlength="3" max="240" min="0" name="col3windmin" placeholder="Min Sustained" id="col3windmin" type="number" value="<?php if (isset($_POST['col3windmin'])) {echo $_POST['col3windmin'];} elseif (isset($_SESSION['col3windmin'])) {echo $_SESSION['col3windmin'];} else {echo '';};?>"><input style="width:90%; background-color: <?php echo $col3logicErr2; ?>" maxlength="3" max="240" min="0" name="col3windmax" placeholder="Max Sustained" id="col3windmax" type="number" value="<?php if (isset($_POST['col3windmax'])) {echo $_POST['col3windmax'];} elseif (isset($_SESSION['col3windmax'])) {echo $_SESSION['col3windmax'];} else {echo '';};?>"><input style="width:90%; background-color: <?php echo $col3logicErr3; ?>" maxlength="3" max="240" min="0" name="col3windgust" placeholder="Max Gust" id="col3windgust" type="number" value="<?php if (isset($_POST['col3windgust'])) {echo $_POST['col3windgust'];} elseif (isset($_SESSION['col3windgust'])) {echo $_SESSION['col3windgust'];} else {echo '';};?>">
					<select style="width:80%" name="col3winddir">
						<option value="<?php if (isset($_POST['col3winddir'])) {echo $_POST['col3winddir'];} elseif (isset($_SESSION['col3winddir'])) {echo $_SESSION['col3winddir'];} else {echo '';};?>"><?php if (isset($_POST['col3winddir'])) {echo $_POST['col3winddir'];} elseif (isset($_SESSION['col3winddir'])) {echo $_SESSION['col3winddir'];} else {echo 'Direction';};?></option>
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
					<br><small><small><strong>Hide Wind Info?<input type="checkbox" name="col3showwind" value="1" <?php echo (isset($_POST['col3showwind']))?$checked:$unchecked; echo (isset($_SESSION['col3showwind']))?$checked:$unchecked;?>></strong></small></small>
				</p>
				<label for="col3detail">Additional Details</label>
				<br>
				<textarea style="width:95%" height="200px" name="col3detail" id="col3detail" placeholder="Timing, intensity, confidence, etc." type="text"><?php if (isset($_POST['col3detail'])) {echo $_POST['col3detail'];} elseif (isset($_SESSION['col3detail'])) {echo $_SESSION['col3detail'];} else {echo '';};?></textarea>
								<br>
			</div>
				<!-- End Column 3 Input-->
				<!-- Column 4 variables -->
			<div class="two columns" style="text-align: center;" id="hr36-48">
				
				<p>
					<label id="col4title" for="col4label"><?php if (isset($_POST['col2label'])) {echo $_POST['col2label'];} elseif (isset($_SESSION['col2label'])) {echo $_SESSION['col2label'];} else {echo $col2label;};?></label><br>
					<input style="width:90%; background-color: <?php echo $col4fieldErr11 ?>" name="col4" id="col4label" placeholder="Monday" type="text" value="<?php if (isset($_POST['col4'])) {echo $_POST['col4'];} elseif (isset($_SESSION['col4'])) {echo $_SESSION['col4'];} else {echo $col4string;};?>">*
					<br>
				</p>
				<p>
					<select style="width:90%; background-color: <?php echo $col4fieldErr12 ?>" name="col4wx" onchange="document.getElementById('col4desc').value=this.value; updatecol4wximg(this.value)">
						<option value="<?php if (isset($_POST['col4wx'])) {echo $_POST['col4wx'];} elseif (isset($_SESSION['col4wx'])) {echo $_SESSION['col4wx'];} else {echo 'Weather';};?>"><?php if (isset($_POST['col4wx'])) {echo $_POST['col4wx'];} elseif (isset($_SESSION['col4wx'])) {echo $_SESSION['col4wx'];} else {echo 'Weather';};?></option>
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
if (isset($_POST['col4wx'])) {
	echo '<img src="' . $col4wximg . '" alt="Weather Icon Preview" style="width:70px;height:70px;" id="col4wximg" name="col4wximg">';
} 
elseif (isset($_SESSION['col4wx'])) {
	echo '<img src="' . $col4wximg . '" alt="Weather Icon Preview" style="width:70px;height:70px;" id="col4wximg" name="col4wximg">';
} 
else {
	echo '<img src="/ifxwx_images/select.png" alt="Weather Icon Preview" style="width:70px;height:70px;" id="col4wximg" name="col4wximg">';
	 }
?>
				</p>
				<p>
					<label for="col4desc">Weather Description*</label>
					<br>
					<input style="width:90%; background-color: <?php echo $col4fieldErr13 ?>" name="col4desc" placeholder="Mostly Sunny" id="col4desc" type="text" value="<?php if (isset($_POST['col4desc'])) {echo $_POST['col4desc'];} elseif (isset($_SESSION['col4desc'])) {echo $_SESSION['col4desc'];} else {echo '';};?>">
				
					</p>
			
					<label for="col4temp">Temperature*</label>
					<br>
					<input style="width:90%; background-color: <?php echo $col4fieldErr14 ?>" placeholder="High/Low" min="-100" max="134" maxlength="3" name="col4temp" id="col4temp" type="number" value="<?php if (isset($_POST['col4temp'])) {echo $_POST['col4temp'];} elseif (isset($_SESSION['col4temp'])) {echo $_SESSION['col4temp'];} else {echo '';};?>"><br>
				<form id="setcol4highlow">
					<input type="radio" id="col4high" name="col4highlow" value="red" <?php echo $col4highcheck; ?>><small>High</small>
					<input type="radio" id="col4low" name="col4highlow" value="blue" <?php echo $col4lowcheck; ?>><small>Low</small></form>
				
				<br>
			<p>
					<label for="col4pop">Precipitation</label>
					<br>
					<input style="width:90%" min="0" max="100" size="15" maxlength="3" name="col4pop" placeholder="Probability %" id="col4pop" type="number" value="<?php if (isset($_POST['col4pop'])) {echo $_POST['col4pop'];} elseif (isset($_SESSION['col4pop'])) {echo $_SESSION['col4pop'];} else {echo '';};?>"><label style="display: none;" for="col4precip" id="col4precip_label">Precipitation Total</label><input style="width:90%" step=".01" min="0" max="100" name="col4precip" placeholder="Precip Total" id="col4precip" type="number" value="<?php if (isset($_POST['col4precip'])) {echo $_POST['col4precip'];} elseif (isset($_SESSION['col4precip'])) {echo $_SESSION['col4precip'];} else {echo '';};?>"><br><small><small><strong>Hide Rain Total<input type="checkbox" name="col4showrain" value="1" <?php echo (isset($_POST['col4showrain']))?$checked:$unchecked; echo (isset($_SESSION['col4showrain']))?$checked:$unchecked;?>></strong></small></small>
					</p>
			<p>
					<label for="col4snowmin">Snow</label>
					<br>
			<input style="width:90%; background-color: <?php echo $col4logicErr1; ?>" step=".5" min="0" max="100" name="col4snowmin" placeholder="Min Accum" id="col4snowmin" type="number" value="<?php if (isset($_POST['col4snowmin'])) {echo $_POST['col4snowmin'];} elseif (isset($_SESSION['col4snowmin'])) {echo $_SESSION['col4snowmin'];} else {echo '';};?>"><label style="display: none;" for="col4snowmax" id="col4snowmax_label">Day 1 Snow Maximum</label><input style="width:90%; background-color: <?php echo $col4logicErr1; ?>" step=".5" min="0" max="100" name="col4snowmax" placeholder="Max Accum" id="col4snowmax" type="number" value="<?php if (isset($_POST['col4snowmax'])) {echo $_POST['col4snowmax'];} elseif (isset($_SESSION['col4snowmax'])) {echo $_SESSION['col4snowmax'];} else {echo '';};?>"><br>
				</p>
			<p>
		
					<label for="col4wind">Wind</label>
					<br>
					<input style="width:90%; background-color: <?php echo $col4logicErr2; ?>" maxlength="3" max="240" min="0" name="col4windmin" placeholder="Min Sustained" id="col4windmin" type="number" value="<?php if (isset($_POST['col4windmin'])) {echo $_POST['col4windmin'];} elseif (isset($_SESSION['col4windmin'])) {echo $_SESSION['col4windmin'];} else {echo '';};?>"><input style="width:90%; background-color: <?php echo $col4logicErr2; ?>" maxlength="3" max="240" min="0" name="col4windmax" placeholder="Max Sustained" id="col4windmax" type="number" value="<?php if (isset($_POST['col4windmax'])) {echo $_POST['col4windmax'];} elseif (isset($_SESSION['col4windmax'])) {echo $_SESSION['col4windmax'];} else {echo '';};?>"><input style="width:90%; background-color: <?php echo $col4logicErr3; ?>" maxlength="3" max="240" min="0" name="col4windgust" placeholder="Max Gust" id="col4windgust" type="number" value="<?php if (isset($_POST['col4windgust'])) {echo $_POST['col4windgust'];} elseif (isset($_SESSION['col4windgust'])) {echo $_SESSION['col4windgust'];} else {echo '';};?>">
					<select style="width:80%" name="col4winddir">
						<option value="<?php if (isset($_POST['col4winddir'])) {echo $_POST['col4winddir'];} elseif (isset($_SESSION['col4winddir'])) {echo $_SESSION['col4winddir'];} else {echo '';};?>"><?php if (isset($_POST['col4winddir'])) {echo $_POST['col4winddir'];} elseif (isset($_SESSION['col4winddir'])) {echo $_SESSION['col4winddir'];} else {echo 'Direction';};?></option>
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
					<br><small><small><strong>Hide Wind Info?<input type="checkbox" name="col4showwind" value="1" <?php echo (isset($_POST['col4showwind']))?$checked:$unchecked; echo (isset($_SESSION['col4showwind']))?$checked:$unchecked;?>></strong></small></small>
				</p>
				<label for="col4detail">Additional Details</label>
				<br>
				<textarea style="width:95%" height="200px" name="col4detail" id="col4detail" placeholder="Timing, intensity, confidence, etc." type="text"><?php if (isset($_POST['col4detail'])) {echo $_POST['col4detail'];} elseif (isset($_SESSION['col4detail'])) {echo $_SESSION['col4detail'];} else {echo '';};?></textarea>
								<br>
			</div>
				<!-- End Column 4 Input-->
				<!-- Column 5 variables -->
			<div class="two columns" style="text-align: center;" id="hr48-60">
				
				<p>
					<label id="col5title" for="col5label"><?php if (isset($_POST['fxstarttime'])) {echo $_POST['fxstarttime'];} elseif (isset($_SESSION['fxstarttime'])) {echo $_SESSION['fxstarttime'];} else {echo $fxvalidname;};?></label><br>
					<input style="width:90%; background-color: <?php echo $col5fieldErr11 ?>" name="col5" id="col5label" placeholder="Monday" type="text" value="<?php if (isset($_POST['col5'])) {echo $_POST['col5'];} elseif (isset($_SESSION['col5'])) {echo $_SESSION['col5'];} else {echo $col5string;};?>">*
					<br>
				</p>
				<p>
					<select style="width:90%; background-color: <?php echo $col5fieldErr12 ?>" name="col5wx" onchange="document.getElementById('col5desc').value=this.value; updatecol5wximg(this.value)">
						<option value="<?php if (isset($_POST['col5wx'])) {echo $_POST['col5wx'];} elseif (isset($_SESSION['col5wx'])) {echo $_SESSION['col5wx'];} else {echo 'Weather';};?>"><?php if (isset($_POST['col5wx'])) {echo $_POST['col5wx'];} elseif (isset($_SESSION['col5wx'])) {echo $_SESSION['col5wx'];} else {echo 'Weather';};?></option>
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
if (isset($_POST['col5wx'])) {
	echo '<img src="' . $col5wximg . '" alt="Weather Icon Preview" style="width:70px;height:70px;" id="col5wximg" name="col5wximg">';
} 
elseif (isset($_SESSION['col5wx'])) {
	echo '<img src="' . $col5wximg . '" alt="Weather Icon Preview" style="width:70px;height:70px;" id="col5wximg" name="col5wximg">';
} 
else {
	echo '<img src="/ifxwx_images/select.png" alt="Weather Icon Preview" style="width:70px;height:70px;" id="col5wximg" name="col5wximg">';
	 }
?>
				</p>
				<p>
					<label for="col5desc">Weather Description*</label>
					<br>
					<input style="width:90%; background-color: <?php echo $col5fieldErr13 ?>" name="col5desc" placeholder="Mostly Sunny" id="col5desc" type="text" value="<?php if (isset($_POST['col5desc'])) {echo $_POST['col5desc'];} elseif (isset($_SESSION['col5desc'])) {echo $_SESSION['col5desc'];} else {echo '';};?>">
				
					</p>
			
					<label for="col5temp">Temperature*</label>
					<br>
					<input style="width:90%; background-color: <?php echo $col5fieldErr14 ?>" placeholder="High/Low" min="-100" max="134" maxlength="3" name="col5temp" id="col5temp" type="number" value="<?php if (isset($_POST['col5temp'])) {echo $_POST['col5temp'];} elseif (isset($_SESSION['col5temp'])) {echo $_SESSION['col5temp'];} else {echo '';};?>"><br>
				<form id="setcol5highlow">
					<input type="radio" id="col5high" name="col5highlow" value="red" <?php echo $col5highcheck; ?>><small>High</small>
					<input type="radio" id="col5low" name="col5highlow" value="blue" <?php echo $col5lowcheck; ?>><small>Low</small></form>
				
				<br>
			<p>
					<label for="col5pop">Precipitation</label>
					<br>
					<input style="width:90%" min="0" max="100" size="15" maxlength="3" name="col5pop" placeholder="Probability %" id="col5pop" type="number" value="<?php if (isset($_POST['col5pop'])) {echo $_POST['col5pop'];} elseif (isset($_SESSION['col5pop'])) {echo $_SESSION['col5pop'];} else {echo '';};?>"><label style="display: none;" for="col5precip" id="col5precip_label">Precipitation Total</label><input style="width:90%" step=".01" min="0" max="100" name="col5precip" placeholder="Precip Total" id="col5precip" type="number" value="<?php if (isset($_POST['col5precip'])) {echo $_POST['col5precip'];} elseif (isset($_SESSION['col5precip'])) {echo $_SESSION['col5precip'];} else {echo '';};?>"><br><small><small><strong>Hide Rain Total<input type="checkbox" name="col5showrain" value="1" <?php echo (isset($_POST['col5showrain']))?$checked:$unchecked; echo (isset($_SESSION['col5showrain']))?$checked:$unchecked;?>></strong></small></small>
					</p>
			<p>
					<label for="col5snowmin">Snow</label>
					<br>
			<input style="width:90%; background-color: <?php echo $col5logicErr1; ?>" step=".5" min="0" max="100" name="col5snowmin" placeholder="Min Accum" id="col5snowmin" type="number" value="<?php if (isset($_POST['col5snowmin'])) {echo $_POST['col5snowmin'];} elseif (isset($_SESSION['col5snowmin'])) {echo $_SESSION['col5snowmin'];} else {echo '';};?>"><label style="display: none;" for="col5snowmax" id="col5snowmax_label">Day 1 Snow Maximum</label><input style="width:90%; background-color: <?php echo $col5logicErr1; ?>" step=".5" min="0" max="100" name="col5snowmax" placeholder="Max Accum" id="col5snowmax" type="number" value="<?php if (isset($_POST['col5snowmax'])) {echo $_POST['col5snowmax'];} elseif (isset($_SESSION['col5snowmax'])) {echo $_SESSION['col5snowmax'];} else {echo '';};?>"><br>
				</p>
			<p>
		
					<label for="col5wind">Wind</label>
					<br>
					<input style="width:90%; background-color: <?php echo $col5logicErr2; ?>" maxlength="3" max="240" min="0" name="col5windmin" placeholder="Min Sustained" id="col5windmin" type="number" value="<?php if (isset($_POST['col5windmin'])) {echo $_POST['col5windmin'];} elseif (isset($_SESSION['col5windmin'])) {echo $_SESSION['col5windmin'];} else {echo '';};?>"><input style="width:90%; background-color: <?php echo $col5logicErr2; ?>" maxlength="3" max="240" min="0" name="col5windmax" placeholder="Max Sustained" id="col5windmax" type="number" value="<?php if (isset($_POST['col5windmax'])) {echo $_POST['col5windmax'];} elseif (isset($_SESSION['col5windmax'])) {echo $_SESSION['col5windmax'];} else {echo '';};?>"><input style="width:90%; background-color: <?php echo $col5logicErr3; ?>" maxlength="3" max="240" min="0" name="col5windgust" placeholder="Max Gust" id="col5windgust" type="number" value="<?php if (isset($_POST['col5windgust'])) {echo $_POST['col5windgust'];} elseif (isset($_SESSION['col5windgust'])) {echo $_SESSION['col5windgust'];} else {echo '';};?>">
					<select style="width:80%" name="col5winddir">
						<option value="<?php if (isset($_POST['col5winddir'])) {echo $_POST['col5winddir'];} elseif (isset($_SESSION['col5winddir'])) {echo $_SESSION['col5winddir'];} else {echo '';};?>"><?php if (isset($_POST['col5winddir'])) {echo $_POST['col5winddir'];} elseif (isset($_SESSION['col5winddir'])) {echo $_SESSION['col5winddir'];} else {echo 'Direction';};?></option>
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
					<br><small><small><strong>Hide Wind Info?<input type="checkbox" name="col5showwind" value="1" <?php echo (isset($_POST['col5showwind']))?$checked:$unchecked; echo (isset($_SESSION['col5showwind']))?$checked:$unchecked;?>></strong></small></small>
				</p>
				<label for="col5detail">Additional Details</label>
				<br>
				<textarea style="width:95%" height="200px" name="col5detail" id="col5detail" placeholder="Timing, intensity, confidence, etc." type="text"><?php if (isset($_POST['col5detail'])) {echo $_POST['col5detail'];} elseif (isset($_SESSION['col5detail'])) {echo $_SESSION['col5detail'];} else {echo '';};?></textarea>
								<br>
			</div>
				<!-- End Column 5 Input-->
				<!-- Column 6 variables -->
			<div class="two columns" style="text-align: center;" id="hr60-72">
				
				<p>
					<label id="col6title" for="col6label"><?php if (isset($_POST['col2label'])) {echo $_POST['col2label'];} elseif (isset($_SESSION['col2label'])) {echo $_SESSION['col2label'];} else {echo $col2label;};?></label><br>
					<input style="width:90%; background-color: <?php echo $col6fieldErr11 ?>" name="col6" id="col6label" placeholder="Monday" type="text" value="<?php if (isset($_POST['col6'])) {echo $_POST['col6'];} elseif (isset($_SESSION['col6'])) {echo $_SESSION['col6'];} else {echo $col6string;};?>">*
					<br>
				</p>
				<p>
					<select style="width:90%; background-color: <?php echo $col6fieldErr12 ?>" name="col6wx" onchange="document.getElementById('col6desc').value=this.value; updatecol6wximg(this.value)">
						<option value="<?php if (isset($_POST['col6wx'])) {echo $_POST['col6wx'];} elseif (isset($_SESSION['col6wx'])) {echo $_SESSION['col6wx'];} else {echo 'Weather';};?>"><?php if (isset($_POST['col6wx'])) {echo $_POST['col6wx'];} elseif (isset($_SESSION['col6wx'])) {echo $_SESSION['col6wx'];} else {echo 'Weather';};?></option>
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
if (isset($_POST['col6wx'])) {
	echo '<img src="' . $col6wximg . '" alt="Weather Icon Preview" style="width:70px;height:70px;" id="col6wximg" name="col6wximg">';
} 
elseif (isset($_SESSION['col6wx'])) {
	echo '<img src="' . $col6wximg . '" alt="Weather Icon Preview" style="width:70px;height:70px;" id="col6wximg" name="col6wximg">';
} 
else {
	echo '<img src="/ifxwx_images/select.png" alt="Weather Icon Preview" style="width:70px;height:70px;" id="col6wximg" name="col6wximg">';
	 }
?>
				</p>
				<p>
					<label for="col6desc">Weather Description*</label>
					<br>
					<input style="width:90%; background-color: <?php echo $col6fieldErr13 ?>" name="col6desc" placeholder="Mostly Sunny" id="col6desc" type="text" value="<?php if (isset($_POST['col6desc'])) {echo $_POST['col6desc'];} elseif (isset($_SESSION['col6desc'])) {echo $_SESSION['col6desc'];} else {echo '';};?>">
				
					</p>
			
					<label for="col6temp">Temperature*</label>
					<br>
					<input style="width:90%; background-color: <?php echo $col6fieldErr14 ?>" placeholder="High/Low" min="-100" max="134" maxlength="3" name="col6temp" id="col6temp" type="number" value="<?php if (isset($_POST['col6temp'])) {echo $_POST['col6temp'];} elseif (isset($_SESSION['col6temp'])) {echo $_SESSION['col6temp'];} else {echo '';};?>"><br>
				<form id="setcol6highlow">
					<input type="radio" id="col6high" name="col6highlow" value="red" <?php echo $col6highcheck; ?>><small>High</small>
					<input type="radio" id="col6low" name="col6highlow" value="blue" <?php echo $col6lowcheck; ?>><small>Low</small></form>
				
				<br>
			<p>
					<label for="col6pop">Precipitation</label>
					<br>
					<input style="width:90%" min="0" max="100" size="15" maxlength="3" name="col6pop" placeholder="Probability %" id="col6pop" type="number" value="<?php if (isset($_POST['col6pop'])) {echo $_POST['col6pop'];} elseif (isset($_SESSION['col6pop'])) {echo $_SESSION['col6pop'];} else {echo '';};?>"><label style="display: none;" for="col6precip" id="col6precip_label">Precipitation Total</label><input style="width:90%" step=".01" min="0" max="100" name="col6precip" placeholder="Precip Total" id="col6precip" type="number" value="<?php if (isset($_POST['col6precip'])) {echo $_POST['col6precip'];} elseif (isset($_SESSION['col6precip'])) {echo $_SESSION['col6precip'];} else {echo '';};?>"><br><small><small><strong>Hide Rain Total<input type="checkbox" name="col6showrain" value="1" <?php echo (isset($_POST['col6showrain']))?$checked:$unchecked; echo (isset($_SESSION['col6showrain']))?$checked:$unchecked;?>></strong></small></small>
					</p>
			<p>
					<label for="col6snowmin">Snow</label>
					<br>
			<input style="width:90%; background-color: <?php echo $col6logicErr1; ?>" step=".5" min="0" max="100" name="col6snowmin" placeholder="Min Accum" id="col6snowmin" type="number" value="<?php if (isset($_POST['col6snowmin'])) {echo $_POST['col6snowmin'];} elseif (isset($_SESSION['col6snowmin'])) {echo $_SESSION['col6snowmin'];} else {echo '';};?>"><label style="display: none;" for="col6snowmax" id="col6snowmax_label">Day 1 Snow Maximum</label><input style="width:90%; background-color: <?php echo $col6logicErr1; ?>" step=".5" min="0" max="100" name="col6snowmax" placeholder="Max Accum" id="col6snowmax" type="number" value="<?php if (isset($_POST['col6snowmax'])) {echo $_POST['col6snowmax'];} elseif (isset($_SESSION['col6snowmax'])) {echo $_SESSION['col6snowmax'];} else {echo '';};?>"><br>
				</p>
			<p>
		
					<label for="col6wind">Wind</label>
					<br>
					<input style="width:90%; background-color: <?php echo $col6logicErr2; ?>" maxlength="3" max="240" min="0" name="col6windmin" placeholder="Min Sustained" id="col6windmin" type="number" value="<?php if (isset($_POST['col6windmin'])) {echo $_POST['col6windmin'];} elseif (isset($_SESSION['col6windmin'])) {echo $_SESSION['col6windmin'];} else {echo '';};?>"><input style="width:90%; background-color: <?php echo $col6logicErr2; ?>" maxlength="3" max="240" min="0" name="col6windmax" placeholder="Max Sustained" id="col6windmax" type="number" value="<?php if (isset($_POST['col6windmax'])) {echo $_POST['col6windmax'];} elseif (isset($_SESSION['col6windmax'])) {echo $_SESSION['col6windmax'];} else {echo '';};?>"><input style="width:90%; background-color: <?php echo $col6logicErr3; ?>" maxlength="3" max="240" min="0" name="col6windgust" placeholder="Max Gust" id="col6windgust" type="number" value="<?php if (isset($_POST['col6windgust'])) {echo $_POST['col6windgust'];} elseif (isset($_SESSION['col6windgust'])) {echo $_SESSION['col6windgust'];} else {echo '';};?>">
					<select style="width:80%" name="col6winddir">
						<option value="<?php if (isset($_POST['col6winddir'])) {echo $_POST['col6winddir'];} elseif (isset($_SESSION['col6winddir'])) {echo $_SESSION['col6winddir'];} else {echo '';};?>"><?php if (isset($_POST['col6winddir'])) {echo $_POST['col6winddir'];} elseif (isset($_SESSION['col6winddir'])) {echo $_SESSION['col6winddir'];} else {echo 'Direction';};?></option>
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
					<br><small><small><strong>Hide Wind Info?<input type="checkbox" name="col6showwind" value="1" <?php echo (isset($_POST['col6showwind']))?$checked:$unchecked; echo (isset($_SESSION['col6showwind']))?$checked:$unchecked;?>></strong></small></small>
				</p>
				<label for="col6detail">Additional Details</label>
				<br>
				<textarea style="width:95%" height="200px" name="col6detail" id="col6detail" placeholder="Timing, intensity, confidence, etc." type="text"><?php if (isset($_POST['col6detail'])) {echo $_POST['col6detail'];} elseif (isset($_SESSION['col6detail'])) {echo $_SESSION['col6detail'];} else {echo '';};?></textarea>
								<br>
			</div>
				<!-- End Column 6 Input-->
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
			document.getElementById("col1low").checked = true;
			document.getElementById("col2high").checked = true;
			document.getElementById("col3low").checked = true;
			document.getElementById("col4high").checked = true;
			document.getElementById("col5low").checked = true;
			document.getElementById("col6high").checked = true;
			document.getElementById("col1title").innerHTML=val;
			document.getElementById("col2title").innerHTML="5am - 5pm";
			document.getElementById("col3title").innerHTML=val;
			document.getElementById("col4title").innerHTML="5am - 5pm";
			document.getElementById("col5title").innerHTML=val;
			document.getElementById("col6title").innerHTML="5am - 5pm";
		}
		else if (val == "6pm - 6am"){
			
			document.getElementById("col1low").checked = true;
			document.getElementById("col2high").checked = true;
			document.getElementById("col3low").checked = true;
			document.getElementById("col4high").checked = true;
			document.getElementById("col5low").checked = true;
			document.getElementById("col6high").checked = true;
			document.getElementById("col1title").innerHTML=val;
			document.getElementById("col2title").innerHTML="6am - 6pm";
			document.getElementById("col3title").innerHTML=val;
			document.getElementById("col4title").innerHTML="6am - 6pm";
			document.getElementById("col5title").innerHTML=val;
			document.getElementById("col6title").innerHTML="6am - 6pm";
		}
		else if (val == "7pm - 7am"){
			document.getElementById("col1low").checked = true;
			document.getElementById("col2high").checked = true;
			document.getElementById("col3low").checked = true;
			document.getElementById("col4high").checked = true;
			document.getElementById("col5low").checked = true;
			document.getElementById("col6high").checked = true;
			document.getElementById("col1title").innerHTML=val;
			document.getElementById("col2title").innerHTML="7am - 7pm";
			document.getElementById("col3title").innerHTML=val;
			document.getElementById("col4title").innerHTML="7am - 7pm";
			document.getElementById("col5title").innerHTML=val;
			document.getElementById("col6title").innerHTML="7am - 7pm";
		}
		else if (val == "8pm - 8am"){
			document.getElementById("col1low").checked = true;
			document.getElementById("col2high").checked = true;
			document.getElementById("col3low").checked = true;
			document.getElementById("col4high").checked = true;
			document.getElementById("col5low").checked = true;
			document.getElementById("col6high").checked = true;
			document.getElementById("col1title").innerHTML=val;
			document.getElementById("col2title").innerHTML="8am - 8pm";
			document.getElementById("col3title").innerHTML=val;
			document.getElementById("col4title").innerHTML="8am - 8pm";
			document.getElementById("col5title").innerHTML=val;
			document.getElementById("col6title").innerHTML="8am - 8pm";
		}
		else if (val == "5am - 5pm"){
			document.getElementById("col1high").checked = true;
			document.getElementById("col2low").checked = true;
			document.getElementById("col3high").checked = true;
			document.getElementById("col4low").checked = true;
			document.getElementById("col5high").checked = true;
			document.getElementById("col6low").checked = true;
			document.getElementById("col1title").innerHTML=val;
			document.getElementById("col2title").innerHTML="5pm - 5am";
			document.getElementById("col3title").innerHTML=val;
			document.getElementById("col4title").innerHTML="5pm - 5am";
			document.getElementById("col5title").innerHTML=val;
			document.getElementById("col6title").innerHTML="5pm - 5am";
		}
		else if (val == "6am - 6pm"){
			document.getElementById("col1high").checked = true;
			document.getElementById("col2low").checked = true;
			document.getElementById("col3high").checked = true;
			document.getElementById("col4low").checked = true;
			document.getElementById("col5high").checked = true;
			document.getElementById("col6low").checked = true;
			document.getElementById("col1title").innerHTML=val;
			document.getElementById("col2title").innerHTML="6pm - 6am";
			document.getElementById("col3title").innerHTML=val;
			document.getElementById("col4title").innerHTML="6pm - 6am";
			document.getElementById("col5title").innerHTML=val;
			document.getElementById("col6title").innerHTML="6pm - 6am";

		}
		else if (val == "7am - 7pm"){
			document.getElementById("col1high").checked = true;
			document.getElementById("col2low").checked = true;
			document.getElementById("col3high").checked = true;
			document.getElementById("col4low").checked = true;
			document.getElementById("col5high").checked = true;
			document.getElementById("col6low").checked = true;
			document.getElementById("col1title").innerHTML=val;
			document.getElementById("col2title").innerHTML="7pm - 7am";
			document.getElementById("col3title").innerHTML=val;
			document.getElementById("col4title").innerHTML="7pm - 7am";
			document.getElementById("col5title").innerHTML=val;
			document.getElementById("col6title").innerHTML="7pm - 7am";
		}
		else if (val == "8am - 8pm"){
			document.getElementById("col1high").checked = true;
			document.getElementById("col2low").checked = true;
			document.getElementById("col3high").checked = true;
			document.getElementById("col4low").checked = true;
			document.getElementById("col5high").checked = true;
			document.getElementById("col6low").checked = true;
			document.getElementById("col1title").innerHTML=val;
			document.getElementById("col2title").innerHTML="8pm - 8am";
			document.getElementById("col3title").innerHTML=val;
			document.getElementById("col4title").innerHTML="8pm - 8am";
			document.getElementById("col5title").innerHTML=val;
			document.getElementById("col6title").innerHTML="8pm - 8am";

		}
		else {
			document.getElementById("col1title").innerHTML="";
			document.getElementById("col2title").innerHTML="";
			document.getElementById("col3title").innerHTML="";
			document.getElementById("col4title").innerHTML="";
			document.getElementById("col5title").innerHTML="";
			document.getElementById("col6title").innerHTML="";
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
		// Column 3 weather icon preview script
		// This script is to instantly change the weather icon preview in column 3 to whatever the user selects from the drop down menu
		function updatecol3wximg(val) {
switch (val) {
case "Sunny": col3wximg = "/ifxwx_images/sunny.png";
break;
case "Partly Sunny": col3wximg = "/ifxwx_images/partly_cloudy_day.png";
break;
case "Mostly Cloudy": col3wximg = "/ifxwx_images/overcast.png";
break;
case "Clear": col3wximg = "/ifxwx_images/clear_night.png";
break;
case "Partly Cloudy": col3wximg = "/ifxwx_images/partly_cloudy_night.png";
break;
case "Overcast": col3wximg = "/ifxwx_images/overcast.png";
break;
case "Isolated Rain Showers": col3wximg = "/ifxwx_images/showers_isolated.png";
break;
case "Scattered Rain Showers": col3wximg = "/ifxwx_images/showers_scattered.png";
break;
case "Rain": col3wximg = "/ifxwx_images/rain.png";
break;
case "Heavy Rain": col3wximg = "/ifxwx_images/rain_heavy.png";
break;
case "Rain and Fog": col3wximg = "/ifxwx_images/showers_haze.png";
break;
case "Isolated T-Storms": col3wximg = "/ifxwx_images/tstorms_isolated.png";
break;
case "Scattered T-Storms": col3wximg = "/ifxwx_images/tstorms_scattered.png";
break;
case "Thunderstorms": col3wximg = "/ifxwx_images/tstorms_rain.png";
break;
case "Severe T-Storms": col3wximg = "/ifxwx_images/tstorms_severe.png";
break;
case "Snow Flurries": col3wximg = "/ifxwx_images/snow_flurries.png";
break;
case "Scattered Snow Showers": col3wximg = "/ifxwx_images/snow_scattered.png";
break;
case "Snow": col3wximg = "/ifxwx_images/snow.png";
break;
case "Heavy Snow": col3wximg = "/ifxwx_images/snow_heavy.png";
break;
case "Blizzard": col3wximg = "/ifxwx_images/snow_blizzard.png";
break;
case "Blowing Snow": col3wximg = "/ifxwx_images/blowing_snow.png";
break;
case "Rain/Snow": col3wximg = "/ifxwx_images/rain_snow.png";
break;
case "Freezing Rain/Snow": col3wximg = "/ifxwx_images/freezing_rain_snow.png";
break;
case "Freezing Rain/Rain": col3wximg = "/ifxwx_images/freezing_rain.png";
break;
case "Freezing Rain/Sleet": col3wximg = "/ifxwx_images/freezing_rain_sleet.png";
break;
case "Rain/Sleet": col3wximg = "/ifxwx_images/rain_sleet.png";
break;
case "Sleet": col3wximg = "/ifxwx_images/sleet.png";
break;
case "Overcast/Haze": col3wximg = "/ifxwx_images/overcast_haze.png";
break;
case "Haze": col3wximg = "/ifxwx_images/haze_day_night.png";
break;
case "Sunny/Fog": col3wximg = "/ifxwx_images/fog_day.png";
break;
case "Morning Fog": col3wximg = "/ifxwx_images/fog_morning.png";
break;
case "Overnight Fog": col3wximg = "/ifxwx_images/fog_night.png";
break;
case "Cloudy/Fog": col3wximg = "/ifxwx_images/fog_overcast.png";
break;
case "Dense Fog": col3wximg = "/ifxwx_images/fog_dense.png";
break;
case "Windy": col3wximg = "/ifxwx_images/windy.png";
break;
case "Lunar Eclipse": col3wximg = "/ifxwx_images/lunar_eclipse.png";
break;
case "Solar Eclipse": col3wximg = "/ifxwx_images/solar_eclipse.png";
break;
default: col3wximg = "/ifxwx_images/select.png";
}
			document.getElementById("col3wximg").src = col3wximg;
		}
		// Column 4 weather icon preview script
		// This script is to instantly change the weather icon preview in column 4 to whatever the user selects from the drop down menu
		function updatecol4wximg(val) {
switch (val) {
case "Sunny": col4wximg = "/ifxwx_images/sunny.png";
break;
case "Partly Sunny": col4wximg = "/ifxwx_images/partly_cloudy_day.png";
break;
case "Mostly Cloudy": col4wximg = "/ifxwx_images/overcast.png";
break;
case "Clear": col4wximg = "/ifxwx_images/clear_night.png";
break;
case "Partly Cloudy": col4wximg = "/ifxwx_images/partly_cloudy_night.png";
break;
case "Overcast": col4wximg = "/ifxwx_images/overcast.png";
break;
case "Isolated Rain Showers": col4wximg = "/ifxwx_images/showers_isolated.png";
break;
case "Scattered Rain Showers": col4wximg = "/ifxwx_images/showers_scattered.png";
break;
case "Rain": col4wximg = "/ifxwx_images/rain.png";
break;
case "Heavy Rain": col4wximg = "/ifxwx_images/rain_heavy.png";
break;
case "Rain and Fog": col4wximg = "/ifxwx_images/showers_haze.png";
break;
case "Isolated T-Storms": col4wximg = "/ifxwx_images/tstorms_isolated.png";
break;
case "Scattered T-Storms": col4wximg = "/ifxwx_images/tstorms_scattered.png";
break;
case "Thunderstorms": col4wximg = "/ifxwx_images/tstorms_rain.png";
break;
case "Severe T-Storms": col4wximg = "/ifxwx_images/tstorms_severe.png";
break;
case "Snow Flurries": col4wximg = "/ifxwx_images/snow_flurries.png";
break;
case "Scattered Snow Showers": col4wximg = "/ifxwx_images/snow_scattered.png";
break;
case "Snow": col4wximg = "/ifxwx_images/snow.png";
break;
case "Heavy Snow": col4wximg = "/ifxwx_images/snow_heavy.png";
break;
case "Blizzard": col4wximg = "/ifxwx_images/snow_blizzard.png";
break;
case "Blowing Snow": col4wximg = "/ifxwx_images/blowing_snow.png";
break;
case "Rain/Snow": col4wximg = "/ifxwx_images/rain_snow.png";
break;
case "Freezing Rain/Snow": col4wximg = "/ifxwx_images/freezing_rain_snow.png";
break;
case "Freezing Rain/Rain": col4wximg = "/ifxwx_images/freezing_rain.png";
break;
case "Freezing Rain/Sleet": col4wximg = "/ifxwx_images/freezing_rain_sleet.png";
break;
case "Rain/Sleet": col4wximg = "/ifxwx_images/rain_sleet.png";
break;
case "Sleet": col4wximg = "/ifxwx_images/sleet.png";
break;
case "Overcast/Haze": col4wximg = "/ifxwx_images/overcast_haze.png";
break;
case "Haze": col4wximg = "/ifxwx_images/haze_day_night.png";
break;
case "Sunny/Fog": col4wximg = "/ifxwx_images/fog_day.png";
break;
case "Morning Fog": col4wximg = "/ifxwx_images/fog_morning.png";
break;
case "Overnight Fog": col4wximg = "/ifxwx_images/fog_night.png";
break;
case "Cloudy/Fog": col4wximg = "/ifxwx_images/fog_overcast.png";
break;
case "Dense Fog": col4wximg = "/ifxwx_images/fog_dense.png";
break;
case "Windy": col4wximg = "/ifxwx_images/windy.png";
break;
case "Lunar Eclipse": col4wximg = "/ifxwx_images/lunar_eclipse.png";
break;
case "Solar Eclipse": col4wximg = "/ifxwx_images/solar_eclipse.png";
break;
default: col4wximg = "/ifxwx_images/select.png";
}
			document.getElementById("col4wximg").src = col4wximg;
		}
		// Column 5 weather icon preview script
		// This script is to instantly change the weather icon preview in column 5 to whatever the user selects from the drop down menu
		function updatecol5wximg(val) {
switch (val) {
case "Sunny": col5wximg = "/ifxwx_images/sunny.png";
break;
case "Partly Sunny": col5wximg = "/ifxwx_images/partly_cloudy_day.png";
break;
case "Mostly Cloudy": col5wximg = "/ifxwx_images/overcast.png";
break;
case "Clear": col5wximg = "/ifxwx_images/clear_night.png";
break;
case "Partly Cloudy": col5wximg = "/ifxwx_images/partly_cloudy_night.png";
break;
case "Overcast": col5wximg = "/ifxwx_images/overcast.png";
break;
case "Isolated Rain Showers": col5wximg = "/ifxwx_images/showers_isolated.png";
break;
case "Scattered Rain Showers": col5wximg = "/ifxwx_images/showers_scattered.png";
break;
case "Rain": col5wximg = "/ifxwx_images/rain.png";
break;
case "Heavy Rain": col5wximg = "/ifxwx_images/rain_heavy.png";
break;
case "Rain and Fog": col5wximg = "/ifxwx_images/showers_haze.png";
break;
case "Isolated T-Storms": col5wximg = "/ifxwx_images/tstorms_isolated.png";
break;
case "Scattered T-Storms": col5wximg = "/ifxwx_images/tstorms_scattered.png";
break;
case "Thunderstorms": col5wximg = "/ifxwx_images/tstorms_rain.png";
break;
case "Severe T-Storms": col5wximg = "/ifxwx_images/tstorms_severe.png";
break;
case "Snow Flurries": col5wximg = "/ifxwx_images/snow_flurries.png";
break;
case "Scattered Snow Showers": col5wximg = "/ifxwx_images/snow_scattered.png";
break;
case "Snow": col5wximg = "/ifxwx_images/snow.png";
break;
case "Heavy Snow": col5wximg = "/ifxwx_images/snow_heavy.png";
break;
case "Blizzard": col5wximg = "/ifxwx_images/snow_blizzard.png";
break;
case "Blowing Snow": col5wximg = "/ifxwx_images/blowing_snow.png";
break;
case "Rain/Snow": col5wximg = "/ifxwx_images/rain_snow.png";
break;
case "Freezing Rain/Snow": col5wximg = "/ifxwx_images/freezing_rain_snow.png";
break;
case "Freezing Rain/Rain": col5wximg = "/ifxwx_images/freezing_rain.png";
break;
case "Freezing Rain/Sleet": col5wximg = "/ifxwx_images/freezing_rain_sleet.png";
break;
case "Rain/Sleet": col5wximg = "/ifxwx_images/rain_sleet.png";
break;
case "Sleet": col5wximg = "/ifxwx_images/sleet.png";
break;
case "Overcast/Haze": col5wximg = "/ifxwx_images/overcast_haze.png";
break;
case "Haze": col5wximg = "/ifxwx_images/haze_day_night.png";
break;
case "Sunny/Fog": col5wximg = "/ifxwx_images/fog_day.png";
break;
case "Morning Fog": col5wximg = "/ifxwx_images/fog_morning.png";
break;
case "Overnight Fog": col5wximg = "/ifxwx_images/fog_night.png";
break;
case "Cloudy/Fog": col5wximg = "/ifxwx_images/fog_overcast.png";
break;
case "Dense Fog": col5wximg = "/ifxwx_images/fog_dense.png";
break;
case "Windy": col5wximg = "/ifxwx_images/windy.png";
break;
case "Lunar Eclipse": col5wximg = "/ifxwx_images/lunar_eclipse.png";
break;
case "Solar Eclipse": col5wximg = "/ifxwx_images/solar_eclipse.png";
break;
default: col5wximg = "/ifxwx_images/select.png";
}
			document.getElementById("col5wximg").src = col5wximg;
		}
		// Column 6 weather icon preview script
		// This script is to instantly change the weather icon preview in column 6 to whatever the user selects from the drop down menu
		function updatecol6wximg(val) {
switch (val) {
case "Sunny": col6wximg = "/ifxwx_images/sunny.png";
break;
case "Partly Sunny": col6wximg = "/ifxwx_images/partly_cloudy_day.png";
break;
case "Mostly Cloudy": col6wximg = "/ifxwx_images/overcast.png";
break;
case "Clear": col6wximg = "/ifxwx_images/clear_night.png";
break;
case "Partly Cloudy": col6wximg = "/ifxwx_images/partly_cloudy_night.png";
break;
case "Overcast": col6wximg = "/ifxwx_images/overcast.png";
break;
case "Isolated Rain Showers": col6wximg = "/ifxwx_images/showers_isolated.png";
break;
case "Scattered Rain Showers": col6wximg = "/ifxwx_images/showers_scattered.png";
break;
case "Rain": col6wximg = "/ifxwx_images/rain.png";
break;
case "Heavy Rain": col6wximg = "/ifxwx_images/rain_heavy.png";
break;
case "Rain and Fog": col6wximg = "/ifxwx_images/showers_haze.png";
break;
case "Isolated T-Storms": col6wximg = "/ifxwx_images/tstorms_isolated.png";
break;
case "Scattered T-Storms": col6wximg = "/ifxwx_images/tstorms_scattered.png";
break;
case "Thunderstorms": col6wximg = "/ifxwx_images/tstorms_rain.png";
break;
case "Severe T-Storms": col6wximg = "/ifxwx_images/tstorms_severe.png";
break;
case "Snow Flurries": col6wximg = "/ifxwx_images/snow_flurries.png";
break;
case "Scattered Snow Showers": col6wximg = "/ifxwx_images/snow_scattered.png";
break;
case "Snow": col6wximg = "/ifxwx_images/snow.png";
break;
case "Heavy Snow": col6wximg = "/ifxwx_images/snow_heavy.png";
break;
case "Blizzard": col6wximg = "/ifxwx_images/snow_blizzard.png";
break;
case "Blowing Snow": col6wximg = "/ifxwx_images/blowing_snow.png";
break;
case "Rain/Snow": col6wximg = "/ifxwx_images/rain_snow.png";
break;
case "Freezing Rain/Snow": col6wximg = "/ifxwx_images/freezing_rain_snow.png";
break;
case "Freezing Rain/Rain": col6wximg = "/ifxwx_images/freezing_rain.png";
break;
case "Freezing Rain/Sleet": col6wximg = "/ifxwx_images/freezing_rain_sleet.png";
break;
case "Rain/Sleet": col6wximg = "/ifxwx_images/rain_sleet.png";
break;
case "Sleet": col6wximg = "/ifxwx_images/sleet.png";
break;
case "Overcast/Haze": col6wximg = "/ifxwx_images/overcast_haze.png";
break;
case "Haze": col6wximg = "/ifxwx_images/haze_day_night.png";
break;
case "Sunny/Fog": col6wximg = "/ifxwx_images/fog_day.png";
break;
case "Morning Fog": col6wximg = "/ifxwx_images/fog_morning.png";
break;
case "Overnight Fog": col6wximg = "/ifxwx_images/fog_night.png";
break;
case "Cloudy/Fog": col6wximg = "/ifxwx_images/fog_overcast.png";
break;
case "Dense Fog": col6wximg = "/ifxwx_images/fog_dense.png";
break;
case "Windy": col6wximg = "/ifxwx_images/windy.png";
break;
case "Lunar Eclipse": col6wximg = "/ifxwx_images/lunar_eclipse.png";
break;
case "Solar Eclipse": col6wximg = "/ifxwx_images/solar_eclipse.png";
break;
default: col6wximg = "/ifxwx_images/select.png";
}
			document.getElementById("col6wximg").src = col6wximg;
		}
	</script>
</body>
<!-- That's all she wrote folks!-->
</html>
