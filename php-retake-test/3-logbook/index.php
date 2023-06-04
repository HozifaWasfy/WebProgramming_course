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
    <a href="new.php">Add new log...</a>
    <?php
  $logs = json_decode(file_get_contents('logs.json'), true);
  $tracks = json_decode(file_get_contents('tracks.json'), true);
  foreach ($tracks as $track) {
    $has_tour = false;
    foreach ($logs as $log) {
      if ($log['track'] == $track['id']) {
        $has_tour = true;
        break;
      }
    }
    if ($has_tour) {
      echo '<h2>' . $track['id'] . '. ' . $track['from'] . ' - ' . $track['to'] . '</h2>';
      echo '<ul>';
      foreach ($logs as $log) {
        if ($log['track'] == $track['id']) {
          echo '<li><a href="log.php?id=' . $log['id'] . '">' . $log['date_from'] . ' - ' . $log['date_to'] . '</a></li>';
        }
      }
      echo '</ul>';
    }
  }
  ?>
</body>

</html>