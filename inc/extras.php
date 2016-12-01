<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package lakesmtb
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function lakesmtb_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	return $classes;
}
add_filter( 'body_class', 'lakesmtb_body_classes' );


/**
 * GET XML / JSON / DATA
 */
function get_data($data_url)
{
    $curl = curl_init();
    $options = array(
        CURLOPT_URL => $data_url,
        CURLOPT_RETURNTRANSFER => 1,
    );
    curl_setopt_array($curl, $options);
    $string = curl_exec($curl);
    return $string;
}

function cached_and_valid($file) {
  $expired_time = time() - 10800; //3 hours
  return file_exists($file) && filemtime($file) > $expired_time;
}

