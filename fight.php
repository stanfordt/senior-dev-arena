<?php

	session_start();
	
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "arenaDB";
			
	$conn = new mysqli($servername, $username, $password, $dbname);
	
	$sql = "SELECT CharacterID, ClassName FROM Characters";
	$result = $conn->query($sql);
?>

<html>

<head>
	<meta charset="UTF-8">
	<title>Chat</title>
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
			<h3>Fight</h3>
			Choose your opponent.<br>
			<table>
				<tr>
					<th>
						ID
					</th>
					<th>
						Character Name
					</th>
					<th>
						Fight
					</th>
				</tr>
				<?php
					echo
					"
					
					";
					
					while($record = $result->fetch_assoc()){
						echo
						"<tr>".
							"<td>".
								$record["CharacterID"].
							"</td>".
							"<td>".
								$record["ClassName"].
							"</td>".
							"<td>".
								"<a class=\"navlinks\" target=\"_blank\" href=\"combat.php?enemyid=".
								$record["CharacterID"].
								"\">Fight</a>".
							"</td>".
						"</tr>";
					}
				?>
			</table>
		</div>
    </div>
</body>
</html>