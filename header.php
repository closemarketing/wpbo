<?php wpbo_doctype(); ?>
<head>
    <?php wpbo_preheader();?>
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
