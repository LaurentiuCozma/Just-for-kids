<?php

$link = mysqli_connect('localhost', 'root', '','proiect-tw');
if (!$link) {
    die('Eșec la conectare: ' . mysqli_error($mysql));
}

if($_POST['TestID'] == ''){

$query = sprintf("INSERT INTO Teste (nume,dificultate_id,categorie) values ('%s','%s','%s')",
    mysqli_real_escape_string($link, $_POST['nume_test']),
    mysqli_real_escape_string($link, $_POST['dificultate']),
    mysqli_real_escape_string($link, $_POST['categorie']));

    mysqli_query($link,$query);
    $TestID = mysqli_insert_id($link);
} else {
    $TestID = $_POST['TestID'];
}

// move uploaded file

if(!empty($_FILES['imagine'])){
    if($_FILES['imagine']['error'] == 0){
        $filename = $_FILES['imagine']['name'];
        $path = dirname($_SERVER['SCRIPT_FILENAME']) . '/images/' . $filename;
        move_uploaded_file($_FILES['imagine']['tmp_name'], $path);
    }
}

if(!empty($_POST['intrebare'])){
    $query = sprintf("INSERT INTO Intrebari (test_id,intrebare,raspuns1,raspuns2,raspuns3,raspuns4,raspuns_corect,imagine) values ('%s','%s','%s','%s','%s','%s','%s','%s')",

        mysqli_real_escape_string($link,$TestID),
        mysqli_real_escape_string($link,$_POST['intrebare']),
        mysqli_real_escape_string($link,$_POST['raspuns1']),
        mysqli_real_escape_string($link,$_POST['raspuns2']),
        mysqli_real_escape_string($link,$_POST['raspuns3']),
        mysqli_real_escape_string($link,$_POST['raspuns4']),
        mysqli_real_escape_string($link,$_POST['raspuns_corect']),
        mysqli_real_escape_string($link,isset($filename) ? $filename : ''));
    	mysqli_query($link,$query);
}

header('Location: teste.php?TestID='.$TestID);
?>