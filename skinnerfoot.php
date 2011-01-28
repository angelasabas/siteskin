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

// find out if the header file is there
// php first, then html, then none
if( is_file( $skins_dir . $skin_array[$skin] . '/footer.php' ) ) {
   require_once( $skins_dir . $skin_array[$skin] . '/footer.php' );

} elseif( is_file( $skins_dir . $skin_array[$skin] . '/footer.html' ) ) {
   require_once( $skins_dir . $skin_array[$skin] . '/footer.html' );

} elseif( is_file( $skins_dir . $skin_array[$skin] . '/footer.htm' ) ) {
   require_once( $skins_dir . $skin_array[$skin] . '/footer.htm' );

} else {
  ss_show_warning( 'WARNING: No footer file found. Check your skin directory setting and contents.' );
}
?>