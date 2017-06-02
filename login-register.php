<?php
session_start();
$link = mysql_connect('localhost', 'root', '');
if (!$link) {
    die('Eșec la conectare: ' . mysql_error());
}
$db_selected = mysql_select_db('proiect-tw', $link);
if (!$db_selected) {
    die ('Can\'t use proiect-tw : ' . mysql_error());
}


if(isset($_POST['register_parinte'])){




$query = sprintf("INSERT INTO utilizatori (nume_prenume,email,telefon,parola,tip) values ('%s','%s','%s','%s','%s')",
    mysql_real_escape_string($_POST['nume2_parinte']),
    mysql_real_escape_string($_POST['mail_parinte']),
    mysql_real_escape_string($_POST['telefon_parinte']),
    mysql_real_escape_string(md5($_POST['parola2_parinte'])),
    mysql_real_escape_string('parinte'));


$result = mysql_query($query);

// Check result
// This shows the actual query sent to MySQL, and the error. Useful for debugging.
if (!$result) {
    $message  = 'Invalid query: ' . mysql_error() . "\n";
    $message .= 'Whole query: ' . $query;
    die($message);
}}

if(isset($_POST['login1_parinte'])){ 
  $query = sprintf("SELECT * from utilizatori where email = '%s' and parola = '%s'",
    mysql_real_escape_string($_POST['email_parinte']),
    mysql_real_escape_string(md5($_POST['parola1_parinte'])));

$result = mysql_query($query);

// Check result
// This shows the actual query sent to MySQL, and the error. Useful for debugging.
if (!$result) {
    $message  = 'Invalid query: ' . mysql_error() . "\n";
    $message .= 'Whole query: ' . $query;
    die($message);
}else { 
$utilizator = mysql_fetch_assoc($result);


if(isset($utilizator)){
  $_SESSION['utilizator'] = $utilizator;
}


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
        <?php
            require_once 'meniu.php';
            
            ?>
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
                                    <td><label for="tine-minte1_parinte"></td>
                                    <td><input class="checkbox" type="checkbox" name="tine-minte1_parinte" id="tine-minte1_parinte" checked="checked" /></td>
                                    Tine minte</label>
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
                                            <label for="tine-minte_parinte">
                                        </td>
                                        <td>
                                        <input class="checkbox" type="checkbox" name="tine-minte_parinte" id="tine-minte_parinte" checked="checked" /></td>
                                    </tr>
                                    Tine minte</label>
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

