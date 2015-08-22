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
// Set all fields to white background by default
	$fieldErr1 = $fieldErr3 = $fieldErr4 = $fieldErr5 = $fieldErr6 = $fieldErr7 = $fieldErr8 = $fieldErr9 = $fieldErr10 = "#FFF";
	$fieldErr2 ="**All fields highlighted in red must be filled in before submitting your forecast**";

	$proceed = false;

// Verification of required variables
if ($_SERVER["REQUEST_METHOD"] == "POST" && $proceed == false) {
	
	//Check to see if any of the required fields are blank or set at the default values
	if (empty($_POST["forecaster"]) || empty($_POST["stationname"]) || empty($_POST["date"])|| empty($_POST["time"]) || empty($_POST["fxstartmonth"]) || $_POST["fxstartmonth"] == "Select Month" || empty($_POST["fxstartday"]) || $_POST["fxstartday"] == "Select Day" || empty($_POST["fxstartyear"]) || $_POST["fxstartyear"] == "Select Year" || empty($_POST["fxstarttime"]) || $_POST["fxstarttime"] == "Select Time") {
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
	
	//$fieldErr1 = "#FFF"; <- I think this is leftover code
}

//if the form has been submitted and the required fields are filled in properly then we can proceed to submit all variables
if ($_SERVER["REQUEST_METHOD"] == "POST" && $proceed == true) {
submit_input();	
}

		
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
	
	
	// 0-12hr Forecast Period Variables
	$_SESSION["day1label"] = $_POST["day1label"];
	$_SESSION["day1wx"] = $_POST["day1wx"];
	$_SESSION["day1"] = $_POST["day1"];
	$_SESSION["day1highlow"] = $_POST["day1highlow"];
	$_SESSION["precipunit"] = $_POST["precipunit"];
	$_SESSION["day1pop"] = $_POST["day1pop"];
	$_SESSION["day1desc"] = $_POST["day1desc"];
	$_SESSION["day1temp"] = $_POST["day1temp"];
	$_SESSION["day1precip"] = $_POST["day1precip"];
	$_SESSION["day1showrain"] = $_POST["day1showrain"];
	$_SESSION["day1snowmin"] = $_POST["day1snowmin"];
	$_SESSION["day1snowmax"] = $_POST["day1snowmax"];
	$_SESSION["day1windmin"] = $_POST["day1windmin"];
	$_SESSION["day1windmax"] = $_POST["day1windmax"];
	$_SESSION["day1winddir"] = $_POST["day1winddir"];
	$_SESSION["day1showwind"] = $_POST["day1showwind"];
	$_SESSION["day1windgust"] = $_POST["day1windgust"];
	$_SESSION["day1detail"] = $_POST["day1detail"];
	
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
	$day1string = date('l');
}
elseif ($hour < "06" && $am_pm == "am") {
	$fxvalid = "6AM";
	$day1string = date('l');
}
elseif ($hour < "07" && $am_pm == "am") {
	$fxvalid = "7AM";
	$day1string = date('l');
}
elseif ($hour < "08" && $am_pm == "am") {
	$fxvalid = "8AM";
	$day1string = date('l');
}
elseif ($hour >= "08" && $hour < "12" && $am_pm == "am") {
	$fxvalid = "5PM";
	$day1string = date('l') . " Night";
	//$day1string = date('l', strtotime("+1 day")) . " Night";
}
elseif ($hour == "12" && $am_pm == "am") {
	$fxvalid = "5AM";
	$day1string = date('l');
}
elseif ($hour < "05" && $am_pm == "pm") {
	$fxvalid = "5PM";
	$day1string = date('l') . " Night";
}
elseif ($hour < "06" && $am_pm == "pm") {
	$fxvalid = "6PM";
	$day1string = date('l') . " Night";
}
elseif ($hour < "07" && $am_pm == "pm") {
	$fxvalid = "7PM";
	$day1string = date('l') . " Night";
}
elseif ($hour < "08" && $am_pm == "pm") {
	$fxvalid = "8PM";
	$day1string = date('l') . " Night";
}
elseif ($hour >= "08" && $hour < "12" && $am_pm == "pm") {
	$fxvalid = "5AM";
	$day1string = date('l');
}
elseif ($hour == "12" && $am_pm == "pm") {
	$fxvalid = "5PM";
	$day1string = date('l') . " Night";
}
else {
	$fxvalid = "Select Time";
	$day1string = date('l');
}
// Convert the start time from the value into a logical string for user to understand the duration of the forecast period
switch ($fxvalid) {
	case "5AM": $fxvalidname = $day1label = "5am - 5pm";
	break;
	case "6AM": $fxvalidname = $day1label = "6am - 6pm";
	break;
	case "7AM": $fxvalidname = $day1label = "7am - 7pm";
	break;
	case "8AM": $fxvalidname = $day1label = "8am - 8pm";
	break;
	case "5PM": $fxvalidname = $day1label = "5pm - 5am";
	break;
	case "6PM": $fxvalidname = $day1label = "6pm - 6am";
	break;
	case "7PM": $fxvalidname = $day1label = "7pm - 7am";
	break;
	case "8PM": $fxvalidname = $day1label = "8pm - 8am";
	break;
	default: $fxvalidname = "Select Time";
	$day1label = "0-12hr";
	break;
}

