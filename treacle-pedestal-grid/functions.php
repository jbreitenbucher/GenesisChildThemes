<?php
if ( function_exists('register_sidebar') ) {
register_sidebar(array(
'name' => 'Column One',
'before_widget' => '<li><div id="%1$s" class="%2$s">',
'after_widget' => '</div></li>',
'before_title' => '<h2>',
'after_title' => '</h2>',
));
register_sidebar(array(
'name' => 'Column Two',
'before_widget' => '<li><div id="%1$s" class="%2$s">',
'after_widget' => '</div></li>',
'before_title' => '<h2>',
'after_title' => '</h2>',
)); 
register_sidebar(array(
'name' => 'Sidebar Header',
'before_widget' => '<li><div id="%1$s" class="%2$s">',
'after_widget' => '</div></li>',
'before_title' => '<h2>',
'after_title' => '</h2>',
));
}
?>
<?php
function my_get_blogs_of_user( $id ) {
        global $wpdb, $wpmuBaseTablePrefix;
        
        $user = get_userdata( $id );
        $blogs = array();

        $i = 0;
        foreach ( $user as $key => $value ) {
                if ( strstr( $key, '_capabilities') && strstr( $key, 'wp_') ) {
                        preg_match('/wp_(\d+)_capabilities/', $key, $match);
                        $blog = get_blog_details( $match[1] );
                        if ( $blog && isset( $blog->domain ) ) {
                                $blogs[$match[1]]->userblog_id = $match[1];
                                $blogs[$match[1]]->domain      = $blog->domain;
                                $blogs[$match[1]]->path        = $blog->path;
                                $blogs[$match[1]]->blog_id     = $blog->blog_id;
                        }
                }
        }

        return $blogs;
}

function home_page_login_form() {
global $current_user, $blog_id;
if ( !isset( $_REQUEST['redirect_to'] ) )
                $redirect_to = 'wp-admin/';
        else
                $redirect_to = $_REQUEST['redirect_to'];

if ( ! is_user_logged_in() ) {
?>
<li id="headerlogin">
<form name="loginform" id="loginform" action="wp-login.php" method="post">
<h2>Already a member? Sign in here...</h2>
<div class="left">
<?php _e('Username:') ?><br />
<input type="text" name="log" id="log" value="<?php echo wp_specialchars(stripslashes($user_login), 1); ?>"
size="20" tabindex="1" /><br />
</div>
<div class="right">
<?php _e('Password:') ?><br />
<input type="password" name="pwd" id="pwd" value="" size="20" tabindex="2" /><br />
<input name="rememberme" type="checkbox" id="rememberme" value="forever" tabindex="3" />
  <?php _e('Remember me'); ?><br />
<input type="submit" name="submit" id="submit" value="<?php _e('Login'); ?>" tabindex="4" /><br />
<input type="hidden" name="redirect_to" value="<?php echo wp_specialchars($redirect_to); ?>" />
</div>
</form>
</li> 
<?php  
} else {
$blogs = my_get_blogs_of_user($current_user->ID);
$username = $current_user->user_login;
$siteurl= get_settings('siteurl');
?>
<li id="headerlogin">
<h2>Hi, <?php echo $username; ?>! (<a href="/wp-login.php?action=logout&amp;redirect_to=<?php echo $siteurl; ?>"><?php _e('Logout') ?></a>)</h2>
<p>Here are your blogs:</p>
<ul>
<?php

if ( ! empty($blogs) ) foreach ( $blogs as $blog ) {
        $name = get_blog_option($blog->blog_id, 'blogname');
echo "<li><a href='http://" . $blog->domain . $blog->path . "'>" . $name . "</a> | <a href='http://" . $blog->domain .  "/wp-admin/'>Admin page</a></li>";
}
?>
</ul>  
</li> 
<?php  
} 
}
?>
