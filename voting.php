<?php
    require_once "functions.php";
    session_start();
    $pollid=$_POST['poll-id'];
    //$polls_json = fopen("polls.json", "r");
    $pols = (array)(json_decode(file_get_contents("polls.json"),true));
    $poll =(array)$pols[$pollid];

// var_dump($_POST);
// var_dump($_SESSION);
if(isset($_POST["ans"])){
    echo "nooo";
}else{
    
}

    // echo $pollid;
    // var_dump($poll);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Vote</title>
    <style>
            #poll-area{
            width: 50%;
            margin: 0 auto;
            background-color: #fff;
            padding: 5em;
            border-radius: 5px;
            box-shadow: 2px 2px 5px #ccc;
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
<div id="poll-area">
<h2><?= $poll['question'] ?></h1>
        <form action="savevote.php" method="POST" novalidate>
            <input type="hidden" name="pollid" value="<?= $pollid ?>">
            <?php if (!$poll['isMultiple']) : ?>
            <?php foreach ($poll['options'] as $option) : ?>
                <input type="radio" id="aaaa" name="ans[]" value="<?= $option ?>" required> <?= $option ?><br>
            <?php endforeach; ?>
            <?php endif; ?>
            <?php if ($poll['isMultiple']) : ?>
                <p>You can select multiple options</p>
                <?php foreach ($poll['options'] as $option) : ?>
                    <input type="checkbox" name="ans[]" value="<?= $option ?>" required> <?= $option ?><br>
                <?php endforeach; ?>
            <?php endif; ?>
            <br>
            <?php echo('Deadline for the poll is on: ' . $poll['deadline']);  ?>
            <br>
            <br>
            <input type="submit" name="vvv" value="Submit">
        </form>
            </div>
</body>
</html>



