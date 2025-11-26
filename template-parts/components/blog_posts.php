<?php
    $headline = get_sub_field('headline');
    $buttonText = get_sub_field('button_text');
    $buttonUrl = get_sub_field('button_url');
    $backgroundColor = get_sub_field('background_color');
    $textColor = get_sub_field('text_color');
    $fullHeight = get_sub_field('full_height');
    $posts_count = get_sub_field('number_of_blog_posts_to_show');
?>
<section class="blog-posts<?php if($fullHeight === 'Yes'):?> full-height<?php endif;?>" style="
    <?php if ($textColor): ?> color: <?= $textColor; ?>; <?php endif; ?>
    <?php if ($backgroundColor): ?> background: <?= $backgroundColor; ?>; <?php endif; ?>
    ">
    <div class="container">
        <div class="title">
            <h2><?= esc_html($headline); ?></h2>
            <?php if($buttonUrl):?><a href="<?= esc_url($buttonUrl); ?>" class="desktop-button btn btn-primary">
                <?= esc_html($buttonText); ?>
                <i class="bi bi-arrow-right"></i>
            </a>
			<?php endif;?>
        </div>
        <div class="blog-posts-wrapper">
            <?php
            // Get ACF field for number of posts to show (set this field in ACF, e.g. as 'blog_posts_count')
            if (!$posts_count) {
                $posts_count = -1; // Show all if not set
            }
            $query = new WP_Query([
                'post_type' => 'post',
                'posts_per_page' => $posts_count,
                'post_status' => 'publish',
            ]);
            if ($query->have_posts()):
                while ($query->have_posts()): $query->the_post();
                    $post_url = get_permalink();
                    $post_title = get_the_title();
                    $post_image = get_the_post_thumbnail_url(get_the_ID(), 'large');
                    $post_categories = get_the_category();
                    $post_category = $post_categories ? esc_html($post_categories[0]->name) : '';
                    $post_date = get_the_date();
                    $post_excerpt = get_the_excerpt();
            ?>
                <a class="blog-post" href="<?= esc_url($post_url) ?>">
                    <?php if($post_image): ?>
                        <img class="w-100" loading="lazy" decoding="async" src="<?= esc_url($post_image) ?>" alt="<?= esc_attr($post_title) ?>">
                    <?php endif; ?>
                    <div class="content">
                        <div class="text">
                            <div class="blog-post-info">
                                <span class="highlight"><?= $post_category ?></span>
                                <span><?= esc_html($post_date) ?></span>
                            </div>
                            <h3 class="title"><?= esc_html($post_title) ?></h3>
                            <span><?= esc_html($post_excerpt)?></span>
                        </div>
                        <span class="btn btn-link">
                            Read more
                            <i class="bi bi-chevron-right"></i>
                        </span>
                    </div>
                </a>
            <?php
                endwhile;
                wp_reset_postdata();
            endif;
            ?>
        </div>
        <?php if($buttonUrl):?> <a href="<?= $buttonUrl; ?>" class="mobile-button btn btn-primary">
            <?= $buttonText; ?>
            <i class="bi bi-arrow-right"></i>
        </a>
		<?php endif;?>
    </div>
</section>
