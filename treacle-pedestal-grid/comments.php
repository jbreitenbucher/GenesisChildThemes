<script type="text/javascript">
  var blogTool               = "WordPress";
  var blogURL                = "<?php echo get_option('siteurl'); ?>";
  var blogTitle              = "<?php bloginfo('name'); ?>";
  var postURL                = "<?php the_permalink() ?>";
  var postTitle              = "<?php the_title(); ?>";
  <?php if ( $user_ID ) : ?>
      var commentAuthor          = "<?php echo $user_identity; ?>";
  <?php else : ?>
      var commentAuthorFieldName = "author";
  <?php endif; ?>
  var commentAuthorLoggedIn  = <?php if ( !$user_ID ) { echo "false"; }
                                     else { echo "true"; } ?>;
  var commentFormID          = "commentform";
  var commentTextFieldName   = "comment";
  var commentButtonName      = "submit";
  var cocomment_force        = false;
</script>
<script type="text/javascript" src="http://www.cocomment.com/js/cocomment.js"></script>
<?php if ( !empty($post->post_password) && $_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password) : ?>
<p><?php _e('Enter your password to view comments.'); ?></p>
<?php return; endif; ?>

<h3 id="comments"><?php if ( comments_open() ) : ?>
<a href="#postcomment" title="<?php _e("Leave a comment"); ?>"><?php comments_number(__('No comments'), __('1 comment'), __('% comments')); ?> 
</a>
<?php endif; ?>
</h3>

<?php if ( $comments ) : ?>
<!--AWP_inlinecomments--><ul id="commentlist">

<?php foreach ($comments as $comment) : ?>
	<li id="comment-<?php comment_ID() ?>">

	<p><?php _e('At'); ?> <a href="#comment-<?php comment_ID() ?>"><?php comment_time() ?></a> <?php _e('on'); ?> <?php comment_date() ?>,  <?php comment_author_link() ?> <?php comment_type(__('commented'), __('trackbacked'), __('pingbacked')); ?>:</p>
<div class="commenttext">	<?php comment_text() ?></div>
<p><?php edit_comment_link(__("edit?"), ''); ?></p>
	</li>

<?php endforeach; ?>

</ul><!--AWP_inlinecomments-->

<?php else : // If there are no comments yet ?>
	<p><?php _e(' '); ?></p>
<?php endif; ?>

<p><?php comments_rss_link(__('<abbr title="Really Simple Syndication">RSS</abbr> feed for comments on this post.')); ?> 
<?php if ( pings_open() ) : ?>
	<a href="<?php trackback_url() ?>" rel="trackback"><?php _e('TrackBack <abbr title="Uniform Resource Identifier">URI</abbr>'); ?></a>
<?php endif; ?>
</p>

<?php if ( comments_open() ) : ?>
<h2 id="postcomment"><?php _e('Have your say'); ?>:</h2>

<?php if ( get_option('comment_registration') && !$user_ID ) : ?>
<p>Sorry, you must be <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php the_permalink(); ?>">logged in</a> to post a comment.</p>
<?php else : ?>

<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
<?php do_action('comment_form', $post->ID); ?>
<p><?php _e('XHTML allowed: '); ?><?php echo allowed_tags(); ?></p>

<p><textarea name="comment" id="comment" cols="60" rows="6" tabindex="1"></textarea></p>
<?php if ( $user_ID ) : ?>

<p>Logged in as <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?action=logout" title="<?php _e('Logout') ?>">Logout &raquo;</a></p>
<?php else : ?>
<p>
<label for="author">and you are? <?php if ($req) _e('(name required)'); ?>></label><br/>
<input type="text" name="author" id="author" value="<?php echo $comment_author; ?>" size="60" tabindex="2" /></p>

<p>
<label for="email">and your email address is? <?php if ($req) _e("(required: won't be published)"); ?></label><br/>
<input type="text" name="email" id="email" value="<?php echo $comment_author_email; ?>" size="60" tabindex="3" />
</p>

<p>
<label for="url">and where is your site?</label><br/>
<input type="text" name="url" id="url" value="http://<?php echo $comment_author_url; ?>" size="60" tabindex="4" /></p>
<?php endif; ?>

<p><input name="submit" type="submit" id="submit" tabindex="5" title="submit comment" value="" />
<input type="hidden" name="comment_post_ID" value="<?php echo $id; ?>" />
</p>
<p><a href="http://www.cocomment.com/" title="coComment website"><img 
src="http://www.cocomment.com/images/cocomment-integrated.gif" 
alt="coComment integrated" /></a></p> <div class="clear"><br/></div>

</form>

<?php endif; // If registration required and not logged in ?>

<?php else : // Comments are closed ?>
<p><?php _e('Sorry, comments are closed'); ?></p>
<?php endif; ?>
