<?php
/**
 * Template part for displaying page content in front-page.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package lakesmtb
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
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
	
	<section id="route-search">
		<div class="container">
			<h2><?php the_title(); ?></h2>
			<p><?php the_content(); ?></p>
		</div>
	</section>


	<section id="route-results">
		<div class="container">
			<div class="row">
				<?php
						$args = array( 'post_type' => 'routes', 'posts_per_page' => 4 );
						$loop = new WP_Query( $args );
							while ( $loop->have_posts() ) : $loop->the_post(); ?>
								<div class='single-route'>
									<a href="<?php the_permalink(); ?>"><h4><?php the_title(); ?></h4></a>
									<p class="gpx-link">
										<?php 

										$file = get_field('gpx_download');

										if( $file ): 

											// vars
											$url = $file['url']; ?>

											<a href="<?php echo $url; ?>" download>Download GPX file</a>

										<?php endif; ?>
									</p>

									<div class="route-hover">
										<div class="overlay">
					                		<div class="table"><div class="cell middle">
						                		<a href="<?php the_permalink(); ?>"><h3>View Full Route</h3></a>
						                	</div></div>
						                </div>
					                	<?php the_post_thumbnail('route-square'); ?>
					                </div>
					  				<div class="stat-one"><p>Dst: <?php the_field('distance')?> miles</p></div>
						  			<div class="stat-two"><p>Elevation (ft): <?php the_field('elevation')?></p></div>
					  				<div class="tags"><?php the_tags(); ?></div>
					  			</div>
					<?php endwhile;
					wp_reset_query(); ?>
			</div>
		</div>
	</section>

	
</article><!-- #post-## -->
