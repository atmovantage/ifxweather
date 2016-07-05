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

global $wpdb;

$table = $wpdb->prefix . '3dayforecasts';
$forecastid = $_SESSION["lastid"];

$mylink = $wpdb->get_row( "SELECT * FROM $table WHERE id = $forecastid", ARRAY_A );

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html><head>
<meta content="text/html; charset=ISO-8859-1" http-equiv="content-type"><title>iFx Weather Verification</title>
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
	<p>
		<big style="font-family: Helvetica,Arial,sans-serif;"><br>Forecast Verification</big>
		<div class="twelve columns" align="center">
		<?php 
		echo "Forecast ID: " . $_SESSION["lastid"]; ?>
	</div>
	</p>
</div>
	<div class="twelve columns">
				<hr>
			</div>
<!-- Forecast Meta Data -->
	<div class="three columns">
				<p>
		<strong>Forecaster: </strong><?php echo $mylink['forecaster'] ?>
		</p>
			</div>
				<div class="three columns">
				<p>
		<strong>Location: </strong><?php echo $mylink['station'] . " " . $mylink['location'] ?>
		</p>
			</div>
			<div class="three columns">
				<p>
		<strong>Published: </strong><?php echo $mylink['date']. " " . $mylink['time'] ?>
		</p>
			</div>
	<div class="three columns">
				<p>
					<strong>Valid From: </strong><?php echo $mylink['fx_valid_time'] . " " . $mylink['fx_valid_month'] . "/" . $mylink['fx_valid_day']. "/" . $mylink['fx_valid_year'] ?>
		</p>
			</div>
	<!-- End Forecast Meta Data -->
	<div class="twelve columns">
				<hr>
			</div>
	<!-- Forecast Data -->
	<table class="u-normal">
		<caption style="font-size:18px; font-weight:bold"><?php echo $mylink['col1_title'] ?></caption>
  <thead>
		<tr>
			<th></th>
      <th>Forecast</th>
			<th>Actual</th>
			<th>Error</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>Conditions</td>
      <td><?php echo $mylink['col1_weather'] ?></td>
      <td>Coming Soon</td>
      <td>Null</td>
    </tr>
    <tr>
      <td>Temperature</td>
      <td><?php echo $mylink['col1_temp'] ?></td>
      <td>Coming Soon</td>
      <td>Null</td>
    </tr>
		<tr>
      <td>Chance of Precip.</td>
      <td><?php echo $mylink['col1_pop'] ?></td>
      <td>Coming Soon</td>
      <td>Null</td>
    </tr>
		<tr>
      <td>Liquid Accum.</td>
      <td><?php echo $mylink['col1_precip']?></td>
      <td>Coming Soon</td>
      <td>Null</td>
    </tr>
		<tr>
      <td>Snow Accum.</td>
      <td><?php echo $mylink['col1_snowmin'] . " - " . $mylink['col1_snowmax'] ?></td>
      <td>Coming Soon</td>
      <td>Null</td>
    </tr>
		<tr>
      <td>Wind Speed</td>
      <td><?php echo $mylink['col1_windmin'] . " - " . $mylink['col1_winmax'] . " G(" . $mylink['col1_windgust'] . ")" ?></td>
      <td>Coming Soon</td>
      <td>Null</td>
    </tr>
		<tr>
      <td>Wind Dir.</td>
      <td><?php echo $mylink['col1_winddir']?></td>
      <td>Coming Soon</td>
      <td>Null</td>
    </tr>
  </tbody>
