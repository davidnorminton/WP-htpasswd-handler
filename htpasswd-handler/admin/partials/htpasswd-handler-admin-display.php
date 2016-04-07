<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://davenorm.me
 * @since      1.0.0
 *
 * @package    Htpasswd_Handler
 * @subpackage Htpasswd_Handler/admin/partials
 */


?>

<h1><?php echo esc_html(get_admin_page_title()); ?></h1>
<hr />
  <ul>
    <li class="active" id="add_users">Add a user</li>
    <li class="tabs" id="delete_user">Delete a user</li>
    <li class="tabs" id="change_password">Change password</li>
  </ul>
<div id="wrap">  
<div id="tab1">  
  <h2>Add a new user</h2>
  <form method="POST" id="useradd" action="">
    <input type="hidden" name="adduser" value="add" />
    <label class="label">
      <span>
        <?php esc_attr_e("Username"); ?>
      </span>
    </label>
    <input class="input_field" type="text" name="username" placeholder="username" required />
    <label class="label">
      <span>
        <?php esc_attr_e('Password', $this->plugin_name); ?>
      </span>
    </label>
    <input  class="input_field" type="text" name="password" placeholder="Password" required />
    <?php submit_button('Add User', 'primary','submit', TRUE); ?>
  </form>
</div>

<div id="tab2">
  <h2>Delete a user</h2>
  <form method="POST" action="">
    <input type="hidden" name="deleteuser" value="delete" />
    <label class="label">
      <span>
        <?php esc_attr_e("Username"); ?>
      </span>
    </label>
    <input class="input_field" type="text" name="username" placeholder="username" required />
    <?php submit_button('Delete User', 'primary','submit', TRUE); ?>
  </form>      
</div>

<div id="tab4">  
  <h2>Change Password</h2>
  <form method="POST"  action="">
    <input type="hidden" name="changePass" value="changePass" />
    <label class="label">
      <span>
        <?php esc_attr_e("Username"); ?>
      </span>
    </label>
    <input class="input_field" type="text" name="username" placeholder="username" required />
    <label class="label">
      <span>
        <?php esc_attr_e('Password', $this->plugin_name); ?>
      </span>
    </label>
    <input  class="input_field" type="text" name="password" placeholder="New Password" required />
    <?php submit_button('Change Password', 'primary','submit', TRUE); ?>
  </form>
</div>
</div>
<?php include_once( ABSPATH . 'wp-content/plugins/htpasswd-handler/htpasswd_functions.php');
