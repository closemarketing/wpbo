<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article">

    <header>

        <h3 class="h2"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>

        <?php get_template_part('partials/content', 'meta');?>

    </header> <!-- end article header -->

    <section class="post_content">
        <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
            <?php the_post_thumbnail( 'wpbo-featured' ); ?>
        </a>

        <?php the_excerpt(); ?>

    </section> <!-- end article section -->

    <footer>

    </footer> <!-- end article footer -->

</article> <!-- end article -->
