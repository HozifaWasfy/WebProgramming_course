<?php
if (isset($_POST['submit'])) {
  $old_json_data = json_decode(file_get_contents('logs.json'), true);
  $last_id = intval(end($old_json_data)['id']);
  $id =  $last_id ? $last_id + 1 : 0;
  $track = $_POST['track'];
  $date_from = $_POST['date-from'];
  $date_to = $_POST['date-to'];
  $log = $_POST['log'];
  if (isset($_POST['fellows'])) {
    $fellows = $_POST['fellows'];
  } else {
    $fellows = explode(',', $_POST['fellow-text']);
  }
  $rating = $_POST['rating'];

  $data = array(
    'id' => $id,
    'track' => $track,
    'date_from' => $date_from,
    'date_to' => $date_to,
    'log' => $log,
    'fellows' => $fellows,
    'rating' => $rating
  );
  array_push($old_json_data, $data);
  $json_data = json_encode($old_json_data);
  file_put_contents('logs.json', $json_data);

  header('Location: index.php');
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task 3</title>
    <link rel="stylesheet" href="index.css">
</head>

<body>
    <h1>Task 3: Logbook</h1>
    <h2>New log</h2>
    <form method="POST">
        Track: <br>
        <select name="track" id="track" required>
            <?php
      $tracks = json_decode(file_get_contents('tracks.json'), true);
      foreach ($tracks as $track) {
        echo '<option value="' . $track['id'] . '">' . $track['id'] . '. ' . $track['from'] . ' - ' . $track['to'] . '</option>';
      }
      ?>
        </select> <br>
        Date interval: <br>
        <input type="date" name="date-from" required> - <input type="date" name="date-to" required> <br>
        Log: <br>
        <textarea name="log" cols="120" rows="10" placeholder="Write your experiences here..." required></textarea> <br>
        Fellows: <br>
        <?php
    $logs = json_decode(file_get_contents('logs.json'), true);
    $fellows = array();
    if (isset($logs)) {
      foreach ($logs as $log) {
        $fellows = array_merge($fellows, $log['fellows']);
      }
      $unique_fellows = array_unique($fellows);
      foreach ($unique_fellows as $fellow) {
        echo '<input type="checkbox" name="fellows[]" value="' . $fellow . '">' . $fellow . '<br>';
      }
    } else {
      echo "There are no fellow registered yet";
    }
    ?>
        <small>Add new fellows as a comma-separated list:</small> <br>
        <textarea name="fellow-text" cols="20" rows="8" placeholder="fellow1,fellow2"></textarea> <br>
        Rating: <br>
        <input type="radio" name="rating" value="1" required> 1
        <input type="radio" name="rating" value="2"> 2
        <input type="radio" name="rating" value="3"> 3
        <input type="radio" name="rating" value="4"> 4
        <input type="radio" name="rating" value="5"> 5
        <br>
        <input type="submit" name="submit" value="Add new track"></input>
    </form>
</body>

</html>