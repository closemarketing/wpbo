<?php
/*
Template Name: Landing Page
*/
__( 'Landing Page', 'wpbo' );
?>

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

            </div>

        </div> <!-- end .container -->
    </div> <!-- end .navbar -->

</header> <!-- end header -->

<div class="container">


<div id="content" class="clearfix row">

    <div id="main" class="col col-sm-12 clearfix" role="main">

        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

        <article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article">

            <header>

                <div class="page-header"><h1><?php the_title(); ?></h1></div>

            </header> <!-- end article header -->

            <section class="post_content">
                <?php the_content(); ?>

            </section> <!-- end article section -->

            <footer>

                <p class="clearfix"><?php the_tags('<span class="tags">' . __("Tags","wpbo") . ': ', ', ', '</span>'); ?></p>

            </footer> <!-- end article footer -->

        </article> <!-- end article -->

        <?php endwhile; ?>

        <?php else : ?>

        <article id="post-not-found">
            <header>
                <h1><?php _e("Not Found", "wpbo"); ?></h1>
            </header>
            <section class="post_content">
                <p><?php _e("Sorry, but the requested resource was not found on this site.", "wpbo"); ?></p>
            </section>
            <footer>
            </footer>
        </article>

        <?php endif; ?>

    </div> <!-- end #main -->

    <?php //get_sidebar(); // sidebar 1 ?>

</div> <!-- end #content -->

</div> <!-- end #container -->
<footer class="mainfooter" role="contentinfo">
    <div class="container">
        <div id="inner-footer" class="clearfix">
          <hr />
          <div id="widget-footer" class="clearfix row">
            <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('footer1') ) : ?>
            <?php endif; ?>
            <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('footer2') ) : ?>
            <?php endif; ?>
            <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('footer3') ) : ?>
            <?php endif; ?>
          </div>

            <nav class="clearfix">
                <?php wpbo_bootstrap_footer_links(); // Adjust using Menus in Wordpress Admin ?>
            </nav>

            <p class="pull-right">
                Theme made by <a href="<?php echo esc_url( __('http://www.closemarketing.net/', 'wpbo'));?>" target="_blank" title="Dise&ntilde;o Web Wordpress en Granada" rel="nofollow">Closemarketing</a>
            </p>

            <p class="attribution">&copy; <?php bloginfo('name'); ?></p>

        </div> <!-- end #inner-footer -->
    </div> <!-- end #container -->
</footer> <!-- end footer -->
    <?php wp_footer(); // js scripts are inserted using this function ?>
</body>

</html>