//Checkbox values
$checked = "checked";
$unchecked = "";

if (!empty($_POST["day1highlow"]) && $_POST["day1highlow"] == "red") {
	$highcheck = "checked";
	$lowcheck = "";
}

elseif (!empty($_SESSION["day1highlow"]) && $_SESSION["day1highlow"] == "red") 
{
	$highcheck = "checked";
	$lowcheck = "";
} 

elseif (($fxvalid == '6AM' || $fxvalid == '7AM' || $fxvalid == '8AM' || $fxvalid == '9AM') && empty($_SESSION["day1highlow"]) && empty($_POST["day1highlow"])) {
	$highcheck = "checked";
	$lowcheck = "";
}

elseif (!empty($_POST["day1highlow"]) && $_POST["day1highlow"] == "blue") {
	$lowcheck = "checked";
	$highcheck = "";
}

elseif (!empty($_SESSION["day1highlow"]) && $_SESSION["day1highlow"] == "blue") 
{
	$lowcheck = "checked";
	$highcheck = "";
} 

elseif (($fxvalid == '6PM' || $fxvalid == '7PM' || $fxvalid == '8PM' || $fxvalid == '9PM') && empty($_SESSION["day1highlow"]) && empty($_POST["day1highlow"])) {
	$lowcheck = "checked";
	$highcheck = "";
						   }
else {
	$lowcheck = "";
	$highcheck = "checked";
	 }
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
	<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
		
		<div class="wrapper">
			<img src="/ifxwx_images/background.jpg" id="bg" alt="">
			<div class="container">
			<div class="twelve columns" style="font-weight: bold; text-align: center" id="header">
