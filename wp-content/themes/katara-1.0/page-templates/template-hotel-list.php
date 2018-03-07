<?php
/*
Template Name: Hotel List Page layout
Template Post Type: page
*/
get_header(); 

$countrySlug = isset( $_GET['_c'] ) ? esc_html( $_GET['_c'] ) : '';
// get country name
$term = get_term_by('slug', $countrySlug, 'locations'); 
$currCountryName = $term->name; 
$currCountryID = $term->term_id; 
$currRegionSlug = get_field( 'kat_region', $term->taxonomy.'_'.$currCountryID ); 
// $currRegionName = _e( $currRegionName, 'katara');

$allRegions = kataraRegions(); 
$currRegionName = $allRegions[$currRegionSlug]; 

global $currRegionSlug, $currCountryID; ?>

	<div class="content-inner-holder">

	<?php get_template_part( 'template-parts/sidebar/sidebar', 'hotel-list' ); ?>

	<div class="inner-content">
		<section class="k-section k-section-hotels">
			<div class="title-holder">
				<strong class="title-top"><?php _e( 'Our Hotels', 'katara' ) ?> - <?php echo $currRegionName ?></strong>
				<h3><?php echo $currCountryName ?></h3>
			</div>

			<div class="row">

				<?php $hotelByCntryQuery = kataraGetPost( 'hotels', '', -1, array( $currCountryID ) );
						 		
					if ( $hotelByCntryQuery -> have_posts() ) : 

						while ( $hotelByCntryQuery -> have_posts() ) : $hotelByCntryQuery -> the_post(); 

							get_template_part( 'template-parts/loop/loop', 'hotel' ); 
						
						endwhile;

				endif; ?>
				
			</div>
		</section>
	</div>

	</div>


<?php get_footer();
