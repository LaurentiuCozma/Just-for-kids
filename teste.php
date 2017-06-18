<?php   

session_start();

$link = mysqli_connect('localhost', 'root', '','proiect-tw');
if (!$link) {
    die('Eșec la conectare: ' . mysqli_error($link));
}

$query = sprintf("select * from Teste");

$result4 = mysqli_query($link,$query);

$query = sprintf("select * from Dificultati");

$result = mysqli_query($link,$query);

$questions_count = 0;

if(isset($_GET['TestID'])){
  $query = sprintf("select * from Teste where id = '%s'", mysqli_real_escape_string($link,$_GET['TestID']));
  $result2 = mysqli_query($link,$query);

  $row2 = mysqli_fetch_assoc($result2);

  $query = sprintf("select count(*) as questions_count from Intrebari where test_id = '%s'", mysqli_real_escape_string($link,$_GET['TestID']));

  $result3 = mysqli_query($link,$query);

  $questions_count = mysqli_fetch_assoc($result3);
}
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
  <ul class = "meniu">
<?php 
if(!isset($_SESSION['utilizator']) && !isset($_SESSION['copil'])){?>
      <li><a href="login-register.php">Login|Register</a></li>

<?php } else{
  ?>
  <li><a  href="logout.php">Logout</a></li>
  <?php } ?>
      
      <li><a href="contact.php">Contact</a></li>
      <li><a class="active" href="teste.php">Teste</a></li>
      <li><a href="despre.php">Despre</a></li>
      <li><a href="index.php">Acasa</a></li>
    </ul>
  <div class="imag">
    <img alt="" class="imaginetop" src="images/kids.png"><br>
    <div>
      <div style="background-color: #FFF !important">
        <div class="teste">
          <?php
          if(isset($_SESSION['utilizator'])){
            if($_SESSION['utilizator']['tip'] == 'admin') {
          ?>
          <form action='AddTest.php' class="AddTestForm" method='post' enctype="multipart/form-data">
            <fieldset>
            <legend><h2>Adaugare test</h2></legend>
              <a href="teste.php"><h3>Adauga un nou test</h3></a>
              <table class="AddTestTable">
              <tr>
              </tr>
              <tr><td><input type="hidden" value="<?php echo isset($_GET['TestID']) ? $_GET['TestID'] : ''; ?>" name="TestID"></td></tr>
                <tr>
                  <td><label>Nume test</label></td>
                  <td><input value="<?php echo isset($row2['nume']) ? $row2['nume'] : '' ?>" name="nume_test" type="text"></td>
                </tr>
                <tr>
                  <td><label>Dificultate</label></td>
                  <td>
                   <select name="dificultate">
                  <?php
                  while($row = mysqli_fetch_assoc($result)){

                  ?>
                 
                    <option <?php if( isset($row2['dificultate_id']) && $row2['dificultate_id'] == $row['id']) echo 'selected="selected"' ?> value='<?php echo $row['id']; ?>'>
                      <?php echo $row['dificultate']; ?>
                    </option>
                   <?php } ?> 
                  </select></td>
                </tr>
                <tr>
                  <td><label>Categorie</label></td>
                  <td><select name="categorie">
                   <option <?php if( isset($row2['categorie']) && $row2['categorie'] == 'matematica') echo 'selected="selected"' ?> value="matematica">Matematica</option> 
                   <option <?php if( isset($row2['categorie']) && $row2['categorie'] == 'literatura') echo 'selected="selected"' ?> value="literatura">Literatura</option> 
                   <option <?php if( isset($row2['categorie']) && $row2['categorie'] == 'muzica') echo 'selected="selected"' ?> value="muzica">Muzica</option> 
                   <option <?php if( isset($row2['categorie']) && $row2['categorie'] == 'geografie') echo 'selected="selected"' ?> value="geografie">Geografie</option> </select></td>
                </tr>
               
              </table>
              <hr>
              <?php if(isset($questions_count) && intval($questions_count['questions_count']) < 10){ ?>
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
              <?php }else{ ?>
                <h3>Ai adaugat deja 10 intrebari pentru acest test</h3>
              <?php } ?>
              <hr>
              <button type="submit">Salveaza</button>
            </fieldset>
          </form>
          <?php } else if($_SESSION['utilizator']['tip'] == 'parinte'){ ?>
          <form class="AddChildForm" action="AddChild.php" method="post">
            <fieldset>
              <legend><h2>Adaugare copil</h2></legend>
              <table class="AddChildTable">
              <tr>
                <td>Nume copil</td>
                <td><input type="text" name="nume_copil"></td>
              </tr>
              <tr>
                <td>Prenume copil</td>
                <td><input type="text" name="prenume_copil"></td>
              </tr>
              <tr>
                <td>Email copil</td>
                <td><input type="text" name="email_copil"></td>
              </tr>
              <tr>
                <td>Parola</td>
                <td><input type="password" name="parola"></td>
              </tr>
              <tr>
                <td>Dificultate Copil</td>
                <td><select name="dificultate">
                  <?php
                  while($row = mysqli_fetch_assoc($result)){

                  ?>
                 
                    <option <?php if( isset($row2['dificultate_id']) && $row2['dificultate_id'] == $row['id']) echo 'selected="selected"' ?> value='<?php echo $row['id']; ?>'>
                      <?php echo $row['dificultate']; ?>
                    </option>
                   <?php } ?>
                </select></td>
              </tr>
              <tr>
                <td>Teste Admisibile</td>
                <td><select multiple name="teste_admise[]">
                  <?php
                  while($row = mysqli_fetch_assoc($result4)){
                  ?>
                    <option value='<?php echo $row['id']; ?>'>
                      <?php echo $row['nume']; ?>
                    </option>
                   <?php } ?>
                </select></td>
              </tr>
              </table>
              <hr>
              <button type="submit">Salveaza</button>
            </fieldset>
          </form>
          <?php }
          } else {
            if(!isset($_SESSION['copil'])){
          ?>
            <form method="post" action="LoginChild.php" class="LoginChildForm">
              <fieldset>
                <legend><h2>Logare copil</h2></legend>
                <table class="LoginChildTable">
                  <tr>
                    <td>Email copil</td>
                    <td><input type="text" name="email_copil"></td>
                  </tr>
                  <tr>
                    <td>Parola</td>
                    <td><input type="password" name="parola"></td>
                  </tr>
                </table>
                <hr>
                <button type="submit">Logare</button>
              </fieldset>
            </form>
          <?php }else{
            $query = sprintf("SELECT * FROM teste WHERE id IN (%s)", $_SESSION['copil']['teste_admisibile']);

            $result = mysqli_query($link, $query);

            while($row = mysqli_fetch_assoc($result)){ ?>
              <a href="test.php?id=<?php echo $row['id']?>"><?php echo $row['nume']?></a><br/>
          <?php }
            }
          }?>
        </div>
        <div class="footer">
          <p>Copyright &copy; 2017 - Just for Kids --- Cozma Laurentiu</p>
        </div>
      </div>
    </div>
  </div>
</body>
</html>