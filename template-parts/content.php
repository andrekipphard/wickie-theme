<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package wickie
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
   <?php if ( has_post_thumbnail() ) : ?>
	   <div class="post-hero-image">
		   <?php the_post_thumbnail('full', ['class' => 'w-100', 'style' => 'width:100%;height:auto;display:block;']); ?>
	   </div>
   <?php endif; ?>
   <div class="post-title-wrapper">
	   <header class="entry-header">
			<?php
			if ( is_singular() ) :
				the_title( '<h1 class="entry-title">', '</h1>' ); // Headline for singular posts
			else :
				the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			endif;

			if ( 'post' === get_post_type() ) :
				?>
				<div class="entry-meta"> <!-- Meta Info for singular posts -->
					<?php
						wickie_posted_on();
						// Display categories as plain text, comma-separated, no links
						$categories = get_the_category();
						if ( $categories ) {
							$cat_names = array();
							foreach ( $categories as $cat ) {
								$cat_names[] = esc_html( $cat->name );
							}
							echo '<span>' . implode( ', ', $cat_names ) . '</span>';
						}
					?>
				</div><!-- .entry-meta --> 
			<?php endif; ?>
		</header><!-- .entry-header -->
		<!-- wickie_post_thumbnail(); removed for hero image test -->
	</div>




	<div class="entry-content"> <!-- Content for singular posts -->
		<?php
		the_content(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'wickie' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				wp_kses_post( get_the_title() )
			)
		);

		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'wickie' ),
				'after'  => '</div>',
			)
		);
		?>
	</div><!-- .entry-content -->
</article><!-- #post-<?php the_ID(); ?> -->
