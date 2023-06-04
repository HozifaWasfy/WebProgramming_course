<?php
    $polls = json_decode(file_get_contents("polls.json"),true);
    $results = $polls[$_POST['poll-id']]['answers'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>results</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Results of poll:  <?php echo $polls[$_POST['poll-id']]['id']; ?></h2>
    <h3><?php echo $polls[$_POST['poll-id']]['question']; ?></h3>
    <ul>
        <?php
            foreach($polls[$_POST['poll-id']]['options'] as $option){
                echo "<li>".$option. "  :  ". $results[$option]. "</li>";
            }
        ?>
    </ul>
    <form action="index.php">
        <input type="submit" value=" Return to Main Page">
</form>
</body>
</html>