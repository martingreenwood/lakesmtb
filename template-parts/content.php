<?php
/**
 * Template part for displaying posts.
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


	<header class="entry-header">
		<?php
			if ( is_single() ) {
				the_title( '<h1 class="entry-title">', '</h1>' );
			} else {
				the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			}

		if ( 'post' === get_post_type() ) : ?>
		<div class="entry-meta">
			<?php lakesmtb_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php
		endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php
			the_content( sprintf(
				/* translators: %s: Name of current post. */
				wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'lakesmtb' ), array( 'span' => array( 'class' => array() ) ) ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			) );

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'lakesmtb' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php lakesmtb_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
