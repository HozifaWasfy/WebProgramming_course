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
    <a href="index.php">Back to main page</a>
    <h2>Log details</h2>

    <dl>
        <?php
    $logs = json_decode(file_get_contents('logs.json'), true);
    $tracks = json_decode(file_get_contents('tracks.json'), true);
    $log_id = $_GET['id'];
    foreach ($logs as $log) {
      if ($log['id'] == $log_id) {
        $track = $log['track'];
        echo '<a href="edit.php?id=' . $log['id'] . '">Edit Log</a>';
        echo '<dt>Track</dt>';
        echo '<dd>' . $log['track'] . '. From ' . $tracks[$track]['from'] . ' To ' .  $tracks[$track]['to'] . '</dd>';
        echo '<dt>Date</dt>';
        echo '<dd> From ' . $log['date_from'] . ' To ' .  $log['date_to'] . '</dd>';
        echo '<dt>Log:</dt>';
        echo '<dd>' . nl2br(htmlspecialchars($log['log'])) . '</dd>';
        echo '<dt>Fellows:</dt>';
        echo '<dd>' . implode(', ', $log['fellows']) . '</dd>';
        echo '<dt>Rating:</dt>';
        echo '<dd>' . $log['rating'] . '</dd>';
        break;
      }
    }
    ?>
    </dl>

</body>

</html>