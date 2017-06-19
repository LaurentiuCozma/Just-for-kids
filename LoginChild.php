<?php

session_start();

$link = mysqli_connect('localhost', 'root', '','proiect-tw');
if (!$link) {
    die('Eșec la conectare: ' . mysqli_error($mysql));
}

echo '<pre>';
var_dump($_POST['email_copil'] == '' || $_POST['parola'] == '');
exit;


if($_POST['email_copil'] == '' || $_POST['parola'] == ''){
        header('Location:teste.php');
        exit;
    }

$query = sprintf("SELECT * from copii where email = '%s' and parola = '%s'",
    mysqli_real_escape_string($link,$_POST['email_copil']),
    mysqli_real_escape_string($link,md5($_POST['parola'])));

$result = mysqli_query($link,$query);


if (!$result) {
    $message  = 'Invalid query: ' . mysqli_error($link) . "\n";
    $message .= 'Whole query: ' . $query;
    die($message);
}else { 
	$copil = mysqli_fetch_assoc($result);
}

if(isset($copil)){
  $_SESSION['copil'] = $copil;
}

header('Location: teste.php');

?>