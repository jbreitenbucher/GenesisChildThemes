<?php

/*
Before you use feedburner subscription, please change
FEEDBURNER_ID in the form below with your real FeedBurner ID
e.g. FEEDBURNER_ID -> 929345

Also you need to change BLOG_TITLE to your own blog title.
*/

?>

<form action="http://www.feedburner.com/fb/a/emailverify" method="post" onsubmit="window.open('http://www.feedburner.com/fb/a/emailverifySubmit?feedId=FEEDBURNER_ID', 'popupwindow', 'scrollbars=yes,width=550,height=520');return true">
<fieldset>
<input type="text" id="rssinput" name="email" />
<input type="submit" id="rssbutton" value="Sign Up" />
<input type="hidden" value="http://feeds.feedburner.com/~e?ffid=FEEDBURNER_ID" name="url"/>
<input type="hidden" value="BLOG_TITLE" name="title"/>
<input type="hidden" name="loc" value="en_US"/>
</fieldset>
</form>