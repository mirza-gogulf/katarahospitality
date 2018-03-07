<div class="left-sidebar contact-sidebar">
	<div class="contact-address-holder">
		<div class="address-holder">
			<strong class="title"><?php _e( 'address', 'katara' ); ?></strong>
			<address><?php the_field( 'cntact_address' ) ?></address>
		</div>
		<div class="phone-holder">
			<strong class="title"><?php _e( 'telephone', 'katara' ) ?></strong>
			<ul>
				<li class="tel">
                    <?php echo sprintf( '<span>%1$s: </span><a href="tel:%2$s" class="clickable-link">%2$s</a>', __( 'Tel', 'katara'), get_theme_mod( KATARA_PREFIX . "footer_tel" ) ); ?>
                </li>
                <li class="fax">
                    <?php echo sprintf( '<span>%s: </span><span class="fax1">%s</span>', __( 'Fax', 'katara'), get_theme_mod( KATARA_PREFIX . "footer_fax" ) ); ?>
                </li>
			</ul>
		</div>
		<div class="direction-holder">
			<strong class="title"><?php _e( 'directions', 'katara' ) ?></strong>
			<div class="direction-info">
			 <?php echo sprintf( '%s <a href="%s" target="_blank">%s</a> %s', __( 'Download directions', 'katara' ), get_theme_mod( KATARA_PREFIX . "direction_file" ), __( 'here', 'katara' ),  __( 'as a PDF', 'katara' ) ); ?>
			</div>
		</div>
	</div>
</div>