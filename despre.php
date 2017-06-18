<?php

  session_start();

?>

<!DOCTYPE html>
<html>
<head>
	<title>Just for Kids</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <link rel="stylesheet" href="style.css">
</head>
<body style="margin-top: 0px;
             margin-left: 0px;
             margin-bottom: 0px;
             margin-right: 0px;">
    <ul class = "meniu">
<?php 
if(!isset($_SESSION['utilizator']) && !isset($_SESSION['copil'])){?>
      <li><a href="login-register.php">Login|Register</a></li>

<?php } else{
  ?>
  <li><a  href="logout.php">Logout</a></li>
  <?php } ?>
      
      <li><a href="contact.php">Contact</a></li>
      <li><a href="teste.php">Teste</a></li>
      <li><a class="active" href="despre.php">Despre</a></li>
      <li><a href="index.php">Acasa</a></li>
    </ul>

    <div class = "imag">
      <img class = "imaginetop" src="images/kids.png" alt=""><br>
    <div>
<div style="background-color: #FFF !important">

    <div class="detalii">
          <h2>32. JfK (Just for Kids Game)</h2>
          <p>Sa se propuna un joc Web care ofera copiilor mijloace amuzante de invatare si testare interactiva a cunostintelor generale dintr-un domeniu ales dintr-o lista editabila (exemple tipice: matematica, literatura, geografie, istorie, muzica). Rezultatele testelor realizate vor putea fi raportate parintilor, rudelor sau tutorilor legali via e-mail si fluxuri de stiri Atom. Se vor oferi mai multe niveluri de dificultate in functie de varsta copiilor -- e.g., prescolari, scolari mici, elevi de gimnaziu etc. Parintii/tutorii vor avea posibilitatea monitorizarii progresului inregistrat si a gestionarii testelor si cunostintelor folosite pentru instruire, eventual preluate de pe diverse situri de profil indicate de utilizatori. Bonus: partajarea celor mai bune rezultate obtinute de copii pe minim 2 retele sociale (e.g., Facebook si Twitter).</p>
    </div>
    
    <div class = "resurse">
          <h2>Resurse:</h2>
        <ul>
          <li><a href="http://atomenabled.org/" target="_blank">Atom</a></li>
          <li><a href="http://www.programmableweb.com/category/social/api" target="_blank">Social API</a></li>
        </ul>
        <p>Persoane alocate: 3</p>
    </div>

    <div class="footer">
        <p>Copyright &copy; 2017 - Just for Kids --- Cozma Laurentiu, Lazar Sorin-Livius, Stanciu Stefan</p>
    </div>

</div>
</div>
</div>

</body>
</html>