</table>
	
	<div class="twelve columns">
				<hr>
			</div>

	<table class="u-normal">
		<caption style="font-size:18px; font-weight:bold"><?php echo $mylink['col2_title'] ?></caption>
  <thead>
		<tr>
			<th></th>
      <th>Forecast</th>
			<th>Actual</th>
			<th>Error</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>Conditions</td>
      <td><?php echo $mylink['col2_weather'] ?></td>
      <td>Coming Soon</td>
      <td>Null</td>
    </tr>
    <tr>
      <td>Temperature</td>
      <td><?php echo $mylink['col2_temp'] ?></td>
      <td>Coming Soon</td>
      <td>Null</td>
    </tr>
		<tr>
      <td>Chance of Precip.</td>
      <td><?php echo $mylink['col2_pop'] ?></td>
      <td>Coming Soon</td>
      <td>Null</td>
    </tr>
		<tr>
      <td>Liquid Accum.</td>
      <td><?php echo $mylink['col2_precip']?></td>
      <td>Coming Soon</td>
      <td>Null</td>
    </tr>
		<tr>
      <td>Snow Accum.</td>
      <td><?php echo $mylink['col2_snowmin'] . " - " . $mylink['col2_snowmax'] ?></td>
      <td>Coming Soon</td>
      <td>Null</td>
    </tr>
		<tr>
      <td>Wind Speed</td>
      <td><?php echo $mylink['col2_windmin'] . " - " . $mylink['col2_winmax'] . " G(" . $mylink['col2_windgust'] . ")" ?></td>
      <td>Coming Soon</td>
      <td>Null</td>
    </tr>
		<tr>
      <td>Wind Dir.</td>
      <td><?php echo $mylink['col2_winddir']?></td>
      <td>Coming Soon</td>
      <td>Null</td>
    </tr>
  </tbody>
</table>
	
	<div class="twelve columns">
				<hr>
			</div>

	<table class="u-normal">
		<caption style="font-size:18px; font-weight:bold"><?php echo $mylink['col3_title'] ?></caption>
  <thead>
		<tr>
			<th></th>
      <th>Forecast</th>
			<th>Actual</th>
			<th>Error</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>Conditions</td>
      <td><?php echo $mylink['col3_weather'] ?></td>
      <td>Coming Soon</td>
      <td>Null</td>
    </tr>
    <tr>
      <td>Temperature</td>
      <td><?php echo $mylink['col3_temp'] ?></td>
      <td>Coming Soon</td>
      <td>Null</td>
    </tr>
		<tr>
      <td>Chance of Precip.</td>
      <td><?php echo $mylink['col3_pop'] ?></td>
      <td>Coming Soon</td>
      <td>Null</td>
    </tr>
		<tr>
      <td>Liquid Accum.</td>
      <td><?php echo $mylink['col3_precip']?></td>
      <td>Coming Soon</td>
      <td>Null</td>
    </tr>
		<tr>
      <td>Snow Accum.</td>
      <td><?php echo $mylink['col3_snowmin'] . " - " . $mylink['col3_snowmax'] ?></td>
      <td>Coming Soon</td>
      <td>Null</td>
    </tr>
		<tr>
      <td>Wind Speed</td>
      <td><?php echo $mylink['col3_windmin'] . " - " . $mylink['col3_winmax'] . " G(" . $mylink['col3_windgust'] . ")" ?></td>
      <td>Coming Soon</td>
      <td>Null</td>
    </tr>
		<tr>
      <td>Wind Dir.</td>
      <td><?php echo $mylink['col3_winddir']?></td>
      <td>Coming Soon</td>
      <td>Null</td>
    </tr>
  </tbody>
</table>

	<div class="twelve columns">
				<hr>
			</div>
	
	<table class="u-normal">
		<caption style="font-size:18px; font-weight:bold"><?php echo $mylink['col4_title'] ?></caption>
  <thead>
		<tr>
			<th></th>
      <th>Forecast</th>
			<th>Actual</th>
			<th>Error</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>Conditions</td>
      <td><?php echo $mylink['col4_weather'] ?></td>
      <td>Coming Soon</td>
      <td>Null</td>
    </tr>
    <tr>
      <td>Temperature</td>
      <td><?php echo $mylink['col4_temp'] ?></td>
      <td>Coming Soon</td>
      <td>Null</td>
    </tr>
		<tr>
      <td>Chance of Precip.</td>
      <td><?php echo $mylink['col4_pop'] ?></td>
      <td>Coming Soon</td>
      <td>Null</td>
    </tr>
		<tr>
      <td>Liquid Accum.</td>
      <td><?php echo $mylink['col4_precip']?></td>
      <td>Coming Soon</td>
      <td>Null</td>
    </tr>
		<tr>
      <td>Snow Accum.</td>
      <td><?php echo $mylink['col4_snowmin'] . " - " . $mylink['col4_snowmax'] ?></td>
      <td>Coming Soon</td>
      <td>Null</td>
    </tr>
		<tr>
      <td>Wind Speed</td>
      <td><?php echo $mylink['col4_windmin'] . " - " . $mylink['col4_winmax'] . " G(" . $mylink['col4_windgust'] . ")" ?></td>
      <td>Coming Soon</td>
      <td>Null</td>
    </tr>
		<tr>
      <td>Wind Dir.</td>
      <td><?php echo $mylink['col4_winddir']?></td>
      <td>Coming Soon</td>
      <td>Null</td>
    </tr>
  </tbody>
