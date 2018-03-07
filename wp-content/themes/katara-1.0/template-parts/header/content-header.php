<header class="<?php echo ( is_front_page() ) ? 'fixed' : '' ?>">
	<div class="container">
		<nav class="navbar navbar-expand-lg navbar-light bg-nav justify-content-between">
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<?php $logo = get_theme_mod( KATARA_PREFIX . 'header_logo' );
			$logoInner = get_theme_mod( KATARA_PREFIX . 'header_inner_logo' ); ?>

			<a class="navbar-brand d-lg-none" href="<?php echo esc_url( home_url( '/' ) ); ?>"><img class="logo-white" src="<?php echo $logo ?>" width="140" height="129" alt="logo"><img class="logo-inner" src="<?php echo $logoInner ?>" width="140" height="129" alt="logo"></a>
			<span class="trig-left" id="trig-left">menu</span>
			<div class="collapse navbar-collapse justify-content-md-center" id="navbarSupportedContent">

				<?php wp_nav_menu( array( 'theme_location' => 'header-1', 'container' => '', 'items_wrap' => '<ul class="navbar-nav" >%3$s</ul>' ) ); ?>
			
				<div class="logo hidden-lg-down d-lg-block">
					<a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>"><img class="logo-white" src="<?php echo $logo ?>" width="140" height="129" alt="logo"><img class="logo-inner" src="<?php echo $logoInner ?>" width="140" height="129" alt="logo"></a>
				</div>

				<?php wp_nav_menu( array( 'theme_location' => 'header-2', 'container' => '', 'items_wrap' => '<ul class="navbar-nav" >%3$s</ul>' ) ); ?>

			</div>
		</nav>
	</div>
	<div class="lang-list">
		<?php if ( !is_arabic() ) { ?>
			<a href="<?php echo get_kat_blog_path( AR_SITE_ID ); ?>">العربية</a>
		<?php } else { ?>
			<a href="<?php echo get_kat_blog_path( EN_SITE_ID ); ?>">English</a>
		<?php } ?>
	
	</div>
</header>