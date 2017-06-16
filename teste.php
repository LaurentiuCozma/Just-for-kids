<?php   

$link = mysqli_connect('localhost', 'root', '','proiect-tw');
if (!$link) {
    die('Eșec la conectare: ' . mysql_error());
}


$query = sprintf("select * from Dificultati");

$result = mysqli_query($link,$query);

$query = sprintf("select * from Teste where id = '%s'",$_GET['TestID']);
$result2 = mysqli_query($link,$query);

$row2 = mysqli_fetch_assoc($result2);
?>

<!DOCTYPE html>
<html>
<head>
  <title>Just for Kids</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="text/html; charset=utf-8" http-equiv="Content-Type">
  <link href="style.css" rel="stylesheet">
</head>
<body style="margin-top: 0px; margin-left: 0px; margin-bottom: 0px; margin-right: 0px;">
  <?php
          require_once 'meniu.php';

        ?>
  <div class="imag">
    <img alt="" class="imaginetop" src="images/kids.png"><br>
    <div>
      <div style="background-color: #FFF !important">
        <div class="teste">
          <form action='AddTest.php' class="AddTestForm" method='post' enctype="multipart/form-data">
            <fieldset>
            <legend><h2>Adaugare test</h2></legend>
              <table class="AddTestTable">
                
              <tr><td><input type="hidden" value='<?php echo $_GET['TestID'] ?>' name="TestID"></td></tr>
                <tr>
                  <td><label>Nume test</label></td>
                  <td><input value="<?php echo $row2['nume'] ?>" name="nume_test" type="text"></td>
                </tr>
                <tr>
                  <td><label>Dificultate</label></td>
                  <td>
                   <select name="dificultate">
                  <?php
                  while($row = mysqli_fetch_assoc($result)){

                  ?>
                 
                    <option <?php if( $row2['dificultate_id'] == $row['id']) echo 'selected="selected"' ?> value='<?php echo $row['id']; ?>'>
                      <?php echo $row['dificultate']; ?>
                    </option>
                   <?php } ?> 
                  </select></td>
                </tr>
                <tr>
                  <td><label>Categorie</label></td>
                  <td><select name="categorie">
                   <option <?php if( $row2['categorie'] == 'matematica') echo 'selected="selected"' ?> value="matematica">Matematica</option> 
                   <option <?php if( $row2['categorie'] == 'literatura') echo 'selected="selected"' ?> value="literatura">Literatura</option> 
                   <option <?php if( $row2['categorie'] == 'muzica') echo 'selected="selected"' ?> value="muzica">Muzica</option> 
                   <option <?php if( $row2['categorie'] == 'geografie') echo 'selected="selected"' ?> value="geografie">Geografie</option> </select></td>
                </tr>
               
              </table>
              <hr>
              <table class="AddQuestionTable">
                <tr>
                  <td>Intrebare:</td>
                  <td>
                  <textarea name="intrebare"></textarea></td>
                </tr>
                <tr> <td> Adauga imagine: </td> <td> <input type="file" name="imagine" /> </td> </tr>
                <tr>
                  <td>Raspuns1:</td>
                  <td><input class="AddRaspuns" name="raspuns1" type="text"></td>
                </tr>
                <tr>
                  <td>Raspuns2:</td>
                  <td><input class="AddRaspuns" name="raspuns2" type="text"></td>
                </tr>
                <tr>
                  <td>Raspuns3:</td>
                  <td><input class="AddRaspuns" name="raspuns3" type="text"></td>
                </tr>
                <tr>
                  <td>Raspuns4:</td>
                  <td><input class="AddRaspuns" name="raspuns4" type="text"></td>
                </tr>
                <tr> <td >Raspuns Corect:</td>
                  <td><select  name="raspuns_corect">
                    <option value="raspuns1">
                      Raspuns1
                    </option>
                    <option value="raspuns2">
                      Raspuns2
                    </option>
                    <option value="raspuns3">
                      Raspuns3
                    </option>
                    <option value="raspuns4">
                      Raspuns4
                    </option>
                  </select></td>
                </tr>
              </table>
              <hr>
              <button type="submit">Salveaza</button>
            </fieldset>
          </form>
        </div>
        <div class="footer">
          <p>Copyright &copy; 2017 - Just for Kids --- Cozma Laurentiu</p>
        </div>
      </div>
    </div>
  </div>
</body>
</html>