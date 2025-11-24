<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package wickie
 */

get_header();
?>

	<main id="primary" class="site-main">

		<?php if (have_rows('content')):?>
			<?php while( have_rows('content')): the_row(); 

				if( get_row_layout() == 'hero' ):
					
					get_template_part( 'template-parts/components/'. get_row_layout() );

				elseif( get_row_layout() == 'feature_cards' ): 

					get_template_part( 'template-parts/components/'. get_row_layout() );

				elseif( get_row_layout() == 'credit_card' ): 

					get_template_part( 'template-parts/components/'. get_row_layout() );

				elseif( get_row_layout() == 'rewards' ): 

					get_template_part( 'template-parts/components/'. get_row_layout() );

				elseif( get_row_layout() == 'market' ): 

					get_template_part( 'template-parts/components/'. get_row_layout() );

				elseif( get_row_layout() == 'popular_services' ): 

					get_template_part( 'template-parts/components/'. get_row_layout() );

				elseif( get_row_layout() == 'steps' ): 

					get_template_part( 'template-parts/components/'. get_row_layout() );

				elseif( get_row_layout() == 'content_card' ): 

					get_template_part( 'template-parts/components/'. get_row_layout() );

				elseif( get_row_layout() == 'feature_boxes' ): 

					get_template_part( 'template-parts/components/'. get_row_layout() );

				elseif( get_row_layout() == 'pricing' ): 

					get_template_part( 'template-parts/components/'. get_row_layout() );

				elseif( get_row_layout() == 'banner' ): 

					get_template_part( 'template-parts/components/'. get_row_layout() );

				elseif( get_row_layout() == 'testimonials' ): 

					get_template_part( 'template-parts/components/'. get_row_layout() );

				elseif( get_row_layout() == 'blog_posts' ): 

					get_template_part( 'template-parts/components/'. get_row_layout() );

				elseif( get_row_layout() == 'hero_single' ): 

					get_template_part( 'template-parts/components/'. get_row_layout() );

				elseif( get_row_layout() == 'services' ): 

					get_template_part( 'template-parts/components/'. get_row_layout() );

				elseif( get_row_layout() == 'banner_boxed' ): 

					get_template_part( 'template-parts/components/'. get_row_layout() );

				elseif( get_row_layout() == 'image_content' ): 

					get_template_part( 'template-parts/components/'. get_row_layout() );

				elseif( get_row_layout() == 'icon_boxes' ): 

					get_template_part( 'template-parts/components/'. get_row_layout() );

				elseif( get_row_layout() == 'faq' ): 

					get_template_part( 'template-parts/components/'. get_row_layout() );

				elseif( get_row_layout() == 'get_started' ): 

					get_template_part( 'template-parts/components/'. get_row_layout() );

				elseif( get_row_layout() == 'credit_card_content' ): 

					get_template_part( 'template-parts/components/'. get_row_layout() );

				elseif( get_row_layout() == 'contact_info' ): 

					get_template_part( 'template-parts/components/'. get_row_layout() );

				elseif( get_row_layout() == 'contact_boxes' ): 

					get_template_part( 'template-parts/components/'. get_row_layout() );

				elseif( get_row_layout() == 'contact_form' ): 

					get_template_part( 'template-parts/components/'. get_row_layout() );

				elseif( get_row_layout() == 'reel_form' ): 

					get_template_part( 'template-parts/components/'. get_row_layout() );

				elseif( get_row_layout() == 'headline_subline_text' ): 

					get_template_part( 'template-parts/components/'. get_row_layout() );

				elseif( get_row_layout() == 'images' ): 

					get_template_part( 'template-parts/components/'. get_row_layout() );

				elseif( get_row_layout() == 'team' ): 

					get_template_part( 'template-parts/components/'. get_row_layout() );
		
				elseif( get_row_layout() == 'hero_new' ): 

					get_template_part( 'template-parts/components/'. get_row_layout() );
		
				elseif( get_row_layout() == 'downloads' ): 

					get_template_part( 'template-parts/components/'. get_row_layout() );
		
				elseif( get_row_layout() == 'order_form' ): 

					get_template_part( 'template-parts/components/'. get_row_layout() );
				
				endif; 

			endwhile;

		else:
			while ( have_posts() ) :
				
				the_post();
				echo "<div class='container mb-5'>";
				
				get_template_part( 'template-parts/content', 'page' );
	
				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;
				echo "</div>";
	
			endwhile; // End of the loop.
		endif;
		?>

	</main><!-- #main -->

<?php
// if (!have_rows('content')):
	// get_sidebar();
// endif;
get_footer();
