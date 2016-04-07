<?php 
// path to htpasswd file
define( 'HTPASSWD_PATH' ,get_home_path(). '/wp-content/.htpasswd');

// ! check file exists if not create
if (! file_exists(HTPASSWD_PATH))
    $handle = fopen(HTPASSWD_PATH, 'w') or die('Cannot open file:  '.HTPASSWD_PATH); //implicitly creates file


// check is writable
if (! is_writable(HTPASSWD_PATH)) 
    @chmod(HTPASSWD_PATH, 0644);

/**
 * add a user to htpasswd file
 */
if ($_POST['adduser']) {

    if (empty($_POST['username'])) {
        die( errorMsg("Username must be supplied") );   
    }
     
    if (empty($_POST['password'])) {
        die( errorMsg("Password field can't be empty!") );
    }
   include_once('htpasswd-adduser.php');     
}

/**
 * handle deleting a user
 */
if ($_POST['deleteuser']){

   if (empty($_POST['username']))
      die(errorMsg("Username can't be empty"));
    
   include_once('htpasswd-deleteuser.php');   
}



/**
 * change a users password
 */
if ($_POST['changePass']){

   if (empty($_POST['username']))
      die(errorMsg("Username can't be empty"));
 
   if (empty($_POST['password']))
      die(errorMsg("Password field can't be empty!"));
 
   include_once('htpasswd-changepassword.php');
}


/**
 * Display error messages
 * @param string $msg - This will be the displayed message to admin
 */
function errorMsg($msg) {
    echo '<div class="outputerror">'.$msg.'</div>';
}

/**
 * Encrypt password
 * $encrypted_password = crypt($password, base64_encode($password));
 */
function encryptPassword($password) {
   return crypt($password, base64_encode($password));
} 
