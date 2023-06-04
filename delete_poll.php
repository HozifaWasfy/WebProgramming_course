<?php
require_once "functions.php";
    if(isset($_POST['poll-id'])){
        $polls = json_decode(file_get_contents('polls.json'),true);
        unset($polls[$_POST['poll-id']]);
        file_put_contents('polls.json', json_encode($polls,JSON_PRETTY_PRINT));
        redirect('index.php');
    }
?>