<section class="k-section k-section-about-katara" id="k-section-about-katara">
	<div class="block-katara-hodpitality container wow bounceInUp" data-wow-delay="0.2s">
		<div class="title-holder">
			<h2><?php the_field( 'front_intro_section_title' ) ?></h2>
		</div>
		<div class="about-box">
			<div class="about-box-top d-flex align-items-center">
				<div class="about-box-top-left">
					<?php the_content(); ?>
				</div>
				<?php if( get_field( 'front_employee_count' ) ) { ?>
				<div class="about-box-top-right d-flex flex-column align-items-center">
					<span class="counter" id="targetElement"><?php echo get_field( 'front_employee_count' ) ?></span>
					<span class="text"><?php echo get_field( 'front_employee_label' ) ?></span>
				</div>
				<?php } ?>
			</div>
			<div class="about-box-bottom d-flex">
				<div class="about-box-bottom-left">
					<?php $abutSideMenus = get_field( 'front_intro_side_menu' ); 
					if ( $abutSideMenus && count( $abutSideMenus ) > 0 ) : ?>
					<ul class="about-list">
						<?php foreach ($abutSideMenus as $key => $smenu) {
							echo sprintf('<li><a href="%s">%s</a></li>', esc_url( $smenu['fintro_menu_link'] ), esc_attr( $smenu['fintro_menu_title'] ) ); 
						} ?>
					</ul>
					<?php endif; ?>
				</div>
				<div class="about-box-bottom-right d-flex align-items-center justify-content-around">
					<?php if( get_field( 'front_employee_count' ) ) { ?>
					<div class="counter-half">
						<span class="counter" id="targetElement2"><?php echo get_field( 'front_prop_count' ) ?></span>
						<span class="text"><?php echo get_field( 'front_prop_label' ) ?></span>
					</div>
					<?php }
					if( get_field( 'front_employee_count' ) ) { ?>
					<div class="counter-half">
						<span class="counter" id="targetElement3"><?php echo get_field( 'front_keys_count' ) ?></span>
						<span class="text"><?php echo get_field( 'front_keys_label' ) ?></span>
					</div>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- section-about-katara end -->