<?php
require_once "functions.php";
$polls_json = file_get_contents("polls.json");
$pols = (array)json_decode(file_get_contents("polls.json"),true);
if (isset($_POST["id"]) && isset($_POST["question"]) && !empty($_POST["options"]) && isset($_POST["deadline"])) {
    $id = $_POST["id"];
    $question = $_POST["question"];
    $options = $_POST["options"];
    $allow_multiple = isset($_POST["multiple"]) ? true : false;
    $expiry_date = $_POST["deadline"];

    if(!file_exists('polls.json')){
        echo "polls.json file not found";
        exit;
    }

    // Read the JSON file


    if($pols === null){
        echo "polls.json file is empty or invalid json format";
        exit;
    }

    // Get the next available index for the new poll
    $next_index = count($pols);

    // Add the new poll to the JSON file
    
    //var_dump($pols);
    $answersarr =[];
    foreach ($options as $op){
        $answersarr[$op] = 0;
    }
    var_dump($answersarr);
    $pols[$id] = array(
        "id" => $id,
        "question" => $question,
        "options" => $options,
        "isMultiple" => $allow_multiple,
        "deadline" => $expiry_date,
        "createdAt" => date("Y-m-d H:i:s"),
        "answers" => $answersarr,
        "voted" => array()
    );
    // Save the JSON file
    if(!file_put_contents('polls.json', json_encode($pols,JSON_PRETTY_PRINT))){
        echo "Failed to write to polls.json";
        exit;
    }

 redirect('index.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Make your poll</title>
    <link rel="stylesheet" href="style.css">
    <style>
            div{
            width: 50%;
            margin: 0 auto;
            background-color: #fff;
            padding: 5em;
            border-radius: 5px;
            box-shadow: 2px 2px 5px #ccc;
            align: center;
            display:flex;
        }
        html {
  --s: 50px;
  --c: #191b22;
  --_s: calc(2*var(--s)) calc(2*var(--s));
  --_g: 35.36% 35.36% at;
  --_c: #0000 66%,#20222a 68% 70%,#0000 72%;
  background: 
    radial-gradient(var(--_g) 100% 25%,var(--_c)) var(--s) var(--s)/var(--_s), 
    radial-gradient(var(--_g) 0 75%,var(--_c)) var(--s) var(--s)/var(--_s), 
    radial-gradient(var(--_g) 100% 25%,var(--_c)) 0 0/var(--_s), 
    radial-gradient(var(--_g) 0 75%,var(--_c)) 0 0/var(--_s), 
    repeating-conic-gradient(var(--c) 0 25%,#0000 0 50%) 0 0/var(--_s), 
    radial-gradient(var(--_c)) 0 calc(var(--s)/2)/var(--s) var(--s) var(--c);
  background-attachment: fixed;
}
    </style>
</head>
<body>
    <div>
<form method="post">
    <h2>Create poll</h2>
        <label for="id">Poll Id:</label>
        <input type="text" id="id" name="id">
        <br>
        <label for="question">Poll Question:</label>
        <input type="text" id="question" name="question">
        <br>
        <label for="options">Options:</label>
        <input type="text" id="option1" name="options[]">
        <input type="text" id="option2" name="options[]">
        <input type="text" id="option3" name="options[]">
        <br>
        <label for="multiple">Allow multiple selection</label>
        <input type="checkbox" id="multiple" name="multiple" value="true">
        <br>
        <label for="deadline">Deadline:</label>
        <input type="date" id="deadline" name="deadline">
        <br>
        <input type="submit" value="Create Poll">
    </form>
</div>
</body>
</html>