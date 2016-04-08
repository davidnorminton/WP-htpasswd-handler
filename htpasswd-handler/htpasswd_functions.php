<?php 
// path to htpasswd file
define( 'HTPASSWD_PATH' ,get_home_path(). '/wp-content/.htpasswd');

// ! check file exists if not create
if (! file_exists(HTPASSWD_PATH))
    $handle = fopen(HTPASSWD_PATH, 'w') or die('Cannot open file:  '.HTPASSWD_PATH); //implicitly creates file


// check is writable
if (! is_writable(HTPASSWD_PATH)) 
    @chmod(HTPASSWD_PATH, 0644);

// alter_htpasswd_class.php
include_once('alter_htpasswd_class.php');
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
   $addUser = new alterHtpasswd(HTPASSWD_PATH);
   echo $addUser->addUser($_POST['username'], $_POST['password']);    
}

/**
 * handle deleting a user
 */
if ($_POST['deleteuser']){

   if (empty($_POST['username']))
      die(errorMsg("Username can't be empty"));
    
   $delete = new alterHtpasswd(HTPASSWD_PATH);
   echo $delete->deleteUser($_POST['username']);   
}



/**
 * change a users password
 */
if ($_POST['changePass']){

   if (empty($_POST['username']))
      die(errorMsg("Username can't be empty"));
 
   if (empty($_POST['password']))
      die(errorMsg("Password field can't be empty!"));
 
   $change = new alterHtpasswd(HTPASSWD_PATH);
   echo $change->changePassword($_POST['username'], $_POST['password']);
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
