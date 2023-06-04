<?php
require_once "functions.php";
session_start();
$polls = json_decode(file_get_contents('polls.json'),true);
$poll = $polls[$_POST['poll-id']];
var_dump($_POST['multiple']);
$answersarr = array();
$ismult = isset($_POST['multiple']);
foreach($_POST['options'] as $opt){
    $answersarr[$opt] = 0;
}
$newpoll = array(
    "id" =>$_POST['id'] ,
    "question" =>$_POST['question'] ,
    "options" =>$_POST['options'] ,
    "isMultiple" => $ismult,
    "deadline" => $_POST['deadline'],
    "createdAt" => date("Y-m-d H:i:s"),
    "answers" => $answersarr,
    "voted" => array()
);
unset($polls[$_POST['poll-id']]);
$polls[$_POST['id']]= $newpoll;
file_put_contents('polls.json', json_encode($polls,JSON_PRETTY_PRINT));
redirect('index.php');
// var_dump($_POST);
// var_dump($newpoll);
?>
