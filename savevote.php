<?php
require_once "functions.php";
session_start();

$polls = json_decode(file_get_contents('polls.json'),true);
$poll = $polls[$_POST['pollid']];
// var_dump($_POST['ans']);
foreach($_POST['ans'] as $ans){
$poll['answers'][$ans]++;
}
if(!in_array($_SESSION['userid'],$poll['voted'])){
    array_push($poll['voted'],$_SESSION['userid']);
}
$polls[$_POST['pollid']] =  $poll;
file_put_contents('polls.json', json_encode($polls,JSON_PRETTY_PRINT));
redirect('index.php');
var_dump($poll['voted']);
var_dump($poll);
// var_dump($_POST);
// var_dump($_SESSION);
?>
