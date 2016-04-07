<?php
/**
 * delete a user from htpasswd file
 */
 
//@var array $users - store htpasswd lines in array
$users = [];

//@var resource $f - open htpasswd    
$f = fopen(HTPASSWD_PATH, 'r');

if ($f) {
    // one line of htpasswd file per array element
    while (($line = fgets($f)) !== false) {
        $users[] = $line;
    }

    fclose($f);
    
} else {
    // error opening the file.
    errorMsg("Problem opening file");
} 
// length of array
$users_len = count($users);
    
$f = fopen(HTPASSWD_PATH, 'w');
// @var string $found - store email of user if found in file
$found = NULL;

// loop over array of users and find user to remove
for ($i=0; $i<$users_len; $i++) {
    // user password separated by : in htpasswd file
    list($email, $password) = explode(':', $users[$i]);
    
    if (trim($email) == $_POST['username']) {
        $found = $email;
        unset($users[$i]);
    } else {
        // this user is ok so write back to file
        fwrite($f, $users[$i]);
    }       
}     
fclose($f);

if ($found != NULL) {
    echo '<div class="output"><span class="added">' . $found . '</span> has been removed</div>';
} else {
    errorMsg('<span class="added">' . $_POST['username'] . '</span> has already been removed');          
}       
