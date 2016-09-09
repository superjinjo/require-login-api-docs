# Requiring Login for Viewing Pages and Documentation

Documentation generators are very convenient, but I needed a way to host my generated documentation
without it being public to everyone, and I wanted to do minimal copying and pasting. I already had a WordPress
site dedicated to developer resources, so my solution was to use mod_rewrite to run a script before displaying the
content. The script checks if a user is logged in using WordPress's already existing authentication functions.

Currently the .htaccess file only checks for .html files but it can be modifed to check for any number of file extensions.

This plugin also requires users to log in when viewing WordPress pages.

## Instructions
1. Put docsauth.php in the root of the WordPress installation
2. Put doc-role.php in the /wp-content/mu-plugins/ folder or make the necessary changes to make it into a regular plugin.
3. Put the .htaccess file in the root of the WordPress installation or just copy and paste the pieces you need on your already existing one