<?php get_header(); ?>

<div id="content" class="clearfix row">

    <div id="main" class="col col-sm-8 clearfix" role="main">

        <div class="page-header"><h1><span><?php _e("Search Results for","wpbo"); ?>:</span> <?php echo esc_attr(get_search_query()); ?></h1></div>

        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

        <article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article">

            <header>

                <h3><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>

                <?php get_template_part('partials/content', 'meta');?>

            </header> <!-- end article header -->

            <section class="post_content">
                <?php the_excerpt('<span class="read-more">' . __("Read more on","wpbo") . ' "'.the_title('', '', false).'" &raquo;</span>'); ?>

            </section> <!-- end article section -->

            <footer>


            </footer> <!-- end article footer -->

        </article> <!-- end article -->

        <?php endwhile; ?>

        <?php if (function_exists('wpbo_pagenavi')) { wpbo_pagenavi(); } ?>		

        <?php else : ?>

        <!-- this area shows up if there are no results -->

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

    <?php get_sidebar(); // sidebar 1 ?>

</div> <!-- end #content -->

<?php get_footer(); ?>
