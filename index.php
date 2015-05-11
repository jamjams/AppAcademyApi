<?php 
/*configuration for our php server*/
set_time_limit(0);
ini_set('default_socket_limit', 300);
session_start();

/*Make constants using define*/
/*we can call the name anywhere else in the file because we gave it a value*/
define('clientID', '871b92afb12e4290b6162a24bceeb547');
define('clientSecret', '3a0169d5e8b94ba799bdb8933c97c4e7');
define('redirectURI', 'http://localhost/AppAcademyApi/index.php');
define('ImageDirectory', 'pics/');


?><!-- testing sourcetree -->

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<!-- Creating a login for people to go and get approval for our web app to access their Instagram account 
	After getting approval we are now going to have the information so we can play with it -->
	<a href="https:api.instagram/oauth/authorize/?client_id=<?php echo clientID; ?>&redirect_uri=<?php echo redirectURI ?>&response_type=code">LOGIN</a>

</body>
</html>