<p><img style="width: 70px; height: 61px;" alt="" src="/ifxwx_images/logo.png"> Version 0.11.0 pre-alpha<br><big style="font-family: Helvetica,Arial,sans-serif;"><big><big>Forecast Composer</big></big></big>
</p>
			<div class="twelve columns" >
				Welcome to the forecast composer page. This is the first step towards creating your own weather forecast. Enter the variables for your weather forecast using the forms below and click the 'Submit' button to view your final product.<small><br>Tips:<br>
				If probability of precipitation is greater than 0% the total precipitation must also be greater than 0. If no measurable precipitation is expected then probability should be 0%. You may explain further using the "details" section.</small>
				<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && $proceed == false) {
	echo "<br>" . "<div style='color:red'>" . $fieldErr2 . "</div>";
}
?>
				</div>
				</div>
				<div class="twelve columns">
				<hr>
			</div>
			<div class= "twelve columns" id="metaforms">
			<div style="text-align: center;" class="three columns offset-by-one">
				<p>
					<label for="forecaster">Your Name</label>
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
					<label for="stationname">Location Name</label>
					<br>
					<input style="background-color: <?php echo $fieldErr4 ?>" size="15" name="stationname" id="stationname" placeholder="Danbury, CT" type="text" value="<?php echo (isset($_POST['stationname']))?$_POST['stationname']:''; echo (isset($_SESSION['stationname']))?$_SESSION['stationname']:'';?>">
					<br>
				</p>
			</div>
			<div style="text-align: center;" class="two columns">
				<p>
					<label for="date">Publish Date</label>
					<br>
					<input style="background-color: <?php echo $fieldErr5 ?>" size="10" name="date" id="date" placeholder="10/08/2015" type="date" value="<?php if (isset($_POST['date'])) {echo $_POST['date'];} elseif (isset($_SESSION['date'])) {echo $_SESSION['date'];} else {echo $month . '/' . $day . '/' . $year;};?>">
					<br>
				</p>
				</div>
				<div style="text-align: center;" class="two columns">
				<p>
					<label for="time">Publish Time</label>
					<br>
					<input style="background-color: <?php echo $fieldErr6 ?>" size="7" name="time" id="time" placeholder="12:00PM" type="time" value="<?php if (isset($_POST['time'])) {echo $_POST['time'];} elseif (isset($_SESSION['time'])) {echo $_SESSION['time'];} else {echo $hour . ':' . $minutes . $am_pm;;};?>">
					<br>
				</p>
			</div>
				<div style="text-align: center;" class="seven columns" id="fxvalid">
					<big><strong>Forecast Start (Valid From)</strong></big><br>
				<div style="text-align: center;" class="three columns">
				<p>
					<label for="fxstartmonth">Month</label>
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
					<label for="fxstartday">Day</label>
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
					<label for="fxstartyear">Year</label>
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
					<label for="fxstarttime">Local Time</label>
					<br>
					<select style="width:100%; background-color: <?php echo $fieldErr10 ?>" name="fxstarttime" onchange="updateTitles(this.value)">
						<option value="<?php if (isset($_POST['fxstarttime'])) {echo $_POST['fxstarttime'];} elseif (isset($_SESSION['fxstartyear'])) {echo $_SESSION['fxstarttime'];} else {echo $fxvalid;};?>"><?php if (isset($_POST['fxstarttime'])) {echo $_POST['fxstarttime'];} elseif (isset($_SESSION['fxstarttime'])) {echo $_SESSION['fxstarttime'];} else {echo $fxvalidname;};?></option>
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
			<div >
			<div class="two columns" style="text-align: center;" id="hr0-12">
				
				<p>
						<label id="day1title" for="day1label"><?php if (isset($_POST['day1'])) {echo $fxvalidname;} elseif (isset($_SESSION['day1'])) {echo "";} else {echo $fxvalidname;};?></label><br>
					<input style="width:90%" name="day1" id="day1label" placeholder="Monday" type="text" value="<?php if (isset($_POST['day1'])) {echo $_POST['day1'];} elseif (isset($_SESSION['day1'])) {echo $_SESSION['day1'];} else {echo $day1string;};?>">
					<br>
				</p>
				<p>
					<select style="width:90%" name="day1wx" onchange="document.getElementById('day1desc').value=this.value;">
						<option value="<?php if (isset($_POST['day1wx'])) {echo $_POST['day1wx'];} elseif (isset($_SESSION['day1wx'])) {echo $_SESSION['day1wx'];} else {echo 'Weather';};?>"><?php if (isset($_POST['day1wx'])) {echo $_POST['day1wx'];} elseif (isset($_SESSION['day1wx'])) {echo $_SESSION['day1wx'];} else {echo 'Weather';};?></option>
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
					</select>
					<br>
				</p>
				<p>
					<label for="day1desc">Weather Description</label>
					<br>
					<input style="width:90%" name="day1desc" placeholder="Mostly Sunny" id="day1desc" type="text" value="<?php if (isset($_POST['day1desc'])) {echo $_POST['day1desc'];} elseif (isset($_SESSION['day1desc'])) {echo $_SESSION['day1desc'];} else {echo '';};?>">
				</p><br>
			<p>
					<label for="day1temp">Temperature</label>
					<br>
					<input style="width:90%" placeholder="High/Low" min="-100" max="134" maxlength="3" name="day1temp" id="day1temp" type="number" value="<?php if (isset($_POST['day1temp'])) {echo $_POST['day1temp'];} elseif (isset($_SESSION['day1temp'])) {echo $_SESSION['day1temp'];} else {echo '';};?>"><br>
				<form id="setday1highlow">
					<input type="radio" id="day1high" name="day1highlow" value="red" <?php echo $highcheck; ?>><small>High</small>
					<input type="radio" id="day1low" name="day1highlow" value="blue" <?php echo $lowcheck; ?>><small>Low</small></form>
				</p>
				<br>
			<p>
					<label for="day1pop">Precipitation</label>
					<br>
					<input style="width:90%" min="0" max="100" size="15" maxlength="3" name="day1pop" placeholder="Probability %" id="day1pop" type="number" value="<?php if (isset($_POST['day1pop'])) {echo $_POST['day1pop'];} elseif (isset($_SESSION['day1pop'])) {echo $_SESSION['day1pop'];} else {echo '';};?>"><label for="day1precip" id="day1precip_label">Precipitation Total</label><input style="width:90%" step=".01" min="0" max="100" name="day1precip" placeholder="Precip Total" id="day1precip" type="number" value="<?php if (isset($_POST['day1precip'])) {echo $_POST['day1precip'];} elseif (isset($_SESSION['day1precip'])) {echo $_SESSION['day1precip'];} else {echo '';};?>"><br><small><small><strong>Hide Rain Total<input type="checkbox" name="day1showrain" value="1" <?php echo (isset($_POST['day1showrain']))?$checked:$unchecked; echo (isset($_SESSION['day1showrain']))?$checked:$unchecked;?>></strong></small></small>
					</p>
			<p>
					<label for="day1snowmin">Snow</label>
					<br>
			<input style="width:90%" step=".5" min="0" max="100" name="day1snowmin" placeholder="Min Accum" id="day1snowmin" type="number" value="<?php if (isset($_POST['day1snowmin'])) {echo $_POST['day1snowmin'];} elseif (isset($_SESSION['day1snowmin'])) {echo $_SESSION['day1snowmin'];} else {echo '';};?>"><label for="day1snowmax" id="day1snowmax_label">Day 1 Snow Maximum</label><input style="width:90%" step=".5" min="0" max="100" name="day1snowmax" placeholder="Max Accum" id="day1snowmax" type="number" value="<?php if (isset($_POST['day1snowmax'])) {echo $_POST['day1snowmax'];} elseif (isset($_SESSION['day1snowmax'])) {echo $_SESSION['day1snowmax'];} else {echo '';};?>"><br>
				</p>
			<p>
				<!-- Wind Input For Day 1-->
					<label for="day1wind">Wind</label>
					<br>
					<input style="width:90%" maxlength="3" max="240" min="0" name="day1windmin" placeholder="Min Sustained" id="day1windmin" type="number" value="<?php if (isset($_POST['day1windmin'])) {echo $_POST['day1windmin'];} elseif (isset($_SESSION['day1windmin'])) {echo $_SESSION['day1windmin'];} else {echo '';};?>"><input style="width:90%" maxlength="3" max="240" min="0" name="day1windmax" placeholder="Max Sustained" id="day1windmax" type="number" value="<?php if (isset($_POST['day1windmax'])) {echo $_POST['day1windmax'];} elseif (isset($_SESSION['day1windmax'])) {echo $_SESSION['day1windmax'];} else {echo '';};?>"><input style="width:90%" maxlength="3" max="240" min="0" name="day1windgust" placeholder="Max Gust" id="day1windgust" type="number" value="<?php if (isset($_POST['day1windgust'])) {echo $_POST['day1windgust'];} elseif (isset($_SESSION['day1windgust'])) {echo $_SESSION['day1windgust'];} else {echo '';};?>">
					<select style="width:80%" name="day1winddir">
						<option value="<?php if (isset($_POST['day1winddir'])) {echo $_POST['day1winddir'];} elseif (isset($_SESSION['day1winddir'])) {echo $_SESSION['day1winddir'];} else {echo 'Direction';};?>"><?php if (isset($_POST['day1winddir'])) {echo $_POST['day1winddir'];} elseif (isset($_SESSION['day1winddir'])) {echo $_SESSION['day1winddir'];} else {echo 'Direction';};?></option>
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
					<br><small><small><strong>Hide Wind Info?<input type="checkbox" name="day1showwind" value="1"></strong></small></small>
				</p>
				<label for="day1detail">Additional Details</label>
				<br>
				<textarea style="width:95%" height="200px" name="day1detail" id="day1detail" placeholder="Timing, intensity, confidence, etc." type="text"><?php if (isset($_POST['day1detail'])) {echo $_POST['day1detail'];} elseif (isset($_SESSION['day1detail'])) {echo $_SESSION['day1detail'];} else {echo '';};?></textarea>
								<br>
			</div>
