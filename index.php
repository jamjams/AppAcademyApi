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
/*checks for a booliean, if it is true or not true*/
if (isset($_GET['code'])){
	$code = ($_GET['code']);
	$url = 'https://api.instagram.com/oauth/access_token';
	$access_token_settings = array('client_id' => clientID,
		'client_secret' => clientSecret,
		'grant_type' => 'authorization_code',
		'redirect_uri' => redirectURI,
		'code' => $code
		);
	/*cURL is what we use in PHP, it's a library calls to other api's*/
	$curl = curl_init($url);/*setting a cURL session and we put in $url because thats where we are getting the data from*/
	/*sets an option onvthe given cURLsession handle*/
	curl_setopt($curl, CURLOPT_POST, true);
	curl_setopt($curl, CURLOPT_POSTFIELDS, $access_token_settings);/*setting the POSTFIELDS to the array setup that we created*/
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);/*true to return the transfer as a string of the return value of the curl_exec() instead of outputting it out directly*/
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);/*false to stop the cURL from verifying the peers certificate. But in live work-production we want to set this true*/
}
$result=curl_exec($curl);
curl_close();

?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<!-- Creating a login for people to go and get approval for our web app to access their Instagram account 
	After getting approval we are now going to have the information so we can play with it -->
	<a href="https:api.instagram.com/oauth/authorize/?client_id=<?php echo clientID; ?>&redirect_uri=<?php echo redirectURI ?>&response_type=code">LOGIN</a>

</body>
</html>