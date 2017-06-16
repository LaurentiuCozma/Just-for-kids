
<?php 
echo '<pre>';
var_dump($_POST,$_FILES); exit;

$link = mysqli_connect('localhost', 'root', '','proiect-tw');
if (!$link) {
    die('Eșec la conectare: ' . mysql_error());
}

if($_POST['TestID'] == ''){

$query = sprintf("INSERT INTO Teste (nume,dificultate_id,categorie) values ('%s','%s','%s')",
    mysql_real_escape_string($_POST['nume_test']),
    mysql_real_escape_string($_POST['dificultate']),
    mysql_real_escape_string($_POST['categorie']));

mysqli_query($link,$query);
$TestID = mysqli_insert_id($link);
} else { $TestID = $_POST['TestID'];



}



$query = sprintf("INSERT INTO Intrebari (test_id,intrebare,raspuns1,raspuns2,raspuns3,raspuns4,raspuns_corect,imagine) values ('%s','%s','%s','%s','%s','%s','%s','%s')",

    mysql_real_escape_string($TestID),
    mysql_real_escape_string($_POST['intrebare']),
    mysql_real_escape_string($_POST['raspuns1']),
    mysql_real_escape_string($_POST['raspuns2']),
    mysql_real_escape_string($_POST['raspuns3']),
    mysql_real_escape_string($_POST['raspuns4']),
    mysql_real_escape_string($_POST['raspuns_corect']),
    mysql_real_escape_string(''));
	mysqli_query($link,$query);
    header('Location: teste.php?TestID='.$TestID);
	
?>