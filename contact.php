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
    <?php
      require_once 'meniu.php';

    ?>

<div class = "imag">
      <img class = "imaginetop" src="images/kids.png" alt=""><br>
<div> 
    
<div>
    <div style="background-color: #FFF !important">

		<div class = "formular">
     		<h2>Trimite-ne un mesaj!</h2>
     
        		<form action="#" method="post">
          			<p>
            			<input type="text" name="name" id="name" value="" size="22" />
            			<label for="name"><small>Nume (obligatoriu)</small></label>
          			</p>
          			<p>
            			<input type="text" name="email" id="email" value="" size="22" />
            			<label for="email"><small>E-Mail (obligatoriu)</small></label>
          			</p>
          			<p>
            			<textarea name="comment" id="comment" cols="50" rows="5"></textarea>
            			<label for="comment" style="display:none;"><small>Mesaj (obligatoriu)</small></label>
          			</p>
          			<p>
            			<input name="submit" type="submit" id="submit" value="Trimite Mesaj!" />
            			
            			<input name="reset" type="reset" id="reset" tabindex="5" value="Reseteaza Formular!" />
          			</p>
        		</form>
   		</div>

		<div class ="contact">
        	<h2>Date de contact:</h2>
        	<p>Unul dintre dezvoltatorii nostri nu te vor contacta prea curand!!!</p>
        		<ul>
          			<li><a href="#">Cozma Laurentiu-Cristinel</a></li>
          			<li><a href="#">Lazar Sorin-Livius</a></li>
          			<li><a href="#">Stanciu Stefan</a></li>
        		</ul>
        	<p>Nota de subsol: Formularul nu functioneaza!</p>
		</div>
   
	
  

    <div class="footer">
        <p>Copyright &copy; 2017 - Just for Kids --- Cozma Laurentiu, Lazar Sorin-Livius, Stanciu Stefan</p>
    </div>
    </div>
</div>
</div>
</div>

</body>
</html>

