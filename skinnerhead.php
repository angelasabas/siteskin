<?php
/******************************************************************************
 SiteSkin: Easy Site Skinning Script
 Script by Angela Sabas (http://scripts.indisguise.org)

 This program is free software: you can redistribute it and/or modify
 it under the terms of the GNU General Public License as published by
 the Free Software Foundation, either version 3 of the License, or
 any later version.

 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 GNU General Public License for more details.

 You should have received a copy of the GNU General Public License
 along with this program.  If not, see <http://www.gnu.org/licenses/>.

 For more information please view the readme.txt file.
******************************************************************************/
require( 'skinconfig.inc.php' );

// debug or not?
$debug = ( isset( $debug ) ) ? $debug : false;
if( $debug ) {
   ERROR_REPORTING( E_ALL );
} else {
   ERROR_REPORTING( 0 );
}

// function to clean input strings for script
function ss_clean_string( $data ) {
   $data = trim( htmlentities( strip_tags( $data ), ENT_QUOTES ) );
   if( get_magic_quotes_gpc() )
      $data = stripslashes( $data );
   $data = addslashes( $data );
   return $data;
}

function ss_show_warning( $string ) {
   global $debug;
   if( $debug ) {
      echo '<p style="font-weight: bold; color: #990000; font-size: 12px;">' . $string . '</p>';
   }
}

// check skins_dir format
if( substr( $skins_dir, -1 ) != '/' ) {
   // if there is no trailing slash, add it
   $skins_dir = $skins_dir . '/';
}

// read skins folder
$skindir = opendir( $skins_dir );
$skin_array = array();
while( false !== ( $file = readdir( $skindir ) ) ) {
   if( is_dir( $skins_dir . $file ) && $file != '.' && $file != '..' ) {
      $skin_array[] = $file;
   }
}

// find out if this is a first visit
// or verify if their skin cookie is valid
$firstvisit = false;
if( isset( $_GET['skin'] ) && $_GET['skin'] != '' ) {
   // check if the skin still exists, if not, treat it as a first visit
   if( $_GET['skin'] > count( $skin_array ) ) {
      $firstvisit = true;
   } else {
      // change skin
      $skin = ss_clean_string( $_GET['skin'] ) - 1;
      setcookie( $cookie_name, $skin, time()+60*60*24*30 );
   }
} elseif( isset( $_COOKIE[$cookie_name] ) ) {
   // load skin from cookie
   $skin = ss_clean_string( $_COOKIE[$cookie_name] );
   // check if the skin still exists, if not, treat it as a first visit
   if( $skin >= count( $skin_array ) ) {
      $firstvisit = true;
   } else {// refresh cookie
      setcookie( $cookie_name, $skin, time()+60*60*24*30 );
   }
} else {
   $firstvisit = true;
}

// this is the first visit of the visitor
// or the skin they previously set is missing
// or their cookie has expired
// so show him the default skin
if( $firstvisit ) {
   $skin = 0; // initialize
   if( isset( $default_skin ) && $default_skin <= count( $skin_array ) ) {
      $skin = $default_skin - 1;
   } else { // the default skin is invalid or there's nothing set, so get random
      ss_show_warning( 'WARNING: You have no default skin set.' );
      $skin = rand( 0, count( $skin_array ) - 1 );
   }
   setcookie( $cookie_name, $skin, time()+60*60*24*30 );
}

// find out if the header file is there
// php first, then html, then none
if( is_file( $skins_dir . $skin_array[$skin] . '/header.php' ) ) {
   require_once( $skins_dir . $skin_array[$skin] . '/header.php' );

} elseif( is_file( $skins_dir . $skin_array[$skin] . '/header.html' ) ) {
   require_once( $skins_dir . $skin_array[$skin] . '/header.html' );

} elseif( is_file( $skins_dir . $skin_array[$skin] . '/header.htm' ) ) {
   require_once( $skins_dir . $skin_array[$skin] . '/header.htm' );

} else {
  ss_show_warning( 'WARNING: No header file found. Check your skin directory setting and contents.' );
}


function show_skins( $skin, $skin_array, $showcurrent = true ) {
   require( 'skinconfig.inc.php' );

   $ext = 'gif';
   if( isset( $thumb_extension ) )
      $ext = $thumb_extension;

   if( $showcurrent ) {
      echo '<p class="skin">';
      echo 'Current skin:<br />';

      echo '<img src="' . $web_skins_dir . $skin_array[$skin] . '/thumb.' .
         $ext . '" border="0" alt=" current skin" class="skin" />';
      echo '</p>';
      echo '<p class="skin">Select your skin:<br />';
   }

   // set up url
   $pageinfo = pathinfo( $_SERVER['PHP_SELF'] );
   $page = $pageinfo['basename'];
   $connector = '?';
   if( isset( $_GET ) ) {
      foreach( $_GET as $get => $value ) {
         if( $get != 'skin' ) {
            $page .= $connector . $get . '=' . $value;
            $connector = '&amp;';
         }
      }
   }

   $i = 1;
   foreach( $skin_array as $skin_select ) {
      $alt_file = fopen( $skins_dir . $skin_select . '/alt.txt', 'r' );
      $alt_text = fgets( $alt_file );
      fclose( $alt_file );
      echo '<a href="' . $page . $connector . 'skin=' . $i . '">';
      echo '<img src="' . $web_skins_dir . $skin_select . '/thumb.' . $ext .
         '" alt="' . $alt_text . '" title="' . $alt_text . '" class="skin" /></a> ';
      $i++;
   }

   if( $showcurrent )
      echo '</p>';

   // show link -- do not remove
   echo '<p style="text-align: center;">';
   echo '<a href="http://scripts.indisguise.org">';
   echo 'Powered by SiteSkin';
   echo '</a></p>';
}
?>