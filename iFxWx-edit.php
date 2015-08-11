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
// Set all fields to white background by default
	$fieldErr1 = $fieldErr2 = "#FFF";

// Verification of required variables
if ($_SERVER["REQUEST_METHOD"] == "POST") {
			// If all required variables are filled in then we can submit all variables to the preview page
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
	$_SESSION["day1wx"] = $_POST["day1wx"];
	$_SESSION["day1"] = $_POST["day1"];
	$_SESSION["precipunit"] = $_POST["precipunit"];
	$_SESSION["day1pop"] = $_POST["day1pop"];
	$_SESSION["day1desc"] = $_POST["day1desc"];
	$_SESSION["day1temp"] = $_POST["day1temp"];
	$_SESSION["day1precip"] = $_POST["day1precip"];
	$_SESSION["showrain"] = $_POST["showrain"];
	$_SESSION["day1snowmin"] = $_POST["day1snowmin"];
	$_SESSION["day1snowmax"] = $_POST["day1snowmax"];
	$_SESSION["day1windmin"] = $_POST["day1windmin"];
	$_SESSION["day1windmax"] = $_POST["day1windmax"];
	$_SESSION["day1winddir"] = $_POST["day1winddir"];
	$_SESSION["day1windgust"] = $_POST["day1windgust"];
	$_SESSION["day1detail"] = $_POST["day1detail"];
	
	//Submit to the preview page
	header('Location: /preview.php');
	exit();
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
<p><img style="width: 70px; height: 61px;" alt="" src="/ifxwx_images/logo.png"> Version 0.8.2 pre-alpha<br><big style="font-family: Helvetica,Arial,sans-serif;"><big><big>Forecast Composer</big></big></big>
</p>
			<div class="twelve columns" >
				Welcome to the forecast composer page. This is the first step towards creating your own weather forecast. Enter the variables for your weather forecast using the forms below and click the 'Submit' button to view your final product.
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
					<input style="background-color: <?php echo $fieldErr1 ?>" size="15" name="forecaster" id="forecaster" placeholder="Austin" type="text" value="<?php echo (isset($_SESSION['forecaster']))?$_SESSION['forecaster']:'';?>">
					<br>
				</p>
			</div>
				<div style="text-align: center;" class="three columns offset-by-one">
				<p>
					<label for="stationid">Station ID</label>
					<br>
					<input size="5" name="stationid" id="stationid" placeholder="KDXR" type="text" value="<?php echo (isset($_SESSION['stationid']))?$_SESSION['stationid']:'';?>">
					<br>
				</p>
			</div>
			<div style="text-align: center;" class="three columns offset-by-one">
				<p>
					<label for="stationname">Location Name</label>
					<br>
					<input style="background-color: <?php echo $fieldErr2 ?>" size="15" name="stationname" id="stationname" placeholder="Danbury, CT" type="text" value="<?php echo (isset($_SESSION['stationname']))?$_SESSION['stationname']:'';?>">
					<br>
				</p>
			</div>
			<div style="text-align: center;" class="two columns">
				<p>
					<label for="date">Publish Date</label>
					<br>
					<input size="10" name="date" id="date" placeholder="10/08/2015" type="date" value="<?php echo (isset($_SESSION['date']))?$_SESSION['date']:'';?>">
					<br>
				</p>
				</div>
				<div style="text-align: center;" class="two columns">
				<p>
					<label for="time">Publish Time</label>
					<br>
					<input size="7" name="time" id="time" placeholder="12:00PM" type="time" value="<?php echo (isset($_SESSION['time']))?$_SESSION['time']:'';?>">
					<br>
				</p>
			</div>
				<div style="text-align: center;" class="seven columns" id="fxvalid">
					<big><strong>Forecast Start (Valid From)</strong></big><br>
				<div style="text-align: center;" class="three columns">
				<p>
					<label for="fxstartmonth">Month</label>
					<br>
					<select style="width:100%" name="fxstartmonth">
						<option value="<?php echo (isset($_SESSION['fxstartmonth']))?$_SESSION['fxstartmonth']:'';?>"><?php echo (isset($_SESSION['fxstartmonth']))?$_SESSION['fxstartmonth']:'';?></option>
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
					<select style="width:100%" name="fxstartday">
						<option value="<?php echo (isset($_SESSION['fxstartday']))?$_SESSION['fxstartday']:'';?>"><?php echo (isset($_SESSION['fxstartday']))?$_SESSION['fxstartday']:'';?></option>
						<option value="01">1st</option>
						<option value="02">2nd</option>
						<option value="03">3rd</option>
						<option value="04">4th</option>
						<option value="05">5th</option>
						<option value="06">6th</option>
						<option value="07">7th</option>
						<option value="08">8th</option>
						<option value="09">9th</option>
						<option value="10">10th</option>
						<option value="11">11th</option>
						<option value="12">12th</option>
						<option value="13">13th</option>
						<option value="14">14th</option>
						<option value="15">15th</option>
						<option value="16">16th</option>
						<option value="17">17th</option>
						<option value="18">18th</option>
						<option value="19">19th</option>
						<option value="20">20th</option>
						<option value="21">21st</option>
						<option value="22">22nd</option>
						<option value="23">23rd</option>
						<option value="24">24th</option>
						<option value="25">25th</option>
						<option value="26">26th</option>
						<option value="27">27th</option>
						<option value="28">28th</option>
						<option value="29">29th</option>
						<option value="30">30th</option>
						<option value="31">31st</option>
					</select>
					<br>
				</p>
			</div>
					<div style="text-align: center;" class="two columns">
				<p>
					<label for="fxstartyear">Year</label>
					<br>
					<select style="width:100%" name="fxstartyear">
						<option value="<?php echo (isset($_SESSION['fxstartyear']))?$_SESSION['fxstartyear']:'';?>"><?php echo (isset($_SESSION['fxstartyear']))?$_SESSION['fxstartyear']:'';?></option>
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
					<select style="width:100%" name="fxstarttime">
						<option value="<?php echo (isset($_SESSION['fxstarttime']))?$_SESSION['fxstarttime']:'';?>"><?php echo (isset($_SESSION['fxstarttime']))?$_SESSION['fxstarttime']:'';?></option>
						<optgroup label="Morning">
						<option value="5AM">5am - 5pm</option>
						<option value="6AM">6am - 6pm</option>
						<option value="7AM">7am - 7pm</option>
						<option value="8AM">8am - 8pm</option>
						</optgroup>
						<optgroup label="Evening">
						<option value="5PM">5pm - 5am</option>
						<option value="6PM">6pm - 6am</option>
						<option value="7PM">7pm - 7am</option>
						<option value="8PM">8pm - 8am</option>
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
						<label for="day1label">0-12 Hours</label><br>
					<input style="width:90%" name="day1" id="day1label" placeholder="Monday" type="text"  value="<?php echo (isset($_SESSION['day1']))?$_SESSION['day1']:'';?>">
					<br>
				</p>
				<p>
					<select style="width:90%" name="day1wx" onchange="document.getElementById('day1desc').value=this.value;">
						<option value="<?php echo (isset($_SESSION['day1wx']))?$_SESSION['day1wx']:'';?>"><?php echo (isset($_SESSION['day1wx']))?$_SESSION['day1wx']:'';?></option>
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
					<input style="width:90%" name="day1desc" placeholder="Mostly Sunny" id="day1desc" type="text" value="<?php echo (isset($_SESSION['day1desc']))?$_SESSION['day1desc']:'';?>">
				</p><br>
			<p>
					<label for="day1temp">Temperature</label>
					<br>
					<input style="width:90%" placeholder="High/Low" min="-100" max="134" maxlength="3" name="day1temp" id="day1temp" type="number" value="<?php echo (isset($_SESSION['day1temp']))?$_SESSION['day1temp']:'';?>"><br>
				<form id="highlow">
							<input type="radio" id="highlow" name="highlow" value="red" checked><small>High</small>
						<input type="radio" id="highlow" name="highlow" value="blue"><small>Low</small></form>
				</p>
				<br>
			<p>
					<label for="day1pop">Precipitation</label>
					<br>
					<input style="width:90%" min="0" max="100" size="15" maxlength="3" name="day1pop" placeholder="Probability %" id="day1pop" type="number" value="<?php echo (isset($_SESSION['day1pop']))?$_SESSION['day1pop']:'';?>"><label for="day1precip" id="day1precip_label">Precipitation Total</label><input style="width:90%" step=".01" min="0" max="100" name="day1precip" placeholder="Precip Total" id="day1precip" type="number" value="<?php echo (isset($_SESSION['day1precip']))?$_SESSION['day1precip']:'';?>"><br><small><small><strong>Hide Rain Total<input type="checkbox" name="showrain" value="<?php echo (isset($_SESSION['showrain']))?$_SESSION['showrain']:'';?>"></strong></small></small>
					</p>
			<p>
					<label for="day1snowmin">Snow</label>
					<br>
			<input style="width:90%" step=".5" min="0" max="100" name="day1snowmin" placeholder="Min Accum" id="day1snowmin" type="number" value="<?php echo (isset($_SESSION['day1snowmin']))?$_SESSION['day1snowmin']:'';?>"><label for="day1snowmax" id="day1snowmax_label">Day 1 Snow Maximum</label><input style="width:90%" step=".5" min="0" max="100" name="day1snowmax" placeholder="Max Accum" id="day1snowmax" type="number" value="<?php echo (isset($_SESSION['day1snowmax']))?$_SESSION['day1snowmax']:'';?>"><br>
				</p>
			<p>
					<label for="day1wind">Wind</label>
					<br>
					<input style="width:90%" maxlength="3" max="240" min="0" name="day1windmin" placeholder="Min Sustained" id="day1windmin" type="number" value="<?php echo (isset($_SESSION['day1windmin']))?$_SESSION['day1windmin']:'';?>"><input style="width:90%" maxlength="3" max="240" min="0" name="day1windmax" placeholder="Max Sustained" id="day1windmax" type="number" value="<?php echo (isset($_SESSION['day1windmax']))?$_SESSION['day1windmax']:'';?>"><input style="width:90%" maxlength="3" max="240" min="0" name="day1windgust" placeholder="Max Gust" id="day1windgust" type="number" value="<?php echo (isset($_SESSION['day1windgust']))?$_SESSION['day1windgust']:'';?>">
					<select style="width:80%" name="day1winddir">
						<option value="<?php echo (isset($_SESSION['day1winddir']))?$_SESSION['day1winddir']:'';?>"><?php echo (isset($_SESSION['day1winddir']))?$_SESSION['day1winddir']:'';?></option>
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
					<br>
				</p>
				<label for="day1detail">Additional Details</label>
				<br>
				<textarea style="width:95%" height="200px" name="day1detail" id="day1detail" placeholder="Timing, intensity, confidence, etc." type="text"><?php echo (isset($_SESSION['day1detail']))?$_SESSION['day1detail']:'';?></textarea>
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
				<div class="three columns">
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
</body>

</html>
