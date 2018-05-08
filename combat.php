<?php

	session_start();
	
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "arenaDB";
			
	$conn = new mysqli($servername, $username, $password, $dbname);
	
	$sql = "SELECT ClassName, MaxHealth, AttackSpeed FROM Characters WHERE CharacterID = '" . $_SESSION["CharacterID"] . "'";
	$result = $conn->query($sql);
	$record = $result->fetch_assoc();
	
	$playername = $record["ClassName"];
	$playerhealth = $record["MaxHealth"];
	$playerspeed = $record["AttackSpeed"];

    $sql = "SELECT ClassName, MaxHealth, AttackSpeed FROM Characters WHERE CharacterID = '" . $_GET["enemyid"] . "'";
	$result = $conn->query($sql);
	$record = $result->fetch_assoc();
	
	$enemyname = $record["ClassName"];
	$enemyhealth = $record["MaxHealth"];
	$enemyspeed = $record["AttackSpeed"];
	
?>

<html>

<head>
	<meta charset="UTF-8">
	<title>Arena Fight Sim</title>
	<link rel = "stylesheet" type = "text/css" href = "styles.css" />
</head>

<body>
	<div class="fight">
		<h1><?php echo $playername ?> vs. <?php echo $enemyname ?></h1>
		<h2>Fight!</h2>
		<?php
		
		while(($playerhealth > 0) && ($enemyhealth > 0)){
		    $dieroll = rand(1, ($playerspeed + $enemyspeed));
		    $damage = rand(1, 3);
		    
		    if($dieroll <= $playerspeed){
		        echo $playername." swings at ".$enemyname." for ".$damage." damage!<br>";
		        $enemyhealth -= $damage;
		    }
		    else{
		        echo $enemyname." swings at ".$playername." for ".$damage." damage!<br>";
		        $playerhealth -= $damage;
		    }
		}
		
		if($playerhealth <= 0){
		    echo "<h3>".$playername." is knocked out! ".$enemyname." wins!</h3>";
		}
		else{
		    echo "<h3>".$enemyname." is knocked out! ".$playername." wins!</h3>";
		}
		
		?>
	</div>
</body>
</html>