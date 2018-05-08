<?php

	session_start();

	if($_SESSION["UserLevel"] < 1){
		//Redirect user to character page.
		header("Location: character.php");
		die();
	}
?>

<html>

<head>
	<meta charset="UTF-8">
	<title>Administration Panel</title>
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
			<h2>This section still under construction</h2>
			<!-- We will likely have standard site admin tools and DB manipulation utilities to
				 revoke/remove users from DB, or to update inventory items, monsters, etc We will need this nav link to be invisible unless
			     the user holds an admin role and prohibit access directly to mod.php without the proper permissions 
			-->
		</div>
    </div>
</body>
</html>