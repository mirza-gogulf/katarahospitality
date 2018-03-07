<?php global $firstNews; 
$nImg = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ), 'full'); ?>

<div class="card news-card <?php echo ( $firstNews ) ? 'd-flex' : '' ?> align-items-stretch flex-row">
	<div class="card-body d-flex flex-column justify-content-between">
		<h5 class="card-title"><a href="<?php the_permalink() ?>"><?php the_title() ?></a><span class="date"><?php echo get_the_date(); ?></span></h5>

		<?php $locationTerm = wp_get_post_terms( get_the_ID(), 'locations' ); 
		if ($locationTerm && count( $locationTerm ) > 0 ) : ?>

		<div class="card-bottom d-flex justify-content-between">
			<ul class="tag-cloud d-flex">
				<?php foreach ($locationTerm as $key => $loc) { 
					echo sprintf('<li><a href="%s">%s</a></li>', home_url() .'/news?_l='.$loc->term_id, $loc->name ); ?>

				<?php } ?>
			</ul>
		</div>
	<?php endif; ?>

	</div>
	<?php if ( $nImg ) { ?>
	<div class="image-holder">
		<a href="<?php the_permalink() ?>"><img class="img-fluid" src="<?php echo aq_resize( $nImg, 503, 303, true, true, true ) ?>" alt="Card image"></a>
	</div>
	<?php } ?>

</div>
<?php if( $firstNews ) { $firstNews = false; }