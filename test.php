<?php

session_start();

$link = mysqli_connect('localhost', 'root', '', 'proiect-tw');
if (!$link) {
    die('Eșec la conectare: ' . mysqli_error($link));
}

if(!isset($_SESSION['copil']) || !isset($_GET['id'])){
	header('Location: index.php');
	exit;
}

$test_id = $_GET['id'];

$query = sprintf("SELECT * FROM intrebari WHERE test_id = '%s'", mysqli_real_escape_string($link,$test_id));

$result = mysqli_query($link, $query);

// evaluate answers

if(isset($_POST['evaluate'])){
	$report = [];
	if(empty($_POST['raspuns'])){
		$_POST['raspuns'] = [];
	}
	$correct_answers = 0;
	$query = sprintf("SELECT count(*) total_questions FROM intrebari WHERE test_id = '%s'", mysqli_real_escape_string($link,$test_id));

	$result2 = mysqli_query($link, $query);
	$total_questions = mysqli_fetch_assoc($result2)['total_questions'];

	foreach($_POST['raspuns'] as $key => $value){
		$question_id = explode('_', $key)[1];
		$child_answer = $value[0];

		$query = sprintf("SELECT * FROM intrebari WHERE id=%s", mysqli_real_escape_string($link,$question_id));

		$result3 = mysqli_query($link, $query);
		$row = mysqli_fetch_assoc($result3);

		if($row['raspuns_corect'] == 'raspuns' . intval($child_answer)){
			$correct_answers++;
		}

		$report['answers'][] = [
			'question' => $row['intrebare'],
			'child_answer' => $row['raspuns' . intval($child_answer[0])],
			'correct_answer' => $row[$row['raspuns_corect']]
		];
	}

	$report['correct_answers'] = $correct_answers . '/' . $total_questions;

	$query = sprintf("INSERT INTO rezultate(copil_id, test_id, rezultat) VALUES (%s, %s, %s)",
		mysqli_real_escape_string($link, $_SESSION['copil']['id']),
		mysqli_real_escape_string($link, $test_id),
		mysqli_real_escape_string($link, $correct_answers)
	);

	mysqli_query($link, $query);
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Just for Kids</title>
	<meta content="width=device-width, initial-scale=1.0" name="viewport">
	<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
	<link rel="stylesheet" type="text/css" href="style.css"/>
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
      <li><a class="active" href="test.php">Teste</a></li>
      <li><a href="despre.php">Despre</a></li>
      <li><a href="index.php">Acasa</a></li>
    </ul>
    <div class="imag">
    	<img alt="" class="imaginetop" src="images/kids.png"><br>
    	<div>
    		<div style="background-color: #FFF !important">
        		<div class="teste">
        			<br/>
					<form method="post">
						<table class="TestTable">
							<tr>
								<th>#</th>
								<th>Intrebare</th>
								<th>Raspuns1</th>
								<th>Raspuns2</th>
								<th>Raspuns3</th>
								<th>Raspuns4</th>
							</tr>
							<?php
								$i = 0;
								while($row = mysqli_fetch_assoc($result)) { ?>
							<tr>
								<td><?php echo $i++; ?></td>
								<td>
									<?php echo $row['intrebare']; ?>
									<?php if(!empty($row['imagine'])) {?>
									<br/>
									<img src="images/<?php echo $row['imagine']; ?>" class="QuestionImage">
									<?php } ?>
								</td>
								<td>
									<input type="radio" name="raspuns[intrebare_<?php echo $row['id']?>][]" value="1"/>
									<?php echo $row['raspuns1']; ?>
								</td>
								<td>
									<input type="radio" name="raspuns[intrebare_<?php echo $row['id']?>][]" value="2"/>
									<?php echo $row['raspuns2']; ?>
								</td>
								<td>
									<input type="radio" name="raspuns[intrebare_<?php echo $row['id']?>][]" value="3"/>
									<?php echo $row['raspuns3']; ?>
								</td>
								<td>
									<input type="radio" name="raspuns[intrebare_<?php echo $row['id']?>][]" value="4"/>
									<?php echo $row['raspuns4']; ?>
								</td>
							</tr>
							<?php } ?>
						</table>
						<br/>
						<br/>
						<input name="evaluate" type="submit" value="Evalueaza">
						<br/>
						<br/>
						<br/>
					</form>
					<?php if(isset($report)){ ?>
							<h2>Raspunsuri corecte: <?php echo $report['correct_answers']?></h2>
							<h3>Raport:</h3>
							<table class="TestTable">
								<tr>
									<th>Intrebare</th>
									<th>Raspunsul Tau</th>
									<th>Raspunsul Corect</th>
								</tr>
							<?php
								if (empty($report['answers'])){
									$report['answers'] = [];
								}
								foreach($report['answers'] as $value) { ?>
								<tr>
									<td><?php echo $value['question']; ?></td>
									<td><?php echo $value['child_answer']; ?></td>
									<td><?php echo $value['correct_answer']; ?></td>
								</tr>
							<?php } ?>
							</table>
						<?php
						}
					?>
				</div>
			</div>
		</div>
	</div>
	<br/>
	<br/>
	<br/>
</body>
</html>