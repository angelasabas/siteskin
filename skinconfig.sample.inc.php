<?php
/******************************************************************************
 Set this variable to the directory your skin directories will reside.
 The contents of this directory is also directories, and these
 contain the different files for your skins.
******************************************************************************/
$skins_dir = 'skins/';

/******************************************************************************
 Set this variable to a cookie name of your choice, for visitors to
 not keep changing skins when they visit your site.
******************************************************************************/
$cookie_name = 'mysite_skin';

/******************************************************************************
 This variable is optional.
 If you do not want to use GIF as your skin thumbnail images.
 Set this to the image extention you want to use, i.e: JPG, PNG
******************************************************************************/
$thumb_extension = 'gif';

/******************************************************************************
 If your site uses folders, you must set $skins_dir to an absolute path
 (i.e., /home/username/public_html/skins/) and set this variable to
 a web address such as 'http://yourdomain.com/skins/' (don't forget the
 quotes). Otherwise, ignore this variable.
******************************************************************************/
$web_skins_dir = $skins_dir;

/******************************************************************************
 OPTIONAL
 If you would like a default skin to be chosen, first load your skins.php
 page or the page where you skin thumbnails can be shown, and take note of
 the number of the skin you wish to use as your default skin (it is the number
 after "?skin=" in the URL when you hover over a thumbnail). Remove the
 two slashes before the line below ("//") and change "x" to the number
 assigned to your skin.
******************************************************************************/
//$default_skin = 1;


/******************************************************************************
 OPTIONAL
 If you want errors to be shown, set the variable below to true, with no
 quotes. Otherwise, make sure it is set to false (with no quotes).
******************************************************************************/
$debug = false;
?>