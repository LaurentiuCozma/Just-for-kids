<?php
session_start();

$link = mysqli_connect('localhost', 'root', '', 'proiect-tw');
if (!$link) {
    die('Eșec la conectare: ' . mysqli_error($link));
}

if(isset($_POST['register_parinte'])){


    if($_POST['nume2_parinte'] == '' || $_POST['parola2_parinte'] == ''){
        header('Location:login-register.php');
        exit;
    }

$query = sprintf("INSERT INTO utilizatori (nume_prenume,email,telefon,parola,tip) values ('%s','%s','%s','%s','%s')",
    mysqli_real_escape_string($link,$_POST['nume2_parinte']),
    mysqli_real_escape_string($link,$_POST['mail_parinte']),
    mysqli_real_escape_string($link,$_POST['telefon_parinte']),
    mysqli_real_escape_string($link,md5($_POST['parola2_parinte'])),
    mysqli_real_escape_string($link,'parinte'));


$result = mysqli_query($link, $query);


if (!$result) {
    $message  = 'Invalid query: ' . mysqli_error($link) . "\n";
    $message .= 'Whole query: ' . $query;
    die($message);
}}

if(isset($_POST['login1_parinte'])){ 
  $query = sprintf("SELECT * from utilizatori where email = '%s' and parola = '%s'",
    mysqli_real_escape_string($link,$_POST['email_parinte']),
    mysqli_real_escape_string($link,md5($_POST['parola1_parinte'])));

$result = mysqli_query($link,$query);


if (!$result) {
    $message  = 'Invalid query: ' . mysqli_error($link) . "\n";
    $message .= 'Whole query: ' . $query;
    die($message);
}else { 
$utilizator = mysqli_fetch_assoc($result);


if(isset($utilizator)){
  $_SESSION['utilizator'] = $utilizator;
}

header('Location: index.php');

}
}
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
if(!isset($_SESSION['utilizator'])){?>
      <li><a class="active" href="login-register.php">Login|Register</a></li>

<?php } else{
  ?>
  <li><a  href="logout.php">Logout</a></li>
  <?php } ?>
      
      <li><a href="contact.php">Contact</a></li>
      <li><a href="teste.php">Teste</a></li>
      <li><a href="despre.php">Despre</a></li>
      <li><a href="index.php">Acasa</a></li>
    </ul>
        <div class = "imag">
            <img class = "imaginetop" src="images/kids.png" alt=""><br>
            <div>
                <div style="background-color: #FFF !important">
                    <div class = "autentificare">
                        <form action="#" method="post">
                            <fieldset>
                                <legend>
                                    <h2>Autentificare Parinte</h2>
                                </legend>
                                <table class='form_table'>
                                <tr>
                                    <td><label for="nume1_parinte">Email-Utilizator</label></td>
                                    <td><input type="text" name="email_parinte" id="nume1_parinte" value="" size="22" /></td>
                                </tr>
                                <tr>
                                    <td><label for="parola1_parinte" >Parola</label></td>
                                    <td><input type="password" name="parola1_parinte" id="parola1_parinte" value="" size="22" /></td>
                                </tr>
                                <tr>
                                    <td><label for="tine-minte1_parinte">Tine minte</label></td>
                                    <td><input class="checkbox" type="checkbox" name="tine-minte1_parinte" id="tine-minte1_parinte" checked="checked" /></td>
                                    
                                </tr>
                                <tr>
                                    <td><input type="submit" name="login1_parinte" id="login1_parinte" value="Autentificare" /></td>
                                    <td><input type="reset" name="reset1_parinte" id="reset1_parinte" value="Resetare" /></td>
                                </tr></table>
                            </fieldset>
                        </form>
                    </div>
                    <div class = "daca">
                        <h1> Daca nu sunteti inregistrati deja va rugam sa o faceti mai jos!</h1>
                    </div>
                    <div class = "inregistrare">
                        <form action="#" method="post">
                            <fieldset>
                                <legend>
                                    <h2>Inregistrare Parinte</h2>
                                </legend>
                                <table class='form_table'>
                                    <tr>
                                        <td>
                                            <label for="mail_parinte">E-mail</label>
                                        </td>
                                        <td>
                                            <input type="E-mail" name="mail_parinte" id="mail_parinte" value="" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label for="telefon_parinte">Telefon</label>
                                        </td>
                                        <td>
                                            <input type="tel" name="telefon_parinte" id="telefon_parinte" value="" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label for="nume2_parinte">Utilizator</label>
                                        </td>
                                        <td>
                                            <input type="text" name="nume2_parinte" id="nume2_parinte" value="" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label for="parola2_parinte">Parola</label>
                                        </td>
                                        <td>
                                            <input type="password" name="parola2_parinte" id="parola2_parinte" value="" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label for="tine-minte_parinte">Tine minte</label>
                                        </td>
                                        <td>
                                        <input class="checkbox" type="checkbox" name="tine-minte_parinte" id="tine-minte_parinte" checked="checked" /></td>
                                    </tr>
                                    
                                    <tr>
                                        <td>
                                            <input type="submit" name="register_parinte" id="login2_parinte" value="Inregistrare" />
                                        </td>
                                        <td>
                                            <input type="reset" name="reset2_parinte" id="reset2_parinte" value="Resetare" />
                                        </td>
                                    </tr>
                                </table>
                            </fieldset>
                        </form>
                    </div>
                    <div class="footer">
                        <p>Copyright &copy; 2017 - Just for Kids --- Cozma Laurentiu, Lazar Sorin-Livius, Stanciu Stefan</p>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>

