<?php    
/**
 * add a user to htpasswd file
 */
// build string to be stored in htpasswd file
$new_user = $_POST['username'] . ':' . encryptPassword($_POST['password']). "\n";
    
if (file_put_contents(HTPASSWD_PATH, $new_user, FILE_APPEND))
    echo '<div class="output"><span class="added">' . $_POST['username'] . '</span> has been added to your .htpasswd file</div>'; 
