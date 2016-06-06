<div class="blog-meta-wrapper">
    <ul class="blog-meta">
        <li class="meta-date">
            <span class="glyphicon glyphicon-calendar" aria-hidden="true"></span>
            <time datetime="<?php echo the_time('Y-m-j'); ?>" pubdate>
                <?php the_time( get_option('date_format') ); ?>
            </time>
        </li>
        <li class="meta-author">
            <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
            <?php the_author(); ?>
        </li>
        <li class="meta-comments">
            <span class="glyphicon glyphicon-comment" aria-hidden="true"></span>
            <?php comments_number( '', __('One comment','wpbo'), '% comentarios' ); ?>
        </li>
        <li class="meta-category">
            <span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span>
            <?php the_category(', '); ?>
        </li>
    </ul>
</div>