</table>

	<div class="twelve columns">
				<hr>
			</div>
	
	<table class="u-normal">
		<caption style="font-size:18px; font-weight:bold"><?php echo $mylink['col5_title'] ?></caption>
  <thead>
		<tr>
			<th></th>
      <th>Forecast</th>
			<th>Actual</th>
			<th>Error</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>Conditions</td>
      <td><?php echo $mylink['col5_weather'] ?></td>
      <td>Coming Soon</td>
      <td>Null</td>
    </tr>
    <tr>
      <td>Temperature</td>
      <td><?php echo $mylink['col5_temp'] ?></td>
      <td>Coming Soon</td>
      <td>Null</td>
    </tr>
		<tr>
      <td>Chance of Precip.</td>
      <td><?php echo $mylink['col5_pop'] ?></td>
      <td>Coming Soon</td>
      <td>Null</td>
    </tr>
		<tr>
      <td>Liquid Accum.</td>
      <td><?php echo $mylink['col5_precip']?></td>
      <td>Coming Soon</td>
      <td>Null</td>
    </tr>
		<tr>
      <td>Snow Accum.</td>
      <td><?php echo $mylink['col5_snowmin'] . " - " . $mylink['col5_snowmax'] ?></td>
      <td>Coming Soon</td>
      <td>Null</td>
    </tr>
		<tr>
      <td>Wind Speed</td>
      <td><?php echo $mylink['col5_windmin'] . " - " . $mylink['col5_winmax'] . " G(" . $mylink['col5_windgust'] . ")" ?></td>
      <td>Coming Soon</td>
      <td>Null</td>
    </tr>
		<tr>
      <td>Wind Dir.</td>
      <td><?php echo $mylink['col5_winddir']?></td>
      <td>Coming Soon</td>
      <td>Null</td>
    </tr>
  </tbody>
</table>
	
	<div class="twelve columns">
				<hr>
			</div>
	
	<table class="u-normal">
		<caption style="font-size:18px; font-weight:bold"><?php echo $mylink['col6_title'] ?></caption>
  <thead>
		<tr>
			<th></th>
      <th>Forecast</th>
			<th>Actual</th>
			<th>Error</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>Conditions</td>
      <td><?php echo $mylink['col6_weather'] ?></td>
      <td>Coming Soon</td>
      <td>Null</td>
    </tr>
    <tr>
      <td>Temperature</td>
      <td><?php echo $mylink['col6_temp'] ?></td>
      <td>Coming Soon</td>
      <td>Null</td>
    </tr>
		<tr>
      <td>Chance of Precip.</td>
      <td><?php echo $mylink['col6_pop'] ?></td>
      <td>Coming Soon</td>
      <td>Null</td>
    </tr>
		<tr>
      <td>Liquid Accum.</td>
      <td><?php echo $mylink['col6_precip']?></td>
      <td>Coming Soon</td>
      <td>Null</td>
    </tr>
		<tr>
      <td>Snow Accum.</td>
      <td><?php echo $mylink['col6_snowmin'] . " - " . $mylink['col6_snowmax'] ?></td>
      <td>Coming Soon</td>
      <td>Null</td>
    </tr>
		<tr>
      <td>Wind Speed</td>
      <td><?php echo $mylink['col6_windmin'] . " - " . $mylink['col6_winmax'] . " G(" . $mylink['col6_windgust'] . ")" ?></td>
      <td>Coming Soon</td>
      <td>Null</td>
    </tr>
		<tr>
      <td>Wind Dir.</td>
      <td><?php echo $mylink['col6_winddir']?></td>
      <td>Coming Soon</td>
      <td>Null</td>
    </tr>
  </tbody>
</table>
	
	<!-- End Forecast Data -->

		<div class="twelve columns">
				<hr>
			</div>
	<div class="three columns">
		<form action="iFxWx.php">
			<input name="New" id="New" value="Make a New Forecast" type="submit">
		</form></div>
	</div>
</div>
	
	
</body></html>