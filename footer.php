<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package lakesmtb
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="container">
			<div class="row">
				<div class="social">
					<h3>Follow Us:</h3>
					<ul>
						<li><a href="<?php the_field('instagram_url', 'options'); ?>"><i class="fa fa-instagram"></i>Instagram</a></li>
						<li><a href="<?php the_field('twitter_url', 'options'); ?>"><i class="fa fa-twitter"></i>Twitter</a></li>
						<li><a href="<?php the_field('facebook_url', 'options'); ?>"><i class="fa fa-facebook"></i>Facebook</a></li>
					</ul>
				</div>

				<div class="footer-menu">
					<h3>Lakes MTB:</h3>
					<?php wp_nav_menu( array( 'theme_location' => 'footer' ) ); ?>
				</div>

				<div class="info">
					<h3>Info:</h3>
					<ul>
						<li><a href="/index.php/advertisers">Advertisers</a></li>
						<li><a href="/index.php/privacy-policy">Privacy Policy</a></li>
						<li><a href="/index.php/contact">Contact</a></li>
					</ul>
				</div>

				<div class="sign-up">
					<h3>Sign up for news & offers:</h3>
					<p>Join our mailing list for occasional email updates on events, news & offers.</p>
						<!-- Begin MailChimp Signup Form -->
							
							
							<div id="mc_embed_signup">
							<form action="//lakesmtb.us11.list-manage.com/subscribe/post?u=08fa162da6d05141333e6bc83&amp;id=afa381a7be" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
							    <div id="mc_embed_signup_scroll">
								
								<input type="email" value="" name="EMAIL" class="email" id="mce-EMAIL" placeholder="Enter email address here..." required>
							    <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
							    <div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_08fa162da6d05141333e6bc83_afa381a7be" tabindex="-1" value=""></div>
							    <div class="clear"><input type="submit" value="Send it!" name="subscribe" id="mc-embedded-subscribe" class="button"></div>
							    </div>
							</form>
							</div>
						<!--End mc_embed_signup-->
				</div>


				<div class="site-info">
					<p>&copy;<?php echo date("Y"); ?> - LakesMTB</p>
				</div><!-- .site-info -->

			</div>
		</div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
