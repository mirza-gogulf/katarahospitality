<?php
    get_header();
    the_post();
?>
    <div class="hotel-filter">
        <a href="<?php bloginfo( 'url' ); ?>/our-hotels/" class="slidingDoors2 inlineBlock <?php echo ( ! isset( $_GET['ba'] ) ) ? 'active': ''; ?>" id="hotel-filter-region">
            <span class="btnL">&nbsp;</span>
            <?php _e( 'By Region', "Katara" ); ?>
            <span class="btnR">&nbsp;</span>
        </a>
        <a href="<?php bloginfo( 'url' ); ?>/our-hotels/?ba=1" class="slidingDoors2 inlineBlock <?php echo ( isset( $_GET['ba'] ) ) ? 'active': ''; ?>" id="hotel-filter-business">
            <span class="btnL">&nbsp;</span>
            <?php _e( 'By Business Area', "Katara" ); ?>
            <span class="btnR">&nbsp;</span>
        </a>
    </div>
<?php
    get_sidebar('navi');

    get_template_part( 'modules/hotel' );

    get_footer();
?>