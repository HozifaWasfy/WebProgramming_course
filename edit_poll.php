<?php
session_start();
if(isset($_POST['poll-id'])){

$polls_json = file_get_contents("polls.json");
$pols = (array)json_decode(file_get_contents("polls.json"),true);
$poll = $pols[$_POST["poll-id"]];
unset($pols[$_POST['poll-id']]);
if(isset($_POST['edited'])){
    var_dump($_POST);
    $id = $_POST["id"];
    $question = $_POST["question"];
    $options = $_POST["options"];
    $allow_multiple = isset($_POST["multiple"]) ? true : false;
    $expiry_date = $_POST["deadline"];
    $answersarr =[];
    foreach ($options as $op){
        $answersarr[$op] = 0;
    }
    $poll2 = array(
        "id" => $id,
        "question" => $question,
        "options" => $options,
        "isMultiple" => $allow_multiple,
        "deadline" => $expiry_date,
        "createdAt" => date("Y-m-d H:i:s"),
        "answers" => $answersarr,
        "voted" => array()
    );
    $pols[$id] = $poll2;
    file_put_contents('polls.json', json_encode($polls,JSON_PRETTY_PRINT));
    //redirect("index.php");
}
var_dump($_POST);
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
<form action="save_poll.php" method="post">
    <h2>Create poll</h2>
    <input type="hidden" name="poll-id" value= <?=$_POST["poll-id"]?>>
        <!-- <input type="hidden" name="edited"> -->
        <label for="id">Poll Id:</label>
        <input type="text" id="id" name="id" value="<?php echo $poll['id']?>">
        <br>
        <label for="question">Poll Question:</label>
        <input type="text" id="question" name="question" value="<?php echo $poll['question'] ?>">
        <br>
        <label for="options">Options:</label>
        <?php
            foreach($poll['options'] as $opt){
                echo '<input type="text" id="option1" name="options[]" value='.$opt.'>';
            }
        ?>
        <!-- <input type="text" id="option1" name="options[]">
        <input type="text" id="option2" name="options[]">
        <input type="text" id="option3" name="options[]"> -->
        <br>
        <label for="multiple">Allow multiple selection</label>
        <input type="checkbox" id="multiple" name="multiple" <?php echo ($poll['isMultiple']?"checked":''); ?>/>
        <br>
        <label for="deadline">Deadline:</label>
        <input type="date" id="deadline" name="deadline" value="<?php echo isset($poll['deadline']) ? $poll['deadline'] : '' ?>">
        <br>
        <input type="submit" value="Edit Poll" name="edited">
    </form>
</div>
</body>
</html>