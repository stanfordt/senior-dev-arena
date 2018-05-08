<?php
	//The following is a kludged login script.
	$invalid = False;
	$message = "Enter your credentials below.";
	$enteredname = ""; //For retaining username in field after postback.
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$enteredname = $_POST["username"];
		
		if (empty($_POST["username"])) {
		    $invalid = True;
		} else {
	    	$servername = "localhost";
			$username = "root";
			$password = "";
			$dbname = "arenaDB";
			
			$conn = new mysqli($servername, $username, $password, $dbname);
			
			$sql = "SELECT PlayerID, Credentials, UserLevel, CharacterID FROM Players WHERE Username = '" . $_POST["username"] . "'";
			$result = $conn->query($sql);
			
			
			//We should only get one result back, or somethin has gone wrong.
			if ($result->num_rows == 1) {
			    $record = $result->fetch_assoc();
			    
			    if($record["Credentials"] == $_POST["password"]){
			    	//Prepare a session for the authenticated user
			    	session_start();
			    	
			    	$_SESSION["PlayerID"] = $record["PlayerID"];
			    	$_SESSION["Username"] = $_POST["username"];
			    	$_SESSION["UserLevel"] = $record["UserLevel"];
			    	$_SESSION["CharacterID"] = $record["CharacterID"];
			    	
			    	//Takes user to character page.
			    	header("Location: welcome.php");
					die();
			    }
			    else {
			    	$invalid = True;
			    }
			    
			} else {
			    $invalid = True;
			}
			$conn->close();
		}
	}
	
	if ($invalid){
		$message = "Invalid credentials. Please try again.";
	}
?>


<html>

<head>
	<meta charset="UTF-8">
	<title>Arena Login</title>
	<link rel = "stylesheet" type = "text/css" href = "styles.css" />
</head>

<body>

	<div class="banner">

			<img style="width:300; height:80; max-width: auto; margin-top: 20px; margin-left: 40px;" src="resources/logo.png" alt="Arena logo" >
		<div class="banner2">
			<a class="bannerlinks" href="register.php" title="Register Now!">Register</a>
			|
			<a class="bannerlinks" href="" title="Log In">Log In</a>

		</div>

	</div>
	<div class="container">
		<div class="navbar">
			<table id="navtable">
				<tr>
					<td>
						<a class="navlinks" href="index.php" title="Home">Home</a>
					</td>
				</tr>
				<tr>
					<td>
						<a class="navlinks" href="about.php" title="About Arena">About</a>
					</td>
				</tr>
			</table>
		</div>
		<div class="content">
			<h3>User Login</h3>
			<?php echo $message;?>
			<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
				<table>
				<tr>
				<th>Username:</th> 
				<th><input type="text" name="username" value = <?php echo $enteredname ?> ></th>
				</tr>
				<br>
				<tr>
				<th>Password:&nbsp;</th>
				<th><input type="password" name="password"></th>
				</tr>
				<br>
				<tr>
				<th><input type="submit" name="submit" value="Submit"></th>
				</tr>
				</table>
			</form>
			
		</div>
    </div>
</body>
</html>