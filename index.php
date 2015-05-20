<?php

//Configuration for our PHP Server
set_time_limit(0);
ini_set('default_socket_timeout', 300);

session_start();

//Make Constant using define.
define('clientID', '871b92afb12e4290b6162a24bceeb547');
define('clientSecret', '3a0169d5e8b94ba799bdb8933c97c4e7');
define('redirectURI', 'http://localhost/AppAcademyApi/index.php');
define('ImageDirectory', 'pics/');

//***************************************************************************


//Function that is going to connect to Instagram.

function connectToInstagram($url)
{
	$ch = curl_init();

	curl_setopt_array($ch, array(
		CURLOPT_URL => $url,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_SSL_VERIFYPEER => false,
		CURLOPT_SSL_VERIFYHOST => 2

		));

	$result  = curl_exec($ch);
	curl_close($ch);
	return $result;
}

//Function to get userID because userName doesn't allow to get pictures.
function getUserID($userName){
	$url = 'https://api.instagram.com/v1/users/search?q='.$userName.'&client_id=' .clientID;
	$instagramInfo = connectToInstagram($url);
	$results = json_decode($instagramInfo, true);

	return $results['data'][0]['id'];

}

//Function to print out images onto screen
function printImages($userID)
{
	$url = 'https://api.instagram.com/v1/users/' . $userID . '/media/recent?client_id='.clientID . '&count=5';
	$instagramInfo = connectToInstagram($url);
	$results = json_decode($instagramInfo, true);
	require_once(__DIR__ . "/headerfooter/header.php");
	//Parse through thet information one by one
	foreach($results['data'] as $items)
	 {
	 	$image_url = $items['images']['low_resolution']['url']; //go through all of the results and give back the url of those pictures because we want to save it in the php server.
	 	echo '<img src=" '. $image_url .' "/><br/>';
	 	/*calling a function to save that image_url*/
	 	savePictures($image_url);
	 }
	 require_once(__DIR__ . "/headerfooter/footer.php");
}
/*function to save image to server*/
function savePictures($image_url){
	echo '<head>
	<link rel="stylesheet" href="css/pics.css">
	</head>';
	echo '<body id="body-class">';
	return '<div id="image">' .$image_url. '<br></div>'; 
	$filename = basename($image_url);
	echo $filename . '<br>';

	$destination = ImageDirectory . $filename;
	file_put_contents($destination, file_get_contents($image_url));
}


//**************************************************************************


if (isset($_GET['code'])) {
	$code = $_GET['code'];
	$url = 'https://api.instagram.com/oauth/access_token';
	$access_token_settings =  array('client_id' => clientID,
								   'client_secret' => clientSecret,
								   'grant_type' => 'authorization_code',
								   'redirect_uri' => redirectURI,
								   'code' => $code);

								  
//Curl is a library that lets you make HTTP requests($_GET[] or $_POST[]) in PHP.
$curl = curl_init($url);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $access_token_settings);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

$result = curl_exec($curl);
curl_close($curl);

$results = json_decode($result, true);
$userName = $results['user']['username'];

$userID = getUserID($userName);

printImages($userID);


}
else{


?>

<!DOCTYPE html>
<html>
<head>
	<title>App Academy Api</title>
	<link rel="stylesheet" type="text/css" href="css/index.css"> 
	<link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.6.0/pure-min.css">
</head>
<body>
    <center><div class="box"><br><br><br><br>Welcome to my Instagram Api<br><br><a href="https://api.instagram.com/oauth/authorize/?client_id=<?php echo clientID; ?>&redirect_uri=<?php echo redirectURI; ?>&response_type=code"><button class="button-secondary pure-button"><center>LOGIN</center></button></a></div></center>
	

	
</body>
</html>
<?php

}
?>
