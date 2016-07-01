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
									<h4><?php the_title(); ?></h4>
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



	<section id="lakes-routes">
		<div class="container">
			<div class="row">
				<div class="routes-intro">
					<h2>Lake District Routes - #bikeparklakes</h2>
					<p>Completely un-biased real world, real rider product reviews. Long term, short term and first impressions. We invite manufacturers and bike shops to send kit for real world testing and feedback from the followers of LakesMTB.</p>
				</div>
				<?php
					$args = array( 'post_type' => 'routes', 'posts_per_page' => 3 );
					$loop = new WP_Query( $args );
						while ( $loop->have_posts() ) : $loop->the_post(); ?>
							<div class='single-route'>
					  				<h3><?php the_title(); ?></h3>
					  				<?php the_post_thumbnail('shot-week'); ?>
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
