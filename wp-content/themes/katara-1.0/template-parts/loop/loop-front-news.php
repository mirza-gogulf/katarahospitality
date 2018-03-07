<?php global $nCount; 
$nImg = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ), 'full'); 
if ( !empty( $nImg ) ) : ?>
<div class="card news-card <?php echo( $nCount == 1 ) ? 'd-flex' : '' ?> align-items-stretch flex-row">
	<div class="card-body d-flex flex-column justify-content-between">
		<h5 class="card-title"><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h5>
		<?php $locationTerm = wp_get_post_terms( get_the_ID(), 'locations' ); ?>
		

		<div class="card-bottom d-flex justify-content-between">
			<?php if ($locationTerm && count( $locationTerm ) > 0 ) : ?>
			<ul class="tag-cloud d-flex">
				<?php foreach ($locationTerm as $key => $loc) {
					echo sprintf('<li><a href="%s">%s</a></li>', home_url() .'/news?_l='.$loc->term_id ,$loc->name );
				} ?>
			</ul>
			<?php endif; ?>
			<span class="date"><?php echo get_the_date(); ?></span>
		</div>

	</div>
	<?php if ( $nImg ) { ?>
	<div class="image-holder">
		<a href="<?php the_permalink() ?>"><img class="img-fluid" src="<?php echo aq_resize( $nImg, 503, 303, true, true, true ) ?>" alt="Card image"></a>
	</div>
	<?php } ?>
</div>
<?php endif; ?>