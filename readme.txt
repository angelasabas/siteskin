
SiteSkin
-----------------------------
Copyright (c) Angela Sabas
http://scripts.indisguise.org
=============================


SiteSkin is a short script that allows you to easily make your site
skinnable.

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


There should be ten files in the zipped archive you downloaded. These are:
. iframe.php
. iframesample.php
. sample.php
. skinconfig.inc.php
. skinnerfoot.php
. skinnerhead.php
. skinnerifoot.php
. skinnerihead.php
. skins.php
. readme.txt (this file)

There is also a "sample" skin under the skins/sample directory.



Features
--------

. Automatic recognition of new skins
. Ability to change EVERY layout aspect between skins except the content
. No need for a database
. Uses cookies to store visitor's skin information up to 30 days since last
  visit
. XHTML 1.0 Strict-friendly
. Skins can be changed not only in skins.php but in any page of the site
. Optionally allows the selection of a default skin


Requirements
------------

PHP 4.3.0
* These are what I used to develop the script; if you have tested it with
lower versions of PHP and it works, please tell me. :)



Installation/configuration
--------------------------

1. Customize the "skinconfig.inc.php" file. You have to specify the directory
   where your skins will be placed and the cookie name (choose something
   fairly unique for the cookie name).

2. Create the content pages of your site. These files are CONTENT-only;
   these will be the text that will be different for every page of the site,
   i.e., information about you, about your site, etc. Please see sample.php
   for a sample content page.

3. Create your skin(s) (see appropriate section below).

4. For each CONTENT page of your site (i.e., siteinfo.php, domain.php, etc),
   place these lines IN THE FIRST LINE of the file (open it up in notepad
   in order to edit the file):

      <?php require_once( 'skinnerhead.php' ); ?>

   And the last line of these files must be:

      <?php require_once( 'skinnerfoot.php' ); ?>

5. If you want to show the skins that are available and allow visitors to
   change them insert this line where you want the skins to show up:

      <?php show_skins( $skin, $skin_array ); ?>

   So this line would show up in a page like skins.php to allow people to
   view and change skins, or in a side column to allow for changing skins
   anywhere on the site. You can also add a mini-stylesheet if you would
   like to change how the skins are generally displayed:

      <style type="text/css">
      p.skin {
         /* this contains the style you wish for the paragraph tags */
         text-align: left;
         text-indent: 0px;
         }
      img.skin {
         /* this contains the style you wish for the image tags */
         width: 200px;
         height: 150px;
         border-width: 0px;
         }
      </style>

   If you would like to show *only* the skin thumbnails (for putting skins
   on a side column of a site, for example), insert this line instead:

      <?php show_skins( $skin, $skin_array, false ); ?>

   Only the skin thumbnails and the (mandatory) link back to Indiscripts will
   display if the above line is used.

6. Upload the files to your site's root directory. If you are using folders,
   the files must be uploaded in all folders where there is content.



Important Notes, Hints, and Tips
--------------------------------
. If you are using folders for your site, skinconfig.inc.php MUST be in all
  folders where skinned pages exist. Failure to add this file will result in
  skin switching.

. Inline links are NOT to be removed. They can be customized according to
  your wishes but they are NOT to be removed.



Upgrading
---------
. From 3.2.1 to 3.3
  If you are using iframes, DO NOT UPGRADE. SiteSkin 3.3 does not support iframes.
  Otherwise, upload skinnerhead.php and skinnerfoot.php. If you wish to use the
  debug mode, add the $debug variable to your skinconfig.inc.php file (see
  included skinconfig.inc.php file).

. From 3.2 to 3.2.1:
  If you are having problems with the script, try uploading the following files:
     skinnerhead.php
	 skinnerihead.php (if using an iframe)
  If not, you don't need this upgrade. :)

. From 3.1 to 3.2:
  1. Upload the following files:
        skinnerhead.php
     If you will be using iframes, upload the following as well:
        skinnerifoot.php
        skinnerihead.php
  2. If creating iframe layouts, please check the new Creating a Skin section.

