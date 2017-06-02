<ul class = "meniu">
<?php 
if(!isset($_SESSION['utilizator'])){?>
      <li><a class="active" href="login-register.php">Login|Register</a></li>
<?php } else{
	?>
	<li><a class="active" href="logout.php">Logout</a></li>
	<?php } ?>
      
      <li><a href="contact.php">Contact</a></li>
      <li><a href="teste.php">Teste</a></li>
      <li><a href="despre.php">Despre</a></li>
      <li><a href="index.php">Acasa</a></li>
    </ul>