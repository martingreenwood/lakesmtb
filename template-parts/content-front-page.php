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

	<section id="featured-widgets">

		<div class="container">
			<div class="row">
				<div class="twitter">
					<img src="http://placehold.it/350x50">
					<p>The mountains are calling. If you ride bikes in the 
					English Lake District, we want to see your pics.</p>
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis mattis posuere urna non maximus. Fusce id scelerisque lectus, sed rutrum purus. Quisque congue enim et faucibus ullamcorper. Ut ac auctor elit. Curabitur varius condimentum erat, at consequat ante mollis a. </p>
					<p>#lakesmtb @lakesmtb www.lakesmtb.co.uk</p>
				</div>

				<div class="weather">
					<h3>LAKE DISTRICT WEATHER</h3>
					<img src="http://placehold.it/297x265">
				</div>

				<div class="photo-week">
					<h3>SHOT OF THE WEEK - <?php the_field('featured_photographer'); ?></h3>
					<?php $image = get_field('featured_photograph');
						
						if( !empty($image) ): 
							$size = 'shot-week';
							$shot = $image['sizes'][ $size ]; ?>

						<img src="<?php echo $shot; ?>" alt="<?php echo $image['alt']; ?>" />
					<?php endif; ?>
				</div>
			</div>
		</div>

	</section>

	<section id="insta">
		<div class="container">
			<h2>#Lakesmtb on Instagram</h2>
				<div class="display-cabinet">
					<img src="https://scontent.cdninstagram.com/t51.2885-15/s640x640/sh0.08/e35/13549625_1785135505054704_354599205_n.jpg?ig_cache_key=MTI4MTE2MjkxMzYyNDkwOTUxNg%3D%3D.2">
				</div>

			<div class="instafeed">
				
				<?php

                    // Supply a user id and an access token
                    $userid = '1687312187';
                    $accessToken = '1687312187.1677ed0.cd354afbc6724ac699d4293bd39d68ef';

                    // Start counting
                    $counter = 0;
                   
                    // Gets our data
                    function fetchData($url){
                         $ch = curl_init();
                         curl_setopt($ch, CURLOPT_URL, $url);
                         curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                         curl_setopt($ch, CURLOPT_TIMEOUT, 20);
                         $result = curl_exec($ch);
                         curl_close($ch); 
                         return $result;
                    }

                    // Pulls and parses data.
                    $result = fetchData("https://api.instagram.com/v1/users/{$userid}/media/recent/?access_token={$accessToken}");
                    $result = json_decode($result);
                ?>

                <?php foreach ($result->data as $ig_post): ?>
                <div class="ig-card">
                	<div class="overlay">
                		<div class="table"><div class="cell middle">
	                		<ul>
	                			<li><i class="fa fa-heart" aria-hidden="true"></i> <?php echo $ig_post->likes->count; ?></li>
	                			<li><i class="fa fa-comment" aria-hidden="true"></i> <?php echo $ig_post->comments->count; ?></li>
	                		</ul>
	                	</div></div>
                	</div>
                    <img src="<?php echo $ig_post->images->standard_resolution->url ?>" width="<?php echo $ig_post->images->standard_resolution->width ?>" height="<?php echo $ig_post->images->standard_resolution->height ?>" alt="<?php echo $ig_post->caption->text ?>">
                </div>
                <?php if ($counter++ == 8) break; ?>
                <?php endforeach ?> 

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

	<section id="articles">
		<div class="container">
			<div class="row">
				<div class="articles-intro">
					<h2>Articles</h2>
					<p>Articles and stories from our intrepid band of contributors etc.</p>
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



	

	
</article><!-- #post-## -->