. From 3.0 to 3.1:
  1. Upload the following files:
        skinnerhead.php
  2. Open up your skins.php page and replace this:
        <?php
        require_once( 'skinner.php' );
        ?>
     ...with this:
        <?php
        require_once( 'skinnerhead.php' );
        ?>
  4. Add this variable to the end of your skinconfig.inc.php file:
        $web_skins_dir = $skins_dir;
     If you wish to use subdirectories, set your $skins_dir to an absolute path
     and set this variable to a Web URL to your skins directory, i.e., 
     http://yourdomain.com/skins/ (don't forget the trailing slash!)
  3. You can now delete the following files:
        skinner.php
        phpsiteskin.gif

. From 2.0 to 3.0:
  1. Upload the following files:
       phpsiteskin.gif
       skinner.php
       skinnerhead.php
  2. If you wish to use a different extention for your skins, add this variable
     to your skinconfig.inc.php file (i.e., if you want to use a jpeg image):
     $thumb_extension = 'jpg';



Creating a skin
---------------

1. Create a directory within your skins directory (no spaces).

2. Create your layout any way you usually create your layout (i.e., put
   dummy text, etc -- whatever you do). For example, the layout is:

      1: <html><head><title>My Page</title></head>
      2: <table><tr><td>
      3: This is just a sample layout. This text is part of the layout.
      4: </td><td>
      5: This is the start of the content. Everything within this part
      6: changes whenever a different page is viewed.
      7: </td></tr></table>
      8: </body></html>

   In the above example, you will copy lines 1-4 into a new file called
   "header.html" and put this file into the directory you created in your
   skins directory.
   Lines 5-6 will be the lines that will fall inside content pages.
   Lines 7-8 should then be copied into a file called "footer.html" under
   the directory you created.

3. Place all images, stylesheets, etc. used in the layout within the directory
   you created. Make sure that you alter the SRC attributes of your HTML
   tags to include the new locations, i.e.
      <img src="YOUR_SKINS_DIRECTORY/THE_DIRECTORY_YOU_CREATED/filename.jpg" />

4. Create a text file named "alt.txt" that will contain a short one-line
   description of the skin you just made. Or you can be as verbose as you
   want, but keep all text in one line (do not hit enter/return).

5. Create a thumbnail of your skin however way you wish and save it as a GIF
   file: "thumb.gif". If you wish to use a different image format for your
   thumbnail, be sure to specify the extention in skinconfig.inc.php

6. You should now be able to change to your new skin by going to your
   skins.php file (or to the file you changed it into) and clicking on the
   skin thumbnail.



Changelog
---------
* This changelog was started in 3.3 and is not able to fully account for
  all changs between earlier versions

- 3.3.1
  . Change of license to GPLv3.
  . Update of config file samples to use .sample.inc.php in order to prevent
    accidental overwriting.

- 3.2.1 to 3.3
  . Allowed automatic usage of PHP header and footer files
  . Suppressed errors when header/footer files are absent
  . Added a "debug" mode which will show errors
  . Cleaning of GET and COOKIE strings added (not when parsing site URLs)
  . Removed border="0" in thumbnails to allow for XHTML Strict validation
  . Added title attribute to thumbnails
  . Iframes have been discontinued (sorry!)

- 3.1 to 3.2
  . Use of iframe layouts added
  . Added error-checking for possible non-folder files in the skins
    directory
  . Allows selection of a default skin
  . Added support for showing only skin thumbnails and mandatory link
  . Added check for if the skins that are trying to get loaded exists

- 3.0 to 3.1
  . Using a validator such as http://validator.w3.org/ won't result
    in a 302 error
  . Skins can be changed not only in skins.php but in any page of the site
  . Show all skins in any page of the site (for changing)
  . Added supprt for using folders in website and still be able to skin pages
    under them

- 2.x to 3.0
  . Easier upgrading for future versions
  . Added recognition of other thumbnail image types (JPG, PNG)


Contact information
-------------------
You may email me at scripts@indisguise.org or use the contact form at
http://scripts.indisguise.org/contact/ -- please use this information
prudently! I will NOT answer queries and questions about SiteSkin that
I have already addressed in this readme file. NO EXCEPTIONS.