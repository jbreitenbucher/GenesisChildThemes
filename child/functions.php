<?php
/** Start the engine **/
require_once(TEMPLATEPATH.'/lib/init.php');

/** Add support for custom background **/
if (function_exists('add_custom_background')) {
	add_custom_background();
}