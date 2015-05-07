<?php 
/*configuration for our php server*/
set_time_limit(0);
ini_set('default_socket_limit', 300);
session_start();

/*Make constants using define*/
/*we can call the name anywhere else in the file because we gave it a value*/
define('client_id', c73d173254d844b89d8117954f97d9ee);
define('client_secret', c73d173254d844b89d8117954f97d9ee);
define('redirectURI', 'http://localhost/AppAcademyApi/index.php');
define('ImageDirectory', 'pics/');


?>



<!-- CLIENT INFO
CLIENT ID c73d173254d844b89d8117954f97d9ee
CLIENT SECRET 971766cd8c4f4faf7b7a6ff36f32b68b0
WEBSITE URL http://localhost/AppAcademyApi/index.php
REDIRECT URI http://localhost/AppAcademyApi/index.php -->