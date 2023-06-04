<?php
	$places = [
		'Írottkő',
		'Sárvár',
		'Sümeg',
		'Keszthely',
		'Tapolca',
		'Badacsonytördemic',
		'Nagyvázsony',
		'Városlőd',
		'Zirc',
		'Bodajk',
		'Szárliget',
		'Dorog',
		'Piliscsaba',
		'Hűvösvölgy',
		'Rozália téglagyár',
		'Dobogókő',
		'Visegrád',
		'Nagymaros',
		'Nógrád',
		'Becske',
		'Mátraverebély',
		'Mátraháza',
		'Sirok',
		'Szarvaskő',
		'Putnok',
		'Aggtelek',
		'Bódvaszilas',
		'Boldogkőváralja',
		'Sátoraljaújhely',
		'Hollóháza'
	];
	$trackname = "";
	$from = "";
	$to = "";
	$distance = "";
	$time = "";
	$submittable = false;

	if(!empty($_GET)) {
	$trackname = isset($_GET['trackname']) ? $_GET['trackname'] : $trackname;
	$from = isset($_GET['from']) ? $_GET['from'] : $from;
	$to = isset($_GET['to']) ? $_GET['to'] : $to;
	$distance = isset($_GET['distance']) ? $_GET['distance'] : $distance;
	$time = isset($_GET['time']) ? $_GET['time'] : $time;
	
	$trackerror = "";
	$fromToerror = "";
	$timeerror = "";
	$disterror = "";
	$toerror = "";

	if(empty($trackname)){
		$trackerror = "Track name is required!";
	}
	if(empty($distance)){
		$disterror = "Distance is required!";
	}
	if(empty($from)){
		$fromToerror = "From place is required!";
	}
	if(empty($to)){
		$toerror = "To place is required!";
	}
	if(empty($time)){
		$timeerror = "Time is required!";
	}elseif(!preg_match("/^(0?[1-7]):[0-5][0-9]/",$time)){
		$timeerror = "Time must be in format H:MM and hour not exceed 7";
	}
	if($from == $to){
		$fromToerror = "Cannot go to the same point";
	}elseif(!in_array($to,$places) || !in_array($from,$places)){
		$fromToerror = "Places Must be in Hungary";
	}
	

	if (empty($toerror) && empty($trackerror) && empty($disterror) && empty($timeerror)&& empty($fromToerror)) {
        $submittable = true;
    }



 /// time regex "/^(0?[1-9]):[0-5][0-9]/"
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index.css">
    <title>Task 2</title>
</head>
<body>
    <h1>Task 2: Trip registration</h1>
    <form action="index.php" method="get" novalidate>
        <label for="i1">Track name:</label> 
		<input type="text" name="trackname" id="i1" value="<?php echo htmlspecialchars($trackname); ?>">
		<?php if (isset($trackerror)) {
            echo '<span style="color:yellow;">' . $trackerror . '</span>';
        } ?>
		<br>
        <label for="i2">From:</label>
		 <input type="text" name="from" id="i2" value="<?php echo htmlspecialchars($from); ?>"> 
		<?php if (isset($fromToerror)) {
            echo '<span style="color:yellow;">' . $fromToerror . '</span>';
        } ?>
		<br>
		<label for="i3">To:</label> <input type="text" name="to" id="i3" value="<?php echo htmlspecialchars($to); ?>"> 
		<?php if (isset($toerror)) {
            echo '<span style="color:yellow;">' . $toerror . '</span>';
        } ?>
		<br>
        <label for="i4">Distance:</label> <input type="text" name="distance" id="i4" value="<?php echo htmlspecialchars($distance); ?>"> 
		<?php if (isset($disterror)) {
            echo '<span style="color:yellow;">' . $disterror . '</span>';
        } ?>
		<br>
		<label for="i5">Time:</label> <input type="text" name="time" id="i5" value="<?php echo htmlspecialchars($time); ?>"> 
		<?php if (isset($timeerror)) {
            echo '<span style="color:yellow;">' . $timeerror . '</span>';
        } ?>
		<br>
		<button type="submit">Register</button>
    </form>


    <div id="success">
		<?php 
			if($submittable){
				echo "<h2>Trip data saved!</h2>";
			}
		?>
	</div>


    <h2>Hyperlinks for testing</h2>
    <a href="index.php?trackname=&from=&to=&distance=&time=">trackname=&from=&to=&distance=&time=</a><br>
    <a href="index.php?trackname=10.sz.+túra&from=&to=&distance=&time=">trackname=10.sz.+túra&from=&to=&distance=&time=</a><br>
    <a href="index.php?trackname=10.sz.+túra&from=Budapest&to=&distance=&time=">trackname=10.sz.+túra&from=Budapest&to=&distance=&time=</a><br>
    <a href="index.php?trackname=10.sz.+túra&from=Sárvár&to=&distance=&time=">trackname=10.sz.+túra&from=Sárvár&to=&distance=&time=</a><br>
	<a href="index.php?trackname=10.sz.+túra&from=Sárvár&to=Sárvár&distance=&time=">trackname=10.sz.+túra&from=Sárvár&to=Sárvár&distance=&time=</a><br>
    <a href="index.php?trackname=10.sz.+túra&from=Sárvár&to=Dobogókő&distance=&time=">trackname=10.sz.+túra&from=Sárvár&to=Dobogókő&distance=&time=</a><br>
    <a href="index.php?trackname=10.sz.+túra&from=Sárvár&to=Dobogókő&distance=ezer&time=">trackname=10.sz.+túra&from=Sárvár&to=Dobogókő&distance=ezer&time=</a><br>
    <a href="index.php?trackname=10.sz.+túra&from=Sárvár&to=Dobogókő&distance=1000&time=">trackname=10.sz.+túra&from=Sárvár&to=Dobogókő&distance=1000&time=</a><br>
    <a href="index.php?trackname=10.sz.+túra&from=Sárvár&to=Dobogókő&distance=1000&time=10">trackname=10.sz.+túra&from=Sárvár&to=Dobogókő&distance=1000&time=10</a><br>
    <a href="index.php?trackname=10.sz.+túra&from=Sárvár&to=Dobogókő&distance=1000&time=10%3A60">trackname=10.sz.+túra&from=Sárvár&to=Dobogókő&distance=1000&time=10%3A60</a><br>
    <a href="index.php?trackname=10.sz.+túra&from=Sárvár&to=Dobogókő&distance=1000&time=4%3A10"><span style="color: green">Correct input: </span>trackname=10.sz.+túra&from=Sárvár&to=Dobogókő&distance=1000&time=4%3A10</a><br>

    </body>
</html>
