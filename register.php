<?php
	$message = "Enter your information below.";
	$enteredusername = "";
	$enteredcharname = "";
	$enteredemail = "";
	
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$enteredusername = $_POST["username"];
		$enteredcharname = $_POST["charname"];
		$enteredemail = $_POST["email"];
		
		if (empty($_POST["username"]) || empty($_POST["charname"]) || empty($_POST["email"]) || empty($_POST["password"])) {
		    $message = "All fields are required. Please fill them all out.";
		}
		else{
			$servername = "localhost";
			$username = "root";
			$password = "";
			$dbname = "arenaDB";
			
			$conn = new mysqli($servername, $username, $password, $dbname);
			
			$sql = "SELECT * FROM Players WHERE Username = '" . $_POST["username"] . "'";
			$result = $conn->query($sql);
			
			if($result->num_rows >= 1){
				$message = "That username is taken. Please try another.";
			}
			else{
				$charsql = "INSERT INTO `Characters`(`ClassName`, `MaxHealth`, `AttackSpeed`, `Level`) VALUES ('" . $_POST["charname"] . "', 10, 10, 1)";
				$conn->query($charsql);
				
				$charidsql = "SELECT MAX(CharacterID)  AS CharacterID FROM Characters WHERE ClassName = '" . $_POST["charname"] . "'";
				$idresult = $conn->query($charidsql);
				$idrecord = $idresult->fetch_assoc();
				
				$usersql = "INSERT INTO `Players`(`Username`, `UserLevel`, `Email`, `Credentials`, `CharacterID`) VALUES ('" . $_POST["username"]
					."', 0, '" . $_POST["email"] . "', '" . $_POST["password"] . "'," . $idrecord["CharacterID"] . ")";
				
				if($conn->query($sql) === TRUE ){
					$message = "You're now registered, please log in.";
				}
				else{
					$message = "Something has gone wrong, please contact an administrator.";
				}
			}
		}
	}
?>


<html>

<head>
	<meta charset="UTF-8">
	<title>Register Now!</title>
	<link rel = "stylesheet" type = "text/css" href = "styles.css" />
</head>

<body>

	<div class="banner">

			<img style="width:300; height:80; max-width: auto; margin-top: 20px; margin-left: 40px;" src="resources/logo.png" alt="Arena logo" >
		<div class="banner2">
			<a class="bannerlinks" href="register.php" title="Register Now!">Register</a>
			|
			<a class="bannerlinks" href="login.php" title="Log In">Log In</a>

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
			<h3>User Registration</h3>
			<?php echo $message;?>
			
			<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
				<table>
				<tr>
				<th>Username:</th>
				<th><input type="text" name="username" value = <?php echo $enteredusername ?> ></th>
				</tr>
				<br>
				<tr>
				<th>Character Name:</th>
				<th><input type="text" name="charname" value = <?php echo $enteredcharname ?> ></th>
				</tr>
				<br>
				<tr>
				<th>E-mail:</th> 
				<th><input type="text" name="email" value = <?php echo $enteredemail ?> ></th>
				</tr>
				<br>
				<tr>
				<th>Password:</th>
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