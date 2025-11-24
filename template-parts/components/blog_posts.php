<?php
    $headline = get_sub_field('headline');
    $buttonText = get_sub_field('button_text');
    $buttonUrl = get_sub_field('button_url');
    $backgroundColor = get_sub_field('background_color');
    $textColor = get_sub_field('text_color');
    $fullHeight = get_sub_field('full_height');
?>
<section class="blog-posts<?php if($fullHeight === 'Yes'):?> full-height<?php endif;?>" style="
    <?php if ($textColor): ?> color: <?= $textColor; ?>; <?php endif; ?>
    <?php if ($backgroundColor): ?> background: <?= $backgroundColor; ?>; <?php endif; ?>
    ">
    <div class="container">
        <div class="title">
            <h2><?= esc_html($headline); ?></h2>
            <?php if($buttonUrl):?><a href="<?= esc_url($buttonUrl); ?>" target="_blank" class="desktop-button btn btn-primary">
                <?= esc_html($buttonText); ?>
                <i class="bi bi-arrow-right"></i>
            </a>
			<?php endif;?>
        </div>
        <div class="blog-posts-wrapper">
            <?php
            if( have_rows('blog_post')):
                while( have_rows('blog_post') ): the_row();
                $blogPostUrl = get_sub_field('blog_post_url');
                $blogPostTitle = get_sub_field('blog_post_title');
                $blogPostImageUrl = get_sub_field('blog_post_image_url');
                $blogPostCategory = get_sub_field('blog_post_category');
                $blogPostDate = get_sub_field('blog_post_date');
                $blogPostExcerpt = get_sub_field('blog_post_excerpt');
				$newTab = get_sub_field('new_tab');
            ?>
                <a class="blog-post" href="<?= $blogPostUrl ?>"<?php if($newTab === 'Yes'):?> target="_blank"<?php endif;?>>
                    <img class="w-100" loading="lazy" decoding="async" src="<?= $blogPostImageUrl ?>" alt="<?= $blogPostTitle ?>">
                    <div class="content">
                        <div class="text">
                            <div class="blog-post-info">
                                <span class="highlight"><?= $blogPostCategory ?></span>
                                <span><?= $blogPostDate ?></span>
                            </div>
                            <h3 class="title"><?= $blogPostTitle ?></h3>
                            <span><?= $blogPostExcerpt?></span>
                        </div>
                        <span class="btn btn-link">
                            Read more
                            <i class="bi bi-chevron-right"></i>
                        </span>
                    </div>
                </a>
            <?php
                endwhile;
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
