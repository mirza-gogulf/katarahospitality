<?php get_header(); ?>
<div class="not-found">
	<div class="container">
		<div id="four04-cont" class="grid_12 full">
			<div class="grid_6 four04-l">

				<h1 class="ttl-36"><?php echo __( '404: Page not found', "Katara" ); ?></h1>
				<p class="tag-line-29"><?php echo __( 'We\'re sorry, we couldn\'t find that page: there has been an error and the page you were looking for seems to be missing.', "Katara" ); ?></p>
			</div><!-- #content -->
			<div class="grid_6 four04-r">
				<ul>
					<li><p><?php echo __( 'If you typed in the address, please double-check your spelling as it could just be a typo.', "Katara" ); ?></p></li>
					<li><p><?php echo __( 'If you followed a link, it\'s likely to be broken. Please', "Katara" ); ?> <a href="<?php bloginfo('url'); ?>/contact-us/"><?php echo __( 'contact us', "Katara" ); ?></a> <?php echo __( 'and we\'ll fix it as soon as possible.', "Katara" ); ?></p></li>
					<li><p><?php echo __( 'If you\'re not sure what you\'re looking for, please start from our', "Katara" ); ?> <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php echo __( 'homepage', "Katara" ); ?></a>.</p></li>
				</ul>    
			</div><!-- #content -->
		</div><!-- #primary -->
	</div>
</div>

<?php get_footer(); ?>