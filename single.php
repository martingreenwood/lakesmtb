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

			<?php if (get_field('enable_slider')): ?>
			<div class='slides'>
			<?php $images = get_field('slider'); if( $images ): ?>
			<?php foreach( $images as $image ): ?>
				<div class='slide'>'
					<img src="<?php echo $image['sizes']['slider']; ?>" alt="<?php echo $image['alt']; ?>" />
					<div class="container">
						<p class="hashtag"><?php echo $image['title']; ?></p>
						<p class="copyright"><?php echo $image['caption']; ?></p>
					</div>
				</div>
			<?php endforeach; ?>
			<?php endif; ?>
			</div>
			<?php else : ?>
			<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'slider' ); ?>
		    <div id="feature-bg" style="background-image: url('<?php echo $image[0]; ?>')">
		        <div class="container">
					<div class="container">
						<p class="hashtag"><?php echo $image['title']; ?></p>
						<p class="copyright"><?php echo $image['caption']; ?></p>
					</div>
				</div>
		    </div>
			<?php endif; ?>

			<section id="article-intro">
				<div class="container">
					<div class="row">
						<div class="about-route">
							<h3><?php the_date(); ?></h3>
							<p class="uppercase author">By <?php the_author(); ?></p>

							<?php
								if ( function_exists( 'sharing_display' ) ) {
								    sharing_display( '', true );
								}
							?>

							<div class="route">
								<h5>The Route:</h5>
								<?php
								$post_object = get_field('associated_route');

								if( $post_object ): 
									$post = $post_object;
									setup_postdata( $post ); 
									the_field('waypoints'); ?>
								<a href="<?php the_permalink(); ?>"><h5>More route info here</h5></a>
							    <?php wp_reset_postdata();
								endif; ?>
							</div>
							
						</div>

						<div class="start-content">
							<h2><?php the_title(); ?></h2>
							<?php the_content(); ?>
						</div>
					</div>
				</div>
			</section>

			<?php
			if( have_rows('feature_grid') ): ?>
			<div class="container grid">
		
			    <?php while ( have_rows('feature_grid') ) : the_row(); ?>
		
				<div class="row">
				
					<?php
		
					    while ( have_rows('columns') ) : the_row();
						$column_width = get_sub_field('width');
						$column_content = get_sub_field('content');
						?>
		
						<div class="column <?php echo $column_width; ?>">
		
						<?php if( have_rows('content') ):
						    while ( have_rows('content') ) : the_row();
		
						        if( get_row_layout() == 'image' ):
						        	get_template_part( 'partials/grid', 'image' );
		
						        elseif( get_row_layout() == 'video' ): 
						        	get_template_part( 'partials/grid', 'feature-vid' );
		
						        elseif( get_row_layout() == 'text_box' ): 
						        	get_template_part( 'partials/grid', 'text' );
		
						        endif;
		
						    endwhile;
						endif; ?>
							
						</div>
		
					    <?php endwhile; ?>
		
				</div>
		
			    <?php endwhile; ?>
			
			</div>
			<?php endif; ?>
			
			<div class="container"><hr></div>

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
