<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package lakesmtb
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<div class='slides'>
				<?php
					$args = array( 'post_type' => 'routes', 'posts_per_page' => 5 );
					$loop = new WP_Query( $args );
						while ( $loop->have_posts() ) : $loop->the_post(); ?>
							<div class='slide'>'
					  			<?php the_post_thumbnail('slider'); ?>
					  			<div class="container">
					  				<h1><?php the_title(); ?></h1>
					  				<p class="tagline">Lorem ipsum dolor sit amet, consectetur adipiscing elit.<br> Etiam interdum felis volutpat nulla rhoncus, in pretium purus mattis. </p>
					  				<p class="hashtag">#lakesmtb</p>
					  				<p class="copyright">Photo: @tristantinn</p>
					  			</div>
				  			</div>
				<?php endwhile;
				wp_reset_query(); ?>
			</div>

			<div class="container">
				<?php
				while ( have_posts() ) : the_post();

					get_template_part( 'template-parts/content', get_post_format() );

					the_post_navigation();

				endwhile; // End of the loop.
				?>
			</div>

			<section id="articles">
			<div class="container">
				<div class="row">
					<div class="articles-intro">
						<h2>More Articles</h2>
					</div>
						<?php
						$args = array( 'post_type' => 'post', 'posts_per_page' => 2 );
						$loop = new WP_Query( $args );
							while ( $loop->have_posts() ) : $loop->the_post(); ?>
								<div class='single-article'>
						  				<h3><?php the_title('\'', '\''); ?></h3>
						  				<p>Words and photos by <?php the_author(); ?> - @<?php the_author_meta('instagram'); ?></p>
						  				<?php the_post_thumbnail('article'); ?>
						  				<div class="custom-byline"><?php the_field('custom_byline')?></div>
						  				<div class="excerpt"><?php the_excerpt(); ?></div>
					  			</div>
						<?php endwhile;
						wp_reset_query(); ?>
				</div>
			</div>
		</section>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
