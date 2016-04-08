<?php
/**
 * Alter htpasswd file details and create new users
 *
 */ 
class alterHtpasswd {

    /**
     * @var string $file - path to htpasswd file
     */
    private $file;
    
    /**
     * @var array $users
     * store users with passwords found in htpasswd file
     */
    private $users = [];      
    
    /**
     * @var int $len_users - length of $users array
     */ 
    private $len_users;
    
    /**
     * method __construct() - set required properties
     * @param string $file - path to htpasswd file
     */     
    public function __construct($file)
    {
        if(empty($file))
           throw new Exception('Path to htpasswd required!');
        $this->file = $file;
    } 
    
    
    /**
     * method addUser - add user and password to htpasswd file
     * @param string $user - user identifier
     * @param string $password - users password
     * @return html string to inform user on success / error
     */
    public function addUser($user, $password)
    {
        if(empty($user))
            throw new Exception('A user name is required!');
        if(empty($password))
            throw new Exception('A password is required!');
        $new_user = $user . ':' . encryptPassword($password). "\n"; 
        if (file_put_contents($this->file, $new_user, FILE_APPEND)) {
            return '<div class="output"><span class="added">'.$user.'</span> has been added to your .htpasswd file</div>';                    
        } else {
            return $this->errorMsg('Problem adding ' . $user);
        }        
    }
    
    /**
     * method deleteUser() - remove a user from htpasswd file
     * @param string $username - user to remove
     * @return html string to inform user on success / error
     */
    public function deleteUser($username)
    {
         // populate the $this->users array with usernames and passwords
         $popUsers = $this->getUsers();
         if($popUsers == -1)
             $this->errorMsg('Problem opening htpasswd file!');
    
         $f = fopen($this->file, 'w');
         // @var string $found - store email of user if found in file
         $found = NULL;

         // loop over array of users and find user to remove
         for ($i=0; $i<$this->len_users; $i++) {
             // user password separated by : in htpasswd file
             list($email, $password) = explode(':', $this->users[$i]);
    
             if (trim($email) == $_POST['username']) {
                 $found = $email;
                 unset($this->users[$i]);
             } else {
                // this user is ok so write back to file
                fwrite($f, $this->users[$i]);
             }       
          }     
          fclose($f);

          if ($found != NULL) {
              return '<div class="output"><span class="added">'.$found.'</span> has been removed</div>';
          } else {
              return $this->errorMsg('<span class="added">'.$username.'</span> has already been removed');          
          }          
    }
    
    /**
     * method changePassword - change a users password
     * @param string $user - username
     * @return string html success or fail
     */
    public function changePassword($user, $new_password)
    {
         // populate the $this->users array with usernames and passwords
         $popUsers = $this->getUsers();
         if($popUsers == -1)
             $this->errorMsg('Problem opening htpasswd file!');

         // if email found store in $found for success message
         $found = NULL;

         $f = fopen($this->file, 'w');

         for ($i=0; $i<$this->len_users;$i++) {
             list($email, $password) = explode(':', $this->users[$i]);
             if (trim($email) == $user) {
                 fwrite($f, $user . ':' . encryptPassword($new_password) . "\n");
                 // user found so store in $found for success msg
                 $found = $user;
             } else {
                 fwrite($f, $this->users[$i]);
             }      
         } 
         fclose($f);
         // all is good user was found and password has been changed
         if ($found != NULL) {
             return '<div class="output">Password has been succussefully changed for <span class="added">'.$found.'</span></div>';

         } else {
             // oops user has already been removed, prehaps we should create user
             return $this->errorMsg("User not found");
         }                  
    }
      
    /**
     * method getUsers - populate the $users array with htpasswd users 
     *
     */ 
    public function getUsers()
    {

        //@var resource $f - open htpasswd    
        $f = fopen($this->file, 'r');

        if ($f) {
             // one line of htpasswd file per array element
            while (($line = fgets($f)) !== false) {
             $this->users[] = $line;
         }

         fclose($f);
    
         } else {
            // error opening the file.
            return -1;
         } 
         // length of array
         $this->len_users = count($this->users);    
    }
    
         
    /**
     * Display error messages
     * @param string $msg - This will be the displayed message to admin
     */
    public function errorMsg($msg) {
        echo '<div class="outputerror">'.$msg.'</div>';
    }

    /**
     * Encrypt password
     * $encrypted_password = crypt($password, base64_encode($password));
     */
    public function encryptPassword($password) {
       return crypt($password, base64_encode($password));
    }     
}
