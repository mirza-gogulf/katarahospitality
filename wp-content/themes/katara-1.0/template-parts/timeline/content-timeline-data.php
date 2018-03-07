<?php
$featImg = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ), 'full');  
if ( $featImg ) { ?>
<div class="history-right-image">
	<img src="<?php echo aq_resize( $featImg, 678, 475, true, true, true ) ?>" class="img-fluid" alt="image">
</div>
<?php } ?>
<div class="history-right-text">
	<strong class="title"><?php the_title() ?></strong>
	<?php the_content(); ?>
</div>