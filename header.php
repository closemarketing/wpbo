<!doctype html>
<!--[if IEMobile 7 ]> <html <?php language_attributes(); ?>class="no-js iem7"> <![endif]-->
<!--[if lt IE 7 ]> <html <?php language_attributes(); ?> class="no-js ie6"> <![endif]-->
<!--[if IE 7 ]>    <html <?php language_attributes(); ?> class="no-js ie7"> <![endif]-->
<!--[if IE 8 ]>    <html <?php language_attributes(); ?> class="no-js ie8"> <![endif]-->
<!--[if (gte IE 9)|(gt IEMobile 7)|!(IEMobile)|!(IE)]><!--><html <?php language_attributes(); ?> class="no-js"><!--<![endif]-->
<head>
    <meta charset="utf-8">
    <!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<header role="banner">

    <div class="navbar navbar-default navbar-fixed-top">
        <div class="container">

            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>


            <a class="navbar-brand" title="<?php echo get_bloginfo('description'); ?>" href="<?php echo home_url(); ?>">
                <?php if ( function_exists( 'the_custom_logo' ) ) { the_custom_logo(); } ?>
            </a>
            </div>

            <div class="collapse navbar-collapse navbar-responsive-collapse">
                <?php wpbo_bootstrap_main_nav(); // Adjust using Menus in Wordpress Admin ?>


                <form class="navbar-form navbar-right" role="search" method="get" id="searchform" action="<?php echo home_url( '/' ); ?>">
                    <div class="form-group">
                        <input name="s" id="s" type="text" class="search-query form-control" autocomplete="off" placeholder="<?php _e('Search','wpbo'); ?>">
                    </div>
                </form>

            </div>

        </div> <!-- end .container -->
    </div> <!-- end .navbar -->

</header> <!-- end header -->

<div class="container">
