<?php
function show_poll($poll){
    $id = $poll->id;
    $question = $poll->question;
    $options = $poll->options;
    $isMultiple = $poll->isMultiple;
    $createdAt = $poll->createdAt;
    $deadline = $poll->deadline;
    $answers = $poll->answers;
    $voted = $poll->voted;
    // $id = $poll['id'];
    // $question = $poll['question'];
    // $options = $poll['options'];
    // $isMultiple = $poll['isMultiple'];
    // $createdAt = $poll['createdAt'];
    // $deadline = $poll['deadline'];
    // $answers = $poll['answers'];
    // $voted = $poll['voted'];
    
    echo "<tr>";
    echo "<td>";
    echo "<span>".$id."</span>" ;
    echo "</td>";
    echo "<td>";
    echo $createdAt;
    echo "</td>";
 
    echo "<td>";
    echo $deadline;
    echo "</td>";
    if(voted_before($poll)){

        echo "<td>";
           //echo '<a href="voting.php" id='.$id.'>Vote</a>'; 
           echo '<form action="voting.php" method="post">';
           echo '<input type="hidden" name="poll-id" value='. $id.'>';
           echo '<input type="submit" id="vote" value="Update" name="vote">';
            echo '</form>';
        echo "</td>";
    }else{
        echo "<td>";
           //echo '<a href="voting.php" id='.$id.'>Vote</a>'; 
           echo '<form action="voting.php" method="post">';
           echo '<input type="hidden" name="poll-id" value='. $id.'>';
           echo '<input type="submit" id="vote" value="Vote" name="vote">';
            echo '</form>';
        echo "</td>";

    }


    if(isset($_SESSION['userid']) && $_SESSION["userid"]=="admin"){
        echo "<td>";
        echo '<form action="delete_poll.php" method="post">';
        echo '<input type="hidden" name="poll-id" value='. $id.'>';
        echo '<input type="submit" id="vote" value="Delete" name="delete">';
        echo '</form>';
        echo "</td>";
    }
    if(isset($_SESSION['userid']) && $_SESSION["userid"]=="admin"){
        echo "<td>";
        echo '<form action="edit_poll.php" method="post">';
        echo '<input type="hidden" name="poll-id" value='. $id.'>';
        echo '<input type="submit" id="vote" value="Edit" name="Edit">';
        echo '</form>';
        echo "</td>";
    }
    
    echo "</tr>";
}
function show_ex_poll($poll){
    $id = $poll->id;
    $question = $poll->question;
    $options = $poll->options;
    $isMultiple = $poll->isMultiple;
    $createdAt = $poll->createdAt;
    $deadline = $poll->deadline;
    $answers = $poll->answers;
    $voted = $poll->voted;
    // $id = $poll['id'];
    // $question = $poll['question'];
    // $options = $poll['options'];
    // $isMultiple = $poll['isMultiple'];
    // $createdAt = $poll['createdAt'];
    // $deadline = $poll['deadline'];
    // $answers = $poll['answers'];
    // $voted = $poll['voted'];
    
    echo "<tr>";
    echo "<td>";
    echo "<span>".$id."</span>" ;
    echo "</td>";
    echo "<td>";
    echo $createdAt;
    echo "</td>";
 
    echo "<td>";
    echo $deadline;
    echo "</td>";
 
    echo "<td>";
        echo '<form action="result.php" method="post">';
        echo '<input type="hidden" name="poll-id" value='. $id.'>';
        echo '<input type="submit" id="vote" value="res" name="delete">';
        echo '</form>';
    echo "</td>";
    
    if(isset($_SESSION['userid']) && $_SESSION["userid"]=="admin"){
        echo "<td>";
        echo '<form action="delete_poll.php" method="post">';
        echo '<input type="hidden" name="poll-id" value='. $id.'>';
        echo '<input type="submit" id="vote" value="Delete" name="delete">';
        echo '</form>';
        echo "</td>";
    }
    if(isset($_SESSION['userid']) && $_SESSION["userid"]=="admin"){
        echo "<td>";
        echo '<form action="edit_poll.php" method="post">';
        echo '<input type="hidden" name="poll-id" value='. $id.'>';
        echo '<input type="submit" id="vote" value="Edit" name="Edit">';
        echo '</form>';
        echo "</td>";
    }
    echo "</tr>";
}
function add_admin_features(){
    echo "<td>";
    echo '<a href="delete_poll.php" id=>Delete</a>'; 
    echo "</td>";
}
 
function redirect($page){
    header('Location: '.$page);
    die;
}

function get_ongoing_polls($polls)
{
    if(empty($polls)) return [];
    $ongoing_polls = [];
    foreach ($polls as $poll) {
        if (isset($pol->deadline) && !empty($pol->deadline) && strtotime($pol->deadline) > time()) {
            $ongoing_polls[] = $poll;
        }
    }
    return $ongoing_polls;
}

function get_expired_polls($polls)
{
    if(empty($polls)) return [];
    $ongoing_polls = [];
    foreach ($polls as $poll) {
        if (isset($pol->deadline) && !empty($pol->deadline) && strtotime($pol->deadline) < time()) {
            $ongoing_polls[] = $poll;
        }
    }
    return $ongoing_polls;
}
function check_user($usern,$password){
    $users = (array)json_decode(file_get_contents("users.json"),true);
    foreach($users as $user){
        //var_dump(($user->username == $user && $user->password==$password));
        //print_r($user['username']);
        //print_r($user['password']);
        //print_r($user->password);
        if($user['username'] == $usern && $user['password']==$password){
            return true;
        }
    }
    return false;

}
function save_user($email,$username,$password){
    $users = (array)json_decode(file_get_contents("users.json"),true);
    $users[] = [
        'email' => $email,
        'username' => $username,
        'password' => $password
    ];
    $json_data = json_encode($users, JSON_PRETTY_PRINT);
    file_put_contents('users.json', $json_data);
}
function voted_before($poll){
    foreach($poll->voted as $part){
        if(isset($_SESSION['userid']) && $part == $_SESSION['userid']){
            return true;
        }
    }
return false;
}

 function check_form($email,$username,$password,$confirm_password){
    if (empty($email) || empty($username) || empty($password) || empty($confirm_password)) {
        echo "Please fill in all the fields";
    } else {
        //check if email is valid
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "Invalid email format";
        } else {
            //check if password and confirm password match
            if ($password != $confirm_password) {
                echo "Passwords do not match";
            } else {
                //save the user to the database
                save_user($username, $password, $email);

            }
        }
    }
 }
?>

