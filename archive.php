<?php get_header(); ?>

<div id="content" class="clearfix row">

    <div id="main" class="col-sm-8 clearfix" role="main">

        <div class="page-header">
        <?php if (is_category()) { ?>
            <h1 class="archive_title h2">
                <?php single_cat_title(); ?>
            </h1>
        <?php } elseif (is_tag()) { ?>
            <h1 class="archive_title h2">
                <span><?php _e("Posts Tagged:", "wpbo"); ?></span> <?php single_tag_title(); ?>
            </h1>
        <?php } elseif (is_author()) { ?>
            <h1 class="archive_title h2">
                <span><?php _e("Posts By:", "wpbo"); ?></span> <?php get_the_author_meta('display_name'); ?>
            </h1>
        <?php } elseif (is_day()) { ?>
            <h1 class="archive_title h2">
                <?php printf( __( 'Daily Archives: <span>%s</span>', 'wpbo' ), get_the_date() ); ?>
            </h1>
        <?php } elseif (is_month()) { ?>
            <h1 class="archive_title h2">
                <?php printf( __( 'Monthly Archives: <span>%s</span>', 'wpbo' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'wpbo' ) ) ); ?>
            </h1>
        <?php } elseif (is_year()) { ?>
            <h1 class="archive_title h2">
				<?php printf( __( 'Yearly Archives: <span>%s</span>', 'wpbo' ), get_the_date( _x( 'Y', 'yearly archives date format', 'wpbo' ) ) ); ?>
            </h1>
        <?php } ?>

        <?php if ( !get_query_var( 'paged' ) ) {
          //Description for Taxonomy ?>
            <div class="resume">
              <?php echo wpautop( term_description() ); ?>
            </div>
        <?php } ?>

        </div>

        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

        <?php get_template_part( 'loop', 'blog' ); ?>

        <?php endwhile; ?>

        <?php
            if (function_exists('wpbo_pagenavi')) { // function for pagination

                wpbo_pagenavi(); // use the page navi function

            } else { // if it is disabled, display regular wp prev & next links ?>
            <nav class="wp-prev-next">
                <ul class="pager">
                    <li class="previous">&laquo; <?php next_posts_link(_e('Older Entries', "wpbo")) ?></li>
                    <li class="next"><?php previous_posts_link(_e('Newer Entries', "wpbo")) ?> &raquo;</li>
                </ul>
            </nav>
        <?php } ?>

        <?php else : ?>

        <article id="post-not-found">
            <header>
                <h1><?php _e("No Posts Yet", "wpbo"); ?></h1>
            </header>
            <section class="post_content">
                <p><?php _e("Sorry, What you were looking for is not here.", "wpbo"); ?></p>
            </section>
            <footer>
            </footer>
        </article>

        <?php endif; ?>

    </div> <!-- end #main -->

    <?php get_sidebar(); // sidebar 1 ?>

</div> <!-- end #content -->

<?php get_footer(); ?>
