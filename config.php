<?php
/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'user_thuexe');
define('DB_PASSWORD', '123456');
define('DB_NAME', 'quanlythuexe');
 
/* Attempt to connect to MySQL database */
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}



// Upload configs.
define('UPLOAD_DIR', 'uploads');
define('UPLOAD_MAX_FILE_SIZE', 10485760); // 10MB.
//@changed_2018-02-17_14.28
define('UPLOAD_ALLOWED_MIME_TYPES', 'image/jpeg,image/png,image/gif');
?>