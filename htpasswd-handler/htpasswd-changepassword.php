<?php
/**
 * change a password in htpasswd file
 */
//@var array $users - store htpasswd lines in array
$users = [];
   
//@var resource $f - open htpasswd for reading
$f = fopen(HTPASSWD_PATH, 'r');

// store each line in htpasswd as array element
if ($f) {
    while (($line = fgets($f)) !== false) {
        $users[] = $line;
    }

    fclose($f);

} else {
    // error opening the file.
    errorMsg('Problem opening file');
} 
    
$users_len = count($users);
// if email found store in $found for success message
$found = NULL;

$f = fopen(HTPASSWD_PATH, 'w');

for ($i=0; $i<$users_len;$i++) {
    list($email, $password) = explode(':', $users[$i]);
    if (trim($email) == $_POST['username']) {
        fwrite($f, $_POST['username'] . ':' . encryptPassword($_POST['password']) . "\n");
        // user found so store in $found for success msg
        $found = $_POST['username'];
     } else {
        fwrite($f, $users[$i]);
     }      
} 
fclose($f);
// all is good user was found and password has been changed
if ($found != NULL) {
    echo '<div class="output">Password has been succussefully changed for <span class="added">' . $found . '</span></div>';

} else {
    // oops user has already been removed, prehaps we should create user
    errorMsg("User not found");
}  
