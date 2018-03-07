<?php $f = false;
$firstYr = null;
if( is_front_page() || is_home() ){ $f = true; } ?>

<div class="history-block d-flex align-items-<?php echo ($f) ? 'center' : 'start' ?>">
	<?php $timelineYrs = kataraTaxonomyTermList( 'history_year', 12 ); 
	if ( $timelineYrs && count( $timelineYrs ) > 0 ) : ?>
	<div class="history-left">
		<ul class="year-list">

			<?php $first = true;

			foreach ($timelineYrs as $key => $yr) {
				$fclass = '';
				if( $first ){
					$fclass = 'active';
					$firstYr = $yr->term_id;
				}
				$first = ( $first ) ? false : '';
				echo sprintf( '<li class="%s"><a href="" data-yid="%s">%s</a></li>', $fclass, $yr->term_id, $yr->name );
			} ?>
		
		</ul>
	</div>
<?php endif; ?>
	<div class="history-right d-flex <?php echo ($f) ? 'align-items-center' : 'flex-column flex-wrap' ?>">
		<?php $fTimelineQuery = kataraGetPost( 'history_timeline', $firstYr ); 
		if ( $fTimelineQuery -> have_posts() ) :
			while ( $fTimelineQuery -> have_posts() ) : $fTimelineQuery -> the_post(); 
				
				get_template_part( "template-parts/timeline/content", "timeline-data" );
			
			endwhile; 
		else :
			_e( 'No Results Found.', 'katara' );
		endif;
		wp_reset_postdata(); ?>

	</div>
</div>