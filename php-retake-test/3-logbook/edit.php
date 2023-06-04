<?php

if (isset($_GET['id'])) {
    $logs = json_decode(file_get_contents('logs.json'), true);
    $selected_log = null;
    foreach ($logs as $log) {
        if ($log['id'] == $_GET['id']) {
            $selected_log = $log;
            break;
        }
    }
}

if (isset($_POST['submit'])) {
    $old_json_data = json_decode(file_get_contents('logs.json'), true);
    $id = $_POST['id'];
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
    // loop through the logs array and check if the current log id is equal to the id that you have passed in the hidden input field
    for ($i = 0; $i < count($old_json_data); $i++) {
        if ($old_json_data[$i]['id'] == $id) {
            $old_json_data[$i] = $data;
            break;
        }
    }
    $json_data = json_encode($old_json_data);
    file_put_contents('logs.json', $json_data);
    header('Location: log.php?id=' . $id);
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
    <h2>Edit log</h2>
    <form method="POST">
        <input type="hidden" name="id" value="<?php echo $selected_log['id']; ?>">
        Track: <br>
        <select name="track" id="track" required>
            <?php
            $tracks = json_decode(file_get_contents('tracks.json'), true);
            foreach ($tracks as $track) {
                if ($track['id'] == $selected_log['track']) {
                    echo '<option value="' . $track['id'] . '" selected>' . $track['id'] . '. ' . $track['from'] . ' - ' . $track['to'] . '</option>';
                } else {
                    echo '<option value="' . $track['id'] . '">' . $track['id'] . '. ' . $track['from'] . ' - ' . $track['to'] . '</option>';
                }
            }
            ?>
        </select> <br>
        Date interval: <br>
        <input type="date" name="date-from" value="<?php echo $selected_log['date_from']; ?>" required> - <input
            type="date" name="date-to" value="<?php echo $selected_log['date_to']; ?>" required> <br>
        Log: <br>
        <textarea name="log" cols="120" rows="10" required><?php echo $selected_log['log']; ?></textarea> <br>
        Fellows: <br>
        <?php
        $fellows = array();
        foreach ($logs as $log) {
            $fellows = array_merge($fellows, $log['fellows']);
        }
        $unique_fellows = array_unique($fellows);
        foreach ($unique_fellows as $fellow) {
            if (in_array($fellow, $selected_log['fellows'])) {
                echo '<input type="checkbox" name="fellows[]" value="' . $fellow . '" checked>' . $fellow . '<br>';
            } else {
                echo '<input type="checkbox" name="fellows[]" value="' . $fellow . '">' . $fellow . '<br>';
            }
        }
        ?>
        <small>Add new fellows as a comma-separated list:</small> <br>
        <textarea name="fellow-text" cols="20" rows="8"
            placeholder="fellow1,fellow2"><?php echo implode(',', $selected_log['fellows']); ?></textarea> <br>
        Rating: <br>
        <input type="radio" name="rating" value="1" <?php echo ($selected_log['rating'] == 1) ? 'checked' : ''; ?>
            required> 1
        <input type="radio" name="rating" value="2" <?php echo ($selected_log['rating'] == 2) ? 'checked' : ''; ?>
            required> 2
        <input type="radio" name="rating" value="3" <?php echo ($selected_log['rating'] == 3) ? 'checked' : ''; ?>
            required> 3
        <input type="radio" name="rating" value="4" <?php echo ($selected_log['rating'] == 4) ? 'checked' : ''; ?>
            required> 4
        <input type="radio" name="rating" value="5" <?php echo ($selected_log['rating'] == 5) ? 'checked' : ''; ?>
            required> 5 <br>
        <input type="submit" name="submit" value="Save">
    </form>
</body>

</html>


</body>

</html>