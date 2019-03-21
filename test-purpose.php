<?php
define('WP_USE_THEMES', false);
/** Loads the WordPress Environment and Template */
require ('/home/kko001/domains/creativecircle.nl/public_html/voorbeeld/data/wp-blog-header.php');

get_header();

echo do_shortcode('[amelia_calendar]');

get_footer();