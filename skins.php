<?php
require_once( 'skinnerhead.php' );
?>



<!-- introduction/content that goes before the list/screenshots of skins -->

<h1>Change Skin</h1>

<p>
This page allows you to choose a skin for this site, according to your
preferences. Click on the skin you wish to change into. Hover over the screenshots to see a few notes on the skin.
</p>

<!-- end introduction/content that goes before the list/screenshots of skins -->



<?php
show_skins( $skin, $skin_array );
require_once( 'skinnerfoot.php' );
?>