<?php
get_header(); // Includes standard theme header

if (have_posts()) : // If there are posts in the loop
    while (have_posts()) : the_post(); ?>
        <div class='dd-wrapper'>
            <div class="dd-single">
                <h1 class="dd-title"><?php the_title(); ?></h1>
                <div class="odd-content">
                    <?php the_content(); ?>
                </div>

                <div class="dd-details"> <!-- This section displays the meta info -->
                    <p><strong>Building: </strong> <?php echo esc_html(get_post_meta(get_the_ID(), 'building', true)); ?></p>

                    <p><strong>Phone: </strong> <?php echo esc_html(get_post_meta(get_the_ID(), 'phone', true)); ?></p>

                    <p><strong>Email: </strong> <a href="mailto:<?php echo esc_attr(get_post_meta(get_the_ID(), 'email', true)); ?>"><?php echo esc_html(get_post_meta(get_the_ID(), 'email', true)); ?></a></p>

                    <p><strong>Link: </strong> <a href="<?php echo esc_url(get_post_meta(get_the_ID(), 'link', true)); ?>" target="_blank"><?php echo esc_html(get_post_meta(get_the_ID(), 'link', true)); ?></a></p>
                </div>
            </div>
        </div>
    <?php endwhile;
endif;

get_footer(); // Includes standard theme footer
