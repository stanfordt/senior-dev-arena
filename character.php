<?php

	session_start();
	
	echo ($_SESSION["CharacterID"] == null);
	
	if(($_SESSION["CharacterID"] == null) != 1){
	
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "arenaDB";
			
	$conn = new mysqli($servername, $username, $password, $dbname);
	
	$sql = "SELECT ClassName, MaxHealth, AttackSpeed, Level FROM Characters WHERE CharacterID = " . $_SESSION["CharacterID"];
	$result = $conn->query($sql);
	
	//Shouldn't be an issue if we got this far.
	$record = $result->fetch_assoc();
	}
?>

<html>

<head>
	<meta charset="UTF-8">
	<title>Your Character</title>
	<link rel = "stylesheet" type = "text/css" href = "styles.css" />
</head>

<body>

	<div class="banner">

			<img style="width:300; height:80; max-width: auto; margin-top: 20px; margin-left: 40px;" src="resources/logo.png" alt="Arena logo" >
		<div class="banner2">
			
			<h3>Welcome,</h3>
			<?php echo $_SESSION["Username"]; ?> (<a href="logout.php" title="Logout">Logout</a>)

		</div>

	</div>
	<div class="container">
		<div class="navbar">
			<table id="navtable">
				<tr>
					<td>
						<a class="navlinks" href="character.php" title="My Character">Character</a>
					</td>
				</tr>
				<tr>
					<td>
						<a class="navlinks" href="fight.php" title="Fight Now">Fight</a>
					</td>
				</tr>
				<tr>
					<td>
						<a class="navlinks" href="chat.php" title="Chat">Chat</a>
					</td>
				</tr>
				<?php
					if($_SESSION["UserLevel"] >= 1){
						echo "
						<tr>
							<td>
								<a class=\"navlinks\" href=\"mod.php\" title=\"\">Moderation</a>
							</td>
						</tr>
						";
					}
				?>
			</table>
		</div>
		<div class="content">
			<h3>Character Info</h3>
			<?php
				if(($_SESSION["CharacterID"] == null) != 1){
					echo 
					"<b>Name: </b>" . $record["ClassName"] . "<br> ".
					"<b>Level: </b>" . $record["Level"] . "<br>".
					"<b>Max Health: </b>" . $record["MaxHealth"] . "<br>".
					"<b>Attack Speed: </b>" . $record["AttackSpeed"] . "<br>";
				}
				else{
					echo "You're an administrator!";
				}
			?>
		</div>
    </div>
</body>
</html>