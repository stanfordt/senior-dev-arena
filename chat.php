<?php

	session_start();

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
			<h2>Under construction</h2>
			<!-- It is probably in our best interest to find some sort of chat plugin that we can just host on the server locally and pull the usernames from the DB automatically -->
		</div>
    </div>
</body>
</html>