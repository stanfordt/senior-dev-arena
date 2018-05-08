<?php

	session_start();

?>

<html>

<head>
	<meta charset="UTF-8">
	<title>Welcome to Arena!</title>
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
						<a class="navlinks" href="fight.php" title="Fight Now" target="_blank" rel="noopener noreferrer">Fight</a>
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
			<h2>Thank you for logging into Arena! Please use the links to your left to navigate through the site.</h2>
			<!-- More than likely we can just put some random spiel about welcome back blah blah use the links to the left to navigate, etc. Maybe even a leaderboard if we get really motivated -->
		</div>
    </div>
</body>
</html>