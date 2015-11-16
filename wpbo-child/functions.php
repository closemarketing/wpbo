<?php
/**
 * @package WordPress.
 * @subpackage WPBoot Child Theme.
 * About: Add your awesome functions here.
*/
//Not load JS and CSS in WPML
define('ICL_DONT_LOAD_NAVIGATION_CSS', true);
define('ICL_DONT_LOAD_LANGUAGE_SELECTOR_CSS', true);
define('ICL_DONT_LOAD_LANGUAGES_JS', true);
define("ICL_DONT_PROMOTE", true);

function first_paragraph( $content ){
}