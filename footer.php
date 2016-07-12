<?php if ( function_exists('yoast_breadcrumb') ) {
    yoast_breadcrumb('<p id="breadcrumbs">','</p>');
} ?>
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
                <?php _e('Theme made by','wpbo');?> <a href="<?php echo esc_url( __('http://www.closemarketing.net/', 'wpbo'));?>" target="_blank" title="WordPress Web Design in Granada" rel="nofollow">Closemarketing</a>
            </p>

            <p class="attribution">&copy; <?php bloginfo('name'); ?></p>

        </div> <!-- end #inner-footer -->
    </div> <!-- end #container -->
</footer> <!-- end footer -->
    <?php wp_footer(); // js scripts are inserted using this function ?>
</body>

</html>
