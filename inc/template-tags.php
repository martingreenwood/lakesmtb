<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package lakesmtb
 */

if ( ! function_exists( 'lakesmtb_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function lakesmtb_posted_on() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf(
		esc_html_x( 'Posted on %s', 'post date', 'lakesmtb' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);

	$byline = sprintf(
		esc_html_x( 'by %s', 'post author', 'lakesmtb' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);

	echo '<span class="posted-on">' . $posted_on . '</span><span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.

}
endif;

if ( ! function_exists( 'lakesmtb_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function lakesmtb_entry_footer() {
	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( esc_html__( ', ', 'lakesmtb' ) );
		if ( $categories_list && lakesmtb_categorized_blog() ) {
			printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'lakesmtb' ) . '</span>', $categories_list ); // WPCS: XSS OK.
		}

		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', esc_html__( ', ', 'lakesmtb' ) );
		if ( $tags_list ) {
			printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'lakesmtb' ) . '</span>', $tags_list ); // WPCS: XSS OK.
		}
	}

	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		/* translators: %s: post title */
		comments_popup_link( sprintf( wp_kses( __( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'lakesmtb' ), array( 'span' => array( 'class' => array() ) ) ), get_the_title() ) );
		echo '</span>';
	}

	edit_post_link(
		sprintf(
			/* translators: %s: Name of current post */
			esc_html__( 'Edit %s', 'lakesmtb' ),
			the_title( '<span class="screen-reader-text">"', '"</span>', false )
		),
		'<span class="edit-link">',
		'</span>'
	);
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function lakesmtb_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'lakesmtb_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'lakesmtb_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so lakesmtb_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so lakesmtb_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in lakesmtb_categorized_blog.
 */
function lakesmtb_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'lakesmtb_categories' );
}
add_action( 'edit_category', 'lakesmtb_category_transient_flusher' );
add_action( 'save_post',     'lakesmtb_category_transient_flusher' );



if ( ! function_exists('array_group_by') ) :
	/**
	 * Groups an array by a given key.
	 *
	 * Groups an array into arrays by a given key, or set of keys, shared between all array members.
	 *
	 * Based on {@author Jake Zatecky}'s {@link https://github.com/jakezatecky/array_group_by array_group_by()} function.
	 * This variant allows $key to be closures.
	 *
	 * @param array $array   The array to have grouping performed on.
	 * @param mixed $key,... The key to group or split by. Can be a _string_,
	 *                       an _integer_, a _float_, or a _callable_.
	 *
	 *                       If the key is a callback, it must return
	 *                       a valid key from the array.
	 *
	 *                       ```
	 *                       string|int callback ( mixed $item )
	 *                       ```
	 *
	 * @return array|null Returns a multidimensional array or `null` if `$key` is invalid.
	 */
	function array_group_by( array $array, $key )
	{
		if ( ! is_string( $key ) && ! is_int( $key ) && ! is_float( $key ) && ! is_callable( $key ) ) {
			trigger_error( 'array_group_by(): The key should be a string, an integer, or a callback', E_USER_ERROR );
			return null;
		}
		$func = ( is_callable( $key ) ? $key : null );
		$_key = $key;
		// Load the new array, splitting by the target key
		$grouped = [];
		foreach ( $array as $value ) {
			if ( is_callable( $func ) ) {
				$key = call_user_func( $func, $value );
			} elseif ( is_object( $value ) && isset( $value->{ $_key } ) ) {
				$key = $value->{ $_key };
			} elseif ( isset( $value[ $_key ] ) ) {
				$key = $value[ $_key ];
			} else {
				continue;
			}
			$grouped[ $key ][] = $value;
		}
		// Recursively build a nested grouping if more parameters are supplied
		// Each grouped array value is grouped according to the next sequential key
		if ( func_num_args() > 2 ) {
			$args = func_get_args();
			foreach ( $grouped as $key => $value ) {
				$params = array_merge( [ $value ], array_slice( $args, 2, func_num_args() ) );
				$grouped[ $key ] = call_user_func_array( 'array_group_by', $params );
			}
		}
		return $grouped;
	}
endif;