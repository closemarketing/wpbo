<div id="single-author" class="panel panel-default">
    <div class="panel-body">
    <div id="author-image" class="col-sm-2 widgettitle">
        <?php echo get_avatar( get_the_author_meta('user_email'), '120', '' ); ?>
    </div><!-- author-image -->
    <div id="author-bio" class="col-sm-10">
        <h3 class="heading"><?php the_author_meta('first_name'); ?> <?php the_author_meta('last_name'); ?></h3>
        <p><?php the_author_meta('description'); ?></p>

        <ul id="author-social" class="nav nav-pills">
            <?php if(get_the_author_meta('facebook')) { ?>
            <li>
                <a href="<?php the_author_meta('facebook'); ?>">
                    <i class="fa fa-facebook fa-2x"></i>
                </a>
            </li>
            <?php } ?>

            <?php if(get_the_author_meta('twitter')) { ?>
            <li>
                <a href="https://twitter.com/<?php the_author_meta('twitter'); ?>">
                    <i class="fa fa-twitter fa-2x"></i>
                </a>
            </li>
            <?php } ?>

            <?php if(get_the_author_meta('googleplus')) { ?>
            <li>
                <a href="<?php the_author_meta('googleplus'); ?>">
                    <i class="fa fa-google-plus fa-2x"></i>
                </a>
            </li>
            <?php } ?>

            <?php if(get_the_author_meta('linkedin')) { ?>
            <li>
                <a href="<?php the_author_meta('linkedin'); ?>">
                    <i class="fa fa-linkedin fa-2x"></i>
                </a>
            </li>
            <?php } ?>
        </ul>
    </div><!-- author-bio -->
    </div>
</div><!-- /single-author -->
