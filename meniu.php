
<?php
 preg_match('/.+\/(.+\.php)/', $_SERVER['REQUEST_URI'],$matches);
?>

<ul class = "meniu">
<?php 
if(!isset($_SESSION['utilizator'])){?>
      <li><a class="<?php if($matches[1] == 'login-register.php') echo 'active'?>" href="login-register.php">Login|Register</a></li>

<?php } else{
	?>
	<li><a  href="logout.php">Logout</a></li>
	<?php } ?>
      
      <li><a class="<?php if($matches[1] == 'contact.php') echo 'active'?>" href="contact.php">Contact</a></li>
      <li><a class="<?php if($matches[1] == 'teste.php') echo 'active'?>" href="teste.php">Teste</a></li>
      <li><a class="<?php if($matches[1] == 'despre.php') echo 'active'?>" href="despre.php">Despre</a></li>
      <li><a class="<?php if($matches[1] == 'index.php') echo 'active'?>" href="index.php">Acasa</a></li>
    </ul>