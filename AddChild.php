<?php

session_start();

$link = mysqli_connect('localhost', 'root', '','proiect-tw');
if (!$link) {
    die('Eșec la conectare: ' . mysqli_error($mysql));
}

$query = sprintf("INSERT INTO copii (user_id, nume, prenume, email, teste_admisibile, dificultate_id, parola) VALUES ('%s','%s','%s','%s','%s','%s','%s')",
	mysqli_real_escape_string($link, $_SESSION['utilizator']['id']),
	mysqli_real_escape_string($link, $_POST['nume_copil']),
	mysqli_real_escape_string($link, $_POST['prenume_copil']),
	mysqli_real_escape_string($link, $_POST['email_copil']),
	mysqli_real_escape_string($link, implode(',', $_POST['teste_admise'])),
	mysqli_real_escape_string($link, $_POST['dificultate']),
	mysqli_real_escape_string($link, md5($_POST['parola']))
	);
mysqli_query($link,$query);

header('Location: teste.php');