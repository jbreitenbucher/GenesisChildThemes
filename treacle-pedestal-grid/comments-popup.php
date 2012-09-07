<?php 
/* Don't remove these lines. */
add_filter('comment_text', 'popuplinks');
foreach ($posts as $post) { start_wp();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
     <title><?php echo sprintf(__("Comments on %s"), the_title('','',false)); ?></title>

	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
	<style type="text/css" media="screen">
		@import url( <?php bloginfo('stylesheet_url'); ?> );
		body { margin: 3px; }
	</style>

</head>
<body id="commentspopup" style="text-align:left">

<h2 id="comments"><?php _e("comments"); ?></h2>

<p><a href="<?php bloginfo('url'); ?>/wp-commentsrss2.php?p=<?php echo $post->ID; ?>"><?php _e("<abbr title=\"Really Simple Syndication\">RSS</abbr> feed for comments on this post."); ?></a></p>

<?php if ('open' == $post->ping_status) { ?>
<p><?php _e("The <acronym title=\"Uniform Resource Identifier\">URI</acronym> to TrackBack this entry is:"); ?> <em><?php trackback_url() ?></em></p>
<?php } ?>

<?php
// this line is WordPress' motor, do not delete it.
$comment_author = (isset($_COOKIE['comment_author_' . COOKIEHASH])) ? trim($_COOKIE['comment_author_'. COOKIEHASH]) : '';
$comment_author_email = (isset($_COOKIE['comment_author_email_'. COOKIEHASH])) ? trim($_COOKIE['comment_author_email_'. COOKIEHASH]) : '';
$comment_author_url = (isset($_COOKIE['comment_author_url_'. COOKIEHASH])) ? trim($_COOKIE['comment_author_url_'. COOKIEHASH]) : '';
$comments = $wpdb->get_results("SELECT * FROM $wpdb->comments WHERE comment_post_ID = $id AND comment_approved = '1' ORDER BY comment_date");
$commentstatus = $wpdb->get_row("SELECT comment_status, post_password FROM $wpdb->posts WHERE ID = $id");
if (!empty($commentstatus->post_password) && $_COOKIE['wp-postpass_'. COOKIEHASH] != $commentstatus->post_password) {  // and it doesn't match the cookie
	echo(get_the_password_form());
} else { ?>

<?php if ($comments) { ?>
<ul id="commentlist">

<?php foreach ($comments as $comment) : ?>
	<li id="comment-<?php comment_ID() ?>">

	<p><?php _e('At'); ?> <a href="#comment-<?php comment_ID() ?>"><?php comment_time() ?></a> <?php _e('on'); ?> <?php comment_date() ?>,  <?php comment_author_link() ?> <?php comment_type(__('commented'), __('trackbacked'), __('pingbacked')); ?>:</p>
<div class="commenttext">	<?php comment_text() ?></div>
<p><?php edit_comment_link(__("edit?"), ''); ?></p>
	</li>

<?php endforeach; ?>

</ul>
<?php } else { // this is displayed if there are no comments so far ?>
	<p><?php _e(" "); ?></p>
<?php } ?>

<?php if ('open' == $commentstatus->comment_status) { ?>
<h2><?php _e("Have your say"); ?></h2>

<p><?php _e('XHTML allowed: '); ?><?php echo allowed_tags(); ?></p>

<form action="<?php echo get_settings('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">

<p><textarea name="comment" id="comment" cols="60" rows="6" tabindex="1"></textarea></p>

<p>
<label for="author">and you are? <?php if ($req) _e('(name required)'); ?>></label><br/>
<input type="text" name="author" id="author" value="<?php echo $comment_author; ?>" size="60" tabindex="2" />
<input type="hidden" name="comment_post_ID" value="<?php echo $id; ?>" />
<input type="hidden" name="redirect_to" value="<?php echo wp_specialchars($_SERVER["REQUEST_URI"]); ?>" />
</p>

<p>
<label for="email">and your email address is? <?php if ($req) _e("(required: won't be published)"); ?></label><br/>
<input type="text" name="email" id="email" value="<?php echo $comment_author_email; ?>" size="60" tabindex="3" />
</p>

<p>
<label for="url">and where is your site?</label><br/>
<input type="text" name="url" id="url" value="http://<?php echo $comment_author_url; ?>" size="60" tabindex="4" /></p>

<p><input name="submit" type="submit" id="submit" tabindex="5" title="speak!" value="" />
<input type="hidden" name="comment_post_ID" value="<?php echo $id; ?>" />
</p>
<div class="clear"><br/></div>

<?php do_action('comment_form', $post->ID); ?>
</form>
<?php } else { // comments are closed ?>
<p><?php _e("Sorry, the comment form is closed at this time."); ?></p>
<?php }
} // end password check
?>

<div><strong><a href="javascript:window.close()"><?php _e("Close this window."); ?></a></strong></div>

<?php // if you delete this the sky will fall on your head
}
?>

<!-- // this is just the end of the motor - don't touch that line either :) -->
<?php //} ?> 
<?php // Seen at http://www.mijnkopthee.nl/log2/archive/2003/05/28/esc(18) ?>
<script type="text/javascript">
<!--
document.onkeypress = function esc(e) {	
	if(typeof(e) == "undefined") { e=event; }
	if (e.keyCode == 27) { self.close(); }
}
// -->
</script>
</body>
</html>
