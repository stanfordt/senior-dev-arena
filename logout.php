<?php
    //Clear the session.
    session_unset();
    session_destroy();
    
    //Redirect user to start page.
    header("Location: index.php");
	die();

?>