<?php
/**
 * Template part for displaying page content in front-page.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package lakesmtb
 */

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

$user_result = fetchData("https://api.instagram.com/v1/users/{$userid}/?access_token={$accessToken}");
$user_result = json_decode($user_result);


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
					<header>

						<div class="icon">
							<?php
							if($user_result->data->profile_picture) {
								echo '<img src="'.$user_result->data->profile_picture .'">';
							} else {
								$ig_icon = get_field('ig_icon'); 
								$size = 'full';
								echo wp_get_attachment_image( $ig_icon, $size );
							}
							if($user_result->data->username) {
								echo "@".strtoupper($user_result->data->username);
							} else {
								echo strtoupper(get_field('ig_name'));
							}
							?>
						</div>

						<a class="follow" target="_blank" href="<?php the_field('ig_url') ?>">Follow</a>

					</header>

					<?php the_field('ig_text'); ?>

					<?php if (is_object($user_result->data)): ?>
					<ul>
						<li><strong><?php echo $user_result->data->counts->media; ?></strong> posts</li>
						<li><strong><?php echo $user_result->data->counts->followed_by; ?></strong> followers</li>
						<li><strong><?php echo $user_result->data->counts->follows; ?></strong> following</li>
					</ul>
					<?php endif; ?>
				</div>

				<div class="weather">
					<h3>LAKE DISTRICT WEATHER</h3>

					<?php

						function fahrenheit_to_celsius($given_value)
						{
							$celsius=5/9*($given_value-32);
							return $celsius ;
						}

						function celsius_to_fahrenheit($given_value)
						{
							$fahrenheit=$given_value*9/5+32;
							return $fahrenheit ;
						}

						function kelvin_to_celsius($temp) 
						{
							if ( !is_numeric($temp) ) { return false; }
							return round(($temp - 273.15));
						}

						function weather_icon($typeicon) {

							if ($typeicon == "01d"):
								$weatherIcon = '<i class="wi wi-day-sunny"></i>';
							elseif ($typeicon == "01n"):
								$weatherIcon = '<i class="wi wi-night-clear"></i>';
							
							elseif ($typeicon == "02d"):
								$weatherIcon = '<i class="wi wi-day-cloudy"></i>';
							elseif ($typeicon == "02n"):
								$weatherIcon = '<i class="wi wi-night-partly-cloudy"></i>';

							elseif ($typeicon == "03d" || $typeicon == "03n"):
								$weatherIcon = '<i class="wi wi-cloud"></i>';
							elseif ($typeicon == "04d" || $typeicon == "04n"):
								$weatherIcon = '<i class="wi wi-cloudy"></i>';
							elseif ($typeicon == "09d" || $typeicon == "09n"):
								$weatherIcon = '<i class="wi wi-showers"></i>';
							elseif ($typeicon == "10d"):
								$weatherIcon = '<i class="wi wi-rain"></i>';
							elseif ($typeicon == "10n"):
								$weatherIcon = '<i class="wi wi-night-alt-rain"></i>';
							elseif ($typeicon == "11d" || $typeicon == "11n"):
								$weatherIcon = '<i class="wi wi-thunderstorm"></i>';
							elseif ($typeicon == "13d" || $typeicon == "13n"):
								$weatherIcon = '<i class="wi wi-day-fog"></i>';
							elseif ($typeicon == "50d" || $typeicon == "50n"):
								$weatherIcon = '<i class="wi wi-night-fog"></i>';

							else:
								$weatherIcon = '<i class="wi wi-alien"></i>';

							endif;

							return $weatherIcon;
						}

						if(isset($_GET['loc'])) {
							$location = $_GET['loc'];
						} else {
							$location = '2655049';
						}

						// call weather
						$session = curl_init('http://api.openweathermap.org/data/2.5/forecast?id='.$location.'&appid=e3db0ccaeae256f11a5dfb6fadf3de49');
						curl_setopt($session, CURLOPT_RETURNTRANSFER, true);
						$json = curl_exec($session);
						$weatherObj =  json_decode($json);

						$cities_file    = file_get_contents(get_stylesheet_directory_uri() . '/assets/cities.txt');
						$rows        = explode("\n", $cities_file);
						array_shift($rows);

						// set days array
						$days = $weatherObj->list;

						// set today for ref
						$day_zero = date("D", strtotime("now"));
						$day_one = date("D", strtotime("+1 day"));
						$day_two = date("D", strtotime("+2 days"));
						$day_three = date("D", strtotime("+3 days"));
						$day_four = date("D", strtotime("+4 days"));
						$day_five = date("D", strtotime("+5 days"));

						?>

						<div class="weather_box">

							<header class="clear">
								<span>Today</span>
								<span><?php echo $weatherObj->city->name; ?></span>
							</header>

							<section class="temp clear">
								<span><?php echo kelvin_to_celsius($weatherObj->list[0]->main->temp); ?>&deg;C</span>
								<span><?php echo weather_icon($weatherObj->list[0]->weather[0]->icon); ?></span>
							</section>

							<section class="days clear">

							<?php foreach ($days as $day ):

								if( date("D", $day->dt) != $day_zero): ?>

									<div class="<?php echo date("D", $day->dt); ?>">
										<span class="day"><?php echo date("D", $day->dt); ?></span>
										<span class="time"><?php echo date("H:i A", $day->dt); ?></span>
										<span class="tmp"><?php echo kelvin_to_celsius($day->main->temp); ?>&deg;C</span>
										<span class="icn"><?php echo weather_icon($day->weather[0]->icon); ?></span>
									</div>

								<?php endif; 

							endforeach; ?>

							</section>

							<section class="search_box">

								<select id="cities" class="cities" name="cities" data-placeholder="Search for a location" style="width:100%;">
									<option value=""></option>
									<?php
										foreach($rows as $row => $data)
										{
										    //get row data
										    $row_data = explode('^', $data);

										    $info[$row]['id']	= $row_data[0];
										    $info[$row]['nm']	= $row_data[1];

										    echo '<option value="'.$info[$row]['id'].'">'.$info[$row]['nm'].'</option>';
										}
									?>
								</select>

							</section>

						</div>

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
				<?php 
				foreach ($result->data as $ig_dc):
				$ig_large = str_replace('s150x150/', 's640x640/', $ig_dc->images->thumbnail->url);
				?>
				<img src="<?php echo $ig_large; ?>" width="640" height="640" alt="">
				<?php if ($counter++ == 0) break; ?>
			<?php endforeach ?> 
			</div>

			<div class="instafeed gallery-thumbs">

                <?php foreach ($result->data as $ig_post): ?>
            	<?php $ig_thumbnail = str_replace('s150x150/', 's320x320/', $ig_post->images->thumbnail->url); ?>
            	<?php $ig_large 	= str_replace('s150x150/', 's640x640/', $ig_post->images->thumbnail->url); ?>
                <div class="ig-card" data-thumbnail="<?php echo $ig_large; ?>">
                	<div class="overlay">
                		<div class="table"><div class="cell middle">
	                		<ul>
	                			<li>
	                				<a target="_blank" href="<?php echo $ig_post->link; ?>">
	                					<i class="fa fa-heart" aria-hidden="true"></i> <?php echo $ig_post->likes->count; ?>
	                				</a>
	                			</li>
	                			<li>
	                				<a target="_blank" href="<?php echo $ig_post->link; ?>">
	                					<i class="fa fa-comment" aria-hidden="true"></i> <?php echo $ig_post->comments->count; ?>
	                				</a>
	                			</li>
	                		</ul>
	                	</div></div>
                	</div>
                    <img src="<?php echo $ig_thumbnail; ?>" width="320" height="320" alt="">
                </div>
                <?php if ($counter++ == 9) break; ?>
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
					  				<a href="<?php the_permalink(); ?>"><h3><?php the_title(); ?></h3></a>
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
					  				<a href="<?php the_permalink(); ?>"><h3><?php the_title('\'', '\''); ?></h3></a>
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