<div class="twelve columns">
	<hr>
				</div>

					<div class="twelve columns" id="userpref">
					<div class="two columns" id="tempunit">
						<label for="tempunit">Temperature Units</label>
							<input type="radio" name="tempunit" value="fahrenheit" checked><small>Fahrenheit</small><br>
							<input type="radio" name="tempunit" value="celsius"><small>Celsius</small>
						</div>
				<div class="two columns" id="precipunit">
					<label for="precipunit">Precipitation Units</label>
							<input type="radio" name="precipunit" value="in." checked><small>Inches (in.)</small><br>
							<input type="radio" name="precipunit" value="mm"><small>Millimeters (mm)</small>
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
							<input type="radio" id="colortemp" name="colortemp" value="no" checked><small>No</small><br>
						<input type="radio" id="colortemp" name="colortemp" value="yes"><small>Yes</small>
						</div>
						<div class="two columns" id="test">
							<label for="addopt1">Additional Options 1</label>
							<input type="radio" id="addopt1" name="addopt1" value="no" checked><small>No</small><br>
						<input type="radio" id="addopt1" name="addopt1" value="yes"><small>Yes</small>
						</div>
						<div class="two columns" id="test">
							<label for="addopt2">Additional Options 2</label>
							<input type="radio" id="addopt2" name="addopt2" value="no" checked><small>No</small><br>
						<input type="radio" id="addopt2" name="addopt2" value="yes"><small>Yes</small>
						</div>
				</div>
				
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
	<script>
		// This script sets the titles for each forecast period to alternate day/night depending on user selection of forecast start time
	function updateTitles(val) {
		if (val == "5pm - 5am"){
			document.getElementById("day1high").checked = false;
			document.getElementById("day1low").checked = true;
			document.getElementById("day1title").innerHTML=val;
			document.getElementById("day2title").innerHTML="5am - 5pm";
		}
		else if (val == "6pm - 6am"){
			document.getElementById("day1high").checked = false;
			document.getElementById("day1low").checked = true;
			document.getElementById("day1title").innerHTML=val;
			document.getElementById("day2title").innerHTML="6am - 6pm";
		}
		else if (val == "7pm - 7am"){
			document.getElementById("day1high").checked = false;
			document.getElementById("day1low").checked = true;
			document.getElementById("day1title").innerHTML=val;
			document.getElementById("day2title").innerHTML="7am - 7pm";
		}
		else if (val == "8pm - 8am"){
			document.getElementById("day1high").checked = false;
			document.getElementById("day1low").checked = true;
			document.getElementById("day1title").innerHTML=val;
			document.getElementById("day2title").innerHTML="8am - 8pm";
		}
		else if (val == "5am - 5pm"){
			document.getElementById("day1low").checked = false;
			document.getElementById("day1high").checked = true;
			document.getElementById("day1title").innerHTML=val;
			document.getElementById("day2title").innerHTML="5pm - 5am";
		}
		else if (val == "6am - 6pm"){
			document.getElementById("day1low").checked = false;
			document.getElementById("day1high").checked = true;
			document.getElementById("day1title").innerHTML=val;
			document.getElementById("day2title").innerHTML="6pm - 6am";

		}
		else if (val == "7am - 7pm"){
			document.getElementById("day1low").checked = false;
			document.getElementById("day1high").checked = true;
			document.getElementById("day1title").innerHTML=val;
			document.getElementById("day2title").innerHTML="7pm - 7am";
		}
		else if (val == "8am - 8pm"){
			document.getElementById("day1low").checked = false;
			document.getElementById("day1high").checked = true;
			document.getElementById("day1title").innerHTML=val;
			document.getElementById("day2title").innerHTML="8pm - 8am";

		}
		else {
			document.getElementById("day1title").innerHTML="";
			document.getElementById("day2title").innerHTML="";
		}
		
	}
	</script>
</body>

</html>
