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
		
		<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'slider' ); ?>
        <div id="feature-bg" style="background-image: url('<?php echo $image[0]; ?>')">
            <div class="container">
				<p class="copyright">Photo: @tristantinn</p>
			</div>
        </div>


	<section id="contributors">
		<div class="container">
			<h2>Contributors</h2>
			<p class="intro-para">Friends, photographers, writers, industry types but most importantly; all riders who share the same passion for riding bikes. Sharing stories, moments and trails from the Lake District.</p>
			<div class="row">
					<?php
					$args = array(
						'role' => 'Author'
					);

					// The Query
					$user_query = new WP_User_Query( $args );

					// User Loop
					if ( ! empty( $user_query->results ) ) {
						foreach ( $user_query->results as $user ) { ?>
							<div class="contributor">
								<h4> <?php echo $user->display_name ?></h4>
								<p class="insta-handle">@ <?php echo $user->instagram ?></p>
								<div class="cont-hover">
									<div class="overlay">
							            <div class="table"><div class="cell middle">
								            <a href="<?php the_permalink(); ?>"><h3>View Full Profile</h3></a>
								        </div></div>
									</div>
								<?php echo get_avatar( $user ->ID, 280); ?>
								</div>
							</div>
						<?php }
					} else {
						echo 'No users found.';
					}
					?>
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
